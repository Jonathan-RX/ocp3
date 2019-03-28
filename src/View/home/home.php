<?php 
ob_start();
?>

<?php
foreach($chapters as $chapter) :
$date = new DateTime($chapter->getDate(),new DateTimeZone('Europe/Paris'));
$comanager = new App\Model\CommentManager();
$count = $comanager->count($chapter->getId());
if($count > 1){$count = $count . ' Commentaires';}else{$count = $count . ' Commentaire';}
?>

                        <article class="post post-<?= $chapter->getId(); ?>">
							<header class="entry-header">
								<h1 class="entry-title">
									<a href="/chapitre/<?= $chapter->getSlug(); ?>"><?= $chapter->getTitle(); ?></a>
								</h1>
								<div class="entry-meta">
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?= $chapter->getDate(); ?>"><?= $date ->format('d/m/Y à H\hi') ?></time></a></span>

									<span class="comments-link"><a href="#"><?= $count; ?></a></span>
								</div>
							</header>
							<div class="entry-content clearfix">
								<p><?= substr($chapter->getContent(),0,640); ?> ...</p>
								<div class="read-more cl-effect-14">
									<a href="/chapitre/<?= $chapter->getSlug(); ?>" class="more-link">Lire la suite <span class="meta-nav">→</span></a>
								</div>
							</div>
						</article>
<?php 
endforeach;
?>

<?php
$title = 'Accueil';
$content = ob_get_clean();
require('src/View/full-width.php');
?>