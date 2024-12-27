<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_content')
    @php
        $fav_logo = \App\Helpers\Helper::getConfigValue('fav_icon');
    @endphp
    <link rel="icon" href="{{asset('storage/setting/'.$fav_logo)}}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('storage/setting/'.$fav_logo)}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('storage/setting/'.$fav_logo)}}">
    <link rel="apple-touch-icon" href="{{asset('storage/setting/'.$fav_logo)}}">
    <link rel="manifest" href="{{asset('storage/setting/'.$fav_logo)}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap CSS -->
    @include('frontend.layouts.css')
</head>

<body class="royal_loader">
    <!-- royal_loader -->
    <div id="page">
        <!-- Mobile Menu -->
        @include('frontend.layouts.navbar')
        <!-- /Mobile Menu -->



        @include('frontend.layouts.header')
        <!-- /End Header 9 Warp -->

        @yield('content')
        <!-- /copyright -->


        <!-- Footer -->
        @include('frontend.layouts.footer')
        <!-- /Footer -->

    </div>
    <!-- /page -->
    <a id="to-the-top" class="fixbtt bg-hover-theme"><i class="fa fa-chevron-up"></i></a>
 
    @include('frontend.layouts.js')

</body>

</html>
