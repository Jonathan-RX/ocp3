<?php 
ob_start();
?>
                        <h1 class="page-title">Contact</h1>
						<article class="post">
							<div class="entry-content clearfix">
                            <?= \App\Services\PHPSession::get('alert'); ?>
								<form action="/contact" method="post" class="contact-form">
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<input type="text" name="name" placeholder="Nom" required>
											<input type="email" name="email" placeholder="Email" required>
											<input type="text" name="subject" placeholder="Sujet" required>
                                            <textarea name="message" rows="7" placeholder="Votre Message" required></textarea>
                                            <div class="form-inline">
												<input type="checkbox" name="data_privacy_consent" id="checkbox-privacy" required>
												<label for="checkbox-privacy">Je consens à ce que mes données soumises soient recueillies et stockées comme décrit par le site .</label>
                                            </div>
											<?= \App\Services\Captcha::getCaptchaInput(); ?><br />
											<button class="btn-send btn-5 btn-5b ion-ios-paperplane"><span>Envoyer</span></button>
										</div>
									</div>	<!-- row -->
                                </form>
							</div>
                        </article>
						<?= \App\Services\Captcha::getCaptchaScript(); ?>
<?php
$title = 'Contact';
$content = ob_get_clean();
require('src/View/layout.php');
?>