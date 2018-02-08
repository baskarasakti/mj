var table;
var action;

$(document).ready(function() {

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
            url: site_url+'hpp/view_data',
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

	$('#add-btn').click(function(){
		action = "Add";
		$('#form-title').text('Add Form');
		$("#form").validator();
		show_hide_form(true);
	});

	$('#cancelBtn').click(function(){
		$("#form").validator('destroy');
		show_hide_form(false);
		$('#form')[0].reset();
	});

    $("#saveBtn").click(function (e) {
         var validator = $("#form").data("bs.validator");
         validator.validate();
         if (!validator.hasErrors()){
            save_data();
         }
	 });

    var processes;
    $.ajax({
    	url: site_url+'processes/populate_select',
    	type: "GET",
    	async: false,
    	success : function(text)
    	{
    		processes = JSON.parse(text);
    	}
    });

    var materials;
    $.ajax({
    	url: site_url+'materials/populate_select',
    	type: "GET",
    	async: false,
    	success : function(text)
    	{
    		materials = JSON.parse(text);
    	}
    });

   
	
});

function form_jsgrid(id){
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
        			url: "hpp/jsgrid_functions/"+id,
        			data: filter,
        			dataType:"JSON"
        		});
        	},
        	insertItem: function(item) {
        		item["csrf_token"] = $("[name='csrf_token']").val();
        		console.log(item)
        		return $.ajax({
        			type: "POST",
        			url: "products/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item,
        			dataType:"JSON"
        		});
        	},
        	updateItem: function(item) {
        		return $.ajax({
        			type: "PUT",
        			url: "products/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: item
        		});
        	},
        	deleteItem: function(item) {
        		return $.ajax({
        			type: "DELETE",
        			url: "products/jsgrid_functions",
        			data: item
        		});
        	}
        },

        fields: [ 
        { name: "id" }, 
        { name: "material", title:"Material", type: "number", width: 50 }, 
        { name: "qty", title:"Qty", type: "number", width: 100 }, 
        { name: "unit_price", title:"unit_price", type: "number", width: 100 }, 
        { type: "control" } 
        ] 
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
		url = site_url+"hpp/add";
	}else{
		url = site_url+"hpp/update";
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

function edit(id){
	action = "Edit";
	$('[name="change_id"]').val(id);
	$.ajax({
			url : site_url+"hpp/get_by_id/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('#code').val(data.code);
				$('#name').val(data.name);
				$("#form").validator();
				$('#form-title').text('Edit Form');
				form_jsgrid(id);
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
				url : site_url+"hpp/delete/"+id,
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
