<?php


if (isset($_POST['data_tender_red'])){
	$tendertimespan = $_POST['tendertimespan'] ;
	$warrantee_period = $_POST['warrantee_period'] ;
	$tenderprice = $_POST['tenderprice'] ;
	$compJsonSelect = $_POST['compJsonSelect'] ;
	$in_tender_id = $_POST['in_tender_id'] ;
	$ux = $_POST['ux'] ;	
	$description = $_POST['description'] ;	

	require '../DBClass/DBTenderProposal.php';
	require '../DBClass/DBTenderProposalBrandAssociated.php';

	$DBTenderProposal = new DBTenderProposal();

	$propResult =  $DBTenderProposal->saveNewProposal($in_tender_id , $tenderprice  , $tendertimespan ,$ux , $warrantee_period  , $description, $ux , "0" , "0" );	

	if($propResult !== 'saved'){
		print $propResult;
		exit;
	}

	$lastId = $DBTenderProposal->getLastAutoMadeID();

	$DBTenderProposalBrandAssociatedObject = new DBTenderProposalBrandAssociated();

	$result = '';

	if ( !empty($compJsonSelect) ) {

		if( strpos($compJsonSelect , ',') !== false ) { // if is like 3,4,5,7  lets split using comma character
			$brandIds = explode(',' , $compJsonSelect );
			foreach ($brandIds as $brandId ){
				$result = $DBTenderProposalBrandAssociatedObject ->saveBrandForTenderPropser( (int) $in_tender_id , $lastId , (int) $brandId );
			}			
		} else {

				// has one value like 4
			$result = $DBTenderProposalBrandAssociatedObject ->saveBrandForTenderPropser( (int) $in_tender_id , $lastId , (int) $compJsonSelect );
		}
	} else {

		$result  = $propResult ;
	}


	print $result;

	exit;

}


?>