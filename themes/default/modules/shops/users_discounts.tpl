<!-- BEGIN: main -->
<div id="users">
    <!-- BEGIN: is_forum -->
    <div class="alert alert-warning">{LANG.modforum}</div>
    <!-- END: is_forum -->
   
    <form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <caption><em class="fa fa-file-text-o">&nbsp;</em>{TABLE_CAPTION}</caption>
                <thead>
                    <tr>
                        <th class="w50"><a href="{HEAD.userid.href}">{HEAD.userid.title}</a></th>
                        <th><a href="{HEAD.username.href}">{HEAD.username.title}</a> / <a href="{HEAD.full_name.href}">{HEAD.full_name.title}</a></th>
                        <th><a href="{HEAD.email.href}">{HEAD.email.title}</a></th>
                        <th class="text-center ">{LANG.affiliate_groups}</th>
                        <th class="text-center w100">{LANG.funcs}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- BEGIN: xusers -->
                    <tr>
                        <td class="align-middle"> {CONTENT_TD.userid} </td>
                        <td>
                            <!-- BEGIN: view --><a href="{CONTENT_TD.link}" target="_blank">{CONTENT_TD.username}</a><!-- END: view -->
                            <!-- BEGIN: show -->{CONTENT_TD.username}<!-- END: show -->
                            <div class="mt-1">{CONTENT_TD.full_name}</div>
                        </td>
                        <td>
                            <span class="text-info">{CONTENT_TD.regdate}</span>
                            <div class="mt-1">{CONTENT_TD.active_obj}</div>
                        </td>
                        <td class="text-center align-middle">
							<select class="form-control" name="affiliate" onchange="nv_chang_affiliate('{CONTENT_TD.userid}','affiliate');" id="id_affiliate_{CONTENT_TD.userid}">
								<option value="-1">---{LANG.affiliate_set}---</option>
								<!-- BEGIN: affiliate -->
								<option value="{AFFILIATE.key}"{AFFILIATE.selected}>{AFFILIATE.value}</option>
								<!-- END: affiliate -->
							</select>
						</td>
                        <td class="text-center align-middle">
                            <!-- BEGIN: set_official -->
                            <a data-toggle="tooltip" title="{LANG.set_official_note}" href="javascript:void(0);" class="btn btn-xs btn-info" onclick="nv_set_official({CONTENT_TD.userid});"><em class="fa fa-user"></em></a>
                            <!-- END: set_official -->
                        </td>
                    </tr>
                    <!-- END: xusers -->
                </tbody>
                <!-- BEGIN: footer -->
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <!-- BEGIN: action -->
                            <div class="pull-left margin-right form-inline">
                                <select class="form-control w150" id="mainuseropt">
                                    <!-- BEGIN: loop --><option value="{ACTION_KEY}">{ACTION_LANG}</option><!-- END: loop -->
                                </select>
                                <input type="button" class="btn btn-primary" value="{LANG.read_submit}" id="mainusersaction" data-msgnocheck="{LANG.msgnocheck}"/>
                            </div>
                            <!-- END: action -->
                            <!-- BEGIN: exportfile -->
                            <input type="button" class="btn btn-primary" value="{LANG.export}" name="data_export"/>
                            <!-- END: exportfile -->
                            <!-- BEGIN: generate_page -->
                            {GENERATE_PAGE}
                            <!-- END: generate_page -->
                        </td>
                    </tr>
                </tfoot>
                <!-- END: footer -->
            </table>
        </div>
    </form>
</div>
<script type="text/javascript">
var export_note = '{LANG.export_note}';
var export_complete = '{LANG.export_complete}';
</script>
<!-- END: main -->
