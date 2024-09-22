<?php 
include 'controller/fronthead.php';
?>
  <body>
    <!-- Loader starts-->
    
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-5"><img class="bg-img-cover bg-center" src="assets/images/login/3.jpg" alt="looginpage"></div>
          <div class="col-xl-7 p-0">    
            <div class="login-card">
             <div class="theme-form login-form">
                <h4>Validate Domain</h4>
                <h6>Welcome back! Validate your account.</h6>
                <div id="getmsg"></div>
                <div class="form-group">
                  <label>Enter User App Envato Purchase Code</label>
                  <div class="input-group"><span class="input-group-text"><i class="fa fa-key"></i></span>
                    <input class="form-control" type="text" required="" id="inputCode" placeholder="Enter User App Enavato Code">
					
                  </div>
                </div>
				
				<div class="form-group">
                  <label>Enter Service Partner Envato Purchase Code</label>
                  <div class="input-group"><span class="input-group-text"><i class="fa fa-key"></i></span>
                    <input class="form-control" type="text" required="" id="inputCode1" placeholder="Enter Service Partner App Enavato Code">
					
                  </div>
                </div>
				
				<div class="form-group">
                  <label>Enter Service Provider Envato Purchase Code</label>
                  <div class="input-group"><span class="input-group-text"><i class="fa fa-key"></i></span>
                    <input class="form-control" type="text" required="" id="inputCode2" placeholder="Enter Service Provider App Enavato Code">
				
                  </div>
                </div>
                
                
                <div class="form-group">
                  <button class="btn btn-primary btn-block" id="sub_activate" >Activate</button>
                </div>
                </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <?php include 'controller/service.php';?>
	
    <!-- login js-->
    <!-- Plugin used-->
  </body>


</html>