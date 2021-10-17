<!-- BEGIN: main -->



			<script>
			function doi_trang_258(el) {    
			   jQuery(".bocuc_258 .tieude_tab span").removeClass("trang_hientai");
			   jQuery(el).addClass("trang_hientai");
			}
			
			function doi_trang_theo_id_258(i_id) {   
				jQuery(".bocuc_258 .tieude_tab span").removeClass("trang_hientai");
				 jQuery("#trang_so_"+i_id+"_258").addClass("trang_hientai");
			}
			
			</script>
			<div class="tieude_tab">
				<!-- BEGIN: loopcatid1 -->
					<span id="trang_so_{STT}_258" class{ACTIVE} onclick="doi_trang_258(this);swiper_258.slideTo({STT})">{data.title}</span>
				<!-- END: loopcatid1 -->
			</div>

			<div class="swiper-container swiper_258 ">
				<div class="swiper-wrapper">
					<!-- BEGIN: loopcatid -->
					<div class="swiper-slide bocuc bocuc_259 {ACTIVE1}" >
						<div class="loprong">
							<div class="padding ">
								<div class="sanpham_box">

									<ul>
										<!-- BEGIN: loop -->
											<li id="sp_259_1">
												<div class="div_noidung">
													<h2 class="truong tieude">
														<a title="" href="{link}">{title}</a>
													</h2>
													<div class="truong anh">
														<a title="{title}" href="{link}"><img alt="{title}" class="anh_sanpham_danhsach" src="{src_img}"></a>
		
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
					<!-- END: loopcatid -->
					
				 </div>
				 <div class="swiper-pagination swiper-pagination-white"></div>
				  
		   </div>
		 <script>
    var swiper_258 = new Swiper('.swiper_258',{simulateTouch: false,effect:"slide"}
);
  	
 swiper_258.on('TransitionStart', function (event, data)  {
doi_trang_theo_id_258(swiper_258.activeIndex);
});
   setTimeout(function(){swiper_258.init();	},500);
 </script>


<!-- END: main -->


