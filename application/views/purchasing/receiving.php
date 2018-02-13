<div class="container-fluid">
	<?php $this->load->view('layouts/breadcumb') ?>
	<!-- /row -->
	<div class="row">
		<div id="table-panel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
			<div class="panel panel-default">
				<div class="panel-heading"> <?=$table_title;?>         
					<!-- <div class="pull-right">
						<a href="javascript:void(0);" id="add-btn"><i class="ti-plus"></i> Add Data</a> 
					</div> -->
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
		<div id="form-panel" class="col-md-12">
			<div class="panel panel-info">
				<div id="form-title" class="panel-heading"> Add Form</div>
				<div class="panel-wrapper collapse in block-div" aria-expanded="true">
					<div class="panel-body">
					<form id="form" data-toggle="validator">
						<div class="form-group">
							<label for="code" class="control-label">Code</label>
							<input type="text" class="form-control" id="code" name="code" placeholder="Code" readonly>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="date" class="control-label">Delivery Date</label>
							<input type="text" class="form-control" id="delivery_date" name="delivery_date" placeholder="Delivery Date" readonly>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="vendor" class="control-label">Vendor</label>
							<select class="custom-select col-sm-12" id="vendors_id" name="vendors_id" disabled>
								<option selected="">Choose...</option>
								<?php
									foreach($vendors as $vendor){
										echo '<option value="'.$vendor->id.'">'.$vendor->name.'</option>';
									}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="date" class="control-label">Receive Date</label>
							<input type="text" class="form-control" id="receive_date" name="receive_date" placeholder="Delivery Date">
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="date" class="control-label">File Upload</label>
							<input type="file" id="file" name="file">
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group text-right">
							<button type="button" id="saveBtn" class="btn btn-success">Save</button>
							<button type="button" id="cancelBtn" class="btn btn-danger">Cancel</button>
						</div>
						<input type="hidden" name="asd">
						<div class="table-responsive"> 
			              <div id="jsGrid"></div> 
			            </div> 
						<input type="hidden" name="change_id">
					</form>
					</div>
				</div>
			</div>
		</div>
		<div id="detail-panel" class="col-md-12">
			<div class="panel panel-info">
				<div id="form-title" class="panel-heading"> Add Form</div>
				<div class="panel-wrapper collapse in block-div" aria-expanded="true">
					<div class="panel-body">
					<form id="form" data-toggle="validator">
						<div class="form-group">
							<label for="code" class="control-label">Code</label>
							<input type="text" class="form-control" id="code1" placeholder="Code" readonly>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="date" class="control-label">Receive Date</label>
							<input type="text" class="form-control" id="date1" placeholder="Receive Date" readonly>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="vendor" class="control-label">Vendor</label>
							<select class="custom-select col-sm-12" id="vendor1" readonly>
								<option selected="">Choose...</option>
								<?php
									foreach($vendors as $vendor){
										echo '<option value="'.$vendor->id.'">'.$vendor->name.'</option>';
									}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group text-right">
							<button type="button" id="cancelBtn1" class="btn btn-danger" onclick="show_hide_form_detail(false)">Cancel</button>
						</div>
						<input type="hidden" name="asd">
						<div class="table-responsive"> 
			              <div id="jsGrid1"></div> 
			            </div> 
						<input type="hidden" name="change_id">
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
