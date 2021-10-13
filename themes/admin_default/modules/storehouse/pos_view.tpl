<!-- BEGIN: main -->
<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Invoice Không 5</title>
        <base href="{MY_DOMAIN}"/>
        <meta http-equiv="cache-control" content="max-age=0"/>
        <meta http-equiv="cache-control" content="no-cache"/>
        <meta http-equiv="expires" content="0"/>
        <meta http-equiv="pragma" content="no-cache"/>
        <link rel="shortcut icon" href="/themes/admin_default/js/storehouse/assets/images/icon.png"/>
        <link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/styles/theme.css" type="text/css"/>
        <style type="text/css" media="all">
            body { color: #000; }
            #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }
            .btn { border-radius: 0; margin-bottom: 5px; }
            .bootbox .modal-footer { border-top: 0; text-align: center; }
            h3 { margin: 5px 0; }
            .order_barcodes img { float: none !important; margin-top: 5px; }
            @media print {
                .no-print { display: none; }
                #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }
                .no-border { border: none !important; }
                .border-bottom { border-bottom: 1px solid #ddd !important; }
                table tfoot { display: table-row-group; }
            }
        </style>
    </head>

    <body>
            <div id="wrapper">
        <div id="receiptData">
            <div class="no-print">
                            </div>
            <div id="receipt-data">
                <div class="text-center">
                    <img src="{LINK_LOGO}" alt="">
                    <h3 style="text-transform:uppercase;">{TITLE_SHOP}</h3>
                    <p>{ADDRESS}<br>{LANG.phone}: {MOBILE}<br>{LANG.tax_code}: {GST}<br></p>
                </div>
                <p>{LANG.date}: {ORDER_DATE}<br>
                	{LANG.bill_no}: {ORDER_BILL}<br>
                	{LANG.sales_name}: {SALES_NAME}</p>
               <p>{LANG.customer}: {CUSTOMER}<br></p>
                <div style="clear:both;"></div>
                <table class="table table-condensed">
                    <tbody>
                    	<!-- BEGIN: product -->
                        <tr>
                        	<td colspan="2" class="no-border">#1: &nbsp;&nbsp;{PRODUCT.product_name}<span class="pull-right">*NT</span></td>
                        	
                        </tr>
                        <tr>
                        	<td class="no-border border-bottom">{PRODUCT.quantity} x {PRODUCT.real_unit_price}</td>
                        	<td class="no-border border-bottom text-right">{PRODUCT.real_total}</td>
                        </tr>
                       <!-- END: product -->
                     </tbody>
                    <tfoot>
                        <tr>
                            <th>{LANG.total}</th>
                            <th class="text-right">{AMOUNT}</th>
                        </tr>
                                                    <tr>
                                <th>{LANG.total_2}</th>
                                <th class="text-right">{AMOUNT}</th>
                            </tr>
                                                </tfoot>
                </table>
                <table class="table table-striped table-condensed"><tbody><tr><td>{LANG.payment_by}: {PAYMENT_TYPE}</td><td colspan="2">{LANG.total_2}: {AMOUNT}</td><td>{LANG.total_return}: {total_return}</td></tr></tbody></table>
                
                                                                <p class="text-center"> {LANG.thanks_order}</p>            </div>

           
            <div style="clear:both;"></div>
        </div>

        <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
            <hr>
                                        <span class="pull-right col-xs-12">
                    <button onclick="window.print();" class="btn btn-block btn-primary">{LANG.print}</button>                </span>
                <span class="col-xs-12">
                    <a class="btn btn-block btn-warning" href="/admin/index.php?language=vi&nv=storehouse&op=pos">{LANG.back_pos}</a>
                </span>
                                <div style="clear:both;"></div>
                <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">
                    {LANG.print_note}
                </div>
                            <div style="clear:both;"></div>
        </div>
    </div>

            <script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/custom.js"></script>
           
            </body>
</html>

<!-- END: main -->