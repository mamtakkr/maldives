<?php
//echo '<pre>'; print_r($comments); //exit();
if(!empty($comments)){
	foreach($comments as $comment){?>
	    <div class="feedback">
           <div class="media">
           <div class="comment-pic">
           		<?php 
           		if(!empty($comment->profile_pic)&&file_exists('uploads/resorts/thumbnails/'.$comment->profile_pic)){
           			echo '<img src="'.base_url().'uploads/resorts/thumbnails/'.$comment->profile_pic.'" class="mr-3 gallery1" style="width:100px;">';
           		}else{
           			echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" class="mr-3 gallery1" style="width:100px;">';
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
      </div>
	<?php 
	}
}?>