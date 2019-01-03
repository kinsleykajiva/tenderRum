<?php

class DBTenderBrandsCorrelations{

	private $DbCon;
	private $TABLE = "tender_brands_correlations";


	public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {

		$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);

	}

	private function array_push_assoc(array $array, string $key, string $value):array{
		$array[$key] = $value;
		return $array;
	}

	public function getBrandsWightDataForProposal(int $tender_id):array {
		$sql = "SELECT tender_brands_correlations.* , acceptable_brands.title AS brandName FROM tender_brands_correlations  
					JOIN acceptable_brands ON acceptable_brands.id =  tender_brands_correlations.brand_id
					WHERE tender_brands_correlations.tender_id = $tender_id
		";

		$data =  $this->query($sql) ;
		$return =array() ;
		while ($row = mysqli_fetch_assoc($data) ) {
			$return = $this-> array_push_assoc($return , $row['brandName'] ,   $row['weight']);
		}
		return $return;
	}

	/**
	 * @category [brand category if empty then get default brands]
	 * @strict bool jus consider catagories only related to the tender 
	 * get brands  that have been deemed as reliable brands and would have been verted
	 */
	public function getBrandsSelected(string $catagory = "" , bool $strict = false ) {
		$sql = "SELECT tender_brands_correlations.* , acceptable_brands.title AS brandName FROM tender_brands_correlations  
					JOIN acceptable_brands ON acceptable_brands.id =  tender_brands_correlations.brand_id
		";

		return $this->query($sql) ;
	}


	private function query(string $query){
		return mysqli_query ($this->DbCon, $query );
	}






}




?>


