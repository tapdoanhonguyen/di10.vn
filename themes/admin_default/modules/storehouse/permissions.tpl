<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
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
                    <th>{LANG.group_name}</th>
                    <th>{LANG.group_hometext}</th>
                    <th class="w150">&nbsp;</th>
                </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="checkbox-center" colspan="3">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td> {VIEW.number} </td>
                    <td> <a href = "{VIEW.link_view}"  >{VIEW.group_title}</a> </td>
                    <td> {VIEW.group_hometext} </td>
                    <td class="checkbox-center">
                    	<!-- BEGIN: action -->
                    	<i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{ACTION.link_edit}#edit">{LANG.permissions}</a>
                    	<!-- END: action -->
                    </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- END: view -->

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />

    <div class="form-group">
    	<table class="table table-bordered table-hover table-striped reports-table">

            <thead>
            <tr>
                <th colspan="6" class="text-center"> {LANG.permissions} :  {GROUPS_TITLE} <input type="hidden" name="group_id" value="{GROUPS_ID}" />
	            
	           </th>
            </tr>
            <tr>
                <th rowspan="2" class="text-center">{LANG.permissions_func}                                   </th>
                <th colspan="5" class="text-center">{LANG.permissions_limit}  </th>
            </tr>
            <tr>
                <th class="text-center">{LANG.permissions_index} </th>
                <th class="text-center">{LANG.permissions_add} </th>
                <th class="text-center">{LANG.permissions_edit} </th>
                <th class="text-center">{LANG.permissions_delete} </th>
                <th class="text-center">{LANG.permissions_other} </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{LANG.permissions_products}</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="products_index" value="1" {ROW.products_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="products_add" value="1" {ROW.products_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="products_edit" value="1" {ROW.products_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="products_delete" value="1" {ROW.products_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_cost" value="1" {ROW.products_cost} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products-cost" class="padding05">{LANG.products_cost}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_price" value="1" {ROW.products_price} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products-price" class="padding05">{LANG.products_price}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_adjustments" value="1" {ROW.products_adjustments} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products-adjustments" class="padding05">{LANG.products_adjustments}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_barcode" value="1" {ROW.products_barcode} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products-barcode" class="padding05">{LANG.products_barcode}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_stock_count" value="1" {ROW.products_stock_count} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products-stock_count" class="padding05">{LANG.products_stock_count}</label>
                    </span>
                </td>
            </tr>
            <tr>
                <td>{LANG.sales_list}</td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="sales_index" {ROW.sales_index}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="sales_add" {ROW.sales_add}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="sales_edit" {ROW.sales_edit}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="sales_delete" {ROW.sales_delete}>
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input type="checkbox" value="1" id="sales-email" class="form-control" name="sales_email" {ROW.sales_email}>
                        <label for="sales_email" class="padding05">{LANG.permissions_email}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input type="checkbox" value="1" id="sales-pdf" class="form-control" name="sales_pdf" {ROW.sales_pdf}>
                        <label for="sales_pdf" class="padding05">{LANG.permissions_pdf}</label>
                    </span>
                    
                    <span style="display:inline-block;">
                        <input type="checkbox" value="1" id="sales-payments" class="form-control" name="sales_payments" {ROW.sales_payments}>
                        <label for="sales_payments" class="padding05">{LANG.sales_payments}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input type="checkbox" value="1" id="sales_return_sales" class="form-control" name="sales_return_sales" {ROW.sales_return_sales}>
                        <label for="sales_return_sales" class="padding05">{LANG.sales_return_sales}</label>
                    </span>
                </td>
            </tr>
            <tr>
                <td>{LANG.permissions_purchases}</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="purchases_index" value="1" {ROW.purchases_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="purchases_add" value="1" {ROW.purchases_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="purchases_edit" value="1" {ROW.purchases_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="purchases_delete" value="1" {ROW.purchases_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="purchases_email" value="1" {ROW.purchases_email} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases-email" class="padding05">{LANG.permissions_email}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="purchases_pdf" value="1" {ROW.purchases_pdf} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases-pdf" class="padding05">{LANG.permissions_pdf}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="purchases_payments" value="1" {ROW.purchases_payments} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases-payments" class="padding05">{LANG.purchases_payments}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="purchases_expenses" value="1" {ROW.purchases_expenses} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases-expenses" class="padding05">{LANG.purchases_expenses}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="purchases_return_purchases" value="1" {ROW.purchases_return_purchases} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases-return_purchases" class="padding05">{LANG.purchases_return_purchases}</label>
                    </span>
                </td>
            </tr>

            <tr>
                <td>{LANG.permissions_transfers}</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="transfers_index" value="1" {ROW.transfers_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="transfers_add" value="1" {ROW.transfers_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="transfers_edit" value="1" {ROW.transfers_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="transfers_delete" value="1" {ROW.transfers_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="transfers_email" value="1" {ROW.transfers_email} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="transfers-email" class="padding05">{LANG.permissions_email}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="transfers_pdf" value="1" {ROW.transfers_pdf} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="transfers-pdf" class="padding05">{LANG.permissions_pdf}</label>
                    </span>
                </td>
            </tr>

            <tr>
                <td>{LANG.permissions_return}</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="returns_index" value="1" {ROW.returns_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="returns_add" value="1" {ROW.returns_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="returns_edit" value="1" {ROW.returns_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="returns_delete" value="1" {ROW.returns_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="returns_email" value="1" {ROW.returns_email} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="returns-email" class="padding05">{LANG.permissions_email}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="returns_pdf" value="1" {ROW.returns_pdf} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="returns-pdf" class="padding05">{LANG.permissions_pdf}</label>
                    </span>
                </td>
            </tr>
			<tr>
                <td>{LANG.gift_card}</td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="gift_index" {ROW.gift_index}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="gift_add" {ROW.gift_add}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="gift_edit" {ROW.gift_edit}>
                </td>
                <td class="text-center">
                    <input type="checkbox" value="1" class="form-control" name="gift_delete" {ROW.gift_delete}>
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>{LANG.permissions_customers}</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="customers_index" value="1" {ROW.customers_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="customers_add" value="1" {ROW.customers_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="customers_edit" value="1" {ROW.customers_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="customers_delete" value="1" {ROW.customers_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="customers_deposits" value="1" {ROW.customers_deposits} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="customers-deposits" class="padding05">{LANG.customers_deposits}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="customers_delete_deposit" value="1" {ROW.customers_delete_deposit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="customers-delete_deposit" class="padding05">{LANG.customers_delete_deposit}</label>
                    </span>
                </td>
            </tr>

            <tr>
                <td>Nhà cung cấp</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="suppliers_index" value="1" {ROW.suppliers_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="suppliers_add" value="1" {ROW.suppliers_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="suppliers_edit" value="1" {ROW.suppliers_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="suppliers_delete" value="1" {ROW.suppliers_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                </td>
            </tr>
			 <tr>
                <td>Danh mục</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="cat_index" value="1" {ROW.cat_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="cat_add" value="1" {ROW.cat_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="cat_edit" value="1" {ROW.cat_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="cat_delete" value="1" {ROW.cat_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Kho hàng</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="warehouse_index" value="1" {ROW.warehouse_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="warehouse_add" value="1" {ROW.warehouse_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="warehouse_edit" value="1" {ROW.warehouse_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="warehouse_delete" value="1" {ROW.warehouse_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Chi nhánh</td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="store_index" value="1" {ROW.store_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="store_add" value="1" {ROW.store_add} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="store_edit" value="1" {ROW.store_edit} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td class="text-center">
                    <input class="form-control" type="checkbox" name="store_delete" value="1" {ROW.store_delete} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Báo cáo</td>
                <td colspan="5">
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_index" value="1" {ROW.reports_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_index" class="padding05">{LANG.reports_index}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_best_sellers" value="1" {ROW.reports_best_sellers} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_best_sellers" class="padding05">{LANG.reports_best_sellers}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_warehouse_stock" value="1" {ROW.reports_warehouse_stock} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_index" class="padding05">{LANG.reports_warehouse_stock}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_quantity_alerts" value="1" {ROW.reports_quantity_alerts} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="product_quantity_alerts" class="padding05">{LANG.reports_quantity_alerts}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_expiry_alerts" value="1" {ROW.reports_expiry_alerts} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="Product_expiry_alerts" class="padding05">{LANG.reports_expiry_alerts}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_products" value="1" {ROW.reports_products} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products" class="padding05">{LANG.reports_products}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_payments" value="1" {ROW.reports_payments} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="payments" class="padding05">{LANG.reports_payments}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_tax" value="1" {ROW.reports_tax} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="tax" class="padding05">{LANG.reports_tax}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_expenses" value="1" {ROW.reports_expenses} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="expenses" class="padding05">{LANG.reports_expenses}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_purchases" value="1" {ROW.reports_purchases} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="purchases" class="padding05">{LANG.reports_purchases}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_sales" value="1" {ROW.reports_sales} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_sales" class="padding05">{LANG.reports_sales}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_daily_sales" value="1" {ROW.reports_daily_sales} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_daily_sales" class="padding05">{LANG.reports_daily_sales}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_monthly_sales" value="1" {ROW.reports_monthly_sales} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_monthly_sales" class="padding05">{LANG.reports_monthly_sales}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_daily_purchases" value="1" {ROW.reports_daily_purchases} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_daily_purchases" class="padding05">{LANG.reports_daily_purchases}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_monthly_purchases" value="1" {ROW.reports_monthly_purchases} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_monthly_purchases" class="padding05">{LANG.reports_monthly_purchases}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_profit_loss" value="1" {ROW.reports_profit_loss} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="reports_profit_loss" class="padding05">{LANG.reports_profit_loss}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_customers" value="1" {ROW.reports_customers} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="customers" class="padding05">{LANG.reports_customers}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_suppliers" value="1" {ROW.reports_suppliers} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="suppliers" class="padding05">{LANG.reports_suppliers}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="reports_staff" value="1" {ROW.reports_staff} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="staff" class="padding05">{LANG.reports_staff}</label>
                    </span>
                    
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="products_stock_count" value="1" {ROW.products_stock_count} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="products_stock_count" class="padding05">{LANG.products_stock_count}</label>
                    </span>
                </td>
            </tr>

            <tr>
                <td>{LANG.permissions_other}</td>
                <td colspan="5">
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="bulk_actions" value="1" {ROW.bulk_actions} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="bulk_actions" class="padding05">{LANG.bulk_actions}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="pos_index" value="1" {ROW.pos_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="pos" class="padding05">{LANG.pos}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="ajax" value="1" {ROW.ajax} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="ajax" class="padding05">{LANG.ajax}</label>
                    </span>
                    <span style="display:inline-block;">
                        <input class="form-control" type="checkbox" name="config_index" value="1" {ROW.config_index} pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
                        <label for="config" class="padding05">{LANG.config}</label>
                    </span>
                </td>
            </tr>

            </tbody>
        </table>
    <div class="form-group" style="checkbox-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div></div>
<!-- END: main -->