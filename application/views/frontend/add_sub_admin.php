<style type="text/css">
   .rate_check{ color: orange;}
   .rate_check:hover{color: orange;}
   .remove_icon{ color: red;  display: none;}
</style>
<div class="wrapper" style="margin: 20px;">
   <div class="card border-0">
      <div class="card-body p-0">  
         <div class="container"> 
            <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_sub_admin_frm">
                <div class="row">
                  <div class="col-md-12">
                    <div class="wizard-left pr-0">
                      <div id="add_sub_admin_res"></div>
                      <div class="clearfix"></div>
                      <div class="row" id="add_story_data">
                        <div class="col-sm-6">
                          <div class="resort-option">
                             <div class="form-group">
                                <label for="exampleInputEmail1">
                                   Sub admin name 
                                </label>
                                <input type="text" name="hotel_name" class="form-control" value="<?php echo !empty($subadmin->first_name)?$subadmin->first_name:''; ?>" placeholder=" Sub admin name">
                             </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="resort-option">
                             <div class="form-group">
                                <label for="exampleInputEmail1">
                                   Email
                                </label>
                                <input type="text" name="email" class="form-control" value="<?php echo !empty($subadmin->email)?$subadmin->email:''; ?>" placeholder="Enter email">
                             </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="resort-option">
                             <div class="form-group">
                                <label for="exampleInputEmail1">
                                  Password
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" id="password1">
                             </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="resort-option">
                             <div class="form-group">
                                <label for="exampleInputEmail1">
                                  Confirm Password
                                </label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Enter confirm password">
                             </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center col-md-12"> 
                    <input type="hidden" name="admin_id" value="<?php echo !empty($subadmin->id)?$subadmin->id:'';?>">
                    <input type="hidden" name="old_email" value="<?php echo !empty($subadmin->email)?$subadmin->email:'';?>">
                    <button type="submit" class="btn-next">
                      Submit
                    </button>
                  </div>                  
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
  <script type="text/javascript">
   $('#add_sub_admin_frm').validate({
      rules: {
        hotel_name: {required: true},  
        email: {required: true, email:true, validEmail:true},
        <?php if(!empty($subadmin->id)){?>
          password: {minlength: 6},  
          confirm_password: {
                            equalTo: "#password1",
                          }, 
        <?php }else{?>
          password: {required: true, minlength: 6},  
          confirm_password: { required: true, 
                              equalTo: "#password1",
                            }, 
        <?php }?>      
      },
      messages: { 
        hotel_name:{ required:"The hotel name is required"},  
        email:{ required:"The email is required",
                email:"The email is invalid"
        },
        <?php if(!empty($subadmin->id)){?>
          password:{ 
            minlength:"The password field must be at least 6 characters in length"
          },
          confirm_password:{  
                            equalTo:"The passwords do not match",
                          },  
        <?php }else{?>
          password:{ 
            required:"The password is required", 
            minlength:"The password field must be at least 6 characters in length"
          },
          confirm_password:{ 
                            required:"The confirm password is required",
                            equalTo:"The passwords do not match",
                          },  
        <?php }?>            
      },
      submitHandler: function(form) {
        $.ajax({ 
          url:base_url+"user/add_sub_admin_res",
          type:"POST",
          data:$("#add_sub_admin_frm" ).serialize(), 
          success: function(html){
             var response = $.parseJSON(html); 
             if(response.type=='add'&&response.status=='true'){
                $('#add_sub_admin_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                $("#add_sub_admin_frm")[0].reset();
                setTimeout(function(){  
                  window.location.href ="<?php echo base_url('user/dashboard?type=sub_admin'); ?>"; 
                }, 1500);
             }else if(response.status=='true'){
               $('#add_sub_admin_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
               setTimeout(function(){  
                window.location.href ="<?php echo base_url('user/dashboard?type=sub_admin'); ?>"; 
              }, 1500);
             }else{ 
                $('#add_sub_admin_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
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
</script>
