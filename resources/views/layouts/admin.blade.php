<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.scss') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="side-menu-wrapper">
        <div class="nav-side-menu">
            <div class="brand">
            </div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                        <a href="{{'/'}}">
        <i class="fa fa-dashboard fa-lg"></i> Dashboard
      </a>
    </li>
    <li data-toggle="collapse" data-target="#student" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-graduation-cap fa-lg"></i> Student <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="student">
      <li>
        <a href='/'> 'New Student', new_admin_student</a>
      </li>
      <li>
        <a href='/'> 'Student Lists', admin_students</a>
      </li>
      <li>
        <a href='/'> 'Assign Course', '' </a>
      </li>
    </ul>
    <li data-toggle="collapse" data-target="#events" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-user fa-lg"></i> Teacher <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="events">
      <li>
        <a href='/'> 'New Teacher', new_admin_teacher</a>
      </li>
      <li>
        <a href='/'> 'Teacher Lists', admin_teachers</a>
      </li>
      <li>
        <a href='/'> 'Assign Course', assign_course_admin_teachers</a>
      </li>
    </ul>
    <li data-toggle="collapse" data-target="#department" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-building-o fa-lg"></i> Department <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="department">
      <li>
        <a href='/'> 'New Department', new_admin_department</a>
      </li>
      <li>
        <a href='/'> 'Department Lists', admin_departments</a>
      </li>
    </ul>
    <li data-toggle="collapse" data-target="#course" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-book fa-lg"></i> Course <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="course">
      <li>
        <a href='/'> 'New Course', new_admin_course</a>
      </li>
      <li>
        <a href='/'> 'Course Lists', admin_courses</a>
      </li>
      <li>
        <a href='/'> 'Assign Student', new_admin_course</a>
      </li>
      <li>
        <a href='/'> 'Assign Teacher', '' </a>
      </li>
    </ul>
    <li data-toggle="collapse" data-target="#semester" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-address-book-o fa-lg"></i> Semester <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="semester">
      <li>
        <a href='/'> 'New Semester', new_admin_semester</a>
      </li>
      <li>
        <a href='/'> 'Semester Lists', admin_semesters</a>
      </li>
    </ul>

    <li data-toggle="collapse" data-target="#semester_registrations" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-sellsy fa-lg"></i> Semester Registrations <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="semester_registrations">
      <li>
        <a href='/'> 'New Semester Registration', new_admin_semester_registration</a>
      </li>
      <li>
        <a href='/'> 'Semester Registration Lists', admin_semester_registrations</a>
      </li>
    </ul>

    <li>
      <a href='/'>
          <i class="fa fa-registered fa-lg"></i> Course Registration
      </a>
    </li>

    <li data-toggle="collapse" data-target="#share" class="collapsed">
      <a href="javascript:void(0)">
        <i class="fa fa-rebel fa-lg"></i> Result <span class="arrow"></span>
      </a>
    </li>
    <ul class="sub-menu collapse" id="share">
      <li>
        <a href='/'> 'New Semester', new_admin_semester</a>
      </li>
      <li>
        <a href='/'> 'Semester Lists', admin_semesters</a>
      </li>
    </ul>

    <li>
      <a href="destroy_user_session">
        <i class="fa fa-sign-out fa-lg"></i> Logout
      </a>
    </li>
  </ul>
</div>
        </div>
    </div>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
