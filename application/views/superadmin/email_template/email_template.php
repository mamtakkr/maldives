<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Email Template List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Email Template List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="" method="get">
    <div class="filter_box" style="width:150px">
      <label>Template ID</label>
      <input type="text" name="category_id" value="<?php if($this->input->get('category_id')){echo $this->input->get('category_id');}?>" class="form-control"  placeholder="Search Category ID">
    </div>
    <div class="filter_box" style="width:">
      <label>Template Title</label>
      <input type="text" name="templateTitle" value="<?php if($this->input->get('templateTitle')){echo $this->input->get('templateTitle');}?>" class="form-control"  placeholder="Search Template Title">
    </div>
     <div class="filter_box" style="width:">
      <label>Template Subject</label>
      <input type="text" name="template_subject" value="<?php if($this->input->get('template_subject')){echo $this->input->get('template_subject');}?>" class="form-control"  placeholder="Search Template Subject">
    </div>
    <div class="filter_box" style="width:">
      <label>Order</label>
      <select class="form-control" name="order">
        <option value="DESC" <?php if($this->input->get('order')&&$this->input->get('order')=='DESC'){echo 'selected';} ?>>New</option>
        <option value="ASC" <?php if($this->input->get('order')&&$this->input->get('order')=='ASC'){echo 'selected';} ?>>Old</option>
      </select>
    </div> 
    <div class="filter_box" style="width: 80px;">
      <button type="submit" class="btn btn-primary search_btn">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
      <a href="<?php echo current_url();?>" class="btn btn-danger search_btn">
        <i class="fa fa-refresh" aria-hidden="true"></i>
      </a>
    </div>
  </form>
</section>
<?php
$status_array = array('1'=>'Active','2'=>'Deactive','4'=>'Pending');?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">            
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tr>
              <head>
                <th class="text-center">S.No.</th> 
                <th class="text-center">ID</th> 
                <th class="text-left">Title</th> 
                <th class="text-left">Template Subject</th>
                <th class="text-center">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center"><?php  echo !empty($res_data->id)?'#'.$res_data->id:'-';?></td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->templateTitle)? ucfirst($res_data->templateTitle):'-';?>
                  </td>
                   <td class="text-left">
                    <?php  echo !empty($res_data->template_subject)? ucfirst($res_data->template_subject):'-';?>
                  </td> 
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'emailTemplate/addEmailTemplate/';?><?php if(!empty($res_data->id)) echo $res_data->id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>                                       
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="6" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No email template records found'; ?>                
                      </span>
                    </td>
                  </tr>              
              <?php } ?> 
             <tbody>         
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">         
          <div class="text-right">
            <?php if(!empty($pagination)) echo $pagination; ?>
          </div>
        </div>
      </div>          
    </div>        
  </div>
</section>