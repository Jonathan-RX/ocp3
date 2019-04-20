<?php

namespace App\Services;

use App\config\Config;

class Captcha{
    /**
     * Check if captcha is valide
     *
     * @param  string Secret google captcha key
     *
     * @return bool true on success, false on fail
     */
    public function checkCaptcha($response = ''){
        $config = new Config();
        $secret = $config->getCaptchaSecret();
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;
        
        $decode = json_decode(file_get_contents($api_url), true);
        if(isset($decode['success']) AND $decode['success'] == true){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Return Input for google captcha
     *
     * @return string Div for captcha box
     */
    public static function getCaptchaInput(){
        $config = new Config();
        $public = $config->getCaptchaPublic();
        return '<div class="g-recaptcha" data-sitekey="' . $public . '"></div>';
    }

    /**
     * Return Html for google captcha
     *
     * @return string Html script with google captcha api
     */
    public static function getCaptchaScript(){
        return '<script src=\'https://www.google.com/recaptcha/api.js?hl=fr\'></script>';
    }
}