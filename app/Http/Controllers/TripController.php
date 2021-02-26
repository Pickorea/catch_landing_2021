<?php

namespace App\Http\Controllers;

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
Use Excel;
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

        $trips = Fisherman ::with (['trips'])->paginate(5);


        return view('landing.trips.index')->withItems($trips);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fisherman $fisherman)
    {
         $species = Species::pluck('species_name','id');
         $locations = Location::pluck('location_name','id');
         $methods = Method::pluck('method_name','id');
        //  dd($species);
        return view('landing.trips.create')
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
      
        $trip = Trip::create(
            [
            'fisherman_id' => $request->fisherman_id,
            'trip_hrs' => $request->trip_hrs,
            'number_of_fishers' => $request->number_of_fishers,
            'trip_date' => $request->trip_date,
            'location_id' => $request->location_id,
            'method_id' => $request->method_id
        ]);

        $species = $request->input('species_id', []);
        $weight = $request->input('weight', []);



        for ($i=0; $i < count($species); $i++) {
            if ($species[$i] != '') {
                $trip->species()->attach($species[$i], ['weight' => $weight[$i]]);
            }

        }


        return redirect()->route('fisherman.trip.index',$fisherman)
        ->with('success', 'Trip created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return view('landing.trips.show')->withItem($trip);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fisherman $fisherman, Trip $trip)
    {

        $species = Species::pluck('species_name','id');
        $locations = Location::pluck('location_name','id');
        $methods = Method::pluck('method_name','id');

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
    public function update(Request $request, Trip $trip, Fisherman $fisherman)
    {
        $trip->update($request->all());

        // $trip = Trip::update(
        //     [
        //     'fisherman_id' => $request->fisherman_id,
        //     'trip_hrs' => $request->trip_hrs,
        //     'number_of_fishers' => $request->number_of_fishers,
        //     'trip_date' => $request->trip_date,
        //     'location_id' => $request->location_id,
        //     'method_id' => $request->method_id
        // ]);

        $trip->species()->detach();

        $species = $request->input('species_id', []);
        $weight = $request->input('weight', []);



        for ($i=0; $i < count($species); $i++) {
            if ($species[$i] != '') {
                $trip->species()->detach($species[$i], ['weight' => $weight[$i]]);
            }

        }

        return redirect()->route('trip.index')
                        ->with('success','trip updated successfully');
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
        return Excel::download(new TripExport,'triplist.csv');
    }

    public function ExportIntoCsv()
    {
        return Excel::download(new TripExport,'triplist.csv');
    }
}
