<?php

namespace App\Http\Controllers;

use App\Enum\EpisodeStateType;
use App\Models\Episode;
use App\Models\EpisodeType;
use App\Models\EpisodeSymptom;
use App\Models\EpisodeTrigger;
use App\Models\Symptom;
use App\Models\SymptomTiming;
use App\Models\Timing;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EpisodeStoreRequest;
use Illuminate\Support\Facades\Auth;

class EpisodeController extends Controller
{

    /**
     * @param string $publicId
     *
     * @return View
     */
    public function show(string $publicId): View
    {
        if (Auth::check()) {
            $user = Auth::user();
            $episode = Episode::where('public_id', '=', $publicId)
                ->where('user_id', '=', $user->id)
                ->firstOrFail();
            return view('episode-details', compact('episode'));
        }

        return view('not-authorized');
    }

    /**
     * @param EpisodeStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(EpisodeStoreRequest $request)
    {
        if (! Auth::check()) {
            return redirect(route('home'));
        }

        $rawType      = $request->get('type');
        $rawIntensity = $request->get('intensity');
        $rawSymptoms  = $request->get('symptoms');
        $rawTriggers  = $request->get('triggers');
        $rawDuration  = $request->get('duration');
        $rawPublished = $request->get('published_at');

        $episode = Episode::create([
            'user_id'      => Auth::user()->id,
            'state'        => EpisodeStateType::PUBLISHED->value,
            'intensity'    => $rawIntensity,
            'duration'     => $rawDuration,
            'published_at' => $rawPublished,
        ]);

        $type = EpisodeType::firstOrCreate(['name' => $rawType]);
        $episode->types()->attach($type);

        $this->processSymptoms($episode, $rawSymptoms);
        $this->processTriggers($episode, $rawTriggers);

        $episode->save();

        $request->session()->flash('status', 'Episode successfully created!');

        return redirect()->back();
    }

    private function processSymptoms(Episode $episode, array $symptoms): void
    {
        foreach ($symptoms as $symptom => $data) {

            $timing = $data['timing'];

            $symptom = Symptom::firstOrCreate(['name' => $symptom]);
            $timing = Timing::firstOrCreate(['name' => $timing]);

            EpisodeSymptom::firstOrCreate([
                'episode_id' => $episode->id,
                'symptom_id' => $symptom->id
            ]);

            SymptomTiming::firstOrCreate([
                'symptom_id' => $symptom->id,
                'timing_id' => $timing->id
            ]);
        }
    }

    private function processTriggers(Episode $episode, array $triggers): void
    {
        foreach ($triggers as $trigger) {
            $model = EpisodeTrigger::firstOrCreate(['name' => $trigger]);
            $episode->triggers()->attach($model->id);
        }
    }
}
