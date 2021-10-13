<!-- BEGIN: main -->
<!-- BEGIN: view -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="w100">{LANG.sort_order}</th>
                    <th>{LANG.username}</th>
                    <th>{LANG.groups}</th>
                    <th></th>
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
                	</td>
                    <td> {USER.username} </td>
                    <td>  {USER.title} {USER.store} </td>
                     <td>  </td>
                    <td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{USER.link_edit}#edit">{LANG.edit}</a> </td>
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
<!-- BEGIN: adduser -->
<button class="adduser">{LANG.user_add}</button>
<script type="text/javascript">
$(document).ready(function () {
	$(document).on('click','.adduser', function(){	
		window.location.href = '{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}=users_add';
	});	
});
</script>

<!-- END: adduser -->

<!-- END: main -->