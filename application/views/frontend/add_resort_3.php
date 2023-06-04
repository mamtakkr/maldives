<form class="wizard-container new_wized" onsubmit="return false;" method="POST" action="" id="add_resort_3">
   <div class="row">
      <div class="col-md-12">
         <div class="wizard-left pr-0">
            <h6>Step 3: Resort Information</h6>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-md-12">
                  <div class="resort-option">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <label for="exampleInputEmail1"> Distance to Velana International Airport (in kms)</label>
                              <input type="text" name="distance_to_closest_international_airport" value="<?php if(!empty($row->distance_to_closest_international_airport)){echo $row->distance_to_closest_international_airport;} ?>" class="form-control only_number" placeholder="Enter here" maxlength="4">
                           </div>
                        </div>
                        <div class="col-md-6" style="display:none;">
                           <div class="form-group">
                              <label for="exampleInputEmail1">Opening date</label>
                              <span class="text-danger">*</span>
                              <input type="text" class="form-control datetimepicker1" name="opening_date" id="opening_date" value="<?php if(!empty($row->opening_date)){echo $row->opening_date;}?>">
                              <span class="date-icon"><i class="fa fa-calendar-o" aria-hidden="true"></i> </span> 
                           </div>
                        </div>
                        <div class="col-md-6" style="display:none;">
                           <div class="form-group" style="display:none;">
                              <label for="exampleInputEmail1">
                                 Last renovated date
                              </label>
                              <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="renovated_date">
                                 <option value="">Year</option>
                                 <?php 
                                 $minYr = date('Y')-50;
                                 for($yr=date('Y');$yr>$minYr;$yr--){
                                    if(!empty($row->renovated_date)&&$row->renovated_date==$yr){
                                       echo '<option selected="selected" value="'.$yr.'">'.$yr.'</option>';
                                    }else{
                                       echo '<option value="'.$yr.'">'.$yr.'</option>';
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Google maps location</label>
                        <input type="text" id="full_location" name="maps_location" class="form-control"  placeholder="Enter a location" value="<?php if(!empty($row->maps_location)){echo $row->maps_location;}?>" autocomplete="off" aria-required="true" aria-invalid="false">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
               <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1">Do you arrange transfers for night international flights?</label>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="tick">
                                    <div class="custom-control custom-radio">
                                       <input type="radio" id="transfers_for_night_international_flights1" name="transfers_for_night_international_flights" class="custom-control-input" <?php if(!empty($row->transfers_for_night_international_flights)&&$row->transfers_for_night_international_flights==1){echo 'checked';} ?> value="1">
                                       <label class="custom-control-label" for="transfers_for_night_international_flights1">Yes</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="tick">
                                    <div class="custom-control custom-radio">
                                       <input type="radio" id="transfers_for_night_international_flights2" name="transfers_for_night_international_flights" value="2" class="custom-control-input" <?php if(!empty($row->transfers_for_night_international_flights)&&$row->transfers_for_night_international_flights==2){echo 'checked';} ?>>
                                       <label class="custom-control-label" for="transfers_for_night_international_flights2">No</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> Distance to closest Domestic airport (in kms)</label>
                        <input type="text" name="distance_to_closest_domestic_airport" value="<?php if(!empty($row->distance_to_closest_domestic_airport)){echo $row->distance_to_closest_domestic_airport;} ?>" class="form-control only_number" placeholder="Enter here" maxlength="4">
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> Name to closest Domestic airport</label>
                        <input type="text" name="name_to_closest_domestic_airport" value="<?php if(!empty($row->name_to_closest_domestic_airport)){echo $row->name_to_closest_domestic_airport;} ?>" class="form-control" placeholder="Enter here">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group" style="display:none;">
                        <label for="exampleInputEmail1">Diving Centre name </label>
                        <input type="text" name="diving_centre_name" value="<?php //if(!empty($row->diving_centre_name)){echo $row->diving_centre_name;} ?>" class="form-control" placeholder="Enter here">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label> Upload Factsheet </label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="factsheet_main_i">
                                 <div class="clearfix"></div>
                                 <div class="image-upload-wrap ">
                                    <input class="file-upload-input"  type='file' id="FactsheetImg" onchange="uploadFactsheet();"/>
                                    <div class="drag-text">
                                       <h3>
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                          <div class="clearfix"></div>
                                          Upload your factsheet
                                          <div class="clearfix"></div>
                                          <small>Just drop them here</small> 
                                          <ul class="note-msg">
                                             <li>                                
                                                The factsheet should be only <span>PDF</span> file format
                                             </li> 
                                             <li>
                                               Factsheet can be maximum <span>10 MB</span> size
                                             </li>
                                          </ul>
                                       </h3>
                                    </div>
                                    <div class="new_loader" style="display: none;"></div>
                                 </div>
                                 <div id="factsheet_main">
                                    <?php 
                                    if(!empty($row->factsheet)&&file_exists('uploads/resorts/'.$row->factsheet)){
                                       $randT      = rand(000,999).time();
                                       $deletImg   = "deletefactsheet('".$randT."','".$row->factsheet."')"; 
                                       $html       = '<div id="'.$randT.'" class="file-upload-content">';
                                       $fileTypes  = explode('.', $row->factsheet);
                                       $fileType   = strtolower(end($fileTypes)); 
                                       $randT      = rand(000,999).time();
                                       if($fileType=='pdf'){                           
                                          $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->factsheet.'" alt="resort affiliation"></iframe>';
                                       }else{
                                          $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->factsheet.'" alt="resort factsheet">';
                                       }
                                       $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                       echo $html;
                                    }
                                    ?>
                                 </div>
                                 <div id="factsheet_error"></div>
                                 <input type="hidden" name="factsheet" id="factsheet">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label>Upload Resort map </label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="resort_map_data_main_i">                             
                                 <div class="image-upload-wrap" id="resort_map_main_file">
                                    <input id="resortMapImg" onchange="resortMapImgNew();" class="file-upload-input"  type='file'/>
                                    <div class="drag-text">
                                       <h3>
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                          <div class="clearfix"></div>
                                          Upload your resort map
                                          <div class="clearfix"></div>
                                          <small>Just drop them here</small> 
                                          <ul class="note-msg">
                                             <li>                                
                                                Upload Landscape Image
                                             </li> 
                                            <li>                                
                                               The resort map should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span>, <span> PDF </span> file format
                                            </li> 
                                            <li>
                                               Resort map need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                                            </li> 
                                            <li>
                                              Resort map can be maximum <span>10 MB</span> size
                                            </li>
                                          </ul>
                                       </h3>
                                    </div>
                                    <div class="new_loader1" style="display: none;"></div>
                                 </div>
                                 <div id="resort_map_img_main">
                                    <?php 
                                    if(!empty($row->resort_map)&&file_exists('uploads/resorts/'.$row->resort_map)){
                                       $fileTypes  = explode('.', $row->resort_map);
                                       $fileType   = strtolower(end($fileTypes)); 
                                       $randT      = rand(000,999).time();
                                       $deletImg   = "deleteResortMap('".$randT."','".$row->resort_map."')"; 
                                       $html       = '<div id="'.$randT.'" class="file-upload-content">';
                                       if($fileType=='pdf'){       
                                          $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->resort_map.'" alt="resort affiliation"></iframe>';
                                       }else{
                                          $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->resort_map.'" alt="resort affiliation">';
                                       }
                                       $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                       echo $html;
                                    }
                                    ?>
                                 </div>
                                 <div id="resort_map_img_error"></div>
                                 <input type="hidden" name="resort_map" id="resort_map">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label> Upload Resort Brochure</label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="resort_brochure_main_i">
                                 <div class="clearfix"></div>
                                 <div class="image-upload-wrap">
                                    <input class="file-upload-input"  type='file' onchange="resortBrochureImgNew();" id="resortBrochureImg" />
                                    <div class="drag-text">
                                       <h3>
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                          <div class="clearfix"></div>
                                          Upload your brochure
                                          <div class="clearfix"></div>
                                          <small>Just drop them here</small> 
                                          <ul class="note-msg">
                                             <li>                                
                                                Upload Landscape Image
                                             </li>  
                                            <li>                                
                                               The brochure should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span>, <span> PDF </span> file format
                                            </li> 
                                            <li>
                                               Brochure need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                                            </li> 
                                            <li>
                                              Brochure can be maximum <span>10 MB</span> size
                                            </li>
                                          </ul>
                                       </h3>
                                    </div>
                                    <div class="new_loader2" style="display: none;"></div>
                                 </div>
                                 <div id="brochure_main">
                                    <?php 
                                    if(!empty($row->resort_brochure)&&file_exists('uploads/resorts/'.$row->resort_brochure)){
                                       $fileTypes  = explode('.', $row->resort_brochure);
                                       $fileType   = strtolower(end($fileTypes)); 
                                       $randT      = rand(000,999).time();
                                       $deletImg   = "deleteResortBrochure('".$randT."','".$row->resort_brochure."')";
                                       $html = '<div id="'.$randT.'" class="file-upload-content">';
                                       if($fileType=='pdf'){        
                                          $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->resort_brochure.'" alt="resort affiliation"></iframe>';
                                       }else{
                                          $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->resort_brochure.'" alt="resort affiliation">';
                                       }
                                       $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                       echo $html;
                                    }
                                    ?>
                                 </div>
                                 <div id="brochure_error"></div>
                                 <input type="hidden" name="resort_brochure" id="resort_brochure">
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="resort-option">
                     <div class="form-group">
                        <label>Upload Resort Images</label>
                        <div class="upload-doc">
                           <div class="form-group">
                              <div class="file-upload" id="resort_images_main_i">
                                 <div class="clearfix"></div>
                                 <?php 
                                    if(!empty($images) && count($images) > 4) {
                                       $display = "display:none;";
                                    } else {
                                       $display = "display:block;";
                                    }
                                 ?>
                                 <div class="image-upload-wrap" id="resortImageUpload" style="<?php echo $display;?>">
                                    <input class="file-upload-input" type='file' onchange="resortImagesImgNew();" accept="image/*" id="resortImagesImg" multiple="multiple" />
                                    <div class="drag-text">
                                       <h3>
                                          <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                          <div class="clearfix"></div>
                                          Upload your resort Images
                                          <div class="clearfix"></div>
                                          <small>Just drop them here</small> 
                                          <ul class="note-msg">
                                             <li>                                
                                                You can upload maximum 4 images
                                             </li>    
                                             <li>                                
                                                Upload Landscape Image 
                                             </li>    
                                            <li>                                
                                               The resort images should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
                                            </li> 
                                            <li>
                                               Resort images need to be at least <span>100 x 100</span> pixels and maximum <span> 3,000 x 3,000</span> pixels
                                            </li> 
                                            <li>
                                              Resort images can be maximum <span>2.5 MB/image</span> size
                                            </li>
                                            <li>
                                              Upload up to <span>4</span> images at a time
                                            </li>
                                          </ul>
                                       </h3>
                                    </div>
                                    <div class="new_loader3" style="display: none;"></div>
                                 </div>
                                 <div id="resort_images_error" class="error"></div>
                                 <div id="resort_images_main">
                                    <?php 
                                    if(!empty($images)){ 
                                       foreach ($images as $image) {
                                          if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){
                                             $randT      = rand(000,999).time();
                                             $deletImg   = "deleteResortImage('".$randT."','".$image->image_name."', '".$image->id."')";
                                             $html       = '<div id="'.$randT.'" class="file-upload-content">';
                                             $html       .= '<div class="setCoverImage" rel='.$image->id.'>Set Cover Image</div><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort image"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                                             echo $html;
                                          }
                                       }
                                    }
                                    ?>
                                 </div>                          
                                 <style>    
                                    .setCoverImage{                                       
                                       position: absolute;
                                       bottom: 41px;
                                       background: #444;
                                       text-align: center;
                                       left: 23px;
                                       padding: 2px 6px;
                                       font-size: 11px;
                                       cursor: pointer;
                                       color:#fff;
                                       border-radius:3px;
                                    }
                                 </style>    
                                 <input type="hidden" id="resortImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                                 <input type="hidden" name="resort_images" id="resort_images">
                                 <div class="clearfix"></div> 
                              </div> 
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> Resort Image Caption Heading (Main)</label>
                        <textarea name="resort_caption" maxlength="50" rows="2" class="form-control" placeholder="Enter Caption"><?php if(!empty($row->resort_caption)){echo $row->resort_caption;} ?></textarea>
                     </div>
                  </div>
                  <div class="resort-option">
                     <div class="form-group">
                        <label for="exampleInputEmail1"> Resort Image Caption Description</label>
                        <textarea name="resort_caption_description" maxlength="100" class="form-control" placeholder="Enter Caption Description" rows="5"><?php if(!empty($row->resort_caption_description)){echo $row->resort_caption_description;} ?></textarea>
                     </div>
                  </div>
                  
               </div>
            </div>
            <div class="row">
               <div class="col-sm-12 ">
                  <div class="resort-option">
                     <div class="form-group">
                        <label> Points of attractions (within vicinity) </label>
                        <div class="row">
                           <?php
                           $resortAttractions  = array();
                           if(!empty($row->points_of_attractions)){
                              $resortAttractions = explode(',', $row->points_of_attractions);
                           }
                           if(!empty($attractions)){
                              foreach($attractions as $attraction){?>
                                 <div class="col-sm-6 col-md-4">
                                    <div class="tick">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" name="points_of_attractions[]" id="attraction_<?php echo $attraction->id ?>" value="<?php echo $attraction->id ?>" <?php if(in_array($attraction->id, $resortAttractions)){echo 'checked';} ?>>
                                          <label class="custom-control-label" for="attraction_<?php echo $attraction->id ?>"><?php echo $attraction->attraction_name ?> </label>
                                       </div>
                                    </div>
                                 </div>
                              <?php 
                              }
                           }
                           ?> 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 ">
                  <div class="resort-option">
                     <div class="form-group">
                        <label> Holiday styles </label>
                        <div class="row">
                           <?php 
                           $resortHolidays = array();
                           if(!empty($row->holiday_styles)){
                              $resortHolidays = explode(',', $row->holiday_styles);
                           }
                           if(!empty($holidays)){
                              foreach($holidays as $holiday){?>
                                 <div class="col-sm-6 col-md-4">
                                    <div class="tick">
                                       <div class="custom-control custom-checkbox">
                                          <input name="holiday_styles[]" type="checkbox" class="custom-control-input" id="holiday_<?php echo $holiday->id ?>" value="<?php echo $holiday->id ?>" <?php if(in_array($holiday->id, $resortHolidays)){echo 'checked';} ?>>
                                          <label class="custom-control-label" for="holiday_<?php echo $holiday->id ?>">
                                             <?php 
                                                echo $holiday->holiday_name;
                                             ?> 
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                              <?php 
                              }
                           }
                           ?> 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-12">
         <div class="btn-next-con"> 
            <input type="hidden" name="resort_id" value="<?php echo !empty($resort_id)?$resort_id:'';?>">
            <a class="btn-back" href="javascript:void(0)" onclick="backtostep2();">Back</a> 
            <button type="submit" class="btn-next">
               Save & Continue
            </button>
         </div>
      </div>
   </div>
</form>
<link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>css/alertify.core.css"> 
<script src="<?php echo FRONT_THEAM_PATH; ?>js/moment.min.js"></script>
<script src="<?php echo FRONT_THEAM_PATH; ?>js/bootstrap-datetimepicker.min.js"></script> 
<script type="text/javascript">
   function uploadFactsheet(){
      $('.new_loader').show();
      var files    = document.getElementById('FactsheetImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('factsheet_pic', 'yes');   
      formData.append('pdf_file', 'only_pdf'); 
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
            $('.new_loader').hide();
            if(res.statuss=='true'){
               $('#factsheet_main').html(res.html);
               $('#factsheet').val(res.file_name);  
               $('#factsheet_main_i .file-upload-content').show();
               $('#factsheet_main_i .image-upload-wrap').hide();
               $('#factsheet_error').hide();
            }else{       
               $('#factsheet_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function resortMapImgNew(){     
      $('.new_loader1').show(); 
      var files    = document.getElementById('resortMapImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('resort_map_pic', 'yes');    
      formData.append('pdf_file', 'yes');   
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
            $('.new_loader1').hide();
            if(res.statuss=='true'){
               $('#resort_map_img_main').show().html(res.html);
               $('#resort_map_img_main .file-upload-content').show();
               $('#resort_map_main_file').hide();
               $('#resort_map').val(res.file_name);
               $('#resort_map_img_error').hide();
            }else{       
               $('#resort_map_img_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function resortBrochureImgNew(){
      $('.new_loader2').show();
      var files    = document.getElementById('resortBrochureImg').files; 
      var file     = files[0];
      var xhr      = new XMLHttpRequest(); 
      var formData = new FormData();     
      formData.append('user_img',file);
      formData.append('resort_brochure_pic', 'yes');  
      formData.append('pdf_file', 'yes');  
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
            $('.new_loader2').hide();
            if(res.statuss=='true'){
               $('#brochure_main').html(res.html);
               $('#resort_brochure').val(res.file_name);  
               $('#resort_brochure_main_i .file-upload-content').show();
               $('#resort_brochure_main_i .image-upload-wrap').hide();
               $('#brochure_error').hide();
            }else{       
               $('#brochure_error').show().html(res.message);
            }
         };
      };      
      xhr.send(formData);
   }
   function resortImagesImgNew(){
      if($('#resort_images_main_i').find('.file-upload-content').length > 4) {
          consol("You cannot add more than 4 images.");
          return false;
      }
    
      $('.new_loader3').show();
      var files           = document.getElementById('resortImagesImg').files;
      var resortImgCount  = $('#resortImagesCount').val();   
      var totalFileCount  = parseInt(resortImgCount) + parseInt(files.length);
      if(totalFileCount>4){
         $('#resort_images_error').show().html('You can`t upload more than 4 images');
         $('.new_loader3').hide();  
      }else{
         var max_count = files.length;
         for(img=0;img<max_count;img++){         
            var file      = files[img];
            var xhr       = new XMLHttpRequest(); 
            var formData  = new FormData();     
            formData.append('user_img',file);
            formData.append('resort_image_pic', 'yes');   
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
                  $('.new_loader3').hide();
                  if(res.statuss=='true'){
                     $('#resort_images_main').append(res.html);
                     var filenames = $('#resort_images').val();
                     if(filenames!=''){
                         $('#resort_images').val(filenames+','+res.file_name);
                     }else{
                        $('#resort_images').val(res.file_name);
                     }
                     $('#resort_images_main .file-upload-content').show();
                     var resortImgCount = parseInt($('#resortImagesCount').val())+parseInt(1);  
                     $('#resortImagesCount').val(resortImgCount);
                     $('#resort_images_error').hide();
                     if(resortImgCount > 3) {
                        $('#resortImageUpload').hide();
                     }
                     /*$('#resort_images_error .image-upload-wrap').hide();*/
                  }else{       
                     $('#resort_images_error').show().html(res.message);
                  }
               };
            };      
            xhr.send(formData);
         }
      }
   }
   setTimeout(function(){ 
      <?php 
         if(!empty($row->factsheet)&&file_exists('uploads/resorts/'.$row->factsheet)){ 
            echo "$('#factsheet_main_i .file-upload-content').show();
                  $('#factsheet_main_i .image-upload-wrap').hide();";
         }
         if(!empty($row->resort_map)&&file_exists('uploads/resorts/'.$row->resort_map)){      
            echo "$('#resort_map_data_main_i .file-upload-content').show();
                  $('#resort_map_data_main_i .image-upload-wrap').hide();";
         }
         if(!empty($row->resort_brochure)&&file_exists('uploads/resorts/'.$row->resort_brochure)){  
            echo "$('#resort_brochure_main_i .file-upload-content').show();
                  $('#resort_brochure_main_i .image-upload-wrap').hide();";
         }
         if(!empty($images)){  
            echo "$('#resort_images_main .file-upload-content').show();";
         }
      ?> 
   }, 1500);
   $('.datetimepicker1').datetimepicker({
      format: 'DD/MM/YYYY'
   });
   function deletefactsheet(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#factsheet, #factsheet_main').val('');
            $('#factsheet_main_i .file-upload-content').hide();
            $('#factsheet_main_i .image-upload-wrap').show();
         }
      });
   } 
   function deleteResortMap(imageID,imageold){
      
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#resort_map, #resort_map_img_main').val('');
            $('#resort_map_data_main_i .file-upload-content').hide();
            $('#resort_map_data_main_i .image-upload-wrap').show();
         }
      });
   }   
   function deleteResortBrochure(imageID,imageold){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#resort_brochure, #brochure_main').val('');
            $('#resort_brochure_main_i .file-upload-content').hide();
            $('#resort_brochure_main_i .image-upload-wrap').show();
         }
      });
   }   
   function deleteResortImage(imageID,imageold,imageDBID){
      alertify.confirm("Are you sure you want to delete this image?", function (e) {
         if (e) {       
            $('#'+imageID).remove();           
            var resortImgCount = parseInt($('#resortImagesCount').val())-parseInt(1);  
            if(resortImgCount < 3) {
               $('#resortImageUpload').show();
            }
            $('#resortImagesCount').val(resortImgCount);
            var all_images = $('#resort_images').val(); 
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
            $('#resort_images').val(imageName);
         }
      });
   }  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1QRhyIWRwXJrbWyzBY__Cldqg37ials&libraries=places&callback=initAutocomplete"
   async defer></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCswsEqPI8Xfbctqne8Eq3Wd6xGSGM-eT8
&libraries=places&callback=initAutocomplete"
   async defer></script>   -->
<script type="text/javascript">
  /* var placeSearch, autocomplete;  
   function initAutocomplete() {
      var input = document.getElementById('full_location');
      var options = {
        types: ['address'],
        componentRestrictions: {country: 'in'}
      };
      autocomplete = new google.maps.places.Autocomplete(input, options);
   }*/
   function initAutocomplete() {
      var options = {componentRestrictions: {country: 'mv'}};
      var input = document.getElementById('full_location');
      var autocomplete = new google.maps.places.Autocomplete(input, options);
      google.maps.event.addListener(autocomplete, 'place_changed', function () {
         var place     = autocomplete.getPlace();
         document.getElementById('latitude').value = place.geometry.location.lat();
         document.getElementById('longitude').value = place.geometry.location.lng();         
      });
   }   
</script>
<script type="text/javascript">
   function backtostep2(){
      var progressBar = $('#js-progress').find('.progress-bar');
      var progressVal = $('#js-progress').find('.progress-val');
      var step_id     = $('#step_id').val();
      var step_id     = parseInt(step_id)-parseInt(1);
      var step_val    = $('#step_val').val();
      var step_val    = parseInt(step_val)-parseInt(10);
      progressBar.css('width', step_val+ '%');
      progressVal.text(step_val+'%');
      $('#step_id').val(step_id);
      $('#step_val').val(step_val);
      var resort_id = $('#resort_id').val();
      $.ajax({ 
         url:base_url+"home/edit_resort_2",
         type:"POST",
         data:{resort_id:resort_id}, 
         success: function(html){
            var response = $.parseJSON(html); 
            if(response.status=='true'){
               $('#tab3').hide().html('');
               $('#tab2').show().html(response.nexthtml);
               $('#add_resort_res').hide();
               $('#tab_menu_3').removeClass('active2');
               $('#tab_menu_2').addClass('active2');
            }else{ 
               $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
            }
         }                
      });
   }    
   $('.setCoverImage').click(function(event){
      $('.setCoverImage').html('Set Cover Image');
      var thisobj = $(this);
      $(this).html('Please wait...');
      var resort_id = $('#resort_id').val();
      $.ajax({ 
            url:base_url+"home/setCoverImage",
            type:"POST",
            data:{image_id:$(this).attr('rel'),resort_id:resort_id}, 
            success: function(html){
               thisobj.html('Successfully Set');
            }                
         });
   });
   $('#add_resort_3').validate({
      submitHandler: function(form) {
         var resort_id = $('#resort_id').val();
         $.ajax({ 
            url:base_url+"home/save_resort_3",
            type:"POST",
            data:$("#add_resort_3" ).serialize(), 
            success: function(html){
               var response = $.parseJSON(html); 
               if(response.status=='true'){
                  nextlable();
                  $('#tab3').hide().html('');
                  $('#tab4').show().html(response.nexthtml);
                  $('#add_resort_res').hide();
                  $('#tab_menu_3').removeClass('active2');
                  $('#tab_menu_4').removeClass('disable');
                  $('#tab_menu_4').addClass('active2');
               }else{ 
                  $('#add_resort_res').show().html('<div style="margin-top:0px" class="alert alert-danger" id="actionMessageError"><button type="button" class="close" data-dismiss="alert">&times;</button>'+response.message+'</div>');  
               }
            }                
         });
      }
   });    
   $(".only_number").keydown(function (e) {
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A, Command+A
         (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
         // Allow: home, end, left, right, down, up
         (e.keyCode >= 35 && e.keyCode <= 40)) {
         // let it happen, don't do anything
         return;
      }        
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
         e.preventDefault();
      }
   }); 
</script>