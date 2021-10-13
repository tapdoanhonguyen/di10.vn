<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="GET" class="form-inline" role="form">
		<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
		<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />

		<div class="form-group">
			<label class="sr-only">{LANG.date_from}</label>
			<input type="text" name="from" id="from" value="{SEARCH.date_from}" class="form-control" placeholder="{LANG.date_from}" readonly="readonly">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.date_to}</label>
			<input type="text" name="to" id="to" value="{SEARCH.date_to}" class="form-control" placeholder="{LANG.date_to}" readonly="readonly">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.order_nhanvien}</label>
			<select name="userid" id="" class="form-control">
				<option value="0">Tìm theo nhân viên</option>
				<!-- BEGIN: user-->
				<option value="{LISTUSER.userid}"{LISTUSER.sl}>{LISTUSER.username}</option>
				<!-- END: user-->
			</select>
			
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.order_payment}</label>
			<select class="form-control" name="order_payment">
				<option value="">{LANG.order_payment}</option>
				<!-- BEGIN: transaction_status -->
				<option value="{TRAN_STATUS.key}" {TRAN_STATUS.selected}>{TRAN_STATUS.title}</option>
				<!-- END: transaction_status -->
			</select>
		</div>
		<div class="form-group">
			<input type="hidden" name ="checkss" value="{CHECKSESS}" />
			<input type="submit" class="btn btn-primary" name="search" value="{LANG.search}" />
		</div>
	</form>
</div>

<!-- BEGIN: data -->
<div class="clearfix"></div>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th><strong>{LANG.saler_name}</strong></th>
                <th><strong>{LANG.total_order}</strong></th>
                <th><strong>{LANG.transaction_status_0}</strong></th>
				<th><strong>{LANG.transaction_status_4}</strong></th>
				<th></th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: row -->
			<tr >
				<td>{DATA.saller_name}</td>
                <td>{DATA.total_order}</td>
                <td>{DATA.transaction_status_0}</td>
                <td>{DATA.transaction_status_4}</td>
				<td>{DATA.total_price}</td>
				<td align="left"><a href="{DATA.order_list_url}" class="pull-right" title="{LANG.order_list}"><em class="fa fa-search fa-lg">&nbsp;</em></a></td>
			</tr>
			<!-- END: row -->
		</tbody>
	</table>
</div>
<!-- END: data -->

<script type="text/javascript">
	$(document).ready(function() {
		$("#from,#to").datepicker({
			showOn : "both",
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
			buttonImageOnly : true
		});
	});
</script>
    <!-- BEGIN: highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    <div id="container_highcharts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    
    <table style="display:none;" class="table" id="datatable">
        <thead>
            <tr>
                <th></th>
                <th>{LANG.total_order}</th>
                <th>{LANG.transaction_status_0}</th>
                <th>{LANG.transaction_status_4}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: user -->
            <tr>
                <th>{DATA.saller_name}</th>
                <td>{DATA.total_order}</td>
                <td>{DATA.transaction_status_0}</td>
                <td>{DATA.transaction_status_4}</td>
            </tr>
            <!-- END: user -->
        </tbody>
    </table>
    <script type="text/javascript">
    Highcharts.chart('container_highcharts', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '{LANG.highcharts_by_user}'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: '{LANG.unit}'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
    </script>
    <!-- END: highcharts -->
<!-- END: main -->
