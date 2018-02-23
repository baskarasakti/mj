<div class="container-fluid">
	<?php $this->load->view('layouts/breadcumb') ?>
	<!-- /row -->
	<div class="row">
		<div id="table-panel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
				<div class="panel panel-default">
					<div class="panel-heading"> <?=$table_title;?>         
						<div class="pull-right">
							<a href="javascript:void(0);" id="add-btn"><i class="ti-plus"></i> Generate Code</a> 
						</div>
					</div>
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
							<div class="table-responsive">
								<table id="datatable" class="table table-striped">
									<thead>
										<tr>
											<?php
											foreach($columns as $column){	
												?>	
												<th class="dt-head-center" data-field="<?=$column['data_field'];?>" data-align="<?=$column['data_align'];?>" ><?=$column['label'];?></th>
												<?php
											}
											?>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<hr> 
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
				<div class="panel panel-default">
					<div class="panel-heading"> <?=$table_title1;?> <span id="nopo"></span>        
						<!-- <div class="pull-right">
							<a href="javascript:void(0);" id="add-btn"><i class="ti-plus"></i> Add Data</a> 
						</div> -->
					</div>
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
							<div class="table-responsive">
								<table id="datatable1" class="table table-striped">
									<thead>
										<tr>
											<?php
											foreach($columns1 as $column){	
												?>	
												<th class="dt-head-center" data-field="<?=$column['data_field'];?>" data-align="<?=$column['data_align'];?>" ><?=$column['label'];?></th>
												<?php
											}
											?>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<hr> 
			</div>
		</div>
		<div id="form-panel" class="col-md-12">
			<div class="panel panel-info">
				<div id="form-title" class="panel-heading"> Add Form</div>
				<div class="panel-wrapper collapse in block-div" aria-expanded="true">
					<div class="panel-body">
						<form id="form" data-toggle="validator">
							<div class="form-group">
								<label for="category" class="control-label">Estimated Products</label>
								<input type="text" class="form-control" id="estimate" name="estimate" placeholder="Estimated Products" required>
								<div class="help-block with-errors"></div>
							</div>
							<input type="hidden" name="woid" value="<?= $woid ?>">
							<input type="hidden" name="pid" value="<?= $pid ?>">
							<div class="form-group text-right">
								<button type="button" id="saveBtn" class="btn btn-success">Save</button>
								<button type="button" id="cancelBtn" class="btn btn-danger">Cancel</button>
							</div>
								<!-- <div class="table-responsive"> 
									<div id="jsGrid"></div> 
								</div> --> 
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="form-panel1" class="col-md-12">
				<div class="panel panel-info">
					<div id="form-title" class="panel-heading"> Move Product</div>
					<div class="panel-wrapper collapse in block-div" aria-expanded="true">
						<div class="panel-body">
							<form id="form1" data-toggle="validator">
								<div class="form-group">
									<label for="category" class="control-label">Process</label>
									<select class="custom-select col-sm-12" id="processes_id" name="processes_id" required>
										<option value="" selected>Choose...</option>
										<?php
										foreach($process as $item){
											echo '<option value="'.$item->id.'">'.$item->name.'</option>';
										}
										?>
										<option value="-2">Not Processed</option>
										<option value="-1">Uninished</option>
										<option value="0">Finished</option>
									</select>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label for="category" class="control-label">Machine</label>
									<select class="custom-select col-sm-12" id="machine_id" name="machine_id">
										<option value="" selected>Choose...</option>
									</select>
									<div class="help-block with-errors"></div>
								</div>
								<input type="hidden" name="woid1" value="<?= $woid ?>">
								<input type="hidden" name="prid">
								<input type="hidden" name="pm_id">
								<div class="table-responsive"> 
									<div id="jsGrid"></div> 
								</div> 
								<div class="form-group text-right">
									<button type="button" id="saveBtn1" class="btn btn-success">Save</button>
									<button type="button" id="cancelBtn1" class="btn btn-danger">Cancel</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
