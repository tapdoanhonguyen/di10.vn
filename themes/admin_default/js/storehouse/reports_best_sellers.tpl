<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">


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
			"url":"{HTTP_PORT}:\/\/{MY_DOMAIN}\/",
			"base_url":"{HTTP_PORT}:\/\/{MY_DOMAIN}\\/admin\/",
			"assets":"{HTTP_PORT}:\/\/{MY_DOMAIN}\/assets\/",
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
        <!-- BEGIN: m2bs -->
        $('#m2bschart').highcharts({
            chart: {type: 'column'},
            title: {text: ''},
            credits: {enabled: false},
            xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
            yAxis: {min: 0, title: {text: ''}},
            legend: {enabled: false},
            series: [{
                name: '{LANG.sold}',
                data: [<!-- BEGIN: m2loop -->{M2BS_JSON}<!-- END: m2loop -->],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#000',
                    align: 'right',
                    y: -25,
                    style: {fontSize: '12px'}
                }
            }]
        });
        <!-- END: m2bs -->
        <!-- BEGIN: m1bs -->
        $('#m1bschart').highcharts({
            chart: {type: 'column'},
            title: {text: ''},
            credits: {enabled: false},
            xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
            yAxis: {min: 0, title: {text: ''}},
            legend: {enabled: false},
            series: [{
                name: '{LANG.sold}',
                data: [<!-- BEGIN: m1loop -->{M1BS_JSON}<!-- END: m1loop -->],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#000',
                    align: 'right',
                    y: -25,
                    style: {fontSize: '12px'}
                }
            }]
        });
        <!-- END: m1bs -->
        <!-- BEGIN: m3bs -->
        $('#m3bschart').highcharts({
            chart: {type: 'column'},
            title: {text: ''},
            credits: {enabled: false},
            xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
            yAxis: {min: 0, title: {text: ''}},
            legend: {enabled: false},
            series: [{
                name: '{LANG.sold}',
                data: [<!-- BEGIN: m3loop -->{M3BS_JSON}<!-- END: m3loop -->],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#000',
                    align: 'right',
                    y: -25,
                    style: {fontSize: '12px'}
                }
            }]
        });
        <!-- END: m3bs -->
       	<!-- BEGIN: m4bs -->
        $('#m4bschart').highcharts({
            chart: {type: 'column'},
            title: {text: ''},
            credits: {enabled: false},
            xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
            yAxis: {min: 0, title: {text: ''}},
            legend: {enabled: false},
            series: [{
                name: '{LANG.sold}',
                data: [<!-- BEGIN: m4loop -->{M4BS_JSON}<!-- END: m4loop -->],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#000',
                    align: 'right',
                    y: -25,
                    style: {fontSize: '12px'}
                }
            }]
        });
		<!-- END: m4bs -->
		});
	</script>
	<div class="box">
	    <div class="box-header">
	        <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>{LANG.reports_best_sellers}  </h2>
			<div class="box-icon">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="form-group col-md-24">
							<label class="col-sm-24 col-md-8 "><strong>{LANG.warehouses}</strong> <span class="red">(*)</span></label>
							<div class="col-sm-24 col-md-16">
								<select class="form-control" name="report_warehouse_id" id="report_warehouse_id">
									<option value="0"> --{LANG.warehouses_all}-- </option>
									<!-- BEGIN: wloop -->
									<option value="{WAREHOUSE.key}" {WAREHOUSE.selected}>{WAREHOUSE.title}</option>
									<!-- END: wloop -->
								</select>
								<input class=" form-control col-md-20" type="hidden" name="warehouse_session" value="{WAREHOUSE_SESSION}" id="warehouse_session"/>
							</div>
						</div>
					</div>
				</div>
	    	</div>
		    <div class="box-content">
				<div class="clearfix"></div>
			    <div class="row" style="margin-bottom: 15px;">
			        <div class="col-sm-12">
			            <div class="box">
			                <div class="box-header">
			                    <h2 class="blue">{M1}
			                    </h2>
			                </div>
			                <div class="box-content">
			                    <div class="row">
			                        <div class="col-md-24">
			                            <div id="m1bschart" style="width:100%; height:450px;"></div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <div class="col-sm-12">
			            <div class="box">
			                <div class="box-header">
			                    <h2 class="blue">{M2}
			                    </h2>
			                </div>
			                <div class="box-content">
			                    <div class="row">
			                        <div class="col-md-24">
			                            <div id="m2bschart" style="width:100%; height:450px;"></div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
		
			    <div class="row">
			        <div class="col-sm-12">
			            <div class="box">
			                <div class="box-header">
			                    <h2 class="blue">{M3}
			                    </h2>
			                </div>
			                <div class="box-content">
			                    <div class="row">
			                        <div class="col-md-24">
			                            <div id="m3bschart" style="width:100%; height:450px;"></div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <div class="col-sm-12">
			            <div class="box">
			                <div class="box-header">
			                    <h2 class="blue">{M4}
			                    </h2>
			                </div>
			                <div class="box-content">
			                    <div class="row">
			                        <div class="col-md-24">
			                            <div id="m4bschart" style="width:100%; height:450px;"></div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
	
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

</div>

<!-- END: main -->