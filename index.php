<?php
// Routeur
require('vendor/autoload.php');

$url = '';
if(isset($_GET['url'])){
    $url = $_GET['url'];
}

$router = new App\Router\Router($url);

$router->get('/', "Home#home");

$router->get('/about', "About#about");

$router->get('/legals', "Legals#legals");

$router->get('/contact', "Contact#contact");
$router->post('/contact', "Contact#postContact");

$router->get('/chapitres', "Chapters#chapters");
$router->get('/chapitres/:page', "Chapters#chapters");

$router->get('/chapitre/:slug', "Chapter#chapterBySlug");
$router->get('/chapitre/:slug/reportComment=:commentId', "Comment#reportComment")->with('commentId', '[0-9]+')->with('slug', '([a-z\-0-9]+)');
$router->post('/chapitre/:slug', "Comment#postComment");

$router->get('/login', "AdminLogin#adminLogin");
$router->post('/login', "AdminLogin#adminLoginOn");
$router->get('/logout', "AdminLogin#adminLogout");
$router->get('/admin/dashboard', "AdminDashboard#adminDashboard");
$router->get('/admin/chapitres', "AdminChapters#adminChaptersController");
$router->get('/admin/nouveau-chapitre', "AdminNewChapter#newChapter");
$router->post('/admin/nouveau-chapitre', "AdminChapterSubmit#newChapter");
$router->get('/admin/chapitre/:id', "AdminChapters#editChapter");
$router->post('/admin/chapitre/:id', "AdminChapterSubmit#updateChapter");
$router->get('/admin/supprimerchapitre/:id', "AdminChapterSubmit#deleteChapter");
$router->get('/admin/commentaire/moderer/:idComment/:url', "AdminCommentModerate#moderateComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaire/autoriser/:idComment/:url', "AdminCommentUnmoderate#unmoderateComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaire/rehabiliter/:idComment/:url', "AdminCommentUnreport#unreportComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaires', "AdminComments#adminCommentsController");
$router->get('/admin/commentaires-moderes', "AdminCommentsModerates#adminCommentsModeratesController");


$router->get('/:unknow', "Error#pageUnknow")->with('unknow', '([a-z\-0-9\-/]+)');

$router->run();