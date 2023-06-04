<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>
    <?php if(!empty($title)) echo $title; ?>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li><a href="<?php echo ADMIN_URL.'resorts/resort_story'; ?>">Resort Story List</a></li>
    <li class="active"><?php if(!empty($title)) echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">              
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">  
            <div class="form-group">
              <label for="exampleInputEmail1">
                User 
              </label>    
              <select name="user_id" class="form-control">
                <option value="">Select User</option>
                <?php 
                if(!empty($users)){
                  foreach($users as $user){
                    if(set_value('user_id')&&set_value('user_id')==$user->id){
                      echo '<option selected="selected" value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }elseif(!empty($row->user_id)&&$row->user_id==$user->id){ 
                      echo '<option selected="selected" value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }else{
                      echo '<option value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('user_id'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Resort 
              </label>    
              <select name="resort_id" class="form-control">
                <option value="">Select resort</option>
                <?php 
                if(!empty($resorts)){
                  foreach($resorts as $resort){
                    if(set_value('resort_id')&&set_value('resort_id')==$resort->id){
                      echo '<option selected="selected" value="'.$resort->id.'">'.ucfirst($resort->resort_name).'</option>';
                    }elseif(!empty($row->resort_id)&&$row->resort_id==$resort->id){ 
                      echo '<option selected="selected" value="'.$resort->id.'">'.ucfirst($resort->resort_name).'</option>';
                    }else{
                      echo '<option value="'.$resort->id.'">'.ucfirst($resort->resort_name).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('resort_id'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Story Title
              </label>     
              <input type="text" placeholder="Story Title" class="form-control" name="title" value="<?php if(set_value('title')){echo set_value('title');}else{ if(!empty($row->title)){ echo $row->title;}}   ?>">
              <?php echo form_error('title'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Story Description
              </label>   
              <textarea placeholder="Story Description" rows="15" class="form-control tinymce_edittor" name="description"><?php if(set_value('description')){echo set_value('description');}elseif(!empty($row->description)){ echo $row->description;}   ?></textarea>
              <?php echo form_error('description'); ?>
            </div>              
            <div class="form-group">
              <div id="file_html_1" style="width: 100%; float: left;">
                <?php
                if(!empty($images)){
                  foreach($images as $image){ 
                    $del_fun  = "deleteImages('".$image->id."','".$image->image_name."','1');";
                    echo '<div class="image_li" id="'.$image->id.'"><img src="'.base_url().'uploads/blogs/'.$image->image_name.'" class="img_banner thumimgs"><a href="javascript:void(0);" onclick="'.$del_fun.'" class="btn btn-sm btn-danger deleteSchoolImg"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                  }
                }
                ?>                  
                </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Story Image
              </label>     
              <!-- <input type="file" class="form-control" name="user_img" multiple=""> -->
              <input type="file" class="form-control" id="uploadFile1" name="user_img[]" onchange="uploadMultipleFileImage('1', 'resorts', 'yes');" multiple="">
              <input type="hidden" name="resort_stories_files" id="file_name_1" />
              <div id="file_html_1"></div>
              <div class="note-msg">
               Story image need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
              </div>
              <?php echo form_error('user_img'); ?>
            </div>   
            <input type="hidden" name="submit" value="submit">
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>   