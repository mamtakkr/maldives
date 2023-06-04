<!--== RESORT START ==-->
<?php
   if($this->input->get('type')&&$this->input->get('type')=='add_story'){
      echo '<style type="text/css"> #add_contribution{ display:block;} #contributions_list{display:none;} </style>';
   }else{
      echo '<style type="text/css"> #add_contribution{display:none;} #contributions_list{display:block;} </style>';
   } 
   ?>
<link rel="stylesheet" href="<?php echo base_url('assets/front/data_table/jquery.dataTables.min.css'); ?>">
<section class="resort bg-transparent pb-0 new_hotal_fds">
   <div class="container-fluid p-0">
      <div class="dashboard">
         <!-- Sidebar Holder -->
         <div id="sidebar">
            <ul class="nav" id="myTab" role="tablist">
               <li class="nav-item w-100"> 
                  <a class="nav-link <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog'||$this->input->get('type')=='story_list')?"":"active";?>" id="user_profile-tab"  onclick="left_tab_cl();" href="#user_profile" role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a> 
               </li>
               <li class="nav-item w-100"> 
                  <a class="nav-link" id="user_setting-tab" onclick="left_tab_cl();"  href="#user_setting" role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a> 
               </li>
               <li class="nav-item w-100"> 
                  <a class="nav-link" id="story_list-tab" onclick="left_tab_cl();" href="#story_list"  role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-commenting-o" aria-hidden="true"></i> Traveller Stories</a> 
               </li>
               <li class="nav-item w-100"> 
                  <a class="nav-link" id="resort_story_list-tab" onclick="left_tab_cl('resort_story');" href="#resort_story_list"  role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-commenting" aria-hidden="true"></i> Resort Stories </a> 
               </li>
               <li class="nav-item w-100"> 
                  <a class="nav-link <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"active":"";?>" id="blog_list-tab" onclick="left_tab_cl('blog_list');" href="#blog_list"  role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i> Blogs  </a> 
               </li>
               <li class="nav-item w-100"> 
                  <a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> 
               </li>
            </ul>
         </div>
         <!-- Page Content Holder -->
         <div id="content">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn slide-toggle mt-3"> 
            <i class="glyphicon glyphicon-align-left"></i> 
            <span><i class="fa fa-arrow-left" aria-hidden="true"></i></span> 
            </button>
            <div class="tab-content" id="myTabContent">               
               <?php 
                  include('sub_admin_profile_setting.php');
               ?> 
               <div class="tab-pane fade <?php echo ($this->input->get('type')=='story_list')?"show active":"";?>" id="story_list" role="tabpanel" aria-labelledby="story_list-tab">
                  <div class="dashboard-wrapper">
                     <?php include('contributions_list.php'); ?>                     
                  </div>
               </div>
               <div class="tab-pane fade" id="resort_story_list" role="tabpanel" aria-labelledby="resort_story_list-tab">
                  <div class="pr-0">
                     <div class="resort-title-card">
                        <div class="row">
                           <div class="col-7">
                              <h6 id="resort_stories_tab_title">Resort Stories</h6>
                           </div>
                           <div class="col-5 add-resort">
                              <a href="javascript:void(0);" onclick="add_resort_story();" class="btn btn-primary">
                              Add Resort Story
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="row" id="resort_story_main_tab">
                     </div>
                     <div class="row" id="add_resort_story_main_tab">
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="tab-pane fade <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"show active":"";?>" id="blog_list" role="tabpanel" aria-labelledby="blog_list-tab">
                  <div class="pr-0">
                     <div class="resort-title-card">
                        <div class="row">
                           <div class="col-7">
                              <h6 id="blog_title_tab"><?php if($this->input->get('blog_id')&&$this->input->get('type')&&$this->input->get('type')=='add_blog'){echo "Edit Blog";}else if($this->input->get('type')&&$this->input->get('type')=='add_blog'){echo "Add Blog";}else{echo "Blog List";} ?></h6>
                           </div>
                           <div class="col-5 add-resort">
                              <a href="javascript:void(0);" onclick="add_blog();" class="btn btn-primary">Add Blog</a>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="blogs_response"></div>
                     <div class="row" id="blog_main_list">                        
                     </div>
                     <div class="row" id="add_main_blog"><?php ($this->input->get('type')&&$this->input->get('type')=='add_blog')?include('add_blog.php'):""; ?></div>
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>
</section>
<div class="clearfix"></div>
<script type="text/javascript">
   $('#user_signup').validate({
      rules: {
         hotel_name: {required: true},
       },
      messages: { 
        hotel_name:{ required:"The hotel name is required"},
      },
      submitHandler: function(form) {      
         $.ajax({ 
            url:base_url+"user/update_profile_res",
            type:"POST",
            data:$( "#user_signup" ).serialize(), 
            success: function(html){ 
               var response = $.parseJSON(html);  
               if(response.status=='true'){ 
                   $('#user_signup_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');        
               }else{ 
                  $('#user_signup_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }
         }); 
      }
   });
   $('#change_password_frm').validate({
      rules: {
         old_password: {required: true},
         new_password: {required: true},
         confirm_password: {required: true, equalTo: "#new_password"},
       },
      messages: { 
        old_password:{ required:"The old password is required"},
        new_password:{ required:"The new password is required"},
        confirm_password:{ required:"The confirm password is required", equalTo:"The password field does not match the confirm password field"},
      },
      submitHandler: function(form) {      
         $.ajax({ 
            url:base_url+"user/change_password_res",
            type:"POST",
            data:$( "#change_password_frm" ).serialize(), 
            success: function(html){ 
               var response = $.parseJSON(html);  
               if(response.status=='true'){ 
                  $('#change_password_frm')[0].reset();
                  $('#change_password_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');        
               }else{ 
                  $('#change_password_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }
         }); 
      }
   })
   function setUploadProfile(){
      $('#user_profile_pic').click();
   }
   function uploadProfile() {
      var files    = document.getElementById('user_profile_pic').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('profile_pic', 'yes');   
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
            $('.loader_profile_left').hide();
            if(res.statuss=='true'){
               $('#user_profile_image, #user_profile_image_header').attr('src', res.imgFullPath); 
               $('#logo_file_type_error, #logo_name-error').hide();
            }else{       
               $('#logo_file_type_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }   
   function delete_blog(blog_id){
      alertify.confirm("Are you sure you want to delete this blog?", function (e) {
         if (e) {  
            $.ajax({ 
               url:"<?php echo base_url().'home/delete_blog'; ?>",
               type:"POST",
               data:{blog_id:blog_id}, 
               success: function(html){
                  var res = JSON.parse(html); 
                  $('#blog_'+blog_id).hide(); 
                  $('#blogs_response').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+res.message+'</div>');
               }
            });
         }
      });
   } 
   function delete_resort(resort_id){
      alertify.confirm("Are you sure you want to delete this resort?", function (e) {
         if (e) {  
            $.ajax({ 
               url:"<?php echo base_url().'home/delete_resort'; ?>",
               type:"POST",
               data:{resort_id:resort_id}, 
               success: function(html){
                  var res = JSON.parse(html); 
                  $('#resort_row_'+resort_id).hide(); 
                  $('#dashboard_response').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+res.message+'</div>');
               }
            });
         }
      });
   } 
   function delete_sub_admin(admin_id){
      alertify.confirm("Are you sure you want to delete this sub admin?", function (e) {
         if (e) {  
            $.ajax({ 
               url:"<?php echo base_url().'user/delete_sub_admin'; ?>",
               type:"POST",
               data:{admin_id:admin_id}, 
               success: function(html){
                  var res = JSON.parse(html); 
                  $('#subadmin_'+admin_id).hide(); 
                  $('#sub_admin_response').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+res.message+'</div>');
               }
            });
         }
      });
   } 
   $(function(){
      $('body').on('click','ul#search_page_pagination>li>a',function(e){
         e.preventDefault();  // prevent default behaviour for anchor tag
         var Pagination_url = $(this).attr('href'); // getting href of <a> tag
      $('#preloaderMainss').show();
         $.ajax({
            url:Pagination_url,
            type:'GET',
            data:$("#search_filtersNews").serialize(), 
            success:function(data){
               var $page_data = $(data);
               $('#ajax_resultss').html($page_data.find('div#search_filter_result'));
               $('#preloaderMainss').hide();
               //window.scrollTo(500, 0);
            }
         });
      });
   }); 
   function form_filter(){
      $.ajax({
         url:'<?php echo base_url('user/user_resort_list'); ?>',
         type:'GET',
         data:$("#search_filtersNews").serialize(), 
         success:function(data){
          var $page_data = $(data);
          $('#preloaderMainss').hide();
          $('#ajax_resultss').html($page_data.find('div#search_filter_result'));
          $('#sort_order').val('');
         }
      });
   }
   $(document).ready(function() {
      var showChar = 330;
      var ellipsestext = "...";
      var moretext = "more";
      var lesstext = "less";
      $('.more').each(function() {
         var content = $(this).html();
         if(content.length > showChar) {
           var c = content.substr(0, showChar);
           var h = content.substr(showChar-1, content.length - showChar);
           var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
   
           $(this).html(html);
         }
      });
      $(".morelink").click(function(){
         if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
         } else {
            $(this).addClass("less");
            $(this).html(lesstext);
         }
         $(this).parent().prev().toggle();
         $(this).prev().toggle();
         return false;
      });
   });
</script>
<script type="text/javascript"> 
   function edit_story(story_id){
      $.ajax({ 
         url:base_url+"user/edit_story?story_id="+story_id,
         type:"GET",
         success: function(html){
            $('#add_contribution').show().html(html);
            $('#contributions_list').hide();
         }                 
      });
   }    
   $(document).ready(function () {
   $('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
   });
   });
   function left_tab_cl(type=''){
      var width = $(window).width();
      if(width<=768){          
         $('#sidebar').toggleClass('active');
      }
      if(type=='blog_list'){
         blog_list();
      }
      if(type=='resort_story'){
         resort_story();
      }  
      if(type=='sub_admin'){
         sub_admin_list();
      }  
   }
   function sub_admin_list(){
      $('#blog_title_tab').html('Sub Admin List');
      $.ajax({ 
         url:base_url+"user/sub_admin_list",
         type:"GET",
         success: function(html){  
            $('#sub_admin_main_list').show().html(html);
            $('#add_main_sub_admin').hide().html('');
         }                 
      });
   }
   function add_sub_admin(admin_id=''){
      if(admin_id){
         $('#blog_title_tab').html('Edit blog');
         window.location.href="<?php echo base_url('user/dashboard?type=add_sub_admin&admin_id='); ?>"+admin_id;
      }else{
         $('#blog_title_tab').html('Add blog');
         window.location.href="<?php echo base_url('user/dashboard?type=add_sub_admin'); ?>";
      }
      $.ajax({ 
         url:base_url+"user/add_blog?admin_id="+admin_id,
         type:"GET",
         success: function(html){  
            $('#add_main_blog').show().html(html);
            $('#blog_main_list').hide();
         }                 
      });
   }
   function verify_now(story_id){
      alertify.confirm("Are you sure you want to approve this traveller story.", function (e) {
        if (e) {
          window.location.href= "<?php echo base_url(); ?>home/approve_traveller_story?story_id="+story_id
        }
      });
   }
   function open_story_imgs(story_id=''){
      $.ajax({ 
         url:base_url+"home/get_story_imgs?story_id="+story_id,
         type:"GET",
         success: function(html){
            $('#story_images_data').html(html);
         }                
      }); 
   }     
   function blog_list(){
      $('#blog_title_tab').html('Blog List');
      $.ajax({ 
         url:base_url+"user/blog_list",
         type:"GET",
         success: function(html){  
            $('#blog_main_list').show().html(html);
            $('#add_main_blog').hide().html('');
         }                 
      });
   }
   function add_blog(blog_id=''){
      if(blog_id){
         $('#blog_title_tab').html('Edit blog');
         window.location.href="<?php echo base_url('user/dashboard?type=add_blog&blog_id='); ?>"+blog_id;
      }else{
         $('#blog_title_tab').html('Add blog');
         window.location.href="<?php echo base_url('user/dashboard?type=add_blog'); ?>";
      }
      $.ajax({ 
         url:base_url+"user/add_blog?blog_id="+blog_id,
         type:"GET",
         success: function(html){  
            $('#add_main_blog').show().html(html);
            $('#blog_main_list').hide();
         }                 
      });
   }
   function resort_story(){
      $.ajax({ 
         url:base_url+"user/resort_story",
         type:"GET",
         success: function(html){  
            $('#resort_story_main_tab').show().html(html);
            $('#add_resort_story_main_tab').hide().html('');
         }                 
      });
   }
   function add_resort_story(story_id=''){
      if(story_id){
         $('#resort_stories_tab_title').html('Edit Resort Story');
      }else{
         $('#resort_stories_tab_title').html('Add Resort Story');
      }
      $.ajax({ 
         url:base_url+"user/add_resort_story?story_id="+story_id,
         type:"GET",
         success: function(html){  
            $('#add_resort_story_main_tab').show().html(html);
            $('#resort_story_main_tab').hide();
         }                 
      });
   }
</script>
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
<script src="<?php echo base_url('assets/front/data_table/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript">
   function delete_story(story_id){
      alertify.confirm("Are you sure you want to delete this story?", function (e) {
         if (e) {       
            $.ajax({ 
               url:base_url+"home/delete_resort_story",
               type:"POST",
               data:{story_id:story_id}, 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){
                     $('#story_'+story_id).hide(); 
                  }
               }                
            });
         }
      });
   }
   $(document).ready(function() {
    var oTable= $('#Guest_Activities_tab').DataTable({
      "aoColumns": [
                { "iDataSort": 1 },
                { "iDataSort": 2, "sClass": "center" },
                { "iDataSort": 3, "sClass": "center" },
                { "iDataSort": 4, "sClass": "center" },
                { "iDataSort": 5, "sClass": "center" },
            ],
      "sPaginationType": "full_numbers",
        "Retrieve": true,
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "iDisplayLength":25,
        "aaSorting": [],
        "ajax": "<?php echo base_url('user/user_activity_list'); ?>",
    } );
} );
<?php 
if($this->input->get('type')&&$this->input->get('type')=='blog'){?>
   setTimeout(function(){  blog_list(); }, 1500);
<?php }
if($this->input->get('type')&&$this->input->get('type')=='sub_admin'){?>
   setTimeout(function(){  sub_admin_list(); }, 1500);
<?php }
?>
</script> 
