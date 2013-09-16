<?php 
class Comment{

	private $_DB;

	public function __construct($DB){
		$this->_DB = $DB;
	}

	/**
	* Permet de lire les commentaire dans la base
	* @param $id int L'id du film
	* @return array
	**/
	public function readCom($id){
		$sql = 'SELECT users.id, users.pseudo,users.email, title.id, title.name, comments.id, comments.id_movie, comments.message, comments.id_user, comments.date_com
				FROM comments 
				LEFT JOIN title ON comments.id_movie = title.id
				LEFT JOIN users ON comments.id_user = users.id
				WHERE comments.id_movie=:id
				ORDER BY comments.id DESC';

		$data 	= array(':id' => $id);
		$c 		= $this->_DB->query($sql, $data);

		return $c;
	}

	/**
	* Permet d'enregistrer un commentaire ds la base
	* @param $data array Données à envoyer à la base
	**/
	public function addCom($data){
		$sql 	= 'INSERT INTO comments (id_user,message,date_com,id_movie) VALUES(:id_user,:message,:date_com,:id_movie)';
		$this->_DB->insert($sql,$data);		
	}


}

 ?>