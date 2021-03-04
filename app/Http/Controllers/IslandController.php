<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\DataTables\IslandDataTable;
use App\Models\Island;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreIslandRequest;
use App\Http\Requests\Landing\UpdateIslandRequest;
use App\Services\IslandService;
use Yajra\DataTables\Facades\DataTables;

class IslandController extends Controller
{
    
    /**
     * @var IslandService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param IslandService $service
    */
    public function __construct(IslandService $service)
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
        $islands = Island::paginate(10);
        // dd($island);
        return view('landing.islands.index')->with('islands', $islands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.islands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIslandRequest $request)
    {
        $item = $this->service->store($request->validated());

        return redirect()->route('island.index')
        ->with('success', 'Island created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Island $island)
    {
        return view('landing.islands.show')->withItem($island);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Island $island)
    {
        // dd($island);
        return view('landing.islands.edit')->withItem($island);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIslandRequest $request, Island $island)
    {
        $this->service->update($island, $request->validated());
    
        return redirect()->route('island.index')
                        ->with('success', 'island updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Island $island)
    {
        $this->service->delete($island);

        return redirect()->route('island.index')
            ->with('success', 'Product deleted successfully');
    }
}
