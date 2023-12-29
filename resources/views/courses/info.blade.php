@extends('layouts.layout')
@section('Title', 'Course Info')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">Course Info</h3>
    <table class="table table-striped vertical">
      <tr style="width: 25%">
        <th scope="col">NAME</th>
        <th scope="col">TEACHER</th>
        <th scope="col">LEVEL</th>
        <th scope="col">FEE</th>
        <th scope="col">OPENING DATE</th>
        <th scope="col">ENDING DATE</th>
        <th scope="col">SCHEDULE DATE</th>
        <th scope="col">TOTAL SESSION</th>
        <th scope="col">ACTUAL STUDENT</th>
        <th scope="col">ESTIMATED STUDENT</th>
        <th scope="col">STATUS</th>
      </tr>
      <tr style="width: 75%">
        <td>{{ $course->name }}</td>
        <td>{{ $teacherName }}</td>
        <td>{{ $course->level->name }}</td>
        <td>{{ $course->fee }}</td>
        <td>{{ $course->opening_date }}</td>
        <td>{{ $course->ending_date }}</td>
        <td>{{ $course->schedule_dates }}</td>
        <td>{{ $course->total_session }}</td>
        <td>{{ $course->actual_students }}</td>
        <td>{{ $course->estimated_students }}</td>
        <td style="font-weight: bold; {{ statusColorStyle($course) }}">{{ $course->status }}</td>
      </tr>
    </table>
    <div>
      <button type="button" class="btn btn-secondary" onclick="getBackPageRoute()"><i class="fa-solid fa-backward"></i>
        Back</button>
    </div>
  </main>
@endsection

<script src="{{ asset('js/getBackPageRoute.js') }}"></script>
