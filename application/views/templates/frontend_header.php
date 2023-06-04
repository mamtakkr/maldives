<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo  FRONT_THEAM_PATH ;?>images/fav.png" type="image/gif" sizes="16x16"> 
  <title>Maldives Experts | HOME</title>
	<!-- bootstrap css file -->
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/all.min.css">
	<!-- font-awesome css -->
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- owl carousel css -->
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/owl.theme.default.css">
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/pretty-checkbox.min.css">
	<!-- accordion css -->
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/accordion.css">
	<!-- scroll-top css -->
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/scroll-top.css">
	
	<link href="https://fonts.googleapis.com/css2?family=Carattere&display=swap" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
	<!-- css file -->
	<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/style.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?php echo FRONT_THEAM_PATH; ?>js/jquery.validate.min.js"></script>  
<script>
	$( document ).ready(function() {
		$('#mySeachTextBoxTop').blur(function(event) {
			$('.searchBoxpopup').hide();
		});
		$('#searchtopIcon').click(function(event) {
			$('.searchBoxpopup').show();
			$('#mySeachTextBoxTop').focus();
		});
	});
</script>


</head>
<body>
<section class="header-container">
	<nav class="navbar navbar-expand-lg navbar-light page-navbar">
	    <div class="container">
		<a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Logo.png" alt="Logo.png"
				class="img-fluid" /></a>
		<button class="navbar-toggler" type="button" data-toggle="modal" data-target="#mobile-nav">
			<i class="fa fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('inspiration'); ?>#Resort-section">Resorts</a>
				</li>
			
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('inspiration'); ?>#villas-and-Suits">Villas & Suites </a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('inspiration'); ?>#experiences"> Experiences </a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="<?php echo  base_url('compare_resorts');?>">Compare</a>
				</li>
				<!--<li class="nav-item">-->
				<!--	<a class="nav-link" href="<?php echo base_url('transfers'); ?>">Transfers</a>-->
				<!--</li>-->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo  base_url('blogs');?>">Blog</a>
				</li>
				<!--<li class="nav-item">-->
				<!--	<a class="nav-link" href="<?php echo base_url('reviews'); ?>">Reviews</a>-->
				<!--</li>-->
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('maldives'); ?>">Maldives</a>
				</li>
				<!--<li class="nav-item dropdown">-->
				<!--	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"-->
				<!--		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
				<!--		More...-->
				<!--	</a>-->
				<!--	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
				<!--		<a class="dropdown-item" href="<?php echo base_url('maldives'); ?>">Maldives</a>-->
						<!-- <a class="dropdown-item" href="<?php //echo base_url('community'); ?>">Community</a> -->
				<!--		<a class="dropdown-item" href="<?php echo base_url('galllery'); ?>">Gallery</a>-->
            			<!-- <a class="dropdown-item" href="<?php //echo base_url('aboutus'); ?>">About</a> -->
				<!--	</div>-->
				<!--</li>-->
			</ul>
		</div>
		<div class="nav-img nav_login">
			<?php 
				$user = user_info();
				if(empty($user)){
					$width="width:80px;";
				} else {
					$width="width:182px;";
				}
			?>
    <ul style="list-style:none;<?php echo $width;?>">
      <li style="float:left;padding-top:10px;position:relative;">
			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Search2.png" alt="Search2.png" class="img-fluid mr-4" id="searchtopIcon" />
			<div class="searchBoxpopup">
				<form action="<?php echo base_url();?>resorts">
				<?php 
					$search = "";
					if(isset($_REQUEST['search']) && $_REQUEST['search']!="") {
						$search = $_REQUEST['search'];
					}
				?>
					<input type="text"  id="mySeachTextBoxTop" name="search" placeholder="Search resort name..." value="<?php echo $search;?>">
				</form>
			</div>
      </li>
	  	<li style="float:left;">
			<?php 
          		
				if(empty($user)){?>
            			<a href="<?php echo base_url('login'); ?>"> 
                			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/user.png" alt="user" class="diff">                 
            			</a> 
					 <?php 
				} //print_r($user);
			  	if(!empty($user)){
          			if(!empty($user->profile_pic)&&file_exists('uploads/resorts/thumbnails/150_'.$user->profile_pic)){
            			$profilePic = base_url('uploads/resorts/thumbnails/150_'.$user->profile_pic);
          			}
				  	else if(!empty($user->file)){
						$profilePic = $user->file;
				  	}else{
            			$profilePic = base_url('assets/front/images/No_Image_Available.jpg');
          			}?>
						<div class="profile-dropdown">
							<div class="dropdown">
								<div class="dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="avtar">
										<div class="avtar-pic ">
										<img src="<?php echo $profilePic; ?>" id="user_profile_image_header" alt=" user profile image">
										</div>
									</div>
								</div>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="<?php echo base_url('user/dashboard'); ?>">Dashboard</a>
									<a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">Sign out</a>
								</div>
							</div>
						</div>
          <?php }?>
					</li>
        </ul>  
		</div>
	</div>
	</nav>
	<div class="mobile-nav">
		<div class="modal fade" id="mobile-nav" tabindex="-1" aria-labelledby="mobile-navLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class="fa fa-times"></i></span>
						</button>
					</div>
					<div class="modal-body">
						<!--<ul class="navbar-nav mx-auto">-->
						<!--	<li class="nav-item active">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo base_url('resorts'); ?>">Hotels</a>-->
						<!--	</li>-->
						<!--	<li class="nav-item">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo base_url('inspiration'); ?>">Inspirations</a>-->
						<!--	</li>-->
						<!--	<li class="nav-item">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo  base_url('compare_resorts');?>">Compare</a>-->
						<!--	</li>-->
						<!--	<li class="nav-item">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo base_url('transfers'); ?>">Transfers</a>-->
						<!--	</li>-->
						<!--	<li class="nav-item">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo  base_url('blogs');?>">Blog</a>-->
						<!--	</li>-->
						<!--	<li class="nav-item">-->
						<!--		<a class="nav-link mobile-nav-link" href="<?php echo base_url('reviews'); ?>">Reviews</a>-->
						<!--	</li>-->
      <!--                      <li class="nav-item">	-->
      <!--                          <a class="nav-link mobile-nav-link" href="<?php echo base_url('maldives'); ?>">Maldives</a>-->
      <!--          			</li>-->
      <!--          			<li class="nav-item">	-->
      <!--                          <a class="nav-link mobile-nav-link" href="<?php echo base_url('community'); ?>">Community</a>-->
      <!--          			</li>-->
      <!--          			<li class="nav-item">	-->
      <!--                          <a class="nav-link mobile-nav-link" href="<?php echo base_url('galllery'); ?>">Gallery</a>-->
      <!--          			</li>-->
      <!--                      <li class="nav-item">	-->
      <!--                        <a class="nav-link mobile-nav-link" href="<?php echo base_url('aboutus'); ?>">About</a>-->
						<!--	</li>-->
						<!--</ul>-->
						
						<ul class="navbar-nav mx-auto">
							<li class="nav-item active">
								<a  class="nav-link mobile-nav-link new_mobie_menu"  href="<?php echo base_url('inspiration'); ?>#Resort-section">Resorts</a>
							</li>
							<li class="nav-item">
								<a class="nav-link mobile-nav-link new_mobie_menu" href="<?php echo base_url('inspiration'); ?>#villas-and-Suits">Villas & Suites </a>
							</li>
							<li class="nav-item">
								<a class="nav-link mobile-nav-link new_mobie_menu" href="<?php echo base_url('inspiration'); ?>#experiences">Experiences </a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link mobile-nav-link" href="<?php echo  base_url('compare_resorts');?>">Compare</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link mobile-nav-link" href="<?php echo  base_url('blogs');?>">Blog</a>
							</li>
                            <li class="nav-item">	
                                <a class="nav-link mobile-nav-link" href="<?php echo base_url('maldives'); ?>">Maldives</a>
                			</li>
                		
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>