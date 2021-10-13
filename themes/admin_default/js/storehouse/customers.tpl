<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.customer}       </h2>

        <div class="box-icon">
        </div>
    </div>
	    <div class="box-content">
			<div class="panel panel-default">
			<div class="panel-body">
			<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
			    <input type="hidden" name="id" value="{ROW.id}" />
			    <input type="hidden" name ="customer_group_id" value="1" />
				<div class="form-group" >
					<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.customer_group_id}</strong> <span class="red">(*)</span></label>
					<div class="col-sm-19 col-md-20">
						<select class="form-control" name="customer_group">
							<!-- BEGIN: select_customer_group_id-->
							<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
							<!-- END: select_customer_group_id -->
						</select>
					</div>
				</div>
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

<!-- BEGIN: customer_add_sales -->

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
    </button>
    <h4 class="modal-title" id="myModalLabel">Thêm khách hàng</h4>
</div>
<form action="/admin/index.php?nv=storehouse&op=ajax&mod=customers_add_save" data-toggle="validator" role="form" id="add-customer-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="token" value="1af4a3f0937c448a2e501dfc0d6b1542" />
	<input type="hidden" name="customer_group" value="1" id="customer_group" />
	<input type="hidden" name="price_group" value="1" id="price_group" />
	<input type="hidden" name="code_customer" value="" id="code" />
        <div class="modal-body">
            <p>Vui lòng điền vào các thông tin dưới đây. Các mục đánh dấu * là các mục bắt buộc phải nhập vào.</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group company">
                        <label for="company">Công ty</label>                        <input type="text" name="company" value=""  class="form-control tip"   id="company" data-bv-notempty="true" />
                    </div>
                    <div class="form-group person">
                        <label for="name">Tên (*)</label>                        <input type="text" name="name" value=""  class="form-control tip" id="name" data-bv-notempty="true" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="vat_no">Số VAT</label>                        <input type="text" name="vat_no" value=""  class="form-control" id="vat_no" />
                    </div>
                    <div class="form-group">
                        <label for="gst_no">gst no</label>                        <input type="text" name="gst_no" value=""  class="form-control" id="gst_no" />
                    </div>
                    <!--<div class="form-group company">
                    <label for="contact_person">Người liên hệ</label>                    <input type="text" name="contact_person" value=""  class="form-control" id="contact_person" data-bv-notempty="true" />
                </div>-->
                    <div class="form-group">
                        <label for="email_address">Địa chỉ Email  (*)</label>                        <input type="email" name="email" class="form-control" required="required" id="email_address"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại</label>                        <input type="tel" name="phone" class="form-control" required="required" id="phone"/>
                    </div>
                    

                </div>
                <div class="col-md-12">
                	<div class="form-group">
                        <label for="address">Địa chỉ</label>                        <input type="text" name="address" value=""  class="form-control" id="address" />
                    </div>
                    <div class="form-group">
                        <label for="city">Tỉnh/TP</label>                        <input type="text" name="city" value=""  class="form-control" id="city"  />
                    </div>
                    <div class="form-group">
                        <label for="state">Huyện</label>                        <input type="text" name="state" value=""  class="form-control" id="state" />
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Mã bưu chính</label>                        <input type="text" name="postal_code" value=""  class="form-control" id="postal_code" />
                    </div>
                    <div class="form-group">
                        <label for="country">Quốc gia</label>                        <input type="text" name="country" value=""  class="form-control" id="country" />
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <input type="button"  id="addCustomer" name="add_customer" value="Thêm khách hàng"  class="btn btn-primary" />
        </div>
</form>

<script type="text/javascript">

    $(document).ready(function (e) {
        $('#addCustomer').on("click", function( event ) {
        	var formJqObj = $('#add-customer-form');
		    var formDataObj = {};
		    (function(){
		        formJqObj.find(":input").not("[type='submit']").not("[type='reset']").each(function(){
		            var thisInput = $(this);
		            formDataObj[thisInput.attr("name")] = thisInput.val();
		        });
		    })();
		    if(formDataObj.name!='' && formDataObj.email!=''){
		    	$.ajax({
		            type: 'post',
		            url: script_name+'?language=vi&nv=storehouse&op=ajax&mod=customers_add_save',
		            dataType: "text",
		            data: formDataObj,
		            success: function (res) {
		            	var data = JSON.parse(res);
		                if(data.result === 'success') {
		                	$("#sitemodal.modal-content").html('').modal();
		                	$('#sitemodal').modal('hide');
		                	$('#sitemodal').modal('hide');
		                    $('.message').addClass('alert').addClass('alert-success').html('').append('<button data-dismiss="alert" class="close" type="button">×</button>' + data.message);//$('#gcerror').text(data.message);
		                    $('.message').show();
		                    $('#customer_id').append('<option value="' + data.id + '" >' + data.title + '</option>');
		                    $('#customer_id').val(data.id).trigger('change');
		                    //location.reload();
		                } else {
		                    $('.message').addClass('alert').addClass('alert-success').html('').append('<button data-dismiss="alert" class="close" type="button">×</button>' + data.message);//$('#gcerror').text(data.message);
		                    $('.message').show();
		                }
		            }
		        });
		    }
			//event.preventDefault();
  			return false;
  		});
    });
</script>

<!-- END: customer_add_sales -->


<!-- BEGIN: customer_add -->

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
    </button>
    <h4 class="modal-title" id="myModalLabel">Thêm khách hàng</h4>
</div>
<form action="/admin/index.php?nv=storehouse&op=ajax&mod=customer_save" data-toggle="validator" role="form" id="add-customer-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<input type="hidden" name="token" value="1af4a3f0937c448a2e501dfc0d6b1542" />
	<input type="hidden" name="customer_group" value="1" id="customer_group" />
	<input type="hidden" name="price_group" value="1" id="price_group" />
	<input type="hidden" name="code_customer" value="" id="code" />
        <div class="modal-body">
            <p>Vui lòng điền vào các thông tin dưới đây. Các mục đánh dấu * là các mục bắt buộc phải nhập vào.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group company">
                        <label for="company">Công ty</label>                        <input type="text" name="company" value=""  class="form-control tip"   id="company" data-bv-notempty="true" />
                    </div>
                    <div class="form-group person">
                        <label for="name">Tên (*)</label>                        <input type="text" name="name" value=""  class="form-control tip" id="name" data-bv-notempty="true" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="vat_no">Số VAT</label>                        <input type="text" name="vat_no" value=""  class="form-control" id="vat_no" />
                    </div>
                    <div class="form-group">
                        <label for="gst_no">gst no</label>                        <input type="text" name="gst_no" value=""  class="form-control" id="gst_no" />
                    </div>
                    <!--<div class="form-group company">
                    <label for="contact_person">Người liên hệ</label>                    <input type="text" name="contact_person" value=""  class="form-control" id="contact_person" data-bv-notempty="true" />
                </div>-->
                    <div class="form-group">
                        <label for="email_address">Địa chỉ Email  (*)</label>                        <input type="email" name="email" class="form-control" required="required" id="email_address"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại</label>                        <input type="tel" name="phone" class="form-control" required="required" id="phone"/>
                    </div>
                    

                </div>
                <div class="col-md-6">
                	<div class="form-group">
                        <label for="address">Địa chỉ</label>                        <input type="text" name="address" value=""  class="form-control" id="address" />
                    </div>
                    <div class="form-group">
                        <label for="city">Tỉnh/TP</label>                        <input type="text" name="city" value=""  class="form-control" id="city"  />
                    </div>
                    <div class="form-group">
                        <label for="state">Huyện</label>                        <input type="text" name="state" value=""  class="form-control" id="state" />
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Mã bưu chính</label>                        <input type="text" name="postal_code" value=""  class="form-control" id="postal_code" />
                    </div>
                    <div class="form-group">
                        <label for="country">Quốc gia</label>                        <input type="text" name="country" value=""  class="form-control" id="country" />
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <input type="submit"  id="addCustomer" name="add_customer" value="Thêm khách hàng"  class="btn btn-primary" />
        </div>
</form>

<script type="text/javascript">

    $(document).ready(function (e) {
        $('#add-customer-form').submit(function( event ) {
        	var formJqObj = $(this);
		    var formDataObj = {};
		    (function(){
		        formJqObj.find(":input").not("[type='submit']").not("[type='reset']").each(function(){
		            var thisInput = $(this);
		            formDataObj[thisInput.attr("name")] = thisInput.val();
		        });
		    })();
		    if(formDataObj.name!='' && formDataObj.email!=''){
		    	$.ajax({
		            type: 'post',
		            url: site.base_url+'index.php?language=vi&nv=storehouse&op=ajax&mod=customers_add_save',
		            dataType: "text",
		            data: formDataObj,
		            success: function (res) {
		            	var data = JSON.parse(res);
		                if(data.result === 'success') {
		                	$("#myModal2C.modal-content").html('').modal();
		                	$('#myModal2C').modal('hide');
		                	$('#myModalC').modal('hide');
		                    $('.message').addClass('alert').addClass('alert-success').html('').append('<button data-dismiss="alert" class="close" type="button">×</button>' + data.message);//$('#gcerror').text(data.message);
		                    $('.message').show();
		                    $('#poscustomer').val(data.id).trigger('change');
		                    location.reload();
		                } else {
		                    $('.message').addClass('alert').addClass('alert-success').html('').append('<button data-dismiss="alert" class="close" type="button">×</button>' + data.message);//$('#gcerror').text(data.message);
		                    $('.message').show();
		                }
		            }
		        });
		    }
			event.preventDefault();
  
  		});
    });
</script>

<!-- END: customer_add -->