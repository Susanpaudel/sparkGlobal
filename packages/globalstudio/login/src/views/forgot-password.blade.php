@extends('login::masters')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Global</b>Studio</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      @if($errors->any())
      @foreach ($errors->all() as $error)
      <li class="text-danger">{{$error}}</li>
      @endforeach
      @endif
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
      <p class="mb-0">
        <a  href="{{ route('register') }}">Register</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection