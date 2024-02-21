<?php
class daftarOrangVaksin{  
    private $idPenduduk;
    private $nama;
    private $pekerjaan;
    private $jumlahVaksin;
	private $NIK;


    public function __construct($idPenduduk,$nama,$pekerjaan,$jumlahVaksin,$NIK){
		$this->idPenduduk = $idPenduduk;
		$this->nama = $nama;
		$this->pekerjaan = $pekerjaan;
		$this->jumlahVaksin = $jumlahVaksin;
		$this->NIK = $NIK;
	}

	public function getidPenduduk(){
		return $this->idPenduduk;
	}
    public function getnama(){
		return $this->nama;
	}
	public function getNIK(){
		return $this->NIK;
	}
    public function getpekerjaan(){
		return $this->pekerjaan;
	}
    public function getjumlahVaksin(){
		return $this->jumlahVaksin;
	}
}
?>
