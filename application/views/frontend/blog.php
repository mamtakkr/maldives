	<section>
		<div class="blog-header-banner">
			<div class="blog-inner-slider owl-carousel owl-theme">
				<?php 
				if(!empty($caption_imgs)) {
					if(!empty($caption_imgs)){
						$img=0; 
							foreach($caption_imgs as $caption_img){
								if(file_exists('uploads/caption/'.$caption_img->image_name)){
						?>
						<div class="box"  style="background-image:url('<?php echo base_url('uploads/caption/' . $caption_img->image_name); ?>')">>
							<div class="blog-header-title">
								<h1><?php echo !empty($caption->caption_sub_title)?$caption->caption_sub_title:'';?></h1>
								<h2><?php echo ucwords($caption->caption_title);?></h2>
								<!--<h2><?php //echo strtoupper($caption->caption_title);?></h2>-->
							</div>
						</div>
						<?php 
						} }
					} }?>
			</div>
		</div>
	</section>

	<section>
		<div class="about blog_news">
			<div class="about-title">
			    <h2>TRAVEL STORIES & NEWS</h2>
				<!--<h2>STORIES, BLOGS & NEWS</h2>-->
				<img src="assets/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
		</div>
		<div class="blogs-items-container">
			<div class="container">
				<div class="row">
				    
					<div class="col-lg-2 col-md-12 overlay" id="myNav">
					    <p class="new_tags">INSPIRE BY:</p> 
						<div class="blog-sidebar new_blog_redis">
							<div class="blog-sidebar-header blog_categories">
								<!--<span>INSPIRE ME BY</span>-->
								<a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
							</div>
							<div class="blog-sidebar-items">
							    
								<?php 
								// 	$tagArr = [];
								// 	if(is_array($tags)){
								// 	    $all_tags = "";
    				// 					foreach($tags as $tag) {
    				// 					    $all_tags .= $tag->tags.",";
    				// 				// 		if($tag->tags!="") {
    				// 				// 			if(strpos($tag->tags,",") >-1) {
    				// 				// 				$splitTags = explode(",",$tag->tags);
    				// 				// 				foreach($splitTags as $key=>$val) {
    				// 				// 					if(!array_search($val,$tagArr)) {
    				// 				// 						$tagArr[] = $val;
    				// 				// 					}
    													
    				// 				// 				}
    				// 				// 			} else {
    				// 				// 				if(!array_search($tag->tags,$tagArr)) {
    				// 				// 					$tagArr[] = $tag->tags;
    				// 				// 				}
    				// 				// 			}
    											
    				// 				// 		}
    				// 					}
    				// 					if(!empty($all_tags)){
    				// 					    $splitTags = explode(",",$all_tags);
    				// 					    $arr_tags = array_intersect_key($splitTags, array_unique(array_map('strtolower', $splitTags)));
    				// 					   // echo "<pre>"; var_dump($data); die;
    				// 					   // $arr_tags = array_unique($splitTags);
    				// 					    foreach($arr_tags as $key=>$val) {
								// 				if(!array_search($val,$tagArr)) {
								// 					$tagArr[] = $val;
								// 				}
								// 			}
    				// 					}
								// 	}
								// 	if(!empty($tagArr)) {
								// 		foreach($tagArr as $k=>$v) {
											?>
												<!--<a href="<?php echo base_url();?>blogs?custags=<?php echo $v;?>" class="review-btn btn my-2 "><?php echo $v;?></a>-->
											<?php
								// 		}
										
								// 	}
								// var_dump($blog_cats); die;
								?>
								<!--<div class="blog-sidebar-item">Travel News</div> -->
								<?php 
								if(!empty($blog_cats)){
								    foreach($blog_cats as $b_cat){
								        if(!empty($b_cat['blog_cat_name'])){
        								    ?>
								            <div class="blog-sidebar-item">
								                <b>
								                    <a href="<?php echo base_url();?>blogs?category=<?php echo $b_cat['blog_cat_id'];?>">
								                    <?php echo $b_cat['blog_cat_name'];?>
								                </a>
								                </b>
								            </div> 
        								    <?php 
								        }
								    }
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-10 col-md-12 mx-auto blog-innner-cards">
						<button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
						<?php include('blog_list.php'); ?>       
					</div>
				</div>
			</div>
		</div>
	</section>
	
<script>
  //showmore
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 250;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "More";
    var lesstext = "Less";
    

    $('.more1').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
  </script>
    <script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
