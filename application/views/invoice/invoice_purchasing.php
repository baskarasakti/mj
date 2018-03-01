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
						<div class="pull-left">
							<address>
								<?php
									if($purchasing->vat == 1){
								?>	
								<h3> &nbsp;<b class="text-danger">PT. MEGAHJAYA CEMERLANG</b></h3>
								<p class="text-muted m-l-5">Jl. Raya Mojosari - Trawas Km 7 No 88 Mojokerto
									<br/> Kab. Mojokerto
									<br/> NPWP : 02.297.175.6-6-2.000
								<?php
									}
								?>	
							</address>
						</div>
						<div class="pull-right text-right">
							<address>
								<h4 class="font-bold"><?= $vendor->name ?></h4>
								<p class="text-muted m-l-30"><?= $vendor->address ?>
									<br/> <?= $vendor->telp ?>
							</address>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<h3>ORDER PEMBELIAN</h3>
							<h4>PO. No: <?= $purchasing->code ?></h4>
						</div>
						<p>Mohon dikirimkan kepada kami tanggal : <?= $purchasing->delivery_date ?></p>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th class="text-right">NAMA BARANG</th>
										<th class="text-right">Qty</th>
										<th class="text-right">HARGA SATUAN</th>
										<th class="text-right">JUMLAH</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1; $total = 0;
										foreach ($receive_det as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td class="text-right"><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
												<td class="text-right"><?= $q->unit_price ?></td>
												<td class="text-right"><?= $q->total_price ?></td>
											</tr>
										 	<?php
										$i++;$total += $q->total_price;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="pull-left">NB: <?= $purchasing->note ?></div>
						<div class="pull-right m-t-30 text-right">
							<h3><b>Total :</b> <?= $total; ?></h3>
						</div>
						<div class="clearfix"></div>
						<hr>
					</div>
					<div class="col-md-6">
						<p>
							CATATAN:
							<br>1. Pada saat pengiriman barang, mohon dicantumkan No. PO
							<br>2. Pada saat penagihan, mohon disertakan tanda terima 
							<br>barang dari bagian gudang
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							SUPPLIER
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							PEMESAN
							<br>
							<br>
							<br>
							DESSI
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .row -->
	<!-- /.row -->
	<div class="row bg-title">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 pull-right">
		<div class="text-right">
			<button id="print-invoice2" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
		</div>
	</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="white-box printableArea2">
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<address>
								<?php
									if($purchasing->vat == 1){
								?>	
								<h3> &nbsp;<b class="text-danger">PT. MEGAHJAYA CEMERLANG</b></h3>
								<p class="text-muted m-l-5">Jl. Raya Mojosari - Trawas Km 7 No 88 Mojokerto
									<br/> Kab. Mojokerto
									<br/> NPWP : 02.297.175.6-6-2.000
								<?php
									}
								?>	
							</address>
						</div>
						<div class="pull-right text-right">
							<address>
								<h4 class="font-bold"><?= $vendor->name ?></h4>
								<p class="text-muted m-l-30"><?= $vendor->address ?>
									<br/> <?= $vendor->telp ?>
							</address>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<h3>ORDER PEMBELIAN</h3>
							<h4>PO. No: <?= $purchasing->code ?></h4>
						</div>
						<p>Mohon dikirimkan kepada kami tanggal : <?= $purchasing->delivery_date ?></p>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th class="text-right">NAMA BARANG</th>
										<th class="text-right">Qty</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1; $total = 0;
										foreach ($receive_det as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td class="text-right"><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
											</tr>
										 	<?php
										$i++;$total += $q->total_price;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="pull-left">NB: <?= $purchasing->note ?></div>
						<div class="pull-right m-t-30 text-right">
							<!-- <h3><b>Total :</b> <?= $total; ?></h3> -->
						</div>
						<div class="clearfix"></div>
						<hr>
					</div>
					<div class="col-md-6">
						<p>
							CATATAN:
							<br>1. Pada saat pengiriman barang, mohon dicantumkan No. PO
							<br>2. Pada saat penagihan, mohon disertakan tanda terima 
							<br>barang dari bagian gudang
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							SUPPLIER
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							PEMESAN
							<br>
							<br>
							<br>
							DESSI
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .row -->
	<!-- /.row -->
</div>
</div>

<!-- /.container-fluid -->
