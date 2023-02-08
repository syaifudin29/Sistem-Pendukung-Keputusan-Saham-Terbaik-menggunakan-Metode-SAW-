<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saham extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
		$this->load->model('Dataku');
	}
	
	public function index()
	{
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

		$this->load->view('admin/header', $data);
		$this->load->view('admin/saham');
		$this->load->view('admin/footer');
	}

	public function tambahSaham()
	{
		$nama = $this->input->post('nama');
		$idUser = $this->session->userdata('idUser');
		$kode = $this->input->post('kode');
		$tabel = "saham";
		$field = "kode_saham, nama_saham, id_admin";
		$value = "'$kode', '$nama', '$idUser'";
		$this->Modelku->addData($tabel,$field,$value,"saham");

	}

	public function deleteSaham()
	{
		$id = $this->input->get('id');
		$this->Modelku->deleteData('saham', 'id_saham', $id, 'saham');
	}

	public function ubahSaham()
	{
		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$hasil = $this->Dataku->saham();
		$id = $this->input->get('id');
		$querySaham = "select * from saham where id_saham = $id";
		$hasilSaham = $this->db->query($querySaham)->row();
		$data = array(
			'menu' => 'saham',
			'dataSaham' => $hasil,
			'op' => 'update',
			'nama' => $hasilSaham->nama_saham,
			'kode' => $hasilSaham->kode_saham,
			'id' => $id,
			'kode'
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/saham');
		$this->load->view('admin/footer');
	}

	public function updateSaham()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$kode = $this->input->post('kode');
		$tabel = "saham";
		$data = array(
			'id_saham' => $id,
			'nama_saham' => $nama,
			'kode_saham' => $kode
		);
		$this->Modelku->updateData($tabel,$data,"saham");

	}


}

