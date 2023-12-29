@extends('layouts.layout')
@section('Title', 'Admin List')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <div>
      <h2>Admin List</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">NAME</th>
            @role('ADMIN')
              <th scope="col">UPDATE</th>
              <th scope="col">DELETE</th>
            @endrole
            <th scope="col">INFO</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $index => $user)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $user->name }}</td>
              @role('ADMIN')
                <td>
                  <button class="btn btn-success" type="button"
                    onclick="location.href='{{ route('edit_admin', $user->id) }}'">Update</button>
                </td>
                <td>
                  <button class="btn btn-danger" type="button" onclick="deleteModal({{ $user->id }})">DELETE</button>
                </td>
              @endrole
              <form action="{{ route('delete_user') }}" method="POST" id="{{ $user->id }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
              </form>
              <td>
                <button class="btn btn-primary" type="button"
                  onclick="location.href='{{ route('admin_info', $user->id) }}'">Info</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {!! $admins->links('pagination::bootstrap-5') !!}
    </div>
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
  @if (Session::has('error'))
    <script>
      Swal.fire({
        title: "Delete Fail!",
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

<script src="{{ asset('js/deleteModal.js') }}"></script>
