var table;
var action;

$(document).ready(function() {

	$('#inlineFormCustomSelect').select2({
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
            url: site_url+'receiving/view_data',
            type: "POST",
            dataSrc : 'data',
            data: function ( d ) {
                d.csrf_token = $("[name='csrf_token']").val();
            }
        },
        columns: columns,
        columnDefs: [ 
			{ className: "dt-body-right", targets: right_align },
			{ "orderable": false, targets : [-1]  } 
        ]
	});
	
	$('#form-panel').hide();
	$('#detail-panel').hide();

	$('#add-btn').click(function(){
		action = "Add";
		$('#form-title').text('Add Form');
		$("#form").validator();
		show_hide_form(true);
	});

	$('#cancelBtn').click(function(){
		$("#form").validator('destroy');
		show_hide_form_detail(false);
		$('#form')[0].reset();
	});

    $("#saveBtn").click(function (e) {
         var validator = $("#form").data("bs.validator");
         validator.validate();
         if (!validator.hasErrors()){
            save_data();
         }
	 });

    var materials;
    $.ajax({
    	url: site_url+'purchasing/get_materials',
    	type: "GET",
    	async: false,
    	success : function(text)
    	{
    		materials = JSON.parse(text);
    	}
    });

    $("#jsGrid1").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	inserting: false, 
    	editing: false, 
    	deleting: false, 
    	sorting: true, 
    	paging: true, 

        // data: lists, 
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "receiving/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	},
        	insertItem: function(item) {
        		item["csrf_token"] = $("[name='csrf_token']").val();
        		console.log(item)
        		return $.ajax({
        			type: "POST",
        			url: "receiving/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item,
        			dataType:"JSON"
        		});
        	},
        	updateItem: function(item) {
        		return $.ajax({
        			type: "PUT",
        			url: "receiving/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item
        		});
        	},
        	deleteItem: function(item) {
        		return $.ajax({
        			type: "DELETE",
        			url: "receiving/jsgrid_functions",
        			data: item
        		});
        	}
        },

        fields: [ 
        { name: "id", visible:false }, 
        { name: "name", title:"Item Name", type: "select", items: materials, valueField: "Id", textField: "Name", width: 150, validate: "required" }, 
        { name: "qty", title:"Qty", type: "number", width: 50 }, 
        { name: "price", title:"Price", type: "number", width: 200 },  
        { type: "control", deleteButton: false, editButton: false } 
        ] 
    }); 
	
});

function show_hide_form(bShow){
	if(bShow==true){
		$('#form-panel').show();
		$('#table-panel').hide();
		$('#detail-panel').hide();
	}else{
		$('#form-panel').hide();
		$('#detail-panel').hide();
		$('#table-panel').show();
	}
}

function show_hide_form_detail(bShow){
	if(bShow==true){
		$('#table-panel').hide();
		$('#detail-panel').show();
	}else{
		$('#detail-panel').hide();
		$('#table-panel').show();
	}
}

function reload_table(){
	table.ajax.reload(null,false); //reload datatable ajax 
} 

function save_data(){
	var url;
	if(action == "Add"){
		url = site_url+"receiving/add";
	}else{
		url = site_url+"receiving/update";
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
			   if(data.status){
				   reload_table();
				   $("#saveBtn").text("Save");
				   $("#saveBtn").prop('disabled', false);
				   $('div.block-div').unblock();
				   show_hide_form(false);
				   $('#form')[0].reset();
			   }else{
				   alert('Fail');
			   }
		   }
	   });
   }

function receiving(id) {
	var url;
	url = site_url+"receiving/add/"+id;
   
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
				   $("#saveBtn").text("Save");
				   $("#saveBtn").prop('disabled', false);
				   $('div.block-div').unblock();
				   show_hide_form(false);
				   $('#form')[0].reset();
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
			url : site_url+"receiving/get_by_id/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('#code').val(data.code);
				$('#receive_date').val(data.receive_date);
				$('#vendors_id').val(data.vendors_id);			
				$("#form").validator();
				$('#form-title').text('Edit Form');
				show_hide_form(true);
			}
		});
}

function details(id){
	$.ajax({
			url : site_url+"receiving/get_by_id/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('#code1').val(data.code);
				$('#date1').val(data.receive_date);
				$("#form").validator();
				$('#form-title').text('Details');
				$('[name="asd"]').val(id);
				$('#jsGrid1').jsGrid('loadData');
				show_hide_form_detail(true);
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
				url : site_url+"receiving/delete/"+id,
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
