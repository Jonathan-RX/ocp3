<?php 
ob_start();
?>
<?= \App\Services\PHPSession::get('alert'); ?>
<div class="row mb-4">
        <div class="col-md">
            <a class="d-flex border" href="/admin/chapitres">
                <div class="bg-primary text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fas fa-3x fa-fw fa-file"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Chapitres</p>
                    <h3 class="font-weight-bold mb-0"><?= $numberChapter; ?></h3>
                </div>
            </a>
        </div>
        <div class="col-md">
            <a class="d-flex border" href="/admin/commentaires">
                <div class="bg-success text-light p-4">
                    <div class="d-flex align-items-center h-100">
                        <i class="fa fa-3x fa-fw fa-comments"></i>
                    </div>
                </div>
                <div class="flex-grow-1 bg-white p-4">
                    <p class="text-uppercase text-secondary mb-0">Commentaires</p>
                    <h3 class="font-weight-bold mb-0"><?= $numberComment; ?></h3>
                </div>
            </a>
        </div>
    </div>
    <div class="d-flex flex-row">
        <div class="mr-1 col">
        <h4>5 derniers commentaires</h4>
            <?php
            foreach($lastComs as $c) :    
            $date = new DateTime($c->getDateAdd(),new DateTimeZone('Europe/Paris'));
            ?>
            <div class="card mb-2 width-45%">
                <div class="card-body">
                    <h5 class="card-title">Par <?= $c->getAuthor(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><time class="entry-date" datetime="<?= $c->getDateAdd(); ?>">Le <?= $date->format('d/m/Y à H\hi') ?></time></h6>
                    <p class="card-text"><?= $c->getComment(); ?></p>
                    <a href="/admin/commentaire/moderer/<?= $c->getId(); ?>/dashboard/" class="card-link" data-toggle="tooltip" title="Cacher le contenu du commentaire"><i class="fas fa-minus-square"></i> Moderér</a>
                </div>
            </div>
            <?php
            endforeach;
            ?>
        </div>
        <div class="ml-1 col">
        <h4>5 derniers signalements</h4> 
            <?php
            foreach($lastReports as $c) :    
            $date = new DateTime($c->getDateAdd(),new DateTimeZone('Europe/Paris'));
            ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Par <?= $c->getAuthor(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><time class="entry-date" datetime="<?= $c->getDateAdd(); ?>">Le <?= $date->format('d/m/Y à H\hi') ?></time></h6>
                    <p class="card-text"><?= $c->getComment(); ?></p>
        
                  <a href="/admin/commentaire/rehabiliter/<?= $c->getId(); ?>/dashboard/" class="card-link" data-toggle="tooltip" title="Retirer le signalement"><i class="fas fa-check-square"></i> Réhabiliter</a>
                  <a href="/admin/commentaire/moderer/<?= $c->getId(); ?>/dashboard/" class="card-link" data-toggle="tooltip" title="Cacher le contenu du commentaire"><i class="fas fa-minus-square"></i> Modérer</a>
                </div>
            </div>
            <?php 
            endforeach;
            ?>
        </div>
    </div>
<?php
$title = 'Tableau de bord';
$content = ob_get_clean();
require('src/View/admin.php');
?>