<?php
if(!empty($row->activities_image)){ 
   echo '<style type="text/css">
      #resort_activities_image_main_i .image-upload-wrap{ display:none;}
      #activities_image_main{ display:block;}
      #activities_image_main .file-upload-content{ display:block;}
   </style>';
}
?>
<div class="row" id="sortable">
   <?php 
   if(!empty($activitys)){
      foreach($activitys as $activity){?>
         <div class="col-md-12 cus_mov" id="activity_<?php 
               echo !empty($activity->id)?$activity->id:'';
               ?>">
            <div class="add-resort-card">
               <div class="add-resort-card-left">
            <?php 
               echo (!empty($activity->activities_image)&&file_exists('uploads/resorts/thumbnails/500_'.$activity->activities_image))?'<img src="'.base_url('uploads/resorts/thumbnails/500_'.$activity->activities_image).'" style="    max-width: 100%;" />':'<img src="'.base_url('assets/front/images/upload-photo.png').'" />';
            ?>
            </div>
            <input type="hidden" name="orders[]" value="<?php echo !empty($activity->id)?$activity->id:'';?>">
            <div class="add-resort-card-right">
            <span class="villa-name-title">
               <?php 
                  echo !empty($activity->name_of_activities)?$activity->name_of_activities:'';
               ?>
            </span>
            <p>
               <?php 
               echo !empty($activity->activities_description)?$activity->activities_description:'';
               ?>
            </p>
            <a href="javascript:void(0);" onclick="edit_activity('<?php 
               echo !empty($activity->id)?$activity->id:'';
               ?>');" class="edit-icon">
               <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a href="javascript:void(0);" onclick="delete_activity('<?php 
               echo !empty($activity->id)?$activity->id:'';
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
<div class="row">
   <div class="col-sm-12">
      <div class="resort-option">
         <div class="form-group">
            <label for="exampleInputEmail1">Name of activities </label>
            <input type="text" name="name_of_activities" value="<?php if(!empty($row->name_of_activities)){echo $row->name_of_activities;} ?>" class="form-control" placeholder="Enter here">
            <input type="hidden" name="activity_id" value="<?php if(!empty($row->id)){echo $row->id;} ?>">
         </div>
      </div>
      <div class="resort-option">
         <div class="form-group">
            <label for="exampleInputEmail1">Description: (max characters: 320)</label>
            <textarea rows="3" cols="40" type="text" name="activities_description" class="form-control" placeholder="Enter here" maxlength="320"><?php if(!empty($row->activities_description)){echo $row->activities_description;} ?></textarea>
         </div>
      </div> 
	  <div class="resort-option">
         <div class="form-group">
                        <label> Experience Categories </label>
                        <div class="row">
						<?php  $exp_categories =array();
						if(!empty($row->experience_category)){ $exp_categories = explode(",",$row->experience_category);}else{$exp_categories=array();}
                  if(!empty($experience_categories)) {
						foreach($experience_categories as $exp_cat){
							if(!empty($exp_categories)) {
								if(in_array($exp_cat->exp_cat_id,$exp_categories)){$checked = "checked";}else{$checked='';}
							}else{$checked='';}
							?>
							<div class="col-sm-6 col-md-4">
								<div class="tick">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="exp_cat_ids[]" id="exp_cat_ids_<?php echo $exp_cat->exp_cat_id; ?>" value="<?php echo $exp_cat->exp_cat_id; ?>"  <?php echo $checked;?>>
										<label class="custom-control-label" for="exp_cat_ids_<?php echo $exp_cat->exp_cat_id; ?>"><?php echo $exp_cat->exp_cat_name; ?> </label>
									</div>
								</div>
							</div>
						<?php } }?>
                        </div>
                     </div>
      </div>
   </div>
   <div class="col-sm-12">
      <div class="resort-option">
         <div class="form-group">
            <label>Add Image</label>
            <div class="upload-doc">
               <div class="form-group">
                  <div class="file-upload" id="resort_activities_image_main_i">
                     <div class="image-upload-wrap">
                        <input class="file-upload-input"  type='file' onchange="resortactivities_imageImgNew();" id="resortactivities_imageImg" />
                        <div class="drag-text">
                           <h3>
                              <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                              <div class="clearfix"></div>
                               Upload your photos
                              <div class="clearfix"></div>
                              <small>Just drop them here</small> 
                              <ul class="note-msg">
                                 <li>
                                    Upload Landscape Image
                                 </li>   
                                 <li>                                
                                    The photo should be <span>PNG</span>, <span>JPG</span> and <span> JPEG </span> file format
                                 </li> 
                                 <li>
                                    Photo need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels 
                                 <li>
                                    Photo can be maximum <span>10 MB</span> size
                                 </li>
                              </ul>
                           </h3>
                        </div>
                        <div class="new_loader" style="display: none;"></div>
                     </div>
                     <div id="activities_image_main">
                        <?php 
                        if(!empty($row->activities_image)&&file_exists('uploads/resorts/thumbnails/150_'.$row->activities_image)){
                           $randT      = rand(000,999).time();
                           $deletImg   = "deleteActivityMenu('".$randT."','".$row->activities_image."')"; 
                           $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$row->activities_image.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                           echo $html;
                        }
                        ?>
                     </div>
                     <div id="activities_image_error"></div>
                     <input type="hidden" name="resort_activities_image" id="resort_activities_image">
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>