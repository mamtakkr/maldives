<!--== RESORT START ==-->
<!--<link href="https://www.maldivesexperts.com/assets/front/css/style.css" rel="stylesheet" type="text/css">
<link href="https://www.maldivesexperts.com/assets/front/css/dev.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/custom.css" type="text/css">
<link href="<?php echo  FRONT_THEAM_PATH ;?>css/dev.css" rel="stylesheet" type="text/css">
<section class="bg-transparent add-resort-wrapp">
   <div class="container-fluid p-0">
      <div class="page-wrapper">
         <div class="wrapper">
            <div class="card border-0">
               <div class="card-body p-0">                  
                  <!-- <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="js-wizard-form"> -->
                     <div class="progress" id="js-progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"> <span class="progress-val">10%</span> </div>
                     </div>
                     <input type="hidden" id="step_id" value="1">
                     <input type="hidden" id="step_val" value="10">
                     <input type="hidden" id="resort_id" value="<?php if($this->input->get('resort_id')){echo base64_decode($this->input->get('resort_id'));} ?>">
                     <div class="container">
                        <div class="row">
                              <div class="col-md-3 tabb">
                                    <ul class="nav nav-tab">
                                       <li> <a href="#tab1" onclick="go_to_step_dr_1()" id="tab_menu_1" data-toggle="tab" class="active2">General Information</a> </li>
                                       <li><a href="#tab2" onclick="go_to_step_dr_2()" id="tab_menu_2" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Resort Information</a> </li>
                                       <li><a href="#tab3" onclick="go_to_step_dr_3()" id="tab_menu_3" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">About Resort</a> </li>
                                       <li><a href="#tab4" onclick="go_to_step_dr_4()" id="tab_menu_4" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Resorts Facilities</a> </li>
                                       <li><a href="#tab5" onclick="go_to_step_dr_5()" id="tab_menu_5" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Accommodation</a> </li>
                                      <!--  <li><a href="#tab6" id="tab_menu_6" data-toggle="tab" class="disable">Step 6 : Room Facilities</a> </li> -->
                                       <li><a href="#tab7" onclick="go_to_step_dr_7()" id="tab_menu_7" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Sports & Entertainments</a> </li>
                                       <li><a href="#tab8" onclick="go_to_step_dr_8()" id="tab_menu_8" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Dining</a> </li>
                                       <li><a href="#tab9" onclick="go_to_step_dr_9()" id="tab_menu_9" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">SPA/Health & Wellness</a> </li>
                                       <li><a href="#tab10" onclick="go_to_step_dr_10()" id="tab_menu_10" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">Resort Activities & Excursions</a> </li>
                                       <!--<li><a href="#tab11" onclick="go_to_step_dr_11()" id="tab_menu_11" data-toggle="tab" class="<?php echo empty($this->input->get('resort_id'))?'disable':''; ?>">FAQ</a> </li>-->
                                    </ul>
                              </div>
                              <div class="col-md-9">
                                 <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                       <?php include('add_resort_1.php'); ?>
                                    </div>
                                    <div class="tab-pane" id="tab2"></div>
                                    <div class="tab-pane" id="tab3"></div>
                                    <div class="tab-pane" id="tab4"></div>
                                    <div class="tab-pane" id="tab5"></div>
                                    <div class="tab-pane" id="tab6"></div>
                                    <div class="tab-pane" id="tab7"></div>
                                    <div class="tab-pane" id="tab8"></div>
                                    <div class="tab-pane" id="tab9"></div>
                                    <div class="tab-pane" id="tab10"></div>
                                    <div class="tab-pane" id="tab11"></div>
                                 </div>

                              </div>
                        </div>
                         </div>     
                       <div id="add_resort_res"></div>

                 <!--  </form> -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>
</section>
<div class="clearfix"> </div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2" aria-hidden="true">
   <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header text-center border-bottom-0">
            <h5 class="modal-title text-center" id="exampleModalCenterTitle">
               <div class="thankyou">Submission Successful</div>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body  text-center pl-5 pr-5">
            <div class="verify-email-grap">
               <img src="<?php echo  FRONT_THEAM_PATH ;?>img/thankyou.png">
               <div class="clearfix"></div>
               <span>Thanks for using Maldives Experts! </span>
            </div>
            <div class="clearfix"></div>
            <div class="thanks-message">
               <div class="clearfix"></div>
               Your resort details have been successfully done
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	function go_to_step_dr_1(){
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
	         url:base_url+"home/edit_resort_1",
	         type:"POST",
	         data:{resort_id:resort_id}, 
	         success: function(html){
	            var response = $.parseJSON(html); 
	            if(response.status=='true'){
	               $('#tab2,#tab3,#tab4,#tab5,#tab6,#tab7,#tab8,#tab9,#tab10').hide().html('');
	               $('#tab1').show().html(response.nexthtml);
	               $('#add_resort_res').hide();
	               $('#tab_menu_10,#tab_menu_2,#tab_menu_3,#tab_menu_4,#tab_menu_5,#tab_menu_6,#tab_menu_7,#tab_menu_8,#tab_menu_9').removeClass('active2');
	               $('#tab_menu_1').addClass('active2');
	            }else{ 
	               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
	            }
	         }                
	      });
	}
	function go_to_step_dr_2(){
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
	        url:base_url+"home/edit_resort_2",
	        type:"POST",
	        data:{resort_id:resort_id}, 
	        success: function(html){
	            var response = $.parseJSON(html); 
	            if(response.status=='true'){
	               $('#tab1,#tab3,#tab4,#tab5,#tab6,#tab7,#tab8,#tab9,#tab10').hide().html('');
	               $('#tab2').show().html(response.nexthtml);
	               $('#add_resort_res').hide();
	               $('#tab_menu_1,#tab_menu_10,#tab_menu_3,#tab_menu_4,#tab_menu_5,#tab_menu_6,#tab_menu_7,#tab_menu_8,#tab_menu_9').removeClass('active2');
	               $('#tab_menu_2').addClass('active2');
	            }else{ 
	               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
	            }
	        }                
	    });
	}
	function go_to_step_dr_3(){
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
         	url:base_url+"home/edit_resort_3",
         	type:"POST",
         	data:{resort_id:resort_id}, 
         	success: function(html){
	            var response = $.parseJSON(html); 
	            if(response.status=='true'){
	               $('#tab2,#tab4,#tab1,#tab5,#tab6,#tab7,#tab8,#tab9,#tab10').hide().html('');
	               $('#tab3').show().html(response.nexthtml);
	               $('#add_resort_res').hide();
	               $('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_4,#tab_menu_5,#tab_menu_6,#tab_menu_7,#tab_menu_8,#tab_menu_9').removeClass('active2');
	               $('#tab_menu_3').addClass('active2');
	            }else{ 
	               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
	            }
         	}                
      	});
	}
	function go_to_step_dr_4(){
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
			      	$('#tab2,#tab3,#tab1,#tab5,#tab6,#tab7,#tab8,#tab9,#tab10').hide().html('');
			      	$('#tab4').show().html(response.nexthtml);
			      	$('#add_resort_res').hide();
			      	$('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_4,#tab_menu_5,#tab_menu_6,#tab_menu_7,#tab_menu_8,#tab_menu_9').removeClass('active2');
			      	$('#tab_menu_4').addClass('active2');
			    }else{ 
			       $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
			    }
		 	}                
		});
	}
	function go_to_step_dr_5(){
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
	               $('#tab2,#tab3,#tab1,#tab4,#tab6,#tab7,#tab8,#tab9,#tab10').hide();
	               $('#tab5').show().html(response.nexthtml);
	               $('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_7,#tab_menu_3,#tab_menu_4,#tab_menu_6,#tab_menu_7,#tab_menu_8,#tab_menu_9').removeClass('active2');
	               $('#tab_menu_5').addClass('active2');
	               $('#add_resort_res').hide();
	            }else{ 
	               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
	            }
	        }                
      	});
	}
	function go_to_step_dr_7(){
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
		 	url:base_url+"home/edit_resort_7",
		 	type:"POST",
		 	data:{resort_id:resort_id}, 
		 	success: function(html){
		    	var response = $.parseJSON(html); 
			    if(response.status=='true'){
			       $('#tab2,#tab3,#tab1,#tab5,#tab6,#tab4,#tab8,#tab9,#tab10').hide();
			       $('#tab7').show().html(response.nexthtml);
			       $('#add_resort_res').hide();
			       $('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_4,#tab_menu_5,#tab_menu_6,#tab_menu_3,#tab_menu_8,#tab_menu_9').removeClass('active2');
			       $('#tab_menu_7').addClass('active2');			       
			    }else{ 
			       $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
			    }
		 	}                
		});
	}
	function go_to_step_dr_8(){
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
	                $('#tab2,#tab3,#tab1,#tab5,#tab6,#tab7,#tab4,#tab9,#tab10').hide();
	                $('#tab8').show().html(response.nexthtml);
	                $('#add_resort_res').hide();
	                $('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_7,#tab_menu_5,#tab_menu_6,#tab_menu_3,#tab_menu_4,#tab_menu_9').removeClass('active2');
                	$('#tab_menu_8').addClass('active2');
	            }else{ 
	               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
	            }
	        }                
      	});
	}
	function go_to_step_dr_9(){
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
		        	$('#tab2,#tab3,#tab1,#tab5,#tab6,#tab7,#tab8,#tab4,#tab10').hide();
		        	$('#tab9').show().html(response.nexthtml);
		        	$('#add_resort_res').hide();
		        	$('#tab_menu_1,#tab_menu_10,#tab_menu_2,#tab_menu_7,#tab_menu_5,#tab_menu_6,#tab_menu_3,#tab_menu_4,#tab_menu_8').removeClass('active2');
                	$('#tab_menu_9').addClass('active2');
		    	}else{ 
		       	$('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
		    	}
		 	}                
		});
	}
	function go_to_step_dr_10(){
		 var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/get_resort_10",
            type:"POST",
            data:{'resort_id':resort_id}, 
            success: function(html){
               	var response = $.parseJSON(html); 
               	if(response.status=='true'){
                  	nextlable();
                  	$('#tab2,#tab3,#tab1,#tab5,#tab6,#tab7,#tab8,#tab9,#tab4,#tab11').hide();
                  	$('#tab10').show().html(response.nexthtml);
                  	$('#add_resort_res').hide();
                  	$('#tab_menu_1,#tab_menu_9,#tab_menu_2,#tab_menu_7,#tab_menu_5,#tab_menu_6,#tab_menu_3,#tab_menu_4,#tab_menu_8,#tab_menu_11').removeClass('active2');
                	$('#tab_menu_10').addClass('active2');
                }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
        });
	}
	function go_to_step_dr_11(){
		 var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/get_resort_11",
            type:"POST",
            data:{'resort_id':resort_id}, 
            success: function(html){
				var response = $.parseJSON(html); 
               	if(response.status=='true'){
                  	nextlable();
					$('#tab1,#tab2,#tab3,#tab4,#tab5,#tab6,#tab7,#tab8,#tab9,#tab10').hide();                  	
					$('#tab11').show().html(response.nexthtml);
                  	$('#add_resort_res').hide();
                  	$('#tab_menu_1,#tab_menu_9,#tab_menu_2,#tab_menu_7,#tab_menu_5,#tab_menu_6,#tab_menu_3,#tab_menu_4,#tab_menu_8,#tab_menu_10').removeClass('active2');
                	$('#tab_menu_11').addClass('active2');
                }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
        });
	}
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>