<?php 
require 'header.php'; 

if (!$user->isLogged()){
	$flash->setFlash('Vous ne pouvez pas accèder à cette page, il faut être connecté', 'error');
	header('Location:index.php');
}


if (!empty($_POST)){
	extract($_POST);
	$name = htmlentities($name);

	$newName 		= strtolower($name);

	// Renomme l'affiche avec le titre du film
	$nameForlder 	= basename($_FILES['poster']['name']);
	$folder 	 	= explode('.', $nameForlder);
	$folderFinal 	= str_replace($folder['0'], $newName, $folder);
	$newFolder 		= implode(".", $folderFinal);  

	// Supprime les accents
	$newFolder = suppr_accents($newFolder);
	// Upload de l'affiche
	if (!empty($_FILES['poster']['name'])){
		if (strpos($_FILES['poster']['type'], 'image') !== false){
			$dir = "css/images/affiches";
			if (!file_exists($dir))	mkdir($dir, 0777);
			move_uploaded_file($_FILES['poster']['tmp_name'], $dir.'/'.$newFolder);		
		} else {
			$flash->setFlash('Le fichier n\'est pas une image valide', 'error');			
			header('Location:movie.php?action=add');
		}
	}

	// Enregistre l'image dans la base :
	// Si l'id n'existe pas => INSERT
	if (!isset($id)){
		if ($view == 'checked') $view = 1;
		else 					$view = 0;

		$data = array(
			':name' 	=> $name,
			':poster'	=> $newFolder,
			':view'		=> $view
		);
		$sql = "INSERT INTO title(name,poster,view) VALUES(:name,:poster,:view)";		
		$DB->insert($sql, $data);
		$flash->setFlash('Le film a bien été ajouté');
		header('Location:listmovies.php');
	}

	if ($view = 'checked'){
		$data = array(
			':id'		=> $id,
			':name'		=> $name,
			':poster'	=> $newFolder,
			':view'		=> 1
		);
		$DB->insert('UPDATE title SET name=:name, poster=:poster, view=:view WHERE id=:id', $data);	
		$flash->setFlash('Le film a bien été édité');
		header('Location:listmovies.php');	 				
	} else {
		$data = array(
			':id'		=> $id,
			':name'		=> $name,
			':poster'	=> $newFolder
		);
		$DB->insert('UPDATE title SET name=:name, poster=:poster WHERE id=:id', $data);
		$flash->setFlash('Le film a bien été édité');
		header('Location:listmovies.php');
	}
} else {
	$flash->setFlash('Il n\'y a pas d\'informations à modifier', 'error');
	header('Location:listmovies.php');
}


?>