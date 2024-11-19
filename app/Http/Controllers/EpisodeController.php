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

class EpisodeController extends Controller
{

    /**
     * @param string $publicId
     *
     * @return View
     */
    public function show(string $publicId): View
    {
        $episode = Episode::where('public_id', '=', $publicId)->firstOrFail();
        return view('episode-details', compact('episode'));
    }

    /**
     * @param EpisodeStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(EpisodeStoreRequest $request)
    {
        $rawType      = $request->get('type');
        $rawIntensity = $request->get('intensity');
        $rawSymptoms  = $request->get('symptoms');
        $rawTriggers  = $request->get('triggers');
        $rawDuration  = $request->get('duration');

        $episode = Episode::create([
            'intensity' => $rawIntensity,
            'duration' => $rawDuration,
            'state' => EpisodeStateType::PUBLISHED->value
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

            $episodeSymptom = EpisodeSymptom::firstOrCreate([
                'episode_id' => $episode->id,
                'symptom_id' => $symptom->id
            ]);

            $symptomTiming = SymptomTiming::firstOrCreate([
                'symptom_id' => $symptom->id,
                'timing_id' => $timing->id
            ]);

            $episodeSymptom->save();
            $symptomTiming->save();
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
