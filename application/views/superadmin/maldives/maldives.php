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
<div class="portlet-body form" style="min-height: 3700px;">
  <form action="<?php current_url(); ?>" class="form-horizontal form-bordered custom-admin-form" method="post" enctype="multipart/form-data">
  <div class="col-md-10 center-block "> 
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Location<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="location" value="<?php if(set_value('location')){ echo set_value('location');} else{ if(!empty($row->location)){ echo $row->location; }} ?>" placeholder="Enter Location" autocomplete="off"/>
        <?php echo form_error('location'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Capital<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="capital" value="<?php if(set_value('capital')){ echo set_value('capital');} else{ if(!empty($row->capital)){ echo $row->capital; }} ?>" placeholder="Enter Capital" autocomplete="off"/>
        <?php echo form_error('capital'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Population<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="population" value="<?php if(set_value('population')){ echo set_value('population');} else{ if(!empty($row->population)){ echo $row->population; }} ?>" placeholder="Enter population" autocomplete="off"/>
        <?php echo form_error('population'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Area<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="area" value="<?php if(set_value('area')){ echo set_value('area');} else{ if(!empty($row->area)){ echo $row->area; }} ?>" placeholder="Enter area" autocomplete="off"/>
        <?php echo form_error('area'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Calling Code<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="calling_code" value="<?php if(set_value('calling_code')){ echo set_value('calling_code');} else{ if(!empty($row->calling_code)){ echo $row->calling_code; }} ?>" placeholder="Enter calling code" autocomplete="off"/>
        <?php echo form_error('calling_code'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Largest Industry<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <textarea name="terms_en" placeholder="Enter Largest Industry" class="form-control tinymce_edittor"><?php if(set_value('largest_industry')){echo set_value('largest_industry');}elseif(!empty($row->largest_industry)){ echo $row->largest_industry;}?></textarea>
        <ul class="note-msg">
          <li>                                
             The file should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
          </li> 
          <li>
            File need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
          </li> 
          <li>
            File can be maximum <span>10 MB</span> size
          </li>
        </ul>
          <?php echo form_error('largest_industry'); ?>
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Government<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="government" value="<?php if(set_value('government')){ echo set_value('government');} else if(!empty($row->government)){ echo $row->government; } ?>" placeholder="Enter government" autocomplete="off"/>
        <?php echo form_error('government'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Independence Day<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="independence" value="<?php if(set_value('independence')){ echo set_value('independence');} else if(!empty($row->independence)){ echo $row->independence; } ?>" placeholder="Enter independence" autocomplete="off"/>
        <?php echo form_error('independence'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Geography<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <textarea name="geography" placeholder="Enter geography" class="form-control tinymce_edittor"><?php if(set_value('geography')){echo set_value('geography');}elseif(!empty($row->geography)){ echo $row->geography;}   ?></textarea>
        <ul class="note-msg">
          <li>                                
             The file should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
          </li> 
          <li>
             File need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
          </li> 
          <li>
            File can be maximum <span>10 MB</span> size
          </li>
        </ul>
          <?php echo form_error('geography'); ?>
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Number of Resorts<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="number_of_resorts" value="<?php if(set_value('number_of_resorts')){ echo set_value('number_of_resorts');} else if(!empty($row->number_of_resorts)){ echo $row->number_of_resorts; } ?>" placeholder="Enter Number of Resorts" autocomplete="off"/>
        <?php echo form_error('number_of_resorts'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Number of Resorts<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="local_time" value="<?php if(set_value('local_time')){ echo set_value('local_time');} else if(!empty($row->local_time)){ echo $row->local_time; } ?>" placeholder="Enter local time" autocomplete="off"/>
        <?php echo form_error('local_time'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Currency<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="currency" value="<?php if(set_value('currency')){ echo set_value('currency');} else if(!empty($row->currency)){ echo $row->currency; } ?>" placeholder="Enter Currency" autocomplete="off"/>
        <?php echo form_error('currency'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Official Language<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="official_language" value="<?php if(set_value('official_language')){ echo set_value('official_language');} else if(!empty($row->official_language)){ echo $row->official_language; } ?>" placeholder="Enter Official Language" autocomplete="off"/>
        <?php echo form_error('official_language'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Airports<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="airports" value="<?php if(set_value('airports')){ echo set_value('airports');} else if(!empty($row->airports)){ echo $row->airports; } ?>" placeholder="Enter Airports" autocomplete="off"/>
        <?php echo form_error('airports'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Electricity<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <input type="text" class="form-control input-medium" name="electricity" value="<?php if(set_value('electricity')){ echo set_value('electricity');} else if(!empty($row->electricity)){ echo $row->electricity; } ?>" placeholder="Enter Electricity" autocomplete="off"/>
        <?php echo form_error('electricity'); ?> 
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Climate & Weather<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <textarea name="climate_weather" placeholder="Enter Climate & Weather" class="form-control tinymce_edittor"><?php if(set_value('climate_weather')){echo set_value('climate_weather');}elseif(!empty($row->climate_weather)){ echo $row->climate_weather;}   ?></textarea>
        <ul class="note-msg">
          <li>                                
             The file should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
          </li> 
          <li>
             File need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
          </li> 
          <li>
            File can be maximum <span>10 MB</span> size
          </li>
        </ul>
          <?php echo form_error('climate_weather'); ?>
      </div>
    </div>
    <div class="form-group last" id="mobileNoLay">
      <label class="control-label col-md-3" id="mobileNoLable">Map of the Maldives<small class="required">*</small>
      </label>
      <div class="col-md-9">
        <?php
        if(!empty($row->map_img)&&file_exists('uploads/maldives/'.$row->map_img)){ 
          echo '<img src="'.base_url('uploads/maldives/'.$row->map_img).'" />'; 
        } ?>
        <input type="file" class="form-control input-medium" name="user_img"/>
        <?php echo form_error('user_img'); ?> 
        <ul class="note-msg">
          <li>                                
             The Map should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
          </li> 
          <li>
             Map need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
          </li> 
          <li>
            Map can be maximum <span>10 MB</span> size
          </li>
        </ul>
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
   </div>
  </form>
  </div>
</div>