<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
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
		                    <th>{LANG.purechases_quantity}</th>
		                    <th>{LANG.sales_quantity}</th>
		                    <th>{LANG.profit}</th>
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
		                    <td> {VIEW.purchasedqty} </td>
		                    <td> {VIEW.soldqty} </td>
		                    <td> {VIEW.profit} </td>
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