<?php 
ob_start();
?>

<?php
foreach($chapters as $chapter) :?>
<p>
<h2><a href="chapitre-<?= $chapter->getId(); ?>"><?= $chapter->getTitle(); ?></a></h2>
</p>
<?php 
endforeach;
?>

<?php
$content = ob_get_clean();
require('src/View/layout.php');
?>