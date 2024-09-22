 <div class="sidebar-wrapper"> 
          <div>
            <div class="logo-wrapper"><a href="dashboard.php"><img class="img-fluid for-light" src="<?php echo $set['weblogo'];?>" alt=""><img class="img-fluid for-dark" src="<?php echo $set['weblogo'];?>" alt=""></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="dashboard.php"><img class="img-fluid" src="<?php echo $set['weblogo'];?>" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="dashboard.php"><img class="img-fluid" src="<?php echo $set['weblogo'];?>" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true">        </i></div>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="dashboard.php">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g> 
                            <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Dashboard</span></a></li>
					  
					 
                  
                  
				  <?php 
				  if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
			?>
			<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g> 
                            <path d="M15.596 15.6963H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.596 11.9365H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.1312 8.17725H8.37622" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.61011 12C3.61011 18.937 5.70811 21.25 12.0011 21.25C18.2951 21.25 20.3921 18.937 20.3921 12C20.3921 5.063 18.2951 2.75 12.0011 2.75C5.70811 2.75 3.61011 5.063 3.61011 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Sub Category</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Subcategory.php">Add SubCategory</a></li>
                      <li><a href="list_Subcategory.php">List SubCategory</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2498 12C21.2498 17.108 17.1088 21.25 11.9998 21.25C6.89176 21.25 2.74976 17.108 2.74976 12C2.74976 6.891 6.89176 2.75 11.9998 2.75C17.1088 2.75 21.2498 6.891 21.2498 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M16.1906 12.7672L11.6606 12.6932V7.84619" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
<span>Timeslot</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Timeslot.php">Add Timeslot</a></li>
                      <li><a href="list_Timeslot.php">List Timeslot</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                   
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M12.0002 2.75C5.06324 2.75 2.75024 5.063 2.75024 12C2.75024 18.937 5.06324 21.25 12.0002 21.25C18.9372 21.25 21.2502 18.937 21.2502 12" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5285 4.30364V4.30364C18.5355 3.42464 17.0185 3.51664 16.1395 4.50964C16.1395 4.50964 11.7705 9.44464 10.2555 11.1576C8.73853 12.8696 9.85053 15.2346 9.85053 15.2346C9.85053 15.2346 12.3545 16.0276 13.8485 14.3396C15.3435 12.6516 19.7345 7.69264 19.7345 7.69264C20.6135 6.69964 20.5205 5.18264 19.5285 4.30364Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.009 5.80078L18.604 8.98378" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>

<span>Service</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Service.php">Add Service</a></li>
                      <li><a href="list_Service.php">List Service</a></li>
                    </ul>
                  </li>
				  
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                 
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.92234 21.8083C6.10834 21.8083 2.85034 21.2313 2.85034 18.9213C2.85034 16.6113 6.08734 14.5103 9.92234 14.5103C13.7363 14.5103 16.9943 16.5913 16.9943 18.9003C16.9943 21.2093 13.7573 21.8083 9.92234 21.8083Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.92231 11.2159C12.4253 11.2159 14.4553 9.1859 14.4553 6.6829C14.4553 4.1789 12.4253 2.1499 9.92231 2.1499C7.41931 2.1499 5.38931 4.1789 5.38931 6.6829C5.38031 9.1769 7.39631 11.2069 9.89031 11.2159H9.92231Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19.1313 8.12891V12.1389" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.1776 10.1338H17.0876" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>

<span>Partner</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Partner.php">Add Partner</a></li>
                      <li><a href="list_Partner.php">List Partner</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.42993 14.5697L14.5699 9.42969" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M14.4955 14.5H14.5045" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.4955 9.5H9.5045" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>


<span>Coupon</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Coupon.php">Add Coupon</a></li>
                      <li><a href="list_Coupon.php">List Coupon</a></li>
                    </ul>
                  </li>
				  
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
               
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M6.07056 16.4588C6.07056 16.4588 6.88256 14.8218 8.06456 14.8218C9.24656 14.8218 9.85056 16.1968 11.1606 16.1968C12.4696 16.1968 13.9386 12.7488 15.4226 12.7488C16.9046 12.7488 17.9706 15.1398 17.9706 15.1398" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1393 9.10487C10.1393 9.96487 9.44229 10.6629 8.58129 10.6629C7.72129 10.6629 7.02429 9.96487 7.02429 9.10487C7.02429 8.24487 7.72129 7.54688 8.58129 7.54688C9.44229 7.54788 10.1393 8.24487 10.1393 9.10487Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 18.937 5.06324 21.25 12.0002 21.25C18.9372 21.25 21.2502 18.937 21.2502 12C21.2502 5.063 18.9372 2.75 12.0002 2.75C5.06324 2.75 2.75024 5.063 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>




<span>Cover</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Cover.php">Add Cover</a></li>
                      <li><a href="list_Cover.php">List Cover</a></li>
                    </ul>
                  </li>
				  
			<?php 
		}
		else 
		{
				  ?>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M6.07056 16.4588C6.07056 16.4588 6.88256 14.8218 8.06456 14.8218C9.24656 14.8218 9.85056 16.1968 11.1606 16.1968C12.4696 16.1968 13.9386 12.7488 15.4226 12.7488C16.9046 12.7488 17.9706 15.1398 17.9706 15.1398" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1393 9.10487C10.1393 9.96487 9.44229 10.6629 8.58129 10.6629C7.72129 10.6629 7.02429 9.96487 7.02429 9.10487C7.02429 8.24487 7.72129 7.54688 8.58129 7.54688C9.44229 7.54788 10.1393 8.24487 10.1393 9.10487Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 18.937 5.06324 21.25 12.0002 21.25C18.9372 21.25 21.2502 18.937 21.2502 12C21.2502 5.063 18.9372 2.75 12.0002 2.75C5.06324 2.75 2.75024 5.063 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Banner</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Banner.php">Add Banner</a></li>
                      <li><a href="list_Banner.php">List Banner</a></li>
                    </ul>
                  </li>
				  
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g> 
                            <path d="M15.596 15.6963H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.596 11.9365H8.37598" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.1312 8.17725H8.37622" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.61011 12C3.61011 18.937 5.70811 21.25 12.0011 21.25C18.2951 21.25 20.3921 18.937 20.3921 12C20.3921 5.063 18.2951 2.75 12.0011 2.75C5.70811 2.75 3.61011 5.063 3.61011 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Category</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Category.php">Add Category</a></li>
                      <li><a href="list_Category.php">List Category</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                   
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5103 10.7105C14.5103 9.3292 13.391 8.20996 12.0097 8.20996C10.6295 8.20996 9.51025 9.3292 9.51025 10.7105C9.51025 12.0907 10.6295 13.21 12.0097 13.21C13.391 13.21 14.5103 12.0907 14.5103 10.7105Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9995 21C9.10148 21 4.5 15.9587 4.5 10.5986C4.5 6.40246 7.8571 3 11.9995 3C16.1419 3 19.5 6.40246 19.5 10.5986C19.5 15.9587 14.8985 21 11.9995 21Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
<span>Service Zone</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Zone.php">Add Zone</a></li>
                      <li><a href="list_Zone.php">List Zone</a></li>
                    </ul>
                  </li>
				  
				  
				   <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9724 20.3683C8.73343 20.3683 5.96643 19.8783 5.96643 17.9163C5.96643 15.9543 8.71543 14.2463 11.9724 14.2463C15.2114 14.2463 17.9784 15.9383 17.9784 17.8993C17.9784 19.8603 15.2294 20.3683 11.9724 20.3683Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9725 11.4488C14.0985 11.4488 15.8225 9.72576 15.8225 7.59976C15.8225 5.47376 14.0985 3.74976 11.9725 3.74976C9.84645 3.74976 8.12245 5.47376 8.12245 7.59976C8.11645 9.71776 9.82645 11.4418 11.9455 11.4488H11.9725Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.3622 10.3915C19.5992 10.0605 20.5112 8.93254 20.5112 7.58954C20.5112 6.18854 19.5182 5.01854 18.1962 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.9431 13.5444C20.6971 13.5444 22.1951 14.7334 22.1951 15.7954C22.1951 16.4204 21.6781 17.1014 20.8941 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.58372 10.3915C4.34572 10.0605 3.43372 8.93254 3.43372 7.58954C3.43372 6.18854 4.42772 5.01854 5.74872 4.74854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5.00176 13.5444C3.24776 13.5444 1.74976 14.7334 1.74976 15.7954C1.74976 16.4204 2.26676 17.1014 3.05176 17.2854" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Service Provider</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Provider.php">Add Provider</a></li>
                      <li><a href="list_Provider.php">List Provider</a></li>
                    </ul>
                  </li>
				  
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75024 12C2.75024 5.063 5.06324 2.75 12.0002 2.75C18.9372 2.75 21.2502 5.063 21.2502 12C21.2502 18.937 18.9372 21.25 12.0002 21.25C5.06324 21.25 2.75024 18.937 2.75024 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.2045 13.8999H15.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12.2045 9.8999H12.2135" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.19557 13.8999H9.20457" stroke="#130F26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Home Section</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Section.php">Add Section</a></li>
                      <li><a href="list_Section.php">List Section</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1601 8.3L14.4901 2.9C13.7601 2.8 12.9401 2.75 12.0401 2.75C5.75015 2.75 3.65015 5.07 3.65015 12C3.65015 18.94 5.75015 21.25 12.0401 21.25C18.3401 21.25 20.4401 18.94 20.4401 12C20.4401 10.58 20.3501 9.35 20.1601 8.3Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.9341 2.83276V5.49376C13.9341 7.35176 15.4401 8.85676 17.2981 8.85676H20.2491" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M14.3125 12.9807H9.41248" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11.8633 15.4308V10.5308" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
<span>Home Section Item</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Section_Item.php">Add Section Item</a></li>
                      <li><a href="list_Section_Item.php">List Section Item</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 12C2.75 18.937 5.063 21.25 12 21.25C18.937 21.25 21.25 18.937 21.25 12C21.25 5.063 18.937 2.75 12 2.75C5.063 2.75 2.75 5.063 2.75 12Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.69775 15.3022L10.2718 10.2722L15.3018 8.69824L13.7278 13.7272L8.69775 15.3022Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Country Code</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_country_code.php">Add Country Code</a></li>
                      <li><a href="list_country_code.php">List Country Code</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M12.0002 2.75C5.06324 2.75 2.75024 5.063 2.75024 12C2.75024 18.937 5.06324 21.25 12.0002 21.25C18.9372 21.25 21.2502 18.937 21.2502 12" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5285 4.30364V4.30364C18.5355 3.42464 17.0185 3.51664 16.1395 4.50964C16.1395 4.50964 11.7705 9.44464 10.2555 11.1576C8.73853 12.8696 9.85053 15.2346 9.85053 15.2346C9.85053 15.2346 12.3545 16.0276 13.8485 14.3396C15.3435 12.6516 19.7345 7.69264 19.7345 7.69264C20.6135 6.69964 20.5205 5.18264 19.5285 4.30364Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15.009 5.80078L18.604 8.98378" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Page</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_Page.php">Add Page</a></li>
                      <li><a href="list_Page.php">List Page</a></li>
                    </ul>
                  </li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0);">
                      
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M8.54248 9.21777H15.3975" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9702 2.5C5.58324 2.5 4.50424 3.432 4.50424 10.929C4.50424 19.322 4.34724 21.5 5.94324 21.5C7.53824 21.5 10.1432 17.816 11.9702 17.816C13.7972 17.816 16.4022 21.5 17.9972 21.5C19.5932 21.5 19.4362 19.322 19.4362 10.929C19.4362 3.432 18.3572 2.5 11.9702 2.5Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>
<span>FAQ</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="add_faq.php">Add Faq</a></li>
                      <li><a href="list_faq.php">List Faq</a></li>
                    </ul>
                  </li>
                  
                   <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="payout.php">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                          <g>
                            <path d="M7.4831 10.261V16.9547" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12.0368 7.05737V16.9553" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M16.5158 13.7983V16.9552" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.30005 12.0369C2.30005 4.73479 4.73479 2.30005 12.0369 2.30005C19.339 2.30005 21.7737 4.73479 21.7737 12.0369C21.7737 19.339 19.339 21.7737 12.0369 21.7737C4.73479 21.7737 2.30005 19.339 2.30005 12.0369Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Payout List</span></a></li>
				  
				  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="payment_method.php">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M21.1712 14.6755H17.2845C15.8693 14.6755 14.7217 13.5279 14.7217 12.1117C14.7217 10.6964 15.8693 9.54883 17.2845 9.54883H21.1407" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17.7219 12.0531H17.4248" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.6062 8.14367H11.6662" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.71411 12.2532C2.71411 5.8484 5.03887 3.71411 12.0151 3.71411C18.9903 3.71411 21.3151 5.8484 21.3151 12.2532C21.3151 18.657 18.9903 20.7922 12.0151 20.7922C5.03887 20.7922 2.71411 18.657 2.71411 12.2532Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg><span>Payment Method</span></a></li>


  <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="userlist.php">
                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g> 
                      <g> 
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg><span>User list</span></a></li>


<li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="setting.php">
                   
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g> 
                          <g> 
                            <path d="M11.1437 17.8829H4.67114" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.205 17.8839C15.205 19.9257 15.8859 20.6057 17.9267 20.6057C19.9676 20.6057 20.6485 19.9257 20.6485 17.8839C20.6485 15.8421 19.9676 15.1621 17.9267 15.1621C15.8859 15.1621 15.205 15.8421 15.205 17.8839Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M14.1765 7.39439H20.6481" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1153 7.39293C10.1153 5.35204 9.43436 4.67114 7.39346 4.67114C5.35167 4.67114 4.67078 5.35204 4.67078 7.39293C4.67078 9.43472 5.35167 10.1147 7.39346 10.1147C9.43436 10.1147 10.1153 9.43472 10.1153 7.39293Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </g>
                      </svg>

<span>Setting</span></a></li>
	<?php } }?>
                </ul>
                <div class="sidebar-img-section">
                  <div class="sidebar-img-content"><img class="img-fluid" src="assets/images/side-bar.png" alt="">
                    <h4>Need Help ?</h4><a class="txt" href="https://join.skype.com/invite/yU3i0IOqb8Kk">Contact our team via Skype</a><a class="btn btn-secondary" href="https://join.skype.com/invite/yU3i0IOqb8Kk">Contact Now</a>
                  </div>
                </div>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>