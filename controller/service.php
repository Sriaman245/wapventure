<?php
require 'controller/serviceconfig.php';
$afile = $main['data'];
echo $afile;
if($set['show_dark'] == 1)
{
	?>
	<script>
	
	$("body").toggleClass("dark-only");
	$(".mode").toggleClass("dark");
	</script>
	<?php 
}
?>

	
    