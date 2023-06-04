<form class="wizard-container new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_9">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 8: SPA/Health & Wellness</h6>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Name of the Spa<span class="text-danger">*</span></label>
                        <input type="text" name="name_of_the_spa" value="<?php if(!empty($row->name_of_the_spa)){echo $row->name_of_the_spa;} ?>" class="form-control" placeholder="Enter here">
                     </div>
                  </div>
                  <div class="resort-option" style="display:none;">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Signature Treatment </label>
                        <input type="text" name="signature_treatment" value="<?php if(!empty($row->signature_treatment)){echo $row->signature_treatment;} ?>" class="form-control" placeholder="Enter here">
                     </div>
                  </div>
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Spa Highlights</label>
                        <?php 
                           if(isset($row->signature_treatment_description) && $row->signature_treatment_description!="") {
                              $signature_treatment_description  = explode("###",$row->signature_treatment_description);
                           }
                           for($i=0;$i<5;$i++) {
                              ?>
                                 <input type="text" name="signature_treatment_description[]" class="form-control" placeholder="Enter here" value="<?php if(isset($signature_treatment_description[$i])) {echo $signature_treatment_description[$i];}?>">
                              <?php
                           }
                        ?>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Description<span class="text-danger">* (maximum characters: 320 )</span></label>
                        <textarea rows="5" cols="50" maxlength="320" name="spa_description" type="text" class="form-control" placeholder="Enter here"><?php if(!empty($row->spa_description)){echo $row->spa_description;} ?></textarea>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label>Upload Menu</label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="resort_spa_menu_main_i">
                                 <div class="clearfix"></div>
                                 <div class="image-upload-wrap">
                                    <input class="file-upload-input"  type='file' onchange="resortspa_menuImgNew();" id="resortspa_menuImg" />
                                    <div class="drag-text">
                                       <h3>
                                       <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                          <div class="clearfix"></div>
                                          Upload your menu
                                          <div class="clearfix"></div>
                                          <small>Just drop them here</small> 
                                          <ul class="note-msg">
                                             <li>
                                                Upload Landscape Image
                                             </li>   
                                             <li>                                
                                                The menu should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> and <span> PDF </span> file format
                                             </li> 
                                             <li>
                                                Menu need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                                             </li> 
                                             <li>
                                                Menu can be maximum <span>10 MB</span> size
                                             </li>
                                          </ul>
                                       </h3>
                                    </div>
                                    <div class="new_loader" style="display: none;"></div>
                                 </div>
                                 <div id="spa_menu_main">
                                    <?php 
                                    if(!empty($row->spa_menu)){
                                       $fileTypes  = explode('.', $row->spa_menu);
                                       $fileType   = strtolower(end($fileTypes));
                                       $randT      = rand(000,999).time();
                                       $deletImg   = "deleteSpaMenu('".$randT."','".$row->spa_menu."')"; 
                                       $html       = '<div id="'.$randT.'" class="file-upload-content">';
                                       if($fileType=='pdf'){      
                                          $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->spa_menu.'" alt="resort affiliation"></iframe>';
                                       }else{
                                          $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->spa_menu.'" alt="resort affiliation">';
                                       }
                                       $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                       /*
                                       $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->spa_menu.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove </button></div></div>';*/
                                       echo $html;
                                    }
                                    ?>
                                 </div>
                                 <div id="spa_menu_error"></div>
                                 <input type="hidden" name="resort_spa_menu" id="resort_spa_menu">
                                 <div class="clearfix"></div>
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
                              <div class="file-upload" id="spa_images_main_i">
                                 <div class="clearfix"></div>
                                 <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' onchange="resortImagesImgNewFun();" accept="image/*" id="resortImagesImgNew" multiple="multiple" />
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
                                    <div class="new_loader1" style="display: none;"></div>
                                 </div>
                                 <div id="spa_images_error" class="error"></div>
                                 <div id="spa_images_main">
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
                                 <input type="hidden" name="spa_images" id="spa_images">
                                 <input type="hidden" id="spaImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                                 <div class="clearfix"></div> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="btn-next-con"> 
         <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
         <a class="btn-back" href="javascript:void(0)" onclick="backtostep8();">Back</a> 
         <button type="submit" class="btn-next">
            Save & Continue
         </button>
      </div>
   </div>
</form>
<script type="text/javascript">
   $('#add_resort_9').validate({
      rules: {
         name_of_the_spa: {required: true},
         spa_description: {required: true},
      },
      messages: {
         name_of_the_spa:{ required:"The name of spa is required"},
         spa_description:{ required:"The description is required"},
      },
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/save_resort_9",
            type:"POST",
            data:$("#add_resort_9" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  nextlable();
                  $('#tab9').hide();
                  $('#tab10').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_9').removeClass('active2');
                  $('#tab_menu_10').removeClass('disable');
                  $('#tab_menu_10').addClass('active2');
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   }); 
   function backtostep8(){
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
         url:base_url+"home/edit_resort_8",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab9').hide().html('');
               $('#tab8').show().html(response.nexthtml);
               $('#add_resort_res').hide();
               $('#tab_menu_9').removeClass('active2');
               $('#tab_menu_8').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
   function resortspa_menuImgNew(){
      var files    = document.getElementById('resortspa_menuImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      $('.new_loader').show();  
      formData.append('user_img',file);
      formData.append('spa_menu_pic', 'yes');   
      formData.append('pdf_file', 'yes');   
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
               $('#spa_menu_main').html(res.html);
               $('#resort_spa_menu').val(res.file_name);  
               $('#resort_spa_menu_main_i .file-upload-content').show();
               $('#resort_spa_menu_main_i .image-upload-wrap').hide();
            }else{       
               $('#spa_menu_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteSpaMenu(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#resort_spa_menu, #spa_menu_main').val('');
            $('#resort_spa_menu_main_i .file-upload-content').hide();
            $('#resort_spa_menu_main_i .image-upload-wrap').show();
         }
      });
   } 
   function resortImagesImgNewFun(){
      var files           = document.getElementById('resortImagesImgNew').files;
      var resortImgCount  = $('#spaImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      console.log('totalFileCount = '+totalFileCount);
      $('.new_loader1').show();  
      if(totalFileCount>10){
         $('#spa_images_error').show().html('You can`t upload more than 10 images');
         $('.new_loader1').hide();  
      }else{
         var max_count = files.length;
         console.log('max_count = '+max_count);
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img', file);
            formData.append('resort_image_pic', 'yes');   
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
                  $('.new_loader1').hide();  
                  if(res.statuss=='true'){
                     $('#spa_images_main').append(res.html);
                     var filenames = $('#spa_images').val();
                     if(filenames!=''){
                         $('#spa_images').val(filenames+','+res.file_name);
                     }else{
                        $('#spa_images').val(res.file_name);
                     }
                     $('#spa_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#spaImagesCount').val())+parseInt(1);  
                     $('#spaImagesCount').val(resortImgCount);
                     $('#spa_images_error').hide();
                     /*$('#spa_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#spa_images_error').show().html(res.message);
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
            echo "$('#spa_images_main .file-upload-content').show();";
         }
      ?> 
   }, 1500);
   function deleteResortImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#spaImagesCount').val())-parseInt(1);  
            $('#spaImagesCount').val(resortImgCount);
            var all_images = $('#spa_images').val(); 
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
            $('#spa_images').val(imageName);
         }
      });
   } 
</script>