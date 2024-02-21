
<div class = "flex-container">
	<div class = "judul">Web Vaksinasi Covid-19 Indonesia</div>
	<div>
		<?php 
		if($isAuth != null){
		?>
			<a href="<?php echo route('/logout'); ?>" class="tombol">Logout</a>
		<?php
		}else{
		?>
			<a href="<?php echo route('/login'); ?>" class="tombol">Login</a>
		<?php
		}
		?>
	</div>
</div>

<div>
	<div class = "gambar">
		<img id="gmbr" src = "view/img/peta.png">
	</div>
	<br>
	<div class = "explaination">
	Vaksinasi gotong royong adalah pelaksanaan vaksinasi kepada karyawan/karyawati, keluarga dan individu lain 
	dalam keluarga yang pendanaannya dibebankan pada badan hukum atau badan usaha berdasarkan Peraturan Menteri 
	Kesehatan Nomor 10 Tahun 2021.
</div>
<br>
<div class= "daftar">
	<button class="buttonDaf"><a style="text-decoration:none;" href = "<?php echo route('/daftar'); ?>" class = "nextpage">Daftar Vaksinasi</a></div>
	</button>
<div class = "ViMi">
		<h3 id="ViCom">Visi <br> Menuju masyarakat Indonesia yang lebih sehat serta maju dalam bidang kesehatan<h3>

		<h3 id="MiCom">Misi <br>Memberikan pelayanan yang terbaik bagi seluruh masyarakat Indonesia yang Bhineka Tunggal Ika<h3>
	</div>
<div class="company">
	<img id="logoC" src="view/img/logoCompany.png">
	<h2 id="boutAMA">AMA Company terbentuk sejak April 2021 sebagai bentuk pengabdian kepada masyarakat Indonesia di tengah kondisi covid-19 dalam bidang kesehatan.</h2>
</div>

