<?php

namespace App\Services;

use App\Services\PHPSession;

class AdminNavBar{

    /**
     * Check if a session is registered and return admin nagivation barr if true
     *
     * @return string Html admin navigation barr
     */
    public static function getNavBar(){
        if(PHPSession::check('login_token')){
            ob_start();
            ?>
            <ul class="horizontal">
                <li><a class="active" href="/admin/dashboard"><i class="icon ion-android-settings"></i> Administration</a></li>
                <li><a class="active" href="/admin/chapitres"><i class="ion-ios-copy"></i> Chapitres</a></li>
                <li><a class="active" href="/admin/commentaires"><i class="ion-ios-chatbubble"></i> Commentaires</a></li>
                <li class="pull-right"><a href="/logout"><i class="icon ion-power"></i> Se déconnecter</a></li>
            </ul>
            <?php
            return  ob_get_clean();
        }
    }
}