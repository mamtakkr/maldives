<?php 
$user_id = user_id();
if(!empty($blogs)){
   foreach($blogs as $blog){
    $image = $this->common_model->get_row('images', array('type'=>'blog', 'item_id' =>$blog->id), array(), array('id', 'asc'));
      ?>
      <div class="col-md-4" id="blog_<?php echo !empty($blog->id)?$blog->id:'';?>">
         <div class="add-resort-card">
            <div class="add-resort-card-left card_left_blog">
               <a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)) ?>" target="_blank">
               <?php 
               if(!empty($image->image_name)){
                  echo (!empty($image->image_name)&&file_exists('uploads/blogs/thumbnails/150_'.$image->image_name))?'<img src="'.base_url('uploads/blogs/thumbnails/150_'.$image->image_name).'" />':'<img src="'.base_url('assets/front/img/No_Image_Available.jpg').'" />';
               }else if(!empty($image->image_name)){
                  echo (!empty($image->image_name)&&file_exists('uploads/blogs/thumbnails/500_'.$image->image_name))?'<img src="'.base_url('uploads/blogs/thumbnails/500_'.$image->image_name).'" />':'<img src="'.base_url('assets/front/img/No_Image_Available.jpg').'" />';
               }else{                                         
                  echo (!empty($blog->news_image)&&file_exists('uploads/blogs/'.$blog->news_image))?'<img src="'.base_url('uploads/blogs/'.$blog->news_image).'" />':'<img src="'.base_url('assets/front/img/No_Image_Available.jpg').'" />';
               }
               ?>
             </a>
            </div>
            <div class="add-resort-card-right card_right_blog">
               <a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)) ?>" target="_blank">
                  <span class="villa-name-title">
                  <?php 
                     echo !empty($blog->news_title)?$blog->news_title:'';
                     ?>
                  </span>
               </a>
                  <div class="more_less_desc15">
                    <p class="comment more">
                        <?php 
                        echo !empty($blog->news_description)?character_limiter(strip_tags($blog->news_description)):'';
                        ?>
                     </p> 
                  </div>
                  <div class="more_less_desc15">
                     <p class="more">
                        <b>Tags :</b> 
                        <?php 
                        echo !empty($blog->tags)?$blog->tags:'';
                        ?>
                     </p> 
                  </div>                   
               <?php if(!empty($blog->news_added_user)&&$blog->news_added_user==$user_id){?>
                  <div class="listing-menu">
                  <div class="actions">
                     <div class="btn-group">
                        <span class=" dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </span>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left"> 
                           <a class="dropdown-item" href="javascript:void(0);" onclick="add_blog('<?php echo base64_encode($blog->id) ?>');">
                              Edit
                           </a> 
                           <a class="dropdown-item" href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)) ?>">
                             View
                          </a>                                                      
                           <!--<a class="dropdown-item" href="javascript:void(0);" onclick="delete_blog('<?php echo !empty($blog->id)?$blog->id:'';?>');">-->
                           <!--   Delete-->
                           <!--</a>  -->
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