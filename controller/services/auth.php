<?php

require_once 'mysqlDB.php';

class Auth{
    protected $db;
    protected static $sessionIndex = "akun_id";

    public function __construct(MySQLDB $db = null){
        $this->db = $db == null ? new MySQLDB() : $db;
    }

    public static function authUser($id){
        $_SESSION[self::$sessionIndex] = $id;
    }

    public static function getAuthenticatedUser(){
      if( isset($_SESSION[self::$sessionIndex]) )
        return $_SESSION[self::$sessionIndex];
      else
        return null;
    }

    public static function logout(){
        unset($_SESSION[self::$sessionIndex]);

        header("Location: ".route('/'));
    }

    public static function implodeSql(array $pairs, string $operator, string $column, string $glue){
      $out = [];
      foreach($pairs as $key => $value){
        $out[] = "$column $operator '$value'";
      }
      return implode(" $glue ",$out);
    }

    public function checkRole(array $required_roles = []){
        if( !isset($_SESSION[self::$sessionIndex]) ) return false;

        $query = "SELECT * FROM akun WHERE `idA` = '".$_SESSION[self::$sessionIndex]."' AND ".$this->implodeSql($required_roles, "=", "role","OR");
        // die(var_dump($query));

        $query_result = $this->db->executeSelectQuery($query);
        if( count($query_result) > 0 ) return true;
        return false;
    }

    public function submitLogin(){
        if( 
            !isset($_POST['username']) ||
            !isset($_POST['password'])
        ) return header('Location: ' . $_SERVER['HTTP_REFERER']);

        $username = $_POST['username'];
        $plaintext_password = $_POST['password'];

        $query = "SELECT * FROM akun WHERE `username` = '$username'";

        $query_result = $this->db->executeSelectQuery($query);
        if( count($query_result) > 0 ){
            $user = $query_result[0];
            $hash = $user["password"];

            if(password_verify($plaintext_password, $hash) && $user["role"]=="admin"){
                $this->authUser($user["idA"]);
                header("Location: ".route('/admin'));
            }
            else if(password_verify($plaintext_password, $hash) && $user["role"]=="petugas"){
                $this->authUser($user["idA"]);
                header("Location: ".route('/petugas'));
            }
            else if(password_verify($plaintext_password, $hash) && $user["role"]=="pimpinan"){
                $this->authUser($user["idA"]);
                header("Location: ".route('/pimpinan'));
            }
            else{
                header("Location: ".route('/'));
            }
            return;
        }

        http_response_code(404);
        return;

    }

    public function submitRegister(){
        if( 
            !isset($_POST['username']) ||
            !isset($_POST['role']) ||
            !isset($_POST['password'])
        ) return header('Location: ' . $_SERVER['HTTP_REFERER']);

        $username = $_POST['username'];
        $role = $_POST['role'];
        $plaintext_password = $_POST['password'];
        $hash = password_hash($plaintext_password, 
          PASSWORD_DEFAULT);

        $query = "INSERT INTO akun(`username`, `role`, `password`) VALUES(
            '$username','$role','$hash'
        )";
        // die($query);
        if($this->db->executeNonSelectQuery($query)){
            // Authenticate
            $this->authUser($this->db->lastID());

            // Redirect
            if($role=='admin')
                header("Location: ".route('/admin'));
            else if($role=='pimpinan')
                header("Location: ".route('/pimpinan'));
            else if($role=='petugas')
                header("Location: ".route('/petugas'));
        }else{
            http_response_code(500);
            return;
        }
    }
}