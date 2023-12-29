@extends('layouts.layout')
@section('Title', 'Update User')
@section('content')
  <main class="signup-form">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <h3 class="card-header text-center">Update Student</h3>
          <div class="card-body">
            <form action="{{ route('update_student', $user->id) }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <input type="text" placeholder="Fullname*" id="name" class="form-control" name="name" required
                  autofocus value={{ old('name') ?: $user->name }}>
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="birthday">Date of birth*:</label><br>
                <input type="date" id="birthday" class="form-control" name="birthday" required
                  value="{{ old('birthday') ?: $user->birthday }}">
                @error('birthday')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label>Gender*:</label><br>
                <div class="row" style="display: grid; grid-template-columns: 1fr 1fr;">
                  <div style="padding-left: 20%">
                    <input type="radio" id="male" name="gender" value='male' required
                      {{ (old('gender') ?: $user->gender) === 'male' ? 'checked' : '' }}>
                    <label for="male">Male</label>
                  </div>
                  <div>
                    <input type="radio" id="female" name="gender" value='female' required
                      {{ (old('gender') ?: $user->gender) === 'female' ? 'checked' : '' }}>
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
                  required value="{{ $user->email }}" disabled>
                @error('email')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Phone number*" id="phone_number" class="form-control"
                  name="phone_number" value="{{ old('phone_number') ?: $user->phone_number }}">
                @error('phone_number')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group mb-3">
                <input type="text" placeholder="Hometown" id="hometown" class="form-control" name="hometown"
                  value="{{ old('hometown') ?: $user->hometown }}">
                @error('hometown')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="text" placeholder="Address" id="address" class="form-control" name="address"
                  value="{{ old('address') ?: $user->address }}">
                @error('address')
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
    <div>
      <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('student_list') }}'"><i
          class="fa-solid fa-backward"></i> Back</button>
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
