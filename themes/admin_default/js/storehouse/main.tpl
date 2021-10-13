<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<div id="content" style="min-height: 602px;">
   <div class="row">
      <div class="col-sm-24 col-md-24">
         <ul class="breadcrumb">
            <li class="active">Bảng điều khiển</li>
            <li class="right_log hidden-xs" >
               Địa chỉ IP của bạn {IP} <span class="hidden-sm">( Đăng nhập gần đây: {date_login}  )</span>                            
            </li>
            <li class="right_log hidden-xs" >
               Cữa hàng: {NAME_STORE}                           
            </li>
         </ul>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-44">
         <div class="alerts-con"></div>
         <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-44">
               <div class="box">
                  <div class="box-header">
                     <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span>Liên kết nhanh</h2>
                  </div>
                  <div class="box-content">
                  	<!--<div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bblue white quick-button small" href="index.php?language=vi&nv=storehouse&op=pos">
                           <i class="fa fa-barcode"></i>
                           <p>{LANG.pos}</p>
                        </a>
                     </div>-->
					 <!-- BEGIN: button_product -->
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bblue white quick-button small" href="index.php?language=vi&nv=storehouse&op=products_list">
                           <i class="fa fa-barcode"></i>
                           <p>{LANG.products_list}</p>
                        </a>
                     </div>
					 <!-- END: button_product -->
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bdarkGreen white quick-button small" href="index.php?language=vi&nv=storehouse&op=sales_list">
                           <i class="fa fa-heart"></i>
                           <p>{LANG.sales_list}</p>
                        </a>
                     </div>
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bred white quick-button small" href="index.php?language=vi&nv=storehouse&op=purchases_list">
                           <i class="fa fa-star"></i>
                           <p>{LANG.purchases_list}</p>
                        </a>
                     </div>
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bpink white quick-button small" href="index.php?language=vi&nv=storehouse&op=transfer_list">
                           <i class="fa fa-star-o"></i>
                           <p>{LANG.transfer_list}</p>
                        </a>
                     </div>
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bgrey white quick-button small" href="index.php?language=vi&nv=storehouse&op=customers_list">
                           <i class="fa fa-users"></i>
                           <p>{LANG.customers_list}</p>
                        </a>
                     </div>
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bgrey white quick-button small" href="index.php?language=vi&nv=storehouse&op=supply_list">
                           <i class="fa fa-users"></i>
                           <p>{LANG.supply_list}</p>
                        </a>
                     </div>
					 <!-- BEGIN: button_setting -->
                     <div class="col-lg-6 col-md-6 col-xs-24 padding1010">
                        <a class="bblue white quick-button small" href="index.php?language=vi&nv=storehouse&op=config">
                           <i class="fa fa-cogs"></i>
                           <p>Cài đặt</p>
                        </a>
                     </div>
                     <!-- END: button_setting -->
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-44">
               <div class="box">
                  <div class="box-header">
                     <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span>Báo cáo Tổng quan </h2>
                  </div>
                  <div class="box-content">
					
                  	<div class="col-md-4 col-xs-8 padding1010">
	                    <a class="bblue white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_products">
	                        <i class="fa fa-barcode"></i>
	
	                        <p>Báo cáo sản phẩm</p>
	                    </a>
	                </div>
	
	                <div class="col-md-4 col-xs-8 padding1010" >
	                    <a class="bdarkGreen white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_daily_sales">
	                        <i class="fa fa-calendar-o"></i>
	
	                        <p>Doanh số theo ngày</p>
	                    </a>
	                </div>
                  	<div class="col-md-4 col-xs-8 padding1010">
	                    <a class="bblue white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_warehouse_stock">
	                        <i class="fa fa-building"></i>
	
	                        <p>Biểu đồ tồn kho</p>
	                    </a>
	                </div>
                  	<div class="col-md-4 col-xs-8 padding1010" >
	                    <a class="blightOrange white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_profit_loss">
	                        <i class="fa fa-money"></i>
	
	                        <p>Lợi nhuận và chi phí</p>
	                    </a>
	                </div>
	
	                <div class="col-md-4 col-xs-8 padding1010" >
	                    <a class="blightBlue white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_purchases">
	                        <i class="fa fa-star"></i>
	
	                        <p>Báo cáo nhập hàng</p>
	                    </a>
	                </div>
	
	                <div class="col-md-4 col-xs-8 padding1010" >
	                    <a class="borange white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_customers">
	                        <i class="fa fa-users"></i>
	
	                        <p>Thống kê KH</p>
	                    </a>
	                </div>
	
	                <div class="col-md-4 col-xs-8 padding1010" >
	                    <a class="borange white quick-button" href="{NV_BASE_SITEURL}admin/index.php?language=vi&nv=storehouse&op=reports_suppliers">
	                        <i class="fa fa-users"></i>
	
	                        <p>Thống kê nhà cung cấp</p>
	                    </a>
	                </div>
                     
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-24">
               <div class="box">
                  <div class="box-header">
                     <h2 class="blue"><i class="fa-fw fa fa-tasks"></i> 5 dữ liệu mới nhất</h2>
                  </div>
                  <div class="box-content">
                     <div class="row">
                        <div class="col-md-24">
                        	<ul class="nav nav-tabs ext-detail-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab" aria-expanded="true">{LANG.sales_list}</a></li>
								<li role="presentation" ><a href="#purchases" aria-controls="purchases" role="tab" data-toggle="tab" aria-expanded="false">{LANG.purchases_list}</a></li>
								<li role="presentation" ><a href="#customers" aria-controls="customers" role="tab" data-toggle="tab" aria-expanded="false">{LANG.customers_list}</a></li>
								<li role="presentation" ><a href="#suppliers" aria-controls="suppliers" role="tab" data-toggle="tab" aria-expanded="false">{LANG.supply_list}</a></li>
							</ul>
                          
							<div class="tab-content">
								<div id="sales" class="tab-pane in active" role="tabpanel" >
									<div class="row">
										<div class="col-sm-24">
											<div class="table-responsive">
												<table id="sales-tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
													<thead>
														<tr>
															<th style="width:30px !important;">#</th>
															<th>Ngày</th>
															<th>Số tham chiếu</th>
															<th>Khách hàng</th>
															<th>Trạng thái</th>
															<th>Tổng</th>
															<th>Trạng thái thanh toán</th>
															<th>Đã thanh toán</th>
														</tr>
													</thead>
													<tbody>
														<!-- BEGIN: sales -->
														<tr>
															<td >{SALES.number}</td>
															<td>{SALES.date_formart}</td>
															<td>{SALES.reference_no}</td>
															<td>{SALES.customer.company}</td>
															<td>{SALES.sale_status_formart}</td>
															<td>{SALES.grand_total_format}</td>
															<td>{SALES.payment_formart}</td>
															<td>{SALES.paid_format}</td>
														</tr>
														<!-- END: sales -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
								<div id="purchases" class="tab-pane fade in" role="tabpanel">
									<div class="row">
										<div class="col-sm-24">
											<div class="table-responsive">
												<table id="purchases-tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
													<thead>
														<tr>
															<th style="width:30px !important;">#</th>
															<th>Ngày</th>
															<th>Số tham chiếu</th>
															<th>Nhà cung cấp</th>
															<th>Trạng thái</th>
															<th>Tổng</th>
															<th>Trạng thái thanh toán</th>
															<th>Đã thanh toán</th>
														</tr>
													</thead>
													<tbody>
														<!-- BEGIN: purchases -->
														<tr>
															<td >{PURCHASES.number}</td>
															<td>{PURCHASES.date_formart}</td>
															<td>{PURCHASES.reference_no}</td>
															<td>{PURCHASES.supplier.company}</td>
															<td>{PURCHASES.status_formart}</td>
															<td>{PURCHASES.grand_total_format}</td>
															<td>{PURCHASES.payment_formart}</td>
															<td>{PURCHASES.paid_format}</td>
														</tr>
														<!-- END: purchases -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								
								<div id="customers" class="tab-pane fade in" role="tabpanel">
									<div class="row">
										<div class="col-sm-24">
											<div class="table-responsive">
												<table id="customers-tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
													<thead>
														<tr>
															<th style="width:30px !important;">#</th>
															<th>Công ty</th>
															<th>Tên</th>
															<th>Email</th>
															<th>Điện thoại</th>
															<th>Địa chỉ</th>
														</tr>
													</thead>
													<tbody>
														<!-- BEGIN: customer -->
														<tr>
															<td >{CUSTOMER.number}</td>
															<td>{CUSTOMER.company}</td>
															<td>{CUSTOMER.name}</td>
															<td>{CUSTOMER.email}</td>
															<td>{CUSTOMER.phone}</td>
															<td>{CUSTOMER.address}</td>
														</tr>
														<!-- END: customer -->
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div id="suppliers" class="tab-pane fade in" role="tabpanel">
									<div class="row">
										<div class="col-sm-24">
											<div class="table-responsive">
												<table id="suppliers-tbl" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
													<thead>
														<tr>
															<th style="width:30px !important;">#</th>
															<th>Công ty</th>
															<th>Tên</th>
															<th>Email</th>
															<th>Điện thoại</th>
															<th>Địa chỉ</th>
														</tr>
													</thead>
													<tbody>
														<!-- BEGIN: supplier -->
														<tr>
															<td >{SUPPLIER.number}</td>
															<td>{SUPPLIER.company}</td>
															<td>{SUPPLIER.name}</td>
															<td>{SUPPLIER.email}</td>
															<td>{SUPPLIER.phone}</td>
															<td>{SUPPLIER.address}</td>
														</tr>
														<!-- END: supplier -->
														
													</tbody>
												</table>
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
         </div>
       
         <div class="clearfix"></div>
      </div>
   </div>
</div>
<!-- END: main -->