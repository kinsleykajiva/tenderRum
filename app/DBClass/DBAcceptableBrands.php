<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 18/12/2018
		 * Time: 4:35 AM
		 */
		
		class DBAcceptableBrands
		{
		
				private $DbCon;
				private $TABLE = "acceptable_brands";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}
				public function getBrands(){
						return $this->query ("SELECT * FROM " . $this->TABLE);
				}
				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}
		
		}