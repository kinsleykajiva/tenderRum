<?php
	
	if (isset($_POST['usernameLog'])) {
		$usernameLog = $_POST['usernameLog'];
		$passwordLog = $_POST['passwordLog'];

		require '../DBClass/DBUsers.php';
		$usersObj = new DBUsers();

		$result = $usersObj->logInUser($usernameLog , $passwordLog) ;
		
		print $result ;
		exit;
	}

	if (isset($_POST['companyName'])) {

		$companyName = $_POST['companyName'] ;
		$companyRegiDate = $_POST['companyRegiDate'] ;
		$companyCategory = $_POST['companyCategory'] ;
		$companyEmail = $_POST['companyEmail'] ;
		$companyPassword = $_POST['companyPassword'] ;
		$compnayUsername = $_POST['compnayUsername'] ;
		$companyAddress = $_POST['companyAddress'] ;
		$compnyPhone = $_POST['compnyPhone'] ;


		require '../DBClass/DBCompanies.php';

		$DBCompanies = new DBCompanies();

		print $DBCompanies->saveNewCompany( $companyName  ,  $companyCategory  ,  $companyRegiDate  ,  $companyEmail  ,  $companyPassword  ,  $companyAddress  ,  $compnyPhone , $compnayUsername ) ;



	}




?>