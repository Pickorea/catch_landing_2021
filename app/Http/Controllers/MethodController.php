<?php

namespace App\Http\Controllers;

use App\Http\Requests\Landing\ViewRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\LocationDataTable;
use App\Models\Method;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreMethodRequest;
use App\Http\Requests\Landing\UpdateMethodRequest;
use App\Services\MethodService;
use Yajra\DataTables\Facades\DataTables;

class MethodController extends Controller
{

    /**
     * @var MethodService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param MethodService $service
    */
    public function __construct(MethodService $service)
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
        // $methods = Method::paginate(10);
        // dd($Location);
        return view('landing.methods.index');//->withItems($methods);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landing.methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMethodRequest $request)
    {
        $item = $this->service->store($request->validated());

        return redirect()->route('method.index')
        ->with('success', 'Location created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Method $method)
    {
        return view('landing.methods.show')->withItem($method);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Method $method)
    {
        // dd($Location);
        return view('landing.methods.edit')->withItem($method);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMethodRequest $request, Method $method)
    {
        $this->service->update($method, $request->validated());

        return redirect()->route('method.index')
                        ->with('success', 'Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Method $method)
    {
        $this->service->delete($method);

        return redirect()->route('method.index')
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
