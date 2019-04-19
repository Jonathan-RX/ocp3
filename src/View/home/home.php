<?php 
ob_start();
?>

                        <article class="post">
							<header class="entry-header">
								<h1 class="entry-title">
									Exemple de contenu textuel pour présenter le site
								</h1>
							</header>
							<div class="entry-content clearfix">
								<figure class="img-home">
									<img class="img-responsive center-block" src="/public/img/montagne.jpg" alt="Developer Image">
								</figure>
								<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis et est a odio ultrices mattis eget ac lacus. Quisque vitae lorem iaculis, semper nunc in, fermentum ligula. Etiam ullamcorper ipsum nunc, a fermentum urna faucibus vel. Nunc a hendrerit ligula. Ut ac mollis ipsum. Morbi quam diam, sagittis et convallis sit amet, aliquam in orci. Aliquam elementum lorem id luctus sagittis. Proin at sapien enim. Morbi arcu eros, condimentum eu neque sed, consequat luctus eros. Nulla facilisi. Suspendisse a nunc sed turpis faucibus pharetra a vitae sapien. Nam feugiat at nisl eu dignissim.</p>
								<p class="text-justify">In hac habitasse platea dictumst. Mauris ex sem, mattis a nibh eget, vulputate hendrerit turpis. Ut in purus et felis fringilla rutrum. Curabitur semper, dolor eu molestie vehicula, mi odio sagittis erat, tincidunt sollicitudin erat nisi non ante. Integer ornare justo vitae vulputate commodo. Praesent a purus ac felis porttitor finibus tincidunt vitae nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse faucibus lorem eget neque consequat maximus. Sed varius fringilla nibh, sit amet semper magna viverra in. Quisque porta ipsum non urna varius malesuada ac imperdiet justo. Praesent ornare consectetur fermentum. Suspendisse vulputate interdum egestas.</p>
								<div class="read-more cl-effect-14">
									<a href="/chapitres" class="more-link read-more">Découvrir les chapitres <span class="meta-nav">→</span></a>
								</div>
							</div>
						</article>


<?php
$title = 'Accueil';
$content = ob_get_clean();
require('src/View/layout.php');
?>