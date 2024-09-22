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
                  <h3>Service Management</h3>
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
                 <?php 
				 if(isset($_GET['id']))
				 {
					 $data = $service->query("select * from tbl_service where id=".$_GET['id']."")->fetch_assoc();
					 ?>
					 <form method="POST"  enctype="multipart/form-data">
								
								<div class="row">
<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Image</label>
									<input type="file" name="cat_img"   class="form-control">
									<br>
									<img src="<?php echo $data['img'];?>" width="170" height="170"/>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Video</label>
									<input type="file" name="cat_video" class="form-control">
									<br>
									<video width="170" height="170" controls>
  <source src="<?php echo $data['video'];?>" type="video/mp4">
  
</video>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Title</label>
									<input type="text" name="mtitle" placeholder="Enter Service Title" value="<?php echo $data['title'];?>" class="form-control"  required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Discount</label>
									<input type="text"  name="sdisc" placeholder="Enter Service Discount" value="<?php echo $data['discount'];?>" class="form-control numberonly"  required>
								</div>
								</div>
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Time Taken</label>
									<input type="text"  name="stime" placeholder="Enter Service Time Taken(Mintues)" value="<?php echo $data['take_time'];?>" class="form-control numberonly" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Max Quantity</label>
									<input type="text"  name="mqty" placeholder="Enter Service Max Quantity" value="<?php echo $data['max_quantity'];?>" class="form-control numberonly"  required>
								</div>
								</div>
								
								
                             
							
							 

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Service Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Service Status</option>
									<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($data['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Which Thing Show ?</label>
									<select name="thing" class="form-control" required>
									<option value="">Select Thing</option>
									<option value="1" <?php if($data['service_type'] == 1){echo 'selected';}?>>Video</option>
									<option value="0" <?php if($data['service_type'] == 0){echo 'selected';}?>>Images</option>
									
									</select>
								</div>
							</div>							
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Price</label>
									<input type="hidden" name="type" value="edit_service"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
									<input type="text" step="any" name="price" placeholder="Enter Service Price" value="<?php echo $data['price'];?>" class="form-control numberonly"  required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Category</label>
									<select name="cat" id="sel_cat" class="form-control select2-single" required>
									<option value="" selected disabled>Select
Category</option>
									<?php 
									$web = $service->query("select * from tbl_category  where id IN(".$sdata['catid'].") and status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['cat_id']){echo 'selected';}?>><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Sub Category</label>
									<select name="subcat" id="sel_subcat" class="form-control select2-single">
									<option value="" selected disabled>Select
Subcategory</option>
<?php 
									$web = $service->query("select * from tbl_subcategory  where cat_id =".$data['cat_id']." and vendor_id=".$sdata['id']." and status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>" <?php if($row['id'] == $data['sub_id']){echo 'selected';}?>><?php echo $row['title'];?></option>
										<?php 
									}
									?>
</select>
									
									</select>
								</div>
								</div>
								
								
								
								
								

											
											
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Service Description </label>
									<textarea class="form-control" rows="5" id="mdesc" name="sdescription" style="resize: none;"><?php echo $data['service_desc'];?></textarea>
								</div>
							</div>							
								
							</div>
                                    <button type="submit" class="btn btn-primary">Edit Service</button>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  enctype="multipart/form-data">
								
								<div class="row">
<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Image</label>
									<input type="file" name="cat_img"   class="form-control" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Video</label>
									<input type="file" name="cat_video" class="form-control" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Title</label>
									<input type="text" name="mtitle" placeholder="Enter Service Title" class="form-control"  required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Discount</label>
									<input type="text"  name="sdisc" placeholder="Enter Service Discount" class="form-control numberonly"  required>
								</div>
								</div>
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Time Taken</label>
									<input type="text"  name="stime" placeholder="Enter Service Time Taken(Mintues)" class="form-control numberonly" required>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Max Quantity</label>
									<input type="text"  name="mqty" placeholder="Enter Service Time Taken(Mintues)" class="form-control numberonly"  required>
								</div>
								</div>
								
								
                             
							
							 

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Service Status </label>
									<select name="status" class="form-control" required>
									<option value="">Select Service Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Which Thing Show ?</label>
									<select name="thing" class="form-control" required>
									<option value="">Select Thing</option>
									<option value="1">Video</option>
									<option value="0">Images</option>
									
									</select>
								</div>
							</div>							
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Price</label>
									<input type="hidden" name="type" value="add_service"/>
									<input type="text" step="any" name="price" placeholder="Enter Service Price" class="form-control numberonly"  required>
								</div>
								</div>
								
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Category</label>
									<select name="cat" id="sel_cat" class="form-control select2-single" required>
									<option value="" selected disabled>Select
Category</option>
									<?php 
									$web = $service->query("select * from tbl_category  where id IN(".$sdata['catid'].") and status=1");
									while($row = $web->fetch_assoc())
									{
										?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
										<?php 
									}
									?>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group mb-3">
									<label>Service Sub Category</label>
									<select name="subcat" id="sel_subcat" class="form-control select2-single">
									<option value="" selected disabled>Select
Subcategory</option>
</select>
									
									</select>
								</div>
								</div>
								
								
								
								
								

											
											
							
							

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group mb-3">
									<label for="cname">Service Description </label>
									<textarea class="form-control" rows="5" id="mdesc" name="sdescription" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>
                                    <button type="submit" class="btn btn-primary">Add Service</button>
                                </form>
				 <?php } ?>
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