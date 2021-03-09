<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landing\ViewRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\IslandDataTable;
use App\Models\Fisherman;
use App\Models\Trip;
use App\Models\Species;
use App\Services\TripService;
use App\Models\Location;
use App\Models\Method;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreFishermanRequest;
use App\Http\Requests\Landing\UpdateFishermanRequest;
use App\Exports\TripExport;
use Excel;
use Yajra\DataTables\Facades\DataTables;

class FishermanTripController extends Controller
{
    /**
    * @var TripService
    */
    protected $service;

    /**
    * TripController constructor.
    * @param TripService $service
    */
    public function __construct(TripService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $trips = Fisherman ::with(['trips'])->paginate(5);


        return view('landing.trips.index');//->withItems($trips);
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
    public function fishermanEdit(Fisherman $fisherman, Trip $trip)
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

    public function edit(Trip $trip)
    {
        $species = Species::pluck('species_name', 'id');
        $locations = Location::pluck('location_name', 'id');
        $methods = Method::pluck('method_name', 'id');

        return view('landing.trips.edit')
            ->withFisherman($trip->fisherman)
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

    public function datatables(ViewRequest $request)
    {
        $search = $request->get('search', '');

        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->service->datatables($search);

        $datatables = DataTables::make($query)
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('Y-m-d') : '';
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at ? with(new Carbon($row->updated_at))->format('Y-m-d') : '';
            })
            ->editColumn('trip_date', function ($row) {
                return $row->trip_date ? with(new Carbon($row->trip_date))->format('Y-m-d') : '';
            })
            ->make(true);

        return $datatables;
    }
}
