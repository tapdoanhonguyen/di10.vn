<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.companies}       </h2>

        <div class="box-icon">
        </div>
    </div>
	    <div class="box-content">
			<div class="panel panel-default">
			<div class="panel-body">
			<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
			    <input type="hidden" name="id" value="{ROW.id}" />
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.group_id}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="group_id" value="{ROW.group_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.group_name}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="group_name" value="{ROW.group_name}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_group_id}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <select class="form-control" name="customer_group_id">
			                <option value=""> --- </option>
			                <!-- BEGIN: select_customer_group_id -->
			                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
			                <!-- END: select_customer_group_id -->
			            </select>
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.name}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="name" value="{ROW.name}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.company}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="company" value="{ROW.company}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.vat_no}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="vat_no" value="{ROW.vat_no}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="address" value="{ROW.address}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.city}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="city" value="{ROW.city}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.state}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="state" value="{ROW.state}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.postal_code}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="postal_code" value="{ROW.postal_code}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.country}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="country" value="{ROW.country}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="phone" value="{ROW.phone}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="email" value="{ROW.email}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf1}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf1" value="{ROW.cf1}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf2}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf2" value="{ROW.cf2}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf3}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf3" value="{ROW.cf3}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf4}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf4" value="{ROW.cf4}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf5}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf5" value="{ROW.cf5}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.cf6}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="cf6" value="{ROW.cf6}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.invoice_footer}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <textarea class="form-control" style="height:100px;" cols="75" rows="5" name="invoice_footer">{ROW.invoice_footer}</textarea>
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.payment_term}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="payment_term" value="{ROW.payment_term}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
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
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.award_points}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="award_points" value="{ROW.award_points}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.deposit_amount}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="deposit_amount" value="{ROW.deposit_amount}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price_group_id}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="price_group_id" value="{ROW.price_group_id}" pattern="^[0-9]*$"  oninvalid="setCustomValidity(nv_digits)" oninput="setCustomValidity('')" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.price_group_name}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="price_group_name" value="{ROW.price_group_name}" />
			        </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.gst_no}</strong></label>
			        <div class="col-sm-19 col-md-20">
			            <input class="form-control" type="text" name="gst_no" value="{ROW.gst_no}" />
			        </div>
			    </div>
			    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
			</form>
			</div></div>
			
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

<!-- END: main -->