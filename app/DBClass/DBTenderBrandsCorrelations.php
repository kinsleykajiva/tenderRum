<?php

class DBTenderBrandsCorrelations{

	private $DbCon;
	private $TABLE = "tender_brands_correlations";


	public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {

		$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);

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


