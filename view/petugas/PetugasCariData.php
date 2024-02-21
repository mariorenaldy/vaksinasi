<h1 style = "margin-top : 0px;"></h1>
<?php
$title = "Petugas Cari Data";
date_default_timezone_set("Asia/Jakarta");
?>

<script type="text/javascript">
	function date_time(id){
		date = new Date;
		year = date.getFullYear();
		month = date.getMonth();
		months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
		d = date.getDate();
		day = date.getDay();
		days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		h = date.getHours();
		if(h<10){
			h = "0"+h;
		}
		m = date.getMinutes();
		if(m<10){
			m = "0"+m;
		}
		s = date.getSeconds();
		if(s<10)
		{
		s = "0"+s;
		}
		result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
		document.getElementById(id).innerHTML = result;
		setTimeout('date_time("'+id+'");','1000');
		return true;
	}
</script>
 	<span id="date_time"></span>
<script type="text/javascript">
	window.onload = date_time('date_time');
</script>
<form method="GET" action="<?php echo route("/petugas/cari-orang-vaksin"); ?>">
		<fieldset>
			<legend>Search by NIK</legend>
			<input type="text" name="filter" value="">
			<input type="submit" value="SEARCH">
		</fieldset>
	</form>
<table>
		<tr>
			<th>Nama</th>
			<th>NIK</th>
			<th>Pekerjaan</th>
            <th>Status Vaksinasi</th>
            <th>Input Data Kesehatan</th>
		</tr>
		<?php
			foreach ($result as $key => $row) {
				$id=$row->getidPenduduk();
				$nama=$row->getnama();
				$pekerjaan=$row->getpekerjaan();
				$jmlVaksin=$row->getjumlahVaksin();
				$NIK=$row->getNIK();
				echo "<tr>";
				echo "<td>".$nama."</td>";
				echo "<td>".$NIK."</td>";
				echo "<td>".$pekerjaan."</td>";					
				echo "<td>vaksin ke-".($jmlVaksin+1)."</td>";
				echo '<td><form method="GET" action="'.route("/petugas/input-data-kesehatan").'"><button type="submit" name="vaksin" value="'.$id.'">input</button></form></td>';
              
				echo "</tr>";
			}
		?>
	</table>
