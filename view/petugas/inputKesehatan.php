<form method="POST" action='<?php echo route("/petugas/submit-data-kesehatan"); ?>'>
	<fieldset>
			<legend>Data Kesehatan</legend>
			<?php				
				foreach ($result as $key => $row) {
					$id=$row->getidPenduduk();
					$nama=$row->getnama();
					$jmlVaksin=($row->getjumlahVaksin()+1);
					
				}
				echo "<a>ID Penduduk : <input type='number' name='idPenduduk' value='".$id."' readonly></a><br><br>";
				echo "<a>Nama : ".$nama."</a><br><br>";
				echo "<a>Suhu Tubuh : <input type='number' name='suhu' placeholder='Input Suhu'step=0.1 required> °C</a><br><br>";
				echo "<a>Tekanan Darah : <input type='number' name='mm' placeholder='Input mm'required> / <input type='number' name='Hg' placeholder='Input Hg' required>mmHg</a><br><br>";
				echo "<a>Vaksin ke :<input type='number' name='vaksin' value='".$jmlVaksin."' readonly /></a><br><br>";
				$today = date("d/m/Y");
				echo "<a>Tanggal di Vaksin : ".$today."</a><br><br>";
				echo "<div style='float: right ;'><input type='submit' value= 'Submit' style='font-size: 20px;'></div></form>";				
				echo "<div style='float: left ;'>
				<button onclick='window.location.href=\"".route("/petugas")."\";'>kembali</button>
				</div>";
			?>
				
				
			
	</fieldset>
