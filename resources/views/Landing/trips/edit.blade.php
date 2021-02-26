@extends('layouts.app')

@section('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        function deleteSelectedRow(button) {
            console.log('delete_row current');
            $(button).parent().parent().html('');
        }
        $(document).ready(function(){
            let row_number = {{ $trip->species->count() }};
            $("#add_row").click(function(e){
                e.preventDefault();
                console.log('add_row ' + row_number);
                let new_row_number = row_number + 1;
                $('#species_table tbody').append('<tr id="species' + new_row_number + '"></tr>');
                $('#species' + new_row_number).html($('#speciestemplaterow').html()).find('td:first-child');
                row_number++;

            });
        });
    </script>
@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-forms.patch action="{{ route('fisherman.trip.update', [$fisherman->id,$trip->id]) }}">
                    <input type="hidden" name="fisherman_id" value="{{ $fisherman->id }}" />
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}" />
                    <div class="card">
                        <div class="card-header">{{ __('Edit Trip') }}</div>
                        <div class="card-body">

                            <x-forms.textfield type="number" name="trip_hrs" label="Trip Hours" value="{{ $trip->trip_hrs }}" />
                            <x-forms.textfield name="number_of_fishers" label="Number of Fisherman Per Trip" value="{{ $trip->number_of_fishers }}" />
                            <x-forms.textfield type="date" name="trip_date" label="Enter trip date" value="{{ $trip->trip_date }}" />
                            <x-forms.select-from-pluck name="location_id" label="Location name" value="{{ $trip->location_id }}" :options="$locations" placeholder="-- choose fishing location --" />
                            <x-forms.select-from-pluck name="method_id" label="Fishing method" value="{{ $trip->method_id }}" :options="$methods" placeholder="-- choose fishing method --" />

                            <table class="table" id="species_table">
                                <thead>
                                <tr>
                                    <th>Species</th>
                                    <th>Weight</th>
                                    <th> <button id="add_row" class="btn btn-default pull-left">+</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--  @foreach (old('species', $species->trips->count() ? $species->trips->trips : ['']) as $species_trip)--}}
                                @foreach ($trip->species as $species)
                                <tr id="species{{ $loop->index }}">
                                    <td>
                                        <x-forms.select-from-pluck name="species_id[]" value="{{$species->species_id}}" :options="$species" placeholder="-- choose species --" />
                                    </td>
                                    <td>
                                        <x-forms.textfield type="number" name="species_weight" value="{{$species->species_weight}}" />
                                    </td>
                                    <td><button type="button" onclick="deleteSelectedRow(this)" class="btn btn-danger pull-right">-</button></td>
                                </tr>
                                 @endforeach

                                {{--<tr id="product{{ count(old('species', $species->trips->count() ? $species->trip : [''])) }}"></tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>
                </x-forms.patch>
        </div>
    </div>
</div>


<div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <x-forms.get>
                <table>
                    <tbody>
            <tr id="speciestemplaterow" class="hidden">
                <td>
                    <x-forms.select-from-pluck name="species_id[]" value="" :options="$species" placeholder="-- choose species --" />
                </td>
                <td>
                    <x-forms.textfield type="number" name="species_weight" value="" />
                </td>
                <td><button type="button" onclick="deleteSelectedRow(this)" class="btn btn-danger pull-right">-</button></td>
            </tr>
                    </tbody>
                </table>
            </x-forms.get>
        </div>
    </div>
</div>
@endsection
