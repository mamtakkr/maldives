<style type="text/css">
   .rate_check{ color: orange;}
   .rate_check:hover{color: orange;}
   .remove_icon{ color: red;  display: none;}
</style>
<div class="card border-0" style="margin: 20px;">
   <div class="card-body p-0">  
      <div class="container"> 
         <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_story_frm">
            <div class="row">
               <div class="col-md-12">
                  <div class="wizard-left pr-0">                    
                     <div class="clearfix"></div>
                     <div class="row" id="add_story_data">
                        <div class="col-sm-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Resort 
                                 </label>
                                 <select name="resort_id" class="form-control">
                                    <option value=""> Select Resort</option>
                                    <?php
                                    if(!empty($resorts)){
                                       foreach ($resorts as $resort) {
                                          if(!empty($row->resort_id)&&$row->resort_id==$resort->id){
                                             echo '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                          }else{
                                             echo '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                          }
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Title
                                 </label>
                                 <input type="text" name="title" class="form-control" value="<?php echo !empty($row->title)?$row->title:''; ?>" placeholder="Story Title">
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Description
                                 </label>
                                 <textarea rows="10" name="desciption" class="form-control" placeholder="desciption "><?php echo !empty($row->description)?$row->description:''; ?></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="wizard-right">
                              <div class="form-group">
                                 <div class="file-upload" id="logo_img_main_i">
                                    <div class="clearfix"></div>
                                    <div class="image-upload-wrap">
                                       <input class="file-upload-input"  type='file' accept="image/*" id="BannerImg" onchange="uploadLogo();" multiple="multiple" />
                                       <div class="drag-text">
                                          <h3>
                                             <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                             <div class="clearfix"></div>
                                                Upload your Banner
                                             <div class="clearfix"></div>
                                             <small>Just drop them here</small>
                                             <div class="clearfix"></div>
                                             <small>
                                                <em class="underline">
                                                   Browse your Banner
                                                </em>
                                             </small> 
                                             <ul class="note-msg">
                                                <li>                                
                                                   The image should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
                                                </li> 
                                                <li>
                                                   image need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                                                </li> 
                                                <li>
                                                  Image can be maximum <span>10 MB</span> size
                                                </li>
                                             </ul>
                                          </h3>
                                       </div>
                                    </div>
                                    <div id="story_images_error" class="error"></div>
                                    <div id="story_images_main">
                                     <?php 
                                     
                                     if(!empty($images)){ 
                                       foreach ($images as $image) {
                                         if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){
                                             $randT      = rand(000,999).time();
                                         $deletImg   = "deleteStoryImage('".$randT."','".$image->image_name."', '".$image->id."')";
                                             $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                           echo $html;
                                         }
                                       }
                                     }
                                     ?>
                                    </div>
                                    <input type="hidden" name="story_images" id="story_images">
                                    <input type="hidden" id="storyImagesCount" value="<?php echo !empty($images)?count($images):0;?>">   
                                    <div class="clearfix"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="text-center col-md-12"> 
                  <input type="hidden" name="story_id" id="story_id" value="<?php echo !empty($row->id)?$row->id:'';?>">
                  <button type="submit" class="btn-next">
                    Submit
                  </button>
               </div>
               <div id="add_story_res"></div>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   <?php if(!empty($row->image_name)){ ?>
      setTimeout(function(){ 
         $('#logo_img_main_i .file-upload-content').show();
         $('#logo_img_main_i .image-upload-wrap').hide();
      }, 1500);
   <?php }?>
   function set_rate(category_id,rate){
      $('#'+category_id).val(rate);
      for(rt=1;rt<=5;rt++){
         if(rt<=rate){
            $('#'+category_id+'_'+rt).addClass('rate_check').html('<i class="fa fa-star"></i>');
         }else{
            $('#'+category_id+'_'+rt).removeClass('rate_check').html('<i class="fa fa-star-o"></i>');
         }
      }
   }
   $('#add_story_frm').validate({
      rules: {
         resort_id: {required: true},
         title: {required: true},
         desciption: {required: true},         
      },
      messages: {
         resort_id:{ required:"The resort is required"},
         title:{ required:"The title is required"},
         desciption:{ required:"The desciption is required"},
      },
      submitHandler: function(form) {
         $.ajax({ 
            url:base_url+"user/add_resort_story_res",
            type:"POST",
            data:$("#add_story_frm" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.type=='add'&&response.status=='true'){
                  $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                  $("#add_story_frm")[0].reset();
                  $('#logo_name, #logo_img_main').val('');
                  $('#story_images_main').hide();
                  $('#logo_img_main_i .image-upload-wrap').show();
               }else if(response.status=='true'){
                 $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }else{ 
                  $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   }); 
   /*function uploadLogo() {
      var files    = document.getElementById('BannerImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('resort_story_pic', 'yes');   
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
            if(res.statuss=='true'){
               $('#logo_img_main').html(res.html);
               $('#logo_name').val(res.file_name);  
               $('#logo_img_main .file-upload-content').show();
               $('#logo_img_main_i .image-upload-wrap').hide();
            }else{       
               $('#logo_file_type_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }*/
   function uploadLogo(){
      var files           = document.getElementById('BannerImg').files;
      var resortImgCount  = $('#storyImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>5){
         $('#story_images_error').show().html('You can`t upload more than 5 images');
         $('.loader_profile_left').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
            formData.append('traveller_story_image_pic', 'yes');   
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
                  if(res.statuss=='true'){
                     $('#story_images_main').append(res.html);
                     var filenames = $('#story_images').val();
                     if(filenames!=''){
                         $('#story_images').val(filenames+','+res.file_name);
                     }else{
                        $('#story_images').val(res.file_name);
                     }
                     $('#story_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#storyImagesCount').val())+parseInt(1);  
                     $('#storyImagesCount').val(resortImgCount);
                     $('#story_images_error').hide();
                     /*$('#story_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#story_images_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
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
   function deleteStoryImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#storyImagesCount').val())-parseInt(1);  
            $('#storyImagesCount').val(resortImgCount);
            var all_images = $('#story_images').val(); 
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
            $('#story_images').val(imageName);
         }
      });
   }  
</script>