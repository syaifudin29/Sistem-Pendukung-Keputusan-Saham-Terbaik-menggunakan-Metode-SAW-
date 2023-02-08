<div class="content">
	<div class="row">
		<div class="col-md-6">
		<h3>Selamat datang Admin</h3>
	<img class="img-fluid" alt="Responsive image" style="margin-bottom: 10px;" src="<?php echo base_url('assets/gambar/saham.jpg');?>">
	<h6 style="width: 60%; color: #636363;">Aplikasi Sistem Pendukung Keputusan dalam menentukan saham yang terbaik untuk investasi kedepannya. Aplikasi ini menggunakan metode SAW dalam perhitungannya.</h6>
	<br>
	<h3>Tips sukses Investasi untu Pemula</h3>
	<h6>1.Baca laporan keuangan saham yang ingin dibeli</h6>
	<p>Tips investasi saham yang pertama ala Lo Kheng Hong adalah membaca laporan keuangan. Menurut Lo Kheng Hong, tidak ada alasan investor atau trader tak membaca laporan keuangan</p>
	<h6>2.Sabar menanti hasil yang terbaik</h6>
	<p>Tips investasi saham yang kedua ala Lo Kheng Hong adalah sabar. Tidak ada yang instan untuk mendapatkan hasil yang terbaik. Ini dibuktikan Lo Kheng Hong ketika pertama kali terjun berinvestasi.</p>
	<h6>3.Beli saham yang bidang usahanya baik</h6>
	<p>Tips investasi saham yang ketiga ala Lo Kheng Hong adalah membeli saham dengan bidang usaha baik. Memilih emiten sebenarnya tidak sulit menurut Lo Kheng Hong, investor hanya perlu mencari industri yang dapat bertahan dalam berbagai kondisi ekonomi.</p>
	<h6>4.Pilih perusahaan yang untung</h6>
	<p>Tips investasi saham yang keempat ala Lo Kheng Hong adalah membeli saham dari perusahaan yang selalu untung. Lo Kheng Hong juga mengatakan, dirinya sangat anti membeli perusahaan yang rugi.</p>
	<h6>5.Track record pimpinan perusahaan yang baik</h6>
	<p>Tips investasi saham yang kelima ala Lo Kheng Hong adalah melihat rekam jejak pimpinan perusahaan. Setiap menentukan saham yang hendak dibeli, tentunya harus melihat pimpinan perusahaanya, mencakup jajaran direksi dan komisarisnya.</p>
	</div>
	<div class="col-md-6">
		<h5 style="text-align: center;">Saham terbaik</h5>
		<?php  foreach ($dataTahun as $keyTahun) { ?>
		<h6>Tahun <?php echo $keyTahun->tahun; ?></h6>
		<div class="table-responsive">
		 <table class="table">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Saham</th>
		      <th scope="col">Nilai</th>
		    </tr>
		  </thead>
		  <?php $nom = 1;		  
		  $sahamTerbaik = $this->Dataku->sahamTerbaik($keyTahun->tahun);
		  foreach ($sahamTerbaik->result() as $key) {
			  		echo " <tr>";
			  		echo "<td>".$nom++."</td>";
			  		echo "<td>".$key->kode_saham."</td>";
			  		echo "<td>".$key->nilai_preferensi."</td>";
			  		echo "</tr>";
			  	}
			  	if ($sahamTerbaik->num_rows() == 0) {
			  	 	echo "<td>Data Kosong</td>";
			} ?>
		  <tbody>
		  </tbody>
		</table>
	</div>
<?php } ?>
	</div>
</div>