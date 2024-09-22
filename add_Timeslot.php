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
                  <h3>TimeSlot Management</h3>
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
					 $data = $service->query("select * from tbl_timeslot where id=".$_GET['id']."")->fetch_assoc();
					 $extime = explode(',',$data['timeslot']);	
					 ?>
					 <form method="POST"  enctype="multipart/form-data">
								
								<div class="form-group mb-3">
									<label for="cname">Select Category</label>
									<select name="category"  class="form-control select2-single" required>
									<option value="" selected disabled>Select
Category</option>
									<?php 
									$product = $service->query("select * from tbl_category where id IN(".$sdata['catid'].")");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>" <?php if($rmed['id'] == $data['cat_id']){echo 'selected';}?>><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
								
								
								
                                        <div class="form-group mb-3">
                                            <label>Current Or Next Date?</label>
                                            <select name="dthing" class="form-control">
											<option value="">Select Date Status</option>
											<option value="0" <?php if($data['day_type'] == 0){echo 'selected';}?>>Current</option>
											<option value="1" <?php if($data['day_type'] == 1){echo 'selected';}?>>Next</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Date+Day</label>
											<input type="hidden" name="type" value="edit_timeslot"/>
											
										<input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Day" value="<?php echo $data['total_days'];?>"  name="day" required="">
                                        </div>
										
										
                                       
										 <div class="form-group row mb-3">
                                            <label class="col-md-12">TimeSloat List</label>
											<?php 
											function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i A';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[] = $date->format( $format );
    }

    return $times;
}
$range = hoursRange( 28800, 86400, 60 * 30, 'h:i A' );

for($i=0;$i<count($range);$i++)
{
											?>
											<div class="col-md-2 mb-3">
                                            <input type="checkbox"  class="checkbox_animated" name="timsloat[]" value="<?php echo $range[$i];?>" <?php if (in_array($range[$i], $extime)){echo 'checked';} ?>/> <?php echo $range[$i];?>
											</div>
<?php } ?>
                                        </div>
										
                                    <button type="submit" class="btn btn-primary">Edit Timeslot</button>
                                </form>
					 <?php 
				 }
				 else 
				 {
				 ?>
                  <form method="POST"  enctype="multipart/form-data">
								
								
									
									
								
								<div class="form-group mb-3">
									<label for="cname">Select Category</label>
									<select name="category"  class="form-control select2-single" required>
									<option value="" selected disabled>Select
Category</option>
									<?php 
									$product = $service->query("select * from tbl_category where id IN(".$sdata['catid'].")");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['title'];?></option>
									<?php } ?>
									</select>
								</div>
								
								
								
                                        <div class="form-group mb-3">
                                            <label>Current Or Next Date?</label>
                                            <select name="dthing" class="form-control">
											<option value="">Select Date Status</option>
											<option value="0">Current</option>
											<option value="1">Next</option>
											</select>
                                        </div>
										
										<div class="form-group mb-3">
                                            <label>Date+Day</label>
											<input type="hidden" name="type" value="add_timeslot"/>
                                            <input type="text" class="form-control numberonly" placeholder="Enter Day"   name="day" required="">
                                        </div>
										
										
                                       
										 <div class="form-group row mb-3">
                                            <label class="col-md-12">TimeSloat List</label>
											<?php 
											function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i A';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[] = $date->format( $format );
    }

    return $times;
}
$range = hoursRange( 28800, 86400, 60 * 30, 'h:i A' );

for($i=0;$i<count($range);$i++)
{
											?>
											<div class="col-md-2 mb-3">
                                            <input type="checkbox"  class="checkbox_animated" name="timsloat[]" value="<?php echo $range[$i];?>"/> <?php echo $range[$i];?>
											</div>
<?php } ?>
                                        </div>
                                        
										
                                    
                                    <button type="submit" class="btn btn-primary">Add Timeslot</button>
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