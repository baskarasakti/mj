	<!-- jQuery -->
	<script src="<?= asset_url('plugins/bower_components/jquery/dist/jquery.min.js');?>"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="<?= asset_url('plugins/bower_components/jquery-validation/dist/jquery.validate.min.js');?>"></script>	
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= asset_url('bootstrap/dist/js/tether.min.js');?>"></script>
    <script src="<?= asset_url('bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?= asset_url('plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js');?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= asset_url('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js');?>"></script>
    <!--Counter js -->
    <script src="<?= asset_url('plugins/bower_components/waypoints/lib/jquery.waypoints.js');?>"></script>
    <script src="<?= asset_url('plugins/bower_components/counterup/jquery.counterup.min.js');?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= asset_url('js/jquery.slimscroll.js');?>"></script>
    <!--Wave Effects -->
    <script src="<?= asset_url('js/waves.js');?>"></script>
    <!--Morris JavaScript -->
    <script src="<?= asset_url('plugins/bower_components/raphael/raphael-min.js');?>"></script>
    <script src="<?= asset_url('plugins/bower_components/morrisjs/morris.js');?>"></script>
    <script src="<?= asset_url('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js');?>"></script>
	<!-- DataTables -->
	<script src="<?= asset_url('plugins/bower_components/datatables/jquery.dataTables.min.js');?>"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
	<!-- Editable -->
    <script src="<?= asset_url('plugins/bower_components/jsgrid/dist/jsgrid.min.js');?>"></script>
	<!--BlockUI Script -->
	<script src="<?= asset_url('plugins/bower_components/blockUI/jquery.blockUI.js');?>"></script>
	<!-- Form Validation -->
	<script src="<?= asset_url('js/validator.js');?>"></script>
	<!-- Sweet-Alert  -->
    <script src="<?= asset_url('plugins/bower_components/sweetalert/sweetalert.min.js');?>"></script>
    <script src="<?= asset_url('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js');?>"></script>
    <!-- Custom Theme JavaScript -->
	<script src="<?= asset_url('js/custom.min.js');?>"></script>
	<!-- Typehead Plugin JavaScript -->
	<script src="<?= asset_url('plugins/bower_components/typeahead.js-master/dist/typeahead.bundle.min.js');?>"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<!-- Extra JavaScript -->
	 <script src="<?= asset_url('apps-js/extra.js');?>"></script>
	<script>
		var base_url = "<?=base_url();?>";
		var site_url = "<?=site_url('/');?>";
	</script>
	<?php
		if(isset($js_asset)){
			echo '<script src="'.asset_url('apps-js/'.$js_asset.'.js').'"></script>';
		}
	?>
    <!--Style Switcher -->
    <script src="<?= asset_url('plugins/bower_components/styleswitcher/jQuery.style.switcher.js');?>"></script>
