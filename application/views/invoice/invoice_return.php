<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pull-right">
			<div class="text-right">
				<button id="print-invoice" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-md-12">
			<div class="white-box printableArea">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<h3>LAPORAN PENGEMBALIAN MATERIAL <?= $material_return->usage_categories ?></h3>
							<h4>No: ......</h4>
						</div>
						<p class="pull-left">tanggal: <?= $material_return->date ?></p>
						<p class="pull-right">No. SPK: <?= $material_return->wocode ?></p>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th>NAMA BARANG</th>
										<th class="text-right">Qty</th>
										<th class="text-right">Uom</th>
										<th class="text-right">Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										foreach ($material_return_detail as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
												<td class="text-right"><?= $q->symbol ?></td>
												<td class="text-right"></td>
											</tr>
										 	<?php
										$i++;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							Diserahkan Oleh,<br>
							Admin Gudang
							<br>
							<br>
							<br>
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							Menyetujui,<br>
							PPIC
							<br>
							<br>
							<br>
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							Mengetahui,<br>
							Kepala Bagian
							<br>
							<br>
							<br>
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							Dibuat Oleh,<br>
							Admin Produksi
							<br>
							<br>
							<br>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .row -->
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
