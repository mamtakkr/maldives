<!-- Content Header (Page header) -->
<style type="text/css">
  .list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
    border: 1px solid #dad7d7;
    padding: 10px 0px 10px 10px;
    border-radius: 5px;
    min-height: 105px;
  }
  .main_module label { cursor: pointer; }
  input[type=checkbox], input[type=radio] {    
    margin-top: 1px\9;
    line-height: normal;
  } 
  .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.dropdown, .dropup{ border: 1px solid #dad7d7; padding-left: 10px; position: relative;; }
.tdrop .dropdown-menu .lang_d {
    width: 100%;
    display: inline-block;
    padding: 5px 8px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;}

 .dropdown-menu {
    padding: 0;
    max-width: 100%;
    width: 100%;}

    .dropdown-menu li {
    display: block;
}
.dropdown-menu li strong {
    padding: 8px 8px;
    display: block;
    background: #f1f1f1;
    font-size: 13px;
    text-transform: uppercase;}

   .dropdown-menu li strong img {
      width: 50px;
      margin: 0px 10px;
    }
.dropdown-menu li + li {
    border-top: 1px solid #ddd;
}
.dropdown a{ color: #000; }
</style>
<section class="content-header">
  <h1>
   <?php echo !empty($type)?$type:''; ?>       
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"><?php echo !empty($type)?$type:''; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
  <form action="" method="post" enctype="multipart/form-data">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border"> Login Details</div>
        <!-- /.box-header -->
        <!-- form start -->
          <?php 
            if(!empty($user->email)){
              echo '<input type="hidden" name="oldEmail" value="'.$user->email.'">';
            } 
            if(!empty($user->mobile)){
              echo '<input type="hidden" name="oldMobile" value="'.$user->mobile.'">';
            }  
            if(!empty($user->id)){
              echo '<input type="hidden" name="id" value="'.$user->id.'">';
            } 
          ?>    
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">
                First Name <span class="text-danger">*</span>
              </label>    
              <input type="text" placeholder="First Name" class="form-control" name="first_name" value="<?php if(set_value('first_name')){echo set_value('first_name');}elseif(!empty($user->first_name)){ echo $user->first_name;}   ?>" maxlength="50">
                 <?php echo form_error('first_name'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Last Name <span class="text-danger">*</span>
              </label>    
              <input type="text" placeholder="Last Name" class="form-control" name="last_name" value="<?php if(set_value('last_name')){echo set_value('last_name');}elseif(!empty($user->last_name)){ echo $user->last_name;}   ?>" maxlength="50">
                 <?php echo form_error('last_name'); ?>
            </div>            
            <div class="form-group">
              <label for="exampleInputEmail1">
                Email Address 1 <span class="text-danger">*</span>
              </label>                  
               <input type="text" placeholder="Email Address 1" class="form-control" name="email" value="<?php if(set_value('email')){echo set_value('email');}else{ if(!empty($user->email)){ echo $user->email;}}   ?>">
                <?php echo form_error('email'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Email Address 2
              </label>                  
               <input type="text" placeholder="Email Address 2" class="form-control" name="email_2" value="<?php if(set_value('email_2')){echo set_value('email_2');}else{ if(!empty($user->email_2)){ echo $user->email_2;}}   ?>">
                <?php echo form_error('email_2'); ?>
            </div>  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Password <span class="text-danger">*</span>
              </label>                  
               <input type="password" placeholder="Password" class="form-control" name="password" >
                <?php echo form_error('password'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Confirm Password <span class="text-danger">*</span>
              </label>                  
               <input type="password" placeholder="Confirm Password" class="form-control" name="confirm_password">
                <?php echo form_error('confirm_password'); ?>
            </div> 
            <div  style="padding-bottom: 10px;">
              <label for="exampleInputEmail1">
                Phone Number 1 <span class="text-danger">*</span>
              </label> 
              <div class="input-group">                
                <span class="input-group-addon" style="padding: 0;border: none;" id="basic-addon3">
                  <input type="text" placeholder="Country Code" class="form-control" name="country_code_phone_1" value="<?php if(set_value('country_code_phone_1')){echo set_value('country_code_phone_1');}elseif(!empty($user->country_code_phone_1)){ echo $user->country_code_phone_1;}else{echo '974';}?>" maxlength="5" style="width: 90px;">
                  <?php echo form_error('country_code_phone_1'); ?>
                </span>
                <input type="text" placeholder="Phone Number 1" class="form-control" name="mobile" value="<?php if(set_value('mobile')){echo set_value('mobile');}elseif(!empty($user->mobile)){ echo $user->mobile;}?>" maxlength="10">
                </div>             
                <?php echo form_error('mobile'); ?>
            </div>
            <div  style="padding-bottom: 0px;">
              <label for="exampleInputEmail1">
                Phone Number 2
              </label> 
              <div class="input-group">                
                <span class="input-group-addon" style="padding: 0;border: none;" id="basic-addon3">
                  <input type="text" placeholder="Country Code" class="form-control" name="country_code_phone_2" value="<?php if(set_value('country_code_phone_2')){echo set_value('country_code_phone_2');}elseif(!empty($user->country_code_phone_1)){ echo $user->country_code_phone_2;}else{echo '974';}?>" maxlength="5" style="width: 90px;">
                  <?php echo form_error('country_code_phone_2'); ?>
                </span>
                  <input type="text" placeholder="Phone Number 2" class="form-control" name="mobile_2" value="<?php if(set_value('mobile_2')){echo set_value('mobile_2');}elseif(!empty($user->mobile_2)){ echo $user->mobile_2;}?>" maxlength="10">
                <?php echo form_error('mobile_2'); ?>
                </div>         
            </div>  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Gender
              </label>         
              <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                <?php 
                if(set_value('gender')&&set_value('gender')=='male'){
                  echo '<option selected value="male">Male</option>';
                }elseif(!empty($user->gender)&&$user->gender=='male'){ 
                  echo '<option selected value="male">Male</option>';
                }else{
                  echo '<option value="male">Male</option>';
                }
                if(set_value('gender')&&set_value('gender')=='female'){
                  echo '<option selected value="male">Female</option>';
                }elseif(!empty($user->gender)&&$user->gender=='female'){ 
                  echo '<option selected value="male">Female</option>';
                }else{
                  echo '<option value="male">Female</option>';
                }?>                
              </select>
              <?php echo form_error('gender'); ?>
            </div>    
            <div class="form-group">
              <label for="exampleInputEmail1">
                Government ID Number
              </label>                  
              <input type="text" placeholder="Government ID Number" class="form-control" name="government_id_number" value="<?php if(set_value('government_id_number')){echo set_value('government_id_number');}elseif(!empty($user->government_id_number)){ echo $user->government_id_number;}?>" maxlength="50">
                <?php echo form_error('government_id_number'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Government ID Upload 
              </label>                  
              <input type="file" class="form-control" name="government_id_uploads[]" multiple="multiple">
              <?php echo form_error('government_id_uploads'); ?>
            </div>
            <div class="form-group">
              <?php 
                if(!empty($user->profile_pic)&&file_exists('uploads/users/'.$user->profile_pic)){
                  $profilePic = base_url('uploads/users/'.$user->profile_pic);
                  echo '<img src="'.$profilePic.'" width="150">';
                }
              ?>              
            </div>               
            <div class="form-group">
              <label for="exampleInputEmail1">
                Profile Image
              </label>     
              <input type="file" class="form-control" id="exampleInputFile" name="user_img"  >
                <?php 
                if(! form_error('user_img')) { ?>
                  <div class="note-msg">
                    Profile Image need to be atleast <font>100 x 100</font> pixels and maximum <font>2000 x 2000</font> pixels
                  </div>  
                <?php }else{  echo form_error('user_img'); } ?>
            </div>    
            <div class="form-group">
              <label for="exampleInputEmail1">
                Is this an individual or a family membership ?
              </label> <br/>               
              <input type="radio" name="membership" id="customRadioInline10" class="custom-control-input" value="1">
              <label class="custom-control-label" for="customRadioInline10">  Individual
              </label>
              <input type="radio" name="membership" id="customRadioInline20" class="custom-control-input" value="2">
                <label class="custom-control-label" for="customRadioInline20">Family
                </label>
            </div>     
            <div class="form-group">
              <label for="exampleInputEmail1">
                Will you be an active member of PGS programmes ?
              </label> <br/>               
              <input type="radio" id="PGSprogrammes1" name="PGSprogrammes" class="custom-control-input" value="1">
                <label class="custom-control-label" for="PGSprogrammes1">
                  Yes
                </label>
              <input type="radio" id="PGSprogrammes2" name="PGSprogrammes" class="custom-control-input" value="2">
                <label class="custom-control-label" for="PGSprogrammes2">
                  No
                </label>
            </div>  
            <div class="">                    
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input type='text' id="date_of_birth" name="date_of_birth" class="form-control" value="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" placeholder="yyyy-mm-dd"  onchange="calculateAge();"/>
                  <div id="date_of_birth_error" class="error"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="text" name="age" id="age" placeholder="Enter Age" value="18" class="form-control only_number" maxlength="2">
                  <div id="age_error" class="error"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Emergency Contact Name</label>
                  <input type="text" name="emergency_contact" placeholder="Emergency Contact" class="form-control"  id="emergency_contact">
                </div>
              </div>
              <div class="col-md-6">
                <div  style="padding-bottom: 0px;">
                  <label for="exampleInputEmail1">
                    Emergency Contact Phone
                  </label> 
                  <div class="input-group">                
                    <span class="input-group-addon" style="padding: 0;border: none;" id="basic-addon3">
                      <input type="text" placeholder="Country Code" class="form-control" name="emergency_contact_contry_code" value="<?php if(set_value('emergency_contact_contry_code')){echo set_value('emergency_contact_contry_code');}elseif(!empty($user->emergency_contact_contry_code)){ echo $user->emergency_contact_contry_code;}else{echo '974';}?>" maxlength="5" style="width: 90px;">
                      <?php echo form_error('emergency_contact_contry_code'); ?>
                    </span>
                      <input type="text" placeholder="Emergency Contact Phone" class="form-control" name="emergency_contact_2" value="<?php if(set_value('emergency_contact_2')){echo set_value('emergency_contact_2');}elseif(!empty($user->emergency_contact_2)){ echo $user->emergency_contact_2;}?>" maxlength="10">
                    <?php echo form_error('emergency_contact_2'); ?>
                    </div>         
                </div> 
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Do you have any Medical Condition that would impede you from participating in Sports Activities?
                    <sup>*
                    </sup>
                  </label>
                  <div class="col-6">
                    <input type="radio" name="medical_condition" value="1">
                      Yes
                  </div>
                  <div class="col-6">
                     <input type="radio" name="medical_condition" value="2">
                       No
                  </div>
                  <div class="col-md-11">
                    <div id="medical_condition_error" class="error"></div>
                  </div>
                </div>
                <div class="form-group specify_medical collapse" id="collapseExample3">
                  <label for="exampleInputEmail1">Please specify your Medical Condition
                  </label>
                  <textarea class="form-control" rows="3" placeholder="Medical Condition" name="medical_condition_desc"></textarea>
                </div>
              </div>
              <div class="col-md-11">
                <label for="exampleInputEmail1">Do you agree to 
                  <a href="<?php echo base_url('home/terms_and_conditions'); ?>">PSG Website Terms & Conditions
                  </a> ?
                  <Sup>*
                  </Sup>
                </label>
                <div class="check" style="margin-left:30px;">
                  <div class=""> 
                    <div class="">
                      <input type="radio" id="customRadioInline61" name="term_and_condition" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline61">
                          I agree
                        </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-11">
                <label for="exampleInputEmail1">Do you agree to PGS 
                  <a target="_blank" href="<?php echo base_url('home/safety_securty'); ?>">Safety / Security Waiver
                  </a>?                  
                </label>
                <div class="check" style="margin-left:30px;">
                  <div class="row">                           
                    <div class="">
                      <input type="radio" id="customRadioInline81" name="safety_securty" class="custom-control-input">
                      <label class="custom-control-label" for="customRadioInline81">I agree
                      </label>
                    </div>
                    <div class="col-md-11">
                      <div id="safety_securty_error" class="error"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-11">
                <label for="exampleInputEmail1">Agree to Photo/Video Publishing of material collected in sessions for
                </label>
                <div class="check" style="margin-left:30px;">
                  <div class="">
                    <div class="col-8">
                      <label for="exampleInputEmail1">Coach Education?
                        <sup>*
                        </sup>
                      </label>
                    </div>
                    <div class="col-4" style="margin-left:30px;">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline91" name="coach_education" class="custom-control-input" checked="checked" value="1">
                        <label class="custom-control-label" for="customRadioInline91">Yes
                        </label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline101" name="coach_education" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="customRadioInline101">No
                        </label>
                      </div>
                    </div>
                    <div class="col-md-11">
                      <div id="coach_education_error" class="error"></div>
                    </div>
                  </div>
                  <div class="">
                    <div class="col-8">
                      <label for="exampleInputEmail1">Student Education? 
                        <sup>*
                        </sup>
                      </label>
                    </div>
                    <div class="col-4" style="margin-left:30px;">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" checked="checked" id="customRadioInline111" name="student_education" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="customRadioInline111">Yes
                        </label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline121" name="student_education" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="customRadioInline121">No
                        </label>
                      </div>
                      <div id="student_education_error" class="error"></div>
                    </div>
                    <div class="col-md-11">
                      <div id="student_education_error" class="error"></div>
                    </div>
                  </div>
                  <div class="">
                    <div class="col-8">
                      <label for="exampleInputEmail1">Marketing / Promotional Material?
                        <sup>*
                        </sup>
                      </label>
                    </div>
                    <div class="col-4" style="margin-left:30px;">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline131" name="marketing_material" class="custom-control-input" checked="checked" value="1">
                        <label class="custom-control-label" for="customRadioInline131">Yes
                        </label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline141" name="marketing_material" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="customRadioInline141">No
                        </label>
                      </div>
                    </div>
                    <div class="col-md-11">
                      <div id="marketing_material_error" class="error"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="submit" value="submit">
          </div>
          <!-- /.box-body -->          
      </div>
      <!-- /.box -->
    </div>
    </div>
    <div class="clearfix"></div>
    <br/>
      <div class="box-footer">
        <button style="text-align: center;display: block;margin: 0em auto;padding: 9px 19px;" type="submit" class="btn btn-primary">
          <?php echo !empty($type)?$type:''; ?>          
        </button>
      </div>
    </form>
  </div>
  <!-- /.row -->
</section>   
<script type="text/javascript">
  function calculateAge(){
    var date_of_birth = $('#date_of_birth').val();
     $.ajax({ 
      url:base_url+"home/calculateAge",
      type:"POST",
      data:{"date_of_birth":date_of_birth}, 
      success: function(html){ 
        $('#age').val(html);
      }
    });
  }
</script>