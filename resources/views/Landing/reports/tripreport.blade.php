@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Report') }}
                <div class="btn pull-right"> <a href="{{ route('export-excel') }}"> <button  class="btn btn-primary ">Export</button></a> </div>
                </div>
            

                <div class="card-body">
                   
                <section style="padding-top:7px;">
                
                    <div class="container">
                    
                            <div class="row">
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Island</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Trip hrs</th>
                                        <th scope="col">Nbrs of Fishers</th>
                                        <th scope="col">Trip Date</th>
                                        <th scope="col">Fishing Area</th>
                                        <th scope="col">Fishing Method</th>
                                        <th scope="col">Species Name</th>
                                        <th scope="col">Weight</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                      @foreach($reports as $report)
                                    <tr>                       
                                        <td>{{$report->island_name}}</td>
                                        <td> {{$report->first_name}}</td> 
                                        <td> {{$report->last_name}}</td>
                                        <td> {{$report->trip_hrs}}</td> 
                                        <td> {{$report->number_of_fishers}}</td> 
                                        <td> {{$report->trip_date}}</td>  
                                        <td> {{$report->location_name}}</td> 
                                        <td> {{$report->method_name}}</td> 
                                        <td> {{$report->species_name}}</td> 
                                        <td> {{$report->weight}}</td> 
                                        
                                       
                                        {{--<td> 
                                        {{ html()->form('DELETE', route('island.destroy', $island->id))->open() }}
                                            <a class="btn btn-info" href="{{ route('island.show',$island->id) }}">Show</a>                                          
                                            <a class="btn btn-primary" href="{{ route('island.edit',$island->id) }}">Edit</a>                                                                                        
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ html()->form()->close() }}  
                                        </td>  --}}
                                                            
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                         </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                {{ $reports->links() }}               
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