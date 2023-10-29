<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Masuk</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class="container">

		<div class="card my-5">
			<div class="card-header text-center">
				<h1>Masuk</h1>
			</div>
			<div class="card-body">
				<form action="<?= base_url('login') ?>" method="post">
					<?php if ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger" role="alert">
							<?= $this->session->flashdata('error') ?>
						</div>
					<?php endif ?>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<?= $this->session->flashdata('success') ?>
						</div>
					<?php endif ?>
					<div class="form-group">
						<label for="username">Username:</label>
						<?php echo form_error('username', '<div class="text-danger" >', '</div>'); ?>
						<input required id="username" name="username" value="<?= set_value('username'); ?>" type="text" class="form-control" placeholder="Username">
					</div>
					<br>
					<div class="form-group">
						<label for="password">Password:</label>
						<?php echo form_error('password', '<div class="text-danger" >', '</div>'); ?>
						<input required id="password" name="password" value="<?= set_value('password'); ?>" type="password" class="form-control" placeholder="Password">
					</div>
					<br>
					<button class="btn btn-primary w-100">Masuk</button>
					<br>
					<br>
					<div class="text-center">
						<a href="<?= base_url('register') ?>" title="Daftar">Daftar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>