<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataku extends CI_Model {

	public function saham(){
		$query = "select * from saham ORDER BY id_saham ASC";
		return $this->db->query($query)->result();
	}

	public function kriteria(){
		$query = "select * from kriteria ORDER BY id_kriteria ASC";
		return $this->db->query($query)->result();
	}

	public function sahamTerbaik($tahun){
		$queryTerbaik = "SELECT saham.kode_saham, hasil.nilai_preferensi from hasil INNER JOIN saham on saham.id_saham = hasil.id_saham WHERE hasil.tahun = $tahun ORDER BY hasil.nilai_preferensi DESC limit 5";
		return $this->db->query($queryTerbaik);
	}

	public function tabelKecocokan($id, $nilai){
		//EPS
		if ($id == 1) {
				if ($nilai <= 4) {
					$hasil = 1;
				}else if ($nilai <= 15){
					$hasil = 2;
				}else{
					$hasil = 3;
				}
			}
			//PER
			else if ($id == 2) {
				if ($nilai > 20) {
					$hasil = 1;
				}else if ($nilai > 15){
					$hasil = 2;
				}else{
					$hasil = 3;
				}
			}
			//PBV
			else if ($id == 3) {
				if ($nilai > 2) {
					$hasil = 1;
				}else if ($nilai > 1){
					$hasil = 2;
				}else{
					$hasil = 3;
				}
			}
			//DER
			else if ($id == 4) {
				if ($nilai < 1) {
					$hasil = 3;
				}else{
					$hasil = 1;
				}
			}
			//ROE
			else if ($id == 5) {
				if ($nilai <= 10) {
					$hasil = 1;
				}else if ($nilai <= 30){
					$hasil = 2;
				}else{
					$hasil = 3;
				}
			}

			return $hasil;

	}
	public function normalisasi($id, $nilai){
		//EPS
		if ($id == 1) {
				if ($nilai <= 4) {
					$hasil = 1/3;
				}else if ($nilai <= 15){
					$hasil = 2/3;
				}else{
					$hasil = 3/3;
				}
			}
			//PER
			else if ($id == 2) {
				if ($nilai > 20) {
					$hasil = 1/1;
				}else if ($nilai > 15){
					$hasil = 1/2;
				}else{
					$hasil = 1/3;
				}
			}
			//PBV
			else if ($id == 3) {
				if ($nilai > 2) {
					$hasil = 1/1;
				}else if ($nilai > 1){
					$hasil = 1/2;
				}else{
					$hasil = 1/3;
				}
			}
			//DER
			else if ($id == 4) {
				if ($nilai < 1) {
					$hasil = 1/3;
				}else{
					$hasil = 1/1;
				}
			}
			//ROE
			else if ($id == 5) {
				if ($nilai <= 10) {
					$hasil = 1/3;
				}else if ($nilai <= 30){
					$hasil = 2/3;
				}else{
					$hasil = 3/3;
				}
			}

			return $hasil;

	}

	public function bobot($id, $nilai){
		//EPS
		if ($id == 1) {
				if ($nilai <= 4) {
					$hasil = 1/3*0.15;
				}else if ($nilai <= 15){
					$hasil = 2/3*0.15;
				}else{
					$hasil = 3/3*0.15;
				}
			}
			//PER
			else if ($id == 2) {
				if ($nilai > 20) {
					$hasil = 1/1*0.25;
				}else if ($nilai > 15){
					$hasil = 1/2*0.25;
				}else{
					$hasil = 1/3*0.25;
				}
			}
			//PBV
			else if ($id == 3) {
				if ($nilai > 2) {
					$hasil = 1/1*0.22;
				}else if ($nilai > 1){
					$hasil = 1/2*0.22;
				}else{
					$hasil = 1/3*0.22;
				}
			}
			//DER
			else if ($id == 4) {
				if ($nilai < 1) {
					$hasil = 1/3*0.18;
				}else{
					$hasil = 1/1*0.18;
				}
			}
			//ROE
			else if ($id == 5) {
				if ($nilai <= 10) {
					$hasil = 1/3*0.20;
				}else if ($nilai <= 30){
					$hasil = 2/3*0.20;
				}else{
					$hasil = 3/3*0.20;
				}
			}

			return $hasil;

	}



}