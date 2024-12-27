@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Page
@endsection
@push('css')
    <style type="text/css">
        .box {
            border: 2px solid #ccc;
            padding: 12px;
            margin-bottom: 20px;
            margin-top: 50px;
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
                        <h1>Edit Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">View Pages</a></li>
                            <li class="breadcrumb-item active">Edit Page</li>
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
                        <form class="form" method="post" action="{{ route('admin.page.update') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
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
                                        <div class="card-body">

                                            <input type="hidden" name="id" value="{{ $page->id }}">

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ $page->title }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Slug <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug" required
                                                    value="{{ $page->slug }}">
                                            </div>

                                            <div class="form-group">
                                                @foreach ($page->contents as $page_content)
                                                <input type="hidden" name="content_id[]" value="{{ $page_content->id}}">
                                                    <div class="box">
                                                        <div class="form-group">
                                                            <label for="">Section Title<span
                                                                class="required">*</span></label>
                                                            <input type="text" class="form-control" name="section_title[]"
                                                                placeholder="Enter title" value="{{ $page_content->title }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Sub Title</label>
                                                            <input type="text" class="form-control" name="section_subtitle[]"
                                                                placeholder="Enter subtitle" value="{{ $page_content->subtitle }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Content</label>

                                                            <textarea class="summernote" name="content[]">
                                                                        {{ $page_content->content }}
                                                                         </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Text</label>
                                                            <input type="text" class="form-control" name="text[]"
                                                                placeholder="Enter text" value="{{ $page_content->text}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Link</label>
                                                            <input type="text" class="form-control" name="link[]"
                                                                placeholder="Enter link" value="{{ $page_content->link }}">
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-8 col-lg-8 col-md-8">
                                                                <div class="form-group">
                                                                    <label for="exampleInputPassword1">Image</label>
                                                                    <input type="file" class="form-control"
                                                                        id="{{$page_content->id}}" name="image[]" accept="image/*"
                                                                        onchange="loadFile(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-4">
                                                                @if ($page_content->image)
                                                                    <img src="{{asset('storage/pages/'.$page_content->image)}}"
                                                                        class="previous_image_{{$page_content->id}} display_image"
                                                                        alt="AdminLTELogo" height="80" width="100">
                                                                @endif
                                                                <div class="image_div_{{$page_content->id}}" style="display:none;">
                                                                    <img id="image_preview_{{$page_content->id}}" class="display_image"
                                                                        height="80" width="100" />
                                                                </div>
            
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                @endforeach
                                            </div>


                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">Page Above</label>
                                                <textarea class="summernote" name="page_above">
                     {{ $page->page_above }}
                      </textarea>
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Page Below</label>
                                                <textarea class="summernote" name="page_below">
                     {{ $page->page_below }}
                      </textarea>
                                            </div> --}}


                                            <div class="row">
                                                <div class="col-6 col-lg-3 col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status"
                                                                @if ($page->status) checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-lg-3 col-md-3">

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Show On Menu</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="menu"
                                                                @if ($page->menu) checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

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
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="">SEO Title</label>
                                                <input type="text" class="form-control" name="seo_title"
                                                    value="{{ $page->seo_title }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword"
                                                    value="{{ $page->seo_keyword }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">SEO Description</label>
                                                <textarea name="seo_description" class="form-control">{{ $page->seo_description }} </textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="">SEO Tags</label>
                                                <input type="text" class="form-control" name="seo_tags"
                                                    value="{{ $page->seo_tags }}">
                                            </div>

                                        </div>


                                    </div>

                                    <!-- /.card-body -->


                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
@push('js')
    <script>
        // Image Preview 
        var loadFile = function(event) {
            var reader = new FileReader();
            var inputId = event.target.id; // Get the ID of the current input field
            reader.onload = function() {
                var output = document.getElementById('image_preview_' +
                    inputId); // Use the ID to update the correct preview element
                $('.image_div_' + inputId).css('display', 'block'); // Use the ID to show the correct image div
                output.src = reader.result;
                $('.previous_image_' + inputId).css('display',
                    'none'); // Use the ID to hide the correct previous image
            };
            $('.previous_image_' + inputId).css('display', 'block'); // Use the ID to show the correct previous image
            $('.image_div_' + inputId).css('display', 'none'); // Use the ID to hide the correct image div
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        $(document).ready(function(){
            $('#summernote').summernote({
                callbacks: {
                    onInit: function() {
                        // remove required attribute from hidden textarea
                        $('#summernote').parent().find('textarea').removeAttr('required');
                    }
                }
            });
        });
        </script>
@endpush
