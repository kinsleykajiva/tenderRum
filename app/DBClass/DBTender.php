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
				public function getTender(int $record_id){
						$res = $this->query("SELECT * FROM " . $this->TABLE . " WHERE id = $record_id ");
						return mysqli_fetch_assoc ($res);
				}
				public function deleteTender(int  $record_id):string{
					return $this->query("DELETE FROM tenderrum.tender WHERE id = $record_id ") ? 'done' : 'failed';
				}
				public function saveTender(string $tenderNumber , string $tendertitle , int  $tenderCategory , string $editor2 ,
				                           string $compJson , string $compJsonSelect , int $ux_i , string $due_date ):string{
						$editor2 = !empty($editor2) ? "'$editor2'" : 'NULL';
						$compJson = !empty($compJson) ? "'$compJson'" : '';
						$compJsonSelect = !empty($compJsonSelect) ? "'$compJsonSelect'" : '';	

						
						$res = $this->query ("INSERT INTO   " . $this->TABLE . " (tender_number , title , description, date_created , due_date , created_by , catagory , isdeleted )
						VALUES ( '$tenderNumber' , '$tendertitle' ,$editor2 , NOW(), '$due_date' ,$ux_i ,$tenderCategory , 0  )") ? 'saved' : 'fail';
						
						if($res == 'saved'){
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
						}else{
							return 'failed11';
						}
						
				}
				public function getTenders(){
						return $this->query ("SELECT tenders.* , users.username , tender_categories.title
							FROM `tenders`
							JOIN users on users.id = tenders.created_by
							JOIN tender_categories on tender_categories.id = tenders.catagory ");
				}
				
				private function query(string $query){
					return mysqli_query ($this->DbCon, $query );
				}
		}