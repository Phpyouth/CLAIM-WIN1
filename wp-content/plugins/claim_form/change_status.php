<?php
	error_reporting(E_ERROR | E_PARSE);
	require( dirname(__FILE__) . '/../../../wp-config.php' );
	$claim_id = $_POST['claim_id'];
	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	  else{
	  	//echo "connected";
	  }
	$update_status = mysqli_query($con,"update ".$table_prefix."claim_form SET status = IF(status=1, 0, 1) where id = '".$claim_id."' ");
	if($update_status){ echo "updated"; }
	else{ echo "some error , try again"; }
?>