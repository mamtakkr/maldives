<section class="resort" style="margin-top: 115px;">
  <div class="container">
 
    <!--== RESORT START ==-->  
    <div class="row">
       <div class="col-md-3 col-lg-2">
          <div class="resort-name-img text-center">
            <div class="imag1">
			<?php if(isset($resort->id)){ ?>
              <a href="<?php echo base_url('resort-detail?resort_id='.base64_encode($resort->id)); ?>">
               <?php 
               if(!empty($resort->resort_logo)&&file_exists('uploads/resorts/'.$resort->resort_logo)){?>
                  <img src="<?php echo base_url().'uploads/resorts/'.$resort->resort_logo ;?>" alt="Resort-Name"/>
				  </a> 
               <?php }
               }else{?> 
                  <img src="<?php echo  FRONT_THEAM_PATH ;?>images/No_Image_Available.jpg" alt="Resort-Name"/>
               <?php }?> 
                          
            </div>
         </div>
       </div>
       <div class="col-md-9 col-lg-10">
          <div class="title text-left">
            <h3>Review Resort</h3>
         </div>
        <?php if(isset($resort->id)){ ?><h2>
		  <a href="<?php echo base_url('resort-detail?resort_id='.base64_encode($resort->id)); ?>"><?php echo !empty($resort->resort_name)?ucfirst($resort->resort_name):'';?></a>
		  </h2>
		   <?php }else{echo " <span style='color:red; margin-bottom:25px; float:left;'> * No resort selected, Please select it before submiting </span>";}?> 
          <?php include('add_story.php'); ?>
       </div>
    </div>
  </div>
</section>
