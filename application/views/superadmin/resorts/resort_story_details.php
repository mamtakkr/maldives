<div class="row">
   <div class="col-md-12 col-12">
      <div class="traveller_story_right">
         <div class="row">
            <div class="col-md-12 col-12">
               <div class="traveller_story_right_left">
                  <h3>
                     <?php echo !empty($story->resort_name)?ucfirst($story->resort_name):'';?>
                  </h3>
                  <h4>
                     <?php 
                        echo !empty($story->title)?ucfirst($story->title):'';
                     ?>                     
                  </h4>
                  <h4>Description</h4>
                  <p class="content-pera">
                     <?php 
                        echo !empty($story->description)?ucfirst($story->description):'';
                     ?>                                          
                  </p>
               </div>
            </div>
         </div>
         <div >
            <div class="list-social">
               <ul class="list-inline">
                  <li class="list-inline-item">
                     <a href="javascript:void(0);">
                        <div class="like-up">
                           <?php
                            echo '<img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/>';
                           ?>         
                        </div>
                        <div class="number-like danger">
                           <?php 
                           echo get_all_count('resort_story_likes', array('story_id'=>$story->id));
                           ?>
                        </div>
                     </a>
                  </li>
                  <li class="list-inline-item">
                     <a href="javascript:void(0);">
                        <div><img src="<?php echo  FRONT_THEAM_PATH ;?>img/comment.png" alt="comment"/></div>
                        <div class="number-like comment" id="traveller_stories_comments_<?php echo $story->id; ?>">
                           <?php 
                           echo get_all_count('resort_story_comments', array('resort_story_id'=>$story->id));
                           ?>
                        </div>
                     </a>
                  </li>
               </ul>
               <div id="like_unlike_message_<?php echo $story->id; ?>" class="text-danger"></div>
            </div>
         </div>  
         <div id="traveller_stories_comment_list_<?php echo $story->id;?>">
            <div id="traveller_comment_list_<?php echo $story->id;?>">
            <?php 
               $data['comments']      = $this->developer_model->getResortStoryComments($story->id, 0, PER_PAGE_COMMENTS, 1);
               $total_comments = $this->developer_model->getResortStoryComments($story->id, 0, 0, 1);
               if(!empty($total_comments)&&$total_comments>PER_PAGE_COMMENTS){
                  $more_comment = 'show';
               }else{
                  $more_comment = 'hide';
               }
               $data['type'] = '1';
               $this->load->view('superadmin/resorts/resort_comment_list', $data); 
            ?>                                    
            </div>
            <input type="hidden" id="traveller_stories_comment_pages_<?php echo !empty($story->id)?$story->id:''; ?>" value="<?php echo PER_PAGE_COMMENTS; ?>">
            <input type="hidden" id="traveller_stories_total_comments_<?php echo !empty($story->id)?$story->id:''; ?>" value="<?php echo !empty($total_comments)?$total_comments:'';?>">
            <a href="javascript:void(0);" onclick="loadResortStoryMoreComment('<?php echo !empty($story->id)?$story->id:'';?>');" class="" id="traveller_stories_comment_more_<?php echo !empty($story->id)?$story->id:'';?>" style="<?php if(!empty($more_comment)&&$more_comment=='hide'){ echo 'display: none;'; }?>">
               Load More 
            </a>
            <div class="clearfix"></div>                  
         </div>                                   
      </div>
   </div>
   <div class="col-md-12">
      <h4>Images </h4>
      <div class="row">
         <?php 
         if(!empty($images)){
            foreach($images as $image){?>
               <div class="col-md-3">
                  <img src="<?php echo base_url('uploads/resorts/'.$image->image_name); ?>" class="img img-responsive">
               </div>
            <?php
            }
         }else if(!empty($story->image_name)&&file_exists('uploads/resorts/'.$story->image_name)){
            echo '<div class="col-md-3"><img src="'.base_url('uploads/resorts/'.$story->image_name).'" alt="resort-image" class="img img-responsive"/></div>';
         }else{
            echo '<div class="col-md-3"><img src="'.FRONT_THEAM_PATH.'img/resort-image.png" alt="resort-image" class="img img-responsive"/></div>';
         } 
         ?>
      </div>  
   </div> 
</div>