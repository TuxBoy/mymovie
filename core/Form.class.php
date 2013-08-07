<?php
/**
 * Helper Form,
 * Permet de générer simplement un formulaire
 */

class Form {

	private $_data = ' ';		// Contient les données à insérer dans le formulaire
	private $_errors;

	public function __construct(){			
	}

	public function setData($data){
		if (!empty($data)) 	$this->_data = $data;
		else 			  	$this->_data = "";
	}

	/**
	 * Permet d'initialiser les erreurs
	 * @param array $errors
	 */
	public function setErrors($errors){
		$this->_errors = $errors;
	}

	/**
	 * Affiche une erreur
	 */
	public function getErrors($name){
		if (isset($this->_errors[$name]) && $this->_errors[$name] != ""){
			return '  <span class="error-message">'.$this->_errors[$name].'</span>';
		}
	}	

	/**
	 * Permet de générer des champs du formulaire
	 * @param string $name Nom du champs
	 * @param string $label Nom du label
	 * @param array  $options Définie des options : préciser si autre qu'un champ classique
	 * @return string
	 */
	public function input($name, $label, $options = array()){
		if ($label == 'hidden') {
			return '<input type="hidden" name="'.$name.'" value="">';
		}
		$html = '<label for="input'. $name .'">'.$label.'</label>';
		$attr = '';
		
		foreach ($options as $k => $v){
			if ($k != 'type') 		$attr .= "$k=\"$v\"";
		}
		if (!isset($options['type'])){
			$html .= '<input type="text" id="input'.$name.'" name="'.$name.'" value="'.$this->_data.'" '.$attr.' required>';
		}elseif($options['type'] == 'textarea'){
			$html .= '<textarea id="input'.$name.'" name="'.$name.'" '.$attr.'>'.$this->_data.'</textarea>';
		}elseif ($options['type'] == 'checkbox'){
			$html .= '<input type="checkbox" name="'.$name.'" value=""';
		}elseif($options['type'] == 'password'){
			$html .= '<input type="password" id="input'.$name.'" name="'.$name.'"'.$attr.' required>';
		}elseif($options['type'] == 'file'){
			$html .= '<input type="file" id="input'.$name.'" name="'.$name.'" value="'.$this->_data.'" '.$attr.'>';
		}elseif($options['type'] == 'email'){
			$html .= '<input type="email" id="input'.$name.'" name="'.$name.'" value="'.$this->_data.'" '.$attr.' >';
		}

		$html .= $this->getErrors($name);

		return $html;
					
	}

}
?>