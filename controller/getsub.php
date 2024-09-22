<?php 
require 'serviceconfig.php';
require 'fixxy.php';
if(isset($_POST['cat_id']))
{
	$cat_id = $_POST['cat_id'];
	?>
	<option value="" selected disabled>Select
Subcategory</option>
									<?php 
									$product = $service->query("select * from tbl_subcategory where cat_id=".$cat_id." and vendor_id=".$sdata['id']."");
									while($rmed = $product->fetch_assoc())
									{
									?>
									<option value="<?php echo $rmed['id'];?>"><?php echo $rmed['title'];?></option>
									<?php } ?>
	<?php 
}
?>