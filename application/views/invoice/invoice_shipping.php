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
								<h3> &nbsp;<b class="text-danger">PT. MEGAHJAYA CEMERLANG</b></h3>
								<p class="text-muted m-l-5">Jl. Raya Mojosari - Trawas Km 7 No 88 Mojokerto
									<br/> Kab. Mojokerto
									<br/> NPWP : 02.297.175.6-6-2.000
							</address>
						</div>
						<div class="pull-right text-right">
							<address>
								<p>Mojosari, <?= $shipping->shipping_date ?></p>
								<p>Kepada Yth,</p>
								<h4 class="font-bold"><?= $customer->name ?></h4>
								<p class="text-muted m-l-30"><?= $customer->address ?>
									<br/> <?= $customer->telp ?>
							</address>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<h3>SURAT JALAN</h3>
							<h4>PO. No: <?= $shipping->code ?></h4>
						</div>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">>
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th>NAMA BARANG</th>
										<th class="text-right">JUMLAH</th>
										<th>KETERANGAN</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										foreach ($shipping_det as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
												<td></td>
											</tr>
										 	<?php
										$i++;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="pull-left">NB: <?= $shipping->note ?></div>
						<!-- <div class="pull-right m-t-30 text-right">
							<h3><b>Total :</b> $13,986</h3>
						</div> -->
						<div class="clearfix"></div>
						<hr>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							PENERIMA:
							<br>
							<br>
							<br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
						</p>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							PENGIRIM:
							<br>
							<br>
							<br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
						</p>
					</div>
					<div class="col-md-4">
						<p class="text-center">
							HORMAT KAMI:
							<br>
							<br>
							<br>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
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
