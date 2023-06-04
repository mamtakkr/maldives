<div id="ajax_resultss">
   <div id="search_filter_result">  
      <ul class="dashboard-list">
         <?php 
         if(!empty($resorts)){
            foreach($resorts as $resort){?>
            <li id="resort_row_<?php echo $resort->id;?>">
               <div class="listing-content">
                  <div class="listing-main">
                     <div class="listing-cover">
                        <a href="<?php echo base_url('resort-detail?resort_id=').base64_encode($resort->id) ?>">
                           <?php 
                           if(!empty($resort->resort_logo)&& file_exists('uploads/resorts/thumbnails/150_'.$resort->resort_logo)){?>
                              <img src="<?php echo  base_url().'uploads/resorts/thumbnails/150_'.$resort->resort_logo ;?>">
                           <?php }else{?>
                              <img src="<?php echo  FRONT_THEAM_PATH ;?>images/No_Image_Available.jpg">
                           <?php }?>
                        </a>
                     </div>
                     <div class="listing-header">
                        <a href="<?php echo base_url('resort-detail?resort_id=').base64_encode($resort->id) ?>">
                           <h3 class="listing-title">
                              <?php 
                              echo !empty($resort->resort_name)?ucfirst($resort->resort_name):''; 
                              ?>
                           </h3>
                        </a>
                        <div class="listing-location">
                           <span class="listing-country">
                           <?php 
                           echo !empty($resort->maps_location)?ucfirst($resort->maps_location):''; 
                           ?>
                           </span> 
                        </div>
                        <?php 
                           echo !empty($resort->admin_approved=="1" && $resort->status=="1")?'<span class="badge badge-success">Approved</span>':'<span class="badge badge-info">Pending</span>'; 
                        ?>  
                        <div class="listing-menu">
                           <div class="actions">
                              <div class="btn-group">
                                 <span class=" dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> <i class="fa fa-circle" aria-hidden="true"></i> </span>
                                 <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left"> 
                                    <a class="dropdown-item" href="<?php echo base_url('home/add_resort?resort_id='.base64_encode($resort->id)); ?>">
                                       Edit
                                    </a> 
                                    <a class="dropdown-item" href="<?php echo base_url('resort-detail?resort_id='.base64_encode($resort->id)) ?>">
                                      View
                                   </a>                                                      
                                    <!--<a class="dropdown-item" href="javascript:void(0);" -->
                                    <!--onclick="delete_resort('<?php echo $resort->id;?>')">-->
                                    <!--   Delete-->
                                    <!--</a>  -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="listing-text">
                        <p>Add on <?php echo !empty($resort->created_date)?date('F d Y', strtotime($resort->created_date)):'' ?></p>
                     </div>
                     <div class="listing_last_date">
                        <p>Last updated: <?php echo !empty($resort->updated_date)?date('F d Y', strtotime($resort->updated_date)):'' ?></p>
                     </div>
                
                  </div>
               </div>
            </li>
         <?php 
            }
         }
         ?>                   
      </ul>
      <div class="box-footer">
         <?php 
            echo  $this->pagination->create_links();    
         ?>
      </div>
   </div>   
</div>