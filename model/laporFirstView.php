<?php
class laporFirstView{  
    private $tanggal;
    private $jmlOrang;


    public function __construct($tanggal,$jmlOrang){
		$this->tanggal = $tanggal;
		$this->jmlOrang = $jmlOrang;
	}

	public function getjmlOrang(){
		return $this->jmlOrang;
	}
    public function gettanggal(){
		return date_format (new DateTime($this->tanggal), 'd F Y');
		// return $this->tanggal;
	}
}
  ?>