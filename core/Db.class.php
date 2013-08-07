<?php
class DB {

	private $_host 		= 'localhost';
	private $_username 	= 'root';
	private $_password 	= '';
	private $_database	= 'tuto';
	private $_db;

	public function __construct($host = null, $username = null, $password = null, $database = null) {
		if ($host != null) {
			$this->_host 		= $host;
			$this->_username 	= $username;
			$this->_password 	= $password;
			$this->_database 	= $database;
		}

		// Jme connecte à la base
		try {
			$this->_db = new PDO('mysql:host='.$this->_host.';dbname='.$this->_database, $this->_username, 
				$this->_password, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
					PDO::ATTR_ERRMODE 			 => PDO::ERRMODE_WARNING
				));
		} catch (PDOException $e) {
			if (Conf::debug >= 1)	die($e->getMessage());
			else 					die('<h1>Impossible de se connecter à la base de donnée</h1>');
		}
	}

	/**
	 * Permet de faire des requêtes vers la base (SELECT)
	 * @param string $sql
	 * @param array $data
	 * @return array
	 */
	public function query($sql, $data = array()) {
		$req = $this->_db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Permet d'insérer des données dans la base
	 * @param string $sql
	 * @param array $data
	 * @return array
	 */
	public function insert($sql, $data = array()){
		$req = $this->_db->prepare($sql);
		$req->execute($data);
	}
}
?>