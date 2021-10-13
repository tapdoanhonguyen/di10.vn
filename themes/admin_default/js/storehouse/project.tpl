<!-- BEGIN: main -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.project}       </h2>

        <div class="box-icon">
        </div>
    </div>
	    <div class="box-content">
			<!-- BEGIN: view -->
			<div class="well">
			<form action="{NV_BASE_ADMINURL}index.php" method="get">
			    <input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
			    <input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
			    <input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
			    <div class="row">
			        <div class="col-xs-24 col-md-6">
			            <div class="form-group">
			                <input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
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
			                    <th class="w100">{LANG.number}</th>
			                    <th>{LANG.project_name}</th>
			                    <th>{LANG.customer_id}</th>
			                    <th class="w150">&nbsp;</th>
			                </tr>
			            </thead>
			            <!-- BEGIN: generate_page -->
			            <tfoot>
			                <tr>
			                    <td class="text-center" colspan="8">{NV_GENERATE_PAGE}</td>
			                </tr>
			            </tfoot>
			            <!-- END: generate_page -->
			            <tbody>
			                <!-- BEGIN: loop -->
			                <tr>
			                    <td> {VIEW.number} </td>
			                    <td> {VIEW.title} </td>
			                    <td> {VIEW.customer} </td>
			                    <td class="text-center"> <i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
			                </tr>
			                <!-- END: loop -->
			            </tbody>
			        </table>
			    </div>
			</form>
			<!-- END: view -->
			
			<!-- BEGIN: error -->
			<div class="alert alert-warning">{ERROR}</div>
			<!-- END: error -->
			<div class="panel panel-default">
			<div class="panel-body">
			<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}=project" method="post">
				<!-- BEGIN: customer -->
				<div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_name}</strong> <span class="red">(*)</span></label>
			        <div class="col-sm-19 col-md-20">
			            <select class="form-control" name="customer_id" id="customer_id">
								<!-- BEGIN: select_customer_id -->
								<option value="{CUSTOMER.key}" {CUSTOMER.selected}>{CUSTOMER.title}</option>
								<!-- END: select_customer_id -->
							</select>
			        </div>
			    </div>
			    <!-- END: customer -->
			    <!-- BEGIN: customerinput -->
			    	<input  type="hidden" name="id" value="{ROW.projectid}" />
			    	<input  type="hidden" name="customer_id" value="{ROW.customerid}" />
			    <!-- END: customerinput -->
			    
				<div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.project_name}</strong> <span class="red">(*)</span></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
			        </div>
			    </div>
			    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
			</form>
			</div>
			
			
			<script type="text/javascript">
			//<![CDATA[
			    $(".selectfile").click(function() {
			        var area = "id_logo";
			        var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
			        var currentpath = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
			        var type = "image";
			        nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
			        return false;
			    });
			
			//]]>
			</script>
			
			</div>
	</div>
</div>
<!-- END: main -->