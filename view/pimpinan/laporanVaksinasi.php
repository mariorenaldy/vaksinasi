<?php
	$title = "Pimpinan";
?>
<div style="text-align:center;">
		<div class = "PilihTanggal"> Pilih tanggal vaksinasi </div>
	<br>
			<div>
	dari :
	<br>
	<form method="POST" action="<?php echo route("/pimpinan/laporan-vaksinasi"); ?>">
	<input type="date" name="awalVaksinasi" required>
			</div>
	<br>
			<div>
	sampai dengan :
	<br>
	<input type="date" name="akhirVaksinasi" required>
			</div>
	<br>
			<input type="submit" value="Tampilkan" style="font-size: 20px;">
	</form>
	
<?php
	echo '<td><form method="POST" action="'.route("/pimpinan/laporan-vaksinasi-detail").'">';
	if(isset($_POST['awalVaksinasi'])){
		echo "
		<hr>
		<table>			
		
		<tr>
			<th>Tanggal Awal</th>
			<th>Tanggal Akhir</th>			
		</tr>
					
			<tr>
			<td><input type='date' name='awalVaksinasi' value='".$_POST['awalVaksinasi']."' readonly></td>
			<td><input type='date' name='akhirVaksinasi' value='".$_POST['akhirVaksinasi']."' readonly></td>
		</tr>
		 
		</table>
		
		<br>
		<div style='text-align: center;'>Laporan Hasil </div>
		<br>
		<table>
		<tr>
			<th>Tahap</th>
			<th>Nama</th>
			<th>NIK</th>
			<th>Status Vaksinasi</th>
			<th>Tanggal di Vaksin</th>
		</tr>";
		foreach ($result as $key => $row) {
			$nama=$row->getNama();
			$NIK=$row->getNIK();
			$status=$row->getstatus();
			$tanggal=$row->gettanggal();
			$tahap=$row->gettahap();
			echo "<tr>";
			echo "<td>".$tahap."</td>";
			echo "<td>".$nama."</td>";
			echo "<td>".$NIK."</td>";
			echo "<td> vaksinasi ke-".$status."</td>";
			echo "<td>".$tanggal."</td>";             
			echo "</tr>";
		}	
		echo "</table><br><hr>";

		echo "<div  style='text-align:center;'><button type='submit'>Rekapan hasil</button></div>";
	}		
		?>

		
		<br>
		
	</form>
	<?php echo "<button onclick='window.location.href=\"".route("/pimpinan")."\";'>Kembali</button>";?>
</div>