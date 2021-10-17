<!-- BEGIN: main -->
<div class="title-text text-center space-20">
                  <h2>{BLOCK_TITLE}</h2>
                  <p>{GIOITHIEU}</p>
               </div>
               <div id="carousel" class="slider-images hidden-1199">
			      <!-- BEGIN: loop -->
                  <picture>
                     <source media="(max-width: 480px)" srcset="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/loading.svg" data-lazyload3="{ROW.image}">
                     <img class="img-responsive basic center-block" data-src="{ROW.image}" alt="{ROW.description}" />
                  </picture>
                 <!-- END: loop -->
                  <a href="#" id="prev"><i class="fa fa-angle-left"></i></a>
                  <a href="#" id="next"><i class="fa fa-angle-right"></i></a>
               </div>
               <div class="show-1199 owl-carousel pb-50" data-dot="true" data-margin="15" data-lg-items="2" data-md-items="2" data-sm-items="2" data-xs-items="2" data-xxs-items="1">
                  <!-- BEGIN: item -->
				  <div class="item">
                     <picture>
                        <source media="(max-width: 480px)" srcset="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/loading.svg" data-lazyload3="{ROW.image}">
                        <img class="img-responsive basic center-block" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/loading.svg" data-src="{ROW.image}" alt="{ROW.description}" />
                     </picture>
                  </div>
                  <!-- END: item -->
               </div>
<!-- END: main -->