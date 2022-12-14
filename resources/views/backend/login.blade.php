<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DEV Host | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    .login_textbox{
        border:none;
        border-bottom:1px solid #ddd;
    }
    .min-height{
        min-height:20vh;
    }
</style>
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    
    <a href=""><b>DEV</b>Host</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">User Login</p>

    <form action="{{route('admin.login')}}" method="post">
      @csrf
      <div class="form-group has-feedback" style="margin-top:10%;">
        <input type="text" class="form-control login_textbox" placeholder="User Name" name="username" @if(Cookie::has('username')) value="{{Cookie::get('username')}}" @endif>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
          <small>  
                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
          </small>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control login_textbox" id="login_password" placeholder="Password" name="password" @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif>
        <span class="input-group-btn" id="eyeSlash" style="float:right; padding-right:35px; z-index:1; margin-top:-32px;">
          <button class="btn btn-default reveal" style="border:none; background:none;" onclick="visibility3()" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
        </span>
        <span class="input-group-btn" id="eyeShow"  style="display: none; float:right; padding-right:35px; z-index:1; margin-top:-32px;">
          <button class="btn btn-default reveal" style="border:none; background:none;" onclick="visibility3()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
        </span>
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
       
        <small>  
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
          </small>
      </div>
      <div class="row min-height">
        <div class="col-xs-8" style="margin-top:10%;">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="remember" @if(Cookie::has('username')) checked @endif> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4" style="margin-top:10%;">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });

  function visibility3() {
  var x = document.getElementById('login_password');
  if (x.type === 'password') {
    x.type = "text";
    $('#eyeShow').show();
    $('#eyeSlash').hide();
  }else {
    x.type = "password";
    $('#eyeShow').hide();
    $('#eyeSlash').show();
  }
}
</script>
</body>
</html>
