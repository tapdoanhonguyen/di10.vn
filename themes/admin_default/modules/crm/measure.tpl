<!-- BEGIN: main -->
<!-- BEGIN: view -->
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>{LANG.weight}</th>
					<th>{LANG.measure_name}</th>
					<th>{LANG.status}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td>
    						<select class="form-control" id="id_weight_{VIEW.measure_id}" onchange="nv_change_weight('{VIEW.measure_id}');">
    						<!-- BEGIN: weight_loop -->
    							<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
    						<!-- END: weight_loop -->
                            </select>
				    </td>
					<td> {VIEW.measure_name} </td>
					<td> {VIEW.status} </td>
					<td class="text-center">
                        <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a>
                         - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a>
                    </td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->
    <!-- BEGIN: error -->
    <div class="alert alert-warning">{ERROR}</div>
    <!-- END: error -->
    <form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    	<input type="hidden" name="measure_id" value="{ROW.measure_id}" />
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-hover">
    			<tbody>
    				<tr>
    					<td> {LANG.measure_name} </td>
    					<td><input class="form-control" type="text" name="measure_name" value="{ROW.measure_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
    				</tr>
    				<tr>
    					<td> {LANG.status} </td>
    					<td><select class="form-control" name="status">
    					<option value=""> --- </option>
    					<!-- BEGIN: select_status -->
    					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
    					<!-- END: select_status -->
    				</select></td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    	<div style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
    </form>
<script type="text/javascript">
//<![CDATA[
	function nv_change_weight(id) {
		var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
		var new_vid = $('#id_weight_' + id).val();
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=measure&nocache=' + new Date().getTime(), 'ajax_action=1&measure_id=' + id + '&new_vid=' + new_vid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] != 'OK') {
				alert(nv_is_change_act_confirm[2]);
			}
			clearTimeout(nv_timer);
			window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=measure';
			return;
		});
		return;
	}
//]]>
</script>
<!-- END: main -->