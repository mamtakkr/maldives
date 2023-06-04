<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
</div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     <!--  <b>Version</b> 2.4.0 -->
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> </a>.</strong> All rights   reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script type="text/javascript">
  var superadmin_url = "<?php echo ADMIN_URL; ?>";
  var base_url       = "<?php echo base_url(); ?>";
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo ADMIN_THEAM_PATH ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo ADMIN_THEAM_PATH ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ADMIN_THEAM_PATH ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo ADMIN_THEAM_PATH ?>dist/js/demo.js"></script>
<script src="<?php echo ADMIN_THEAM_PATH;?>js/alertify.min.js"></script> 
<script src="<?php echo ADMIN_THEAM_PATH;?>js/jquery.validate.min.js"></script> 
<script src="<?php echo ADMIN_THEAM_PATH;?>js/backend_js_validation.js"></script> 
<script src="<?php echo ADMIN_THEAM_PATH;?>js/jquery.fancybox.js"></script> 
<!-- datepicker js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
<script type="text/javascript">
    $(document).ready(function() {
      $(".datepickerLastToday").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        minDate:0
      }); 
    });
    function changeFavStatus(id, status,statusType){
      alertify.confirm("Are you sure you want to "+statusType+"", function (e) {
        if (e) {
          window.location.href="<?php echo ADMIN_URL?>superadmin/changeFavStatus/"+id+'/'+status;
        }
      });
    }
    function changeUserStatus(user_id,user_status,statusType){
      alertify.confirm("Are you sure you want to "+statusType+" this user.", function (e) {
        if (e) {
          window.location.href="<?php echo ADMIN_URL?>superadmin/changeStatus/users/User/"+user_id+'/'+user_status;
        }
      });
    }
    function ApproveReviewStatus1(story_id){
      alertify.confirm("Are you sure you want to approve this traveller story.", function (e) {
        if (e) {
          window.location.href="<?php echo ADMIN_URL?>resorts/approve_traveller_story/"+story_id;
          /*$('#story_id').val(story_id);          
          $('#review_status_modal').modal('show');*/
        }
      });
    }
    
    function ApproveReviewStatus(story_id){
      alertify.confirm("Are you sure you want to approve this traveller story.", function (e) {
        if (e) {
          window.location.href="<?php echo ADMIN_URL?>resorts/approve_reort_story/"+story_id;
          /*$('#story_id').val(story_id);          
          $('#review_status_modal').modal('show');*/
        }
      });
    }
    
    function changeStatus(table, title, id, status,statusType, key,column,permanentDelete){
      alertify.confirm("Are you sure you want to "+statusType+" this "+title+"?", function (e) {
        if (e) {
          var ajxUrl = "<?php echo ADMIN_URL.'superadmin/changeStatus';?>";
          if(table){ajxUrl += "/"+table;}
          if(title){ajxUrl += "/"+title;}
          if(id){ajxUrl += "/"+id;}
          if(status){ajxUrl += "/"+status;}
          if(statusType){ajxUrl += "/"+statusType;}
          if(key){ajxUrl += "/"+key;}
          if(column){ajxUrl += "/"+column;}
          if(permanentDelete){ajxUrl += "/"+permanentDelete;}
          //alert("ajxUrl = "+ajxUrl);
          window.location.href= ajxUrl;
        }
      });
    }
    $("#date_picker1, #date_picker2, .date_picker, .datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    }); 
    $("#date_of_birth").datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: '-18Y',
      dateFormat: 'yy-mm-dd',
    }); 
    function VerifyUser(user_id){
      alertify.confirm("Are you sure you want to verify this user email.", function (e) {
        if (e) {
          window.location.href="<?php echo ADMIN_URL;?>superadmin/changeVerifyStatus/"+user_id;
        }
      });
    }
    function VerifyUserEmail(user_id){
      window.location.href="<?php echo ADMIN_URL;?>superadmin/VerifyUserEmail/"+user_id;
    }
    function go_link(event, link){
      if (event.ctrlKey) {
        if(link!=''){
          window.open(link, "_blank");
        } 
      }else{
        if(link!=''){
          window.location.href = link;
        }
      }           
    }     
     /*common funcation */
    function uploadMultipleFileImage(fileCode, fileUpload, isImage){
      var files = document.getElementById('uploadFile'+fileCode).files; 
      var fileCounter = files.length;
      for(var i=0;i<fileCounter;i++){
        var file = files[i];
        uploadFile(file, i, file.type, fileCode, fileUpload, isImage, 1);
      }     
    }    
    /*common funcation */
    function uploadSingleFileImage(fileCode, fileUpload, isImage){
      var files = document.getElementById('uploadFile'+fileCode).files; 
      var file  = files[0];
      uploadFile(file, 0, file.type, fileCode, fileUpload, isImage, 0);   
    }
    function uploadFile(file, i,type, fileCode, fileUpload, isImage, multiPleImg){
      var xhr = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img', file);
      formData.append('fileUpload', fileUpload);
      formData.append('isImage', isImage);
      formData.append('multiPleImg', multiPleImg);
      xhr.open("POST", "<?php echo ADMIN_URL; ?>superadmin/uploadPics");
        xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {     
          var percentComplete = (e.loaded / e.total) * 100; 
          $('#preloaderMainss').show(); 
        }
      };
      xhr.onload = function() {
        if (this.status == 200) {
          var resp = this.response;
            console.log('resp'+resp);
            res = JSON.parse(resp); 
            $('#preloaderMainss').hide();        
            if(res.statuss=='true'){
              if(multiPleImg=='1'){                
                $('#file_html_'+fileCode).append(res.fileHtml);
                var filenames = $('#file_name_'+fileCode).val();
                if(filenames!=''){
                  $('#file_name_'+fileCode).val(filenames+','+res.file_name);
                }else{
                  $('#file_name_'+fileCode).val(res.file_name);
                }
              }else{                
                if(isImage==1){
                  $('#file_html_'+fileCode).html(res.thumb_pathHtml);
                }else{
                  $('#file_html_'+fileCode).html(res.fileHtml);
                }
                $('#file_name_'+fileCode).val(res.file_name);  
              }
            }else{    
              $('#file_html_'+fileCode+'_error').show().html(res.message);
           }
        };
      };      
      xhr.send(formData);  
    }
    function deleteImages(imageID,img,rowID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
        if (e) {
          var files_name = $('#file_name_'+rowID).val();  
          $('#'+imageID).hide();
          $.ajax({ 
            url:"<?php echo ADMIN_URL;?>superadmin/deleteImgs",
            type:"POST",
            data:{img:img, imageID:imageID,files_name:files_name}, 
            success: function(html){
              $('#file_name_'+rowID).val(html)
            }
          });
        }
      });
    }    
    function upperClick(counterID){     
      if($("#upper_"+counterID).prop('checked') == true){
        $('.lower_'+counterID).prop('checked', true);        
      }else{
        $('.lower_'+counterID).prop('checked', false);       
      }
    }
    function lowerClick(counterID){  
      var allCounter = $('.lower_'+counterID).length;
      var lowCounter = $('.lower_'+counterID+':checked').length;
      if(lowCounter==allCounter){
        $('#upper_'+counterID).prop('checked', true);        
      }else{
        $("#upper_"+counterID).prop('checked', false);       
      }
    }
    $(".only_number").keydown(function (e) {
      //console.log('keyCode = '+e.keyCode);
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,110, 190]) !== -1 ||
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
        (e.keyCode >= 35 && e.keyCode <= 40)||e.keyCode==16) {
        //console.log('up allow');
        return;      
      } 
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
       // console.log('not allow');
        e.preventDefault();
        // /alert('notallow');
      }
    }); 
</script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yce0zaitd65hrxhga40mxmc5pcydv134y1b8jjvk5pzfopvx"></script>
<script>
  tinymce.init({
      selector: '.tinymce_edittor',
      height: <?php echo ($this->uri->segment(3)=='addEmailTemplate')?600:250; ?>,
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
      images_upload_url: '<?php echo ADMIN_URL.'superadmin/uploadFileEditor'; ?>',      
      // override default upload handler to simulate successful upload
      images_upload_handler: function (blobInfo, success, failure) {
          var xhr, formData;        
          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', '<?php echo ADMIN_URL.'superadmin/uploadFileEditor'; ?>');        
          xhr.onload = function() {
              var json;          
              if (xhr.status != 200) {
                  failure('HTTP Error: ' + xhr.status);
                  return;
              }          
              json = JSON.parse(xhr.responseText);  
              if (json.status==false) {
                  //alertify.alert().set('message',  json.message).show(); 
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
  function loadTravellerMoreComment(story_id=''){
      var current_page   = $('#traveller_stories_comment_pages_'+story_id).val();
      var total_comments = $('#traveller_stories_total_comments_'+story_id).val();
      $.ajax({
         url:'<?php echo ADMIN_URL.'resorts/loadTravellerMoreComment'; ?>',
         type:'get',
         data:{'story_id':story_id, 'current_page':current_page, 'total_comments':total_comments}, 
         success:function(html){
            var response = $.parseJSON(html);
            $('#traveller_comment_list_'+story_id).append(response.html);
            $('#traveller_stories_comment_pages_'+story_id).val(response.current_page);
            if(response.more_comment=='show'){
               $('#traveller_stories_comment_more_'+story_id).show();
            }else{
               $('#traveller_stories_comment_more_'+story_id).hide();
            }
         }
      });
  }
  function story_comment_status(comment_id){
    var comment_id_status = $('#story_comment_status_'+comment_id).attr('data');
    if(comment_id_status==1){
      var comment_type = 'active';
    }else{
      var comment_type = 'block';
    }
    alertify.confirm("Are you sure you want to "+comment_type+" this comment?", function (e) {
      if (e) {
        $.ajax({
          url:'<?php echo ADMIN_URL.'resorts/story_comment_status'; ?>',
          type:'get',
          data:{'comment_id':comment_id, 'comment_type':comment_type, 'type':'all'}, 
          success:function(html){
            var response = $.parseJSON(html);
            $('#story_comment_status_'+comment_id).attr('data', response.comment_type);
            $('#story_comment_status_'+comment_id).html(response.comment_message);
          }
        });
      }
    });
  }
  function loadResortStoryMoreComment(story_id=''){
      var current_page   = $('#traveller_stories_comment_pages_'+story_id).val();
      var total_comments = $('#traveller_stories_total_comments_'+story_id).val();
      $.ajax({
         url:'<?php echo ADMIN_URL.'resorts/loadResortStoryMoreComment'; ?>',
         type:'get',
         data:{'story_id':story_id, 'current_page':current_page, 'total_comments':total_comments}, 
         success:function(html){
            var response = $.parseJSON(html);
            $('#traveller_comment_list_'+story_id).append(response.html);
            $('#traveller_stories_comment_pages_'+story_id).val(response.current_page);
            if(response.more_comment=='show'){
               $('#traveller_stories_comment_more_'+story_id).show();
            }else{
               $('#traveller_stories_comment_more_'+story_id).hide();
            }
         }
      });
  }
  function resort_story_comment_status(comment_id){
    var comment_id_status = $('#story_comment_status_'+comment_id).attr('data');
    if(comment_id_status==1){
      var comment_type = 'active';
    }else{
      var comment_type = 'block';
    }
    alertify.confirm("Are you sure you want to "+comment_type+" this comment?", function (e) {
      if (e) {
        $.ajax({
          url:'<?php echo ADMIN_URL.'resorts/resort_story_comment_status'; ?>',
          type:'get',
          data:{'comment_id':comment_id, 'comment_type':comment_type, 'type':'all'}, 
          success:function(html){
            var response = $.parseJSON(html);
            $('#story_comment_status_'+comment_id).attr('data', response.comment_type);
            $('#story_comment_status_'+comment_id).html(response.comment_message);
          }
        });
      }
    });
  }
  function loadBlogMoreComment(blog_id=''){
      var current_page   = $('#traveller_stories_comment_pages_'+blog_id).val();
      var total_comments = $('#traveller_stories_total_comments_'+blog_id).val();
      $.ajax({
         url:'<?php echo ADMIN_URL.'blogs/loadBlogMoreComment'; ?>',
         type:'get',
         data:{'blog_id':blog_id, 'current_page':current_page, 'total_comments':total_comments}, 
         success:function(html){
            var response = $.parseJSON(html);
            $('#traveller_comment_list_'+blog_id).append(response.html);
            $('#traveller_stories_comment_pages_'+blog_id).val(response.current_page);
            if(response.more_comment=='show'){
               $('#traveller_stories_comment_more_'+blog_id).show();
            }else{
               $('#traveller_stories_comment_more_'+blog_id).hide();
            }
         }
      });
  }
  function blog_comment_status(comment_id){
    var comment_id_status = $('#story_comment_status_'+comment_id).attr('data');
    if(comment_id_status==1){
      var comment_type = 'active';
    }else{
      var comment_type = 'block';
    }
    alertify.confirm("Are you sure you want to "+comment_type+" this comment?", function (e) {
      if (e) {
        $.ajax({
          url:'<?php echo ADMIN_URL.'blogs/blog_comment_status'; ?>',
          type:'get',
          data:{'comment_id':comment_id, 'comment_type':comment_type, 'type':'all'}, 
          success:function(html){
            var response = $.parseJSON(html);
            $('#story_comment_status_'+comment_id).attr('data', response.comment_type);
            $('#story_comment_status_'+comment_id).html(response.comment_message);
          }
        });
      }
    });
  }
</script>
</body>
</html>
