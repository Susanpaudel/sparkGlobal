@extends('common::layouts.masters')

@section('title')
    {{ env('APP_NAME') }} | Edit Service
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Service</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">View Service</a></li>
                            <li class="breadcrumb-item active">Edit Service</li>
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
                            <form class="form" method="post" action="{{ route('admin.service.update', $service->id) }}"
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
                                                    <label for="title">Title <span class="required">*</span></label>
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="{{ $service->title }}" placeholder="Enter title" required>
                                                </div>
                                            </div>
                                           
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="slug">Slug<span class="required">*</span></label>
                                                    <input type="text" class="form-control" name="slug" required
                                                        value="{{ $service->slug }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="feature_0">short content <span
                                                        class="required">*</span></label>
                                                    <textarea rows="4" type="text" name="short_content" class="form-control" id="feature_0"
                                                        placeholder="Enter Short Content" required>{{old('short_content',$service->short_content)}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Long Content<span class="required">*</span></label>
                                                    <textarea class="summernote" value="{{ old('content') }}" name="content" required> 
                                                    {{ old('content',$service->content) }}
                                                   </textarea>                    
            
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="feature_0">Icon <span
                                                        class="required">*</span></label>
                                                    <textarea rows="2" type="text" name="icon" class="form-control" id="feature_0"
                                                        placeholder="Enter Icon <span></span>" required>{{old('icon',$service->icon)}}</textarea>
                                                        <span>Copy tag from this website : <a target="_blank" href="https://fontawesome.com/icons">Link</a></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-8">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/*" onchange="loadFile(event)" id="file" />
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-4">
                                                @if ($service->image)
                                                    <img src="{{ asset("storage/service/".$service->image) }}" class="previous_image"
                                                        alt="Service Image" height="80" width="80">
                                                @endif
                                                <div class="image_div" style="display:none;">
                                                    <img id="image_preview" height="90" width="100" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="title">Priority</label>
                                                    <input type="text" name="priority" class="form-control"
                                                        id="priority" value="{{ $service->priority }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Status</label><br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status"
                                                            @if ($service->status) checked @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                           
                                            @php
                                                $fetch_data=json_decode($service->trader_choose_us_id,true);
                                            @endphp
                                            <div class="card-body border p-2 mb-2">
                                                <!-- Feature Repeater -->
                                                <div id="">
                                                    <label>Select Trader Choose Us Content</label>
                                                    <div class="repeater-item" data-index="0">
                                                        <div class="row">
                                                            @foreach ($chooses as $a=>$ch)
                                                            <div class="col-lg-6">
                                                                <div class="form-group form-check">
                                                                    <input class="form-check-input" type="checkbox" {{ in_array($ch->id, $fetch_data) ? 'checked' : '' }} value="{{$ch->id}}"  name="trader_content[]" id="flexCheckChecked{{$a}}">
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

                                            
                                        </div>

                                        @php
                                            $client_benefit_titles=json_decode($service->client_benefit_title,true);
                                            $client_benefit_descriptions=json_decode($service->client_benefit_description,true);
                                        @endphp
                                        <div class="card-body border p-2">
                                            <!-- Feature Repeater -->
                                            <div id="feature-repeater">
                                                <label>Clients Benefits</label>
                                                <div class="repeater-item" data-index="0">
                                                    @foreach ($client_benefit_titles as $key=>$client)
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="feature_0">Title <span
                                                                    class="required">*</span></label>
                                                                <textarea rows="4" type="text" name="benefit_title[]" class="form-control"
                                                                    id="feature_0" placeholder="Title" required>{{old('benefit_title.*',$client)}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="value_0">Description<span
                                                                    class="required">*</span></label>
                                                                <textarea rows="4" type="text" name="benefit_description[]" class="form-control"
                                                                    id="value_0" placeholder="Description" required>{{old('benefit_description.*',$client_benefit_descriptions[$key])}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
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

                                   
                                    
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h5>SEO Information</h5>
                                            <div class="form-group">
                                                <label for="seo_title">SEO Title</label>
                                                <input type="text" name="seo_title" class="form-control"
                                                    placeholder="Enter SEO title" value="{{ old('seo_title',$service->seo_title) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_keyword">SEO Keyword</label>
                                                <input type="text" name="seo_keyword" class="form-control"
                                                    placeholder="Enter SEO keyword" value="{{ old('seo_keyword',$service->seo_keyword) }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_description">SEO Description</label>
                                                <textarea name="seo_description" class="form-control" placeholder="Enter SEO description">{{ old('seo_description',$service->seo_description) }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="seo_tags">SEO Tags</label>
                                                <input type="text" name="seo_tags" class="form-control"
                                                    placeholder="Enter SEO tags" value="{{ old('seo_tags',$service->seo_tags) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="feature-repeater-template" class="d-none">
        <div class="repeater-item row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Title <span class="required">*</span></label>
                    <textarea rows="4" name="benefit_title[]" class="form-control" placeholder="Title" required></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Description<span class="required">*</span></label>
                    <textarea rows="4" name="benefit_description[]" class="form-control" placeholder="Description" required></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <button type="button" class="btn btn-danger remove-repeater-item">Remove</button>
                <hr>
            </div>
        </div>
    </div>
    @push('js')
    <script>
    $(document).ready(function () {
    // Add new benefit item
    $('#add-feature-item').click(function () {
        // Clone the template
        let newRow = $('#feature-repeater-template').clone().removeAttr('id').removeClass('d-none');
        // Append the cloned row to the repeater
        $('#feature-repeater').append(newRow);
    });

    // Remove benefit item
    $(document).on('click', '.remove-repeater-item', function () {
        // Check if there is more than one item
        if ($('#feature-repeater .repeater-item').length > 1) {
            $(this).closest('.repeater-item').remove();
        } else {
            alert('At least one content must remain.');
        }
    });
});

    </script>
    @endpush



@endsection
