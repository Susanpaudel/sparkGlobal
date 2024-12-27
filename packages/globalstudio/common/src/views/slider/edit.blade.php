@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Slider
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Slider</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">View Sliders</a></li>
                            <li class="breadcrumb-item active">Edit Slider</li>
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
                        <div class="card card-secondary">
                            <div class="card-header">
                                {{-- <h3 class="card-title">Quick Example</h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">

                                <form class="row form" method="post" action="{{ route('admin.slider.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $slider->id }}" name="id">
                                    <div class="card-body">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="title" required
                                                            value="{{ old('title',$slider->title) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Sub Title<span class="required">*</span></label>
                                                        <input type="text" class="form-control" name="sub_title" required
                                                            value="{{ old('sub_title',$slider->sub_title) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Body<span class="required">*</span></label>
                                                        <textarea class="summernote" name="body" required>
                                                    {{ old('body',$slider->body) }}
                                               </textarea>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-md-6 col-8 ">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Image<span class="required">*</span></label>
                                                        <input type="file" class="form-control" name="image"
                                                            accept="image/*" onchange="loadFile(event)" id="file"  />

                                                    </div>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-4 ">
                                                    @if ($slider->image)
                                                        <img src="{{ asset('storage/slider/'.$slider->image) }}" class="previous_image"
                                                            alt="AdminLTELogo" height="80" width="80">
                                                    @endif
                                                    <div class="image_div"
                                                     style="display:none;" >
                                                        <img id="image_preview" height="90" width="100" />
                                                    </div>

                                                </div>
                                                <div class=" col-lg-2 col-md-2 col-6">
                                                    <div class="form-group">
                                                        <label for="">Priority</label>
                                                        <input type="number" class="form-control" name="priority"
                                                            name="{{ $slider->priority }}" value="{{$slider->priority}}">
                                                    </div>

                                                </div>
                                                <div class=" col-lg-1 col-md-2 col-6 d-flex justify-content-center">

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status"
                                                                @if ($slider->status) checked @endif>
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
                                                            placeholder="Enter Button One Title" value="{{old('button_one_title',$slider->button_one_title)}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button One Url</label>
                                                        <input type="url" class="form-control" name="button_one_url"
                                                            placeholder="Enter Button One link" value="{{old('button_one_url',$slider->button_one_url)}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button Two Title</label>
                                                        <input type="text" class="form-control" name="button_two_title"
                                                            placeholder="Enter Button Two Title" value="{{old('button_two_title',$slider->button_two_title)}}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="">Button Two Url</label>
                                                        <input type="url" class="form-control" name="button_two_url"
                                                            placeholder="Enter Button Two link" value="{{old('button_two_url',$slider->button_two_url)}}">
                                                    </div>
                                                </div>
                                                

                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                            </div>



                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                            <!-- /.card -->



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
