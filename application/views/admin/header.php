<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="utf-8">
	<title>APLIKASI SPK SAHAM</title>
</head>
<body>

<div class="container">
	<h1 class="text-center">APLIKASI SPK SAHAM</h1>
	<ul class="nav justify-content-center bg-custom">
	  <li class="nav-item">
	    <a class="nav-link <?php if($menu=="beranda"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" aria-current="page" href="<?php echo base_url(); ?>index.php/beranda/">Beranda</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if($menu=="saham"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" href="<?php echo base_url(); ?>index.php/saham/">Saham</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link <?php if($menu=="kriteria"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" href="<?php echo base_url(); ?>index.php/kriteria/">Kriteria</a>
	  </li>
	  <li class="nav-item btn-custom">
	    <a class="nav-link <?php if($menu=="penilaian"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" href="<?php echo base_url(); ?>index.php/penilaian/">Penilaian</a>
	  </li>
	  <li class="nav-item btn-custom" >
	    <a class="nav-link <?php if($menu=="hasil"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" href="<?php echo base_url(); ?>index.php/hasil/">Hasil</a>
	  </li>
	  <li class="nav-item btn-custom" >
	    <a class="nav-link <?php if($menu=="Keluar"){echo "active-custom btn-custom";}else{echo "btn-custom";} ?>" href="<?php echo base_url(); ?>index.php/login/keluar">Keluar</a>
	  </li>
	</ul>
	
	