@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Create Service
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Service</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">View Service</a></li>
                            <li class="breadcrumb-item active">Create Service</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
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
                        <div class="card card-primary">
                            <form class="form serviceStore" method="post" action="{{ route('admin.service.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Services</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="feature_0">Title<span
                                                        class="required">*</span></label>
                                                    <input type="text" name="title" class="form-control" id="feature_0"
                                                        placeholder="Enter feature" value="{{old('title')}}" required>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Slug<span
                                                            class="required">*</span></label>
                                                    <input type="text" class="form-control" value="{{old('slug')}}" name="slug"
                                                        placeholder="Enter slug" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="feature_0">short content <span
                                                        class="required">*</span></label>
                                                    <textarea rows="4" type="text" name="short_content" class="form-control" id="feature_0"
                                                        placeholder="Enter Short Content" required>{{old('short_content')}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Long Content<span class="required">*</span></label>
                                                    <textarea class="summernote" value="{{ old('content') }}" name="content" required> 
                                                    {{ old('content') }}
                                                   </textarea>                    
            
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="feature_0">Icon <span
                                                        class="required">*</span></label>
                                                    <textarea rows="2" type="text" name="icon" class="form-control" id="feature_0"
                                                        placeholder="Enter Icon <span></span>" required>{{old('icon')}}</textarea>
                                                        <span>Copy tag from this website : <a target="_blank" href="https://fontawesome.com/icons">Link</a></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-4">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Image<span
                                                        class="required">*</span></label>
                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/*" onchange="loadFile(event)" id="file" required/>

                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-4">
                                                <div class="image_div" style="display:none;">
                                                    <img id="image_preview" height="90" width="100" />
                                                </div>
                                            </div>
                                           

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="feature_0">Priority</label>
                                                    <input type="number" name="priority" class="form-control"
                                                        id="feature_0" placeholder="Enter Priority" value="{{old('priority')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Status</label><br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status" checked>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body border p-2 mb-2">
                                            <!-- Feature Repeater -->
                                            <div id="">
                                                <label>Select Trader Choose Us Content</label>
                                                <div class="repeater-item" data-index="0">
                                                    <div class="row">
                                                        @foreach ($chooses as $a=>$ch)
                                                        <div class="col-lg-6">
                                                            <div class="form-group form-check">
                                                                <input class="form-check-input"  {{ in_array($ch->id, old('trader_content', [])) ? 'checked' : '' }} type="checkbox" value="{{$ch->id}}" name="trader_content[]" id="flexCheckChecked{{$a}}">
                                                                <label class="form-check-label" for="flexCheckChecked{{$a}}">
                                                                    {{$ch->title}}
                                                                </label>
                                                               
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="card-body border p-2">
                                            <!-- Feature Repeater -->
                                            <div id="feature-repeater">
                                                <label>Clients Benefits</label>
                                                <div class="repeater-item" data-index="0">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="feature_0">Title <span
                                                                    class="required">*</span></label>
                                                                <textarea rows="4" type="text" name="benefit_title[]" class="form-control"
                                                                    id="feature_0" placeholder="Title" required>{{old('benefit_title.*')}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="value_0">Description<span
                                                                    class="required">*</span></label>
                                                                <textarea rows="4" type="text" name="benefit_description[]" class="form-control"
                                                                    id="value_0" placeholder="Description" required>{{old('benefit_description.*')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <button type="button"
                                                                class="btn btn-danger remove-repeater-item">Remove</button>
                                                            <hr>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="add-feature-item" class="btn btn-primary">Add
                                                Benefits</button>
                                        </div>
                                       

                                       

                                       
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <h5>SEO Information</h5>
                                                <div class="form-group">
                                                    <label for="seo_title">SEO Title</label>
                                                    <input type="text" name="seo_title" class="form-control"
                                                        placeholder="Enter SEO title" value="{{old('seo_title')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="seo_keyword">SEO Keyword</label>
                                                    <input type="text" name="seo_keyword" class="form-control"
                                                        placeholder="Enter SEO keyword" value="{{old('seo_keyword')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="seo_description">SEO Description</label>
                                                    <textarea name="seo_description" class="form-control" placeholder="Enter SEO description">{{old('seo_description')}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="seo_tags">SEO Tags</label>
                                                    <input type="text" name="seo_tags" value="{{old('seo_tags')}}" class="form-control"
                                                        placeholder="Enter SEO tags">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('js')
        {{-- <script>
            $(document).ready(function() {
                let featureIndex = 1;
                let serviceIndex = 1;

                // Feature Repeater
                $('#add-feature-item').click(function() {
                    let newItem = $('#feature-repeater .repeater-item:first').clone();
                    newItem.attr('data-index', featureIndex);
                    newItem.find('input').each(function() {
                        let name = $(this).attr('name');
                        let id = $(this).attr('id');
                        name = name.replace(/\d+/, featureIndex);
                        id = id.replace(/\d+/, featureIndex);
                        $(this).attr('name', name);
                        $(this).attr('id', id);
                        $(this).val(''); // Clear input values
                    });
                    newItem.appendTo('#feature-repeater');
                    featureIndex++;
                });

                $(document).on('click', '#feature-repeater .remove-repeater-item', function() {
                    if ($('#feature-repeater .repeater-item').length > 1) {
                        $(this).closest('.repeater-item').remove();
                    } else {
                        alert('You need to have at least one feature.');
                    }
                });

                // Service Repeater
                $('#add-service-item').click(function() {
                    let newItem = $('#service-repeater .repeater-item:first').clone();
                    newItem.attr('data-index', serviceIndex);
                    newItem.find('input, textarea').each(function() {
                        let name = $(this).attr('name');
                        let id = $(this).attr('id');
                        if (name) {
                            name = name.replace(/\[\d*\]/, '[' + serviceIndex +
                                ']'); // Update name with index
                            $(this).attr('name', name);
                        }
                        if (id) {
                            id = id.replace(/\d+/, serviceIndex); // Update id with index
                            $(this).attr('id', id);
                        }
                        $(this).val(''); // Clear input values
                    });
                    newItem.find('.note-editor').remove(); // Remove the Summernote editor
                    newItem.find('.summernote').show(); // Ensure the textarea is visible
                    $('#service-repeater').append(newItem);

                    initializeSummernote(newItem); // Initialize Summernote for the new textarea
                    serviceIndex++;
                });

                $(document).on('click', '#service-repeater .remove-repeater-item', function() {
                    if ($('#service-repeater .repeater-item').length > 1) {
                        $(this).closest('.repeater-item').remove();
                    } else {
                        alert('You need to have at least one service.');
                    }
                });

                // Initialize Summernote
                function initializeSummernote(context = null) {
                    let selector = context ? context.find('.summernote') : $('.summernote');
                    selector.summernote({
                        height: 200,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                            ['view', ['fullscreen', 'codeview']]
                        ]
                    });
                }

                initializeSummernote(); // Initialize Summernote on page load
            });
        </script> --}}


        <script>
            $(document).ready(function() {
                let featureIndex = 1;
                let serviceIndex = 1;
                let priceIndex = 1;

                // Feature Repeater
                $('#add-feature-item').click(function() {
                    let newItem = $('#feature-repeater .repeater-item:first').clone();
                    newItem.attr('data-index', featureIndex);
                    newItem.find('input').each(function() {
                        let name = $(this).attr('name');
                        let id = $(this).attr('id');
                        name = name.replace(/\d+/, featureIndex);
                        id = id.replace(/\d+/, featureIndex);
                        $(this).attr('name', name);
                        $(this).attr('id', id);
                        $(this).val(''); // Clear input values
                    });
                    newItem.appendTo('#feature-repeater');
                    featureIndex++;
                });

                $(document).on('click', '#feature-repeater .remove-repeater-item', function() {
                    if ($('#feature-repeater .repeater-item').length > 1) {
                        $(this).closest('.repeater-item').remove();
                    } else {
                        alert('You need to have at least one feature.');
                    }
                });
            });
        </script>
    @endpush
@endsection
