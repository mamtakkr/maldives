  <div class="inspiration-marquee">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="marquee-overlay">
              <div class="marquee-inner">
                <div class="stylesh-font">Maldives</div>
                <h1>FINDING YOUR DREAM HOLIDAY</h1>
                <div class="clearfix"></div>
              </div>
            </div>
            <img  src="<?php echo base_url();?>assets/front/images/faq-marquee.png" class="d-block w-100" alt="..."> </div>
          <div class="carousel-item">
            <div class="marquee-overlay">
              <div class="marquee-inner">
                <div class="stylesh-font">Maldives</div>
                <h1>FREQUENTLY ASKED QUESTIONS</h1>
                <div class="clearfix"></div>
              
              </div>
            </div>
            <img  src="<?php echo base_url();?>assets/front/images/banner-home.png" class="d-block w-100" alt="..."></div>
          <div class="carousel-item">
            <div class="marquee-overlay">
              <div class="marquee-inner">
                <div class="stylesh-font">Maldives</div>
                <h1>FREQUENTLY ASKED QUESTIONS</h1>
                <div class="clearfix"></div>
                
              </div>
            </div>
            <img  src="<?php echo base_url();?>assets/front/images/resort-details_bg.png" class="d-block w-100" alt="..."> </div>
        </div>
      </div>
    </div>
  
  
  <div class="clearfix"></div>
  
  
  <div class="faq" id="faq">
    <div class="container">
      <h2 class="text-center">FREQUENTLY ASKED QUESTIONS</h2>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  	<?php $i=0;
      if($faqs) {
		 foreach($faqs as $faq){?>
        <div class="panel panel-default">
          <div class="panel-heading <?php if($i==0){echo 'active';}?>" role="tab" id="heading_<?php echo $faq->faq_id;?>">
            <h4 class="panel-title"> 
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $faq->faq_id;?>" aria-expanded="true" aria-controls="collapse_<?php echo $faq->faq_id;?>" class="collapsed"> 
				<?php echo $faq->question;?> 
				</a> 
			</h4>
          </div>
          <div id="collapse_<?php echo $faq->faq_id;?>" class="panel-collapse in collapse <?php if($i==0){echo 'show';}?>" role="tabpanel" aria-labelledby="heading_<?php echo $faq->faq_id;?>" style="">
            <div class="panel-body"> 
			<?php echo $faq->answer;?> 
			</div>
          </div>
        </div>
		<?php $i++;} }?>
     </div>
     
    </div>
  </div>