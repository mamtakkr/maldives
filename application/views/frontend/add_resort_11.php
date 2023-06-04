<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">.cus_mov{cursor: move;}</style>
<form class="wizard-container new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_11">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 10: FAQ</h6>
            <div class="clearfix"></div>
            <div id="add_FAQ_data">   
               <?php include('add_faq_data.php'); ?>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="btn-next-con"> 
         <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>" id="resort_id_11">
         <input type="hidden" name="add_FAQ" value="no" id="add_FAQ">
         <a class="btn-back" href="javascript:void(0)" onclick="backtostep10();">Back</a>
         <button type="submit" id="addFAQBtn" class="btn-next" onclick="addFAQ();" id="addFAQBtn">
            Add More FAQ
         </button> 
         <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model" onclick="finish_model();">Finish</a>
         <!-- <button type="submit" class="btn-next">
            Save & Continue
         </button> -->
      </div>
   </div>
</form>
<div id="finish_model" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title text-center w-100">Alert</h4>
      </div>
      <div class="modal-body">
            <div class="want">
        Do you want to 
         <a  class="" href="javascript:void(0);" data-dismiss="modal" onclick="addFAQFinish();">
           Add More FAQ 
         </a>      
         <br/>
         <a  class="btn-next" href="javascript:void(0);" data-dismiss="modal" onclick="FAQFinish();">
           Proceed to next step
         </a>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
   function addFAQFinish(){
      $('#add_FAQ').val('yes');
      $('#addFAQBtn').click();      
   }
   function FAQFinish(){
      var resort_id    = $('#resort_id_11').val();
      var add_FAQ = $('#add_FAQ').val();
      $.ajax({ 
         url:base_url+"home/save_resort_with_out_11",
         type:"POST",
         data:$("#add_resort_11" ).serialize(), 
         success: function(html){
            var response = $.parseJSON(html);   
            if(response.status=='true'){ 
               
               alertify.confirm("I confirm all the information provided are accurate and most updated information. I also confirm that all the images uploaded into the resort profile belongs to resort and has full copy rights.", function (e) {
                  if (e) { 
                     $.ajax({ 
                        url:base_url+"home/go_to_approval",
                        type:"POST",
                        data:{"resort_id":resort_id}, 
                        success: function(html){ 
                           window.location.href= base_url+"user/dashboard";
                        }
                     });
                  }else{           
                     window.location.href= base_url+"user/dashboard";
                  }
               });
              
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 

            }
         }                
      });
   }
   function addFAQ(){
      $('#add_FAQ').val('yes');
   }
   $('#add_resort_11').validate({
      rules: {
         name_of_activities: {required: true},
         activities_description: {required: true},
      },
      messages: {
         name_of_activities:{ required:"The name of FAQ is required"},
         activities_description:{ required:"The description is required"},
      },
      submitHandler: function(form) {
         var resort_id    = $('#resort_id_11').val();
         var add_FAQ = $('#add_FAQ').val();
         $.ajax({ 
            url:base_url+"home/save_resort_11",
            type:"POST",
            data:$("#add_resort_11" ).serialize(), 
            success: function(html){
                var response = $.parseJSON(html); 
               if(response.status=='true'){                  
                  if(add_FAQ=='no'){ 
                     alertify.confirm("I confirm all the information provided are accurate and most updated information", function (e) {
                        if (e) { 
                           $.ajax({ 
                              url:base_url+"home/go_to_approval",
                              type:"POST",
                              data:{"resort_id":resort_id}, 
                              success: function(html){ 
                                 nextlable();
                                 $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');
                                 window.location.href= base_url+"user/dashboard";
                              }
                           });
                        }else{                        
                           nextlable();
                           $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');
                           window.location.href= base_url+"user/dashboard";
                        }
                     });
                  }else{
                     console.log(response);
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                     $('#add_FAQ_data').show().html(response.nexthtml); 
                     $('#FAQ_list_data').show().html(response.FAQhtml); 
                     $('#addFAQBtn').html('Add More FAQ');
                  }
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 

               }
            }                
         });
      }
   }); 
   function backtostep10(){
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
         url:base_url+"home/edit_resort_9",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab10').hide().html('');
               $('#tab9').show().html(response.nexthtml);
               $('#add_resort_res').hide();
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
   function resortactivities_imageImgNew(){
      var files    = document.getElementById('resortactivities_imageImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('activities_image_pic', 'yes');   
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
               $('#activities_image_main').html(res.html);
               $('#resort_activities_image').val(res.file_name);  
               $('#resort_activities_image_main_i .file-upload-content').show();
               $('#resort_activities_image_main_i .image-upload-wrap').hide();
            }else{       
               $('#activities_image_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteFAQMenu(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#resort_activities_image, #activities_image_main').val('');
            $('#resort_activities_image_main_i .file-upload-content').hide();
            $('#resort_activities_image_main_i .image-upload-wrap').show();
         }
      });
   } 
   function edit_faq(FAQ_id){
      $('#FAQ_id').val(FAQ_id);
      var resort_id = $('#resort_id_11').val();
      $.ajax({ 
         url:base_url+"home/edit_FAQ",
         type:"POST",
         data:{FAQ_id:FAQ_id, resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){              
               $('#add_FAQ_data').show().html(response.nexthtml);
               $('#addFAQBtn').html('Update FAQ');
               $('#add_resort_res').hide();
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
   function delete_faq(FAQ_id){
      alertify.confirm("Are you sure you want to delete this dinning?", function (e) {
         if (e) {       
            $.ajax({ 
               url:base_url+"home/delete_FAQ",
               type:"POST",
               data:{FAQ_id:FAQ_id}, 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){
                     $('#faq_'+FAQ_id).hide();
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }else{ 
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }
               }                
            });
         }
      });
   }
</script>
 <script>
  $( function() {
      // $( "#sortable" ).sortable({
      //    update: function (event, ui) {
      //       //var data = $(this).sortable('serialize');
      //       var data = $("#add_resort`_11" ).serialize();
      //       //alert('test');
      //       // POST to server using $.post or $.ajax
      //       $.ajax({
      //          data: data,
      //          type: 'POST',
      //          url: base_url+"home/FAQ_priority_order",
      //          success: function(html){
      //          }
      //       });
      //    }
      // });
      // $( "#sortable" ).disableSelection();
  } );
  </script>