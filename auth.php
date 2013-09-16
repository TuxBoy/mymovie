<?php require 'header.php'; ?>
<?php 
if ($user->isLogged()){
	$flash->setFlash('Vous ne pouvez pas avoir accès à cette page', 'error');
	header('Location:index.php');
}

if (!empty($_POST)){
	$pseudo 	= $_POST['pseudo'];
	$password 	= sha1($_POST['password']);

	if (!$user->inBase($pseudo, $password)){
		// On a trouvé un utilisateur
		// Créé les sessions
		$_SESSION['Auth'] = array(
			'pseudo'	=> $pseudo,
			'password'	=> $password
		);

		$flash->setFlash('Vous êtes maintenant connecté !');
		header('Location:index.php');
	} else {
		$error = 'Votre compte utilisateur est introuvable ! (Veuillez vérifier votre pseudo ou mot de passe)';
	}
}
 ?>

<!-- Main -->
	<div id="">				
		<h1>Se connecter</h1>
		
		<h2>Connectez-vous à votre compte movie hunter</h2> <br> <br>
		<?php if (isset($error)) echo '<span class="error-message">'.$error.'</span><br><br>'; ?>
		<form action="auth.php" method="post">
			<?php echo $form->input('pseudo', 'Pseudo :'); ?>
			<?php echo $form->input('password', 'Mot de passe :', array('type' => 'password')); ?>
			<?php echo $form->input('remember', 'Se souvenir de moi :', array('type' => 'checkbox')); ?>

			<div>
				<input type="submit" class="btn" value="Se connecter">
			</div>
		</form>
	</div>
<?php require 'footer.php'; ?>