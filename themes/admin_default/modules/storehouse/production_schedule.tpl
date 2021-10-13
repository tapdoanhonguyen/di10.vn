<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
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
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.production_schedule}       </h2>

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
		            	<label>{LANG.date_form}</label>
		                <input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
		            </div>
		        </div>
		        <div class="col-xs-12 col-md-3">
		            <div class="form-group">
		            	<label>{LANG.date_to}</label>
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
		                    <td class="text-center"><a href="{VIEW.link_view_pro_sche}" > {LANG.production_schedule_view}</a></td>
		                </tr>
		                <!-- END: loop -->
		            </tbody>
		        </table>
		    </div>
		</form>
		   
		<!-- END: view -->
		
		<!-- BEGIN: project -->
		
		<!-- BEGIN: add_pro_sche_button -->
		<button id="add"> Tạo kế hoạch sản xuất</button>
		<!-- END: add_pro_sche_button -->
		<!-- BEGIN: edit_pro_sche_button -->
		<button id="edit"> Cập nhật kế hoạch sản xuất</button>
		<!-- END: edit_pro_sche_button -->
		<!-- BEGIN: adduser_pro_sche_button -->
		<button id="adduser"> Thêm nhân viên vào dự án </button> 
		<!-- END: adduser_pro_sche_button -->
		<!-- BEGIN: view_pro_sche_button -->
		<button id="view"> Xem lộ trình sản xuất</button> 
		<!-- END: view_pro_sche_button -->
		<!-- BEGIN: check_pro_sche_button -->
		<button id="check">Xác nhận chất lượng bê tông</button>
		<!-- END: check_pro_sche_button --> 
		<!-- BEGIN: tran_pro_sche_button -->
		<button id="tran"> Chuyển hàng ra xe</button> 
		<!-- END: tran_pro_sche_button -->
		<div id="details" >
			<!-- BEGIN: add_pro_sche_content -->
			<div id="add_pro_sche_content">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_pro_sche" name="form_add_pro_sche">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <input type="hidden" name="saleid"  value="{saleid}" />
				    <div class="row">
				        <div class="col-xs-24 col-md-6">
				            <div class="form-group">
				            	<label>{LANG.date_form}</label>
				                <input class="form-control" type="text" value="{daystart}" name="daystart" id="daystart" style="width: 90px;" maxlength="10"  />
				            </div>
				        </div>
				        <div class="col-xs-24 col-md-6">
				            <div class="form-group">
				            	<label>{LANG.date_to}</label>
				                <input class="form-control" type="text" value="{dayend}" name="dayend" id="dayend" style="width: 90px;" maxlength="10"  />
				            </div>
				        </div>
				        <div id="ablist" class="form-inline col-xs-24 col-md-24 ">
				        	<label>{LANG.staff}</label>
						    <select multiple id="users" class="form-control" name="users[]">
						    	
						    </select>
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="create_pro_sche" type="button">{LANG.create_pro_sche}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: add_pro_sche_content -->
			<!-- BEGIN: edit_pro_sche_content -->
			<div id="edit_pro_sche_content" style="display:none">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_pro_sche" name="form_add_pro_sche">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <div class="row">
				        <div class="col-xs-24 col-md-6">
				            <div class="form-group">
				            	<label>{LANG.date_form}</label>
				                <input class="form-control" type="text" value="{daystart}" name="daystart" id="daystart" maxlength="255"  />
				            </div>
				        </div>
				        <div class="col-xs-24 col-md-6">
				            <div class="form-group">
				            	<label>{LANG.date_to}</label>
				                <input class="form-control" type="text" value="{dayend}" name="dayend" id="dayend" maxlength="255"  />
				            </div>
				        </div>
				        <div id="ablist" class="form-inline col-xs-24 col-md-24 ">
						    <select multiple id="users" class="form-control" name="users[]">
						    	
						    </select>
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="create_pro_sche" type="button">{LANG.create_pro_sche}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: edit_pro_sche_content -->
			<!-- BEGIN: view_pro_sche_content -->
			<div id="view_pro_sche_content">
				<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
				    <div class="table-responsive">
				        <table class="table table-striped table-bordered table-hover">
				            <thead>
				                <tr>
				                    <th>{LANG.project}</th>
				                    <th>{LANG.daystart_pro_che}</th>
				                    <th>{LANG.dayend_pro_che}</th>
				                     <th>{LANG.employees}</th>
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
				            <tbody id="log_pro_sche">
				            </tbody>
				        </table>
				    </div>
				</form>
			</div>
			<!-- END: view_pro_sche_content -->
			<!-- BEGIN: check_pro_sche_content -->
			<!-- END: check_pro_sche_content -->
			<!-- BEGIN: tran_pro_sche_content -->
			<div id="tran_pro_sche_content">
				<form action="{NV_BASE_ADMINURL}index.php" method="get" id="form_add_pro_sche" name="form_add_pro_sche">
				    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
				    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
				    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
				    <input type="hidden" name="projectid"  value="{projectid}" />
				    <input type="hidden" name="saleid"  value="{saleid}" />
				    <div class="row">
				        <div class="form-inline col-xs-24 col-md-24 ">
						    <select multiple id="tran_users" class="form-control" name="tran_users[]">
						    	
						    </select>
						</div>
						<div id="ablist" class="form-inline col-xs-24 col-md-24 ">
							
						</div>
				        <div class="col-xs-24 col-md-24">
				            <div class="form-group">
				                <button id="tran_pro_sche" type="button">{LANG.tran_pro_sche}</button>
				            </div>
				        </div>
				    </div>
				</form>
				
			</div>
			<!-- END: tran_pro_sche_content -->
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
		
		function add_log_pro_sche (form) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=add_pro_sche';
			//var formData = form.find('input[name="daystart"]').val();
			var formData = form.serialize();
			console.log(formData);
			var posting = $.post( url,formData );
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status === 'OKE'){
					$("#add_pro_sche_content").remove();
		        		$("#add").remove();
		        		$("#edit").show();
					log_pro_sche (data.project,data.sale);
		    		$("#view_pro_sche_content").show();
		    		$("#check_pro_sche_content").hide();
		    		$("#tran_pro_sche_content").hide();
				}else{
					alert(data.text);
					return false;
				}
				
			});
		}
		function tran_pro_sche (form) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=tran_pro_sche';
			//var formData = form.find('input[name="daystart"]').val();
			var formData = form.serialize();
			console.log(formData);
			var posting = $.post( url,formData );
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status == 'OKE'){
					alert(data.text);
					log_pro_sche (data.project,data.sale);
					$("#tran").hide();
		    		$("#view_pro_sche_content").show();
		    		$("#check_pro_sche_content").hide();
		    		$("#tran_pro_sche_content").hide();
				}else{
					alert(data.text);
					return false;
				}
				
			});
		}
		function process_pro_sche (projectid,saleid,id,action) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=process_pro_sche';
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
					
					log_pro_sche (data.project,data.sale);
		    		$("#view_pro_sche_content").show();
		    		$("#check_pro_sche_content").hide();
		    		$("#tran_pro_sche_content").hide();
		    		if(action==3){
		    			window.location.href = window.location.href;
		    		}
				}else{
					alert(data.text);
					return false;
				}
				
			});
		}
		function log_pro_sche (projectid,saleid) {
			var url = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=log_pro_sche&saleid='+saleid+'&projectid='+projectid;
			var data =[];
			var posting = $.post( url, data);
			// Put the results in a div
			
			posting.done(function( res ) {
				var data = JSON.parse(res);
				if(data.status === 'OKE'){
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
										 data.content.day_end +
									'</td>' +
									' <td> ' +
										 data.content.employees +
									'</td>' +
									'<td>' +
										data.content.status +
									'</td>' +
									'<td> ';
						if(data.content.process)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.process_pro_sche}</button>';
						if(data.content.checkpro)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.check_pro_sche}</button>';
						if(data.content.checkprosu)
							content += '<button id ="action" data-project="' + data.content.projectid + '" data-sale="' + data.content.saleid + '" data-id="' + data.content.id + '" data-user="' + data.content.employeesid + '" data-action="' + data.content.action + '" type="button">{LANG.check_pro_sche_success}</button>';
							content += '</td>' +
								'</tr>';
						$('#log_pro_sche').html(content);
					//});
					
				}else{
					var content = '{LANG.no_log_on_project}';
					$('#log_pro_sche').html(content);
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
		 			<!-- BEGIN: add_pro_sche_script -->
		 			$("#edit").hide();
		        	$(document).on('click','#add', function(){
		        		console.log('Tạo Lịch sản xuất');
		        		$("#add_pro_sche_content").show();
		        		$("#view_pro_sche_content").hide();
		        		$("#check_pro_sche_content").hide();
		        		$("#tran_pro_sche_content").hide();
		        	});
		        	$("#add_pro_sche_content").hide();
		        	$(document).on('click','#create_pro_sche', function(){
		        		console.log('Tạo lịch thanh công');
		        		
		        		add_log_pro_sche($(this).parent().parent().parent().parent());
		        	});
		        	$("#view_pro_sche_content").hide();
		        	<!-- END: add_pro_sche_script -->
		        	<!-- BEGIN: show_view_pro_sche -->
			        	log_pro_sche({projectid}, {saleid});
			 			$("#view_pro_sche_content").show();
		 			<!-- END: show_view_pro_sche -->
		        	<!-- BEGIN: edit_pro_sche_script -->
		 			$("#add").hide();
		 			
		        	$(document).on('click','#edit', function(){
		        		console.log('Tạo Lịch sản xuất');
		        		$("#edit_pro_sche_content").show();
		        		$("#add_pro_sche_content").hide();
		        		$("#view_pro_sche_content").hide();
		        		$("#check_pro_sche_content").hide();
		        		$("#tran_pro_sche_content").hide();
		        	});
		        	$("#edit_pro_sche_content").hide();
		        	$(document).on('click','#create_pro_sche', function(){
		        		console.log('Tạo lịch thanh công');
		        		
		        		$("#add_pro_sche_content").remove();
		        		$("#add").remove();
		        		add_log_pro_sche($(this).parent().parent().parent().parent());
		        	});
		        	<!-- END: edit_pro_sche_script -->
		        	<!-- BEGIN: view_pro_sche_script -->
		        	$(document).on('click','#view', function(){
		        		console.log('Xem lộ trình sản xuất');
		        		log_pro_sche({projectid}, {saleid});
		        		$("#add_pro_sche_content").hide();
		        		$("#edit_pro_sche_content").hide();
		        		$("#view_pro_sche_content").show();
		        		$("#check_pro_sche_content").hide();
		        		$("#tran_pro_sche_content").hide();
		        	});
		        	
		        	<!-- END: view_pro_sche_script -->
		        	
		        	<!-- BEGIN: check_pro_sche_script -->
		        	$(document).on('click','#check', function(){
		        		console.log('Xác nhận chất lượng bê tông');
		        		$("#add_pro_sche_content").hide();
		        		$("#edit_pro_sche_content").hide();
		        		$("#view_pro_sche_content").hide();
		        		$("#check_pro_sche_content").show();
		        		$("#tran_pro_sche_content").hide();
		        	});
		        	$("#check_pro_sche_content").hide();
		        	<!-- END: check_pro_sche_script -->
		        	<!-- BEGIN: tran_pro_sche_script -->
		        	$(document).on('click','#tran', function(){
		        		console.log('Chuyển cho xe đi giao hàng');
		        		$("#add_pro_sche_content").hide();
		        		$("#edit_pro_sche_content").hide();
		        		$("#view_pro_sche_content").hide();
		        		$("#check_pro_sche_content").hide();
		        		$("#tran_pro_sche_content").show();
		        	});
		        	$(document).on('click','#tran_pro_sche', function(){
		        		console.log('Chuyển hàng ra xe');
		        		
		        		$("#add_pro_sche_content").remove();
		        		$("#edit_pro_sche_content").remove();
		        		$("#add").remove();
		        		$("#edit").remove();
		        		tran_pro_sche($(this).parent().parent().parent().parent());
		        	});
		        	$("#tran_pro_sche_content").hide();
		        	<!-- END: tran_pro_sche_script -->
		        	$(document).on('click','#action', function(){
		        		$("#add_pro_sche_content").hide();
						if (confirm( '{LANG.process_pro_sche_confirm}' )) {
							process_pro_sche($(this).attr('data-project'), $(this).attr('data-sale'), $(this).attr('data-id'),$(this).attr('data-action'));
						}
		        		$("#view_pro_sche_content").show();
		        		$("#check_pro_sche_content").hide();
		        		$("#tran_pro_sche_content").hide();
		        	});
		        	
		        	
		        	$("#users").select2({
		        		ajax: {
							url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=list_user',
							dataType: 'json',
							delay: 250,
							data: function (params) {
								return {
									q: params.term,
									groups:25
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
		        	$('#tran_users').on('select2:select', function (e) {
						var data = e.params.data;
						html = '<div id="vehicle_user_' + data.id + '"> Số chuyến xe "<strong>' + data.text + '</strong>" thực hiện :  <input name="vehicle_user_' + data.id + '" /> {LANG.vehicle_unit}</div>';
						$('#ablist').append(html);
					});
					$('#tran_users').on('select2:unselect', function (e) {
						var data = e.params.data;
						console.log(data);
						$('#vehicle_user_' + data.id).remove();	
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