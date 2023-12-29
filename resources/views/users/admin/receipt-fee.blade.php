@extends('layouts.layout')
@section('Title', 'Manage Fee')
@section('content')
  <main class="col bg-faded py-3 flex-grow-1">
    <div>
      <h2>Receipt Fee</h2>
      <form action="{{ route('store_receipt_fee', $course->id) }}" method="post">
        @csrf
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">PAY</th>
              <th scope="col">UNPAID</th>
              <th scope="col" style="display: none">COURSE_USER_ID</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($courseStudents as $key => $courseStudent)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $courseStudent->user->name }}</td>
                <td>{{ $courseStudent->user->email }}</td>
                <td><input name="courseStudent[{{ $key }}][is_fee]" type="radio" value=1 required
                    {{ isCheckedAttributeInPayFee($courseStudent) }}></td>
                <td><input name="courseStudent[{{ $key }}][is_fee]" type="radio" value=0 required
                    {{ isCheckedAttributeInUnpaidFee($courseStudent) }}></td>
                <td style="display: none"><input type="hidden" name='courseStudent[{{ $key }}][course_id]'
                    value={{ $courseStudent->course_id }}></td>
                <td style="display: none"><input type="hidden" name='courseStudent[{{ $key }}][user_id]'
                    value={{ $courseStudent->user_id }}></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-success float-end">Save</button>
      </form>
    </div>
    {!! $courseStudents->links('pagination::bootstrap-5') !!}
    <div>
      <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('course_list') }}'"><i
          class="fa-solid fa-backward"></i> Back</button>
    </div>
  </main>

  @if (Session::has('success'))
    <script>
      Swal.fire({
        title: "Update Success!",
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
        title: "Update Fail!",
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
