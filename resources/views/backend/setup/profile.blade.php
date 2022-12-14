<!-- Content Wrapper. Contains page content -->
@extends('layouts.admin_master')
@section('title','Setup')
@section('heading','Setup')
@section('nav','User Profile')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      @yield('heading')
        <small>@yield('nav')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> @yield('heading')</a></li>
        <li class="active"> @yield('nav')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <p><b>System Administration Panel </b>:: You can change Name, Email and Password.</p>
      </div>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/images/user_icon.png') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">@if(Auth::user()->rank==1) Administrator @endif @if(Auth::user()->rank==2) User @endif</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{Auth::user()->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Created Date</b> <a class="pull-right">{{date('d-M-Y', strtotime(Auth::user()->created_at));}}</a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right">Active</a>
                </li>
              </ul>

              <a href="{{route('logout')}}" class="btn btn-danger btn-block"><b>Logout</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Edit Profile</a></li>
              <li><a href="#timeline" data-toggle="tab">Change Password</a></li>
             
            </ul>
            <div class="tab-content" style="min-height:325px;">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block" style="padding-top:10%;">
                  <form class="form-horizontal" method="post" id="editform">
                    @csrf
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Your Name</label>
                      <div class="col-sm-10">
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <input type="text" class="form-control" id="" name="name" value='{{Auth::user()->name}}'>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="" name="email" value='{{Auth::user()->email}}'>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-2 control-label">Login Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="username" value='{{Auth::user()->username}}'>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="editprofile">Update <i class="fa fa-refresh"></i></button>
                      </div>
                    </div>
                  </form>
                  </div>
                  
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <div class="user-block" style="padding-top:10%;">
                <form class="form-horizontal" method="post" id="passwordform">
                    @csrf
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Current Password</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <input type="password" class="form-control" id="" name="currentPassword">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="" name="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-sm-3 control-label">Confirm Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="" name="confirmPassword">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="changePassword">Change  <i class="fa fa-refresh"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.tab-pane -->

              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @push('scripts')
  <script>
  $(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    $('#editprofile').click(function (e) {
      e.preventDefault();
      //$(this).html('Sending..');
      $.ajax({
        data: $('#editform').serialize(),
        url: "{{ url('setup/editProfile') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#editform').trigger("reset");
        
            toastr.success(data.success);
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 5;
              toastr.error(value);
            });
          }
          //console.log('Error:', data);
          //$('#editprofile').html('Save Error');
        }
      });
    });

    $('#changePassword').click(function (e) {
      e.preventDefault();
      //$(this).html('Sending..');
      $.ajax({
        data: $('#passwordform').serialize(),
        url: "{{ url('setup/changePassword') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#passwordform').trigger("reset");
            if(data.error){
              toastr.error(data.error);
            }
            else{
              toastr.success(data.success);
            }
            
        },
        error: function (data) {
          if (data.status == 422) { 
            $.each(data.responseJSON.errors, function(key, value){
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 5;
              toastr.error(value);
            });
          }
          //console.log('Error:', data);
          //$('#editprofile').html('Save Error');
        }
      });
    });
   
  });
  
</script>
@endpush