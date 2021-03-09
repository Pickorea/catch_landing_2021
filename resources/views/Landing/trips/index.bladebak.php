@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Index of Fishing Trips') }}

                </div>


                <div class="card-body">

                <section style="padding-top:7px;">

                    <div class="container">

                            <div class="row">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Trip Hrs</th>
                                        <th scope="col">Nbr. of fishers</th>
                                        <th scope="col">Trip Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">Created at</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                @foreach($item->trips as $trip)
                                    <tr>

                                        <th scope="row">{{$trip->id}}</th>
                                        <td> {{$item->first_name}}</td>
                                        <td> {{$item->last_name}}</td>
                                        <td> {{$trip->trip_hrs}}</td>
                                        <td> {{$trip->number_of_fishers}}</td>
                                        <td> {{ optional($trip->trip_date)->format('d M Y') }}</td>
                                        <td> {{optional($trip->location)->location_name}}</td>
                                        <td>{{ optional($trip->method)->method_name }}</td>
                                        <td> {{$trip->created_at->diffForHumans()}}</td>
                                        <td>
                                        {{ html()->form('DELETE', route('trip.destroy', $trip->id))->open() }}
                                            <a class="btn btn-info" href="{{ route('trip.show',$trip->id) }}">Show</a>
                                            <a class="btn btn-primary" href="{{route('fisherman.trip.edit',[$item->id,$trip->id])}}">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{ html()->form()->close() }}
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                         </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">

                                {!! $items->appends(Request::all())->links() !!}
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
