<!DOCTYPE html>
<html>
<head>
    <title> <?php echo $title;?> </title>
    <link rel="stylesheet" href="<?php echo asset("view/css/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("view/css/alma.css"); ?>">
</head>
<body>
    <div id="navigasi" style = "border-bottom : 1px solid black;">
		<div>
            <div class="kiri"><a href="https://covid19.go.id/"><img src="<?php echo asset("view/img/logo-kpcpen.png"); ?>" height="50"></a></div>
            <div class="kiri"><a href="https://covid19.go.id/"><img src="<?php echo asset("view/img/logo-satgas.png"); ?>" height="50"></a></div>
			<div class="kanan"><a style="text-decoration : none;" href="<?php echo route("/"); ?>">Beranda</a></div>
            <div class="kanan" ><a style="text-decoration : none;" href="https://covid19.go.id/vaksin-covid19" target="_blank" rel="noopener noreferrer">Info Vaksin</a></div>
		</div>
	</div>
    <?php echo $content; ?>
</body>
</html>