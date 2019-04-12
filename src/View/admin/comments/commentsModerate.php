<?php 
ob_start();
?>
    <?= \App\Services\PHPSession::get('alert'); ?>
    
            <?php
            foreach($comments as $c) :
            ?>
            <div class="card mb-4">
                <div class="card-header bg-white font-weight-bold">
                        Le <?= $c->getDateAdd(); ?> 
                        par <cite title="Source Title"><?= $c->getAuthor(); ?></cite>
                </div>
                <div class="card-body">
                  <p><?= $c->getComment(); ?></p>
                  <a href="/admin/commentaire/autoriser/<?= $c->getId(); ?>/commentaires-moderes" class="card-link" data-toggle="tooltip" title="Cacher le contenu du commentaire"><i class="fas fa-check-square"></i> Restaurer</a>
                  <a href="/admin/chapitre/<?= $c->getPostId(); ?>" class="card-link" data-toggle="tooltip" title="Voir le chapitre"><i class="fas fa-search"></i></i> Voir le chapitre</a>
                </div>
            </div>
            <?php
            endforeach;
            ?>
       
<?php
$title = 'Commentaires modérés';
$content = ob_get_clean();
require('src/View/admin.php');
?>