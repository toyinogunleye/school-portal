 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('public/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('public/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ url('public/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

      <span class="brand-text font-weight-light">Prima School</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @if(Auth::user()->user_type == 1)
            <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Admin
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Teachers
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('admin/student/list')}}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Students
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{url('admin/parent/list')}}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Parents
              </p>
            </a>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'class-subject' || Request::segment(2) == 'assign-class-teacher' || Request::segment(2) == 'class-timetable') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'class-subject' || Request::segment(2) == 'assign-class-teacher' || Request::segment(2) == 'class-timetable') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Academics
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="{{url('admin/class/list')}}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <li class="nav-item">
               <a href="{{url('admin/class-subject/list')}}" class="nav-link @if(Request::segment(2) == 'class-subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Class Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/assign-class-teacher/list')}}" class="nav-link @if(Request::segment(2) == 'assign-class-teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Class Teacher</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{url('admin/class-timetable/list')}}" class="nav-link @if(Request::segment(2) == 'class-timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Timetable</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'communicate') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Communicate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                 <a href="{{url('admin/communicate/notice-board')}}" class="nav-link @if(Request::segment(3) == 'notice-board') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>

              <li class="nav-item">
                 <a href="{{url('admin/communicate/send-email')}}" class="nav-link @if(Request::segment(3) == 'send-email') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send Email</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                 <a href="{{url('admin/homework/homework')}}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework List</p>
                </a>
              </li>

              <li class="nav-item">
                 <a href="{{url('admin/homework/homework-report')}}" class="nav-link @if(Request::segment(3) == 'homework-report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework Reports</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'examination') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'examination') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Examination
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                 <a href="{{url('admin/examination/exam-list')}}" class="nav-link @if(Request::segment(3) == 'exam-list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam List</p>
                </a>
              </li>

              <li class="nav-item">
                 <a href="{{url('admin/examination/exam-schedule')}}" class="nav-link @if(Request::segment(3) == 'exam-schedule') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Schedules</p>
                </a>
              </li>

              <li class="nav-item">
                 <a href="{{url('admin/examination/mark-register')}}" class="nav-link @if(Request::segment(3) == 'mark-register') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Register</p>
                </a>
              </li>


            </ul>
          </li>


          <li class="nav-item">
            <a href="{{url('admin/change-password')}}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Change Password
              </p>
            </a>
          </li>


            @elseif (Auth::user()->user_type == 2)

             <li class="nav-item">
            <a href="{{url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('teacher/my-account')}}" class="nav-link @if(Request::segment(2) == 'my-account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('teacher/my-student')}}" class="nav-link @if(Request::segment(2) == 'my-student') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Students
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('teacher/my-class-subject')}}" class="nav-link @if(Request::segment(2) == 'my-class-subject') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Class & Subject
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('teacher/notice-board')}}" class="nav-link @if(Request::segment(2) == 'notice-board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Notice Board
              </p>
            </a>
          </li>

            <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                 <a href="{{url('teacher/homework-list')}}" class="nav-link @if(Request::segment(2) == 'homework-list') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework List</p>
                </a>
              </li>

              {{-- <li class="nav-item">
                 <a href="{{url('teacher/homework/submitted-homework')}}" class="nav-link @if(Request::segment(2) == 'submitted-homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Submitted Homeworks</p>
                </a>
              </li> --}}

            </ul>
          </li>

           <li class="nav-item">
            <a href="{{url('teacher/exam-timetable')}}" class="nav-link @if(Request::segment(2) == 'exam-timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Exam Timetable
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('teacher/change-password')}}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Change Password
              </p>
            </a>
          </li>

            @elseif (Auth::user()->user_type == 3)
             <li class="nav-item">
            <a href="{{url('student/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('student/my-account')}}" class="nav-link @if(Request::segment(2) == 'my-account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Profile
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('student/my-subject')}}" class="nav-link @if(Request::segment(2) == 'my-subject') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Subjects
              </p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{url('student/my-homework')}}" class="nav-link @if(Request::segment(2) == 'my-homework') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Homework
              </p>
            </a>
          </li> --}}

           <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                 <a href="{{url('student/my-homework')}}" class="nav-link @if(Request::segment(2) == 'my-homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Homework</p>
                </a>
              </li>


              <li class="nav-item">
                 <a href="{{url('student/homework/my-submitted-homework')}}" class="nav-link @if(Request::segment(2) == 'my-submitted-homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Submitted Homework</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item">
            <a href="{{url('student/notice-board')}}" class="nav-link @if(Request::segment(2) == 'notice-board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Notice Board
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('student/exam-timetable')}}" class="nav-link @if(Request::segment(2) == 'exam-timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Exam Timetable
              </p>
            </a>
          </li>


           <li class="nav-item">
            <a href="{{url('student/change-password')}}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Change Password
              </p>
            </a>
          </li>


            @elseif (Auth::user()->user_type == 4)
             <li class="nav-item">
            <a href="{{url('parent/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('parent/my-account')}}" class="nav-link @if(Request::segment(2) == 'my-account') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('parent/my-student')}}" class="nav-link @if(Request::segment(2) == 'my-student') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              My Student
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('parent/notice-board')}}" class="nav-link @if(Request::segment(2) == 'notice-board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
             My Notice Board
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{url('parent/my-student-notice-board')}}" class="nav-link @if(Request::segment(2) == 'my-student-notice-board') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
             My Student Notice Board
              </p>
            </a>
          </li>
{{--
           <li class="nav-item">
            <a href="{{url('parent/exam-timetable')}}" class="nav-link @if(Request::segment(2) == 'exam-timetable') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Exam Timetable
              </p>
            </a>
          </li> --}}



           <li class="nav-item">
            <a href="{{url('parent/change-password')}}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
              Change Password
              </p>
            </a>
          </li>
            @endif


          <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
              Logout
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
