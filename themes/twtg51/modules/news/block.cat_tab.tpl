<!-- BEGIN: main -->
<div class="header">
	<span class="header_text">
		<div id="TrangTrai">
		</div>
	</span>
</div>
<div class="padding "> 

	 <style>
	.swiper_265{
		 width: 100%;
	  }
	</style>

	<script>
	function doi_trang_265(el) {    
	   jQuery(".bocuc_265 .tieude_tab span").removeClass("trang_hientai");
	   jQuery(el).addClass("trang_hientai");
	}
	
	function doi_trang_theo_id_265(i_id) {   
		jQuery(".bocuc_265 .tieude_tab span").removeClass("trang_hientai");
		 jQuery("#trang_so_"+i_id+"_265").addClass("trang_hientai");
	}
	
	</script>
	<div class="tieude_tab">
		<!-- BEGIN: loopcatid1 -->
		<span id="trang_so_{STT}_265" class{ACTIVE} onclick="doi_trang_265(this);swiper_265.slideTo({STT})">{data.title}</span>
		<!-- END: loopcatid1 -->
		
	</div>

	<div class="swiper-container swiper_265 swiper-container-horizontal">
		<div class="swiper-wrapper">
			<!-- BEGIN: loopcatid -->
			<div class="swiper-slide bocuc bocuc_27{STT} {ACTIVE1}" >
				<div class="loprong">
					<div class="header">
						<span class="header_text">{data1.title}</span>
					</div>
					<div class="padding ">
						<div class="bocuc  bocuc_271 ">
							<div class="loprong">
								<div class="padding ">
									<div class="col-sm-12">
										{data1.descriptionhtml}
									</div>
								</div>
							</div>
						</div>
						<div class="bocuc  bocuc_272 ">
							<div class="loprong">
								<div class="padding ">
									<span><img class="lazy  anh_1 " data-src="{data1.title}" alt="{data1.title}" src="{data1.image}"></span>
								</div>
							</div>
						</div>
						<div class="bocuc  bocuc_273 ">
							<div class="loprong">
								<div class="padding ">
									<div class="row">
										<div class="col-sm-24">
												
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END: loopcatid -->
		</div> 
		<div class="swiper-pagination swiper-pagination-white"></div>
		
	</div>
</div>








<!-- END: main -->



<ul class="nav nav-tabs">
<!-- BEGIN: loopcatid1 -->
<li class="{ACTIVE}"><a data-toggle="tab" href="#tab{STT}" title="{data.title}">{data.title}</a></li>
<!-- END: loopcatid1 -->
</ul>
<div class="tab-content">
<!-- BEGIN: loopcatid -->
<div id="tab{STT}" class="tab-pane fade {ACTIVE1}">
<div class="row">
<!-- BEGIN: loop -->
		<div class="col-xs-12 col-sm-12 col-md-6 text-center">
			<a href="{link}" title="{title}"><img src="{src_img}" alt="{title}" style="max-width:100%; max-height: 180px;"></a>
		<h3><a href="{link}" title="{title}">{title}</a></h3>
		</div>
<!-- END: loop -->
</div>
</div>
<!-- END: loopcatid -->
</div>