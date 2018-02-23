var table;
var table1;
var woid = -1;
var pid = -1;
var prid = -1;
var action;

$(document).ready(function() {

	$('#receive_date').datepicker({
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

    var columns1 = [];
    var right_align1 = [];
    $("#datatable1").find('th').each(function(i, th){
        var field = $(th).attr('data-field');
        var align = $(th).attr('data-align');
        columns1.push({data: field, name: field});
        if(align == "right")
            right_align1.push(i);
    });

    table = $('#datatable').DataTable({
        dom: 'lrftip',
        responsive: true,
        pageLength: 10,
        deferRender: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        ajax: {
            url: site_url+'product_movement_detail/view_data/'+$('[name="pid"]').val(),
            type: "POST",
            dataSrc : 'data',
            data: function ( d ) {
                d.csrf_token = $("[name='csrf_token']").val();
            }
        },
        columns: columns,
        columnDefs: [ 
            { className: "dt-body-right", targets: right_align },
            { "orderable": false, targets : [-1]  },
            { "visible": false, targets : [0]  } 
        ]
    });

    table1 = $('#datatable1').DataTable({
        dom: 'lrftip',
        responsive: true,
        pageLength: 10,
        deferRender: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        ajax: {
            url: site_url+'product_movement_detail/view_data1/'+woid+'/'+pid+'/'+prid,
            type: "POST",
            dataSrc : 'data',
            data: function ( d ) {
                d.csrf_token = $("[name='csrf_token']").val();
            }
        },
        columns: columns1,
        columnDefs: [ 
            { className: "dt-body-right", targets: right_align1 },
            { "orderable": false, targets : [-1]  } ,
            { "visible": false, targets : [0]  } 
        ]
    });

    $('#datatable tbody').on( 'click', 'tr', function () {

        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
        }
        else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
        }
        var id = table.row( this ).data().id;
        woid = $("[name='woid']").val();
        pid = $("[name='pid']").val();
        prid = id;
        table1.ajax.url(site_url+'product_movement_detail/view_data1/'+woid+'/'+pid+'/'+prid).load();
        $('#add-btn').show();
        $('#nopo').text(table.row( this ).data().code);
    } );
	
    $('#form-panel').hide();
	$('#form-panel1').hide();

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

    $('#cancelBtn1').click(function(){
		$("#form1").validator('destroy');
		show_hide_form(false);
		$('#form1')[0].reset();
	});

    $("#saveBtn1").click(function (e) {
         var validator = $("#form1").data("bs.validator");
         validator.validate();
         if (!validator.hasErrors()){
            saveSelectedItems();
         }
	 });

    $("#processes_id").change(function (e) {
        $.ajax({
            url: site_url+'machine/populate_select',
            type: "GET",
            data: {
                processes_id: this.value
            },
            dataType:"JSON",
            success : function(resp)
            {
                var option = "<option value='' selected>Choose..</option>";
                $.each(resp, function(k, v){
                    option += "<option value='"+v.code+"'>"+v.code+"</option>";
                });
                $("#machine_id").html(option);
                // $("#machine_id").val();
            }
        });
    })


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

    $("#jsGrid").jsGrid({ 
    	width: "100%", 
    	height: "400px", 

    	inserting: false, 
    	editing: false, 
    	sorting: true, 
    	paging: true, 

        // data: lists, 
        controller: {
        	loadData: function(filter) {
        		return $.ajax({
        			type: "GET",
        			url: site_url+"product_movement_detail/jsgrid_functions/"+$('[name="woid"]').val()+"/"+$('[name="pid"]').val()+"/"+$('[name="prid"]').val(),
        			data: filter,
        			dataType:"JSON"
        		});
        	}
        },

        fields: [ 
        {
            headerTemplate: function() {
                return "Choose";
            },
            itemTemplate: function(_, item) {
                return $("<input>").attr("type", "checkbox")
                .prop("checked", $.inArray(item.id, selectedItems) > -1)
                .on("change", function () {
                    $(this).is(":checked") ? selectItem(item.id) : unselectItem(item.id);
                });
            },
            align: "center",
            width: 50
        },
        { name: "id", visible:false }, 
        { name: "code", title:"Code", type: "text", width: 50 }, 
        { type: "control", editButton: false, deleteButton: false } 
        ] 
    });

    var selectedItems = [];
 
    var selectItem = function(item) {
        selectedItems.push(item);
    };
 
    var unselectItem = function(item) {
        selectedItems = $.grep(selectedItems, function(i) {
            return i !== item;
        });
    };
 
    var saveSelectedItems = function() { 
        saveClients(selectedItems);
        console.log(selectedItems);
        selectedItems = [];
    };
 
    var saveClients = function(item) {
        $.ajax({
            url : site_url+"product_movement_detail/update_process",
            data: {
                csrf_token: $("[name='csrf_token']").val(),
                item: item,
                process_id: $("[name='processes_id']").val(),
                machine_id: $("[name='machine_id']").val(),
                pm_id: $("[name='pm_id']").val()
            },
            type: "post",
            dataType: "JSON",
            success:function(data){
                if (data.status) {
                    alert("Success");
                    var $grid = $("#jsGrid");
                    $grid.jsGrid("option", "pageIndex", 1);
                    $grid.jsGrid("loadData");
                }
            }
        });
    };
	
});

function show_hide_form(bShow){
    if(bShow==true){
        $('#form-panel').show();
        $('#form-panel1').hide();
        $('#table-panel').hide();
    }else{
        $('#form-panel').hide();
        $('#form-panel1').hide();
        $('#table-panel').show();
    }
}

function show_hide_form1(bShow){
	if(bShow==true){
        $('#form-panel').hide();
		$('#form-panel1').show();
		$('#table-panel').hide();
	}else{
        $('#form-panel').hide();
		$('#form-panel1').hide();
		$('#table-panel').show();
	}
}

function reload_table(){
	table.ajax.reload(null,false); //reload datatable ajax 
} 

function save_data(){
	var url;
	if(action == "Add"){
		url = site_url+"product_movement_detail/generate_code/"+$('[name="woid"]').val()+"/"+$('[name="pid"]').val();
	}else{
		url = site_url+"product_movement_detail/update/"+$('[name="woid"]').val()+"/"+$('[name="pid"]').val();
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
				   $("#saveBtn").text("Save");
				   $("#saveBtn").prop('disabled', false);
				   $('div.block-div').unblock();
				   $('[name="asd"]').val(data.id);
				   show_hide_form(false);
				   $('#form')[0].reset();
			   }else{
				   alert('Fail');
			   }
		   }
	   });
   }

function edit(woid, pid, prid, pmid){
    action = "Edit";
    $('[name="prid"]').val(prid);
    $('[name="pm_id"]').val(pmid);
    $("#form1").validator();
    $('#form-title').text('Edit Form');
    $('#jsGrid').jsGrid('loadData');
    show_hide_form1(true);
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
				url : site_url+"product_movement_detail/delete/"+id,
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
