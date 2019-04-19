<?php

namespace App\Model;

use App\Services\PHPSession;
use \PDO;
use \DateTime;

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
    public function checkUser($login, $password){
        $request = $this->db->prepare('SELECT * FROM users WHERE login=?');
        $request->execute([$login]);
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
        }
    }

    /**
     * Check if user exist, create a token if true
     *
     * @param  string User email
     *
     * @return string Token for success, false for fail
     */
    public function resetPassword($email){
        $request = $this->db->prepare('SELECT * FROM users WHERE email=?');
        $request->execute([$email]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if($result){
            $token = uniqid('', true);
            $request = $this->db->prepare('UPDATE users set token = ?, token_date=NOW() WHERE email=?');
            $results = $request->execute([$token, $email]);
        }else{
            $token = false;
        }
        return $token;
    }

    /**
     * Check if the token exists and is no more than half an hour
     *
     * @param  string Token to check
     *
     * @return bool True on success, false on fail
     */
    public function checkToken($token){
        $request = $this->db->prepare('SELECT * FROM users WHERE token=?');
        $request->execute([$token]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $now = time();
        $tokenDate = strtotime($result['token_date']);
        $diff = ($now - $tokenDate)/60;
        if($result AND $result['token'] === $token AND $diff < 30){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Update a user password by token
     *
     * @param  string New password
     * @param  string Token of user to update
     *
     * @return bool True on success, false on fail
     */
    public function changePassword($newPassword, $token){
        $pass = password_hash($newPassword, PASSWORD_BCRYPT);
        $request = $this->db->prepare('UPDATE users SET password = ?, token = null, token_date = null WHERE token=?');
        $results = $request->execute([$pass, $token]);
        return $results;
    }
}