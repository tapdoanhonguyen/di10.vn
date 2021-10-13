<!-- BEGIN: main -->
<h2 class="section_title">
{BLOCK_TITLE}
</h2>
<div class="section_content">
   <div class="slick_deal_hot">
   <!-- BEGIN: loop -->
      <div class="item">
         <div class="col-item">
		 <!-- BEGIN: discounts --><div class="sale-label sale-top-right"><span>-{PRICE.discount_percent}{PRICE.discount_unit}</span></div><!-- END: discounts -->
            <div class="product-thumb">
               <a href="{link}" title="{title}" class="thumb">
               <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{src_img}" alt="{title}" />
               </a>
               <div class="actions hidden-xs hidden-sm">
                  <a href="{link}" title="{title}">
                   <button class="button btn-cart add_to_cart" title="{LANG.add_product}"><span><i class="fa fa-cart-plus" aria-hidden="true"></i> {LANG.add_product}</span></button>
				   </a>
               </div>
            </div>
            <div class="clockdiv" data-countdown="{end_time}" style="display: block !important;"></div>
            <div class="product-info">
               <div class="product_type"></div>
               <h3 class="title"> <a href="{link}" title="{title}">{title}</a> </h3>
               <div class="content">
                  <div class="item-price">
                     <div class="price-box"> 
					          <!-- BEGIN: price -->
							  <!-- BEGIN: discounts -->
                              <span class="special-price">{PRICE.sale_format} {PRICE.unit}</span>
                              <span class="old-price"> {PRICE.price_format} {PRICE.unit}</span>
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
         </div>
      </div>
	  <!-- END: loop -->
   </div>
</div>
<!-- END: main -->
