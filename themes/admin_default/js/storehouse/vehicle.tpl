<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<style type="text/css">
	.select2-container--default{
		width: 100% !important;
	}
	
</style>
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.vehicle}       </h2>

        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
<!-- BEGIN: view -->

		<div class="well">
		<form action="{NV_BASE_ADMINURL}index.php" method="get">
		    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
		    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
		    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
		    <div class="row">
		        <div class="col-xs-24 col-md-6">
		            <div class="form-group">
		                <input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
		            </div>
		        </div>
		        <div class="col-xs-12 col-md-3">
		            <div class="form-group">
		                <input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
		            </div>
		        </div>
		    </div>
		</form>
		</div>
		<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
		    <div class="table-responsive">
		        <table class="table table-striped table-bordered table-hover">
		            <thead>
		                <tr>
		                    <th>{LANG.date}</th>
		                    <th>{LANG.customer_id}</th>
		                    <th>{LANG.warehouse_id}</th>
		                     <th>{LANG.project}</th>
		                    <th>{LANG.status}</th>
		                    <th class="w150">&nbsp;</th>
		                </tr>
		            </thead>
		            <!-- BEGIN: generate_page -->
		            <tfoot>
		                <tr>
		                    <td class="text-center" colspan="11">{NV_GENERATE_PAGE}</td>
		                </tr>
		            </tfoot>
		            <!-- END: generate_page -->
		            <tbody>
		                <!-- BEGIN: loop -->
		                <tr>
		                    <td> {VIEW.date} </td>
		                    <td> {VIEW.customer_id} </td>
		                    <td> {VIEW.warehouse_id} </td>
		                    <td> {VIEW.title} </td>
		                    <td> {VIEW.status} </td>
		                    <td class="text-center"><a href="{VIEW.link_view_vehicle}" > {LANG.vehicle_view}</a></td>
		                </tr>
		                <!-- END: loop -->
		            </tbody>
		        </table>
		    </div>
		</form>
		   
		<!-- END: view -->
		
		<!-- BEGIN: project -->
		
		<!-- BEGIN: add_vehicle_button -->
		<button id="add">Thêm tài xế giao hàng</button>
		<!-- END: add_vehicle_button -->
		<!-- BEGIN: edit_vehicle_button -->
		<button id="edit"> Cập nhật  tài xế giao hàng</button>
		<!-- END: edit_vehicle_button -->
		<!-- BEGIN: adduser_vehicle_button -->
		<button id="adduser"> Thêm nhân viên vào dự án </button> 
		<!-- END: adduser_vehicle_button -->
		<!-- BEGIN: view_vehicle_button -->
		<button id="view"> Xem lộ trình giao hàng</button> 
		<!-- END: view_vehicle_button -->
		<!-- BEGIN: check_vehicle_button -->
		<button id="check">Xác nhận chất lượng bê tông</button>
		<!-- END: check_vehicle_button --> 
		<div id="details" >
			<!-- BEGIN: add_vehicle_content -->
			<div id="add_vehicle_content">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_vehicle" name="form_add_vehicle">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <input type="hidden" name="saleid"  value="{saleid}" />
				    <div class="row">
				        
				        <div id="ablist" class="form-inline col-xs-24 col-md-24 ">
						    <select multiple id="users" class="form-control" name="users[]">
						    	
						    </select>
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="create_vehicle" type="button">{LANG.create_vehicle}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: add_vehicle_content -->
			<!-- BEGIN: edit_vehicle_content -->
			<div id="edit_vehicle_content" style="display:none">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_vehicle" name="form_add_vehicle">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <div class="row">
				        
				        <div id="ablist" class="form-inline col-xs-24 col-md-24 ">
						    <select multiple id="users" class="form-control" name="users[]">
						    	
						    </select>
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="create_vehicle" type="button">{LANG.create_vehicle}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: edit_vehicle_content -->
			<!-- BEGIN: view_vehicle_content -->
			<div id="view_vehicle_content">
				<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
				    <div class="table-responsive">
				        <table class="table table-striped table-bordered table-hover">
				            <thead>
				                <tr>
				                    <th>{LANG.project}</th>
				                    <th>{LANG.timedelivery}</th>
				                     <th>{LANG.vehicle_member}</th>
				                    <th>{LANG.status}</th>
				                    <th class="w150">&nbsp;</th>
				                </tr>
				            </thead>
				            <!-- BEGIN: generate_page -->
				            <tfoot>
				                <tr>
				                    <td class="text-center" colspan="11">{NV_GENERATE_PAGE}</td>
				                </tr>
				            </tfoot>
				            <!-- END: generate_page -->
				            <tbody id="log_vehicle">
				            </tbody>
				        </table>
				    </div>
				</form>
			</div>
			<!-- END: view_vehicle_content -->
			<!-- BEGIN: check_vehicle_content -->
			<!-- END: check_vehicle_content -->
			<!-- BEGIN: tran_vehicle_content -->
			<div id="tran_vehicle_content">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_vehicle" name="form_add_vehicle">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <input type="hidden" name="saleid"  value="{saleid}" />
				    <div class="row">
				        <div id="ablist" class="form-inline col-xs-24 col-md-24 ">
						    <select multiple id="tran_users" class="form-control" name="tran_users[]">
						    	
						    </select>
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="tran_vehicle" type="button">{LANG.tran_vehicle}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: tran_vehicle_content -->
		</div>
		<div id="details_items_sales" >
			<table class="table table-striped table-bordered table-hover">
				<thead>
				    <tr>
				        <th>{LANG.project}</th>
				        <th>{LANG.quantity}</th>
				    </tr>
				</thead>
				<tbody>
				<!-- BEGIN: items -->
					 <tr>
		                <td> {ITEMS.product_name} </td>
		                <td> {ITEMS.quantity_dec} {ITEMS.unit}</td>
		            </tr>
				<!-- END: items -->
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
		
		function add_log_vehicle (form) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=add_vehicle';
			//var formData = form.find('input[name="daystart"]').val();
			var formData = form.serialize();
			console.log(formData);
			var posting = $.post( url,formData );
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status == 'OKE'){
					alert(data.text);
					log_vehicle (data.project,data.sale);
		    		$("#view_vehicle_content").show();
				}else{
					alert(data.text);
					return false;
				}
				
			});
		}
		
		function process_vehicle (projectid,saleid,id,action) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=process_vehicle';
			if(action==1){
				 url += '&process=1';
			}else{
				if(action==2){
					 url += '&checkpro=1';
				}else{
					if(action==3){
						url += '&checkprosu=1';
					}
				}
			}
			
			var posting = $.post( url,'projectid='+ projectid+'&saleid=' + saleid + '&id='+ id + '&status='+action);
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status == 'OKE'){
					alert(data.text);
					
					log_vehicle (data.project,data.sale);
		    		$("#view_vehicle_content").show();
		    		if(action==3){
		    			window.location.href = window.location.href;
		    		}
				}else{
					alert(data.text);
					return false;
				}
				
			});
		}
		function log_vehicle (projectid,saleid) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=log_vehicle&saleid='+saleid+'&projectid='+projectid;
			var data =[];
			var posting = $.post( url, data);
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status == 'OKE'){
					console.log(data.content);
					//$.each(data.content, function( index, value ) {
					  	var content = '<tr>' +
									' <td> ' +
										 data.content.projectname +
									'</td>' +
									' <td> ' +
										 data.content.day_start +
									'</td>' +
									' <td> ' +
										 data.content.employees +
									'</td>' +
									'<td>' +
										data.content.status +
									'</td>' +
									'<td> ';
						if(data.content.process)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.process_vehicle}</button>';
						if(data.content.checkpro)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.check_vehicle}</button>';
						if(data.content.checkprosu)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.check_vehicle_success}</button>';
							content += '</td>' +
								'</tr>';
						$('#log_vehicle').html(content);
					//});
					
				}else{
					var content = '{LANG.no_log_on_project}';
					$('#log_vehicle').html(content);
				}
				
			});
		}
		 	$(document).ready(function () {
		 			$("#daystart,#dayend").datepicker({
				        showOn : "both",
				        dateFormat : "dd/mm/yy",
				        changeMonth : true,
				        changeYear : true,
				        showOtherMonths : true,
				        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
				        buttonImageOnly : true
				    });
		 			<!-- BEGIN: add_vehicle_script -->
		 			$("#edit").hide();
		        	$(document).on('click','#add', function(){
		        		console.log('Tạo Lịch sản xuất');
		        		$("#add_vehicle_content").show();
		        		$("#view_vehicle_content").hide();
		        	});
		        	$("#add_vehicle_content").hide();
		        	$(document).on('click','#create_vehicle', function(){
		        		console.log('Tạo lịch thanh công');
		        		
		        		$("#add_vehicle_content").remove();
		        		$("#add").remove();
		        		$("#edit").show();
		        		
		        		add_log_vehicle($(this).parent().parent().parent().parent());
		        	});
		        	$("#view_vehicle_content").hide();
		        	<!-- END: add_vehicle_script -->
		        	<!-- BEGIN: show_view_vehicle -->
			        	log_vehicle({projectid}, {saleid});
			 			$("#view_vehicle_content").show();
		 			<!-- END: show_view_vehicle -->
		        	<!-- BEGIN: edit_vehicle_script -->
		 			$("#add").hide();
		 			
		        	$(document).on('click','#edit', function(){
		        		console.log('Tạo Lịch sản xuất');
		        		$("#edit_vehicle_content").show();
		        		$("#add_vehicle_content").hide();
		        		$("#view_vehicle_content").hide();
		        	});
		        	$("#edit_vehicle_content").hide();
		        	$(document).on('click','#create_vehicle', function(){
		        		console.log('Tạo lịch thanh công');
		        		
		        		$("#add_vehicle_content").remove();
		        		$("#add").remove();
		        		add_log_vehicle($(this).parent().parent().parent().parent());
		        	});
		        	<!-- END: edit_vehicle_script -->
		        	<!-- BEGIN: view_vehicle_script -->
		        	$(document).on('click','#view', function(){
		        		console.log('Xem lộ trình sản xuất');
		        		log_vehicle({projectid}, {saleid});
		        		$("#add_vehicle_content").hide();
		        		$("#edit_vehicle_content").hide();
		        		$("#view_vehicle_content").show();
		        	});
		        	
		        	<!-- END: view_vehicle_script -->
		        	$(document).on('click','#action', function(){
		        		$("#add_vehicle_content").hide();
		        		$("#edit_vehicle_content").hide();
						if (confirm( '{LANG.process_pro_sche_confirm}' )) {
							process_vehicle($(this).attr('data-project'), $(this).attr('data-sale'), $(this).attr('data-id'),$(this).attr('data-action'));
						}
						$("#add").remove();
						$("#edit").remove();
						$("#view").remove();
		        		log_vehicle({projectid}, {saleid});
		        		$("#view_vehicle_content").show();
		        	});
		
		
		        	
		        	
		        	$("#users").select2({
		        		ajax: {
							url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=list_user',
							dataType: 'json',
							delay: 250,
							data: function (params) {
								return {
									q: params.term,
									groups:23
								};
							},
							processResults: function (data) {
								return {
									results: data
								};
							}
						}
		        	});
		        	$("#tran_users").select2({
		        		ajax: {
							url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=list_user',
							dataType: 'json',
							delay: 250,
							data: function (params) {
								return {
									q: params.term,
									groups:23
								};
							},
							processResults: function (data) {
								return {
									results: data
								};
							}
						}
		        	});
		     });
		 </script>   

<!-- END: project -->
<!-- BEGIN: no_project -->
	{LANG.no_sale_on_project}
<!-- END: no_project -->
	</div>
</div>
<!-- END: main -->