<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Caption List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Caption List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'cms/caption';?>" method="get">
    <div class="filter_box" style="width:180px;">
      <label>Caption ID</label>
      <input type="text" name="caption_id" value="<?php if($this->input->get('caption_id')){echo $this->input->get('caption_id');}?>" class="form-control"  placeholder="Search Caption ID">
    </div>
    <div class="filter_box" style="width:220px;">
      <label>Caption Title</label>
      <input type="text" name="caption_title" value="<?php if($this->input->get('caption_title')){echo $this->input->get('caption_title');}?>" class="form-control"  placeholder="Search caption title">
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
                <th class="text-center">Caption ID</th> 
                <th class="text-left">Page</th>
                <th class="text-left">Caption Title</th>
                <th class="text-left">Caption Sub Title</th>
                <th class="text-center">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
            $pages = array('home'=>'Home', 'home/resorts' =>'Resorts', 'home/inspire_me' =>'Inspire Me', 'home/maldives' =>'Maldives', 'home/reviews' =>'Reviews', 
                            'home/term_and_services' =>'Term & Services', 'home/blogs' =>'Blogs', 'home/privacy_policy'=>'Privacy Policy','home/transfers' =>'Transfer',
                            'home/galllery'=>'Galllery','home/compare'=>'Compare','home#banner'=>'Home/banner','home/compare#banner'=>'Compare/banner');
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center">
                    <?php  echo !empty($res_data->id)? ucfirst($res_data->id):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php 
                    if(!empty($pages)){
                      foreach($pages as $key => $page){
                        if(!empty($res_data->page_url)&&$res_data->page_url==$key){ 
                          echo ucfirst($page);
                        }                   
                      }
                    }
                    ?>
                  </td>
                  <td class="text-left">
                    <?php  
                      echo !empty($res_data->caption_title)? ucfirst($res_data->caption_title):'-';
                    ?>
                  </td>
                  <td class="text-left">
                    <?php  
                      echo !empty($res_data->caption_sub_title)? ucfirst($res_data->caption_sub_title):'-';
                    ?>
                  </td>                   
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'cms/add_caption/';?><?php if(!empty($res_data->id)) echo $res_data->id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <!-- <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('captions','caption','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');");">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                     </a>   -->                                      
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="8" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No caption records found'; ?>                
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