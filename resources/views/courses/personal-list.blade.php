@extends('layouts.layout')
@section('Title', 'Your Course')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">Your Course</h3>
    <table class="table table-striped" style="width: 100%">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          @role('TEACHER')
            <th scope="col">ATTENDANCE</th>
          @endrole
          <th scope="col">STATUS</th>
          <th scope="col">INFO</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($courses as $index => $course)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $course->name }}</td>
            @role('TEACHER')
              <td>
                <button class="btn {{ getAttendanceBtnColor($course) }}" type="button"
                  onclick="location.href='{{ route('create_attendance', $course->id) }}'">Attendance</button>
              </td>
            @endrole
            <td style="font-weight: bold; {{ statusColorStyle($course) }}">{{ $course->status }}</td>
            <td>
              <button class="btn btn-primary" type="button"
                onclick="location.href='{{ route('personal.course_info', $course->id) }}'">Info</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {!! $courses->links('pagination::bootstrap-5') !!}
  </main>

  @if (Session::has('error'))
    <script>
      Swal.fire({
        title: "Direct Fail!",
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
