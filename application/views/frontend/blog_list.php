<div id="ajax_resultss">
   <div id="search_filter_result">
      <div class="row">
         <?php 
         $count = 0;
         if(!empty($blogs)){
            foreach ($blogs as $blog) {?> 
				<?php 
					$share_link = base_url('blog-detail?blog_id='.$blog->id); 
					$blog_title = $blog->news_title;
					$sgimage=get_single_image_of_blog($blog->id);
				?>
				<div class="col-lg-4 col-md-6 col-12 mb-4">
					
					<div class="box">
						<div class="img-content">
                            <?php if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/500_'.$sgimage->image_name)) {?>
                                <img src="<?= base_url('uploads/blogs/thumbnails/500_'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php } elseif(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/'.$sgimage->image_name)){ ?>
                                <img src="<?= base_url('uploads/blogs/thumbnails/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php }else { ?>
                                <img src="<?php echo base_url('assets/front/images/No_Image_Available.jpg'); ?>" alt="image.png" class="img-fluid  HomeImage">
                              <?php  }?>
							<div class="image-text-container">
								<!--<div class="d-flex justify-content-between">-->
								<!--	<div class="img-content-title-container">-->
								<!--		<div class="img-content-title"><a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>"><?php echo $blog_title;?></a></div>-->
								<!--		<div class="d-flex">-->
								<!--		<span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>-->
								<!--		</div>-->
								<!--	</div>-->
        <!--                            <div class="img-content-title-container">-->
        <!--                                <div class="description" style="font-size:15px;"><?php echo $blog->tags;?></div>-->
        <!--                            </div>-->
								<!--</div>-->
							</div>
							<div>
								<div class="new_share_blogs share-icon">
                          <div class="share-social">
						  <style>
	    .mobile-social-share {
    background: none repeat scroll 0 0 #EEEEEE;
    display: block !important;
    min-height: 70px !important;
    margin: 50px 0;
}


.mobile-social-share h3 {
    color: inherit;
    float: left;
    font-size: 15px;
    line-height: 20px;
    margin: 25px 25px 0 25px;
}

.share-group {
    float: right;
    margin: 18px 25px 0 0;
}

.btn-group {
    display: inline-block;
    font-size: 0;
    position: relative;
    vertical-align: middle;
    white-space: nowrap;
}

.mobile-social-share ul {
    float: right;
    list-style: none outside none;
    margin: 0;
    min-width: 61px;
    padding: 0;
}

.share {
    min-width: 17px;
}

.mobile-social-share li {
    display: block;
    font-size: 18px;
    list-style: none outside none;
    margin-bottom: 3px;
    margin-left: 4px;
    margin-top: 3px;
}

.btn-share {
    background-color: #BEBEBE;
    border-color: #CCCCCC;
    color: #333333;
}

.btn-twitter {
    background-color: #3399CC !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-google {
    background-color: #DD3F34 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-linkedin {
    background-color: #1884BB !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-pinterest {
    background-color: #CC1E2D !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-mail {
    background-color: #FFC90E !important;
    width: 51px;
    color:#FFFFFF!important;
}

.caret {
    border-left: 4px solid rgba(0, 0, 0, 0);
    border-right: 4px solid rgba(0, 0, 0, 0);
    border-top: 4px solid;
    display: inline-block;
    height: 0;
    margin-left: 2px;
    vertical-align: middle;
    width: 0;
}

#socialShare {
    max-width:59px;
    margin-bottom:18px;
}

#socialShare > a{
    padding: 6px 10px 6px 10px;
}

@media (max-width : 320px) {
    #socialHolder{
        padding-left:5px;
        padding-right:5px;
    }
    
    .mobile-social-share h3 {
        margin-left: 0;
        margin-right: 0;
    }
    
    #socialShare{
        margin-left:5px;
        margin-right:5px;
    }
    
    .mobile-social-share h3 {
        font-size: 15px;
    }
}

@media (max-width : 238px) {
    .mobile-social-share h3 {
        font-size: 12px;
    }
}


	</style>
						  <a data-toggle="dropdown" class="btn btn-info">
                                                                             <i class="fa fa-share-alt fa-inverse"></i>
                                                                        </a>
                                                        				<ul class="dropdown-menu" style="background:transparent;border:none;">
                                                            				<li>
                                                        					    <a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo $share_link.'&text='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'twitter');" class="btn btn-twitter" data-placement="left">
                                                    								<i class="fa fa-twitter"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Facebook" rel="tooltip"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left"  target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'facebook');">
                                                    								<i class="fa fa-facebook"></i>
                                                    							</a>
                                                        					</li>					
                                                        				
                                                        				    <li>
                                                        						<a data-original-title="LinkedIn" rel="tooltip"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'linkedin');" class="btn btn-linkedin" data-placement="left">
                                                    								<i class="fa fa-linkedin"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link.'&description='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'pinterest');" class="btn btn-pinterest" data-placement="left">
                                                    								<i class="fa fa-pinterest"></i>
                                                    							</a>
                                                        					</li>
                                                                            
                                                                        </ul>  
                            
                          </div>
                        </div>
							</div>
						</div>
						<div class="img-bottom-contianer blog_news">
						  <div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title"><a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>"><?php echo $blog_title;?></a></div>
										<div class="d-flex">
										<span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>
										</div>
									</div>
                                    <!--<div class="img-content-title-container">-->
                                    <!--    <div class="description" style="font-size:15px;"><?php echo $blog->tags;?></div>-->
                                    <!--</div>-->
								</div>  
						    
						<div class="img-bottom-profile new_blog my-1">
                        <div class="profile-image">
						<?php
							if(!empty($blog->profile_pic)&&file_exists('uploads/users/'.$blog->profile_pic)){
								echo '<img src="'.base_url('uploads/users/'.$blog->profile_pic).'" class="img-fluid ">';
							}else{
								echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" class="img-fluid"/>';
							}
							?> 
                        </div>
                        <div class="profile-details mx-2">
                          <div class="profile-name"> <?php echo $blog->first_name." ".$blog->last_name; ?></div>
						  <?php $counts = $this->common_model->getGroupBycount('mal_news_blog','news_added_user',array('news_added_user'=>$blog->news_added_user));?>
                          <div class="profile-comment">Maldives | <?php echo $counts[0]->fieldcount;?> Contributions</div>
                        </div>
                      </div>
                      
                      <div class="img-bottom-contianer-description blog_new_descriptions">
                        <span class="more-link-page" rel="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>">
						<?php echo !empty($blog->news_description)?character_limiter(strip_tags($blog->news_description), 180):''; ?>
                        </span>
                      </div>
						</div>
					</div>
				</div>

					
            <?php 
            }
         }?>
		  </div>
         <div class="clearfix"></div>
         <div class="box-footer">
           <?php 
               echo  $this->pagination->create_links();    
           ?>
          </div>
      </div>
   </div>
</div>
