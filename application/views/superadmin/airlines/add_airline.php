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
    <li><a href="<?php echo ADMIN_URL.'airlines'; ?>">Airlines List</a></li>
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
              <label for="airlines_name">Airlines Name</label>  
			   <input type="text" placeholder="Airlines Name" class="form-control" name="airlines_name" value="<?php if(set_value('airlines_name')){echo set_value('airlines_name');}else if(!empty($row->airlines_name)){ echo $row->airlines_name;}?>">
              <?php echo form_error('airlines_name'); ?>
              
			  </select>
            </div> 
			 <div class="form-group">
              <label for="Scheduled">Scheduled</label>  
              <input type="text" placeholder="Scheduled" class="form-control" name="scheduled" value="<?php if(set_value('scheduled')){echo set_value('scheduled');}else if(!empty($row->scheduled)){ echo $row->scheduled;}?>">
              <?php echo form_error('scheduled'); ?>
            </div>
            <div class="form-group">
			<label for="country">Country</label>     
			<input type="text" placeholder="Country" class="form-control" name="country" value="<?php if(set_value('country')){echo set_value('country');}else if(!empty($row->country)){ echo $row->country;}?>">
              <?php echo form_error('country'); ?>
            </div> 
			 <div class="form-group">
              <label for="Image">
                Image
              </label>     
             <?php
					if(!empty($row->image)&&file_exists('uploads/transfer/airlines/'.$row->image)){ 
					echo '<img src="'.base_url('uploads/transfer/airlines/'.$row->image).'" height="70%" width="100%"  />'; 
					} ?>

					<input type="file" class="form-control input-medium" name="image"/>
					<input type="hidden" name="old_image" value="<?php if(!empty($row->image)){ echo $row->image; } ?>"/>
					<?php echo form_error('image'); ?> 
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