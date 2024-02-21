<?php
	$title = "Pembuatan Pendaftaran";
?>
<div id="form_container">
	<form method="POST" action="buat-pendaftaran">
		<h2 class=judulForm>Pembuatan Pendaftaran</h2>

		<ul>
			<li>
				<label for="tahap">Tahap: </label>
				<div>
					<select id="tahap" name="tahap">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div> 
			</li>
			
			<li>
				Tanggal Pendaftaran:
				<br>
				
				<input type="datetime-local" id="awalPendaftaran" name="awalPendaftaran" required>
				sampai
				<input type="datetime-local" id="akhirPendaftaran" name="akhirPendaftaran" required>
			</li>

			<li>
				Jadwal Vaksinasi:
				<br>

				<input type="datetime-local" id="awalVaksinasi" name="awalVaksinasi" required>
				sampai
				<input type="datetime-local" id="akhirVaksinasi" name="akhirVaksinasi" required>
			</li>

			<li>
				<button name="submit" value="Submit" type="submit" onclick="return confirm('Buat pendaftaran?')"> Buat Pendaftaran </button>
			</li>
		</ul>
	</form>

	<a class="back" href="<?php echo route("/admin"); ?>"><button>Kembali ke halaman Admin</button></a>
</div>

<script>
	document.getElementById("awalPendaftaran").addEventListener("change", limitAkhirDaftar);
	document.getElementById("akhirPendaftaran").addEventListener("change", limitAwalVaksin);
	document.getElementById("awalVaksinasi").addEventListener("change", limitAkhirVaksin);

	function limitAkhirDaftar(){
		document.getElementById("akhirPendaftaran").min = document.getElementById("awalPendaftaran").value;
	}
	function limitAwalVaksin(){
		document.getElementById("awalVaksinasi").min = document.getElementById("akhirPendaftaran").value;
	}
	function limitAkhirVaksin(){
		document.getElementById("akhirVaksinasi").min = document.getElementById("awalVaksinasi").value;
	}
</script>