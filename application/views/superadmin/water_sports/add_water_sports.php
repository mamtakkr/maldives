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
    <li><a href="<?php echo ADMIN_URL.'water_sports'; ?>">Water Sport List</a></li>
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
                Water Sport Name
              </label>     
              <input type="text" placeholder="Water Sport Name" class="form-control" name="water_sports_name" value="<?php if(set_value('water_sports_name')){echo set_value('water_sports_name');}else{ if(!empty($row->water_sports_name)){ echo $row->water_sports_name;}}   ?>">
                 <?php echo form_error('water_sports_name'); ?>
            </div> 
            <div class="form-group">
              <?php  echo (!empty($row->water_sports_img)&&file_exists('uploads/sports/thumbnails/'.$row->water_sports_img))?'<img src="'.base_url().'uploads/sports/thumbnails/'.$row->water_sports_img.'" style="max-width:150px"/>':'';
                  ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Sport Icon
              </label>     
              <input type="file" class="form-control" name="user_img">
              <div class="note-msg">
               Sport Icon need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
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