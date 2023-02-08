<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
		$this->load->model('Dataku');
	}

	public function index(){
		$notif = $this->session->flashdata('notif');
		$this->Modelku->notif($notif);
		$this->Modelku->cekLogin();
		$dataSaham = $this->Dataku->saham();
		$dataKriteria = $this->Dataku->kriteria();
		
		// cek tahun
		if (isset($_POST['tahuncari'])) {
			$tahun = $_POST['tahuncari'];
		}else{
			$tahun = 2018;
		}

		$queryCek = "select DISTINCT nilai_kriteria.id_saham, saham.kode_saham FROM nilai_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where tahun = $tahun order by id_nilai DESC";
		 $hasilCek = $this->db->query($queryCek)->result();
		
		$cekData = "select id_kriteria from nilai_kriteria where tahun = $tahun";
		$hasilData = $this->db->query($cekData)->num_rows();

		$matriks = "select saham.id_saham, saham.kode_saham, kriteria.id_kriteria, kriteria.nama_kriteria, nilai_kriteria.nilai_kriteria, nilai_kriteria.tahun FROM nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where nilai_kriteria.tahun = $tahun";
		$dataMatriks =$this->db->query($matriks)->result();
		$hasilTerbaik = $this->Dataku->sahamTerbaik($tahun);
		

		//hitungkendal 
		//standar
		$tahun1 = 2018;
		$tahun2 = 2019;

		if (isset($_GET['tahun1'])) {
			if ($_GET['tahun1'] < $_GET['tahun2']) {
				$tahun1 = $_GET['tahun1'];
				$tahun2 = $_GET['tahun2'];
			}else{
				$tahun1 = $_GET['tahun2'];
				$tahun2 = $_GET['tahun1'];
			}
		}
		$pengulangan = 45;


		//query data ke array
		$query1 = $this->db->query("SELECT * FROM `hasil` WHERE tahun = $tahun1 order by nilai_preferensi desc");
		$query2 = $this->db->query("SELECT * FROM `hasil` WHERE tahun = $tahun2 order by nilai_preferensi desc");

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

		 if (isset($_GET['tahun1'])) {
		 	if ($_GET['tahun1'] == $_GET['tahun2']) {
		 		
				$hasil_kendal = "Silahkan masukkan data tahun yang berbeda";
		 	}else{
		 		$hasil_kendal = "<p>Hasil dari pengujian kendal menggunakan data saham <b> tahun ".$tahun1."</b> dan data saham <b>tahun ".$tahun2." </b> dengan menggunakan jumlah data <b>".$pengulangan."</b> menghasilkan nilai tidak kemiripan <b>".round($hitung, 2)."%</b>.</p>";
		 	}
		}else{
			$hasil_kendal = "<p>Hasil dari pengujian kendal menggunakan data saham <b> tahun ".$tahun1."</b> dan data saham <b>tahun ".$tahun2." </b> dengan menggunakan jumlah data <b>".$pengulangan."</b> menghasilkan nilai tidak kemiripan <b>".round($hitung, 2)."%</b>.</p>";		
		}


		 $data = array(
			'menu'         => 'hasil',
			'dataSaham'    => $dataSaham,
			'dataKriteria' => $dataKriteria,
			'dataMatriks' => $dataMatriks,
			'sahamTerbaik' => $hasilTerbaik,
			'hasilData' => $hasilData,
			'hasilCek' => $hasilCek,
			'tahun' => $tahun,
			'hasilKendal' => $hasil_kendal
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/hasil');
		$this->load->view('admin/footer');
	}

	public function prosesData(){
	
		$tahun = $this->input->post('tahunproses');
		$queryTahunProses = "select distinct tahun from hasil where tahun = $tahun";
	    $hasilTahunProses = $this->db->query($queryTahunProses)->num_rows();
	    if ($hasilTahunProses) {
	    	$this->session->set_flashdata('notif', '2');
	    	redirect(base_url("index.php/hasil"));
	    }else{

	    $dataSaham = $this->Dataku->saham();
		$dataKriteria = $this->Dataku->kriteria();

	    $cekData = "select id_kriteria from nilai_kriteria where tahun = $tahun";
	    $hasilData = $this->db->query($cekData)->num_rows();
	    $dataKriteria = $this->Dataku->kriteria();
		$dataSaham = $this->Dataku->saham();
		$jmlKeriteria =  count($dataKriteria);
		$no=1;
		$total = 0;
		$queryCek = "select DISTINCT nilai_kriteria.id_saham, saham.kode_saham FROM nilai_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where tahun = $tahun order by id_nilai DESC";
		 $hasilCek = $this->db->query($queryCek)->result();
		foreach ($hasilCek as $key) {
		echo "<tr>";
		echo "<td>".$no."</td>";
		echo "<td>".$key->kode_saham."</td>";
		for ($i=1; $i <= $jmlKeriteria; $i++) {

			$query1 = "select nilai_kriteria.nilai_kriteria,  kriteria.id_kriteria FROM nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where saham.id_saham = ".$key->id_saham." AND kriteria.id_kriteria = ".$i." and nilai_kriteria.tahun = ".$tahun;
			$hasil1 = $this->db->query($query1)->row(); 
			$hasil = $this->Dataku->bobot($hasil1->id_kriteria,$hasil1->nilai_kriteria);
			$total=$total+$hasil;
		}
		$ttl = round($total,3);
		$queryTambah = "INSERT INTO `hasil` (id_saham, tahun, nilai_preferensi) VALUES ($key->id_saham, $tahun, $ttl)";
		$hasilTambah = $this->db->query($queryTambah);
		$total = 0;
		$no++;
		}
		$this->session->set_flashdata('notif', '1');
		redirect(base_url("index.php/hasil"));	
		}
	}

}

