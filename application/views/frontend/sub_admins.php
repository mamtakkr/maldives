<?php 
if(!empty($sub_admins)){
   foreach($sub_admins as $sub_admin){?>
      <div class="col-md-12" id="subadmin_<?php echo !empty($sub_admin->id)?$sub_admin->id:'';?>">
         <div class="add-resort-card">
            <!--<div class="add-resort-card-left card_left_blog">-->
            <div class="card_left_blog">    
               <?php 
               echo (!empty($sub_admin->profile_pic)&&file_exists('uploads/resorts/'.$sub_admin->profile_pic))?'<img src="'.base_url('uploads/resorts/'.$sub_admin->profile_pic).'" />':'<img src="'.base_url('assets/front/img/No_Image_Available.jpg').'" />';
                ?>
            </div>
            <div class="add-resort-card-right card_right_blog"> 
               <span class="villa-name-title">
               <?php 
                  echo !empty($sub_admin->first_name)?ucfirst($sub_admin->first_name):'';
               ?>
               </span>
               <div class="more_less_desc15">
                  <p class="comment more">
                     <?php 
                        echo !empty($sub_admin->email)?$sub_admin->email:'';
                     ?>
                  </p> 
               </div>                                    
               <a href="javascript:void(0);" onclick="add_sub_admin('<?php echo base64_encode($sub_admin->id) ?>');" class="edit-icon">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
               </a>
               <a href="javascript:void(0);" onclick="delete_sub_admin('<?php echo !empty($sub_admin->id)?$sub_admin->id:'';?>');" class="delete-icon">
                  <i class="fa fa-times-circle" aria-hidden="true"></i>
               </a>
            </div>
         </div>
      </div>
<?php                     
   }
}
?>