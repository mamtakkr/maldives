<!--== HERO-BANNER START ==-->
<style type="text/css">
   #hotel-stories{ display: none; }
   .experience .hide_btn{ display: none; }
</style>
<div class="hero">
   <div class="hero-image">
      <div class="custom1 owl-carousel owl-theme">
         <?php 
            if(!empty($resort_story->image_name)&&file_exists('uploads/resorts/'.$resort_story->image_name)){
               echo '<img src="'.base_url('uploads/resorts/'.$resort_story->image_name).'" alt="resort-image" />';
            }else{
               echo '<img src="'.FRONT_THEAM_PATH.'img/resort-image.png" alt="resort-image" />';
            }  
            ?> 
      </div>
   </div>
</div>
<?php 
if(!empty($resort_story)){
	$data['comments']       = $this->developer_model->getResortStoryComments($resort_story->id, 0, PER_PAGE_COMMENTS);
	$total_comments = $this->developer_model->getResortStoryComments($resort_story->id, 0, 0);
	if(!empty($total_comments)&&$total_comments>PER_PAGE_COMMENTS){
	 $more_comment = 'show';
	}else{
	 $more_comment = 'hide';
	}
    ?>
    <div style="padding: 59px 30px;">
        <h3>
            <?php 
               echo !empty($resort_story->resort_name)?ucfirst($resort_story->resort_name):'';
            ?>
        </h3>
        <div class="resort-stories-content">
            Posted On : 
            <?php 
               echo !empty($resort_story->created_date)?date('d F Y h:i A', strtotime($resort_story->created_date)):'';
            ?>
            <h4>
               <?php 
                  echo !empty($resort_story->title)?ucfirst($resort_story->title):'';
               ?>
            </h4>
            <p>
               <?php 
                  echo !empty($resort_story->description)?$resort_story->description:'';
               ?>
            </p>
            <hr />  
            <div class="container">
               <div class="list-social">
                  <ul class="list-inline">
                     <li class="list-inline-item">
                        <a href="javascript:void(0);" onclick="like_unlike_resort_story('<?php echo $resort_story->id;?>');" id="like_unlike_btn_<?php echo $resort_story->id;?>">
                           <div class="like-up">
                              <?php
                              if(user_logged_in()){ 
                                 if(get_all_count('resort_story_likes', array('story_id'=>$resort_story->id, 'user_id'=>user_id()))){
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
                              echo get_all_count('traveller_stories_like', array('story_id'=>$resort_story->id));
                              ?>
                           </div>
                        </a>
                     </li>
                     <li class="list-inline-item">
                        <a href="javascript:void(0);" onclick="open_comment_sec('<?php echo $resort_story->id;?>');">
                           <div><img src="<?php echo  FRONT_THEAM_PATH ;?>img/comment.png" alt="comment"/></div>
                           <div class="number-like comment" id="resort_story_comments_<?php echo $resort_story->id; ?>">
                              <?php 
                              echo get_all_count('resort_story_comments', array('resort_story_id'=>$resort_story->id));
                              ?>
                           </div>
                        </a>
                     </li>
                     <li class="list-inline-item">
                        <div class="share-social">
                           <?php 
                           $share_link = base_url('home/share_resort_story?story_id='.base64_encode($resort_story->id));;
                           $blog_title = !empty($resort_story->title)?ucfirst($resort_story->title):'';
                           ?>
                           <a href="javascript:void(0);" class="share-button" onclick="show_show_btn('<?php echo $resort_story->id; ?>');">
                              <div>
                                 <img src="<?php echo  FRONT_THEAM_PATH ;?>img/share.png" alt="share" />
                              </div>
                           </a>
                           <ul class="list-ul" id="share_btn_menu_<?php echo $resort_story->id; ?>">
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
                  <div id="like_unlike_message_<?php echo $resort_story->id; ?>" class="text-danger"></div>
               </div>
            </div>           
            <div id="resort_comment_list_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>">
               <?php 
                  $this->load->view('frontend/resort_comment_list', $data); 
               ?>
            </div>
            <input type="hidden" id="resort_comment_pages_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>" value="<?php echo PER_PAGE_COMMENTS; ?>">
            <input type="hidden" id="resort_total_comments_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>" value="<?php echo !empty($total_comments)?$total_comments:'';?>">
            <a href="javascript:void(0);" onclick="loadResortMoreComment('<?php echo !empty($resort_story->id)?$resort_story->id:'';?>');" class="" id="resort_comment_more_<?php echo !empty($resort_story->id)?$resort_story->id:'';?>" style="<?php if(!empty($more_comment)&&$more_comment=='hide'){ echo 'display: none;'; }?>">
               Load More 
            </a>
    
            <div class="clearfix"></div>
            <div class="add_comment">
               <form action="" onsubmit="return false;" id="add_comment" method="post">
                  <div class="form-group col-md-12 ">
                     <div class="row">
                        <textarea class="form-control" id="comment_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>" name="comment" rows="2" placeholder="Add Comment"></textarea>
                        <div id="comment_error_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>" class="text-danger"></div>
                     </div>
                  </div>
                  <div class="experience">
                     <button class="btn" type="submit" onclick="save_comment('<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>');">
                        Send
                     </button>
                  </div>
               </form>
               <div id="comment_message_<?php echo !empty($resort_story->id)?$resort_story->id:''; ?>"></div>
            </div>
         </div>
    </div>
<?php 
}
?>
<script type="text/javascript">
   function like_unlike_resort_story(story_id){
      $.ajax({ 
         url:'<?php echo base_url(); ?>home/save_resort_story_like_unlike',
         type:'GET',
         data:{'story_id':story_id}, 
         success:function(html){
            var response = $.parseJSON(html);  
            if(response.status=='true'){
               $('#like_unlike_btn_'+story_id).html(response.html);
            }else{
                $('#like_unlike_message_'+story_id).html(response.message);
            }
         }
      });
   }
   function save_comment(resort_story_id=''){
      var comment = $('#comment_'+resort_story_id).val();
      var error   = 'no';
      if(comment==''){
         $('#comment_error_'+resort_story_id).show().html('The comment is required');
         var error   = 'yes';
      }
      if(error=='no'){         
         $.ajax({
            url:'<?php echo base_url('home/save_comment_resort'); ?>',
            type:'post',
            data:{'resort_story_id':resort_story_id, 'comment':comment}, 
            success:function(html){
               var response = $.parseJSON(html);  
               if(response.status=='true'){
                  if(response.more_comment=='show'){
                     $('#resort_comment_more_'+resort_story_id).show();
                  }else{
                     $('#resort_comment_more_'+resort_story_id).hide();
                  } 
                  $('#resort_total_comments_'+resort_story_id).val(response.total_comments);
                  $('#resort_story_comments_'+resort_story_id).html(response.total_comments);
                  $('#comment_'+resort_story_id).val('');
                  $('#comment_error_'+resort_story_id).hide();                  
                  $('#resort_comment_list_'+resort_story_id).html(response.html);
               }else{
                  $('#comment_error_'+resort_story_id).html(response.message);
               }
            }
         });
      }
   }
   function loadResortMoreComment(resort_story_id){
      var current_page = $('#resort_comment_pages_'+resort_story_id).val();
      var total_comments = $('#resort_total_comments_'+resort_story_id).val();
      $.ajax({
         url:'<?php echo base_url('home/loadResortMoreComment'); ?>',
         type:'get',
         data:{'resort_story_id':resort_story_id, 'current_page':current_page, 'total_comments':total_comments}, 
         success:function(html){
            var response = $.parseJSON(html);
            $('#resort_comment_list_'+resort_story_id).append(response.html);
            $('#resort_comment_pages_'+resort_story_id).val(response.current_page);
            if(response.more_comment=='show'){
               $('#resort_comment_more_'+resort_story_id).show();
            }else{
               $('#resort_comment_more_'+resort_story_id).hide();
            }
         }
      });
   }
</script>
