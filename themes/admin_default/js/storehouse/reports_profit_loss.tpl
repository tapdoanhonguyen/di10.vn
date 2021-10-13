<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.reports_profit_loss}       </h2>

        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
		<div class="well" >
			<form action="{NV_BASE_ADMINURL}index.php" method="post">
			    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
			    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
			    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
			    <div class="row">
			        <div class="col-xs-24 col-md-6">
			            <div class="form-group">
			                <input class="form-control" type="text" value="{date_from}" name="date_from" id="date_from" style="width: 90px;" maxlength="10" />
			            </div>
			        </div>
			        <div class="col-xs-24 col-md-6">
			            <div class="form-group">
			                <input class="form-control" type="text" value="{date_to}" name="date_to" id="date_to" style="width: 90px;" maxlength="10"  />
			            </div>
			        </div>
			        <div class="col-xs-12 col-md-3">
			            <div class="form-group">
			                <input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
			            </div>
			        </div>
			    </div>
			</form>
		</div>
		<div class="box">
			<div class="box-content">
			        <div class="row">
			            <div class="col-lg-24">
			                <p class="introtext">Please view the Profit and/or Loss report and you can select the date range to customized the report.</p>
			
			                <div class="row">
			                    <div class="col-sm-24">
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 borange">
			                                <h4 class="bold">Nhập hàng</h4>
			                                <i class="icon fa fa-star"></i>
			
			                                <h3 class="bold">{VIEW.total_purchases.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_purchases.total_fomart} Nhập hàng </p>
			
			                                <p>{VIEW.total_purchases.paid_fomart} Đã thanh toán                                    &amp; {VIEW.total_purchases.tax_fomart}Tax</p>
			                            </div>
			                        </div>
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 bdarkGreen">
			                                <h4 class="bold">Bán hàng</h4>
			                                <i class="icon fa fa-heart"></i>
			
			                                <h3 class="bold">{VIEW.total_sales.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_sales.total_fomart} Bán hàng </p>
			
			                                <p>{VIEW.total_sales.paid_fomart} Đã thanh toán                                    &amp; {VIEW.total_sales.tax_fomart} Tax </p>
			                            </div>
			                        </div>
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 bred">
			                                <h4 class="bold">Trả về</h4>
			                                <i class="icon fa fa-random"></i>
			
			                                <h3 class="bold">{VIEW.total_return_sales.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_return_sales.total_fomart} Trả về </p>
			
			                                <p>{VIEW.total_return_sales.tax_fomart}Tax </p>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-24">
			                        <div class="col-sm-12">
			                            <div class="small-box padding1010 bdarkGreen">
			                                <h4 class="bold">Thanh toán đã nhận</h4>
			                                <i class="icon fa fa-usd"></i>
			
			                                <h3 class="bold">{VIEW.total_received.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_received.total_fomart} Đã nhận </p>
			
			                                <p>{VIEW.total_received_cash.total_amount_fomart} Tiền mặt                                    , {VIEW.total_received_cc.total_amount_fomart}Số thẻ tín dụng                                    , {VIEW.total_received_cheque.total_amount_fomart} Séc                                    , {VIEW.total_received_ppp.total_amount_fomart} Paypal Pro                                    , {VIEW.total_received_stripe.total_amount_fomart} Stripe </p>
			                            </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="small-box padding1010 borange">
			                                <h4 class="bold">Đã thanh toán</h4>
			                                <i class="icon fa fa-usd"></i>
			
			                                <h3 class="bold">{VIEW.total_paid.total_amount_fomart}</h3>
			
			                                <p>{VIEW.total_paid.total_fomart} Gửi</p>
			
			                                <p>&nbsp;</p>
			                            </div>
			                        </div>
			                        <div class="col-sm-6">
			                            <div class="small-box padding1010 bpurple">
			                                <h4 class="bold">Chi phí</h4>
			                                <i class="icon fa fa-usd"></i>
			
			                                <h3 class="bold">{VIEW.total_expenses.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_expenses.total_fomart} Chi phí</p>
			
			                                <p>&nbsp;</p>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-24">
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 bred">
			                                <h4 class="bold">Lợi nhuận/Chi phí</h4>
			                                <i class="icon fa fa-money"></i>
			
			                                <h3 class="bold">{VIEW.profit_loss.total_amount_fomart}</h3>
			
			                                <p>{VIEW.total_sales.total_amount_fomart} Bán hàng                                    - {VIEW.total_purchases.total_amount_fomart} Nhập hàng</p>
			                            </div>
			                        </div>
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 bpink">
			                                <h4 class="bold">Lợi nhuận/Chi phí</h4>
			                                <i class="icon fa fa-money"></i>
			
			                                <h3 class="bold">{VIEW.profit_loss.tax_fomart}</h3>
			
			                                <p>{VIEW.total_sales.total_amount_fomart} Bán hàng                                    - {VIEW.total_sales.tax_fomart} Tax                                    - {VIEW.total_purchases.total_amount_fomart} Nhập hàng </p>
			                            </div>
			                        </div>
			                        <div class="col-sm-8">
			                            <div class="small-box padding1010 bblue">
			                                <h4 class="bold">Lợi nhuận/Chi phí</h4>
			                                <i class="icon fa fa-money"></i>
			
			                                <h3 class="bold">{VIEW.profit_loss.profit_loss_total_amount_fomart}</h3>
			
			                                <p>({VIEW.total_sales.total_amount_fomart} Bán hàng                                    - {VIEW.total_sales.tax_fomart} Tax) -
			                                    ({VIEW.total_purchases.total_amount_fomart} Nhập hàng                                    - {VIEW.total_purchases.tax_fomart} Tax)</p>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			                <div class="row">
			                    <div class="col-sm-24">
			                        <div class="col-sm-24">
			                            <div class="small-box padding1010 bmGreen">
			                                <h4 class="bold">Các khoản thanh toán</h4>
			                                <i class="icon fa fa-pie-chart"></i>
			
			                                <h3 class="bold">{VIEW.payments.total_amount_fomart}</h3>
			
			                                <p class="bold">{VIEW.total_received.total_amount_fomart} Đã nhận                                    - {VIEW.total_returned.total_amount_fomart} refund                                    - {VIEW.total_paid.total_amount_fomart} Gửi                                    - {VIEW.total_expenses.total_amount_fomart} Chi phí                                    - {VIEW.total_return_sales.total_amount_fomart} Trả về                                    </p>
			                            </div>
			                        </div>
			                    </div>
			                </div> 
			              </div>
			        </div> 
			    </div> 
		</div>	
	</div>
</div>
<script>
    $(document).ready(function () {
    	$("#date_from,#date_to").datepicker({
	        showOn : "both",
	        dateFormat : "dd/mm/yy",
	        changeMonth : true,
	        changeYear : true,
	        showOtherMonths : true,
	        buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
	        buttonImageOnly : true
	    });
	    $('body').on('click', '#excel', function(e) {
	        e.preventDefault();
	        $('#form_action').val($(this).attr('data-action'));
	        $('#action-form-submit').submit();
	    });
	});
</script>
<!-- END: main -->