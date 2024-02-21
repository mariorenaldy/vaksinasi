<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once "controller/services/auth.php";
require_once "model/laporFirstView.php";
require_once "model/laporDetailVaksin.php";
require_once "model/laporDetailPendaftaran.php";


class PimpinanController{
    protected $db;
    protected $auth;

    public function __construct(){
        $this->db = new MySQLDB();
        $this->auth = new Auth($this->db);
        if( !$this->auth->checkRole(["pimpinan"]) ){
          redirect(route('/'));
        }
    }

    public function index(){
        return View::createView('pimpinan/pimpinan.php');
    }

    public function laporanVaksinasi(){
        $result=[];
        return View::createView('pimpinan/laporanVaksinasi.php', ["result"=>$result]);
    }

    public function laporanPendaftaran(){
        $result=[];
        return View::createView('pimpinan/laporanPendaftaran.php', ["result"=>$result]);
    }

    public function laporanVaksinasiSc($awal,$akhir){
        $result=$this->getAllV($awal,$akhir);
        return View::createView('pimpinan/laporanVaksinasi.php', ["result"=>$result]);
    }

    public function laporanVaksinasidetail($awal,$akhir){
        $result=$this->getAlldetailV($awal,$akhir);
        return View::createView('pimpinan/tampilanVaksinasi.php', ["result"=>$result]);
    }

    public function laporanPendaftaranSc($awal,$akhir){
        $result=$this->getAllP($awal,$akhir);
        return View::createView('pimpinan/laporanPendaftaran.php', ["result"=>$result]);
    }

    public function laporanPendaftarandetail($awal,$akhir){
        $result=$this->getAlldetailP($awal,$akhir);
        return View::createView('pimpinan/tampilanPendaftaran.php', ["result"=>$result]);
    }

    public function getAllV($awal,$akhir){
        $query = "SELECT nama,NIK,tanggal,status,tahap
                    FROM penduduk inner join daftarpenduduk on penduduk.idPenduduk=daftarpenduduk.idPenduduk 
                    INNER JOIN dataKesehatan ON daftarpenduduk.idPenduduk = dataKesehatan.idPenduduk 
                    inner join pendaftaran on pendaftaran.idDaftar=daftarpenduduk.idDaftar 
                    WHERE tanggal >= '$awal' AND tanggal <= '$akhir'
                    ";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){       
            $result[] =new laporDetailVaksin ($value['nama'],$value['NIK'],$value['tanggal'],$value['status'],$value['tahap']);
        }
        return $result;      
    }
    
    public function getAlldetailV($awal,$akhir){

        $query = "SELECT tanggal,count(daftarpenduduk.idPenduduk)as jmlOrang
                    FROM pendaftaran inner join daftarpenduduk on pendaftaran.idDaftar=daftarpenduduk.idDaftar 
                    INNER JOIN dataKesehatan ON daftarpenduduk.idPenduduk = dataKesehatan.idPenduduk 
                    WHERE tanggal >= '$awal' AND tanggal <= '$akhir'
                    GROUP BY tanggal
                    ";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){       
            $result[] =new laporFirstView ($value['tanggal'],$value['jmlOrang']);
        }
        return $result;
        
    }

    public function getAllP($awal,$akhir){
        $awal= date("$awal 00:00:00");
        $akhir= date("$akhir 23:59:59");
        $query = "SELECT nama,NIK,tanggalPendaftaran,tahap
                    FROM penduduk inner join daftarpenduduk on penduduk.idPenduduk=daftarpenduduk.idPenduduk 
                    inner join pendaftaran on pendaftaran.idDaftar=daftarpenduduk.idDaftar 
                    WHERE tanggalPendaftaran >= '$awal' AND tanggalPendaftaran <= '$akhir'
                    ";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){       
            $result[] =new laporDetailPendaftaran ($value['nama'],$value['NIK'],$value['tanggalPendaftaran'],$value['tahap']);
        }
        return $result;
    }

    public function getAlldetailP($awal,$akhir){
        $awal= date("$awal 00:00:00");
        $akhir= date("$akhir 23:59:59");
        $query = "SELECT tanggalPendaftaran,count(daftarpenduduk.idPenduduk)as jmlOrang
                    FROM pendaftaran inner join daftarpenduduk on pendaftaran.idDaftar=daftarpenduduk.idDaftar 
                    WHERE tanggalPendaftaran >= '$awal' AND tanggalPendaftaran <= '$akhir'
                    GROUP BY DATE(tanggalPendaftaran)
                    ";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){   
            $result[] =new laporFirstView ($value['tanggalPendaftaran'],$value['jmlOrang']);
        }
        return $result;
        
    }
    
}
?>