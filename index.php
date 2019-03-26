<?php
// Routeur
require('vendor/autoload.php');

$url = '';
if(isset($_GET['url'])){
    $url = $_GET['url'];
}

$router = new App\Router\Router($url);

$router->get('/', "Home#home");

$router->get('/chapitre-:id', "Chapter#chapter");

$router->get('/chapitre/:slug', "Chapter#chapter");

$router->get('/chapitre-:postId/reportComment-:commentId', "Comment#reportComment");

$router->post('/chapitre-:id', "Comment#postComment");

$router->get('/:unknow', "Error#pageUnknow");

$router->run();


// $router->post('/posts/:id', function($id){echo 'Poster pour l\'article ' . $id . '<pre>' .  print_r($_POST, true) . '</pre>';});
// $router->get('/posts', function(){echo 'Tous les articles';});
// $router->get('/posts/:id-:slug', function($id, $slug) use ($router){echo $router->url('posts.show', ['id'=> 1, 'slug'=> 'salut-les-gens']);}, 'posts.show')->with('id', '[0-9]+')->with('slug', '([a-z\-0-9]+)');


/*

Routage de base + url = "chapitre-1"

$url = '';
if(isset($_GET['url'])){
    $url = $_GET['url'];
}
if($url === ''){
    $home = new App\Controller\Home\HomeController();
    $home->home();
}elseif($id = explode ("chapitre-", $url) AND is_numeric($id['1'])){
    $chapter = new App\Controller\Chapter\ChapterController();
    $chapter->chapter($id['1']);
}
*/

/* Code établit avec Thibaut pour un routeur très basique, url = chapitres?id=1
}elseif($url === 'chapitre'){
    $chapter = new App\Controller\Chapter\ChapterController();
    $chapter->chapter($_GET['id']);
}*/
