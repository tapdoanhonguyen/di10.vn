<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.purchase_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="purchase_id" value="{ROW.purchase_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.transfer_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="transfer_id" value="{ROW.transfer_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_id" value="{ROW.product_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_code}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_code" value="{ROW.product_code}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_name}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_name" value="{ROW.product_name}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.option_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="option_id" value="{ROW.option_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.net_unit_cost}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="net_unit_cost" value="{ROW.net_unit_cost}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.quantity}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="quantity" value="{ROW.quantity}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.warehouse_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="warehouse_id" value="{ROW.warehouse_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.item_tax}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="item_tax" value="{ROW.item_tax}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tax_rate_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="tax_rate_id" value="{ROW.tax_rate_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.tax}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="tax" value="{ROW.tax}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="discount" value="{ROW.discount}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.item_discount}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="item_discount" value="{ROW.item_discount}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.expiry}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="expiry" value="{ROW.expiry}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.subtotal}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="subtotal" value="{ROW.subtotal}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.quantity_balance}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="quantity_balance" value="{ROW.quantity_balance}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.date}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="date" value="{ROW.date}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.status}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="status" value="{ROW.status}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit_cost}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="unit_cost" value="{ROW.unit_cost}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.real_unit_cost}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="real_unit_cost" value="{ROW.real_unit_cost}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.quantity_received}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="quantity_received" value="{ROW.quantity_received}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.supplier_part_no}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="supplier_part_no" value="{ROW.supplier_part_no}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.purchase_item_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="purchase_item_id" value="{ROW.purchase_item_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_unit_id}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_unit_id" value="{ROW.product_unit_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.product_unit_code}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="product_unit_code" value="{ROW.product_unit_code}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.unit_quantity}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="unit_quantity" value="{ROW.unit_quantity}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.gst}</strong></label>
        <div class="col-sm-19 col-md-20">
            <input class="form-control" type="text" name="gst" value="{ROW.gst}" />
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
<!-- END: main -->