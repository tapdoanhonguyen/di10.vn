<!-- BEGIN: main -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>POS Module | SHOP nv</title>
    <script type="text/javascript">if(parent.frames.length !== 0){top.location = '{MY_DOMAIN}';}</script>
    <base href="{MY_DOMAIN}"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link rel="shortcut icon" href="/themes/admin_default/js/storehouse/assets/images/icon.png"/>
    <link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/styles/theme.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/styles/style.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/pos/css/posajax.css" type="text/css"/>
    <link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/pos/css/print.css" type="text/css" media="print"/>
    <script type="text/javascript" src="/assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
	<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
    <!--[if lt IE 9]>
    <script src="/themes/admin_default/js/storehouse/assets/js/jquery.js"></script>
    <![endif]-->
    </head>
<body>
<noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                your browser to utilize the functionality of this website.</p>
        </div>
    </div>
</noscript>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery-migrate-3.0.0.min.js"></script>
<div id="wrapper">
	<div class="message" style="display: none">

    </div>
	<header id="header" class="navbar">
		<div class="container">
			<!-- BEGIN: select_store_id -->
			<div class="col-md-4 store" style="padding:3px 0px 0px 0px">
				
				<div class="col-sm-24 col-md-24">
					<select class="input-group" name="store_id" id="store_id">
						<option value="0"> --{LANG.store_main}-- </option>
						<!-- BEGIN: sloop -->
						<option value="{STORE.key}" {STORE.selected}>{STORE.title}</option>
						<!-- END: sloop -->
					</select>
				</div>
			</div>
			<!-- END: select_store_id -->
			
			<div class="header-nav">
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
							<img alt="" src="/themes/admin_default/js/storehouse/assets/images/male.png" class="mini_avatar img-rounded">
							<div class="user">
								<span>{LANG.wellcome} {SALES_NAME}</span>
							</div>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="{LINK_INFO_USER}">
								<i class="fa fa-user"></i> {LANG.info}                               </a>
							</li>
							<li>
								<a href="{LINK_USER_CHANG_PASS}">
								<i class="fa fa-key"></i> {LANG.changepass}                                </a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="/admin/index.php?nv=storehouse&op=pos#">
								<i class="fa fa-sign-out"></i> {LANG.logout}                                </a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav pull-right">

				
					
					
					<li class="dropdown">
						<a class="btn bblue pos-tip" title="{LANG.dashboard}" data-placement="bottom" href="/admin/index.php?nv=storehouse">
						<i class="fa fa-dashboard"></i>
						</a>
					</li>
					<li class="dropdown hidden-sm">
						<a class="btn pos-tip" title="{LANG.setting}" data-placement="bottom" href="/admin/index.php?nv=storehouse&op=config">
						<i class="fa fa-cogs"></i>
						</a>
					</li>
					<li class="dropdown hidden-xs">
						<a class="btn pos-tip" title="{LANG.caculator}" data-placement="bottom" href="/admin/index.php?nv=storehouse&op=pos#" data-toggle="dropdown">
						<i class="fa fa-calculator"></i>
						</a>
						<ul class="dropdown-menu pull-right calc">
							<li class="dropdown-content">
								<span id="inlineCalc"></span>
							</li>
						</ul>
					</li>
					<li class="dropdown hidden-sm">
						<a class="btn pos-tip" title="{LANG.shortcut}" data-placement="bottom" href="#" data-toggle="modal" data-target="#sckModal">
						<i class="fa fa-key"></i>
						</a>
					</li>
					<li class="dropdown">
						<a class="btn pos-tip" title="{LANG.view_bill}" data-placement="bottom" href="/admin/index.php?nv=storehouse&op=pos#" target="_blank">
						<i class="fa fa-laptop"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn blightOrange pos-tip" id="opened_bills" title="<span>{LANG.suppended_sales}</span>" data-placement="bottom" data-html="true" href="/admin/index.php?nv=storehouse&op=config" data-toggle="ajax">
						<i class="fa fa-th"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn bdarkGreen pos-tip" id="register_details" title="<span>{LANG.sales_pitch_detail}</span>" data-placement="bottom" data-html="true" href="/admin/index.php?nv=storehouse&op=config" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-check-circle"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn borange pos-tip" id="close_register" title="<span>{LANG.sales_pitch_close}</span>" data-placement="bottom" data-html="true" data-backdrop="static" href="/admin/index.php?nv=storehouse&op=config" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-times-circle"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn borange pos-tip" id="add_expense" title="<span>{LANG.add_expense}</span>" data-placement="bottom" data-html="true" href="/admin/index.php?nv=storehouse&op=config" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-dollar"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn bdarkGreen pos-tip" id="today_profit" title="<span>{LANG.today_profit}</span>" data-placement="bottom" data-html="true" href="/admin/index.php?nv=storehouse&op=config" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-hourglass-half"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn bdarkGreen pos-tip" id="today_sale" title="<span>{LANG.today_sales}</span>" data-placement="bottom" data-html="true" href="/admin/index.php?nv=storehouse&op=config" data-toggle="modal" data-target="#myModal">
						<i class="fa fa-heart"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn bblue pos-tip" title="{LANG.list_pitch}" data-placement="bottom" href="/admin/index.php?nv=storehouse&op=config">
						<i class="fa fa-list"></i>
						</a>
					</li>
					<li class="dropdown" style="display:none">
						<a class="btn bred pos-tip" title="{LANG.delete_data_saved}" data-placement="bottom" id="clearLS" href="#">
						<i class="fa fa-eraser"></i>
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a class="btn bblack" style="cursor: default;"><span id="display_time"></span></a>
					</li>
				</ul>
			</div>
		</div>
	</header>
	<div id="content">
		<div class="c1">
			<div class="pos">
				<div id="pos">
					
					<div id="cp">
						<div id="cpinner" class="col-md-8">
							<div class="quick-menu">
								<div id="proContainer">
									<div id="ajaxproducts">
										<div id="item-list">
											<div>
												<!-- BEGIN: products -->
												<button id="product-0104" type="button" value='{PRODUCT.code}' title="{PRODUCT.name}" class="btn-prni btn-default product pos-tip" data-container="body">
													<img src="{PRODUCT.image}" alt="{PRODUCT.name}" class='img-rounded' />
													<span>{PRODUCT.name}</span>
												</button>
												<!-- END: products -->
											</div>
										</div>
										<div class="btn-group btn-group-justified pos-grid-nav">
											<div class="btn-group">
												<button style="z-index:10002;" class="btn btn-primary pos-tip" title="Previous" type="button" id="previous">
												<i class="fa fa-chevron-left"></i>
												</button>
											</div>
											<div class="btn-group">
												<button style="z-index:10003;" class="btn btn-primary pos-tip" type="button" id="sellGiftCard" title="{LANG.create_gift_card} ">
												<i class="fa fa-credit-card" id="addIcon"></i> {LANG.create_gift_card}                                               </button>
											</div>
											<div class="btn-group">
												<button style="z-index:10004;" class="btn btn-primary pos-tip" title="Next" type="button" id="next">
												<i class="fa fa-chevron-right"></i>
												</button>
											</div>
										</div>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
						</div>
						<form action="/admin/index.php?language=vi&nv=storehouse&op=pos" data-toggle="validator" role="form" id="pos-sale-form" method="post" accept-charset="utf-8" class="col-md-4">
							<input type="hidden" name="token" value="5e59302fb93f9badfe8e269fd1cd67a9" />
							<div id="leftdiv">
								<div id="printhead">
									<h4 style="text-transform:uppercase;">{SHOP_TITLE}</h4>
									<h5 style="text-transform:uppercase;">{LANG.order_list}</h5>
									{LAN.date} {NOW}                       
								</div>
								<div id="left-top">
									
									<div
										style="position: absolute; left:-9999px;"><input type="text" name="test" value=""  id="test" class="kb-pad" /></div>
									<div class="form-group">
										<div class="input-group">
											<input type="text" name="customer" value=""  id="poscustomer" data-placeholder="Chọn Khách hàng" required="required" class="form-control pos-input-tip" style="width:100%;" />
											<div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
												<a href="#" id="toogle-customer-read-attr" class="external">
												<i class="fa fa-pencil" id="addIcon" style="font-size: 1.2em;"></i>
												</a>
											</div>
											<div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
												<a href="#" id="view-customer" class="external" data-toggle="modal" data-target="#myModalC">
												<i class="fa fa-eye" id="addIcon" style="font-size: 1.2em;"></i>
												</a>
											</div>
											<div class="input-group-addon no-print" style="padding: 2px 8px;">
												<a href="/admin/index.php?nv=storehouse&op=ajax&mod=customer_add" id="add-customer" class="external" data-toggle="modal" data-target="#myModal2C">
												<i class="fa fa-plus-circle" id="addIcon" style="font-size: 1.5em;"></i>
												</a>
											</div>
										</div>
										<div style="clear:both;"></div>
									</div>
									<div class="no-print">
										<div class="form-group">
											<select name="warehouse" id="poswarehouse" class="form-control pos-input-tip" data-placeholder="Chọn Kho hàng" required="required" style="width:100%;" id="warehouse_id">
												<option value=""></option>
												<!-- BEGIN: select_warehouse_id -->
												<option value="{WAREHOUSE.key}" >{WAREHOUSE.title}</option>
												<!-- END: select_warehouse_id -->
											</select>
										</div>
										<div class="form-group" id="ui">
											<div class="input-group">
												<input type="text" name="add_item" value=""  class="form-control pos-tip" id="add_item" data-placement="top" data-trigger="focus" placeholder="{LANG.find_product_by_name_code}" title="{LANG.find_product_by_name_code_note}" />
												<div class="input-group-addon" style="padding: 2px 8px;">
													<a href="#" id="addManually">
													<i class="fa fa-plus-circle" id="addIcon" style="font-size: 1.5em;"></i>
													</a>
												</div>
											</div>
											<div style="clear:both;"></div>
										</div>
									</div>
								</div>
								<div id="print">
									<div id="left-middle">
										<div id="product-list">
											<table class="table items table-striped table-bordered table-condensed table-hover sortable_table"
												id="posTable" style="margin-bottom: 0;">
												<thead>
													<tr>
														<th width="40%">{LANG.product_name}</th>
														<th width="15%">{LANG.price}</th>
														<th width="15%">{LANG.quantity}</th>
														<th width="20%">{LANG.total}</th>
														<th style="width: 5%; text-align: center;">
															<i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
														</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
											<div style="clear:both;"></div>
										</div>
									</div>
									<div style="clear:both;"></div>
									<div id="left-bottom">
										<table id="totalTable"
											style="width:100%; float:right; padding:5px; color:#000; background: #FFF;">
											<tr>
												<td style="padding: 5px 10px;border-top: 1px solid #DDD;">{LANG.total_items}</td>
												<td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
													<span id="titems">0</span>
												</td>
												<td style="padding: 5px 10px;border-top: 1px solid #DDD;">{LANG.total}</td>
												<td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
													<span id="total">0.00</span>
												</td>
											</tr>
											<tr>
												<td style="padding: 5px 10px;">{LANG.tax_order}                                        <a href="#" id="pptax2">
													<i class="fa fa-edit"></i>
													</a>
												</td>
												<td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;">
													<span id="ttax2">0.00</span>
												</td>
												<td style="padding: 5px 10px;">{LANG.product_discount}                                                                                       <a href="#" id="ppdiscount">
													<i class="fa fa-edit"></i>
													</a>
												</td>
												<td class="text-right" style="padding: 5px 10px;font-weight:bold;">
													<span id="tds">0.00</span>
												</td>
											</tr>
											<tr>
												<td style="padding: 5px 10px; border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
													{LANG.shipping}                                          <a href="#" id="pshipping">
													<i class="fa fa-plus-square"></i>
													</a>
													<span id="tship"></span>
												</td>
												<td class="text-right" style="padding:5px 10px 5px 10px; font-size: 14px;border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;" colspan="2">
													<span id="gtotal">0.00</span>
												</td>
											</tr>
										</table>
										<div class="clearfix"></div>
										<div id="botbuttons" class="col-xs-12 text-center">
											<input type="hidden" name="biller" id="biller" value="{userid}"/>
											<div class="row">
												<div class="col-xs-4" style="padding: 0;">
													<div class="btn-group-vertical btn-block">
														<button type="button" class="btn btn-warning btn-block btn-flat"
															id="suspend">
														{LANG.suppended_sales}                                                </button>
														<button type="button" class="btn btn-danger btn-block btn-flat"
															id="reset">
														{LANG.cancel}                                                </button>
													</div>
												</div>
												<div class="col-xs-4" style="padding: 0;">
													<div class="btn-group-vertical btn-block">
														<button type="button" class="btn btn-info btn-block" id="print_order">
														{LANG.print_order}                                                </button>
														<button type="button" class="btn btn-primary btn-block" id="print_bill">
														{LANG.print_bill}                                                </button>
													</div>
												</div>
												<div class="col-xs-4" style="padding: 0;">
													<button type="button" class="btn btn-success btn-block" id="payment" style="height:67px;">
													<i class="fa fa-money" style="margin-right: 5px;"></i>{LANG.payment}                                          </button>
												</div>
											</div>
										</div>
										<div style="clear:both; height:5px;"></div>
										<div id="num">
											<div id="icon"></div>
										</div>
										<span id="hidesuspend"></span>
										<input type="hidden" name="pos_note" value="" id="pos_note">
										<input type="hidden" name="staff_note" value="" id="staff_note">
										<div id="payment-con">
											<input type="hidden" name="amount[]" id="amount_val_1" value=""/>
											<input type="hidden" name="balance_amount[]" id="balance_amount_1" value=""/>
											<input type="hidden" name="paid_by[]" id="paid_by_val_1" value="cash"/>
											<input type="hidden" name="cc_no[]" id="cc_no_val_1" value=""/>
											<input type="hidden" name="paying_gift_card_no[]" id="paying_gift_card_no_val_1" value=""/>
											<input type="hidden" name="cc_holder[]" id="cc_holder_val_1" value=""/>
											<input type="hidden" name="cheque_no[]" id="cheque_no_val_1" value=""/>
											<input type="hidden" name="cc_month[]" id="cc_month_val_1" value=""/>
											<input type="hidden" name="cc_year[]" id="cc_year_val_1" value=""/>
											<input type="hidden" name="cc_type[]" id="cc_type_val_1" value=""/>
											<input type="hidden" name="cc_cvv2[]" id="cc_cvv2_val_1" value=""/>
											<input type="hidden" name="payment_note[]" id="payment_note_val_1" value=""/>
											<input type="hidden" name="amount[]" id="amount_val_2" value=""/>
											<input type="hidden" name="balance_amount[]" id="balance_amount_2" value=""/>
											<input type="hidden" name="paid_by[]" id="paid_by_val_2" value="cash"/>
											<input type="hidden" name="cc_no[]" id="cc_no_val_2" value=""/>
											<input type="hidden" name="paying_gift_card_no[]" id="paying_gift_card_no_val_2" value=""/>
											<input type="hidden" name="cc_holder[]" id="cc_holder_val_2" value=""/>
											<input type="hidden" name="cheque_no[]" id="cheque_no_val_2" value=""/>
											<input type="hidden" name="cc_month[]" id="cc_month_val_2" value=""/>
											<input type="hidden" name="cc_year[]" id="cc_year_val_2" value=""/>
											<input type="hidden" name="cc_type[]" id="cc_type_val_2" value=""/>
											<input type="hidden" name="cc_cvv2[]" id="cc_cvv2_val_2" value=""/>
											<input type="hidden" name="payment_note[]" id="payment_note_val_2" value=""/>
											<input type="hidden" name="amount[]" id="amount_val_3" value=""/>
											<input type="hidden" name="balance_amount[]" id="balance_amount_3" value=""/>
											<input type="hidden" name="paid_by[]" id="paid_by_val_3" value="cash"/>
											<input type="hidden" name="cc_no[]" id="cc_no_val_3" value=""/>
											<input type="hidden" name="paying_gift_card_no[]" id="paying_gift_card_no_val_3" value=""/>
											<input type="hidden" name="cc_holder[]" id="cc_holder_val_3" value=""/>
											<input type="hidden" name="cheque_no[]" id="cheque_no_val_3" value=""/>
											<input type="hidden" name="cc_month[]" id="cc_month_val_3" value=""/>
											<input type="hidden" name="cc_year[]" id="cc_year_val_3" value=""/>
											<input type="hidden" name="cc_type[]" id="cc_type_val_3" value=""/>
											<input type="hidden" name="cc_cvv2[]" id="cc_cvv2_val_3" value=""/>
											<input type="hidden" name="payment_note[]" id="payment_note_val_3" value=""/>
											<input type="hidden" name="amount[]" id="amount_val_4" value=""/>
											<input type="hidden" name="balance_amount[]" id="balance_amount_4" value=""/>
											<input type="hidden" name="paid_by[]" id="paid_by_val_4" value="cash"/>
											<input type="hidden" name="cc_no[]" id="cc_no_val_4" value=""/>
											<input type="hidden" name="paying_gift_card_no[]" id="paying_gift_card_no_val_4" value=""/>
											<input type="hidden" name="cc_holder[]" id="cc_holder_val_4" value=""/>
											<input type="hidden" name="cheque_no[]" id="cheque_no_val_4" value=""/>
											<input type="hidden" name="cc_month[]" id="cc_month_val_4" value=""/>
											<input type="hidden" name="cc_year[]" id="cc_year_val_4" value=""/>
											<input type="hidden" name="cc_type[]" id="cc_type_val_4" value=""/>
											<input type="hidden" name="cc_cvv2[]" id="cc_cvv2_val_4" value=""/>
											<input type="hidden" name="payment_note[]" id="payment_note_val_4" value=""/>
											<input type="hidden" name="amount[]" id="amount_val_5" value=""/>
											<input type="hidden" name="balance_amount[]" id="balance_amount_5" value=""/>
											<input type="hidden" name="paid_by[]" id="paid_by_val_5" value="cash"/>
											<input type="hidden" name="cc_no[]" id="cc_no_val_5" value=""/>
											<input type="hidden" name="paying_gift_card_no[]" id="paying_gift_card_no_val_5" value=""/>
											<input type="hidden" name="cc_holder[]" id="cc_holder_val_5" value=""/>
											<input type="hidden" name="cheque_no[]" id="cheque_no_val_5" value=""/>
											<input type="hidden" name="cc_month[]" id="cc_month_val_5" value=""/>
											<input type="hidden" name="cc_year[]" id="cc_year_val_5" value=""/>
											<input type="hidden" name="cc_type[]" id="cc_type_val_5" value=""/>
											<input type="hidden" name="cc_cvv2[]" id="cc_cvv2_val_5" value=""/>
											<input type="hidden" name="payment_note[]" id="payment_note_val_5" value=""/>
										</div>
										<input name="order_tax" type="hidden" value="1" id="postax2">
										<input name="discount" type="hidden" value="" id="posdiscount">
										<input name="shipping" type="hidden" value="0" id="posshipping">
										<input type="hidden" name="rpaidby" id="rpaidby" value="cash" style="display: none;"/>
										<input type="hidden" name="total_items" id="total_items" value="0" style="display: none;"/>
										<input type="submit" id="submit_sale" value="Submit Sale" style="display: none;"/>
									</div>
								</div>
							</div>
						</form>
						<div style="clear:both;"></div>
					</div>
					
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	</div>
</div>
<div class="rotate btn-cat-con" >
	<button type="button" id="open-category" class="btn btn-primary open-category">{LANG.cat}</button>
</div>
<div id="category-slider">
	<button type="button" class="close open-category"><i class="fa fa-2x">&times;</i></button>
	<div id="category-list">
		
		<!-- BEGIN: cat -->
		<button id="category-{CAT.no}" type="button" value='{CAT.id}' class="btn-prni category" ><img src="{CAT.image}" class='img-rounded img-thumbnail' /><span>{CAT.name}</span></button>    
   		<!-- END: cat -->
	</div>
</div>

<div class="modal fade in" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
					class="fa fa-2x">&times;</i></span><span class="sr-only">{LANG.close}</span></button>
				<h4 class="modal-title" id="payModalLabel">{LANG.finalize_sale}</h4>
			</div>
			<div class="modal-body" id="payment_content">
				<div class="row">
					<div class="col-md-10 col-sm-9">
						<div class="form-group">
							<label for="biller">{LANG.sales_name}</label>                                
							<select name="biller" class="form-control" id="posbiller" required="required">
								<option value="3" selected="selected">{SALES_NAME}</option>
							</select>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<textarea name="sale_note" cols="40" rows="10"  id="sale_note" class="form-control kb-text skip" style="height: 100px;" placeholder="{LANG.sale_note}" maxlength="250"></textarea>
								</div>
								<div class="col-sm-6">
									<textarea name="staffnote" cols="40" rows="10"  id="staffnote" class="form-control kb-text skip" style="height: 100px;" placeholder="{LANG.staff_note}" maxlength="250"></textarea>
								</div>
							</div>
						</div>
						<div class="clearfir"></div>
						<div id="payments">
							<div class="well well-sm well_1">
								<div class="payment">
									<div class="row">
										<div class="col-sm-5">
											<div class="form-group">
												<label for="amount_1">{LANG.money_payment}</label>                                                <input name="amount[]" type="text" id="amount_1"
													class="pa form-control kb-pad1 amount"/>
											</div>
										</div>
										<div class="col-sm-5 col-sm-offset-1">
											<div class="form-group">
												<label for="paid_by_1">{LANG.paying_by}</label>                                                
												<select name="paid_by[]" id="paid_by_1" class="form-control paid_by">
													<option value="cash">{LANG.cash}</option>
													<option value="gift_card">{LANG.coupon}</option>
													<option value="CC">{LANG.card}</option>
													<option value="other">{LANG.other}</option>
													<option value="deposit">{LANG.deposit}</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-11">
											<div class="form-group gc_1" style="display: none;">
												<label for="gift_card_no_1">{LANG.gift_card_no}</label>                                                <input name="paying_gift_card_no[]" type="text" id="gift_card_no_1"
													class="pa form-control kb-pad gift_card_no"/>
												<div id="gc_details_1"></div>
											</div>
											<div class="pcc_1" style="display:none;">
												<div class="form-group">
													<input type="text" id="swipe_1" class="form-control swipe"
														placeholder="{LANG.swipe}"/>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<input name="cc_no[]" type="text" id="pcc_no_1"
																class="form-control"
																placeholder="{LANG.cc_no}"/>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<input name="cc_holer[]" type="text" id="pcc_holder_1"
																class="form-control"
																placeholder="{LANG.cc_holer}"/>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<select name="cc_type[]" id="pcc_type_1"
																class="form-control pcc_type"
																placeholder="{LANG.card_type}">
																<option value="Visa">{LANG.visa}</option>
																<option
																	value="MasterCard">{LANG.mastercard}</option>
																<option value="Amex">{LANG.amex}</option>
																<option
																	value="Discover">{LANG.discover}</option>
																<option
																	value="ATM">{LANG.atm}</option>
															</select>
															<!-- <input type="text" id="pcc_type_1" class="form-control" placeholder="Card Type" />-->
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input name="cc_month[]" type="text" id="pcc_month_1"
																class="form-control"
																placeholder="{LANG.cc_month}"/>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input name="cc_year" type="text" id="pcc_year_1"
																class="form-control"
																placeholder="{LANG.cc_year}"/>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input name="cc_cvv2" type="text" id="pcc_cvv2_1"
																class="form-control"
																placeholder="{LANG.cc_sec_code}"/>
														</div>
													</div>
												</div>
											</div>
											<div class="pcheque_1" style="display:none;">
												<div class="form-group"><label for="cheque_no_1">Cheque No</label>                                                    <input name="cheque_no[]" type="text" id="cheque_no_1"
													class="form-control cheque_no"/>
												</div>
											</div>
											<div class="form-group">
												<label for="payment_note">{LANG.payment_note}</label>                                                <textarea name="payment_note[]" id="payment_note_1"
													class="pa form-control kb-text payment_note"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="multi-payment"></div>
						<button type="button" class="btn btn-primary col-md-12 addButton"><i
							class="fa fa-plus"></i> {LANG.add_payment_type}</button>
						<div style="clear:both; height:15px;"></div>
						<div class="font16">
							<table class="table table-bordered table-condensed table-striped" style="margin-bottom: 0;">
								<tbody>
									<tr>
										<td width="25%">{LANG.total_products}</td>
										<td width="25%" class="text-right"><span id="item_count">0.00</span></td>
										<td width="25%">{LANG.total_cus_pay}</td>
										<td width="25%" class="text-right"><span id="twt">0.00</span></td>
									</tr>
									<tr>
										<td>{LANG.total_payment}</td>
										<td class="text-right"><span id="total_paying">0.00</span></td>
										<td>{LANG.balance}</td>
										<td class="text-right"><span id="balance">0.00</span></td>
									</tr>
								</tbody>
							</table>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 text-center">
						<span style="font-size: 1.2em; font-weight: bold;">{LANG.quick_cash}</span>
						<div class="btn-group btn-group-vertical">
							<button type="button" class="btn btn-lg btn-info quick-cash" id="quick-payable">0.00
							</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">1,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">2,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">5,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">10,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">20,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">50,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">100,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">200,000</button>
							<button type="button" class="btn btn-lg btn-warning quick-cash">500,000</button> 
							 
							<button type="button" class="btn btn-lg btn-danger"
								id="clear-cash-notes">{LANG.delete}</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-block btn-lg btn-primary" id="submit-sale">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="cmModal" tabindex="-1" role="dialog" aria-labelledby="cmModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				<i class="fa fa-2x">&times;</i></span>
				<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="cmModalLabel"></h4>
			</div>
			<div class="modal-body" id="pr_popover_content">
				<div class="form-group">
					<label for="icomment">comment</label>                    <textarea name="comment" cols="40" rows="10"  class="form-control" id="icomment" style="height:80px;"></textarea>
				</div>
				<div class="form-group">
					<label for="iordered">Đã đặt hàng</label>                                        
					<select name="ordered" class="form-control" id="iordered" style="width:100%;">
						<option value="0">Không</option>
						<option value="1">Yes</option>
					</select>
				</div>
				<input type="hidden" id="irow_id" value=""/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="editComment">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
					class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="prModalLabel"></h4>
			</div>
			<div class="modal-body" id="pr_popover_content">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-sm-4 control-label">Thuế sản phẩm</label>
						<div class="col-sm-8">
							<select name="ptax" id="ptax" class="form-control pos-input-tip" style="width:100%;">
								<option value="" selected="selected"></option>
								<option value="1">No Tax</option>
								<option value="2">VAT @10%</option>
								<option value="3">GST @6%</option>
								<option value="4">VAT @20%</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="pserial" class="col-sm-4 control-label">Serial No</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-text" id="pserial">
						</div>
					</div>
					<div class="form-group">
						<label for="pquantity" class="col-sm-4 control-label">Số lượng</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="pquantity">
						</div>
					</div>
					<div class="form-group">
						<label for="punit" class="col-sm-4 control-label">Đơn vị SP</label>
						<div class="col-sm-8">
							<div id="punits-div"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="poption" class="col-sm-4 control-label">Product Option</label>
						<div class="col-sm-8">
							<div id="poptions-div"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="pdiscount" class="col-sm-4 control-label">Product Discount</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="pdiscount">
						</div>
					</div>
					<div class="form-group">
						<label for="pprice" class="col-sm-4 control-label">Đơn giá</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="pprice" >
						</div>
					</div>
					<table class="table table-bordered table-striped">
						<tr>
							<th style="width:25%;">Đơn vị giá bán</th>
							<th style="width:25%;"><span id="net_price"></span></th>
							<th style="width:25%;">Thuế sản phẩm</th>
							<th style="width:25%;"><span id="pro_tax"></span></th>
						</tr>
					</table>
					<input type="hidden" id="punit_price" value=""/>
					<input type="hidden" id="old_tax" value=""/>
					<input type="hidden" id="old_qty" value=""/>
					<input type="hidden" id="old_price" value=""/>
					<input type="hidden" id="row_id" value=""/>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="editItem">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="gcModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
					class="fa fa-2x">&times;</i></button>
				<h4 class="modal-title" id="myModalLabel">{LANG.create_gift_card} </h4>
			</div>
			<div class="modal-body">
				<p>Vui lòng điền vào các thông tin dưới đây. Các mục đánh dấu * là các mục bắt buộc phải nhập vào.</p>
				<div class="alert alert-danger gcerror-con" style="display: none;">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<span id="gcerror"></span>
				</div>
				<div class="form-group">
					<label for="gccard_no">{LANG.card_no_gift}</label> *
					<div class="input-group">
						<input type="text" name="gccard_no" value=""  class="form-control" id="gccard_no" />
						<div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
							<a href="#" id="genNo"><i class="fa fa-cogs"></i></a>
						</div>
					</div>
				</div>
				<input type="hidden" name="gcname" value="{LANG.card_gift}" id="gcname"/>
				<div class="form-group">
					<label for="gcvalue">{LANG.gift_value}</label> *
					<input type="text" name="gcvalue" value=""  class="form-control" id="gcvalue" />
				</div>
				<div class="form-group">
					<label for="gcprice">{LANG.gift_price}</label> *
					<input type="text" name="gcprice" value=""  class="form-control" id="gcprice" />
				</div>
				<div class="form-group">
					<label for="gccustomer">{LANG.customer}</label>                    <input type="text" name="gccustomer" value=""  class="form-control" id="gccustomer" />
				</div>
				<div class="form-group">
					<label for="gcexpiry">{LANG.gift_date_expried}</label>                    <input type="text" name="gcexpiry" value="12/10/2020"  class="form-control date" id="gcexpiry" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="addGiftCard" class="btn btn-primary">{LANG.create_gift_card}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="mModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
					class="fa fa-2x">&times;</i></span><span class="sr-only">{LANG.close}</span></button>
				<h4 class="modal-title" id="mModalLabel">Thêm sản phẩm thủ công</h4>
			</div>
			<div class="modal-body" id="pr_popover_content">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="mcode" class="col-sm-4 control-label">Mã sản phẩm *</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-text" id="mcode">
						</div>
					</div>
					<div class="form-group">
						<label for="mname" class="col-sm-4 control-label">Tên sản phẩm *</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-text" id="mname">
						</div>
					</div>
					<div class="form-group">
						<label for="mtax" class="col-sm-4 control-label">Thuế sản phẩm *</label>
						<div class="col-sm-8">
							<select name="mtax" id="mtax" class="form-control pos-input-tip" style="width:100%;">
								<option value="" selected="selected"></option>
								<option value="1">No Tax</option>
								<option value="2">VAT @10%</option>
								<option value="3">GST @6%</option>
								<option value="4">VAT @20%</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="mquantity" class="col-sm-4 control-label">Số lượng *</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="mquantity">
						</div>
					</div>
					<div class="form-group">
						<label for="mdiscount"
							class="col-sm-4 control-label">Product Discount</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="mdiscount">
						</div>
					</div>
					<div class="form-group">
						<label for="mprice" class="col-sm-4 control-label">Đơn giá *</label>
						<div class="col-sm-8">
							<input type="text" class="form-control kb-pad" id="mprice">
						</div>
					</div>
					<table class="table table-bordered table-striped">
						<tr>
							<th style="width:25%;">Đơn vị giá bán</th>
							<th style="width:25%;"><span id="mnet_price"></span></th>
							<th style="width:25%;">Thuế sản phẩm</th>
							<th style="width:25%;"><span id="mpro_tax"></span></th>
						</tr>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="addItemManually">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="sckModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">
				<i class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span>
				</button>
				<button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
				<i class="fa fa-print"></i> {LANG.print}                </button>
				<h4 class="modal-title" id="mModalLabel">{LANG.shortcut_key}</h4>
			</div>
			<div class="modal-body" id="pr_popover_content">
				<table class="table table-bordered table-striped table-condensed table-hover"
					style="margin-bottom: 0px;">
					<thead>
						<tr>
							<th>{LANG.shortcut_key}</th>
							<th>{LANG.task}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Ctrl+F3</td>
							<td>{LANG.products}</td>
						</tr>
						<tr>
							<td>Ctrl+Shift+M</td>
							<td>{LANG.add_manual_products}</td>
						</tr>
						<tr>
							<td>Ctrl+Shift+C</td>
							<td>{LANG.customers}</td>
						</tr>
						<tr>
							<td>Ctrl+Shift+A</td>
							<td>{LANG.customers}</td>
						</tr>
						<tr>
							<td>Ctrl+F11</td>
							<td>{LANG.open_cat}</td>
						</tr>
						
						<tr>
							<td>F4</td>
							<td>{LANG.cancel_sale}</td>
						</tr>
						<tr>
							<td>F7</td>
							<td>{LANG.suppended_sales}</td>
						</tr>
						<tr>
							<td>F9</td>
							<td>{LANG.print_list_product}</td>
						</tr>
						<tr>
							<td>F8</td>
							<td>{LANG.payment_by}</td>
						</tr>
						<tr>
							<td>Ctrl+F1</td>
							<td>{LANG.today_sales}</td>
						</tr>
						<tr>
							<td>Ctrl+F2</td>
							<td>{LANG.open_suppened}</td>
						</tr>
						<tr>
							<td>Ctrl+F10</td>
							<td>{LANG.sales_pitch_close}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="dsModal" tabindex="-1" role="dialog" aria-labelledby="dsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fa fa-2x">&times;</i>
				</button>
				<h4 class="modal-title" id="dsModalLabel">{LANG.edit_discount}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="order_discount_input">{LANG.money_discount}</label>                    <input type="text" name="order_discount_input" value=""  class="form-control kb-pad" id="order_discount_input" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="updateOrderDiscount" class="btn btn-primary">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="sModal" tabindex="-1" role="dialog" aria-labelledby="sModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fa fa-2x">&times;</i>
				</button>
				<h4 class="modal-title" id="sModalLabel">{LANG.shipping}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="shipping_input">{LANG.shipping}</label>                    <input type="text" name="shipping_input" value=""  class="form-control kb-pad" id="shipping_input" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="updateShipping" class="btn btn-primary">{LANG.save}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="txModal" tabindex="-1" role="dialog" aria-labelledby="txModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
					class="fa fa-2x">&times;</i></button>
				<h4 class="modal-title" id="txModalLabel">{LANG.update_tax_code}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="order_tax_input">{LANG.tax_code_name}</label>
					<select name="order_tax_input" id="order_tax_input" class="form-control pos-input-tip" style="width:100%;">
						<option value="" selected="selected"></option>
						<option value="1">{LANG.no_tax}</option>
						<option value="2">VAT @10%</option>
						<option value="3">GST @6%</option>
						<option value="4">VAT @20%</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="updateOrderTax" class="btn btn-primary">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade in" id="susModal" tabindex="-1" role="dialog" aria-labelledby="susModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
					class="fa fa-2x">&times;</i></button>
				<h4 class="modal-title" id="susModalLabel">{LANG.suppended_sales}</h4>
			</div>
			<div class="modal-body">
				<p>{LANG.reference_note}</p>
				<div class="form-group">
					<label for="reference_note">{LANG.reference}</label>                    <input type="text" name="reference_note" value=""  class="form-control kb-text" id="reference_note" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="suspend_sale" class="btn btn-primary">{LANG.send}</button>
			</div>
		</div>
	</div>
</div>
<div id="order_tbl">
	<span id="order_span"></span>
	<table id="order-table" class="prT table table-striped" style="margin-bottom:0;" width="100%"></table>
</div>
<div id="bill_tbl">
	<span id="bill_span"></span>
	<table id="bill-table" width="100%" class="prT table table-striped" style="margin-bottom:0;"></table>
	<table id="bill-total-table" class="prT table" style="margin-bottom:0;" width="100%"></table>
	<span id="bill_footer"></span>
</div>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true"></div>
<div class="modal fade in" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabelC"
	aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        
	    </div>
	</div>
</div>
	
<div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
	aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        
	    </div>
	</div>
</div>
<div class="modal fade in" id="myModal2C" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2C"
	aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        
	    </div>
	</div>
</div>
<div class="modal fade in" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	        
	    </div>
	</div>
</div>
<div id="modal-loading" style="display: none;">
	<div class="blackbg"></div>
	<div class="loader"></div>
</div>
<script type="text/javascript">
	var site = {"url":"http:\/\/{MY_DOMAIN}\/","base_url":"https:\/\/{MY_DOMAIN}/admin\/","assets":"https:\/\/{MY_DOMAIN}\/themes\/admin_default\/js\/storehouse\/assets\/","settings":{"logo":"logo2.png","logo2":"logo3.png","site_name":"SHOP nv","language":"vietnamese","default_warehouse":"1","accounting_method":"0","default_currency":"USD","default_tax_rate":"1","rows_per_page":"10","version":"3.4.6","default_tax_rate2":"1","dateformat":"5","sales_prefix":"SALE","quote_prefix":"QUOTE","purchase_prefix":"PO","transfer_prefix":"TR","delivery_prefix":"DO","payment_prefix":"IPAY","return_prefix":"SR","returnp_prefix":"PR","expense_prefix":"","item_addition":"0","theme":"default","product_serial":"1","default_discount":"1","product_discount":"1","discount_method":"1","tax1":"1","tax2":"1","overselling":"0","iwidth":"800","iheight":"800","twidth":"150","theight":"150","watermark":"1","smtp_host":"pop.gmail.com","bc_fix":"4","auto_detect_barcode":"1","captcha":"0","reference_format":"2","racks":"1","attributes":"1","product_expiry":"1","decimals":"2","qty_decimals":"2","decimals_sep":".","thousands_sep":",","invoice_view":"0","default_biller":"3","rtl":"0","each_spent":null,"ca_point":null,"each_sale":null,"sa_point":null,"sac":"0","display_all_products":"0","display_symbol":"0","symbol":"","remove_expired":"0","barcode_separator":"-","set_focus":"0","price_group":"1","barcode_img":"0","ppayment_prefix":"POP","disable_editing":"90","qa_prefix":"","update_cost":"0","apis":"0","state":"AN","pdf_lib":"dompdf","user_language":"vietnamese","user_rtl":"0","indian_gst":false},"dateFormats":{"js_sdate":"dd\/mm\/yyyy","php_sdate":"d\/m\/Y","mysq_sdate":"%d\/%m\/%Y","js_ldate":"dd\/mm\/yyyy hh:ii","php_ldate":"d\/m\/Y H:i","mysql_ldate":"%d\/%m\/%Y %H:%i"}}, pos_settings = {"pos_id":"1","cat_limit":"22","pro_limit":"20","default_category":"1","default_customer":"1","default_biller":"3","display_time":"1","cf_title1":"GST Reg","cf_title2":"VAT Reg","cf_value1":"123456789","cf_value2":"987654321","receipt_printer":"BIXOLON SRP-350II","cash_drawer_codes":"x1C","focus_add_item":"Ctrl+F3","add_manual_product":"Ctrl+Shift+M","customer_selection":"Ctrl+Shift+C","add_customer":"Ctrl+Shift+A","toggle_category_slider":"Ctrl+F11","toggle_subcategory_slider":"Ctrl+F12","cancel_sale":"F4","suspend_sale":"F7","print_items_list":"F9","finalize_sale":"F8","today_sale":"Ctrl+F1","open_hold_bills":"Ctrl+F2","close_register":"Ctrl+F10","keyboard":"1","pos_printers":"BIXOLON SRP-350II, BIXOLON SRP-350II","java_applet":"0","product_button_color":"default","tooltips":"1","paypal_pro":"0","stripe":"0","rounding":"0","char_per_line":"42","pin_code":null,"purchase_code":"purchase_code","envato_username":"envato_username","version":"3.4.6","after_sale_page":"0","item_order":"0","authorize":"0","toggle_brands_slider":null,"remote_printing":"1","printer":null,"order_printers":null,"auto_print":"0","customer_details":null,"local_printers":null};
	var lang = {
	    unexpected_value: 'Unexpected value provided!',
	    select_above: '{LANG.warehouse_error}',
	    r_u_sure: '{LANG.sure}',
	    bill: '{LANG.payment}',
	    order: '{LANG.}',
	    total: '{LANG.total}',
	    items: '{LANG.total_items}',
	    discount: '{LANG.discount}',
	    order_tax: '{LANG.order_tax}',
	    grand_total: '{LANG.total}',
	    total_payable: '{LANG.total}',
	    rounding: '{LANG.rounding}',
	    merchant_copy: '{LANG.merchant_copy}'
	};
</script>
<script type="text/javascript">
	var product_variant = 0, shipping = 0, p_page = 0, per_page = 0, tcp = "1", pro_limit = 20,
	    brand_id = 0, obrand_id = 0, cat_id = "1", ocat_id = "1", sub_cat_id = 0, osub_cat_id,
	    count = 1, an = 1, DT = 1,
	    product_tax = 0, invoice_tax = 0, product_discount = 0, order_discount = 0, total_discount = 0, total = 0, total_paid = 0, grand_total = 0,
	    KB = 1, tax_rates =[{"id":"1","name":"No Tax","code":"NT","rate":"0.0000","type":"2"},{"id":"2","name":"VAT @10%","code":"VAT10","rate":"10.0000","type":"1"},{"id":"3","name":"GST @6%","code":"GST","rate":"6.0000","type":"1"},{"id":"4","name":"VAT @20%","code":"VT20","rate":"20.0000","type":"1"}];
	var protect_delete = 0, billers = [{"logo":"logo1.png","company":"Test Biller"}], biller = {"logo":"logo1.png","company":"Test Biller"};
	var username = '{SALES_NAME}', order_data = '', bill_data = '';
	
	function widthFunctions(e) {
	    var wh = $(window).height(),
	        lth = $('#left-top').height(),
	        lbh = $('#left-bottom').height();
	    $('#item-list').css("height", wh - 140);
	    $('#item-list').css("min-height", 515);
	    $('#left-middle').css("height", wh - lth - lbh - 102);
	    $('#left-middle').css("min-height", 278);
	    $('#product-list').css("height", wh - lth - lbh - 107);
	    $('#product-list').css("min-height", 278);
	}
	$(window).bind("resize", widthFunctions);
	$(document).ready(function () {
	    $('#view-customer').click(function(){
	        $('#myModalC').modal({remote: site.base_url + '/index.php?language=vi&nv=storehouse&op=ajax&mod=customers_view&customer_id=' + $("input[name=customer]").val()});
	        $('#myModalC').modal('show');
	        return false;
	    });
	    $('textarea').keydown(function (e) {
	        if (e.which == 13) {
	           var s = $(this).val();
	           $(this).val(s+'\n').focus();
	           e.preventDefault();
	           return false;
	        }
	    });
	    <!-- BEGIN: remove_pos_payment_old -->
	    
	    if (localStorage.getItem('positems')) {
            localStorage.removeItem('positems');
        }
        if (localStorage.getItem('posdiscount')) {
            localStorage.removeItem('posdiscount');
        }
        if (localStorage.getItem('postax2')) {
            localStorage.removeItem('postax2');
        }
        if (localStorage.getItem('posshipping')) {
            localStorage.removeItem('posshipping');
        }
        if (localStorage.getItem('poswarehouse')) {
            localStorage.removeItem('poswarehouse');
        }
        if (localStorage.getItem('posnote')) {
            localStorage.removeItem('posnote');
        }
        if (localStorage.getItem('poscustomer')) {
            localStorage.removeItem('poscustomer');
        }
        if (localStorage.getItem('posbiller')) {
            localStorage.removeItem('posbiller');
        }
        if (localStorage.getItem('poscurrency')) {
            localStorage.removeItem('poscurrency');
        }
        if (localStorage.getItem('posnote')) {
            localStorage.removeItem('posnote');
        }
        if (localStorage.getItem('staffnote')) {
            localStorage.removeItem('staffnote');
        }
	    $.ajax({
    		type: "GET",
    		url: '/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=set_session_store_remove_posls&session_store_id=0',
        	dataType: 'json',
        	data: function (params) {
                 return {
					 mod: 'set_session_store_id',
					 session_store_id:'0'
                 };
             },
            success: function (data, params) {
            	console.log(data);
            }
    	});
	    <!-- END: remove_pos_payment_old -->
	    
	    widthFunctions();
	    if (!localStorage.getItem('poscustomer')) {
	        localStorage.setItem('poscustomer', 1);
	    }
	    if (!localStorage.getItem('postax2')) {
	        localStorage.setItem('postax2', 1);
	    }
	    $('.select').select2({minimumResultsForSearch: 7});
	     //var customers = [{
	     //    id: 1,
	     //    text: 'Walk-in Customer'
	     //}];
	    $('#poscustomer').val(localStorage.getItem('poscustomer')).select2({
	        minimumInputLength: 3,
	        data: [],
	        initSelection: function (element, callback) {
	            $.ajax({
	                type: "get", async: false,
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=customers_getCustomer&customer_id=" + $(element).val(),
	                dataType: "json",
	                success: function (data) {
	                    callback(data[0]);
	                }
	            });
	        },
	        ajax: {
	            url: site.base_url + "index.php?language=vi&nv=storehouse&op=ajax&mod=customers_suggestions",
	            dataType: 'json',
	            quietMillis: 15,
	            data: function (term, page) {
	                return {
	                    term: term,
	                    limit: 10
	                };
	            },
	            results: function (data, page) {
	            	console.log(data.results);
	                if (data.results != null) {
	                    return {results: data.results};
	                } else {
	                    return {results: [{id: '', text: 'No Match Found'}]};
	                }
	            }
	        }
	    });
	    if (KB) {
	        display_keyboards();
	
	        var result = false, sct = '';
	        $('#poscustomer').on('select2-opening', function () {
	            sct = '';
	            $('.select2-input').addClass('kb-text');
	            display_keyboards();
	            $('.select2-input').bind('change.keyboard', function (e, keyboard, el) {
	                if (el && el.value != '' && el.value.length > 0 && sct != el.value) {
	                    sct = el.value;
	                }
	                if(!el && sct.length > 0) {
	                    $('.select2-input').addClass('select2-active');
	                    setTimeout(function() {
	                        $.ajax({
	                            type: "get",
	                            async: false,
	                            url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=customers_suggestions&term=" + sct,
	                            dataType: "json",
	                            success: function (res) {
	                                if (res.results != null) {
	                                    $('#poscustomer').select2({data: res}).select2('open');
	                                    $('.select2-input').removeClass('select2-active');
	                                } else {
	                                     bootbox.alert('no_match_found');
	                                    $('#poscustomer').select2('close');
	                                    $('#test').click();
	                                }
	                                
	                            }
	                        });
	                    }, 500);
	                }
	            });
	        });
	
	        $('#poscustomer').on('select2-close', function () {
	            $('.select2-input').removeClass('kb-text');
	            $('#test').click();
	            $('select, .select').select2('destroy');
	            $('select, .select').select2({minimumResultsForSearch: 7});
	        });
	        $(document).bind('click', '#test', function () {
	            var kb = $('#test').keyboard().getkeyboard();
	            kb.close();
	        });
	
	    }
	
	    $(document).on('change', '#posbiller', function () {
	        var sb = $(this).val();
	        $.each(billers, function () {
	            if(this.id == sb) {
	                biller = this;
	            }
	        });
	        $('#biller').val(sb);
	    });
	
	            $('#paymentModal').on('change', '#amount_1', function (e) {
	        $('#amount_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('blur', '#amount_1', function (e) {
	        $('#amount_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('select2-close', '#paid_by_1', function (e) {
	        $('#paid_by_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_no_1', function (e) {
	        $('#cc_no_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_holder_1', function (e) {
	        $('#cc_holder_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#gift_card_no_1', function (e) {
	        $('#paying_gift_card_no_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_month_1', function (e) {
	        $('#cc_month_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_year_1', function (e) {
	        $('#cc_year_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_type_1', function (e) {
	        $('#cc_type_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_cvv2_1', function (e) {
	        $('#cc_cvv2_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#cheque_no_1', function (e) {
	        $('#cheque_no_val_1').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#payment_note_1', function (e) {
	        $('#payment_note_val_1').val($(this).val());
	    });
	            $('#paymentModal').on('change', '#amount_2', function (e) {
	        $('#amount_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('blur', '#amount_2', function (e) {
	        $('#amount_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('select2-close', '#paid_by_2', function (e) {
	        $('#paid_by_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_no_2', function (e) {
	        $('#cc_no_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_holder_2', function (e) {
	        $('#cc_holder_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#gift_card_no_2', function (e) {
	        $('#paying_gift_card_no_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_month_2', function (e) {
	        $('#cc_month_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_year_2', function (e) {
	        $('#cc_year_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_type_2', function (e) {
	        $('#cc_type_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_cvv2_2', function (e) {
	        $('#cc_cvv2_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#cheque_no_2', function (e) {
	        $('#cheque_no_val_2').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#payment_note_2', function (e) {
	        $('#payment_note_val_2').val($(this).val());
	    });
	            $('#paymentModal').on('change', '#amount_3', function (e) {
	        $('#amount_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('blur', '#amount_3', function (e) {
	        $('#amount_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('select2-close', '#paid_by_3', function (e) {
	        $('#paid_by_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_no_3', function (e) {
	        $('#cc_no_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_holder_3', function (e) {
	        $('#cc_holder_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#gift_card_no_3', function (e) {
	        $('#paying_gift_card_no_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_month_3', function (e) {
	        $('#cc_month_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_year_3', function (e) {
	        $('#cc_year_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_type_3', function (e) {
	        $('#cc_type_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_cvv2_3', function (e) {
	        $('#cc_cvv2_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#cheque_no_3', function (e) {
	        $('#cheque_no_val_3').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#payment_note_3', function (e) {
	        $('#payment_note_val_3').val($(this).val());
	    });
	            $('#paymentModal').on('change', '#amount_4', function (e) {
	        $('#amount_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('blur', '#amount_4', function (e) {
	        $('#amount_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('select2-close', '#paid_by_4', function (e) {
	        $('#paid_by_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_no_4', function (e) {
	        $('#cc_no_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_holder_4', function (e) {
	        $('#cc_holder_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#gift_card_no_4', function (e) {
	        $('#paying_gift_card_no_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_month_4', function (e) {
	        $('#cc_month_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_year_4', function (e) {
	        $('#cc_year_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_type_4', function (e) {
	        $('#cc_type_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_cvv2_4', function (e) {
	        $('#cc_cvv2_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#cheque_no_4', function (e) {
	        $('#cheque_no_val_4').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#payment_note_4', function (e) {
	        $('#payment_note_val_4').val($(this).val());
	    });
	            $('#paymentModal').on('change', '#amount_5', function (e) {
	        $('#amount_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('blur', '#amount_5', function (e) {
	        $('#amount_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('select2-close', '#paid_by_5', function (e) {
	        $('#paid_by_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_no_5', function (e) {
	        $('#cc_no_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_holder_5', function (e) {
	        $('#cc_holder_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#gift_card_no_5', function (e) {
	        $('#paying_gift_card_no_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_month_5', function (e) {
	        $('#cc_month_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_year_5', function (e) {
	        $('#cc_year_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_type_5', function (e) {
	        $('#cc_type_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#pcc_cvv2_5', function (e) {
	        $('#cc_cvv2_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#cheque_no_5', function (e) {
	        $('#cheque_no_val_5').val($(this).val());
	    });
	    $('#paymentModal').on('change', '#payment_note_5', function (e) {
	        $('#payment_note_val_5').val($(this).val());
	    });
	    
	    $('#payment').click(function () {
	                    var twt = formatDecimal((total + invoice_tax) - order_discount + shipping);
	        if (count == 1) {
	            bootbox.alert('{LANG.add_product_payment_error}');
	            return false;
	        }
	        gtotal = formatDecimal(twt);
	                    $('#twt').text(formatMoney(gtotal));
	        $('#quick-payable').text(gtotal);
	                    $('#item_count').text(count - 1);
	        $('#paymentModal').appendTo("body").modal('show');
	        $('#amount_1').focus();
	    });
	    $('#paymentModal').on('show.bs.modal', function(e) {
	        $('#submit-sale').text('Gửi').attr('disabled', false);
	    });
	    $('#paymentModal').on('shown.bs.modal', function(e) {
	        $('#amount_1').focus().val(0);
	        $('#quick-payable').click();
	    });
	    var pi = 'amount_1', pa = 2;
	    $(document).on('click', '.quick-cash', function () {
	        if ($('#quick-payable').find('span.badge').length) {
	            $('#clear-cash-notes').click();
	        }
	        var $quick_cash = $(this);
	        var amt = $quick_cash.contents().filter(function () {
	            return this.nodeType == 3;
	        }).text();
	        var th = ',';
	        var $pi = $('#' + pi);
	        amt = formatDecimal(amt.split(th).join("")) * 1 + $pi.val() * 1;
	        $pi.val(formatDecimal(amt)).focus();
	        var note_count = $quick_cash.find('span');
	        if (note_count.length == 0) {
	            $quick_cash.append('<span class="badge">1</span>');
	        } else {
	            note_count.text(parseInt(note_count.text()) + 1);
	        }
	    });
	    $(document).on('click', '#quick-payable', function () {
	        $('#clear-cash-notes').click();
	        $(this).append('<span class="badge">1</span>');
	        $('#amount_1').val(grand_total);
	    });
	    $(document).on('click', '#clear-cash-notes', function () {
	        $('.quick-cash').find('.badge').remove();
	        $('#' + pi).val('0').focus();
	    });
	
	    $(document).on('change', '.gift_card_no', function () {
	        var cn = $(this).val() ? $(this).val() : '';
	        var payid = $(this).attr('id'),
	            id = payid.substr(payid.length - 1);
	        if (cn != '') {
	            $.ajax({
	                type: "get", async: false,
	                url: site.base_url + "index.php?language=vi&nv=storehouse&op=ajax&mod=sales_validate_gift_card&gift_card_no=" + cn,
	                dataType: "json",
	                success: function (data) {
	                    if (data === false) {
	                        $('#gift_card_no_' + id).parent('.form-group').addClass('has-error');
	                        bootbox.alert('Gift card number is incorrect or expired.');
	                    } else if (data.customer_id !== null && data.customer_id !== $('#poscustomer').val()) {
	                        $('#gift_card_no_' + id).parent('.form-group').addClass('has-error');
	                        bootbox.alert('Gift card number is not for this customer.');
	                    } else {
	                        $('#gc_details_' + id).html('<small>Card No: ' + data.card_no + '<br>Value: ' + data.value + ' - Balance: ' + data.balance + '</small>');
	                        $('#gift_card_no_' + id).parent('.form-group').removeClass('has-error');
	                        //calculateTotals();
	                        $('#amount_' + id).val(gtotal >= data.balance ? data.balance : gtotal).focus();
	                    }
	                }
	            });
	        }
	    });
	
	    $(document).on('click', '.addButton', function () {
	        if (pa <= 5) {
	            $('#paid_by_1, #pcc_type_1').select2('destroy');
	            var phtml = $('#payments').html(),
	                update_html = phtml.replace(/_1/g, '_' + pa);
	            pi = 'amount_' + pa;
	            $('#multi-payment').append('<button type="button" class="close close-payment" style="margin: -10px 0px 0 0;"><i class="fa fa-2x">&times;</i></button>' + update_html);
	            $('#paid_by_1, #pcc_type_1, #paid_by_' + pa + ', #pcc_type_' + pa).select2({minimumResultsForSearch: 7});
	            read_card();
	            pa++;
	        } else {
	            bootbox.alert('Max allowed limit reached.');
	            return false;
	        }
	        if (KB) { display_keyboards(); }
	        $('#paymentModal').css('overflow-y', 'scroll');
	    });
	
	    $(document).on('click', '.close-payment', function () {
	        $(this).next().remove();
	        $(this).remove();
	        pa--;
	    });
	
	    $(document).on('focus', '.amount', function () {
	        pi = $(this).attr('id');
	        calculateTotals();
	    }).on('blur', '.amount', function () {
	        calculateTotals();
	    });
	
	    function calculateTotals() {
	        var total_paying = 0;
	        var ia = $(".amount");
	        $.each(ia, function (i) {
	            var this_amount = formatCNum($(this).val() ? $(this).val() : 0);
	            total_paying += parseFloat(this_amount);
	        });
	        $('#total_paying').text(formatMoney(total_paying));
	                    $('#balance').text(formatMoney(total_paying - gtotal));
	        $('#balance_' + pi).val(formatDecimal(total_paying - gtotal));
	        total_paid = total_paying;
	        grand_total = gtotal;
	                }
	
	    $("#add_item").autocomplete({
	        source: function (request, response) {
	            if (!$('#poscustomer').val()) {
	                $('#add_item').val('').removeClass('ui-autocomplete-loading');
	                bootbox.alert('Vui lòng chọn kho hàng');
	                //response('');
	                $('#add_item').focus();
	                return false;
	            }
	            $.ajax({
	                type: 'get',
	                url: '/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=sales_suggestions',
	                dataType: "json",
	                data: {
	                    term: request.term,
	                    warehouse_id: $("#poswarehouse").val(),
	                    customer_id: $("#poscustomer").val()
	                },
	                success: function (data) {
	                    $(this).removeClass('ui-autocomplete-loading');
	                    response(data);
	                }
	            });
	        },
	        minLength: 1,
	        autoFocus: false,
	        delay: 250,
	        response: function (event, ui) {
	            if ($(this).val().length >= 16 && ui.content[0].id == 0) {
	                bootbox.alert('Không có kết quả phù hợp được tìm thấy! Sản phẩm có thể không có trong kho.', function () {
	                    $('#add_item').focus();
	                });
	                $(this).val('');
	            }
	            else if (ui.content.length == 1 && ui.content[0].id != 0) {
	                ui.item = ui.content[0];
	                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
	                $(this).autocomplete('close');
	            }
	            else if (ui.content.length == 1 && ui.content[0].id == 0) {
	                bootbox.alert('Không có kết quả phù hợp được tìm thấy! Sản phẩm có thể không có trong kho.', function () {
	                    $('#add_item').focus();
	                });
	                $(this).val('');
	
	            }
	        },
	        select: function (event, ui) {
	            event.preventDefault();
	            if (ui.item.id !== 0) {
	                var row = add_invoice_item(ui.item);
	                if (row)
	                    $(this).val('');
	            } else {
	                bootbox.alert('Không có kết quả phù hợp được tìm thấy! Sản phẩm có thể không có trong kho.');
	            }
	        }
	    });
		console.log(count);
	    $(".pos-tip").tooltip();        // $('#posTable').stickyTableHeaders({fixedOffset: $('#product-list')});
	    $('#posTable').stickyTableHeaders({scrollableArea: $('#product-list')});
	    $('#product-list, #category-list, #subcategory-list, #brands-list').perfectScrollbar({suppressScrollX: true});
	    $('select, .select').select2({minimumResultsForSearch: 7});
	
	    $(document).on('click touchstart', '.product', function (e) {
	        $('#modal-loading').show();
	        	code = $(this).val(),
	            wh = $('#poswarehouse').val(),
	            cu = $('#poscustomer').val();
	            if(wh=='null') wh =0;
	        $.ajax({
	            type: "get",
	            url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=ProductDataByCode",
	            data: {code: code, warehouse_id: wh, customer_id: cu},
	            dataType: "json",
	            success: function (data) {
	                e.preventDefault();
	                if (data.result !== 'failed') {
	                    add_invoice_item(data.pr);
	                    $('#modal-loading').hide();
	                } else {
	                    bootbox.alert('{LANG.no_product_2}');
	                    $('#modal-loading').hide();
	                }
	            }
	        });
	    });
		
	    $(document).on('click', '.category', function () {
	        if (cat_id != $(this).val()) {
	            $('#open-category').click();
	            $('#modal-loading').show();
	            cat_id = $(this).val();
	            $.ajax({
	                type: "get",
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=pos_ajaxsecondcategorydata",
	                data: {category_id: cat_id},
	                dataType: "json",
	                success: function (data) {
	                    $('#item-list').empty();
	                    var newPrs = $('<div></div>');
	                    newPrs.html(data.products);
	                    newPrs.appendTo("#item-list");
	                    $('#subcategory-list').empty();
	                    var newScs = $('<div></div>');
	                    newScs.html(data.subcategories);
	                    newScs.appendTo("#subcategory-list");
	                    tcp = data.tcp;
	                    nav_pointer();
	                }
	            }).done(function () {
	                p_page = 'n';
	                $('#category-' + cat_id).addClass('active');
	                $('#category-' + ocat_id).removeClass('active');
	                ocat_id = cat_id;
	                $('#modal-loading').hide();
	                nav_pointer();
	            });
	        }
	    });
	    $('#category-' + cat_id).addClass('active');
	
	    $(document).on('click', '.brand', function () {
	        if (brand_id != $(this).val()) {
	            $('#open-brands').click();
	            $('#modal-loading').show();
	            brand_id = $(this).val();
	            $.ajax({
	                type: "get",
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=pos_ajaxbranddata",
	                data: {brand_id: brand_id},
	                dataType: "json",
	                success: function (data) {
	                    $('#item-list').empty();
	                    var newPrs = $('<div></div>');
	                    newPrs.html(data.products);
	                    newPrs.appendTo("#item-list");
	                    tcp = data.tcp;
	                    nav_pointer();
	                }
	            }).done(function () {
	                p_page = 'n';
	                $('#brand-' + brand_id).addClass('active');
	                $('#brand-' + obrand_id).removeClass('active');
	                obrand_id = brand_id;
	                $('#category-' + cat_id).removeClass('active');
	                $('#subcategory-' + sub_cat_id).removeClass('active');
	                cat_id = 0; sub_cat_id = 0;
	                $('#modal-loading').hide();
	                nav_pointer();
	            });
	        }
	    });
	
	    $(document).on('click', '.subcategory', function () {
	        if (sub_cat_id != $(this).val()) {
	            $('#open-subcategory').click();
	            $('#modal-loading').show();
	            sub_cat_id = $(this).val();
	            $.ajax({
	                type: "get",
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=pos_ajaxproducts",
	                data: {category_id: cat_id, subcategory_id: sub_cat_id, per_page: p_page},
	                dataType: "html",
	                success: function (data) {
	                    $('#item-list').empty();
	                    var newPrs = $('<div></div>');
	                    newPrs.html(data);
	                    newPrs.appendTo("#item-list");
	                }
	            }).done(function () {
	                p_page = 'n';
	                $('#subcategory-' + sub_cat_id).addClass('active');
	                $('#subcategory-' + osub_cat_id).removeClass('active');
	                $('#modal-loading').hide();
	            });
	        }
	    });
	
	    $('#next').click(function () {
	        if (p_page == 'n') {
	            p_page = 0
	        }
	        p_page = p_page + pro_limit;
	        if (tcp >= pro_limit && p_page < tcp) {
	            $('#modal-loading').show();
	            $.ajax({
	                type: "get",
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=pos_ajaxproducts",
	                data: {category_id: cat_id, subcategory_id: sub_cat_id, per_page: p_page},
	                dataType: "html",
	                success: function (data) {
	                    $('#item-list').empty();
	                    var newPrs = $('<div></div>');
	                    newPrs.html(data);
	                    newPrs.appendTo("#item-list");
	                    nav_pointer();
	                }
	            }).done(function () {
	                $('#modal-loading').hide();
	            });
	        } else {
	            p_page = p_page - pro_limit;
	        }
	    });
	
	    $('#previous').click(function () {
	        if (p_page == 'n') {
	            p_page = 0;
	        }
	        if (p_page != 0) {
	            $('#modal-loading').show();
	            p_page = p_page - pro_limit;
	            if (p_page == 0) {
	                p_page = 'n'
	            }
	            $.ajax({
	                type: "get",
	                url: "/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=pos_ajaxproducts",
	                data: {category_id: cat_id, subcategory_id: sub_cat_id, per_page: p_page},
	                dataType: "html",
	                success: function (data) {
	                    $('#item-list').empty();
	                    var newPrs = $('<div></div>');
	                    newPrs.html(data);
	                    newPrs.appendTo("#item-list");
	                    nav_pointer();
	                }
	
	            }).done(function () {
	                $('#modal-loading').hide();
	            });
	        }
	    });
	
	    $(document).on('change', '.paid_by', function () {
	        $('#clear-cash-notes').click();
	        $('#amount_1').val(grand_total);
	        var p_val = $(this).val(),
	            id = $(this).attr('id'),
	            pa_no = id.substr(id.length - 1);
	        $('#rpaidby').val(p_val);
	        if (p_val == 'cash' || p_val == 'other') {
	            $('.pcheque_' + pa_no).hide();
	            $('.pcc_' + pa_no).hide();
	            $('.pcash_' + pa_no).show();
	            $('#amount_' + pa_no).focus();
	        } else if (p_val == 'CC' || p_val == 'stripe' || p_val == 'ppp' || p_val == 'authorize') {
	            $('.pcheque_' + pa_no).hide();
	            $('.pcash_' + pa_no).hide();
	            $('.pcc_' + pa_no).show();
	            $('#swipe_' + pa_no).focus();
	        } else if (p_val == 'Cheque') {
	            $('.pcc_' + pa_no).hide();
	            $('.pcash_' + pa_no).hide();
	            $('.pcheque_' + pa_no).show();
	            $('#cheque_no_' + pa_no).focus();
	        } else {
	            $('.pcheque_' + pa_no).hide();
	            $('.pcc_' + pa_no).hide();
	            $('.pcash_' + pa_no).hide();
	        }
	        if (p_val == 'gift_card') {
	            $('.gc_' + pa_no).show();
	            $('.ngc_' + pa_no).hide();
	            $('#gift_card_no_' + pa_no).focus();
	        } else {
	            $('.ngc_' + pa_no).show();
	            $('.gc_' + pa_no).hide();
	            $('#gc_details_' + pa_no).html('');
	        }
	    });
	
	    $(document).on('click', '#submit-sale', function () {
	        if (total_paid == 0 || total_paid < grand_total) {
	            bootbox.confirm("Paid amount is less than the payable amount. Please press OK to submit the sale.", function (res) {
	                if (res == true) {
	                    $('#pos_note').val(localStorage.getItem('posnote'));
	                    $('#staff_note').val(localStorage.getItem('staffnote'));
	                    $('#submit-sale').text('Loading...').attr('disabled', true);
	                    $('#pos-sale-form').submit();
	                }
	            });
	            return false;
	        } else {
	            $('#pos_note').val(localStorage.getItem('posnote'));
	            $('#staff_note').val(localStorage.getItem('staffnote'));
	            $(this).text('Loading...').attr('disabled', true);
	            $('#pos-sale-form').submit();
	        }
	    });
	    $('#suspend').click(function () {
	        if (count <= 1) {
	            bootbox.alert('{LANG.add_product_suppend}');
	            return false;
	        } else {
	            $('#susModal').modal();
	        }
	    });
	    $('#suspend_sale').click(function () {
	        ref = $('#reference_note').val();
	        if (!ref || ref == '') {
	            bootbox.alert('Please type reference note and submit to suspend this sale');
	            return false;
	        } else {
	            suspend = $('<span></span>');
	                            suspend.html('<input type="hidden" name="suspend" value="yes" /><input type="hidden" name="suspend_note" value="' + ref + '" />');
	                            suspend.appendTo("#hidesuspend");
	            $('#total_items').val(count - 1);
	            $('#pos-sale-form').submit();
	
	        }
	    });
	});
	
	$(document).ready(function () {
	    $('#print_order').click(function () {
	        if (count == 1) {
	            bootbox.alert('{LANG.add_product_order_error}');
	            return false;
	        }
	        Popup($('#order_tbl').html());
	    });
	    $('#print_bill').click(function () {
	        if (count == 1) {
	            bootbox.alert('{LANG.add_product_bill_error}');
	            return false;
	        }
	                        Popup($('#bill_tbl').html());
	                });
	});
	function formatRepo (repo) {
		console.log(repo);
		if (repo.loading) return repo.text;
		return repo.title;
	}
	
	function formatRepoSelection (repo) {
		return '';
	}
	function formatRepoSelection2 (repo) {
		return repo.title;
	}
	function warehouse_id_select2 (current) {
		if(current == null) current = 0;
		$("#warehouse_id").select2({
		        language: "vi",
		        ajax: {
			        url: '/admin/index.php?language=vi&nv=storehouse&op=ajax',
		            dataType: 'json',
		            delay: 0,
		            data: function (params) {
		            	
	                	return {
						  mod : "warehouse_list",
						  store_id : current
	              		};
	              	},
		            processResults: function (data, params) {
		                return {
		                    results: data
		                };
		            },
			        cache: true
		        },
		        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
		        minimumInputLength: 1,
		        templateResult: formatRepo, // omitted for brevity, see the source of this page
		        templateSelection: formatRepoSelection2 // omitted for brevity, see the source of this page
		    });
	}
	$(function () {
		$("#store_id").select2();
			var store_id = $("#store_session").val();
			warehouse_id_select2 (store_id);
		$("#store_id").on('change', function () {
			 var current = $("#store_id").select2("val");
			 $("#warehouse_id").val(null).trigger("change");
			 //warehouse_id_select2 (current);
			$.ajax({
	    		type: "GET",
	    		url: '/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=set_session_store_id&session_store_id=' + current,
	        	dataType: 'json',
	        	data: function (params) {
	                 return {
						 mod: 'set_session_store_id',
						 session_store_id:current
	                 };
	             },
	            success: function (data, params) {
	            	$("#store_session").val(data.session_store_id);
	            	//warehouse_id_select2 (data.session_store_id);
	            	console.log(data);
	            	window.location.href = window.location.href;
	            }
	    	});
	    	
		});
	    $(".alert").effect("shake");
	    setTimeout(function () {
	        $(".alert").hide('blind', {}, 500)
	    }, 15000);
	            var now = new moment();
	    $('#display_time').text(now.format((site.dateFormats.js_sdate).toUpperCase() + " HH:mm"));
	    setInterval(function () {
	        var now = new moment();
	        $('#display_time').text(now.format((site.dateFormats.js_sdate).toUpperCase() + " HH:mm"));
	    }, 1000);
	        });
	    function Popup(data) {
	    var mywindow = window.open('', 'sma_pos_print', 'height=500,width=300');
	    mywindow.document.write('<html><head><title>Print</title>');
	    mywindow.document.write('<link rel="stylesheet" href="/themes/admin_default/js/storehouse/assets/styles/helpers/bootstrap.min.css" type="text/css" />');
	    mywindow.document.write(' <style type="text/css" media="all">');
        mywindow.document.write('    body { color: #000; }');
        mywindow.document.write('    #wrapper { max-width: 480px; margin: 0 auto; padding-top: 20px; }');
        mywindow.document.write('    .btn { border-radius: 0; margin-bottom: 5px; }');
        mywindow.document.write('    .bootbox .modal-footer { border-top: 0; text-align: center; }');
        mywindow.document.write('    h3 { margin: 5px 0; }');
        mywindow.document.write('    .order_barcodes img { float: none !important; margin-top: 5px; }');
        mywindow.document.write('    @media print {');
        mywindow.document.write('        .no-print { display: none; }');
        mywindow.document.write('       #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }');
        mywindow.document.write('       .no-border { border: none !important; }');
        mywindow.document.write('       .border-bottom { border-bottom: 1px solid #ddd !important; }');
        mywindow.document.write('       table tfoot { display: table-row-group; }');
        mywindow.document.write('    }');
        mywindow.document.write(' </style>');
	    mywindow.document.write('</head><body >');
	    mywindow.document.write(data);
	    mywindow.document.write('<div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">');
	    mywindow.document.write('<button onclick="window.print();" class="btn btn-block btn-primary">Print</button>');
	    mywindow.document.write('</div>');
	    mywindow.document.write('</bo' + 'dy>');
	    mywindow.document.write('</html>');
	    //window.print();
	    //mywindow.print();
	    //mywindow.close();
	    return true;
	} 
</script>

<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/themes/default/js/bootstrap.min.js?t=106"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/select2.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/custom.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/jquery.calculator.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/pos/js/plugins.min.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/pos/js/parse-track-data.js"></script>
<script type="text/javascript" src="/themes/admin_default/js/storehouse/assets/pos/js/pos.ajax.js"></script>
<script type="text/javascript">
	$('.sortable_table tbody').sortable({
	    containerSelector: 'tr'
	});
</script>
<script type="text/javascript" charset="UTF-8">(function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Hãy gõ "+n+" hoặc nhiều ký tự gợi ý"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Hãy xóa "+n+" ký tự"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Đang tìm..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);</script>
<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
</body></html>
<!-- END: main -->
<!-- BEGIN: no_pos -->
    <script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
	<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
	<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
	<!-- BEGIN: error -->
	<div class="alert alert-warning">{ERROR}</div>
	<!-- END: error -->
<!-- END: no_pos -->