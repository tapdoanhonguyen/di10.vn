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
														<a rel="nofollow" href="/giohang.html" class="bieutuongdamua bieutuongdamua bieutuongdamua12">
															<i class="fal fa-2x fa-shopping-bag"></i>
															<span></span>
														</a>
													</div>
													<div class="gia">
														<span class="nhan">Giá: </span> 
														<strong>30.000</strong>
														<span>VND</span>
													</div>
													<div class="truong nutmuahang">
														<label class="nut_dat" onclick=" dathang(12);"><span>Mua hàng</span></label>
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


<!-- END: main -->


