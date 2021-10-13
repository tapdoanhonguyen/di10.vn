<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<!-- BEGIN: config -->

<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="setting_id" value="{ROW.setting_id}" />
    <input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.logo}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="logo" value="{ROW.logo}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.logo2}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="logo2" value="{ROW.logo2}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.site_name}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="site_name" value="{ROW.site_name}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.language}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="language">
                <option value=""> --- </option>
                <!-- BEGIN: select_language -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_language -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_warehouse}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="default_warehouse">
                <!-- BEGIN: select_default_warehouse -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_default_warehouse -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.accounting_method}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="accounting_method">
                <option value=""> --- </option>
                <!-- BEGIN: select_accounting_method -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_accounting_method -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_currency}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="default_currency">
                <option value=""> --- </option>
                <!-- BEGIN: select_default_currency -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_default_currency -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_tax_rate}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="default_tax_rate">
                <option value=""> --- </option>
                <!-- BEGIN: select_default_tax_rate -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_default_tax_rate -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.rows_per_page}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="rows_per_page" value="{ROW.rows_per_page}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.version}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="version" value="{ROW.version}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_tax_rate2}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="default_tax_rate2">
                <option value=""> --- </option>
                <!-- BEGIN: select_default_tax_rate2 -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_default_tax_rate2 -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.dateformat}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="dateformat">
                <option value=""> --- </option>
                <!-- BEGIN: select_dateformat -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_dateformat -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_prefix" value="{ROW.product_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.sales_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="sales_prefix" value="{ROW.sales_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.quote_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="quote_prefix" value="{ROW.quote_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.purchase_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="purchase_prefix" value="{ROW.purchase_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.transfer_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="transfer_prefix" value="{ROW.transfer_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.delivery_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="delivery_prefix" value="{ROW.delivery_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.payment_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="payment_prefix" value="{ROW.payment_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.return_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="return_prefix" value="{ROW.return_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.returnp_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="returnp_prefix" value="{ROW.returnp_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.expense_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="expense_prefix" value="{ROW.expense_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.item_addition}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="item_addition" value="{ROW.item_addition}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.theme}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="theme">
                <option value=""> --- </option>
                <!-- BEGIN: select_theme -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_theme -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_serial}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_serial" value="{ROW.product_serial}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="default_discount">
                <option value=""> --- </option>
                <!-- BEGIN: select_default_discount -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_default_discount -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_discount" value="{ROW.product_discount}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.discount_method}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="discount_method" value="{ROW.discount_method}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tax1}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="tax1">
                <option value=""> --- </option>
                <!-- BEGIN: select_tax1 -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_tax1 -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tax2}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="tax2">
                <option value=""> --- </option>
                <!-- BEGIN: select_tax2 -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_tax2 -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.overselling}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="overselling" value="{ROW.overselling}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.restrict_user}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="restrict_user" value="{ROW.restrict_user}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.restrict_calendar}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="restrict_calendar" value="{ROW.restrict_calendar}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.timezone}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="timezone">
                <option value=""> --- </option>
                <!-- BEGIN: select_timezone -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_timezone -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.iwidth}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="iwidth" value="{ROW.iwidth}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.iheight}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="iheight" value="{ROW.iheight}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.twidth}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="twidth" value="{ROW.twidth}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.theight}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="theight" value="{ROW.theight}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.watermark}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="watermark" value="{ROW.watermark}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.reg_ver}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="reg_ver" value="{ROW.reg_ver}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.allow_reg}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="allow_reg" value="{ROW.allow_reg}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.reg_notification}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="reg_notification" value="{ROW.reg_notification}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.auto_reg}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="auto_reg" value="{ROW.auto_reg}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.protocol}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="protocol" value="{ROW.protocol}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.mailpath}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="mailpath" value="{ROW.mailpath}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.smtp_host}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="smtp_host" value="{ROW.smtp_host}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.smtp_user}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="smtp_user" value="{ROW.smtp_user}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.smtp_pass}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="smtp_pass" value="{ROW.smtp_pass}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.smtp_port}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="smtp_port" value="{ROW.smtp_port}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.smtp_crypto}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="smtp_crypto" value="{ROW.smtp_crypto}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.corn}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="corn" value="{ROW.corn}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_group}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="customer_group" value="{ROW.customer_group}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_email}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="default_email" value="{ROW.default_email}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.mmode}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="mmode" value="{ROW.mmode}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.bc_fix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="bc_fix" value="{ROW.bc_fix}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.auto_detect_barcode}</strong></label>
        <div class="col-sm-19 col-md-20">
        	<select class="form-control" name="auto_detect_barcode">
				<option value=""> --- </option>
				<!-- BEGIN: select_barcode-->
				<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
				<!-- END: select_barcode -->
			</select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.captcha}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="captcha" value="{ROW.captcha}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.reference_format}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="reference_format" value="{ROW.reference_format}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.racks}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="racks">
                <option value=""> --- </option>
                <!-- BEGIN: select_racks -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_racks -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.attributes}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="attributes">
                <option value=""> --- </option>
                <!-- BEGIN: select_attributes -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_attributes -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_expiry}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_expiry" value="{ROW.product_expiry}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.decimals}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="decimals" value="{ROW.decimals}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.qty_decimals}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="qty_decimals" value="{ROW.qty_decimals}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.decimals_sep}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="decimals_sep" value="{ROW.decimals_sep}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.thousands_sep}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="thousands_sep" value="{ROW.thousands_sep}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.invoice_view}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="invoice_view" value="{ROW.invoice_view}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.default_biller}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="default_biller" value="{ROW.default_biller}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.envato_username}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="envato_username" value="{ROW.envato_username}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.purchase_code}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="purchase_code" value="{ROW.purchase_code}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.rtl}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="rtl" value="{ROW.rtl}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.each_spent}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="each_spent" value="{ROW.each_spent}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.ca_point}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="ca_point" value="{ROW.ca_point}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.each_sale}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="each_sale" value="{ROW.each_sale}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.sa_point}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="sa_point" value="{ROW.sa_point}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.update}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="update" value="{ROW.update}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.sac}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="sac" value="{ROW.sac}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.display_all_products}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="display_all_products" value="{ROW.display_all_products}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.display_symbol}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="display_symbol" value="{ROW.display_symbol}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.symbol}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="symbol" value="{ROW.symbol}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.remove_expired}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="remove_expired" value="{ROW.remove_expired}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.barcode_separator}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="barcode_separator" value="{ROW.barcode_separator}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.set_focus}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="set_focus" value="{ROW.set_focus}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price_group}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="price_group" value="{ROW.price_group}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.barcode_img}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="barcode_img" value="{ROW.barcode_img}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.ppayment_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="ppayment_prefix" value="{ROW.ppayment_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.disable_editing}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="disable_editing" value="{ROW.disable_editing}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.qa_prefix}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="qa_prefix" value="{ROW.qa_prefix}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.update_cost}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="update_cost" value="{ROW.update_cost}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.apis}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="apis" value="{ROW.apis}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.state}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="state" value="{ROW.state}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.pdf_lib}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="pdf_lib">
                <option value=""> --- </option>
                <!-- BEGIN: select_pdf_lib -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_pdf_lib -->
            </select>
        </div>
    </div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div>
<!-- END: config -->

</div>
<!-- END: main -->