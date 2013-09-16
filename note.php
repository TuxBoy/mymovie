<?php 
if (!empty($_POST)){
	extract($_POST);
	$name = 'rate'.$id_movie;
	$json = array('error' => true);

	if (isset($_COOKIE[$name])){
		//echo 'Vous avez déjà voté ce film !';
		$json['message'] = 'Vous avez déjà voté ce film !';
	}else{
		if (isset($name)){
			setcookie($name, $name, time() + 60 * 60 * 24 * 30, "/");
			require '_header.php';
			$sql 		= "SELECT tt_votes, nb_votes, id_movie FROM ratings WHERE id_movie=$id_movie";
			$rating = $DB->query($sql);

			// Premier vote
			if (empty($rating)){
				$sql 	= "INSERT INTO ratings (tt_votes, nb_votes, id_movie) VALUES (:tt_votes, :nb_votes, :id_movie)";
				$data = array(
					':tt_votes' => $notesA,
					':nb_votes' => 1,
					':id_movie' => $id_movie
				);

				$DB->insert($sql, $data);
				
				$json['error']		= false;
				$json['average']	= $averageRate;
				$json['message'] 	= 'Votre vote a été pris en compte. Merci !';	
			}else{
				// Si pas premier vote, alors UPTADE de la base
				foreach ($rating as $rate) {
					$average 			= $rate->tt_votes / $rate->nb_votes;
					$averageRate 	= round($average, 1);				

					$data = array(
						':tt_votes' 	=> $rate->tt_votes + $notesA,
						':nb_votes'		=> $rate->nb_votes + 1,
						':moy_votes' 	=> $averageRate,
						':id_movie'		=> $id_movie
					);

					$sql = "UPDATE ratings SET tt_votes=:tt_votes, nb_votes=:nb_votes, moy_votes=:moy_votes WHERE id_movie=:id_movie";
					$DB->insert($sql,$data);				

					$json['error']		= false;
					$json['average']	= $averageRate;
					$json['message'] 	= 'Votre vote a été pris en compte. Merci !';					
				}
			}
		}		
	}
}

echo json_encode($json);

 ?>