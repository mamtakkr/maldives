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
    <li><a href="<?php echo ADMIN_URL.'distance_places'; ?>">Distance Places List</a></li>
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
                Place Name              
              </label>  
              <input type="text" placeholder="Place Name" class="form-control" name="title" value="<?php if(set_value('title')){echo set_value('title');}else if(!empty($row->title)){ echo $row->title;}?>">
              <?php echo form_error('title'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Latitude
              </label>     
              <input type="text" placeholder="Latitude" class="form-control" name="latitude" value="<?php if(set_value('latitude')){echo set_value('latitude');}else if(!empty($row->latitude)){ echo $row->latitude;}?>">
                 <?php echo form_error('latitude'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Longitude
              </label>     
              <input type="text" placeholder="longitude" class="form-control" name="longitude" value="<?php if(set_value('longitude')){echo set_value('longitude');}else if(!empty($row->longitude)){ echo $row->longitude;}?>">
                 <?php echo form_error('position'); ?>
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