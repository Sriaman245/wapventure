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
                  <h3>Service Provider List Management</h3>
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
				<?php 
				if(isset($_GET['subcat_id']))
				{
					?>
					<table class="display" id="basic-1">
                        <thead>
                          <tr>
											 <tr>
                                                <th>Sr No.</th>
												<th>Subcategory Name</th>
												<th>Subcategory Image</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $service->query("select * from tbl_subcategory where vendor_id=".$_GET['subcat_id']."");
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
                                                    <?php echo $row['title']; ?>
                                                </td>
                                                
                                               
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="100" height="100"/>
                                                </td>
                                               
												<?php if($row['is_approve'] == 1) { ?>
												
                                                <td><span class="badge badge-success">Approved</span></td>
												<?php } else if($row['is_approve'] == 2){ ?>
												
												<td>
												<span class="badge badge-danger">Rejected</span></td>
												<?php }else{ ?>
												
												<td>
												<a class="drop" data-id="<?php echo $row['id'];?>" data-status="1" data-type="update_status" coll-type="subcat" href="javascript:void(0);"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#FFB901"/>
<path d="M20.75 13V10.75L25.25 15.25H23C21.42 15.25 20.75 14.58 20.75 13ZM20.74 27.6C20.8 27.8 20.66 28 20.46 28H14C12 28 11 27 11 25V13C11 11 12 10 14 10H19.25V13C19.25 15.42 20.58 16.75 23 16.75H26V20.21C26 20.37 25.87 20.5 25.71 20.51C22.82 20.66 20.5 23.07 20.5 26C20.5 26.56 20.58 27.1 20.74 27.6ZM19.75 23C19.75 22.586 19.414 22.25 19 22.25H15C14.586 22.25 14.25 22.586 14.25 23C14.25 23.414 14.586 23.75 15 23.75H19C19.414 23.75 19.75 23.414 19.75 23ZM22 19.75C22.414 19.75 22.75 19.414 22.75 19C22.75 18.586 22.414 18.25 22 18.25H15C14.586 18.25 14.25 18.586 14.25 19C14.25 19.414 14.586 19.75 15 19.75H22ZM30 26C30 28.209 28.209 30 26 30C23.791 30 22 28.209 22 26C22 23.791 23.791 22 26 22C28.209 22 30 23.791 30 26ZM27.604 24.813C27.409 24.618 27.092 24.618 26.897 24.813L25.584 26.126L25.105 25.646C24.91 25.451 24.5929 25.451 24.3979 25.646C24.2029 25.841 24.2029 26.158 24.3979 26.353L25.231 27.186C25.325 27.28 25.452 27.332 25.585 27.332C25.718 27.332 25.845 27.279 25.939 27.186L27.606 25.519C27.799 25.325 27.799 25.009 27.604 24.813Z" fill="white"/>
</svg></a>
												<a class="drop" data-id="<?php echo $row['id'];?>" data-status="2" data-type="update_status" coll-type="subcat" href="javascript:void(0);"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#AEB2F4"/>
<path d="M21.75 13V10.75L26.25 15.25H24C22.42 15.25 21.75 14.58 21.75 13ZM21.74 27.6C21.8 27.8 21.66 28 21.46 28H15C13 28 12 27 12 25V13C12 11 13 10 15 10H20.25V13C20.25 15.42 21.58 16.75 24 16.75H27V20.21C27 20.37 26.87 20.5 26.71 20.51C23.82 20.66 21.5 23.07 21.5 26C21.5 26.56 21.58 27.1 21.74 27.6ZM16.75 23C16.75 22.586 16.414 22.25 16 22.25C15.586 22.25 15.25 22.586 15.25 23C15.25 23.414 15.586 23.75 16 23.75C16.414 23.75 16.75 23.414 16.75 23ZM16.75 19C16.75 18.586 16.414 18.25 16 18.25C15.586 18.25 15.25 18.586 15.25 19C15.25 19.414 15.586 19.75 16 19.75C16.414 19.75 16.75 19.414 16.75 19ZM20.75 23C20.75 22.586 20.414 22.25 20 22.25H18.5C18.086 22.25 17.75 22.586 17.75 23C17.75 23.414 18.086 23.75 18.5 23.75H20C20.414 23.75 20.75 23.414 20.75 23ZM23 19.75C23.414 19.75 23.75 19.414 23.75 19C23.75 18.586 23.414 18.25 23 18.25H18.5C18.086 18.25 17.75 18.586 17.75 19C17.75 19.414 18.086 19.75 18.5 19.75H23ZM31 26C31 28.209 29.209 30 27 30C24.791 30 23 28.209 23 26C23 23.791 24.791 22 27 22C29.209 22 31 23.791 31 26ZM28.604 24.813C28.409 24.618 28.092 24.618 27.897 24.813L26.584 26.126L26.105 25.646C25.91 25.451 25.5929 25.451 25.3979 25.646C25.2029 25.841 25.2029 26.158 25.3979 26.353L26.231 27.186C26.325 27.28 26.452 27.332 26.585 27.332C26.718 27.332 26.845 27.279 26.939 27.186L28.606 25.519C28.799 25.325 28.799 25.009 28.604 24.813Z" fill="white"/>
</svg></a>
												
												</td>
												<?php } ?>
                                                
                                                </tr>
											<?php 
										}
										?>
                                           
                                        </tbody>
                      </table>
					<?php 

				}
				else if(isset($_GET['service_id']))
				{
					?>
					<table class="display" id="basic-1">
                        <thead>
                          <tr>
											 <tr>
                                                <th>Sr No.</th>
												<th>Service Name</th>
												<th>Category Name</th>
												<th>Subcategory Name</th>
												<th>Service Price</th>
												<th>Service Discount</th>
												<th>Service Image</th>
												<th>Service Video</th>
												<th>Display?</th>
												<th>Time Taken?</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $service->query("select * from tbl_service where vendor_id=".$_GET['service_id']."");
										$i=0;
										while($row = $city->fetch_assoc())
										{
											$cdata = $service->query("select * from tbl_category where id=".$row['cat_id']."")->fetch_assoc();
		$sdata = $service->query("select * from tbl_subcategory where id=".$row['sub_id']."")->fetch_assoc();
											$i = $i + 1;
											?>
											<tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['title']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $cdata['title']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $sdata['title']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['price'].$set['currency']; ?>
                                                </td>
												
												<td>
                                                    <?php echo $row['discount'].' %'; ?>
                                                </td>
                                                
                                               
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['img']; ?>" width="150" height="150"/>
                                                </td>
                                               
											   <td>
											   <video width="150" height="150" controls>
  <source src="<?php echo $row['video']; ?>" type="video/mp4">
</video>
											   </td>
											   
											   <?php if($row['service_type'] == 0) { ?>
												
                                                <td><span class="badge badge-success">Image</span></td>
												<?php } else{ ?>
												
												<td>
												<span class="badge badge-success">Video</span></td>
												<?php } ?>
											 
											 <td>
                                                    <?php echo $row['take_time'].' Mintues'; ?>
                                                </td>
												
												<?php if($row['is_approve'] == 1) { ?>
												
                                                <td><span class="badge badge-success">Approved</span></td>
												<?php } else if($row['is_approve'] == 2){ ?>
												
												<td>
												<span class="badge badge-danger">Rejected</span></td>
												<?php }else{ ?>
												
												<td style="min-width:100px;">
												<a class="drop" data-id="<?php echo $row['id'];?>" data-status="1" data-type="update_status" coll-type="service" href="javascript:void(0);"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#FFB901"/>
<path d="M20.75 13V10.75L25.25 15.25H23C21.42 15.25 20.75 14.58 20.75 13ZM20.74 27.6C20.8 27.8 20.66 28 20.46 28H14C12 28 11 27 11 25V13C11 11 12 10 14 10H19.25V13C19.25 15.42 20.58 16.75 23 16.75H26V20.21C26 20.37 25.87 20.5 25.71 20.51C22.82 20.66 20.5 23.07 20.5 26C20.5 26.56 20.58 27.1 20.74 27.6ZM19.75 23C19.75 22.586 19.414 22.25 19 22.25H15C14.586 22.25 14.25 22.586 14.25 23C14.25 23.414 14.586 23.75 15 23.75H19C19.414 23.75 19.75 23.414 19.75 23ZM22 19.75C22.414 19.75 22.75 19.414 22.75 19C22.75 18.586 22.414 18.25 22 18.25H15C14.586 18.25 14.25 18.586 14.25 19C14.25 19.414 14.586 19.75 15 19.75H22ZM30 26C30 28.209 28.209 30 26 30C23.791 30 22 28.209 22 26C22 23.791 23.791 22 26 22C28.209 22 30 23.791 30 26ZM27.604 24.813C27.409 24.618 27.092 24.618 26.897 24.813L25.584 26.126L25.105 25.646C24.91 25.451 24.5929 25.451 24.3979 25.646C24.2029 25.841 24.2029 26.158 24.3979 26.353L25.231 27.186C25.325 27.28 25.452 27.332 25.585 27.332C25.718 27.332 25.845 27.279 25.939 27.186L27.606 25.519C27.799 25.325 27.799 25.009 27.604 24.813Z" fill="white"/>
</svg></a>
												<a class="drop" data-id="<?php echo $row['id'];?>" data-status="2" data-type="update_status" coll-type="service" href="javascript:void(0);"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#AEB2F4"/>
<path d="M21.75 13V10.75L26.25 15.25H24C22.42 15.25 21.75 14.58 21.75 13ZM21.74 27.6C21.8 27.8 21.66 28 21.46 28H15C13 28 12 27 12 25V13C12 11 13 10 15 10H20.25V13C20.25 15.42 21.58 16.75 24 16.75H27V20.21C27 20.37 26.87 20.5 26.71 20.51C23.82 20.66 21.5 23.07 21.5 26C21.5 26.56 21.58 27.1 21.74 27.6ZM16.75 23C16.75 22.586 16.414 22.25 16 22.25C15.586 22.25 15.25 22.586 15.25 23C15.25 23.414 15.586 23.75 16 23.75C16.414 23.75 16.75 23.414 16.75 23ZM16.75 19C16.75 18.586 16.414 18.25 16 18.25C15.586 18.25 15.25 18.586 15.25 19C15.25 19.414 15.586 19.75 16 19.75C16.414 19.75 16.75 19.414 16.75 19ZM20.75 23C20.75 22.586 20.414 22.25 20 22.25H18.5C18.086 22.25 17.75 22.586 17.75 23C17.75 23.414 18.086 23.75 18.5 23.75H20C20.414 23.75 20.75 23.414 20.75 23ZM23 19.75C23.414 19.75 23.75 19.414 23.75 19C23.75 18.586 23.414 18.25 23 18.25H18.5C18.086 18.25 17.75 18.586 17.75 19C17.75 19.414 18.086 19.75 18.5 19.75H23ZM31 26C31 28.209 29.209 30 27 30C24.791 30 23 28.209 23 26C23 23.791 24.791 22 27 22C29.209 22 31 23.791 31 26ZM28.604 24.813C28.409 24.618 28.092 24.618 27.897 24.813L26.584 26.126L26.105 25.646C25.91 25.451 25.5929 25.451 25.3979 25.646C25.2029 25.841 25.2029 26.158 25.3979 26.353L26.231 27.186C26.325 27.28 26.452 27.332 26.585 27.332C26.718 27.332 26.845 27.279 26.939 27.186L28.606 25.519C28.799 25.325 28.799 25.009 28.604 24.813Z" fill="white"/>
</svg></a>
												
												</td>
												<?php } ?>
                                                
                                                </tr>
											<?php 
										}
										?>
                                           
                                        </tbody>
                      </table>
				<?php 
				}
				else 
				{
				?>
                <table class="display mytable" id="basic-1">
                        <thead>
                          <tr>
											 <tr>
                                                <th>Sr No.</th>
												<th>Service Provider Name</th>
                                                <th>Service Provider Image</th>
												<th>Service Provider Cover Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
<th>Pending Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										$city = $service->query("select * from service_details");
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
                                                    <?php echo $row['title']; ?>
                                                </td>
                                                
                                                <td class="align-middle">
                                                   <img src="<?php echo $row['rimg']; ?>" width="100" height="100" />
                                                </td>
												<td class="align-middle">
                                                   <img src="<?php echo $row['cover_img']; ?>" width="100" height="100"/>
                                                </td>
                                                
                                               
												<?php if($row['status'] == 1) { ?>
												
                                                <td><span class="badge badge-success">Publish</span></td>
												<?php } else { ?>
												
												<td>
												<span class="badge badge-danger">Unpublish</span></td>
												<?php } ?>
                                                <td style="white-space: nowrap; width: 15%;"><div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
                                           <div class="btn-group btn-group-sm" style="float: none;">
										   <a href="add_Provider.php?id=<?php echo $row['id'];?>" class="tabledit-edit-button " style="float: none; margin: 5px;">
<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="30" height="30" rx="15" fill="#79F9B4"/><path d="M22.5168 9.34109L20.6589 7.48324C20.0011 6.83703 18.951 6.837 18.2933 7.49476L16.7355 9.06416L20.9359 13.2645L22.5052 11.7067C23.163 11.0489 23.163 9.99885 22.5168 9.34109ZM15.5123 10.2873L8 17.8342V22H12.1658L19.7127 14.4877L15.5123 10.2873Z" fill="#25314C"/></svg>


</a>
										   
										   </div>
                                           
                                       </div></td>
									   <td>
									  <a href="list_Provider.php?service_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="bottom"  title="Pending Service"> <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#FFB901"/>
<path d="M20.75 13V10.75L25.25 15.25H23C21.42 15.25 20.75 14.58 20.75 13ZM20.74 27.6C20.8 27.8 20.66 28 20.46 28H14C12 28 11 27 11 25V13C11 11 12 10 14 10H19.25V13C19.25 15.42 20.58 16.75 23 16.75H26V20.21C26 20.37 25.87 20.5 25.71 20.51C22.82 20.66 20.5 23.07 20.5 26C20.5 26.56 20.58 27.1 20.74 27.6ZM19.75 23C19.75 22.586 19.414 22.25 19 22.25H15C14.586 22.25 14.25 22.586 14.25 23C14.25 23.414 14.586 23.75 15 23.75H19C19.414 23.75 19.75 23.414 19.75 23ZM22 19.75C22.414 19.75 22.75 19.414 22.75 19C22.75 18.586 22.414 18.25 22 18.25H15C14.586 18.25 14.25 18.586 14.25 19C14.25 19.414 14.586 19.75 15 19.75H22ZM30 26C30 28.209 28.209 30 26 30C23.791 30 22 28.209 22 26C22 23.791 23.791 22 26 22C28.209 22 30 23.791 30 26ZM27.604 24.813C27.409 24.618 27.092 24.618 26.897 24.813L25.584 26.126L25.105 25.646C24.91 25.451 24.5929 25.451 24.3979 25.646C24.2029 25.841 24.2029 26.158 24.3979 26.353L25.231 27.186C25.325 27.28 25.452 27.332 25.585 27.332C25.718 27.332 25.845 27.279 25.939 27.186L27.606 25.519C27.799 25.325 27.799 25.009 27.604 24.813Z" fill="white"/>
</svg> </a>
									  <a href="list_Provider.php?subcat_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="bottom" title="Pending Subcategory"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="40" height="40" rx="20" fill="#AEB2F4"/>
<path d="M21.75 13V10.75L26.25 15.25H24C22.42 15.25 21.75 14.58 21.75 13ZM21.74 27.6C21.8 27.8 21.66 28 21.46 28H15C13 28 12 27 12 25V13C12 11 13 10 15 10H20.25V13C20.25 15.42 21.58 16.75 24 16.75H27V20.21C27 20.37 26.87 20.5 26.71 20.51C23.82 20.66 21.5 23.07 21.5 26C21.5 26.56 21.58 27.1 21.74 27.6ZM16.75 23C16.75 22.586 16.414 22.25 16 22.25C15.586 22.25 15.25 22.586 15.25 23C15.25 23.414 15.586 23.75 16 23.75C16.414 23.75 16.75 23.414 16.75 23ZM16.75 19C16.75 18.586 16.414 18.25 16 18.25C15.586 18.25 15.25 18.586 15.25 19C15.25 19.414 15.586 19.75 16 19.75C16.414 19.75 16.75 19.414 16.75 19ZM20.75 23C20.75 22.586 20.414 22.25 20 22.25H18.5C18.086 22.25 17.75 22.586 17.75 23C17.75 23.414 18.086 23.75 18.5 23.75H20C20.414 23.75 20.75 23.414 20.75 23ZM23 19.75C23.414 19.75 23.75 19.414 23.75 19C23.75 18.586 23.414 18.25 23 18.25H18.5C18.086 18.25 17.75 18.586 17.75 19C17.75 19.414 18.086 19.75 18.5 19.75H23ZM31 26C31 28.209 29.209 30 27 30C24.791 30 23 28.209 23 26C23 23.791 24.791 22 27 22C29.209 22 31 23.791 31 26ZM28.604 24.813C28.409 24.618 28.092 24.618 27.897 24.813L26.584 26.126L26.105 25.646C25.91 25.451 25.5929 25.451 25.3979 25.646C25.2029 25.841 25.2029 26.158 25.3979 26.353L26.231 27.186C26.325 27.28 26.452 27.332 26.585 27.332C26.718 27.332 26.845 27.279 26.939 27.186L28.606 25.519C28.799 25.325 28.799 25.009 28.604 24.813Z" fill="white"/>
</svg> </a>
									   </td>
                                                </tr>
											<?php 
										}
										?>
                                           
                                        </tbody>
                      </table>
				<?php } ?>
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