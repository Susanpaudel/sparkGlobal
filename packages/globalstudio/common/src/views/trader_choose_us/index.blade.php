@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Trader Choose Us
@endsection

@push('css')
    <style>
        .row-id {
            display: none;
        }

        .td-flex {
            display: inline-flex;
        }
    </style>
@endpush

@section('content')
    <!-- Content Wrapper. Contains blog content -->
    <div class="content-wrapper">
        <!-- Content Header (Blog header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trader Choose Us</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Trader Choose Us</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">ARE YOU SURE?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you really want to delete this item?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.trader_choose_us.delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" id="id" name="id">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">NO</button>
                                            <button type="submit" class="btn btn-primary">YES</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-6">
                                    <input type="text" class="form-control" id="why-choose-us-search" placeholder="Search Trader Choose Us"
                                        style="width: 100%;">
                                </div>

                                <div class="col-lg-2 col-6">
                                    <div span="button">
                                        <a href="{{ route('admin.trader_choose_us.create') }}">
                                            <button type="button" class="btn btn-success " style="width: 100%;">
                                                <i class="fa fa-plus"></i> &nbsp; Create</button>
                                        </a>
                                    </div>
                                </div>
                            </div> <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="why-choose-us-table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!--end table -->
                        </div><!-- end card body -->

                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('js')
        <script>
            $(document).ready(function() {
                var datatable = $('#why-choose-us-table').DataTable({
                    searching: false,
                    stripeClasses: ['odd-row', 'even-row'],
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    deferLoading: 10,
                    processing: true,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    },
                    dom: 'Bfrtip',
                    buttons: ['copyHtml5', 'csvHtml5', 'excelHtml5', 'print', 'pdfHtml5'],
                    ajax: {

                        url: "{{ route('admin.trader_choose_us.search') }}",
                        data: function(d) {
                            d.keyword = $('#why-choose-us-search').val();
                        }
                    },
                    columns: [{

                            data: 'id',
                            render: function(data, type, row, meta) {
                                return '<div class="row-id">' + row.id + '</div>' + row.sn;
                            }
                        },
                        {
                            data: 'title'
                        },
                       

                        {
                            data: 'status',

                            render: function(data, type, row) {
                                if (row.status === 1) {
                                    return '<span class="badge badge-success"  text-capitalize mr-1">&nbsp;Active</span>';
                                } else {
                                    return '<span class="badge badge-warning"  text-capitalize mr-1">&nbsp;In-Active</span>';
                                }
                            }
                        },
                        {
                            data: 'action',
                            render: function(data, type, row) {
                                var del = "{{ url('admin/trader_choose_us/delete') }}" + '/' + row.id;

                                var edit = "{{ url('admin/trader_choose_us/edit') }}" + '/' + row.id;
                                return '<div class="td-flex"><a href="' + edit +
                                    '"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>&nbsp&nbsp <button type="button" id="delete" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash"></i></button></div';
                            }
                        },
                    ],
                    bLengthChange: false // hide the records per blog dropdown

                }).on('xhr.dt', function(e, settings, json, xhr) {

                });

                $('body').on('keyup', '#why-choose-us-search', function() {
                    setTimeout(function() {
                        datatable.ajax.reload();
                    }, 1);
                });

                $('body').on('click', '#delete', function() {
                    var id = $(this).parents('tr').find('.row-id').text();
                    $('#id').val(id);
                })
                datatable.ajax.reload();
            });
        </script>
    @endpush
@endsection
