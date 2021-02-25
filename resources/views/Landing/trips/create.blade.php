@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   


    <script>
       $(document).ready(function(){
       let row_number = 1;
       $("#add_row").click(function(e){
           e.preventDefault();
           let new_row_number = row_number - 1;
           $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
           $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
           row_number++;
       });
       
                                                      
       $("#delete_row").click(function(e){
           e.preventDefault();
           if(row_number > 1){
           $("#product" + (row_number - 1)).html('');
           row_number--;
           }
       });

       
       });                                          
      

</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create Trips') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('POST', route('fisherman.trip.store', $fisherman->id))->open() }}
                <div class="form-group">
                    <input type="hidden" name="fisherman_id" value="{{ $fisherman->id }}" />    
                    <label for="trip_hrs">Trip Hours</label>
                    <input type="Number" class="form-control" id="trip_hrs" name="trip_hrs" placeholder="Enter Trip Hours"   value="{{old('trip_hrs')}}">
                </div>

                <div class="form-group">
                    <label for="number_of_fishers">Number of Fisherman Per Trip</label>
                    <input type="text" class="form-control" id="number_of_fishers" name="number_of_fishers" placeholder="Enter Number of fisherman per trip"   value="{{old('number_of_fishers')}}">
                </div>

                <div class="form-group">
                    <label for="trip_date">Trip Date</label>
                    <input type="date" class="form-control" id="trip_date" name="trip_date" placeholder="Enter trip date"   value="{{old('trip_date')}}">
                </div>
                <div class="form-group">
   
                <label for="location_id">Location name</label>
                <select class="form-control" name="location_id" id="location_id">
                
                @foreach($locations as $key => $item)
                       <option value="{{ $key }}" >{{ $item }}</option>
                @endforeach
                </select>

                </div>

                <div class="form-group">
   
                <label for="method_id">Fishing method</label>
                <select class="form-control" name="method_id" id="method_id">
                
                @foreach($methods as $key => $item)
                <option value="{{ $key }}" >{{ $item }}</option>
                @endforeach
                </select>

                </div>
                
                <div>

                    <div>
                        <table class="table" id="products_table">
                            <thead>
                                <tr>
                                    <th>Species</th>
                                    <th>Weight</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <tr id="product0">
                                        <td class="col-md-2">
                                    
                                        
                                                    <select name="species_id[]" class="form-control">
                                                        <option value="">-- choose species --</option>
                                                        @foreach ($species as $key => $item)
                                                            <option value="{{ $key}}">
                                                            {{ $item}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                    
                                    
                                        </td>
                                        <td class="col-md-2">
                                    
                                        
                                        <input type="double" name="weight[]" class="form-control" value="1" />
                                    
                                        </td>

                                        

                                    </tr>
                                    <tr id="product1"></tr>

                                </tbody>
                        </table>

                        <div>
                            <div class="col-md-12">
                                <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                <button id='delete_row' class="btn btn-default pull-right">- Delete Row</button>
                            </div>

                        </div>
                    </div>
                </div>

                                        
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection