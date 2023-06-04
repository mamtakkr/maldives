<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">.cus_mov{cursor: move;}</style>
<form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_resort_5">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <div class="row">
               <div class="col-md-6">
                  <h6>Step 5: Accommodation</h6>
               </div>
               <div class="col-md-6" style="text-align:right">
                  <!--<input type="button"  class="btn-next" value="Add Accommodation" id="btnAddAccommodation" data-bs-toggle="modal" data-bs-target="#exampleModal" >-->
                   <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#dse_model">Add Accommodation</a> 
                  <br>&nbsp;
               </div>
               <div class="clearfix"></div>
               
             </div>
             <div class="row">   
                <div class="col-md-12">
                  <textarea class="form-control" id="accommodation_heading" name="accommodation_heading" maxlength="320" 
                        placeholder="Short description" onchange="update_heading();">
                      <?php echo $accommodation_heading->accommodation_heading;?>
                  </textarea>
                </div>
             </div>
            <div class="clearfix"></div>
            <div class="row" id="sortable">               
               <?php 
               if(!empty($accommodations)){
                  $total_accommodations = count($accommodations);
                  foreach($accommodations as $accommodation){?>
                     <div class="col-md-12 cus_mov" id="accommodation_<?php 
                           echo !empty($accommodation->id)?$accommodation->id:'';
                           ?>">
                        <div class="add-resort-card">
                           <div class="add-resort-card-left">
                              <input type="hidden" name="orders[]" value="<?php 
                              echo !empty($accommodation->id)?$accommodation->id:'';
                              ?>">
                              <?php 
                              $images = $this->common_model->get_result('images', array('item_id'=>$accommodation->id, 'type'=>'accommodation'));
                              $img   = 0;
                              ?>
                              <div id="carouselExampleIndicators_<?php echo $accommodation->id;?>" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                    <?php 
                                    if(!empty($images)){
                                       foreach($images as $image){
                                        if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){?>
                                          <li data-target="#carouselExampleIndicators_<?php echo $accommodation->id;?>" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
                                       <?php 
                                         $img++;
                                       }
                                       }
                                    }
                                    ?>
                                 </ol>
                                 <div class="carousel-inner">
                                    <?php 
                                    $img = 1;                              
                                    if(!empty($images)){
                                       foreach($images as $image){
                                          if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                                             echo ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';
                                             echo  '<img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort"/>';
                                             echo '</div>';
                                             $img++;
                                           }
                                       }
                                    }
                                     ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators_<?php echo $accommodation->id;?>" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators_<?php echo $accommodation->id;?>" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                           </div>
                           <div class="add-resort-card-right">
                              <span class="villa-name-title">
                                 <?php 
                                 echo !empty($accommodation->name_of_villa)?$accommodation->name_of_villa:'';
                                 ?>
                              </span>
                              <p>
                                 <?php 
                                 echo !empty($accommodation->description)?$accommodation->description:'';
                                 ?>
                              </p>
                              <ul class="add-resort5">
                              <li>Villa Type : 
                                 <span>
                                 <?php 
                                    echo !empty($accommodation->villa_type_name)?$accommodation->villa_type_name:'';
                                 ?>                              
                                 </span> 
                              </li>                        
                              <li>Room size sqm : 
                               <span><?php 
                                    echo !empty($accommodation->room_size)?ucfirst($accommodation->room_size):'';
                                 ?></span> </li>                         
                              <li>Villa location : 
                                <span>
                                 <?php 
                                    echo !empty($accommodation->villa_location)?ucfirst(str_replace('_', ' ', $accommodation->villa_location)):'';
                                 ?>    
                                 </span> 
                              </li>                          
                              <li>Rooms per Villa : 
                                 <span>
                                    <?php 
                                       echo !empty($accommodation->number_of_rooms_per_villa)?$accommodation->number_of_rooms_per_villa:'';
                                    ?> 
                                 </span> 
                              </li>                        
                              <li>No of Units : 
                                 <span>
                                    <?php 
                                       echo !empty($accommodation->number_of_units)?$accommodation->number_of_units:'';
                                    ?> 
                                 </span> 
                              </li>
                              <li>Living Room : 
                                 <span>
                                    <?php 
                                       echo (!empty($accommodation->is_living_status) && $accommodation->is_living_status==1)?'Yes':'No';
                                    ?> 
                                 </span> 
                              </li>
                              <li>Villa with a Pool? : 
                                 <span><?php 
                                       echo (!empty($accommodation->villa_with_pool) && $accommodation->villa_with_pool==1)?'Yes':'No';
                                    ?></span> 
                              </li>                        
                               <li>
                                 Ideal for  : 
                                 <span><?php 
                                 echo !empty($accommodation->ideal_names)?$accommodation->ideal_names:'';
                                 ?></span> 
                              </li>                         
                              <li>
                                 Amenities  : 
                                <span> <?php 
                                 echo !empty($accommodation->amenitie_name)?$accommodation->amenitie_name:'';
                                 ?>
                                 </span> 
                              </li>
                              </ul>
                              <a href="javascript:void(0);" onclick="edit_accommodation('<?php 
                                 echo !empty($accommodation->id)?$accommodation->id:'';
                                 ?>');" class="edit-icon edit_accommodation" data-toggle="modal" data-target="#dse_model">
                                 <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                              
       <!--                       <div>-->
							<!--	<a href="javascript:void(0);" class="ideal-link resort_map" data-toggle="modal" data-target="#resort_map" -->
							<!--	onclick="resort_map('<?php //echo !empty($resort->id)?$resort->id:''; ?>');">Resort Map</a>-->
							<!--</div>-->
                              
                               
                              <a href="javascript:void(0);" onclick="delete_accommodation('<?php 
                                 echo !empty($accommodation->id)?$accommodation->id:'';
                                 ?>');" class="delete-icon">
                                 <i class="fa fa-times-circle" aria-hidden="true"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                     <?php                     
                  }
               }
               ?>
            </div>
            <div class="clearfix"></div>
            <div id="dse_model" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center w-100">Accommodation</h4>
                      </div>
                      <div class="modal-body" id="add_accommodation_data">
                        <?php include('add_accommodation_data.php'); ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save and Continue</a> 
                      </div>
                    </div>
                  </div>
                </div>
            
            <!--<div class="row" id="add_accommodation_data" style="display:none;">-->
               
            <!--</div>-->
            <!--<div class="row" id="add_accommodation_data" style="display:none;">-->
               <?php //include('add_accommodation_data.php'); ?>
            <!--</div>-->
            
            <!--<div id="edit_accommodation_data" class="modal fade" role="dialog">-->
            <!--  <div class="modal-dialog">-->
                 <!--Modal content-->
            <!--    <div class="modal-content">-->
            <!--      <div class="modal-header">-->
            <!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            <!--        <h4 class="modal-title text-center w-100">Edit Accommodation</h4>-->
            <!--      </div>-->
            <!--      <div class="modal-body" id="edit_accommodation_result">-->
            <!--        <?php //include('add_accommodation_data.php'); ?>-->
            <!--      </div>-->
            <!--      <div class="modal-footer">-->
            <!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <!--        <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save and Continue</a> -->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            
            
            
<!--<div class="modal fade edit_new_villa" id="edit_accommodation" tabindex="-1" role="dialog" aria-labelledby="edit_accommodation" aria-hidden="true">-->
<!--	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--    	<div class="modal-content">-->
<!--      		<div class="modal-header">-->
<!--        		<h5 class="modal-title" id="edit_accommodation_details_title">Edit Accommodation</h5>-->
<!--        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          			<span aria-hidden="true">&times;</span>-->
<!--        		</button>-->
<!--      		</div>-->
<!--      		<div class="modal-body" id="edit_accommodation_details_data">-->
<!--                    <?php //include('edit_accommodation_data.php'); ?>-->
      		    <!--<img src="http://demogswebtech.com/maldives/uploads/resorts/thumbnails/500_7785dc97bed9031ca2db2aff0b510389.jpg">-->
<!--      		</div>-->
<!--      		<div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save and Continue</a> -->
<!--            </div>-->
<!--    	</div>-->
<!--  	</div>-->
<!--</div>-->

            
            
            
            
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="btn-next-con"> 
         <input type="hidden" name="resort_id" id="resort_id_5" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
         <input type="hidden" name="accommodation_id" id="accommodation_id" value="">
         <input type="hidden" name="add_accommodation" value="no" id="add_accommodation">
         <a class="btn-back" href="javascript:void(0)" onclick="backtostep4();">Back</a> 
         <!--<button type="button" class="btn-next" id="addAccommodationBtn" onclick="addAccommodation();">-->
         <!--  Add More Accommodation-->
         <!--</button>-->
         <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#dse_model">Add More Accommodation </a>
         <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save and Continue</a> 

      </div>
   </div>
</form>
<!-- Modal -->
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
         <a  class="" href="javascript:void(0);" id="add_more_accommodation" data-dismiss="modal" onclick="addAccommodationFinish();">
            Add More Accommodation 
         </a>      
    <br />
         <a  class="btn-next" href="javascript:void(0);" data-dismiss="modal" onclick="accommodationFinish();">
           Proceed to next step
         </a>
         
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
   function addAccommodationFinish(){
      $('#add_accommodation').val('yes');
    //   $('#addAccommodationBtn').click();    
    
    //   $('#add_accommodation').val('no');
      var resort_id         = $('#resort_id').val();
      var add_accommodation = $('#add_accommodation').val();
      $.ajax({ 
         url:base_url+"home/save_resort_without_validate_5",
         type:"POST",
         data:$("#add_resort_5" ).serialize(), 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               if(add_accommodation=='no'){                     
                  nextlable();
                  $('#tab5').hide().html('');
                  $('#tab7').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_5').removeClass('active2');
                  $('#tab_menu_7').removeClass('disable');
                  $('#tab_menu_7').addClass('active2');
               }else{
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                   $.ajax({ 
                     url:base_url+"home/edit_resort_5",
                     type:"POST",
                     data:{resort_id:resort_id}, 
                     success: function(html){
                        var response = $.parseJSON(html); 
                        if(response.status=='true'){
                        $('input:text').val('');
                        $('input[type=radio]').prop('checked',false);
                        $('input[type=checkbox]').prop('checked',false);
                        $('input[type=file]').val(null) ;
                        $('textarea').val('');
                        $('select').val('');
                        
                        $('#resort_images_main').css("display",'none');
                        $('#accommodation_floor_plan_mains35').css("display",'none');
                        $('#accommodation_floor_plan_mains_i').css("display",'block');
                        
                        
                        $('#dse_model').modal("hide");
                        
                        
                        
                        // $('#dse_model').trigger("reset")
                        // $('#dse_model').modal("show");
                        
                        }
                        else{ 
                           $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                        }
                     }                
                  });
               }
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
      
   }
   function accommodationFinish(){
      $('#add_accommodation').val('no');
      var resort_id         = $('#resort_id').val();
      var add_accommodation = $('#add_accommodation').val();
      $.ajax({ 
         url:base_url+"home/save_resort_without_validate_5",
         type:"POST",
         data:$("#add_resort_5" ).serialize(), 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               if(add_accommodation=='no'){                     
                  nextlable();
                  $('#tab5').hide().html('');
                  $('#tab7').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_5').removeClass('active2');
                  $('#tab_menu_7').removeClass('disable');
                  $('#tab_menu_7').addClass('active2');
               }else{
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                   $.ajax({ 
                     url:base_url+"home/edit_resort_5",
                     type:"POST",
                     data:{resort_id:resort_id}, 
                     success: function(html){
                        var response = $.parseJSON(html); 
                        if(response.status=='true'){
                           $('#tab5').show().html(response.nexthtml);
                        }else{ 
                           $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                        }
                     }                
                  });
               }
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
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
   function addAccommodation(){
      $('#add_accommodation').val('yes');
      if(!$('#add_accommodation_data').is(":visible")) {
         $('#add_accommodation_data').show();
      } else {
         $('#add_resort_5').submit();
      }
      
   }
   function old_aminities(){
      var old_aminity = $('#old_aminity').val();
      $.ajax({ 
         url:base_url+"home/old_aminity",
         type:"POST",
         data:$("#add_resort_5" ).serialize(), 
         success: function(html){
            $('#aminities_data').show().html(html);
         }
      });
   }
   function accommodation_photos_new(){
      $('.new_loader').show(); 
      var files           = document.getElementById('accommodation_photos').files;
      var resortImgCount  = $('#resortImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>6){
         $('#accommodation_photos_error').show().html('You can`t upload more than 6 images');
         $('.new_loader').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
            formData.append('accommodation_photos_pic', 'yes');   
            xhr.open("POST", "<?php echo base_url('home/uploadPics'); ?>");
               xhr.upload.onprogress = function(e) {
               if (e.lengthComputable) {     
                  var percentComplete = (e.loaded / e.total) * 100; 
               }
            };
            xhr.onload = function() {
               if (this.status == 200) {
                  $('.new_loader').hide(); 
                  var resp = this.response;
                  res      = JSON.parse(resp); 
                  if(res.statuss=='true'){
                     $('#resort_images_main').append(res.html);
                     var filenames = $('#accommodation_photos_val').val();
                     if(filenames!=''){
                         $('#accommodation_photos_val').val(filenames+','+res.file_name);
                     }else{
                        $('#accommodation_photos_val').val(res.file_name);
                     }
                     $('#accommodation_photos_mains_i .file-upload-content').show();
                     var resortImgCount = parseInt($('#resortImagesCount').val())+parseInt(1);  
                     console.log(resortImgCount);
                     $('#resortImagesCount').val(resortImgCount);
                     $('#accommodation_photos_error').hide();
                     /*$('#resort_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#accommodation_photos_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
   }     
   function deleteAcommodationImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#resortImagesCount').val())-parseInt(1);  
            $('#resortImagesCount').val(resortImgCount);
            var all_images = $('#accommodation_photos_val').val(); 
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
            $('#accommodation_photos_val').val(imageName);
         }
      });
   }  
   function accommodation_floor_plan_new(){
      $('.new_loader1').show(); 
      var files    = document.getElementById('accommodation_floor_plan').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img', file);
      formData.append('floor_plan_pic', 'yes');   
      formData.append('pdf_file', 'pdf_word');  
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
               //alert('accommodation_floor_plan_mains csss');
               $('#accommodation_floor_plan_mains35').show();
               $('#accommodation_floor_plan_mains35').html(res.html);
               $('#accommodation_floor_plan_val').val(res.file_name);  
               $('#accommodation_floor_plan_mains35 .file-upload-content').show();
               $('#accommodation_floor_plan_mains_i .image-upload-wrap').hide();
               $('#accommodation_floor_plan_error').hide();
            }else{       
               $('#accommodation_floor_plan_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function delete_accommodation_floor_plan(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#accommodation_floor_plan, #accommodation_floor_plan_mains').val('');
            $('#accommodation_floor_plan_mains_i .file-upload-content').hide();
            $('#accommodation_floor_plan_mains_i .image-upload-wrap').show();
         }
      });
   } 
   function backtostep7(){
      var progressBar = $('#js-progress').find('.progress-bar');
      var progressVal = $('#js-progress').find('.progress-val');
      var step_id     = $('#step_id').val();
      var step_id     = parseInt(step_id)+parseInt(1);
      var step_val    = $('#step_val').val();
      var step_val    = parseInt(step_val)-parseInt(10);
      progressBar.css('width', step_val+ '%');
      progressVal.text(step_val+'%');
      $('#step_id').val(step_id);
      $('#step_val').val(step_val);
      var resort_id = $('#resort_id_5').val();
      $.ajax({ 
         url:base_url+"home/edit_resort_7",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab5').hide().html('');
               $('#tab7').show().html(response.nexthtml);
               $('#add_resort_res').hide();
            }
         }                
      });
   }
   function backtostep4(){
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
         url:base_url+"home/edit_resort_4",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
              $('#tab5').hide().html('');
              $('#tab4').show().html(response.nexthtml);
              $('#add_resort_res').hide();
              $('#tab_menu_5').removeClass('active2');
              $('#tab_menu_4').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
            }
         }                
      });
   }    
   $('#add_resort_5').validate({
      rules: {
         name_of_villa: {required: true},
         description: {required: true},
         villa_type: {required: true},
         number_of_rooms_per_villa: {required: true},
      },
      messages: {
         name_of_villa:{ required:"The name of villa is required"},
         description:{ required:"The description is required"},
         number_of_rooms_per_villa:{ required:"The number of rooms per villa is required"},
      },
      submitHandler: function(form) {
         var resort_id         = $('#resort_id').val();
         var add_accommodation = $('#add_accommodation').val();
         $.ajax({ 
            url:base_url+"home/save_resort_5",
            type:"POST",
            data:$("#add_resort_5" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  if(add_accommodation=='no'){                     
                     nextlable();
                     $('#tab5').hide().html('');
                     $('#tab7').show().html(response.nexthtml);
                     $('#add_resort_res').hide();
                     $('#tab_menu_5').removeClass('active2');
                     $('#tab_menu_6').removeClass('disable');
                     $('#tab_menu_6').addClass('active2');
                  }else{
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                      $.ajax({ 
                        url:base_url+"home/edit_resort_5",
                        type:"POST",
                        data:{resort_id:resort_id}, 
                        success: function(html){
                           var response = $.parseJSON(html); 
                           if(response.status=='true'){
                              $('#tab5').show().html(response.nexthtml);
                           }else{ 
                              $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                           }
                        }                
                     });
                  }
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   }); 
//   function edit_accommodation(accommodation_id){
//       $('#accommodation_id').val(accommodation_id);
//       var resort_id = $('#resort_id_5').val();
//       var stories_height = parseInt($("#edit_accommodation_data").offset().top) - parseInt(180) ; 
//       $('html, body').animate({scrollTop: stories_height}, 1000);
//       $.ajax({ 
//          url:base_url+"home/edit_accommodation",
//          type:"POST",
//          data:{accommodation_id:accommodation_id, resort_id:resort_id}, 
//          success: function(html){
//             var response = $.parseJSON(html); 
//             if(response.status=='true'){              
//               $('#edit_accommodation_result').show().html(response.nexthtml);
//               $('#add_resort_res').hide();
//             }else{ 
//               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
//             }
//          }                
//       });
//   }


  function edit_accommodation(accommodation_id) {
      $('#accommodation_id').val(accommodation_id);
      var resort_id = $('#resort_id_5').val();
    $.ajax({ 
          url:"<?php echo base_url();?>home/edit_accommodation",
          type:"POST",
         data:{accommodation_id:accommodation_id, resort_id:resort_id},
          success: function(html){
            // var response = $.parseJSON(html.nexthtml); 
            // if(response.status=='true'){  
			  $('#add_accommodation_data').html(html);
            // }
          }                
    }); 
  }



   function delete_accommodation(accommodation_id){
      alertify.confirm("Are you sure you want to delete this accommodation?", function (e) {
         if (e) {       
            $.ajax({ 
               url:base_url+"home/delete_accommodation",
               type:"POST",
               data:{accommodation_id:accommodation_id}, 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){
                     $('#accommodation_'+accommodation_id).hide();
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }else{ 
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }
               }                
            });
         }
      });
   }
   function priority_order(accommodation_id,total_accommodation){
      var resort_id = $('#resort_id_5').val();
      var priority_order = $('#priority_order_'+accommodation_id).val();
      $.ajax({ 
         url:base_url+"home/accommodation_priority_order",
         type:"POST",
         data:{accommodation_id:accommodation_id,resort_id:resort_id,priority_order:priority_order,total_accommodation:total_accommodation}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#accommodation_'+accommodation_id).hide();
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }
</script>
 <script>
  $( function() {
   $('#btnAddAccommodation').click(function(event) {
      $('#add_accommodation_data').show();
      $('#name_of_villa').focus();
   })

      $( "#sortable" ).sortable({
         update: function (event, ui) {
            //var data = $(this).sortable('serialize');
            var data = $("#add_resort_5" ).serialize();
            //alert('test');
            // POST to server using $.post or $.ajax
            $.ajax({
               data: data,
               type: 'POST',
               url: base_url+"home/accommodation_priority_order",
               success: function(html){
               }
            });
         }
      });
      $( "#sortable" ).disableSelection();
  } );
  function update_heading(){
    var accommodation_heading = $('#accommodation_heading').val();
    var resort_id             = $('#resort_id_5').val();
    $.ajax({
      data: {accommodation_heading:accommodation_heading,resort_id:resort_id},
      type: 'POST',
      url: base_url+"home/update_accommodation_heading",
      success: function(html){

      }
    });
  }
  </script>