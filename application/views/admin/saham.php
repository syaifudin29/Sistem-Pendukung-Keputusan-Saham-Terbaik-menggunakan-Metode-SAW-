<div class="content">
	<h4 style="margin-bottom: 20px;">Data Saham</h4>
	<div class="row">
		<div class="col-md-4">
		<form method="POST" action="<?php echo base_url(); ?>index.php/saham/">
		  	<div class="form-group">
		  		<div class="row">
		  			<input type="text" style=" margin-left: 15px; width: 73%; margin-right: 10px;" class="form-control" id="pencarian" name="pencarian" aria-describedby="pencarian" placeholder="Pencarian....">
		  			<button type="submit" class="btn btn-custom">Cari</button>
		  		</div>
		  	</div>
		 </form>
		 <?php if (isset($op) != "update") { ?>
		 <div class="card">
			<div class="card-header" style="background-color: #6D8B74;">
				<h5 class="card-title text-center text-white">Tambah Saham</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/saham/tambahSaham">
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Kode</label>
			    	<input type="text" class="form-control" id="kode" name="kode" aria-describedby="kode" placeholder="masukkan kode"  required>
			  	</div>
			  	<div class="form-group">
			  	<label for="exampleInputEmail1">Nama Saham</label>
			    	<input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" placeholder="masukkan nama"  required>
			  	</div>
			  	<button type="submit" class="btn btn-custom">Simpan</button>
			  
			 </form>
		  </div>
		</div>
		<?php }else{?>
		<div class="card">
			<div class="card-header" style="background-color: #EC994B;">
				<h5 class="card-title text-center text-white">Update Saham</h5>
			</div>
		  	<div class="card-body">
		  	 <form method="POST" action="<?php echo base_url(); ?>index.php/saham/updateSaham">
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Kode</label>
			   	 	<input type="hidden" value="<?php echo $id; ?>" name="id">
			    	<input type="text" class="form-control" id="kode" name="kode" aria-describedby="kode" placeholder="masukkan kode" value="<?php echo $kode; ?>" required>
			  	</div>
			  	<div class="form-group">
			   	 <label for="exampleInputEmail1">Nama Saham</label>
			   	 	<input type="hidden" value="<?php echo $id; ?>" name="id">
			    	<input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" placeholder="masukkan saham" value="<?php echo $nama; ?>" required>
			  	</div>
			  	<button type="submit" class="btn btn-custom" style="background-color: #EC994B;">Update</button>
			  	<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/saham/">BATAL</a>
			 </form>
		  </div>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-8">
		<div class="table-responsive" style="height: 400px;">
		 <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Kode</th>
		      <th scope="col">Nama Saham</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php $no=1;
		   foreach ($dataSaham as $value) { ?>
		    <tr>
		      <th scope="row"><?php echo $no; ?></th>
		      <td><?php echo $value->kode_saham; ?></td>
		      <td><?php echo $value->nama_saham; ?></td>
		      <td>
		      	<a href="<?php echo base_url('index.php/saham/ubahSaham?id='.$value->id_saham.'&nama='.$value->kode_saham); ?>"><i style="color: #6D8B74;font-size: 25px;" class="fa fa-pencil-square-o"></i></a>
		      	 | 
		      	<a href="<?php echo base_url('index.php/saham/deleteSaham?id='.$value->id_saham); ?>"><i style="color: red;font-size: 25px;" class="fa fa-trash"></i></a></td>
		    </tr>
		    <?php $no++; } ?>
		  </tbody>
		</table>
	   </div>
	 </div>
	</div>
</div>