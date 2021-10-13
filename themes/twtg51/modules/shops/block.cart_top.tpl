<!-- BEGIN: main -->
<!-- BEGIN: enable -->
<div class="drawer__header">
                  <div class="drawer__title h3"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:24px; color:#ff1255">&nbsp;</i></div>
                  <div class="drawer__close js-drawer-close">
                     <button type="button" class="icon-fallback-text">
                     <span class="icon icon-x" aria-hidden="true"></span>
                     <span class="fallback-text">"Close"</span>
                     </button>
                  </div>
</div>
	
<div class="ajaxcart__footer">
<div class="quickview-cart clearfix">
    <h3 style="background-color:#eee;margin-bottom:15px;padding: 10px 0 10px 5px">{LANG.cart_title}: {num} {LANG.cart_product_title}</h3>
	<div class="grid--full">
	    <!-- BEGIN: price -->
		<div class="grid__item two-thirds">
			<p>{LANG.cart_product_total}:</p>
		</div>
		<div class="grid__item one-third text-right">
			<p class="money">{total} {money_unit}</p>
		</div>
		<!-- END: price -->
	</div>
	<button type="submit" class="btn--secondary btn--full cart__checkout" name="checkout">
    <a title="{LANG.cart_check_out}" href="{LINK_VIEW}" id="submit_send" style="color:#fff">{LANG.cart_check_out}</a>
	</button>
	<!--  BEGIN: history -->
	<button type="submit" class="btn--secondary btn--full cart__checkout" name="checkout" style="margin-top:5px">
	<a href="{LINK_HIS}" style="color:#fff">{LANG.history_title}</a>
	</button>
	<!--  END: history -->
</div>
<!-- END: enable -->
<!-- BEGIN: disable -->
	<p>
		{LANG.active_order_dis}
	</p>
<!-- END: disable -->
</div>
<!-- END: main -->