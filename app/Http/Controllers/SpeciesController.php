<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreSpeciesRequest;
use App\Http\Requests\Landing\UpdateSpeciesRequest;
use App\Models\Species;
use App\Services\SpeciesService;

class SpeciesController extends Controller
{
      /**
     * @var SpeciesService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param SpeciesService $service
    */
    public function __construct(SpeciesService $service)
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
        $species = Species::paginate(10);
        return view('landing.species.index')->withItems($species);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.species.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpeciesRequest $request)
    {
        $item = $this->service->store($request->validated());

        return redirect()->route('species.index')
        ->with('success', 'Species created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        return view('landing.species.show')->withItem($species);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        return view('landing.species.edit')->withItem($species);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpeciesRequest $request, Species $species)
    {
        $this->service->update($species, $request->validated());
    
        return redirect()->route('species.index')
                        ->with('success', 'species updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Species $species)
    {
        $this->service->delete($species);

        return redirect()->route('species.index')
        ->with('success', 'Product deleted successfully');
    }
}
