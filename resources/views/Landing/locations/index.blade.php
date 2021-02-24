@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Index of Location') }}
                <div class="btn pull-right"> <a href="{{ route('location.create') }}"> <button  class="btn btn-primary ">Create</button></a> </div>
                </div>
            

                <div class="card-body">
                   
                <section style="padding-top:7px;">
                
                    <div class="container">
                    
                            <div class="row">
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Location Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>                       
                                        <th scope="row">{{$item->id}}</th>
                                        <td> {{$item->location_name}}</td> 
                                       
                                        <td> 
                                        {{ html()->form('DELETE', route('location.destroy', $item->id))->open() }}
                                            <a class="btn btn-info" href="{{ route('location.show',$item->id) }}">Show</a>                                          
                                            <a class="btn btn-primary" href="{{ route('location.edit',$item->id) }}">Edit</a>                                                                                        
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ html()->form()->close() }}  
                                        </td>  
                                                            
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                         </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                {{ $items->links() }}                           
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