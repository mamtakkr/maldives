
 <div class="row">
<?php
if(!empty($dinnings)){
   foreach($dinnings as $dinning){
      $meal_serveds = $this->developer_model->get_dinnings_meal_served($dinning->id);
      
      $imagesD = $this->common_model->get_result('images', array('item_id'=>$dinning->id, 'type'=>'dinning'));
      ?>
    <div class="col-lg-4 col-md-6 new_dinning_as">  
      <div class=" mb-5 p-2 accommodation-villa">
         <div class="col-lg-12 col-md-12 new_dinning_star">
            <div class="accommodation-slider owl-carousel">
               <?php 
               $s=0; 
               if(!empty($imagesD)) {
                  foreach($imagesD as $img){
                     if($s==0){ $carousel_item_active = 'active';}else{$carousel_item_active = '';}?>

                        <div class="item">
                           <?php 
                              if(!empty($img->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$img->image_name)){?>
                                 <img class="owlsliderimage" data-thumb='<img src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$img->image_name ;?>" />'  src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$img->image_name ;?>" alt="thumbImage1.png">
                  <?php       } else{ ?>
                                 <img class="owlsliderimage" data-thumb='<img src="<?php echo  FRONT_THEAM_PATH;?>/images/instagram-pic1.jpg" />'  src="<?php echo  FRONT_THEAM_PATH;?>/images/instagram-pic1.jpg" alt="thumbImage1.png">
                                 <?php 
                              } ?>
                        </div>
                  <?php $s++;} }?>
            </div>
         </div>
         
         <div class="col-lg-12 col-md-12 new_dinning_text">
		 <div class="img-bottom-contianer inspiration-readmore3 accommodation-villa ">
            <div class="img-bottom-contianer-description smalldesc">
            <div class="py-2 px-3">
               <div class="accommodation-villa-title"><?php echo !empty($dinning->name_of_restaurant)?ucfirst($dinning->name_of_restaurant):'';?></div>
               <div class="accommodation-villa-description mb-2">Restaurant
               </div>
               <div class="des_dinner">
                 <p class="accommodation-villa-text"><?php echo !empty($dinning->description)?ucfirst($dinning->description):'';?></p>
               </div>
               <hr />
                <h6 class="good_to_know">GOOD TO KNOW</h6>
               <div class="row">
                <div class="col-lg-12 new_dinner_&_lunch">    
                  <?php 
                //   echo "<pre>"; var_dump($meal_serveds);
                     if(!empty($meal_serveds)){
                        foreach($meal_serveds as $meal_served){
                           if(!empty($meal_served->meals_styles_title)){
                              $meal_served_st = 0;
                              if(!empty($meal_served->menu_chart)&&file_exists('uploads/resorts/'.$meal_served->menu_chart)){                                 
                                 $file_types = explode('.', $meal_served->menu_chart); 
                                 $file_type  = strtolower(end($file_types));
                                 $meal_served_st = 1;
                              }
                                 ?>
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                       <div class="row accommodation-villa-items">
                                          <div class="col-lg-12 col-12 col-md-6 accommodation-villa-item my-1"><span class="accommodation-villa-title"><?php echo !empty($meal_served->meal_served_title)?$meal_served->meal_served_title:''; ?> :</span><span class="accommodation-villa-text"> <?php echo !empty($meal_served->meals_styles_title)?$meal_served->meals_styles_title:''; ?></span></div>
                                       </div>
                                       <div class="accommodation-villa-text">
                                       <?php 
                                          if($meal_served->no_time=="1") {
                                             echo "no opening or closing time";
                                          } else {
                                             if(empty($meal_served->open_hour)&&empty($meal_served->open_minut)&&empty($meal_served->closing_hour)&&empty($meal_served->closing_minut)){    
                                                echo '';                                         
                                             }else{
                                                if(!empty($meal_served->open_hour)){
                                                   echo ($meal_served->open_hour<9)?'0'.$meal_served->open_hour:$meal_served->open_hour; 
                                                }else{echo '00'; }?>:
                                                <?php echo !empty($meal_served->open_minut)?ucfirst($meal_served->open_minut):'00'; ?> to 
                                                <?php 
                                                if(!empty($meal_served->closing_hour)){
                                                   echo ($meal_served->closing_hour<9)?'0'.$meal_served->closing_hour:$meal_served->closing_hour; 
                                                }else{echo '00'; }
                                                ?>:<?php echo !empty($meal_served->closing_minut)?ucfirst($meal_served->closing_minut):'00';
                                             }
                                          }
                                          ?>
                                       </div>
                                        
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <?php if($meal_served->meal_served_status==12){?>
                                            <div class="col-xl-8 col-lg-5 col-6 new_beverage">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#dining_menu" type="button" onclick="dining_menu('<?php echo !empty($meal_served->id)?$meal_served->id:''; ?>');">Beverage</a>
                                            </div>  
                                            <?php }else{ ?>
                                            <div class="col-xl-4 col-lg-5 col-6 mene_menu">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#dining_menu" type="button" onclick="dining_menu('<?php echo !empty($meal_served->id)?$meal_served->id:''; ?>');">Menu</a>
                                            </div>
                                            <?php } ?>
                                        </div>    
                                    </div> 
                                </div>
                                 <?php 
                              }
                           }
                        }
                     ?>
                     </div>
                    <!-- <div class="col-lg-6 mene_menu">-->
                    <!--     <a href="javascript:void(0);" data-toggle="modal" data-target="#dining_menu" type="button" onclick="dining_menu('<?php echo !empty($dinning->id)?$dinning->id:''; ?>');">Menu</a>-->
                    <!--</div>     -->
               </div>
               
               <div class="accommodation-villa-bottom-links mt-3">
                  <div class="row">
                     <div class="col-lg-5 accommodation-villa-title new_dress">Dress Code:</div>
                     <div class="col-lg-7 accommodation-villa-text"><?php echo !empty($dinning->dn_dress_code)?ucfirst($dinning->dn_dress_code):''; ?></div>
                  </div>
                  <div class="row">
                     <div class="col-lg-5 accommodation-villa-title new_dress">Meal Plans:</div>
                     <div class="col-lg-7 accommodation-villa-text"><?php echo !empty($dinning->dn_meal_plans)?ucfirst($dinning->dn_meal_plans):''; ?></div>
                  </div>
               </div>
            </div>
            </div>
			<div class="card-read-more-container">
				<a href="#" class="card-read-more3 btn">Read More</a>
			</div>
         </div>
         </div>
      </div>
      </div>
      <?php
   }
} else{
		   echo '<div class="not-found">
				   
					 <div class="clearfix"></div>
				   <h4>All Dine & Vine Filtered Out!</h4>
					<span>We couldn’t find any dine & vine matching the criteria. Please remove the filters applied and try again.</span>
				</div>';
		}
?>


        <div style="clear:both;"></div>
	  	<?php 
		
		if(!empty($dinning_count)&&$dinning_count>3){?>
		<div class="col-12">
            <div class="text-center" style="margin:0 auto;padding:50px 0px;">
                  <button type="button" class="btn btn-primary discover-more-btn" onclick="show_all_dinnings();">Discover More</button>
            </div>
        </div>    
      <?php }?>
   </div>   


<div class="modal fade" id="dining_menu" tabindex="-1" role="dialog" aria-labelledby="dining_menu" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="dining_menu_details_img">Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class="img_new_dining" id="dining_menu_details_data">
      		    <!--<img src="http://demogswebtech.com/maldives/uploads/resorts/thumbnails/500_7785dc97bed9031ca2db2aff0b510389.jpg">-->
      		</div>
		</div>
	</div>
</div>



<script type="text/javascript">
   $(document).ready(function() {
      var showChar = 330;
      var ellipsestext = "...";
      var moretext = "more";
      var lesstext = "less";
      $('.accommodation-slider').owlCarousel({
         autoplay: false,
         autoplayTimeout: 4000,
         loop: true,
         items: 1,
         center: true,
         nav: true,
         thumbs: true,
         thumbImage: true,
         thumbsPrerendered: true,
         thumbContainerClass: 'owl-thumbs',
         thumbItemClass: 'owl-thumb-item',
         navText:['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">','<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
      })
      $('.more').each(function() {
         var content = $(this).html();
         if(content.length > showChar) {
           var c = content.substr(0, showChar);
           var h = content.substr(showChar-1, content.length - showChar);
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
   
    $('.inspiration-readmore3').find('.card-read-more3').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more3').text(this.expand?"Hide Content":"Read More");
        $('.inspiration-readmore3').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
    
    function dining_menu(dinning_id) {
        $.ajax({ 
              url:"<?php echo base_url();?>home/dining_menu",
              type:"GET",
              data:{dinning_id:dinning_id}, 
              success: function(html){
    			  $('#dining_menu_details_data').html(html);
              }                
        }); 
   }
</script>