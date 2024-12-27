@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create User
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">View Users</a></li>
                            <li class="breadcrumb-item active">Create User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div> --}}
                            <!-- /.card-header -->
                            <!-- form start -->

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="font-size: smaller;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class=" form" method="post" action="{{ route('admin.user.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address<span class="required">*</span></label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Enter email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mobile<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="mobile"
                                                    placeholder="Enter mobile" value="{{ old('mobile') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">User Name<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="Enter username" value="{{ old('username') }}" required>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">

                                            <div class="form-group">
                                                <label>Department </label> &nbsp; <a href="#"
                                                    data-target="#depart-modal" data-toggle="modal"><span
                                                        class="badge badge-success">create new <i
                                                            class="fas fa-plus"></i></span></a>
                                                <select class="form-control select select_depart" name="department_id">
                                                    <option value="">Select Department </option>
                                                    @foreach ($departments as $depart)
                                                        <option value="{{ $depart->id }}"> {{ $depart->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Branch</label> &nbsp; <a href="#" data-target="#branch-modal"
                                                    data-toggle="modal" class=""><span
                                                        class="badge badge-success">create new <i
                                                            class="fas fa-plus"></i></span></a>
                                                <select class="form-control select select_branch" name="branch_id">
                                                    <option value="">Select Branch </option>
                                                    <option value="new_branch">Create New Branch </option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password<span class="required">*</span></label>
                                                <input type="password" class="form-control" name="password" required
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Confirm Password <span class="required">*</span></label>
                                                <input type="password" class="form-control" name="confirm-password" required
                                                    placeholder="Confirm password">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">Role</label>
                                                <input type="text" class="form-control" name="role"
                                                    placeholder="Enter role">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-8">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image</label>
                                                <input type="file" class="form-control" name="image"
                                                    accept="image/*" onchange="loadFile(event)" id="file" />

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4">
                                            <div class="image_div" style="display:none;">
                                                <img id="image_preview" height="90" width="100" />
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 col-6">

                                            <div class="form-group">
                                                <label for="exampleInputFile">Status</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-6">

                                            <div class="form-group">
                                                <label for="exampleInputFile">Is-Team</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="is_team" >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>




                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <!-- /.card -->

                        </div>

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <div class="modal fade" id="depart-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Department</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="depart-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control depart-name" required name="name" placeholder="Enter name">
                            </div>

                            <!-- Default checked -->

                            <div class="form-group">
                                <label for="exampleInputFile">Status</label><br>
                                <label class="switch">
                                    <input type="checkbox" name="status" class="depart-status" checked> 
                                    <span class="slider round"></span>
                                </label>
                            </div>
                    </div>

                    <!-- /.card-body -->


                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>

            </div>

        </div>

        <div class="modal fade" id="branch-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Branch</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" id="branch-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control branch-name" name="name" required
                                    placeholder="Enter name">
                            </div>

                            <!-- Default checked -->

                            <div class="form-group">
                                <label for="exampleInputFile">Status</label><br>
                                <label class="switch">
                                    <input type="checkbox" name="status" class="branch-status" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                    </div>

                    <!-- /.card-body -->


                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


        <!-- /.content-wrapper -->
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                getBranches();
            });
            $('body').on('click', '.depart-create', function() {
                // alert($(this).val());
                var data = $(this).val();
                $('#depart-modal').modal('show');

            });
            $('body').on('click', '.branch-create', function() {
                // alert($(this).val());
                var data = $(this).val();
                $('#branch-modal').modal('show');

            });
            $('#branch-form').on('submit', function(e) {
                e.preventDefault();
                var name = $('.branch-name').val();
                // alert(name)
                var status = $('.branch-status').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin') }}" + "/branches/store",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        status: status
                    },
                    success: function() {
                        $('#branch-modal').modal('toggle');
                        getBranches();
                        toastr.success("Created Successfully");


                    },
                    eroror: function(){
                        toastr.error("Couldnot Create");
                    }
                });
            });

            function getBranches() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/admin') }}" + "/branches",
                    success: function(results) {
                        $('.select_branch').html('<option value="">Select Branch</option> ');
                        for (var i = 0; i < results.length; i++) {
                            $('.select_branch').append('<option value="' + results[i].id +
                                '">' + results[i].name + '</option>')
                        }
                        
                    }
                });
            }
            $('#depart-form').on('submit', function(e) {
                e.preventDefault();
                var name = $('.depart-name').val();
                // alert(name)
                var status = $('.depart-status').val();

                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin') }}" + "/departments/store",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        status: status
                    },
                    success: function() {   
                        $('#depart-modal').modal('toggle');
                        getDepartments();
                        toastr.success("Created  Successfully");
                    },
                    eroror: function(){
                        toastr.error("Couldnot Create");
                    }
                });
            });

            function getDepartments() {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/admin') }}" + "/departments",
                    success: function(results) {
                        $('.select_depart').html('<option value="">Select Department</option> ');
                        for (var i = 0; i < results.length; i++) {
                            $('.select_depart').append('<option value="' + results[i].id +
                                '">' + results[i].name + '</option>')
                        }

                    }
                });
            }
        </script>
    @endpush
