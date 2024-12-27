@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit User
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
                            <li class="breadcrumb-item active">Edit User</li>
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
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="font-size: smaller;">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="row form" method="post" action="{{ route('admin.user.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="name" required
                                                        value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address<span class="required">*</span></label>
                                                    <input type="email" class="form-control" name="email" required
                                                        value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mobile<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="mobile"  required
                                                        value="{{ $user->mobile }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">User Name<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="username" required
                                                        value="{{ $user->username }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control select" name="department_id">
                                                        @foreach ($departments as $depart)
                                                            <option value="{{ $depart->id }}"
                                                                @if ($user->department_id == $depart->id) selected @endif>
                                                                {{ $depart->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Branch</label>
                                                    <select class="form-control select" name="branch_id">
                                                        @foreach ($branches as $branch)
                                                            <option value="{{ $branch->id }}"
                                                                @if ($user->branch_id == $branch->id) selected @endif>
                                                                {{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm-password"
                                                    placeholder="Password">
                                            </div>
                                        </div> --}}
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="">Role</label>
                                                    <input type="text" class="form-control" name="role"
                                                        value="{{ $user->role }}">
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
                                                @if ($user->image)
                                                    <img src="{{ asset($user->image) }}" class="previous_image"
                                                        alt="AdminLTELogo" height="80" width="80">
                                                @endif
                                                <div class="image_div" style="display:none;">
                                                    <img id="image_preview" height="90" width="100" />
                                                </div>

                                            </div>


                                            <div class="col-lg-6 col-md-6 col-12">

                                                <div class="form-group">
                                                    <label for="exampleInputFile">Status</label><br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status"
                                                            @if ($user->status) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
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
    </div>
    <!-- /.content-wrapper -->
@endsection
