<!-- Navbar -->
<nav class="navbar navbar-expand navbar-light navbar-white" style="background-color: #e3f2fd;">
  <!-- class="main-header" -->
  <div class="container">
    <!-- SEARCH FORM -->
    <div class="{{ $isSearchForm === true ? '' : 'd-none' }} col-6">
      <form class="ml-3" action="" method="get"> <!-- class="form-inline" -->
        <div class="input-group input-group-lg">
          <input class="form-control" placeholder="Search by name" aria-label="Search" name="searchKey"
            value="{{ $searchKey }}"> <!-- class="form-control-navbar" -->
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
