<!--== HERO-BANNER START ==-->
<style type="text/css">
   #hotel-stories{ display: none; }
   .experience .hide_btn{ display: none; }
</style>
<div class="hero">
   <div class="hero-image">
      <?php 
      if(!empty($images)){?>
         <div class="custom1 owl-carousel owl-theme">
            <?php          
            foreach($images as $image){
               if(!empty($image->image_name)&&file_exists('uploads/resorts/'.$image->image_name)){?>
                  <div class="item"> 
                     <div class="text-holder"><?php echo !empty($caption->caption_title)?$caption->caption_title:''; ?></div>
                     <img src="<?php echo  base_url('uploads/resorts/'.$image->image_name); ;?>"> 
                  </div>
               <?php 
               }
            }         
            ?>
         </div>
      <?php 
      }else if(!empty($caption_imgs)){
         foreach($caption_imgs as $caption_img){
            if(!empty($caption_img->image_name)&&file_exists('uploads/caption/'.$caption_img->image_name)){?>
               <div class="item"> 
                  <div class="text-holder"><?php echo !empty($caption->caption_title)?$caption->caption_title:''; ?></div>
                  <img src="<?php echo  base_url('uploads/caption/'.$caption_img->image_name); ;?>">
               </div>
            <?php 
            }
         }
      }
      ?>
   </div>
</div>
<div class="container-fluid mt-3">
<div class="stories-block">
<div class="row">
   
   <div class="col-md-9 col-12 order-md-2">
      <div class="traveller_story_right">
         <div class="row">
            <div class="col-md-8 col-12">
               <div class="traveller_story_right_left">
                  <h3>
                     <?php echo !empty($story->resort_name)?ucfirst($story->resort_name):'';?>
                  </h3>
                  <p>
                  <?php 
                     echo !empty($story->story_title)?ucfirst($story->story_title):'';
                  ?></p>
                  <h4>My Experience</h4>
                  <p class="content-pera">
                     <?php 
                     echo !empty($story->my_experience)?ucfirst($story->my_experience):'';
                     ?>                                          
                  </p>
                  <h4>What can be improved</h4>
                  <p class="content-pera">
                     <?php 
                     echo !empty($story->improved)?ucfirst($story->improved):'';
                     ?>
                  </p>
               </div>
            </div>
            <div class="col-md-4 col-12">
               <div class="traveller_story_right_right">
                  <div class="meter">
                     <div class="meter-verified">
                        <h5><i class="fa fa-certificate" aria-hidden="true"></i> <span>Verified By :</span> 
                           <strong>
                           <?php 
                              echo !empty($story->verified_by)?ucfirst($story->verified_by):'';
                           ?>                                                   
                           </strong>
                        </h5>
                     </div>
                  </div>
                  <?php
                  if(!empty($story->staff_friendliness)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Staff Friendliness</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->staff_friendliness&&!empty($story->staff_friendliness))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->services)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Services</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->services&&!empty($story->services))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->villa)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Villa & Suites</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->villa&&!empty($story->villa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->dine_wine)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Dine & Wine</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->dine_wine&&!empty($story->dine_wine))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->spa)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Spa</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->spa&&!empty($story->spa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->facilities)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Facilities</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->facilities&&!empty($story->facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->location)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Location</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->location&&!empty($story->location))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->beach)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Beach</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->beach&&!empty($story->beach))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->snorkeling)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Snorkeling</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                          <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->snorkeling&&!empty($story->snorkeling))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->kids_facilities)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p>Kids Facilities</p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->kids_facilities&&!empty($story->kids_facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }if(!empty($story->over_all)){?>
                  <div class="traveller_star">
                     <div class="traveller_star_name">
                        <p><strong>Over All</strong></p>
                     </div>
                     <div class="traveller_star_rate">
                        <ul class="list-inline">
                           <?php
                           for($nu=1;$nu<=5;$nu++){
                              echo ($nu<=$story->over_all&&!empty($story->over_all))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
                  <?php }?>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="list-social">
            <div class="treveller-stories">
               <ul class="list-inline">
                  <li class="list-inline-item">
                     <a href="javascript:void(0);" onclick="like_unlike('<?php echo $story->id;?>');" id="like_unlike_btn_<?php echo $story->id;?>">
                        <div class="like-up">
                           <?php
                           if(user_logged_in()){ 
                              if(get_all_count('traveller_stories_like', array('story_id'=>$story->id, 'user_id'=>user_id()))){
                                 echo '<img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/>';
                              }else{
                                 echo '<img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/>';
                              }
                           }else{
                              echo '<img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/>';
                           }
                           ?>         
                        </div>
                        <div class="number-like danger">
                           <?php 
                           echo get_all_count('traveller_stories_like', array('story_id'=>$story->id));
                           ?>
                        </div>
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="javascript:void(0);" onclick="open_comment_sec('<?php echo $story->id;?>');">
                        <div><img src="<?php echo  FRONT_THEAM_PATH ;?>img/comment.png" alt="comment"/></div>
                        <div class="number-like comment" id="traveller_stories_comments_<?php echo $story->id; ?>">
                           <?php 
                           echo get_all_count('traveller_stories_comments', array('status'=>'1', 'story_id'=>$story->id));
                           ?>
                        </div>
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="javascript:void(0);" onclick="open_story_imgs('<?php echo $story->id; ?>')"   data-toggle="modal" data-target="#story_images_details" >
                        <div><img src="<?php echo  FRONT_THEAM_PATH ;?>img/image.png" alt="image"/></div>
                        <div class="number-like image">
                           <?php 
                           echo get_all_count('images', array('status'=>'1', 'item_id'=>$story->id, 'type'=>'traveller_story'));
                           ?>
                        </div>
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <div class="share-social">
                        <?php 
                        $share_link = base_url('home/share_story?story_id='.base64_encode($story->id));;
                        $blog_title = !empty($story->story_title)?ucfirst($story->story_title):'';
                        ?>
                        <a href="javascript:void(0);" class="share-button" onclick="show_show_btn('<?php echo $story->id; ?>');">
                           <div>
                              <img src="<?php echo  FRONT_THEAM_PATH ;?>img/share.png" alt="share" />
                           </div>
                        </a>
                        <ul class="list-ul" id="share_btn_menu_<?php echo $story->id; ?>">
                           <li>
                              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" target="_blank">
                                 <i class="fa fa-facebook"></i>
                              </a>
                           </li>
                           <li>
                              <a href="https://twitter.com/share?url=<?php echo $share_link.'&text='.$blog_title ?>" target="_blank">
                                 <i class="fa fa-twitter"></i>
                              </a>
                           </li> 
                           <li> 
                              <a href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link.'&description='.$blog_title ?>" target="_blank">
                                 <i class="fa fa-pinterest-p"></i>
                              </a>
                           </li>
                           <li>
                              <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" target="_blank">
                                 <i class="fa fa-linkedin"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </li>
               </ul>
               </div>
               <div id="like_unlike_message_<?php echo $story->id; ?>" class="text-danger"></div>
            </div>
         </div>  
         <div class="container" id="traveller_stories_comment_list_<?php echo $story->id;?>">
            <div id="traveller_comment_list_<?php echo $story->id;?>">
            <?php 
               $data['comments']       = $this->developer_model->getTravellerStoryComments($story->id, 0, PER_PAGE_COMMENTS);
               $total_comments = $this->developer_model->getTravellerStoryComments($story->id, 0, 0);
               if(!empty($total_comments)&&$total_comments>PER_PAGE_COMMENTS){
                  $more_comment = 'show';
               }else{
                  $more_comment = 'hide';
               }
               $this->load->view('frontend/resort_comment_list', $data); 
            ?>                                    
            </div>
            <input type="hidden" id="traveller_stories_comment_pages_<?php echo !empty($story->id)?$story->id:''; ?>" value="<?php echo PER_PAGE_COMMENTS; ?>">
            <input type="hidden" id="traveller_stories_total_comments_<?php echo !empty($story->id)?$story->id:''; ?>" value="<?php echo !empty($total_comments)?$total_comments:'';?>">
            <a href="javascript:void(0);" onclick="loadTravellerMoreComment('<?php echo !empty($story->id)?$story->id:'';?>');" class="" id="traveller_stories_comment_more_<?php echo !empty($story->id)?$story->id:'';?>" style="<?php if(!empty($more_comment)&&$more_comment=='hide'){ echo 'display: none;'; }?>">
               Load More 
            </a>
            <div class="clearfix"></div>
            <div class="add_comment">
               <form action="" onsubmit="return false;" method="post">
                  <div class="form-group col-md-12 ">
                     <div class="row">
                        <textarea class="form-control" id="traveller_comment_<?php echo !empty($story->id)?$story->id:''; ?>" name="comment" rows="4" placeholder="Add Comment"></textarea>
                        <div id="traveller_comment_error_<?php echo !empty($story->id)?$story->id:''; ?>" class="text-danger"></div>
                     </div>
                  </div>
                  <div class="experience">
                     <button class="btn" type="submit" onclick="save_traveller_comment('<?php echo !empty($story->id)?$story->id:''; ?>');">Send</button>
                  </div>
               </form>
               <div id="traveller_comment_message_<?php echo !empty($story->id)?$story->id:''; ?>"></div>
            </div>                  
         </div>                            
      </div>
   </div>
   <div class="col-md-3 col-12">
   <div class="treveller-stories"> 
      <div class="traveller_story_left">
         <div class="traveller_story_left_profile_img">
            <?php 
            if(!empty($story->profile_pic)&&file_exists('uploads/resorts/'.$story->profile_pic)){?>
            <div class="resort-caption">
               <img src="<?php echo base_url('uploads/resorts/'.$story->profile_pic); ?>">
            </div>
            <?php 
               }else{?>
            <div class="resort-caption">
               <img src="<?php echo base_url();?>assets/front/img/No_Image_Available.jpg" class="no-img"/>
            </div>
            <?php } ?>                                   
         </div>
         <div class="traveller_story_left_profile_content">
            <h4>
               <?php 
                  echo !empty($story->first_name)?ucfirst($story->first_name):'';
                  echo !empty($story->last_name)?' '.ucfirst($story->last_name):'';
               ?>
            </h4>
            <div class="place">
               <div>
                  <p>Maldives</p>
               </div>
               <div><img src="<?php echo  FRONT_THEAM_PATH ;?>img/flag.png" alt="place-flag" /></div>
            </div>
            <p class="plc">
               Reviewed On
               <span>:
                  <?php 
                     echo !empty($story->created_date)?date('d F Y h:i A', strtotime($story->created_date)):''; 
                  ?>
               </span>
            </p>
            <p class="plc">
               Contributions.
               <span>:
                  <?php 
                  echo !empty($contributions)?number_format($contributions,0):'';
                  ?>                                          
               </span>
            </p>
            <p class="plc">                                                
               Holiday Style 
               <span>:
               <?php 
                  echo !empty($story->category_name)?' '.ucfirst($story->category_name):'';
                  ?>                                        
               </span>
            </p>
            <p class="plc">                                                
               Stayed in 
               <span>:
               <?php 
                  echo !empty($story->traveller_date)?date('d F Y', strtotime($story->traveller_date)):''; 
               ?>                                          
               </span>
            </p>
         </div>
      </div>
      </div>
   </div>
</div>
</div>
<div class="clearfix"></div>
</div>