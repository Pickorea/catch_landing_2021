@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Index of Island') }}
                <div class="btn pull-right"> <a href="{{ route('island.create') }}"> <button  class="btn btn-primary ">Create</button></a> </div>
                </div>
            

                <div class="card-body">
                   
                <section style="padding-top:7px;">
                
                    <div class="container">
                    
                            <div class="row">
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Island Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($islands as $island)
                                    <tr>                       
                                        <th scope="row">{{$island->id}}</th>
                                        <td> {{$island->island_name}}</td> 
                                       
                                        <td> 
                                        {{ html()->form('DELETE', route('island.destroy', $island->id))->open() }}
                                            <a class="btn btn-info" href="{{ route('island.show',$island->id) }}">Show</a>                                          
                                            <a class="btn btn-primary" href="{{ route('island.edit',$island->id) }}">Edit</a>                                                                                        
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ html()->form()->close() }}  
                                        </td>  
                                                            
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                         </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                {{ $islands->links() }}                           
                                </ul>
                            </nav>
                            </div>
                    
                    </div>
                   
                </section>
               
                   
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection