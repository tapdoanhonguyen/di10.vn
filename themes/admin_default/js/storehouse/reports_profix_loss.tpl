<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<!-- BEGIN: select_store_id -->
<div class="panel panel-default">
	<div class="panel-body">
		<div class="form-group col-md-24">
			<label class="col-sm-24 col-md-4 "><strong>{LANG.warehouses_at}</strong> <span class="red">(*)</span></label>
			<div class="col-sm-24 col-md-8">
				<select class="form-control" name="store_id" id="store_id">
					<option value="0"> --{LANG.store_main}-- </option>
					<!-- BEGIN: sloop -->
					<option value="{STORE.key}" {STORE.selected}>{STORE.title}</option>
					<!-- END: sloop -->
				</select>
				<input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>
			</div>
		</div>
	</div>
</div>
<!-- END: select_store_id -->
<!-- BEGIN: store_id -->
<input class=" form-control col-md-20" type="hidden" name="store_session" value="{STORE_SESSION}" id="store_session"/>
<!-- END: store_id -->
<!-- BEGIN: view -->
<div class="well">
<h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>{LANG.report_period}  </h2>
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
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="w100" rowspan="1">{LANG.number}</th>
                    <th rowspan="1">{LANG.code}</th>
                    <th rowspan="1">{LANG.name}</th>
					<th colspan="1">{LANG.peroidbg}</th>
                    <th colspan="1">{LANG.purchasesin}</th>
                    <th colspan="1">{LANG.salessin}</th>
                    <th colspan="1">{LANG.peroidend}</th>
                </tr>

            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
                <tr>
                    <td class="text-center" colspan="16">{NV_GENERATE_PAGE}</td>
                </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
                <!-- BEGIN: loop -->
                <tr>
                    <td> {VIEW.number} </td>
                    <td> <a href="{VIEW.link_detail}">{VIEW.code}</a>  </td>
                    <td> {VIEW.name} </td>
                    <td> {VIEW.beginperiod} </td>
                    <td> {VIEW.purchasedqtyin} </td>
                    <td> {VIEW.soldqtyin} </td>
                    <td> {VIEW.endperoid} </td>
                </tr>
                <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- END: view -->
<div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Please view the Profit and/or Loss report and you can select the date range to customized the report.</p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="small-box padding1010 borange">
                                <h4 class="bold">Nh???p h??ng</h4>
                                <i class="icon fa fa-star"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0 Nh???p h??ng </p>

                                <p>0.00 ???? thanh to??n                                    &amp; 0.00 Tax</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box padding1010 bdarkGreen">
                                <h4 class="bold">B??n h??ng</h4>
                                <i class="icon fa fa-heart"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0 B??n h??ng </p>

                                <p>0.00 ???? thanh to??n                                    &amp; 0.00 Tax </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box padding1010 bred">
                                <h4 class="bold">Tr??? v???</h4>
                                <i class="icon fa fa-random"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0 Tr??? v??? </p>

                                <p>0.00 Tax </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="small-box padding1010 bdarkGreen">
                                <h4 class="bold">Thanh to??n ???? nh???n</h4>
                                <i class="icon fa fa-usd"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0 ???? nh???n </p>

                                <p>0.00 Ti???n m???t                                    , 0.00 S??? th??? t??n d???ng                                    , 0.00 S??c                                    , 0.00 Paypal Pro                                    , 0.00 Stripe </p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="small-box padding1010 borange">
                                <h4 class="bold">???? thanh to??n</h4>
                                <i class="icon fa fa-usd"></i>

                                <h3 class="bold">0.00</h3>

                                <p>0 G???i</p>

                                <p>&nbsp;</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="small-box padding1010 bpurple">
                                <h4 class="bold">Chi ph??</h4>
                                <i class="icon fa fa-usd"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0 Chi ph??</p>

                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <div class="small-box padding1010 bred">
                                <h4 class="bold">L???i nhu???n/Chi ph??</h4>
                                <i class="icon fa fa-money"></i>

                                <h3 class="bold">0.00</h3>

                                <p>0.00 B??n h??ng                                    - 0.00 Nh???p h??ng</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box padding1010 bpink">
                                <h4 class="bold">L???i nhu???n/Chi ph??</h4>
                                <i class="icon fa fa-money"></i>

                                <h3 class="bold">0.00</h3>

                                <p>0.00 B??n h??ng                                    - 0.00 Tax                                    - 0.00 Nh???p h??ng </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box padding1010 bblue">
                                <h4 class="bold">L???i nhu???n/Chi ph??</h4>
                                <i class="icon fa fa-money"></i>

                                <h3 class="bold">0.00</h3>

                                <p>(0.00 B??n h??ng                                    - 0.00 Tax) -
                                    (0.00 Nh???p h??ng                                    - 0.00 Tax)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="small-box padding1010 bmGreen">
                                <h4 class="bold">C??c kho???n thanh to??n</h4>
                                <i class="icon fa fa-pie-chart"></i>

                                <h3 class="bold">0.00</h3>

                                <p class="bold">0.00 ???? nh???n                                    - 0.00 refund                                    - 0.00 G???i                                    - 0.00 Chi ph??                                    - 0.00 Tr??? v???                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                                    <div class="col-sm-4">
                        <div class="small-box padding1010 bblue">
                            <h4 class="bold">Warehouse 1 (WHI)</h4>
                            <i class="icon fa fa-money"></i>

                            <h3 class="bold">0.00</h3>

                            <p>
                            B??n h??ng - Nh???p h??ng - Tr??? v???                            </p>
                            <hr style="border-color: rgba(255, 255, 255, 0.4);">
                            <p>
                            0.00 B??n h??ng                                - 0.00 Tax                                = 0.00 net sales                                </p>
                                <p>
                                0.00 Nh???p h??ng                                - 0.00 Tax                                = 0.00 net purchases                                </p>
                                <p>
                                0.00 Tr??? v???                                - 0.00 Tax                                = 0.00 net returns                                </p>
                                <hr style="border-color: rgba(255, 255, 255, 0.4);">

                                <h3 class="bold">0.00</h3>                                <p>
                                net sales - net purchases - net returns                                </p>
                                <hr style="border-color: rgba(255, 255, 255, 0.4);">

                                <h3 class="bold">0.00</h3>                                <p>
                                0 Chi ph??                                </p>

                        </div>
                    </div>
                                    <div class="col-sm-4">
                        <div class="small-box padding1010 bblue">
                            <h4 class="bold">Warehouse 2 (WHII)</h4>
                            <i class="icon fa fa-money"></i>

                            <h3 class="bold">0.00</h3>

                            <p>
                            B??n h??ng - Nh???p h??ng - Tr??? v???                            </p>
                            <hr style="border-color: rgba(255, 255, 255, 0.4);">
                            <p>
                            0.00 B??n h??ng                                - 0.00 Tax                                = 0.00 net sales                                </p>
                                <p>
                                0.00 Nh???p h??ng                                - 0.00 Tax                                = 0.00 net purchases                                </p>
                                <p>
                                0.00 Tr??? v???                                - 0.00 Tax                                = 0.00 net returns                                </p>
                                <hr style="border-color: rgba(255, 255, 255, 0.4);">

                                <h3 class="bold">0.00</h3>                                <p>
                                net sales - net purchases - net returns                                </p>
                                <hr style="border-color: rgba(255, 255, 255, 0.4);">

                                <h3 class="bold">0.00</h3>                                <p>
                                0 Chi ph??                                </p>

                        </div>
                    </div>
                            </div>
        </div> 
    </div>
<!-- END: main -->