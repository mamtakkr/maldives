<style type="text/css">
  .feedback {
    float: left;
    width: 100%;
    position: relative;
}
.feedback .media {
    padding-bottom: 15px;
    padding-top: 15px;
}
.comment-pic {
    float: left;
    width: 100px;
}
.mr-3, .mx-3 {
    margin-right: 1rem!important;
}
.comment-text {
    float: left;
    width: calc(100% - 100px);
    padding-left: 15px;
}
.feedback h5 {
    color: #34c1b9 !important;
    font-family: 'brandon_textbold';
    margin: 0 !important;
    font-size: 18px !important;
}
.comment-date {
    float: left;
    width: 100%;
    font-size: 12px !important;
    color: #777 !important;
    margin-bottom: 4px;
    margin-top: 2px;
}
.dd {
    font-size: 16px;
}
.story_comment_status{ position: absolute; top: 0px; right: 20px; }
</style>
<?php
//echo '<pre>'; print_r($comments); //exit();
if(!empty($comments)){
	foreach($comments as $comment){?>
	    <div class="feedback">
           <div class="media">
           <div class="comment-pic">
           		<?php 
           		if(!empty($comment->profile_pic)&&file_exists('uploads/resorts/thumbnails/'.$comment->profile_pic)){
           			echo '<img src="'.base_url().'uploads/resorts/thumbnails/'.$comment->profile_pic.'" class="mr-3" style="width:100px;">';
           		}else{
           			echo '<img src="'.FRONT_THEAM_PATH.'img/No_Image_Available.jpg" class="mr-3" style="width:100px;">';
           		}
           		?>
            </div>
                <div class="comment-text">
           <div class="media-body">
              	<h5 class="mt-0">
              	<?php
              		echo !empty($comment->first_name)?ucfirst($comment->first_name):'';
              		echo !empty($comment->last_name)?' '.ucfirst($comment->last_name):'';
              	?>	              		
              	</h5>
              <p class="comment-date">
              	<?php
              		echo !empty($comment->created_date)?date('d F Y h:i A', strtotime($comment->created_date)):''; 
              	?>
              </p>
              <p class="dd">
                <?php
              		echo !empty($comment->comment_name)?ucfirst($comment->comment_name):'';
              	?>
              </p>
           </div>
           </div>
        </div>
        <?php 
        if(!empty($type)&&$type=='1'){?>
          <a href="javascript:void(0);" onclick="resort_story_comment_status('<?php echo !empty($comment->id)?$comment->id:''; ?>');" class="story_comment_status" id="story_comment_status_<?php echo !empty($comment->id)?$comment->id:''; ?>" data="<?php echo (!empty($comment->status)&&$comment->status==1)?"2":"1";?>"><?php echo (!empty($comment->status)&&$comment->status==1)?"block":"active";?></a>
        <?php 
        }else{?>
          <a href="javascript:void(0);" onclick="story_comment_status('<?php echo !empty($comment->id)?$comment->id:''; ?>');" class="story_comment_status" id="story_comment_status_<?php echo !empty($comment->id)?$comment->id:''; ?>" data="<?php echo (!empty($comment->status)&&$comment->status==1)?"2":"1";?>"><?php echo (!empty($comment->status)&&$comment->status==1)?"block":"active";?></a>
        <?php }?>
      </div>
	<?php 
	}
}?>