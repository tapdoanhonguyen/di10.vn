<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.reference_no}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="reference_no" value="{ROW.reference_no}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.date}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="date" value="{ROW.date}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.supplier_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="supplier_id" value="{ROW.supplier_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.warehouse_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="warehouse_id" value="{ROW.warehouse_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.note}</strong></label>
        <div class="col-sm-19 col-md-20">
{ROW.note}        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.total}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="total" value="{ROW.total}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_discount" value="{ROW.product_discount}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.order_discount_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="order_discount_id" value="{ROW.order_discount_id}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.order_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="order_discount" value="{ROW.order_discount}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.total_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="total_discount" value="{ROW.total_discount}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_tax}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_tax" value="{ROW.product_tax}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.order_tax_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="order_tax_id" value="{ROW.order_tax_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.order_tax}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="order_tax" value="{ROW.order_tax}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.total_tax}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="total_tax" value="{ROW.total_tax}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.shipping}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="shipping" value="{ROW.shipping}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.grand_total}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="grand_total" value="{ROW.grand_total}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.paid}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="paid" value="{ROW.paid}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.status}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="status">
                <option value=""> --- </option>
                <!-- BEGIN: select_status -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_status -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.payment_status}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="payment_status" value="{ROW.payment_status}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.created_by}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="created_by" value="{ROW.created_by}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.updated_by}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="updated_by" value="{ROW.updated_by}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.updated_at}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="updated_at" value="{ROW.updated_at}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.attachment}</strong></label>
        <div class="col-sm-19 col-md-20">
            <div class="input-group">
            <input class="form-control" type="text" name="attachment" value="{ROW.attachment}" id="id_attachment" />
            <span class="input-group-btn">
                <button class="btn btn-default selectfile" type="button" >
                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
            </button>
            </span>
        </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.payment_term}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="payment_term" value="{ROW.payment_term}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.due_date}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="due_date" value="{ROW.due_date}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.return_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="return_id" value="{ROW.return_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.surcharge}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="surcharge" value="{ROW.surcharge}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.return_purchase_ref}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="return_purchase_ref" value="{ROW.return_purchase_ref}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.purchase_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <select class="form-control" name="purchase_id">
                <option value=""> --- </option>
                <!-- BEGIN: select_purchase_id -->
                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
                <!-- END: select_purchase_id -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.return_purchase_total}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="return_purchase_total" value="{ROW.return_purchase_total}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cgst}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="cgst" value="{ROW.cgst}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.sgst}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="sgst" value="{ROW.sgst}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.igst}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="igst" value="{ROW.igst}" />
        </div>
    </div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div></div>

<script type="text/javascript">
//<![CDATA[
    $(".selectfile").click(function() {
        var area = "id_attachment";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var type = "image";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });

//]]>
</script>
<!-- END: main -->