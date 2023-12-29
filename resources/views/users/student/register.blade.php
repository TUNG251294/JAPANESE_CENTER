@extends('layouts.layout')
@section('Title', 'Register Course')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">Course Info</h3>
    <table class="table table-striped vertical" style="width: 50%;">
      <tr style="width: 50%">
        <th scope="col">NAME</th>
        <th scope="col">TEACHER</th>
        <th scope="col">LEVEL</th>
        <th scope="col">FEE</th>
        <th scope="col">OPENING DATE</th>
        <th scope="col">ENDING DATE</th>
        <th scope="col">TOTAL SESSION</th>
        <th scope="col">SCHEDULE DATE</th>
        <th scope="col">ESTIMATED STUDENT</th>
        <th scope="col">STATUS</th>
      </tr>
      <tr style="width: 50%">
        <td>{{ $course->name }}</td>
        <td>{{ $teacherName }}</td>
        <td>{{ $course->level->name }}</td>
        <td>{{ $course->fee }}</td>
        <td>{{ $course->opening_date }}</td>
        <td>{{ $course->ending_date }}</td>
        <td>{{ $course->total_session }}</td>
        <td>{{ $course->schedule_dates }}</td>
        <td>{{ $course->estimated_students }}</td>
        <td style="font-weight: bold; {{ statusColorStyle($course) }}">{{ $course->status }}</td>
      </tr>
    </table>
    <div class="row">
      <div class="col-3">
        <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('course_list') }}'"><i
            class="fa-solid fa-backward"></i> Back</button>
      </div>
      <div class="col-3">
        <form action="{{ route('register_course.custom', $course->id) }}" method="POST" id="register-course-form">
          @csrf
          <input type="hidden" name="course_id" value={{ $course->id }}>
          <input type="hidden" name="user_id" value={{ $account->id }}>
          <button class="btn btn-success float-end" type="button" onClick="registerCourseModal()">Register</button>
        </form>
      </div>
    </div>
  </main>

  @if (Session::has('success'))
    <script>
      Swal.fire({
        title: "Registered!",
        text: "{{ Session::get('success') }}",
        icon: "success"
      }).then(function() {
        location.reload();
        location.href = '/courses/list';
      })
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

<script src="{{ asset('js/registerCourseModal.js') }}"></script>
