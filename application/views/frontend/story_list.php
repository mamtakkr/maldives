<style type="text/css">
   .story_head{margin-bottom: 0px !important; }
</style>
<section class="bg-transparent">
   <div class="container-fluid p-0">
      <div class="page-wrapper">
         <div class="wrapper">
            <div class="card border-0">
               <div class="card-body p-0">  
                  <div class="container"> 
                     <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_resort_5">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="wizard-left pr-0">
                                 <h6>Traveller Stories</h6>
                                 <div class="clearfix"></div>
                                 <div class="row traveller_contribution more_less_desc4">
                                    <?php 
                                    if(!empty($storys)){
                                       foreach($storys as $story){?>
                                          <div class="col-md-12" id="story_<?php 
                                                echo !empty($story->id)?$story->id:'';
                                                ?>">
                                             <div class="add-resort-card">
                                                <div class="add-resort-card-left">
                                                <?php 
                                                $images = $this->common_model->get_result('images', array('item_id'=>$story->id, 'type'=>'traveller_story'));
                                                $img   = 0;
                                                if(!empty($images )){?>
                                                   <div class="resort-caption">
                                                      <div id="carouselExampleIndicators_<?php echo $story->id;?>" class="carousel slide" data-ride="carousel">
                                                         <ol class="carousel-indicators">
                                                            <?php 
                                                            if(!empty($images)){
                                                               foreach($images as $image){?>
                                                                  <li data-target="#carouselExampleIndicators_<?php echo $story->id;?>" data-slide-to="<?php echo $img; ?>" class="<?php echo ($img==0)?'active':''; ?>"></li>
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
                                                         <a class="carousel-control-prev" href="#carouselExampleIndicators_<?php echo $story->id;?>" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                         </a>
                                                         <a class="carousel-control-next" href="#carouselExampleIndicators_<?php echo $story->id;?>" role="button" data-slide="next">
                                                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                             <span class="sr-only">Next</span>
                                                         </a>
                                                      </div>
                                                   </div>
                                                <?php 
                                                }else{?>
                                                   <div class="resort-caption">
                                                      <img src="<?php echo base_url();?>assets/front/img/No_Image_Available.jpg" class="no-img"/>
                                                   </div>
                                             <?php } ?>
                                                </div>
                                             <div class="add-resort-card-right">
                                             <span class="villa-name-title">
                                                <?php 
                                                echo !empty($story->story_title)?$story->story_title:'';
                                                ?>
                                             </span>
                                             <p class="content-pera comment1 more1">
                                                <?php 
                                                echo !empty($story->my_experience)?ucfirst($story->my_experience):'';
                                                ?>                                          
                                             </p>
                                             <h4>Staff Makes Your Stay Memorable12</h4>
                                             <p class="content-pera">
                                                <?php 
                                                echo !empty($story->improved)?ucfirst($story->improved):'';
                                                ?>
                                             </p>
                                             <h4>Recommend This Resort/Hotel</h4>
                                                <p class="content-pera">
                                                   <?php 
                                                      echo !empty($story->recommend)?$story->recommend:'No';
                                                   ?>
                                                </p>
                                             <h4>Hear About This Hotel</h4>
                                                <p class="content-pera">
                                                   <?php 
                                                      echo !empty($story->hear_by_title)?$story->hear_by_title:'-';
                                                   ?>
                                                </p>
                                             <h4>Customer has been to maldives before</h4>
                                                <p class="content-pera">
                                                   <?php 
                                                      echo !empty($story->maldives_before_status)?ucfirst($story->maldives_before_status):'No';
                                                   ?>
                                                </p>
                                             <?php 
                                             if(!empty($story->maldives_before_status)&&$story->maldives_before_status=='yes'){?>
                                                <h4>Customer has been to this hotel before</h4>
                                                <p class="content-pera">
                                                   <?php 
                                                      echo !empty($story->hotel_before_status)?ucfirst($story->hotel_before_status):'No';
                                                   ?>
                                                </p> 
                                             <?php }
                                             if(!empty($story->how_many_times)){?>
                                                <h4>How Many Times</h4>
                                                <p class="content-pera">
                                                   <?php 
                                                      echo !empty($story->how_many_times)?$story->how_many_times:'0';
                                                   ?>
                                                </p> 
                                             <?php }?>
                                             <ul>
                                             <li>
                                                Resort : 
                                                <span>
                                                <?php 
                                                   echo !empty($story->resort_name)?$story->resort_name:'';
                                                ?>                              
                                                </span> 
                                             </li>                        
                                             <li>
                                                User : 
                                                <span>
                                                <?php 
                                                   echo !empty($story->first_name)?ucfirst($story->first_name):'';
                                                   echo !empty($story->last_name)?' '.ucfirst($story->last_name):'';
                                                ?>                                                   
                                                </span> 
                                                </li>                         
                                               <li>
                                                   Category : 
                                                  <span>
                                                   <?php 
                                                      echo !empty($story->category_name)?ucfirst($story->category_name):'';
                                                   ?>    
                                                   </span> 
                                             </li>  
                                             <li>
                                                Staff Friendliness: 
                                                <span>
                                                   <div class="traveller_star_rate">
                                                      <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->staff_friendliness&&!empty($story->staff_friendliness))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?> 
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>                        
                                             <li>
                                                Services : 
                                                <span>
                                                   <div class="traveller_star_rate">
                                                      <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->services&&!empty($story->services))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?> 
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>Villa & Suites : 
                                                <span>
                                                   <div class="traveller_star_rate">
                                                      <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->villa&&!empty($story->villa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>                        
                                              <li>
                                                Dine & Wine : 
                                                <span>
                                                   <div class="traveller_star_rate">
                                                      <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->dine_wine&&!empty($story->dine_wine))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?>
                                                   </ul>
                                                </div> 
                                                </span> 
                                             </li>                         
                                             <li>
                                                Spa  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                <?php 
                                                for($nu=1;$nu<=5;$nu++){
                                                   echo ($nu<=$story->spa&&!empty($story->spa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                }
                                                ?>
                                                </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Facilities  : 
                                               <span> 
                                                   <div class="traveller_star_rate">
                                                      <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->facilities&&!empty($story->facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Location  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                   <?php 
                                                      for($nu=1;$nu<=5;$nu++){
                                                         echo ($nu<=$story->location&&!empty($story->location))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                      }
                                                   ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Beach  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->beach&&!empty($story->beach))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Snorkeling  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                <?php 
                                                for($nu=1;$nu<=5;$nu++){
                                                   echo ($nu<=$story->snorkeling&&!empty($story->snorkeling))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                }
                                                ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Kids Facilities  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                   <?php 
                                                   for($nu=1;$nu<=5;$nu++){
                                                      echo ($nu<=$story->kids_facilities&&!empty($story->kids_facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                   }
                                                   ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Over All  : 
                                               <span> 
                                                <div class="traveller_star_rate">
                                                   <ul class="list-inline">
                                                      <?php 
                                                      for($nu=1;$nu<=5;$nu++){
                                                         echo ($nu<=$story->over_all&&!empty($story->over_all))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
                                                      }
                                                      ?>
                                                   </ul>
                                                </div>
                                                </span> 
                                             </li>
                                             <li>
                                                Verified By  : 
                                               <span> 
                                                <?php 
                                                   echo !empty($story->verified_by)?$story->verified_by:'Pending';
                                                ?>
                                                </span> 
                                             </li>
                                             </ul>      
                                             </div>
                                          </div>
                                          </div>
                                          <?php                     
                                       }
                                    }
                                    ?>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   function delete_story(story_id){
      alertify.confirm("Are you sure you want to delete this story?", function (e) {
         if (e) {       
            $.ajax({ 
               url:base_url+"home/delete_story",
               type:"POST",
               data:{story_id:story_id}, 
               success: function(html){
                  var response = $.parseJSON(html); 
                  if(response.status=='true'){
                     $('#story_'+story_id).hide(); 
                  }
               }                
            });
         }
      });
   }
</script>