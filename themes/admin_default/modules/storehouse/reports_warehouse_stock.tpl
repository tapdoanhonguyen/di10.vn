<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">

<!-- BEGIN: view -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.report_period}       </h2>

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
		<form action="{NV_BASE_ADMINURL}index.php" method="post" id="action-form-submit">
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
		                    <th class="w100" rowspan="1">{LANG.number}</th>
		                    <th rowspan="1">{LANG.code}</th>
		                    <th rowspan="1">{LANG.name}</th>
							<th colspan="1">{LANG.peroidbg}</th>
		                    <th colspan="1">{LANG.purchasesin}</th>
		                    <th colspan="1">{LANG.salessin}</th>
		                    <th colspan="1">{LANG.peroidend}</th>
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
		                    <td> {VIEW.beginperiod} </td>
		                    <td> {VIEW.purchasedqtyin} </td>
		                    <td> {VIEW.soldqtyin} </td>
		                    <td> {VIEW.endperoid} </td>
		                </tr>
		                <!-- END: loop -->
		            </tbody>
		        </table>
		    </div>
		</form>
	</div>
</div>
<!-- END: view -->
<div class="col-lg-24">
	<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/hc/highcharts.js"></script>
	<div class="alerts-con"></div>
	<script type="text/javascript">
		function format1(n, currency) {
		  return currency + n.toFixed(site.settings.decimals).replace(/./g, function(c, i, a) {
		    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
		  });
		}
		function formatThousandsWithRounding(n, dp){
		  var w = n.toFixed(dp), k = w|0, b = n < 0 ? 1 : 0, a=1,
		      u = Math.abs(w-k), d = (''+u.toFixed(dp)).substr(2, dp),
		      s = ''+k, i = s.length, r = '';
		  while ( (i-=3) > b ) { r = ',' + s.substr(i, 3) + r; }
		  //return s.substr(0, i + 3) + r + (d ? '.'+d: '') ;
		  return number_format(n);
		};
		site = {
			"url":"https:\/\/{MY_DOMAIN}\/",
			"base_url":"http:\/\/{MY_DOMAIN}\/admin\/",
			"assets":"http:\/\/{MY_DOMAIN}\/assets\/",
			"settings":{
				"logo":"logo2.png",
				"logo2":"logo3.png",
				"site_name":"SHOP nv",
				"language":"vietnamese",
				"default_warehouse":"1",
				"accounting_method":"0",
				"default_currency":"VND",
				"default_tax_rate":"1",
				"rows_per_page":"10",
				"version":"3.4.6",
				"default_tax_rate2":"1",
				"dateformat":"5",
				"sales_prefix":"SALE",
				"quote_prefix":"QUOTE",
				"purchase_prefix":"PO",
				"transfer_prefix":"TR",
				"delivery_prefix":"DO",
				"payment_prefix":"IPAY",
				"return_prefix":"SR",
				"returnp_prefix":"PR",
				"expense_prefix":"",
				"item_addition":"0",
				"theme":"default",
				"product_serial":"1",
				"default_discount":"1",
				"product_discount":"1",
				"discount_method":"1",
				"tax1":"1",
				"tax2":"1",
				"overselling":"0",
				"iwidth":"800",
				"iheight":"800",
				"twidth":"150",
				"theight":"150",
				"watermark":"1",
				"smtp_host":"pop.gmail.com",
				"bc_fix":"4",
				"auto_detect_barcode":"1",
				"captcha":"0",
				"reference_format":"2",
				"racks":"1",
				"attributes":"1",
				"product_expiry":"1",
				"decimals":"0",
				"qty_decimals":"0",
				"decimals_sep":".",
				"thousands_sep":',',
				"invoice_view":"0",
				"default_biller":"3",
				"rtl":"0",
				"each_spent":null,
				"ca_point":null,
				"each_sale":1,
				"sa_point":null,
				"sac":"0",
				"display_all_products":"0",
				"display_symbol":"2",
				"symbol":"VND",
				"remove_expired":"0",
				"barcode_separator":"-",
				"set_focus":"0",
				"price_group":"1",
				"barcode_img":"0",
				"ppayment_prefix":"POP",
				"disable_editing":"90",
				"qa_prefix":"",
				"update_cost":"0",
				"apis":"0",
				"state":"AN",
				"pdf_lib":"dompdf",
				"user_language":"vietnamese",
				"user_rtl":"0",
				"indian_gst":false},
				"dateFormats":{"js_sdate":"dd\/mm\/yyyy",
				"php_sdate":"d\/m\/Y",
				"mysq_sdate":"%d\/%m\/%Y",
				"js_ldate":"dd\/mm\/yyyy hh:ii",
				"php_ldate":"d\/m\/Y H:i",
				"mysql_ldate":"%d\/%m\/%Y %H:%i"
			}
		};
		var dp = site.settings.decimals;
		function formatQuantity(x) {
		    return formatThousandsWithRounding((x != null) ? x : 0);
		   // return (x != null) ? formatQuantityNumber(x, site.settings.qty_decimals) : '';
		}
		
		function formatMoney(amount) {
			
		    return (site.settings.display_symbol == 1 ? site.settings.symbol : '') +  format1(amount,'')+
											(site.settings.display_symbol == 2 ? site.settings.symbol : '');
		  
		};

		function currencyFormat(x) {
			console.log(x);
		    return '<div class="text-right">'+formatMoney(x != null ? x : 0)+'</div>';
		}
		$(function () {
		    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
		        return {
		            radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
		            stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
		        };
		    });
		    $('#chart').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false
		        },
		        title: {text: ''},
		        credits: {enabled: false},
		        tooltip: {
		            formatter: function () {
		                return '<div class="tooltip-inner hc-tip" style="margin-bottom:0;">' + this.key + '<br><strong>' + currencyFormat(this.y) + '</strong> (' + format1(this.percentage,'') + '%)';
		            },
		            followPointer: true,
		            useHTML: true,
		            borderWidth: 0,
		            shadow: false,
		            valueDecimals: site.settings.decimals,
		            style: {fontSize: '14px', padding: '0', color: '#000000'}
		        },
		        plotOptions: {
		            pie: {
		                dataLabels: {
		                    enabled: true,
		                    formatter: function () {
		                        return '<h3 style="margin:-15px 0 0 0;"><b>' + this.point.name + '</b>:<br><b> ' + currencyFormat(this.y) + '</b></h3>';
		                    },
		                    useHTML: true
		                }
		            }
		        },
		        series: [{
		            type: 'pie',
		            name: 'Giá trị tồn kho',
		            data: [
		                ['Giá trị tính theo giá bán', {REPORT_WAREHOUSE_CHART.stock_by_price}],
		                ['Giá trị tính theo giá nhập', {REPORT_WAREHOUSE_CHART.stock_by_cost}],
		                ['Lợi nhuận ước tính', {REPORT_WAREHOUSE_CHART.profit_estimate}],
		            ]
		
		        }]
		    });
		
		});
	</script>
	<div class="well" >
		<div class="box-header">
			<h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>Biểu đồ tồn kho  </h2>
			<div class="row">
				<div class="col-xs-24 col-md-24">
					<label class="col-sm-24 col-md-10 "><strong>{LANG.warehouses}</strong> <span class="red">(*)</span></label>
					<div class="col-md-14">
						<select class="form-control" name="report_warehouse_id" id="report_warehouse_id">
							<option value="0"> --{LANG.warehouses_all}-- </option>
							<!-- BEGIN: wloop -->
							<option value="{WAREHOUSE.key}" {WAREHOUSE.selected}>{WAREHOUSE.title}</option>
							<!-- END: wloop -->
						</select>
						<input type="hidden" name="warehouse_session" value="{WAREHOUSE_SESSION}" id="warehouse_session"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box" >
		
		<div class="box-content">
			
			<div class="row">
				<div class="col-lg-24">
					<p class="introtext">Giá trị tồn kho được tính bởi Chi phí và Giá bán. Vui lòng chọn các kho bên phải để có được giá trị cho kho chọn.</p>
					<div class="small-box padding1010 col-sm-12 bblue">
						<div class="inner clearfix">
							<a>
								<h3>{REPORT_WAREHOUSE_TOTALS.total_items}</h3>
								<p>Tổng số các loại</p>
							</a>
						</div>
					</div>
					<div class="small-box padding1010 col-sm-12 bdarkGreen">
						<div class="inner clearfix">
							<a>
								<h3>{REPORT_WAREHOUSE_TOTALS.total_quantity}</h3>
								<p>Tổng số lượng</p>
							</a>
						</div>
					</div>
					<div class="clearfix" style="margin-top:20px;"></div>
					<div id="chart" style="width:100%; height:450px;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script>
    $(document).ready(function () {
	    $('body').on('click', '#excel', function(e) {
	        e.preventDefault();
	        $('#form_action').val($(this).attr('data-action'));
	        $('#action-form-submit').submit();
	    });
	});
</script>
<script type="text/javascript">
$(function() {
	$("#date_from,#date_to").datepicker({
        showOn : "both",
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
        buttonImageOnly : true
    });
    
	$("#report_warehouse_id").on("change",function() {
  		var w_id = $("#report_warehouse_id").val();
  		$.ajax({
    		type: "GET",
    		url: script_name + '?' + nv_name_variable + '=storehouse&' + nv_fc_variable + '=ajax&mod=report_warehouse_chart&w_id=' + w_id,
        	dataType: 'json',
        	data: function (params) {
                 return {
					 mod: 'report_warehouse_chart',
					 w_id:w_id
                 };
             },
            success: function (data, params) {
            	$("#warehouse_session").val(data.session_store_warehouse_id);
            	//warehouse_id_select2 (data.session_store_id);
            	console.log(data);
            	window.location.href = window.location.href;
            }
    	});
	});
	
	
	
});

</script>
<div class="clearfix"></div>
<!-- END: main -->