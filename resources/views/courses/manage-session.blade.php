@extends('layouts.layout')
@section('Title', 'Manage session')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <div>
      <h2>Manage Session</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            <th scope="col">EMAIL</th>
            <th scope="col">PRESENT SESSION</th>
            <th scope="col">TOTAL SESSION</th>
            <th scope="col">RATE (%)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($attendances as $index => $attendance)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $attendance->courseUser->user->name }}</td>
              <td>{{ $attendance->courseUser->user->email }}</td>
              <td>{{ $attendance->present_count }}</td>
              <td>{{ $attendance->courseUser->course->total_session }}</td>
              <td>{{ $attendance->courseUser->session->rate ?? 'None' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {!! $attendances->links('pagination::bootstrap-5') !!}
    <div>
      <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('course_list') }}'"><i
          class="fa-solid fa-backward"></i> Back</button>
    </div>
  </main>
@endsection
