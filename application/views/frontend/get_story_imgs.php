<?php 
if(!empty($images)){?>
  <div id="carouselExampleIndicators_images" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    	<?php 
    	$img   = 0;
    	if(!empty($images)){
    		foreach($images as $image){?>
    			<li data-target="#carouselExampleIndicators_images" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
    		<?php 
    		$img++;
    		}
    	}
    	?>
    </ol>
    <div class="carousel-inner">
    	<?php	
    	$img = 1;							      	
    	if(!empty($images)){
    		foreach($images as $image){
    			if(!empty($image->image_name)&&file_exists('uploads/resorts/'.$image->image_name)){
    				echo ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';
              	echo  '<img  class="d-block w-100" src="'.base_url().'uploads/resorts/'.$image->image_name.'" alt="resort"/>';
              	echo '</div>';
              	$img++;
              }
    		}
    	}
      ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators_images" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators_images" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<?php }else{
  echo '<div class="not-found">
          <img src="'.FRONT_THEAM_PATH.'img/story.png" alt="No Found" />
        <div class="clearfix"></div>
       <h4>No Traveller Story Images!</h4>
       <span>We couldn’t find any traveller story images matching the criteria.</span>
        </div>';
}?>