<!-- BEGIN: main -->
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="GET" class="form-inline" role="form">
		<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
		<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />

		<div class="form-group">
			<label class="sr-only">{LANG.num_sell_from}</label>
			<input type="text" name="num_sell_from" value="{SEARCH.num_sell_from}" class="form-control" placeholder="{LANG.num_sell_from}">
		</div>
		<div class="form-group">
			<label class="sr-only">{LANG.num_sell_to}</label>
			<input type="text" name="num_sell_to" value="{SEARCH.num_sell_to}" class="form-control" placeholder="{LANG.num_sell_to}">
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
				<th><strong>{LANG.product_title}</strong></th>
                <th><strong>{LANG.num_sell}</strong></th>
                <th><strong>{LANG.luotmua}</strong></th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: row -->
			<tr >
				<th>{DATA.title}</th>
				<td>{DATA.num_sell}</td>
                <td>{DATA.luotmua}</td>
			</tr>
			<!-- END: row -->
		</tbody>
	</table>
</div>
<!-- END: data -->

    <!-- BEGIN: highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    
    <div id="container_highcharts" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    
    <table style="display:none;" class="table" id="datatable">
        <thead>
            <tr>
                <th>{LANG.product_title}</th>
                <th>{LANG.num_sell}</th>
                <th>{LANG.luotmua}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: user -->
            <tr>
                <th>{DATA.title}</th>
                <td>{DATA.num_sell}</td>
                <td>{DATA.luotmua}</td>
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
                text: 'Lần'
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
