<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 16/12/2018
		 * Time: 4:27 PM
		 */
		
		class DBTenderCategories {
				private $DbCon;
				private $TABLE = "tender_categories";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}
				public function getCategories(){
						return $this->query ("SELECT * FROM " . $this->TABLE);
				}
				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}
				
		}