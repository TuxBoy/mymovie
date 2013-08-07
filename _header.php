<?php
require 'core/Conf.class.php';
require 'core/function.php';
require 'classes/User.class.php';
require 'core/Form.class.php';
require 'core/Flash.class.php';
require 'core/Db.class.php';
require 'core/Pagination.class.php';
require 'classes/Comment.class.php';

$pages = array(
	'Acceuil' 		=> 'index.php',
	'News'			=> 'news.php',
	'Inscription' 	=> 'login.php',
	'Se connecter'	=> 'auth.php',
	'Contactez'		=> 'contact.php'
); 

$pagesAuth = array(
	'Acceuil' 			=> 'index.php',
	'News'				=> 'news.php',
	'Mon compte' 		=> 'user.php',
	'Contactez'			=> 'contact.php',
	'Se déconnecter' 	=> 'logout.php'
); 

$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);

$DB 		= new DB('localhost', 'root', 'naruto22kira', 'filmotheque');
$form 		= new Form();
$user		= new User($DB);
$flash 		= new Flash();
$comment 	= new Comment($DB);

?>