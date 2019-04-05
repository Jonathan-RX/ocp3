<!DOCTYPE html>
<html>
	<head>
		<title><?= $title; ?></title>

		<!-- meta -->
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- css -->
		<link rel="stylesheet" href="/public/css/bootstrap.min.css">
		<link rel="stylesheet" href="/public/css/ionicons.min.css">
		<link rel="stylesheet" href="/public/css/pace.css">
	    <link rel="stylesheet" href="/public/css/custom.css">
	</head>

	<body>
		<div class="container">	
			<header id="site-header">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-8">
						<div class="logo">
							<h1><a href="/"><b>Jean</b> Forteroche</a></h1>
						</div>
					</div><!-- col-md-4 -->
					<div class="col-md-8 col-sm-7 col-xs-4">
						<nav class="main-nav" role="navigation">
							<div class="navbar-header">
  								<button type="button" id="trigger-overlay" class="navbar-toggle">
    								<span class="ion-navicon"></span>
  								</button>
							</div>

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  								<ul class="nav navbar-nav navbar-right">
    								<li class="cl-effect-11"><a href="/" data-hover="Accueil">Accueil</a></li>
    								<li class="cl-effect-11"><a href="/about" data-hover="Auteur">Auteur</a></li>
    								<li class="cl-effect-11"><a href="/chapitres" data-hover="Chapitres">Chapitres</a></li>
    								<li class="cl-effect-11"><a href="/contact" data-hover="Contact">Contact</a></li>
  								</ul>
							</div><!-- /.navbar-collapse -->
						</nav>
					</div><!-- col-md-8 -->
				</div>
			</header>
		</div>

		<div class="content-body">
			<div class="container">
				<div class="row">
					<main class="col-md-12">
						<?= $content; ?>
					</main>
				</div>
			</div>
		</div>
		<footer id="site-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="copyright">&copy; 2014 ThemeWagon.com - <a href="/legals">Mentions légales</a> - <a href="/login">Administration</a></p>
					</div>
				</div>
			</div>
		</footer>

		<!-- Mobile Menu -->
		<div class="overlay overlay-hugeinc">
			<button type="button" class="overlay-close"><span class="ion-ios-close-empty"></span></button>
			<nav>
				<ul>
					<li><a href="/">Accueil</a></li>
					<li><a href="/about">Auteur</a></li>
					<li><a href="/chapitres">Chapitres</a></li>
					<li><a href="/contact">Contact</a></li>
				</ul>
			</nav>
		</div>

	    <script src="/public/js/jquery-2.1.3.min.js"></script>
	    <script src="/public/js/bootstrap.min.js"></script>
	    <script src="/public/js/pace.min.js"></script>
	    <script src="/public/js/modernizr.custom.js"></script>
		<script src="/public/js/script.js"></script>

	</body>
</html>
