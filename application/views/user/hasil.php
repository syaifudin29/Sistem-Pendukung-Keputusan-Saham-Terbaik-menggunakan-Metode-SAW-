<div class="content">
	<h4 style="text-align: center;">Hasil Metode SAW</h4>
	<div class="row">
		<div class="col-md-3">
			<form method="POST" action="<?php echo base_url(); ?>index.php/userBeranda/hasil">
			    <div class="form-group">
			    	<label for="exampleFormControlSelect1">Pilih Tahun</label>
			    	<?php
			    		$queryTahunPilih = "select distinct tahun from hasil";
			    		$hasilTahunPilih = $this->db->query($queryTahunPilih)->result();
			    	 ?>
				    <select class="form-control" name="tahuncari" id="exampleFormControlSelect1">
				    <?php
				    foreach ($hasilTahunPilih as $key) {
				    	if ($key->tahun == $tahun) {
				    		$select = "selected";
				    	}else{
				    		$select = "";
				    	}
				     	echo "<option ".$select." value='".$key->tahun."'>".$key->tahun."</option>";	
				     } 
				    ?>
				    </select>
				    <button type="submit" style="margin-top: 10px;" class="btn btn-custom">Lihat</button>
				  </div>
			</form>
		</div>
	<div class="col-md-12">
		<div class="row">
		<h5 class="bg-custom" style="width: 100%; padding: 10px; text-align: center;">Saham Terbaik <?php echo $tahun; ?></h5>
		<table class="table">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Saham</th>
			      <th scope="col">Nilai Prefrensi</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $nom = 1; foreach ($sahamTerbaik->result() as $key) {
			  		echo " <tr>";
			  		echo "<td>".$nom++."</td>";
			  		echo "<td>".$key->kode_saham."</td>";
			  		echo "<td>".$key->nilai_preferensi."</td>";
			  		echo "</tr>";
			  	}
			  	if ($sahamTerbaik->num_rows() == 0) {
			  	 	echo "<td>Data Kosong</td>";
			  	 } ?>
			  </tr>
			  </tbody>
			</table>
		</div>

		<h5 class="bg-custom" style="padding: 10px; text-align: center;">Matriks</h5>
		<div class="table-responsive" style="height: 400px;">
			<table class="table">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">No</th>
				      <th scope="col">Saham</th>
				      <?php $k=1; 
				      foreach ($dataKriteria as $key) {
				      	echo "<th scope='col'>".$key->nama_kriteria."</th>";
				      	$idK[$k] = $key->id_kriteria;
				      $k++;} ?>
				    </tr>
				  </thead>
				  <tbody>
				 <?php
				 if ($hasilData) {
					 $no=1;
					 $jmlKeriteria =  count($dataKriteria);
						foreach ($hasilCek as $key) {
						echo "<tr>";
						echo "<td>".$no."</td>";
						echo "<td>".$key->kode_saham."</td>";
						for ($i=1; $i <= $jmlKeriteria; $i++) {
						$query1 = "select nilai_kriteria.nilai_kriteria,  kriteria.id_kriteria FROM nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where saham.id_saham = ".$key->id_saham." AND kriteria.id_kriteria = ".$i." AND nilai_kriteria.tahun = ".$tahun;
						$hasil1 = $this->db->query($query1)->row(); 
						$hasil = $this->Dataku->tabelKecocokan($hasil1->id_kriteria,$hasil1->nilai_kriteria);
						echo "<td>".$hasil."</td>";
						}
						echo "<tr>";
						$no++;}
					}else{
						echo "<td>Data Kosong</td>";
					}
					?>
				  </tbody>
				</table>
			</div>
			<h5 class="bg-custom" style="padding: 10px; text-align: center;">Normalisasi</h5>
			<div class="table-responsive" style="height: 400px;">
				<table class="table">
					  <thead class="thead-light">
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Saham</th>
					      <?php $k=1; 
					      foreach ($dataKriteria as $key) {
					      	echo "<th scope='col'>".$key->nama_kriteria."</th>";
					      	$idK[$k] = $key->id_kriteria;
					      $k++;} ?>
					    </tr>
					  </thead>
					  <tbody>
						<?php
						if ($hasilData) {
						foreach ($hasilCek as $key) {
						echo "<tr>";
						echo "<td>".$no."</td>";
						echo "<td>".$key->kode_saham."</td>";
						for ($i=1; $i <= $jmlKeriteria; $i++) {
						$query1 = "select nilai_kriteria.nilai_kriteria,  kriteria.id_kriteria FROM nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where saham.id_saham = ".$key->id_saham." AND kriteria.id_kriteria = ".$i;
						$hasil1 = $this->db->query($query1)->row(); 
						$hasil = $this->Dataku->normalisasi($hasil1->id_kriteria,$hasil1->nilai_kriteria);
						echo "<td>".round($hasil,3)."</td>";
						}
						echo "<tr>";
						$no++;}
						}else{
							echo "<td>Data Kosong</td>";
						}
						 ?>
					  </tbody>
					</table>
				</div>
				<h5 class="bg-custom" style="padding: 10px; text-align: center;">Bobot</h5>
				<div class="table-responsive" style="height: 400px;">
					<table class="table">
					  <thead class="thead-light">
					    <tr>
					      <th scope="col">No</th>
					      <th scope="col">Saham</th>
					      <?php $k=1; 
					      foreach ($dataKriteria as $key) {
					      	echo "<th scope='col'>".$key->nama_kriteria."</th>";
					      	$idK[$k] = $key->id_kriteria;
					      $k++;} ?>
					      <th scope="col">Nilai Prefrensi</th>
					    </tr>
					  </thead>
					  <tbody>
					 <?php
						$total = 0;
						 $no=1;
						 if ($hasilData) {
						foreach ($hasilCek as $key) {
						echo "<tr>";
						echo "<td>".$no."</td>";
						echo "<td>".$key->kode_saham."</td>";
						for ($i=1; $i <= $jmlKeriteria; $i++) {

							$query1 = "select nilai_kriteria.nilai_kriteria,  kriteria.id_kriteria FROM nilai_kriteria INNER JOIN kriteria on kriteria.id_kriteria = nilai_kriteria.id_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham where saham.id_saham = ".$key->id_saham." AND kriteria.id_kriteria = ".$i;
							$hasil1 = $this->db->query($query1)->row(); 
							$hasil = $this->Dataku->bobot($hasil1->id_kriteria,$hasil1->nilai_kriteria);
							echo "<td>".round($hasil,3)."</td>";
							$total=$total+$hasil;
						}

						echo "<td>".round($total,3)."</td>";
						$ttl = round($total,3);
						// $sql = "INSERT INTO `hasil` (`id_hasil`, `id_saham`, `tahun`, `nilai_preferensi`) VALUES (NULL, $key->id_saham, 2019, $ttl)";
						// $this->db->query($sql);
						echo "<tr>";
						$total = 0;
						$no++;}
						}else{
							echo "<td>Data Kosong</td>";
						}
						 ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>