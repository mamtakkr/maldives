<form class="wizard-container new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_7">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 6: Sports & Entertainments</h6>
            <div class="clearfix"></div>
            <div class="resort-option facilities">
               <div class="form-group">
                  <label for="exampleInputEmail1">Choose Sports & Entertainments</label>
                  <div class="amenities">
                     <div class="clearfix"></div>
                     <ul>
                        <?php 
                        $resortSports = array();
                        if(!empty($row->sports)){
                           $resortSports = explode(',', $row->sports);
                        }
                        if(!empty($sports)){
                           foreach ($sports as $sport) {
                              if(!empty($sport->sport_img)&&file_exists('uploads/sports/thumbnails/'.$sport->sport_img)){?>
                              <li>
                                 <input type="checkbox" value="<?php echo $sport->id; ?>" name="sports[]" class="hidden" id="sports_<?php echo $sport->id; ?>" <?php if(in_array($sport->id, $resortSports)){echo 'checked';} ?>>
                                 <label for="sports_<?php echo $sport->id; ?>" class="lable_text">
                                    <div class="amenities-icon" for="sports_<?php echo $sport->id; ?>"> 
                                       <?php                  
                                       echo '<img src="'.base_url().'uploads/sports/thumbnails/'.$sport->sport_img.'">';
                                       ?>
                                    </div>
                                    <div class="amenities-title">
                                       <?php echo $sport->sport_name; ?> 
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
                  </div>
               </div>
            </div>
            <div class="resort-option facilities">
               <div class="form-group">
                  <label for="exampleInputEmail1">Water Sports</label>
                  <div class="amenities">
                     <div class="clearfix"></div>
                     <ul>
                        <?php 
                        $resort_water_sports = array();
                        if(!empty($row->water_sports)){
                           $resort_water_sports = explode(',', $row->water_sports);
                        }
                        if(!empty($water_sports)){
                           foreach ($water_sports as $water_sport) {
                              if(!empty($water_sport->water_sports_img)&&file_exists('uploads/sports/thumbnails/'.$water_sport->water_sports_img)){?>
                              <li>
                                 <input type="checkbox" value="<?php echo $water_sport->id; ?>" name="water_sports[]" class="hidden" id="water_sport_<?php echo $water_sport->id; ?>" <?php if(in_array($water_sport->id, $resortSports)){echo 'checked';} ?>>
                                 <label for="water_sport_<?php echo $water_sport->id; ?>" class="lable_text">
                                    <div class="amenities-icon" for="water_sport_<?php echo $water_sport->id; ?>"> 
                                       <?php                  
                                       echo '<img src="'.base_url().'uploads/sports/thumbnails/'.$water_sport->water_sports_img.'">';
                                       ?>
                                    </div>
                                    <div class="amenities-title">
                                       <?php echo $water_sport->water_sports_name; ?> 
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
                  </div>
               </div>
            </div>
            
            <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label>Upload Images</label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="sport_images_main_i">
                                 <div class="clearfix"></div>
                                 <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="sportImagesImgNewFun();" accept="image/*" id="sportImagesImgNew" />
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
                                 <div id="sport_images_error" class="error"></div>
                                 <div id="sport_images_main">
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
                                 <input type="hidden" name="sport_images" id="sport_images">
                                 <input type="hidden" id="sportImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                                 <div class="clearfix"></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            
            
            
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">      
         <div class="btn-next-con"> 
            <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
            <a class="btn-back" href="javascript:void(0)" onclick="backtostep6();">Back</a> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">
   function backtostep6(){
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
         url:base_url+"home/edit_resort_5",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab7').hide().html('');
               $('#tab5').show().html(response.nexthtml);
               $('#tab_menu_7').removeClass('active2');
               $('#tab_menu_5').addClass('active2');
               $('#add_resort_res').hide();
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }    
   $('#add_resort_7').validate({
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/save_resort_7",
            type:"POST",
            data:$("#add_resort_7" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  nextlable();
                  $('#tab7').hide().html('');
                  $('#tab8').show().html(response.nexthtml);
                  $('#tab_menu_7').removeClass('active2');
                  $('#tab_menu_8').removeClass('disable');
                  $('#tab_menu_8').addClass('active2');
                  $('#add_resort_res').hide();
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   }); 
   
   
   
   function sportImagesImgNewFun(){
      var files           = document.getElementById('sportImagesImgNew').files;
      var resortImgCount  = $('#sportImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      console.log('totalFileCount = '+totalFileCount);
      if(totalFileCount>10){
         $('#sport_images_error').show().html('You can`t upload more than 10 images');
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
            formData.append('sport_image_pic', 'yes');   
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
                     $('#sport_images_main').append(res.html);
                     var filenames = $('#sport_images').val();
                     if(filenames!=''){
                         $('#sport_images').val(filenames+','+res.file_name);
                     }else{
                        $('#sport_images').val(res.file_name);
                     }
                     $('#sport_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#sportImagesCount').val())+parseInt(1);  
                     $('#sportImagesCount').val(resortImgCount);
                     $('#sport_images_error').hide();
                     /*$('#sport_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#sport_images_error').show().html(res.message);
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
            echo "$('#sport_images_main .file-upload-content').show();";
         }
      ?> 
   }, 1500);
   function deleteResortImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#sportImagesCount').val())-parseInt(1);  
            $('#sportImagesCount').val(resortImgCount);
            var all_images = $('#sport_images').val(); 
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
            $('#sport_images').val(imageName);
         }
      });
   } 
   
</script>