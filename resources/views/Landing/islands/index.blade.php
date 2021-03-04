@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">

            <div class="col">
                <h3>@lang('Islands')</h3>
            </div>
            <div class="col-auto">
                <form method="POST" id="search-form" class="form-inline" role="form">
                    <div class="form-group float-right">
                        <input type="text" class="form-control" name="search" id="search" value="{{ old('search') }}" placeholder="{{ __('Search') }}">
                    </div>
                    <button type="button" class="btn btn-primary" id="searchBtn">@lang('Search')</button>
                    {{--<a href="{{ route() }}" class="btn btn-outline-info" id="exportBtn">@lang('Export')</a>--}}

                </form>
            </div>
        </div>
      

      
            <h2>Datatables</h2>

            <table class="table table-hover mx-0 display" id="data-table" data-page-length="100"
                   data-order='[[ 0, "desc" ]]' data-href="{{ route("datatables") }}">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Created at</th>
                    <th width="80px">
                    
                            <a href="{{ route('island.create') }}"><i class="fas fa-plus"></i></a>
                      
                    </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
            
@endsection

@push('after-scripts')
    <script src="{{ url('/') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let datatable = (function () {
           {{--let permissionEdit = ('{{ $logged_in_user->can() }}' == '1');--}}

            var table;

            var init = function (item) {
                var htmlTable = $(item);
                table = htmlTable.DataTable({
                    searching: false,
                    bLengthChange: false,
                    order: [[1, "asc"]],
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
                        {data: 'island_name', name: 'island_name'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'id',  name: 'id', searchable: false, sortable: false }
                    ],
                    columnDefs: [
                        {
                            "render": function ( data, type, row ) {
                                value = data;
                                return value;

                            },
                            "targets": 1
                        },
                        {
                            "render": function ( data, type, row ) {
                                value = '<a href="{{ route('island.index') }}/'+row['id']+'"><i class="fas fa-eye"></i></a>';
                                 if (permissionEdit) {
                                    value += ' <a href="{{ route('island.index') }}/'+row['id']+'/edit"><i class="fas fa-edit"></i></a>' ;
                                }
                                 return value;

                            },
                            "targets": 2
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

            // return public methods
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
