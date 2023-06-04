<link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<style type="text/css">
   .rate_check{ color: orange;}
   .rate_check:hover{color: orange;}
   .remove_icon{ color: red;  display: none;}
   .bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: white;
}
.bootstrap-tagsinput{ 
  width: 100% !important; 
  height: auto;
  padding: .375rem .75rem !important;  
  background-clip: padding-box !important;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  line-height: 1.5 !important;
  font-size: 1rem !important;
  font-weight: 400;
}
.label-info {
    background-color: #5bc0de;
}
.bootstrap-tagsinput .label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
.story_tags input{ min-width: 70% }
</style>
<style type="text/css">
   .remove_icon{ color: red;  display: none;}
   <?php 
   if(!empty($row->memorable)&&$row->memorable=='yes'){
      echo '#mark_memorable_child{display: block}';
   }else{
      echo '#mark_memorable_child{display: none}';
   }
   ?>
</style>
<div class="resort-title-card">
   <div class="clearfix"></div>
   <div class="row">
   <div class="col-md-12">
      <div class="traveller_contribution">
         <form class="wizard-container" onsubmit="return false;" method="POST" action="" id="add_story_frm">
			<div class="row">
				<div class="col-md-6">
				<?php if($this->input->get('resort_id')!=''){?>
                  <input type="hidden" name="resort_id" id="resort_id" value="<?php 
                  if(!empty($row->resort_id)){
                    echo $row->resort_id;
                  }else if($this->input->get('resort_id')){
                    echo base64_decode($this->input->get('resort_id'));
                  }
                  ?>">
				  <?php }else { ?>
				  <select name="resort_id" id="resort_id" class="form-control required">
					<option value=''>Select Resort</option>
					<?php 
                  if(!empty($resort_list)) {
               foreach($resort_list as $rlist){ ?>
					<option value='<?php echo $rlist->id;?>'><?php echo $rlist->resort_name;?></option>
				  
				  <?php } }?>
				  </select>
				  <?php }				  ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix" style="margin-top:20px;"></div>
            <div id="add_story_data">
               <div class="row">
			   
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-lg-7 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Holiday Style
                                 </label>
                                 <select name="category_id" class="form-control">
                                    <option value=""> Select Category</option>
                                    <?php
                                    if(!empty($categorys)){
                                       foreach ($categorys as $category) {
                                          if(!empty($row->category_id)&&$row->category_id==$category->id){
                                             echo '<option selected value="'.$category->id.'">'.$category->category_name.'</option>';
                                          }else{
                                             echo '<option value="'.$category->id.'">'.$category->category_name.'</option>';
                                          }
                                       }
                                    }
                                    ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Stayed in
                                 </label>
                                 <input type="text" class="form-control datetimepicker1" placeholder="Enter date" name="traveller_date" value="<?php echo !empty($row->traveller_date)?$row->traveller_date:''; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-10 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Number of nights stayed?<span class="text-danger">*</span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <div class="form-group">
                                    <select name="nights_stayed" class="form-control">
                                       <?php 
                                       for($ti=1;$ti<100;$ti++){
                                          echo '<option value="'.$ti.'">'.$ti.'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <input type="text" name="story_title" class="form-control" value="<?php echo !empty($row->story_title)?$row->story_title:''; ?>" placeholder="Give a title to your review">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <textarea rows="4" name="my_experience" placeholder="Share your experience with this resort" class="form-control"><?php echo !empty($row->my_experience)?$row->my_experience:''; ?></textarea>
                              </div>
                           </div>
                        </div>   
                        <div class="col-lg-6 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                     How did you book your stay? <span class="text-danger">*</span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <div class="form-group">
                                    <select name="hear_by" class="form-control">
                                       <option value=""> Select </option>
                                       <?php
                                       if(!empty($hear_by)){
                                          foreach ($hear_by as $hear_by_row) {
                                             if(!empty($row->hear_by)&&$row->hear_by==$hear_by_row->id){
                                                echo '<option selected value="'.$hear_by_row->id.'">'.$hear_by_row->hear_by.'</option>';
                                             }else{
                                                echo '<option value="'.$hear_by_row->id.'">'.$hear_by_row->hear_by.'</option>';
                                             }
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div> 
                        <div class="col-lg-10 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                     Number of visits to Maldives?<span class="text-danger">*</span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <div class="form-group">
                                    <select name="maldives_visits" class="form-control">
                                       <?php 
                                       for($ti=1;$ti<100;$ti++){
                                          echo '<option value="'.$ti.'">'.$ti.'</option>';
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div> 
                        <div class="col-lg-10 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                    Number of visits to this resort/hotel? <span class="text-danger">*</span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <div class="form-group">
                                    <select name="hotel_visits" class="form-control">
                                    <?php 
                                    for($ti=1;$ti<100;$ti++){
                                       echo '<option value="'.$ti.'">'.$ti.'</option>';
                                    }
                                    ?>
                                 </select>
                                 </div>
                              </div>
                           </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                   Villa & Suite <span class="text-danger">*</span>
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <div class="form-group">
                                    <select name="villa_id" class="form-control">
                                       <option value=""> Select Villa</option>
                                       <?php
                                       if(!empty($villas)){
                                          foreach ($villas as $villa) {
                                             if(!empty($row->villa_id)&&$row->villa_id==$villa->id){
                                                echo '<option selected value="'.$villa->id.'">'.$villa->name_of_villa.'</option>';
                                             }else{
                                                echo '<option value="'.$villa->id.'">'.$villa->name_of_villa.'</option>';
                                             }
                                          }
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div> 
                        <div class="col-lg-6 col-md-12 col-12">
                           <div class="form-group">
                              <label for="exampleInputEmail1">
                               Did any staff make your stay more memorable ?
                              </label>
                           </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12">
                           <div class="form-group">
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-sm-6">
                                       <div class="tick">
                                          <div class="custom-control custom-radio">
                                             <input type="radio" id="recommend1" name="memorable" onclick="mark_memorable('1');"  class="custom-control-input" value="1">
                                             <label class="custom-control-label" for="recommend1">Yes </label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6">
                                       <div class="tick">
                                          <div class="custom-control custom-radio">
                                             <input onclick="mark_memorable('2');" type="radio" id="recommend2" name="memorable" class="custom-control-input" value="0" checked="">
                                             <label class="custom-control-label" for="recommend2">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12" id="mark_memorable_child">
                           <div class="resort-option story_tags">
                              <div class="form-group">
                                 <input type="text" data-role="tagsinput" name="staff_name" placeholder="Would you like to recognize their names?" class="form-control" value="<?php echo !empty($row->staff_name)?$row->staff_name:''; ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 rate">
                     <h6 class=" mt-0">
                        Rate Your Stay
                       
                     </h6>
                      <div class="clearfix"></div>
                        <small class="mb-4 pull-left" style="color:#888;">Don't fill if you haven't experienced any service</small>
                     <div class="clearfix"></div>
                     <div class="row">
                        <div class="col-md-6 ">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Staff Friendliness 
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="staff_friendliness" type="hidden" value="<?php echo !empty($row->staff_friendliness)?$row->staff_friendliness:''; ?>" id="staff_friendliness">
                                 <?php
                                 for($co=1;$co<=5;$co++){
                                    if(!empty($row->staff_friendliness)&&$co<=$row->staff_friendliness){?>
                                    <a href="javascript:void(0);" id="staff_friendliness_<?php echo $co; ?>" onclick="set_rate('staff_friendliness', '<?php echo $co; ?>');"  class="rate_check">
                                       <i class="fa fa-star"></i>
                                    </a>
                                 <?php 
                                 }else{?>
                                    <a href="javascript:void(0);" id="staff_friendliness_<?php echo $co; ?>" onclick="set_rate('staff_friendliness', '<?php echo $co; ?>');">
                                       <i class="fa fa-star-o"></i>
                                    </a>
                                 <?php }
                                    } ?>
                                    <a href="javascript:void(0);" id="staff_friendliness_remove" onclick="set_rate('staff_friendliness', '0');" class="remove_icon">
                                       <i class="fa fa-times"></i>
                                    </a>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Services
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="services" type="hidden" value="<?php echo !empty($row->services)?$row->services:''; ?>" id="services">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->services)&&$co<=$row->services){?>
                                 <a href="javascript:void(0);" id="services_<?php echo $co; ?>" onclick="set_rate('services', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="services_<?php echo $co; ?>" onclick="set_rate('services', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>  
                                 <a href="javascript:void(0);" id="services_remove" onclick="set_rate('services', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a>                                           
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Villa & Suites
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="villa" type="hidden" value="<?php echo !empty($row->villa)?$row->villa:''; ?>" id="villa">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->villa)&&$co<=$row->villa){?>
                                 <a href="javascript:void(0);" id="villa_<?php echo $co; ?>" onclick="set_rate('villa', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="villa_<?php echo $co; ?>" onclick="set_rate('villa', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="villa_remove" onclick="set_rate('villa', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a>  
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Dine & Wine
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="dine_wine" type="hidden" value="<?php echo !empty($row->dine_wine)?$row->dine_wine:''; ?>" id="dine_wine">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->dine_wine)&&$co<=$row->dine_wine){?>
                                 <a href="javascript:void(0);" id="dine_wine_<?php echo $co; ?>" onclick="set_rate('dine_wine', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="dine_wine_<?php echo $co; ?>" onclick="set_rate('dine_wine', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="dine_wine_remove" onclick="set_rate('dine_wine', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Spa
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="spa" type="hidden" value="<?php echo !empty($row->spa)?$row->spa:''; ?>" id="spa">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->spa)&&$co<=$row->spa){?>
                                 <a href="javascript:void(0);" id="spa_<?php echo $co; ?>" onclick="set_rate('spa', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="spa_<?php echo $co; ?>" onclick="set_rate('spa', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="spa_remove" onclick="set_rate('spa', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Facilities
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="facilities" type="hidden" value="<?php echo !empty($row->facilities)?$row->facilities:''; ?>" id="facilities">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->facilities)&&$co<=$row->facilities){?>
                                 <a href="javascript:void(0);" id="facilities_<?php echo $co; ?>" onclick="set_rate('facilities', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="facilities_<?php echo $co; ?>" onclick="set_rate('facilities', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="facilities_remove" onclick="set_rate('facilities', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Location
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="location" type="hidden" value="<?php echo !empty($row->location)?$row->location:''; ?>" id="location">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->location)&&$co<=$row->location){?>
                                 <a href="javascript:void(0);" id="location_<?php echo $co; ?>" onclick="set_rate('location', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="location_<?php echo $co; ?>" onclick="set_rate('location', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="location_remove" onclick="set_rate('location', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Beach
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="beach" type="hidden" value="<?php echo !empty($row->beach)?$row->beach:''; ?>" id="beach">
                                 <?php
                                 for($co=1;$co<=5;$co++){
                                    if(!empty($row->beach)&&$co<=$row->beach){?>
                                       <a href="javascript:void(0);" id="beach_<?php echo $co; ?>" onclick="set_rate('beach', '<?php echo $co; ?>');"  class="rate_check">
                                          <i class="fa fa-star"></i>
                                       </a>
                                 <?php 
                                    }else{?>
                                    <a href="javascript:void(0);" id="beach_<?php echo $co; ?>" onclick="set_rate('beach', '<?php echo $co; ?>');">
                                       <i class="fa fa-star-o"></i>
                                    </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="beach_remove" onclick="set_rate('beach', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Kids Facilities
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="kids_facilities" type="hidden" value="<?php echo !empty($row->kids_facilities)?$row->kids_facilities:''; ?>" id="kids_facilities">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->over_all)&&$co<=$row->over_all){?>
                                 <a href="javascript:void(0);" id="kids_facilities_<?php echo $co; ?>" onclick="set_rate('kids_facilities', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="kids_facilities_<?php echo $co; ?>" onclick="set_rate('kids_facilities', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="kids_facilities_remove" onclick="set_rate('kids_facilities', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label for="exampleInputEmail1">
                                 Snorkeling
                                 </label>
                                 <div class="clearfix"></div>
                                 <input name="over_all" type="hidden" value="<?php echo !empty($row->over_all)?$row->over_all:''; ?>" id="over_all">
                                 <?php
                                    for($co=1;$co<=5;$co++){
                                       if(!empty($row->over_all)&&$co<=$row->over_all){?>
                                 <a href="javascript:void(0);" id="over_all_<?php echo $co; ?>" onclick="set_rate('over_all', '<?php echo $co; ?>');"  class="rate_check">
                                 <i class="fa fa-star"></i>
                                 </a>
                                 <?php 
                                    }else{?>
                                 <a href="javascript:void(0);" id="over_all_<?php echo $co; ?>" onclick="set_rate('over_all', '<?php echo $co; ?>');">
                                 <i class="fa fa-star-o"></i>
                                 </a>
                                 <?php }
                                    } ?>
                                 <a href="javascript:void(0);" id="over_all_remove" onclick="set_rate('over_all', '0');" class="remove_icon">
                                    <i class="fa fa-times"></i>
                                 </a> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="resort-option">
                              <div class="form-group">
                                 <label>Upload Images</label>
                                 <div class="upload-doc">
                                    <div class="form-group">
                                       <div class="file-upload" id="story_images_main_i">
                                          <div class="clearfix"></div>
                                          <div class="image-upload-wrap">
                                             <input class="file-upload-input" type='file' onchange="storyImagesImgNew();" accept="image/*" id="storyImagesImg" multiple="multiple" />
                                             <div class="drag-text">
                                                <h3>
                                                   <img src="<?php echo  FRONT_THEAM_PATH ;?>images/resort-pic.png">
                                                   <div class="clearfix"></div>
                                                   Upload your Images
                                                   <div class="clearfix"></div>
                                                   <small>Just drop them here</small> 
                                                </h3>
                                             </div>
                                          </div>
                                          <div id="story_images_error" class="error"></div>
                                          <div id="story_images_main">
                                           <?php 
                                           if(!empty($images)){ 
                                             foreach ($images as $image) {
                                               if(!empty($image->image_name)&&file_exists('uploads/resorts/'.$image->image_name)){
                                                   $randT      = rand(000,999).time();
                                               $deletImg   = "deleteStoryImage('".$randT."','".$image->image_name."', '".$image->id."')";
                                                   $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                                 echo $html;
                                               }
                                             }
                                           }
                                           ?>
                                          </div>
                                          <input type="hidden" name="story_images" id="story_images">
                                          <input type="hidden" id="storyImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                                       </div>
                                       <small class="color-gry">
                                         Upload up to 10 images
                                       </small> 
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class=" col-md-12"> 
                  <input type="hidden" name="story_id" id="story_id" value="<?php echo !empty($row->id)?$row->id:'';?>">
				  
                  <button type="submit" class="btn-next pull-right mt-4">
                     Submit
                  </button>
               </div>
               </div>
               <div id="add_story_res"></div>
            </div>
         </form>
      </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  <?php
  if(!empty($images)){ ?>
    setTimeout(function(){ $('#story_images_main .file-upload-content').show(); }, 1000);
  <?php } ?>
   function set_rate(category_id,rate){
      $('#'+category_id).val(rate);
      for(rt=1;rt<=5;rt++){
         if(rt<=rate){
            $('#'+category_id+'_'+rt).addClass('rate_check').html('<i class="fa fa-star"></i>');
         }else{
            $('#'+category_id+'_'+rt).removeClass('rate_check').html('<i class="fa fa-star-o"></i>');
         }
      }
      if(parseInt(rate)>parseInt(0)){
         $('#'+category_id+'_remove').show();
      }else{
         $('#'+category_id+'_remove').hide();
      }
   }
   $('#add_story_frm').validate({
      rules: {
         category_id: {required: true},
         story_title: {required: true},
         my_experience: {required: true},
         improved: {required: true},
      },
      messages: {
         category_id:{ required:"The category is required"},
         story_title:{ required:"The story title is required"},
         my_experience:{ required:"The my experience is required"},
         improved:{ required:"The improved is required"},
      },
      submitHandler: function(form) {
         $.ajax({ 
            url:base_url+"user/add_story_res",
            type:"POST",
            data:$("#add_story_frm" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.type=='add'&&response.status=='true'){
                  $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
                  $("#add_story_frm")[0].reset();
                  set_rate('staff_friendliness', 0);
                  set_rate('services', 0);
                  set_rate('villa', 0);
                  set_rate('dine_wine', 0);
                  set_rate('spa', 0);
                  set_rate('facilities', 0);
                  set_rate('location', 0);
                  set_rate('beach', 0);
                  set_rate('snorkeling', 0);
                  set_rate('kids_facilities', 0);
                  set_rate('over_all', 0);
                  $('#story_images').val(''); 
                  $('#story_images_main').html(''); 
                  $('#contribution_list').html(response.contributions_list);  
                  $('#contribution_list').show();          
                  $('#add_contribution').hide();
                  setTimeout(function(){ window.location.href="<?php echo base_url('user/dashboard'); ?>"; }, 1500);     
               }else if(response.status=='true'){
                  $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-success" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');
                  setTimeout(function(){ window.location.href="<?php echo base_url('user/dashboard'); ?>"; }, 1500);
                  
               }else{ 
                  $('#add_story_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>'); 
               }
            }                
         });
      }
   }); 
   function storyImagesImgNew(){
      var files           = document.getElementById('storyImagesImg').files;
      var resortImgCount  = $('#storyImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>10){
         $('#story_images_error').show().html('You can`t upload more than 10 images');
         $('.loader_profile_left').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
            formData.append('traveller_story_image_pic', 'yes');   
            xhr.open("POST", "<?php echo base_url('home/uploadPics'); ?>");
               xhr.upload.onprogress = function(e) {
               if (e.lengthComputable) {     
                  var percentComplete = (e.loaded / e.total) * 100; 
               }
            };
            xhr.onload = function() {
               if (this.status == 200) {
                  var resp = this.response;
                  res = JSON.parse(resp); 
                  if(res.statuss=='true'){
                     $('#story_images_main').append(res.html);
                     var filenames = $('#story_images').val();
                     if(filenames!=''){
                         $('#story_images').val(filenames+','+res.file_name);
                     }else{
                        $('#story_images').val(res.file_name);
                     }
                     $('#story_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#storyImagesCount').val())+parseInt(1);  
                     $('#storyImagesCount').val(resortImgCount);
                     $('#story_images_error').hide();
                     /*$('#story_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#story_images_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
   }
   function deleteStoryImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#storyImagesCount').val())-parseInt(1);  
            $('#storyImagesCount').val(resortImgCount);
            var all_images = $('#story_images').val(); 
            imageName      = '';
            images = all_images.split(',');
            for(var im=0; im<images.length; im++){
               console.log('imagesss s'+images[im]);
               if(images[im]&&images[im]!=imageold){
                  imageName +=','+images[im];
               }
            }
            $.ajax({ 
               url:base_url+"home/deleteResortImage/"+imageDBID,
               type:"GET",
               success: function(html){}                 
            });
            $('#story_images').val(imageName);
         }
      });
   }  
   function mark_memorable(status=''){
      if(status=='1'){
         $('#mark_memorable_child').show();
      }else{
         $('#mark_memorable_child').hide();
      }
   }
</script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>