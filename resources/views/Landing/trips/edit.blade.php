@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> 

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
      $(document).ready(function(){
        let row_number = {{ count(old('species', $trip->species->count() ? $trip->species : [''])) }};
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
                <div class="card-header">{{ __('Edit species') }}</div>
               

                <div class="card-body">
                   
                {{ html()->form('PATCH', route('fisherman.trip.update', [$item->id,$trip->id]))->open() }}
                <div class="form-group">
                
                    <input type="hidden" name="fisherman_id" value="{{ old('item_id', $item->id) }}" />
                
                    <input type="hidden" name="trip_id" value="{{ old('trip_id', $trip->id) }}" />
                
                    <label for="trip_hrs">Trip Hours</label>
                    <input type="Number" class="form-control" id="trip_hrs" name="trip_hrs"   value="{{old('trip_hrs', $trip->trip_hrs)}}">
                </div>

                <div class="form-group">
                    <label for="number_of_fishers">Number of Fisherman Per Trip</label>
                    <input type="text" class="form-control" id="number_of_fishers" name="number_of_fishers"    value="{{old('number_of_fishers', $trip->number_of_fishers)}}">
                </div>

                <div class="form-group">
                    <label for="trip_date">Trip Date</label>
                    <input type="date" class="form-control" id="trip_date" name="trip_date" placeholder="Enter trip date"   value="{{old('trip_date',$trip->trip_date)}}">
                </div>

                <div class="form-group">
   
                <label for="location_id">Location name</label>
                <select class="form-control" name="location_id" id="location_id">
                <option value="">-- choose fishing location --</option>
                @foreach($locations as $key => $item)
                    
                    <option value="{{ $key }}" {{ ($key == $trip->location_id) ? 'selected' : '' }}>{{ $item }}</option>
                    
                @endforeach
                </select>

                </div>

                <div class="form-group">
   
                <label for="method_id">Fishing method</label>
                <select class="form-control" name="method_id" id="method_id">
                <option value="">-- choose fishing method --</option>
                @foreach($methods as $key => $item)
                <option value="{{ $key }}" {{ ($key == $trip->method_id) ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
                </select>

                </div>
             <div>

             <table class="table" id="products_table">
                            <thead>
                            <tr>
                                    <th>Species</th>
                                    <th>Weight</th>
                             </tr>
                            </thead>
                            <tbody>
                      {{--  @foreach (old('species', $species->trips->count() ? $species->trips->trips : ['']) as $species_trip)--}}
                            <tr >
                                <td>
                                <select name="species_id[]" class="form-control">
                                                        <option value="">-- choose species --</option>
                                                        @foreach ($species as $key => $item)
                                                            <option value="{{ $key}}">
                                                            {{ $item}}
                                                            </option>
                                                        @endforeach
                                </select>
                                </td>
                               
                            </tr>
                      {{-- @endforeach--}}
                        {{--<tr id="product{{ count(old('species', $species->trips->count() ? $species->trip : [''])) }}"></tr>--}}
                        </tbody>
                    </table>
                        </table>

       

                <div>
                    <div class="col-md-12">
                        <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                        <button id='delete_row' class="btn btn-default pull-right">- Delete Row</button>
                    </div>

                </div>
            </div>
   </div>
</div>
<div>
                          
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                {{ html()->form()->close() }}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection