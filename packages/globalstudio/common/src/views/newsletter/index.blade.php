@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Newsletters
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Contacts</li>
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
                                    {{-- <div class="modal-footer">
                          <form action="{{ route('admin.newsletter.delete') }}" method="post">
                              @csrf
                              <input type="hidden" id="id" name="id">
                              <button type="button" class="btn btn-warning" data-dismiss="modal">NO</button>
                              <button type="submit" class="btn btn-primary">YES</button>
                          </form>
                      </div> --}}
                                </div>

                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-6">
                                    <input type="text" class="form-control" id="newsletter-search" placeholder="Search Newsletter"
                                        style="width: 100%;">
                                </div>

                                <div class="col-lg-2 col-6">
                                    {{-- <div span="button">
                          <a href="{{ route('admin.newsletter.create') }}">
                              <button type="button" class="btn btn-success " style="width: 100%;">
                                  <i class="fa fa-plus"></i> &nbsp; Create</button>
                          </a>
                      </div> --}}
                                </div>
                            </div> <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dataTable dtr-inline" id="newsletter-table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            
                                            <th>Email</th>
                                        
                                            <th>Subscribe At</th>
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
                var datatable = $('#newsletter-table').DataTable({
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

                        url: "{{ route('admin.newsletter.search') }}",
                        data: function(d) {
                            d.keyword = $('#newsletter-search').val();
                        }
                    },
                    columns: [{

                            data: 'id',
                            render: function(data, type, row, meta) {
                                return '<div class="row-id">' + row.id + '</div>' + row.sn;
                            }
                        },
                        
                        {
                            data: 'email'
                        },
                        
                        {
                            data: 'created_at'
                        },


                    ],
                    bLengthChange: false // hide the records per page dropdown

                }).on('xhr.dt', function(e, settings, json, xhr) {

                });

                $('body').on('keyup', '#newsletter-search', function() {
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
