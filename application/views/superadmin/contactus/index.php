<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Contact Us List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Contact Us List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="" method="get">
    <div class="filter_box" style="width:">
      <label>Contact ID</label>
      <input type="text" name="contact_id" value="<?php if($this->input->get('contact_id')){echo $this->input->get('contact_id');}?>" class="form-control"  placeholder="Search Contact ID">
    </div>
    <div class="filter_box" style="width:">
      <label>Contact Name</label>
      <input type="text" name="name" value="<?php if($this->input->get('name')){echo $this->input->get('name');}?>" class="form-control"  placeholder="Search Contact Name">
    </div>
     <div class="filter_box" style="width:">
      <label>Email</label>
      <input type="text" name="email" value="<?php if($this->input->get('email')){echo $this->input->get('email');}?>" class="form-control"  placeholder="Search Contact Email">
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
                <th class="text-center">Contact Us ID</th> 
                <th class="text-left">Contact Name</th>
                <th class="text-left">Contact Email</th>
                <th>Message</th>  
                <th class="text-left">Created Date & Time</th>
                <th class="text-center">Reply</th>
                <th class="text-center">Status</th>   
                <th class="text-center">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($contacts)){
              foreach ($contacts as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center"><?php  echo !empty($res_data->id)?'#'.$res_data->id:'-';?></td>
                  <td class="text-left"><?php  echo !empty($res_data->name)? ucfirst($res_data->name):'-';?></td>
                  <td class="text-left"><?php  echo !empty($res_data->email)? ucfirst($res_data->email):'-';?></td>
                  <td>
                    <?php 
                    if(strlen($res_data->message)>50){
                        echo substr($res_data->message, 0, 50)." ..";
                    }else{   echo $res_data->message ;}?>
                  </td>
                  <td class="text-left">
                    <?php  echo !empty($res_data->created)? date('d M Y h:i A', strtotime($res_data->created)):'-';?>
                  </td>
                  <td class="ms2" style="text-align:center">
                    <?php if($res_data->status==0) { echo "<label class='label label-warning label-mini'> No </label>"; }else{ echo "<label class='label label-primary label-mini'> Yes </label>"; }   ?>
                </td>
                <td class="ms2" style="text-align:center">
                  <?php if($res_data->read_status==0) { echo "<label class='label label-danger label-mini'> Unread </label>"; }else{ echo "<label class='label label-success label-mini'> Read </label>"; }   ?>                    
                </td> 
                <td class="ms1 ms" style="text-align:center">
                  <a href="<?php echo base_url().'superadmin/contactus/contactus_reply/'.$res_data->id ?>" class="btn btn-primary btn-xs tooltips rpl" rel="tooltip"  data-placement="left" data-original-title="Reply" >
                    Reply
                  </a>
                  <a href="javascript:void(0);" onclick="getPreview('<?php  echo !empty($res_data->id)? $res_data->id:'';?>');" class="btn btn-info btn-xs tooltips rpl" rel="tooltip" data-toggle="modal" data-target="#myModal">
                    Preview
                  </a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('contact_us','contact email','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');");">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>  
                </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="10" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No contact records found'; ?>                
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Details</h4>
      </div>
      <div class="modal-body" id="contact_details"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function getPreview(id='') {
    $.ajax({ 
      url:"<?php echo base_url(); ?>superadmin/contactus/contact_us_details/"+id,
      type:"GET",
      success: function(html){
        $('#contact_details').html(html);
      }
    });
  }
</script>