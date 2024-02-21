<?php
	$title = "Pimpinan";
?>
<table>			
		
		<tr>
			<th>Tanggal</th>
			<th>Jumlah yang daftar</th>
		</tr>
		<?php
		$total=0;
		foreach ($result as $key => $row) {
				$tanggal=$row->gettanggal();
				$jumlah=$row->getjmlOrang();		
				echo "<tr>";
				echo "<td>".$tanggal."</td>";
				echo "<td>".$jumlah." orang</td>";
				$total=$total+$jumlah;
				echo "</tr>";
			}
			
		echo "</table>";
		
		echo "<div style='text-align: center;'>Pada tanggal ".$_POST['awalpendaftaran']." sampai ".$_POST['akhirpendaftaran']." terdapat ".$total." penduduk yang daftar</div><br>";
		
		?>
		
		<div style="text-align: center;">
			<?php echo "<button  onclick='window.location.href=\"".route("/pimpinan/laporan-pendaftaran")."\";'>Kembali</button>";?>
		</div>