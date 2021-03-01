@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Show Island') }}
                <div class="btn pull-right"> <a href="{{ route('island.create') }}"> <button  class="btn btn-primary ">Create</button></a> </div>
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
                                                            <th scope="col">IS_ID#</th>
                                                            <th scope="col">Island Name</th>
                                                            <th scope="col">Created at</th>
                                                            <th scope="col">Updated at</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                        <tr>                       
                                                            <th scope="row">{{$item->id}}</th>
                                                            <td> {{ $item->island_name}}</td> 
                                                            <td>  {{ $item->created_at}}</td> 
                                                            <td>  {{ $item->updated_at}}</td> 
                                                            <td>  <a href="{{route('island.fisherman.create',$item->id)}}"><button class="btn btn-primary">Add</button></a></td> 
                                                            
                                                                            
                                                        </tr>
    
                                                       
                                                    </tbody>
                                                    <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">FI_D#</th>
                                                            <th scope="col">Fisherman FullName</th>
                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                                  
                                                        @foreach($item->fisherman as $obj) 
                                                            <tr>                       
                                                                <th scope="row">{{$obj->id}}</th>
                                                                <td> <a href="{{route('fisherman.trip.create',[$obj->id,$item->id])}}">{{ $obj->first_name}} {{ $obj->last_name}}</a></td> 
                                                                <td>  
                                                                 </td> 
                                                                
                                                                                
                                                            </tr>
                                                        @endforeach
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