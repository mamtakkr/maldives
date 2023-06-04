<!--<link href="https://www.maldivesexperts.com/assets/front/css/style.css" rel="stylesheet" type="text/css">
<link href="https://www.maldivesexperts.com/assets/front/css/dev.css" rel="stylesheet" type="text/css">-->
<form class="wizard-container new_resoret new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_2">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left">
            <h6>Step 2: Resort Information</h6>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Resort Affiliation<span class="text-danger"></span></label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="resort_affiliation">
                           <option value="">Select Affiliation</option>
                           <?php
                           if(!empty($affiliations)){
                              foreach ($affiliations as $affiliation) {
                                 if(!empty($row->resort_affiliation)&&$row->resort_affiliation==$affiliation->id){
                                    echo '<option selected value="'.$affiliation->id.'">'.$affiliation->affiliation_name.'</option>';
                                 }else{
                                    echo '<option value="'.$affiliation->id.'">'.$affiliation->affiliation_name.'</option>';
                                 }
                              }
                           }
                           ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> Star Category <span class="text-danger">*</span></label>
                        <select class="custom-select mr-sm-2" id="resort_category" name="resort_category">
                           <option value="">Select Category</option>
                           <?php
                           if(!empty($categorys)){
                              foreach ($categorys as $category) {
                                 if(!empty($row->resort_category)&&$row->resort_category==$category->id){
                                    echo '<option selected value="'.$category->id.'">'.$category->category_name.'</option>';
                                 }else{
                                    echo '<option value="'.$category->id.'">'.$category->category_name.'</option>';
                                 }
                              }
                           }
                           ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group mb-3">
                        <label for="exampleInputEmail1">Contact details<span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" placeholder="Contact Name" name="contact_name" value="<?php if(!empty($row->contact_name)){ echo $row->contact_name;}?>">
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-transparent" id="basic-addon1">+960</span>
                           </div>
                           <input type="text" class="form-control" placeholder="Phone number" value="<?php if(!empty($row->contact_number)){ echo $row->contact_number;}?>" name="contact_number" maxlength="15">
                        </div>
                        <input type="text" class="form-control mb-3" placeholder="Email" name="contact_email" value="<?php if(!empty($row->contact_email)){ echo $row->contact_email;}?>">
                        <input type="text" name="contact_website" value="<?php if(!empty($row->contact_website)){ echo $row->contact_website;}?>" class="form-control mb-3" placeholder="Website URL">
                     </div>
                  </div>
               </div> 
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group mb-3">
                        <label for="exampleInputEmail1"> 
                           Transfer modes From International airport <span class="text-danger">*</span>
                        </label>
                        <?php 
                        if(!empty($airports)){
                           foreach($airports as $airport){
                              $checkAirport = $this->common_model->get_row('international_airports', array('resort_id'=>$row->id, 'airport_type'=>$airport->id));?>
                              <div class="modes">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="tick">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" name="airports[]" id="customCheck<?php echo !empty($airport->id)?$airport->id:'';?>" value="<?php echo !empty($airport->id)?$airport->id:'';?>" <?php if(!empty($checkAirport->check_option)&&$checkAirport->check_option==1){echo 'checked';} ?> multiple="multiple" onclick="customCheck('<?php echo !empty($airport->id)?$airport->id:'';?>');">
                                             <label class="custom-control-label" for="customCheck<?php echo !empty($airport->id)?$airport->id:'';?>">
                                                <?php
                                                echo !empty($airport->airport_type_name)?$airport->airport_type_name:'';
                                                ?>
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="row">
                                       
									  <?php if(!empty($airport->id) && $airport->id==3){ ?>
									  <div class="col-sm-12">
                                          <select id="hour1_<?php echo !empty($airport->id)?$airport->id:''; ?>" name="hour1_<?php echo !empty($airport->id)?$airport->id:''; ?>" class="form-control <?php if(empty($checkAirport->check_option)){echo 'hide_cl';} ?>" onchange="select_minut('1_<?php echo !empty($airport->id)?$airport->id:''; ?>');">
                                                <option value="">Hours</option>
                                                <?php 
                                                for($hr=1; $hr<100;$hr++){
                                                   if(!empty($checkAirport->hour1)&&$checkAirport->hour1==$hr){
                                                      echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                                   }else{
                                                      echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                                   }
                                                }
                                                ?>
                                             </select>
                                             <div class="text-danger minuts_error" id="hour1_error_1_<?php echo !empty($airport->id)?$airport->id:''; ?>"></div>
                                      </div>
									  	   <div class="col-sm-12">
									     <select id="minuts1_<?php echo !empty($airport->id)?$airport->id:''; ?>" name="minuts1_<?php echo !empty($airport->id)?$airport->id:''; ?>" class="form-control <?php if(empty($checkAirport->check_option)){echo 'hide_cl';} ?>" onchange="select_minut('1_<?php echo !empty($airport->id)?$airport->id:''; ?>');">
                                                <option value="">Minutes</option>
                                                <?php 
                                                for($hr=1; $hr<100;$hr++){
                                                   if(!empty($checkAirport->minuts1)&&$checkAirport->minuts1==$hr){
                                                      echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                                   }else{
                                                      echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                                   }
                                                }
                                                ?>
                                             </select>
                                             <div class="text-danger minuts_error" id="minuts_error_1_<?php echo !empty($airport->id)?$airport->id:''; ?>"></div>
											  </div>
									  <?php }else{?>
									   <div class="col-sm-12">
									     <select id="minuts1_<?php echo !empty($airport->id)?$airport->id:''; ?>" name="minuts1_<?php echo !empty($airport->id)?$airport->id:''; ?>" class="form-control <?php if(empty($checkAirport->check_option)){echo 'hide_cl';} ?>" onchange="select_minut('1_<?php echo !empty($airport->id)?$airport->id:''; ?>');">
                                                <option value="">Minutes</option>
                                                <?php 
                                                for($hr=1; $hr<100;$hr++){
                                                   if(!empty($checkAirport->minuts1)&&$checkAirport->minuts1==$hr){
                                                      echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                                   }else{
                                                      echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                                   }
                                                }
                                                ?>
                                             </select>
                                             <div class="text-danger minuts_error" id="minuts_error_1_<?php echo !empty($airport->id)?$airport->id:''; ?>"></div>
											  </div>
																		 
									  <?php 
                                       if(!empty($airport->airport_type) && $airport->airport_type>1){?>
                                       <div class="col-sm-12">
                                       <select id="minuts2_<?php echo !empty($airport->id)?$airport->id:''; ?>" name="minuts2_<?php echo !empty($airport->id)?$airport->id:''; ?>" class="form-control <?php if(empty($checkAirport->check_option)){echo 'hide_cl';} ?>" onchange="select_minut('2_<?php echo !empty($airport->id)?$airport->id:''; ?>');">
                                          <option value="">Minutes</option>
                                          <?php 
                                          for($hr=1; $hr<100;$hr++){
                                             if(!empty($checkAirport->minuts2)&&$checkAirport->minuts2==$hr){
                                                echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                             }else{
                                                echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                             }
                                          }
                                          ?>
                                       </select>
                                       <div class="text-danger minuts_error" id="minuts_error_2_<?php echo !empty($airport->id)?$airport->id:''; ?>"></div>
                                       </div>
                                       <?php
						   }}?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <?php 
                           }
                        }
                        ?> 
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Size of the Island (In kms) <span class="text-danger">*</span></label>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group mb-3">
                                 <input type="text" name="island_size_length" value="<?php if(!empty($row->island_size_length)){ echo $row->island_size_length;}?>" class="form-control only_number" placeholder="Length (kms)" maxlength="5">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <input type="text" name="island_size_width" value="<?php if(!empty($row->island_size_width)){ echo $row->island_size_width;}?>" class="form-control only_number" placeholder="Width (kms)" maxlength="5">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>              
            </div>
         </div>
      </div>
      <div class="col-md-12">         
        <div class="respot_form"> 
         <div class="col-sm-12">
            <div class="resort-option">
               <div class="form-group">
                  <label for="exampleInputEmail1">
                     Total no. of Villas <span class="text-danger">*</span>
                  </label>
                  <input type="text" name="total_no_villas" value="<?php if(!empty($row->total_no_villas)){ echo $row->total_no_villas;}?>" class="form-control only_number" placeholder="Enter total no. of unit" maxlength="4" id="total_no_villas" onkeydown="hide_messsage();">
                  <input type="hidden" name="total_no_villas_vaild" value="">
               </div>
            </div>
         </div>     
         <div class="clearfix"></div>                                     
         <div class="col-sm-12">
            <table class="table">
               <?php 
               if(!empty($villa_types)){
                  foreach($villa_types as $villa_type){
                     $checkVillaType = $this->common_model->get_row('villas', array('resort_id'=>$row->id, 'villas_type'=>$villa_type->id));?>
                     <tr>
                        <th width="150">
                           <label>
                              <?php 
                              if($villa_type->villa_type=='Other'){?>
                                 <input type="text" name="villa_type_other_label" style="width:150px;" value="<?php if(!empty($checkVillaType->villa_name)){ echo $checkVillaType->villa_name;}else{echo 'Other';}?>" class="form-control" placeholder="Enter Other" style="display: none;" id="villa_type_other_label" style="width:150px">
                                 <span id="villa_type_other_label_t">
                                    <?php if(!empty($checkVillaType->villa_name)){ echo $checkVillaType->villa_name;}else{echo 'Other';}?>
                                 </span>
                                 <a href="javascript:void(0);" onclick="villa_type_other_label();" id="villa_type_other_label_t_link">
                                    <i class="fa fa-pencil"></i>
                                 </a>
                              <?php 
                              }else{
                                 echo $villa_type->villa_type; 
                              }
                              ?>
                           </label>
                        </th> 
                        <td width="150">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="tick">
                                    <div class="custom-control custom-radio">
                                       <input type="radio" id="villa_counter_status_1_<?php echo $villa_type->id; ?>" name="villa_counter_status_<?php echo $villa_type->id; ?>" class="custom-control-input" value="1" onclick="villa_counter_status('<?php echo $villa_type->id; ?>', '1');" <?php if(!empty($checkVillaType->villa_counter_status)&&$checkVillaType->villa_counter_status==1){ echo 'checked';}?>>
                                       <label class="custom-control-label" for="villa_counter_status_1_<?php echo $villa_type->id; ?>">Yes </label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="tick">
                                    <div class="custom-control custom-radio">
                                       <input type="radio" id="villa_counter_status_2_<?php echo $villa_type->id; ?>" name="villa_counter_status_<?php echo $villa_type->id; ?>" class="custom-control-input" value="2" onclick="villa_counter_status('<?php echo $villa_type->id; ?>', '2');" <?php if(!empty($checkVillaType->villa_counter_status)&&$checkVillaType->villa_counter_status==2){ echo 'checked';}?>>
                                       <label class="custom-control-label" for="villa_counter_status_2_<?php echo $villa_type->id; ?>">No</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <td width="150">
                           <div  id="villa_counter_<?php echo $villa_type->id; ?>" style="<?php if(!empty($checkVillaType->villa_counter_status)&&$checkVillaType->villa_counter_status==1){ echo 'display: block;';}else{echo 'display: none;';}?>">
                              <input type="text" name="villa_counter_<?php echo $villa_type->id; ?>" value="<?php if(!empty($checkVillaType->villas_type_counter)){ echo $checkVillaType->villas_type_counter;}?>" class="form-control only_number" maxlength="4" placeholder="Enter No. of units" onchange="select_villa_counter('<?php echo $villa_type->id; ?>');" onkeydown="hide_messsage();" id="villa_counter_val_<?php echo $villa_type->id; ?>">
                              <div id="villa_counter_error_<?php echo $villa_type->id; ?>" class="villa_counter_error error"></div>
                           </div>
                        </td>             
                     </tr>
                  <?php 
                  }
               }
               ?>                                                
            </table>
         </div>               
         <div class="col-sm-12">
            <div class="resort-option">
               <div class="form-group">
                  <label for="exampleInputEmail1">
                     Meal plans available <span class="text-danger">*</span>
                  </label>
                  <div class="row">
                     <?php 
                     $resortMeals = array();
                     if(!empty($row->meal_plans)){
                        $resortMeals = explode(',', $row->meal_plans);
                     }
                     if(!empty($meal_plans)){
                        foreach($meal_plans as $meal_plan){?>
                           <div class="col-sm-6">
                              <div class="tick">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="meal_plans[]" class="custom-control-input" id="customCheck_meal_plan_<?php echo $meal_plan->id ?>" value="<?php echo $meal_plan->id ?>" <?php if(in_array($meal_plan->id, $resortMeals)){echo 'checked';} ?>>
                                    <label class="custom-control-label" for="customCheck_meal_plan_<?php echo $meal_plan->id ?>">
                                       <?php echo $meal_plan->meal_plans_name ?>
                                    </label>
                                 </div>
                              </div>
                           </div>
                        <?php 
                        }
                     }
                     ?>  
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="resort-option">
               <div class="form-group">
                  <label for="exampleInputEmail1">
                     Can guests fly Drones? <span class="text-danger">*</span>
                  </label>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="tick">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="guests_fly_drones1" name="guests_fly_drones" class="custom-control-input" value="1" <?php if(!empty($row->guests_fly_drones)&&$row->guests_fly_drones==1){ echo 'checked';}?>>
                                 <label class="custom-control-label" for="guests_fly_drones1">Yes </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="tick">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="guests_fly_drones2" name="guests_fly_drones" class="custom-control-input" value="2" <?php if(!empty($row->guests_fly_drones)&&$row->guests_fly_drones==2){ echo 'checked';}?>>
                                 <label class="custom-control-label" for="guests_fly_drones2">No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="resort-option">
               <div class="form-group">
                  <label for="exampleInputEmail1">Drone Policy <span class="text-danger">*</span></label>
                  <div class="clearfix"></div>
                  <textarea class="form-control" name="drone_policy"  row="6" placeholder="Add here"><?php if(!empty($row->drone_policy)){ echo $row->drone_policy;}?></textarea>
               </div>
            </div>
         </div>
        </div> 
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
         <div class="btn-next-con"> 
            <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
            <a class="btn-back" href="javascript:void(0)" onclick="backtostep1();">Back</a> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">
   //alert('resort_logo = <?php echo $row->resort_logo; ?>');
   <?php if(!empty($row->affiliation_img)){ ?>
      setTimeout(function(){ 
         //alert('files');
         $('#resort_affiliation_main_i .file-upload-content').show();
         $('#resort_affiliation_main_i .image-upload-wrap').hide();
      }, 1500);
   <?php }?>
   function villa_counter_status(villa_id, status){
      if(status==1){
         $('#villa_counter_'+villa_id).show();
      }else{
         $('#villa_counter_'+villa_id).hide();
      }
   }
   $(".only_number").keydown(function (e) {
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A, Command+A
         (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         // Allow: home, end, left, right, down, up
         (e.keyCode >= 35 && e.keyCode <= 40)) {
         // let it happen, don't do anything
         return;
      }        
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         e.preventDefault();
      }
   });    
   function backtostep1(){
      var progressBar = $('#js-progress').find('.progress-bar');
      var progressVal = $('#js-progress').find('.progress-val');
      var step_id     = $('#step_id').val();
      var step_id     = parseInt(step_id)-parseInt(1);
      var step_val    = $('#step_val').val();
      var step_val    = parseInt(step_val)-parseInt(10);
      progressBar.css('width', step_val+ '%');
      progressVal.text(step_val+'%');
      $('#step_id').val(step_id);
      $('#step_val').val(step_val);
      var resort_id = $('#resort_id').val();
      $.ajax({ 
         url:base_url+"home/edit_resort_1",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab2').hide().html('');
               $('#tab1').show().html(response.nexthtml);
               $('#add_resort_res').hide();
               $('#tab_menu_2').removeClass('active2');
               $('#tab_menu_1').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
   $('#add_resort_2').validate({
      ignore: "not:hidden",
      rules: {
        /* resort_affiliation: {required: true},*/
         resort_category: {required: true},
         contact_name: {required: true},
         contact_email: {required: true,email:true, validEmail:true},
         contact_number: {required: true, number:true},
         contact_website: {required: true},         
         "airports[]": {
            required: true,
            minlength: 1,
            maxlength:2,
         },
         total_no_villas:{required: true},
         total_no_villas_vaild:{checkTotalNoOfVillas:true},
         affiliation_img:{required: true}, 
         island_size_length:{required: true, number:true},
         island_size_width:{required: true, number:true},
         guests_fly_drones:{required: true},
         drone_policy:{required: true},
         "meal_plans[]": {required: true},
      },
      messages: {
        /* resort_affiliation:{ required:"The affiliation is required"},*/
         resort_category:{ required:"The category is required"},
         contact_name:{ required:"The contact name is required"},
         contact_email:{ required:"The contact name is required", email:"The contact email is required"},
         contact_number:{ required:"The contact number is required", number:"Only number allow"},
         contact_website:{ required:"The website is required"},
         "airports[]": {
            required: "The transfer modes is required",
            minlength: "select at least minimum 1 transfer modes",
            maxlength: "You can select maximum 2 transfer modes",
         },
         total_no_villas:{required: "The total of number villas is required"},
         affiliation_img:{required: "The resort affiliation is required"},
         island_size_length:{ 
            required:"The island length is required", number:"Only number allow"
         },
         island_size_width:{ 
            required:"The island width is required", number:"Only number allow"
         },
         guests_fly_drones:{
            required:"drone info is required"
         },
         drone_policy:{
            required:"The drone policy is required"
         },
         "meal_plans[]": {
            required: "The meal plan is required"
         },            
      },
      submitHandler: function(form) {
         var error = 'no';
         $('.minuts_error').hide();
         $('input[name="airports[]"]:checked').each(function() {
            console.log('val 1 = '+this.value);
            var minut = $('#minuts1_'+this.value).val();
            if(minut==''){
               error = 'yes';
               $('#minuts_error_1_'+this.value).show().html('The minuts is required');
            }else{
               $('#minuts_error_1_'+this.value).hide();
            }
         });
         //console.log('error = '+error);
         if(error=='no'){            
            var resort_id = $('#resort_id').val();
            $.ajax({ 
               url:base_url+"home/save_resort_2",
               type:"POST",
               data:$("#add_resort_2" ).serialize(), 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){ 
                     nextlable();
                     $('#tab2').hide().html('');
                     $('#tab3').show().html(response.nexthtml);
                     $('#add_resort_res').hide();
                     $('#tab_menu_2').removeClass('active2');
                     $('#tab_menu_3').removeClass('disable');
                     $('#tab_menu_3').addClass('active2');
                  }else{ 
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }
               }                
            });
         }
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
   $.validator.addMethod("checkTotalNoOfVillas", 
      function(value, element) {
         var total_no_villas = $('#total_no_villas').val();
         if(total_no_villas==''){
            return true;
         }else{
            var isSuccess = false;
            $.ajax({ 
               url: "<?php echo base_url('home/checkTotalNoOfVillas'); ?>", 
               data: $("#add_resort_2" ).serialize(), 
               type:"POST",
               async: false, 
               success:function(html) { 
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){ 
                     isSuccess = true ;
                  }else{
                     isSuccess = false; 
                     $('.villa_counter_error').hide();
                     var villas_error = response.villas_error;
                     for (i = 0; i < villas_error.length; i++) { 
                       console.log('message = '+villas_error[i]);
                       $('#villa_counter_error_'+villas_error[i]).show().html('It should be more than 0');
                     } 
                  }
               }
            });
            return isSuccess;
         }
      }, "The total number of villas is not equal to describe number of villas"
   );
   function nextlable(){
      var progressBar = $('#js-progress').find('.progress-bar');
      var progressVal = $('#js-progress').find('.progress-val');
      var step_id     = $('#step_id').val();
      var step_id     = parseInt(step_id)+parseInt(1);
      var step_val    = $('#step_val').val();
      var step_val    = parseInt(step_val)+parseInt(10);
      progressBar.css('width', step_val+ '%');
      progressVal.text(step_val+'%');
      $('#step_id').val(step_id);
      $('#step_val').val(step_val);
   }   
   function villa_type_other_label(){
      $('#villa_type_other_label').show();
      $('#villa_type_other_label_t, #villa_type_other_label_t_link').hide();
   }
   function uploadResortAffiliation(){
      var files    = document.getElementById('resortAffiliation').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('affiliation_pic', 'yes');   
      formData.append('pdf_file', 'yes');   
      xhr.open("POST", "<?php echo base_url('home/uploadPics'); ?>");
      xhr.upload.onprogress = function(e) {
         if (e.lengthComputable) {     
            var percentComplete = (e.loaded / e.total) * 100; 
            /*$('.loader_profile_left').show(); */
         }
      };
      xhr.onload = function() {
         if (this.status == 200) {
            var resp = this.response;
            res = JSON.parse(resp); 
            /*$('.loader_profile_left').hide();*/
            if(res.statuss=='true'){
               $('#affiliation_img_main').html(res.html);
               $('#affiliation_img').val(res.file_name);  
               $('#resort_affiliation_main_i .file-upload-content').show();
               $('#resort_affiliation_main_i .image-upload-wrap').hide();
               $('#affiliation_img-error').hide();
            }else{       
               $('#affiliation_img_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteAffiliation(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#affiliation_img, #affiliation_img_main').val('');
            $('#resort_affiliation_main_i .file-upload-content').hide();
            $('#resort_affiliation_main_i .image-upload-wrap').show();
         }
      });
   }
   
   function hide_messsage(){
      $('#total_no_villas_vaild-error').hide();
   }
   function select_villa_counter(vill_counter_id){
      var villa_counter = $("#villa_counter_val_"+vill_counter_id).val();   
      if(villa_counter&&parseInt(villa_counter)>parseInt(0)){
         $("#villa_counter_error_"+vill_counter_id).hide();
      }else{
         $("#villa_counter_error_"+vill_counter_id).show();
      }
   }
   function select_minut(message_id){
      var minuts = $("#minuts"+message_id).val(); 
      if(minuts==''){
         $("#minuts_error_"+message_id).show().html('The minuts is required');
      }else{
         $("#minuts_error_"+message_id).hide();
      }
   }
   function customCheck(id){ 
      var customCheck = $("#customCheck"+id).is(':checked'); 
      //alert('id='+id+", customCheck="+customCheck);
      if(customCheck){
         $("#hour1_"+id).removeClass('hide_cl'); 
         $("#minuts1_"+id).removeClass('hide_cl'); 
         $("#minuts2_"+id).removeClass('hide_cl'); 
      }else{
         $("#hour1_"+id).addClass('hide_cl'); 
         $("#minuts1_"+id).addClass('hide_cl'); 
         $("#minuts2_"+id).addClass('hide_cl'); 
      }
   }
</script>