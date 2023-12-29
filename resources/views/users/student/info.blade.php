@extends('layouts.layout')
@section('Title', 'Student Info')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">User Info</h3>
    @php
      $role = $account->getRoleNames()->first();
    @endphp
    <table class="table table-striped vertical">
      <tr style="width: 25%">
        <th scope="col">NAME</th>
        <th scope="col">LEVEL</th>
        @hasanyrole('ADMIN|TEACHER')
          <th scope="col">EMAIL</th>
          <th scope="col">PHONE NUMBER</th>
        @endhasanyrole
        <th scope="col">GENDER</th>
        <th scope="col">BIRTHDAY</th>
        <th scope="col">ADDRESS</th>
        <th scope="col">HOMETOWN</th>
      </tr>
      <tr style="width: 75%">
        <td>{{ $user->name }}</td>
        <td>{{ $user->level->name }}</td>
        @hasanyrole('ADMIN|TEACHER')
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone_number }}</td>
        @endhasanyrole
        <td>{{ $user->gender }}</td>
        <td>{{ $user->birthday }}</td>
        <td>{{ $user->address }}</td>
        <td>{{ $user->hometown }}</td>
      </tr>
    </table>
    <div>
      <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('student_list') }}'"><i
          class="fa-solid fa-backward"></i> Back</button>
    </div>
  </main>
@endsection
