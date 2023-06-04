<div class="container-fluid">
   <div class="com-wrapper log">
      <div class="container text-center p-0">
         <div id="reset" class="form-wrapp animated fadeIn">
            <h2 class="title-login">Reset Passowrd</h2>
            <!--<div class="sign-option">Back to <a href="index.php">Home</a></div>-->
            <div class="card">
               <div class="card-body">
                  <div id="user_new_password_res"></div>
                  <form onsubmit="return false;" id="user_new_password" method="post">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group mb-3">
                              <label for="exampleInputPassword1">
                                 Set New Password
                              </label>
                              <input type="password" name="password" id="password1" class="form-control" placeholder="Set New Password">
                           </div>
                           <div class="form-group mb-3">
                              <label for="exampleInputPassword1">
                                 Confirm New Password
                              </label>
                              <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password">
                              <input type="hidden" name="user_token" value="<?php echo base64_encode($user->id);?>">
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
   $('#user_new_password').validate({
      rules: {
         password: {required: true, minlength: 6},   
         confirm_password: { required: true, 
                             equalTo: "#password1",
                           }, 
       },
      messages: { 
         password:{ required:"The password is required", 
                    minlength:"The password field must be at least 6 characters in length"},
         confirm_password:{  required:"The password is required",
                             equalTo:"The passwords do not match",
                           },
      },
      submitHandler: function(form) {      
         $.ajax({ 
            url:base_url+"home/reset_password_res",
            type:"POST",
            data:$( "#user_new_password" ).serialize(), 
            success: function(html){ 
               var response = $.parseJSON(html);  
               if(response.status=='true'){ 
                   $('#user_new_password')[0].reset();
                   $('#user_new_password_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                   setTimeout(function(){
                         window.location.href="<?php echo base_url(); ?>home/login";
                     }, 2000);      
               }else{ 
                  $('#user_new_password_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }
         }); 
      }
   });
</script>