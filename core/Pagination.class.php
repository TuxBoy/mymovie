<?php 
class Pagination{


	/**
	 * Affiche la pagination avec gestion des longeur des pages, avec bouton précédent/suivant
	 * @param int $nbPage Nombre d'éléments par page
	 * @param int $adjacent Nombre ou la pagination sera coupé (début => 0)
	 * @return string
	 */
	public static function toString($nbPage, $adjacent, $cPage, $url = null){
		$pagination = "";
		$next 		= $cPage + 1;
		$prev		= $cPage - 1;
		$lpm1		= $nbPage - 1;

		if ($url == null) $url = '';		

		if ($cPage == 1) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$prev.$url.'">Précédent</a></li>';
		else 				$pagination .= '<li><a href="listmovies.php?p='.$prev.$url.'">Précédent</a></li>';		

		// Pas assé de page pour les couper
		if ($nbPage < 7 + ($adjacent * 2)){
			for ($i = 1; $i <= $nbPage; $i++){ 
				if ($i == $cPage) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$i.'?'.$url.'">'.$i.'</a></li>';
				else 				$pagination .= '<li><a href="listmovies.php?p='.$i.'?'.$url.'">'.$i.'</a></li>';	
			}

		}elseif($nbPage > 5 + ($adjacent * 2)){
			if ($nbPage < 1 + ($adjacent * 2)){
				for ($i = 1; $i < 4 + ($adjacent * 2); $i++){
					if ($i == $cPage) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
					else 				$pagination .= '<li><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
				}
				$pagination .= "<li class=\"active\"><a href=\"#\">...</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=$lpm1\">$lpm1</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=$nbPage\">$nbPage</a></li>";	

			}elseif ($nbPage - ($adjacent * 2 ) > $cPage && $cPage > ($adjacent * 2)){
				$pagination .= "<li><a href=\"listmovies.php?p=1\">1</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=2\">2</a></li>";				
				for ($i = $cPage - $adjacent; $i <= $cPage + $adjacent; $i++){
					if ($i == $cPage) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
					else 				$pagination .= '<li><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
				}
				$pagination .= "<li class=\"active\"><a href=\"#\">...</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=$lpm1\">$lpm1</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=$nbPage\">$nbPage</a></li>";

			}else{
				$pagination .= "<li><a href=\"listmovies.php?p=1\">1</a></li>";
				$pagination .= "<li><a href=\"listmovies.php?p=2\">2</a></li>";
				$pagination .= "<li class=\"active\"><a href=\"#\">...</a></li>";
				for ($i = $nbPage - (2 + ($adjacent * 2)); $i <= $nbPage; $i++){
					if ($i == $cPage) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
					else 				$pagination .= '<li><a href="listmovies.php?p='.$i.'">'.$i.'</a></li>';
				}				
			}
		}
		if ($cPage == $nbPage) 	$pagination .= '<li class="active"><a href="listmovies.php?p='.$next.$url.'">Suivant</a></li>';
		else 					$pagination .= '<li><a href="listmovies.php?p='.$next.$url.'">Suivant</a></li>';
			
		return '<div class="pagination pagination-small"><ul>'.$pagination.'</ul></div>';
	}


}


 ?>