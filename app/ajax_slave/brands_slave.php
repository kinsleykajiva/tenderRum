<?php 

if(isset($_POST['brandName'])) {
	$brandName = $_POST['brandName'] ;
	$brandTag = $_POST['brandTag'] ;
	$brandDescription = $_POST['brandDescription'] ;

	require '../DBClass/DBAcceptableBrands.php';
	$DBAcceptableBrands = new DBAcceptableBrands();

	 echo $DBAcceptableBrands->saveCategories($brandName,$brandDescription,$brandTag );
	  exit;

}

if(isset($_POST['update'])) {
	$brandName = $_POST['ubrandName'] ;
	$update = (int) $_POST['update'] ;
	$brandTag = $_POST['ubrandTag'] ;
	$brandDescription = $_POST['ubrandDescription'] ;

	require '../DBClass/DBAcceptableBrands.php';
	$DBAcceptableBrands = new DBAcceptableBrands();

	 echo $DBAcceptableBrands->update($brandName,$brandDescription,$brandTag  ,$update );
	  exit;

}







?>