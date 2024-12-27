@extends('login::masters')
@section('content')
    <div class="register-box">
      <div class="register-logo">
        <a href="#"><b>Global</b>Studio</a>
      </div>
    
      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register a new membership</p>
    
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" class="form-control"  name="name" value="{{old('name')}}" required  placeholder="Full name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control"  name="email" value="{{old('email')}}" required placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" value="{{old('password')}}" required placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  required placeholder="Retype password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
             
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
     
          <a href="{{route('login')}}" class="text-center">Already Registered</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>  
    <!-- /.register-box -->
    @endsection