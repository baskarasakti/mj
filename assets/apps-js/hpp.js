var table;
var action;
var method;

$(document).ready(function() {

	var form_drop_down = function(el, type) {
		$.ajax({
			url: site_url+"work_orders/populate_month_year/"+type,
			type: "GET",
			dataType: "JSON",
			success:function(resp){
				var option = "<option value='' selected>Choose..</option>";
                $.each(resp, function(k, v){
                    option += "<option value='"+v.id+"'>"+v.value+"</option>";
                });
				$(el).html(option);
				if(type == "year"){
					$(el).val(moment().format("Y"));
				}
			}
		});
	}

	form_drop_down("#month", "month");
	form_drop_down("#year", "year");

	$("#month, #year").change(function(){
		populate_product_select("");
	});

	$("#jsGrid").jsGrid({ 
    	width: "100%", 
    	height: "400px", 
    	inserting: false, 
    	editing: false, 
    	sorting: true, 
    	paging: true, 
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "hpp/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	}
        },

        fields: [ 
        { name: "category", title:"Category", type: "text", width: 150 },
        { name: "name", title:"Item Name", type: "text", width: 150 },
        { name: "pick", title:"Pick", type: "text" },
        { name: "used", title:"Used", type: "text" },
        { name: "return", title:"Return", type: "text" },
        { name: "unit_price", title:"Price", type: "number" },
        { name: "total_price", title:"Total", type: "number" }
        ] 
	}); 
	

	$("#jsGrid2").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	inserting: false, 
    	editing: false, 
    	sorting: true, 
    	paging: true, 

		rowClick: function(args) {
			method = "Edit";
			editedRow = args.item;
			get_pick_detail(args.item);
        },
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: "btkl/jsgrid_functions/"+$('[name="asd"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	}
        },

        fields: [ 
        { name: "id", visible: false }, 
        { name: "processes_id", title:"Process", type: "text" }, 
		{ name: "qty", title:"Qty", type: "number" }, 
		{ name: "price", title:"Price", type: "number" },  
        { name: "total_price", title:"Total", type: "number" }
        ] 
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
		$("#saveBtn").prop('disabled', false);
		show_hide_form(true);
		$("[name='asd']").val(-1);
		$('#jsGrid').jsGrid('loadData');
		$('#jsGrid2').jsGrid('loadData');
	});

	$('#cancelBtn').click(function(){
		$("#form").validator('destroy');
		show_hide_form(false);
		$('#form')[0].reset();
		$('#form3')[0].reset();
		$("[name='asd']").val(-1);
		$('#jsGrid').jsGrid('loadData');
		$('#jsGrid2').jsGrid('loadData');
	});

	$('#cancelBtn2').click(function(){
		method = "";
		$('#form2')[0].reset();
	});

    $("#saveBtn").click(function (e) {
         var validator = $("#form").data("bs.validator");
         validator.validate();
         if (!validator.hasErrors()){
			save_data();
         }
	 });

	 $("#saveBtn2").click(function (e) {
		var validator = $("#form2").data("bs.validator");
		validator.validate();
		if (!validator.hasErrors()){
			save_pick_detail()
		}
	});

	$("#saveBtn3").click(function (e) {
		var validator = $("#form3").data("bs.validator");
		validator.validate();
		if (!validator.hasErrors()){
			save_hpp_bop()
		}
	});

	var save_pick_detail = function(){
		var data = $("#form2").serializeArray();
		data.push({name: 'csrf_token',value: $("[name='csrf_token']").val()});
		data.push({name: 'hpp_id',value: $("[name='asd']").val()});
		var url = site_url+"btkl/update";
		if(method != "Edit"){
			url = site_url+"btkl/add";
		}
		$.ajax({
			url : url,
			type: "POST",
			data: data,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					method = "";
					$('#form2')[0].reset();
					$('#jsGrid2').jsGrid('loadData');
				}
			}
		});
	}	 

	var save_hpp_bop = function(){
			var data = $("#form3").serializeArray();
			data.push({name: 'csrf_token',value: $("[name='csrf_token']").val()});
			data.push({name: 'hpp_id',value: $("[name='asd']").val()});
			var url = site_url+"hpp/update_bop";
			$.ajax({
				url : url,
				type: "POST",
				data: data,
				dataType: "JSON",
				success: function(data)
				{
					if(data.status){
						alert("Saved!");
					}
				}
			}); 	
	 }

	 var get_pick_detail = function(data){
		$('[name="details_id"]').val(data.id);
		$('[name="process"]').val(data.processes_id);
		$('[name="qty"]').val(data.qty);
		$('[name="price"]').val(data.price);
	 }

	 var generate_info = function(msg){
		$.toast({
			heading: 'Material out of stock',
			text: msg,
			position: 'top-right',
			loaderBg:'#ff6849',
			icon: 'error',
			hideAfter: 10000, 
			stack: 6
		  });
	 }

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
			   if(data.id){
				   	reload_table();
					$("#saveBtn").text("Saved");
					$("#saveBtn").prop('disabled', true);
					$('div.block-div').unblock();
					$('[name="asd"]').val(data.id);
					$('#jsGrid').jsGrid('loadData');
				 	$('#jsGrid2').jsGrid('loadData');
					if(action == "Add"){
						$('[name="code"]').val(data.code);
					}
					populate_product_materials("");
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
				// $('#jsGrid2').jsGrid('loadData');
				show_hide_form(true);
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
				$('#month').val(data.month);			
				$('#year').val(data.year);			
				$('#code').val(data.code);			
				$('#penyusutan').val(data.penyusutan);			
				$('#listrik').val(data.listrik);			
				$('#lain_lain').val(data.lain_lain);			
				populate_product_select(data.products_id);	
				$("#form").validator();
				$('#form-title').text('Edit Form');
				$('[name="asd"]').val(id);
				$('#jsGrid').jsGrid('loadData');
				$('#jsGrid2').jsGrid('loadData');
				$("#saveBtn").prop('disabled', true);
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


function populate_product_select(selected){
	$.ajax({
		url: site_url+"work_orders/get_product_by_month_year",
		type: "GET",
		data:{
			month:$("#month").val(),
			year:$("#year").val()
		},
		dataType: "JSON",
		success:function(resp){
			var option = "<option value='' selected>Choose..</option>";
			$.each(resp, function(k, v){
				option += "<option value='"+v.id+"'>"+v.code+" - "+v.name+"</option>";
			});
			$("#products_id").html(option);
			$("#products_id").val(selected);
		}
	});
}

function getMateriaTotal(){
	var total = 0;
	var data = $("#jsGrid").jsGrid("option", "data");
	console.log(data); 
}



