<!-- BEGIN: main -->


<div class="bocuc  bocuc_264  ">
	<div class="loprong">
		<div class="padding ">
			<p style="text-align: center;">{CAT.descriptionhtml}</p>
		</div>
	</div>
</div>
<div class="bocuc  bocuc_257  ">
	<div class="loprong">
		<div class="padding ">
			<div class="sanpham_box">

				<ul>
					<!-- BEGIN: loop -->
					<li id="sp_257_1">
						<div class="div_noidung">
							<h2 class="truong tieude">
								<a title="{title}" href="{link}">{title}</a>
							</h2>
							<div class="truong anh">
								<a title="{title}" href="{link}">
									<img alt="{title}" class="lazy anh_sanpham_danhsach" data-src="{src_img}" src="{src_img}">
								</a>
								<a rel="nofollow" href="/giohang.html" class="bieutuongdamua bieutuongdamua bieutuongdamua51"><i class="fal fa-2x fa-shopping-bag"></i><span></span></a>
							</div>
							<div class="gia">
								<!-- BEGIN: price -->
								<!-- BEGIN: discounts -->
								<strong class="special-price">{PRICE.sale_format} {PRICE.unit}</strong>
								<del class="light-font old-price">{PRICE.price_format} {PRICE.unit}</del> 
								<!-- END: discounts -->
								<!-- BEGIN: no_discounts -->
								<span class="special-price">{PRICE.price_format} {PRICE.unit}</span> 
								<!-- END: no_discounts -->
								<!-- END: price -->
								<!-- BEGIN: contact -->
								<span class="special-price">{LANG.price_contact}</span>
								<!-- END: contact -->
							</div>
							<div class="truong mota">
								{hometext}
							</div>
							<div class="truong nutmuahang">
								<!-- BEGIN: order -->
								<a href="javascript:void(0)" id="{id}" title="{title}" onclick="cartorder(this, {GROUP_REQUIE}, '{link}'); return !1;"><button type="button" class="btn btn-primary btn-xs"><span><i class="fa fa-shopping-cart">&nbsp;</i>{LANG.add_product}</button></a>
								<!-- END: order -->
								<!-- BEGIN: product_empty -->
								<button class="btn btn-danger disabled btn-xs">{LANG.product_empty}</button>
								<!-- END: product_empty -->
							</div>
						</div>
					</li>
					<!-- END: loop -->
				</ul>  

			</div>
		</div>
	</div>
</div>
 <script>
    var swiper_265 = new Swiper('.swiper_265',{simulateTouch: false,effect:"slide"}
);
  	
 swiper_265.on('TransitionStart', function (event, data)  {
doi_trang_theo_id_265(swiper_265.activeIndex);
});
   setTimeout(function(){swiper_265.init();	},500);
 </script>

<!-- END: main -->


