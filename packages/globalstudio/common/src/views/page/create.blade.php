@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Page
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
        <!-- Content Header (Blog header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.page.index') }}">View Pages</a></li>
                            <li class="breadcrumb-item active">Create Page</li>
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
                        <form class="form" method="post" action="{{ route('admin.page.store') }}"
                            enctype="multipart/form-data">
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

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title') }}" placeholder="Enter title">
                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Slug<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug" required
                                                    value="{{ old('slug') }}" placeholder="Enter slug">
                                            </div>


                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">Content<span class="required">*</span></label> <a   class=" add-new-option"
                                                style="float: right;">Add
                                                New
                                                Option</a>
                                                
                                                <textarea class="summernote" name="content" required>
                                            {{ old('content') }}
              </textarea>

                                            </div> --}}
                                            <div class="form-group">
                                                <button type="button" class="add-new-option  btn-sm btn  btn-primary"
                                                    style="float: right;">Add New Page Section</button>
                                            </div>
                                            <input type="hidden" name="counter" value="1">
                                            <div class="content-group">
                                                <div class="box">
                                                    <div class="form-group">
                                                        <label for="">Section Title</label>
                                                        <input type="text" class="form-control" name="section_title[]"
                                                            placeholder="Enter title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Sub Title</label>
                                                        <input type="text" class="form-control" name="section_subtitle[]"
                                                            placeholder="Enter sub title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Content<span
                                                                class="required">*</span></label>

                                                        <textarea class="summernote" name="content[]" required>
                                                </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Text</label>
                                                        <input type="text" class="form-control" name="text[]"
                                                            placeholder="Enter text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Link</label>
                                                        <input type="text" class="form-control" name="link[]"
                                                            placeholder="Enter link">
                                                    </div>
                                                    <div class="row ">
                                                        <div class="col-8 col-lg-8 col-md-8">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Image</label>
                                                                <input type="file" class="form-control" id="1"
                                                                    name="image[]" accept="image/*"
                                                                    onchange="loadFile(event)">
                                                            </div>
                                                        </div>
                                                        <div class="col-4 col-lg-4 col-md-4">
                                                            <div class="image_div">
                                                                <img id="preview_1" class="display_image" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Blog Above</label>
                                                <textarea class="summernote" name="page_above">
                                                    {{ old('page_above') }}
                      </textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Blog Below</label>
                                                <textarea class="summernote" name="page_below">
                                                    {{ old('page_below') }}
                      </textarea>
                                            </div> --}}
                                            <div class="row">
                                                <div class="col-6 col-lg-3 col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Status</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status" checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-lg-3 col-md-3">

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">Show On Menu</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="menu">
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
                                                    value="{{ old('seo_title') }}" placeholder="">
                                            </div>


                                            <div class="form-group">
                                                <label for="">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword"
                                                    value="{{ old('seo_keyword') }}" placeholder="">
                                            </div>

                                            <div class="form-group">
                                                <label for="">SEO Description</label>
                                                <textarea name="seo_description" class="form-control"> {{ old('seo_description') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="">SEO Tags</label>
                                                <input type="text" class="form-control" name="seo_tags"
                                                    value="{{ old('seo_tags') }}" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
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


@push('js')
    <script>
        $(document).ready(function() {
            $('.add-new-option').click(function() {
                var old_value = parseInt($('input[name="counter"]').val());
                var new_value = ++old_value;

                $('input[name="counter"]').val(new_value);
                console.log(new_value);
                console.log($('input[name="counter"]').val())
                var newOption =
'<div class="box"> <div class="form-group"> <label for="">Title</label> <input type="text" class="form-control" name="section_title[]" placeholder="Enter title"> </div> <div class="form-group"> <label for="">Sub Title</label> <input type="text" class="form-control" name="section_subtitle[]" placeholder="Enter sub title"> </div> <div class="form-group"> <label for="exampleInputEmail1">Content<span class="required">*</span></label> <textarea class="summernote" name="content[]" required> </textarea> </div> <div class="form-group"> <label for="">Text</label> <input type="text" class="form-control" name="text[]" placeholder="Enter text"> </div> <div class="form-group"> <label for="">Link</label> <input type="text" class="form-control" name="link[]" placeholder="Enter link"> </div> <div class="row "> <div class="col-8 col-lg-8 col-md-8"> <div class="form-group"> <label for="exampleInputPassword1">Image</label> <input type="file" class="form-control" id="1" name="image[]" accept="image/*" onchange="loadFile(event)"> </div> </div> <div class="col-4 col-lg-4 col-md-4"> <div class="image_div"> <img id="preview_1" class="display_image" /> </div> </div> </div> </div>';
                $('.content-group').append(newOption);
                $('.summernote').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                        ['height', ['height']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            });
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
    <script>
        // Image Preview 
        var loadFile = function(event) {
            var reader = new FileReader();
            var inputId = event.target.id; // Get the ID of the current input field
            reader.onload = function() {
                var output = document.getElementById('preview_' +
                    inputId); // Use the ID to update the correct preview element
                output.src = reader.result;
                $(output).css({
                    'height': '70px',
                    'width': '100px'
                });
            };

            reader.readAsDataURL(event.target.files[0]);
        };

        $('input[name="title"]').keyup(function() {
            var title = $(this).val();
            $('input[name="seo_title"]').val(title);
            $('input[name="seo_keyword"]').val(title);
        });
    </script>
@endpush
