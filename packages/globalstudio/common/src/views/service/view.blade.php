@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Service
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1604.44px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Invoice #{{ $order->id }}</h1> --}}
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">Teams</a></li>
                            <li class="breadcrumb-item active">view</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        {{-- <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to
                            test.
                        </div> --}}

                        <div class="invoice p-3 mb-3">




                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th> </th>
                                                    <td> <img class="profile-user-img img-fluid img-circle"
                                                            src="{{ asset($service->image) }}" alt="User profile picture">
                                                    </td>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Title:</th>
                                                    <td>
                                                        <h5>{{ $service->title }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Priority:</th>
                                                    <td>
                                                        <h5>{{ $service->priority }}<h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Slug:</th>
                                                    <td>
                                                        <h5>{{ $service->slug }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Price Description:</th>
                                                    <td>
                                                        <h5>{{ $service->price_description }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Time Description:</th>
                                                    <td>
                                                        <h5>{{ $service->time_description }}<h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Price:</th>
                                                    <td>
                                                        <h5>{{ $service->price }}<h5>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th style="font-size:18px;" class="text-center">Content:</th>
                                                    <td>
                                                        <h5>{!! $service->content !!}</h5>
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                            </div>

                            {{-- 
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="invoice p-3 mb-3">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                {{ $service->serviceCategory->title }}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <table class="table table-bordered table-hover dataTable dtr-inline"
                                            id="team-table">
                                            <thead>



                                                <tr>

                                                    <th>Title</th>
                                                    <th>Priority</th>
                                                    <th>Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach ($relatedServices as $service)
                                                    <tr>
                                                        <td>{{ $service->title }}</td>
                                                        <td>{{ $service->priority }}</td>
                                                        <td>

                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#editModal"
                                                                data-id="{{ $service->id }}"
                                                                data-title="{{ $service->title }}"
                                                                data-priority="{{ $service->priority }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>


                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <input type="number" name="priority" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
@endsection
@push('js')
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract service id from data attributes
            var title = button.data('title');
            var priority = button.data('priority');

            var modal = $(this);
            var form = modal.find('form');

            // Update the form action URL dynamically with the service id
            form.attr('action', "{{ url('admin/service-priority/update') }}/" + id);

            // Set form fields with values
            modal.find('input[name="id"]').val(id);
            modal.find('input[name="title"]').val(title);
            modal.find('input[name="priority"]').val(priority);
        });
    </script>
@endpush
