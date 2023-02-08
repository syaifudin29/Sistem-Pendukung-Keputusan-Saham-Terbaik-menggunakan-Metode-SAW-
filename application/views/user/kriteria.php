<div class="content">
	<h4 style="margin-bottom: 20px;">Data Kriteria</h4>
	<div class="row">
	<div class="col-md-12">
		 <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Nama</th>
		      <th scope="col">Bobot</th>
		      <th scope="col">Keterangan</th>
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
		    </tr>
		    <?php $no++; } ?>
		  </tbody>
		</table>
	</div>
	</div>
</div>