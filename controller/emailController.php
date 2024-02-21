<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once 'model/penduduk.php';

class EmailController{
    protected $db;

    public function __construct(){
        $this->db = new MySQLDB();
    }

    public function view_email(){
        $result = $this->getAllEmail();
        return View::createView('email.php',
            [
                "result"=> $result
            ]);
    }

    public function getAllEmail(){
        $query = "SELECT * FROM daftarpenduduk INNER JOIN penduduk ON daftarpenduduk.idPenduduk = penduduk.idPenduduk WHERE awalVaksinasi is not null";

        $query_result = $this->db->executeSelectQuery($query);
        $result = [];
        foreach($query_result as $key => $value){
            setlocale(LC_ALL, 'IND');
            $awalVaksinasi = new DateTime($value['awalVaksinasi']);
            $akhirVaksinasi = new DateTime($value['akhirVaksinasi']);

            $awalVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $awalVaksinasi->getTimestamp());
            $akhirVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $akhirVaksinasi->getTimestamp());
            $result[] = new Penduduk($value['idDaftar'], $value['idPenduduk'], $value['tanggalPendaftaran'], $value['nama'], $value['NIK'], $value['KTP'], $value['pekerjaan'], $value['noHP'], $value['email'], $awalVaksinasi, $akhirVaksinasi);
        }
        return $result;
    }
}
?>