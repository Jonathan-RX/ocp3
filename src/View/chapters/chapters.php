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
								<h2 class="entry-title">
									<a href="/chapitre/<?= $chapter->getSlug(); ?>"><?= $chapter->getTitle(); ?></a>
								</h2>
								<div class="entry-meta">
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?= $chapter->getDate(); ?>"><?= $date ->format('d/m/Y à H\hi') ?></time></a></span>

									<span class="comments-link"><a href="/chapitre/<?= $chapter->getSlug(); ?>#comments"><?= $count; ?></a></span>
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
$count = 0;
?>
<h3 class="entry-title">Pages</h3>
<ul class="pages">
		<li><a href="/chapitres/1">&lt;&lt;</a></li>	
<?php
while($count < $nbrPages){
	$count++;
	if($count == $page){
?>
		<li><a href="#" class="self"><?= $count; ?></a></li>	
<?php
	}else{
?>
		<li><a href="/chapitres/<?= $count; ?>"><?= $count; ?></a></li>	
<?php
	}
}
?>
		<li><a href="/chapitres/<?= ceil($nbrPages); ?>">&#62;&#62;</a></li>	
</ul>
<?php
$title = 'Liste des chapitres';
$content = ob_get_clean();
require('src/View/layout.php');
?>