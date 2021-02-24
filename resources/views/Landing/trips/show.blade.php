@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Show Island') }}
                <div class="btn pull-right"> <a href="{{ route('species.create') }}"> <button  class="btn btn-primary ">Create</button></a> </div>
                </div>

                <div class="card-body">
                <section style="padding-top:7px;">
                
                <div class="container">
                
                        <div class="row">

                        <section style="padding-top:7px;">
                
                                <div class="container">
                                
                                        <div class="row">
                                        
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID#</th>
                                                    <th scope="col">Species Name</th>
                                                    <th scope="col">Created at</th>
                                                    <th scope="col">Updated at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>                       
                                                    <th scope="row">{{$item->id}}</th>
                                                    <td> {{ $item->species_name}}</td> 
                                                    <td>  {{ $item->created_at}}</td> 
                                                    <td>  {{ $item->updated_at}}</td> 
                                                                    
                                                </tr>
                                                
                                            
                                            </tbody>
                                    </table>
                                        
                                        </div>
                                
                                </div>
                            
                            </section>
                                                
                        </div>
                
                </div>
            
            </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection