@extends('layouts.layout')
@section('Title', 'Course List')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">Course List</h3>
    <table class="table table-striped" style="width: 100%">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NAME</th>
          @role('ADMIN')
            <th scope="col">MANAGE FEE</th>
          @endrole
          @hasanyrole('ADMIN|TEACHER')
            <th scope="col">MANAGE SESSION</th>
          @endhasanyrole
          <th scope="col">STATUS</th>
          @role('TEACHER')
            <th scope="col">REGISTER</th>
          @endrole
          @role('STUDENT')
            <th scope="col">REGISTER</th>
          @endrole
          @role('ADMIN')
            <th scope="col">UPDATE</th>
          @endrole
          <th scope="col">INFO</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($courses as $index => $course)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $course->name }}</td>
            @role('ADMIN')
              <td>
                <button class="btn {{ getManageFeeBtnColor($course) }}" type="button"
                  onclick="location.href='{{ route('create_receipt_fee', $course->id) }}'">Manage fee</button>
              </td>
            @endrole
            @hasanyrole('ADMIN|TEACHER')
              <td>
                <button class="btn {{ getManageSessionBtnColor($course) }}" type="button"
                  onclick="location.href='{{ route('show_manage_session', $course->id) }}'">Manage session</button>
              </td>
            @endhasanyrole
            <td style="font-weight: bold; {{ statusColorStyle($course) }}">{{ $course->status }}</td>
            @role('TEACHER')
              <td>
                <button class="btn {{ getTeacherRegisterStatus($course, $account)['class'] }} disabled"
                  type="button">{{ getTeacherRegisterStatus($course, $account)['value'] }}</button>
              </td>
            @endrole
            @role('STUDENT')
              <td>
                <button class="btn {{ getStudentRegisterStatus($course, $account)['class'] }}" type="button"
                  onclick="location.href='{{ route('register_course', $course->id) }}'">{{ getStudentRegisterStatus($course, $account)['value'] }}</button>
              </td>
            @endrole
            @role('ADMIN')
              <td>
                <button class="btn btn-success" type="button"
                  onclick="location.href='{{ route('edit_course', $course->id) }}'">Update</button>
              </td>
            @endrole
            <td>
              <button class="btn btn-primary" type="button"
                onclick="location.href='{{ route('course_info', $course->id) }}'">Info</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {!! $courses->links('pagination::bootstrap-5') !!}
  </main>
  @if (Session::has('success'))
    <script>
      Swal.fire({
        title: "Delete Success!",
        text: "{{ Session::get('success') }}",
        icon: 'success',
      }).then(function() {
        location.reload();
      })
    </script>
  @endif
@endsection
