@extends('frontend.layouts.master')
@section('meta_content')
@php
    $logo=App\Helpers\MyHelper::getSiteConfig('header_site_logo');
@endphp
  <!-- HTML Meta Tags -->
  <title>{{ $page->seo_title }} - {{ config('app.name') }}</title>
  <meta name="description" content="{{ $page->seo_description }}">
  <meta name="keywords" content="{{$page->seo_keyword}}">
  <!-- Facebook Meta Tags -->
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $page->seo_title }} - {{ config('app.name') }}">
  <meta property="og:description" content="{{ $page->seo_description }}">
  <meta property="og:image" content="{{ asset('storage/setting/' . $logo) }}">
  <meta property="og:image:alt" content="{{ $page->seo_title }} - {{ config('app.name') }} Logo">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta property="twitter:domain" content="{{ url()->current() }}">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="{{ $page->seo_title }} - {{ config('app.name') }}">
  <meta name="twitter:description" content="{{ $page->seo_description }}">
  <meta name="twitter:image" content="{{ asset('storage/setting/' . $logo) }}">
  <!-- Meta Tags Generated by Susan Paudel -->
@endsection

@section('css')
    <style>
        .sh-news {
            background: url("{{ asset('frontend/images/bg-content/sh-news.jpg') }}") no-repeat;

        }

       
    </style>
@endsection

@section('content')
    <section class="no-padding sh-news">
        <div class="sub-header ">
            <span>COMPANY BLOGS</span>
            <h3>LATEST BLOGS</h3>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('blog') }}"><i class="fa fa-home"></i> HOME </a>
                </li>

                <li class="active"> BLOGS</li>
            </ol>
        </div>
    </section>
    <!-- /subheader -->
    
    @if(count($blogs)>0)
    <section>
        <div class="container">
            <div class="row">
                <div class="news-list-warp">
                    @foreach ($blogs as $blog)
                    
                    <div class="col-md-6">
                        <div class="item-new-list grid-new"> <!-- add class no-position -->

                            <div class="feature-new-warp">
                                <a href="{{route('blog-single',$blog->slug)}}">
                                    <img src="{{ asset('storage/blog/'.$blog->image) }}" class="img-responsive"
                                        alt="Image">
                                </a>
                            </div>
                            <div class="box-new-info">
                                <div class="new-info">
                                    <h4>
                                        <a href="{{route('blog-single',$blog->slug)}}">{{$blog->title}}</a>
                                    </h4>
                                    <p><i class="fa fa-calendar" aria-hidden="true"></i>{{ $blog->created_at->format('F d, Y') }}</p>
                                    @php
                                        $role=App\Models\User::find($blog->added_by)->name;
                                    @endphp
                                    @if($role)
                                    <p><i class="fa fa-user" aria-hidden="true"></i> By {{$role}}</p>
                                    @endif
                                    {{-- <p><i class="fa fa-comments" aria-hidden="true"></i>28 </p>
                                    <p>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    </p> --}}
                                </div>
                                <div class="tapo">
                                    <p>{{$blog->short_content}}</p>
                                </div>
                                <a href="{{route('blog-single',$blog->slug)}}" class="ot-btn btn-sub-color">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   
                </div>
                <div class="col-md-12">
                    @if ($blogs->hasPages())
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            @if ($blogs->onFirstPage())
                                <li class="disabled"><a href="#">PREVIOUS</a></li>
                            @else
                                <li><a href="{{ $blogs->previousPageUrl() }}">PREVIOUS</a></li>
                            @endif

                            <!-- Pagination Links -->
                            @foreach ($blogs->links()->elements[0] as $page => $url)
                                @if ($page == $blogs->currentPage())
                                    <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Next Page Link -->
                            @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}">NEXT</a></li>
                            @else
                                <li class="disabled"><a href="#">NEXT</a></li>
                            @endif
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </section>
    @endif
   
@endsection
