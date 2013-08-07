<?php 
require 'header.php';
require 'api/sphinxapi.php';

$sphinx = new SphinxClient;

$sphinx->SetServer('localhost', 2081);
$sphinx->SetConnectTimeout(1);

$data = $sphinx->Query('name', 'title');

if ($data === false){
	echo 'ERREUR:'.$sphinx->GetLastError();
	die();
}

if( $sphinx->GetLastWarning() ){
    echo 'WARNING: '.$sphinx->GetLastWarning();
}

debug($data);