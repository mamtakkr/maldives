<form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_resort_6">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 6: Room Facilities</h6>
            <div class="clearfix"></div>
            <div class="resort-option facilities">
               <div class="form-group">
                  <label for="exampleInputEmail1">Choose the Facilities</label>
                  <div class="amenities">
                     <div class="clearfix"></div>
                     <ul>
                        <?php 
                        $resortFacilities = array();
                        if(!empty($row->facilities)){
                           $resortFacilities = explode(',', $row->facilities);
                        }
                        if(!empty($facilities)){
                           foreach ($facilities as $facilitie) {
                              if(!empty($facilitie->facility_img)&&file_exists('uploads/facilities/thumbnails/'.$facilitie->facility_img)){?>
                                 <li>
                                    <input type="checkbox" value="<?php echo $facilitie->id; ?>" name="facilities[]" class="hidden" id="facilitie_<?php echo $facilitie->id; ?>" <?php if(in_array($facilitie->id, $resortFacilities)){echo 'checked';} ?>>
                                    <label for="facilitie_<?php echo $facilitie->id; ?>" class="lable_text">
                                       <div class="amenities-icon" for="facilitie_<?php echo $facilitie->id; ?>"> 
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>img/facilities-icon1.png"> 
                                       </div>
                                       <div class="amenities-title">
                                          <?php echo $facilitie->facility_name; ?> 
                                       </div>
                                    </label>
                                    <div class="clearfix"></div>
                                 </li>
                              <?php 
                              }
                           }
                        }?>                    
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
         <div class="btn-next-con"> 
            <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
            <a class="btn-back" href="javascript:void(0)" onclick="backtostep5();">Back</a> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<script type="text/javascript">
   function backtostep5(){
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
               $('#tab6').hide().html('');
               $('#tab5').show().html(response.nexthtml);
               $('#tab_menu_6').removeClass('active2');
               $('#tab_menu_5').addClass('active2');
               $('#add_resort_res').hide();
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }    
   $('#add_resort_6').validate({
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/save_resort_6",
            type:"POST",
            data:$("#add_resort_6" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  nextlable();
                  $('#tab6').hide().html('');
                  $('#tab7').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_6').removeClass('active2');
                  $('#tab_menu_7').removeClass('disable');
                  $('#tab_menu_7').addClass('active2');
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   });
</script>