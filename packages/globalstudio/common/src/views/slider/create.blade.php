@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Slider
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">View Sliders</a></li>
                            <li class="breadcrumb-item active">Create Slider</li>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: smaller;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- general form elements -->
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>   
                            </div> --}}
                            <!-- /.card-header -->
                            <!-- form start -->
                          
                            
                                <form class="form" method="post" action="{{ route('admin.slider.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="title" required
                                                        placeholder="Enter Title" value="{{old('title')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sub Title<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="sub_title" required
                                                        placeholder="Enter Sub Title" value="{{old('sub_title')}}">
                                                </div>
                                         

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Body<span class="required">*</span></label>
                                                <textarea class="summernote" name="body" required>
                                                    {{old('body')}}
                                                 </textarea>

                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Image<span class="required">*</span></label>
                                                        <input type="file" class="form-control" name="image" accept="image/*"
                                                            onchange="loadFile(event)" id="file"  required/>
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-4 col-lg-3 col-md-3">
                                                    <div class="image_div" style="display:none;">
                                                        <img id="image_preview" height="90" width="100"/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-6 ">
                                                    <div class="form-group">
                                                        <label for="">Priority</label>
                                                        <input type="number" class="form-control" name="priority"
                                                            placeholder="" value="{{old('priority')}}">
                                                    </div>

                                                </div>
                                                <div class="col-6 col-lg-2 col-md-2 d-flex justify-content-center">

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button One Title</label>
                                                        <input type="text" class="form-control" name="button_one_title"
                                                            placeholder="Enter Button One Title" value="{{old('button_one_title')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button One Url</label>
                                                        <input type="url" class="form-control" name="button_one_url"
                                                            placeholder="Enter Button One link" value="{{old('button_one_url')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button Two Title</label>
                                                        <input type="text" class="form-control" name="button_two_title"
                                                            placeholder="Enter Button Two Title" value="{{old('button_two_title')}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button Two Url</label>
                                                        <input type="url" class="form-control" name="button_two_url"
                                                            placeholder="Enter Button Two link" value="{{old('button_two_url')}}">
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
