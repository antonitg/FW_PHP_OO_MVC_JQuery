<?php
class logreg_bll
{
    private $dao;
    static $_instance;

    function __construct()
    {
        $this->dao = logreg_dao::getInstance();
    }
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function login($args)
    {
        $user = $this->dao->selectUserData($args[2]);
        $pwd_peppered = hash_hmac("sha256", $args[0], $args[1]);
        try {
            if (password_verify($pwd_peppered, $user['passwd'])) {
                $token = jwt_process::encode($args[1], $user["username"]);
                $total = array("message" => 'Succefully loged in!', "token" => $token, "page" => 'home/list');
                $out = array_values($total);
                return json_encode($out);
                //  $total;
            } else {
                $total = array("message" => 'Your password and username dont match try again!', "alertify" => "warning");
                $out = array_values($total);
                return json_encode($out);
            }
        } catch (Exception $e) {
            $total = array("message" => 'We have not found the user try again!', "alertify" => "error");
            $out = array_values($total);
            return json_encode($out);
        }
    }
    public function register($args)
    {
        $pwd_peppered = hash_hmac("sha256", $args[0], $args[1]);
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_DEFAULT);
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($args[4])));
        return $this->dao->register($pwd_hashed, $args[2], $args[3], $args[4], $grav_url);
    }
    // $pass,$fullname,$username,$email,$grav_url
}
// [$_POST['passwd'],$ini_file["secret"],$_POST['fullname'], $_POST['username'], $_POST['email']
