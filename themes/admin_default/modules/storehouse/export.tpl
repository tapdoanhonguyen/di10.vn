<!-- BEGIN: main -->

<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>

<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<div class="message" style="display: none">

    </div>
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
<input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>

<!-- BEGIN: store -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->

<div class="panel panel-default">
<div class="panel-body">

    <input type="hidden" name="id" value="{ROW.id}" />
    <input type="hidden" name="status" value="4" />
   
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
								<td style="width:200px">{LANG.warehouse_id}</td>
								<td>
									<select class="form-control w300" name="warehouse_id" id="warehouse_id" >
									
									<!-- BEGIN: select_warehouse_id -->
										<option value="{WAREHOUSE.id}" {WAREHOUSE.selected}> {WAREHOUSE.name} </option>
									<!-- END: select_warehouse_id -->
									</select>
								</td>
							</tr>
							<tr class="required">
								<td style="width:200px">{LANG.customer_id} 
									<a href="/admin/index.php?nv=storehouse&op=ajax&mod=customer_add" id="add-customer" class="external" data-toggle="modal" data-target="#myModal2C">
										<i class="fa fa-plus-circle" id="addIcon" style="font-size: 1.5em;"></i>
									</a>
								</td>
								<td>
									 <select class="form-control" name="customer_id" id="customer_id">
										<option value=""> --- </option>
										<!-- BEGIN: select_customer_id -->
										<option value="{CUSTOMER.key}" {CUSTOMER.selected}>{CUSTOMER.title}</option>
										<!-- END: select_customer_id -->
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
							<!-- tr>
								<td style="width:200px">{LANG.status}</td>
								<td>
									 <select class="form-control w300" name="status">
										<option value=""> --- </option>
										<!-- BEGIN: select_status -->
										<!-- option value="{STATUS.key}" {STATUS.selected}>{STATUS.title}</option>
										<!-- END: select_status -->
									<!--/select>
								</td>  
							</tr -->  
							
						</tbody>
					</table>
				</div>
   
   
   

	<div class="col-md-24">
		<div class="control-group table-group">
			<label class="table-label">{LANG.order_item}</label>

			<div class="controls table-controls">
				<table id="poTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
					<thead>
					<tr>
						<th class="col-md-1"></th>
						<th>{LANG.product_name}</th>
						<th class="col-md-2">{LANG.product_expried}</th>
						<th class="col-md-2">{LANG.price}</th>
						<th class="col-md-2">{LANG.quantity}</th>
						<th class="col-md-2">{LANG.product_discount}</th>                                            
						<th class="col-md-2">{LANG.product_tax}</th>                                            
						<th class="col-md-2">{LANG.product_total} (<span class="currency">VND</span>)
						</th>
						<th style="width: 30px !important; text-align: center;"><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></th>
					</tr>
					</thead>
					<tbody class="ui-sortable products">
						<!-- BEGIN: products -->
						<tr id="pro_s_{product.i}">
							<td> <input type="checkbox" value = "{product.i}"  name="idcheck[]" class="checkib"/></td>
							<td> <select class="form-control" name="product[]" id="products_id_{product.i}" ></select>
								<input type="hidden" name="product_id[]" class="form-control" id="pro_sl_id_{product.i}" value ="{product.id}"/>
								<input type="hidden" name="product_code[]" value="{product.code}" id="pro_sl_name_{product.i}">
								<input type="hidden" name="product_name[]" value="{product.title}" id="pro_sl_code_{product.i}">
								<script type="text/javascript">$(document).ready(function() {product_sales_select("products_id_{product.i}",{product.i},{product.id}); $('#products_id_{product.i}').prop('disabled', true); list_pro_id.push('{product.id}'); });</script>
							</td>
							<td> 
								<input type="text" class="form-control" name="product_expried[]" value="{product.expried}" id="product_expried_{product.i}">
								<script type="text/javascript">$(document).ready(function() {$("#product_expried_{product.i}").datepicker({showOn : "both",dateFormat : "dd/mm/yy",changeMonth : true, changeYear : true,showOtherMonths : true,buttonImage : nv_base_siteurl + "assets/images/calendar.gif",buttonImageOnly : true}); });</script>
								
							</td>
							<td> 
								<input type="hidden" name="product_net_price[]" value="{product.price}" id="pro_sl_net_{product.i}">
								<input type="hidden" name="product_unit_price[]" value="{product.price}" id="pro_sl_price_{product.i}">
								<input type="text" class="form-control" name="product_real_unit_price[]" value="{product.price}" id="pro_sl_real_price_{product.i}">
								<script type="text/javascript">$("#pro_sl_real_price_{product.i}").on("change", function () {var quantity_input = $("#pro_sl_quantity_{product.i}").val(); var quantity = Number(quantity_input.replace(/,/gi, "")); var price_input = $("#pro_sl_real_price_{product.i}").val();  var price = Number(price_input.replace(/,/gi, "")); var total = price*quantity; $("#pro_sl_total_{product.i}").val(number_format(total,0,'.',',')); total_sale();}); </script>
							</td>
							<td>
								<input type="text" class="form-control" name="product_base_quantity[]" value="{product.quantity}" id="pro_sl_quantity_{product.i}">
								<input type="hidden" name="product_unit[]" value="{product.sale_unit}" id="pro_sl_unit_{product.i}">
								<script type="text/javascript">$("#pro_sl_quantity_{product.i}").on("change", function () {var quantity_input = $("#pro_sl_quantity_{product.i}").val(); var quantity = Number(quantity_input.replace(/,/gi, "")); var price_input = $("#pro_sl_real_price_{product.i}").val();  var price = Number(price_input.replace(/,/gi, "")); var total = price*quantity; $("#pro_sl_total_{product.i}").val(number_format(total,0,'.',',')); total_sale();}); </script>
							</td>
							<td><input type="hidden" name="product_discount[]" value="{product.discount}"> {product.discount}</td>
							<td class="form-control" ><input type="hidden" name="product_tax_rate[]" value="{product.tax_id}">
								<input type="hidden" name="product_tax[]" value="{product.tax }">
								<input type="hidden" name="product_cost_tax[]" value="{product.price_tax}">
								( {product.tax}%) <br>  {product.cost_tax} 
							</td>
							<td>
								<input type="text" class="form-control" name="product_total[]" id="pro_sl_total_{product.i}" value=" {product.total}"> 
							</td>
							<td> </td>
						</tr>
						<!-- END: products -->
					</tbody>
					<tfoot>
        				<tr>
        					<td colspan="4">
        						<a href="#" class="btn btn-default btn-xs" onclick="add_product_sales_line(); return false;" >
									<em class="fa fa-plus">&nbsp;</em> {LANG.add_line}
								</a>
								<a href="#" class="btn btn-default btn-xs" onclick="delete_product_sales_line(this); return false;" >
									<em class="fa fa-minus">&nbsp;</em> {LANG.delete_line}
								</a >
        					</td>
        					<td colspan="1" id="quantitySales">
        						
        					</td>
        					<td colspan="2">
        						{LANG.total_sales_temp}
        					</td>
        					<td colspan="2" id="totalSales">
        					</td>
        				</tr>
        			</tfoot>
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
				<input class="form-control" type="text" name="shipping" value="{ROW.shipping_fomart}" />
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
<script src="/assets/js/jquery/jquery.cookie.js"></script>
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
	$(document).ready(function () {
	    $('#add-customer').click(function(){
	    	var title = $(this).attr('data-title');
	    	$.ajax({
	    		url : script_name + '?language=vi&nv=storehouse&op=ajax&mod=customer_add'
	    	}).done(function(res){
	    		modalShow(title, res);
	    	})
	        
	        return false;
	    });
	});
</script>
<script type="text/javascript">
//<![CDATA[
	$.cookie('products_sales_total', '{products_sales_total}' , { path: '/', expires: 1 });
    $(".selectfile").click(function() {
        var area = "id_attachment";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
        var type = "image";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
	$("#customer_id").select2();
	$('#project_id').append('<option value="{ROW.projectid}" selected="selected">{ROW.project_title}</option>');
	$("#project_id").select2({
    	placeholder: "Test",
    	 searchInputPlaceholder: 'Chọn dự án',
        language: "vi",
        ajax: {
        	url: script_name + '?' + nv_name_variable + '=storehouse&' + nv_fc_variable + '=ajax',
			dataType: 'json',
			data: function (params) {
            	var customerid = $('#customer_id').val();
            	$('#project_id').html('');
            	if(customerid == '' || customerid == undefined) customerid = 0;
                  return {
                      q: params.term, // search term
					  mod: "products_project_list",
					  customerid: customerid,
					  projectid: {ROW.project_id}
                  }
			},
			processResults: function (data, params) {
                return { results: data };
			},
        	cache: false
        },
       
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 0,
        templateResult: formatProRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoProSelection // omitted for brevity, see the source of this page
 	});
	
	 <!-- BEGIN: project_value -->
        	
        	$('#project_id').val({ROW.projectid}).trigger('change');
        	$('#select2-project_id-container').append('{ROW.project_title}');
        	$('#select2-search__field').append('{ROW.project_title}');
        	total_sale();
		<!-- END: project_value -->
	function total_sale(){
		var pro_sl_total = $.cookie('products_sales_total');
		var total_sales=0;
		var quantity_sales=0;
		for(i=1;i<=pro_sl_total;i++){
			var price = $('#pro_sl_total_' + i).val();
			var quantity = $('#pro_sl_quantity_' + i).val();
			var subtotal =0;
			var subquantity =0;
			if(price !== undefined && price !== null) {
				subtotal = Number(price.replace(/,/gi, ""));
			}else{
				subtotal =0;
			}
			total_sales += subtotal;
			if(quantity !== undefined && quantity !== null) {
				subquantity = Number(quantity.replace(/,/gi, ""));
			}else{
				subquantity =0;
			}
			quantity_sales += subquantity;
		}
		$('#totalSales').html(number_format(total_sales, 0)); // Returns '1,234.57' );
		$('#quantitySales').html(number_format(quantity_sales, 0)); // Returns '1,234.57' );
		return true;
	}
//]]>
</script>
<!-- END: store -->
<!-- END: main -->
<!-- BEGIN: no_pos -->
	<!-- BEGIN: error -->
	<div class="alert alert-warning">{ERROR}</div>
	<!-- END: error -->
<!-- END: no_pos -->