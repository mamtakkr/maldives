<div class="inspiration-slider owl-carousel owl-theme">
<?php
    $ex_count = 1; 
    if(!empty($activitys)){
      foreach($activitys as $activity){
        ?>    
          <div class="box">
              <div class="img-content">
              <?php if(!empty($activity->activities_image)&&file_exists('uploads/resorts/full_image/1300_'.$activity->activities_image)){?>
                      <img src="<?php echo base_url();?>uploads/resorts/full_image/1300_<?php echo $activity->activities_image;?>" alt="Resort"  class="img-fluid HomeImage">
              <?php }?> 
                <div class="image-text-container">
                  <div class="d-flex justify-content-between">
                    <div class="img-content-title-container d-flex align-items-center">
                      <div class="img-content-title"><?php echo !empty($activity->resort_name)?$activity->resort_name:''; ?></div>
                    </div>
                    <div class="reviews-rating d-flex">
                      <div>
                      <?php $category_star = $this->common_model->get_row('mal_category', array('id'=>$activity->resort_category));
                        for($i=0;$i< $category_star->no_of_star;$i++){ ?>
                        <i class="fa fa-star" aria-hidden="true"></i> 
                      <?php } ?>
                      </div>
                      <div class="reviews-text ml-1"><?php echo $category_star->category_name;?></div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="no-of-likes like-heart heart-icon" onclick="save_exprince_like_unlike('<?php echo $activity->id;?>');" id="experince_like_unlike_btn_<?php echo $activity->id;?>">
                      <?php 
                        if(user_logged_in()){ 
                            if(get_all_count('exprience_likes', array('exprience_id'=>$activity->id, 'user_id'=>user_id()))){
                              echo '<span class="fa fa-heart" aria-hidden="true"></span>';
                            }else{
                              echo '<span class="fa fa-heart-o" aria-hidden="true"></span>';
                            }
                        }else{
                            echo '<span class="fa fa-heart-o" aria-hidden="true"></span>';
                        }
                        ?> 
                      <strong>
                      <?php 
                        $likes = get_all_count('exprience_likes', array('exprience_id'=>$activity->id));
            
                        echo !empty($likes)?number_format($likes, 0):'';
                        ?>
                      </strong>
                  </div>
                </div>
              </div>
              <div class="img-bottom-contianer inspiration-readmore">
                <div class="img-bottom-contianer-description smalldesc">
                  <div class="img-bottom-contianer-description-title"><?php echo !empty($activity->name_of_activities)?$activity->name_of_activities:''; ?></div>
                  <span class="more"><?php echo !empty($activity->activities_description)?$activity->activities_description:''; ?></span>
                </div>
              </div>
          </div>
  <?php 
      $ex_count++;
      }
      ?>
        </div>
      <?php
    } else {
      echo '<div class="not-found">
            <div class="clearfix"></div>
            <h4 style="color: #B2B2B2;">No Experience Stories!</h4>
            <span>We couldn’t find any experience matching the criteria.</span>
        </div>';
    }?>    