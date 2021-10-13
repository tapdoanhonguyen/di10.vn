<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<!-- BEGIN: config -->

<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    
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
    
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div>
<!-- END: config -->

</div>
<!-- END: main -->