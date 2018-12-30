<?php

 /**
  * 
  */
 class DBTenderProposal 
 {
 	
 	private $DbCon;
	private $TABLE = "tender_brands_correlations";

	


	public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {

		$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);

	}
	public function getAllProposals(){
		return $this ->query("SELECT * FROM tender_brands_correlations");
	}
	public function saveNewProposal(string $tender_id ,string $price ,string $time_of_service_provision ,string $company_id ,string $warrantee_period , string $description = '-' ,string $created_by , string $was_accepted ,string $isdeleted ):string{

		$sql = "INSERT INTO tender_proposal (tender_id , price , time_of_service_provision , company_id , warrantee_period , description , created_by , date_created , was_accepted , isdeleted ) 
		 VALUES ( '$tender_id' , '$price' , '$time_of_service_provision' , '$company_id' , '$warrantee_period' , '$description' , '$created_by' , NOW() , '$was_accepted' , '$isdeleted'  ) ";

		return $this->query($sql) ? 'saved' : 'failed';
	}

	public function getLastAutoMadeID():Int	{
		return (int) mysqli_insert_id($this->DbCon);
	}

	private function query(string $query){
		return mysqli_query ($this->DbCon, $query );
	}
 }



?>