<?php require 'header.php'; ?>
<?php
if ($user->isLogged()){
	// A venir les messages flash
	header('Location:index.php');
}
if (!empty($_POST)){	
	extract($_POST);
	$pseudo 	= htmlentities($pseudo);
	$password 	= sha1($password);
	$confirm 	= sha1($confirm);
	$email 		= htmlentities($email);
	
	$erreurPseudo 		= '';
	$erreurPassword 	= '';
	$erreurEmail 		= '';
	$valid 				= true;

	if (empty($pseudo)){
		$valid 			= false;
		$erreurPseudo 	= "Vous n'avez pas rempli votre pseudo !";
	}
	if ($user->noExist($pseudo, 'pseudo')){
		$valid 			= false;
		$erreurPseudo 	= "Le pseudo que vous avez choisi existe déjà !";
	}
	if (empty($password) || $password != $confirm){
		$valid 			= false;
		$erreurPassword = "Vous n'avez pas entré un mot de passe, ou les mot de passe sont différents !";
	}
	if (!preg_match("/^[a-z0-9\-_.]+@[a-z0-9\-_.]+\.[a-z]{2,3}$/i", $email)){
		$valid			= false;
		$erreurEmail 	= "Votre adresse email n'est pas valide";
	}
	if (empty($email)){
		$valid 			= false;
		$erreurEmail 	= "Vous n'avez pas rempli votre email !";
	}
	if ($user->noExist($email, 'email')){
		$valid 			= false;
		$erreurEmail	= "L'adresse email que vous avez choisi existe déjà !";
	}

	if ($valid){		
		// Enregistre le membre dans BDD
		$DB->insert('INSERT INTO users (pseudo, password, email, avatar, dateinscr) 
					 VALUES (:pseudo, :password, :email, :avatar, :dateinscr)', array(
							'pseudo' 		=> $pseudo,
							'password' 		=> $password,
							'email'			=> $email,
							'avatar'		=> null,
							'dateinscr'		=> date()
		));

		// Créé les sessions
		$_SESSION['Auth'] = array(
			'pseudo'	=> $pseudo,
			'password'	=> $password			
		);

		// Session permettant de vérifier sur les autres pages
		$_SESSION['Verif'] = array('registre' => 'ok');
		sleep(2);
		header('Location:index.php');

	}else{
		$errors = array(
			'pseudo'	=> $erreurPseudo,
			'password'	=> $erreurPassword,
			'email'		=> $erreurEmail
		);

		$form->setErrors($errors);
	}

}

//if (isset($pseudo)) $form->setData(array($pseudo,$email));	
//if (isset($email))	$form->setData($email);

?>



<!-- Main -->
	<div id="">				
		<h1>Créer un compte</h1>
		<h2>Créez votre propore filmothèque</h2> <br> <br>
			<form action="login.php" method="post">
				<?php echo $form->input('pseudo', 'Pseudo :'); ?>
				<?php echo $form->input('password', 'Mot de passe :', array('type' => 'password')); ?>
				<?php echo $form->input('confirm', 'Entrez à nouveau votre mot de passe :', array('type' => 'password')); ?>
				<?php echo $form->input('email', 'Adresse Email :', array('type' => 'email')); ?>
				<?php echo $form->input('avatar', 'Choisissez votre avatar :', array('type' => 'file')); ?>
			
				<div>
					<input type="submit" class="btn" value="Créer">		
				</div>
			</form>
	</div>
<?php require 'footer.php'; ?>