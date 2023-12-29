@extends('layouts.layout')
@section('Title', 'Attendance')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    @php
      $days = getEnableScheduleDates($course->schedule_dates);
      $courseUserLength = count($courseStudents);
    @endphp
    <div>
      <h2>Attendance Form</h2>
      <div class="row py-2">
        <div class="col-md-2 col-md-3" style="max-width: 200px">
          <label for="attendanceDate" class="col-form-label text-md pb-0">ATTENDANCE DATE:</label>
        </div>
        <div class="col-md-2 col-md-3 px-0 flatpickr">
          <input name="attendanceDate" id="attendanceDate" type="date" class="form-control"
            onchange="changeAttendanceDate(this)" value="{{ date('Y-m-d') }}">
        </div>
      </div>

      <form action="{{ route('store_attendance') }}" method="post">
        @csrf
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">PRESENT</th>
              <th scope="col">ABSENT</th>
              <th scope="col" style="display: none">COURSE_USER_ID</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courseStudents as $key => $courseUser)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $courseUser->user->name }}</td>
                <td>{{ $courseUser->user->email }}</td>
                <td><input name="courseUser[{{ $key }}][is_present]" type="radio" value=1 required></td>
                <td><input name="courseUser[{{ $key }}][is_present]" type="radio" value=0 required></td>
                <td style="display: none"><input type="hidden" name='courseUser[{{ $key }}][course_user_id]'
                    value={{ $courseUser->id }}></td>
                <td style="display: none"><input type="hidden" name='courseUser[{{ $key }}][attendance_date]'
                    id={{ $key + 1 }} value="{{ date('Y-m-d') }}"></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>

    {!! $courseStudents->links('pagination::bootstrap-5') !!}
    <hr>
    <div class="row">
      <div class="col-6">
        <button type="button" class="btn btn-secondary"
          onclick="location.href='{{ route('show_personal_courses') }}'"><i class="fa-solid fa-backward"></i>
          Back</button>
      </div>
      <div class="col-6">
        <form action="{{ route('end_course') }}" method="POST" id="end-course-form">
          @csrf
          <input type="hidden" name="id" value="{{ $course->id }}">
          <button class="btn btn-danger float-end" type="button" onclick="endCourseModal({{ $course->id }})">End
            course!</button>
        </form>
      </div>
    </div>
  </main>

  @if (Session::has('success'))
    <script>
      Swal.fire({
        title: "Attendance Success!",
        text: "{{ Session::get('success') }}",
        icon: 'success',
      })
    </script>
  @endif
  @if (Session::has('error'))
    <script>
      Swal.fire({
        title: "Attendance Fail!",
        text: "{{ Session::get('error') }}",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
      })
    </script>
  @endif
  @if (Session::has('endCourseSuccess'))
    <script>
      Swal.fire({
        title: "Operation Success!",
        text: "{{ Session::get('endCourseSuccess') }}",
        icon: 'success',
      })
    </script>
  @endif
  @if (Session::has('endCourseError'))
    <script>
      Swal.fire({
        title: "Operation Fail!",
        text: "{{ Session::get('endCourseError') }}",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK"
      })
    </script>
  @endif
@endsection

@push('script')
  <script>
    flatpickr("input[type=date]", {
      dateFormat: "Y-m-d",
      minDate: "{{ $course->opening_date }}",
      maxDate: "{{ $course->ending_date }}",
      disable: [
        function(date) {
          return (date.getDay() === {{ $days['mon'] }} || date.getDay() === {{ $days['tue'] }} || date
            .getDay() === {{ $days['wed'] }} || date.getDay() === {{ $days['thu'] }} ||
            date.getDay() === {{ $days['fri'] }} || date.getDay() === {{ $days['sat'] }} || date.getDay() ===
            {{ $days['sun'] }});
        }
      ],
      locale: {
        "firstDayOfWeek": 1
      }
    });
  </script>
@endpush
<script type="text/javascript">
  function changeAttendanceDate(selectedDate) {
    for (var i = 1; i <= {{ $courseUserLength }}; i++) {
      var attendanceDate = document.getElementById(i);
      attendanceDate.value = selectedDate.value;
    }
  }
</script>

<script src="{{ asset('js/endCourseModal.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
