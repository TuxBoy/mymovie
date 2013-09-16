<?php require 'header.php'; ?>

<?php 
if (isset($_GET['m'])){
	$m 		= (int) $_GET['m'];
	$sql 	= 'SELECT id,name,poster,view FROM title WHERE id='.$m;
	$movie 	= $DB->query($sql);
}

if (isset($_GET['action'])){
	$action = $_GET['action'];
}

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
		<?php $ratings = $DB->query('SELECT * FROM ratings WHERE id_movie='.$mov->id); ?>	
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
				<div class="stars">
							<div class="stars-in">
								
							</div>
							<?php foreach ($ratings as $rating): ?>
							<?php if ($rating->nb_votes != null): ?>
								<p> (<?php echo '<span class="moy">'.round($rating->moy_votes, 1). '</span>'; ?> / 5 vote(s))</p>
							<?php else: ?>
								<p>Ce film n'a pas été encore voté !</p>
							<?php endif; ?>
							<?php endforeach; ?>
						</div>
			</div>
			<div class="dialog" title="Erreur">
				
			</div>
			<div class="loading"><img src="css/images/load.gif" alt="Loading"></div>
		<div class="gere_movie">
			<div class="rating">
					<form action="note.php" method="post">
						<input type="hidden" name="id_movie" value="<?= $mov->id; ?>" class="id">
						<ul class="notes-echelle">
							<li>
								<label for="note01<?= $mov->id; ?>" title="Note&nbsp;: 1 sur 5">1</label>
								<input type="radio" name="notesA" id="note01<?= $mov->id; ?>" value="1" class="radioNote">
							</li>
							<li>
								<label for="note02<?= $mov->id; ?>" title="Note&nbsp;: 2 sur 5" class="infoNote">2</label>
								<input type="radio" name="notesA" id="note02<?= $mov->id; ?>" value="2" class="radioNote">
							</li>
							<li>
								<label for="note03<?= $mov->id; ?>" title="Note&nbsp;: 3 sur 5" class="infoNote">3</label>
								<input type="radio" name="notesA" id="note03<?= $mov->id; ?>" value="3" class="radioNote">
							</li>
							<li>
								<label for="note04<?= $mov->id; ?>" title="Note&nbsp;: 4 sur 5" class="infoNote">4</label>
								<input type="radio" name="notesA" id="note04<?= $mov->id; ?>" value="4" class="radioNote">
							</li>
							<li>
								<label for="note05<?= $mov->id; ?>" title="Note&nbsp;: 5 sur 5" class="infoNote">5</label>
								<input type="radio" name="notesA" id="note05<?= $mov->id; ?>" value="5" class="radioNote">
							</li>
						</ul>
			</div>
		</div>
		</div>
		<?php endforeach; ?>
		<hr>
		<?php 	
			/* Récupère et affiche les commentaires : */
			$comments 	= $comment->readCom($m);					
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
					$avatar = "http://www.gravatar.com/avatar/".md5($co->email);
				 ?>
				<div class="message">
					<div class="avatar"><img src="<?php echo $avatar; ?>" alt="Votre Gravatar"/></div>									
					<div class="contents">
					<div class="date"> <time datetime="<?php echo $co->date_com; ?>+02:00" pubdate><?php echo $co->date_com; ?></time> 
					</div>
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

