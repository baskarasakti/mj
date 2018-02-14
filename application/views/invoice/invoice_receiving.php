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
					<!-- div class="col-md-12">
						<div class="pull-left">
							<address>
								<h3> &nbsp;<b class="text-danger">PT. MEGAHJAYA CEMERLANG</b></h3>
								<p class="text-muted m-l-5">Jl. Raya Mojosari - Trawas Km 7 No 88 Mojokerto
									<br/> Kab. Mojokerto
									<br/> NPWP : 02.297.175.6-6-2.000
							</address>
						</div>
						<div class="pull-right text-right">
							<address>
								<h4 class="font-bold"><?= $vendor->name ?></h4>
								<p class="text-muted m-l-30"><?= $vendor->address ?>
									<br/> <?= $vendor->telp ?>
							</address>
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="text-center">
							<h3>LAPORAN PENERIMAAN BARANG</h3>
						</div>
					</div>
					<div class="col-md-6">
						<table>
							<tr>
								<td width="175">Terima barang dari</td>
								<td width="10">:</td>
								<td><?= $receiving->name ?></td>
							</tr>
							<tr>
								<td>No. PO</td>
								<td>:</td>
								<td><?= $receiving->code ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-3">
						Tanggal: <?= $receiving->receive_date ?>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th>NAMA BARANG</th>
										<th class="text-right">Qty</th>
										<th>SATUAN</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										foreach ($receive_det as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
												<td><?= $q->uom ?></td>
											</tr>
										 	<?php
										$i++;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="pull-left">NB: </div>
						<div class="pull-right m-t-30 text-right">
							<!-- <h3><b>Total :</b> <?= $total; ?></h3> -->
						</div>
						<div class="clearfix"></div>
						<hr>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							Menyetujui,
							<br>Admin Pembelian
							<br>
							<br>
						</p>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							Mengetahui,
							<br>Kepala Pabrik
							<br>
							<br>
						</p>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							Penerima,
							<br>Admin Gudang
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
