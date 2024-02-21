<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "controller/services/auth.php";

class HomeController{
    protected $db;
    protected $auth;

    public function __construct(){
        $this->db = new MySQLDB();
        $this->auth = new Auth($this->db);
    }

    public function index(){
        return View::createView('landing.php',["title"=>"Web Vaksinasi Covid-19 Indonesia", "isAuth"=>Auth::getAuthenticatedUser()]);
    }

    public function login(){
        if( Auth::getAuthenticatedUser() != null ){
            redirect(route("/"));
        }
        return View::createView('login.php',
            [
                "title"=> "Login ke Admin"
            ]);
    }

    public function register(){
        return View::createView('register.php',
            [
                "title"=> "Register Admin"
            ]);
    }

    public function submitLogin(){
        $this->auth->submitLogin();
    }

    public function submitRegister(){
        $this->auth->submitRegister();
    }

    public function logout(){
        Auth::logout();
    }
}
?>