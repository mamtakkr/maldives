<?php 
  $one_holidays   = $two_holidays = $three_holidays = $amenities_one = $amenities_two = $amenities_three = $facilities_one = $facilities_two = $facilities_three = array();

  if(!empty($resort_one->holidays)){
    $one_holidays = explode(',', $resort_one->holidays);
  }  
  if(!empty($resort_two->holidays)){
    $two_holidays = explode(',', $resort_two->holidays);
  }
  if(!empty($resort_three->holidays)){
    $three_holidays = explode(',', $resort_three->holidays);
  }
  $all_hiliday  = array_unique(array_merge($one_holidays, $two_holidays, $three_holidays)); 
  $all_airports = $all_villa_types = array();
  if(!empty($resort_one->id)){   
    $airports_one   = $this->developer_model->user_international_airports($resort_one->id);
    $villas_one     = $this->developer_model->resort_villas($resort_one->id);    
    $amenities_one  = !empty($resort_one->amenities)?explode(',', $resort_one->amenities):array(); 
    $facilities_one = !empty($resort_one->facilities)?explode(',', $resort_one->facilities):array(); 
	$sports1 = explode(",",$resort_one->sports);
	$sports_one = array();
	
	
	foreach($sports1 as $sport1){
		$sports_1     = $this->common_model->get_row('mal_sport',array('id'=>$sport1));
		if(!empty($sports_1->id)){
		    $sports_one[$sports_1->id] = $sports_1->sport_name;
		}
	}
	
	// meal type
	$mealtype1 = explode(",",$resort_one->meal_plans);
	$meal_type_one = array();
	foreach($mealtype1 as $mealt1){
		
		$mealt_1     = $this->common_model->get_row('mal_meal_plans',array('id'=>$mealt1));
		$meal_type_one[$mealt_1->id] = $mealt_1->meal_plans_name;
	}
	
  }
  if(!empty($resort_two->id)){   
    $airports_two   = $this->developer_model->user_international_airports($resort_two->id);
    $villas_two     = $this->developer_model->resort_villas($resort_two->id); 
    $amenities_two  = !empty($resort_two->amenities)?explode(',', $resort_two->amenities):array();         
    $facilities_two  = !empty($resort_two->facilities)?explode(',', $resort_two->facilities):array();  
	$sports2 = explode(",",$resort_two->sports);
	$sports_two = array();
	foreach($sports2 as $sport2){
		
		$sports_2     = $this->common_model->get_row('mal_sport',array('id'=>$sport2));
        if(isset($sports_2->sport_name) && $sports_2->sport_name!="") {
            $sports_two[$sports_2->id] = $sports_2->sport_name;
        }
		
	}
	// meal type
	$mealtype2 = explode(",",$resort_two->meal_plans);
	$meal_type_two = array();
	foreach($mealtype2 as $mealt2){
		
		$mealt_2     = $this->common_model->get_row('mal_meal_plans',array('id'=>$mealt2));
        if(isset($mealt_2->meal_plans_name) && $mealt_2->meal_plans_name!="") {
            $meal_type_two[$mealt_2->id] = $mealt_2->meal_plans_name;
        }
	}
  }
  if(!empty($resort_three->id)){   
    $airports_three  = $this->developer_model->user_international_airports($resort_three->id);
    $villas_three    = $this->developer_model->resort_villas($resort_three->id);      
    $amenities_three = !empty($resort_three->amenities)?explode(',', $resort_three->amenities):array(); 
    $facilities_three = !empty($resort_three->facilities)?explode(',', $resort_three->facilities):array(); 
	$sports3 = explode(",",$resort_three->sports);
	$sports_three = array();
	foreach($sports3 as $sport3){
		
		$sports_3     = $this->common_model->get_row('mal_sport',array('id'=>$sport3));
        if(isset($sports_3->sport_name) && $sports_3->sport_name!="") {
            $sports_three[$sports_3->id] = $sports_3->sport_name;
        }
	}
	// meal type
	$mealtype3 = explode(",",$resort_three->meal_plans);
	$meal_type_three = array();
	foreach($mealtype3 as $mealt3){
		
		$mealt_3     = $this->common_model->get_row('mal_meal_plans',array('id'=>$mealt3));
        if(isset($mealt_3->meal_plans_name) && $mealt_3->meal_plans_name!="") {
            $meal_type_three[$mealt_3->id] = $mealt_3->meal_plans_name;
        }
		
	}
  }
  if(!empty($airports_one)){
    foreach($airports_one as $airport_one){
      $all_airports[] = $airport_one->airport_type;
    }
  }
  if(!empty($airports_two)){
    foreach($airports_two as $airport_two){
      $all_airports[] = $airport_two->airport_type;
    }
  }
  if(!empty($airports_three)){
    foreach($airports_three as $airport_three){
      $all_airports[] = $airport_three->airport_type;
    }
  }
  if(!empty($villas_one)){
    foreach($villas_one as $villa_one){
      $all_villa_types[] = $villa_one->villas_type;
    }
  }
  if(!empty($villas_two)){
    foreach($villas_two as $villa_two){
      $all_villa_types[] = $villa_two->villas_type;
    }
  }
  if(!empty($villas_three)){
    foreach($villas_three as $villa_three){
      $all_villa_types[] = $villa_three->villas_type;
    }
  }
  $all_airports     = array_unique($all_airports); 
  $all_villa_types  = array_unique($all_villa_types); 
  $all_amenities    = array_unique(array_merge($amenities_one, $amenities_two, $amenities_three)); 
  $all_facilities    = array_unique(array_merge($facilities_one, $facilities_two, $facilities_three)); 
  sort($all_amenities); 
  sort($all_facilities); 
?>
<!-- for first row -->
    
    <div class="content">
        <div class="row pt-3">
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Location</div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <a href="<?php echo !empty($resort_one->maps_location)?ucfirst($resort_one->maps_location):'-'; ?>" target="blank"><?php echo !empty($resort_one->maps_location)?ucfirst($resort_one->maps_location):'-'; ?></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
             <div class="compare-hotel-title px-lg-0">Location</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <a href="<?php echo !empty($resort_two->maps_location)?ucfirst($resort_two->maps_location):'-'; ?>"target="blank"><?php echo !empty($resort_two->maps_location)?ucfirst($resort_two->maps_location):'-'; ?></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Location</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <a href="<?php echo !empty($resort_three->maps_location)?ucfirst($resort_three->maps_location):'-'; ?>" target="blank"><?php echo !empty($resort_three->maps_location)?ucfirst($resort_three->maps_location):'-'; ?></a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row pt-3">
           
            <div class="col-4">
             <div class="compare-hotel-title new_moblie_title px-lg-0">Mode Of Transfers</div>    
                <?php 
                    if(!empty($all_airports)){
                        foreach($all_airports as $all_airport){
                            if(!empty($resort_one->id)){
                                $airport = $this->developer_model->user_international_airport_row($resort_one->id, $all_airport);
                                if(!empty($airport)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">'.$airport->airport_type_name;
                                    echo !empty($airport->minuts1)?' : '.$airport->minuts1.' min':'';
                                    echo '</div></div>'; 
                                }else{
                                    echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }            
                        }
                    }    
                    $airport = '';
                ?>
            </div>
            
           
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Mode Of Transfers</div>     
                <?php 
                    if(!empty($all_airports)){
                        foreach($all_airports as $all_airport){
                            if(!empty($resort_two->id)){
                                $airport = $this->developer_model->user_international_airport_row($resort_two->id, $all_airport);
                                if(!empty($airport)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">'.$airport->airport_type_name;
                                    echo !empty($airport->minuts1)?' : '.$airport->minuts1.' min':'';
                                    echo '</div></div>'; 
                                }else{
                                    echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }            
                        }
                    }    
                    $airport = '';
                ?> 
            </div>
            
            
            <div class="col-4 ">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Mode Of Transfers</div>    
                <?php 
                    if(!empty($all_airports)){
                        foreach($all_airports as $all_airport){
                            if(!empty($resort_three->id)){
                                $airport = $this->developer_model->user_international_airport_row($resort_three->id, $all_airport);
                                if(!empty($airport)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">'.$airport->airport_type_name;
                                    echo !empty($airport->minuts1)?' : '.$airport->minuts1.' min':'';
                                    echo '</div></div>'; 
                                }else{
                                    echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }            
                        }
                    }    
                    $airport = '';
                ?> 
            </div>
        </div>
    
        <div class="row pt-3">
           
            <div class="col-4">
             <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Size</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php echo !empty($resort_one->island_size_length)?number_format($resort_one->island_size_length, 2).' kms ':''; ?>
                        <?php echo !empty($resort_one->island_size_width)?' x '.number_format($resort_one->island_size_width, 2).' kms ':''; ?> 
                    </div>
                </div>
            </div>
            
          
            <div class="col-4">
             <div class="compare-hotel-title px-lg-0">Resort Size</div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php echo !empty($resort_two->island_size_length)?number_format($resort_two->island_size_length, 2).' kms ':''; ?>
                        <?php echo !empty($resort_two->island_size_width)?' x '.number_format($resort_two->island_size_width, 2).' kms ':''; ?> 
                    </div>
                </div>
            </div>
            
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Size</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php echo !empty($resort_three->island_size_length)?number_format($resort_three->island_size_length, 2).' kms ':''; ?>
                        <?php echo !empty($resort_three->island_size_width)?' x '.number_format($resort_three->island_size_width, 2).' kms ':''; ?> 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row pt-3">
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Villas & Suites</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php if(!empty($resort_one->id)){  
                            echo $resort_one_acc_count;
                        }?>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Villas & Suites</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php if(!empty($resort_two->id)){  
                            echo $resort_two_acc_count;
                        }?>
                    </div>
                </div>
            </div>
           
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Villas & Suites</div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php if(!empty($resort_three->id)){  
                            echo $resort_three_acc_count;
                        }?>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row pt-3">
           
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Restaurants & Bars </div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php
                            if(!empty($resort_one->id)){      
                                $dine_count_1 = get_all_count('dinnings', array('dinnings.resort_id'=>$resort_one->id));
                                echo !empty($dine_count_1)?number_format($dine_count_1, 0)." Restaurants / Bars":'';
                            }else{
                                echo "-";
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Restaurants & Bars </div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php
                            if(!empty($resort_two->id)){      
                                $dine_count_1 = get_all_count('dinnings', array('dinnings.resort_id'=>$resort_two->id));
                                echo !empty($dine_count_1)?number_format($dine_count_1, 0)." Restaurants / Bars":'';
                            }else{
                                echo "-";
                            }
                        ?>
                    </div>
                </div>
            </div>
           
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title ">Restaurants & Bars </div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php
                            if(!empty($resort_three->id)){      
                                $dine_count_1 = get_all_count('dinnings', array('dinnings.resort_id'=>$resort_three->id));
                                echo !empty($dine_count_1)?number_format($dine_count_1, 0)." Restaurants / Bars":'';
                            }else{
                                echo "-";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row pt-3">
        
       
        <div class="col-4">
         <div class="compare-hotel-title new_moblie_title px-lg-0">Holiday Style</div>    
            <div class="resort-category-container">
                <div class="resort-category-name">
                    <?php 
						if(!empty($all_hiliday)){
						    foreach($all_hiliday  as $holiday){
                                if(in_array($holiday, $one_holidays)){
                                echo '<div class="resort-category-container">'.$holiday.'</div>';
                                }else{
                                echo '<div>-</div>';
                                }
						    }
						}
                    ?>
                </div>
            </div>
        </div>
        
        
        <div class="col-4">
        <div class="compare-hotel-title px-lg-0">Holiday Style</div>    
            <div class="resort-category-container">
                <div class="resort-category-name">
                    <?php 
						if(!empty($all_hiliday)){
						    foreach($all_hiliday  as $holiday){
                                if(in_array($holiday, $two_holidays)){
                                echo '<div class="resort-category-container">'.$holiday.'</div>';
                                }else{
                                echo '<div>-</div>';
                                }
						    }
						}
                    ?>
                </div>
            </div>
        </div>
        
      
        <div class="col-4">
        <div class="compare-hotel-title new_moblie_title px-lg-0">Holiday Style</div>      
            <div class="resort-category-container">
                <div class="resort-category-name">
                    <?php 
						if(!empty($all_hiliday)){
						    foreach($all_hiliday  as $holiday){
                                if(in_array($holiday, $three_holidays)){
                                echo '<div class="resort-category-container">'.$holiday.'</div>';
                                }else{
                                echo '<div>-</div>';
                                }
						    }
						}
                    ?>
                </div>
            </div>
        </div>
    </div>
   
        <div id="show-more"><a href="javascript:void(0)">View all</a></div>
    
    <div id="show-more-content">
        <div class="row pt-3">
        
        <div class="col-4">
        <div class="compare-hotel-title new_moblie_title px-lg-0">Meal Plans</div>    
            <?php 
                if(isset($meal_type_one)){
					foreach($meal_type_one as $val){?>
					    <div class="resort-category-container">
                            <div class="resort-category-name"><?php echo $val;?></div>
                        </div>
					    <?php 
                    }
				}else{
                    echo '-';
                }
            ?>
        </div>
        
        <div class="col-4">
        <div class="compare-hotel-title px-lg-0">Meal Plans</div>    
            <?php 
                if(isset($meal_type_two)){
					foreach($meal_type_two as $val){?>
					    <div class="resort-category-container">
                            <div class="resort-category-name"><?php echo $val;?></div>
                        </div>
					    <?php 
                    }
				}else{
                    echo '-';
                }
            ?>
        </div>
       
        <div class="col-4">
         <div class="compare-hotel-title new_moblie_title px-lg-0">Meal Plans</div>    
            <?php 
                if(isset($meal_type_three)){
					foreach($meal_type_three as $val){?>
					    <div class="resort-category-container">
                            <div class="resort-category-name"><?php echo $val;?></div>
                        </div>
					    <?php 
                    }
				}else{
                    echo '-';
                }
            ?>
        </div>
    </div>
    
        <div class="row pt-3">
        
        <div class="col-4">
        <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Facilities</div>    
            <?php 
                if(!empty($all_facilities)){  
                    foreach ($all_facilities as $facility) {
                        if(in_array($facility, $facilities_one)){
                            $facility1= $this->common_model->get_row('facilities', array('id'=>$facility));
                            echo '<div class="resort-category-container"><div class="resort-category-name">';
                            echo !empty($facility1->facility_name)?$facility1->facility_name:'-';
                            echo '</div></div>';
                        }else{
                            echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                        }
                    }
                }
            ?>
        </div>
        
        
        <div class="col-4">
        <div class="compare-hotel-title px-lg-0">Resort Facilities</div>    
            <?php 
                if(!empty($all_facilities)){  
                    foreach ($all_facilities as $facility) {
                        if(in_array($facility, $facilities_two)){
                            $facility2= $this->common_model->get_row('facilities', array('id'=>$facility));
                            echo '<div class="resort-category-container"><div class="resort-category-name">';
                            echo !empty($facility2->facility_name)?$facility2->facility_name:'-';
                            echo '</div></div>';
                        }else{
                            echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                        }
                    }
                }
            ?>
        </div>
        
       
        <div class="col-4">
        <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Facilities</div>     
            <?php 
                if(!empty($all_facilities)){  
                    foreach ($all_facilities as $facility) {
                        if(in_array($facility, $facilities_three)){
                            $facility3= $this->common_model->get_row('facilities', array('id'=>$facility));
                            echo '<div class="resort-category-container"><div class="resort-category-name">';
                            echo !empty($facility3->facility_name)?$facility3->facility_name:'-';
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
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Sports & Entertainment</div>    
                <?php 
                    if(isset($sports_one) && isset($sports_two) && isset($sports_three)) {
                        $keys = array_merge(array_keys($sports_one), array_keys($sports_two),array_keys($sports_three));
                        $vals = array_merge($sports_one, $sports_two, $sports_three);
                        $finalSport = array_combine($keys, $vals);
                        ksort($finalSport);
                            
                    } elseif(isset($sports_one) && isset($sports_two)) {
                        $keys = array_merge(array_keys($sports_one), array_keys($sports_two));
                        $vals = array_merge($sports_one, $sports_two);
                        $finalSport = array_combine($keys, $vals);
                        ksort($finalSport);
                    } else {
                        $finalSport = $sports_one;
                        ksort($finalSport);
                    }
    
                    
                    if(isset($sports_one)) {
    					foreach($finalSport as $k=>$v){
                            if(isset($sports_one[$k])) {?>
    					    <div class="resort-category-container">
                                <div class="resort-category-name"><?php echo $sports_one[$k];?></div>
                            </div>
    						<?php 
                            } else {
                                ?>
                                    <div class="resort-category-container">
                                        <div class="resort-category-name">-</div>
                                    </div>
                                <?php
                            }
                        }
    				}else{
                        ?>
                            <div class="resort-category-container">
                                <div class="resort-category-name">-</div>
                            </div>
                        <?php
                    }
                ?>
            </div>
            
            
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Sports & Entertainment</div>    
                <?php 
                    if(isset($sports_two)) {
    					foreach($finalSport as $k=>$v){
                            if(isset($sports_two[$k])) {?>
    					    <div class="resort-category-container">
                                <div class="resort-category-name"><?php echo $sports_two[$k];?></div>
                            </div>
    						<?php 
                            } else {
                                ?>
                                    <div class="resort-category-container">
                                        <div class="resort-category-name">-</div>
                                    </div>
                                <?php
                            }
                        }
    				}else{
                        ?>
                            <div class="resort-category-container">
                                <div class="resort-category-name">-</div>
                            </div>
                        <?php
                    }
                ?>
            </div>
            
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Sports & Entertainment</div>    
                <?php
                    if(isset($sports_three)) {
    					foreach($finalSport as $k=>$v){
                            if(isset($sports_three[$k])) {?>
    					    <div class="resort-category-container">
                                <div class="resort-category-name"><?php echo $sports_three[$k];?></div>
                            </div>
    						<?php 
                            } else {
                                ?>
                                    <div class="resort-category-container">
                                        <div class="resort-category-name">-</div>
                                    </div>
                                <?php
                            }
                        }
    				}else{
                        ?>
                            <div class="resort-category-container">
                                <div class="resort-category-name">-</div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        
        <div class="row pt-3 reviews_tre">
            
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Reviews</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php  
                        if(!empty($resort_one->id)){  
                            if(!empty($resort_one->total_reviews)){         
                            $avg_rates = get_rating($resort_one->id); 
                            echo !empty($avg_rates['rate_text'])?$avg_rates['rate_text']:'';  
                            echo " ";
                            echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; 
                            echo " / ";
                            echo ' reviews ';
                            echo !empty($resort_one->total_reviews)?$resort_one->total_reviews:''; 
                            
                            }else{
                                echo 'Be the first to review';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            
            
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Reviews</div>     
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php  
                            if(!empty($resort_two->id)){  
                                if(!empty($resort_two->total_reviews)){         
                                $avg_rates = get_rating($resort_two->id); 
                                echo !empty($avg_rates['rate_text'])?$avg_rates['rate_text']:'';  
                                echo " ";
                                echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; 
                                echo " / ";
                                echo ' reviews ';
                                echo !empty($resort_two->total_reviews)?$resort_two->total_reviews:''; 
                                
                                }else{
                                    echo 'Be the first to review';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Reviews</div>    
                <div class="resort-category-container">
                    <div class="resort-category-name">
                        <?php  
                            if(!empty($resort_three->id)){  
                                if(!empty($resort_three->total_reviews)){         
                                $avg_rates = get_rating($resort_three->id); 
                                echo !empty($avg_rates['rate_text'])?$avg_rates['rate_text']:'';  
                                echo " ";
                                echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; 
                                echo " / ";
                                echo ' reviews ';
                                echo !empty($resort_three->total_reviews)?$resort_three->total_reviews:''; 
                                
                                }else{
                                    echo 'Be the first to review';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row pt-3">
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Villa types</div>    
                <?php  
                    if(!empty($all_villa_types)){
                        foreach($all_villa_types as $all_villa_type){
                            if(!empty($resort_one->id)){
                                $resort_villa = $this->developer_model->resort_villas_row($resort_one->id, $all_villa_type); 
                                if(!empty($resort_villa)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">';
                                    if(!empty($resort_villa->villa_name)){
                                        echo $resort_villa->villa_name;
                                    }else if(!empty($resort_villa->villa_type_name)){
                                        echo $resort_villa->villa_type_name;
                                    }
                                    if(!empty($resort_villa->villas_type_counter)){
                                        echo ' : '.number_format($resort_villa->villas_type_counter, 0);
                                    }
                                    echo '</div></div>';
                                }else{
                                        echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }
                        }  
                    }         
                ?>
            </div>
           
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Villa types</div>     
                <?php  
                    if(!empty($all_villa_types)){
                        foreach($all_villa_types as $all_villa_type){
                            if(!empty($resort_two->id)){
                                $resort_villa = $this->developer_model->resort_villas_row($resort_two->id, $all_villa_type); 
                                if(!empty($resort_villa)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">';
                                    if(!empty($resort_villa->villa_name)){
                                        echo $resort_villa->villa_name;
                                    }else if(!empty($resort_villa->villa_type_name)){
                                        echo $resort_villa->villa_type_name;
                                    }
                                    if(!empty($resort_villa->villas_type_counter)){
                                        echo ' : '.number_format($resort_villa->villas_type_counter, 0);
                                    }
                                    echo '</div></div>';
                                }else{
                                        echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }
                        }  
                    }         
                ?>
            </div>
          
            <div class="col-4">
             <div class="compare-hotel-title new_moblie_title px-lg-0">Villa types</div>     
                <?php  
                    if(!empty($all_villa_types)){
                        foreach($all_villa_types as $all_villa_type){
                            if(!empty($resort_three->id)){
                                $resort_villa = $this->developer_model->resort_villas_row($resort_three->id, $all_villa_type); 
                                if(!empty($resort_villa)){
                                    echo '<div class="resort-category-container"><div class="resort-category-name">';
                                    if(!empty($resort_villa->villa_name)){
                                        echo $resort_villa->villa_name;
                                    }else if(!empty($resort_villa->villa_type_name)){
                                        echo $resort_villa->villa_type_name;
                                    }
                                    if(!empty($resort_villa->villas_type_counter)){
                                        echo ' : '.number_format($resort_villa->villas_type_counter, 0);
                                    }
                                    echo '</div></div>';
                                }else{
                                        echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                                }
                            }else{
                                echo '<div class="resort-category-container"><div class="resort-category-name">-</div></div>';
                            }
                        }  
                    }         
                ?>
            </div>
        </div>
        
        <div class="row pt-3">
            
            <div class="col-4">
            <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Category</div>    
                <div class="resort-category-container">
                    <?php if(!empty($resort_one->resort_category)) { ?>
                    <div class="">
                    	<div class="star-rating"> 
    						 <?php 
    							$category1 = $this->common_model->get_row('mal_category', array('id'=>$resort_one->resort_category));
    							for($i=0;$i< $category1->no_of_star;$i++){ ?>
    							<i class="fa fa-star" aria-hidden="true"></i> 
    						 <?php }
    						 ?>
    					</div>
                    </div>
                    <div class="resort-category-name resort-star"><?php echo !empty($resort_one->category_name)?ucfirst($resort_one->category_name):''; ?></div>
                    <?php }else{ echo '-';}?>
                </div>
            </div>
            
            <div class="col-4">
            <div class="compare-hotel-title px-lg-0">Resort Category</div>    
                <div class="resort-category-container">
                    <?php if(!empty($resort_two->resort_category)) { ?>
                    <div class="">
                    	<div class="star-rating"> 
    						 <?php 
    							$category1 = $this->common_model->get_row('mal_category', array('id'=>$resort_two->resort_category));
    							for($i=0;$i< $category1->no_of_star;$i++){ ?>
    							<i class="fa fa-star" aria-hidden="true"></i> 
    						 <?php }
    						 ?>
    					</div>
                    </div>
                    <div class="resort-category-name resort-star"><?php echo !empty($resort_two->category_name)?ucfirst($resort_two->category_name):''; ?></div>
                    <?php }else{ echo '-';}?>
                </div>
            </div>
            
            <div class="col-4">
                <div class="compare-hotel-title new_moblie_title px-lg-0">Resort Category</div>    
                    <div class="resort-category-container">
                        <?php if(!empty($resort_three->resort_category)) { ?>
                    <div class="">
                    	<div class="star-rating"> 
    						 <?php 
    							$category1 = $this->common_model->get_row('mal_category', array('id'=>$resort_three->resort_category));
    							for($i=0;$i< $category1->no_of_star;$i++){ ?>
    							<i class="fa fa-star" aria-hidden="true"></i> 
    						 <?php }
    						 ?>
    					</div>
                    </div>
                    <div class="resort-category-name resort-star"><?php echo !empty($resort_three->category_name)?ucfirst($resort_three->category_name):''; ?></div>
                    <?php }else{ echo '-';}?>
                </div>
            </div>
            
        </div>
    
        <div id="show-less"><a href="javascript:void(0)">View less</a></div>
     
    </div>
    </div>
    
    
    
    <script>
        $('#show-more-content').hide();

        $('#show-more').click(function(){
        	$('#show-more-content').show(300);
        	$('#show-less').show();
        	$('#show-more').hide();
        });
        
        $('#show-less').click(function(){
        	$('#show-more-content').hide(150);
        	$('#show-more').show();
        	$(this).hide();
        });
    </script>
            				  
	
