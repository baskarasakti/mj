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
								<?php if($work_orders->ppn == 1){?>
								<h3> &nbsp;<b class="text-danger">PT. MEGAHJAYA CEMERLANG</b></h3>
								<p class="text-muted m-l-5">Jl. Raya Mojosari - Trawas Km 7 No 88 Mojokerto
									<br/> Kab. Mojokerto
									<br/> NPWP : 02.297.175.6-6-2.000
								<?php }else{?>
								<h3> &nbsp;<b class="text-danger"></b></h3>
								<p class="text-muted m-l-5">
									<br/> 
									<br/> 
								<?php }?>	
							</address>
						</div>
						<div class="pull-right text-right">
							<address>
								<p>Mojosari, <?=  explode(" ", $work_orders->created_at)[0] ?></p>
							</address>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<h3>SURAT PERINTAH KERJA</h3>
							<h4>No: <?= $work_orders->code ?></h4>
						</div>
						<p>Mohon dikirimkan tanggal: <?=  explode(" ", $work_orders->end_date)[0] ?></p>
					</div>
					<div class="col-md-12">
						<div class="table-responsive m-t-40" style="clear: both;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th class="text-center">No. </th>
										<th class="text-center">Item</th>
										<th class="text-right">Qty</th>
										<th class="text-center">Unit</th>
										<th class="text-center">Keterangan</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										foreach ($work_order_detail as $q) {
										 	?>
										 	<tr>
												<td class="text-center"><?= $i ?></td>
												<td class="text-center" ><?= $q->name ?></td>
												<td class="text-right"><?= $q->qty ?></td>
												<td class="text-center"><?= $q->symbol ?></td>
												<td class="text-left"><?= $q->note ?></td>
											</tr>
										 	<?php
										$i++;}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="pull-left">SO No.: <?=$project->code;?></div>
						<div class="pull-right m-t-30 text-right">
							<h3><b></b> </h3>
						</div>
						<div class="clearfix"></div>
						<hr>
					</div>
					<div class="col-md-2">
						<p class="text-center">
							PEMBUAT
							<br>
							<br>
							<br>
							HANIS
						</p>
					</div>
					<div class="col-md-2">
						<p class="text-center">
							PENERIMA
							<br>
							<br>
							<br>
							FARID
						</p>
					</div>
					<div class="col-md-2">
						<p class="text-center">
							ADMIN
							<br>
							<br>
							<br>
							ATIKA
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							MENYETUJUI
							<br>
							<br>
							<br>
							SATRIO
						</p>
					</div>
					<div class="col-md-3">
						<p class="text-center">
							MENGETAHUI
							<br>
							<br>
							<br>
							SLAMET SUBYAKTO
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
