<style type="text/css">
  .ms-container {  
    width: 676px;   
}
.user-type-height .ms-container .ms-list {
    height: 200px !important;
}
</style>
<ul class="breadcrumb">
  <li><a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>"> Dashboard  </a></li>  
  <li class=""><?php if(!empty($title)) echo $title;?></li>
</ul>
<div class="portlet light bordered">
  <div class="portlet-title panel-heading">
    <div class="caption">
      <i class="fa fa-cog"></i> &nbsp;
        <?php if(!empty($title)) echo $title;?> 
    </div>
  </div>
</div>
<div class="portlet-body form" style="min-height: 6000px;">
  <form action="<?php current_url(); ?>" class="form-horizontal form-bordered custom-admin-form" method="post" enctype="multipart/form-data">
  <div class="col-md-10 center-block "> 
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Title<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="title" value="<?php if(set_value('title')){ echo set_value('title');} else{ if(!empty($row->title)){ echo $row->title; }} ?>" placeholder="Enter Title" autocomplete="off"/>
        <?php echo form_error('title'); ?> 
      </div>
    </div>
	
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="description">Description<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <textarea name="description" placeholder="Enter Description" class="form-control tinymce_edittor"><?php if(set_value('description')){echo set_value('description');}elseif(!empty($row->description)){ echo $row->description;}?></textarea>
       
          <?php echo form_error('description'); ?>
      </div>
    </div>
   
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="image1">Image1<small class="required">*</small>
      </label>
      <div class="col-md-9">
        
        <?php
        if(!empty($row->image1)&&file_exists('uploads/maldives/maldives_diving/'.$row->image1)){ 
          ?>
          <div style="position:relative;" id="divImage1">
          <div style="position:absolute;color: #000;background: #fff;right: 0px;padding: 0px 7px;font-size: 25px;cursor: pointer;" onclick="remove_image1();">X</div>
          <?php
            echo '<img src="'.base_url('uploads/maldives/maldives_diving/'.$row->image1).'"height="70%" width="100%"  />'; 
          ?>
          </div>
          <?php
        } ?>
        
        <input type="file" class="form-control input-medium" name="image1"/>
        <input type="hidden" name="old_image1" value="<?php if(!empty($row->image1)){ echo $row->image1; } ?>"/>
        <?php echo form_error('image1'); ?> 
       
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="image2">Image2<small class="required">*</small>
      </label>
      <div class="col-md-9">
      
         <?php
        if(!empty($row->image2)&&file_exists('uploads/maldives/maldives_diving/'.$row->image2)){ 
          ?>
          <div style="position:relative;" id="divImage2">
          <div style="position:absolute;color: #000;background: #fff;right: 0px;padding: 0px 7px;font-size: 25px;cursor: pointer;"  onclick="remove_image2();">X</div>
          <?php
            echo '<img src="'.base_url('uploads/maldives/maldives_diving/'.$row->image2).'"height="70%" width="100%"  />'; 
          ?>
          </div>
          <?php
        } ?>
      
        <input type="file" class="form-control input-medium" name="image2"/>
		 <input type="hidden" name="old_image2" value="<?php if(!empty($row->image2)){ echo $row->image2; } ?>"/>
        <?php echo form_error('image2'); ?> 
       
       
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Image3<small class="required">*</small>
      </label>
      <div class="col-md-9">
      
         <?php
        if(!empty($row->image3)&&file_exists('uploads/maldives/maldives_diving/'.$row->image3)){ 
          ?>
            <div style="position:relative;" id="divImage3">
          <div style="position:absolute;color: #000;background: #fff;right: 0px;padding: 0px 7px;font-size: 25px;cursor: pointer;"  onclick="remove_image3();">X</div>
          <?php
          echo '<img src="'.base_url('uploads/maldives/maldives_diving/'.$row->image3).'"height="70%" width="100%"  />'; 
          ?>
            </div>
          <?php
        } ?>
      
        <input type="file" class="form-control input-medium" name="image3"/>
		    <input type="hidden" name="old_image3" value="<?php if(!empty($row->image3)){ echo $row->image3; } ?>"/>
        <?php echo form_error('image3'); ?> 
       
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Image4<small class="required">*</small>
      </label>
      <div class="col-md-9">
         <?php
        if(!empty($row->image4)&&file_exists('uploads/maldives/maldives_diving/'.$row->image4)){ 
          ?>
            <div style="position:relative;" id="divImage4">
          <div style="position:absolute;color: #000;background: #fff;right: 0px;padding: 0px 7px;font-size: 25px;cursor: pointer;"  onclick="remove_image4();">X</div>
          <?php
          echo '<img src="'.base_url('uploads/maldives/maldives_diving/'.$row->image4).'"height="70%" width="100%"  />'; 
          ?>
          </div>
          <?php
        } ?>
        
        <input type="file" class="form-control input-medium" name="image4"/>
		 <input type="hidden" name="old_image4" value="<?php if(!empty($row->image4)){ echo $row->image4; } ?>"/>
        <?php echo form_error('image4'); ?> 
       
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Image5<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <?php
        if(!empty($row->image5)&&file_exists('uploads/maldives/maldives_diving/'.$row->image5)){ 
          ?>
          <div style="position:relative;" id="divImage5">
          <div style="position:absolute;color: #000;background: #fff;right: 0px;padding: 0px 7px;font-size: 25px;cursor: pointer;"  onclick="remove_image5();">X</div>
          <?php
          echo '<img src="'.base_url('uploads/maldives/maldives_diving/'.$row->image5).'" height="70%" width="100%" />'; 
          ?></div><?php
        } ?>
      
        <input type="file" class="form-control input-medium" name="image5"/>
		 <input type="hidden" name="old_image5" value="<?php if(!empty($row->image5)){ echo $row->image5; } ?>"/>
        <?php echo form_error('image5'); ?> 
       
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Link<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="diving_link1" value="<?php if(set_value('diving_link1')){ echo set_value('diving_link1');} else{ if(!empty($row->diving_link1)){ echo $row->diving_link1; }} ?>" placeholder="Enter Link" autocomplete="off"/>
        <?php echo form_error('title'); ?> 
      </div>
    </div>
	<div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Link<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="diving_link2" value="<?php if(set_value('diving_link2')){ echo set_value('diving_link2');} else{ if(!empty($row->diving_link2)){ echo $row->diving_link2; }} ?>" placeholder="Enter Link" autocomplete="off"/>
        <?php echo form_error('title'); ?> 
      </div>
    </div>
    <div class="form-actions">
      <div class="row">
        <div class="col-md-9 col-md-offset-3">
          <input type="hidden" name="submit" value="submit">
          <button name="submit" type="submit" class="btn btn-primary submit-btn">
            <?php if(!empty($title)) echo $title;?> 
          </button>
        </div>
      </div>
    </div>
    </div>
	</form>
   </div>
   <script type="text/javascript">
     function remove_image1() {
        alertify.confirm("Are you sure you want to delete this?", function (e) {
          if (e) {       
            $.ajax({
              url:"<?php echo ADMIN_URL;?>maldives/remove_maldives_diving1",
              type:"POST",
              success: function(html){
                $('#divImage1').html('');
              }
            });
          }
        });
      }
      function remove_image2() {
        alertify.confirm("Are you sure you want to delete this?", function (e) {
          if (e) {       
            $.ajax({
              url:"<?php echo ADMIN_URL;?>maldives/remove_maldives_diving2",
              type:"POST",
              success: function(html){
                $('#divImage2').html('');
              }
            });
          }
        });
      }
      function remove_image3() {
        alertify.confirm("Are you sure you want to delete this?", function (e) {
          if (e) {       
            $.ajax({
              url:"<?php echo ADMIN_URL;?>maldives/remove_maldives_diving3",
              type:"POST",
              success: function(html){
                $('#divImage3').html('');
              }
            });
          }
        });
      }
      function remove_image4() {
        alertify.confirm("Are you sure you want to delete this?", function (e) {
          if (e) {       
            $.ajax({
              url:"<?php echo ADMIN_URL;?>maldives/remove_maldives_diving4",
              type:"POST",
              success: function(html){
                $('#divImage4').html('');
              }
            });
          }
        });
      }
      function remove_image5() {
        alertify.confirm("Are you sure you want to delete this?", function (e) {
          if (e) {       
            $.ajax({
              url:"<?php echo ADMIN_URL;?>maldives/remove_maldives_diving5",
              type:"POST",
              success: function(html){
                $('#divImage5').html('');
              }
            });
          }
        });
      }
</script>