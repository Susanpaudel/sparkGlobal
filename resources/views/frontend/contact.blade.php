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
        .sh-contact {
            background: url("{{ asset('frontend/images/bg-content/sh-contact.jpg') }}") no-repeat;

        }

        .bg-subcr-1 {
            background: url("{{ asset('frontend/images/bg-content/bg-subcri.jpg') }}") no-repeat;

        }
    </style>
@endsection


@section('content')
    <section class="no-padding sh-contact">
        <div class="sub-header ">
            <span>CONNECT WITH US</span>
            <h3>GET IN TOUCH</h3>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('index') }}"><i class="fa fa-home"></i> HOME </a>
                </li>

                <li class="active">CONTACT US</li>
            </ol>
        </div>
    </section>
    <!-- /subheader -->
    @php
    $address=App\Helpers\MyHelper::getSiteConfig('address');
    $mail=App\Helpers\MyHelper::getSiteConfig('mail');
    $phone=App\Helpers\MyHelper::getSiteConfig('phone_number');
    $mobile=App\Helpers\MyHelper::getSiteConfig('mobile_number');
    $map=App\Helpers\MyHelper::getSiteConfig('map');
@endphp
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="iconbox-inline">
                        <span class="icon icon-location2"></span>
                        <h4>Head Office</h4>
                        <p>{{$address}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconbox-inline">
                        <span class="icon icon-phone"></span>
                        <h4>Phone Numbers</h4>
                        <p><a href="tel:{{$phone}}">{{$phone}}</a>,<a href="tel:{{$mobile}}">{{$mobile}}</a> </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="iconbox-inline">
                        <span class="icon icon-envelop"></span>
                        <h4>E-mail Address</h4>
                        <p><a href="mailto:{{$mail}}">{{$mail}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Iconbxo -->
    <div id="map-canvas" class="map-warp" style="height: 360px;">
        {{$map}}
    </div>
    <!-- /Map -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-block title-contact">
                        <h3>Send an Message</h3>
                        <span class="bottom-title"></span>
                    </div>
                </div>
                <div class="form-contact-warp">
                    <form name="#" action="{{route('contact-store')}}" method="post">
                        @csrf
                        {{-- action="https://templates.thememodern.com/amwal/send_form_email.php"> --}}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}" placeholder="Full Name *" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email Address *" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="subject" value="{{old('subject')}}" placeholder="Subject *" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="comments" class="form-control" rows="5" placeholder="Comment">{{old('comments')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <button type="submit" class="btn-main-color"><i class="fa fa-paper-plane"
                                    aria-hidden="true"></i> Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
