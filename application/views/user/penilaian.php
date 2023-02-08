<div class="content">
	<h4 style="margin-bottom: 20px;">Data Penilaian</h4>
	<div class="row">
	<div class="col-md-12">
		<div class="table-responsive" style="height: 500px;">
		 <table class="table">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Saham</th>
		      <?php $k=1; 
		      foreach ($kriteria as $key) {
		      	echo "<th scope='col'>".$key->nama_kriteria."</th>";
		      	$idK[$k] = $key->id_kriteria;
		      $k++;} ?>
		       <th scope="col">Tahun</th>
		       <th scope="col">Update</th>
		    </tr>
		  </thead>
		  <tbody>
		 <?php
			$no=1;
			$jmlKeriteria =  count($kriteria);
		 	$queryCek = "select DISTINCT tahun, date_create FROM nilai_kriteria order by id_nilai DESC";
		 	$hasilCek = $this->db->query($queryCek)->result();
			foreach ($hasilCek as $keyTahun) {
				$queryNilai = "SELECT DISTINCT nilai_kriteria.id_saham, saham.kode_saham from nilai_kriteria INNER JOIN saham on saham.id_saham = nilai_kriteria.id_saham WHERE tahun = $keyTahun->tahun";
				$hasilNilai = $this->db->query($queryNilai)->result();
				foreach ($hasilNilai as $key) {
				echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$key->kode_saham."</td>";
				foreach ($kriteria as $keyKriteria) {
					$th = $keyTahun->tahun;
					$kr = $keyKriteria->id_kriteria;
					$sh = $key->id_saham;

					$query1 = "select nilai_kriteria as nilai FROM nilai_kriteria WHERE id_saham = $sh AND id_kriteria = $kr AND tahun = $th";
					$hasil = $this->db->query($query1)->row();
					$nil =  $hasil->nilai;
					echo "<td>".$nil."</td>";
				}
				echo "<td>".$keyTahun->tahun."</td>";
				echo "<td>".$keyTahun->date_create."</td>";
				?>
				<?php
				echo "<tr>";
				$no++;}
				}
			?>
		  </tbody>
		</table>
	   </div>
	 </div>
	</div>
</div>