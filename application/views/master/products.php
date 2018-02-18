<div class="container-fluid">
	<?php $this->load->view('layouts/breadcumb') ?>
	<!-- /row -->
	<div class="row">
		<div id="table-panel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
			<div class="panel panel-default">
				<div class="panel-heading"> <?=$table_title;?>         
					<div class="pull-right">
						<a href="javascript:void(0);" id="add-btn"><i class="ti-plus"></i> Add Data</a> 
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
		<div id="form-panel" class="col-md-12 form-hide">
			<div class="panel panel-info">
				<div id="form-title" class="panel-heading"> Add Form</div>
				<div class="panel-wrapper collapse in block-div" aria-expanded="true">
					<div class="panel-body">
					<form id="form" data-toggle="validator">
						<div class="form-group">
							<label for="name" class="control-label">Code</label>
							<input type="text" class="form-control" id="code" name="code" placeholder="Code" readonly>
							<div class="help-block with-errors"></div>
						</div>
						<div id="color-group" class="form-group">
							<label for="color" class="control-label">Color</label>
							<select class="custom-select col-sm-12" id="color" name="color" required>
								<option value="" selected="">Choose...</option>
								<?php
									foreach($colors as $item){
										echo '<option value="'.$item->code.'">'.$item->name.'</option>';
									}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="category" class="control-label">Category</label>
							<select class="custom-select col-sm-12" id="product_categories_id" name="product_categories_id" required>
								<option selected="">Choose...</option>
								<?php
									foreach($p_categories as $item){
										echo '<option value="'.$item->id.'">'.$item->name.'</option>';
									}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group row">
							<div class="col-sm-4">
								<div class="radio">
									<input name="type" checked value="foil" required="" type="radio">
									<label for="out"> Foil </label>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="radio">
									<input name="type" value="tipping" required="" type="radio">
									<label for="out"> Tipping </label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group">
							<label for="uom_id" class="control-label">Unit</label>
							<select class="custom-select col-sm-12" id="uom_id" name="uom_id" required>
								<option selected="">Choose...</option>
								<?php
									foreach($uom as $item){
										echo '<option value="'.$item->id.'">'.$item->symbol.'</option>';
									}
								?>
							</select>
							<div class="help-block with-errors"></div>
						</div>
						<div class="form-group text-right">
							<button type="button" id="saveBtn" class="btn btn-success">Save</button>
							<button type="button" id="cancelBtn" class="btn btn-danger">Cancel</button>
						</div>
						<input type="hidden" name="asd" value="">
						<input type="hidden" name="change_id">
					</form>
					<h3 class="box-title">Product Materials</h3>
                    <hr>
					<div class="table-responsive"> 
						<div id="jsGrid"></div> 
					</div> 
					<h3 class="box-title">Product Process</h3>
                    <hr>
					<div class="table-responsive"> 
						<div id="jsGrid2"></div> 
					</div> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
</div>
