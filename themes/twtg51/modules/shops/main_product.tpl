<!-- BEGIN: main -->
<div id="products" class="clearfix">
    <!-- BEGIN: displays -->
    <div class="form-group form-inline pull-right">
        <label class="control-label">{LANG.displays_product}</label>
        <select name="sort" id="sort" class="form-control input-sm" onchange="nv_chang_price();">
            <!-- BEGIN: sorts -->
                <option value="{key}" {se}> {value}</option>
            <!-- END: sorts -->
        </select>
    </div>
    <div class="clearfix">&nbsp;</div>
    <!-- END: displays -->

    <!-- BEGIN: items -->
    <div class="col-xs-12 col-sm-12 col-md-{num}">
        <div class="thumbnail product-item">
            <div class="product-img" style="height: {height}px">
                <a href="{LINK}" title="{TITLE}"><img src="{IMG_SRC}" alt="{TITLE}" <!-- BEGIN: tooltip_js -->data-content='{hometext}' data-rel="tooltip" data-img="{IMG_SRC}"<!-- END: tooltip_js -->class="img-thumbnail" style="max-height:{height}px;max-width:{width}px;background-color: #fff;"></a>
            </div>
            <div class="info_pro">
            	<!-- BEGIN: new -->
            	<span class="label label-success newday">{LANG.newday}</span>
            	<!-- END: new -->
            	<!-- BEGIN: discounts -->
            	<span class="label label-danger">-{PRICE.discount_percent}{PRICE.discount_unit}</span>
            	<!-- END: discounts -->
            	<!-- BEGIN: point -->
            	<span class="label label-info" title="{point_note}">+{point}</span>
            	<!-- END: point -->
            	<!-- BEGIN: gift -->
            	<span class="label label-success">+<em class="fa fa-gift fa-lg">&nbsp;</em></span>
            	<!-- END: gift -->
            </div>
            <div class="caption text-center product-info" style="padding: 0px;margin-top: 15px;">
			    <div class="product-title">
                <a href="{LINK}" title="{TITLE}">{TITLE0}</a>
				</div>
                <!-- BEGIN: adminlink -->
                <p>{ADMINLINK}</p>
                <!-- END: adminlink -->

				<!-- BEGIN: price -->
				<p class="price">
                    <!-- BEGIN: discounts -->
                    <span class="money">{PRICE.sale_format} {PRICE.unit}</span>
                    <span class="discounts_money">{PRICE.price_format} {PRICE.unit}</span>
                    <!-- END: discounts -->

					<!-- BEGIN: no_discounts -->
					<span class="money">{PRICE.price_format} {PRICE.unit}</span>
					<!-- END: no_discounts -->
				</p>
				<!-- END: price -->

                <!-- BEGIN: contact -->
                <p class="price">{LANG.detail_pro_price}: <span class="money">{LANG.price_contact}</span></p>
                <!-- END: contact -->
            </div>
        </div>
    </div>
    <!-- END: items -->
</div>

<!-- BEGIN: modal_loaded -->
<div class="modal fade" id="idmodals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{LANG.add_product}</h4>
			</div>
			<div class="modal-body">
				<em class="fa fa-spinner fa-spin">&nbsp;</em>
			</div>
		</div>
	</div>
</div>
<!-- END: modal_loaded -->

<!-- BEGIN: pages -->
<div class="text-center">
    {generate_page}
</div>
<!-- END: pages -->
<div class="msgshow" id="msgshow">&nbsp;</div>

<!-- END: main -->
