<link href="<?php echo  FRONT_THEAM_PATH ;?>css/login.css" rel="stylesheet" type="text/css">


<meta name="google-signin-client_id" content="343479563417-831d7gi7hr5ohi8q8ab7adadcov8os0r.apps.googleusercontent.com">
<div class="container-fluid bg1">
<div class="marquee-overlay"></div>
   <div class="com-wrapper log">
      <div class="container text-center p-0">
         <div id="log" class="form-wrapp animated fadeIn">
            <h2 class="title-login">Login</h2>
            <div class="sign-option">Not registered yet? <a id="sign_open" href="javascript:void(0);">Sign Up Now</a></div>
            <div class="card">
               <div class="login-with">
               <div class="row">
                  <div class="col-md-12">
                     <a onclick="fblogin_user();" class="login-with-facebook" href="javascript:void(0);">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/fb.png" alt="facebook" /> Login with Facebook</a>     
                  </div>
				   
                      <div class="col-md-12">
                     <a class="login-with-google g-signin2 w-100"  data-onsuccess="onSignIn"  data-onfailure="onSignInFailure">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/google.png" alt="google" /> Login with Google</a>     
                  </div> 
                  </div>
				  <!--<div >
                     <a class="login-with-google" href="javascript:void(0);" onclick="googleLogin();">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>img/google.png" alt="google" /> Login with Google</a>     
                  </div>-->
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
                    <?php 
                    if($this->input->get('type')&&$this->input->get('type')=='resort_like'){?>
                       <input type="hidden" name="activity_type" value="resort_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('resort_id'))?$this->input->get('resort_id'):""; ?>">
                    <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='blog_like'){?>
                       <input type="hidden" name="activity_type" value="blog_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('blog_id'))?$this->input->get('blog_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='blog_comment'){?>
                       <input type="hidden" name="activity_type" value="blog_comment">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('blog_id'))?$this->input->get('blog_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='accommodation_like'){?>
                       <input type="hidden" name="activity_type" value="accommodation_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('accommodation_id'))?$this->input->get('accommodation_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='dinning_like'){?>
                       <input type="hidden" name="activity_type" value="dinning_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('dinning_id'))?$this->input->get('dinning_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='traveller_story_like'){?>
                       <input type="hidden" name="activity_type" value="traveller_story_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('story_id'))?$this->input->get('story_id'):""; ?>">
                     <?php   
                 	}else if($this->input->get('type')&&$this->input->get('type')=='resort_story_like'){?>
                       <input type="hidden" name="activity_type" value="resort_story_like">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('story_id'))?$this->input->get('story_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='traveller_story_comment'){?>
                       <input type="hidden" name="activity_type" value="traveller_story_comment">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('story_id'))?$this->input->get('story_id'):""; ?>">
                     <?php 
                 	}else if($this->input->get('type')&&$this->input->get('type')=='resort_story_comment'){?>
                       <input type="hidden" name="activity_type" value="resort_story_comment">
                       <input type="hidden" name="activity_id" value="<?php echo !empty($this->input->get('story_id'))?$this->input->get('story_id'):""; ?>">
                     <?php 
                  }?>
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
                       <div class="row">
                          <div class="col-sm-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter Here">
                                <input type="hidden" name="user_type" value="<?php echo !empty($user_type)?$user_type:''; ?>">
                             </div>
                          </div>
                          <div class="col-sm-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Here">
                             </div>
                          </div>
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
                          <label for="exampleInputPassword1">Country</label>
                          <select name="country_id" id="country_id" class="form-control">
                            <option value="">Select Country</option>
                            <?php 
                            if(!empty($countrys)){
                              foreach($countrys as $country){
                                echo '<option value="'.$country->id.'">'.$country->country_name.'</option>';
                              }
                            }
                            ?>
                          </select>
                       </div>
                       <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="customCheck100" value="1">
                          <label class="custom-control-label" for="customCheck100">By creating an account, I am agreeing to the Maldives Experts <a href="<?php echo base_url('term_and_services'); ?>" target="_blank" class="fp fp mb-0">Terms of Service</a> and <a href="<?php echo base_url('privacy_policy'); ?>" target="_blank" class="fp mb-0">Privacy Policy</a>.</label>
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
                     <div class="text-center pull_right">
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
      $('#term_and_condition-error').hide();
      if($(this).prop("checked") == true){
        $('#term_and_condition').val("yes");
      }else{
        $('#term_and_condition').val('');
      }
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
         first_name: {required: true},
         last_name: {required: true},
         country_id: {required: true},
         term_and_condition: {required: true},
         email: {required: true, email:true, validEmail:true},
         password: {required: true, minlength: 6},   
         confirm_password: { required: true, 
                             equalTo: "#password1",
                           }, 
       },
      messages: { 
        first_name:{ required:"The first name is required"},
        term_and_condition:{  required:"Terms Of Service And Privacy Policy don't check",},
        last_name:{ required:"The last name is required"},
        country_id:{ required:"The country is required"},
        email:{ required:"The email is required",
                 email:"The email is invalid"
        },
        password:{ 
          required:"The password is required", 
          minlength:"The password field must be at least 6 characters in length"
        },
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
                  $('#term_and_condition').val('');
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
                     	if(response.redirect_url){
                     		window.location.href="<?php echo base_url();?>"+response.redirect_url;
                     	}else{                     		
	                        <?php 
	                        if($this->input->get('type')&&$this->input->get('type')=='add_story'){
	                          echo 'window.location.href="'.base_url().'user/add_story?type=add_story&resort_id='.$this->input->get('resort_id').'"';
	                        }else if($this->input->get('type')&&$this->input->get('type')=='story_list'){
                            echo 'window.location.href="'.base_url().'user/dashboard?type=story_list"';
                          }else{
	                          echo 'window.location.href="'.base_url('user/dashboard').'"';
	                        }
	                        ?>                         
                     	}
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
</script>
<div id="fb-root"></div>
<script type="text/javascript">
      /*1966888920265725*/
      window.fbAsyncInit = function() { 
          FB.init({
              appId:'392901375606436', cookie:true,
              status:true, xfbml:true,oauth : true
          });
      };
      (function(d){
      var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = " https://connect.facebook.net/en_US/all.js";
      ref.parentNode.insertBefore(js, ref);
    }(document));

  //facebook login function
  function fblogin_user() {
     
      FB.login(function(response) {
      if (response.authResponse) 
      {

        FB.api('/me?fields=id,name,email,picture.width(250).height(250)', function(response) {            
          var email = response.email
          var fb_id = response.id;
          var name = response.name;
          var url = response.picture.data.url;        
            $.ajax({
              url: "<?php echo base_url('home/fb_login'); ?>",
              type:'POST',
              data:{url:url,name:name,email:email,fb_id:fb_id},
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
        });
      } 
      else 
      {
        console.log('User cancelled login or did not fully authorize.');
      }
    }, {scope: 'email'});
  }
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
<!--  <script type="text/javascript"> 

  function googleLogin() {
    var myParams = {
      'clientid' : '343479563417-831d7gi7hr5ohi8q8ab7adadcov8os0r.apps.googleusercontent.com',
      'cookiepolicy' : 'single_host_origin',
      'callback' : 'loginCallback',
      'approvalprompt':'force',
      'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
    };
    gapi.auth.signIn(myParams);
  }
   
  function loginCallback(result)
  {
    console.log(result);
    console.log(' status signed_in = '+result['status']['signed_in']); 
      if(result['status']['signed_in']){
          var request = gapi.client.plus.people.get(
          {
              'userId': 'me'
          });
          request.execute(function (resp)
          {
              var email = '';
              if(resp['emails'])
              {
                  for(i = 0; i < resp['emails'].length; i++)
                  {
                      if(resp['emails'][i]['type'] == 'account')
                      {
                          email = resp['emails'][i]['value'];
                      }
                  }
              }         
             // alert(' email = '+email);   
              $.ajax({
                url: "<?php echo base_url('home/gmail_login'); ?>",
                type:'POST',
                data:{url:resp['image']['url'],name:resp['displayName'],email:email,'page_url':resp['url']},
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
          });   
      }  
  }
  function onLoadCallback()
  {
     /* gapi.client.setApiKey('AIzaSyDImb2sTqlogp_j217RIQck74G9PrT4LTc');*/
      gapi.client.setApiKey('AIzaSyCswsEqPI8Xfbctqne8Eq3Wd6xGSGM-eT8');
      gapi.client.load('plus', 'v1',function(){});
  } 
  </script> -->  
  <script type="text/javascript">
        (function() {
         var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
         po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
         var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
       })();
  </script> 