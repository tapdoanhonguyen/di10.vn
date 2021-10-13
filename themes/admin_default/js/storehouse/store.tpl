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
                    <th class="w100">{LANG.sort_order}</th>
                    <th>{LANG.store_sub_name}</th>
                    <th>{LANG.url}</th>
                    <th>{LANG.admin}</th>
                    <th class="w150">&nbsp;</th>
                </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="text-center" colspan="4">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td>
                        <select class="form-control" id="id_weight_{VIEW.store_id}" onchange="nv_change_weight('{VIEW.store_id}');">
                        <!-- BEGIN: sort_order_loop -->
                            <option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
                        <!-- END: sort_order_loop -->
                    </select>
                </td>
                    <td> <a href="{VIEW.link_view}">{VIEW.name} </a></td>
                    <td> {VIEW.url} </td>
                     <td> {VIEW.admin} </td>
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
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="store_id" value="{ROW.store_id}" />
    <!-- BEGIN: stores -->
    	<input type="hidden" name="stores_id" value="{STORES_ID}" />
    <!-- END: stores -->
    <!-- BEGIN: admin_stores -->
     <div class="form-group">
		<label class="col-sm-5 col-md-4 control-label "><strong>{LANG.stores}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-19 col-md-20">
			<select  class="form-control admin_stores" name="stores_id">
				<option value=""> --- </option>
				<!-- BEGIN: select_stores -->
				<option value="{STORES.store_id}" {STORES.selected}>{STORES.name}</option>
				<!-- END: select_stores -->
			</select>
		</div>
	</div>
	<!-- END: admin_stores -->
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.store_sub_name}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="name" value="{ROW.name}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
		<label class="col-sm-5 col-md-4 control-label "><strong>{LANG.category_id}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-19 col-md-20">
			<select multiple class="form-control category" name="category_id[]">
				<option value=""> --- </option>
				<!-- BEGIN: select_category_id -->
				<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
				<!-- END: select_category_id -->
			</select>
		</div>
	</div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.url}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="url" value="{ROW.url}" />
        </div>
    </div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div></div>

<script type="text/javascript">
//<![CDATA[
    function nv_change_weight(id) {
        var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
        var new_vid = $('#id_weight_' + id).val();
        $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=stores&nocache=' + new Date().getTime(), 'ajax_action=1&store_id=' + id + '&new_vid=' + new_vid, function(res) {
            var r_split = res.split('_');
            if (r_split[0] != 'OK') {
                alert(nv_is_change_act_confirm[2]);
            }
            window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=stores';
            return;
        });
        return;
    }
	$("input[name=searchUser]").click(function() {
        nv_open_browse("{MODULE_URL}=getuserid&area=uid&filtersql={FILTERSQL}", "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
	$(".category").select2({
		closeOnSelect:false,
		placeholder: '{LANG.search_category}'
	});
	$(".admin_stores").select2({
		placeholder: '{LANG.search_stores}'
	});
//]]>
</script>
<!-- END: main -->


<!-- BEGIN: listUsers -->
<!-- BEGIN: pending -->
<div id="id_pending">
    <h3 class="myh3">{PTITLE}</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <col class="w50"/>
            <col span="3" />
            <col class="w250"/>
            <thead>
                <tr>
                    <th class="text-center"> {LANG.userid} </th>
                    <th> {LANG.account} </th>
                    <th> {LANG.nametitle} </th>
                    <th> {LANG.email} </th>
                    <th class="text-center"> {GLANG.actions} </th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td class="text-center"> {LOOP.userid} </td>
                    <td><a title="{LANG.detail}" href="{MODULE_URL}=edit&userid={LOOP.userid}">{LOOP.username}</a></td>
                    <td>{LOOP.full_name}</td>
                    <td><a href="mailto:{LOOP.email}">{LOOP.email}</a></td>
                    <td class="text-center">
                    <!-- BEGIN: tools -->
                    <i class="fa fa-check fa-lg"></i> <a class="approved" href="javascript:void(0);" data-id="{LOOP.userid}">{LANG.approved}</a>
                    <i class="fa fa-times fa-lg"></i> <a class="denied" href="javascript:void(0);" data-id="{LOOP.userid}">{LANG.denied}</a>
                    <!-- END: tools -->
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
    <!-- BEGIN: page -->
    <div class="text-center">{PAGE}</div>
    <!-- END: page -->
</div>
<script type="text/javascript">
//<![CDATA[
$("a.approved").click(function() {
    confirm(nv_is_add_user_confirm[0]) && $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&approved=" + $(this).data("id"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
$("a.denied").click(function() {
    confirm(nv_is_exclude_user_confirm[0]) && $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&denied=" + $(this).data("id"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
//]]>
</script>
<!-- END: pending -->

<!-- BEGIN: leaders -->
<div id="id_leaders">
    <h3 class="myh3">{PTITLE}</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <col class="w50"/>
            <col span="3" />
            <col class="w250"/>
            <thead>
                <tr>
                    <th class="text-center"> {LANG.userid} </th>
                    <th> {LANG.account} </th>
                    <th> {LANG.nametitle} </th>
                    <th> {LANG.email} </th>
                    <th class="text-center"> {GLANG.actions} </th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td class="text-center"> {LOOP.userid} </td>
                    <td><a title="{LANG.detail}" href="{MODULE_URL}=edit&userid={LOOP.userid}">{LOOP.username}</a></td>
                    <td>{LOOP.full_name}</td>
                    <td><a href="mailto:{LOOP.email}">{LOOP.email}</a></td>
                    <td class="text-center">
                    <!-- BEGIN: tools -->
                    <i class="fa fa-star-half-o fa-lg"></i> <a class="demote" href="javascript:void(0);" data-id="{LOOP.userid}">{LANG.demote}</a>
                    <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a class="deleteleader" href="javascript:void(0);" title="{LOOP.userid}">{LANG.exclude_user2}</a>
                    <!-- END: tools -->
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
    <!-- BEGIN: page -->
    <div class="text-center">{PAGE}</div>
    <!-- END: page -->
</div>
<script type="text/javascript">
//<![CDATA[
$("a.deleteleader").click(function() {
    confirm("{LANG.delConfirm} ?") && $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&exclude=" + $(this).attr("title"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
$("a.demote").click(function() {
    $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&demote=" + $(this).data("id"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
//]]>
</script>
<!-- END: leaders -->

<!-- BEGIN: members -->
<div id="id_members">
    <h3 class="myh3">{PTITLE}</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <col class="w50"/>
            <col span="3" />
            <col class="w250"/>
            <thead>
                <tr>
                    <th class="text-center"> {LANG.userid} </th>
                    <th> {LANG.account} </th>
                    <th> {LANG.nametitle} </th>
                    <th> {LANG.email} </th>
                    <th class="text-center"> {GLANG.actions} </th>
                </tr>
            </thead>
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td class="text-center"> {LOOP.userid} </td>
                    <td><a title="{LANG.detail}" href="{MODULE_URL}=edit&userid={LOOP.userid}">{LOOP.username}</a></td>
                    <td>{LOOP.full_name}</td>
                    <td><a href="mailto:{LOOP.email}">{LOOP.email}</a></td>
                    <td class="text-center">
                    <!-- BEGIN: tools -->
                    <i class="fa fa-star fa-lg"></i> <a class="promote" href="javascript:void(0);" data-id="{LOOP.userid}">{LANG.promote}</a> -
                    <i class="fa fa-trash-o fa-lg"></i> <a class="deletemember" href="javascript:void(0);" title="{LOOP.userid}">{LANG.exclude_user2}</a>
                    <!-- END: tools -->
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
    <!-- BEGIN: page -->
    <div class="text-center">{PAGE}</div>
    <!-- END: page -->
</div>
<script type="text/javascript">
//<![CDATA[
$("a.deletemember").click(function() {
    confirm("{LANG.delConfirm} ?") && $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&exclude=" + $(this).attr("title"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
$("a.promote").click(function() {
    $.ajax({
        type : "POST",
        url : "{MODULE_URL}={OP}",
        data : "gid={GID}&promote=" + $(this).data("id"),
        success : function(a) {
            a == "OK" ? $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10)) : alert(a);
        }
    });
    return !1;
});
//]]>
</script>
<!-- END: members -->
<!-- END: listUsers -->

<!-- BEGIN: userlist -->
<!-- BEGIN: adduser -->
<div id="ablist" class="form-inline">
    {LANG.search_id}: <input title="{LANG.search_id}" class="form-control txt" type="text" name="uid" id="uid" value="" maxlength="11" style="width:50px" />
    <input class="btn btn-primary" name="addUser" type="button" value="{LANG.addMemberToGroup}" />
    <input class="btn btn-success" name="searchUser" type="button" value="{GLANG.search}" />
</div>
<!-- END: adduser -->
<div id="pageContent">&nbsp;</div>
<script type="text/javascript">
    //<![CDATA[
    $(function() {
        $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10));
    });
    $("input[name=searchUser]").click(function() {
        nv_open_browse("{MODULE_URL}=getuserid&area=uid&filtersql={FILTERSQL}", "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
    $("input[name=addUser]").click(function() {
        var a = $("#ablist input[name=uid]").val(), a = intval(a);
        a == 0 && ( a = "");
        $("#ablist input[name=uid]").val(a);
        if (a == "") {
            return alert("{LANG.choiceUserID}"), $("#ablist input[name=uid]").select(), false;
        }
        $("#pageContent input, #pageContent select").attr("disabled", "disabled");
        $.ajax({
            type : "POST",
            url : "{MODULE_URL}={OP}",
            data : "gid={GID}&uid=" + a + "&rand=" + nv_randomPassword(10),
            success : function(a) {
                a == "OK" ? ($("#ablist input[name=uid]").val(""), $("div#pageContent").load("{MODULE_URL}={OP}&listUsers={GID}&random=" + nv_randomPassword(10))) : alert(a);
            }
        });
        return !1;
    });
    //]]>
</script>
<!-- END: userlist -->