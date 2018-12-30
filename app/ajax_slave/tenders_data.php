<?php 


if (isset($_GET['getData'])) {
	require '../DBClass/DBTender.php';

	$tendersObject = new DBTender();

	$arr = array();

	$tendersData = $tendersObject ->getTenders();

	while ($row = mysqli_fetch_assoc($tendersData)) {
		$arr [] = $row ;
	}
	echo json_encode($arr);
	exit;



}











?>