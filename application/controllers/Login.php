<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Modelku');
	}
	
	public function index()
	{	
		$notif = $this->session->flashdata('notif');
		$this->Modelku->notif($notif);
		$user = $this->session->userdata('statusUser');
		if (!empty($user)) {
			if ($user == 2) {
				# code...
				redirect(base_url("index.php/beranda"));	
			}else{
				redirect(base_url("index.php/userBeranda"));	
			}
		}
		if (isset($_POST['username'])) {
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$query = "SELECT * from admin where username = '$user' and password = '$pass'";
			$hasil = $this->db->query($query);
			$cek = $hasil->num_rows();
			if ($cek) {
				if ($hasil->row()->status == 2) {
					$this->session->set_userdata('idUser', $hasil->row()->id_admin);
					$this->session->set_userdata('statusUser', 'admin');
					$this->session->set_flashdata('notif', '1');
					redirect(base_url("index.php/beranda"));
				}else{
						$this->session->set_userdata('idUser', $hasil->row()->id_admin);
						$this->session->set_userdata('statusUser', 'user');
						$this->session->set_flashdata('notif', '1');
						redirect(base_url("index.php/userBeranda"));
				}
			}else{
				$this->session->set_flashdata('notif', '2');
				redirect(base_url("index.php/login"));
			}
			
		}else{
			$this->load->view('admin/login');
		}
	}
	public function keluar(){
		session_destroy();
		redirect(base_url("index.php/login"));
	}
	public function daftar(){
		$this->load->view('admin/daftar');
	}
	public function prosesDaftar(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$query = $this->db->query("INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `status`) VALUES (NULL, '$nama', '$username', '$pass', '1')");
		$this->session->set_flashdata('notif', '1');
		redirect(base_url("index.php/login"));
	}
}
