<div class="content">
	<h4 style="margin-bottom: 20px;">Data Penilaian</h4>
	<div class="row">
		<div class="col-md-3">
		 <?php if (isset($op) != "update") { ?>
		 <div class="card">
			<div class="card-header" style="background-color: #6D8B74;">
				<h5 class="card-title text-center text-white">Tambah Penilaian</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/penilaian/tambahPenilaian">
			  	<div class="form-group">
				    <label for="saham">Saham</label>
				    <select class="form-control" name="saham" id="saham">
				      <?php foreach ($saham as $key) {
				      	echo "<option value='".$key->id_saham."'>".$key->kode_saham."</option>";
				      } ?>
				    </select>
				 </div>
				 <div class="form-group">
				    <label for="tahun">Tahun</label>
				    <select class="form-control" name="tahun" id="tahun">
				      <option value="2018">2018</option>
				      <option value="2019">2019</option>
				      <option value="2020">2020</option>
				      <option value="2021">2021</option>
				      <option value="2022">2022</option>
				      <option value="2023">2023</option>
				      <option value="2024">2024</option>
				    </select>
				 </div>
				 	<label for="tahun">Kriteria</label>
				<?php
				foreach ($kriteria as $key) { ?>
				 <div class="form-group">
				 	<div class="input-group mb-2">
				        <div class="input-group-prepend">
				          <div class="input-group-text"><?php echo $key->nama_kriteria; ?></div>
				        </div>
			    	<input type="text" class="form-control" id="nilai" name="<?php echo $key->nama_kriteria; ?>" aria-describedby="nilai" placeholder="<?php echo $key->nama_kriteria ?>" required>
			    	</div>
			  	</div>
				 	<?php
				 } 
				 ?>
			  	<button type="submit" class="btn btn-custom">Simpan</button>
			  	
			 </form>
		  </div>
		</div>
		<?php }else{?>
		<div class="card">
			<div class="card-header" style="background-color: #EC994B;">
				<h5 class="card-title text-center text-white">Update Penilaian</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/penilaian/updatepenilaian">
		  	 	
			  <div class="form-group">
			  	 <label for="tahun">Saham</label>
			  	<?php
			  	$querySaham1 = "select kode_saham from saham where id_saham = $id_saham";
			  	$hasilSaham1 = $this->db->query($querySaham1)->row(); 
			  	 ?>
			    	<input type="text" class="form-control" id="saham" name="saham" aria-describedby="saham" value="<?php echo $hasilSaham1->kode_saham ?>" disabled>
			    	<input type="hidden" name="saham" value="<?php echo $id_saham; ?>">
			  	</div>
			  	<div class="form-group">
			  	 <label for="tahun">Tahun</label>
			    	<input type="text" class="form-control" id="tahun" name="tahun" aria-describedby="tahun" value="<?php echo $thn; ?>" disabled>
			    	<input type="hidden" name="tahun" value="<?php echo $thn; ?>">
			  	</div>
				 <label for="tahun">Kriteria</label>
				<?php
				foreach ($kriteria as $key) {
					$id_kriteria = $key->id_kriteria;
					$queryCek = "select nilai_kriteria as nilai from nilai_kriteria WHERE id_saham = $id_saham AND id_kriteria = $id_kriteria AND tahun = $thn";
					$hasilCek = $this->db->query($queryCek)->row();
					$nilaiData = $hasilCek->nilai;
				 ?>
				 <div class="form-group">
				 	<div class="input-group mb-2">
				        <div class="input-group-prepend">
				          <div class="input-group-text"><?php echo $key->nama_kriteria; ?></div>
				        </div>
			    	<input type="text" class="form-control" id="nilai" name="<?php echo $key->nama_kriteria; ?>" aria-describedby="nilai" value="<?php echo $nilaiData; ?>" placeholder="<?php echo $key->nama_kriteria; ?>" required>
			  	</div>
			  </div>
				 	<?php
				 } 
				 ?>
			  	<button type="submit" class="btn btn-custom" style="background-color: #EC994B;">Update</button>
			  	<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/penilaian/">BATAL</a>
			 </form>
		  </div>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-9">
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
		       <th scope="col">Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
		 <?php
			$no=1;
			$jmlKeriteria =  count($kriteria);
		 	$queryCek = "select DISTINCT tahun FROM nilai_kriteria order by id_nilai DESC";
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

					$query1 = "select nilai_kriteria as nilai,  date_create FROM nilai_kriteria WHERE id_saham = $sh AND id_kriteria = $kr AND tahun = $th";
					$hasil = $this->db->query($query1)->row();
					$nil =  $hasil->nilai;
					$tanggal = $hasil->date_create;
					echo "<td>".$nil."</td>";
				}
				echo "<td>".$keyTahun->tahun."</td>";
				echo "<td>".$tanggal."</td>";
				?>
				 <td>
		      	<a href="<?php echo base_url('index.php/penilaian/ubahPenilaian?id='.$key->id_saham.'&tahun='.$keyTahun->tahun); ?>"><i style="color: #6D8B74;font-size: 25px;" class="fa fa-pencil-square-o"></i></a>
		      	 | 
		      	<a href="<?php echo base_url('index.php/penilaian/deletePenilaian?id='.$key->id_saham.'&tahun='.$keyTahun->tahun); ?>"><i style="color: red;font-size: 25px;" class="fa fa-trash"></i></a></td>
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