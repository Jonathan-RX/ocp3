<?php 
use App\Model\CommentManager;
ob_start();
?>
    <?= \App\Services\PHPSession::get('alert'); ?>
    <div class="card mb-4">
        <div class="card-body">
            <table id="chapters" class="table table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Commentaires</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach($chapters as $chapter){
                    $comanager = new CommentManager();
                    $numberComment = $comanager->count($chapter->getId());
                    ?>
                    <tr>
                        <td><?= $chapter->getTitle(); ?></td>
                        <td><?= $chapter->getDate(); ?></td>
                        <td><?= $numberComment; ?></td>
                        <td>
                            <a href="/admin/chapitre/<?= $chapter->getId(); ?>" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editer"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="/admin/supprimerchapitre/<?= $chapter->getId(); ?>" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Supprimer chapitre <?= $chapter->getTitle(); ?>" onclick="return confirm('Etes-vous sur de vouloir supprimer le chapitre <?= $chapter->getTitle(); ?> et les commentaires associés?')"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
$title = 'Chapitres';
$content = ob_get_clean();
require('src/View/admin.php');
?>