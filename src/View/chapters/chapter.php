<?php 
ob_start();
?>

<section>
    <a href="/">Retour à l'accueil</a>
    <h2><?= $chapter->getTitle(); ?></h2>
    <p><?= $chapter->getContent(); ?></p>
</section>
<section>
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
<section>
    <h3>Laisser un commentaire</h3>
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
$content = ob_get_clean();
require('src/View/layout.php');
?>