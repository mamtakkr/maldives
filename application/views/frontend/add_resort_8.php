<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">.cus_mov{cursor: move;}</style>
<form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_resort_8">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <div class="row"> 
                <div class="col-md-6">
                      <h6>Step 7: Dining</h6>
                   </div>
                   <div class="col-md-6" style="text-align:right">
                      <!--<input type="button"  class="btn-next" value="Add Accommodation" id="btnAddAccommodation" data-bs-toggle="modal" data-bs-target="#exampleModal" >-->
                       <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#dse_model">Add Restaurant</a> 
                      <br>&nbsp;
                   </div>
            </div>       
            <div class="clearfix"></div>
             <div class="row">   
                <div class="col-md-12">
                  <textarea class="form-control" id="dinning_heading" name="dinning_heading" placeholder="short description" onchange="update_heading();"><?php echo $dinning_heading->dinning_heading;?></textarea>
                </div>
             </div>
            <div class="clearfix"></div>
            <br>
            <div class="row" id="sortable">               
               <?php 
               if(!empty($dinnings)){
                  foreach($dinnings as $dinning){
                     $meals_served = $this->developer_model->restaurant_meal_served($dinning->id);
                    //  echo "<pre>"; var_dump($meals_served);
                     $imagesD      = $this->common_model->get_result('images', array('item_id'=>$dinning->id, 'type'=>'dinning'));
                     //echo 'query  = '.$this->db->last_query();
                     ?>
                     <div class="col-md-12 cus_mov new_dinning_edit_p" id="dinning_<?php echo !empty($dinning->id)?$dinning->id:''; ?>">
                        <div class="add-resort-card">
                           <div class="add-resort-card-left">
                              <input type="hidden" name="orders[]" value="<?php echo !empty($dinning->id)?$dinning->id:'';?>">
                              <?php 
                              $img   = 0;
                              ?>
                              <div id="carouselExampleIndicators_<?php echo $dinning->id;?>" class="carousel slide" data-ride="carousel">
                                 <ol class="carousel-indicators">
                                    <?php 
                                    if(!empty($imagesD)){
                                       foreach($imagesD as $image){
                                          if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){?>
                                            <li data-target="#carouselExampleIndicators_<?php echo $dinning->id;?>" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
                                          <?php                                           
                                          }else if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){?>
                                            <li data-target="#carouselExampleIndicators_<?php echo $dinning->id;?>" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
                                          <?php 
                                          }
                                          $img++;
                                       }
                                    }
                                    ?>
                                 </ol>
                                 <div class="carousel-inner">
                                    <?php 
                                    $img = 1;                              
                                    if(!empty($imagesD)){
                                       foreach($imagesD as $image){
                                        if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){
                                          echo ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';
                                          echo  '<img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort"/>';
                                          echo '</div>';
                                          $img++;
                                        }else if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                                          echo ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';
                                          echo  '<img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort"/>';
                                          echo '</div>';
                                          $img++;
                                       }
                                      }
                                    }
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators_<?php echo $dinning->id;?>" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators_<?php echo $dinning->id;?>" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                           </div>
                           <div class="add-resort-card-right">
                              <span class="villa-name-title">
                                 <?php 
                                 echo !empty($dinning->name_of_restaurant)?$dinning->name_of_restaurant:'';
                                 ?>
                              </span>
                              <p>
                                 <?php 
                                 echo !empty($dinning->description)?$dinning->description:'';
                                 ?>
                              </p>
                              <ul class="add-resort5"> 
                                 <li>Type : 
                                    <span>
                                       <?php 
                                       echo !empty($dinning->restaurant_type_txt)?$dinning->restaurant_type_txt:'';
                                       ?>                              
                                    </span> 
                                 </li>                        
                                 <li>Meal Plans Applicable: 
                                    <span>
                                       <?php 
                                       echo !empty($dinning->meal_plans_txt)?$dinning->meal_plans_txt:'';
                                       ?> 
                                    </span> 
                                 </li>                           
                                 <li>Dress Codes : 
                                   <span><?php 
                                       echo !empty($dinning->dress_codes_txt)?$dinning->dress_codes_txt:'';
                                       ?>  </span> 
                                 </li>
                                 <?php 
                                 $Userfood_types = explode(',', $dinning->food_type);
                                 $food_types = $this->common_model->get_result('food_types', array('status'=>1));
                                 if(!empty($food_types)){
                                    foreach($food_types as $food_type){?>
                                       <li><?php echo !empty($food_type->food_type)?ucfirst($food_type->food_type):''; ?> : 
                                         <span>
                                          <?php 
                                             echo (!empty($food_type->id)&&in_array($food_type->id, $Userfood_types))?'Yes':'No';
                                          ?>  
                                          </span> 
                                       </li>
                                       <?php 
                                    }
                                 }                                    
                                 if(!empty($meals_served)){
                                    foreach($meals_served as $meal_served){?>
                                       <li><?php echo !empty($meal_served->meal_served_title)?ucfirst($meal_served->meal_served_title):''; ?> : 
                                         <span> 
                                          <?php echo !empty($meal_served->meals_styles_title)?ucfirst($meal_served->meals_styles_title):''; ?>
                                          <i class="fa fa-clock-o" aria-hidden="true"></i> -
                                          <?php 
                                          if(!empty($meal_served->open_hour)){
                                             echo ($meal_served->open_hour<9)?'0'.$meal_served->open_hour:$meal_served->open_hour; 
                                          }else{echo '00'; }?>:
                                          <?php echo !empty($meal_served->open_minut)?ucfirst($meal_served->open_minut):'00'; ?> to 
                                          <?php 
                                          if(!empty($meal_served->closing_hour)){
                                             echo ($meal_served->closing_hour<9)?'0'.$meal_served->closing_hour:$meal_served->closing_hour; 
                                          }else{echo '00'; }
                                          ?>:<?php echo !empty($meal_served->closing_minut)?ucfirst($meal_served->closing_minut):'00'; ?>
                                          </span> 
                                       </li> 
                                    <?php 
                                    }
                                 }
                                 ?>
                                 </li> 
                              </ul>
                              <a href="javascript:void(0);" onclick="edit_dinning('<?php 
                                 echo !empty($dinning->id)?$dinning->id:'';
                                 ?>');" class="edit-icon edit_dinning" data-toggle="modal" data-target="#dse_model"></a>
                                 <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                              
                              <a href="javascript:void(0);" onclick="delete_dinning('<?php 
                                 echo !empty($dinning->id)?$dinning->id:'';
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
            <!--<div class="row" id="add_dinning_data">-->
               <?php //include('add_dinning_data.php'); ?>
            <!--</div>-->
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="btn-next-con"> 
         <input type="hidden" name="dinning_id" id="dinning_id" value="">
         <input type="hidden" name="add_dinning" value="no" id="add_dinning">
         <input type="hidden" name="resort_id" id="resort_id_7" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
         <a class="btn-back" href="javascript:void(0)" onclick="backtostep7();">Back</a> 
         <!--<button type="submit" id="addDinningBtn" class="btn-next" onclick="addDinning();">-->
         <!--   Add More Dining-->
         <!--</button>-->
          <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#dse_model">Add More Dining</a> 
         <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save & Countinue</a> 
         <!-- <button type="submit" class="btn-next">
            Save & Continue
         </button>
         <a class="btn-back" href="javascript:void(0)" onclick="backtostep9();">Skip</a>  -->
      </div>
   </div>
   
   
    <div id="dse_model" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center w-100">Add Dining</h4>
              </div>
              <div class="modal-body" id="add_dinning_data">
                <?php include('add_dinning_data.php'); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save & Countinue</a> 
              </div>
            </div>
          </div>
    </div>
   
               
<!--<div class="modal fade edit_new_dinning" id="edit_dinning" tabindex="-1" role="dialog" aria-labelledby="edit_dinning" aria-hidden="true">-->
<!--	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--    	<div class="modal-content">-->
<!--      		<div class="modal-header">-->
<!--        		<h5 class="modal-title" id="edit_dinning_details_title">Edit Dinning</h5>-->
<!--        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          			<span aria-hidden="true">&times;</span>-->
<!--        		</button>-->
<!--      		</div>-->
<!--      		<div class="modal-body" id="edit_dinning_details_data">-->
<!--                    <?php //include('edit_dinning_data.php'); ?>-->
<!--      		</div>-->
<!--      		<div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <a class="btn-next" href="javascript:void(0)" data-toggle="modal" data-target="#finish_model">Save and Continue</a> -->
<!--            </div>-->
<!--    	</div>-->
<!--  	</div>-->
<!--</div>-->
   
   
   
   
   
   
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
         <a  class="" href="javascript:void(0);" data-dismiss="modal" onclick="addDinningFinish();">
           Add More Dining 
         </a>      
         <br/>
         <a  class="btn-next" href="javascript:void(0);" data-dismiss="modal" onclick="dinningFinish();">
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
   function addDinningFinish(){
      $('#add_dinning').val('yes');
    //   $('#dse_model').modal("hide");
    //   $('#addDinningBtn').click();      
    
    var resort_id  = $('#resort_id_7').val();
    var add_dinning = $('#add_dinning').val();
      $.ajax({ 
         url:base_url+"home/save_resort_with_out_8",
         type:"POST",
         data:$("#add_resort_8" ).serialize(), 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               if(add_dinning=='no'){ 
                  nextlable();
                  $('#tab8').hide().html('');
                  $('#tab9').show().html(response.nexthtml);
                  $('#tab_menu_8').removeClass('active2');
                  $('#tab_menu_9').removeClass('disable');
                  $('#tab_menu_9').addClass('active2');
                  $('#add_resort_res').hide();
               }else{
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                   $.ajax({ 
                     url:base_url+"home/edit_resort_8",
                     type:"POST",
                     data:{resort_id:resort_id}, 
                     success: function(html){
                        var response = $.parseJSON(html); 
                        if(response.status=='true'){
                        //   $('#tab8').show().html(response.nexthtml);
                        $('input:text').val('');
                        $('input[type=radio]').prop('checked',false);
                        $('input[type=checkbox]').prop('checked',false);
                        $('input[type=file]').val(null) ;
                        $('textarea').val('');
                        $('select').val('');
                        
                        $('#resort_images_main').css("display",'none');
                        // $('.file-upload-meal').css("display",'block');
                        $('#dse_model').modal("hide");
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
   function dinningFinish(){
      $('#add_dinning').val('no');
      var resort_id  = $('#resort_id_7').val();
      var add_dinning = $('#add_dinning').val();
      $.ajax({ 
         url:base_url+"home/save_resort_with_out_8",
         type:"POST",
         data:$("#add_resort_8" ).serialize(), 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               if(add_dinning=='no'){ 
                  nextlable();
                  $('#tab8').hide().html('');
                  $('#tab9').show().html(response.nexthtml);
                  $('#tab_menu_8').removeClass('active2');
                  $('#tab_menu_9').removeClass('disable');
                  $('#tab_menu_9').addClass('active2');
                  $('#add_resort_res').hide();
               }else{
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                   $.ajax({ 
                     url:base_url+"home/edit_resort_8",
                     type:"POST",
                     data:{resort_id:resort_id}, 
                     success: function(html){
                        var response = $.parseJSON(html); 
                        if(response.status=='true'){
                           $('#tab8').show().html(response.nexthtml);
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
   function backtostep7(){
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
      var resort_id = $('#resort_id_7').val();
      $.ajax({ 
         url:base_url+"home/edit_resort_7",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab8').hide().html('');
               $('#tab7').show().html(response.nexthtml);
               $('#add_resort_res').hide();
               $('#tab_menu_8').removeClass('active2');
               $('#tab_menu_7').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }    
   function backtostep9(){
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
      var resort_id = $('#resort_id_7').val();
      $.ajax({ 
         url:base_url+"home/edit_resort_9",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab8').hide().html('');
               $('#tab9').show().html(response.nexthtml);
               $('#tab_menu_8').removeClass('active2');
               $('#tab_menu_9').removeClass('disable');
               $('#tab_menu_9').addClass('active2');
               $('#add_resort_res').hide();
            }
         }                
      });
   }
   function addDinning(){
      $('#add_dinning').val('yes');
   }
   $('#add_resort_8').validate({
      rules: {
         name_of_restaurant: {required: true},
         description: {required: true},
      },
      messages: {
         name_of_restaurant:{ required:"The name of restaurant is required"},
         description:{ required:"The description is required"},
      },
      submitHandler: function(form) {
         var resort_id  = $('#resort_id_7').val();
         var add_dinning = $('#add_dinning').val();
         alert('add_dinning = '+add_dinning);
         $.ajax({ 
            url:base_url+"home/save_resort_8",
            type:"POST",
            data:$("#add_resort_8" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  if(add_dinning=='no'){ 
                     nextlable();
                     $('#tab8').hide().html('');
                     $('#tab9').show().html(response.nexthtml);
                     $('#tab_menu_8').removeClass('active2');
                     $('#tab_menu_9').removeClass('disable');
                     $('#tab_menu_9').addClass('active2');
                     $('#add_resort_res').hide();
                  }else{
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                      $.ajax({ 
                        url:base_url+"home/edit_resort_8",
                        type:"POST",
                        data:{resort_id:resort_id}, 
                        success: function(html){
                           var response = $.parseJSON(html); 
                           if(response.status=='true'){
                              $('#tab8').show().html(response.nexthtml);
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
   function meal_served(meal_type){
      var meal_type_st = $('#meal_served_status_'+meal_type).is(":checked");
      //alert('meal_type = '+meal_type_st);
      if(meal_type_st){
         $('#meal_served_status_up_'+meal_type).removeClass('left_mr_100');
         $('.meal_served_sub_'+meal_type).removeClass('hide_cl');
      }else{
         $('#meal_served_status_up_'+meal_type).addClass('left_mr_100');
         $('.meal_served_sub_'+meal_type).addClass('hide_cl');
      }
   }
   function meal_served_menu(imagesID){
      $('.new_loader').show(); 
      var files    = document.getElementById('meal_served_menu_'+imagesID).files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('meal_served_menu', 'yes');   
      formData.append('pdf_file', 'yes'); 
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
            res = JSON.parse(resp); 
            //alert('csss');
            if(res.statuss=='true'){                   
               $('#meal_served_menu_img_'+imagesID).show();
               $('#meal_served_menu_img_'+imagesID).html(res.html);
               $('#meal_served_menu_img_'+imagesID+' .file-upload-content').show();           
               $('#meal_served_menu_main_'+imagesID+' .image-upload-wrap').hide();
               $('#meal_served_menu_img_val_'+imagesID).val(res.file_name);  
            }else{       
               $('#meal_served_menu_img_'+imagesID+'_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteMealServedMenu(imagesID,fileID,fileName){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#meal_served_menu_img_val_'+imagesID+', #meal_served_menu_img_'+imagesID).val('');
            $('#meal_served_menu_main_'+imagesID+' .file-upload-content').hide();
            $('#meal_served_menu_main_'+imagesID+' .image-upload-wrap').show();
         }
      });
   }
   function dinning_menu_new(){
      $('.new_loader').show(); 
      var files    = document.getElementById('dinning_menu').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('dinning_menu', 'yes'); 
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
            //alert('csss');
            if(res.statuss=='true'){                   
               $('#dinning_menu_img').show();
               $('#dinning_menu_img').html(res.html);
               $('#dinning_menu_img .file-upload-content').show();           
               $('#dinning_menu_main .image-upload-wrap').hide();
               $('#dinning_menu_val').val(res.file_name);  
            }else{       
               $('#dinning_menu_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function deleteDinningMenu(){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#dinning_menu_val, #dinning_menu_img').val('');
            $('#dinning_menu_main .file-upload-content').hide();
            $('#dinning_menu_main .image-upload-wrap').show();
         }
      });
   }
//   function edit_dinning(dinning_id){
//       $('#dinning_id').val(dinning_id);
//       var stories_height = parseInt($("#add_dinning_data").offset().top)-parseInt(180); 
//       $('html, body').animate({scrollTop: stories_height}, 1000);
//       var resort_id = $('#resort_id_7').val();
//       $.ajax({ 
//          url:base_url+"home/edit_dinning",
//          type:"POST",
//          data:{dinning_id:dinning_id, resort_id:resort_id}, 
//          success: function(html){
//             var response = $.parseJSON(html); 
//             if(response.status=='true'){              
//               $('#add_dinning_data').show().html(response.nexthtml);
//               $('#add_resort_res').hide();
//             }else{ 
//               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
//             }
//          }                
//       });
//   }
   
   
  function edit_dinning(dinning_id) {
      $('#dinning_id').val(dinning_id);
      var resort_id = $('#resort_id_7').val();
    $.ajax({ 
          url:"<?php echo base_url();?>home/edit_dinning",
          type:"POST",
         data:{dinning_id:dinning_id, resort_id:resort_id},
          success: function(html){
            // var response = $.parseJSON(html.nexthtml); 
            // alert(html);
            // if(response.status=='true'){  
			  $('#add_dinning_data').html(html);
			  $('#add_resort_res').hide();
            // }
          }                
    }); 
  }

   
   
   
   function delete_dinning(dinning_id){
      alertify.confirm("Are you sure you want to delete this dinning?", function (e) {
         if (e) {       
            $.ajax({ 
               url:base_url+"home/delete_dinning",
               type:"POST",
               data:{dinning_id:dinning_id}, 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){
                     $('#dinning_'+dinning_id).hide();
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }else{ 
                     $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
                  }
               }                
            });
         }
      });
   }
   function resortImagesImgNew(){
      $('.new_loader').show(); 
      var files           = document.getElementById('resortImagesImg').files;
      var resortImgCount  = $('#resortImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>3){
         $('#resort_images_error').show().html('You can`t upload more than 3 images');
         $('.new_loader').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){    
            $('.new_loader').show();      
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
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
                  if(res.statuss=='true'){
                     $('.new_loader').hide(); 
                     $('#resort_images_main').append(res.html);
                     var filenames = $('#resort_images').val();
                     if(filenames!=''){
                         $('#resort_images').val(filenames+','+res.file_name);
                     }else{
                        $('#resort_images').val(res.file_name);
                     }
                     $('#resort_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#resortImagesCount').val())+parseInt(1);  
                     $('#resortImagesCount').val(resortImgCount);
                     $('#resort_images_error').hide();
                     /*$('#resort_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#resort_images_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
   }
   function deleteRestaurantImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#resortImagesCount').val())-parseInt(1);  
            $('#resortImagesCount').val(resortImgCount);
            var all_images = $('#resort_images').val(); 
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
            $('#resort_images').val(imageName);
         }
      });
   } 
</script>
 <script>
  $( function() {
       $( "#sortable" ).sortable({
          update: function (event, ui) {
             //var data = $(this).sortable('serialize');
             var data = $("#add_resort_8" ).serialize();
             //alert('test');
             // POST to server using $.post or $.ajax
             $.ajax({
                data: data,
                type: 'POST',
                url: base_url+"home/dinning_priority_order",
                success: function(html){
                }
             });
          }
       });
       $( "#sortable" ).disableSelection();
  } );
  function update_heading(){
    var dinning_heading  = $('#dinning_heading').val();
    var resort_id        = $('#resort_id_7').val();
    $.ajax({
      data: {dinning_heading:dinning_heading,resort_id:resort_id},
      type: 'POST',
      url: base_url+"home/update_dinning_heading",
      success: function(html){

      }
    });
  }
  </script>