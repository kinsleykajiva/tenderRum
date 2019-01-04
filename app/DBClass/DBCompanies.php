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

				public function saveNewCompany(string $companyName  , string $companyCategory  , string $companyRegiDate  , string $companyEmail  , string $companyPassword  , string $companyAddress  , string $compnyPhone ,string $compnayUsername):string
				{
					require 'DBUsers.php';
					$DBUsers = new DBUsers();
					$res = $DBUsers->saveNewUser($compnayUsername , $companyPassword ) ;
					if($res  == 'failed'){
						return 'failed';
					}
					return $this-> query(
						"INSERT INTO companies ( title , description  ,company_category , address , phone_contact ,  email , company_dob , isdeleted  , date_created ) VALUES ('$companyName' , '' , '$companyCategory' , '$companyAddress' , '$compnyPhone' , '$companyEmail' , '$companyRegiDate' , 0 , NOW() )"
					) ? 'done' : 'failed';
				}

				public function getCompanies(){
						return $this->query ("SELECT companies.* , YEAR(CURDATE()) - YEAR(company_dob) AS years_of_operation FROM " . $this->TABLE);
				}

				public function getCompanyDetails($company_id){
						return mysqli_fetch_assoc(
							$this->query ("SELECT companies.* , YEAR(CURDATE()) - YEAR(company_dob) AS years_of_operation FROM " . $this->TABLE . " WHERE id = $company_id")
						);
				}


				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}
		}