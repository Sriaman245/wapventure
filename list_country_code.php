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
                  <h3>Country Code List Management</h3>
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
											<th>Sr No.</th>
											<th>Country Code Title</th>
											
												<th>Country Code Status</th>
												<th>Action</th>
									</tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $service->query("select * from tbl_code");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['ccode']; ?>
                                                </td>
                                                
                                               
                                                
                                               
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge badge-success">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge badge-danger">Unpublish</span></td>
												<?php } ?>
                                                <td style="white-space: nowrap; width: 15%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                           <div class="btn-group btn-group-sm" style="float: none;">
										   <a href="add_country_code.php?id=<?php echo $row['id'];?>" class="tabledit-edit-button" style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#79F9B4"/><path d="M22.5168 9.34109L20.6589 7.48324C20.0011 6.83703 18.951 6.837 18.2933 7.49476L16.7355 9.06416L20.9359 13.2645L22.5052 11.7067C23.163 11.0489 23.163 9.99885 22.5168 9.34109ZM15.5123 10.2873L8 17.8342V22H12.1658L19.7127 14.4877L15.5123 10.2873Z" fill="#25314C"/></svg></a>
										   <a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" class="tabledit-delete-button  del" data-type="code_delete" style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#FFC0AC"/><path d="M23.75 9C23.75 9.414 23.414 9.75 23 9.75H7C6.586 9.75 6.25 9.414 6.25 9C6.25 8.586 6.586 8.25 7 8.25H11.214C11.307 8.068 11.379 7.862 11.456 7.632L11.658 7.02499C11.862 6.41299 12.435 6 13.081 6H16.919C17.565 6 18.138 6.41299 18.342 7.02499L18.544 7.632C18.621 7.862 18.693 8.068 18.786 8.25H23C23.414 8.25 23.75 8.586 23.75 9ZM21.56 10.75C21.733 10.75 21.871 10.897 21.859 11.07L21.19 21.2C21.08 22.78 20.25 24 18.19 24H11.81C9.75 24 8.92 22.78 8.81 21.2L8.141 11.07C8.13 10.897 8.267 10.75 8.44 10.75H21.56ZM13.75 14C13.75 13.59 13.41 13.25 13 13.25C12.59 13.25 12.25 13.59 12.25 14V19C12.25 19.41 12.59 19.75 13 19.75C13.41 19.75 13.75 19.41 13.75 19V14ZM17.75 14C17.75 13.59 17.41 13.25 17 13.25C16.59 13.25 16.25 13.59 16.25 14V19C16.25 19.41 16.59 19.75 17 19.75C17.41 19.75 17.75 19.41 17.75 19V14Z" fill="#25314C"/></svg></a>
										   </div>
                                           
                                       </div></td>
                                                </tr>
											<?php 
										}
										?>
                                           
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