<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Faq List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Faq List</li>
  </ol>
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
                <th class="text-center">Question</th> 
                <th class="text-left">Answer</th>
                <th class="text-left">Status</th>
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
                    <?php  echo !empty($row->question)? ucfirst($row->question):'-';?>
                  </td>  
                  <td class="text-left">
                    <?php  echo !empty($row->answer)? ucfirst($row->answer):'-';?>
                  </td> 
                             
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($row->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                      if($row->status!=1){$k=1;}else{$k=0;} if($row->status==1){ echo 'Activate';}else{ echo 'Deactive';}?>
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                       <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('faq','faq','<?php if(!empty($row->faq_id)) echo $row->faq_id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else{ echo 'deactive';}?>','faq_id','status');">
                           <?php if($k==1){ echo 'Activate';}else{ echo 'Deactive';}?>
                          </a>
                        </li>
                               
                      </ul>
                    </div>
                  </td>
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'faq/add_faq/';if(!empty($row->faq_id)) echo $row->faq_id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('faq','faq','<?php if(!empty($row->faq_id)) echo $row->faq_id; ?>','3','delete','faq_id','status',1);">
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