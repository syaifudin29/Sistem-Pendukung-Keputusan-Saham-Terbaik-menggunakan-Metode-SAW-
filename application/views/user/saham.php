<div class="content">
	<h4 style="margin-bottom: 20px;">Data Saham</h4>
	<div class="row">
	<div class="col-md-12">
		<div class="table-responsive" style="height: 400px;">
		 <table class="table" >
		  <thead>
		    <tr>
		      <th scope="col">No</th>
		      <th scope="col">Kode</th>
		      <th scope="col">Nama Saham</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php $no=1;
		   foreach ($dataSaham as $value) { ?>
		    <tr>
		      <th scope="row"><?php echo $no; ?></th>
		      <td><?php echo $value->kode_saham; ?></td>
		      <td><?php echo $value->nama_saham; ?></td>
		    </tr>
		    <?php $no++; } ?>
		  </tbody>
		</table>
	   </div>
	 </div>
	</div>
</div>