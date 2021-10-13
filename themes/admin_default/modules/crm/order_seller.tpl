<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="GET" class="form-inline" role="form">
		<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
		<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />

		<div class="form-group">
			<label class="sr-only">{LANG.date_from}</label>
			<input type="text" name="from" id="from" value="{SEARCH.date_from}" class="form-control" placeholder="{LANG.date_from}" readonly="readonly">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.date_to}</label>
			<input type="text" name="to" id="to" value="{SEARCH.date_to}" class="form-control" placeholder="{LANG.date_to}" readonly="readonly">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.order_phone}</label>
			<input type="text" name="order_phone" value="{SEARCH.order_phone}" class="form-control" placeholder="{LANG.order_phone}">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.order_payment}</label>
			<select class="form-control" name="order_payment">
				<option value="">{LANG.order_payment}</option>
				<!-- BEGIN: transaction_status -->
				<option value="{TRAN_STATUS.key}" {TRAN_STATUS.selected}>{TRAN_STATUS.title}</option>
				<!-- END: transaction_status -->
			</select>
		</div>
		<div class="form-group">
			<input type="hidden" name ="checkss" value="{CHECKSESS}" />
			<input type="submit" class="btn btn-primary" name="search" value="{LANG.search}" />
            <button class="btn btn-success exportexcel" onclick="nv_export_excel(); return false;">{LANG.export_excel}</button>
            <span id="loading_bar"></span>
		</div>
	</form>
</div>

<!-- BEGIN: data -->
<div class="clearfix"></div>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead class="text-center">
			<tr>
				<td rowspan="2"><strong>{LANG.order_name}</strong></td>
				<td rowspan="2"><strong>{LANG.mobile}</strong></td>
				<td rowspan="2"><strong>{LANG.saler_name}</strong></td>
				<!-- BEGIN: title_status -->
                <td colspan="2"><strong>{title_status}</strong></td>
				<!-- END: title_status -->
			</tr>
		<tr>
			<!-- BEGIN: title_status_2 -->
			<td>{LANG.total_num_order}</td>
			<td>{LANG.total_price}</td>
			<!-- END: title_status_2 -->
		</tr>
		</thead>
		<tbody>
			<!-- BEGIN: row -->
			<tr >
				<td>{CUSTOMER.full_name}</td>
				<td>{CUSTOMER.mobile}</td>
				<td>{CUSTOMER.saller_name}</td>
				<!-- BEGIN: value_status -->
				<td><strong>{STATUS.total_order} <!-- BEGIN: link --><a href="{STATUS.link}"><i class="fa fa-search">&nbsp;</i></a><!-- END: link --></strong></td>
				<td><strong class="blue">{STATUS.total_price}</strong></td>
				<!-- END: value_status -->
			</tr>
			<!-- END: row -->
		</tbody>
	</table>
</div>
<!-- END: data -->

<script type="text/javascript">
    function nv_export_excel()
    {
    	$('.exportexcel').attr('disabled', 'disabled');
    	$('#loading_bar').html('<center><img src="'+ nv_base_siteurl + 'assets/images/load_bar.gif" alt="" />&nbsp;{LANG.waiting}...</center>');
    	$.post(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=exportorderseller&nocache=' + new Date().getTime(), 'order_id={order_id}', function(res) {
    		var r_split = res.split('_');
    		if(r_split[0] == 'OK'){
    			$("#loading_bar").hide();
    			alert(r_split[1]);
    			$('.exportexcel').removeAttr('disabled');
    			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=exportorderseller&step=2';
    		}else{
    			$("#loading_bar").hide();
    			alert(r_split[1]);
    			$('.exportexcel').removeAttr('disabled');
    		}
    	});	
    }
	$(document).ready(function() {
		$("#from,#to").datepicker({
			showOn : "both",
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
			buttonImageOnly : true
		});
	});
</script>
<!-- END: main -->