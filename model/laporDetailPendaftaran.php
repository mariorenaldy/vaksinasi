<?php

class laporDetailPendaftaran{
	protected $nama;
	protected $NIK;
	protected $tanggal;
	protected $tahap;

	public function __construct($nama,$NIK,$tanggal,$tahap){
		$this->nama = $nama;
		$this->NIK = $NIK;
		$this->tanggal = $tanggal;
		$this->tahap = $tahap;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getNIK(){
		return $this->NIK;
	}

	public function gettanggal(){
		// return date_format (new DateTime($this->tanggal), 'Y');
		// return date_format($this->tanggal,"Y/m/d");
		return $this->tanggal;
	}
	public function gettahap(){
		return $this->tahap;
	}
	
}
?>