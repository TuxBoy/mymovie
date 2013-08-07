<?php 
require 'header.php';
// Déconnexion de l'utilisateur
unset($_SESSION['Auth']);
$flash->setFlash('Vous êtes maintenant déconnecté !');
header('Location:index.php');
?>