<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<table class="table table-striped table-bordered table-hover">
	<tbody>
		<tr>
            <td>
                <strong>{LANG.full_name}</strong>
            </td>
            <td>{ROW.full_name}</td>
			<td> <strong>{LANG.birthday}</strong> </td>
			<td>{ROW.birthday}</td>
		</tr>
		<tr>
			<td> <strong>{LANG.email}</strong> </td>
			<td>{ROW.email}</td>
			<td> <strong>{LANG.sex}</strong> </td>
			<td>{ROW.sex}</td>
		</tr>
		<tr>
			<td> <strong>{LANG.mobile}</strong></td>
			<td>{ROW.mobile}</td>
			<td><strong>{LANG.status}</strong></td>
			<td>{ROW.status_text}</td>
		</tr>
		<tr>
			<td> <strong>{LANG.address}</strong> </td>
			<td>{ROW.address}</td>
            <td> <strong>{LANG.from_by}</strong> </td>
			<td>{ROW.from_by}</td>
		</tr>
	</tbody>
</table>
<div class="table-responsive">
    <form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
        <table class="table table-striped table-bordered table-hover">
            <caption>Ghi thêm lịch sử chăm sóc</caption>
    		<tbody>
    			<tr>
    				<td>{LANG.content_history}</td>
    				<td><textarea class="form-control" name="note" style="width:100%;height:60px"></textarea></td>
    			</tr>
                <tr>
                    <td>{LANG.eventtype_name}</td>
                    <td>
                        <select class="form-control" name="eventtype">
                        <!-- BEGIN: eventtype -->
                            <option value="{EVENT.id}">{EVENT.title}</option>
                        <!-- END: eventtype --> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>{LANG.measure_select}</td>
                    <td>
                        <select class="form-control" name="measureid">
                        <!-- BEGIN: measure -->
                            <option value="{MEASURE.id}">{MEASURE.title}</option>
                        <!-- END: measure --> 
                        </select>
                    </td>
                </tr>
				<tr>
					<td>{LANG.remkt_time}</td>
					<td>
						<input type="text" name="remkt_time" class="form-control" id="remkt_time" value="" />
						<input class="btn btn-primary" onclick="save_history({id});" value="Lưu dữ liệu" />
					</td>
				</tr>
    		</tbody>
    	</table>
    </form>
</div>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>{LANG.admin_action}</th>
				<th>{LANG.date}</th>
                <th>{LANG.content_history}</th>
                <th>{LANG.eventtype_name}</th>
                <th>{LANG.measure_name}</th>
                <th>{LANG.remkt_time}</th>
			</tr>
		</thead>
        <!-- BEGIN: generate_page -->
		<tfoot>
			<tr>
				<td colspan="8">{GENERATE_PAGE}</td>
			</tr>
		</tfoot>
        <!-- END: generate_page -->
		<tbody>
			<!-- BEGIN: loop -->
			<tr>
				<td> {VIEW.adminid} </td>
				<td> {VIEW.addtime} </td>
                <td> <a href="{VIEW.link_users}">{VIEW.content}</a> </td>
                <td> {VIEW.eventtype} </td>
                <td> {VIEW.measureid} </td>
                <td> {VIEW.remkt_time} </td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
<div class="clear">&nbsp;</div>
<script type="text/javascript">
    $("#remkt_time").datepicker({
        showOn : "focus",
        minDate: 1,
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        buttonImage : nv_base_siteurl + "images/calendar.gif",
        buttonImageOnly : true
    });
    function save_history(customerid){
        var note = $('textarea[name=note]').val();
        if( note == '' ){
            alert('Bạn chưa nhập nội dung ghi chú');
            $('textarea[name=note]').focus();
            return;
        }else{
            var eventtype = $('select[name=eventtype]').val();
            var measureid = $('select[name=measureid]').val();
            var remkt_time = $('input[name=remkt_time]').val();
            $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'save=1&customerid=' + customerid + '&note=' + note + '&eventtype='+eventtype+'&measureid='+measureid +'&remkt_time=' + remkt_time +'&num=' + nv_randomPassword( 8 ), function(res) {
        		if( res == "OK"){
        		  window.location.href=window.location.href;
        		}else{
        		  alert('Lỗi không lưu nội dung');
        		}
        	});
        }
    }
</script>
<!-- END: main -->