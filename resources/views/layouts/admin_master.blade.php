<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DEVHost | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/toastr.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/_all-skins.min.css') }}">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  >
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      .fc-event,
              .fc-event-dot {
              background-color:#fb3d3d;
              }
    </style>
  </head>
<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-yellow sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ asset('assets/index2.html') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>H</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DEV</b>Host</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            
            <ul class="dropdown-menu">
              
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('assets/images/user_icon.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">
           
              {{Auth::user()->name}}
              
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('assets/images/user_icon.png') }}" class="img-circle" alt="User Image">
                <p>
                {{Auth::user()->name}} - @if(Auth::user()->rank==1) Administrator @endif @if(Auth::user()->rank==2) User @endif
                  <small>Project To Do List </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <!-- <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div> -->
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('setup/profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header">MAIN NAVIGATION</li> -->
        <li class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
        <li class="{{ (request()->is('record/me')) ? 'active' : '' }}">
          <a href="{{url('record/me')}}">
            <i class="fa fa-file-text-o text-info"></i> <span>My To Do List</span>
            
          </a>
        </li>
        <li class="{{ (request()->is('project/list')) ? 'active' : '' }}">
          <a href="{{url('project/list')}}">
            <i class="fa fa-cubes text-info"></i> <span>Project List</span>
            
          </a>
        </li>
        
        <li class="{{ (Request::segment(1)=='setup') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>System Setup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          @if(Auth::user()->rank==1)
            <li class="{{ (request()->is('setup/companyinfo')) ? 'active' : '' }}">
              <a href="{{url('setup/companyinfo')}}"><i class="fa fa-info-circle"></i> Company Info(Contact)</a>
            </li>
            <li class="{{ (request()->is('setup/project')) ? 'active' : '' }}">
              <a href="{{url('setup/project')}}"><i class="fa fa-cube"></i> Project</a>
            </li>
            <li class="{{ (request()->is('setup/users')) ? 'active' : '' }}">
              <a href="{{url('setup/users')}}"><i class="fa fa-user"></i> Users</a>
            </li>
            <li class="{{ (request()->is('setup/profile')) ? 'active' : '' }}">
              <a href="{{url('setup/profile')}}"><i class="fa fa-credit-card"></i> Profile</a>
            </li>
            <li class="{{ (request()->is('setup/themes')) ? 'active' : '' }}">
              <a href="{{url('setup/themes')}}"><i class="fa fa-paint-brush"></i> Application Themes</a>
            </li>
            @endif
            @if(Auth::user()->rank==2)
            
            <li class="{{ (request()->is('setup/profile')) ? 'active' : '' }}">
              <a href="{{url('setup/profile')}}"><i class="fa fa-credit-card"></i> Profile</a>
            </li>
            <li class="{{ (request()->is('setup/themes')) ? 'active' : '' }}">
              <a href="{{url('setup/themes')}}"><i class="fa fa-paint-brush"></i> Application Themes</a>
            </li>
            @endif
          </ul>
        </li>
        <li><a href="{{route('logout')}}"><i class="fa fa-power-off text-danger"></i> <span>Singout</span></a></li>
        <hr>
        <!-- <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li><a href="{{url('admin/information')}}"><i class="fa fa-circle-o text-aqua"></i> <span>Information Dev</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
  @yield('content')
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2022 <a href="https://icgwebdevelopment.com" target="new">Lh@ICG</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
<script src="{{ asset('assets/dist/js/toastr.min.js') }}"></script>

@stack('scripts')
</body>
</html>
