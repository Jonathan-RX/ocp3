<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/public/css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="/public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/css/bootadmin.min.css">
    <link rel="stylesheet" href="/public/css/admin.css">
    <link rel="stylesheet" href="/public/css/datatables.min.css">


    <title><?= $title; ?></title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="/admin/dashboard">Jean Forteroche</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <?php
                $reported = \App\Model\CommentManager::countReportedComments();
                if($reported > 0){echo '<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> ' . $reported . '</a></li>';}
            ?>
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="/logout" class="dropdown-item">Se déconnecter</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li><a href="/"><i class="fas fa-fw fa-long-arrow-alt-left"></i> Retour au site</a></li>
            <li><a href="/admin/nouveau-chapitre"><i class="fas fa-fw fa-file-alt"></i> Nouveau Chapitre</a></li>
            <li><a href="/admin/chapitres"><i class="fas fa-fw fa-file"></i> Chapitres</a></li>
            <li><a href="/admin/commentaires"><i class="fas fa-comments"></i> Commentaires</a></li>
            <li><a href="/admin/commentaires-moderes"><i class="fas fa-comment-slash"></i></i> Commentaires modérés</a></li>
        </ul>
    </div>

    <div class="content p-4">
        <h2 class="mb-4"><?= $title; ?></h2>

        
                <?= $content; ?>
           
    </div>
</div>

<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/bootstrap.bundle.min.js"></script>
<script src="/public/js/datatables.min.js"></script>
<script src="/public/js/bootadmin.min.js"></script>
<script src="/public/js/admin.js"></script>
<script src="/public/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({
       selector:'.chapter-content',
       language: 'fr_FR',
       menubar: false,
  force_br_newlines : true,
  force_p_newlines : false });</script>


</body>
</html>