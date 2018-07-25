<?php
	header("Content-type: image/jpeg");
	$img = file_get_contents("http://192.0.0.100/passport/img_profile.php?usr=".$_GET['usr']);
	echo $img;
?>
