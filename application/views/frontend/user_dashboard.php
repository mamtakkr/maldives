
<!--== RESORT START ==-->
<?php
   if($this->input->get('type')&&$this->input->get('type')=='add_story'){
      echo '<style type="text/css"> #add_contribution{ display:block;} #contribution_list{display:none;} </style>';
   }else{
      echo '<style type="text/css"> #add_contribution{display:none;} #contribution_list{display:block;} </style>';
   } 
?>
<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/custom.css" type="text/css">
<link href="<?php echo  FRONT_THEAM_PATH ;?>css/dev.css" rel="stylesheet" type="text/css">
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/popper.min.js"></script> 
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/bootstrap.min.js"></script> 
<script src="<?php echo FRONT_THEAM_PATH; ?>js/alertify.min.js"></script>  

<script type="text/javascript">
   function resort_story(){      
      $('#resort_stories_tab_title').html('Resort Stories');
      $.ajax({ 
         url:"<?php echo base_url(); ?>user/resort_story",
         type:"GET",
         success: function(html){
            $('#resort_story_main_tab').show().html(html);
            $('#add_resort_story_main_tab').hide().html('');
         }                 
      });
   }

   function left_tab_cl_new(type=''){
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
      if(type=='activities'){
         $.ajax({ 
            url:base_url+"user/read_activities",
            type:"GET",
            success: function(html){  
               $('#guest_activities_counter').hide().html('');
            }                 
         });
      }
      if(type=='user_favorites'){
         $.ajax({ 
            url:base_url+"user/read_favorites",
            type:"GET",
            success: function(html){  
               $('#favorites_counter').hide().html('');
            }                 
         });
      }     
   }   
</script>
<?php 
   $guest_activities_count = get_all_count('guest_activities', array('read_status'=>0, 'notified_user'=>user_id())); 
   $favroutes_count = get_all_count('resorts_likes', array('read_status'=>0, 'user_id'=>user_id())); 
?>
<section class="resort bg-transparent pb-0 new_hotal_fds">
   <div class="container-fluid p-0">
   <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn slide-toggle"> <i class="glyphicon glyphicon-align-left"></i> <span><i class="fa fa-arrow-left" aria-hidden="true"></i></span> </button>    
      <div class="dashboard">
         <!-- Sidebar Holder -->
              <div id="sidebar">
                        <ul class="nav" id="myTab" role="tablist">
                           <li class="nav-item w-100"> 
                              <a class="nav-link <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"":"active";?>" id="contributions-tab" href="#contributions"  role="tab" aria-controls="contact" aria-selected="true" onclick="show_contributions();"  data-toggle="tab"><i class="fa fa-commenting-o" aria-hidden="true"></i> Contributions</a> 
                           </li>
                           <li class="nav-item w-100"> 
                              <a class="nav-link" id="user_profile-tab"  href="#user_profile" role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a> 
                           </li>
                           <li class="nav-item w-100"> 
                              <a class="nav-link" id="user_setting-tab"  href="#user_setting" role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Setting</a></li>
                           <li class="nav-item w-100"> 
                              <a class="nav-link <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"active":"";?>" id="blog_list-tab" onclick="left_tab_cl_new('blog_list');" href="#blog_list"  role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i> Blogs  </a> 
                           </li>
                           <li class="nav-item w-100"> 
                              <a class="nav-link counter_main" id="user_favorites-tab"  href="#user_favorites" role="tab" aria-controls="contact" onclick="left_tab_cl_new('user_favorites');" aria-selected="false"  data-toggle="tab"><i class="fa fa-heart-o" aria-hidden="true"></i> Favorites <?php echo !empty($favroutes_count)?'<span id="favorites_counter">'.$favroutes_count.'</span></a>':'';?></a> 
                           </li>
                           <li class="nav-item w-100"> 
                              <a class="nav-link counter_main" id="guest_activities-tab" onclick="left_tab_cl_new('activities');" href="#guest_activities"  role="tab" aria-controls="contact" aria-selected="false"  data-toggle="tab"><i class="fa fa-history" aria-hidden="true"></i> Activities <?php echo !empty($guest_activities_count)?'<span id="guest_activities_counter">'.$guest_activities_count.'</span></a>':'';?>
                           </li>
                           <li class="nav-item w-100"> 
                              <a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> 
                           </li>               
                        </ul>
                     </div>
     
     
         <!-- Page Content Holder -->
         <div id="content">
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"":"show active";?>" id="contributions" role="tabpanel" aria-labelledby="contributions-tab">
                  <div class="pr-0" id="contribution_list">
                     <?php include('contributions_list.php'); ?>
                  </div>
                  <div class="pr-0" id="add_contribution">
                     <?php include('add_story.php'); ?>
                   </div>
               </div>
               <?php 
                  include('user_profile_setting.php');
               ?>  
               <div class="tab-pane fade <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"show active":"";?>" id="user_favorites" role="tabpanel" aria-labelledby="user_favorites-tab">
                  <div class="pr-0">
                     <div class="resort-title-card">
                        <div class="row">
                           <div class="col-7">
                              <h6 id="favorites_tab">Favorites Resorts</h6>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div id="blogs_response"></div>
                     <div class="row" id="user_favorites_list"><?php include('favorites_resort_list.php'); ?></div>
                     <div class="clearfix"></div>
                  </div>
               </div> 
               <div class="tab-pane fade" id="guest_activities" role="tabpanel" aria-labelledby="guest_activities-tab">                 
                  <?php include('guest_activities.php'); ?> 
               </div>
               <div class="tab-pane fade <?php echo ($this->input->get('type')=='add_blog'||$this->input->get('type')=='blog')?"show active":"";?>" id="blog_list" role="tabpanel" aria-labelledby="resort_story_list-tab">
                  <div class="pr-0">
                     <div class="resort-title-card">
                        <div class="row">
                           <div class="col-7">
                              <h6 id="blog_title_tab"><?php if($this->input->get('blog_id')&&$this->input->get('type')&&$this->input->get('type')=='add_blog'){echo "Edit Blog";}else if($this->input->get('type')&&$this->input->get('type')=='add_blog'){echo "Add Blog";}else{echo "Blog List";} ?></h6>
                           </div>
                           <div class="col-5 add-resort">
                              <a href="javascript:void(0);" onclick="add_blog();" class="btn btn-primary">
                                 Add Blog
                              </a>
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
   $('#user_signup').validate({
      rules: {
         first_name: {required: true},
         last_name: {required: true},
         country_id: {required: true},
       },
      messages: { 
        first_name:{ required:"The first name is required"},
        last_name:{ required:"The last name is required"},
        country_id:{ required:"The country is required"},
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
   function delete_resort(resort_id){
      alertify.confirm("Are you sure you want to delete this resort?", function (e) {
         if (e) {  
            $.ajax({ 
               url:"<?php echo base_url().'home/delete_resort'; ?>",
               type:"GET",
               data:{resort_id:resort_id}, 
               success: function(html){
                  $('#resort_row_'+resort_id).hide(); 
                  $('#dashboard_response').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+html+'</div>');
               }
            });
         }
      });
   } 
   function delete_favorites_resort(resort_id){
      alertify.confirm("Are you sure you want to remove this resort from favorites list?", function (e) {
         if (e) {  
            $.ajax({ 
               url:"<?php echo base_url().'home/delete_favorites_resort'; ?>",
               type:"GET",
               data:{resort_id:resort_id}, 
               success: function(html){
                  $('#resort_row_'+resort_id).hide(); 
                  $('#dashboard_response').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+html+'</div>');
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
         success: function(url){
            window.location.href=url;
         }                 
      });
   } 
   function delete_story(story_id=''){
      alertify.confirm("Are you sure you want to delete this traveller story?", function (e) {
         if (e) {  
            $.ajax({ 
               url:base_url+"home/delete_story",
               type:"POST",
               data:{'story_id':story_id},
               success: function(){
                  $('#story_'+story_id).hide();
               }                 
            });
         }
      });
   } 
   function show_contributions(){
      $('#add_contribution').hide();
      $('#contribution_list').show();
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
   <?php 
   if($this->input->get('type')&&$this->input->get('type')=='blog'){?>
      setTimeout(function(){  left_tab_cl_new('blog_list'); }, 1500);
   <?php }?>
</script>
 <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
         function open_traveller_stories_images(counter='',max_counter='', image_path='', story_id=''){
    $('#traveller_stories_images').attr('src', '<?php echo base_url().'uploads/resorts/full_image/1300_';?>'+image_path);
    $('#traveller_stories_images').show();
    $('#current_traveller_img').val(counter);
    $('#current_traveller_max').val(max_counter);
    $('#current_traveller_story_id').val(story_id);
    if(parseInt(counter)==parseInt(1)){
      $('.left_traveller_storie').hide();
    }else{
      $('.left_traveller_storie').show();
    }
    if(parseInt(max_counter)==parseInt(counter)){
      $('.right_traveller_stories').hide();
    }else{
      $('.right_traveller_stories').show();
    }
  }
  function left_traveller_stories(){
    var counter = parseInt($('#current_traveller_img').val())-parseInt(1);
    var max_counter = $('#current_traveller_max').val();
    if(parseInt(counter)==parseInt(1)){
      $('.left_traveller_storie').hide();
    }else{
      $('.left_traveller_storie').show();
    }
    if(parseInt(max_counter)==parseInt(counter)){
      $('.right_traveller_stories').hide();
    }else{
      $('.right_traveller_stories').show();
    }
    var current_traveller_story_id = $('#current_traveller_story_id').val();
    var image_path = $('#traveller_stories_'+current_traveller_story_id+'_'+counter).attr('data-image');
    $('#traveller_stories_images').attr('src', '<?php echo base_url().'uploads/resorts/full_image/1300_';?>'+image_path);
    $('#current_traveller_img').val(counter);
  }
  function right_traveller_stories(){
    var counter = parseInt($('#current_traveller_img').val())+parseInt(1);
    var max_counter = $('#current_traveller_max').val();
    if(parseInt(max_counter)==parseInt(counter)){
      $('.right_traveller_stories').hide();
    }else{
      $('.right_traveller_stories').show();
    }
    if(parseInt(counter)==parseInt(1)){
      $('.left_traveller_storie').hide();
    }else{
      $('.left_traveller_storie').show();
    }
    var current_traveller_story_id = $('#current_traveller_story_id').val();
    var image_path = $('#traveller_stories_'+current_traveller_story_id+'_'+counter).attr('data-image');
    $('#traveller_stories_images').attr('src', '<?php echo base_url().'uploads/resorts/full_image/1300_';?>'+image_path);
    $('#current_traveller_img').val(counter);
  }
</script>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body" style="position: relative;">
          <a href="javascript:void(0);" class="left_traveller_storie" onclick="left_traveller_stories();"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
          <a href="javascript:void(0);" class="right_traveller_stories" onclick="right_traveller_stories();"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
          <input type="hidden" id="current_traveller_img">
          <input type="hidden" id="current_traveller_story_id">
          <input type="hidden" id="current_traveller_max">
          <img id="traveller_stories_images" src="https://www.maldivesexperts.com/uploads/resorts/57d5a795e936302216668fba828a5e23.png" class="galleryd" style="width:100%;">    
        </div>        
      </div>
    </div>
  </div>
  <script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
