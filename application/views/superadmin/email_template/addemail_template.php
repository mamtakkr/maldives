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
    <li><a href="<?php echo ADMIN_URL.'category'; ?>">category List</a></li>
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
                <?php echo !empty($row->templateTitle)?ucwords($row->templateTitle).' Subject':'Template Subject'; ?>
              </label>     
              <input type="text" placeholder="Enter Template Subject" class="form-control" name="template_subject" value="<?php if(set_value('template_subject')){echo set_value('template_subject');}else{ if(!empty($row->template_subject)){ echo $row->template_subject;}}   ?>">
                 <?php echo form_error('template_subject'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                <?php echo !empty($row->templateTitle)?ucwords($row->templateTitle).' Body':'Template Body'; ?>
              </label>     
              <textarea rows="250" name="template_body" class="form-control tinymce_edittor"><?php if(set_value('template_body')){echo set_value('template_body');}else{ if(!empty($row->template_body)){ echo $row->template_body;}}   ?></textarea>
                 <?php echo form_error('template_body'); ?>
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