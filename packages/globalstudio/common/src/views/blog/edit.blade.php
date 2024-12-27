@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Blog
@endsection

@section('content')
    <!-- Content Wrapper. Contains blog content -->
    <div class="content-wrapper">
        <!-- Content Header (Blog header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">View Blogs</a></li>
                            <li class="breadcrumb-item active">Edit Blog</li>
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
                        <form class="form" method="post" action="{{ route('admin.blog.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <div class="card card-default ">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $blog->title }}" placeholder="Enter title" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Slug<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="slug" required
                                                    value="{{ $blog->slug }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Short Content<span class="required">*</span></label>
                                            <textarea type="text" class="form-control" rows="4" name="short_content"
                                                 required>{{ $blog->short_content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Content <span class="required">*</span></label>
                                        <textarea class="summernote" name="content" required>
                                           {{ $blog->content }}</textarea>
                                    </div>

                                   

                                    <div class="row">
                                        {{-- <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Categories</label>
                                                <select class="form-control select2 select_category" name="category_id[]" multiple>
                                                    @foreach ($blog_categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if (in_array($category->id, $selected_blog_categories)) selected @endif>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-3 col-md-3 col-8">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image</label>
                                                <input type="file" class="form-control" name="image" accept="image/*"
                                                    onchange="loadFile(event)" id="file" />

                                            </div>
                                        </div>
                                        {{-- @dd($blog) --}}
                                        <div class="col-lg-3 col-md-3 col-4">
                                            @if ($blog->image)
                                                <img src="{{ asset("storage/blog/".$blog->image) }}" class="previous_image"
                                                    alt="AdminLTELogo" height="80" width="80">
                                            @endif
                                            <div class="image_div" style="display:none;">
                                                <img id="image_preview" height="90" width="100" />
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">SEO Title</label>
                                                <input type="text" class="form-control" name="seo_title" value="{{old('seo_title',$blog->seo_title)}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">SEO Keyword</label>
                                                <input type="text" class="form-control" name="seo_keyword" value="{{old('seo_keyword',$blog->seo_keyword)}}"
                                                    placeholder="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">SEO Description</label>
                                                <textarea name="seo_description" class="form-control">{{old('seo_description',$blog->seo_description)}} </textarea>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Tags</label>
                                                <textarea class="form-control" name="tags" placeholder="eg: Tag1,Tag2,Tag3">{{ $blog->tags }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Status</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status"
                                                        @if ($blog->status) checked @endif>
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

                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
