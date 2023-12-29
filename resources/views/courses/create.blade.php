@extends('layouts.layout')
@section('Title', 'Create Course')
@section('content')
  <main class="signup-form">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <h3 class="card-header text-center">Create Course</h3>
          <div class="card-body">
            <form action="{{ route('store_course') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <input type="text" placeholder="Course Name*" id="name" class="form-control" name="name"
                  required autofocus value="{{ old('name') }}">
                @error('name')
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
                <label for="teacher_id">Teacher*:</label>
                <select id="teacher_id" class="form-control" name="teacher_id">
                  @foreach ($teachers as $teacher)
                    <option value={{ $teacher->id }} {{ old('teacher_id') === $teacher->id ? 'selected' : '' }}>
                      {{ $teacher->name }}</option>
                  @endforeach
                </select>
                @error('teacher_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="number" placeholder="Fee*" id="fee" class="form-control" name="fee" required
                  value="{{ old('fee') }}">
                @error('fee')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="opening_date">Opening Date*:</label><br>
                <input type="date" id="opening_date" class="form-control" name="opening_date" required
                  value="{{ old('opening_date') }}">
                @error('opening_date')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <label for="ending_date">Ending Date*:</label><br>
                <input type="date" id="ending_date" class="form-control" name="ending_date" required
                  value="{{ old('ending_date') }}">
                @error('ending_date')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="number" placeholder="Total Sessions*" id="total_session" class="form-control"
                  name="total_session" required value="{{ old('total_session') }}">
                @error('total_session')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              @php
                if (is_array(old('schedule_dates'))) {
                    $scheduleStr = implode(',', old('schedule_dates'));
                }
                $days = getScheduleDates($scheduleStr ?? '');
              @endphp
              <div class="form-group mb-3">
                <div class="schedule-date">
                  <label>Schedule Date</label><br>
                  <div class="d-flex">
                    <div style="width: 50%">
                      <input type="checkbox" id="monday" name="schedule_dates[]" value="monday"
                        {{ isCheckedAttribute($days['isMon']) }}>
                      <label for="monday">Monday</label><br>
                    </div>
                    <div style="width: 50%">
                      <input type="checkbox" id="tuesday" name="schedule_dates[]" value="tuesday"
                        {{ isCheckedAttribute($days['isTue']) }}>
                      <label for="tuesday">Tuesday</label><br>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div style="width: 50%">
                      <input type="checkbox" id="wednesday" name="schedule_dates[]" value="wednesday"
                        {{ isCheckedAttribute($days['isWed']) }}>
                      <label for="wednesday">Wednesday</label><br>
                    </div>
                    <div style="width: 50%">
                      <input type="checkbox" id="thursday" name="schedule_dates[]" value="thursday"
                        {{ isCheckedAttribute($days['isThu']) }}>
                      <label for="thursday">Thursday</label><br>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div style="width: 50%">
                      <input type="checkbox" id="friday" name="schedule_dates[]" value="friday"
                        {{ isCheckedAttribute($days['isFri']) }}>
                      <label for="friday">Friday</label><br>
                    </div>
                    <div style="width: 50%">
                      <input type="checkbox" id="saturday" name="schedule_dates[]" value="saturday"
                        {{ isCheckedAttribute($days['isSat']) }}>
                      <label for="saturday">Saturday</label><br>
                    </div>
                  </div>
                  <div style="width: 50%">
                    <input type="checkbox" id="sunday" name="schedule_dates[]" value='sunday'
                      {{ isCheckedAttribute($days['isSun']) }}>
                    <label for="sunday">Sunday</label><br>
                  </div>
                </div>
                @error('schedule_dates')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="number" placeholder="Estimated Students" id="estimated_students" class="form-control"
                  name="estimated_students" value="{{ old('estimated_students') }}">
                @error('estimated_students')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <input type="hidden" id="status" class="form-control" name="status" value="NEW">
                @error('status')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Create</button>
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
        title: "Create Success!",
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
        title: "Create Fail!",
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
