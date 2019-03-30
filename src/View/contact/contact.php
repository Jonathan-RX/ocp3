<?php 
ob_start();
?>

                        <h1 class="page-title">Contact</h1>
						<article class="post">
							<div class="entry-content clearfix">
                            <?php
                                if (isset($decode['success']) AND $decode['success'] == true) {
                                    echo '<header class="entry-header"><h4 class="entry-title">Merci ' . $_POST["name"] . ', le message a bien été envoyé.</h4></header>';
                                }elseif(isset($decode['success'])){
                                    echo '<header class="entry-header"><h4 class="entry-title"> Echec de l\'envoi du message, veuillez réessayer</h4></header>';
                                }
                            ?>
								<form action="/contact" method="post" class="contact-form">
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<input type="text" name="name" placeholder="Nom" required>
											<input type="email" name="email" placeholder="Email" required>
											<input type="text" name="subject" placeholder="Sujet" required>
                                            <textarea name="message" rows="7" placeholder="Votre Message" required></textarea>
                                            <div class="g-recaptcha" data-sitekey="6Lc135oUAAAAAOeE3SHlgPI3BfWP6ysBtz7CsXFB"></div><br />
											<button class="btn-send btn-5 btn-5b ion-ios-paperplane"><span>Envoyer</span></button>
										</div>
									</div>	<!-- row -->
                                </form>
							</div>
                        </article>
                        <script src='https://www.google.com/recaptcha/api.js?hl=fr'></script>  
<?php
$title = 'Contact';
$content = ob_get_clean();
require('src/View/full-width.php');
?>