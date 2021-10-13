<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
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
                    <th class="w100">{LANG.number}</th>
                    <th>{LANG.warehouses_code}</th>
                    <th>{LANG.warehouses_name}</th>
                    <th>{LANG.address}</th>
                    <th>{LANG.map}</th>
                    <th>{LANG.phone}</th>
                    <th>{LANG.email}</th>
                    <th>{LANG.price_group_id}</th>
                    <th class="w150">&nbsp;</th>
                </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="text-center" colspan="9">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td> {VIEW.number} </td>
                    <td> {VIEW.code} </td>
                    <td> {VIEW.name} </td>
                    <td> {VIEW.address} </td>
                    <td> {VIEW.map} </td>
                    <td> {VIEW.phone} </td>
                    <td> {VIEW.email} </td>
                    <td> {VIEW.price_group_id} </td>
                    <td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
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
<!-- BEGIN: add -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
    <!-- BEGIN: admin_store -->
    <div class="form-group">
		<label class="col-sm-5 col-md-4 control-label "><strong>{LANG.store}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-19 col-md-20">
			<select  class="form-control admin_stores" name="store_id">
				<option value=""> --- </option>
				<!-- BEGIN: select_store -->
				<option value="{STORE.store_id}" {STORE.selected}>{STORE.name}</option>
				<!-- END: select_store -->
			</select>
		</div>
	</div>
    <!-- END: admin_store -->
    <!-- BEGIN: store -->
    	<input type="hidden" name="store_id" value="{STORE_ID}" />
    <!-- END: store -->
    <input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.warehouses_code}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="code" value="{ROW.code}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.warehouses_name}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="name" value="{ROW.name}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="address" value="{ROW.address}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.map}</strong></label>
        <div class="col-sm-19 col-md-20">
            <div class="input-group">
            <input class="form-control" type="text" name="map" value="{ROW.map}" id="id_map" />
            <span class="input-group-btn">
                <button class="btn btn-default selectfile" type="button" >
                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
            </button>
            </span>
        </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="phone" value="{ROW.phone}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="email" value="{ROW.email}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price_group_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="price_group_id">
                <option value=""> --- </option>
                <!-- BEGIN: select_price_group_id -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_price_group_id -->
            </select>
        </div>
    </div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.warehouses_add}" /></div>
</form>
</div></div>

<script type="text/javascript">
//<![CDATA[
    $(".selectfile").click(function() {
        var area = "id_map";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var type = "image";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
	warehouse_id_select2();
//]]>
</script>
<!-- END: add -->
<!-- END: main -->