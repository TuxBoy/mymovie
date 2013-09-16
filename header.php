<?php require '_header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <?php if (isset($title)): ?>      
      <title><?= $title; ?> - My Movie</title>
    <?php else: ?>
      <title>My Movie</title>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Centralisation des films préférés de chacun">
    <meta name="author" content="TuxBoy">
  <!-- <meta http-equiv="Content-type" content="text/html; charset=utf-8" /> -->
  <link rel="shortcut icon" href="css/images/favicon/favicon_cine.png" />
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/perso.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/perso2.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/notif.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/notifTest.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all" />
  <link href="js/zoombox/zoombox.css" rel="stylesheet" type="text/css" media="screen" />
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  
  <script type="text/javascript" src="js/jquery-1.6.2.min.js" charset="utf-8"></script>
  <!--[if IE 6]>
    <script src="js/DD_belatedPNG-min.js" type="text/javascript" charset="utf-8"></script>
  <![endif]-->
  <script type="text/javascript" src="js/jquery-func.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script type="text/javascript" src="js/zoombox/zoombox.js"></script>
  <script type="text/javascript" src="js/box.js"></script>
  <script type="text/javascript" src="js/note.js"></script>
</head>
<body>
<!-- Shell -->
<div id="shell">
  <!-- Header -->
  <div id="header">
    <h1 id="logo"><a href="index.php">Filmothèque</a></h1>
    <div class="social">
      <span>Suivez nous sur :</span>
      <ul>
          <li><a class="twitter" href="#">twitter</a></li>
          <li><a class="facebook" href="#">facebook</a></li>
          <li><a class="vimeo" href="#">vimeo</a></li>
          <li><a class="rss" href="#">rss</a></li>
      </ul>
    </div>
    
    <!-- Navigation -->
    <div id="navigation">
      <ul>       
        <?php if ($user->isLogged()) :  ?>
          <?php foreach ($pagesAuth as $namePage => $page): ?>                                  
            <li><a <?php if($scriptName[2] == $page): ?> class="active" <?php endif; ?> href="<?= $page; ?>"><?= $namePage; ?>
            </a></li>                               
          <?php endforeach; ?>
        <?php else: ?>
          <?php foreach ($pages as $namePage => $page): ?>                                  
            <li><a <?php if($scriptName[2] == $page): ?> class="active" <?php endif; ?> href="<?= $page; ?>"><?= $namePage; ?>
            </a></li>                               
          <?php endforeach; ?>
        <?php endif; ?>
       </ul>
    </div>

    <!-- end Navigation -->
    
    <!-- Sub-menu -->
    <div id="sub-navigation">
      <ul>
          <?php if ($user->isLogged()): ?>
            <li><a href="listmovies.php">Mes films</a></li>
            <li><a href="movie.php?action=add">Ajouter un film</a></li>
          <?php endif; ?>
          <li><a href="#">Montrer Tout</a></li>         
          <li><a href="#">Les mieux notées</a></li>         
      </ul>
      <div id="search">
        <form action="search.php" method="get" accept-charset="utf-8">
          <label for="search-field"></label>          
          <input type="text" name="q" placeholder="Entrez votre recherche"  id="search-field" class="search-field" AUTOCOMPLETE=OFF>
          <input type="submit" value="Go!" class="search-button">
          <p class="exsearch">Ex : Oblivion, Terminator, Rocky...</p>
        </form>
      </div>
      <div class="result" id="result">
       
      </div>
    </div>
    <!-- end Sub-Menu -->
    
  </div>
  <!-- end Header -->