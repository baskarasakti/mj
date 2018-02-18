var table;
var action;

$(document).ready(function() {

	$('#date').datepicker({
		format: 'yyyy-mm-dd' 
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

	$("#jsGrid").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	inserting: false, 
    	editing: true, 
    	sorting: true, 
    	paging: true, 

		rowClick: function(args) {
			alert(args.item);
			$.extend(args.item, {id:2, name:"Test23", qty:93, note:"OKOK"});
			
	$("#jsGrid").jsGrid("updateItem",  args.item);
        },
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "pickup_material/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	},
        	deleteItem: function(item) {
        		return $.ajax({
        			type: "DELETE",
        			url: "pickup_material/jsgrid_functions",
        			data: item
        		});
        	}
        },

        fields: [ 
        { name: "id" }, 
        { name: "name", title:"Item Name", type: "text", width: 150 }, 
        { name: "qty", title:"Qty", type: "number", width: 50 }, 
        { name: "note", title:"Note", type: "textarea", width: 200 },  
		{ 
			type: "control",
			modeSwitchButton: false,
			editButton: false 
		} 
        ] 
	}); 
	
	var jsadd = function(){
		var data = {id:1, name:"Test", qty:9, note:"OK"};
		var data2 = {id:2, name:"Test2", qty:92, note:"OK2"};
		$("#jsGrid").jsGrid("insertItem", data);
		$("#jsGrid").jsGrid("insertItem", data2);
	}
	jsadd();
	
	var data2 = {id:2, name:"Test2", qty:92, note:"OK2"};
	var data = {id:2, name:"Test23", qty:93, note:"OKOK"};
	$("#jsGrid").jsGrid("updateItem", data2, data);
	

	
	$( "#work_orders_code" ).autocomplete({
		maxShowItems: 5,
		source: site_url+"work_orders/populate_autocomplete",
		minLength: 2,
		select: function( event, ui ) {
		  $('[name="work_orders_id"]').val(ui.item.id);
		  $('#jsGrid').jsGrid('loadData');
		  generateID();	
		}
	});

	function generateID(){
		$.ajax({
			url : site_url+"pickup_material/generate_id",
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$("#code").val(data.id);
			}
		});	
	}
	  
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
            url: site_url+'pickup_material/view_data',
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
		url = site_url+"pickup_material/add";
	}else{
		url = site_url+"pickup_material/update";
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

function add(id){
	action = "Add";
	$('[name="change_id"]').val(id);
	$.ajax({
			url : site_url+"pickup_material/get_by_id/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				// $('#date').val(data.usage_date);				
				$("#form").validator();
				$('#form-title').text('Edit Form');
				$('[name="asd"]').val(id);
				// $('#jsGrid').jsGrid('loadData');
				show_hide_form(true);
			}
		});
}

function edit(id){
	action = "Edit";
	$('[name="change_id"]').val(id);
	$.ajax({
			url : site_url+"pickup_material/get_by_id/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('#date').val(data.usage_date);			
				$('#usage_categories').val(data.usage_categories_id);			
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
				url : site_url+"pickup_material/delete/"+id,
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
