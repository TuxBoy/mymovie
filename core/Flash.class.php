<?php 
class Flash{

	public function __construct(){
		if (!isset($_SESSION)) session_start();
	}

	/**
	* Permet de créer la session du message flash
	**/
	public function setFlash($message, $type = 'success'){
		$_SESSION['flash'] = array(
			'message' 	=> $message,
			'type'		=> $type
		);
	}

	/**
	* Permet d'afficher le message flash et génère le code html
	* @return $html
	**/
	public function flash() {
		if (isset($_SESSION['flash']['message'])) {
			$html = '<div id="alert" class="alert alert-'.$_SESSION['flash']['type']. '">
					<a class="close">x</a><p>'.$_SESSION['flash'][
					'message'].'</p></div>';
			
			$_SESSION['flash'] = array();

			return $html;
		}
	}


}



 ?>