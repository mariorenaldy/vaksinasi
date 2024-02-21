<?php
	$title = "Pendaftaran Vaksinasi";
?>
<h1 style="margin-top:0px;">Pendaftaran Vaksinasi</h1>
<table>
	<tr>
		<th>Tahap</th>
		<th>Awal Pendaftaran</th>
		<th>Akhir Pendaftaran</th>
		<th>Awal Vaksin</th>
		<th>Akhir Vaksin</th>
		<th></th>
	</tr>
	<?php
		foreach ($result as $key => $row) {
			$id=$row->getIdDaftar();
			$tahap=$row->getTahap();
			$awalD=$row->getAwalPendaftaran();
			$akhirD=$row->getAkhirPendaftaran();
			$awalV=$row->getAwalVaksinasi();
			$akhirV=$row->getAkhirVaksinasi();
			echo "<tr>";
			echo "<td>".$tahap."</td>";
			
			setlocale(LC_ALL, 'IND');

			$DtAwalD = new DateTime($awalD);
            $DtAkhirD = new DateTime($akhirD);
            $DtAwalV = new DateTime($awalV);
            $DtAkhirV = new DateTime($akhirV);

            echo "<td>".strftime('%A, %d %B %Y pukul %H:%M', $DtAwalD->getTimestamp())."</td>";
            echo "<td>".strftime('%A, %d %B %Y pukul %H:%M', $DtAkhirD->getTimestamp())."</td>";
            echo "<td>".strftime('%A, %d %B %Y pukul %H:%M', $DtAwalV->getTimestamp())."</td>";
            echo "<td>".strftime('%A, %d %B %Y pukul %H:%M', $DtAkhirV->getTimestamp())."</td>";

			$today = date("Y-m-d H:i:s");
			if($today <$awalD) {
				echo '<td>Pendaftaran Belum dibuka</td>';
			}
			elseif ($today >$akhirD) {
				echo '<td>Pendaftaran Sudah ditutup</td>';
			}
			else{
				echo "<td>
				<button onclick='
				window.location.href = \"".route("/daftar/tahap?idDaftar=".$row->getIdDaftar())."\";'
				>
						Daftar Vaksinasi
				</button>
				</td>";
			}               
			echo "</tr>";
		}
	?>
</table>
