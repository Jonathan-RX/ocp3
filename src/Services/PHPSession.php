<?php

namespace App\Services;

class PHPSession{

    /**
     * Assure que la Session est démarré
     */
    private static function ensureStarted(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
     /**
     * Récupère une information en Session puis l'efface
     * 
     * @param string $key
     * @return mixed
     */
    public static function get(string $key){
        self::ensureStarted();
        if(array_key_exists($key, $_SESSION)){
            $mess = $_SESSION[$key];
            self::delete($key);
            return $mess;
        }
        return null;
    }
    
     /**
     * Récupère une information en Session sans l'effacer
     * 
     * @param string $key
     * @return mixed
     */
    public static function check(string $key){
        self::ensureStarted();
        if(array_key_exists($key, $_SESSION)){
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Ajoute une information en Session
     * 
     * @param string $key
     * @param $value
     * @return
     */
    public static function set(string $key, $value): void{
        self::ensureStarted();
        $_SESSION[$key] = $value;
    }

    /**
     * Supprime une clef en Session
     * @param string $key
     */
    public static function delete(string $key): void{
        self::ensureStarted();
        unset($_SESSION[$key]);
    }

}