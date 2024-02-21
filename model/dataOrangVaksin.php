<?php
class dataOrang{  
    private $idPenduduk;
    private $nama;
    private $jumlahVaksin;

    public function __construct($idPenduduk,$nama,$jumlahVaksin){
		$this->idPenduduk = $idPenduduk;
		$this->nama = $nama;
		$this->jumlahVaksin = $jumlahVaksin;
	}

	public function getidPenduduk(){
		return $this->idPenduduk;
	}
    public function getnama(){
		return $this->nama;
	}
    public function getjumlahVaksin(){
		return $this->jumlahVaksin;
	}
}
  ?>