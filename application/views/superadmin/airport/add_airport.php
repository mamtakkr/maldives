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
    <li><a href="<?php echo ADMIN_URL.'faq'; ?>">FAQ List</a></li>
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
              <label for="exampleInputEmail1">Airport Type </label>  
              <select name="airport_type" id="airport_type" class="form-control">
				<option value="">Select Type</option>
				<option value="1" <?php if(isset($row->airport_type) && $row->airport_type==1){echo "selected";}?>>International </option>
				<option value="2" <?php if(isset($row->airport_type) && $row->airport_type==2){echo "selected";}?>>Domestic </option>
			  </select>
            </div> 
			 <div class="form-group">
              <label for="exampleInputEmail1">Name</label>  
              <input type="text" placeholder="Name" class="form-control" name="name" value="<?php if(set_value('name')){echo set_value('name');}else if(!empty($row->name)){ echo $row->name;}?>">
              <?php echo form_error('name'); ?>
            </div>
			<div class="form-group">
              <label for="exampleInputEmail1">Address</label>  
              <input type="text" placeholder="Address" class="form-control" name="address" value="<?php if(set_value('address')){echo set_value('address');}else if(!empty($row->address)){ echo $row->address;}?>">
              <?php echo form_error('address'); ?>
            </div>
            <div class="form-group">
			<label for="exampleInputEmail1">Description</label>     
			<textarea name="description" placeholder="Enter description" class="form-control tinymce_edittor"><?php if(set_value('description')){echo set_value('description');}elseif(!empty($row->description)){ echo $row->description;}?></textarea>
			<?php echo form_error('description'); ?>
            </div> 
			 <div class="form-group">
              <label for="exampleInputEmail1">
                Image
              </label>     
             <?php
					if(!empty($row->image)&&file_exists('uploads/transfer/airport/'.$row->image)){ 
					echo '<img src="'.base_url('uploads/transfer/airport/'.$row->image).'" height="70%" width="100%"  />'; 
					} ?>

					<input type="file" class="form-control input-medium" name="image"/>
					<input type="hidden" name="old_image" value="<?php if(!empty($row->image)){ echo $row->image; } ?>"/>
					<?php echo form_error('image'); ?> 
            </div> 
			<div class="form-group">
              <label for="exampleInputEmail1">Highlights</label>  
              <input type="text" placeholder="highlight" class="form-control" name="highlights[]" value="<?php if(set_value('address')){echo set_value('highlights');}else if(!empty($row->highlights)){ echo $row->highlights;}?>">
              <?php echo form_error('highlights'); ?>
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