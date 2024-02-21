<?php

class laporDetailVaksin{
	protected $nama;
	protected $NIK;
	protected $tanggal;
	protected $status;
	protected $tahap;

	public function __construct($nama,$NIK,$tanggal,$status,$tahap){
		$this->nama = $nama;
		$this->NIK = $NIK;
		$this->tanggal = $tanggal;
		$this->status = $status;
		$this->tahap = $tahap;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getNIK(){
		return $this->NIK;
	}

	public function gettanggal(){
		return $this->tanggal;
	}

	public function getstatus(){
		return $this->status;
	}
	public function gettahap(){
		return $this->tahap;
	}

	
}
?>