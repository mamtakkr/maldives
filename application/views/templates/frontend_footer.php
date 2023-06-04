<!--<section>
		<div class="newsletter-container">
			<div class="newsletter-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<h3>Subscribe For Our Newsletter</h3>
							<p>Subscribe to our newsletter and receive updates on the latest news.</p>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="input-group mb-3 news-letter-group">
								<input type="text" class="form-control "
									placeholder="Help Make Smarter Decisions Faster." aria-label="Recipient's username"
									aria-describedby="button-addon2">
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button"
										id="button-addon2">Subscribe</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>-->
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
	<footer>
		<div class="footer">
		   <div class="container"> 
			<div class="row">
				<div class="col-lg-2 col-md-4 col-12 mb-4">
					<img src="<?php echo  FRONT_THEAM_PATH ;?>/images/logo_footer.png" alt="Logo.png" class="img-fluid">
				</div>
				<div class="col-lg-3 col-md-4 col-6 mb-4 text-center">
					<div class="quick-links">
						<h4>Quick Links</h4>
						<div class="quick-links-items">
							<div class="quick-links-container"><a href="<?php echo base_url('resorts'); ?>">Hotels</a></div>	
							<!--<div class="quick-links-container"><a href="<?php echo base_url('inspiration'); ?>">Inspiration</a></div>	-->
							<div class="quick-links-container"><a href="<?php echo base_url('compare_resorts'); ?>">Compare</a></div>	
							<!--<div class="quick-links-container"><a href="<?php echo base_url('transfers'); ?>">Transfers</a></div>	-->
							<div class="quick-links-container"><a href="<?php echo base_url('blogs'); ?>">Blogs</a></div>	
							<!--<div class="quick-links-container"><a href="<?php echo base_url('reviews'); ?>">Reviews</a></div>	-->
							<!--<div class="quick-links-container"><a href="<?php echo base_url('aboutus'); ?>">About</a></div>-->
							<div class="quick-links-container"><a href="<?php echo base_url('maldives'); ?>">Maldives</a></div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
					<div class="quick-links">
						<h4>Support</h4>
						<div class="quick-links-items">
							<div class="quick-links-container"><a href="#">Privacy Policy</a></div>
							<div class="quick-links-container"><a href="#">Cookie Policy</a></div>
							<div class="quick-links-container"><a href="#">Site Map</a></div>
							<div class="quick-links-container"><a href="<?php echo  base_url('hotel_login');?>">Hotel Login</a></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-4 col-6 mb-4 text-center">
					<div class="quick-links">
						<h4>Contact Us</h4>
						<div class="quick-links-items">
							<div class="quick-links-container"><a
									href="mailto:info@maldivesexperts.com">info@maldivesexperts.com</a></div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-4 col-6 mb-4 text-center">
					<div class="quick-links">
						<h4>Follow Us</h4>
						<div class="quick-links-items">
							<div class="quick-links-container">
								<a class="social-icons" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Facebook1.png" class="img-fluid"
										alt="Facebook1.png"></a>
								<a class="social-icons" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Twitter1.png" class="img-fluid"
										alt="Twitter1.png"></a>
								<a class="social-icons" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Instagram1.png" class="img-fluid"
										alt="Instagram1.png"></a>
								<a class="social-icons" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Linkdin1.png" class="img-fluid"
										alt="Linkdin1.png"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		</div>
	</footer>
	<!-- jquery file -->
	
	<!-- bootstrap boundle file -->
	<script src="<?php echo  FRONT_THEAM_PATH ;?>js/bootstrap.bundle.min.js"></script>
	
	<!-- accordion js file -->
    <script src="<?php echo  FRONT_THEAM_PATH ;?>js/accordion.js"></script>
	<!-- carousel js file -->
	
	<!-- scroll-top js -->
	<script src="<?php echo  FRONT_THEAM_PATH ;?>js/scroll-top.js"></script>
	<!-- custom js file -->
	<script src="<?php echo  FRONT_THEAM_PATH ;?>js/script.js"></script>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



<!--Jquery latest library--> 


<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/popper.min.js"></script> 
 <!--Bootstrap--> 
<!-- <script src="<?php echo  FRONT_THEAM_PATH ;?>js/respond.js"></script>  -->
<!--owl.carousel.min--> 

<!--Custom--> 
<!-- <script src="<?php echo  FRONT_THEAM_PATH ;?>js/custom.js"></script> -->
<!-- <script src="<?php echo  FRONT_THEAM_PATH ;?>js/moment.min.js"></script>   -->
<!-- <script src="<?php echo  FRONT_THEAM_PATH ;?>js/bootstrap-datetimepicker.min.js"></script> -->

<!--Gellery-->
<!-- <script src="<?php echo  FRONT_THEAM_PATH ;?>js/baguetteBox.min.js"></script> -->

 
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
  //$(".resort-toggle a").click(function(){
    //$(".tab-bar ul").slideToggle();
  //}); 
</script>

<script>

  $(document).on('click', '.new_mobie_menu', function(){
      
        var wURL = $(this).attr('href'); 
        window.location.href = wURL;
        $('#mobile-nav').modal({backdrop: 'close'})
      
  });
  
</script>

<link rel="stylesheet" href="<?php echo  FRONT_THEAM_PATH ;?>css/alertify.core.css">
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/alertify.min.js"></script>  
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=yce0zaitd65hrxhga40mxmc5pcydv134y1b8jjvk5pzfopvx"></script>
      <script type="text/javascript">
         tinymce.init({
           selector: '.tinymce_edittor',
           height: 250,
           menubar: true,
           plugins: [
             'advlist autolink lists link image charmap print preview anchor textcolor',
             'searchreplace visualblocks code fullscreen',
             'insertdatetime media table contextmenu paste code help wordcount'
           ],
           toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
           content_css: [
             '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
             '//www.tinymce.com/css/codepen.min.css'],
             // without images_upload_url set, Upload tab won't show up
           images_upload_url: '<?php echo ADMIN_URL; ?>superadmin/uploadFileEditor',      
           // override default upload handler to simulate successful upload
           images_upload_handler: function (blobInfo, success, failure) {
               var xhr, formData;        
               xhr = new XMLHttpRequest();
               xhr.withCredentials = false;
               xhr.open('POST', '<?php echo ADMIN_URL; ?>superadmin/uploadFileEditor');        
               xhr.onload = function() {
                   var json;          
                   if (xhr.status != 200) {
                       failure('HTTP Error: ' + xhr.status);
                       return;
                   }          
                   json = JSON.parse(xhr.responseText);  
                   if (json.status==false) {
                       failure('Invalid JSON: ' + json.message);
                       return;
                   }          
                   success(json.location);
               };        
               formData = new FormData();
               formData.append('user_img', blobInfo.blob(), blobInfo.filename());        
               xhr.send(formData);
           },
         }); 
      </script>  
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149666137-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-149666137-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149666137-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-149666137-1');
</script>
</body>
</html>