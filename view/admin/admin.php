<?php
    $title = "Page Admin";
?>
<h1 style="margin-top:0px;">Admin</h1>

<a href="<?php echo route("/admin/buat-pendaftaran"); ?>" class=linkButton> <button id=adminButton>Buat Pendaftaran Baru</button> </a>
<br>

<span id=listAdmin>List Form Pendaftaran:</span>
<br>

<table>
  <tr>
    <th>No</th>
    <th>Tahap</th>
    <th>Awal Pendaftaran</th>
    <th>Akhir Pendaftaran</th>
    <th>Awal Vaksinasi</th>
    <th>Akhir Vaksinasi</th>
    <th>Hasil Pendaftaran Penduduk</th>
  </tr>
  <?php
        $i = 1;
		foreach ($result as $key => $row) {
			echo "<tr>";
            echo "<td>".$i."</td>";
			echo "<td>".$row->getTahap()."</td>";
            echo "<td>".$row->getAwalPendaftaran()."</td>";
			echo "<td>".$row->getAkhirPendaftaran()."</td>";
            echo "<td>".$row->getAwalVaksinasi()."</td>";
            echo "<td>".$row->getAkhirVaksinasi()."</td>";
            echo "<td>
                <button onclick='
                window.location.href = \"".route("/admin/list-hasil-pendaftaran?idDaftar=".$row->getIdDaftar())."\";'
                >
                    Cek Hasil
                </button>
            </td>
			</tr>";
            $i++;
		}
	?>
</table>
<br>