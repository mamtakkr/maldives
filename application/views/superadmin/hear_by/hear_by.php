<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Hear By List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Hear By List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'hear_by';?>" method="get">
    <div class="filter_box" style="width:150px">
      <label>Hear By ID</label>
      <input type="text" name="hear_by_id" value="<?php if($this->input->get('hear_by_id')){echo $this->input->get('hear_by_id');}?>" class="form-control"  placeholder="Search hear by ID">
    </div>
    <div class="filter_box" style="width:">
      <label>Hear By</label>
      <input type="text" name="hear_by" value="<?php if($this->input->get('hear_by')){echo $this->input->get('hear_by');}?>" class="form-control"  placeholder="Search hear by">
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
                <th class="text-center">Hear by ID</th> 
                <th class="text-left">Hear by</th>
                <th class="text-center">Status</th>   
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
                  <td class="text-center">
                    <?php  echo !empty($res_data->id)? ucfirst($res_data->id):'-';?>
                  </td>  
                   <td class="text-left">
                    <?php  echo !empty($res_data->hear_by)? ucfirst($res_data->hear_by):'-';?>
                  </td>                              
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($res_data->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                      foreach($status_array as $k => $status_a)
                      {
                        if(!empty($res_data->status) && $k == $res_data->status) 
                          echo $status_a;
                      }
                       ?>
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <?php
                         foreach($status_array as $k => $status_a){
                            if(!empty($res_data->status) && $k != $res_data->status&&$k != 4){
                        ?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('hear_by','hear by','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else if($k==3){ echo 'delete';}else{ echo 'deactive';}?>','id','status');">
                            <?php echo $status_a; ?>
                          </a>
                        </li>
                        <?php } 
                       } ?>          
                      </ul>
                    </div>
                  </td>
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'hear_by/add_hear_by/';if(!empty($res_data->id)) echo $res_data->id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('hear_by','hear by','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');");">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                     </a>                                        
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="5" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No hear by records found'; ?>                
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