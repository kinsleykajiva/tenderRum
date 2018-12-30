<?php


/**
 * 
 */
class DBTenderProposalBrandAssociated {
	
	private $DbCon;
	private $TABLE = "tender_proposal_brand_associated";

	public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {

		$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);

	}

	public function saveBrandForTenderPropser(int $tenderId , int $proposalId , int $brandId):String	{
		
		return $this-> query("INSERT INTO $this->TABLE (tender_id , tender_proposal_id , brand_id ) VALUES ( $tenderId , $proposalId , $brandId ) ") ? 'saved' : 'failed' ;
	}
	public function upDateBrandForTenderPropser($value=''):String {
		return "";
	}


	private function query(string $query){
		return mysqli_query ($this->DbCon, $query );
	}








}













?>