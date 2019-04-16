<?php 
ob_start();
?>
                        <form action="/reinitialisation-mot-de-passe" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Adresse mail" name="email">
                            </div>


                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Envoyer</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col pr-2">
                                    <a href="/login"><span class="meta-nav">←</span> Retour à l'identification</a>
                                </div>
                            </div>
                        </form>
<?php
$content = ob_get_clean();
$title = 'Réinitilisation mot de passe';
require('src/View/login.php');
?>