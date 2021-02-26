@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Show Trip') }} for {{ $fisherman->first_name }} {{ $fisherman->last_name }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <label class="col-md-2">Trip Hours</label>
                            <p class="col-md-10">{{ $trip->trip_hrs }}</p>
                        </div>

                        <div class="row">
                            <label class="col-md-2">Number of Fisherman Per Trip</label>
                            <p class="col-md-10">{{ $trip->number_of_fishers }}</p>
                        </div>

                        <div class="row">
                            <label class="col-md-2">trip date</label>
                            <p class="col-md-10">{{ optional($trip->trip_date)->format('d M Y') }}</p>
                        </div>

                        <div class="row">
                            <label class="col-md-2">Location</label>
                            <p class="col-md-10">{{ optional($trip->location)->location_name }}</p>
                        </div>

                        <div class="row">
                            <label class="col-md-2">Fishing method</label>
                            <p class="col-md-10">{{ optional($trip->method)->method_name }}</p>
                        </div>

                        <table class="table" id="species_table">
                            <thead>
                            <tr>
                                <th>Species</th>
                                <th>Weight</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($trip->species as $tripspecies)
                                <tr>
                                    <td>{{$tripspecies->species_name}}</td>
                                    <td>{{$tripspecies->pivot->weight}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
