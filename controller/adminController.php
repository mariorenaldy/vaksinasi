<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "controller/services/auth.php";
require_once "model/pendaftaran.php";

class AdminController{
    protected $db;
    protected $auth;

    public function __construct(){
        $this->db = new MySQLDB();
        $this->auth = new Auth($this->db);
        if( !$this->auth->checkRole(["admin"]) ){
          redirect(route('/'));
        }
    }

    public function view_admin(){
        $result = $this->getAllPendaftaran();
        return View::createView('admin/admin.php',
            [
                "result"=> $result
            ]);
    }

    public function getAllPendaftaran(){
        if( Auth::getAuthenticatedUser() == null ){
            redirect(route("/login"));
            return;
        }

        $query = "SELECT * FROM pendaftaran";

        $query_result = $this->db->executeSelectQuery($query);
        $result = [];
        foreach($query_result as $key => $value){
            setlocale(LC_ALL, 'IND');
            $awalDaftar = new DateTime($value['awalDaftar']);
            $akhirDaftar = new DateTime($value['akhirDaftar']);
            $awalVaksinasi = new DateTime($value['awalVaksinasi']);
            $akhirVaksinasi = new DateTime($value['akhirVaksinasi']);

            $awalDaftar = strftime('%A, %d %B %Y pukul %H:%M', $awalDaftar->getTimestamp());
            $akhirDaftar = strftime('%A, %d %B %Y pukul %H:%M', $akhirDaftar->getTimestamp());
            $awalVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $awalVaksinasi->getTimestamp());
            $akhirVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $akhirVaksinasi->getTimestamp());

            $result[] = new Pendaftaran($value['idDaftar'], $value['tahap'], $awalDaftar, $akhirDaftar, $awalVaksinasi, $akhirVaksinasi);
        }
        return $result;
    }
}
?>