@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3>@lang('Trips')</h3>
                            </div>
                            <div class="col-auto">
                                <form method="POST" id="search-form" class="form-inline" role="form">
                                    <div class="form-group float-right">
                                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                                    </div>
                                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2>Datatables</h2>

                        <table class="table table-hover mx-0 display" id="data-table" data-page-length="100"
                               data-order='[[ 0, "desc" ]]' data-href="{{ route("trip.datatables") }}">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Trip hrs</th>
                                <th>Nbr of Fishers</th>
                                <th>Trip dates</th>
                                <th>Locations</th>
                                <th>Methods</th>
                                <th>Created at</th>
                                <th width="80px">
                                    <a href="{{ route('trip.create') }}"><i class="fas fa-plus"></i>+</a>
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
                        {data: 'fisherman_id', name: 'fisherman_id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'trip_hrs', name: 'trip_hrs'},
                        {data: 'number_of_fishers', name: 'number_of_fishers'},
                        {data: 'trip_date', name: 'trip_date'},
                        {data: 'location_name', name: 'location_name'},
                        {data: 'method_name', name: 'method_name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',  name: 'id', searchable: false, sortable: false }
                    ],
                    columnDefs: [
                        {
                            "render": function ( data, type, row ) {
                                let value = '<a href="{{ route('trip.index') }}/'+row['id']+'"><i class="fas fa-eye"></i>View</a>';
                                 if (permissionEdit) {
                                    value += ' <a href="{{ route('trip.index') }}/'+row['id']+'/edit"><i class="fas fa-edit"></i>Edit</a>' ;
                                }
                                 return value;

                            },
                            "targets": 7
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

            // return public trips
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
