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
$router->post('/contact', "PostContact#postContact");

$router->get('/chapitres', "Chapters#chapters");
$router->get('/chapitres/:page', "Chapters#chapters");

$router->get('/chapitre/:slug', "Chapter#chapterBySlug");
$router->get('/chapitre/:slug/reportComment=:commentId', "ReportComment#reportComment")->with('commentId', '[0-9]+')->with('slug', '([a-z\-0-9]+)');
$router->post('/chapitre/:slug', "PostComment#postComment");

$router->get('/login', "AdminLogin#adminLogin");
$router->post('/login', "AdminLoginOn#adminLoginOn");
$router->get('/logout', "AdminLogout#adminLogout");
$router->get('/reinitialisation-mot-de-passe', "AdminResetPassword#adminResetPassword");
$router->post('/reinitialisation-mot-de-passe', "AdminResetPasswordSubmit#adminResetPasswordSubmit");
$router->get('/admin/dashboard', "AdminDashboard#adminDashboard");
$router->get('/admin/chapitres', "AdminChapters#adminChaptersController");
$router->get('/admin/nouveau-chapitre', "AdminNewChapter#newChapter");
$router->post('/admin/nouveau-chapitre', "AdminChapterSubmit#newChapter");
$router->get('/admin/chapitre/:id', "AdminEditChapter#editChapter");
$router->post('/admin/chapitre/:id', "AdminUpdateChapter#updateChapter");
$router->get('/admin/supprimerchapitre/:id', "AdminDeleteChapter#deleteChapter");
$router->get('/admin/commentaire/moderer/:idComment/:url', "AdminCommentModerate#moderateComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaire/autoriser/:idComment/:url', "AdminCommentUnmoderate#unmoderateComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaire/rehabiliter/:idComment/:url', "AdminCommentUnreport#unreportComment")->with('url', '([a-z\-0-9\-/]+)');
$router->get('/admin/commentaires', "AdminComments#adminCommentsController");
$router->get('/admin/commentaires-moderes', "AdminCommentsModerates#adminCommentsModeratesController");


$router->get('/:unknow', "Error#pageUnknow")->with('unknow', '([a-z\-0-9\-/]+)');

$router->run();