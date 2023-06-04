<div class="tab-pane fade" id="user_profile" role="tabpanel" aria-labelledby="user_profile-tab">
   <div class="dashboard-wrapper">
      <div class="resort-title-card">
         <div class="row">
            <div class="col-sm-12">
               <h6>Profile</h6>
               <div class="clearfix"></div>
               <div class="new_profit col-lg-5 col-md-5 col-12 m-auto">
               <!--<div class="profile-left">-->
               <div class="only_profie_edit">
                  <div class="user-profile">
                     <?php
                     if(!empty($user->profile_pic) && file_exists('uploads/resorts/thumbnails/150_'.$user->profile_pic)){
                       $profilePic = base_url('uploads/resorts/thumbnails/150_'.$user->profile_pic);
                     }else{
                       $profilePic = base_url('assets/front/images/No_Image_Available.jpg');
                     }?>                                       
                     <img src="<?php echo $profilePic;?>" id="user_profile_image">
                  </div>
                  <a  class="edit_profie_new" href="javascript:void(0)" onclick="setUploadProfile();">
                     <i class="fa fa-camera"></i> Change Picture
                  </a>
                  <input type="file" id="user_profile_pic" onchange="uploadProfile();" class="hidden">
                  <div id="logo_file_type_error"></div>
                </div>  
               <!--</div>-->
               <!--<div class="profile-right">-->
                  <div class="card-body pl-0 pr-0">
                     <form onsubmit="return false;" id="user_signup" method="post">
                        <div id="user_signup_res"></div>
                        <!--<div class="row">-->
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="exampleInputPassword1">Hotel Name</label>
                                 <input type="text" name="hotel_name" class="form-control" placeholder="Enter Here" value="<?php echo !empty($user->first_name)?$user->first_name:'';?>">
                                 <input type="hidden" name="user_type" value="">
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="exampleInputPassword1">Email</label>
                                 <input type="text" class="form-control" readonly="readonly" value="<?php echo !empty($user->email)?$user->email:'';?>">
                              </div>
                           </div>
                        <!--</div>-->
                        <div class="clearfix"></div>
                        <div class="col-12">
                        <div class="text-left mt-3">
                           <button type="submit" class="btn btn-primary">
                              Update Profile
                           </button>
                           <div class="clearfix"></div>
                        </div>
                        </div>
                     </form>
                  </div>
               <!--</div>-->
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<div class="tab-pane fade" id="user_setting" role="tabpanel" aria-labelledby="user_setting-tab">
   <div class="dashboard-wrapper">
      <div class="resort-title-card">
         <div class="row">
            <div class="col-sm-12">
               <h6> Setting</h6>      
               <div class="clearfix"></div>
               <div class="card-body pr-0 pl-0">
                  <div id="change_password_res"></div>
                  <form id="change_password_frm" onsubmit="return false;" method="post">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="exampleInputPassword1">Old Password</label>
                              <input type="password" name="old_password" id="old_password" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="exampleInputPassword1">New Password</label>
                              <input type="password" name="new_password" id="new_password" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="exampleInputPassword1">Confirm Password</label>
                              <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                           </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12">
                           <div class="text-left mt-3">
                              <button type="submit" class="btn btn-primary">
                                 Change Password
                              </button>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div> 