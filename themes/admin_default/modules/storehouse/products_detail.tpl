<!-- BEGIN: main -->
<link data-offset="0" rel="stylesheet" href="{$NV_BASE_SITEURL}{$NV_ASSETS_DIR}/js/select2/select2.min.css">
<script src="{$NV_BASE_SITEURL}{$NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
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
					<th>{LANG.category_id}</th>
                    <th>{LANG.cost}</th>
                    <th>{LANG.quantity}</th>
                    <th>{LANG.unit}</th>
                    <th>{LANG.alert_quantity}</th>
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
                    <td> <a href="{VIEW.link_detail}">{VIEW.code}</a> </td>
                    <td> {VIEW.name} </td>
					<td> {VIEW.brand} </td>
					<td> {VIEW.category_id} </td>
                    <td> {VIEW.cost} </td>
                    <td> {VIEW.quantity} </td>
                    <td> {VIEW.unit} </td>
                    <td> {VIEW.alert_quantity} </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- END: view -->
<!-- BEGIN: products -->
<div class="well">
	<ul class="nav nav-tabs ext-detail-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#product_detail" aria-controls="product_detail" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li>
		<li role="presentation" ><a href="#chart" aria-controls="extbasic" role="tab" data-toggle="tab" aria-expanded="false">{LANG.chart}</a></li>
		<li role="presentation" ><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab" aria-expanded="false">{LANG.sales}</a></li>
		<li role="presentation" ><a href="#purechases" aria-controls="purechases" role="tab" data-toggle="tab" aria-expanded="false">{LANG.purechases}</a></li>
		<li role="presentation" ><a href="#transfer" aria-controls="transfer" role="tab" data-toggle="tab" aria-expanded="false">{LANG.transfer}</a></li>
		<li role="presentation" ><a href="#damages" aria-controls="damages" role="tab" data-toggle="tab" aria-expanded="false">{LANG.damages}</a></li>
	</ul>
	<div class="row">
		<div class="col-sm-24 col-md-24">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="product_detail">
					<div > 
						<div class="row">
                            <div class="col-sm-10">
                                <img src="{ROW.image}" alt="{ROW.name}" class="img-responsive img-thumbnail">
									
                                <div id="multiimages" class="padding10">
                                     <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-14">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped dfTable table-right-left">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr>
                                        <tr>
                                            <td style="width:30%;">{LANG.barcode} &amp; {LANG.qrcode}</td>
                                            <td style="width:70%;">
                                            <img src="{ROW.barcode}" alt="{ROW.name}" class="bcimg">
                                                <img src="{ROW.barcode}" alt="{ROW.link_view_pro}" class="qrimg">                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.type}</td>
                                            <td>{ROW.link_view_pro}</td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.name}</td>
                                            <td>{ROW.name}</td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.code}</td>
                                            <td>{ROW.code}</td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.brand}</td>
                                            <td>{ROW.brand}</td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.cateloges}</td>
                                            <td>{ROW.name}</td>
                                        </tr>
                                        <tr>
                                            <td>{LANG.unit}</td>
                                            <td>{ROW.unit_name} ({ROW.unit_code}:)</td>
                                        </tr>
                                        <tr><td>{LANG.cost}</td><td>{ROW.cost}</td></tr><tr><td>{LANG.price}</td><td>{ROW.price}</td></tr>
                                         <tr>
                                                <td>{LANG.tax_rate}</td>
                                                <td>{ROW.tax_rate}</td>
                                            </tr>
                                            <tr>
                                                <td>{LANG.tax_method}</td>
                                                <td>{ROW.tax_method}</td>
                                            </tr>
                                                                                                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-24">
                                <div class="row">
                                    <div class="col-sm-10">
                                        
                                        <h3 class="bold">{LANG.wantity_of_warehouse}</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                <thead>
                                                <tr>
                                                    <th>{LANG.name_of_warehouse}</th>
                                                    <th>{LANG.quantity} </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                	<!-- BEGIN: warehouse -->
                                                	<tr><td>{WAREHOUSE.name} </td><td><strong>{WAREHOUSE.quantity}</strong></td></tr>  
                                               	 	<!-- END: warehouse --> 
                                               	</tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-14">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-24">

                                <div class="panel panel-success">
                                	<div class="panel-heading">{LANG.details}</div>
                                	<div class="panel-body"><p>{ROW.details}</p></div>
                                </div>
                                <div class="panel panel-primary">
                                	<div class="panel-heading">{LANG.product_details}</div>
                                	<div class="panel-body"><p>{ROW.product_details}</p></div>
                                </div>
                            </div>
                        </div>
						
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="chart">
					<div > 
				        <script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/hc/highcharts.js"></script>
				        <script type="text/javascript">
					        function formatThousandsWithRounding(n, dp){
							  var w = n.toFixed(dp), k = w|0, b = n < 0 ? 1 : 0,
							      u = Math.abs(w-k), d = (''+u.toFixed(dp)).substr(2, dp),
							      s = ''+k, i = s.length, r = '';
							  while ( (i-=3) > b ) { r = ',' + s.substr(i, 3) + r; }
							  return s.substr(0, i + 3) + r + (d ? '.'+d: '');
							};
							
							
				        	site = {
								"url":"https:\/\/quanlykho.vinasaas.net\/",
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
							
				        	
							</script>
							<!-- BEGIN: chart -->
							<script type="text/javascript">
				            $(function () {
				            	
				                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
				                    return {
				                        radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
				                        stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
				                    };
				                });
				                 var sold_chart = new Highcharts.Chart({
				                    chart: {
				                        renderTo: 'soldchart',
				                        type: 'line',
				                        width: ($('#details').width()-160)/2},
				                    credits: {enabled: false},
				                    title: {text: ''},
				                    xAxis: {
				                        categories: [<!-- BEGIN: csales -->'{SMONTH}', <!-- END: csales -->]
				                    },
				                    yAxis: {min: 0, title: ""},
				                    legend: {enabled: false},
				                    tooltip: {
				                        shared: true,
				                        followPointer: true,
				                        formatter: function () {
				                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;min-width:150px;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
				                            $.each(this.points, function () {
				                                if (this.series.name == '{LANG.total}') {
				                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
				                                    currencyFormat(this.y) + '</b></td></tr>';
				                                } else {
				                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
				                                    formatQuantity(this.y) + '</b></td></tr>';
				                                }
				                            });
				                            s += '</table></div>';
				                            return s;
				                        },
				                        useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
				                        style: {fontSize: '14px', padding: '0', color: '#000000'}
				                    },
				                    series: [{
				                        type: 'spline',
				                        name: '{LANG.saled}',
				                        data: [<!-- BEGIN: csales2 -->['{SMONTH}', {SQUANTITY}],<!-- END: csales2 -->]
				                    }, {
				                        type: 'spline',
				                        name: '{LANG.total}',
				                        data: [<!-- BEGIN: csales3 -->['{SMONTH}', {SAMOUNT}],<!-- END: csales3 -->]
				                    }]
				                });
				                $(window).resize(function () {
				                    sold_chart.setSize($('#soldchart').width(), 450);
				                });
				                var purchased_chart = new Highcharts.Chart({
				                    chart: {renderTo: 'purchasedchart', type: 'line', width: ($('#details').width() - 160) / 2},
				                    credits: {enabled: false},
				                    title: {text: ''},
				                    xAxis: {
				                        categories: [<!-- BEGIN: cpurchases -->'{SMONTH}', <!-- END: cpurchases -->]
				                    },
				                    yAxis: {min: 0, title: ""},
				                    legend: {enabled: false},
				                    tooltip: {
				                        shared: true,
				                        followPointer: true,
				                        formatter: function () {
				                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;min-width:150px;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
				                            $.each(this.points, function () {
				                                if (this.series.name == '{LANG.total}') {
				                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
				                                    currencyFormat(this.y) + '</b></td></tr>';
				                                } else {
				                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
				                                    formatQuantity(this.y) + '</b></td></tr>';
				                                }
				                            });
				                            s += '</table></div>';
				                            return s;
				                        },
				                        useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
				                        style: {fontSize: '14px', padding: '0', color: '#000000'}
				                    },
				                    series: [{
				                        type: 'spline',
				                        name: '{LANG.purchases_add}',
				                        data: [<!-- BEGIN: cpurchases2 -->['{PMONTH}', {PQUANTITY}],<!-- END: cpurchases2 -->]
				                    }, {
				                        type: 'spline',
				                        name: '{LANG.total}',
				                        data: [<!-- BEGIN: cpurchases3 -->['{PMONTH}', {PAMOUNT}],<!-- END: cpurchases3 -->]
				                    }]
				                });
				                $(window).resize(function () {
				                    purchased_chart.setSize($('#purchasedchart').width(), 450);
				                });
				                
				            });
				           
				        </script>
				        <!-- END: chart -->
				        <div class="box">
				            <div class="box-header">
				                <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o nb"></i>Biểu đồ</h2>
				            </div>
				            <div class="box-content">
				                <div class="row">
				                    <div class="col-md-24">
				                        <div class="row" style="margin-bottom: 15px;">
				                            <div class="col-sm-12">
				                                <div class="box" style="border-top: 1px solid #dbdee0;">
				                                    <div class="box-header">
				                                        <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>{LANG.sales_add} </h2>                                        </h2>
				                                    </div>
				                                    <div class="box-content">
				                                        <div class="row">
				                                            <div class="col-md-24">
				                                                <div id="soldchart" style="width:100%; height:450px;" >
				                                                	
				                                                </div>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                                                            <div class="col-sm-12">
				                                    <div class="box" style="border-top: 1px solid #dbdee0;">
				                                        <div class="box-header">
				                                            <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>{LANG.purchases_add} </h2>
				                                        </div>
				                                        <div class="box-content">
				                                            <div class="row">
				                                                <div class="col-md-24">
				                                                    <div id="purchasedchart" style="width:100%; height:450px;" >
				                                                    	
				                                                    </div>
				                                                </div>
				                                            </div>
				                                        </div>
				                                    </div>
				                                </div>
				                                                    </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>
				<div role="tabpanel" class="tab-pane" id="sales">
					<div>
						<div class="table-responsive">
					        <table class="table table-striped table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th class="w100">{LANG.number}</th>
					                    <th>{LANG.reference_no}</th>
					                    <th>{LANG.sales_date}</th>
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
					                    <td> {SALES.number} </td>
					                    <td> {SALES.reference_no} </td>
					                    <td> {SALES.date} </td>
					                    <td> {SALES.biller} </td>
					                    <td> {SALES.warehouse} </td>
					                    <td> {SALES.total} </td>
					                    <td> {SALES.paid} </td>
					                    <td> {SALES.balance} </td>
					                    <td> {SALES.payment_status} </td>
					                    
					                </tr>
					                <!-- END: sales -->
					            </tbody>
					        </table>
					    </div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="purechases">
					<div >
						<div class="table-responsive">
					        <table class="table table-striped table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th class="w100">{LANG.number}</th>
					                    <th>{LANG.reference_no}</th>
					                    <th>{LANG.date}</th>
					                    <th>{LANG.supplier_id}</th>
					                    <th>{LANG.warehouse_id}</th>
					                    <th>{LANG.total}</th>
					                    <th>{LANG.paid}</th>
					                    <th>{LANG.balance}</th>
					                    <th>{LANG.payment_status}</th>
					                    
					                </tr>
					            </thead>
					          
					            <tbody>
					                <!-- BEGIN: purchases -->
					                <tr>
					                    <td> {PURCHASES.number} </td>
					                    <td> {PURCHASES.reference_no} </td>
					                    <td> {PURCHASES.date} </td>
					                    <td> {PURCHASES.supplier} </td>
					                    <td> {PURCHASES.warehouse} </td>
					                    <td> {PURCHASES.total} </td>
					                    <td> {PURCHASES.paid} </td>
					                    <td> {PURCHASES.balance} </td>
					                    <td> {PURCHASES.payment_status} </td>
					                    
					                </tr>
					                <!-- END: purchases -->
					            </tbody>
					        </table>
					    </div>
						
						
					</div> 
				</div>
				<div role="tabpanel" class="tab-pane" id="transfer">
					<div > 
							<div class="table-responsive">
					        <table class="table table-striped table-bordered table-hover">
					            <thead>
					                <tr>
					                    <th class="w100">{LANG.number}</th>
					                    <th>{LANG.transfer_no}</th>
					                    <th>{LANG.date}</th>
					                    <th>{LANG.product_nam_quantity}</th>
					                    <th>{LANG.warehouse_id}</th>
					                    <th>{LANG.warehouse_id_new}</th>
					                    <th>{LANG.total}</th>
					                    <th>{LANG.status}</th>
					                    
					                </tr>
					            </thead>
					          
					            <tbody>
					                <!-- BEGIN: transfer -->
					                <tr>
					                    <td> {TRANSFER.number} </td>
					                    <td> {TRANSFER.transfer_no} </td>
					                     <td> {TRANSFER.date} </td>
					                    <td> {TRANSFER.product_name} ({TRANSFER.quantity} ) </td>
					                   
					                    <td> {TRANSFER.warehouse} </td>
					                    <td> {TRANSFER.warehouse_new} </td>
					                    <td> {TRANSFER.total} </td>
					                    <td> {TRANSFER.status} </td>
					                    
					                </tr>
					                <!-- END: transfer -->
					            </tbody>
					        </table>
					    </div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="damages">
					<div class="text-center">{LANG.damages} </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: products -->
<!-- END: main -->