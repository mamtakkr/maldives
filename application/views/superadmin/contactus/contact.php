<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Contact Details List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Contact Details List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="" method="get">
    <?php 
    if(admin_type()!='3'){?>
      <div class="filter_box" style="width:">
        <label>Country ID</label>
         <select name="country_id" id="country_id" class="form-control">
          <option value="">All Country</option>
          <?php
          if(!empty($countrys)){ 
            foreach($countrys as $country){
              if($this->input->get('country_id')&&$this->input->get('country_id')==$country->id){
                echo '<option selected value="'.$country->id.'">'.ucwords($country->en_country_name).'</option>';
              }else{
                echo '<option value="'.$country->id.'">'.ucwords($country->en_country_name).'</option>';
              }
            }
          }
        ?>                  
        </select>
      </div>
    <?php }?>
    <div class="filter_box" style="width:">
      <label>Name</label>
      <input type="text" name="contact_name" value="<?php if($this->input->get('contact_name')){echo $this->input->get('contact_name');}?>" class="form-control"  placeholder="Search Name(English)">
    </div>
    <div class="filter_box" style="width:200px">
      <label>Address</label>
      <input type="text" name="conatct_us_address" value="<?php if($this->input->get('conatct_us_address')){echo $this->input->get('conatct_us_address');}?>" class="form-control"  placeholder="Search Address(English)">
    </div>
    <div class="filter_box" style="width:200px">
      <label>Contact Number</label>
      <input type="text" name="conatct_us_mobile_no" value="<?php if($this->input->get('conatct_us_mobile_no')){echo $this->input->get('conatct_us_mobile_no');}?>" class="form-control"  placeholder="Search Contact Number(English)">
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
$status_array = array('1'=>'Active','2'=>'Deactive','4'=>'Pending');
$admin_user   = get_admin_info(superadmin_id());
?>
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
                <th class="text-left">Country</th>
                <th class="text-left">Contact Name(Arabic)</th>
                <th class="text-left">Contact Name(English)</th>
                <th class="text-left">Contact Name(Turkish)</th>
                <th class="text-left">Contact Address</th>
                <?php 
                echo !empty($admin_user->edit_permission)?'<th width="7%" class="text-center">Status</th>':''; 
                if(!empty($admin_user->edit_permission)||!empty($admin_user->delete_permission)){  
                  echo '<th class="text-center">Action</th>';
                }?>
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($contacts)){
              foreach ($contacts as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-left"><?php  echo !empty($res_data->en_country_name)?$res_data->en_country_name:'-';?></td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->conatct_us_name_ab)?ucfirst($res_data->conatct_us_name_ab):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->conatct_us_name_en)?ucfirst($res_data->conatct_us_name_en):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->conatct_us_name_tr)?ucfirst($res_data->conatct_us_name_tr):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->address_location)?ucfirst($res_data->address_location):'-';?>
                  </td>                   
                  <?php 
                  if(!empty($admin_user->edit_permission)){ ?>                
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
                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('contact_details','contact details','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else if($k==3){ echo 'delete';}else{ echo 'deactive';}?>','id','status');">
                              <?php echo $status_a; ?>
                            </a>
                          </li>
                          <?php } 
                         } ?>          
                        </ul>
                      </div>
                    </td>
                  <?php }
                  if(!empty($admin_user->edit_permission)||!empty($admin_user->delete_permission)){ ?> 
                    <td class="text-center"> 
                      <?php 
                      if(!empty($admin_user->edit_permission)){ ?> 
                        <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'contactus/add_contact/';?><?php if(!empty($res_data->id)) echo $res_data->id;?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                         </a>   
                       <?php 
                       }if(!empty($admin_user->delete_permission)){ ?> 
                         <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('contact_details','Contact details','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');");">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                         </a> 
                      <?php }?>                                       
                    </td>
                  <?php }?>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr>
                    <td colspan="6" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No contact details records found'; ?>                
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