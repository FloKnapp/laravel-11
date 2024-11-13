<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\EpisodeType;
use App\Models\EpisodeSymptom;
use App\Models\EpisodeTrigger;
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
        $episode = Episode::findOrFail($publicId, 'public_id');
        return view('episode-details', compact('episode'));
    }

    /**
     * @param EpisodeStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(EpisodeStoreRequest $request)
    {

        $rawType = $request->get('type');
        $rawIntensity = $request->get('intensity');
        $rawSymptoms = $request->get('symptoms');
        $rawTriggers = $request->get('triggers');
        $rawDuration = $request->get('duration');

        $symptoms = $this->allOrCreate(EpisodeSymptom::class, $this->normalizeInput($rawSymptoms));
        $triggers = $this->allOrCreate(EpisodeTrigger::class, $this->normalizeInput($rawTriggers));

        $type = EpisodeType::firstOrCreate(['name' => $rawType]);

        $episode = new Episode(['intensity' => $rawIntensity, 'duration' => $rawDuration]);
        $episode->save();

        $episode->types()->attach($type);

        $this->attach($episode, 'symptoms', $symptoms);
        $this->attach($episode, 'triggers', $triggers);

        $episode->save();

        $request->session()->flash('status', 'Episode successfully created!');

        return redirect()->back();
    }

    /**
     * @param array $inputData
     *
     * @return array
     */
    private function normalizeInput(array $inputData): array
    {
        return collect($inputData)->reduce(function($result, $item) {
            $result[]['name'] = $item;
            return $result;
        }, []);
    }

    /**
     * @param string $model
     * @param array  $data
     *
     * @return array
     */
    private function allOrCreate(string $model, array $data): array
    {
        $result = [];

        foreach ($data as $item) {
            $result[] = $model::firstOrCreate($item);
        }

        return $result;
    }

    /**
     * @param Episode $episode
     * @param string  $relation
     * @param array   $models
     *
     * @return void
     */
    private function attach(Episode $episode, string $relation, array $models): void
    {
        foreach ($models as $model) {
            $episode->$relation()->attach($model);
        }
    }
}
