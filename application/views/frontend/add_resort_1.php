<form class="wizard-container new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_1">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left">
            <h6>Step 1: General Information</h6>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">
                           Name of the property <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="resort_name" value="<?php if(!empty($row->resort_name)){ echo $row->resort_name;}?>" placeholder="Enter here">
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">
                          Description: <span class="text-danger">* (maximum characters: 320 )</span>
                        </label>
                        <textarea rows="8" maxlength="320" class="form-control" placeholder="Enter description" name="resort_description"><?php if(!empty($row->resort_description)){ echo $row->resort_description;}?></textarea>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> 
                           Brand <span class="text-danger">* (if not a brand, please select private)</span>
                        </label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="brand_id">
                           <option value="">Select Brand</option>
                           <?php
                           if(!empty($brands)){
                              foreach($brands as $brand){
                                 if(!empty($row->brand_id)&&$row->brand_id==$brand->id){
                                    echo '<option selected value="'.$brand->id.'">'.$brand->brand_name.'</option>';
                                 }else{
                                    echo '<option value="'.$brand->id.'">'.$brand->brand_name.'</option>';
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
                        <!--<label for="exampleInputEmail1">Physical address<span class="text-danger">* (geographical coordinates, please type inside the box of latitude and longitude)</span>-->
                        <!--  <a href="https://www.gps-coordinates.net" target="blank">www.gps-coordinates.net</a> -->
                        <!--</label>-->
                        <!--<div class="row">-->
                        <!--   <div class="col-md-6 mb-3">-->
                        <!--      <input type="text" class="form-control" value="<?php if(!empty($row->physical_lat)){ echo $row->physical_lat;}?>" name="physical_lat" placeholder="Latitude">-->
                        <!--   </div>-->
                        <!--   <div class="col-md-6 mb-3">-->
                        <!--      <input type="text" value="<?php if(!empty($row->physical_lng)){ echo $row->physical_lng;}?>" name="physical_lng" class="form-control" placeholder="Longitude">-->
                        <!--   </div>-->
                        <!--</div>-->
                        <div class="row">
                           <div class="col-md-6 mb-3">
                              <select class="custom-select mr-sm-2" id="physical_state" name="physical_state">
                                 <option value="">Select Atoll</option>
                                 <?php
                                 if(!empty($states)){
                                    foreach($states as $state){
                                       if(!empty($row->physical_state)&&$row->physical_state==$state->id){
                                          echo '<option selected value="'.$state->id.'">'.$state->state_name.'</option>';
                                       }else{
                                          echo '<option value="'.$state->id.'">'.$state->state_name.'</option>';
                                       }
                                    }
                                 }
                                 ?> 
                              </select>
                           </div>
                           <div class="col-md-6">
                              <input type="text"  value="<?php if(!empty($row->island_name)){ echo $row->island_name;}?>" name="island_name" class="form-control" placeholder="Island Local Name ">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="wizard-right">
            <div class="form-group">
               <div class="file-upload" id="logo_img_main_i">
                  <div class="clearfix"></div>
                  <div class="image-upload-wrap">
                     <input class="file-upload-input"  type='file' accept="image/*" id="logoImg" onchange="uploadLogo();"/>
                     <div class="drag-text">
                        <h3>
                           <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                           <div class="clearfix"></div>
                              Upload your Logo <span class="text-danger">*</span>
                           <div class="clearfix"></div>
                           <small>Just drop them here</small>
                           <div class="clearfix"></div>
                           <small><em class="underline">Browse your Logo</em></small>
                           <ul class="note-msg">
                              <li>                                
                                 upload Landscape Image 
                              </li> 
                              <li>                                
                                 The logo should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
                              </li> 
                              <li>
                                 Logo need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                              </li> 
                              <li>
                                Logo can be maximum <span>10 MB</span> size
                              </li>
                           </ul>
                        </h3>
                     </div>
                     <div class="new_loader" style="display: none;"></div>
                  </div>
                  <div id="logo_img_main">
                  <?php
                  if(!empty($row->resort_logo)){
                     $randT      = rand(000,999).time();
                     $deletImg   = "deleteLogo('".$randT."','".$row->resort_logo."')"; 
                     $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$row->resort_logo.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button></div></div>';
                     echo $html;
                  }
                  ?></div>
                  <div id="logo_file_type_error" class="error"></div>
                  <input type="hidden" name="logo_name" id="logo_name" value="<?php echo !empty($row->resort_logo)?$row->resort_logo:''; ?>">
                  <input type="hidden" name="resort_id" value="<?php if($this->input->get('resort_id')){echo base64_decode($this->input->get('resort_id'));}else if(!empty($row->id)){ echo $row->id;} ?>">
                  <input type="hidden" name="old_resort_name" value="<?php if(!empty($row->resort_name)){ echo $row->resort_name;}?>">          
                  <div class="clearfix"></div>
                  <div>
                     <div class="resort-option">
                        <div class="form-group">
                        <label for="exampleInputEmail1">    
                           Add Resort Highlights  
                        </label>
                        <div id="ResortHighlights">
                           <?php 
                           
                           if(!empty($resort_highlights)){
                              foreach($resort_highlights as $resort_highlight){
                                 if(!empty($resort_highlight->resort_highlights)){
                                    echo '<input type="text" name="resort_highlights[]" class="form-control mb-3" placeholder="for e.g : 11 Villas" value="'.$resort_highlight->resort_highlights.'"">';
                                 }
                              }
                           } 
                           if(empty($resort_highlights)){
                              $count = 0;
                           } else {
                              $count = count($resort_highlights);
                           }
                           if($count<6) {
                           ?> 
                           <input type="text" name="resort_highlights[]" class="form-control mb-3" placeholder="for e.g : 11 Villas">
                           <?php }?>
                        </div>
                        <div class="clearfix"></div>
                        <?php if($count<5) {?>
                        <a href="javascript:void(0);" onclick="addHighlights();" class="add-more">+ Add more</a>
                        <?php }?>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
            <!-- <div class="form-group">
               <label for="exampleInputEmail1">
                 Do you have agoda link ? <span class="text-danger">*</span>
               </label>
               <input type="text" class="form-control" name="agoda_url" value="<?php if(!empty($row->agoda_url)){ echo $row->agoda_url;}?>" placeholder="Enter agoda link">
            </div> -->
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
         <div class="btn-next-con"> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">
   <?php if(!empty($row->resort_logo)){ ?>
      setTimeout(function(){ 
         $('#logo_img_main_i .file-upload-content').show();
         $('#logo_img_main_i .image-upload-wrap').hide();
      }, 1500);
   <?php }?>
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
   $('#add_resort_1').validate({
      ignore: "not:hidden",
      rules: {
         resort_name: {required: true},
         resort_description: {required: true},
         brand_id: {required: true},
        //  physical_lat: {required: true, number:true},
        //  physical_lng: {required: true, number:true},
         physical_state: {required: true},
         island_name: {required: true},
         logo_name:{required: true},        
      },
      messages: {
         resort_name:{ required:"The resort name is required"},
         resort_description:{ required:"The resort description is required"},
         brand_id:{ required:"The brand is required"},
        //  physical_lat:{ required:"The physical latitude is required", number:"Only number allow"},
        //  physical_lng:{ required:"The physical longitude is required", number:"Only number allow"},
         physical_state:{ required:"The atoll is required"},
         island_name:{ required:"The island name is required"},         
         logo_name:{ required:"The logo is required"}, 
      },
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
         var logo_name = $('#logo_name').val();
         var error     = 'no';
         if(logo_name==''&&resort_id==''){
            $('#logo_file_type_error').show().html('The resort logo is required');
            error = 'yes';
         }else{
            $('#logo_file_type_error').hide();
         }
         if(error=='no'){            
            $.ajax({ 
               url:base_url+"home/save_resort_1",
               type:"POST",
               data:$("#add_resort_1" ).serialize(), 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){                      
                     //alert('index'+index);
                     nextlable();
                     $('#resort_id').val(response.resort_id);
                     $('#tab1').hide().html('');
                     $('#tab2').show().html(response.nexthtml);
                     $('#add_resort_res').hide();
                     $('#tab_menu_1').removeClass('active2');
                     $('#tab_menu_2').removeClass('disable');
                     $('#tab_menu_2').addClass('active2');
                  }else{ 
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }
               }                
            });  
         }
      }
   });
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
   function uploadLogo() {
       $('.new_loader').show();
      var files    = document.getElementById('logoImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('logo_pic', 'yes');   
      xhr.open("POST", "<?php echo base_url('home/uploadPics'); ?>");
         xhr.upload.onprogress = function(e) {
         if (e.lengthComputable) {     
            var percentComplete = (e.loaded / e.total) * 100; 
            $('.loader_profile_left').show(); 
         }
      };
      xhr.onload = function() {
         if (this.status == 200) {
            var resp = this.response;
            res = JSON.parse(resp); 
            $('.new_loader').hide();
            if(res.statuss=='true'){
               $('#logo_img_main').html(res.html);
               $('#logo_name').val(res.file_name);  
               $('#logo_img_main .file-upload-content').show();
               $('#logo_img_main_i .image-upload-wrap').hide();
               $('#logo_file_type_error, #logo_name-error').hide();
            }else{       
               $('#logo_file_type_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteLogo(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#logo_name, #logo_img_main').val('');
            $('#logo_img_main .file-upload-content').hide();
            $('#logo_img_main_i .image-upload-wrap').show();
         }
      });
   } 
   function addHighlights(){
      if($('#ResortHighlights input').length<6){
         if($('#ResortHighlights input').length==5) {
            $('.add-more').hide();
         }
         $('#ResortHighlights').append('<input type="text" name="resort_highlights[]" class="form-control mb-3" placeholder="for e.g : 11 Villas">');
      }
   }
</script>