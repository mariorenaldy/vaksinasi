<?php
	$title = "Pendaftaran Vaksinasi";
	if(isset($_SESSION['notImage']) && !empty($_SESSION['notImage'])){
		echo "<script type='text/javascript'>alert('File yang anda masukkan tidak valid!');</script>";
		unset($_SESSION['notImage']);
	}
	else if(isset($_SESSION['submitted']) && !empty($_SESSION['submitted'])){
		echo "<script type='text/javascript'>alert('Pendaftaran anda telah disubmit. Silahkan cek email anda dalam beberapa hari untuk informasi lebih lanjut');</script>";
		unset($_SESSION['submitted']);
	}
?>
<div id="form_container">
	<form method="POST" id="daftarForm" action="<?php echo route("/daftar"); ?>" enctype= "multipart/form-data">
		<h2 class=judulForm>Pendaftaran Vaksinasi</h2>

		<ul>
			<li>
				<label for="nama">Nama Lengkap:</label>
				<div>
					<input id="nama" name="nama" type="text" maxlength="50" required> 
				</div>
			</li>

			<li>
				<label for="NIK">NIK:</label>
				<div>
					<input id="NIK" name="NIK" type="text" pattern="\d*" minlength="16" maxlength="16" required>
				</div> 
			</li>	

			<li>
				<label for="KTP">Foto KTP:</label>
				<div>
					<input type="file" id="KTP" name="KTP" accept="image/*" required>
				</div> 
			</li>

			<li>
				<label for="email">Email:</label>
				<div>
					<input id="email" name="email" type="text" maxlength="50" required> 
				</div> 
			</li>		
			
			<li>
				<label for="noHP">No. HP:</label>
				<div>
					<input id="noHP" name="noHP" type="text" pattern="\d*" minlength="12" maxlength="12" required>
				</div> 
			</li>		
			
			<li>
				<label for="pekerjaan">Pekerjaan:</label>
				<div>
					<input id="pekerjaan" name="pekerjaan" type="text" maxlength="50" required>
				</div>
			</li>
			
			<li>
				<input type='hidden' name='idDaftar' value='<?php echo "$_GET[idDaftar]";?>'>
			</li>

			<li>
				<input id="submit" type="submit" name="submit" value="Submit">
			</li>
		</ul>
	</form>
</div>
<script>
	function testRegex(email) {
		let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	function validateEmail(){
		let email = document.getElementById("email").value;

		if (testRegex(email)) {
			return true;
		} 
		else {
			return false;
		}
	}

	function isValidForm(){
		if(!validateEmail()){
			alert("Email yang anda masukkan tidak valid!");
			return false;
		}
		else{
			return true;
		}
	}

	document.getElementById('daftarForm').onsubmit = function() {
		if(isValidForm()){
			if(confirm('Submit form?')){
				return true;
			} 
			else{
				return false;
			}
		}
		else{
			return false;
		}
	};
</script>