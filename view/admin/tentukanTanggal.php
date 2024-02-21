<div class="form_description">
    <h2>Tentukan Tanggal Vaksinasi</h2>
</div>
<div id="isi">
    <div id="align">
        <?php
            $title = "Tentukan Tanggal Vaksinasi";
            $idDaftar = "";
            $idPenduduk = "";
            foreach ($result as $key => $row) {
                $idDaftar = $row->getIdDaftar();
                $idPenduduk = $row->getIdPenduduk();
                $batasAwal = date('Y-m-d\TH:i', strtotime($row->getBatasAwalVaksinasi()));
                $batasAkhir = date('Y-m-d\TH:i', strtotime($row->getBatasAkhirVaksinasi()));

                echo "<span>Nama Lengkap</span>".$row->getNama()."<br>";
                echo "<span>NIK</span>".$row->getNIK()."<br>";

                echo "<span>Foto KTP</span>";
                $img = file_get_contents($row->getFotoKTP());
                $img_src = 'data:image/jpg;base64,'.base64_encode($img);
                echo "<img src='$img_src' width=350 style='vertical-align:top' /><br>";

                echo "<span>Email</span>" . $row->getEmail() . "<br>";
                echo "<span>No. HP</span>" . $row->getNoHP() . "<br>";
                echo "<span>Pekerjaan</span>" . $row->getPekerjaan() . "<br>";
            }
        ?>
    
    <br>
	<form method="POST" action="<?php echo route("/set-tanggal-vaksinasi"); ?>">
        <span>Jadwal Vaksinasi</span>
        <br>
        <input type="hidden" name="idDaftar" value="<?php echo $idDaftar ?>"/>
        <input type="hidden" name="idPenduduk" value="<?php echo $idPenduduk ?>"/>

        <input type="datetime-local" id="awalVaksinasi" name="awalVaksinasi" required>
        sampai
        <input type="datetime-local" id="akhirVaksinasi" name="akhirVaksinasi" required>
        <br>
        <br>

        <button name="submit" value="Submit" type="submit" onclick="return confirm('Tetapkan tanggal vaksinasi?')">Tetapkan Tanggal Vaksinasi</button>
	</form>
    </div>
    <br>
</div>

<a class="back" href="javascript:history.back()"><button>Kembali ke List Pendaftaran</button></a>

<script>
	document.getElementById("awalVaksinasi").min = "<?php echo $batasAwal; ?>";
    document.getElementById("awalVaksinasi").max = "<?php echo $batasAkhir; ?>";
    document.getElementById("akhirVaksinasi").min = "<?php echo $batasAwal; ?>";
	document.getElementById("akhirVaksinasi").max = "<?php echo $batasAkhir; ?>";

	document.getElementById("awalVaksinasi").addEventListener("change", limitAkhirVaksin);
	function limitAkhirVaksin(){
		document.getElementById("akhirVaksinasi").min = document.getElementById("awalVaksinasi").value;
	}
</script>