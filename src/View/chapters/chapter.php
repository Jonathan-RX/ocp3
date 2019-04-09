<?php 
ob_start();
$date = new DateTime($chapter->getDate(),new DateTimeZone('Europe/Paris'));
$comanager = new App\Model\CommentManager();
$countComs = $comanager->count($chapter->getId());
if($countComs > 1){$count = $countComs . ' Commentaires';}else{$count = $countComs . ' Commentaire';}
?>
                        <article class="post post-1">
							<header class="entry-header">
								<h1 class="entry-title"><?= $chapter->getTitle(); ?></h1>
								<div class="entry-meta">
			
									<span class="post-date"><a href="#"><time class="entry-date" datetime="<?= $chapter->getDate(); ?>"><?= $date->format('d/m/Y à H\hi') ?></time></a></span>
			
									<span class="comments-link"><a href="#comments"><?= $count; ?></a></span>
                                    <?php
                                        if($countComs > 9){
                                            echo '<br /><span class="comments-link"><a href="#new-comment">Ajouter un commentaire</a></span>';
                                        }
                                    ?>
								</div>
							</header>
							<div class="entry-content clearfix">
                            <?= nl2br($chapter->getContent()); ?>
							</div>
						</article>

<section id="comments" class="comments">
    <header class="entry-header">
        <h1 class="entry-title">Commentaires</h1>
    </header>
    <?= \App\Services\PHPSession::get('reportComment'); ?>
    <?php 
        if(!empty($chapter->getComments())) : 
            foreach($chapter->getComments() as $c) :       
    ?>
    <div class="panel panel-default">
            <div class="panel-heading"><b>Le <?= $c->getDateAdd(); ?> par <?= $c->getAuthor(); ?></b> <a href="/chapitre/<?=  $chapter->getSlug(); ?>/reportComment=<?= $c->getId(); ?>" onclick="return confirm('Etes-vous sur de vouloir signaler ce commentaire?')" title="Signaler ce commentaire"><i class="ion-alert-circled pull-right"></i></a></div>
        <div class="panel-body">
            <?php
                if($c->getModerate() === '1'){
                    echo '<i class="text-danger">Le contenu de ce commentaire à été modéré.</i>';
                }else{
                    echo $c->getComment(); 
                }
            ?>
        </div>
    </div>
    <?php 
            endforeach;
        else :
        ?>
    <div class="panel panel-default">
    <div class="panel-body">Ce chapitre ne comporte aucun commentaire, soyez le premier à laisser le votre !</div>
    </div>
    <?php
            
        endif;
     ?>
</section>
<?= \App\Services\PHPSession::get('addComment'); ?>
<section class="comments"  id="new-comment">
    <header class="entry-header">
        <h1 class="entry-title">Laisser un commentaire</h1>
    </header>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="" method="POST" class="form-group">
                <label for="author">Pseudonyme :</label>
                <input type="text" name="author" id="author" class="form-control" /><br /> 
                <label for="comment">Votre commentaire :</label>
                <textarea name="comment" class="form-control" id="comment" rows="5"></textarea><br />
                <input type="hidden" name="postId" value="<?=  $chapter->getId(); ?>" />
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
</section>
<ul class="pages">
        <li></li>
</ul>
<?php
$title = $chapter->getTitle();
$content = ob_get_clean();
require('src/View/layout.php');
?>