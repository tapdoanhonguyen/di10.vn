<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<style>
    .table th {
        text-align: center;
    }

    .table td {
        padding: 2px;
    }

    .table td .table td:nth-child(odd) {
        text-align: left;
    }

    .table td .table td:nth-child(even) {
        text-align: right;
    }

    .table a:hover {
        text-decoration: none;
    }

    .cl_wday {
        text-align: center;
        font-weight: bold;
    }

    .cl_equal {
        width: 14%;
    }

    td.day {
        width: 14%;
        padding: 0 !important;
        vertical-align: top !important;
    }

    .day_num {
        width: 100%;
        text-align: left;
        cursor: pointer;
        margin: 0;
        padding: 8px;
    }

    .day_num:hover {
        background: #F5F5F5;
    }

    .content {
        width: 100%;
        text-align: left;
        color: #428bca;
        padding: 8px;
    }

    .highlight {
        color: #0088CC;
        font-weight: bold;
    }
</style>

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
		
	</script>
	<div class="box">
		<div class="box-header">
			<h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>{LANG.warehouses}  </h2>
			<div class="box-icon col-md-12 ">
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
		</div>
		 <div class="box-content">
		 	<div class="row">
	            <div class="col-lg-24">
	                <p class="introtext">{LANG.get_day_profit} {LANG.reports_calendar_text}</p>
	
	                <div>
	                    {calender}
	                </div>
	            </div>
	        </div>
		 </div>
	</div>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/html2canvas.min.js"></script>
	<script type="text/javascript">
		    $(document).ready(function () {
		    	
		        $('.table .day_num').click(function () {
		            var day = $(this).html();
		            var date = '<?= $year.'-'.$month.'-'; ?>'+day;
		            var href = '<?= admin_url('reports/profit'); ?>/'+date+'/<?= ($warehouse_id ? $warehouse_id : ''); ?>';
		            $.get(href, function( data ) {
		                $("#myModal").html(data).modal();
		            });
		
		        });
		        $('#pdf').click(function (event) {
		            event.preventDefault();
		            window.location.href = "<?=admin_url('reports/daily_sales/'.($warehouse_id ? $warehouse_id : 0).'/'.$year.'/'.$month.'/pdf')?>";
		            return false;
		        });
		        $('#image').click(function (event) {
		            event.preventDefault();
		            html2canvas($('.box'), {
		                onrendered: function (canvas) {
		                    openImg(canvas.toDataURL());
		                }
		            });
		            return false;
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
</div>
<div class="clearfix"></div>
<!-- END: main -->