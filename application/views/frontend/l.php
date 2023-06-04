<link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<style type="text/css">
   .rate_check{ color: orange;}
   .rate_check:hover{color: orange;}
   .remove_icon{ color: red;  display: none;}
   .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white;
}
.bootstrap-tagsinput{ 
  width: 100% !important; 
  height: calc(2.70rem + 2px) !important;
  padding: .375rem .75rem !important;  
  background-clip: padding-box !important;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  line-height: 1.5 !important;
  font-size: 1rem !important;
  font-weight: 400;
}
.label-info {
    background-color: #5bc0de;
}
.bootstrap-tagsinput .label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
</style>
<div class="wrapper" style="margin: 20px;">
   <div class="card border-0">
      <div class="card-body p-0">  
         <div class="container"> 
            <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_blog_frm">
               <div class="row">
                  <div class="col-md-12">
                     <div class="wizard-left pr-0">
                        <div class="clearfix"></div>
                        <div class="row" id="add_story_data">
                           <div class="col-sm-6">
                              <div class="resort-option">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">
                                       Title
                                    </label>
                                    <input type="text" name="news_title" class="form-control" value="<?php echo !empty($blog->news_title)?$blog->news_title:''; ?>" placeholder="Blog Title">
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="resort-option">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">
                                       Tags
                                    </label>
                                    <input type="text" name="tags" class="form-control" value="<?php echo !empty($blog->tags)?$blog->tags:''; ?>" placeholder="Enter tags" data-role="tagsinput">
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="resort-option">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">
                                       Description
                                    </label>
                                    <textarea rows="10" name="news_description" class="form-control tinymce_edittor" placeholder="desciption "><?php echo !empty($blog->news_description)?$blog->news_description:''; ?></textarea>
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
                                                   Upload your image
                                                <div class="clearfix"></div>
                                                <small>Just drop them here</small>
                                                <div class="clearfix"></div>
                                                <small>
                                                   <em class="underline">
                                                      Browse your image
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
                                       <div id="blog_images_error" class="error"></div>
                                       <div id="blog_images_main">
                                        <?php 
                                        if(!empty($blog_images)){ 
                                          foreach ($blog_images as $image) {
                                            if(!empty($image->image_name)&&file_exists('uploads/blogs/'.$image->image_name)){
                                                $randT      = rand(000,999).time();
                                            $deletImg   = "deleteStoryImage('".$randT."','".$image->image_name."', '".$image->id."')";
                                                $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/blogs/'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                              echo $html;
                                            }
                                          }
                                        }
                                        ?>
                                       </div>
                                       <input type="hidden" name="blog_images" id="blog_images">
                                       <input type="hidden" id="blogImagesCoun" value="<?php echo !empty($images)?count($images):0;?>">   
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="text-center col-md-12"> 
                     <input type="hidden" name="blog_id" value="<?php echo !empty($blog->id)?$blog->id:'';?>">
                     <button type="submit" class="btn-next">
                       Submit
                     </button>
                  </div>
                  <div id="add_blog_res"></div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
  <script type="text/javascript">
   <?php if(!empty($blog_images)){  ?>
      setTimeout(function(){ 
         $('#logo_img_main_i .file-upload-content').show();
         /*$('#logo_img_main_i .image-upload-wrap').hide();*/
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
   $('#add_blog_frm').validate({
      rules: {
         news_title: {required: true},
         news_description: {required: true},         
      },
      messages: {
         news_title:{ required:"The title is required"},
         news_description:{ required:"The desciption is required"},
      },
      submitHandler: function(form) {
          $('#news_description').val(tinyMCE.get('news_description').getContent());
          $.ajax({ 
            url:base_url+"user/add_blog_res",
            type:"POST",
            data:$("#add_blog_frm" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.type=='add'&&response.status=='true'){
                  $('#add_blog_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                  $("#add_blog_frm")[0].reset();
                  $('#logo_name, #logo_img_main').val('');
                  $('#blog_images_main').hide();
                  $('#logo_img_main_i .image-upload-wrap').show();
                  setTimeout(function(){  
                    window.location.href ="<?php echo base_url('user/dashboard?type=blog'); ?>"; 
                  }, 1500);
               }else if(response.status=='true'){
                 $('#add_blog_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                 setTimeout(function(){  
                  window.location.href ="<?php echo base_url('user/dashboard?type=blog'); ?>"; 
                }, 1500);
               }else{ 
                  $('#add_blog_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   }); 
   function uploadLogo(){
      var files           = document.getElementById('BannerImg').files;
      var resortImgCount  = $('#blogImagesCoun').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>5){
         $('#blog_images_error').show().html('You can`t upload more than 5 images');
         $('.loader_profile_left').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
            formData.append('blog_img', 'yes');   
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
                     $('#blog_images_main').append(res.html);
                     var filenames = $('#blog_images').val();
                     if(filenames!=''){
                         $('#blog_images').val(filenames+','+res.file_name);
                     }else{
                        $('#blog_images').val(res.file_name);
                     }
                     $('#blog_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#blogImagesCoun').val())+parseInt(1);  
                     $('#blogImagesCoun').val(resortImgCount);
                     $('#blog_images_error').hide();
                     /*$('#blog_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#blog_images_error').show().html(res.message);
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
            var resortImgCount = parseInt($('#blogImagesCoun').val())-parseInt(1);  
            $('#blogImagesCoun').val(resortImgCount);
            var all_images = $('#blog_images').val(); 
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
            $('#blog_images').val(imageName);
         }
      });
   }  
</script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yce0zaitd65hrxhga40mxmc5pcydv134y1b8jjvk5pzfopvx"></script>
<script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_edittor',
    height: 250,
    menubar: true,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor textcolor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code help wordcount'
    ],
    toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'],
      // without images_upload_url set, Upload tab won't show up
    images_upload_url: '<?php echo ADMIN_URL; ?>superadmin/uploadFileEditor',      
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;        
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?php echo ADMIN_URL; ?>superadmin/uploadFileEditor');        
        xhr.onload = function() {
            var json;          
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }          
            json = JSON.parse(xhr.responseText);  
            if (json.status==false) {
                failure('Invalid JSON: ' + json.message);
                return;
            }          
            success(json.location);
        };        
        formData = new FormData();
        formData.append('user_img', blobInfo.blob(), blobInfo.filename());        
        xhr.send(formData);
    },
  }); 
</script>  