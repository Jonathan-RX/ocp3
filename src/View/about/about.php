<?php 
ob_start();
?>
<h1 class="page-title">Auteur</h1>
						<article class="post">
							<div class="entry-content clearfix">
								<figure class="img-responsive-center">
									<img class="img-responsive" src="/public/img/jean.jpg" alt="Developer Image">
								</figure>
								<p>Responsive web design offers us a way forward, finally allowing us to design for the ebb and flow of things. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly.</p>
								<p>Responsive web design offers us a way forward, finally allowing us to design for the ebb and flow of things. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly.</p>
								<div class="height-40px"></div>
								<h2 class="title text-center">Social</h2>
								<ul class="social">
									<li class="facebook"><a href="#"><span class="ion-social-facebook"></span></a></li>
									<li class="twitter"><a href="#"><span class="ion-social-twitter"></span></a></li>
									<li class="google-plus"><a href="#"><span class="ion-social-googleplus"></span></a></li>
									<li class="tumblr"><a href="#"><span class="ion-social-tumblr"></span></a></li>
								</ul>
							</div>
						</article>

<?php
$title = 'Auteur';
$content = ob_get_clean();
require('src/View/layout.php');
?>