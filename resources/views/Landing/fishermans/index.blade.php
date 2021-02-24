@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Index of fisherman') }}
                <div class="btn pull-right"> <a href="{{ route('fisherman.create') }}"> <button  class="btn btn-primary ">Create</button></a> </div>
                </div>
            

                <div class="card-body">
                   
                <section style="padding-top:7px;">
                
                    <div class="container">
                    
                            <div class="row">
                            {{ html()->form()->open() }}
                            <select name="forma"  data-placeholder="Select island" style="width:350px;"   class="chosen-select" tabindex="5" onchange="location =    this.options[this.selectedIndex].value;">
                            <option value="">Islands - Fisherman</option>
                                    @foreach ($items as $island)
                                    <a href="{{route('island.fisherman.create',$island->id)}}"><optgroup value="{{$island->id}}" label="{{$island->island_name}}"></a>
                                        @foreach($island->fisherman as $fisher)
                                        <option value="{{route('fisherman.trip.create', [$fisher->id,$island->id,])}}">
                                        <a href="{{route('fisherman.trip.create',  [$fisher->id,$island->id,])}}">{{$fisher->first_name}}  {{$fisher->last_name}}</a>
                                        </option>
                                    <!-- </optgroup> -->
                                    @endforeach
                            @endforeach
                            {{ html()->form()->close() }}
                            </select>
                            {{--<table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fisherman First Name</th>
                                        <th scope="col">Fisherman Last Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    @foreach ($items as $island)
                                    <tr>                       
                                        <th scope="row">{{$island->id}}</th>
                                        @foreach($island->fisherman as $fisher)
                                        <td> {{$fisher->first_name}}</td> 
                                        <td> {{$fisher->last_name}}</td> 
                                            
                                        @endforeach
                                        <td> 
                                        {{ html()->form('DELETE', route('fisherman.destroy', $island->id))->open() }}
                                            <a class="btn btn-info" href="{{ route('fisherman.show',$island->id) }}">Show</a>                                          
                                            <a class="btn btn-primary" href="{{ route('fisherman.edit',$island->id) }}">Edit</a>                                                                                        
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ html()->form()->close() }}  
                                        </td>  
                                                            
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                         </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                {!! $items->links() !!}                           
                                </ul>
                            </nav>
                            </div>
                    
                    </div>--}}
                   
                </section>
               
                   
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection