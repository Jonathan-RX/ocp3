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
                    <th>Numéro</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Commentaires</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $nbr = 1;
                foreach($chapters as $chapter){
                    $comanager = new CommentManager();
                    $numberComment = $comanager->count($chapter->getId());
                    $date = new DateTime($chapter->getDate(),new DateTimeZone('Europe/Paris'));
                    ?>
                    <tr>
                        <td><?= $nbr; ?></td>
                        <td><?= $chapter->getTitle(); ?></td>
                        <td>le <time class="entry-date" datetime="<?= $chapter->getDate(); ?>"><?= $date->format('d/m/Y à H\hi') ?></time></td>
                        <td><?= $numberComment; ?></td>
                        <td>
                            <a href="/admin/chapitre/<?= $chapter->getId(); ?>" class="btn btn-icon btn-pill btn-primary" data-toggle="tooltip" title="Editer"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="/admin/supprimerchapitre/<?= $chapter->getId(); ?>" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Supprimer chapitre <?= $chapter->getTitle(); ?>" onclick="return confirm('Etes-vous sur de vouloir supprimer le chapitre <?= $chapter->getTitle(); ?> et les commentaires associés?')"><i class="fa fa-fw fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    $nbr++;
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