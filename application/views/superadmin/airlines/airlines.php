<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Airline List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Airline List</li>
  </ol>
</section>

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
                <th class="text-center">Name</th> 
                <th class="text-left">Scheduled</th>
                <th class="text-left">Country</th>
                <th class="text-left">Image</th>
                <th class="text-left">Action</th>
                
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $row){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center">
                    <?php  echo !empty($row->airlines_name)? ucfirst($row->airlines_name):'-';?>
                  </td>  
                  <td class="text-left">
                    <?php  echo !empty($row->scheduled)? ucfirst($row->scheduled):'-';?>
                  </td>
				  <td class="text-left">
                    <?php  echo !empty($row->country)? ucfirst($row->country):'-';?>
                  </td> 
				  <td class="text-left">
                    <?php  if(!empty($row->image)&&file_exists('uploads/transfer/airlines/'.$row->image)){ 
					echo '<img src="'.base_url('uploads/transfer/airlines/'.$row->image).'" height="60px" width="60px"  />'; 
					} ?>
                  </td> 
                  
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'airlines/add_airline/';if(!empty($row->airlines_id)) echo $row->airlines_id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('airlines_travling','Airlines','<?php if(!empty($row->airlines_id)) echo $row->airlines_id; ?>','3','delete','airlines_id','status',1);">
                        <i class='fa fa-trash' aria-hidden='true'></i>
                     </a>                                        
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="11" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No distance place records found'; ?>                
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