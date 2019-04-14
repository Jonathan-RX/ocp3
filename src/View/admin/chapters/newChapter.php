<?php 
ob_start();
?>
    <?= \App\Services\PHPSession::get('alert'); ?>
<form action="/admin/nouveau-chapitre" method="POST">
    <div class="form-inline mb-3">
        <input type="text" name="title" id="title" value="" class="form-control form-control-lg col-sm mr-2" placeholder="Titre" />
        <input type="submit" class="btn btn-primary btn-lg" value="Enregister" />
    </div>
    <textarea class="form-control chapter-content" placeholder="Contenu du chapitre" name="content" rows="20"></textarea>


</form>
   
<?php
$title = 'Nouveau chapitre';
$content = ob_get_clean();
require('src/View/admin.php');
?>