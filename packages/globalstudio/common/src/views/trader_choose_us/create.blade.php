@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Trader Choose Us Content
@endsection

@section('content')
    <!-- Content Wrapper. Contains Trader Choose Us Content content -->
    <div class="content-wrapper">
        <!-- Content Header (trader_choose_us header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Trader Choose Us Content</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.trader_choose_us.index') }}">View Trader Choose Us Contents</a></li>
                            <li class="breadcrumb-item active">Create Trader Choose Us Content</li>
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
                        <form class="form" method="post" action="{{ route('admin.trader_choose_us.store') }}"
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
                                                <label for="exampleInputEmail1">Description<span class="required">*</span></label>
                                                <textarea type="text" class="form-control" rows="4" name="description"
                                                placeholder="Enter Description" required>{{old('description')}}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Icon<span class="required">*</span></label>
                                            <textarea type="text" class="form-control" rows="4" name="icon"
                                             placeholder="Enter icon" required>{{old('icon')}}</textarea>
                                        </div>
                                        <span>Copy tag from this website : <a target="_blank" href="https://fontawesome.com/icons">Link</a></span>
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
                url: "{{ url('/admin') }}" + "/trader_choose_us-categories/store",
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
                url: "{{ url('/admin') }}" + "/trader_choose_us-categories",
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
