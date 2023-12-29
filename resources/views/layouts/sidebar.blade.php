<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ml-sm-auto d-none d-md-block bg-dark">
  <!-- Brand Logo -->
  <div class="ml-2 py-2 pl-2">
    <a href="{{ route('course_list') }}" class="brand-link">
      <img src="{{ asset('images/logo.png') }}" alt="NIHONGO" class="brand-image img-circle elevation-3"
        style="opacity: 1;">
      <span class="brand-text font-weight-light text-white">NIHONGO</span>
    </a>
  </div>

  <!-- Sidebar -->
  <div class="sidebar mx-3" id="sidebar">
    <div class="user-panel my-2 ml-2 pl-2 pb-3 d-flex">
      <a href="#" class="nav-link text-white">
        <i class="fa-solid fa-user-tie fa-xl mr-2" style="color: #539dfd;"></i>
        <span>
          {{ $account->name }}
          {{-- <span class="right badge badge-danger">New</span> --}}
        </span>
      </a>
    </div>
    <div class="user-panel my-2 ml-2 py-2 pl-2 d-flex" id='div_update_account'>
      <a href="{{ route('edit_account') }}" class="nav-link text-white">
        <i class="fa-solid fa-pen-to-square fa-xl mr-2" style="color: #539dfd;"></i>
        <span>
          Update Account
        </span>
      </a>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#course_menu" data-bs-toggle="collapse" class="nav-link align-middle text-white"
            id="courseManagement">
            <i class="fa-solid fa-book-open fa-xl mr-2" style="color: #539dfd;"></i>
            <p>
              Course Management
              <i class="right fa-solid fa-angle-left" id="downListIcon1"></i>
            </p>
          </a>
          <ul class="collapse nav flex-column ms-1 text-white" id="course_menu">

            <li class="nav-item" style="width:100%">
              <a href="{{ route('course_list') }}" class="nav-link text-white" id="link_course_list">
                <i class="fa-solid fa-circle fa-xs"></i>
                <p>Course List</p>
              </a>
            </li>
            @hasanyrole('TEACHER|STUDENT')
              <li class="nav-item" style="width:100%">
                <a href="{{ route('show_personal_courses') }}" class="nav-link text-white" id="link_personal_course">
                  <i class="fa-solid fa-circle fa-xs"></i>
                  <p>Your Course</p>
                </a>
              </li>
            @endhasanyrole
            @role('ADMIN')
              <li class="nav-item">
                <a href="{{ route('create_course') }}" class="nav-link text-white" id="link_create_course">
                  <i class="fa-solid fa-circle fa-xs"></i>
                  <p>Create Course</p>
                </a>
              </li>
            @endrole
          </ul>
        </li>
      </ul>

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
        <li class="nav-item menu-open">
          <a href="#user_menu" data-bs-toggle="collapse" class="nav-link align-middle text-white" id="userManagement">
            <i class="fa-solid fa-users fa-xl mr-2" style="color: #539dfd;"></i>
            <p>
              User Management
              <i class="right fa-solid fa-angle-left" id="downListIcon2"></i>
            </p>
          </a>
          <ul class="collapse nav flex-column ms-1" id="user_menu">
            <li class="nav-item" style="width:100%">
              <a href="{{ route('admin_list') }}" class="nav-link text-white" id="link_admin_list">
                <i class="fa-solid fa-circle fa-xs"></i>
                <p>Admin List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('teacher_list') }}" class="nav-link text-white" id="link_teacher_list">
                <i class="fa-solid fa-circle fa-xs"></i>
                <p>Teacher List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('student_list') }}" class="nav-link text-white" id="link_student_list">
                <i class="fa-solid fa-circle fa-xs"></i>
                <p>Student List</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      @hasanyrole('ADMIN|TEACHER')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
          <li class="nav-item menu-open">
            <a href="#create_menu" data-bs-toggle="collapse" class="nav-link align-middle text-white" id="userCreation">
              <i class="fa-solid fa-user-plus fa-xl mr-2" style="color: #539dfd;"></i>
              <p>
                Creation
                <i class="right fa-solid fa-angle-left" id="downListIcon3"></i>
              </p>
            </a>
            <ul class="collapse nav flex-column ms-1" id="create_menu">
              @role('ADMIN')
                <li class="nav-item" style="width:100%">
                  <a href="{{ route('create_admin') }}" class="nav-link text-white" id="link_create_admin">
                    <i class="fa-solid fa-circle fa-xs"></i>
                    <p>Create Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('create_teacher') }}" class="nav-link text-white" id="link_create_teacher">
                    <i class="fa-solid fa-circle fa-xs"></i>
                    <p>Create Teacher</p>
                  </a>
                </li>
              @endhasanyrole
              <li class="nav-item">
                <a href="{{ route('create_student') }}" class="nav-link text-white" id="link_create_student">
                  <i class="fa-solid fa-circle fa-xs"></i>
                  <p>Create Student</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      @endrole
    </nav>
  </div>
</aside>
