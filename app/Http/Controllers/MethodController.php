<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LocationDataTable;
use App\Models\Method;
use Illuminate\Support\Facades\Paginator;
use App\Http\Requests\Landing\StoreMethodRequest;
use App\Http\Requests\Landing\UpdateMethodRequest;


class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Method::paginate(10);
        // dd($Location);
        return view('landing.methods.index')->withItems($methods);
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
    public function store(Request $request)
    {
        
        $methods = Method::create($request->all());

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
    public function update(Request $request, Method $method)
    {
        $method->update($request->all());
    
        return redirect()->route('method.index')
                        ->with('success','Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Method $method)
    {
        $location->delete();

        return redirect()->route('method.index')
            ->with('success', 'Location deleted successfully');
    }
}
