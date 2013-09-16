<?php $title = 'Liste des films de ma filmothèque'; ?>
<?php require 'header.php'; ?>
<?php if (!$user->isLogged()){
	header('Location:index.php');
} 
?>
<h1>Mes films</h1>

<?php 
if (isset($_GET['v'])){
	$v = $_GET['v'];	
	$countByView 		= $DB->query('SELECT * FROM title WHERE view='.$v);
}

$count 				= $DB->query('SELECT id FROM title');
$adjacent 			= 3;
$cPage 			= 1;

if (isset($_GET['p'])){
	if (is_numeric($_GET['p'])){
		if ($_GET['p'] > 0)	$cPage = round($_GET['p']);
		else 				$cPage = 1;
	}
}

$nbrMovie		= count($count);

$perPage 		= 20;

$nbrPageDebut 		= (($cPage - 1) * $perPage);
$nbPage 				= ceil($nbrMovie/$perPage);
//$nbPageMovieView 	= ceil($nbrMovieView/$perPage);
$lpm1					= $nbPage - 1;


// Séléctionne tous les films
if (isset($v)) {
	$nbrMovieView 	= count($countByView);
	$nbPageMovieView 	= ceil($nbrMovieView/$perPage);
	$sql = "SELECT id,name,poster,view FROM title WHERE view=$v  ORDER BY id DESC LIMIT $nbrPageDebut,$perPage";

} else {
	$sql = "SELECT id,name,poster,view FROM title  ORDER BY id DESC LIMIT $nbrPageDebut,$perPage";
}					
$movies = $DB->query($sql);

?>
<?php echo $flash->flash(); ?>
<?php if (isset($v)): ?>
<h3><?= $nbrMovieView; ?> Films vus</h3>
	<?php $url = '&v='.$v;  ?>
<?= Pagination::toString($nbPageMovieView, $adjacent, $cPage,$url); ?>
<?php else: ?>
	<h3><?= $nbrMovie; ?> Films</h3>

	<?= Pagination::toString($nbPage, $adjacent, $cPage); ?>
<?php endif; ?>
<div class="scroll">
	<a href="#">Haut</a>
</div>
<table class="table">
	<thead>
		<tr>
			<th>Affiche</th>
			<th>Titre</th>
			<th>Vu</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
	<?php $i = 0; ?>
		<?php foreach ($movies as $movie): ?>

		<tr>
			<?php if ($movie->poster != null): ?>
				<td>
					<a href="css/images/affiches/<?= $movie->poster; ?>" class="zoombox">
					<img src="css/images/affiches/<?= $movie->poster; ?>" alt="" width="80"></a>
				</td>
			<?php else: ?>
				<td><img src="css/images/affiches/default.jpg" title="Pas d'image" alt="" width="80"></td>
			<?php endif; ?>
			<td><a href="movie.php?m=<?= $movie->id; ?>&action=consult"><?= $movie->name; ?></a></td>
			<td>
				<?php 

					if ($movie->view == 0){
						$class 	= 'label label-important';
						$text 	= 'Pas vu';
					}else{
						$class 	= 'label label-success';
						$text		= 'Vu';
					}
					$i++;

				 ?>
				<span id="view<?= $movie->id; ?>" class="<?= $class; ?>">
					<a id="vu<?= $movie->id; ?>" class="view" href="view.php?m=<?= $movie->id; ?>&v=<?= $movie->view; ?>"><?= $text; ?></a>
				</span>
			</td>
			<td><a href="movie.php?m=<?= $movie->id; ?>&action=edit">Modifier</a> | 
				<a onclick="return confirm('Etes-vous sûr de vouloir supprimer ce film');" 
					href="movie.php?m=<?= $movie->id; ?>&action=del" >Supprimer</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php if (isset($v)): ?>
	<?php $url = '&v='.$v;  ?>
<?= Pagination::toString($nbPageMovieView, $adjacent, $cPage, $url); ?>
<?php else: ?>
	<?= Pagination::toString($nbPage, $adjacent, $cPage); ?>
<?php endif; ?>
<?php require 'footer.php'; ?>