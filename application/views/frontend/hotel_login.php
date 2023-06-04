<link href="<?php echo  FRONT_THEAM_PATH ;?>css/login.css" rel="stylesheet" type="text/css">
<meta name="google-signin-client_id" content="343479563417-831d7gi7hr5ohi8q8ab7adadcov8os0r.apps.googleusercontent.com">
<div class="container-fluid bg1">
   <div class="com-wrapper log">
      <div class="container text-center p-0">
         <div id="log" class="form-wrapp animated fadeIn">
            <h2 class="title-login">Login</h2>
            <div class="sign-option">Not registered yet? <a id="sign_open" href="javascript:void(0);">Sign Up Now</a></div>
            <div class="card">
               <div class="login-with">
                  <div >
                     <a class="login-with-facebook" href="javascript:void(0);">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/fb.png" alt="facebook" /> Login with Facebook</a>     
                  </div>
                  <div >
                     
                  <a class="login-with-google g-signin2 w-100"  data-onsuccess="onSignIn"  data-onfailure="onSignInFailure">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/google.png" alt="google" /> Login with Google</a>     
                        
                  </div>
               </div>
               <div class="or"><span>OR</span></div>
               <div class="card-body">
                  <form onsubmit="return false;" id="user_login" method="post">
                     <div id="user_login_res"><?php msg_alert(); ?></div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" aria-describedby="emailHelp" placeholder="Enter Email">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                     </div>                     
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">
                           Submit
                        </button>
                        <div class="clearfix"></div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="text-center">
               <a href="javascript:void(0);" id="forgot_password" class="fp">Forgot your password?</a>
            </div>
         </div>
         <div id="sign" class="form-wrapp animated fadeIn w570">
            <h2 class="title-login">Sign Up</h2>
            <div class="sign-option">Already have an account? <a id="log_open" href="javascript:void(0);">Login</a></div>
            <form onsubmit="return false;" id="user_signup" method="post">
              <div class="card">
                 <div class="card-body">                  
                       <div id="user_signup_res"></div>
                       <div class="form-group">
                          <label for="exampleInputPassword1">Hotel Name</label>
                          <input type="text" name="hotel_name" class="form-control" placeholder="Enter Here">
                          <input type="hidden" name="user_type" value="<?php echo !empty($user_type)?$user_type:''; ?>">
                          <input type="hidden" name="country_id" value="134"> 
                          <!-- Maldives country code -->
                       </div>
                       <div class="form-group">
                          <label for="exampleInputPassword1">Email</label>
                          <input type="text" name="email" class="form-control" placeholder="Enter Here">
                       </div>
                       <div class="row">
                          <div class="col-sm-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="password1" placeholder="Password">
                             </div>
                          </div>
                          <div class="col-sm-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                             </div>
                          </div>
                       </div>
                       <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck100" value="1">
                            <label class="custom-control-label" for="customCheck100">By creating an account, I am agreeing to the Maldives Experts <a href="<?php echo base_url('term_and_services'); ?>" target="_blank" class="fp fp mb-0">Terms of Service</a> and <a href="<?php echo base_url('privacy_policy'); ?>" class="fp mb-0">Privacy Policy</a>.</label>
                          </div>
                          <input type="hidden" name="term_and_condition" id="term_and_condition">
                        </div>
                       <div class="text-center">
                          <button type="submit" class="btn btn-primary btn-block">
                             Submit
                          </button>                          
                          <div class="clearfix"></div>
                       </div>                    
                 </div>
              </div>
            </form>
         </div>
         <div id="forgot" class="form-wrapp animated fadeIn">
            <h2 class="title-login">Forgot Password</h2>
            <div class="sign-option">Back to <a id="login_open" href="javascript:void(0);">Login</a></div>
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
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    function check_terms(){
      var check_terms = $('#customCheck100').prop("checked");
      $('#term_and_condition-error').hide();
      console.log('check_terms = '+check_terms);
      if(check_terms == true){
        $('#term_and_condition').val("yes");
      }else{
        $('#term_and_condition').val('');
      }
    }
    $('#sign_open').click(function(){
      $('#sign').css("display" , "block");
      $('#log').css("display" , "none");
   });
   $('#log_open').click(function(){
      $('#sign').css("display" , "none");
      $('#log').css("display" , "block");
   });
   $('#forgot_password').click(function(){
      $('#log').css("display" , "none");
      $('#forgot').css("display" , "block");
   });
   $('#login_open').click(function(){
      $('#log').css("display" , "block");
      $('#forgot').css("display" , "none");
   }); 
   $('#user_signup').validate({
      ignore: "not:hidden",
      rules: {
         hotel_name: {required: true},
         email: {required: true, email:true, validEmail:true},
         password: {required: true, minlength: 6},   
         term_and_condition: {required: true},   
         confirm_password: { required: true, 
                             equalTo: "#password1",
                           }, 
       },
      messages: { 
        hotel_name:{ required:"The hotel name is required"},
        email:{ required:"The email is required",
                 email:"The email is invalid"
        },
        password:{ 
          required:"The password is required", 
          minlength:"The password field must be at least 6 characters in length"
        },
        term_and_condition:{  required:"Terms Of Service And Privacy Policy don't check",},
        confirm_password:{  required:"The password is required",
                             equalTo:"The passwords do not match",
                           },
      },
      submitHandler: function(form) {      
         $.ajax({ 
            url:base_url+"home/signup_res",
            type:"POST",
            data:$( "#user_signup" ).serialize(), 
            success: function(html){ 
               var response = $.parseJSON(html);  
               if(response.status=='true'){ 
                   $('#user_signup')[0].reset();
                   $('#user_signup_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');        
               }else{ 
                  $('#user_signup_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }
         }); 
      }
   });
   $.validator.addMethod("validEmail", 
      function(value, element) {  
         if(value==''){
            return true;
         }else{        
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(value);
         }
      }, "The email is invalid"
   );
   $('#user_login').validate({
      rules: {
         user_name: {required: true},
         password: {required: true},
      },
      messages: {
         user_name:{ required:"The username is required"},
         password:{ required:"The password is required"},
      },
      submitHandler: function(form) {
         $.ajax({ 
             url:base_url+"home/login_res",
             type:"POST",
             data:$("#user_login" ).serialize(), 
             success: function(html){ 
                // alert('res');
                 var response = $.parseJSON(html); 
                 if(response.status=='true'){ 
                     $('#user_login_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                     setTimeout(function(){
                         window.location.href="<?php echo base_url(); ?>user/dashboard";
                     }, 1000);
                 }else{ 
                     $('#user_login_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                 }
             }                
         });  
      }
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
            url:base_url+"home/sendForgotPasswordMail",
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
    function fb_password_link(){
        $('#user_login').hide();
        $('#fb_password_login').show();
        $('#login_mian_title').html('Forgot Password');
    }
    function login_link(){
        $('#user_login').show();
        $('#fb_password_login').hide();
        $('#login_mian_title').html('Login');
    }
    $('input[type="checkbox"]').click(function(){
        $('#term_and_condition-error').hide();
        if($(this).prop("checked") == true){
            console.log("Checkbox is checked.");
             $('#term_and_condition').val("yes");            
        }else if($(this).prop("checked") == false){
            console.log("Checkbox is unchecked.");
             $('#term_and_condition').val("");
        }
    });
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
  <script type="text/javascript"> 
  function onSignIn(googleUser) {
	signOut();
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  $.ajax({
			 url: "<?php echo base_url('home/gmail_login'); ?>",
			 type:'POST',
			 data:{google_id:profile.getId(),url:profile.getImageUrl(),name:profile.getName(),email:profile.getEmail(),'page_url':"<?php echo base_url('google_login'); ?>"},
			 success: function(result){ 
				 if(result=='blocked'){
				$('#login_error_res').show().html('Your account was banned from using the platform and maldives experts. If you believe this has occurred in error, please contact contato@maldivesexperts.com');
			  }else {
				var login_page_status = $('#login_page_status').val();
				if(login_page_status=='yes'){
				  var locationsDW      = $('#locationsDW').val();
				  window.location.href = locationsDW;
				}else{
				  location.reload();
				}
			  }
		   }
		 }); 
}
 function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>