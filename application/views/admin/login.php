<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	 <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	  <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
	<meta charset="utf-8">
	<title>SPK SAHAM</title>
</head>
<body>

<div id="container">
	<h3 class="d-flex justify-content-center" style="margin-top: 20px;"></h3>
	<div class="d-flex justify-content-center" style="margin-top: 40px;">
	<div class="col-md-6">
		<img style="height: 400px" src="<?php echo base_url('assets/gambar/grafik.webp');?>">
	</div>
	<div class="col-md-6">
		<h3 style="margin-left: 100px">APLIKASI SPK SAHAM</h3>
		<div class="card" style="width: 30rem;">
		<div class="card-header bg-custom">
			<h5 class="card-title text-center">LOGIN</h5>
		</div>
		  <div class="card-body">
		   <form method="POST" action="<?php echo base_url(); ?>index.php/login/">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Username</label>
			    <input type="username" class="form-control" id="username" name="username" aria-describedby="username" placeholder="masukkan username" required>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password" required>
			  </div>
			  <button type="submit" class="btn btn-custom">Masuk</button>
			<a type="submit" href="<?php echo base_url('index.php/login/daftar');?>" class="btn btn-warning">Daftar</a>
			</form>
		  </div>
	</div>	
	</div>
	
	

</div>
</div>
</body>
</html>
