<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
	}
	
	public function index()
	{
		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$query = "select * from kriteria";
		$hasil= $this->db->query($query)->result();

		$data = array(
			'menu' => 'kriteria',
			'dataKriteria' => $hasil
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/kriteria');
		$this->load->view('admin/footer');
	}

	public function tambahKriteria()
	{
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$keterangan = $this->input->post('keterangan');
		$tabel = "kriteria";
		$field = "nama_kriteria, bobot_kriteria, keterangan";
		$value = "'$nama', '$bobot','$keterangan'";
		$this->Modelku->addData($tabel,$field,$value,"kriteria");

	}

	public function deleteKriteria()
	{
		$id = $this->input->get('id');
		$this->Modelku->deleteData('kriteria', 'id_kriteria', $id, 'kriteria');
	}

	public function ubahKriteria()
	{
		$notif = $this->session->flashdata('notif');
		$this->Modelku->cekLogin();
		$this->Modelku->notif($notif);
		$query = "select * from kriteria";
		$hasil= $this->db->query($query)->result();
		$nama = $this->input->get('nama');
		$id = $this->input->get('id');
		$bobot = $this->input->get('bobot');
		$keterangan = $this->input->get('keterangan');
		$data = array(
			'menu' => 'kriteria',
			'dataKriteria' => $hasil,
			'op' => 'update',
			'nama' => $nama,
			'id' => $id,
			'bobot' => $bobot,
			'keterangan' => $keterangan
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/kriteria');
		$this->load->view('admin/footer');
	}

	public function updateKriteria()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$keterangan = $this->input->post('keterangan');
		$tabel = "kriteria";
		$data = array(
			'id_kriteria' => $id,
			'nama_kriteria' => $nama,
			'bobot_kriteria' => $bobot,
			'keterangan' => $keterangan
		);
		$this->Modelku->updateData($tabel,$data,"kriteria");

	}


}

