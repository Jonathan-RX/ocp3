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

$router->get('/:unknow', "Error#pageUnknow");

$router->run();