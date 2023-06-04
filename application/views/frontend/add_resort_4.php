<form class="wizard-container new_wized" onsubmit="return false;" action="" id="add_resort_4" method="post" enctype="multipart/form-data">
   <div class="row">
     <!-- <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 4: Room amenities</h6>
            <div class="clearfix"></div>
            <div class="resort-option facilities">
               <div class="form-group">
                  <label for="exampleInputEmail1">Choose the amenities</label>
                  <div class="amenities">
                     <div class="clearfix"></div>
                     <ul>
                        <?php 
                        $resortAmenities = array();
                        if(!empty($row->amenities)){
                           $resortAmenities = explode(',', $row->amenities);
                        }
                        if(!empty($amenities)){
                           foreach ($amenities as $amenitie) {
                              if(!empty($amenitie->amenitie_icon)&& file_exists('uploads/amenities/thumbnails/'.$amenitie->amenitie_icon)){?>
                              <li>
                                 <input type="checkbox" value="<?php echo $amenitie->id; ?>" name="amenities[]" class="hidden" id="amenitie_<?php echo $amenitie->id; ?>" <?php if(in_array($amenitie->id, $resortAmenities)){echo 'checked';} ?>>
                                 <label for="amenitie_<?php echo $amenitie->id; ?>" class="lable_text">
                                    <div class="amenities-icon" for="amenitie_<?php echo $amenitie->id; ?>"> 
                                       <?php                  
                                       echo '<img src="'.base_url().'uploads/amenities/thumbnails/'.$amenitie->amenitie_icon.'">';
                                       ?>
                                    </div>
                                    <div class="amenities-title">
                                       <?php echo $amenitie->amenitie_name; ?> 
                                    </div>
                                 </label>
                                 <div class="clearfix"></div>
                              </li>
                           <?php 
                              }
                           }
                        }
                        ?>          
                     </ul>
                     <div class="col-sm-6">
                        <div class="resort-option">
                           <div class="form-group">
                              <label for="exampleInputEmail1">    
                                 Add Complimentary Services  
                              </label>
                              <div id="ComplimentaryServices">
                                 <?php 
                                 if(!empty($complimentary_services)){
                                    foreach($complimentary_services as $complimentary_service){
                                       if(!empty($complimentary_service->complimentary_name)){
                                          echo '<input type="text" name="complimentary_services[]" class="form-control mb-3" placeholder="for e.g : Complimentary use of snorkelling set during the stay" value="'.$complimentary_service->complimentary_name.'"">';
                                       }
                                    }
                                 } 
                                 ?> 
                                 <input type="text" name="complimentary_services[]" class="form-control mb-3" placeholder="for e.g : Complimentary use of snorkelling set during the stay">
                              </div>
                              <div class="clearfix"></div>
                              <a href="javascript:void(0);" onclick="addComplimentaryServices();" class="add-more">+ Add more</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>-->
      <div class="clearfix"></div>
	   <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 4: Resorts Facilities</h6>
            <div class="clearfix"></div>
            <div class="resort-option facilities">
               <div class="form-group">
                  <label for="exampleInputEmail1">Choose the facilities</label>
                  <div class="amenities">
                     <div class="clearfix"></div>
                     <ul>
                        <?php 
                        $resortFacilities = array();
                        if(!empty($row->facilities)){
                           $resortFacilities = explode(',', $row->facilities);
                        }
                        if(!empty($facilities)){
                           foreach ($facilities as $facilitie) {
                              ?>
                              <li>
                                 <input type="checkbox" value="<?php echo $facilitie->id; ?>" name="facilities[]" class="hidden" id="facilitie_<?php echo $facilitie->id; ?>" <?php if(in_array($facilitie->id, $resortFacilities)){echo 'checked';} ?>>
                                 <label for="facilitie_<?php echo $facilitie->id; ?>" class="lable_text">
                                  
                                    <div class="amenities-title">
                                       <?php echo $facilitie->facility_name; ?> 
                                    </div>
                                 </label>
                                 <div class="clearfix"></div>
                              </li>
                           <?php 
                           
                           }
                        }
                        ?>          
                     </ul>
					<div class="col-sm-6 complimentary_services">
						<div class="resort-option">
						   <div class="form-group">
							  <label for="exampleInputEmail1">    
								 Add Complimentary Services  
							  </label>
							  <div id="ComplimentaryServices">
								 <?php 
								 if(!empty($complimentary_services)){
									foreach($complimentary_services as $complimentary_service){
									   if(!empty($complimentary_service->complimentary_name)){
										  echo '<input type="text" name="complimentary_services[]" class="form-control mb-3" placeholder="for e.g : Complimentary use of snorkelling set during the stay" value="'.$complimentary_service->complimentary_name.'"">';
									   }
									}
								 } 
								 ?> 
								 <input type="text" name="complimentary_services[]" class="form-control mb-3" placeholder="for e.g : Complimentary use of snorkelling set during the stay">
							  </div>
							  <div class="clearfix"></div>
							  <a href="javascript:void(0);" onclick="addComplimentaryServices();" class="add-more">+ Add more</a>
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
            <label>Upload Images</label>
            <div class="upload-doc">
               <div class="form-group">
                  <div class="file-upload" id="fac_images_main_i">
                     <div class="clearfix"></div>
                     <div class="image-upload-wrap">
                        <input class="file-upload-input" type='file' onchange="facImagesImgNewFun();" accept="image/*" id="facImagesImgNew" />
                        <div class="drag-text">
                           <h3>
                              <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                              <div class="clearfix"></div>
                              Upload your Images
                              <div class="clearfix"></div>
                              <small>Just drop them here</small> 
                              <ul class="note-msg">
                                 <li>
                                    Upload Landscape Image
                                 </li>   
                                 <li>                                
                                    The image should be <span>PNG</span>, <span>JPG</span> and <span> JPEG </span> file format
                                 </li> 
                                 <li>
                                    Image need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels 
                                 <li>
                                    Image can be maximum <span>10 MB</span> size
                                 </li>
                                 <li>
                                    Upload up to <span>10</span> images
                                 </li>
                              </ul>
                           </h3>
                        </div>
                        <div class="new_loader" style="display: none;"></div>
                     </div>
                     <div id="fac_images_error" class="error"></div>
                     <div id="fac_images_main">
                        <?php 
                        if(!empty($images)){ 
                           foreach ($images as $image) {   
                              if(file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){                             
                                 $randT      = rand(000,999).time();
                                 $deletImg   = "deleteResortImage('".$randT."','".$image->image_name."', '".$image->id."')";
                                 $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                 echo $html;
                              } 
                           }
                        }
                        ?>
                     </div>                              
                     <input type="hidden" name="fac_images" id="fac_images">
                     <input type="hidden" id="facImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                     <div class="clearfix"></div> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
      
      
      
	  
	  <div style="display:none;">
	   <!-- Kids CLUB -->
	   <input type="hidden" name="kids_club_id" value="<?php if(!empty($kids_club->kids_club_id)){ echo $kids_club->kids_club_id; } ?>"/>
		<div class="col-md-12">
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Kids Club
			  </label>     
			  <input type="text" placeholder="Title" class="form-control" name="kids_club_title" value="<?php if(set_value('kids_club_title')){echo set_value('kids_club_title');}else{ if(!empty($kids_club->kids_club_title)){ echo $kids_club->kids_club_title;}}   ?>">
				 <?php echo form_error('kids_club_title'); ?>
			</div> 
			<div class="form-group">
			  <?php  echo (!empty($kids_club->kids_club_image)&&file_exists('uploads/club/kids_club/'.$kids_club->kids_club_image))?'<img src="'.base_url().'uploads/club/kids_club/'.$kids_club->kids_club_image.'" style="max-width:1000px"/>':'';
				  ?>
			</div>
			<div class="form-group">
			  <label for="exampleInputEmail1">
			  Kids Club Image
			  </label>     
			  <input type="file" class="form-control" name="kids_club_image" id="kids_club_image">
			  <input type="hidden" name="kids_old_image" value="<?php if(!empty($kids_club->kids_club_image)){ echo $kids_club->kids_club_image; } ?>"/>
			  <div class="note-msg">
			   Kids Club need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
			  </div>
			  <?php echo form_error('kids_club_image'); ?>
			</div> 
			<div class="form-group">
			<label for="exampleInputEmail1">Description</label>     
			<textarea name="kids_club_description" placeholder="Enter description" class="form-control tinymce_edittor"><?php if(set_value('kids_club_description')){echo set_value('kids_club_description');}elseif(!empty($kids_club->kids_club_description)){ echo $kids_club->kids_club_description;}?></textarea>
			<?php echo form_error('kids_club_description'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Highlights
			  </label>     
			  <input type="text" placeholder="Highlights" class="form-control" name="kids_club_highlights" value="<?php if(set_value('kids_club_highlights')){echo set_value('kids_club_highlights');}else{ if(!empty($kids_club->kids_club_highlights)){ echo $kids_club->kids_club_highlights;}}   ?>">
				 <?php echo form_error('kids_club_highlights'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Opning Hours
			  </label>     
			  <input type="text" placeholder="9am - 11pm" class="form-control" name="kids_club_opning_hrs" value="<?php if(set_value('kids_club_opning_hrs')){echo set_value('kids_club_opning_hrs');}else{ if(!empty($kids_club->kids_club_opning_hrs)){ echo $kids_club->kids_club_opning_hrs;}}   ?>">
				 <?php echo form_error('kids_club_opning_hrs'); ?>
			</div> 
		</div>
		  <!--End  Kids CLUB -->
		  <div class="clearfix"></div>
	   <!-- WATER  Sports CLUB -->
	  <input type="hidden" name="watersports_club_id" value="<?php if(!empty($watersports_club->watersports_club_id)){ echo $watersports_club->watersports_club_id; } ?>"/>
		<div class="col-md-12">
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Water Sport Name
			  </label>     
			  <input type="text" placeholder="Title" class="form-control" name="watersports_club_title" value="<?php if(set_value('watersports_club_title')){echo set_value('watersports_club_title');}else{ if(!empty($watersports_club->watersports_club_title)){ echo $watersports_club->watersports_club_title;}}   ?>">
				 <?php echo form_error('watersports_club_title'); ?>
			</div> 
			<div class="form-group">
			  <?php  echo (!empty($watersports_club->watersports_club_image)&&file_exists('uploads/club/water_sports_club/'.$watersports_club->watersports_club_image))?'<img src="'.base_url().'uploads/club/water_sports_club/'.$watersports_club->watersports_club_image.'" style="max-width:1000px"/>':'';
				  ?>
			</div>
			<div class="form-group">
			  <label for="exampleInputEmail1">
			   Sport Icon
			  </label>     
			  <input type="file" class="form-control" name="watersports_club_image" id="watersports_club_image">
			  <input type="hidden" name="watersports_old_image" value="<?php if(!empty($watersports_club->watersports_club_image)){ echo $watersports_club->watersports_club_image; } ?>"/>
			  <div class="note-msg">
			   Sport Icon need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
			  </div>
			  <?php echo form_error('watersports_club_image'); ?>
			</div> 
			<div class="form-group">
			<label for="exampleInputEmail1">Description</label>     
			<textarea name="watersports_club_description" placeholder="Enter description" class="form-control tinymce_edittor"><?php if(set_value('watersports_club_description')){echo set_value('watersports_club_description');}elseif(!empty($watersports_club->watersports_club_description)){ echo $watersports_club->watersports_club_description;}?></textarea>
			<?php echo form_error('watersports_club_description'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Highlights
			  </label>     
			  <input type="text" placeholder="Highlights" class="form-control" name="watersports_club_highlights" value="<?php if(set_value('watersports_club_highlights')){echo set_value('watersports_club_highlights');}else{ if(!empty($watersports_club->watersports_club_highlights)){ echo $watersports_club->watersports_club_highlights;}}   ?>">
				 <?php echo form_error('watersports_club_highlights'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Opning Hours
			  </label>     
			  <input type="text" placeholder="9am - 11pm" class="form-control" name="watersports_club_opning_hrs" value="<?php if(set_value('watersports_club_opning_hrs')){echo set_value('watersports_club_opning_hrs');}else{ if(!empty($watersports_club->watersports_club_opning_hrs)){ echo $watersports_club->watersports_club_opning_hrs;}}   ?>">
				 <?php echo form_error('watersports_club_opning_hrs'); ?>
			</div> 
		</div>
		  <!--End  WATER Sports CLUB -->
		  <div class="clearfix"></div>
	   <!-- Dive Ccenter CLUB -->
	   <input type="hidden" name="divecenter_club_id" value="<?php if(!empty($divecenter_club->divecenter_club_id)){ echo $divecenter_club->divecenter_club_id; } ?>"/>
		<div class="col-md-12">
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Dive Center
			  </label>     
			  <input type="text" placeholder="Title" class="form-control" name="divecenter_club_title" value="<?php if(set_value('divecenter_club_title')){echo set_value('divecenter_club_title');}else{ if(!empty($divecenter_club->divecenter_club_title)){ echo $divecenter_club->divecenter_club_title;}}   ?>">
				 <?php echo form_error('divecenter_club_title'); ?>
			</div> 
			<div class="form-group">
			  <?php  echo (!empty($divecenter_club->divecenter_club_image)&&file_exists('uploads/club/dive_center_club/'.$divecenter_club->divecenter_club_image))?'<img src="'.base_url().'uploads/club/dive_center_club/'.$divecenter_club->divecenter_club_image.'" style="max-width:1000px"/>':'';
				  ?>
			</div>
			<div class="form-group">
			  <label for="exampleInputEmail1">
			   Dive center Icon
			  </label>     
			  <input type="file" class="form-control" name="divecenter_club_image" id="divecenter_club_image">
			   <input type="hidden" name="divecenter_old_image" value="<?php if(!empty($divecenter_club->divecenter_club_image)){ echo $divecenter_club->divecenter_club_image; } ?>"/>
			  <div class="note-msg">
			    Dive center Icon need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
			  </div>
			  <?php echo form_error('divecenter_club_image'); ?>
			</div> 
			<div class="form-group">
			<label for="exampleInputEmail1">Description</label>     
			<textarea name="divecenter_club_description" placeholder="Enter description" class="form-control tinymce_edittor"><?php if(set_value('divecenter_club_description')){echo set_value('divecenter_club_description');}elseif(!empty($divecenter_club->divecenter_club_description)){ echo $divecenter_club->divecenter_club_description;}?></textarea>
			<?php echo form_error('divecenter_club_description'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Highlights
			  </label>     
			  <input type="text" placeholder="Highlights" class="form-control" name="divecenter_club_highlights" value="<?php if(set_value('divecenter_club_highlights')){echo set_value('divecenter_club_highlights');}else{ if(!empty($divecenter_club->divecenter_club_highlights)){ echo $divecenter_club->divecenter_club_highlights;}}   ?>">
				 <?php echo form_error('divecenter_club_highlights'); ?>
			</div> 
			<div class="form-group">
			  <label for="exampleInputEmail1">
				Opning Hours
			  </label>     
			  <input type="text" placeholder="9am - 11pm" class="form-control" name="divecenter_club_opning_hrs" value="<?php if(set_value('divecenter_club_opning_hrs')){echo set_value('divecenter_club_opning_hrs');}else{ if(!empty($divecenter_club->divecenter_club_opning_hrs)){ echo $divecenter_club->divecenter_club_opning_hrs;}}   ?>">
				 <?php echo form_error('divecenter_club_opning_hrs'); ?>
			</div> 
		</div>
		  <!--End  Divecenter CLUB -->
		</div>
	   </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
         <div class="btn-next-con"> 
            <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
            <a class="btn-back" href="javascript:void(0)" onclick="backtostep3();">Back</a> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">
<?php if(!empty($row->facilities_img)){ ?>
      setTimeout(function(){ 
         $('#fac_img_main_i .file-upload-fac').show();
         $('#fac_img_main_i .image-upload-wrap').hide();
      }, 1500);
   <?php }?>
   
   function backtostep3(){
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
         url:base_url+"home/edit_resort_3",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab4').hide().html('');
               $('#tab3').show().html(response.nexthtml);
               $('#add_resort_res').hide();
               $('#tab_menu_4').removeClass('active2');
               $('#tab_menu_3').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }    
   $('#add_resort_4').validate({
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
		 var form_id = "#add_resort_4";
		 var form = $(form_id)[0];
		 var formData = new FormData(form); 
         $.ajax({ 
            url:base_url+"home/save_resort_4",
            type:"POST",
            data:formData, 
			contentType: false,
			cache: false,
			processData:false,
			dataType:'json',
            success: function(html){
				//console.log(html);
               var response = (html); 
			   console.log(response);
               if(response.status=='true'){
				   
                  nextlable();
                  $('#tab4').hide().html('');
                  $('#tab5').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_4').removeClass('active2');
                  $('#tab_menu_5').removeClass('disable');
                  $('#tab_menu_5').addClass('active2');
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   });   
   function addComplimentaryServices(){
      $('#ComplimentaryServices').append('<input type="text" name="complimentary_services[]" class="form-control mb-3" placeholder="for e.g : Complimentary use of snorkelling set during the stay">');
   }
   
   
   function facImagesImgNewFun(){
      var files           = document.getElementById('facImagesImgNew').files;
      var resortImgCount  = $('#facImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      console.log('totalFileCount = '+totalFileCount);
      if(totalFileCount>10){
         $('#fac_images_error').show().html('You can`t upload more than 10 images');
         $('.new_loader').hide();  
      }else{
         var max_count = files.length;
         console.log('max_count = '+max_count);
         $('.new_loader').show();  
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img', file);
            formData.append('fac_image_pic', 'yes');   
            xhr.open("POST", "<?php echo base_url('home/uploadPics'); ?>");
               xhr.upload.onprogress = function(e) {
               if (e.lengthComputable) {     
                  var percentComplete = (e.loaded / e.total) * 100; 
               }
            };
            xhr.onload = function() {
               if (this.status == 200) {
                  var resp = this.response;
                  res = JSON.parse(resp); 
                  $('.new_loader').hide();  
                  if(res.statuss=='true'){
                     $('#fac_images_main').append(res.html);
                     var filenames = $('#fac_images').val();
                     if(filenames!=''){
                         $('#fac_images').val(filenames+','+res.file_name);
                     }else{
                        $('#fac_images').val(res.file_name);
                     }
                     $('#fac_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#facImagesCount').val())+parseInt(1);  
                     $('#facImagesCount').val(resortImgCount);
                     $('#fac_images_error').hide();
                     /*$('#fac_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#fac_images_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
   }
   setTimeout(function(){ 
      <?php 
         if(!empty($row->spa_menu)){  
            echo "$('#resort_spa_menu_main_i .file-upload-content').show();
                  $('#resort_spa_menu_main_i .image-upload-wrap').hide();";
         }
         if(!empty($images)){  
            echo "$('#fac_images_main .file-upload-content').show();";
         }
      ?> 
   }, 1500);
   function deleteResortImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#facImagesCount').val())-parseInt(1);  
            $('#facImagesCount').val(resortImgCount);
            var all_images = $('#fac_images').val(); 
            imageName      = '';
            images = all_images.split(',');
            for(var im=0; im<images.length; im++){
               console.log('imagesss s'+images[im]);
               if(images[im]&&images[im]!=imageold){
                  imageName +=','+images[im];
               }
            }
            $.ajax({ 
               url:base_url+"home/deleteResortImage/"+imageDBID,
               type:"GET",
               success: function(html){}                 
            });
            $('#fac_images').val(imageName);
         }
      });
   } 
   
   
</script>