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
    <li><a href="<?php echo ADMIN_URL.'openings'; ?>">Opening List</a></li>
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
                Resort              
              </label>  
              <input type="text" placeholder="New resort" class="form-control" name="resort_id" value="<?php if(set_value('resort_id')){echo set_value('resort_id');}else if(!empty($row->resort_id)){ echo $row->resort_id;}?>">
              <?php echo form_error('resort_id'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Position
              </label>     
              <input type="text" placeholder="Position" class="form-control" name="position" value="<?php if(set_value('position')){echo set_value('position');}else if(!empty($row->position)){ echo $row->position;}?>">
                 <?php echo form_error('position'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Location
              </label>     
              <input type="text" placeholder="location" class="form-control" name="location" value="<?php if(set_value('location')){echo set_value('location');}else if(!empty($row->location)){ echo $row->location;}?>">
                 <?php echo form_error('position'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Transport Mode
              </label>     
              <input type="text" placeholder="transport mode" class="form-control" name="transport_mode" value="<?php if(set_value('transport_mode')){echo set_value('transport_mode');}else if(!empty($row->transport_mode)){ echo $row->transport_mode;}?>">
                 <?php echo form_error('transport_mode'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Est Opening
              </label>     
              <input type="text" placeholder="est opening" class="form-control" name="est_opening" value="<?php if(set_value('est_opening')){echo set_value('est_opening');}else if(!empty($row->est_opening)){ echo $row->est_opening;}?>">
                 <?php echo form_error('est_opening'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                No. units
              </label>     
              <input type="text" placeholder="no. units" class="form-control" name="no_units" value="<?php if(set_value('no_units')){echo set_value('no_units');}else if(!empty($row->no_units)){ echo $row->no_units;}?>">
                 <?php echo form_error('no_units'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                No. of beds
              </label>     
              <input type="text" placeholder="no. units" class="form-control" name="no_beds" value="<?php if(set_value('no_beds')){echo set_value('no_beds');}else if(!empty($row->no_beds)){ echo $row->no_beds;}?>">
                 <?php echo form_error('no_beds'); ?>
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