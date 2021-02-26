@extends('layouts.app')

@section('header')
    <script>
        let row_number = {{ $trip->species->count() }};

        function deleteSelectedRow(button) {
            console.log('delete_row current');
            $(button).parent().parent().html('');
        }
        function addRow(button) {
            console.log('add_row ' + row_number);
            let new_row_number = row_number + 1;
            $('#species_table tbody').append('<tr id="species' + new_row_number + '"></tr>');
            $('#species' + new_row_number).html($('#speciestemplaterow').html()).find('td:first-child');
            row_number++;
        }
    </script>
@endsection

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-forms.post action="{{ route('fisherman.trip.store', $fisherman->id) }}">
                    <div class="card">
                        <div class="card-header">{{ __('Create Trip') }} for {{ $fisherman->first_name }} {{ $fisherman->last_name }}</div>
                        <div class="card-body">
                            <x-forms.textfield type="number" name="trip_hrs" label="Trip Hours" required />
                            <x-forms.textfield name="number_of_fishers" label="Number of Fisherman Per Trip"  required />
                            <x-forms.textfield type="date" name="trip_date" label="Enter trip date" required />
                            <x-forms.select-from-pluck name="location_id" label="Location name"  :options="$locations" required placeholder="-- choose fishing location --" />
                            <x-forms.select-from-pluck name="method_id" label="Fishing method"  :options="$methods" required placeholder="-- choose fishing method --" />
                            <table class="table" id="species_table">
                                <thead>
                                <tr>
                                    <th>Species</th>
                                    <th>Weight</th>
                                    <th> <button type="button" class="btn btn-default pull-left" onclick="addRow()">+</button></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        </div>
                    </div>

                </x-forms.post>
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
                                <x-forms.select-from-pluck name="species_id[]" value="" :options="$species" required placeholder="-- choose species --" />
                            </td>
                            <td>
                                <x-forms.textfield type="float" name="species_weight[]" value="" />
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
