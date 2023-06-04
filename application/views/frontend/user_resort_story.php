<?php 
$user_id = user_id();
if(!empty($re_storys)){
   foreach($re_storys as $story){
    $image = $this->common_model->get_row('images', array('type'=>'resort_story', 'item_id' =>$story->id), array(), array('id', 'asc'));
   	?>
      <div class="col-md-12" id="story_<?php 
         echo !empty($story->id)?$story->id:'';
         ?>">
         <div class="add-resort-card">
            <div class="add-resort-card-left">
                <a href="<?php echo base_url('reviews?type=resort_story&story_id='.base64_encode($story->id)) ?>" target="_blank">
                  <?php 
                   if(!empty($image->image_name)){
                   	echo (!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name))?'<img src="'.base_url('uploads/resorts/thumbnails/150_'.$image->image_name).'" />':'<img src="'.base_url('assets/front/images/No_Image_Available.jpg').'" />';
                   }else{                                       	
                     	echo (!empty($story->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$story->image_name))?'<img src="'.base_url('uploads/resorts/thumbnails/150_'.$story->image_name).'" />':'<img src="'.base_url('assets/front/images/No_Image_Available.jpg').'" />';
                  }
                  ?>
               </a>
            </div>
            <div class="add-resort-card-right">
                <a href="<?php echo base_url('reviews?type=resort_story&story_id='.base64_encode($story->id)) ?>" target="_blank">
                  <span class="villa-name-title">
                  <?php 
                     echo !empty($story->title)?$story->title:'';
                     ?>
                  </span>
               </a>
               <div class="more_less_desc15">
                  <p class="comment more">
                     <?php
                     if(!empty($story->description)) {
                        $description = $story->description;
                        if(strlen($description) > 600) {
                           echo substr($description,0,600)."...";
                        } else {
                           echo $description;
                        }
                     } 
                     ?>
                  </p> 
               </div>
               <ul class="stories">
                  <li>
                     <b>Resort</b>
                     <span>
                     <?php 
                        echo !empty($story->resort_name)?$story->resort_name:'';
                     ?>                              
                     </span> 
                  </li>
                  <li>
                     <b>Posted Date </b>
                     <span>
                     <?php 
                        echo !empty($story->created_date)?date('d M Y h:i A', strtotime($story->created_date)):'';
                     ?>                              
                     </span> 
                  </li>
               </ul>
               <?php if(!empty($story->user_id)&&$story->user_id==$user_id){?>
               <div class="listing-menu">
                  <div class="actions">
                     <div class="btn-group">
                        <span class=" dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </span>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left"> 
                           <a class="dropdown-item" href="javascript:void(0);" onclick="add_resort_story('<?php echo base64_encode($story->id); ?>');">
                              Edit
                           </a> 
                           <a class="dropdown-item" href="<?php echo base_url('reviews?type=resort_story&story_id='.base64_encode($story->id)) ?>">
                             View
                          </a>                                                      
                           <a class="dropdown-item" href="javascript:void(0);" 
                           onclick="delete_story('<?php echo $story->id;?>')">
                              Delete
                           </a>  
                        </div>
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