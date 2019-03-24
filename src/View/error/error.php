<?php 
ob_start();
?>

<section>
<a href="/">Retour à l'accueil</a>
<h2>Erreur</h2>
<p>Vous nous en voyez désolé, <?= $error; ?></p>

</section>
<?php
$content = ob_get_clean();
require('src/View/layout.php');
?>