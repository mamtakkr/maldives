<style type="text/css">
   .resort-stories .resort-stories-img{ height: 520px; }
</style>
<?php 
// echo "<pre>";
// print_r($resort_storys);
if(!empty($resort_storys)){
   foreach($resort_storys as $resort_story){
      $data['comments']       = $this->developer_model->getResortStoryComments($resort_story->id, 0, PER_PAGE_COMMENTS);
      $total_comments = $this->developer_model->getResortStoryComments($resort_story->id, 0, 0);
      if(!empty($total_comments)&&$total_comments>PER_PAGE_COMMENTS){
         $more_comment = 'show';
      }else{
         $more_comment = 'hide';
      }
      $imgArr = array('type'=>'resort_story', 'item_id' =>$resort_story->id); 
      $images = $this->common_model->get_result('images', $imgArr, array(), array('id', 'asc'));
      ?>
      <div class="">
         <h3>
            <?php 
               echo !empty($resort_story->resort_name)?ucfirst($resort_story->resort_name):'';
            ?>
         </h3>
         <div class="resort-stories-img">
            <?php
            if(!empty($images)){
               //foreach($images as $image){?>
                  <div>
                     <div class="resort-caption">
                        <div id="carouselExampleIndicators_<?php echo $resort_story->id;?>" class="carousel slide" data-ride="carousel" data-interval="false">
                          <ol class="carousel-indicators">
                              <?php 
                              if(!empty($images)){
                                 $img=0;
                                 foreach($images as $image){?>
                                    <li data-target="#carouselExampleIndicators_<?php echo $resort_story->id;?>" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
                                    <?php 
                                 $img++;
                                 }
                              }
                              ?>
                          </ol>
                           <div class="carousel-inner">
                              <?php 
                              $img = 0;                              
                              if(!empty($images)){
                                 foreach($images as $image){
                                    if(!empty($image->image_name)&&file_exists('uploads/resorts/'.$image->image_name)){
                                       echo ($img==0)?'<div class="carousel-item active">':'<div class="carousel-item">';
                                       echo  '<img style="height:500px;" class="d-block w-100" src="'.base_url().'uploads/resorts/'.$image->image_name.'" alt="resort"/>';
                                       echo '</div>';
                                       $img++;
                                     }
                                 }
                              }
                              ?>
                          </div>
                           <a class="carousel-control-prev" href="#carouselExampleIndicators_<?php echo $resort_story->id;?>" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                           </a>
                           <a class="carousel-control-next" href="#carouselExampleIndicators_<?php echo $resort_story->id;?>" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                           </a>
                        </div>
                     </div>
                  </div>
               <?php 
               //}
            }elseif(!empty($resort_story->image_name)&&file_exists('uploads/resorts/'.$resort_story->image_name)){
               echo '<img src="'.base_url('uploads/resorts/'.$resort_story->image_name).'" alt="resort-image" />';
            }else{
               echo '<img src="'.FRONT_THEAM_PATH.'images/resort-image.png" alt="resort-image" />';
            }  
            ?>                  
         </div>
         <div class="resort-stories-content more_less_desc1">
            <div class="col-md-12 col-sm-12">
               Posted On : 
               <?php 
                  echo !empty($resort_story->created_date)?date('d F Y h:i A', strtotime($resort_story->created_date)):'';
               ?>
            </div>
            <div class="col-md-12 col-sm-12">
               <div class="list-social">
                     <ul class="list-inline">
                        <li class="list-inline-item">
                           <a href="javascript:void(0);" onclick="like_unlike_resort_story('<?php echo $resort_story->id;?>');" id="like_unlike_btn_<?php echo $resort_story->id;?>">
                              <div class="like-up">
                                 <?php
                                 if(user_logged_in()){ 
                                    if(get_all_count('resort_story_likes', array('story_id'=>$resort_story->id, 'user_id'=>user_id()))){
                                       echo '<i class="fa fa-thumbs-up" aria-hidden="true">Like</i>';
                                    }else{
                                       echo '<i class="fa fa-thumbs-down" aria-hidden="true">Like</i>';
                                    }
                                 }else{
                                    echo '<i class="fa fa-thumbs-down" aria-hidden="true">Like</i>';
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
                              <div><i class="fa fa-comments" aria-hidden="true"> Comment</i></div>
                              <div class="number-like comment" id="resort_story_comments_<?php echo $resort_story->id; ?>">
                                 <?php 
                                 echo get_all_count('resort_story_comments', array('resort_story_id'=>$resort_story->id, 'status'=>1));
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
                              <a href="javascript:void(0);" class="share-button" onclick="show_show_btn('rs_<?php echo $resort_story->id; ?>');">
                                 <div>
                                   <i class="fa fa-share-alt" aria-hidden="true"> Share</i>
                                 </div>
                              </a>
                              <ul class="list-ul" id="share_btn_menu_rs_<?php echo $resort_story->id; ?>">
                                 <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" target="_blank" onclick="share_resort_socail_media('<?php echo $resort_story->id; ?>', 'facebook');">
                                       <i class="fa fa-facebook"></i>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://twitter.com/share?url=<?php echo $share_link.'&text='.$blog_title ?>" target="_blank" onclick="share_resort_socail_media('<?php echo $resort_story->id; ?>', 'twitter');">
                                       <i class="fa fa-twitter"></i>
                                    </a>
                                 </li> 
                                 <li> 
                                    <a href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link.'&description='.$blog_title ?>" target="_blank" onclick="share_resort_socail_media('<?php echo $resort_story->id; ?>', 'pinterest');">
                                       <i class="fa fa-pinterest-p"></i>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" target="_blank" onclick="share_socail_media('<?php echo $resort_story->id; ?>', 'linkedin');">
                                       <i class="fa fa-linkedin"></i>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div id="like_unlike_message_<?php echo $resort_story->id; ?>" class="text-danger"></div>
               
            </div>
            <h4>
               <?php 
                  echo !empty($resort_story->title)?ucfirst($resort_story->title):'';
               ?>
            </h4>
            <p class="comment1 more1">
               <?php 
                  echo !empty($resort_story->description)?$resort_story->description:'';
               ?>
            </p>
            <hr />            
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
}else{
   echo '<div class="not-found">
            <img src="'.FRONT_THEAM_PATH.'images/story.png" alt="No Found" />
          <div class="clearfix"></div>
         <h4>No Resort Stories!</h4>
         <span>We couldn’t find any resort matching the criteria. Please remove the filters applied and try again.</span>
          </div>';
}?>
<script type="text/javascript">
   $(document).ready(function() {
      var showChar1 = 330;
      var ellipsestext1 = "...";
      var moretext1 = "more";
      var lesstext1 = "less";
      $('.more1').each(function() {
         var content1 = $(this).html();
         if(content1.length > showChar1) {
           var c = content1.substr(0, showChar1);
           var h = content1.substr(showChar1-1, content1.length - showChar1);
           var html = c + '<span class="moreellipses">' + ellipsestext1+ '&nbsp;</span><span class="morecontent1"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink1">' + moretext1 + '</a></span>';

           $(this).html(html);
         }
      });
      $(".morelink1").click(function(){
         if($(this).hasClass("less1")) {
            $(this).removeClass("less1");
            $(this).html(moretext1);
         } else {
            $(this).addClass("less1");
            $(this).html(lesstext1);
         }
         $(this).parent().prev().toggle();
         $(this).prev().toggle();
         return false;
      });
   });
</script>