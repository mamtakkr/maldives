<style>
.times {
    float: left;
    font-size: 12px;
    position: relative;
    left: 37%;
    bottom: 9px;
}
.resort-info img {
    width: 150px;
    float: left;
    border-radius: 10px;
}
.user-info img {
    width: 30px;
    height: 30px;
    border-radius: 100%;
}
.activity-list li .fa {
    position: absolute;
    top: 0px;
    left: 0px;
    font-size: 17px;
    color: #35C2BD;
}
.resort-info .activity_name {
    float: right;
    width: calc(100% - 14px);
}
.user-info {
    float: left;
    margin-left: 9px;
}
.user-info {
    float: left;
    margin-left: -50px;
}
.user-name {
    padding-left: 3px;
}
@media (max-width:1440px) {
.times {
    float: left;
    font-size: 12px;
    position: relative;
    left: 66%;
    bottom: -18px;
}
.user-info {
    float: left;
    margin-left: 8px;
}
}
@media (max-width: 1024px){
.times {
    float: left;
    font-size: 12px;
    position: relative;
    left: 46%;
    bottom: -16px;
}

}
@media (max-width:990px) {
.times {
    float: left;
    font-size: 12px;
    position: relative;
        left: 46%;
    bottom: -17px;
}}

@media (max-width:767px) {
.times {
        float: left;
    font-size: 12px;
    position: relative;
     left: 58%;
    bottom: -29px;
}
.user-info {
    float: left;
    margin-left: -60px;
    margin-bottom: 11px;
    font-size: 22px;
}
    }
    
</style>


<?php 
if (!empty($activities['res'])) {
    foreach ($activities['res'] as $activity) {
        switch ($activity->type) {
            case 'resorts_like':
                $like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
             	$like_text     = 'liked';
              	$activity_link = base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id);
                break;
            case 'accommodation_like':
                $like_text     = 'liked';
              	$like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=accommodations_likes&resort_id='.base64_encode($activity->resort_id);
                break;
            case 'dining_like':
                $like_text     = 'liked';
              	$like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=dinnings&resort_id='.base64_encode($activity->resort_id);
                break;
            case 'traveller_story_like':
                $like_text     = 'liked';
              	$like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id);
                break; 
            case 'traveller_story_share':
                $like_text     = 'shared';
               	$like_icon     = '<i class="fa fa-share" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id);
                break;
            case 'traveller_story':
                $like_text     = 'posted';
              	$like_icon     = '<i class="fa fa-stop-circle" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id);
                break;  
            case 'traveller_stories_comment':
                $like_text     = 'commented';
              	$like_icon     = '<i class="fa fa-comment" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id);
                break;
            case 'resort_story_like':
                $like_text     = 'liked';
                $like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id);
                break;
            case 'resort_story_share':
                $like_text     = 'shared';
              	$like_icon     = '<i class="fa fa-share" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id);
                break;
            case 'resort_story':
                $like_text     = 'posted';
                $like_icon     = '<i class="fa fa-stop-circle" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id);
                break; 
            case 'resort_stories_comment':
                $like_text     = 'commented';
               	$like_icon     = '<i class="fa fa-comment" aria-hidden="true"></i>';
                $activity_link = base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id);
                break;    
            case 'blog_like':
                $like_text     = 'liked';
               	$like_icon     = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                $activity_link = base_url().'blog-detail?type=blog_like&blog_id='.base64_encode($activity->resort_id);
                break; 
            case 'blog_share':
                $like_text     = 'shared';
                $like_icon     = '<i class="fa fa-share" aria-hidden="true"></i>';
                $activity_link = base_url().'blog-detail?type=blog_like&blog_id='.base64_encode($activity->resort_id);
                break;
            case 'blog_comment':
                $like_text     = 'commented';
            	$like_icon     = '<i class="fa fa-comment" aria-hidden="true"></i>';
                $activity_link = base_url().'blog-detail?type=blog_comment&blog_id='.base64_encode($activity->resort_id);
                break;                               
            default:
            	$like_icon     = '';
                $activity_link = "";
                break;
        }                  
        if(!empty($activity_link)){
			
			if(!($activity->type=='traveller_story' &&  $activity->verified_status==0)){
			echo '<li id="activity_list_'.$activity->id.'">
                   <div class="activity-card">
                      <div class="activity-card-left">';
                        if(!empty($activity->profile_pic)&&file_exists('uploads/resorts/thumbnails/150_'.$activity->profile_pic)){
                            echo  '<img src="'.base_url().'uploads/resorts/thumbnails/150_'.$activity->profile_pic.'"/>';
                        }else{
                            echo  '<img src="'.base_url('assets/front/img/No_Image_Available.jpg').'"/>';
                        }
                        $user_name  = "";
                        $user_name .= !empty($activity->first_name)?$activity->first_name:"";
                        $user_name .= !empty($activity->last_name)?" ".$activity->last_name:"";
                    echo '</div>
                        <div class="activity-card-right">
                            <span class="activity-card-right-name">'.ucfirst($user_name).'</span>
                            <div class="clearfix"></div>
                            <p class="comment-date">';
                        echo !empty($activity->created_date)?date('d F, Y h:i A', strtotime($activity->created_date)) : 'NA';
                        echo '<span class="replied"> '.ucfirst($like_text).'</span>
                            </p>
                            <div class="clearfix"></div>';
                        echo '<h5>'.$activity->item_name.'</h5>';
                        echo '<div class="clearfix"></div>';
                        $activity_imgs = explode(',', $activity->activity_image);   
                        $image_dataMainArr = array();      
                        $image_data ='';              
                        if(!empty($activity_imgs)){                            
                            foreach($activity_imgs as $activity_img){                                
                                if(!empty($activity_img)&&file_exists('uploads/resorts/thumbnails/150_'.$activity_img)){
                                    $image_dataN = '<div class="col-md-2"><div class="resort-activ">';
                                    $image_dataN .= '<a href="'.$activity_link.'">';
                                    $image_dataN .= '<img src="'.base_url().'uploads/resorts/thumbnails/150_'.$activity_img.'"/>';
                                    $image_dataN .= '</a></div></div>';
                                    $image_dataMainArr[] = $image_dataN;
                                }else if(!empty($activity_img)&&file_exists('uploads/blogs/thumbnails/150_'.$activity_img)){
                                    $image_dataN = '<div class="col-md-2"><div class="resort-activ">';
                                    $image_dataN .= '<a href="'.$activity_link.'">';
                                    $image_dataN .= '<img src="'.base_url().'uploads/blogs/thumbnails/150_'.$activity_img.'"/>';
                                    $image_dataN .= '</a></div></div>';
                                    $image_dataMainArr[] = $image_dataN;
                                }
                            }
                            echo '<div class="row">';
                            echo implode('', $image_dataMainArr);
                            echo'</div>';
                        }  
                            /*<div class="row">
                                <div class="col-md-6">
                                   <div class="resort-activ">
                                      <img src="https://www.maldivesexperts.com/uploads/resorts/thumbnails/500_8e59fc83ab2b4a7eeefd61e18d9c7812.jpg"/>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="resort-activ">
                                      <img src="https://www.maldivesexperts.com/uploads/resorts/thumbnails/500_8e59fc83ab2b4a7eeefd61e18d9c7812.jpg"/>
                                   </div>
                                </div>
                            </div>*/
                        echo '<p class="dd">'.$activity->activity_desc.' </p> 
                      </div>
                   </div>
                </li>';

            /*<li>
               <div class="activity-card">
                  <div class="activity-card-left"><img src="https://www.maldivesexperts.com/assets/front/img/No_Image_Available.jpg"/></div>
                  <div class="activity-card-right">
                     <span class="activity-card-right-name">Mark Wha </span>
                     <div class="clearfix"></div>
                     <p class="comment-date">
                        29 September 2019 09:55 AM <span class="replied">Posted</span>
                     </p>
                     <div class="clearfix"></div>
                     <h5>Story of a small island</h5>
                     <div class="clearfix"></div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="resort-activ">
                              <img src="https://www.maldivesexperts.com/uploads/resorts/thumbnails/500_8e59fc83ab2b4a7eeefd61e18d9c7812.jpg"/>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-activ">
                              <img src="https://www.maldivesexperts.com/uploads/resorts/thumbnails/500_8e59fc83ab2b4a7eeefd61e18d9c7812.jpg"/>
                           </div>
                        </div>
                     </div>
                     <p class="dd">
                        Once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve. Milaidhoo is that island. That time is now and this is our story.              
                     </p>
                  </div>
               </div>
            </li>*/
			
			
        /*	echo "<li>";
	    	echo '<div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12"> ';
            	    	echo $like_icon;
                    	    	echo '<div class="user-info">';
                    	        if(!empty($activity->profile_pic)&&file_exists('uploads/resorts/thumbnails/150_'.$activity->profile_pic)){
                    	          	echo  '<img src="'.base_url().'uploads/resorts/thumbnails/150_'.$activity->profile_pic.'"/>';
                    	        }else{
                    	          	echo  '<img src="'.base_url('assets/front/img/default_img.png').'"/>';
                    	        }
                    	        $user_name  = "";
                    	        $user_name .= !empty($activity->first_name)?$activity->first_name:"";
                    	        $user_name .= !empty($activity->last_name)?" ".$activity->last_name:"";
                    	        echo '<span class="user-name">'.$user_name.'</span>';
                                echo '<div class="times">';
                            echo !empty($activity->created_date)?date('d F, Y', strtotime($activity->created_date)) : 'NA';
                            echo '</div>';
                    	        echo '</div>';
                                
            	        echo '</div>';
                        echo '<div class="col-lg-1 col-md-1 col-sm-12 col-12">';
                        echo '</div>';
            	        echo '<div class="col-lg-7 col-md-5 col-sm-12 col-12">';
                    	        echo '<div class="resort-info">';
                    			echo ' <a href="'.$activity_link.'">';
                    			if(!empty($activity->activity_image)&&file_exists('uploads/resorts/thumbnails/150_'.$activity->activity_image)){
                    	          	echo  '<img src="'.base_url().'uploads/resorts/thumbnails/150_'.$activity->activity_image.'"/>';
                    	        }else if(!empty($activity->activity_image)&&file_exists('uploads/blogs/thumbnails/150_'.$activity->activity_image)){
                                    echo  '<img src="'.base_url().'uploads/blogs/thumbnails/150_'.$activity->activity_image.'"/>';
                                }else{
                    	          	echo  '<img src="'.base_url('assets/front/img/default_img.png').'"/>';
                    	        }
                    			echo ' <div class="activity_name">'.$activity->item_name;
                    			echo '</div>
                    			</a>';	
                    	        echo '</div>';
            	        echo '</div>';
            	        
	        echo '</div>';                                     
	        echo "</li>";*/
        } 
	  }
    }
}
?>