<?php
   $user = user_info();
?>
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
                                 <div class="resort-title-card">
                                    <div class="row">
                                       <div class="col-7">
                                          <h6>Resort Stories</h6>
                                       </div>
                                       <div class="col-5 add-resort">
                                          <?php 
                                          if(!empty($user->user_type)&&$user->user_type==2){ ?>
                                             <a href="<?php echo base_url('user/add_resort_story'); ?>" class="btn btn-primary">
                                                Add Resort Story
                                             </a>
                                          <?php }?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div class="row">               
                                    <?php 
                                    if(!empty($storys)){
                                       foreach($storys as $story){?>
                                          <div class="col-md-12" id="story_<?php 
                                                echo !empty($story->id)?$story->id:'';
                                                ?>">
                                                <div class="add-resort-card">
                                                <div class="add-resort-card-left">
                                             <?php 
                                                echo (!empty($story->image_name)&&file_exists('uploads/resorts/'.$story->image_name))?'<img src="'.base_url('uploads/resorts/'.$story->image_name).'" />':'<img src="'.base_url('assets/front/images/upload-photo.png').'" />';
                                             ?>
                                             </div>
                                             <div class="add-resort-card-right">
                                             <span class="villa-name-title">
                                                <?php 
                                                echo !empty($story->title)?$story->title:'';
                                                ?>
                                             </span>
                                             <p>
                                                <?php 
                                                echo !empty($story->desciption)?$story->desciption:'';
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
                                                   Posted Date : 
                                                   <span>
                                                   <?php 
                                                      echo !empty($story->created_date)?date('d M Y h:i A', strtotime($story->created_date)):'';
                                                   ?>                              
                                                   </span> 
                                                </li>  
                                             </ul>                                      
                                             <a href="<?php echo base_url('user/add_resort_story?story_id='.base64_encode($story->id)); ?>" class="edit-icon">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                             </a>
                                             <a href="javascript:void(0);" onclick="delete_story('<?php 
                                                echo !empty($story->id)?$story->id:'';
                                                ?>');" class="delete-icon">
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
               url:base_url+"home/delete_resort_story",
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