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
            <x-forms.post action="{{ route('fisherman.trip.store', $fisherman->id) }}">
                    <input type="hidden" name="fisherman_id" value="{{ $fisherman->id }}" />
                    <div class="card">
                        <div class="card-header">{{ __('Create Trip') }}</div>
                        <div class="card-body">
                            <x-forms.textfield type="number" name="trip_hrs" label="Trip Hours" />
                            <x-forms.textfield name="number_of_fishers" label="Number of Fisherman Per Trip"  />
                            <x-forms.textfield type="date" name="trip_date" label="Enter trip date"  />
                            <x-forms.select-from-pluck name="location_id" label="Location name"  :options="$locations" placeholder="-- choose fishing location --" />
                            <x-forms.select-from-pluck name="method_id" label="Fishing method"  :options="$methods" placeholder="-- choose fishing method --" />
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
                </x-forms.post>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection