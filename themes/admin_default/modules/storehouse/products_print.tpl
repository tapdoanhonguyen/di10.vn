<!-- BEGIN: main -->
<div class="box">
    <div class="box-header no-print">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>In mã vạch/nhãn</h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" onclick="window.print();return false;" id="print-icon" class="tip" title="" data-original-title="In">
                        <i class="icon fa fa-print"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-24">
                <p class="introtext no-print">Bạn có thể chọn bất kỳ loại để in các tấm mã vạch và điều này có thể được in với bất kỳ máy in laser để bàn.</p>

                <div class="well well-sm no-print">
                    <div class="form-group">
                        <label for="add_item">{LANG.product_add}</label>
                        <input type="text" name="add_item" value="" class="form-control ui-autocomplete-input" id="add_item" placeholder="{LANG.product_add}" autocomplete="off">
                    </div>
                    <form action="{ACTION}" id="barcode-print-form" data-toggle="validator" method="post" accept-charset="utf-8" novalidate="novalidate" class="bv-form">
                    	<button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
	                 	<input type="hidden" name="token" value="e6191062f55a018b6983abb344f383e2">
	                    <div class="controls table-controls">
	                        <table id="bcTable" class="table items table-striped table-bordered table-condensed table-hover">
	                            <thead>
	                            <tr>
	                                <th class="col-xs-4">{LANG.product_name}</th>
	                                <th class="col-xs-1">{LANG.quantity}</th>
	                                <th class="col-xs-7">{LANG.extention}</th>
	                                <th class="text-center" style="width:30px;">
	                                    <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
	                                </th>
	                            </tr>
	                            </thead>
	                            <tbody>
	                            	<!-- BEGIN: product -->
	                            	<tr id="row_4" class="row_{PRODUCT.id}" data-item-id="{PRODUCT.id}">
	                            		<td>
	                            			<input name="product[]" type="hidden" value="{PRODUCT.id}">
	                            			<span id="name_{PRODUCT.id}">{PRODUCT.name}</span>
	                            		</td>
	                            		<td>
	                            			<input class="form-control quantity text-center" name="quantity[]" type="text" value="{PRODUCT.quantity}" data-id="{PRODUCT.id}" data-item="{PRODUCT.id}" id="quantity_{PRODUCT.id}" onclick="this.select();">
	                            		</td>
	                            		<td>
	                            			
	                            		</td>
	                            		<td class="text-center">
	                            			<i class="fa fa-times tip del" id="{PRODUCT.id}" title="" style="cursor:pointer;" data-original-title="Remove"></i>
	                            			
	                            		</td>
	                            	</tr>
	                            	<!-- END: product -->
	                            </tbody>
	                        </table>
	                    </div>
	
	                    <div class="form-group">
	                        <label for="style">{LANG.print_config} *</label>     
	                        <select name="style" class="form-control tip" id="style" required="required" tabindex="-1" title=""  data-original-title="style" data-bv-field="style">
								<option value="">Chọn style</option>
								<option value="40" selected="selected">40 per sheet</option>
								<option value="30">30 {LANG.per_sheet}</option>
								<option value="24">24 {LANG.per_sheet}</option>
								<option value="20">20 {LANG.per_sheet}</option>
								<option value="18">18 {LANG.per_sheet}</option>
								<option value="14">14 {LANG.per_sheet}</option>
								<option value="12">12 {LANG.per_sheet}</option>
								<option value="10">10 {LANG.per_sheet}</option>
								<option value="50">continuous feed</option>
							</select>
	                     </div>
	                    <span class="help-block">{LANG.barecode_tip}</span>
	                    <div class="clearfix"></div>
	                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="style" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter/select a value</small>
	                    <div class="form-group">
	                        <span style="font-weight: bold; margin-right: 15px;">In:</span>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="site_name" type="checkbox" id="site_name" value="1" checked="checked" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="site_name" class="padding05">{SITE_NAME}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="product_name" type="checkbox" id="product_name" value="1" checked="checked" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="product_name" class="padding05">{LANG.product_name}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="price" type="checkbox" id="price" value="1" checked="checked" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="price" class="padding05">{LANG.price}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="currencies" type="checkbox" id="currencies" value="1" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="currencies" class="padding05">{LANG.monney}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="unit" type="checkbox" id="unit" value="1" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="unit" class="padding05">{LANG.unit}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="category" type="checkbox" id="category" value="1" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="category" class="padding05">{LANG.categories}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="variants" type="checkbox" id="variants" value="1" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="variants" class="padding05">{LANG.extention}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="product_image" type="checkbox" id="product_image" value="1" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="product_image" class="padding05">{LANG.images}</label>
	                        <div class="icheckbox_square-blue checked" aria-checked="false" aria-disabled="false" style="position: relative;"><input name="check_promo" type="checkbox" id="check_promo" value="1" checked="checked" ><ins class="iCheck-helper" ></ins></div>
	                        <label for="check_promo" class="padding05">{LANG.check_promo}</label>
	                    </div>
	
	                    <div class="form-group">
	                        <button type="button" id="reset" class="btn btn-danger">{LANG.update}</button>
	                        <button type="button" id="reset" class="btn btn-danger">Làm lại</button>
	                    </div>
	                </form>                    
	                <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: main -->