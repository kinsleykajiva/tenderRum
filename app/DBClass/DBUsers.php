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

	public function logInUser(string $usernameLog , string $passwordLog):string {
		$qry = $this->query("SELECT id , username , password FROM users WHERE username = '$usernameLog' AND password = '$passwordLog' ");
		$result = mysqli_num_rows($qry) > 0 ? 'found' : 'un';
		if ($result == 'found') {
			$data = mysqli_fetch_assoc($qry);
			//if (session_status() == PHP_SESSION_NONE) {
				session_start();
			//}
			$_SESSION['userId'] = $data['id'];
		}

		return $result;
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