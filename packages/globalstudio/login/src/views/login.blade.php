@extends('login::masters')
@php
    $helper = new \App\Helpers\Helper();
    $logo = $helper->getConfigValue('header_site_logo');
@endphp
@section('title')
    Login - {{ env('APP_NAME') }}- BOW CMS
@endsection
@push('css')
    <style type="text/css">
        .login-page {
            background-image: linear-gradient(to right top, rgb(27, 33, 88), #484e4e);
        }
    </style>
@endpush


@section('content')

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                {{-- <h4> Login - {{env('APP_NAME')}}- BOW CMS</h4> --}}
                <a href="{{ env('GLOBAL_WEBSITE_URL') }}">
                    <img src="{{ $logo ? asset($logo) : asset('assets/frontend/images/logo-img.png') }}" style="height:12vh;">

                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('admin.login.post') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="form-control error-input" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control error-input" name="password" required
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li class="text-danger error-input-text">{{ $error }}</li><br>
                        @endforeach
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-2">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>

@endsection
