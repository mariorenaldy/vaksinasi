<?php

class Pendaftaran{
	protected $idDaftar;
	protected $tahap;
	protected $awalPendaftaran;
    protected $akhirPendaftaran;
    protected $awalVaksinasi;
	protected $akhirVaksinasi;

	public function __construct($idDaftar,$tahap,$awalPendaftaran,$akhirPendaftaran,$awalVaksinasi,$akhirVaksinasi){
		$this->idDaftar = $idDaftar;
		$this->tahap = $tahap;
		$this->awalPendaftaran = $awalPendaftaran;
		$this->akhirPendaftaran = $akhirPendaftaran;
		$this->awalVaksinasi = $awalVaksinasi;
		$this->akhirVaksinasi = $akhirVaksinasi;
	}

	public function getIdDaftar(){
		return $this->idDaftar;
	}

	public function getTahap(){
		return $this->tahap;
	}

	public function getAwalPendaftaran(){
		return $this->awalPendaftaran;
	}

	public function getAkhirPendaftaran(){
		return $this->akhirPendaftaran;
	}

    public function getAwalVaksinasi(){
		return $this->awalVaksinasi;
	}

    public function getAkhirVaksinasi(){
		return $this->akhirVaksinasi;
	}
}


?>