<?php

namespace App\Model;

use App\Services\PHPSession;
use \PDO;

class UsersManager extends DbManager{
    private $db;

    /**
     * Builder, retrieves the connection to the database
     */
    public function __construct()
    {
        $this->db = self::dbConnect();
    }

    /**
     * Check if a user exists in the database and if the password is correct
     *
     * @param  string Email entered by the visitor
     * @param  string Password entered by the visitor
     *
     * @return bool True on success, false on fail
     */
    public function checkUser($email, $password){
        $request = $this->db->prepare('SELECT * FROM users WHERE login=?');
        $request->execute([$email]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $result['password']) ){
            return true;
        }
        return false;
    }

    /**
     * Check if the session exists, otherwise redirect to the login page
     */
    public static function checkSession(){
        if(!PHPSession::check('login_token')){
            PHPSession::set('flash', '<div class="alert alert-danger" role="alert">Vous devez vous identifier pour accèder à l\'administration.</div>');
            header('Location: /login');
            exit;
        }
    }
}