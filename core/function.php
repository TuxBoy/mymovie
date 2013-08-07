<?php
/**
 * Permet d'afficher les informations de debug(Amélioration du print_r)
 * @param array $var
 */
function debug($var) {
	$debug = debug_backtrace();
	echo '<p>&nbsp</p><p><a href="#" onclick="$(this).parent().next
			(\'ol\').slideToggle(); return false;"><strong>'. $debug[0]['file'] .
			'</strong> l.'.$debug[0]['line'].'</a></p>';
	echo '<ol style="display:none;">';
	foreach ($debug as $key => $value) {
		if ($key > 0) {
			echo '<li><strong>'.$value['file'].'</strong> l.'. $value['line']. '</li>';
		}
	}
	echo '</ol>';
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function stripAccents($string){
	return strtr($string, 'éèêâù', 
				'eeeau');
}

/**
 * Supprimer les accents
 * 
 * @param string $str chaîne de caractères avec caractères accentués
 * @param string $encoding encodage du texte (exemple : utf-8, ISO-8859-1 ...)
 */
function suppr_accents($str, $encoding='utf-8')
{
    // transformer les caractères accentués en entités HTML
    $str = htmlentities($str, ENT_NOQUOTES, $encoding);
 
    // remplacer les entités HTML pour avoir juste le premier caractères non accentués
    // Exemple : "&ecute;" => "e", "&Ecute;" => "E", "Ã " => "a" ...
    $str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
 
    // Remplacer les ligatures tel que : Œ, Æ ...
    // Exemple "Å“" => "oe"
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    // Supprimer tout le reste
    $str = preg_replace('#&[^;]+;#', '', $str);
 
    return $str;
}

?>