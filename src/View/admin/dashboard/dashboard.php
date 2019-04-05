<?php 
ob_start();
?>
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

    <div class="card mb-4">
            <div class="card-body">
                        Vous êtes dans l'administration 
                    </div>
    </div>
<?php
$title = 'Dashboard';
$content = ob_get_clean();
require('src/View/admin.php');
?>