<?php
//echo '<pre>'; print_r($comments); //exit();
if(!empty($comments)&&is_array($comments)){
	foreach($comments as $comment){?>		
	    <div class="clearfix"></div>
	    <div class="comment-section">
	        <div class="media">
	           <div class="commented-user">
	           		<?php 
	           		if(!empty($comment->profile_pic)&&file_exists('uploads/resorts/thumbnails/'.$comment->profile_pic)){
	           			echo '<img src="'.base_url().'uploads/resorts/thumbnails/'.$comment->profile_pic.'" class="mr-3">';
	           		}else{
	           			echo '<img src="'.FRONT_THEAM_PATH.'img/No_Image_Available.jpg" class="mr-3" style="width:100px;">';
	           		}
	           		?>
	           </div>
	           <div class="media-body">
	              	<h5 class="mt-0">
	              	<?php
	              		echo !empty($comment->first_name)?ucfirst($comment->first_name):'';
	              		echo !empty($comment->last_name)?' '.ucfirst($comment->last_name):'';
	              	?>	              		
	              	</h5>
	              <div class="blog-date">
	              	<i class="fa fa-calendar" aria-hidden="true"></i> 
	              	<?php
	              		echo !empty($comment->created_date)?date('d F Y h:i A', strtotime($comment->created_date)):''; 
	              	?>
	              </div>
	              <p class="dd">
	                <?php
	              		echo !empty($comment->comment_name)?ucfirst($comment->comment_name):'';
	              	?>
	              </p>
	           </div>
	        </div>
	    </div>
	<?php 
	}
}?>