<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
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
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.reports_suppliers}       </h2>

        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
		<!-- BEGIN: view -->
		<div class="well">
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
		    <div class="table-responsive">
		        <table class="table table-striped table-bordered table-hover">
		            <thead>
		                <tr> 
		                    <th class="w100">{LANG.number}</th>
		                    <th>{LANG.reference_no}</th>
		                    <th>{LANG.date}</th>
		                    <th>{LANG.supplier_id}</th>
		                    <th>{LANG.warehouse_id}</th>
		                    <th>{LANG.total}</th>
		                    <th>{LANG.paid}</th>
		                    <th>{LANG.balance}</th>
		                    <th></th>
		                    
		                </tr>
		            </thead>
		          
		            <tbody>
		                <!-- BEGIN: suppliers -->
		                <tr>
		                    <td> {SUPPLIERS.company} </td>
		                    <td> {SUPPLIERS.name} </td>
		                    <td> {SUPPLIERS.email} </td>
		                    <td> {SUPPLIERS.phone} </td>
		                    <td> {SUPPLIERS.total_format} </td>
		                    <td> {SUPPLIERS.total_amount_format} </td>
		                    <td> {SUPPLIERS.paid_format} </td>
		                    <td> {SUPPLIERS.balance_format} </td>
		                    <td> 
		                    	<a href="{SUPPLIERS.link_view}"><span class="button view_report_{SUPPLIERS.id}">{LANG.view_report} </span></a>
		                    	<script type="ja">
		                    		$(document).on('click','.view_report_{SUPPLIERS.id}', function(){
		                    			$(".view_report_{SUPPLIERS.id}").on("click",function(){
		                    				window.location.href = nv_base_siteurl + '{SUPPLIERS.link_view}';
		                    			});
		                    			
		                    		});
		                    	</script>
		                     </td>
		                    	
		                </tr>
		                <!-- END: suppliers -->
		            </tbody>
		        </table>
		    </div>
		<!-- END: view -->
		<!-- BEGIN: suppliers_view -->
			<div class="row">
			    <div class="col-sm-24">
			        <div class="row">
			            <div class="col-sm-18">
			                <div class="small-box padding1010 col-sm-8 bblue">
			                    <h3>{total_amount}</h3>
			
			                    <p>T???ng ti???n nh???p h??ng</p>
			                </div>
			                <div class="small-box padding1010 col-sm-8 blightOrange">
			                    <h3>{paid}</h3>
			
			                    <p>T???ng thanh to??n</p>
			                </div>
			                <div class="small-box padding1010 col-sm-8 borange">
			                    <h3>{total_paid}</h3>
			
			                    <p>T???ng n???</p>
			                </div>
			            </div>
			            <div class="col-sm-6">
			                <div class="row">
			                    <div class="col-sm-24">
			                        <div class="small-box padding1010 bblue">
			                            <div class="inner clearfix">
			                                <a>
			                                    <h3>{total_purchases}</h3>
			
			                                    <p>T???ng s??? l???n nh???p h??ng</p>
			                                </a>
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
		        	oTable = $('#PoRData').DataTable( {
											"language": {
									            "lengthMenu": "",
									            "zeroRecords": "Xin l???i kh??ng t??m th???y k???t qu???",
									            "info": "Hi???n th??? trang _PAGE_ tr??n _PAGES_ trang",
									            "infoEmpty": "Kh??ng t???n t???i k???t qu???",
									            "infoFiltered": "(t??m trong t???ng s??? _MAX_ k???t qu???)",
												"sSearch":       	"T??m ki???m",
												"oPaginate": {
													"sFirst":    	"?????u",
													"sPrevious": 	"Tr?????c",
													"sNext":     	"Ti???p",
													"sLast":     	"Cu???i"
												}
												
									        },
									        
											dom: 'Bfrtip',
									        buttons: [ {
									            extend: 'copy',
									            text: 'Sao ch??p'
									        },
											{
									            extend: 'excel',
									            text: 'Excel',
												exportOptions: {
													columns: ':visible'
									            }
									        },
											{
									            extend: 'pdf',
									            text: 'Pdf',
												exportOptions: {
													columns: ':visible'
									            }
												
												
									        }
											],
											"ajax": nv_base_siteurl + 'admin/index.php?' + nv_lang_variable + '=' + nv_lang_interface + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&mod=reports_getPurchasesReport&supplier={SUPPLIER_ID}&nocache=' + (new Date).getTime()
									    } );
									    oTable.buttons().container()
									        .appendTo( '#tablelistfriend_wrapper .col-sm-12:eq(0)' );
		        });
		        </script>
			<div class="table-responsive">
		        <table id="PoRData" class="table table-striped table-bordered table-hover">
		            <thead>
		                <tr> 
		                    <th >{LANG.date}</th>
		                    <th>{LANG.reference_no}</th>
		                    <th>{LANG.warehouse_id}</th>
		                    <th>{LANG.supplier_id}</th>
		                    <th>{LANG.warehouse_id}</th>
		                    <th>{LANG.total}</th>
		                    <th>{LANG.paid}</th>
		                    <th>{LANG.status}</th>
		                    
		                </tr>
		            </thead>
		          
		            <tbody>
		                
		            </tbody>
		        </table>
		    </div>
		
		<!-- END: suppliers_view -->
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
		 });
</script>
<!-- END: main -->