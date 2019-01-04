<?php 

/**
 * 
 */
class DBCompaniesCategories {
	
	private $DbCon;
	private $TABLE = "company_categories";


	public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {

		$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);

	}



	public function saveCategory($value='') {
		# code...
	}

	public function getAllCompanyCategories() {
		return $this->query("SELECT *  FROM " . $this->TABLE );
	}

	private function query(string $query){
		return mysqli_query ($this->DbCon, $query );
	}
}



?>