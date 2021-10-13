<!-- BEGIN: main -->
<h2 class="section_title">{BLOCK_TITLE}</h2>
<div class="section_content">
   <div class="row">
   <!-- BEGIN: loop -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-24 item">
         <div class="col-item">
            <div class="product-thumb">
               <a href="{link}" title="{title}" class="thumb">
               <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"  data-src="{src_img}" alt="{title}" />
               </a>
            </div>
            <div class="product-info">
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