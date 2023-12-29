@extends('layouts.layout')
@section('Title', 'Admin Info')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <h3 class="text-left">User Info</h3>
    <table class="table table-striped vertical">
      <tr style="width: 25%">
        <th scope="col">NAME</th>
        @hasanyrole('ADMIN|TEACHER')
          <th scope="col">EMAIL</th>
          <th scope="col">PHONE NUMBER</th>
        @endhasanyrole
        <th scope="col">GENDER</th>
        <th scope="col">BIRTHDAY</th>
        <th scope="col">ADDRESS</th>
        <th scope="col">HOMETOWN</th>
        <th scope="col">WORKPLACE</th>
      </tr>
      <tr style="width: 75%">
        <td>{{ $user->name }}</td>
        @hasanyrole('ADMIN|TEACHER')
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone_number }}</td>
        @endhasanyrole
        <td>{{ $user->gender }}</td>
        <td>{{ $user->birthday }}</td>
        <td>{{ $user->address }}</td>
        <td>{{ $user->hometown }}</td>
        <td>{{ $user->workplace }}</td>
      </tr>
    </table>
    <div>
      <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('admin_list') }}'"><i
          class="fa-solid fa-backward"></i> Back</button>
    </div>
  </main>
@endsection
