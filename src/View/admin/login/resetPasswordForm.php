<?php 
ob_start();
?>
                        <?php
                        if(\App\Services\PHPSession::check('reset_token'))  :
                        ?>
                        <form action="/confirmation" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Entrez le nouveau mot de passe" name="password" pattern=".{8,}"   required title="8 caracteres minimum">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Confirmez le nouveau mot de passe" name="passwordconfirm" pattern=".{8,}"   required title="8 caracteres minimum">
                            </div>
                            <div class="input-group mb-3">
                            <em>Votre nouveau mot de passe doit contenir au moins 8 caractères, avec au minimum des lettres miniscules et majuscules et des chiffres.</em>
                            </div>

                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Envoyer</button>
                                </div>
                            </div>

                        </form>
                        <?php
                        endif;
                        ?>
                            <div class="row">
                                <div class="col pr-2">
                                    <a href="/login"><span class="meta-nav">←</span> Retour à l'identification</a>
                                </div>
                            </div>
<?php
$content = ob_get_clean();
$title = 'Modification du mot de passe';
require('src/View/login.php');
?>