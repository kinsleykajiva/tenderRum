<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 18/12/2018
		 * Time: 4:35 AM
		 */
		
		class DBAcceptableBrands {
		
				private $DbCon;
				private $TABLE = "acceptable_brands";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}
				public function saveCategories(string $title , string $description , string $tag_category ):string
					{
						
						return $this-> query("INSERT INTO acceptable_brands (title , description  , assoc_catagory_tags , date_created , isdeleted ) VALUES ('$title' , '$description' , '$tag_category' , NOW() , 0 ) ") ? 'done' : 'failed';
					}

				public function update(string $title , string $description , string $tag_category ,  int $id):string
				{
					return $this-> query("UPDATE  acceptable_brands  SET title =  '$title' , description = '$description' , assoc_catagory_tags = '$tag_category' WHERE id = $id ") ? 'done' : 'failed';
				}
				

				public function getBrands(){
					// SELECT acceptable_brands.* , company_categories.title FROM acceptable_brands JOIN company_categories on company_categories.id = acceptable_brands.assoc_catagory_tags 
						return $this->query ("SELECT acceptable_brands.* FROM acceptable_brands " );
				}
				public function getAllBrands(){
					// SELECT acceptable_brands.* , company_categories.title FROM acceptable_brands JOIN company_categories on company_categories.id = acceptable_brands.assoc_catagory_tags 
					return $this->query ("SELECT acceptable_brands.* , company_categories.title AS categoryTitle FROM 
						acceptable_brands JOIN company_categories on   FIND_IN_SET( company_categories.id , acceptable_brands.assoc_catagory_tags) > 0
						" );
				}
				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}

		
		}