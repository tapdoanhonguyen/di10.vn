<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link rel="stylesheet" href="{NV_BASE_SITEURL}{THEMES_NEWS_CSS}/dataTables.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{NV_BASE_SITEURL}{THEMES_NEWS_CSS}/buttons.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/jszip.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/pdfmake.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/vfs_fonts.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/buttons.html5.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/buttons.print.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/buttons.colVis.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{THEMES_NEWS_JS}/dataTables.export.js"></script>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<!-- BEGIN: view -->

<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.sales}       </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="" data-original-title="T??c v???"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel" >
                        <li>
                            <a href="{link_add}">
                                <i class="fa fa-plus-circle"></i> {LANG.export}                          </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> {LANG.export_excel_sales}                          </a>
                        </li>
                    </ul>
                </li>
                            </ul>
        </div>
    </div>
    <div class="box-content">
		<div class="well">
		<form action="{NV_BASE_ADMINURL}index.php" method="get" id="action-form-submit">
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
		    <input type="hidden" name="form_action" value="" id="form_action"/>
		</form>
		</div>
		<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="get" >
			
		    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
		    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
		    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
		    <input type="hidden" name="page"  value="{page}" />
		    <div class="table-responsive">
		        <table id="PoRData" class="table table-striped table-bordered table-hover">
		            <thead>
		                <tr>
		                    <th class="w100"><input name="check_all[]" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" type="checkbox"></th>
		                    <th>{LANG.reference_no}</th>
		                    <th>{LANG.date}</th>
		                    <th>{LANG.customer_id}</th>
		                    <th>{LANG.warehouse_id}</th>
		                    <th>{LANG.total}</th>
		                    <th>{LANG.paid}</th>
		                    <th>{LANG.status}</th>
		                    <th>{LANG.payment_status}</th>
		                    <th class="w150">&nbsp;</th>
		                </tr>
		            </thead>
		            <!-- BEGIN: generate_page -->
		            <tfoot>
		                <tr>
		                    <td class="text-center" colspan="11">{NV_GENERATE_PAGE}</td>
		                </tr>
		            </tfoot>
		            <!-- END: generate_page -->
		            <tbody>
		                <!-- BEGIN: loop -->
		                <tr>
		                    <td> <input type="checkbox" name="idcheck[]" value="{VIEW.id}" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);"></td>
		                    <td> {VIEW.reference_no} </td>
		                    <td> {VIEW.date} </td>
		                    <td> {VIEW.customer_id} </td>
		                    <td> {VIEW.warehouse_id} </td>
		                    <td> {VIEW.grand_total_fomart} </td>
		                    <td> {VIEW.paid} </td>
		                    <td> {VIEW.status} </td>
		                    <td> {VIEW.payment_status} </td>
		                    <td class="text-center"><i class="fa fa-money fa-lg">&nbsp;</i> <span class="add_payment" sales_id="{VIEW.id}" money="{VIEW.money_nofomart}">{LANG.add_payment}</span> 
		                    	<!-- BEGIN: action --> - <i class="fa fa-print fa-lg">&nbsp;</i> <a href="#" onclick="printExternal('{link_print}')">{LANG.print}</a> - <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a> <!-- END: action -->
		                    	<!-- BEGIN: posaction --> - <i class="fa fa-print fa-lg">&nbsp;</i> <a href="#" onclick="printPos('{link_print}')">{LANG.print}</a> - <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a> <!-- END: posaction -->
		                    </td>
		                </tr>
		                <!-- END: loop -->
		            </tbody>
		        </table>
		    </div>
		    
		</form>
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
        	$(document).on('click','.add_payment', function(){
        		console.log($(this).parent().parent().find("td:nth-child(3)").html());
        		var title = $(this).parent().parent().find("td:nth-child(2)").html();
        		var id = $(this).attr('sales_id');
        		var money = $(this).attr('money');
        		var add_payment= '<form id="submitAddPayment" action="' + nv_base_siteurl  + 'admin/index.php?'+nv_lang_variable +'=' +nv_lang_data+ '&' +nv_name_variable + '=' +nv_module_name + '&' +nv_fc_variable + '=ajax&mod=AddPaymentSales&userid={USERID}&salesid=' + id + '" method="post" >'+
       								'<p>Vui l??ng ??i???n v??o c??c th??ng tin d?????i ????y. C??c m???c ????nh d???u * l?? c??c m???c b???t bu???c ph???i nh???p v??o.</p>'+
        							'<div class="row">' + 
                                    	'<div class="col-sm-12">' + 
                        					'<div class="form-group has-feedback">' + 
                            					'<label for="date">Ng??y *</label>' +
                                                '<input type="text" name="date" value="" class="form-control datetime" id="date" required="required" data-bv-field="date">' +
                                                '<i class="form-control-feedback" data-bv-icon-for="date" style="display: none;"></i>'+
                        					'</div>' +
                    					'</div>'+
                                		'<div class="col-sm-12">'+
                    						'<div class="form-group">'+
                        						'<label for="reference_no">S??? tham chi???u</label>'+
                        						'<input type="text" name="reference_no" value="" class="form-control tip" id="reference_no">'+
                    						'</div>'+
                						'</div>'+
                						'<input type="hidden" value="5" name="purchase_id">'+
            						'</div>'+
            					'<div class="clearfix"></div>'+
					            '<div id="payments">'+
					                '<div class="well well-sm well_1">'+
					                    '<div class="col-md-12">'+
					                        '<div class="row">'+
					                            '<div class="col-sm-12">'+
					                                '<div class="payment">'+
					                                    '<div class="form-group has-feedback">'+
					                                        '<label for="amount_1">S??? l?????ng *</label>'+
					                                        '<input name="amount-paid" type="text" id="amount_1" value="'+money+'" class="pa form-control kb-pad amount" required="required" data-bv-field="amount-paid">'+
					                                        '<i class="form-control-feedback" data-bv-icon-for="amount-paid" style="display: none;"></i>'+
					                                    '</div>'+
					                                '</div>'+
					                            '</div>'+
					                            '<div class="col-sm-12">'+
					                                '<div class="form-group has-feedback">'+
					                                    '<label for="paid_by_1">Thanh to??n b???ng *</label>'+
					                                    '<select name="paid_by" id="paid_by_1" class="form-control paid_by" required="required" data-bv-field="paid_by" tabindex="-1" title="Thanh to??n b???ng *" >'+
													        '<option value="cash">Ti???n m???t</option>'+
													        '<option value="gift_card">Th??? gi???m gi??</option>'+
													        '<option value="CC">Th??? t??n d???ng</option>'+
													        '<option value="Cheque">S??c</option>'+
													        '<option value="other">Kh??ch</option>'+
													     '</select>'+
													     '<i class="form-control-feedback" data-bv-icon-for="paid_by" style="display: none;"></i>'+
                                					'</div>'+
                            					'</div>'+
                       						'</div>'+
                       						'<div class="clearfix"></div>'+
					                        '<div class="pcc_1" style="display:none;">'+
					                            '<div class="row">'+
					                                '<div class="col-md-12">'+
					                                    '<div class="form-group">'+
					                                        '<input name="pcc_no" type="text" id="pcc_no_1" class="form-control" placeholder="S??? th??? t??n d???ng">'+
					                                   ' </div>'+
					                               ' </div>'+
					                                '<div class="col-md-12">'+
					                                    '<div class="form-group">'+
					                                        '<input name="pcc_holder" type="text" id="pcc_holder_1" class="form-control" placeholder="T??n ch??? th???">'+
					                                    '</div>'+
					                                '</div>'+
					                                '<div class="col-md-6">'+
					                                    '<div class="form-group">'+
					                                        '<select name="pcc_type" id="pcc_type_1" class="form-control pcc_type" placeholder="Lo???i th???" tabindex="-1" title="" >'+
					                                            '<option value="Visa">Visa</option>'+
					                                            '<option value="MasterCard">MasterCard</option>'+
					                                            '<option value="Amex">Amex</option>'+
					                                            '<option value="Discover">Discover</option>'+
					                                        '</select>'+
					                                    '</div>'+
					                                '</div>'+
					                                '<div class="col-md-6">'+
					                                    '<div class="form-group">'+
					                                        '<input name="pcc_month" type="text" id="pcc_month_1" class="form-control" placeholder="Th??ng">'+
					                                    '</div>'+
					                                '</div>'+
					                               ' <div class="col-md-6">'+
					                                    '<div class="form-group">'+
					                                        '<input name="pcc_year" type="text" id="pcc_year_1" class="form-control" placeholder="N??m">'+
					                                    '</div>'+
					                                '</div>'+
					                               ' <div class="col-md-6">'+
					                                    '<div class="form-group">'+
					                                        '<input name="pcc_ccv" type="text" id="pcc_cvv2_1" class="form-control" placeholder="CVV2">'+
					                                    '</div>'+
					                                '</div>'+
					                            '</div>'+
					                        '</div>'+
					                        '<div class="pcheque_1" style="display:none;">'+
					                            '<div class="form-group">'+
						                            '<label for="cheque_no_1">S??? s??c</label>'+
						                            '<input name="cheque_no" type="text" id="cheque_no_1" class="form-control cheque_no">'+
					                            '</div>'+
					                        '</div>'+
					                    '</div>'+
					                    '<div class="clearfix"></div>'+
					                '</div>'+
					            '</div>'+
					            '<div class="form-group">'+
					                '<label for="attachment">????nh k??m</label>'+
					                '<span class="file-input file-input-new">'+
										'<div class="input-group ">'+
										   '<div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">'+
										   '<div class="file-caption-name"></div>'+
										'</div>'+
										   '<div class="input-group-btn">'+
										       '<div class="btn btn-primary btn-file">'+
										       		'<i class="fa fa-folder-open"></i> '+
										       		'<input id="attachment" type="file" data-browse-label="Duy???t ..." name="userfile" data-show-upload="false" data-show-preview="false" class="form-control file">'+
										       	'</div>'+
										   '</div>'+
										'</div>'+
									'</span>'+
					            '</div>'+

					            '<div class="form-group">'+
					                '<label for="note">Ghi ch??</label>'+
					                '<textarea name="note" cols="40" rows="10" class="form-control" id="note" dir="ltr" ></textarea></div>'+
					            '</div>'+
								'</form>'+
									'<div id="save_import" class="form-group">'+
										'<div class="col-md-24"><button  class="addpaymentsave" name="save" value="1" >{LANG.add_payment}</button></div>'+
										'<div class="clearfix"></div>'+
									'</div>';
				if(money>0) 
					modalShow('{LANG.add_payment} : ', add_payment);
				else
					modalShow('{LANG.add_payment} : ', '{LANG.add_payment_succesed}');		
        	});
        	$(document).on('click','.addpaymentsave', function(){
				//var form_editcost = $('#submitAddPayment').serialize();
				var $form = $( "#submitAddPayment" ),
				date = $form.find( "input[name='date']" ).val(),
				reference_no = $form.find( "input[name='reference_no']" ).val(),
				paid_by = $form.find( "select[name='paid_by']" ).val(),
				cheque_no = $form.find( "input[name='cheque_no']" ).val(),
				amount = $form.find( "input[name='amount-paid']" ).val(),
				cc_no = $form.find( "input[name='cc_no']" ).val(),
				cc_holder = $form.find( "input[name='cc_holder']" ).val(),
				cc_month = $form.find( "input[name='cc_month']" ).val(),
				cc_year = $form.find( "input[name='cc_year']" ).val(),
				cc_type = $form.find( "input[name='cc_type']" ).val(),
				note = $form.find( "input[name='note']" ).val(),
				url = $form.attr( "action" );
				//console.log(amount);
				var posting = $.post( url, {date: date , reference_no: reference_no, amount: amount, paid_by: paid_by, cheque_no: cheque_no, cc_no: cc_no, cc_holder: cc_holder, cc_month: cc_month, cc_year: cc_year, cc_type: cc_type, note: note});
				// Put the results in a div
				
				posting.done(function( data ) {
					console.log(data);
					if(data == 1){
						$('#sitemodal').modal('hide');
	        			alert('{LANG.add_payment_succes}');
					}else{
						alert("{LANG.add_payment_error}");
					}
					window.location.href = window.location.href;
				});
				
				
														
			});
			$('body').on('click', '#excel', function(e) {
		        e.preventDefault();
		        $('#form_action').val($(this).attr('data-action'));
		        $('#action-form-submit').submit();
		    });
		    
			
        });
        function printExternal(url) {
		    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
		    printWindow.addEventListener('load', function(){
		        printWindow.print();
		        printWindow.close();
		    }, true);
		}
		function printPos(url) {
		    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
		    printWindow.addEventListener('load', function(){
		        printWindow.print();
		        printWindow.close();
		    }, true);
		}
</script>     
<!-- END: view -->

<!-- END: main -->