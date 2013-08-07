<?php require 'header.php'; ?>

<?php 
if (isset($_GET['m'])){
	$m = (int) $_GET['m'];
}

if (isset($_GET['action'])){
	$action = $_GET['action'];
}

$sql 	= 'SELECT id,name,poster,view FROM title WHERE id='.$m;
$movie 	= $DB->query($sql);

 ?>


<?php 
switch ($action) {
	case 'add':
?>
	<?= $flash->flash(); ?>
	<h2>Ajouter un film</h2>
	 <div class="actions">
	 	<form action="moviereg.php" method="post" enctype="multipart/form-data">
		 	<?php echo $form->input('name', 'Titre :'); ?>
		 	<?php echo $form->input('poster', 'Affiche :', array('type' => 'file')); ?>
		 	<?php echo $form->input('view', 'J\'ai vu ce film : ', array('type' => 'checkbox')); ?><br><br>

		 	<input type="submit" class="btn" value="Ajouter">
	 	</form>
	 </div>
<?php 
	break;
	case 'edit':
?>
	<?php foreach($movie as $m): ?>	

	<h2><?= $m->name; ?></h2>
	<form action="moviereg.php" method="post" enctype="multipart/form-data">
		<fieldset>
			<ledend>Modifier un film</ledend>		
				<input type="hidden" name="id" value="<?= $m->id; ?>">
				<label for="name">Titre : </label><input type="text" name="name" value="<?= $m->name; ?>" id="name">
				<label for="poster">Affiche : </label><input type="file" name="poster" id="poster"><br>	<br>			
				Ce film a été vu  : <input type="checkbox" id="view" name="view" <?php if ($m->view > 0) echo 'checked'; ?>><br>
				<input type="submit" class="btn" value="Modifier">
		</fieldset>
	</form>
	<?php endforeach; ?>
<?php
		break;
	case 'del':
		foreach($movie as $m){
			// Supprime le film :
			$sql = 'DELETE FROM title WHERE id='.$m->id;
			$DB->insert($sql);	
			header('Location:listmovies.php');	
		}
		break;
	case 'consult':
		// Information su le film
?>
		<?php 
			$title = 'Mon film';
			//require 'header.php'; 			
			$flash->flash();
		?>
		<?php foreach($movie as $mov): ?>	
		<div class="row">			
			<div class="span2">
				<?php if ($mov->poster != null): ?>
					<a href="css/images/affiches/<?= $mov->poster; ?>"><img src="css/images/affiches/<?= $mov->poster; ?>" alt="<?= $mov->poster; ?>" width="154px" height="215"></a>
				<?php else: ?>
					<img src="css/images/affiches/default.jpg" alt="Image par défaut" width="154px" height="215">	
				<?php endif; ?>
			</div>
			<div class="span5">
				<h2><?= $mov->name; ?></h2>
			</div>
		</div>
		<?php endforeach; ?>
		<hr>
		<?php 	
			/* Récupère et affiche les commentaires : */
			$comments 	= $comment->readCom($m);	
			//$mailMd5	= md5($comments->email);
		
		?>
		<div class="comment">
			<h3 id="comment">Commentaires<sub>(<?php echo count($comments); ?>)</sub></h3>
			<?php //foreach ($movie as $m): ?>
				<form action="addComment.php" method="post">
					<?php if ($user->isLogged()): ?>
						<p>Ajouter un nouveau commentaire :</p>
						<input type="hidden" name="id_movie" value="<?= $m; ?>">
						<textarea class="mess-comment wysiwyg" name="message" cols="54">						
						</textarea>
						<input type="submit" value="Ajouter le commentaire" class="btn">
					<?php else: ?>
						<p>Il faut être inscrit afin de pouvoir ajouter un commentaire</p>
					<?php endif; ?>
				</form>
			<?php //endforeach; ?>
		</div>		

		<?php if (count($comments) >= 1): ?>
			<?php foreach($comments as $co): ?>
				<?php 
					$avatar = "http://www.gravatar.com/avatar/".md5($comments->email).".png?s=80";
				 ?>
				<div class="message">
					<div class="avatar"><img src="<?php echo $avatar; ?>" alt="Votre Gravatar"></div>					
					<div class="contents">
					<div class="pseudo">Posté par : <a href=""><?php echo $co->pseudo; ?></a></div>
						<?php echo $co->message; ?>
					</div>
					<hr>
				</div>				
			<?php endforeach; ?>
		<?php else: ?>
			<p>Ce film ne contient aucun commentaire !</p>
		<?php endif; ?>
<?php 
		break;
	default:
		echo 'Cette action n\'est pas valide !!';
		exit();
		break;
}
 ?>

<?php require 'footer.php'; ?>

