<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       <section class="content">

          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="<?php echo base_url();?>superadmin/superadmin/dashboard">return to dashboard</a>.
                <br/><br/>
                <a href="javascript:void(0)" onclick="goBack()" class="btn btn-info" title="Back">Back</a>
              </p>
              
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section>        
     </div>
<script>
  function goBack() {
      window.history.back();
  }
</script>