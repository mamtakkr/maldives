<style type="text/css">
  .ms-container {  
    width: 676px;   
}
.user-type-height .ms-container .ms-list {
    height: 200px !important;
}
</style>
<ul class="breadcrumb">
  <li><a href="<?php echo base_url('/superadmin/superadmin/dashboard');?>"> Dashboard  </a></li>  
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
<div class="portlet-body form" style="min-height: 2200px;">
  <form action="<?php current_url(); ?>" class="form-horizontal form-bordered custom-admin-form" method="post" enctype="multipart/form-data">
  <div class="col-md-10 center-block ">
   <!--  <br/><br/><br/> -->
  <?php     
    if(!empty($this->uri->segment(4))&&$this->uri->segment(4)=='Follow_Us'){ ?>
      <?php 
      if(!empty($rows)){
        foreach($rows as $row){?>
          <div class="form-group last" id="lastNameLay">
            <label class="control-label col-md-3"><?php echo $row->title ?><small class="required">*</small></label>
            <div class="col-md-6">
              <input type="text" class="form-control input-medium" name="<?php echo $row->meta_key; ?>" value="<?php if(set_value($row->meta_key)){ echo set_value($row->meta_key);} else{ if(!empty($row->meta_data)){ echo $row->meta_data; }} ?>" placeholder="Enter Facebook" autocomplete="off"/>
                <?php echo form_error($row->meta_key); ?>
            </div>
          </div> 
        <?php
        }
      }
    }
    if(!empty($this->uri->segment(4))&&$this->uri->segment(4)=='setting'){ ?>
      <?php 
      $font_styles  = array('italic', 'normal', 'oblique');
      $font_familys = array('brandon_textbold', '-webkit-body', '-webkit-pictograph','auto', 'cursive', 'fantasy', 'inherit', 'monospace', 'sans-serif', 'serif');
      if(!empty($rows)){
        foreach($rows as $row){?>
          <div class="form-group last" id="lastNameLay">
            <label class="control-label col-md-3"><?php echo $row->title ?></label>
            <div class="col-md-6">
              <?php 
              if(!empty($row->type)&&$row->type=='file'){
                if(set_value($row->meta_key)){ 
                  $file_name = set_value($row->meta_key);
                } else if(!empty($row->meta_data)){ 
                  $file_name = $row->meta_data;
                } 
                if(!empty($file_name)){
                  $files    = explode('.', $file_name);
                  $file_ext = end($files);
                  if($file_ext=='mp4'&&file_exists('uploads/cms/'.$file_name)){
                    echo '<video class="fillWidth" id="video" muted="0" autoplay="" preload="auto" loop="" width="100%"><source src="'.base_url().'uploads/cms/'.$file_name.'" type="video/mp4"></video>';
                  }else if(($file_ext=='png'||$file_ext=='jpeg'||$file_ext=='jpg'||$file_ext=='gif')&&file_exists('uploads/cms/thumbnails/500_'.$file_name)){ 
                    echo '<img src="'.base_url().'uploads/cms/thumbnails/500_'.$file_name.'" style="width:500px;"/>';
                  }
                }
                echo '<input type="file" class="form-control input-medium" name="'.$row->meta_key.'">';
                echo form_error($row->meta_key);
              }else if(!empty($row->type)&&$row->type=='font_size'){ 
                echo '<select class="form-control input-medium" name="'.$row->meta_key.'"><option value="">Select Font Size</option>';
                for($fo=8;$fo<100;$fo++){
                  echo '<option value="'.$fo.'px"';
                  echo (set_value($row->meta_key)&&set_value($row->meta_key)==$fo.'px')?' selected':(!empty($row->meta_data&&$row->meta_data==$fo.'px')?' selected':'');
                  echo '>'.$fo.'</option>';
                }
                echo '</select>';
                echo form_error($row->meta_key); 
              }else if(!empty($row->type)&&$row->type=='font_family'){                 
                echo '<select class="form-control input-medium" name="'.$row->meta_key.'"><option value="">Select Font Family</option>';
                foreach($font_familys as $font_family){
                  echo '<option value="'.$font_family.'"';
                  echo (set_value($row->meta_key)&&set_value($row->meta_key)==$font_family)?' selected':(!empty($row->meta_data&&$row->meta_data==$font_family)?' selected':'');
                  echo '>'.ucfirst($font_family).'</option>';
                }
                echo '</select>';
                echo form_error($row->meta_key); 
              }else if(!empty($row->type)&&$row->type=='font_style'){ 
                echo '<select class="form-control input-medium" name="'.$row->meta_key.'"><option value="">Select Font Style</option>';
                foreach($font_styles as $font_style){
                  echo '<option value="'.$font_style.'"';
                  echo (set_value($row->meta_key)&&set_value($row->meta_key)==$font_style)?' selected':(!empty($row->meta_data&&$row->meta_data==$font_style)?' selected':'');
                  echo '>'.ucfirst($font_style).'</option>';
                }
                echo '</select>';
                echo form_error($row->meta_key); 
              }else { 
                echo '<input type="text" class="form-control input-medium" name="'.$row->meta_key.'"';
                echo (set_value($row->meta_key))?' value="'.set_value($row->meta_key).'"':(!empty($row->meta_data)?' value="'.$row->meta_data.'"':"");
                echo 'placeholder="Enter '.$row->title.'" autocomplete="off"/>'; 
                echo form_error($row->meta_key); 
              }?>
            </div>
          </div> 
        <?php
        }
      }
    }if(!empty($this->uri->segment(4))&&$this->uri->segment(4)=='editor'){ ?>
      <?php 
      if(!empty($rows)){
        foreach($rows as $row){?>
          <div class="form-group last" id="lastNameLay">
            <label class="control-label col-md-3"><?php echo $row->title ?><small class="required">*</small></label>
            <div class="col-md-9">
              <textarea class="form-control input-medium tinymce_edittor" name="<?php echo $row->meta_key; ?>"><?php if(set_value($row->meta_key)){ echo set_value($row->meta_key);} else{ if(!empty($row->meta_data)){ echo $row->meta_data; }} ?></textarea>
              <?php echo form_error($row->meta_key); ?>
              <ul class="note-msg">
                <li>                                
                   The brochure should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
                </li> 
                <li>
                   Brochure need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                </li> 
                <li>
                  Brochure can be maximum <span>10 MB</span> size
                </li>
              </ul>
            </div>
          </div> 
        <?php
        }
      }
    }?>
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