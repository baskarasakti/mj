var table;
var action;

$(document).ready(function() {

	$("#jsGrid").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	// inserting: true, 
    	// editing: true, 
    	sorting: true, 
    	paging: true, 

        // data: lists, 
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "work_orders/jsgrid_functions/"+$('[name="projects_id"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	},
        	insertItem: function(item) {
        		item["csrf_token"] = $("[name='csrf_token']").val();
        		console.log(item)
        		return $.ajax({
        			type: "POST",
        			url: "projects/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item
        		});
        	},
        	updateItem: function(item) {
        		return $.ajax({
        			type: "PUT",
        			url: "projects/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item
        		});
        	},
        	deleteItem: function(item) {
        		return $.ajax({
        			type: "DELETE",
        			url: "projects/jsgrid_functions",
        			data: item
        		});
        	}
        },

        fields: [ 
		{ name: "id", title:"ID", visible:false }, 
		{ name: "name", title:"Product", width: 150 }, 
        { name: "qty", title:"Qty", type: "number", width: 50 }
        ] 
	}); 

	$( "#projects_code" ).autocomplete({
		maxShowItems: 5,
		source: site_url+"projects/populate_autocomplete",
		minLength: 2,
		select: function( event, ui ) {
		  $('[name="projects_id"]').val(ui.item.id);
		  $('#jsGrid').jsGrid('loadData');
		  generateID();	
		}
	  });

	$('#start_date').datepicker({
		format: 'yyyy-mm-dd' 
	});

	$('#end_date').datepicker({
		format: 'yyyy-mm-dd' 
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
			url: site_url+'work_orders/view_data',
			type: "POST",
			dataSrc : 'data',
			data: function ( d ) {
				d.csrf_token = $("[name='csrf_token']").val();
			}
		},
		columns: columns,
		columnDefs: [ 
		{ className: "dt-body-right", targets: right_align },
		{ visible: false, targets: [1]},
		]
	});
	
	$('#form-panel').hide();

	$('#add-btn').click(function(){
		action = "Add";
		$('[name="projects_id"]').val("");
		$('#jsGrid').jsGrid('loadData');
		$('#form-title').text('Add Form');
		$("#form").validator();
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

});

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
		url = site_url+"work_orders/add";
	}else{
		url = site_url+"work_orders/update";
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

function generateID(){
	$.ajax({
		url : site_url+"work_orders/generate_id",
		type: "GET",
		data: {projects_id: $('[name="projects_id"]').val()},
		dataType: "JSON",
		success: function(data)
		{
			$("#code").val(data.id);
		}
	});	
}

function edit(id){	
	$('[name="change_id"]').val(id);
	$.ajax({
		url : site_url+"work_orders/get_by_id/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			
			if (data.id) {
				$("#saveBtn").text("Saved");
				$("#saveBtn").prop('disabled', true);
				action = "Edit";
			} else {
				$("#saveBtn").text("Save");
				$("#saveBtn").prop('disabled', false);
				action = "Add";
			}
			$('[name="projects_code"]').val(data.projects_code);
			$('[name="projects_id"]').val(data.projects_id);
			$('[name="code"]').val(data.code);
			$('[name="start_date"]').val(data.start_date);
			$('[name="end_date"]').val(data.end_date);
			$("#form").validator();
			$('#form-title').text('Edit Form');
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
			url : site_url+"work_orders/delete/"+id,
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
