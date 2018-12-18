<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 17/12/2018
		 * Time: 8:40 PM
		 */
		
		class DBCompanies
		{
				private $DbCon;
				private $TABLE = "companies";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}
				public function getCompanies(){
						return $this->query ("SELECT * FROM " . $this->TABLE);
				}
				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}
		}