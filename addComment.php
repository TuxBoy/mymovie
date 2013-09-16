<?php
require 'header.php';

if (!empty($_POST)){
	extract($_POST);

	$comment->addCom(array(
		':id_user'		=> 9,
		':message' 		=> $message,
		':date_com'		=> date('Y-m-d H:i:s'),
		':id_movie' 	=> $id_movie
	));

	$flash->setFlash('Votre commentaire a bien été ajouté !');
	header('Location:movie.php?m='.$id_movie.'&action=consult#comment');
}else{
	echo 'Votre formulaire est vide !';
}

 ?>