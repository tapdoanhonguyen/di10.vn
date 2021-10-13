<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<!-- BEGIN: view -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.reports_sales}       </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="" data-original-title="Tác vụ"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel" >
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> {LANG.reports_sales_excel}                          </a>
                        </li>
                    </ul>
                </li>
                            </ul>
        </div>
    </div>
    <div class="box-content">
		<div class="well">
		<form action="{NV_BASE_ADMINURL}index.php" method="get" id="action-form-submit">
		    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
		    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
		    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
			<div class="row">
			    <div class="col-xs-24 col-md-6">
			        <div class="form-group">
			            <input class="form-control" type="text" value="{date_from}" name="date_from" id="date_from" style="width: 90px;" maxlength="10" />
			        </div>
			    </div>
			    <div class="col-xs-24 col-md-6">
			        <div class="form-group">
			            <input class="form-control" type="text" value="{date_to}" name="date_to" id="date_to" style="width: 90px;" maxlength="10"  />
			        </div>
			    </div>
			    <div class="col-xs-12 col-md-3">
			        <div class="form-group">
			            <input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
			        </div>
			    </div>
			</div>
			<input type="hidden" name="form_action" value="" id="form_action"/>
		</form>
		</div>
		<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
		    <div class="table-responsive">
		        <table class="table table-striped table-bordered table-hover">
		            <thead>
		                <tr>
		                    <th class="w100">{LANG.number}</th>
		                    <th>{LANG.reference_no}</th>
		                    <th>{LANG.date}</th>
		                    <th>{LANG.biller}</th>
		                    <th>{LANG.customer}</th>
		                    <th>{LANG.total}</th>
		                    <th>{LANG.paid}</th>
		                    <th>{LANG.balance}</th>
		                    <th>{LANG.payment_status}</th>
		                   
		                </tr>
		            </thead>
		            <tbody>
		                <!-- BEGIN: sales -->
		                <tr>
		                    <td> {SALES.no} </td>
		                    <td> {SALES.reference_no} </td>
		                    <td> {SALES.date} </td>
		                    <td> {SALES.biller} </td>
		                    <td> {SALES.customer_id} </td>
		                    <td> {SALES.grand_total_fomart} </td>
		                    <td> {SALES.paid_format} </td>
		                    <td> {SALES.balance_format} </td>
		                    <td> {SALES.payment_status} </td>
		                    
		                </tr>
		                <!-- END: sales -->
		            </tbody>
		        </table>
		    </div>
		</form>
	</div>
</div>
<!-- END: view -->
<script>
    $(document).ready(function () {
    	$("#date_from,#date_to").datepicker({
	        showOn : "both",
	        dateFormat : "dd/mm/yy",
	        changeMonth : true,
	        changeYear : true,
	        showOtherMonths : true,
	        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
	        buttonImageOnly : true
	    });
	    $('body').on('click', '#excel', function(e) {
	        e.preventDefault();
	        $('#form_action').val($(this).attr('data-action'));
	        $('#action-form-submit').submit();
	    });
	});
</script>
<!-- END: main -->