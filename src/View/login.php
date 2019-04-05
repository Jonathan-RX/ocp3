
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/public/css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="/public/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/public/css/bootadmin.min.css">

    <title>Login | Administration</title>
</head>
<body class="bg-light">

        <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-4">
                <h1 class="text-center mb-4">Accès administrateur</h1>
                <?= \App\Services\PHPSession::get('flash'); ?>
                <div class="card">
                    <div class="card-body">
                        <form action="/login" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Adresse mail" name="email">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                            </div>

                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Envoyer</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col pr-2">
                                    <a href="/"><span class="meta-nav">←</span> Retour au site</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/bootstrap.bundle.min.js"></script>
<script src="/public/js/bootadmin.min.js"></script>


</body>
</html>