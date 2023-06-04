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
    <li><a href="<?php echo ADMIN_URL.'holiday_styles'; ?>">Holiday Style List</a></li>
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
                Holiday Style Title
              </label>     
              <input type="text" placeholder="Holiday Style Title" class="form-control" name="holiday_name" value="<?php if(set_value('holiday_name')){echo set_value('holiday_name');}else{ if(!empty($row->holiday_name)){ echo $row->holiday_name;}}   ?>">
              <?php echo form_error('holiday_name'); ?>
            </div> 
            <div class="form-group">
              <?php  echo (!empty($row->holiday_image)&&file_exists('uploads/holidays/thumbnails/150_'.$row->holiday_image))?'<img src="'.base_url().'uploads/holidays/thumbnails/150_'.$row->holiday_image.'" style="max-width:150px"/>':'';
                  ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Holiday style Icon
              </label>     
              <input type="file" class="form-control" name="user_img">
              <div class="note-msg">
               Holiday style Icon need to be atleast <font>150 x 150</font> pixels and maximum <font>2000 x 2000</font> pixels
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