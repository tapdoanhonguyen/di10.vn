<!-- BEGIN: main -->

<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/default/css/bootstrap.min.css?t=1571128173">
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/css/font-awesome.min.css?t=1571128173">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/admin_default/css/style.css?t=1571128173">
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css?t=2">
<div class="message" style="display: none">

    </div>
<!-- BEGIN: store -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->

<div class="panel panel-default">
<div class="panel-body">

<div class="well well-sm">

                    <div class="col-xs-8 border-right">

                        <div class="col-xs-4"><i class="fa fa-3x fa-user padding010 text-muted"></i></div>
                        <div class="col-xs-20">
                            <h2 class="">{ROW.customer}</h2>
                            
                            {LANG.customer_address}<br>{ROW.customer_address}<p></p>{LANG.customer_phone}: {ROW.customer_phone}<br>{LANG.customer_email}: {ROW.customer_email}                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-xs-8 border-right">

                        <div class="col-xs-4"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                        <div class="col-xs-20">
                            <h2 class="">
                            	{ROW.admin_name}
                            	<br>
                            	({ROW.admin_username})
                            </h2>
                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-xs-8">
                        <div class="col-xs-4"><i class="fa fa-3x fa-building-o padding010 text-muted"></i></div>
                        <div class="col-xs-20">
                            <h2 class="">{ROW.shop_name}</h2>
                            {ROW.warehouse_name}
                            <p>{ROW.warehouse_address}</p><br>{LANG.shop_phone}: {ROW.shop_phone}<br>{LANG.shop_email}: {ROW.shop_email}                       </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-14 pull-right">
                    <div class="col-xs-24 text-right order_barcodes">
                        {ROW.barecode}
                        <img src="{ROW.qrcode}" alt="" class="qrimg">                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-10">
                    <div class="col-xs-4"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                    <div class="col-xs-20">
                        <h2 class="">{LANG.reference_no}: {ROW.reference_no}</h2>
                        
                        <p style="font-weight:bold;">{LANG.date}: {ROW.date}</p>

                        <p style="font-weight:bold;">{LANG.status}: {ROW.status}</p>

                        <p style="font-weight:bold;">{LANG.payment}: {ROW.payment}</p>

                        <p>&nbsp;</p>
                    </div>
                    <div class="clearfix"></div>
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
						
					</tr>
					</thead>
					<tbody class="ui-sortable products">
						<!-- BEGIN: products -->
						<tr id="pro_s_{product.i}">
							<td></td>
							<td>
								{product.code}-{product.title}
							</td>
							<td> 
								{product.expried}
								
							</td>
							<td> 
								{product.price}
							</td>
							<td>
								{product.quantity}
							</td>
							<td>{product.discount}</td>
							<td >
								( {product.tax}%) <br>  {product.cost_tax} 
							</td>
							<td>
								{product.total}
							</td>
						</tr>
						<!-- END: products -->
					</tbody>
					<tfoot>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.total_sales_temp}
        					</td>
        					<td colspan="1" >
        						{ROW.total_fomart}
        					</td>
        				</tr>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.voucher_total_fomart}
        					</td>
        					<td colspan="1" >
        						{ROW.voucher_total_fomart}
        					</td>
        				</tr>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.tax_total_fomart}
        					</td>
        					<td colspan="1" >
        						{ROW.tax_total_fomart}
        					</td>
        				</tr>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.shipping_sales_temp}
        					</td>
        					<td colspan="1" >
        						{ROW.shipping_fomart}
        					</td>
        				</tr>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.total_sales}
        					</td>
        					<td colspan="1" >
        						{ROW.grand_total_fomart}
        					</td>
        				</tr>
        				
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.paid_total_fomart}
        					</td>
        					<td colspan="1" >
        						{ROW.paid_total_fomart}
        					</td>
        				</tr>
        				<tr>
        					<td colspan="4">
        					</td>
        					<td colspan="1" >
        						
        					</td>
        					<td colspan="2">
        						{LANG.debt_total_fomart}
        					</td>
        					<td colspan="1" >
        						{ROW.debt_total_fomart}
        					</td>
        				</tr>
        			</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-24">
		<div class="form-group">
			<div class="col-sm-24 col-md-24">
				{ROW.note}        
			</div>
		</div>
		
		

	 
		
	</div>
    
</div></div>
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
					  projectid: {ROW.projectid}
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
		var pro_pc_total = $.cookie('products_sales_total');
		var total_sales=0;
		var quantity_sales=0;
		for(i=1;i<=pro_pc_total;i++){
			var price = $('#pro_pc_total_' + i).val();
			var quantity = $('#pro_pc_quantity_' + i).val();
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