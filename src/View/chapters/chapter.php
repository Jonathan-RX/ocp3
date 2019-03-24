<?php 
ob_start();
?>

<section>
    <a href="/">Retour à l'accueil</a>
    <h2><?= $chapter['0']['title']; ?></h2>
    <p><?= $chapter['0']['content']; ?></p>
</section>
<section>
<?php if(isset($_GET['reportComment']) && $_GET['reportComment'] === 'success'){echo '<h3>Le commentaire à bien été signalé.</h3>';} ?>
    <?php foreach($chapter as $c) :
        if(!empty($c['com_id'])) : ?>
    <p>
        <b>Le <?= $c['com_date']; ?> par <?= $c['com_author']; ?></b> (<a href="chapitre-<?=  $chapter['0']['id']; ?>/reportComment-<?= $c['com_id']; ?>" onclick="return confirm('Etes-vous sur de vouloir signaler ce commentaire?')">Signaler ce commentaire</a>)<br />
    <?= $c['com_content']; ?>
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
        <input type="hidden" name="postId" value="<?=  $chapter['0']['id']; ?>" />
        <input type="submit" value="Enregistrer" />
    </form>
</section>
<?php
$content = ob_get_clean();
require('src/View/layout.php');
?>