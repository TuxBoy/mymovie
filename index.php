<?php require 'header.php'; ?>

	<div id="main">
			<?= $flash->flash(); ?>
		<!-- Content -->
		<div id="content">

			<?php 
				// Récupère tous les films vu
				$moviesView = $DB->query('SELECT * FROM title WHERE view=1 ORDER BY id DESC');				
			 ?>
			<!-- Box -->
			<div class="box">

				<div class="head">
					<h3>Déjà vu</h3>
					<p class="text-right"><a href="listmovies.php?v=1">Voir tout</a></p>
				</div>

				<!-- Movie -->
				<div id="carrousel">
				<?php foreach($moviesView as $movie): ?>
				<div class="movie">				
					<div class="movie-image">
						
						<a href="movie.php?m=<?= $movie->id; ?>&action=consult"><span class="play"><span class="name"><?= $movie->name; ?></span></span>
							<img src="css/images/affiches/<?= $movie->poster; ?>" alt="<?= $movie->poster; ?>" /></a>
						
					</div>										
					<div class="rating">
						<p>Note</p>
						<div class="stars">
							<div class="stars-in">
								
							</div>
						</div>
						<?php 
							$comments = $comment->readCom($movie->id);
						 ?>
						<a href="movie.php?m=<?= $movie->id; ?>&action=consult#comment"><span class="comments"><?php echo count($comments); ?></span></a>
					</div>
				</div>
				<?php endforeach; ?>
				</div>
				<a class="prev" id="movie_prev" href="#"><span>prev</span></a>
				<a class="next" id="movie_next" href="#"><span>next</span></a>
				<!-- end Movie -->								
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			<?php 
				$moviesNoView = $DB->query('SELECT * FROM title WHERE view=0 ORDER BY id DESC');
			 ?>
			<!-- Box -->
			<div class="box">
				<div class="head">
					<h3>Film à voir</h3>
					<p class="text-right"><a href="listmovies.php?v=0">Voir tout</a></p>
				</div>

				<!-- Movie -->	
				<div id="carrousel_avoir">
				<?php foreach($moviesNoView as $movieNoView): ?>
				<div class="movie">
					
					<div class="movie-image">
						<a href="#"><span class="play"><span class="name"><?= $movieNoView->name; ?></span></span>
						<?php if ($movieNoView->poster != null): ?>
							<img src="css/images/affiches/<?= $movieNoView->poster; ?>" alt="<?= $movieNoView->poster; ?>">
						<?php else: ?>
							<img src="css/images/affiches/default.jpg" alt="affiche par défaut">
						<?php endif; ?>
						</a>
					</div>	
					<div class="rating">
						<p>Note</p>
						<div class="stars">
							<div class="stars-in">
								
							</div>
						</div>
						<span class="comments">12</span>
					</div>
				</div>
				<?php endforeach; ?>
				</div>			
				<a id="avoir_prev" href="#"><span>prev</span></a>
				<a id="avoir_next" href="#"><span>next</span></a>
				<!-- end Movie -->											
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
			<!-- Box -->
			<div class="box">
				<div class="head">
					<h3>Film à télécharger</h3>
					<p class="text-right"><a href="#">Voir tout</a></p>
				</div>

				<!-- Movie -->
				<div class="movie">
					<div class="movie-image">
						<a href="#"><span class="play"><span class="name">HOUSE</span></span><img src="css/images/movie13.jpg" alt="movie" /></a>
					</div>
					<div class="rating">
						<p>Note</p>
						<div class="stars">
							<div class="stars-in">
								
							</div>
						</div>
						<span class="comments">12</span>
					</div>
				</div>
				<!-- end Movie -->								
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
		</div>
		<!-- end Content -->

		<!-- NEWS -->
		<div id="news">
			<div class="head">
				<h3>New</h3>
				<p class="text-right"><a href="#">Voir tout</a></p>
			</div>
			
			<div class="content">
				<p class="date">12.04.09</p>
				<h4>Disney's A Christmas Carol</h4>
				<p>&quot;Disney's A Christmas Carol,&quot; a multi-sensory thrill ride re-envisioned by Academy Award&reg;-winning filmmaker Robert Zemeckis, captures... </p>
				<a href="#">Lire la suite</a>
			</div>
			<div class="content">
				<p class="date">11.04.09</p>
				<h4>Where the Wild Things Are</h4>
				<p>Innovative director Spike Jonze collaborates with celebrated author Maurice Sendak to bring one of the most beloved books of all time to the big screen in &quot;Where the Wild Things Are,&quot;...</p>
				<a href="#">Read more</a>
			</div>
			<div class="content">
				<p class="date">10.04.09</p>
				<h4>The Box</h4>
				<p>Norma and Arthur Lewis are a suburban couple with a young child who receive an anonymous gift bearing fatal and irrevocable consequences.</p>
				<a href="#">Read more</a>
			</div>
		</div>
		<!-- end NEWS -->
		
		<!-- Coming -->
		<div id="coming">
			<div class="head">
				<h3>En cours de téléchargement<strong>!</strong></h3>
				<p class="text-right"><a href="#">See all</a></p>
			</div>
			<div class="content">
				<h4>The Princess and the Frog </h4>
					<a href="#"><img src="css/images/coming-soon1.jpg" alt="coming soon" /></a>
				<p>Walt Disney Animation Studios presents the musical "The Princess and the Frog," an animated comedy set in the great city of New Orleans...</p>
				<a href="#">Lire la suite</a>
			</div>
			<div class="cl">&nbsp;</div>
			<div class="content">
				<h4>The Princess and the Frog </h4>
					<a href="#"><img src="css/images/coming-soon2.jpg" alt="coming soon" /></a>
				<p>Walt Disney Animation Studios presents the musical "The Princess and the Frog," an animated comedy set in the great city of New Orleans...</p>
				<a href="#">Read more</a>
			</div>
			
		</div>
		<!-- end Coming -->
		<div class="cl">&nbsp;</div>
	</div>
	<!-- end Main -->
<?php require 'footer.php'; ?>	