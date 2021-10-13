<!-- BEGIN: main -->

<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="GET" class="form-inline" role="form">
		<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
		<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />
		<div class="form-group">
			<div class="uiTokenizer uiInlineTokenizer"  style="float:left;">
				<span id="productid" class="tokenarea">
					<!-- BEGIN: data_users -->
					<span class="uiToken removable" title="{DATA.title}">
						{DATA.title}<input type="hidden" autocomplete="off" name="productid" value="{DATA.productid}" />
						<a class="remove uiCloseButton uiCloseButtonSmall" href="javascript:void(0);" onclick="$(this).parent().remove();"></a>
					</span>
					<!-- END: data_users -->
				</span>
				<span class="uiTypeahead">
					<input type="hidden" class="hiddenInput" autocomplete="off" value="" />
					<div class="innerWrap" style="float:left;">
						<input id="group_cat-search" type="text" placeholder="{LANG.input_product_title}" class="form-control textInput" style="width: 100%;" />
					</div>
				</span>
			</div>
		</div>
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
<script>
    $("#group_cat-search").bind("keydown", function(event) {
        if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
            event.preventDefault();
        }
    }).autocomplete({
        source : function(request, response) {
            $.getJSON(script_name + "?" + nv_name_variable + "=" + nv_module_name + "&" + nv_fc_variable + "=productajax", {
                term : extractLast(request.term)
            }, response);
        },
        search : function() {
            // custom minLength
            var term = extractLast(this.value);
            if (term.length < 2) {
                return false;
            }
        },
        select : function(event, data) {
            nv_add_element( data.item );
            $(this).val('');
            return false;
        }
    });
    function nv_add_element( data ){
        var html = "<span title=\"" + data.value + "\" class=\"uiToken removable\">" + data.value + "<input type=\"hidden\" value=\"" + data.key + "\" name=\"productid\" autocomplete=\"off\"><a onclick=\"$(this).parent().remove();\" href=\"javascript:void(0);\" class=\"remove uiCloseButton uiCloseButtonSmall\"></a></span>";
        $("#productid").html( html );
        return false;
    }
    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>
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
