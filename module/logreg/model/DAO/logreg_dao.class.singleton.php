<?php
class logreg_dao
{
    static $_instance;
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        } // end_if
        return self::$_instance;
    } // end_getInstance
    public function register($pass,$fullname,$username,$email,$grav_url)
    {
       $typedQuery = "INSERT INTO `users` (`fullname`, `username`, `email`, `passwd`, `avatar`) VALUES ('{$fullname}', '{$username}', '{$email}', '{$pass}', '{$grav_url}')";

       return db::query()->manual($typedQuery)
            ->execute()
            ->toJSON();
    }
    public function login($username)
    {
       $typedQuery = "SELECT passwd FROM users WHERE username = '{$username}'";
        return db::query()->manual($typedQuery)
            ->execute()
            ->queryToArray() -> getResolve();
    }
    public function setVerifyToken($token,$email)
    {
       $typedQuery = "UPDATE users SET tokenVerify = '{$token}' WHERE email = '{$email}'";
        return db::query()->manual($typedQuery)
            ->execute()
            ->toJSON();
    }
    public function verifyToken($token)
    {
       $typedQuery = "UPDATE users SET tokenVerify = NULL WHERE tokenVerify = '{$token}'";
        return db::query()->manual($typedQuery)
            ->execute()
            ->toJSON();
    }
    
    public function selectUserData($username) {
        return db::query() -> select(['*'], 'users') -> where(['username' => [$username]]) -> execute() -> queryToArray() -> getResolve();
    }// end_selectUserData
 
}
