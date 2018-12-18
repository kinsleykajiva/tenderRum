<?php
		/**
		 * Created by PhpStorm.
		 * User: kajiva kinsley
		 * Date: 18/12/2018
		 * Time: 8:47 AM
		 */
		
		class DBTender {
				private $DbCon;
				private $TABLE = "tenders";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}
				public function saveTender(string $tenderNumber , string $tendertitle , int  $tenderCategory , string $editor2 ,
				                           string $compJson , string $compJsonSelect , int $ux_i ):string{
						$editor2 = !empty($editor2) ? "'$editor2'" : 'NULL';
						$compJson = !empty($compJson) ? "'$compJson'" : '';
						$compJsonSelect = !empty($compJsonSelect) ? "'$compJsonSelect'" : '';
						
						$res = $this->query ("INSERT INTO   " . $this->TABLE . " (tender_number , title , description, date_created , created_by , catagory , isdeleted )
						VALUES ( '$tenderNumber' , '$tendertitle' ,$editor2 , NOW() ,$ux_i ,$tenderCategory,0  )");
						
						if($res){
								$lastid = mysqli_insert_id($this->DbCon);
								$arr = explode (','  , $compJson);
								$compArr =  explode (','  , $compJsonSelect);
								$qry = "";
								// INSERT INTO `tender_brands_correlations` (`id`, `tender_id`, `brand_id`, `weight`, `date_created`)
								// VALUES (NULL, '1', '1', '.5', NOW()), (NULL, '1', '1', '.5', NOW());
								$unwanted = array(",", "'");
								for ($x = 0 ; $x < sizeof ($arr) ; $x++){
										$wscore = $arr[$x];
										$brands = $compArr[$x];
										$wscore = str_replace ($unwanted , '' , $wscore);
										$brands = str_replace ($unwanted , '' , $brands);
										$qry .= "( $lastid, $brands, $wscore, NOW() ),";
								}
								  $qry = rtrim($qry,",");
								 $st = "INSERT INTO tender_brands_correlations (tender_id , brand_id , weight  , date_created )
														VALUES  $qry ";
								$jes = $this->query ($st);
								return $jes?'done':'failed';
						}
						return 'failed';
				}
				public function getTenders(){
						return $this->query ("SELECT * FROM " . $this->TABLE);
				}
				
				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				}
		}