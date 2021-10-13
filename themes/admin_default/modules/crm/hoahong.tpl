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
			<label class="sr-only">{LANG.order_nhanvien}</label>
			<select name="order_nhanvien" id="" class="form-control">
				<option value="0">Tìm theo nhân viên</option>
				<!-- BEGIN: user-->
				<option value="{LISTUSER.userid}"{LISTUSER.sl}>{LISTUSER.username}</option>
				<!-- END: user-->
			</select>
			
		</div>
		<div class="form-group">
			<input type="hidden" name ="checkss" value="{CHECKSESS}" />
			<input type="submit" class="btn btn-primary" name="search" value="{LANG.search}" />
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
				<td><strong>{LANG.saler_name}</strong></td>
				<td><strong>{LANG.donhang}</strong></td>
                <td><strong>{LANG.time_payment}</strong></td>
				<td><strong>{LANG.mobile}</strong></td>
				<td>{LANG.total_price}</td>
				<td>{LANG.doanhthu}</td>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: row -->
			<tr >
				<td>{DATA.saller_name}</td>
				<td><a href="{DATA.detail_order}">{DATA.order_code} - {DATA.order_quotation} - {DATA.full_name}</a></td>
                <td>{DATA.time_payment}</td>
				<td>{DATA.mobile}</td>
				<td><strong class="blue">{DATA.order_total}</strong></td>
				<td><strong class="blue">{DATA.hoahong}</strong></td>
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