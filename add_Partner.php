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
                  <h3>Partner Management</h3>
                </div>
                
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid general-widget">
            <div class="row">
             
             <div class="col-sm-12">
                <div class="card">
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $service->query("select * from tbl_partner where id=".$_GET['id']." and vendor_id=".$sdata['id']."")->fetch_assoc();
					 ?>
					 <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
										
										
										
										<div class="form-group mb-3">
                                            <label>Partner Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Partner Full Name" value="<?php echo $data['id'];?>" name="title"  required="">
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Partner Email Address</label>
                                            <input type="email" class="form-control" placeholder="Enter Partner Email Address" value="<?php echo $data['email'];?>"name="email"  required="">
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Partner Password</label>
                                            <input type="text" class="form-control" placeholder="Enter  Partner Password" value="<?php echo $data['password'];?>" name="password"  required="">
                                        </div>
										
										<div class="form-group mb-3 row">
                                            <label>Partner Mobile</label>
											<div class="col-md-1">
											<select name="ccode" class="form-control select2-single" required>
											<option value="" selected disabled>Select Country Code</option>
											<?php 
$zone = $service->query("select * from tbl_code where status=1");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['ccode'];?>" <?php if($row['ccode'] == $data['ccode']){echo 'selected';}?>><?php echo $row['ccode'];?></option>
	<?php 
}
?>
											</select>
											</div>
											<div class="col-md-11">
                                            <input type="text" class="form-control numberonly" placeholder="Enter  Partner Mobile" value="<?php echo $data['mobile'];?>" name="mobile"  required="">
											</div>
                                        </div>
										
                                        <div class="form-group mb-3">
                                            <label>Partner Image</label>
                                            <input type="file" class="form-control" name="cat_img" >
											<input type="hidden" name="type" value="edit_partner"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
										<br>
											<img src="<?php echo $data['img']?>" width="150" height="150"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Partner Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1"  <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0"  <?php if($data['status'] == 0){echo 'selected';}?>>UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Edit  Partner</button>
                                    </div>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
										
										
										
										<div class="form-group mb-3">
                                            <label>Partner Full Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Partner Full Name" name="title"  required="">
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Partner Email Address</label>
                                            <input type="email" class="form-control" placeholder="Enter Partner Email Address" name="email"  required="">
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Partner Password</label>
                                            <input type="text" class="form-control" placeholder="Enter  Partner Password" name="password"  required="">
                                        </div>
										
										<div class="form-group mb-3 row">
                                            <label>Partner Mobile</label>
											<div class="col-md-1">
											<select name="ccode" class="form-control select2-single" required>
											<option value="" selected disabled>Select Country Code</option>
											<?php 
$zone = $service->query("select * from tbl_code where status=1");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['ccode'];?>"><?php echo $row['ccode'];?></option>
	<?php 
}
?>
											</select>
											</div>
											<div class="col-md-11">
                                            <input type="text" class="form-control numberonly" placeholder="Enter  Partner Mobile" name="mobile"  required="">
											</div>
                                        </div>
										
                                        <div class="form-group mb-3">
                                            <label>Partner Image</label>
                                            <input type="file" class="form-control" name="cat_img"  required="">
											<input type="hidden" name="type" value="add_partner"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Partner Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Add Partner</button>
                                    </div>
                                </form>
				 <?php } ?>
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