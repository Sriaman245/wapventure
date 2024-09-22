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
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Setting Management</h3>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
             
             <div class="col-sm-12">
                <div class="card">
                <div class="card-body">
				
						
						<h5 class="h5_set"><i class="fa fa-gear fa-spin"></i>  General  Information</h5>
				<form method="post" enctype="multipart/form-data">
                                       <div class="row">
									    <div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Website Name</label>
                                            <input type="text" class="form-control " placeholder="Enter Store Name" value="<?php echo $set['webname'];?>" name="webname" required="">
											<input type="hidden" name="type" value="edit_setting"/>
										<input type="hidden" name="id" value="1"/>
                                        </div>
										
                                      <div class="form-group mb-3 col-4" style="margin-bottom: 48px;">
                                            <label><span class="text-danger">*</span> Website Image</label>
                                            <div class="custom-file">
                                                <input type="file" name="weblogo" class="custom-file-input form-control">
                                                <label class="custom-file-label">Choose Website Image</label>
												<br>
												<img src="<?php echo $set['weblogo'];?>" width="60" height="60"/>
                                            </div>
                                        </div>
										
										<div class="form-group mb-3 col-4">
									<label for="cname">Select Timezone</label>
									<select name="timezone" class="form-control" required>
									<option value="">Select Timezone</option>
									<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $set['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Currency</label>
                                            <input type="text" class="form-control" placeholder="Enter Currency"  value="<?php echo $set['currency'];?>" name="currency" required="">
                                        </div>
										
										
										
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Minimum Payout for Service Provider</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Payout for Store"  value="<?php echo $set['pstore'];?>" name="pstore" required="">
                                        </div>
										
										
										
	
	<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-signal"></i> Onesignal Information</h5>
										</div>
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> User App Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter User App Onesignal App Id"  value="<?php echo $set['one_key'];?>" name="one_key" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> User  App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter User Boy App Onesignal Rest Api Key"  value="<?php echo $set['one_hash'];?>" name="one_hash" required="">
                                        </div>
	
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> Service Partner App Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter Service Partner App Onesignal App Id"  value="<?php echo $set['d_key'];?>" name="d_key" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> Service Partner App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter Service Partner App Onesignal Rest Api Key"  value="<?php echo $set['d_hash'];?>" name="d_hash" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> Service Provider Onesignal App Id</label>
                                            <input type="text" class="form-control " placeholder="Enter Service Provider Onesignal App Id"  value="<?php echo $set['s_key'];?>" name="s_key" required="">
                                        </div>
										
										<div class="form-group mb-3 col-6">
                                            <label><span class="text-danger">*</span> Service Provider App Onesignal Rest Api Key</label>
                                            <input type="text" class="form-control " placeholder="Enter Service Provider Onesignal Rest Api Key"  value="<?php echo $set['s_hash'];?>" name="s_hash" required="">
                                        </div>
										
										<div class="form-group mb-3 col-12">
										<h5 class="h5_set"><i class="fa fa-user-plus" aria-hidden="true"></i> Refer And Earn Information</h5>
										</div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Sign Up Credit</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Sign Up Credit"  value="<?php echo $set['scredit'];?>" name="scredit" required="">
                                        </div>
										
										<div class="form-group mb-3 col-4">
                                            <label><span class="text-danger">*</span> Refer Credit</label>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Refer Credit"  value="<?php echo $set['rcredit'];?>" name="rcredit" required="">
                                        </div>
										
										
										
								
								<div class="form-group mb-3 col-4">
										<label for="cname">Convenience Fees?</label>
	<input type="text" class="form-control numberonly"   value="<?php echo $set['cov_fees'];?>" name="cov_fees"  required="">
	</div>
								
										<div class="col-12">
                                                <button type="submit" name="edit_setting" class="btn btn-primary mb-2">Edit Setting</button>
                                            </div>
											</div>
                                    </form> 
								
				</div>
                </div>
              
                
              </div>
              
              
              
              
              
              
              
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
       
      </div>
    </div>
    <!-- latest jquery-->
   <?php include 'controller/service.php';?>
    <!-- login js-->
    <!-- Plugin used-->
  </body>

</html>