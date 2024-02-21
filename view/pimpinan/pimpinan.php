<?php
	$title = "Pimpinan";
?>
<div class = "Pim" >
	<h1 style="margin-top : 0px;">Pimpinan</h1>
</div>

<div class = "ProfilePict">
	<img class = "PP put-middle" src = "view/img/profile.png" width="125px">
</div>

<div class = "TombLaporan">
	<a style="text-decoration : none;" href="<?php echo route("/pimpinan/laporan-pendaftaran"); ?>" class = "tombolDaftar">Laporan Pendaftaran</a>
	<a style="text-decoration : none;" href="<?php echo route("/pimpinan/laporan-vaksinasi"); ?>" class = "tombolVaksin">Laporan Vaksinasi</a>
</div>