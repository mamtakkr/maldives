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
    <li><a href="<?php echo ADMIN_URL.'transfer_modes'; ?>">Transfer Mode List</a></li>
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
                Type
              </label>  
              <select name="airport_type" class="form-control">
                <option value="">Select</option>
                <option value="1" <?php if(set_value('airport_type')&&set_value('airport_type')==1){echo 'selected';}else if(!empty($row->airport_type)&&$row->airport_type==1){ echo 'selected';}   ?>>Single</option>
                <option value="2" <?php if(set_value('airport_type')&&set_value('airport_type')==2){echo 'selected';}else if(!empty($row->airport_type)&&$row->airport_type==2){ echo 'selected';}   ?>>Double</option>
              </select>  
              <?php echo form_error('airport_type'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Transfer Mode Title
              </label>     
              <input type="text" placeholder="Transfer Mode Title" class="form-control" name="airport_type_name" value="<?php if(set_value('airport_type_name')){echo set_value('airport_type_name');}else{ if(!empty($row->airport_type_name)){ echo $row->airport_type_name;}}   ?>">
              <?php echo form_error('airport_type_name'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Transfer Tag
              </label>     
              <input type="text" placeholder="Transfer Mode Tag" class="form-control" name="tag" value="<?php if(set_value('tag')){echo set_value('tag');}else{ if(!empty($row->tag)){ echo $row->tag;}}   ?>">
                 <?php echo form_error('tag'); ?>
            </div> 
            <div class="form-group">
              <?php  echo (!empty($row->image_name)&&file_exists('uploads/airport_type/thumbnails/'.$row->image_name))?'<img src="'.base_url().'uploads/airport_type/thumbnails/'.$row->image_name.'" style="max-width:150px"/>':'';
                  ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Transfer Mode Icon
              </label>     
              <input type="file" class="form-control" name="user_img">
              <div class="note-msg">
               Transfer Mode Icon need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
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