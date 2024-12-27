@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Why Choose Us
@endsection

@section('content')
    <!-- Content Wrapper. Contains Why Choose Us content -->
    <div class="content-wrapper">
        <!-- Content Header (why_choose_us header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Why Choose Us</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.why_choose_us.index') }}">View Why Choose Us</a></li>
                            <li class="breadcrumb-item active">Edit Why Choose Us</li>
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
                        <form class="form" method="post" action="{{ route('admin.why_choose_us.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $why_choose_us->id }}">
                            <div class="card card-default ">
                                <div class="card-body ">
                                    <div class="row">

                                    
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title',$why_choose_us->title) }}" placeholder="Enter title" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Counter<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="counter"
                                                value="{{ old('counter',$why_choose_us->counter) }}" placeholder="Enter counter" required>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Icon<span class="required">*</span></label>
                                            <textarea type="text" class="form-control" rows="4" name="icon"
                                             placeholder="Enter icon" required>{{old('icon',$why_choose_us->icon)}}</textarea>
                                        </div>
                                        <span>Copy tag from this website : <a target="_blank" href="https://fontawesome.com/icons">Link</a></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Status</label><br>
                                            <label class="switch">
                                                <input type="checkbox" name="status"
                                                    @if ($why_choose_us->status) checked @endif>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
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
