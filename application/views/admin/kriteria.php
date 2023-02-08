<div class="content">
	<h4 style="margin-bottom: 20px;">Data Kriteria</h4>
	<div class="row">
		<div class="col-md-4">
		 <?php if (isset($op) != "update") { ?>
		 <div class="card">
			<div class="card-header" style="background-color: #6D8B74;">
				<h5 class="card-title text-center text-white">Tambah Kriteria</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/kriteria/tambahKriteria">
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Nama Kriteria</label>
			    	<input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" placeholder="masukkan kriteria"  required>
			  	</div>
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Bobot</label>
			    	<input type="text" class="form-control" id="bobot" name="bobot" aria-describedby="bobot" placeholder="masukkan bobot"  required>
			  	</div>
			  	<div class="form-group">
				    <label for="exampleFormControlSelect1">Keterangan</label>
				    <select class="form-control" name="keterangan" id="exampleFormControlSelect1">
				      <option value="benefit">Benefit</option>
				      <option value="cost">Cost</option>
				    </select>
				 </div>
			  	<button type="submit" class="btn btn-custom">Simpan</button>
			 </form>
		  </div>
		</div>
		<?php }else{?>
		<div class="card">
			<div class="card-header" style="background-color: #EC994B;">
				<h5 class="card-title text-center text-white">Update Kriteria</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/kriteria/updateKriteria">
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Nama Kriteria</label>
			   	 	<input type="hidden" value="<?php echo $id; ?>" name="id">
			    	<input type="text" class="form-control" id="nama" name="nama" aria-describedby="username" placeholder="masukkan kriteria" value="<?php echo $nama; ?>" required>
			  	</div>
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Bobot</label>
			    	<input type="text" class="form-control" id="bobot" name="bobot" aria-describedby="bobot" placeholder="masukkan bobot" value="<?php echo $bobot; ?>" required>
			  	</div>
			  	<div class="form-group">
				    <label for="exampleFormControlSelect1">Keterangan</label>
				    <select class="form-control" name="keterangan" id="exampleFormControlSelect1">
				      <option <?php if($keterangan=="benefit"){echo "selected";} ?> value="benefit">Benefit</option>
				      <option <?php if($keterangan=="cost"){echo "selected";} ?> value="cost">Cost</option>
				    </select>
				 </div>
			  	<button type="submit" class="btn btn-custom" style="background-color: #EC994B;">Update</button>
			  	<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/kriteria/">BATAL</a>
			 </form>
		  </div>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-8">
		 <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Nama</th>
		      <th scope="col">Bobot</th>
		      <th scope="col">Keterangan</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php $no=1;
		   foreach ($dataKriteria as $value) { ?>
		    <tr>
		      <th scope="row"><?php echo $no; ?></th>
		      <td><?php echo $value->nama_kriteria; ?></td>
		      <td><?php echo $value->bobot_kriteria; ?></td>
		      <td><?php echo $value->keterangan; ?></td>
		      <td>
		      	<a href="<?php echo base_url('index.php/kriteria/ubahKriteria?id='.$value->id_kriteria.'&nama='.$value->nama_kriteria.'&bobot='.$value->bobot_kriteria.'&keterangan='.$value->keterangan); ?>"><i style="color: #6D8B74;font-size: 25px;" class="fa fa-pencil-square-o"></i></a>
		      	 | 
		      	<a href="<?php echo base_url('index.php/kriteria/deleteKriteria?id='.$value->id_kriteria); ?>"><i style="color: red;font-size: 25px;" class="fa fa-trash"></i></a></td>
		    </tr>
		    <?php $no++; } ?>
		  </tbody>
		</table>
	</div>
	</div>
</div>