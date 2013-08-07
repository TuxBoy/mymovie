<?php 	
require 'header.php';
//$json = array('error' => true);
	if (isset($_GET['v'])){
		$v = (int) $_GET['v'];
		$m = (int) $_GET['m'];

		if ($v == 1){
			$data = array(
				':id'	=> $m,
				':view' => 0
			);

			$DB->insert('UPDATE title SET view=:view WHERE id=:id', $data);

			/*$json['error']	 = false;
			$json['message'] = "Vous n'avez pas vu ce film";
			$json['view']	 = "0";*/
		} else {
			$data = array(
				':id'	=> $m,
				':view' => 1
			);

			$DB->insert('UPDATE title SET view=:view WHERE id=:id', $data);

			/*$json['error']	 = false;
			$json['message'] = "Vous avez deja vu ce film";
			$json['view']	 = "1";*/

		}
	}
//echo json_encode($json);

?>