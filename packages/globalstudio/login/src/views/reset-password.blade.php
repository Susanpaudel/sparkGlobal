@extends('login::masters')
@section('content')    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Global</b>Studio</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
    
          <form method="POST" action="{{ route('password.update') }}">
            @csrf  
            
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">


            <div class="input-group mb-3">
              <input type="password" class="form-control" name="email" value="{{$request->email}}" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Confirm Password" name="password" required >
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password"  name="password_confirmation"  required >
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
    
          <p class="mt-3 mb-1">
            <a href="login.html">Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    
 @endsection