<?php 
ob_start();
?>
    <?= \App\Services\PHPSession::get('alert'); ?>
<form action="/admin/chapitre/<?= $chapter->getId(); ?>" id="<?= $chapter->getId(); ?>" method="POST">
    <div class="form-inline mb-3">
        <input type="text" name="title" id="title" value="<?= $chapter->getTitle(); ?>" class="form-control form-control-lg col-sm mr-2" placeholder="Titre" />
        <input type="submit" class="btn btn-primary btn-lg" value="Enregister" />
    </div>
    <div class="form-inline mb-3 meta">
       Publié le <div class="ml-2 mr-2"><?= $chapter->getDate(); ?></div>
       Adresse de la page : 
        <a href="http://ocp3.jr-dev.fr/chapitre/<?= $chapter->getSlug(); ?>" data-toggle="tooltip" title="S'ouvre dans une nouvelle fenetre." target="_blank">http://ocp3.jr-dev.fr/chapitre/<b class="slug"><?= $chapter->getSlug(); ?></b> </a> 
        <a href="#" class="btn btn-primary btn-sm ml-2 change-slug"> Modifier</a>
    </div>
    <input type="hidden" name="id" value="<?= $chapter->getId(); ?>" />
    <input type="hidden" name="slug" value="<?= $chapter->getSlug(); ?>" />
    <textarea class="form-control chapter-content" placeholder="Contenu du chapitre" name="content" rows="20"><?= nl2br($chapter->getContent()); ?></textarea>


</form>
    <?php
        if($chapter->getId() != 'new' AND $chapter->getComments()){
    ?>
    <br />
    <h4 class="mb-4">Commentaires</h4>
    <div class="card mb-4">
        <div class="card-body">
        <?php 
        if(!empty($chapter->getComments())) : 
            foreach($chapter->getComments() as $c) : 
                if($c->getreport() === '1'){$report = 'report';}else{$report = '';}    
        ?>
        <div class="bg-light p-3 mb-3 <?= $report; ?>">
                <blockquote class="blockquote mb-0">
                    <p class="mb-0"><?= $c->getComment(); ?></p>
                    <footer class="blockquote-footer">
                            Le <?= $c->getDateAdd(); ?> 
                            par <cite title="Source Title"><?= $c->getAuthor(); ?></cite>
                        <?php
                        if($c->getreport() === '1'){
                            ?>
                        <a href="/admin/commentaire/rehabiliter/<?= $c->getId(); ?>/chapitre/<?= $chapter->getId(); ?>" class="btn btn-info btn-sm float-right ml-2" onclick="return confirm('Attention, toutes les modifications non sauvegardées sur le chapitre seront perdues. Voulez-vous continuer?');" data-toggle="tooltip" title="Retirer le signalement">Réhabiliter</a>
                            <?php
                        }
                        if($c->getModerate() === '1') : 
                        ?>
                        <a href="/admin/commentaire/autoriser/<?= $c->getId(); ?>/chapitre/<?= $chapter->getId(); ?>" class="btn btn-success btn-sm float-right" onclick="return confirm('Attention, toutes les modifications non sauvegardées sur le chapitre seront perdues. Voulez-vous continuer?');" data-toggle="tooltip" title="Retirer la modération">Restaurer</a>
                        <?php
                        else :
                        ?>
                        <a href="/admin/commentaire/moderer/<?= $c->getId(); ?>/chapitre/<?= $chapter->getId(); ?>" class="btn btn-warning btn-sm float-right" onclick="return confirm('Attention, toutes les modifications non sauvegardées sur le chapitre seront perdues. Voulez-vous continuer?');" data-toggle="tooltip" title="Cacher le contenu du commentaire">Modérer</a>
                        <?php
                        endif;
                        ?>
                     </footer>
                </blockquote>
            </div>
        <?php 
            endforeach;
        endif;
        ?>
        </div>
    </div>
    <?php
    }
    ?>
<?php
if($chapter->getId() === 'new'){
    $title = 'Nouveau chapitre';
}else{
    $title = 'Edition d\'un chapitre';
}
$content = ob_get_clean();
require('src/View/admin.php');
?>