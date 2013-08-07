<?php 
require '_header.php';

if (isset($_GET['r'])){
	$q 		= $_GET['r'];
	$sql 	= "SELECT id,name,poster FROM title WHERE name LIKE '%$q%'";
	$query 	= $DB->query($sql);
	$count 	= count($query);

	if ($count >= 1){
		foreach ($query as $movies) {
			$name = $movies->name;
			$name = str_ireplace($q, '<strong style="color:#fff;">'.$q.'</strong>', $name);
		 	echo '<p class="name"><a href="search.php?q='.$movies->name.'">'.$name.'</a></p><br>';
		 } 
	}else{
		echo 'Aucun résultat pour '.$q;
	}
 }

 ?>
