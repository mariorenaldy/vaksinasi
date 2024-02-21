<?php
require_once "controller/services/mysqlDB.php";
require_once "controller/services/view.php";
require_once 'model/pendaftaran.php';
require_once 'model/penduduk.php';
require_once 'model/hasilDaftar.php';

class PendaftaranController{
    protected $db;

    public function __construct(){
        $this->db = new MySQLDB();
    }

    public function view_daftar(){
        if( !isset($_GET["idDaftar"]) ) redirect(route("/daftar"));

        $result = [];
        return View::createView('daftar.php',
            [
                "result"=> $result
            ]);
    }

    public function view_hasil(){
        if( !isset($_GET["idDaftar"]) || !isset($_GET["idPenduduk"]) ) redirect(route("/daftar"));

        $idDaftar = $_GET['idDaftar'];
        $idPenduduk = $_GET['idPenduduk'];
        $query = "SELECT * FROM daftarpenduduk INNER JOIN penduduk ON daftarpenduduk.idPenduduk = penduduk.idPenduduk WHERE idDaftar = '$idDaftar' AND penduduk.idPenduduk = '$idPenduduk'";

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
        return View::createView('hasil.php',
            [
                "result"=> $result
            ]);
    }

    public function submitPendaftaran(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $file = $_FILES['KTP']['tmp_name'];
            if (file_exists($file)){
                $imagesizedata = getimagesize($file);
                if ($imagesizedata === FALSE)
                {
                    session_start();
                    $_SESSION["notImage"] = "notImage";
                    redirect(route("/daftar/tahap?idDaftar=$_POST[idDaftar]"));
                }
            }
        }

        $nama = "";
        $NIK = "";
        $KTP = "";
        $pekerjaan = "";
        $noHP = "";
        $email = "";

        if(isset($_POST['nama']) && isset($_POST['NIK']) && count($_FILES) > 0 && is_uploaded_file($_FILES['KTP']['tmp_name']) && isset($_POST['pekerjaan']) && isset($_POST['noHP']) && isset($_POST['email'])){
            $nama = $_POST['nama'];
            $NIK = $_POST['NIK'];
            $pekerjaan = $_POST['pekerjaan'];
            $noHP = $_POST['noHP'];
            $email = $_POST['email'];

            $oldname = $_FILES['KTP']['tmp_name'];

            $upload_path = 'uploads/';
            if( !file_exists($upload_path) || !is_dir($upload_path) ){
                mkdir($upload_path, 0775, true);
            }

            $newname = dirname(__DIR__) . '\\uploads\\' . $email .'\\ktp.jpg';
            if (!is_dir("uploads\\$email")) {
                mkdir("uploads\\$email");
            }
            move_uploaded_file($oldname, $newname);
            $KTP = 'uploads/' . $email . '/ktp.jpg';

            if(isset($nama) && $nama != "" && isset($NIK) && $NIK != "" && isset($pekerjaan) && $pekerjaan != "" && isset($noHP) && $noHP != "" && isset($email) && $email != ""){
                $nama = $this->db->escapeString($nama);
                $NIK = $this->db->escapeString($NIK);
                $pekerjaan = $this->db->escapeString($pekerjaan);
                $noHP = $this->db->escapeString($noHP);
                $email = $this->db->escapeString($email);

                $query = "INSERT INTO penduduk (nama, NIK, KTP, pekerjaan, noHP, email) VALUES ('$nama', '$NIK', '$KTP', '$pekerjaan', '$noHP', '$email')";
                $this->db->executeNonSelectQuery($query);

                $idPenduduk = $this->db->lastID();
                $idDaftar = $_POST["idDaftar"];
                $tanggalPendaftaran = new DateTime("now", new DateTimeZone('Asia/Jakarta') );
                $tanggalPendaftaran = $tanggalPendaftaran->format('Y-m-d H:i:s');

                $query = "INSERT INTO daftarpenduduk (idDaftar, idPenduduk, tanggalPendaftaran) VALUES ('$idDaftar', '$idPenduduk', '$tanggalPendaftaran')";
                $this->db->executeNonSelectQuery($query);

                session_start();
                $_SESSION["submitted"] = "submitted";
                redirect(route("/daftar/tahap?idDaftar=$_POST[idDaftar]"));
            }
        }
    }

    public function view_buatPendaftaran(){
        $result = [];
        return View::createView('admin/buatPendaftaran.php',
            [
                "result"=> $result
            ]);
    }

    public function view_listHasilPendaftaran(){
        $result = $this->getAllHasilPendaftaran();
        return View::createView('admin/listHasilPendaftaran.php',
            [
                "result"=> $result
            ]);
    }

    public function getAllHasilPendaftaran(){
        $query = "SELECT * FROM daftarpenduduk INNER JOIN penduduk ON daftarpenduduk.idPenduduk = penduduk.idPenduduk WHERE idDaftar = ".$_GET["idDaftar"];

        $query_result = $this->db->executeSelectQuery($query);
        $result = [];
        foreach($query_result as $key => $value){
            setlocale(LC_ALL, 'IND');
            $tanggalPendaftaran = new DateTime($value['tanggalPendaftaran']);
            $tanggalPendaftaran = strftime('%A, %d %B %Y pukul %H:%M', $tanggalPendaftaran->getTimestamp());

            $awalVaksinasi = $value['awalVaksinasi'];
            $akhirVaksinasi = $value['akhirVaksinasi'];
            if($awalVaksinasi !== null){
                $awalVaksinasi = new DateTime($awalVaksinasi);
                $akhirVaksinasi = new DateTime($akhirVaksinasi);
                $awalVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $awalVaksinasi->getTimestamp());
                $akhirVaksinasi = strftime('%A, %d %B %Y pukul %H:%M', $akhirVaksinasi->getTimestamp());
            }
            $result[] = new Penduduk($_GET['idDaftar'], $value['idPenduduk'], $tanggalPendaftaran, $value['nama'], $value['NIK'], $value['KTP'], $value['pekerjaan'], $value['noHP'], $value['email'], $awalVaksinasi, $akhirVaksinasi);
        }
        return $result;
    }

    public function buatPendaftaran(){
        $tahap = "";
        $awalPendaftaran = "";
        $akhirPendaftaran = "";
        $awalVaksinasi = "";
        $akhirVaksinasi = "";

        if(isset($_POST['tahap']) && isset($_POST['awalPendaftaran']) && isset($_POST['akhirPendaftaran']) && isset($_POST['awalVaksinasi']) && isset($_POST['akhirVaksinasi'])){
            $tahap = $_POST["tahap"];
            $awalPendaftaran = date("Y-m-d H:i:s", strtotime($_POST["awalPendaftaran"]));
            $akhirPendaftaran = date("Y-m-d H:i:s", strtotime($_POST["akhirPendaftaran"]));
            $awalVaksinasi = date("Y-m-d H:i:s", strtotime($_POST["awalVaksinasi"]));
            $akhirVaksinasi = date("Y-m-d H:i:s", strtotime($_POST["akhirVaksinasi"]));

            if(isset($tahap) && $tahap != "" && isset($awalPendaftaran) && $awalPendaftaran != "" && isset($akhirPendaftaran) && $akhirPendaftaran != "" && isset($awalVaksinasi) && $awalVaksinasi != "" && isset($akhirVaksinasi) && $akhirVaksinasi != ""){
                $query = "INSERT INTO pendaftaran (tahap, awalDaftar, akhirDaftar, awalVaksinasi, akhirVaksinasi) VALUES ('$tahap', '$awalPendaftaran', '$akhirPendaftaran', '$awalVaksinasi', '$akhirVaksinasi')";
                $this->db->executeNonSelectQuery($query);
            }
        }
    }

    public function tolakPendaftaran(){
        $idDaftar = $_POST['idDaftar'];
        $idPenduduk = $_POST['idPenduduk'];
        $query = "DELETE FROM daftarpenduduk WHERE idDaftar='$idDaftar' AND idPenduduk='$idPenduduk'";
        $this->db->executeNonSelectQuery($query);

        $query = "DELETE FROM penduduk WHERE idPenduduk='$idPenduduk'";
        $this->db->executeNonSelectQuery($query);
    }

    public function tentukanTanggal(){
        $idDaftar = $_POST['idDaftar'];
        $idPenduduk = $_POST['idPenduduk'];
        $query = "SELECT daftarpenduduk.idDaftar, daftarpenduduk.idPenduduk, daftarpenduduk.tanggalPendaftaran, nama, NIK, KTP, pekerjaan, noHP, email, pendaftaran.awalVaksinasi, pendaftaran.akhirVaksinasi FROM daftarpenduduk INNER JOIN penduduk ON daftarpenduduk.idPenduduk = penduduk.idPenduduk 
        INNER JOIN pendaftaran ON daftarpenduduk.idDaftar = pendaftaran.idDaftar
        WHERE daftarpenduduk.idDaftar = '$idDaftar' AND penduduk.idPenduduk = '$idPenduduk'";

        $query_result = $this->db->executeSelectQuery($query);
        $result = [];
        foreach($query_result as $key => $value){
            $result[] = new HasilDaftar($value['idDaftar'], $value['idPenduduk'], $value['tanggalPendaftaran'], $value['nama'], $value['NIK'], $value['KTP'], $value['pekerjaan'], $value['noHP'], $value['email'], $value['awalVaksinasi'], $value['akhirVaksinasi']);
        }
        return View::createView('admin/tentukanTanggal.php',
        [
            "result"=> $result
        ]);
    }

    public function setTanggalVaksinasi(){
        $idDaftar = $_POST['idDaftar'];
        $idPenduduk = $_POST['idPenduduk'];
        $awalVaksinasi = $_POST['awalVaksinasi'];
        $akhirVaksinasi = $_POST['akhirVaksinasi'];

        $query = "UPDATE daftarpenduduk SET awalVaksinasi = '$awalVaksinasi', akhirVaksinasi = '$akhirVaksinasi' WHERE idDaftar = '$idDaftar' AND idPenduduk = '$idPenduduk'";
        $this->db->executeNonSelectQuery($query);
    }

    public function view_daftarAwal(){
        $result=$this->getAllTglDaftar();
		return View::createView('daftarAwal.php',
            [
                "result"=> $result
            ]);	
	}

    public function getAllTglDaftar(){
        $query = "SELECT * FROM pendaftaran";
        $res= $this->db->executeSelectQuery($query);
        $result=[];
        foreach ($res as $key => $value){           
            $result[] =new Pendaftaran ($value['idDaftar'],$value['tahap'],$value['awalDaftar'],$value['akhirDaftar'],$value['awalVaksinasi'],$value['akhirVaksinasi']);
        }
        return $result;
    }
}
?>