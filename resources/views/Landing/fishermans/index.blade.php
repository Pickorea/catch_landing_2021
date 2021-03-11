@extends('layouts.app')

@section('content')

{{--                    <div class="card-body">--}}

{{--                        <section style="padding-top:7px;">--}}

{{--                            <div class="container">--}}

{{--                                <div class="row">--}}
{{--                                    {{ html()->form()->open() }}--}}
{{--                                    <select name="forma"  data-placeholder="Select island" style="width:350px;"   class="chosen-select" tabindex="5" onchange="location =    this.options[this.selectedIndex].value;">--}}
{{--                                        <option value="">Islands - Fisherman</option>--}}
{{--                                        @foreach ($items as $island)--}}
{{--                                            <a href="{{route('island.fisherman.create',$island->id)}}"><optgroup value="{{$island->id}}" label="{{$island->island_name}}"></a>--}}
{{--                                            @foreach($island->fisherman as $fisher)--}}
{{--                                                <option value="{{route('fisherman.trip.create', [$fisher->id,$island->id,])}}">--}}
{{--                                                    <a href="{{route('fisherman.trip.create',  [$fisher->id,$island->id,])}}">{{$fisher->first_name}}  {{$fisher->last_name}}</a>--}}
{{--                                                </option>--}}
{{--                                                <!-- </optgroup> -->--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                        {{ html()->form()->close() }}--}}
{{--                                    </select>--}}
{{--                            --}}{{--<table class="table">--}}
{{--                                <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th scope="col">#</th>--}}
{{--                                        <th scope="col">Fisherman First Name</th>--}}
{{--                                        <th scope="col">Fisherman Last Name</th>--}}
{{--                                        <th scope="col">Action</th>--}}
{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tbody>--}}
{{--                                    @foreach ($items as $island)--}}
{{--                                    <tr>                       --}}
{{--                                        <th scope="row">{{$island->id}}</th>--}}
{{--                                        @foreach($island->fisherman as $fisher)--}}
{{--                                        <td> {{$fisher->first_name}}</td> --}}
{{--                                        <td> {{$fisher->last_name}}</td> --}}
{{--                                            --}}
{{--                                        @endforeach--}}
{{--                                        <td> --}}
{{--                                        {{ html()->form('DELETE', route('fisherman.destroy', $island->id))->open() }}--}}
{{--                                            <a class="btn btn-info" href="{{ route('fisherman.show',$island->id) }}">Show</a>                                          --}}
{{--                                            <a class="btn btn-primary" href="{{ route('fisherman.edit',$island->id) }}">Edit</a>                                                                                        --}}
{{--                                            <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                        {{ html()->form()->close() }}  --}}
{{--                                        </td>  --}}
{{--                                                            --}}
{{--                                    </tr>--}}
{{--                                    --}}
{{--                                    @endforeach--}}
{{--                                </tbody>--}}
{{--                         </table>--}}
{{--                            <nav aria-label="Page navigation example">--}}
{{--                                <ul class="pagination">--}}
{{--                                {!! $items->links() !!}                           --}}
{{--                                </ul>--}}
{{--                            </nav>--}}
{{--                            </div>--}}
{{--                    --}}
{{--                    </div>--}}

{{--                        </section>--}}


{{--                    </div>--}}




    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>
                                    @isset($island)
                                        {{ $island->island_name }}
                                    @endisset
                                        {{ __('Fishermen') }}
                                </h3>
                            </div>
                            <div class="col-auto">
                                <form method="POST" id="search-form" class="form-inline" role="form">
                                    <div class="form-group float-right">
                                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                                    </div>
                                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                                </form>
                            </div>
                            <div class="col">
                                <div class="float-right">
                                    @isset($island)
                                        <a href="{{ route('fisherman.create',['island' => $island->id]) }}" class="btn btn-primary ">@lang("Create")</a>
                                    @else
                                        <a href="{{ route('fisherman.create') }}" class="btn btn-primary ">@lang("Create")</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2>Datatables</h2>

                        <table class="table table-hover mx-0 display" id="data-table" data-page-length="100"
                               data-order='[[ 0, "desc" ]]' data-href="{{ route("fisherman.datatables", ['island'=> isset($island) ? $island->id : 0]) }}">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Island</th>
                                <th width="80px">
                                    @isset($island)
                                        <a href="{{ route('fisherman.create2',['island' => $island->id]) }}"><i class="fas fa-plus"></i>+</a>
                                    @else
                                        <a href="{{ route('fisherman.create2') }}"><i class="fas fa-plus"></i>+</a>
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="{{ url('/') }}/js/jquery.dataTables.js"></script>
    <script src="{{ url('/') }}/js/dataTables.bootstrap4.js"></script>
    <script>
        let datatable = (function () {
            {{--let permissionEdit = ('{{ $logged_in_user->can('') }}' == '1');--}}
            let permissionEdit = true;

            var table;
            var init = function (item) {
                var htmlTable = $(item);
                console.log(item, htmlTable);
                table = htmlTable.DataTable({
                    searching: false,
                    bLengthChange: false,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: htmlTable.data('href'),
                        type: 'post',
                        data: function (d) {
                            d._token = '{!! csrf_token() !!}';
                            d.search = $('input[name=search]').val();
                            d.trashed = false;
                        }
                    },
                    columns: [
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'island', name: 'island'},
                        {data: 'id',  name: 'id', searchable: false, sortable: false }
                    ],
                    columnDefs: [
                        {
                            "render": function ( data, type, row ) {
                                let value = '<a href="{{ route('fisherman.index') }}/'+row['id']+'"><i class="fas fa-eye"></i>View</a>';
                                value +=  '<a href="{{ route('fisherman.index') }}/'+row['id']+'/trip"><i class="fas fa-eye"></i> create Trip</a>';
                                if (permissionEdit) {
                                    value += ' <a href="{{ route('fisherman.index') }}/'+row['id']+'/edit"><i class="fas fa-edit"></i>Edit</a>' ;
                                }
                                return value;

                            },
                            "targets": 3
                        },
                    ]
                });
            };

            var isColumnVisible = function(columnname) {
                var column = table.column( columnname );
                return (column) ? column.visible() : false ;
            }

            var toggleColumn  = function(columnname) {
                var column = table.column( columnname );
                var visible = (! column.visible()) ;
                column.visible( visible );
            }

            var draw = function() { table.draw() ;}
            var row = function(rowSelector) { return table.row(rowSelector) ;}

            // return public speciess
            return {
                init: init,
                draw: draw,
                row: row,
                isColumnVisible: isColumnVisible,
                toggleColumn: toggleColumn
            };

        })();


        $(function() {
            console.log('Starting Page Ready');
            datatable.init('#data-table');
            $('#searchBtn').on('click', function(e) {
                datatable.draw();
            });
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                datatable.draw();
            });
            console.log('Page Ready Complete');
        });

    </script>
@endpush


