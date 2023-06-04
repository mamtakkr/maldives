<section>
    <div class="container">
        <div class="row">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-10">
            		<div class="blog-header">
            			<div class="blog-title">
            				<h2><?php echo $row->news_title;?></h2>
            				<!--<h3>-->
            					<?php 
            				// 		$tagArr = [];
            				// 		if(strpos($row->tags,",") >-1) {
            				// 			$splitTags = explode(",",$row->tags);
            				// 			foreach($splitTags as $key=>$val) {
            				// 				if(!array_search($val,$tagArr)) {
            				// 					$tagArr[] = $val;
            				// 				}
            				// 			}
            				// 		} else {
            				// 			$tagArr[] = $row->tags;
            				// 		}
            				// 		if(!empty($tagArr)) {
            				// 			foreach($tagArr as $k=>$v) {
            				// 				?>
            				<!--// 					<a href="<?php echo base_url();?>blogs?custags=<?php echo $v;?>" class="review-btn btn my-2 "><?php echo $v;?></a>-->
            								<?php
            				// 			}		
            				// 		}
            					?>
            				<!--</h3>-->
            			</div>
            			<div class="blog-writter">
            				<div class="blog-writter-img">
                                <?php
                                    // if(!empty($blog->profile_pic)&&file_exists('uploads/users/'.$blog->profile_pic))
                                    // { 
                                    //     echo '<img src="'.base_url('uploads/users/'.$blog->profile_pic).'"  class="img-fluid" />'; 
                                    // }else
                                    // { 
                                    //     echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" />'; 
                                    // }
                                    if($row->role=='Hotel User' || $row->role=='User'){
        						        $images=$this->common_model->get_result('images', array('status'=>1, 'type'=>'blog','item_id'=>$row->id));
                                        if(!empty($images)){
                                            foreach($images as $image){ 
                                                if(!empty($image->image_name) && file_exists('uploads/blogs/thumbnails/150_'.$image->image_name)){
                                                    echo '<img src="'.base_url().'uploads/blogs/thumbnails/150_'.$image->image_name.'" width="50"/>';
                                                }else{
                                                    echo '<img src="'.base_url().'uploads/blogs/thumbnails/'.$image->image_name.'" width="50"/>';
                                                }
                                            }
                                        }
        						    }else{
                                        if(!empty($row->page_banner_image))
                                        { 
                                            echo '<img src="'.base_url($row->page_banner_image).'"  class="img-fluid" />'; 
                                        }else
                                        { 
                                            echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" />'; 
                                        }
        						    }
                                ?>
            				</div>
            				<div class="blog-writter-details">
            					<div>
            						<span class="blog-writter-name">
            						    <?php 
            						    if($row->role=='Hotel User' || $row->role=='User'){
            						        echo $row->first_name." ".$row->last_name;
            						    }else{
            						        $userData = $this->common_model->get_row('admin_users', array('id'=>$row->news_added_user));
            						        echo $userData->first_name." ".$userData->last_name;
            						    }
            						    ?>
            						</span> <span class="line_shot">|</span> 
            						<span class="blog-writter-date"><?php echo date('d F, Y',strtotime($row->created_date));?></span>
            					</div>
            					<div class="blog-writter-text">
                                <?php $counts = $this->common_model->getGroupBycount('mal_news_blog','news_added_user',array('news_added_user'=>$row->news_added_user)); //print_r($counts); ?>
            						<!--<div>Maldives | <?php echo $counts[0]->fieldcount;?> Contributions</div>-->
            					</div>
            				</div>
            			</div>
            		</div>
		        </div>
		    </div>
	</div>
	
    <div class="blogs-items-container">
        	<div class="container">
	    <div class="row">
    	    <div class="col-lg-2 col-md-12 overlay" id="myNav" style="with:0%;">
    	         <p class="new_tags">INSPIRE BY:</p> 
    	         <div class="blog-sidebar-header blog_categories">
    				<!--<span>INSPIRE ME BY</span>-->
    				<a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
    			</div>
    	       <div class="blog-sidebar-items new_categories">
    						  
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
    							?>
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
    							<!-- <div class="blog-sidebar-item">Travel News</div> -->
    			</div>
    	    </div>  
    	    <div class="col-lg-10 col-md-12 mx-auto blog-innner-cards">
    	        
    	        <button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
    			<div class="blog-content mt-5">
    				<div class="blog-content-img">
    				    <?php
    				    if($row->role=='Hotel User' || $row->role=='User'){
    				        $images=$this->common_model->get_result('images', array('status'=>1, 'type'=>'blog','item_id'=>$row->id));
                            if(!empty($images)){
                                foreach($images as $image){ 
                                    if(!empty($image->image_name) && file_exists('uploads/blogs/full_image/1300_'.$image->image_name)){
                                        echo '<figure><img src="'.base_url().'uploads/blogs/full_image/1300_'.$image->image_name.'" alt="bannerimage"  class="img-fluid" /></figure>';
                                    }
                                }
                            }
    				    }else{
    				    ?>
    					<figure>
                        <img src="<?php echo base_url($row->page_banner_image);?>" alt="bannerimage"  class="img-fluid" />
    						<!--<figcaption class="blog-content-date my-2">20 June 2021</figcaption>-->
    					</figure>
    					<?php } ?>
    				</div>
    				<div class="blogContent">
    				    <?php //var_dump($row->news_description); die;?>
    					<?php echo $row->news_description;?>
    				</div>
    			</div>
    			<div class="row">
    			    <div class="col-lg-12">
    			        
    			           <div class="blog-title new_font_yt">
    			                <span class="new-tag_1">TAGS</span>
    			     <!--</div>-->
    			     <!--<div class="col-lg-10 col-8">-->
                			
                				
                					<?php 
                						$tagArr = [];
                						if(strpos($row->tags,",") >-1) {
                							$splitTags = explode(",",$row->tags);
                							foreach($splitTags as $key=>$val) {
                								if(!array_search($val,$tagArr)) {
                									$tagArr[] = $val;
                								}
                							}
                						} else {
                							$tagArr[] = $row->tags;
                						}
                						if(!empty($tagArr)) {
                							foreach($tagArr as $k=>$v) {
                								?>
                									<a href="<?php echo base_url();?>blogs?custags=<?php echo $v;?>" class="review-btn btn my-2 "><?php echo $v;?></a>
                								<?php
                							}		
                						}
                					?>
                				
                			</div>
                			
            			</div>
            		</div>	
    			
    			<div class="latest_blog" id="blog-section">
            	   <!--<div class="container">-->
            	       <div class="about blog_news">
            			<div class="about-title">
            			     <div class="new_blog_tr">
            			        <h4>SIMILAR BLOG</h4>
            			     </div>   
            				<!--<h2>STORIES, BLOGS & NEWS</h2>-->
            				
            				<img src="<?php echo base_url();?>/assets/images/Rectangle6.png" alt="" class="img-fluid">
            			</div>
            		</div>
            	       <div class="inspiration-slider owl-carousel owl-theme">
            					<?php 
                                 $count = 0;
                                 if(!empty($recent_blogs)){
                                    foreach ($recent_blogs as $r_blog) { //echo "<pre>"; var_dump($r_blog['id']); die;?> 
                        				<?php 
                        				if($row->id != $r_blog['id']){
                        					$share_link = base_url('blog-detail?blog_id='.$r_blog['id']); 
                        					$blog_title = $r_blog['news_title'];
                        					$sgimage=get_single_image_of_blog($r_blog['id']);
                        				?>
            					<div class="box">
            						<div class="img-content">
                                        <?php if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/500_'.$sgimage->image_name)) {?>
                                            <img src="<?= base_url('uploads/blogs/thumbnails/500_'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                                        <?php } elseif(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/'.$sgimage->image_name)){ ?>
                                            <img src="<?= base_url('uploads/blogs/thumbnails/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                                        <?php }else { ?>
                                            <img src="<?php echo base_url('assets/front/images/No_Image_Available.jpg'); ?>" alt="image.png" class="img-fluid  HomeImage">
                                          <?php  }?>
            						</div>
            						<div class="img-bottom-contianer blog_news">
            						  <div class="d-flex justify-content-between">
            									<div class="img-content-title-container">
            										<div class="img-content-title"><a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($r_blog['id'])); ?>"><?php echo $blog_title;?></a></div>
            										<div class="d-flex">
            										<span class="description ml-1"><?php echo !empty($r_blog['created_date'])?date('d M Y', strtotime($r_blog['created_date'])):''; ?></span>
            										</div>
            									</div>
                                                
            								</div>  
            						    
            						<div class="img-bottom-profile new_blog my-1">
                                    <div class="profile-image">
            						<?php
            							if(!empty($r_blog['profile_pic'])&&file_exists('uploads/users/'.$r_blog['profile_pic'])){
            								echo '<img src="'.base_url('uploads/users/'.$r_blog['profile_pic']).'" class="img-fluid ">';
            							}else{
            								echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" class="img-fluid"/>';
            							}
            							?> 
                                    </div>
                                    <div class="profile-details mx-2">
                                      <div class="profile-name">  </div>
            						  <?php $counts = $this->common_model->getGroupBycount('mal_news_blog','news_added_user',array('news_added_user'=>$r_blog['news_added_user']));?>
                                      <div class="profile-comment">Maldives | <?php echo $counts[0]->fieldcount;?> Contributions</div>
                                    </div>
                                  </div>
                                  
                                  <div class="img-bottom-contianer-description blog_new_descriptions">
                                    <span class="more-link-page" rel="<?php echo base_url('blog-detail?blog_id='.base64_encode($r_blog['id'])); ?>">
            						<?php echo !empty($r_blog['news_description'])?character_limiter(strip_tags($r_blog['news_description']), 180):''; ?>
                                    </span>
                                  </div>
            						</div>
            					</div>
            					
                        <?php 
                        	}
                        }
                     }?>
            					
            						
            	       </div>    
            	   <!--</div>     -->
            	</div>	
    			
    		    </div>	
	    </div>
    </div>
    </div>
</section>
	

<div class="clearfix"></div>

<script>
    //showmore
    $(document).ready(function () {
        // Configure/customize these variables.
        var showChar = 250; // How many characters are shown by default
        var ellipsestext = "...";
        var moretext = "More";
        var lesstext = "Less";

        $(".blogContent").each(function () { 
			if($(this).find('img').attr("src").indexOf('../../../uploads') >-1) {
				var imagesrc = $(this).find('img').attr("src");
				imagesrc = imagesrc.replace("../../../uploads", "./uploads");
				$(this).find('img').attr("src",imagesrc);
			}
		});
        $(".more1").each(function () {
            var content = $(this).html();

            if (content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + "</a></span>";

                $(this).html(html);
            }
        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
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
