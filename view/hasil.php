<div class="form_description">
    <h2>Hasil Pendaftaran</h2>
</div>
<div id="isi">
    <div id="align">
        <?php
            $title = "Hasil Pendaftaran";
            foreach ($result as $key => $row) {
                echo "<span>Nama Lengkap</span>".$row->getNama()."<br>";
                echo "<span>NIK</span>".$row->getNIK()."<br>";

                echo "<span>Foto KTP</span>";
                $img = file_get_contents($row->getFotoKTP());
                $img_src = 'data:image/jpg;base64,'.base64_encode($img);
                echo "<img src='$img_src' width=350 style='vertical-align:top' /><br>";

                echo "<span>Email</span>" . $row->getEmail() . "<br>";
                echo "<span>No. HP</span>" . $row->getNoHP() . "<br>";
                echo "<span>Pekerjaan</span>" . $row->getPekerjaan() . "<br><br>";
                echo "Vaksinasi anda akan dilakukan pada tanggal:<br>".
                $row->getAwalVaksinasi() ." sampai ". $row->getAkhirVaksinasi() . "<br>";
            }
        ?>
    </div>
    <br>
    Kartu vaksinasi telah dikirimkan ke email anda. <br>
    Silahkan disimpan dan diperlihatkan kepada petugas medis saat melakukan vaksinasi.
    <div id="emptyspace">
    </div>
    <a class="back" href="<?php echo route("/"); ?>"><button>Kembali ke halaman utama</button></a>
</div>
<br>