<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo site_info('admin_title'); ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>plugins/iCheck/square/blue.css">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/front/img/favicon.png'); ?>"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .login-page, .register-page {
      background: url(<?php echo base_url(); ?>assets/admin/img/best-resorts-maldives-banner.jpg) ;
      }
      .login-box, .register-box {
        width: 100%;
        margin: 0 auto;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #000000a6;
        height: 100%;
    }
    .main_con {
        width: 360px;
        margin: 7% auto;
    }
    .login-logo b{ color: #fff; }
    .error{ color: red; }
    .has-feedback label~.form-control-feedback {
      top: 0px;
    }
    .btn-primary {
      background-color: #35C2BD !important;
      border-color: #35C2BD !important;
  }
  </style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="main_con">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>">
      <b><?php echo site_info('admin_title'); ?></b>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div id="log">
    <p class="login-box-msg">Sign in to start your session</p>
        <form  method="post" id="login_form" onsubmit="return false;">
          <div id="login_error_res"></div>
          <input  id="loginProcess" name="loginProcess" type="hidden" value="getUserLoggedIn">
          <div id="login_main">
            <div class="form-group">
              <div class="has-feedback">
                <input type="text" id="username" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div id="username_error" class="text-danger"></div>
            </div>
            <div class="form-group">
              <div class="has-feedback">
                <input type="password" id="password" name="password" placeholder="Password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div id="password_error" class="text-danger"></div>
            </div>          
            <div class="row">
              <!-- /.col -->
              <div class="col-xs-4 col-xs-offset-8">
                <button type="submit" id="login_btn" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <div id="forgot_password_main" class="hidden">
            <div class="form-group has-feedback">
              <input type="text" id="forgotEmail" name="forgotEmail" class="form-control" placeholder="Email">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              <div id="forgot_email_error" class="text-danger"></div>
            </div>
          </div>
        </form>
        
        <a href="javascript:void(0)"  id="forgot_password">
          I forgot my password
        </a>
    </div>
    <div id="forgot" class="form-wrapp animated fadeIn" style="display:none;">
            <h2 class="title-login">Forgot Password</h2>
            
            <div class="card">
               <div class="card-body">
                  <form onsubmit="return false;" id="forgot_password_login" method="post">
                     <div id="forgot_password_res"></div>
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group mb-3">
                              <label for="exampleInputPassword1">
                                 Email Address
                              </label>
                              <input type="text" name="forgot_email" class="form-control" placeholder="Enter Your Email Address">
                           </div>
                        </div>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                           Submit
                        </button>
                        <div class="clearfix"></div>
                         <a id="login_open" style="margin-top: 11px;" class="btn btn-primary btn-block new_login_btn" href="<?php echo base_url();?>admin/login">Login</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
  </div>
  <!-- /.login-box-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script type="text/javascript">
  var superadmin_url = "<?php echo ADMIN_URL; ?>"
  var base_url = "<?php echo base_url(); ?>"
</script>
<script src="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/front/js/jquery.validate.min.js"></script> 
<!-- iCheck -->
<script src="<?php echo  ADMIN_THEAM_PATH ;?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo  ADMIN_THEAM_PATH ;?>js/backend_js_validation.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
   $('#forgot_password').click(function(){
      $('#log').css("display" , "none");
      $('#forgot').css("display" , "block");
   });
   
   
   $('#forgot_password_login').validate({
      rules: {
         forgot_email: {required: true, email:true},
      },
      messages: {
         forgot_email:{ required:"The email is required", email:"The email is invalid"},
      },
      submitHandler: function(form) {
         $.ajax({ 
            url:base_url+"admin/login/sendForgotPasswordMailAdmin",
            type:"POST",
            data:$("#forgot_password_login" ).serialize(), 
            success: function(html){ 
               var response = $.parseJSON(html); 
               if(response.status=='true'){ 
                     $('#forgot_password_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                     setTimeout(function(){
                        location.reload();
                     }, 1000);
               }else{ 
                     $('#forgot_password_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });  
      }
    });
</script>
</body>
</html>
