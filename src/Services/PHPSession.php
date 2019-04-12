<?php

namespace App\Services;

class PHPSession{

    /**
     * Ensures the Session is started
     */
    private static function ensureStarted(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
     /**
     * Retrieves information in session and erases it
     * 
     * @param string Name of the information
     * 
     * @return mixed Content of information, null if empty
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
     * Retrieves information in session without erases it
     * 
     * @param string Name of the information
     * 
     * @return mixed Content of information, null if empty
     */
    public static function check(string $key){
        self::ensureStarted();
        if(array_key_exists($key, $_SESSION)){
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Adds information in Session
     * 
     * @param string Name of the information
     * @param mixed Content of information
     */
    public static function set(string $key, $value): void{
        self::ensureStarted();
        $_SESSION[$key] = $value;
    }

    /**
     * Deletes a information in Session
     * 
     * @param string Name of the information
     */
    public static function delete(string $key): void{
        self::ensureStarted();
        unset($_SESSION[$key]);
    }

}