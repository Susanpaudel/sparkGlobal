@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Blog
@endsection

@section('content')
    <!-- Content Wrapper. Contains blog content -->
    <div class="content-wrapper">
        <!-- Content Header (Blog header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">View Blogs</a></li>
                            <li class="breadcrumb-item active">Create Blog</li>
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
                        <form class="form" method="post" action="{{ route('admin.blog.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card card-default ">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title') }}" placeholder="Enter title" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Slug<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug"
                                                    value="{{ old('slug') }}" placeholder="Enter slug" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Short Content<span class="required">*</span></label>
                                            <textarea type="text" class="form-control" rows="4" name="short_content"
                                             placeholder="Enter Short Content" required>{{old('short_content')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content<span class="required">*</span></label>
                                        <textarea class="summernote" value="{{ old('content') }}" name="content" required> 
                                        {{ old('content') }}
                                       </textarea>                    

                                    </div>


                                    <div class="row">
                                        {{-- <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Category</label> &nbsp; <a href="#"
                                                    data-target="#category-modal" data-toggle="modal"><span
                                                        class="badge badge-success">create new <i
                                                            class="fas fa-plus"></i></span></a>
                                                <select class="form-control select2 select_category" name="category_id[]"
                                                    multiple>

                                                </select>


                                            </div>


                                        </div> --}}
                                        <div class="col-lg-6 col-md-6 col-8">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*"
                                                    onchange="loadFile(event)" id="file" />

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4">
                                            <div class="image_div" style="display:none;">
                                                <img id="image_preview" height="90" width="100" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">


                                        <div class="col-lg-6 col-md-6 col-12">

                                            <div class="form-group">
                                                <label for="">SEO Title</label>
                                                <input type="text" class="form-control" name="seo_title" placeholder="seo title" value="{{old('seo_title')}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">

                                            <div class="form-group">
                                                <label for="">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword"
                                                    placeholder="seo keyword" value="{{old('seo_keyword')}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row ">


                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">SEO Description</label>
                                                <textarea name="seo_description" class="form-control">{{old('seo_description')}} </textarea>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Tags</label>
                                                <textarea class="form-control" name="tags" placeholder="eg: Tag1,Tag2,Tag3">{{old('tags')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Status</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" checked>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- /.card-body -->


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
    <div class="modal fade" id="category-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form" id="category-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control category-name" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" class="form-control category-slug" name="slug"
                                            placeholder="Enter Slug">
                                    </div>
                                </div>
                            </div>


                            <div class="row">



                                <div class="col-lg-6 col-md-6 col-12">

                                    <div class="form-group">
                                        <label for="">SEO Title</label>
                                        <input type="text" class="form-control category-seo_title" name="seo_title"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">SEO Keyword</label>
                                        <input type="text" class="form-control category-seo_keyword"
                                            name="seo_keyword" placeholder="">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="">SEO Description</label>
                                        <textarea name="seo_description category-seo_description" class="form-control"> </textarea>
                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Status</label><br>
                                        <label class="switch">
                                            <input type="checkbox" class="category-status" name="status" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
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


    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getCategories();
        });

        $('#category-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('/admin') }}" + "/blog-categories/store",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                success: function(result) {
                    console.log(result)
                    getCategories();
                    $('#category-modal').modal('toggle');
                    toastr.success("Created  Successfully");
                },
                eroror: function() {
                    toastr.error("Couldnot Create");
                }
            });
        });

        function getCategories() {
            $.ajax({
                type: "GET",
                url: "{{ url('/admin') }}" + "/blog-categories",
                success: function(results) {
                    $('.select_category').html('<option value="">Select Category</option> ');
                    for (var i = 0; i < results.length; i++) {
                        $('.select_category').append('<option value="' + results[i].id +
                            '">' + results[i].name + '</option>')
                    }

                }
            });
        }
    </script>
@endpush
