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
	<!-- .right-sidebar -->
	<div class="right-sidebar">
		<div class="slimscrollright">
			<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
			<div class="r-panel-body">
				<ul>
					<li><b>Layout Options</b></li>
					<li>
						<div class="checkbox checkbox-info">
							<input id="checkbox1" type="checkbox" class="fxhdr">
							<label for="checkbox1"> Fix Header </label>
						</div>
					</li>
				</ul>
				<ul id="themecolors" class="m-t-20">
					<li><b>With Light sidebar</b></li>
					<li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
					<li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
					<li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
					<li><a href="javascript:void(0)" theme="blue" class="blue-theme working">4</a></li>
					<li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
					<li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
					<li><b>With Dark sidebar</b></li>
					<br/>
					<li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
					<li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
					<li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
					<li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
					<li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
					<li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
				</ul>
				<ul class="m-t-20 chatonline">
					<li><b>Chat option</b></li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
					</li>
					<li>
						<a href="javascript:void(0)"><img src="../plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.right-sidebar -->
</div>
<!-- /.container-fluid -->
