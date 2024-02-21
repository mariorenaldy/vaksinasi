<?php
	$title = "Pimpinan";
?>
<table>			
		
		<tr>
			<th>Tanggal</th>
			<th>Jumlah yang di Vaksin</th>
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
		
		echo "<div style='text-align: center;'>Pada tanggal ".$_POST['awalVaksinasi']." sampai ".$_POST['akhirVaksinasi']." terdapat ".$total." penduduk yang divaksinasi</div><br>";
		
		?>
		<div style="text-align: center;">
			<?php echo "<button style='text-align:center;' onclick='window.location.href=\"".route("/pimpinan/laporan-vaksinasi")."\";'>Kembali</button>";?>
		</div>