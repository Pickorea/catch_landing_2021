@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Report') }}
                <div class="btn pull-right"> <a href="{{ route('cpue.island') }}"> <button  class="btn btn-primary ">Export</button></a> </div>
                </div>


                <div class="card-body">

                <section style="padding-top:7px;">

                    <div class="container">

                            <div class="row">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Island</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">CPUE</th>

                                    </tr>
                                </thead>
                                <tbody>
                                      @foreach($reports as $report)
{{--                                          <tr>--}}
{{--                                              <td colspan="5">{{ json_encode($report) }}</td>
{{--                                          </tr>--}}
                                    <tr>
                                        <td>{{$report->island_name}}</td>
                                        <td> {{$report->Year}}</td>
                                        <td> {{$report->cpue}}</td>


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
