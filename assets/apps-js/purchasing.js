var table;
var action;

$(document).ready(function() {

	$('#delivery_date').datepicker({
		format: 'yyyy-mm-dd',
		startDate: '0d',
		endDate: '+1Y',
	});

	$( "#vendor_name" ).autocomplete({
		maxShowItems: 5,
		source: site_url+"vendors/populate_autocomplete",
		minLength: 1,
		select: function( event, ui ) {
		  $('[name="vendors_id"]').val(ui.item.id);
		  generate_vendor_material();
		}
	});

	var columns = [];
	var right_align = [];
	$("#datatable").find('th').each(function(i, th){
		var field = $(th).attr('data-field');
		var align = $(th).attr('data-align');
		columns.push({data: field, name: field});
		if(align == "right")
			right_align.push(i);
	});

	table = $('#datatable').DataTable({
		dom: 'lrftip',
		processing: true,
		serverSide: true,
		responsive: true,
		pageLength: 10,
		deferRender: true,
		lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		ajax: {
			url: site_url+'purchasing/view_data',
			type: "POST",
			dataSrc : 'data',
			data: function ( d ) {
				d.csrf_token = $("[name='csrf_token']").val();
			}
		},
		columns: columns,
		columnDefs: [ 
		{ className: "dt-body-right", targets: right_align }, 
		{ visible: false, targets: [0] }, 
		]
	});
	
	$("#jsGrid").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	inserting: true, 
    	editing: true, 
    	sorting: true, 
    	paging: true, 

        // data: lists, 
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "purchasing/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	},
        	insertItem: function(item) {
        		item["csrf_token"] = $("[name='csrf_token']").val();
        		return $.ajax({
        			type: "POST",
        			url: "purchasing/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item,
        			dataType:"JSON"
        		});
        	},
        	updateItem: function(item) {
        		return $.ajax({
        			type: "PUT",
        			url: "purchasing/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item
        		});
        	},
        	deleteItem: function(item) {
        		return $.ajax({
        			type: "DELETE",
        			url: "purchasing/jsgrid_functions",
        			data: item,
        			success: function(data)
        			{
        				if(data.status){
        				}else{
        					alert('Fail');
        				}
        			}
        		});
        	}
        },

        fields: [ 
        { name: "id", visible:false }, 
        { name: "name", title:"Item Name", type: "text", width: 150, validate: "required" }, 
        { name: "qty", title:"Qty", type: "number", width: 50 }, 
        { name: "uom", title:"Uom", type: "text", width: 50, readOnly: true }, 
        { type: "control" } 
        ] 
    });

	$('#form-panel').hide();

	function generateID(){
		$.ajax({
			url : site_url+"purchasing/generate_id",
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$("#code").val(data.id);
			}
		});	
	}

	$('#add-btn').click(function(){
		action = "Add";
		generateID();
		$('[name="asd"]').val("");
		$('#form-title').text('Add Form');
		$("#form").validator();
		$('#jsGrid').jsGrid('loadData');
		show_hide_form(true);
	});

	$('#cancelBtn').click(function(){
		$("#form").validator('destroy');
		show_hide_form(false);
		$('#form')[0].reset();
		$("#saveBtn").text("Save");
		$("#saveBtn").prop('disabled', false);
	});

	$("#saveBtn").click(function (e) {
		var validator = $("#form").data("bs.validator");
		validator.validate();
		if (!validator.hasErrors()){
			save_data();
		}
	});

	var save_material_vendor = function(){
		var data = $("#form2").serializeArray();
		data.push({name: 'csrf_token',value: $("[name='csrf_token']").val()});
		data.push({name: 'materials_id',value: $("[name='change_id']").val()});
		var url = site_url+"materials/edit_material_vendor";
		if(method != "Edit"){
			url = site_url+"materials/add_material_vendor";
		}
		$.ajax({
			url : url,
			type: "POST",
			data: data,
			dataType: "JSON",
			success: function(data)
			{
				if(data){
					method = "";
					$('#form2')[0].reset();
					$('#jsGrid').jsGrid('loadData');
				}
			}
		}); 
	 }

	 var get_material_vendor = function(data){
		$('[name="vendor_name"]').val(data.name);
		$('[name="vendors_id"]').val(data.vendors_id);
		$('[name="details_id"]').val(data.id);
	 }

	 var clear_highlight = function(selected){
		if ( selected ) { selected.children('.jsgrid-cell').css('background-color', ''); }
	 }

	 $("#saveBtn2").click(function (e) {
		var validator = $("#form2").data("bs.validator");
		validator.validate();
		if (!validator.hasErrors()){
		   save_material_vendor();
		}
	});

	$('#cancelBtn2').click(function(){
		method = "";
		clear_highlight(selectedRow);
		$('#form2')[0].reset();
	});

});

function generate_vendor_material(){
	$( "#material_name" ).autocomplete({
		maxShowItems: 5,
		source: function(request,response){
			$.ajax({
				url: site_url+"vendors/populate_autocomplete_material",
				type:"GET",
				data:{term:request.term, vendors_id:$("[name='vendors_id']").val()},
				success:response,
				dataType:"json"
			});
		},
		minLength: 1,
		select: function( event, ui ) {
		  $('[name="materials_id"]').val(ui.item.id);
		}
	});
}

function show_hide_form(bShow){
	if(bShow==true){
		$('#form-panel').show();
		$('#table-panel').hide();
	}else{
		$('#form-panel').hide();
		$('#table-panel').show();
	}
}

function reload_table(){
	table.ajax.reload(null,false); //reload datatable ajax 
} 

function save_data(){
	var url;
	if(action == "Add"){
		url = site_url+"purchasing/add";
	}else{
		url = site_url+"purchasing/update";
	}

	var data = $("#form").serializeArray();
	data.push({name: 'csrf_token',value: $("[name='csrf_token']").val()});

	$.ajax({
		url : url,
		type: "POST",
		data: $.param(data),
		dataType: "JSON",
		beforeSend: function() { 
			$("#saveBtn").text("Saving...");
			   $("#saveBtn").prop('disabled', true); // disable button
			   $('div.block-div').block({
			   	message: '<h4><img src="'+base_url+'assets/plugins/images/busy.gif" /> Just a moment...</h4>',
			   	css: {
			   		border: '1px solid #fff'
			   	}
			   });
			},
		success: function(data)
		{
			if(data.id){
				reload_table();
				$("#saveBtn").text("Saved");
				$("#saveBtn").prop('disabled', true);
				$('div.block-div').unblock();
				$('[name="asd"]').val(data.id);
				show_hide_form(true);
				// $('#form')[0].reset();
			}else{
				alert('Fail');
			}
		}
	});
}

function edit(id){
	action = "Edit";
	$('[name="change_id"]').val(id);
	$.ajax({
		url : site_url+"purchasing/get_by_id/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('#code').val(data.code);
			$('#vat').val(data.vat);
			$('#delivery_date').val(data.delivery_date);
			$('#delivery_place').val(data.delivery_place);
			$('#note').val(data.note);
			$('#vendor').val(data.vendors_id);
			$('#currency').val(data.currency_id);
			$("#form").validator();
			$('#form-title').text('Edit Form');
			$('[name="asd"]').val(id);
			$('#jsGrid').jsGrid('loadData');
			show_hide_form(true);
		}
	});
}

function remove(id){
	swal({
		title: "Are you sure?",
		text: "Your will not be able to recover this data!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false,
		showLoaderOnConfirm: true
	},
	function(){
		$.ajax({
			url : site_url+"purchasing/delete/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				reload_table();
				swal("Deleted!", "Your data has been deleted.", "success");
			}
		});	
	});
}
