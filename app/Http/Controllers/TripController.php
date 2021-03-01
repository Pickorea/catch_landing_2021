<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\IslandDataTable;
use App\Models\Fisherman;
use App\Models\Trip;
use App\Models\Species;
use App\Models\Location;
use App\Models\Method;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreFishermanRequest;
use App\Http\Requests\Landing\UpdateFishermanRequest;
use App\Exports\TripExport;
use Excel;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Fisherman ::with(['trips'])->paginate(5);


        return view('landing.trips.index')->withItems($trips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fisherman $fisherman)
    {
        $species = Species::pluck('species_name', 'id');
        $locations = Location::pluck('location_name', 'id');
        $methods = Method::pluck('method_name', 'id');
        $trip = new Trip();
        $trip->trip_date = Carbon::now();
        $trip->number_of_fishers = 1;

        return view('landing.trips.create')
        ->withTrip($trip)
        ->withFisherman($fisherman)
        ->withSpecies($species)
        ->withLocations($locations)
        ->withMethods($methods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fisherman $fisherman)
    {
        $species = $request->input('species_id', []);
        $weight = $request->input('species_weight', []);

        if (count($species) !== count($weight)) {
            throw new \Exception('Species count mismatched');
        }
        $trip = Trip::create(
            [
            'fisherman_id' => $fisherman->id,
            'trip_hrs' => $request->trip_hrs,
            'number_of_fishers' => $request->number_of_fishers,
            'trip_date' => $request->trip_date,
            'location_id' => $request->location_id,
            'method_id' => $request->method_id
        ]
        );

        $species_pivot = [];
        for ($i=0; $i < count($species); $i++) {
            if ($species[$i] != '') {
                $species_pivot[$species[$i]] = ['weight' => $weight[$i]];
            }
        }
        $trip->species()->sync($species_pivot);


        return redirect()->route('fisherman.trip.index', $fisherman)
        ->with('success', 'Trip created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fisherman $fisherman, Trip $trip)
    {
        return view('landing.trips.show')
            ->withFisherman($trip->fisherman)
            ->withTrip($trip);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fisherman $fisherman, Trip $trip)
    {
        $species = Species::pluck('species_name', 'id');
        $locations = Location::pluck('location_name', 'id');
        $methods = Method::pluck('method_name', 'id');

        return view('landing.trips.edit')
            ->withFisherman($fisherman)
            ->withSpecies($species)
            ->withLocations($locations)
            ->withMethods($methods)
            ->withTrip($trip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fisherman $fisherman, Trip $trip)
    {
        $species = $request->input('species_id', []);
        $weight = $request->input('species_weight', []);

        if (count($species) !== count($weight)) {
            throw new \Exception('Mismatched species counts');
        }
        $trip->update($request->all());

        $species_pivot = [];
        for ($i=0; $i < count($species); $i++) {
            if ($species[$i] != '') {
                $species_pivot[$species[$i]] = ['weight' => $weight[$i]];
            }
        }
        $trip->species()->sync($species_pivot);

        return redirect()
            ->route('trip.index')
            ->withSuccess('trip updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return redirect()->route('trip.index')
            ->with('success', 'Trip deleted successfully');
    }

    public function ExportIntoExcel()
    {
        return Excel::download(new TripExport, 'triplist.csv');
    }

    public function ExportIntoCsv()
    {
        return Excel::download(new TripExport, 'triplist.csv');
    }
}
