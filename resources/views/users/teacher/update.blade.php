@extends('layouts.layout')
@section('Title', 'Update Account')
@section('content')
  <main class="signup-form">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <h3 class="card-header text-center">Update Account</h3>
          <div class="card-body">
            <form action="{{ route('teacher.update_account') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <input type="text" placeholder="Fullname*" id="name" class="form-control" name="name" required
                  autofocus value="{{ old('name') ?: $account->name }}">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="birthday">Date of birth*:</label><br>
                <input type="date" id="birthday" class="form-control" name="birthday" required
                  value="{{ old('birthday') ?: $account->birthday }}">
                @error('birthday')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label>Gender*:</label><br>
                <div class="row" style="display: grid; grid-template-columns: 1fr 1fr;">
                  <div style="padding-left: 20%">
                    <input type="radio" id="male" name="gender" value='male' required
                      {{ (old('gender') ?: $account->gender) === 'male' ? 'checked' : '' }}>
                    <label for="male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="female" name="gender" value='female' required
                      {{ (old('gender') ?: $account->gender) === 'female' ? 'checked' : '' }}>
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
                  <option value=1 {{ (old('level_id') ?: $account->level_id) === 1 ? 'selected' : '' }}>N1</option>
                  <option value=2 {{ (old('level_id') ?: $account->level_id) === 2 ? 'selected' : '' }}>N2</option>
                  <option value=3 {{ (old('level_id') ?: $account->level_id) === 3 ? 'selected' : '' }}>N3</option>
                  <option value=4 {{ (old('level_id') ?: $account->level_id) === 4 ? 'selected' : '' }}>N4</option>
                  <option value=5 {{ (old('level_id') ?: $account->level_id) === 5 ? 'selected' : '' }}>N5</option>
                </select>
                @error('level_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              {{-- The email fields are absent in the request data due to being disabled. --}}
              <div class="form-group mb-3">
                <input type="text" placeholder="Email*" id="readonly_email" class="form-control" name="readonly_email"
                  required value="{{ $account->email }}" disabled>
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Phone number*" id="phone_number" class="form-control"
                  name="phone_number" value="{{ old('phone_number') ?: $account->phone_number }}">
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Hometown" id="hometown" class="form-control" name="hometown"
                  value="{{ old('hometown') ?: $account->hometown }}">
                @error('hometown')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Address" id="address" class="form-control" name="address"
                  value="{{ old('address') ?: $account->address }}">
                @error('address')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Workplace" id="workplace" class="form-control" name="workplace"
                  value="{{ old('workplace') ?: $account->workplace }}">
                @error('workplace')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="password" placeholder="Old Password*" id="old_password" class="form-control"
                  name="old_password" required>
                @error('old_password')
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
                <button type="submit" class="btn btn-dark btn-block">Update</button>
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
        title: "Update Success!",
        text: "{{ Session::get('success') }}",
        icon: 'success',
      }).then(function() {
        location.reload();
      })
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      Swal.fire({
        title: "Update Fail!",
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
