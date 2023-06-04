<div class="resort-title-card">
   <h6>Traveller Stories</h6>
   <div class="clearfix"></div>
   <div class="row">
      <div class="traveller_contribution traveller_story">
         <?php  //, users.profile_pic
         //echo '<pre>';print_r($storys);
         $user    = user_info(); 
         $user_id = user_id();
         if(!empty($storys)){
            foreach($storys as $story){?>
               <div class="col-md-12 " id="story_<?php echo !empty($story->id)?$story->id:'';?>" style="position: relative;">
                  <?php 
                  if(!empty($user->user_type)&&$user->user_type=='1'&&!empty($story->user_id)&&$story->user_id==$user_id){?> 
                     <a class="edit-icon" href="javascript:void(0);" onclick="edit_story('<?php echo !empty($story->id)?base64_encode($story->id):'';?>');">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>
                     <a href="javascript:void(0);" onclick="delete_story('<?php echo !empty($story->id)?$story->id:'';?>');" class="delete-icon">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                     </a>
                  <?php }?>
                  <div class="add-resort-card">
                     <?php 
                     $avg_rates = get_rating($story->resort_id, $story->id);
                     $images  = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$story->id, 'type'=>'traveller_story'));
                     ?>
                    <div class="stories-block">
                       <a href="<?php echo base_url('resort-detail?resort_id='.base64_encode($story->resort_id)); ?>">
                          <h4 class="gap1"><b>
                             <?php 
                                echo !empty($story->resort_name)?ucfirst($story->resort_name):'';
                               ?>
                             </b>
                          </h4>
                       </a> 
                       <div class="row border1">
                          <div class="col-lg-2 col-md-3 col-sm-3 col-5 disk11">
                             <center>
                               <?php 
                               if(!empty($story->profile_pic)&&file_exists('uploads/resorts/'.$story->profile_pic)){?>
                                 <img src="<?php echo base_url('uploads/resorts/'.$story->profile_pic); ?>" class="gallery1">
                               <?php 
                               }else{?>
                                 <img src="<?php echo base_url();?>assets/front/img/No_Image_Available.jpg" class="gallery1"/>
                               <?php 
                               } ?>
                               <p class="para disk2">
                              <i class="fa fa-check fa-2x" aria-hidden="true" style="color:green;"></i> 
                              Stay verifyed:<b>
                                <?php 
                                  echo !empty($story->verified_by)?ucfirst($story->verified_by):'Pending';
                                ?>       
                                </b>
                             </p>
                             <p class="para disk2" style="display:none;">
                              <i class="fa fa-check fa-2x" aria-hidden="true" style="color:#0a67b1;"></i> 
                              Stay verifyed:<b>
                                <?php 
                                   echo !empty($story->verified_by)?ucfirst($story->verified_by):'Pending';
                                   ?>       
                                </b>
                             </p>    
                             </center>
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-4 col-7">
                             <h4 class="para">
                               <b>
                               <?php 
                                echo !empty($story->first_name)?ucfirst($story->first_name):'';
                                echo !empty($story->last_name)?' '.ucfirst($story->last_name):'';
                               ?>
                               </b>
                             </h4>
                             <p class="para"><img src="<?php echo  FRONT_THEAM_PATH ;?>img/flag.png" alt="place-flag"/ style="width: 18px;height: 18px;"> Maldives</p>
                             <?php
                            if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3')&&!empty($story->verified_by)&&$story->verified_status==1)||($user->user_type=='1')){?>
                             <p class="para"><i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> Contributions 
                               <?php 
                               $contributions = get_all_count('traveller_stories', array('user_id'=>$story->user_id));
                               echo !empty($contributions)?number_format($contributions,0):'';
                               ?>  </p>
                               <?php }?>
                          </div>
                          <div class="col-lg-3 col-md-1 col-sm-1 col-5 disk11"></div>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-7">

                            <?php
                              if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3')&&!empty($story->verified_by)&&$story->verified_status==1)||($user->user_type=='1')){?>
                             
                             <?php }?>
                             <p class="para mt1"><i class="fa fa-calendar-o fa-2x" aria-hidden="true"></i> <?php 
                                echo !empty($story->traveller_date)?date('d F Y', strtotime($story->traveller_date)):''; 
                                ?>   </p>

                              <?php  
                              if(!empty($story->verified_by)&&$story->verified_status==1){?>
                             <p class="para disk3" id="story_btn_<?php echo !empty($story->id)?$story->id:'';?>">
                              <i class="fa fa-check fa-2x" aria-hidden="true" style="color:<?php echo (!empty($story->verified_by)&&strtolower($story->verified_by)=='resort')?'green':'blue'; ?>;"></i> Stay Verified
                             </p>
                             <?php }else if(!empty($story->verified_status)&&$story->verified_status==3){?>
                             <p class="para disk3" style="color: red;" id="story_btn_<?php echo !empty($story->id)?$story->id:'';?>">Rejected</p>
                             <?php }else{?>
                              <p class="para" id="story_btn_<?php echo !empty($story->id)?$story->id:'';?>">
                                Verify <b>Pending</b>
                                <?php                                  
                                 if(!empty($user->user_type)&&($user->user_type=='2'||$user->user_type=='3')){?>
                                  <span>
                                    <a href="javascript:void(0);" onclick="verify_now('<?php echo !empty($story->id)?$story->id:'';?>');" style="text-decoration: none; font-weight: bold">Verify Now</a>
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0);" onclick="reject_now('<?php echo !empty($story->id)?$story->id:'';?>');" style="text-decoration: none; font-weight: bold; color: red;">Reject</a>
                                 </span>
                                 <?php }?>
                              </p>
                             <?php }?>

                          </div>
                       </div>
                       <div class="row pd_top">
                          <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                            <?php 
                            if(!empty($avg_rates)){?>
                              <h4 class="para1"><b><?php echo !empty($avg_rates['rate_text'])?$avg_rates['rate_text']:''; ?> <?php echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; ?></b></h4>
                            <?php
                            }
                            if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3')&&!empty($story->verified_by)&&$story->verified_status==1)||($user->user_type=='1')){?>
                             <a href="<?php echo base_url('resort-detail?resort_id='.base64_encode($story->resort_id)); ?>">
                                <h4 class="gap1">
                                   <?php 
                                      echo !empty($story->story_title)?ucfirst($story->story_title):'';
                                      ?>
                                </h4>
                             </a>
                             <p class="content-pera comment1 more1" style="    text-align: justify;font-size:14px;">
                               <?php 
                                 echo !empty($story->my_experience)?ucfirst($story->my_experience):'';
                               ?>                                          
                             </p>                                                         
                             <?php }?>
                             <p class="gap" style="margin-top: 14px"><b>Exceptional Staff members</b></p> 
                             <p class="content-pera gap">
                                <?php 
                                  echo !empty($story->staff_name)?ucwords($story->staff_name):'-';
                                ?>
                             </p>
                             <div class="row mt-3">
                                <?php
                                if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3'))||($user->user_type=='1')){?>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-6">
                                   <div>
                                      <p class="gap"><b>Stay date</b></p>
                                   </div>
                                   <div>
                                      <p class="gap"><b>Holiday Type</b></p>
                                   </div>
                                   <div>
                                      <p class="gap"><b>Villa & Suite</b></p>
                                   </div>
                                   <div>
                                      <p class="gap"><b>Length of Stay</b></p>
                                   </div>
                                   <div>
                                      <p class="gap"><b>Visit to Maldives</b></p>
                                   </div>
                                   <div>
                                      <p class="gap"><b>Visit to this property</b></p>
                                   </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-6">
                                   <div>
                                     <p class="gap">
                                       <?php 
                                         echo !empty($story->traveller_date)?date('d F Y', strtotime($story->traveller_date)):''; 
                                       ?>   
                                     </p>
                                   </div>
                                   <div>
                                      <p class="gap">
                                       <?php 
                                         echo !empty($story->category_name)?' '.ucfirst($story->category_name):'-';
                                       ?> 
                                       </p>
                                   </div> 
                                   <div>
                                      <p class="gap text-gap">
                                       <?php 
                                         echo !empty($story->name_of_villa)?ucfirst($story->name_of_villa):'-';
                                       ?> </p>
                                   </div>
                                   <div>
                                      <p class="gap">
                                       <?php 
                                         echo !empty($story->nights_stayed)?ucfirst($story->nights_stayed):'-';
                                       ?> nights</p>
                                   </div>
                                   <div> 
                                      <p class="content-pera gap">
                                         <?php 
                                            echo !empty($story->maldives_visits)?ucfirst($story->maldives_visits):'-';
                                            ?>
                                      </p>
                                   </div>
                                   <div>
                                      <p class="gap"><?php 
                                         echo !empty($story->hotel_visits)?ucfirst($story->hotel_visits):'-';
                                         ?></p>
                                   </div>
                                </div>
                                <?php }?>
                             </div>
                             
                         </div>
                          <div class="col-lg-1 col-md-12 col-sm-12 col-12"></div>
                          <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                            <?php
                            if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3')&&!empty($story->verified_by)&&$story->verified_status==1)||($user->user_type=='1')){?>
                             <div class="row traveller_story_right_right">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
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
                                   <?php }?>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                   <?php if(!empty($story->services)){?>
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
                                   <?php }if(!empty($story->over_all)){?>
                                   <div class="traveller_star">
                                      <div class="traveller_star_name">
                                         <p>Snorkeling</p>
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
                             <div class="row mt-3 border2">
                                <?php 
                                $counterI = 0;
                                if(!empty($images)){
                                $counts   = count($images);
                                  foreach($images as $image){
                                    $counterI++;
                                    if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                      <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" onclick="open_traveller_stories_images('<?php echo $counterI; ?>', '<?php echo $counts; ?>','<?php echo $image->image_name; ?>','<?php echo $story->id;?>');" id="traveller_stories_<?php echo $story->id;?>_<?php echo $counterI;?>" data-image="<?php echo $image->image_name; ?>">
                                        <img src="<?php echo base_url().'uploads/resorts/thumbnails/150_'.$image->image_name; ?>" class="gallery">
                                      </a>
                                    </div> 
                                    <?php 
                                    }
                                  }
                                }
                                ?>   
                             </div>
                            <?php }?>
                          </div>
                       </div>
                       <?php
                        if(!empty($user->user_type)&&(($user->user_type=='2'||$user->user_type=='3')&&!empty($story->verified_by)&&$story->verified_status==1)||($user->user_type=='1')){?>
                         <div class="row">
                            <div class="col-md-12">
                               <div class="list-social">
                                  <ul class="list-inline">
                                     <li class="list-inline-item">
                                        <a href="javascript:void(0);" onclick="like_unlike('<?php echo $story->id;?>');" id="like_unlike_btn_<?php echo $story->id;?>">
                                           <div class="like-up ">
                                              <?php 
                                               echo '<img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/>&nbsp;';  
                                               ?>
                                           </div>
                                           <div class="number-like danger">
                                              <?php 
                                                 $likes = get_all_count('traveller_stories_like', array('story_id'=>$story->id));
                                                  echo !empty($likes)?$likes:'';
                                               ?>
                                           </div>
                                        </a>
                                     </li>
                                     <li class="list-inline-item">
                                      <a href="javascript:void(0);">
                                        <div> 
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>img/comment.png" alt="comment"/>
                                        </div>
                                         <div class="number-like comment" id="traveller_stories_comments_<?php echo $story->id; ?>">
                                            <?php 
                                             $comments = get_all_count('traveller_stories_comments', array('story_id'=>$story->id));
                                             echo !empty($comments)?$comments:'';
                                             ?>
                                         </div>
                                        </a>
                                     </li>
                                  </ul>
                               </div>
                               <div id="like_unlike_message_<?php echo $story->id; ?>" class="text-danger"></div>
                               <div class="container" id="traveller_stories_comment_list_<?php echo $story->id;?>">
                                  <div id="traveller_comment_list_<?php echo $story->id;?>">
                                     <?php 
                                        $data['comments'] = $this->developer_model->getTravellerStoryComments($story->id, 0, PER_PAGE_COMMENTS);
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
                               </div>
                            </div>
                         </div>     
                        <?php }?>                         
                    </div>                                      
                  </div>
               </div>
         <?php                     
            }
         }
         ?>
      </div>
   </div>
</div>
<div class="modal fade" id="story_images_details" tabindex="-1" role="dialog" aria-labelledby="story_images_details" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Story Images</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="story_images_data"></div>
      </div>
   </div>
</div>