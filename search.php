<?php 
if (isset($_GET['q'])){
	$q 		= addslashes($_GET['q']);
	$title 	= $q.' - Recherche dans ma filmothèque';
	require 'header.php';	

	$search = explode(" ", $q);
	$sql 	= "SELECT * FROM title";

	$i = 0;
	foreach ($search as $movies) {
		if (strlen($movies) > 3){
			if ($i == 0){
				$sql .= " WHERE ";
			}else{
				$sql .= " OR ";
			}
			$sql .= "name LIKE '%$movies%'";
			$i++;
		}
	}

	$query = $DB->query($sql);
	echo '<h3>Films</h3>';
	if (count($query) <= 1) echo '<h4>'.count($query).' résultat trouvé dans ma filmothèque</h4>';
	else 				 	echo '<h4>'.count($query).' résultats trouvés dans ma filmothèque</h4>';
?>
	<table class="table">
			<thead>
				<tr>
					<th>Affiche</th>
					<th>Titre</th>
					<th>Vu</th>
				</tr>
			</thead>
			<tbody>
<?php 
	foreach ($query as $name) {	
		$c = $name->name;	
		foreach ($search as $movie) {
			$c = str_ireplace($movie, '<strong style="color:#fff;">'.$movie.'</strong>', $c);
		}	
?>
			
				<tr>
					<td><a href="css/images/affiches/<?= $name->poster; ?>" class="zoombox"><img src="css/images/affiches/<?= $name->poster; ?>" alt="<?= $name->poster; ?>" width="80"></a></td>
					<td><a href="movie.php?m=<?= $name->id; ?>&action=consult"><?php echo $c; ?></a></td>
					<td>
						<?php if ($name->view > 0): ?>
							<span id="idView" class="label label-success"><a class="view" href="movie.php?m=<?= $name->id; ?>&v=<?= $name->view; ?>&action=view">Vu</a></span>
						<?php else: ?>
							<span id="idView" class="label label-important"><a class="view" href="movie.php?m=<?= $name->id; ?>&v=<?= $name->view; ?>&action=view">Pas vu</a></span>
						<?php endif; ?>
					</td>
				</tr>
			
<?php 
	} // Fin du foreach
}else{
	echo 'Aucune recherche a été lancé !';
}

 ?>
</tbody>
</table>

<?php require 'footer.php'; ?>