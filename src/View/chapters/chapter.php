<?php 
ob_start();
$date = new DateTime($chapter->getDate(),new DateTimeZone('Europe/Paris'));
$comanager = new App\Model\CommentManager();
$count = $comanager->count($chapter->getId());
if($count > 1){$count = $count . ' Commentaires';}else{$count = $count . ' Commentaire';}
?>

                        <article class="post post-1">
							<header class="entry-header">
								<h1 class="entry-title"><?= $chapter->getTitle(); ?></h1>
								<div class="entry-meta">
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?= $chapter->getDate(); ?>"><?= $date ->format('d/m/Y à H\hi') ?></time></a></span>
			
									<span class="comments-link"><a href="#comments"><?= $count; ?></a></span>
								</div>
							</header>
							<div class="entry-content clearfix">
                            <?= $chapter->getContent(); ?>
							</div>
						</article>

<section id="comments" class="comments">
    <header class="entry-header">
        <h1 class="entry-title">Commentaires</h1>
    </header>
<?php if(isset($_GET['reportComment']) && $_GET['reportComment'] === 'success'){echo '<h3>Le commentaire à bien été signalé.</h3>';} ?>
    <?php foreach($chapter->getComments() as $c) :
        if(!empty($c->getId())) : ?>
    <p>
        <b>Le <?= $c->getDateAdd(); ?> par <?= $c->getAuthor(); ?></b> (<a href="/chapitre/<?=  $chapter->getSlug(); ?>/reportComment=<?= $c->getId(); ?>" onclick="return confirm('Etes-vous sur de vouloir signaler ce commentaire?')">Signaler ce commentaire</a>)<br />
    <?= $c->getComment(); ?>
    </p>
    <?php else :
        ?>
    <p>
        <h4>Ce chapitre ne comporte aucun commentaire</h4>
        soyez le premier à laisser le votre
    </p>
        <?php
    endif;endforeach; ?>
</section>
<?php if(isset($_GET['comment']) && $_GET['comment'] === 'success'){echo '<h3>Le commentaire à bien été ajouté.</h3>';} ?>
<section class="comments">
    <header class="entry-header">
        <h1 class="entry-title">Laisser un commentaire</h1>
    </header>
    <form action="" method="POST">
        Pseudonyme :<br />
        <input type="text" name="author" /><br /> 
        Votre commentaire :<br />
        <textarea name="comment"></textarea><br />
        <input type="hidden" name="postId" value="<?=  $chapter->getId(); ?>" />
        <input type="submit" value="Enregistrer" />
    </form>
</section>
<?php
$title = $chapter->getTitle();
$content = ob_get_clean();
require('src/View/full-width.php');
?>