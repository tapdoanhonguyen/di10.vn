<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.product}       </h2>

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
		                    <th>{LANG.code}</th>
		                    <th>{LANG.name}</th>
							<th>{LANG.brand}</th>
							<th>{LANG.category_secondcat}</th>
		                    <th>{LANG.cost}</th>
		                    <th>{LANG.price}</th>
		                    <th>{LANG.quantity_systems}</th>
		                    <th>{LANG.quantity_return}</th>
		                    <th>{LANG.quantity_export}</th>
		                    <th>{LANG.unit}</th>
		                    <th style="display:none">{LANG.alert_quantity}</th>
		                    <th class="w100 text-center" style="display:none" >{LANG.active}</th>
		                    <th class="w150">&nbsp;</th>
		                </tr>
		            </thead>
		            <!-- BEGIN: generate_page -->
		            <tfoot>
		                <tr>
		                    <td class="text-center" colspan="16">{NV_GENERATE_PAGE}</td>
		                </tr>
		            </tfoot>
		            <!-- END: generate_page -->
		            <tbody>
		                <!-- BEGIN: loop -->
		                <tr>
		                    <td> {VIEW.number} </td>
		                    <td> <a href="{VIEW.link_detail}">{VIEW.code}</a>  </td>
		                    <td> {VIEW.name} </td>
							<td> {VIEW.brand} </td>
							<td> {VIEW.second_category_id} </td>
		                    <td> {VIEW.cost} </td>
		                    <td> {VIEW.price} </td>
		                    <td> {VIEW.quantity_balance} </td>
		                    <td> {VIEW.quantity_return} </td>
		                    <td> {VIEW.quantity_export} </td>
		                    <td> {VIEW.unit} </td>
		                    <td style="display:none"> {VIEW.alert_quantity} </td>
		                    <td class="text-center" style="display:none"><input type="checkbox" name="hide" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" /></td>
		                    <td class="text-center">
		                    	<i class="fa fa-print fa-lg">&nbsp;</i> <a href="{VIEW.link_print}">{LANG.print_barcode}</a>
		                    	<i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a>
		                    	 - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
		                </tr>
		                <!-- END: loop -->
		            </tbody>
		        </table>
		    </div>
		</form>
		<!-- END: view -->
	</div>
</div>
<!-- END: main -->