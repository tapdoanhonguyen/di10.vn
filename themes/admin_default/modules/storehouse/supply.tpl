<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.supplier}       </h2>

        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
		<div class="panel panel-default">
		<div class="panel-body">
		<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
		    <input type="hidden" name="id" value="{ROW.id}" />
		    <input type="hidden" name ="customer_group_id" value="2" />
			<div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.company}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="company" value="{ROW.company}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
			<div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.name_supply}<span class="red">(*)</span></strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="name" value="{ROW.name}"required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		
		     
		
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.vat_no}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="vat_no" value="{ROW.vat_no}" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="address" value="{ROW.address}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.city}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="city" value="{ROW.city}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.state}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="state" value="{ROW.state}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.postal_code}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="postal_code" value="{ROW.postal_code}" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.country}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="country" value="{ROW.country}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="phone" value="{ROW.phone}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="email" value="{ROW.email}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.invoice_footer}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <textarea class="form-control" style="height:100px;" cols="75" rows="5" name="invoice_footer">{ROW.invoice_footer}</textarea>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.logo}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <div class="input-group">
		            <input class="form-control" type="text" name="logo" value="{ROW.logo}" id="id_logo" />
		            <span class="input-group-btn">
		                <button class="btn btn-default selectfile" type="button" >
		                <em class="fa fa-folder-open-o fa-fix">&nbsp;</em>
		            </button>
		            </span>
		        </div>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.gst_no}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="gst_no" value="{ROW.gst_no}" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_user}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input title="{LANG.search_id}" class=" txt" type="text" name="uid" id="uid" value="{ROW.user}" maxlength="11" style="width:50px" />
				    <input class="btn btn-success" name="searchUser" type="button" value="{GLANG.search}" />
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
			
			$("input[name=searchUser]").click(function() {
		        nv_open_browse("{MODULE_URL}=getuserid&area=uid&filtersql={FILTERSQL}", "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		        return false;
		    });
		//]]>
		</script>
		
		</div>
	</div>
</div>
<!-- END: main -->