<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landing\ViewRequest;
use App\Services\FishermanService;
use App\Services\IslandService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\IslandDataTable;
use App\Models\Fisherman;
use App\Models\Island;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreFishermanRequest;
use App\Http\Requests\Landing\UpdateFishermanRequest;
use Yajra\DataTables\Facades\DataTables;

class FishermanController extends Controller
{
    protected $service;

    /**
     * FishermanController constructor.
     * @param FishermanService $service
     */
    public function __construct(FishermanService $service)
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
        //$fishermans = Island::with('fisherman')->paginate(10);
        // dd($island);
        return view('landing.fishermans.index'); //->withItems($fishermans);
    }

    public function islandindex(Request $request, $island)
    {
        $island = Island::find(intval($island));
        return view('landing.fishermans.index')->withIsland($island);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Island $island)
    {
        return view('landing.fishermans.create')->withItem($island);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fishermans = Fisherman::create($request->all());

        return redirect()->route('island.index')
        ->with('success', 'Fisherman created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fisherman $fisherman)
    {
        return view('landing.fishermans.show')->withItem($fisherman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $island, int $fisherman)
    {
        // dd($island);
        // dd($fisherman);

        $island = Island::find($island);
        $fisherman = Fisherman::find($fisherman);

        return view('landing.fishermans.edit')->withItem($fisherman)->withIsland($island);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fisherman $fisherman, Island $island)
    {
        $fisherman->update($request->all());

        return redirect()->route('fisherman.index')
                        ->with('success', 'fisherman updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fisherman $fisherman)
    {
        $fisherman->delete();

        return redirect()->route('fisherman.index')
            ->with('success', 'Fisherman deleted successfully');
    }

    public function datatables(ViewRequest $request)
    {
        $search = $request->get('search', '');
        $islandId = intval($request->get('island', '0'));
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->service->datatables($search, $islandId);

        $datatables = DataTables::make($query)
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('Y-m-d') : '';
            })
            ->make(true);

        return $datatables;
    }
}
