<div class="container-fluid">
	<?php $this->load->view('layouts/breadcumb') ?>
	<!-- .row -->
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<div class="col-lg-3 col-md-6 m-b-15 text-center"> <small>Visit</small>
						<h2><i class="ti-arrow-up text-success"></i> 1064</h2>
						<div id="sparklinedash"></div>
					</div>
					<div class="col-lg-3 col-md-6 m-b-15 text-center"> <small>Total Page Views</small>
						<h2><i class="ti-arrow-up text-warning"></i> 5064</h2>
						<div id="sparklinedash2"></div>
					</div>
					<div class="col-lg-3 col-md-6 m-b-15 text-center"> <small>Unique Visitor</small>
						<h2><i class="ti-arrow-up text-info"></i> 664</h2>
						<div id="sparklinedash3"></div>
					</div>
					<div class="col-lg-3 col-md-6 m-b-15 text-center"> <small>Bounce Rate</small>
						<h2><i class="ti-arrow-down text-danger"></i> 50%</h2>
						<div id="sparklinedash4"></div>
					</div>
				</div>
				<ul class="list-inline text-center m-t-40">
					<li>
						<h5><i class="fa fa-circle m-r-5" style="color: #444b4c;"></i>Site A</h5>
					</li>
					<li>
						<h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Site B</h5>
					</li>
					<li>
						<h5><i class="fa fa-circle m-r-5" style="color: #808f8f;"></i>Site C</h5>
					</li>
				</ul>
				<div id="morris-area-chart" style="height: 340px;"></div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- .row -->
	<div class="row">
		<div class="col-lg-6 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="white-box">
						<h3 class="box-title">NEW CLIENTS</h3>
						<ul class="list-inline two-part">
							<li><i class="icon-people text-info"></i></li>
							<li class="text-right"><span class="counter">23</span></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="white-box">
						<h3 class="box-title">NEW Projects</h3>
						<ul class="list-inline two-part">
							<li><i class="icon-folder text-purple"></i></li>
							<li class="text-right"><span class="counter">169</span></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="white-box">
						<h3 class="box-title">Open Projects</h3>
						<ul class="list-inline two-part">
							<li><i class="icon-folder-alt text-danger"></i></li>
							<li class="text-right"><span class="">311</span></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="white-box">
						<h3 class="box-title">NEW Invoices</h3>
						<ul class="list-inline two-part">
							<li><i class="ti-wallet text-success"></i></li>
							<li class="text-right"><span class="">117</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-12 col-xs-12">
			<div class="news-slide m-b-15">
				<div class="vcarousel slide">
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="active item">
							<div class="overlaybg"><img src="../plugins/images/news/slide1.jpg" /></div>
							<div class="news-content"><span class="label label-danger label-rounded">Primary</span>
								<h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
						</div>
						<div class="item">
							<div class="overlaybg"><img src="../plugins/images/news/slide1.jpg" /></div>
							<div class="news-content"><span class="label label-primary label-rounded">Primary</span>
								<h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
						</div>
						<div class="item">
							<div class="overlaybg"><img src="../plugins/images/news/slide1.jpg" /></div>
							<div class="news-content"><span class="label label-success label-rounded">Primary</span>
								<h2>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</h2> <a href="#">Read More</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<!-- .row -->
	<div class="row">
		<div class="col-md-6 col-lg-9 col-xs-12">
			<div class="white-box">
				<h3 class="box-title">SALES ANALYTICS</h3>
				<ul class="list-inline text-center">
					<li>
						<h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Site A View</h5>
					</li>
					<li>
						<h5><i class="fa fa-circle m-r-5" style="color: #fdc006;"></i>Site B View</h5>
					</li>
				</ul>
				<div id="morris-area-chart2" style="height: 370px;"></div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3 col-sm-6 col-xs-12">
			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<h3 class="box-title">Total Sites Visit</h3>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
								<h1 class="text-warning">$678</h1>
								<p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div id="sales1" class="text-center"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="white-box">
						<h3 class="box-title">Sales Difference</h3>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6  m-t-30">
								<h1 class="text-info">$447</h1>
								<p class="text-muted">APRIL 2017</p> <b>(150 Sales)</b> </div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div id="sales2" class="text-center"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
