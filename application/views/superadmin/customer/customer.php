<!-- Content Header (Page header) -->
<?php 
  $status_array = array('1'=>'Active','2'=>'Suspend','4'=>'Pending');
?>
<section class="content-header">
  <h1>
    <?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> List
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> 
        Dashboard
      </a>
    </li>
    <li class="active">
      <?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> List
    </li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo (!empty($type)&&$type=='hotel')?ADMIN_URL.'customer/hotels':ADMIN_URL.'customer/users'; ?>" method="get">
    <div class="filter_box" style="width:95px">
      <label><?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> ID</label>
      <input type="text" name="user_id" value="<?php if($this->input->get('user_id')){echo $this->input->get('user_id');}?>" class="form-control"  placeholder="<?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> ID">
    </div> 
    <div class="filter_box" style="width:100px">
      <label><?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> Name</label>
      <input type="text" name="user_name" value="<?php if($this->input->get('user_name')){echo $this->input->get('user_name');}?>" class="form-control"  placeholder="<?php echo (!empty($type)&&$type=='hotel')?'hotel':'User'; ?> Name">
    </div>  
    <div class="filter_box" style="width:200px">
      <label>Email</label>
      <input type="text" name="email" value="<?php if($this->input->get('email')){echo $this->input->get('email');}?>" class="form-control"  placeholder="Email">
    </div> 
     <div class="filter_box" style="width:127px">
      <label>Start Date</label>
      <input type="text" name="start" value="<?php if($this->input->get('start')){echo $this->input->get('start');}?>" class="form-control datepicker" readonly  placeholder="Search Start Date">
    </div> 
     <div class="filter_box" style="width:125px">
      <label>End Date</label>
      <input type="text" name="end" value="<?php if($this->input->get('end')){echo $this->input->get('end');}?>" class="form-control datepicker" readonly  placeholder="Search End Date">
    </div> 
     <div class="filter_box" style="width:100px;">
      <label>Order</label>      
      <select class="form-control" name="order">
        <option value="DESC" <?php if($this->input->get('order')&&$this->input->get('order')=='DESC'){echo 'selected';} ?>>New</option>
        <option value="ASC" <?php if($this->input->get('order')&&$this->input->get('order')=='ASC'){echo 'selected';} ?>>Old</option>
        <option value="NameAtoZ" <?php if($this->input->get('order')&&$this->input->get('order')=='NameAtoZ'){echo 'selected';} ?>>Name A-Z</option>
         <option value="NameZtoA" <?php if($this->input->get('order')&&$this->input->get('order')=='NameZtoA'){echo 'selected';} ?>>Name Z-A</option>
      </select>
    </div> 
    <div class="filter_box" style="width: 221px;">
      <button type="submit" class="btn btn-primary search_btn">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
      <a href="<?php echo current_url();?>" class="btn btn-danger search_btn">
        <i class="fa fa-refresh" aria-hidden="true"></i>
      </a>             
    </div>
  </form>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">            
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <head>
                <th width="50" class="text-center">S.No.</th> 
                <th width="80" class="text-center"><?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> ID</th>   
                <th class="text-left"><?php echo (!empty($type)&&$type=='hotel')?'Hotel':'User'; ?> Name </th>     
                <th class="text-left">Email</th>   
                <th width="11%" class="text-center">Created Date &amp; Time</th>                
                <th width="11%" class="text-center">Last Login</th>   
                <th width="7%" class="text-center">Email Status</th>
                <th width="7%" class="text-center">Status</th>
                <th class="text-center" width="150">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
               $i = $offset + 1;
                if(!empty($users)){
                  foreach ($users as $res_data){?>
                    <tr>
                      <td class="text-center">
                        <?php echo $i; ?>
                      </td> 
                      <td class="text-center">
                      <?php 
                        if(!empty($res_data->id)){
                           echo '#'.$res_data->id;
                        }else{
                          echo '-';
                          }  
                      ?>        
                      </td> 
                      <td class="text-left">      
                        <?php      
                          if(!empty($res_data->user_name)){
                            echo ucfirst($res_data->user_name);
                          }else{
                            echo '-';
                          }                
                        ?>        
                      </td>    
                      <td class="text-left">
                        <?php       
                          if(!empty($res_data->email)) echo $res_data->email;     
                        ?>
                      </td> 
                      <td class="text-center">  
                        <?php 
                          if(!empty($res_data->created_date)){        
                             echo date('d M Y h:i A', strtotime($res_data->created_date)); 
                          }else{ echo '-';} 
                        ?>        
                      </td>
                      <td class="text-center">  
                        <?php 
                          if(!empty($res_data->last_login)&&$res_data->last_login!='0000-00-00 00:00:00'){
                            echo date('d M Y h:i A', strtotime($res_data->last_login));
                          }else{ echo '-';} 
                        ?>        
                      </td>
                      <td class="text-center"> 
                      <div class="dropdown">
                        <button class="<?php echo !empty($res_data->is_email_verify)?btnOrder($res_data->is_email_verify):btnOrder(4);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                         if(!empty($res_data->is_email_verify) && $res_data->is_email_verify=='1'){
                            echo 'Verified';
                          }else{
                            echo 'Pending';
                          } 
                        if(empty($res_data->is_email_verify)){ ?>
                        <span class="caret"></span></button>  
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                          <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="VerifyUser('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                              Verify Email
                            </a>
                          </li>
                          <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="VerifyUserEmail('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                              Send Verification Email
                            </a>
                          </li>
                        </ul>
                        <?php }?>
                      </div>          
                    </td>  
                    <td class="text-center"> 
                      <div class="dropdown">
                        <button class="<?php echo btnOrder($res_data->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown">
                        <?php 
                          foreach($status_array as $k => $status_a){
                            if(!empty($res_data->status) && $k == $res_data->status) 
                              echo $status_a;
                          }
                        ?><span class="caret"></span></button>  
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                           <?php
                           foreach($status_array as $k => $status_a)
                            {
                              if(!empty($res_data->status) && $k != $res_data->status&&$k != 4)
                              {
                          ?>
                          <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeUserStatus('<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else if($k==3){ echo 'delete';}else{ echo 'suspend';}?>');">
                              <?php echo $status_a; ?>
                            </a>
                          </li>
                          <?php } 
                         } ?>          
                        </ul>
                      </div>
                    </td>
                    <td class="text-center">   
                      <a title="Customer Details" data-toggle="modal" onclick="userInfo('<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php if(!empty($res_data->first_name)) echo ucwords($res_data->first_name); if(!empty($res_data->last_name)) echo ' '.ucwords($res_data->last_name); ?>')" data-target="#userDetails" class="btn btn-primary btn-sm tooltips" >
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('users','<?php echo (!empty($type)&&$type=='hotel')?'hotel':'user'; ?>','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');")>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>  
                      <?php 
                      if(!empty($res_data->user_type)&&$res_data->user_type==2){?>
                        <a class="btn btn-sm btn-info" href="<?php echo ADMIN_URL.'resorts?user_id='.$res_data->id.'&user_name='.$res_data->first_name ?>" title="Resorts List">
                          <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                      <?php }  ?>                    
                    </td> 
                  </tr>
                <?php $i++;
                    } 
                  }else{?>
                      <tr >
                        <td colspan="10" class="text-center text-danger">
                          <span class="data-not-present">
                            <?php echo 'No user records found'; ?>                
                          </span>
                        </td>
                      </tr>              
              <?php } ?> 
             </tbody>         
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
<!-- Modal -->
<div class="modal fade" id="userDetails" role="dialog">
  <div class="modal-dialog" id="modal-box" style="width: 1000px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="row">
            <div class="col-md-12"> 
              <h4 class="modal-title text-center">
                <b>
                  <span id="customerName" style="color: #fff;"></span>
                </b>
              </h4>
            </div>
          </div>
      </div>
      <div class="modal-body">
        <div class="row" id="user_info"></div>                      
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- /.content -->
<script type="text/javascript">
    function userInfo(customerID='', customerName=''){
      $('#customerName').html(customerName);
      $.ajax({
        url: "<?php echo ADMIN_URL.'customer/customerInfo'; ?>?user_id="+customerID,
        type:'GET',
        success: function(result){  
          $('#user_info').html(result);
        }
      });      
    }
</script>