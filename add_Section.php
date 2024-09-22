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
                  <h3>Section Management</h3>
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
					 $data = $service->query("select * from tbl_section where id=".$_GET['id']."")->fetch_assoc();
					 ?>
					 <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="card-body">
                                        
										<div class="form-group mb-3">
                                            <label>Section Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Title" value="<?php echo $data['title'];?>"name="title"  required="">
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Section Category</label>
                                           <select name="catsearch" id="product" class="select2-single form-control" required>
										   <option value="" selected disabled>Select
Category</option>
									  <?php 
$zone = $service->query("select * from tbl_category");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>" <?php if($data['cat_id'] == $row['id']){echo 'selected';}?>><?php echo $row['title'];?></option>
	<?php 
}
?>
									   </select>
											<input type="hidden" name="type" value="edit_section"/>
											<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Section Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
											<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Edit  Section</button>
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
                                            <label>Section Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Title" name="title"  required="">
                                        </div>
										
                                        <div class="form-group mb-3">
                                            <label>Section Category</label>
                                           <select name="catsearch" id="product" class="select2-single form-control" required>
										   <option value="" selected disabled>Select
Category</option>
									  <?php 
$zone = $service->query("select * from tbl_category");
while($row = $zone->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
									   </select>
											<input type="hidden" name="type" value="add_section"/>
                                        </div>
										
										
										
										 <div class="form-group mb-3">
                                            <label>Section Status</label>
                                            <select name="status" class="form-control" required>
											<option value="">Select Status</option>
											<option value="1">Publish</option>
											<option value="0">UnPublish</option>
											</select>
                                        </div>
                                        
										
                                    </div>
                                    <div class="card-footer text-left">
                                        <button  class="btn btn-primary">Add Section</button>
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