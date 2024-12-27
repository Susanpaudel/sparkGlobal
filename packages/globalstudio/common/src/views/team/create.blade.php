@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Team
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Team</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">View Teams</a></li>
                            <li class="breadcrumb-item active">Create Team</li>
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
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: smaller;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <!-- general form elements -->
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>   
                            </div> --}}
                            <!-- /.card-header -->
                            <!-- form start -->


                            <form class="form" method="post" action="{{ route('admin.team.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{old('name')}}" required
                                                placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Slug<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="slug" value="{{old('slug')}}" placeholder="Enter slug" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employee Type<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="employee_type" value="{{old('employee_type')}}" placeholder="Employee Type"
                                                required>
                                        </div>
                                    </div>
                                   {{-- <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="title" required
                                                placeholder="Enter Title">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">About<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="about" required
                                                placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Qualifications<span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control" name="qualification" required
                                                placeholder="Enter Title">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Achivements<span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control" name="achivement" required
                                                placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Passion<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="passion" required
                                                placeholder="Enter Title">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mobile</label>
                                            <input type="text" class="form-control" name="mobile"
                                                placeholder="Enter Mobile">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Facebook</label>
                                            <input type="url" class="form-control" value="{{old('facebook')}}" name="facebook"
                                                placeholder="Enter Facebook link">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Twitter</label>
                                            <input type="url" class="form-control" value="{{old('twitter')}}" name="twitter"
                                                placeholder="Enter Twitter link">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Linkedin</label>
                                            <input type="url" class="form-control" value="{{old('linkedin')}}" name="linkedin"
                                                placeholder="Enter Linkedin link  ">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Google</label>
                                            <input type="url" class="form-control" value="{{old('google')}}" name="google"
                                                placeholder="Enter Google link">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-8">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Image</label>
                                            <input type="file" class="form-control" name="image" accept="image/*"
                                                onchange="loadFile(event)" id="file" required/>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-4">
                                        <div class="image_div" style="display:none;">
                                            <img id="image_preview" height="90" width="100" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Status</label><br>
                                            <label class="switch">
                                                <input type="checkbox" name="status" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="exampleInputFile">Display At</label><br>
                                        <div class="form-floating mb-2">
                                            <div class="btn-group">
                                              <input type="radio" class="btn-check me-3" name="is_top" value="0" id="option1" autocomplete="off"/>
                                              <label class="btn btn-outline-primary" for="option1">Top</label>
                                              <input type="radio" class="btn-check mx-3" name="is_top" value="1" id="option2" checked autocomplete="off"/>
                                              <label class="btn btn-outline-primary" for="option2">Bottom</label>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea type="text" class="form-control" rows="5" name="description"
                                                placeholder="Enter Description">{{old('description')}}</textarea>
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
