<?php

class HasilDaftar{
	protected $idDaftar;
	protected $idPenduduk;
	protected $tanggalPendaftaran;
	protected $nama;
	protected $NIK;
    protected $fotoKTP;
	protected $pekerjaan;
    protected $noHP;
	protected $email;
	protected $batasAwalVaksinasi;
	protected $batasAkhirVaksinasi;

	public function __construct($idDaftar,$idPenduduk,$tanggalPendaftaran,$nama,$NIK,$fotoKTP,$pekerjaan,$noHP,$email, $batasAwalVaksinasi, $batasAkhirVaksinasi){
		$this->idDaftar = $idDaftar;
		$this->idPenduduk = $idPenduduk;
		$this->tanggalPendaftaran = $tanggalPendaftaran;
		$this->nama = $nama;
		$this->NIK = $NIK;
		$this->fotoKTP = $fotoKTP;
		$this->pekerjaan = $pekerjaan;
		$this->noHP = $noHP;
		$this->email = $email;
		$this->batasAwalVaksinasi = $batasAwalVaksinasi;
		$this->batasAkhirVaksinasi = $batasAkhirVaksinasi;
	}

	public function getIdDaftar(){
		return $this->idDaftar;
	}

	public function getIdPenduduk(){
		return $this->idPenduduk;
	}

	public function getTanggalPendaftaran(){
		return $this->tanggalPendaftaran;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getNIK(){
		return $this->NIK;
	}

	public function getFotoKTP(){
		return $this->fotoKTP;
	}

	public function getPekerjaan(){
		return $this->pekerjaan;
	}

    public function getNoHP(){
		return $this->noHP;
	}

    public function getEmail(){
		return $this->email;
	}

	public function getBatasAwalVaksinasi(){
		return $this->batasAwalVaksinasi;
	}

	public function getBatasAkhirVaksinasi(){
		return $this->batasAkhirVaksinasi;
	}
}
?>