<!-- BEGIN: main -->
<div class="col-lg-24">
	<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/hc/highcharts.js"></script>
	<div class="alerts-con"></div>
	<script type="text/javascript">
		function formatThousandsWithRounding(n, dp){
		  var w = n.toFixed(dp), k = w|0, b = n < 0 ? 1 : 0,
		      u = Math.abs(w-k), d = (''+u.toFixed(dp)).substr(2, dp),
		      s = ''+k, i = s.length, r = '';
		  while ( (i-=3) > b ) { r = ',' + s.substr(i, 3) + r; }
		  return s.substr(0, i + 3) + r + (d ? '.'+d: '');
		};
		site = {
			"url":"https:\/\/{MY_DOMAIN}\/",
			"base_url":"http:\/\/quanlykho.vinasaas.net\/admin\/",
			"assets":"http:\/\/quanlykho.vinasaas.net\/assets\/",
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
			
		    return (site.settings.display_symbol == 1 ? site.settings.symbol : '') +  formatThousandsWithRounding(amount)+
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
		                return '<div class="tooltip-inner hc-tip" style="margin-bottom:0;">' + this.key + '<br><strong>' + currencyFormat(this.y) + '</strong> (' + formatNumber(this.percentage) + '%)';
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
		                ['Giá trị tính theo giá bán', 18000000.00000000],
		                ['Giá trị tính theo giá nhập', 10000000.00000000],
		                ['Lợi nhuận ước tính', 8000000],
		            ]
		
		        }]
		    });
		
		});
	</script>
	<div class="box" style="margin-top: 15px;">
		<div class="box-header">
			<h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>Biểu đồ tồn kho  </h2>
			<div class="box-icon">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group col-md-24">
							<label class="col-sm-24 col-md-4 "><strong>{LANG.warehouses}</strong> <span class="red">(*)</span></label>
							<div class="col-sm-24 col-md-8">
								<select class="form-control" name="warehouse_id" id="warehouse_id">
									
								</select>
								<input class=" form-control col-md-20" type="hidden" name="warehouse_session" value="{WAREHOUSE_SESSION}" id="warehouse_session"/>
							</div>
						</div>
					</div>
				</div>
				<!-- ul class="btn-tasks">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="" data-original-title="Kho hàng"></i></a>
						<ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
							<li><a href="/admin/index.php?language=vi&nv=storehouse&op=reports_warehouse_stock"><i class="fa fa-building-o"></i> Tất cả kho hàng</a></li>
							<li class="divider"></li>
							<li><a href="/admin/index.php?language=vi&nv=storehouse&op=reports_warehouse_stock&warehouse_id={WAREHOUSE.id}"><i class="fa fa-building"></i>Warehouse 1</a></li>
							<li><a href="/admin/index.php?language=vi&nv=storehouse&op=reports_warehouse_stock&warehouse_id={WAREHOUSE.id}"><i class="fa fa-building"></i>Warehouse 2</a></li>
						</ul>
					</li>
				</ul -->
			</div>
		</div>
		<div class="box-content">
			
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- END: main -->