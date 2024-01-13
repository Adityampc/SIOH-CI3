<html>

<head>
	<meta charset="UTF-8">
	<title>Orang Hilang - SIOH</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url() ?>/css/style.css">
	<link rel="shortcut icon" href="<?= base_url() ?>/images/favicon.png" type="image/png">
</head>

<body>
	<div class="container">
		<div class="header">
			<h1 align="center">Sistem Informasi Orang Hilang</h1>
		</div>
		<div class="main">
			<div class="left">
				<h3 align="center">Menu</h3>
				<ul>
					<li> <label>Cari Disini</label> <input placeholder="Cari Orang" type="text" oninput="load_middle_content(<?= base_url() ?>'/all?query='+this.value)" id="query">&nbsp;</li>
					<li><a href="javascript:void(0)" onclick="load_middle_content('<?= base_url('all') ?>')">Berita</a></li>
					<li><a href="javascript:void(0)" onclick="load_middle_content('<?= base_url('report') ?>')">Buat Laporan</a></li>
					<?php if (loggedIn()) : ?>
						<li><a href="<?= base_url('logout') ?>">Keluar</a></li>
					<?php else : ?>
						<li><a href="<?= base_url('login') ?>">Masuk</a></li>
					<?php endif ?>
				</ul>
			</div>
			<div id="middle-content" class="middle">
			</div>
			<div class="right">
				<h3 align="center">Laporan Terbaru</h3>
				<ul id="new-report">
				</ul>
			</div>
		</div>
		<div class="footer">
			<p align="center">Copyright &copy; <?= date('Y') ?> Adityampc</p>
		</div>
	</div>
	<script>
		var base_url = '<?= base_url() ?>';
	</script>
	<script src="js/script.js"></script>
</body>

</html>
