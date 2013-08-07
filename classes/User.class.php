<?php
class User{

	private $_DB;

	public function __construct($DB){	
		if (!isset($_SESSION)){
			session_start();
		}	

		$this->_DB = $DB;
	}

	/**
	 * Permet de vérifier si une valeur existe dans BDD
     * @param string $data
     * @param string $field
     * @return bool
     */ 
	public function noExist($data, $field){
		$verif = $this->_DB->query("SELECT $field FROM users WHERE $field='$data'");
		if (count($verif) <= 0) return false;

		return true;
	}

	public function isLogged(){
		if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['pseudo']) && isset($_SESSION['Auth']['password'])) {
			return true;
		} else {
			return false;
		}
	}

	public function inBase($pseudo, $password){
		$user = $this->_DB->query("SELECT pseudo, password FROM users WHERE pseudo='$pseudo' AND password='$password'");
		if (count($user) > 0) return true;

		return false;	
	}

	public function idUser(){
		$pseudo = $_SESSION['Auth']['pseudo'];
		$sql 	= "SELECT id,pseudo FROM users WHERE pseudo='$pseudo'";
		$id 	= $this->_DB->query($sql);
		return $id;
	}

}
?>