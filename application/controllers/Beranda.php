<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

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
		 $tahun = $this->db->query("SELECT DISTINCT tahun FROM nilai_kriteria ORDER BY tahun ASC")->result();
		$data = array(
			'menu' => 'beranda',
			'dataTahun' => $tahun
		);

		$this->load->view('admin/header', $data);
		$this->load->view('admin/beranda');
		$this->load->view('admin/footer');
		// $this->session->unset_userdata('idUser');

	}
}
