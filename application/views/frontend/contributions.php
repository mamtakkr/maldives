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
                                 <div class="row traveller_contribution">
                                    <?php 
                                    if(!empty($storys)){
                                       foreach($storys as $story){?>
                                          <div class="col-md-12" id="story_<?php echo !empty($story->id)?$story->id:'';?>">
                                             <div class="add-resort-card">
                                                <div class="add-resort-card-left">
                                                <?php 
                                                   echo (!empty($story->resort_logo)&&file_exists('uploads/resorts/'.$story->resort_logo))?'<img src="'.base_url('uploads/resorts/'.$story->resort_logo).'" />':'<img src="'.base_url('assets/front/images/upload-photo.png').'" />';
                                                ?>
                                                </div>
                                                <div class="add-resort-card-right">
                                                <span class="villa-name-title">
                                                   <?php 
                                                   echo !empty($story->story_title)?$story->story_title:'';
                                                   ?>
                                                </span>
                                                <h6 class="story_head">My Experience</h6>
                                                <p>
                                                   <?php 
                                                   echo !empty($story->my_experience)?$story->my_experience:'';
                                                   ?>
                                                </p>
                                                <h6 class="story_head">What Can Be Improved</h6>
                                                <p>
                                                   <?php 
                                                      echo !empty($story->improved)?$story->improved:'';
                                                   ?>
                                                </p>
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
                                             <!-- <li>
                                                Verified By  : 
                                               <span> 
                                                <?php 
                                                   echo !empty($story->verified_by)?$story->verified_by:'Pending';
                                                ?>
                                                </span> 
                                             </li> -->
                                             </ul>                                             
                                             <a href="<?php echo base_url('user/add_story?story_id='.base64_encode($story->id)); ?>" class="edit-icon">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                             </a>
                                             <a href="javascript:void(0);" onclick="delete_story('<?php echo !empty($story->id)?$story->id:'';?>');" class="delete-icon">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                             </a>
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