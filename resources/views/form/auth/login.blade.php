@extends('layouts.auth-navbar')
@section('Title', 'Login')
@section('content')
  <main class="login-form">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
          <div class="card">
            <h3 class="card-header text-center">Login</h3>
            <div class="card-body">
              <form method="POST" action="{{ route('login.custom') }}">
                @csrf
                <div class="form-group mb-3">
                  <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                    autofocus>
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                    required>
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                {{-- <div class="form-group mb-3">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> Remember Me
                  </label>
                </div>
              </div> --}}
                <div class="d-grid mx-auto">
                  <button type="submit" class="btn btn-dark btn-block">Signin</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @if (Session::has('errors'))
    <script>
      Swal.fire({
        icon: "error",
        title: "Login Error",
        text: "{!! implode('<br>', $errors->all()) !!}",
      }).then(function() {
        location.reload();
      });
    </script>
  @endif
  @if (Session::has('unauthenticated'))
    <script>
      Swal.fire({
        title: "Not authorized",
        text: "{{ Session::get('unauthenticated') }}",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
      }).then(function() {
        location.reload();
      })
    </script>
  @endif
@endsection
