<!-- BEGIN: main -->

<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<script type="text/javascript">
</script>
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">

<!-- BEGIN: store_id -->
<input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>
<!-- END: store_id -->
<!-- BEGIN: store -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">

    <input type="hidden" name="id" value="{ROW.id}" />
   
   
      <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<tbody>
							<tr class="required">
								<td style="width:200px">{LANG.date}</td>
								<td>
								<input class=" form-control w300" type="text" name="date" value="{ROW.date}" id="date"  required="required"  maxlength="10"style="float: left;"/>
								</td>
							</tr>
						   <tr class="required">
								<td style="width:200px">{LANG.warehouse_id_old}</td>
								<td>
									<select class="form-control w300" name="warehouse_id" id="warehouse_id" ></select>
								</td>
							</tr> 
							<tr class="required">
								<td style="width:200px">{LANG.warehouse_id_new}</td>
								<td>
									<select class="form-control w300" name="warehouse_id_new" id="warehouse_id_new" >
									</select>
								</td>
							</tr>
							
							<tr class="required">
								<td style="width:200px">{LANG.supplier_id}</td>
								<td>
									  <select class="form-control w300" name="supplier_id" id="supplier_id">
											<!-- BEGIN: select_supplier_id -->
											<option value="{SUPPLIER.key}" {SUPPLIER.selected}>{SUPPLIER.title}</option>
											<!-- END: select_supplier_id -->
									  </select>
								</td>
							</tr>
							<tr class="required">
								<td style="width:200px">{LANG.reference_no}</td>
								<td>
								<input class="form-control" type="text" name="reference_no" value="{ROW.reference_no}" />
								</td>
							</tr>
							<tr class="required">
								<td style="width:200px">{LANG.attachment}</td>
								<td>
									 <div class="input-group">
									<input class="form-control" type="text" name="attachment" value="{ROW.attachment}" id="id_attachment" />
									<span class="input-group-btn">
										<button class="btn btn-default selectfile" type="button" >
										<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
									</button>
									</span>
									</div>
								</td>
							</tr>
							<tr>
								<td style="width:200px">{LANG.status}</td>
								<td>
									 <select class="form-control w300" name="status">
										<option value=""> --- </option>
										<!-- BEGIN: select_status -->
										<option value="{STATUS.key}" {STATUS.selected}>{STATUS.title}</option>
										<!-- END: select_status -->
									</select>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
				
				



 
    <div class="form-group">
        <label class="col-sm-5 col-md-24"><strong>{LANG.products}</strong> <span class="red">(*)</span></label>
        <div class="col-sm-19 col-md-24">
            <select class="form-control" name="products_id" id="products_id" >
				<option value="0"  selected="selected">{LANG.purchase_products_note}</option>
            </select>
        </div>
    </div>
	<div class="col-md-24">
		<div class="control-group table-group">
			<label class="table-label">{LANG.order_item}</label>

			<div class="controls table-controls">
				<table id="poTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
					<thead>
					<tr>
						<th>{LANG.product_name}</th>
						<th class="col-md-2">{LANG.product_expried}</th> 
						<th class="col-md-2">{LANG.cost}</th>
						<th class="col-md-2">{LANG.quantity}</th>
						<th class="col-md-2">{LANG.product_discount}</th>   
						<th class="col-md-2">{LANG.product_tax}</th>   
						<th class="col-md-4">{LANG.product_total} (<span class="currency">VND</span>)
						</th>
						<th style="width: 30px !important; text-align: center;"><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></th>
					</tr>
					</thead>
					<tbody class="ui-sortable">
						<!-- BEGIN: products -->
						<tr>
							<td> {product.title} ( {product.code} )
								<input type="hidden" name="product_id[]" value="{product.id}">
								<input type="hidden" name="product_code[]" value="{product.code}">
								<input type="hidden" name="product_name[]" value="{product.title}">
							</td>
							<td> <input type="text" name="product_expried[]" value=""></td>
							<td> {product.cost}
								<input type="hidden" name="product_net_cost[]" value="{product.cost}">
								<input type="hidden" name="product_unit_cost[]" value="{product.cost}">
								<input type="hidden" name="product_real_unit_cost[]" value="{product.cost}">
							</td>
							<td>
								<input type="text" name="product_base_quantity[]" value="{product.quantity}">
								<input type="hidden" name="product_unit[]" value="{product.purchase_unit}">
							</td>
							<td><input type="hidden" name="product_discount[]" value="{product.discount}"> {product.discount}</td>
							<td><input type="hidden" name="product_tax_rate[]" value="{product.tax_id}">
								<input type="hidden" name="product_tax[]" value="{product.tax }">
								<input type="hidden" name="product_cost_tax[]" value="{product.cost_tax}">
								( {product.tax}%) <br>  {product.cost_tax} 
							</td>
							<td>
								<input type="hidden" name="product_total[]" value=" {product.total}"> 
								{product.total}
							</td>
							<td> </td>
						</tr>
						<!-- END: products -->
					</tbody>
					<tfoot></tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="form-group">
		<input class="form-control" type="checkbox" name="advance_choose" value="1" /> {LANG.advance_choose}
	</div>
	<div class="col-md-24">
		<div class="form-group col-md-8">
			<label class="col-sm-24 col-md-24 "><strong>{LANG.order_tax_id}</strong></label>
			<div class="col-sm-24 col-md-22">
				<select class="form-control" name="order_tax_id">
					<option value=""> --- </option>
					<!-- BEGIN: select_order_tax_id -->
					<option value="{TAX_RATE.key}" {TAX_RATE.selected}>{TAX_RATE.title}</option>
					<!-- END: select_order_tax_id -->
				</select>
			</div>
		</div>
		<div class="form-group col-md-8">
			<label class="col-sm-24 col-md-24 "><strong>{LANG.order_discount_id}</strong></label>
			<div class="col-sm-24 col-md-24">
				<input class="form-control" type="text" name="order_discount_id" value="{ROW.order_discount_id}" />
			</div>
		</div>
		
		<div class="form-group col-md-8">
			<label class="col-sm-24 col-md-24 control-label"><strong>{LANG.shipping}</strong></label>
			<div class="col-sm-24 col-md-24">
				<input class="form-control" type="text" name="shipping" value="{ROW.shipping}" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-24 col-md-24 "><strong>{LANG.payment_term}</strong></label>
			<div class="col-sm-24 col-md-24">
				<input class="form-control" type="text" name="payment_term" value="{ROW.payment_term}"  />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-24 col-md-24 "><strong>{LANG.note}</strong></label>
			<div class="col-sm-24 col-md-24">
				{ROW.note}        
			</div>
		</div>
		
		

	 
		
	</div>
	<div style="display: none">
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
			<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.grand_total}</strong></label>
			<div class="col-sm-19 col-md-20">
				<input class="form-control" type="text" name="grand_total" value="{ROW.grand_total}" />
			</div>
		</div>
	</div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>

</div></div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
//<![CDATA[
    $("#date").datepicker({
        showOn : "both",
        dateFormat : "dd/mm/yy",
        changeMonth : true,
        changeYear : true,
        showOtherMonths : true,
        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
        buttonImageOnly : true
    });
    

//]]>
</script>

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
<!-- END: store -->
<!-- END: main -->