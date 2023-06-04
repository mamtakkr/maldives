<style type="text/css">
   .list-inline-item img{ width: 40px; }
   .like-up{float: left;}
   .number-like {float: left;font-size: 22px;padding-top: 7px;padding-left: 10px;}
</style>
<div class="row">
   <div class="col-md-12 col-12">
      <div class="traveller_story_right">
         <div class="row">
            <div class="col-md-3 col-12">
               <div class="traveller_story_left">
                  <div class="traveller_story_left_profile_img">
                     <?php
                     if(!empty($blog->profile_pic)&&file_exists('uploads/resorts/'.$blog->profile_pic)){?>
                        <div class="resort-caption">
                           <img src="<?php echo base_url('uploads/resorts/'.$blog->profile_pic); ?>" class="img-responsive img">
                        </div>
                     <?php 
                     }else{?>
                        <div class="resort-caption">
                           <img src="<?php echo base_url();?>assets/front/images/No_Image_Available.jpg" class="img-responsive img"/>
                        </div>
                  <?php } ?>                                   
                  </div>
                  <div class="traveller_story_left_profile_content">
                     <h4 class="text-center">
                        <?php 
                           echo !empty($blog->first_name)?ucfirst($blog->first_name):'';
                           echo !empty($blog->last_name)?' '.ucfirst($blog->last_name):'';
                        ?>
                     </h4>
                     <p class="plc">
                        Posted On
                        <span>:
                           <?php 
                              echo !empty($blog->created_date)?date('d M Y h:i A', strtotime($blog->created_date)):''; 
                           ?>
                        </span>
                     </p>
                     <p class="plc">
                        Contributions.
                        <span>:
                          <?php echo get_all_count('news_blog', array('news_added_user'=>$blog->news_added_user)); ?>                                        
                        </span>
                     </p>
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
                                    $likes = get_all_count('blog_likes', array('new_blog_id'=>$blog->id));
                                    echo !empty($likes)?$likes:'';
                                    ?>
                                 </div>
                              </a>
                           </li>
                           <li class="list-inline-item">
                              <a href="javascript:void(0);">
                                 <div class="like-up">
                                    <img src="<?php echo  FRONT_THEAM_PATH ;?>img/comment.png" alt="comment"/>
                                 </div>
                                 <div class="number-like comment" id="traveller_stories_comments_<?php echo $blog->id; ?>">
                                    <?php 
                                    $comments = get_all_count('blog_comments', array('new_blog_id'=>$blog->id));
                                    echo !empty($comments)?$comments:'';
                                    ?>
                                 </div>
                              </a>
                           </li>
                        </ul>
                        <div id="like_unlike_message_<?php echo $blog->id; ?>" class="text-danger"></div>
                     </div>
                  </div> 
               </div>
            </div>
            <div class="col-md-9 col-12">
               <div class="traveller_story_right_left">                  
                  <h4>
                     <?php 
                        echo !empty($blog->news_title)?ucfirst($blog->news_title):'';
                     ?>                     
                  </h4>
                  <h4>Description</h4>
                  <p class="content-pera">
                     <?php 
                        echo !empty($blog->news_description)?ucfirst($blog->news_description):'';
                     ?>                                          
                  </p>
                  <h4>Tags</h4>
                  <p class="content-pera">
                     <?php 
                        echo !empty($blog->tags)?ucfirst($blog->tags):'';
                     ?>                                          
                  </p>
               </div>
            </div>
         </div>          
         <div id="traveller_stories_comment_list_<?php echo $blog->id;?>">
            <div id="traveller_comment_list_<?php echo $blog->id;?>">
            <?php 
               $total_comments = $this->developer_model->getBlogComments($blog->id, 0, 0, 1);
               $data['comments']      = $this->developer_model->getBlogComments($blog->id, 0, PER_PAGE_COMMENTS, 1);
               //echo $this->db->last_query();
               if(!empty($total_comments)&&$total_comments>PER_PAGE_COMMENTS){
                  $more_comment = 'show';
               }else{
                  $more_comment = 'hide';
               }
               $data['type'] = '1';
               $this->load->view('superadmin/blogs/blog_comment_list', $data); 
            ?>                                    
            </div>
            <input type="hidden" id="traveller_stories_comment_pages_<?php echo !empty($blog->id)?$blog->id:''; ?>" value="<?php echo PER_PAGE_COMMENTS; ?>">
            <input type="hidden" id="traveller_stories_total_comments_<?php echo !empty($blog->id)?$blog->id:''; ?>" value="<?php echo !empty($total_comments)?$total_comments:'';?>">
            <a href="javascript:void(0);" onclick="loadBlogMoreComment('<?php echo !empty($blog->id)?$blog->id:'';?>');" class="" id="traveller_stories_comment_more_<?php echo !empty($blog->id)?$blog->id:'';?>" style="<?php if(!empty($more_comment)&&$more_comment=='hide'){ echo 'display: none;'; }?>">
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
                  <img src="<?php echo base_url('uploads/blogs/'.$image->image_name); ?>" class="img img-responsive">
               </div>
            <?php
            }
         }
         ?>
      </div>  
   </div>
</div>