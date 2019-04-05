<?php

namespace App\Model;

use App\Services\PHPSession;
use \PDO;

class UsersManager extends DbManager{
    private $db;

    public function __construct()
    {
        $this->db = self::dbConnect();
    }

    public function checkUser($email, $password){
        $request = $this->db->prepare('SELECT * FROM users WHERE login=?');
        $request->execute([$email]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $result['password']) ){
            return true;
        }
        return false;
    }

    public static function checkSession(){
        if(!PHPSession::check('login_token')){
            PHPSession::set('flash', '<div class="alert alert-danger" role="alert">Vous devez vous identifier pour accèder à l\'administration.</div>');
            header('Location: /login');
            exit;
        }
    }
}