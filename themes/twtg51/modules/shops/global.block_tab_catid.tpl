<!-- BEGIN: main -->
<div class="bg">
   <h2 class="section_title">{BLOCK_TITLE}</h2>
   <div class="e-tabs not-dqtab ajax-tab-2" data-section="ajax-tab-2" data-view="grid_4">
      <div class="content">
         <span class="hidden-md hidden-lg button_show_tab">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </span>
         <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-24 col-xs-24">
               <ul class="tabs tabs-title tab-desktop ajax clearfix evo-close" style="margin-top:0px;font-weight:normal">
                  <!-- BEGIN: group_info -->
                  <li class="tab-link {BLOCK_INFO.active} has-content" data-tab="tab-{BLOCK_INFO.catid}">
                     <span title="{BLOCK_INFO.title}">
                     <img class="img-responsive lazyload" src="{BLOCK_INFO.image}" data-src="{BLOCK_INFO.image}" alt="{BLOCK_INFO.title}">
                     <span class="link_title">{BLOCK_INFO.title}</span></span>
                  </li>
                  <!-- END: group_info -->
               </ul>
            </div>
            <div class="col-lg-18 col-md-18 col-sm-24 col-xs-24">
			<!-- BEGIN: loop -->
               <div class="tab-{BLOCK_INFO.catid} tab-content {BLOCK_INFO.active}">
                  <div class="row">
				      <!-- BEGIN: loopcontent -->
                     <div class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="col-item">
						<!-- BEGIN: discounts -->
						<div class="sale-label sale-top-right"><span>- {PRICE.discount_percent}{PRICE.discount_unit}</span></div>
						<!-- END: discounts -->
                           <div class="product-thumb">
                              <a href="{LOOP.link}" title="{LOOP.title}" class="thumb">
                              <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"  data-src="{LOOP.homeimgthumb}" alt="{LOOP.title}" />
                              </a>
                              <div class="actions hidden-xs hidden-sm">
							     <!-- BEGIN: order -->
					                <a href="javascript:void(0)" id="{LOOP.id}" title="{LOOP.title}" onclick="cartorder(this, {GROUP_REQUIE}, '{LOOP.link}')">
                                    <button class="button btn-cart add_to_cart" data-toggle="tooltip" title="{LANG.add_product}">
                                    <span><i class="fa fa-shopping-cart">&nbsp;</i>{LANG.add_product}</span>
                                    </button>
									</a>
								<!-- END: order -->
                              </div>
                           </div>
                           <div class="product-info">
                              <h3 class="title"> <a href="{LOOP.link}" title="{LOOP.title}">{LOOP.title0}</a></h3>
                              <div class="content">
                                 <div class="item-price">
                                     <div class="price-box"> 
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
                                 </div>
                              </div>
                           </div>
                           <div class="thumbs-list">   
						      <!-- BEGIN: othersimg -->
						      <div class="thumbs-list-item active">
                                 <img class="lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{LOOP.homeimgthumb}" data-img="{LOOP.homeimgthumb}" alt="{ROW.title}" />
                              </div> 
							  <!-- BEGIN: img -->
							  <div class="thumbs-list-item">
                                 <img class="lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{IMG_THUMB}" data-img="{IMG_THUMB}" alt="{ROW.title}" />
                              </div>
							  <!-- END: img -->
							  <!-- END: othersimg -->
                           </div> 
                        </div>
                     </div>
					  <!-- END: loopcontent --> 
                  </div>
               </div>
			    <!-- END: loop -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- BEGIN: modal_loadedpk -->
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
<!-- END: modal_loadedpk -->
<div class="msgshow" id="msgshow">&nbsp;</div> 
<style type="text/css">
.tab-content{opacity:0;visibility:hidden;height:0;overflow:hidden}
</style> 
<!-- END: main -->