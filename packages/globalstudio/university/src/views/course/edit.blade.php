@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Course
@endsection

@section('content')
    <!-- Content Wrapper. Contains course content -->
    <div class="content-wrapper">
        <!-- Content Header (Course header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Course</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.course.index') }}">View Courses</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Course</li>
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
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: smaller;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form" method="post" action="{{ route('admin.course.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course->id }}" />
                            <div class="row">
                                <div class="col-12 col-lg-8 col-md-8">
                                    <div class="card card-default ">
                                        <div class="card-header">
                                            <h3 class="card-title">General </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                            </div>
                                        </div>

                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Name<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $course->name }}" placeholder="Enter name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Slug<span
                                                                class="required">*</span></label>
                                                        <input type="text" class="form-control" name="slug"
                                                            value="{{ $course->slug }}" placeholder="Enter slug" required>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label>Content</label>
                                                        <textarea class="form-control summernote" name="content" placeholder="Enter Content">{{ $course->content }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Total Enrolled</label>
                                                        <input type="text" class="form-control" name="enrolled"
                                                            value="{{ $course->enrolled }}"
                                                            placeholder="Enter total enrolled">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-8">
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Image</label>
                                                        <input type="file" class="form-control" name="image"
                                                            accept="image/*" onchange="loadFile(event)" id="file" />

                                                    </div>
                                                </div>
                                                {{-- @dd($blog) --}}
                                                <div class="col-lg-2 col-md-2 col-4">
                                                    @if ($course->image)
                                                        <img src="{{ asset($course->image) }}" class="previous_image"
                                                            alt="AdminLTELogo" height="80" width="80">
                                                    @endif
                                                    <div class="image_div" style="display:none;">
                                                        <img id="image_preview" height="90" width="100" />
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Status</label><br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status"
                                                            @if ($course->status) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mx-5">
                                                    <label for="exampleInputFile">Featured</label><br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="featured"
                                                            @if ($course->featured) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.card-body -->


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 col-md-4">
                                    <div class="card card-default ">
                                        <div class="card-header">
                                            <h3 class="card-title">SEO </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                            </div>
                                        </div>

                                        <div class="card-body ">

                                            <div class="form-group">
                                                <label for="">SEO Title</label>
                                                <input type="text" class="form-control" name="seo_title"
                                                    value="{{ $course->seo_title }}" placeholder="Enter SEO title">
                                            </div>
                                            <div class="form-group">
                                                <label for="">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword"
                                                    value="{{ $course->seo_keyword }}" placeholder="Enter SEO keyword">
                                            </div>
                                            <div class="form-group">
                                                <label>SEO Description</label>
                                                <textarea class="form-control" name="seo_description" placeholder="Enter SEO description">{{ $course->seo_description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>SEO Tags</label>
                                                <textarea class="form-control" name="seo_tags" placeholder="eg: Tag1,Tag2,Tag3">{{ $course->seo_tags }}</textarea>
                                            </div>
                                        </div>

                                        <!-- /.card-body -->
                                    </div>
                                </div>
                        </form>

                        <!-- /.card -->

                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->

        </section>
    </div><!-- /.container-fluid -->

@endsection
