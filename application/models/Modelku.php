<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelku extends CI_Model {

	public function cekLogin(){
		$user = $this->session->userdata('idUser');
		if (empty($user)) {
			redirect(base_url("index.php/login"));
		}
	}

	public function notif($a){
		if ($a == 1) {
		echo "<script type='text/javascript'>
			    alert('Berhasil');
			</script>";

		}else if($a == 2){
			echo "<script type='text/javascript'>
			    alert('Gagal');
			</script>";
		}else{

		}
	}

	public function addData($tabel,$field,$value,$redirect){
		$query = "INSERT INTO `$tabel` ($field) VALUES ($value)";
		$hasil = $this->db->query($query);
		if ($hasil) {
			$this->session->set_flashdata('notif', '1');
			redirect(base_url("index.php/$redirect"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/$redirect"));
		}		
	}

	public function updateData($tabel,$data,$redirect){
		$hasil = $this->db->replace($tabel, $data);
		if ($hasil) {
			$this->session->set_flashdata('notif', '1');
			redirect(base_url("index.php/$redirect"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/$redirect"));
		}		
	}

	public function deleteData($tabel,$field,$value,$redirect){
		$this->db->where($field, $value);
		$hasil = $this->db->delete($tabel);
		if ($hasil) {
			$this->session->set_flashdata('notif', '1');
			redirect(base_url("index.php/$redirect"));
		}else{
			$this->session->set_flashdata('notif', '2');
			redirect(base_url("index.php/$redirect"));
		}		
	}
	
	
}