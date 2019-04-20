<?php

namespace App\config;

class Config{
    private $dbHost         =   '';
    private $dbUser         =   '';
    private $dbPassword     =   '';
    private $dbName         =   '';

    private $smtpPassword   =   '';
    private $smtpUser       =   '';
    private $smtpHost       =   'smtp.gmail.com';
    private $smtpAuth       =   true;
    private $smtpSecure     =   'tls';
    private $smtpPort       =   '587';

    private $captchaSecret  =   '';
    private $captchaPublic  =   '';

    /**
     * Get database Host parameter
     *
     * @return string Host of database
     */
    public function getDBHost(){
        return $this->dbHost;
    }
  
    /**
     * Get database User parameter
     *
     * @return string User of database
     */
    public function getDBUser(){
        return $this->dbUser;
    }
  
    /**
     * Get database Password parameter
     *
     * @return string Password of database User
     */
    public function getDBPassword(){
        return $this->dbPassword;
    }
  
    /**
     * Get database name parameter
     *
     * @return string Name of database
     */
    public function getDBName(){
        return $this->dbName;
    }


    /**
     * Get external smtp user  parameter
     *
     * @return string User
     */
    public function getMailUser(){
        return $this->smtpUser;
    }

    /**
     * Get external smtp password parameter
     *
     * @return string Password
     */
    public function getMailPassword(){
        return $this->smtpPassword;
    }

    /**
     * Get external smtp host parameter
     *
     * @return string Host
     */
    public function getMailHost(){
        return $this->smtpHost;
    }

    /**
     * Get external smtp auth parameter
     *
     * @return string Auth method
     */
    public function getMailAuth(){
        return $this->smtpAuth;
    }

    /**
     * Get external smtp secure parameter
     *
     * @return string Secure method
     */
    public function getMailSecure(){
        return $this->smtpSecure;
    }

    /**
     * Get external smtp port parameter
     *
     * @return string Port
     */
    public function getMailPort(){
        return $this->smtpPort;
    }


    /**
     * Get secret google captcha key
     *
     * @return string Key
     */
    public function getCaptchaSecret(){
        return $this->captchaSecret;
    }

    /**
     * Get publi google captcha key
     *
     * @return string Key
     */
    public function getCaptchaPublic(){
        return $this->captchaPublic;
    }
}