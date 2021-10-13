<!-- BEGIN: main -->
<script type="text/javascript">
    function nv_get_district(provinceid, districtid) {
        if( provinceid == 0 ){
            provinceid = $('select[name=provinceid]').val();
        }
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'loaddistrict=1&provinceid=' + provinceid + '&districtid=' + districtid, function(res) {
			$("#district_data").html( res );
		});
	}
</script>
<!-- BEGIN: view -->
<script type="text/javascript">
    <!-- BEGIN: loaddistrict -->
    nv_get_district('{provinceid}', '{districtid}');
    <!-- END: loaddistrict -->
</script>
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php" method="get">
	<input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
	<input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
	<input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
    
    <table class="table table-striped table-bordered table-hover">
		<tbody>
			<tr>
                <td>
                    <select style="width: 100%;" class="form-control" name="status">
    					<option value="-1">{LANG.status_search}</option>
                        <!-- BEGIN: status_select -->
    					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
    					<!-- END: status_select -->
    			    </select>
                </td>
                <td>
                    <select style="width: 100%;" onchange="nv_get_district(this.value, 0)" class="form-control" name="provinceid">
    					<option value="0">{LANG.province_search}</option>
                        <!-- BEGIN: province_select -->
    					<option value="{OPTION.id}" {OPTION.selected}>{OPTION.title}</option>
    					<!-- END: province_select -->
				    </select>
                </td>
                <td id="district_data">
                    <select style="width: 100%;" class="form-control" name="districtid">
                        <option value="0">{LANG.district_search}</option>
				    </select>
                </td>
                <td>
                    <input class="form-control" placeholder="{LANG.search_title}" style="width: 300px;" type="text" value="{Q}" name="q" maxlength="255" />&nbsp;
	                <input class="btn btn-primary" type="submit" value="{LANG.search}" />
                    &nbsp;<a href="{addcustomer}" class="btn btn-primary">{LANG.addcustomer}</a>
                </td>
            </tr>
        </tbody>
    </table>        
</form>
<br />
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
                    <th>{LANG.district}</th>
					<th>{LANG.full_name}</th>
					<th>{LANG.email}</th>
                    <th>{LANG.mobile}</th>
					<th>{LANG.edit_time}</th>
					<th>{LANG.status}</th>
                    <th>{LANG.from_by}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
                    <td> {VIEW.district_name} </td>
					<td> {VIEW.full_name} </td>
					<td> {VIEW.email} </td>
                    <td> {VIEW.mobile} </td>
					<td> {VIEW.edit_time} </td>
					<td> {VIEW.status} </td>
                    <td> {VIEW.from_by} </td>
                    <td class="text-center">
                        <!-- BEGIN: allow_edit -->
                        <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a>
                        <!-- END: allow_edit -->
                        <!-- BEGIN: allow_del -->
                         - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a>
                        <!-- END: allow_del -->
                        <!-- BEGIN: allow_eventcontent -->
                         - <i class="fa fa-history fa-lg">&nbsp;</i><a href="{VIEW.addevent}">{LANG.addevent}</a>
                        <!-- END: allow_eventcontent -->
                    </td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->
    <!-- BEGIN: add_row -->
    <!-- BEGIN: error -->
    <div class="alert alert-warning">{ERROR}</div>
    <!-- END: error -->
    <link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
        
    <form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}&action={action}" method="post">
    	<input type="hidden" name="id" value="{ROW.id}" />
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-hover">
    			<tbody>
    				<tr>
    					<td style="width:100px"> {LANG.full_name} <span class="red">(*)</span></td>
    					<td style="width:200px"><input style="width: 100%;" class="form-control" type="text" name="full_name" value="{ROW.full_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /></td>
                        <td style="width:120px">{LANG.birthday}</td>
                        <td style="width:200px"><input style="width: 100%;" class="form-control" type="text" name="birthday" id="birthday" value="{ROW.birthday}" /></td>
    				</tr>
    				<tr>
                        <td>{LANG.sex}</td>
    					<td>
                            <!-- BEGIN: checkbox_sex -->
        					<input class="form-control" type="radio" name="sex" id="sex_{OPTION.key}" value="{OPTION.key}" {OPTION.checked} /><label for="sex_{OPTION.key}">{OPTION.title}</label> &nbsp; 
        					<!-- END: checkbox_sex -->
                        </td>
                        <td> {LANG.mobile} <span class="red">(*)</span></td>
    					<td style="width:200px"><input style="width: 100%;" class="form-control" type="text" name="mobile" id="mobile" value="{ROW.mobile}" /></td>
                    </tr>
                    <tr>
                        <td> {LANG.email} </td>
    					<td><input style="width: 100%;" class="form-control" type="text" name="email" id="email" value="{ROW.email}" /></td>
                        <td>{LANG.address} <span class="red">(*)</span></td>
                        <td><input style="width: 100%;" class="form-control" type="text" name="address" value="{ROW.address}" /></td>
                    </tr>
                    <tr>
                        <td>{LANG.from_by}</td>
                        <td>
                            <select style="width: 100%;" class="form-control" name="from_by">
                                <option value="0">-----</option>
            					<!-- BEGIN: from_select -->
            					<option value="{FROM.id}" {FROM.selected}>{FROM.title}</option>
            					<!-- END: from_select -->
        				    </select>
                        </td>
                        <td> {LANG.status} </td>
                        <td>
                            <select style="width: 100%;" class="form-control" name="status">
                                <!-- BEGIN: select_status -->
                                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                                <!-- END: select_status -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{LANG.province_select}</td>
                        <td>
                            <select style="width: 100%;" onchange="nv_get_district(this.value, 0)" class="form-control" name="provinceid">
                                <option value="0">-- --</option>
            					<!-- BEGIN: province_select -->
            					<option value="{OPTION.id}" {OPTION.selected}>{OPTION.title}</option>
            					<!-- END: province_select -->
        				    </select>
                        </td>
                        <td>{LANG.district_select}</td>
                        <td id="district_data">
                            <select style="width: 100%;" class="form-control" name="districtid">
                                <option value="0">---------</option>
        				    </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">
                            <input class="btn btn-primary submit-post" name="save" type="submit" value="{LANG.save}" />
                        </td>
                    </tr>
    			</tbody>
    		</table>
    	</div>
    </form>
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
    <script type="text/javascript">
        $("#birthday").datepicker({
    		showOn : "focus",
    		dateFormat : "dd/mm/yy",
    		changeMonth : true,
    		changeYear : true,
    		showOtherMonths : true,
    		buttonImage : nv_base_siteurl + "images/calendar.gif",
    		buttonImageOnly : true
    	});
        nv_get_district('{ROW.provinceid}', '{ROW.districtid}');
    </script>
    <!-- END: add_row -->
<!-- END: main -->