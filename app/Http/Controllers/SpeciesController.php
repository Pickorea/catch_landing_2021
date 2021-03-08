<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landing\ViewRequest;
use Carbon\Carbon;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreSpeciesRequest;
use App\Http\Requests\Landing\UpdateSpeciesRequest;
use App\Models\Species;
use App\Services\SpeciesService;
use Yajra\DataTables\Facades\DataTables;

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
