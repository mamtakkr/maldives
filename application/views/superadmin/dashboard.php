<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  #dash_board_custom .margin_bottom_20 {
    min-height: 240px;
}
</style>
<div id="dash_board_custom">
  <!-- Content Header (Page header) -->
  <section class="content-header title_containt">
    Hello 
    <span class="user_names_s">
      <?php echo superadmin_name();?>
    </span>, 
    Welcome to the <span class="site_name"><?php echo site_info('site_title'); ?></span> Admin............. <i class="fa fa-smile-o" aria-hidden="true"></i>      
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">        
      <?php 
      $admin_type = admin_type();
      $segment1   =   $this->uri->segment(2);
      $segment2   =   $this->uri->segment(3);
      if(!empty($segment2)){
        $urlSegment = strtolower($segment1)."/".strtolower($segment2);
      }else{
        $urlSegment = strtolower($segment1);
      }
      if(!empty($admin_type)&&$admin_type==1){
      ?>  
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
             <i class="fa fa-users" aria-hidden="true"></i>
              Users    
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound">   
                <li>
                  <a href="<?php echo ADMIN_URL.'customer/users'; ?>">
                    User List  <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('users', array('user_type'=>'1')); ?></span>
                  </a>
                </li> 
                <li>
                  <a href="<?php echo ADMIN_URL.'customer/hotels'; ?>">
                    Hotel List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('users', array('user_type'=>'2')); ?></span>
                  </a>
                </li> 
            </ul>
          </div>
        </div>
      </div> 
      <?php }?>
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
             <i class="fa fa-list" aria-hidden="true"></i>
              Resorts    
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound">  
                <?php if(!empty($admin_type)&&$admin_type==1){?>
                <li>
                  <a href="<?php echo ADMIN_URL.'resorts'; ?>">
                    Resorts List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('resorts', array('status !='=>'3')); ?></span>
                  </a>
                </li> 
                <?php }?>
                <li>
                  <a href="<?php echo ADMIN_URL.'resorts/resort_story'; ?>">
                    Resort Stories List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('resort_stories', array('status !='=>'3')); ?></span>
                  </a>
                </li> 
                <li>
                  <a href="<?php echo ADMIN_URL.'resorts/traveller_story'; ?>">
                    Traveller Stories List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('traveller_stories', array('status !='=>'3')); ?></span>
                  </a>
                </li> 
            </ul>
          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
             <i class="fa fa-th" aria-hidden="true"></i>
              News & Blogs    
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound">   
                <li>
                  <a href="<?php echo ADMIN_URL.'blogs/add_blog'; ?>">
                    Add News & Blog 
                  </a>
                </li> 
                <li>
                  <a href="<?php echo ADMIN_URL.'blogs'; ?>">
                    News & Blogs List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('news_blog'); ?></span>
                  </a>
                </li> 
            </ul>
          </div>
        </div>
      </div>      
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
             <i class="fa fa-th" aria-hidden="true"></i>
              New Resorts
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound"> 
                <li>
                  <a href="<?php echo ADMIN_URL.'resorts'; ?>">
                    New Resorts List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('resorts', array('status ='=>'1')); ?></span>
                  </a>
                </li> 
                <li>
                  <a href="<?php echo ADMIN_URL.'resorts/villalist'; ?>">
                    Villa List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('accommodation'); ?></span>
                  </a>
                </li> 
                <li>
                  <a href="<?php echo ADMIN_URL.'experience_category'; ?>">
                    Experience Category List <span class="label label-success pull-right lable_counter-dash"><?php echo get_all_count('experience_category', array('status ='=>'1')); ?></span>
                  </a>
                </li> 
            </ul>
          </div>
        </div>
      </div>   
      <?php if(!empty($admin_type)&&$admin_type==1){?>
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
             <i class="fa fa-cog" aria-hidden="true"></i>
              Setting   
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound">   
              <li>
                <a href="<?php echo ADMIN_URL.'maldives'; ?>">
                  About Maldives
                </a>
              </li> 
              <li>
                <a href="<?php echo ADMIN_URL.'cms/index/Follow_Us'; ?>">
                  Follow Us Link
                </a>
              </li> 
              <li>
                <a href="<?php echo ADMIN_URL.'emailTemplate'; ?>">
                  Email Template
                </a>
              </li> 
            </ul>
          </div>
        </div>
      </div>  
      <?php }?> 
      <div class="col-md-4">
        <div class="box margin_bottom_20">
          <div class="box-header with-border box_heads">
            <h3 class="box-title">
              <i class="fa fa-bookmark" aria-hidden="true"></i>
              Other
            </h3>
          </div>
          <div class="box-body">
            <ul class="secound">  
              <li>
                <a href="<?php echo ADMIN_URL.'superadmin/profile'; ?>">
                  Profile
                </a>
              </li>
              <li>
                <a href="<?php echo ADMIN_URL.'superadmin/change_password'; ?>">
                  Change Password 
                </a>
              </li>
              <li>
                <a href="<?php echo ADMIN_URL.'superadmin/logout'; ?>">
                  Signout
                </a>
              </li>
            </ul> 
          </div>
        </div>
      </div>
    </div>
  </section>
</div>