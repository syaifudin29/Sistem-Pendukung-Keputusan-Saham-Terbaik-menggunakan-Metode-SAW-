<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
		$this->load->model('Dataku');
	}
	
	public function index()
	{

		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$query = "select nilai_kriteria.id_nilai,nilai_kriteria.date_create, nilai_kriteria.id_saham, nilai_kriteria.id_kriteria, nilai_kriteria.nilai_kriteria, nilai_kriteria.tahun, saham.kode_saham, kriteria.nama_kriteria from nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham ON saham.id_saham = nilai_kriteria.id_saham order by nilai_kriteria.id_nilai DESC";
		$hasil= $this->db->query($query)->result();
		$saham = $this->Dataku->saham();
		$kriteria = $this->Dataku->kriteria();
		$data = array(
			'menu' => 'penilaian',
			'dataPenilaian' => $hasil,
			'saham' => $saham,
			'kriteria' => $kriteria
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/penilaian');
		$this->load->view('admin/footer');
	}

	public function tambahPenilaian()
	{
		// menerima input post
		$saham = $this->input->post('saham');
		$tahun = $this->input->post('tahun');
		$tggl = date('Y-m-d');

		$queryCek = "select id_nilai from nilai_kriteria WHERE id_saham = $saham AND tahun = $tahun";
		$hasilCek = $this->db->query($queryCek)->num_rows();
		if ($hasilCek != 0) {
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/penilaian"));
		}

		$kriteria = $this->Dataku->kriteria();
		$queryKriteria = "select id_kriteria from kriteria ";
		$hasilKriteria = $this->db->query($queryKriteria)->num_rows();
		foreach ($kriteria as $key ) {
			$nilai_kriteria = $this->input->post($key->nama_kriteria);
			$idUser = $this->session->userdata('idUser');
			$tabel = "nilai_kriteria";
			$field = "id_saham, id_kriteria, nilai_kriteria, tahun, id_admin, date_create";
			$value = "'$saham','$key->id_kriteria','$nilai_kriteria','$tahun', '$idUser', '$tggl'";
			$query = "INSERT INTO `$tabel` ($field) VALUES ($value)";
			$hasil = $this->db->query($query);
		}
		if ($hasil) {
			redirect(base_url("index.php/penilaian/prosesData?tahun=$tahun"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/penilaian"));
		}

	}

	public function deletePenilaian()
	{
		$id = $this->input->get('id');
		$tahun = $this->input->get('tahun');
		$query = "DELETE FROM `nilai_kriteria` WHERE `id_saham` = $id AND tahun = $tahun";
		$hasil = $this->db->query($query);
		if ($hasil) {
			redirect(base_url("index.php/penilaian/prosesData?tahun=$tahun&act=delete"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/penilaian"));
		}	
	}

	public function ubahPenilaian()
	{

		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$id_saham = $this->input->get('id');
		$thn = $this->input->get('tahun');

		$query = "select nilai_kriteria.id_nilai, nilai_kriteria.id_saham, nilai_kriteria.id_kriteria, nilai_kriteria.nilai_kriteria, nilai_kriteria.tahun, saham.kode_saham, kriteria.nama_kriteria from nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham ON saham.id_saham = nilai_kriteria.id_saham order by nilai_kriteria.id_nilai DESC";
		$hasil= $this->db->query($query)->result();
		$saham = $this->Dataku->saham();
		$kriteria = $this->Dataku->kriteria();
		$data = array(
			'menu' => 'penilaian',
			'dataPenilaian' => $hasil,
			'saham' => $saham,
			'kriteria' => $kriteria,
			'op' => 'update',
			'id_saham' => $id_saham,
			'thn' => $thn
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/penilaian');
		$this->load->view('admin/footer');
	}

	public function updatePenilaian()
	{
		// menerima input post
		$saham = $this->input->post('saham');
		$tahun = $this->input->post('tahun');
		$tggl = date('Y-m-d');

		$kriteria = $this->Dataku->kriteria();
		$queryKriteria = "select id_kriteria from kriteria ";
		$hasilKriteria = $this->db->query($queryKriteria)->num_rows();
		foreach ($kriteria as $key ) {
			$nilai_kriteria = $this->input->post($key->nama_kriteria);
			$idUser = $this->session->userdata('idUser');
			
			$query = "UPDATE nilai_kriteria SET nilai_kriteria = $nilai_kriteria, date_create = '$tggl' WHERE id_saham = $saham AND tahun = $tahun AND id_kriteria = $key->id_kriteria";
			$hasil = $this->db->query($query);
		}
		if ($hasil) {
			redirect(base_url("index.php/penilaian/prosesData?tahun=$tahun"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/penilaian"));
		}

	}

	public function prosesData(){
		$tahun = $this->input->get('tahun');
		$act = $this->input->get('act');
		$this->db->query("DELETE FROM `hasil` WHERE tahun = $tahun");
		
		// $queryTahunProses = "SELECT DISTINCT tahun FROM `hasil` where tahun = $tahun";
	 //    $hasilTahunProses = $this->db->query($queryTahunProses)->num_rows();
	 //    print_r($hasilTahunProses);
	 //    if ($hasilTahunProses != 0) {
	 //    	$this->session->set_flashdata('notif', '2');
	 //    	redirect(base_url("index.php/penilaian"));
	 //    }else{

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
		redirect(base_url("index.php/penilaian"));	
		
	}



}

