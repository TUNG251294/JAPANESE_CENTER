<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('Title')</title>
  {{-- AdminLTE --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
  {{-- Font Awesome CDN --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- sweetalert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  {{-- flatpickr --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  {{-- jQuery --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/course-info-table.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.css') }}">
</head>

<body>
  <div class="container-fluid">
    <div class="row" style="height: 100vh;">
      <div class="col-lg-2 col-12 col-md-2 col-sm-4">
        @include('layouts.sidebar')
      </div>
      <div class="col-lg-10 col-12 col-md-10 col-sm-8">
        <div>
          @include('layouts.navbar')
        </div>
        <div class="container py-3">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  @stack('script')
  <script src="{{ asset('js/sidebar.js') }}"></script>
  <script src="{{ asset('bootstrap-5.2.3-dist/js/bootstrap.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  {{-- flatpickr --}}
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>
