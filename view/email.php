<?php
    $title = "Email";
?>

<h1>Email</h1>
<table>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIK</th>
	  <th>Foto KTP</th>
    <th>Pekerjaan</th>
    <th>No. HP</th>
	  <th>Email</th>
	  <th>Tanggal Vaksinasi</th>
    <th>Isi Email</th>
  </tr>
  <?php
    $i = 1;
    foreach ($result as $key => $row) {
      echo "<tr>";
      echo "<td>".$i."</td>";
      echo "<td>".$row->getNama()."</td>";
      echo "<td>".$row->getNIK()."</td>";
      echo "<td><button id='modalButton$i' onclick='"."showModal($i)"."'>Cek KTP</button>
      <div id='modal$i' class='modal'>
        <div class='modal-content'>
          <span id='close$i' class='close'>&times;</span>";
            $img = file_get_contents($row->getfotoKTP());
            $img_src= 'data:image/jpg;base64,'.base64_encode($img);

            echo "<img src=$img_src width=700px>
        </div>
      </div>
      </td>";

      echo "<td>".$row->getPekerjaan()."</td>";
      echo "<td>".$row->getNoHP()."</td>";
      echo "<td>".$row->getEmail()."</td>";
      echo "<td>".$row->getAwalVaksinasi() . " sampai " . $row->getAkhirVaksinasi() . "</td>";
      echo "<td>
      <form method=GET action=".route('/daftar/hasil').">
        <input type=hidden name=idDaftar value='".$row->getIdDaftar()."'/>
        <input type=hidden name=idPenduduk value='".$row->getIdPenduduk()."'/>
        <button type=submit>Hasil Pendaftaran</button>
      </form>
      </td>";
      echo "</tr>";
      $i++;
    }
	?>
</table>
<br>
<script>
  function showModal(index){
    // Get the modal
    var modal = document.getElementById("modal"+index);

    // Get the button that opens the modal
    var btn = document.getElementById("modalButton"+index);

    // Get the <span> element that closes the modal
    var span = document.getElementById("close"+index);

    // When the user clicks on the button, open the modal
    modal.style.display = "block";

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }
</script>