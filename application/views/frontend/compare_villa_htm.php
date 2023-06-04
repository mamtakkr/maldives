<?php 
  $one_holidays   = $two_holidays = $three_holidays = $amenities_one = $amenities_two = $amenities_three = $facilities_one = $facilities_two = $facilities_three = array();
  $villa_type_one=$villa_type_two=$villa_type_three='';
  
//   var_dump("here",$villa_one);die;
//   if(!empty($villa_one->holidays)){
//     $one_holidays = explode(',', $villa_one->holidays);
//   }  
//   if(!empty($villa_two->holidays)){
//     $two_holidays = explode(',', $villa_two->holidays);
//   }
//   if(!empty($resort_three->holidays)){
//     $three_holidays = explode(',', $resort_three->holidays);
//   }
  if(!empty($villa_one->ideal_for)){
    $mal_ideals=[];
    foreach(explode(',', $villa_one->ideal_for) as $ideals_one)
    {
        $mal_ideals_for  = $this->common_model->get_result('mal_ideals', array('id' => $ideals_one)); 
        $mal_ideals[] = $mal_ideals_for[0]->ideal_name;
    }
    $one_holidays = $mal_ideals;
  }  
  if(!empty($villa_two->ideal_for)){
    $mal_ideals=[];
    foreach(explode(',', $villa_two->ideal_for) as $ideals_two)
    {
        $mal_ideals_for  = $this->common_model->get_result('mal_ideals', array('id' => $ideals_two)); 
        $mal_ideals[] = $mal_ideals_for[0]->ideal_name;
    }
    $two_holidays = $mal_ideals;
  } 
  if(!empty($villa_three->ideal_for)){
    $mal_ideals=[];
    foreach(explode(',', $villa_three->ideal_for) as $ideals_three)
    {
        $mal_ideals_for  = $this->common_model->get_result('mal_ideals', array('id' => $ideals_three)); 
        $mal_ideals[] = $mal_ideals_for[0]->ideal_name;
    }
    $three_holidays = $mal_ideals;
  } 
  if(!empty($resort_three->holidays)){
    $three_holidays = explode(',', $resort_three->holidays);
  }
  $all_hiliday  = array_unique(array_merge($one_holidays, $two_holidays, $three_holidays)); 
  if(!empty($villa_one->id)){
    $villa_type_one    = $villa_one->villa_type;   
    $amenities_one  = !empty($villa_one->amenities)?explode(',', $villa_one->amenities):array(); 
    $facilities_one = !empty($villa_one->facilities)?explode(',', $villa_one->facilities):array(); 
    $villa1 = $this->common_model->get_result('resorts', array('id'=>$villa_one->resort_id));
    $villa1 = $this->common_model->get_result('resorts', array('id'=>$villa_one->resort_id));
		
  }
  if(!empty($villa_two->id)){ 
	$villa_type_two    = $villa_two->villa_type;   
    $amenities_two  = !empty($villa_two->amenities)?explode(',', $villa_two->amenities):array();         
    $facilities_two  = !empty($villa_two->facilities)?explode(',', $villa_two->facilities):array();  
    $villa2 = $this->common_model->get_result('resorts', array('id'=>$villa_two->resort_id));
	
  }
  if(!empty($villa_three->id)){   
    $villa_type_three    = $villa_three->villa_type;      
    $amenities_three = !empty($villa_three->amenities)?explode(',', $villa_three->amenities):array(); 
    $facilities_three = !empty($villa_three->facilities)?explode(',', $villa_three->facilities):array(); 
    $villa3 = $this->common_model->get_result('resorts', array('id'=>$villa_three->resort_id));
	
  }
 
 
 $all_amenities    = array_unique(array_merge($amenities_one, $amenities_two, $amenities_three));
  $all_facilities    = array_unique(array_merge($facilities_one, $facilities_two, $facilities_three)); 
  sort($all_amenities); 
  sort($all_facilities); 
  //exit;
?>

    <div class="villas-content">
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title  pl-lg-0" style="text-align: left;">Resort</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa1[0])){?>
    				    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($villa1[0]->id)); ?>" target="blank">
    				        <?php echo !empty($villa1[0]->resort_name)?ucfirst($villa1[0]->resort_name):'-'; ?>
    				    </a>
    				    <?php }?>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title  pl-lg-0" style="text-align: left;">Resort</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa2[0])){?>
        				    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($villa2[0]->id)); ?>" target="blank">
        				        <?php echo !empty($villa2[0]->resort_name)?ucfirst($villa2[0]->resort_name):'-'; ?>
        				    </a>
        				<?php }?>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Resort</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa3[0])){?>
        				    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($villa3[0]->id)); ?>" target="blank">
        				        <?php echo !empty($villa3[0]->resort_name)?ucfirst($villa3[0]->resort_name):'-'; ?>
        				    </a>
        				<?php }?>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Villa types</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo $villa_type_one;?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title  pl-lg-0" style="text-align: left;">Villa types</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo $villa_type_two;?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4"> 
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Villa types</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo $villa_type_three;?></div>
    			</div>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title  pl-lg-0" style="text-align: left;">villa Size</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_one->room_size)?number_format($villa_one->room_size, 2).' sqm ':''; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title pl-lg-0" style="text-align: left;">villa Size</div>     
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_two->room_size)?number_format($villa_two->room_size, 2).' sqm ':''; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">villa Size</div>     
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_type_three->room_size)?number_format($villa_three->room_size, 2).' sqm ':''; ?></div>
    			</div>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title  pl-lg-0" style="text-align: left;">Maximum Occupancy</div>    
    			<?php 
    				if(!empty($all_hiliday)){
    					foreach($all_hiliday  as $holiday){
    						if(in_array($holiday, $one_holidays)){
    							echo '<div class="resort-category-container"><div class="resort-category-name">'.$holiday.'</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    			?>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title pl-lg-0" style="text-align: left;">Maximum Occupancy</div>   
    			<?php 
    				if(!empty($all_hiliday)){
    					foreach($all_hiliday  as $holiday){
    						if(in_array($holiday, $two_holidays)){
    							echo '<div class="resort-category-container"><div class="resort-category-name">'.$holiday.'</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    			?>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Maximum Occupancy</div>   
    			<?php 
    				if(!empty($all_hiliday)){
    					foreach($all_hiliday  as $holiday){
    						if(in_array($holiday, $three_holidays)){
    							echo '<div class="resort-category-container"><div class="resort-category-name">'.$holiday.'</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    			?>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Private Pool</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa_one->villa_with_pool) && $villa_one->villa_with_pool==2){echo "No";}else{ echo "Yes";} ?>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title  pl-lg-0" style="text-align: left;">Private Pool</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa_two->villa_with_pool) && $villa_two->villa_with_pool==2){echo "No";}else{ echo "Yes";} ?>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Private Pool</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name">
    				    <?php if(!empty($villa_three->villa_with_pool) && $villa_three->villa_with_pool==2){echo "No";}else{ echo "Yes";} ?>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    	
    	<div id="villas-show-more"><a href="javascript:void(0)">View all</a></div>
    
    <div id="villas-show-more-content">
        
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title  pl-lg-0" style="text-align: left;">No of Units</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_one->number_of_units)?$villa_one->number_of_units:'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4 col-border">
    		<div class="compare-hotel-title  pl-lg-0" style="text-align: left;">No of Units</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_two->number_of_units)?$villa_two->number_of_units:'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">No of Units</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_three->number_of_units)?$villa_three->number_of_units:'-'; ?></div>
    			</div>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title  pl-lg-0" style="text-align: left;">Living Room</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_one->is_living_status)?'Yes':'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4 col-border">
    		<div class="compare-hotel-title   pl-lg-0" style="text-align: left;">Living Room</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_two->is_living_status)?'Yes':'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    			<div class="resort-category-container" style="text-align: left;">
    			<div class="compare-hotel-title new_moblie_title pl-lg-0">Living Room</div>    
    				<div class="resort-category-name"><?php echo !empty($villa_three->is_living_status)?'Yes':'-'; ?></div>
    			</div>
    		</div>
    	</div>
	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    	    <div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Location</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_one->villa_location)? ucfirst($villa_one->villa_location):'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4 col-border">
    	    <div class="compare-hotel-title pl-lg-0" style="text-align: left;">Location</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_two->villa_location)? ucfirst($villa_two->villa_location):'-'; ?></div>
    			</div>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    	    <div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Location</div>    
    			<div class="resort-category-container">
    				<div class="resort-category-name"><?php echo !empty($villa_three->villa_location)? ucfirst($villa_three->villa_location):'-'; ?></div>
    			      	
    			</div>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Villa Facilities</div>    
    		
    			<?php 
                    //echo "<pre>"; var_dump($all_amenities);
    				// if(!empty($all_facilities)){  
    				// 	foreach ($all_facilities as $facility) {
    				// 		if(in_array($facility, $facilities_one)){
    				// 			$facility1= $this->common_model->get_row('facilities', array('id'=>$facility));
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">';
    				// 				echo !empty($facility1->facility_name)?$facility1->facility_name:'-';
    				// 			echo '</div></div>';
    				// 		}else{
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    				// 		}
    				// 	}
    				// }
    				
    				if(!empty($all_amenities)){  
    					foreach ($all_amenities as $amenities) {
    						if(in_array($amenities, $amenities_one)){
    							$amenities1= $this->common_model->get_row('amenities', array('id'=>$amenities));
    							echo '<div class="resort-category-container"><div class="resort-category-name">';
    								echo !empty($amenities1->amenitie_name)?$amenities1->amenitie_name:'-';
    							echo '</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    			?>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title pl-lg-0" style="text-align: left;">Villa Facilities</div>    
    			<?php 
    				// if(!empty($all_facilities)){  
    				// 	foreach ($all_facilities as $facility) {
    				// 		if(in_array($facility, $facilities_two)){
    				// 			$facility2= $this->common_model->get_row('facilities', array('id'=>$facility));
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">';
    				// 				echo !empty($facility2->facility_name)?$facility2->facility_name:'-';
    				// 			echo '</div></div>';
    				// 		}else{
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    				// 		}
    				// 	}
    				// }
    				
    				if(!empty($all_amenities)){  
    					foreach ($all_amenities as $amenities) {
    						if(in_array($amenities, $amenities_two)){
    							$amenities2= $this->common_model->get_row('amenities', array('id'=>$amenities));
    							echo '<div class="resort-category-container"><div class="resort-category-name">';
    								echo !empty($amenities2->amenitie_name)?$amenities2->amenitie_name:'-';
    							echo '</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    				
    			?>
    		</div>
    		<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    		<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Villa Facilities</div>    
    			<?php 
    				// if(!empty($all_facilities)){  
    				// 	foreach ($all_facilities as $facility) {
    				// 		if(in_array($facility, $facilities_three)){
    				// 			$facility3= $this->common_model->get_row('facilities', array('id'=>$facility));
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">';
    				// 				echo !empty($facility3->facility_name)?$facility3->facility_name:'-';
    				// 			echo '</div></div>';
    				// 		}else{
    				// 			echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    				// 		}
    				// 	}
    				// }
    				
    				if(!empty($all_amenities)){  
    					foreach ($all_amenities as $amenities) {
    						if(in_array($amenities, $amenities_three)){
    							$amenities3= $this->common_model->get_row('amenities', array('id'=>$amenities));
    							echo '<div class="resort-category-container"><div class="resort-category-name">';
    								echo !empty($amenities3->amenitie_name)?$amenities3->amenitie_name:'-';
    							echo '</div></div>';
    						}else{
    							echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
    						}
    					}
    				}
    			?>
    		</div>
    	</div>
    	
    	<div class="row pt-3">
    	<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    	<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Floor plans</div>    
    		<div class="resort-category-container">
    			<div class="resort-category-name">
    				<?php 
    					if(!empty($villa_one->floor_plan) && file_exists('uploads/resorts/'.$villa_one->floor_plan)){
    						?>
    						<a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$villa_one->floor_plan;?>" class="ideal-link FloorPlanLink">
    							<img  class="d-block w-100" src="<?php echo base_url();?>uploads/resorts/<?php echo $villa_one->floor_plan;?>" alt="resort" class="img-fluid"/>
    						</a>
    						<?php 
    					} else {
    						echo "-";
    					}
    				?>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    	<div class="compare-hotel-title   pl-lg-0" style="text-align: left;">Floor plans</div>    
    		<div class="resort-category-container">
    			<div class="resort-category-name">
    				<?php 
    					if(!empty($villa_two->floor_plan) && file_exists('uploads/resorts/'.$villa_two->floor_plan)){
    						?>
    						<a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$villa_two->floor_plan;?>" class="ideal-link FloorPlanLink">
    							<img  class="d-block w-100" src="<?php echo base_url();?>uploads/resorts/<?php echo $villa_two->floor_plan;?>" alt="resort" class="img-fluid"/>	
    						</a>
    						<?php 
    					} else {
    						echo "-";
    					}
    				?>
    			</div>
    		</div>
    	</div>
    	<div class="col-lg-4 col-md-4 col-sm-4 col-4">
    	<div class="compare-hotel-title new_moblie_title pl-lg-0" style="text-align: left;">Floor plans</div>     
    		<div class="resort-category-container">
    			<div class="resort-category-name">
    				<?php 
    					if(!empty($villa_three->floor_plan) && file_exists('uploads/resorts/'.$villa_three->floor_plan)){
    						?>
    						<a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$villa_three->floor_plan;?>" class="ideal-link FloorPlanLink">
    							<img  class="d-block w-100" src="<?php echo base_url();?>uploads/resorts/<?php echo $villa_three->floor_plan;?>" alt="resort" class="img-fluid"/>	
    						</a>
    						<?php 
    					} else {
    						echo "-";
    					}
    				?>
    			</div>
    		</div>
    	</div>
    	</div>
	
        <div id="villas-show-less"><a href="javascript:void(0)">View less</a></div>
     
    </div>
    </div>
	 <div class="modal fade" id="Modal_FloorPlan" tabindex="-1" role="dialog" aria-labelledby="Modal_FloorPlan" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Floor Plan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
               <img src="" id="FloorPlanImage" alt="FloorPlanImage" style="width:100%" />
				</div>
			</div>
		</div>
	</div>
    
    <script>
        $('#villas-show-more-content').hide();

        $('#villas-show-more').click(function(){
        	$('#villas-show-more-content').show(300);
        	$('#villas-show-less').show();
        	$('#villas-show-more').hide();
        });
        
        $('#villas-show-less').click(function(){
        	$('#villas-show-more-content').hide(150);
        	$('#villas-show-more').show();
        	$(this).hide();
        });
        
        
        $('.FloorPlanLink').on('click', function() {
         $('#FloorPlanImage').attr('src',$(this).attr('myurl'));
         $('#Modal_FloorPlan').modal('show');
       });
    </script>
            				  
	

	