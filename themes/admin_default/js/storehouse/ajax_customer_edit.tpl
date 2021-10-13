<!-- BEGIN: main -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">×</i>
    </button>
    <h4 class="modal-title" id="myModalLabel2C">{LANG.edit_customer}</h4>
</div>

	<button type="submit" class="bv-hidden-submit" style="display: none;"></button>
    <input type="hidden" name="token" value="1b6a5f46bf02823c20d724687210bcfa">
    <input type="hidden" name="save_custom" value="1">
    <input type="hidden" name="edcustomer_id" value="{ROW.id}">
    <div class="modal-body">
        <p>{LANG.required}</p>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                <label class="control-label" for="customer_group">{LANG.groups_customer} *</label>
                 <select name="customer_group" class="form-control" id="customer_group"  required="required"  title="{LANG.groups_customer} *">
				<option value="1" selected="selected">General</option>
				<option value="2">Reseller</option>
				<option value="3">Distributor</option>
				<option value="4">New Customer (+10)</option>
				</select>
				<i class="form-control-feedback" data-bv-icon-for="customer_group" style="display: none;"></i>
                <small class="help-block" data-bv-validator="notEmpty" data-bv-for="customer_group" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group company has-feedback">
                    <label for="company">{LANG.company} *</label>
                    <input type="text" name="company" value="{ROW.company}" class="form-control tip" id="company" required="required" data-bv-field="company">
                    <i class="form-control-feedback" data-bv-icon-for="company" style="display: none;"></i>
                	<small class="help-block" data-bv-validator="notEmpty" data-bv-for="company" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
                <div class="form-group person has-feedback">
                    <label for="name">{LANG.customer_name} *</label>
                    <input type="text" name="name" value="{ROW.name}" class="form-control tip" id="name" required="required" data-bv-field="name">
                    <i class="form-control-feedback" data-bv-icon-for="name" style="display: none;"></i>
                	<small class="help-block" data-bv-validator="notEmpty" data-bv-for="name" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
                <div class="form-group">
                    <label for="vat_no">{LANG.tax_code}</label>
                    <input type="text" name="vat_no" value="" class="form-control" id="vat_no">
                </div>
                <div class="form-group has-feedback">
                    <label for="email_address">{LANG.email} *</label>
                    <input type="email" name="email" class="form-control" required="required" id="email_address" value="{ROW.email}" data-bv-field="email">
                    <i class="form-control-feedback" data-bv-icon-for="email" style="display: none;"></i>
                	<small class="help-block" data-bv-validator="emailAddress" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.value_email}</small>
                	<small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
                <div class="form-group has-feedback">
                    <label for="phone">{LANG.phone} *</label>
                    <input type="tel" name="phone" class="form-control" required="required" id="phone" value="{ROW.phone}" data-bv-field="phone">
                    <i class="form-control-feedback" data-bv-icon-for="phone" style="display: none;"></i>
                	<small class="help-block" data-bv-validator="notEmpty" data-bv-for="phone" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
                <div class="form-group has-feedback">
                    <label for="address">{LANG.address} *</label>
                    <input type="text" name="address" value="{ROW.address}" class="form-control" id="address" required="required" data-bv-field="address">
                    <i class="form-control-feedback" data-bv-icon-for="address" style="display: none;"></i>
                	<small class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED" style="display: none;">{LANG.select_value}</small>
                </div>
            </div>
        </div>
        

    </div>
    <div class="modal-footer">
        <input type="submit" id="editCustomer" name="edit_customer" value="{LANG.edit_customer}" class="btn btn-primary">
    </div>

<!-- END: main -->