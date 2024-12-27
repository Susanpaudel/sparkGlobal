@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Site Setting
@endsection
@push('css')
    <style>
        .display_image {
            width: 70px !important;
            height: 70px !important;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            opacity: 85%;
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
                        <h1>Site Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="{{route('admin.branch.index')}}">View Branches</a></li> --}}
                            <li class="breadcrumb-item active">Site Setting</li>
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
                        <!-- general form elements -->
                        <div class="card card-primary">

                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body ">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="font-size: smaller;">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="form" method="post" action="{{ route('admin.site-config.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-default ">
                                                <div class="card-header">
                                                    <h3 class="card-title">General </h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                    </div>
                                                </div>
                                                <div class="card-body row">

                                                    @foreach ($site_configs as $config)
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="row  align-items-center m-2" >
                                                            <div class="col-12 col-md-3 col-lg-3" >
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{{ucwords(str_replace('_', ' ', $config->key)) }}:</label>
                                                                </div>
                                                            </div>

                                                            @if ($config->data_type == 'file')
                                                                    <div class="col-8 col-md-7 col-lg-7">
                                                                        <div class="form-group">
                                                                            <input type="file" class="form-control" id="{{ $config->key }}"
                                                                                name="{{ $config->key }}" accept="image/*"
                                                                                onchange="loadFile(event)">
                    
                                                                        </div>
                                                                    </div>
                    
                                                                    <div class="col-lg-2 col-md-2 col-4">
                                                                        @if ($config->value)
                                                                        @if (in_array(strtolower(pathinfo($config->value, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                                                                        <img src="{{ asset('storage/setting/'.$config->value) }}" 
                                                                             class="previous_image_{{ $config->key }} display_image" 
                                                                             alt="AdminLTELogo" height="50" width="70">
                                                                        @else
                                                                            <a href="{{ asset('storage/setting/'.$config->value) }}" target="_blank"><i class="fas fa-eye"></i></a>
                                                                            <a href="{{ asset('storage/setting/'.$config->value) }}" download=""><i class="fas fa-download"></i></a>
                                                                        @endif
                                                                        @endif
                                                                        <div class="image_div_{{ $config->key }}" style="display:none;">
                                                                            <img id="image_preview_{{ $config->key }}" class="display_image"
                                                                                height="50" width="70" />
                                                                        </div>
                    
                                                                    </div>
                                                                @elseif($config->data_type == 'textarea')
                                                                <div class="col-12 col-md-9 col-lg-9" >
                                                                    <div class="form-group">
                                                                        <textarea type="text" rows="4" class="form-control" name="{{ $config->key }}"
                                                                         >{{ $config->value }}</textarea>
                                                                    </div>
                                                                </div>

                                                            @else
                                                            <div class="col-12 col-md-9 col-lg-9" >
                                                                <div class="form-group">
                                                                        <input type="{{ $config->data_type }}"
                                                                            class="form-control" name="{{ $config->key }}"
                                                                            value="{{ $config->value }}">
                                                                    </div>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!-- /.card-body -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
    @push('js')
        <script></script>
    @endpush

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
@endpush
