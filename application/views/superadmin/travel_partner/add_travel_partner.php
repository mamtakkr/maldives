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
				<?php foreach($airporttype as $atype){ ?>
				<option value="<?php echo $atype->id;?>" <?php if(isset($row->id) && $row->id==$atype->airport_type){echo "selected";}?>><?php echo $atype->airport_type_name;?></option>
				<?php } ?>
			  </select>
            </div> 
			 <div class="form-group">
              <label for="exampleInputEmail1">Title</label>  
              <input type="text" placeholder="Title" class="form-control" name="title" value="<?php if(set_value('title')){echo set_value('title');}else if(!empty($row->title)){ echo $row->title;}?>">
              <?php echo form_error('title'); ?>
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
					if(!empty($row->image)&&file_exists('uploads/transfer/travel_partner/'.$row->image)){ 
					echo '<img src="'.base_url('uploads/transfer/travel_partner/'.$row->image).'" height="70%" width="100%"  />'; 
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