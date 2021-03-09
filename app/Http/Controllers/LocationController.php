<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landing\ViewRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreLocationRequest;
use App\Http\Requests\Landing\UpdateLocationRequest;
use App\Services\LocationService;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * @var LocationService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param LocationService $service
    */
    public function __construct(LocationService $service)
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
        return view('landing.Locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $item = $this->service->store($request->validated());

        return redirect()->route('location.index')
        ->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('landing.locations.show')->withItem($location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        // dd($Location);
        return view('landing.locations.edit')->withItem($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $this->service->update($location, $request->validated());
    
        return redirect()->route('location.index')
                        ->with('success', 'Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $this->service->delete($location);

        return redirect()->route('location.index')
            ->with('success', 'Location deleted successfully');
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
            ->make(true);

        return $datatables;
    }
}
