<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserBeranda extends CI_Controller {

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
		
		$data = array(
			'menu' => 'beranda'
		);

		$this->load->view('user/header', $data);
		$this->load->view('user/beranda');
		$this->load->view('user/footer');
	}
	public function saham(){
		$notif = $this->session->flashdata('notif');
		$nama = $this->input->post('pencarian');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		
		if (isset($nama) == "") {
			$query = "select * from saham";
			$hasil= $this->db->query($query)->result();
		}else{
			$query  = "select * from saham where kode_saham LIKE '%$nama%' ";
			$hasil= $this->db->query($query)->result();
		}

		$data = array(
			'menu' => 'saham',
			'dataSaham' => $hasil
		);

		$this->load->view('user/header', $data);
		$this->load->view('user/saham');
		$this->load->view('user/footer');
	}

	public function kriteria(){
		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$query = "select * from kriteria";
		$hasil= $this->db->query($query)->result();

		$data = array(
			'menu' => 'kriteria',
			'dataKriteria' => $hasil
		);

		$this->load->view('user/header', $data);
		$this->load->view('user/kriteria');
		$this->load->view('user/footer');
	}

	public function penilaian(){
		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$query = "select nilai_kriteria.id_nilai, nilai_kriteria.id_saham, nilai_kriteria.id_kriteria, nilai_kriteria.nilai_kriteria, nilai_kriteria.tahun, saham.kode_saham, kriteria.nama_kriteria from nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham ON saham.id_saham = nilai_kriteria.id_saham order by nilai_kriteria.id_nilai DESC";
		$hasil= $this->db->query($query)->result();
		$saham = $this->Dataku->saham();
		$kriteria = $this->Dataku->kriteria();
		$data = array(
			'menu' => 'penilaian',
			'dataPenilaian' => $hasil,
			'saham' => $saham,
			'kriteria' => $kriteria
		);

		$this->load->view('user/header', $data);
		$this->load->view('user/penilaian');
		$this->load->view('user/footer');
	}
	public function hasil()
	{
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
		$data = array(
			'menu'         => 'hasil',
			'dataSaham'    => $dataSaham,
			'dataKriteria' => $dataKriteria,
			'dataMatriks' => $dataMatriks,
			'sahamTerbaik' => $hasilTerbaik,
			'hasilData' => $hasilData,
			'hasilCek' => $hasilCek,
			'tahun' => $tahun
		);

		$this->load->view('user/header', $data);
		$this->load->view('user/hasil');
		$this->load->view('user/footer');
	}
}