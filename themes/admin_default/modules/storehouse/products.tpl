<!-- BEGIN: main -->
<script type="text/javascript" src="/assets/editors/ckeditor/ckeditor.js?t=1"></script>
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
	<div class="col-sm-24 col-md-24">
		<div class="form-group">
			<label class="col-sm-5 col-md-4 "><strong>{LANG.type}</strong> <span class="red">(*)</span></label>
			<div class="col-sm-19 col-md-20">
				<select class="form-control" name="type" id="type">
					<!-- BEGIN: select_type -->
					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
					<!-- END: select_type -->
				</select>
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs ext-detail-tabs" role="tablist">
		
	</ul>
	<div class="tab-content" >
		<div role="tabpanel" class="tab-pane active" id="type_standard">
			<div class="col-sm-19 col-md-12">
				
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.code}</strong> </label>
					<div class="col-sm-19 col-md-20 input-group">
						<input class="form-control" type="text" name="code" value="{ROW.code}"  />
						<!-- BEGIN: code -->
						<span class="input-group-addon pointer" id="random_num" style="padding: 1px 10px;">
                                <i class="fa fa-random"></i>
                            </span>
                        <!-- END: code -->
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.name}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="name" id="name" value="{ROW.name}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.alias}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="alias" id="alias" value="{ROW.alias}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<i class="fa fa-refresh fa-lg" onclick="get_alias('products', {row.id});">&nbsp;</i>
							</button>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.second_name}</strong></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="second_name" value="{ROW.second_name}" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.weight}</strong></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="weight" value="{ROW.weight}" />
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-5 col-md-24 "><strong>{LANG.barcode_symbology}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="barcode_symbology">
							<!-- BEGIN: select_barcode-->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_barcode -->
						</select>
					</div>
				</div>
				<div class="form-group" style="display:none">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.brand}</strong></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="brand">
							<option value=""> --- </option>
							<!-- BEGIN: select_brand -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_brand -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.image}</strong></label>
					<div class="col-sm-19 col-md-20">
						<div class="input-group">
						<input class="form-control" type="text" name="image" value="{ROW.image}" id="id_image" />
						<span class="input-group-btn">
							<button class="btn btn-default selectimage" type="button" >
							<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
						</button>
						</span>
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.file}</strong></label>
					<div class="col-sm-19 col-md-20">
						<div class="input-group">
						<input class="form-control" type="text" name="file" value="{ROW.file}" id="id_file" />
						<span class="input-group-btn">
							<button class="btn btn-default selectfile" type="button" >
							<em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
						</button>
						</span>
					</div>
					</div>
				</div>
				
				
				
			</div>
			<div class="col-sm-19 col-md-12">
				<div class="form-group" style="display:none">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.category_id}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<select multiple class="form-control category" name="category_id[]">
							<option value=""> --- </option>
							<!-- BEGIN: select_category_id -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_category_id -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.subsecondcategory_id}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<select  class="form-control secondcategory" name="second_category_id">
							<option value=""> --- </option>
							<!-- BEGIN: select_secondcategory_id -->
							<option value="{pcatid_i}" {pselect}>{ptitle_i}</option>
							<!-- END: select_secondcategory_id -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.cost}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="cost" value="{ROW.cost}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.price}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<input class="form-control" type="text" name="price" value="{ROW.price}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.tax_method}</strong></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="tax_method">
							<option value=""> --- </option>
							<!-- BEGIN: select_tax_method -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_tax_method -->
						</select>
					</div>
				</div>
				<div class="form-group" style="display:none">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.alert_quantity}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<div class="col-sm-19 col-md-18">
							<input class="form-control" type="text" name="alert_quantity" value="{ROW.alert_quantity}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
						</div>
						<div class="col-sm-19 col-md-6">
							<input class="form-control" type="checkbox" name="track_quantity" value="{ROW.track_quantity}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.unit}</strong><span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="unit" id="unit">
							<option value=""> --- </option>
							<!-- BEGIN: select_unit -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_unit -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.sale_unit}</strong></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="sale_unit" id="sale_unit">
							<option value=""> --- </option>
							<!-- BEGIN: select_sale_unit -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_sale_unit -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.purchase_unit}</strong></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="purchase_unit" id="purchase_unit">
							<option value=""> --- </option>
							<!-- BEGIN: select_purchase_unit -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_purchase_unit -->
						</select>
						
					</div>
				</div>
				<div class="form-group" style="display:none">
					<label class="col-sm-5 col-md-24 "><strong>{LANG.tax_rate}</strong></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="tax_rate">
							<option value=""> --- </option>
							<!-- BEGIN: select_tax_rate -->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_tax_rate -->
						</select>
					</div>
				</div>
				
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
		        <label class="col-sm-5 col-md-24 "><strong>{LANG.product_details}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-24">
					{ROW.product_details}        
				</div>
		    </div>
			<div class="clearfix"></div>
			<div class="form-group">
		        <label class="col-sm-5 col-md-24 "><strong>{LANG.details}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-24">
					{ROW.details}        
				</div>
		    </div>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="material">
			<div class="row">
			 	<div class="form-group">
                	<label class="col-md-24 ">{LANG.product_storehouse}</label>
                	<div class="col-md-24">
                		<table class="table table-striped table-bordered table-hover">
                			<thead>
                				<th class="col-md-1 "><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
                				<th class="col-md-5 ">{LANG.product_code}</th>
								<th class="col-md-6 ">{LANG.product_name}</th>
								<th class="col-md-6 ">{LANG.prounit}</th>
								<th class="col-md-6 ">{LANG.seller_num}</th>
                			</thead>
                			<tbody class="products">
                				<!-- BEGIN: products -->
                				<tr id="pro_sh_{product_stt}" >
                					<td>
                						<input type="checkbox" value = "{product_stt}" name="idcheck[]" class="checkib" />
                						
									</td>
									<td>
										<select class="form-control" name="products[]" id="products_id_{product_stt}" >
							            </select>
										<input type="hidden" name="products_id[]" class="form-control" id="pro_sh_id_{product_stt}" />
										<input type="hidden" name="products_code[]" class="form-control" id="pro_sh_code_{product_stt}" />
										<script type="text/javascript">$(document).ready(function() {product_select2("products_id_{product_stt}",{product_stt},{products_id}); $('#products_id_{product_stt}').prop('disabled', true); list_pro_id.push('{products_id}'); });</script>
									</td>
									<td>
										<div id="pro_sh_name_{product_stt}" > </div>
									</td>
									<td>
										<input type="hidden" name="products_unit[]" class="form-control" id="pro_sh_unit_{product_stt}" />
										<div id="pro_sh_unit_name_{product_stt}" > </div>
									</td>
									<td>
										<input type="text" name="number_product[]" class="form-control" value="{products_number}"/>
									</td>
								</tr>
								<!-- END: products -->
                			</tbody>
                			<tfoot>
                				<tr>
                					<td colspan="5">
                						<a href="#" class="btn btn-default btn-xs" onclick="add_line(); return false;" >
											<em class="fa fa-plus">&nbsp;</em> {LANG.add_line}
										</a>
										<a href="#" class="btn btn-default btn-xs" onclick="delete_line(this); return false;" >
											<em class="fa fa-minus">&nbsp;</em> {LANG.delete_line}
										</a >
                					</td>
                				</tr>
                			</tfoot>
						</table>	
						
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="combo">
			<div class="row">
			 	<div class="form-group">
                	<label class="col-md-24 ">{LANG.product_storehouse}</label>
                	<div class="col-md-24">
                		<table class="table table-striped table-bordered table-hover">
                			<thead>
                				<th class="col-md-1 "><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
                				<th class="col-md-5 ">{LANG.product_code}</th>
								<th class="col-md-6 ">{LANG.product_name}</th>
								<th class="col-md-6 ">{LANG.prounit}</th>
								<th class="col-md-6 ">{LANG.seller_num}</th>
                			</thead>
                			<tbody class="products_combo">
                				<!-- BEGIN: products_combo -->
                				<tr id="pro_sh_{product_stt}" >
                					<td>
                						<input type="checkbox" value = "{product_stt}" name="idcheck[]" class="checkib" />
                						
									</td>
									<td>
										<select class="form-control" name="" id="products_id_{product_stt}" >
							            </select>
										<input type="hidden" name="products[]" class="form-control" id="pro_sh_id_{product_stt}" />
										<input type="hidden" name="products_code[]" class="form-control" id="pro_sh_code_{product_stt}" />
										<!-- script type="text/javascript">$(document).ready(function() {product_select2_combo("products_id_{product_stt}",{product_stt},{products_id});});</script -->
									</td>
									<td>
										<div id="pro_sh_name_{product_stt}" > </div>
									</td>
									<td>
										<input type="hidden" name="products_unit[]" class="form-control" id="pro_sh_unit_{product_stt}" />
										<div id="pro_sh_unit_name_{product_stt}" > </div>
									</td>
									<td>
										<input type="text" name="number_product[]" class="form-control" value="{products_number}"/>
									</td>
								</tr>
								<!-- END: products_combo -->
                			</tbody>
                			<tfoot>
                				<tr>
                					<td colspan="5">
                						<a href="#" class="btn btn-default btn-xs" onclick="add_line_combo(); return false;" >
											<em class="fa fa-plus">&nbsp;</em> {LANG.add_line}
										</a>
										<a href="#" class="btn btn-default btn-xs" onclick="delete_line_combo(this); return false;" >
											<em class="fa fa-minus">&nbsp;</em> {LANG.delete_line}
										</a >
                					</td>
                				</tr>
                			</tfoot>
						</table>	
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div></div>

<!-- BEGIN:getalias -->
<script type="text/javascript">
	$("#name").change(function() {
		get_alias('products', {row.id});
	});
</script>
<!-- END:getalias -->
<script src="/assets/js/jquery/jquery.cookie.js"></script>
						
<script type="text/javascript">
$.cookie('products_material_total', '{products_material_total}' , { path: '/', expires: 1 });
//$('.products select').select2();


function formatRepo (repo) {
	if (repo.loading) return repo.text;
	return '<div id="pro_sh_id_option_' + repo.id + '" class="product_list_select" ><div class="col-md-8"> ' + '</div><div class="col-md-16">' + repo.name + '</div></div>';
}
function formatRepo_combo (repo) {
	if (repo.loading) return repo.text;
	return '<div id="pro_sh_id_option_' + repo.id + '" class="product_list_select" ><div class="col-md-8"> ' +  '</div><div class="col-md-16">' + repo.name + '</div></div>';
}

function formatRepoSelection (repo) {
		$('#pro_sh_name_'+repo.pro_sh_id).html('');
		$('#pro_sh_name_'+repo.pro_sh_id).append(repo.name);
		$('#pro_sh_unit_name_'+repo.pro_sh_id).html('');
		$('#pro_sh_unit_name_'+repo.pro_sh_id).append(repo.unit_name);
		$('#pro_sh_unit_'+repo.pro_sh_id).val(repo.unit_id);
		$('#pro_sh_code_'+repo.pro_sh_id).val(repo.title);
		$('#pro_sh_id_'+repo.pro_sh_id).val(repo.id);
	
	return repo.title;
}
function formatRepoSelection_combo (repo) {
		$('#pro_sh_name_'+repo.pro_sh_id).html('');
		$('#pro_sh_name_'+repo.pro_sh_id).append(repo.name);
		$('#pro_sh_unit_name_'+repo.pro_sh_id).html('');
		$('#pro_sh_unit_name_'+repo.pro_sh_id).append(repo.unit_name);
		$('#pro_sh_unit_'+repo.pro_sh_id).val(repo.unit_id);
		$('#pro_sh_code_'+repo.pro_sh_id).val(repo.title);
		$('#pro_sh_id_'+repo.pro_sh_id).val(repo.id);
	
	return repo.title;
}

function product_select2_combo(id,pro_sh_id,id_product_select){
	var selected = {id: id_product_select, name: id_product_select};
    $("#"+id).select2({
    	placeholder: "Test",
    	 searchInputPlaceholder: 'Please, select station',
        language: "vi",
        ajax: {
        	url: script_name + '?' + nv_name_variable + '=storehouse&' + nv_fc_variable + '=ajax',
            dataType: 'json',
            delay: 1,
            data: function (params) {
                  return {
                      q: params.term, // search term
					  mod: "products_material_list",
					  pro_sh_id: pro_sh_id,
					  id_product_select:id_product_select
                  };
              },
            processResults: function (data, params) {
                return {
                    results: data
                };
            },
        cache: true
        },
        initSelection: function(element, callback) {
        	console.log(id_product_select);
        	if(id_product_select>0){
        		console.log(id_product_select);
	        	$.ajax({
	        		type: "GET",
	        		url: script_name + '?' + nv_name_variable + '=storehouse&' + nv_fc_variable + '=ajax&mod=products_material_list&pro_sh_id=' + pro_sh_id + '&id_product_select=' + id_product_select,
	            	dataType: 'json',
	            	data: function (params) {
		                 return {
							 pro_sh_id: pro_sh_id,
							 id_product_select:id_product_select
		                 };
		             },
		            success: function (data, params) {
		            	var optionsd = data;
		            	console.log(data);
		   				for (var i = 0; i < data.length; i++) {
		   					if(optionsd[i].id == id_product_select){
		   						callback({id: optionsd[i].id, title: optionsd[i].title });
		   						$('#pro_sh_name_'+optionsd[i].pro_sh_id).html('');
								$('#pro_sh_name_'+optionsd[i].pro_sh_id).append(optionsd[i].name);
								$('#pro_sh_unit_name_'+optionsd[i].pro_sh_id).html('');
								$('#pro_sh_unit_name_'+optionsd[i].pro_sh_id).append(optionsd[i].unit_name);
								$('#pro_sh_unit_'+optionsd[i].pro_sh_id).val(optionsd[i].unit_id);
								$('#pro_sh_code_'+optionsd[i].pro_sh_id).val(optionsd[i].title);
								$('#pro_sh_id_'+optionsd[i].pro_sh_id).val(optionsd[i].id);
		   					}
		   						
						}
		            	
		            }
	        	});
	       }else{
	       		callback({id: 0, title: '' });
	       }
		},
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 0,
        templateResult: formatRepo_combo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection_combo // omitted for brevity, see the source of this page
 	});
 	
 	
}
</script>
<script type="text/javascript">
//<![CDATA[
    $(".selectfile").click(function() {
        var area = "id_file";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}/products";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}/products";
        var type = "file";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
    $(".category").select2({
		closeOnSelect:false,
		placeholder: '{LANG.search_service}'
	});
	$(".secondcategory").select2({
		placeholder: '{LANG.search_service}'
	});
	$(".selectimage").click(function() {
        var area = "id_image";
        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}/products";
        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}/products";
        var type = "image";
        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
        return false;
    });
	 $("#type").on('change', function () {
	 	var current = $("#type").val();
	 	//if(current === 'standard') $('#product_content').html($('#type_standard').html());
	 	//if(current === 'combo') $('#product_content').html($('#type_combo').html());
	 	if(current === 'material'){
	 		$('#type_standard').addClass( 'active' );
	 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li>');
	 	} 
	 	if(current === 'standard'){
	 		$('#material').removeClass( 'active' );
	 		$('#type_standard').addClass( 'active' );
	 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li><li role="presentation" ><a href="#material" aria-controls="material" role="tab" data-toggle="tab" aria-expanded="false">{LANG.material_option}</a></li>');
	 	} 
	 	if(current === 'combo'){
	 		$('#combo').removeClass( 'active' );
	 		$('#type_standard').addClass( 'active' );
	 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li><li role="presentation" ><a href="#combo" aria-controls="combo" role="tab" data-toggle="tab" aria-expanded="false">{LANG.combo}</a></li>');
	 	} 
	 	
	 });
	 $("#type").select2();
	 $('#random_num').click(function(){
        $(this).parent('.input-group').children('input').val('{PRODUCT_PREFIX}' + generateCardNo(9));
    });
	 window.onload = function(){
	 		var current = $("#type").val();
	 		if(current === 'material'){
		 		$('#type_standard').addClass( 'active' );
		 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li>');
		 	} 
		 	if(current === 'standard'){
		 		$('#material').removeClass( 'active' );
		 		$('#type_standard').addClass( 'active' );
		 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li><li role="presentation" ><a href="#material" aria-controls="material" role="tab" data-toggle="tab" aria-expanded="false">{LANG.material_option}</a></li>');
		 	} 
		 	if(current === 'combo'){
		 		$('#combo').removeClass( 'active' );
		 		$('#type_standard').addClass( 'active' );
		 		$('.nav-tabs').html('').append('<li role="presentation" class="active"><a href="#type_standard" aria-controls="type_standard" role="tab" data-toggle="tab" aria-expanded="true">{LANG.products_detail}</a></li><li role="presentation" ><a href="#combo" aria-controls="combo" role="tab" data-toggle="tab" aria-expanded="false">{LANG.combo}</a></li>');
		 	}
	 	};
//]]>
</script>
<!-- END: main -->