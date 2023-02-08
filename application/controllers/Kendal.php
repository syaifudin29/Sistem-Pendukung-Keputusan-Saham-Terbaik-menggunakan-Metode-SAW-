<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendal extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
	}
	
	public function index()
	{
		$tahun1 = 2018;
		$tahun2 = 2019;
		$pengulangan = 10;



		//query data ke array
		$query1 = $this->db->query("SELECT * FROM `hasil` WHERE tahun = 2018 order by nilai_preferensi asc");
		$query2 = $this->db->query("SELECT * FROM `hasil` WHERE tahun = 2019 order by nilai_preferensi asc");

		//menambahkan data ke array 2 data
		$no =1;
		$dat1=[];
		$dat2=[];

		//data ke dat1
		foreach ($query1->result() as $key) {
		 	$dat1[$no]=$key->id_saham;
		 	$no++;
		 } 
		 // data ke dat2
		 $no=1;
		foreach ($query2->result() as $key) {
		 	$dat2[$no]=$key->id_saham;
		 	$no++;
		 } 

		 //hitung kendal
		 $jumlah = 0;
		 for ($i=1; $i <= $pengulangan ; $i++) { 
		 	for ($k=($i+1); $k <= $pengulangan ; $k++) { 
		 		if ($dat1[$i] == $dat2[$k]) {
		 			$jumlah=$jumlah+1;
		 		}
		 	}
		 }
		 //jumlah nilai uji kendal
		 $hitung = ($jumlah/($pengulangan*($pengulangan-1)/2))*100;
		 echo round($hitung, 2)."%";
		 


	}
}
