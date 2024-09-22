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
                  <h3>User List Management</h3>
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
				<div class="table-responsive">
                <table class="display" id="basic-1">
                        <thead>
                           <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>mobile</th>
                                                <th>Join Date</th>
                                                <th>Status</th>
                                                <th>Refer Code</th>
                                                <th>Parent Code</th>
                                                <th>Wallet</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											 $stmt = $service->query("SELECT * FROM `tbl_user`");
$i = 0;
while($row = $stmt->fetch_assoc())
{
	$i = $i + 1;
											?>
                                            <tr>
                                                <td><img class="rounded-circle" width="35" height="35" src="<?php echo $row['pro_pic'];?>" alt=""></td>
                                                <td><?php echo $row['name'];?></td>
												<td><?php echo $row['email'];?></td>
												<td><?php echo $row['mobile'];?></td>
												<td><?php echo $row['rdate'];?></td>
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span  data-id="<?php echo $row['id'];?>" data-status="0" data-type="update_status" coll-type="userstatus" class="drop badge badge-danger">Make Deactive</span></td>
												<?php } else { ?>
												
												<td>
												<span data-id="<?php echo $row['id'];?>" data-status="1" data-type="update_status" coll-type="userstatus" class="badge drop  badge-success">Make Active</span></td>
												<?php } ?>
												<td><?php echo $row['code'];?></td>
												<td><?php echo $row['refercode'];?></td>
												<td><?php echo $row['wallet'].$set['currency'];?></td>
                                               												
                                            </tr>
<?php } ?>
                                            
                                        </tbody>
                      </table>
					  </div>
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