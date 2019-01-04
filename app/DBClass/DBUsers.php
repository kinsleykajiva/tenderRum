<?php 


/**
 * 
 */
class DBUsers 
{
	
	private $DbCon;
				private $TABLE = "users";
				
				
				public function __construct(string $HOST = "localhost", string $USER ="root",  string $PASSWORD = "",  string $DATABASE = "tenderrum") {
						
						$this->DbCon = mysqli_connect($HOST, $USER, $PASSWORD, $DATABASE);
						
				}

				public function saveNewUser(string $userName , string $password):string
				{
					return $this->query("INSERT INTO users (username , password ) VALUES ('$userName' , '$password') ")? 'saved' : 'failed';
				}


				private function query(string $query){
						return mysqli_query ($this->DbCon, $query );
				} 
}




?>