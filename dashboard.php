<?php 
include 'controller/head.php';
?>
  <body>     
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader">
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-bar"></div>
        <div class="loader-ball"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php include 'controller/nav.php'; ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
       <?php 
	   include 'controller/sidebar.php';
	   ?>
        <!-- Page Sidebar Ends-->
		<?php 
		if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
			?>
			<div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Dashboard</h3>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget dashboardt">
            <div class="row">
              
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Sub Category</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_subcategory where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon2.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
			  <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Services</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_service where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon12.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Timeslot</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_timeslot where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon7.svg" class="img-80">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Partner</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_partner where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon4.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Pending Service</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Pending' and vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon6.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Delivered Service </h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Completed' and vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon7.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Cancelled Service</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Cancelled' and vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon8.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
			  
			  <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Coupon</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_coupon where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon6.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Cover</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_cover where vendor_id=".$sdata['id']."")->num_rows;?></h4>
                      </div>
                       <img src="assets/dashboard/icon9.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Overall Rating</h6>
                        <h4 class="mb-0 counter"><?php 
										$checkrate = $service->query("SELECT *  FROM tbl_order where vendor_id=".$sdata['id']." and o_status='Completed' and provider_rate !=0")->num_rows;
		if($checkrate !=0)
		{
			$rdata_rest = $service->query("SELECT sum(provider_rate)/count(*) as rate_rest FROM tbl_order where vendor_id=".$sdata['id']." and o_status='Completed' and provider_rate !=0")->fetch_assoc();
			echo number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
		echo $sdata['rate'];
		}
		?></h4>
                      </div>
                     <img src="assets/dashboard/icon10.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Shop Open Or Close ?</h6>
                        <h4 class="mb-0 counter"><?php if($sdata['rstatus']==1) { 
	?>
	<h3><a class="drop" data-id="<?php echo $sdata['id'];?>" data-status="0" data-type="update_status" coll-type="shopstatus" href="javascript:void(0);"><button class="btn shadow-z-2 btn-danger">Make Shop Close</button></a></h3>
	<?php }else { ?>
	<h3><a class="drop" data-id="<?php echo $sdata['id'];?>" data-status="1" data-type="update_status" coll-type="shopstatus" href="javascript:void(0);"><button class="btn shadow-z-2 btn-success">Make Shop Open</button></a></h3>
	<?php } ?></h4>
                      </div>
                     <img src="assets/dashboard/icon11.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Sales(Not Included Tax And Coveince fee)</h6>
                        <h4 class="mb-0 counter"><?php $sales  = $service->query("select sum((o_total-(tax+conv_fee)) - (o_total-(tax+conv_fee)) * pcommission/100) as full_total from tbl_order where o_status='Completed'  and  vendor_id=".$sdata['id']."")->fetch_assoc();
            $payout =   $service->query("select sum(amt) as full_payout from payout_setting where vendor_id=".$sdata['id']."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){echo $bs.' '.$set['currency'];}else {echo  number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', '').' '.$set['currency']; } ?></h4>
                      </div>
                     <img src="assets/dashboard/icon12.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
			<?php 
		}
		else 
		{
			?>
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Dashboard</h3>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget dashboardt">
            <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Banner</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from banner")->num_rows;?></h4>
                      </div>
                       <img src="assets/dashboard/icon1.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Category</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_category")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon2.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Service Provider</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from service_details")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon3.svg" class="img-80">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">New User</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_user")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon4.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Pending Service</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Pending'")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon6.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Delivered Service </h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Completed'")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon7.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Cancelled Service</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_order where o_status='Cancelled'")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon8.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
			  
			  <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total FAQ</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_faq")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon6.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Home Section</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_section")->num_rows;?></h4>
                      </div>
                       <img src="assets/dashboard/icon9.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget mb-0">
                      <div class="media-body">
                        <h6 class="font-roboto">Pages</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_page")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon10.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Service Zone </h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from zones")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon11.svg" class="img-100">
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="card-body">
                    <div class="media static-widget">
                      <div class="media-body">
                        <h6 class="font-roboto">Total Services</h6>
                        <h4 class="mb-0 counter"><?php echo $service->query("select * from tbl_service")->num_rows;?></h4>
                      </div>
                     <img src="assets/dashboard/icon12.svg" class="img-100">

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
	<?php } } ?>
      </div>
    </div>
    <!-- latest jquery-->
   <?php include 'controller/service.php';?>
    <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>