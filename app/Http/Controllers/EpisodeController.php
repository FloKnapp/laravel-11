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
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EpisodeStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EpisodeController extends Controller
{

    /**
     * @param string $publicId
     *
     * @return View|RedirectResponse
     */
    public function show(string $publicId): View|RedirectResponse
    {
        $episode = Episode::where('public_id', '=', $publicId)->firstOrFail();

        if (! Gate::allows('show-episode', $episode)) {
            abort(403);
        }

        return view('episode.details', compact('episode'));
    }

    /**
     * Display the user's dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function list(): View
    {
        $episodes = Episode::where('user_id', '=', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('episode.list', compact('episodes'));
    }

    /**
     * @param EpisodeStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(EpisodeStoreRequest $request)
    {
        if (! auth()->check()) {
            return redirect(route('home'));
        }

        $rawType      = $request->get('type');
        $rawIntensity = $request->get('intensity');
        $rawSymptoms  = $request->get('symptoms');
        $rawTriggers  = $request->get('triggers');
        $rawDuration  = $request->get('duration');
        $rawPublished = $request->get('published_at');

        $episode = Episode::create([
            'user_id'      => auth()->user()->id,
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

        return redirect(route('home'));
    }

    /**
     * @param int $id
     *
     * @return Factory|View|Application
     */
    public function edit(int $id): Factory|View|Application
    {
        $episode = Episode::findOrFail($id);

        if (! Gate::allows('update-episode', $episode)) {
            abort(403);
        }

        return view('episode.edit', compact('episode'));
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $episode = Episode::findOrFail($id);

        if (! Gate::allows('delete-episode', $episode)) {
            abort(403);
        }

        $episode->state = EpisodeStateType::DELETED->value;
        $episode->save();

        return redirect()->intended(route('episode.list'));
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
