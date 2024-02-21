<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "controller/services/auth.php";
require_once "model/daftarOrangVaksin.php";
require_once "model/dataOrangVaksin.php";

class PetugasController{
    protected $db;
    protected $auth;

    public function __construct(){
        $this->db = new MySQLDB();
        $this->auth = new Auth($this->db);
        if( !$this->auth->checkRole(["petugas"]) ){
          redirect(route('/'));
        }
    }

    public function view_vaksin(){
        $result=$this->getAllDaftarOrang();
        return View::createView('petugas/PetugasCariData.php', ["result"=>$result]);
    }
    public function view_vaksinS($nama){
        $result=$this->getAllDaftarOrangS($nama);
		return View::createView('petugas/PetugasCariData.php',["result"=>$result]);		
	}
    
	public function view_dataKesehatan($id){
        $result=$this->getOrang($id);
		return View::createView('petugas/inputKesehatan.php',["result"=>$result]);		
	}

    public function getOrang($id){
        $query = "SELECT penduduk.idPenduduk,nama,jumlahVaksin 
                  FROM penduduk LEFT JOIN (SELECT idPenduduk, COUNT(id) as jumlahVaksin
                                           FROM dataKesehatan
                                           GROUP BY idPenduduk)as jmlVaksin ON penduduk.idPenduduk=jmlVaksin.idPenduduk
                  WHERE penduduk.idPenduduk=$id";
        $res= $this->db->executeSelectQuery($query);  
        $result=[];
        foreach ($res as $key => $value){  
            $result[] =new dataOrang ($value['idPenduduk'],$value['nama'],$value['jumlahVaksin']);
        }
        return $result;
    }

    public function input_dataKesehatan($idPenduduk,$suhu,$mm,$Hg,$vaksin){
        $tekananDarah=$mm."/".$Hg;
        $tanggal = date("Y-m-d");
        $query= " INSERT INTO dataKesehatan (id,idPenduduk,suhuTubuh, tekananDarah,status,tanggal) VALUES ('', '$idPenduduk ', ' $suhu', ' $tekananDarah', ' $vaksin', ' $tanggal')";
        $this->db->executeNonSelectQuery($query);
    }

    public function getAllDaftarOrang(){
        $today=date("Y-m-d");
        date_default_timezone_set("Asia/Jakarta");
        $time = date("Y-m-d H:i:s");
        $query = "SELECT penduduk.idPenduduk,nama,pekerjaan,jumlahVaksin,tanggal,NIK
                  FROM penduduk LEFT JOIN (SELECT idPenduduk, COUNT(id) as jumlahVaksin
                                           FROM dataKesehatan
                                           GROUP BY idPenduduk)as jmlVaksin ON penduduk.idPenduduk=jmlVaksin.idPenduduk
                                           LEFT JOIN(SELECT idPenduduk,tanggal
                                                     FROM dataKesehatan)as faksinH on penduduk.idPenduduk=faksinH.idPenduduk
                                           LEFT JOIN(SELECT idPenduduk,awalVaksinasi, akhirVaksinasi
                                                     FROM daftarpenduduk) as daftar on penduduk.idPenduduk=daftar.idPenduduk
                 
                                           WHERE '$time'>=awalVaksinasi AND '$time'<=akhirVaksinasi AND (jumlahVaksin<2 OR jumlahVaksin IS  NULL) AND tanggal!='$today'";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){           
            $result[] =new daftarOrangVaksin ($value['idPenduduk'],$value['nama'],$value['pekerjaan'],$value['jumlahVaksin'],$value['NIK']);
        }
        return $result;
    }

    public function getAllDaftarOrangS($NIK){
        $today=date("Y-m-d");
        date_default_timezone_set("Asia/Jakarta");
        $time = $this->db->escapeString(date("Y-m-d H:i:s"));
        $query = "SELECT penduduk.idPenduduk,nama,pekerjaan,jumlahVaksin,tanggal,NIK
                  FROM penduduk LEFT JOIN (SELECT idPenduduk, COUNT(id) as jumlahVaksin
                                           FROM dataKesehatan
                                           GROUP BY idPenduduk)as jmlVaksin ON penduduk.idPenduduk=jmlVaksin.idPenduduk
                                           LEFT JOIN(SELECT idPenduduk,tanggal
                                                     FROM dataKesehatan)as faksinH on penduduk.idPenduduk=faksinH.idPenduduk
                                           LEFT JOIN(SELECT idPenduduk,awalVaksinasi, akhirVaksinasi
                                                     FROM daftarpenduduk) as daftar on penduduk.idPenduduk=daftar.idPenduduk
                  WHERE NIK LIKE '%$NIK%' AND '$time'>=awalVaksinasi AND '$time'<=akhirVaksinasi AND (jumlahVaksin<2 OR jumlahVaksin IS  NULL)AND tanggal!='$today'";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){           
            $result[] =new daftarOrangVaksin ($value['idPenduduk'],$value['nama'],$value['pekerjaan'],$value['jumlahVaksin'],$value['NIK']);
        }
        return $result;
    }
}
?>
