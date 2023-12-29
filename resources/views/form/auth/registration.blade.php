@extends('layouts.auth-navbar')
@section('Title', 'Register')
@section('content')
  <main class="signup-form">
    <div class="row justify-content-center">
      <div class="col-lg-3 col-md-4">
        <div class="card">
          <h3 class="card-header text-center">Register Student</h3>
          <div class="card-body">
            <form action="{{ route('register.custom') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <input type="text" placeholder="Full name*" id="name" class="form-control" name="name" required
                  value="{{ old('name') }}">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="birthday">Date of birth*:</label><br>
                <input type="date" id="birthday" class="form-control" name="birthday" required
                  value="{{ old('birthday') }}">
                @error('birthday')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label>Gender*:</label><br>
                <div class="row" style="display: grid; grid-template-columns: 1fr 1fr;">
                  <div style="padding-left: 20%">
                    <input type="radio" id="male" name="gender" value='male' required
                      {{ old('gender') === 'male' ? 'checked' : '' }}>
                    <label for="male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="female" name="gender" value='female' required
                      {{ old('gender') === 'female' ? 'checked' : '' }}>
                    <label for="female">Female</label>
                  </div>
                </div>
                @error('gender')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="level_id">Level*:</label>
                <select id="level_id" class="form-control" name="level_id">
                  <option value=1 {{ old('level_id') === 1 ? 'selected' : '' }}>N1</option>
                  <option value=2 {{ old('level_id') === 2 ? 'selected' : '' }}>N2</option>
                  <option value=3 {{ old('level_id') === 3 ? 'selected' : '' }}>N3</option>
                  <option value=4 {{ old('level_id') === 4 ? 'selected' : '' }}>N4</option>
                  <option value=5 {{ old('level_id') === 5 ? 'selected' : '' }}>N5</option>
                </select>
                @error('level_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Email*" id="email" class="form-control" name="email" required
                  value="{{ old('email') }}">
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Phone Number*" id="phone_number" class="form-control"
                  name="phone_number" required value="{{ old('phone_number') }}">
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Hometown" id="hometown" class="form-control" name="hometown"
                  value="{{ old('hometown') }}">
                @error('hometown')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Address" id="address" class="form-control" name="address"
                  value="{{ old('address') }}">
                @error('address')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="password" placeholder="Password*" id="password" class="form-control" name="password"
                  required>
                @error('password')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="password" placeholder="Confirm Password*" id="confirm_password" class="form-control"
                  name="password_confirmation" required>
                @error('password_confirmation')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  @if (Session::has('success'))
    <script>
      Swal.fire({
        title: "Register Success",
        text: "{{ Session::get('success') }}",
        icon: 'success',
      }).then(function() {
        location.href = '/login';
      });
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      Swal.fire({
        title: "Register Fail!",
        text: "{{ Session::get('error') }}",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
      }).then(function() {
        location.reload();
      })
    </script>
  @endif
@endsection
