<!-- BEGIN: main -->

<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.config_sms}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-4 text-right"><strong>{LANG.config_sms_on}</strong></label>
				<div class="col-sm-20">
					<input type="checkbox" value="1" name="sms_on" {SMS_ON}/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"><strong>{LANG.apikey}</strong></label>
				<div class="col-sm-20">
					<input type="text" class="form-control" value="{DATA_CONFIG.apikey}" name="apikey" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"><strong>{LANG.secretkey}</strong></label>
				<div class="col-sm-20">
					<input type="text" class="form-control" value="{DATA_CONFIG.secretkey}" name="secretkey" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"><strong>{LANG.config_sms_type}</strong></label>
				<div class="col-sm-20">
					<select class="form-control" name="sms_type">
						<!-- BEGIN: sms_type -->
						<option value="{SMS_TYPE.key}"{SMS_TYPE.selected}>{SMS_TYPE.title}</option>
						<!-- END: sms_type -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label"><strong>{LANG.brandname}</strong></label>
				<div class="col-sm-20">
					<input type="text" class="form-control" value="{DATA_CONFIG.brandname}" name="brandname" />
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.config_bonus}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-4 text-right"><strong>{LANG.bonus}</strong></label>
				<div class="col-sm-20">
					<input type="text" name="bonus" value="{DATA_CONFIG.bonus}" class="form-control" />
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.module_config}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-4 text-right"><strong>{LANG.module}</strong></label>
				<div class="col-sm-20">
					<select style="width:200px ;float:left;margin-right:10px" class="form-control" name="module">
						<option value="0">{LANG.select_mod}</option>
						<!-- BEGIN: mod -->
						<option mod_file="{mod.module_file}" mod_upload="{mod.module_upload}" mod_data="{mod.module_data}" value="{mod.module_data}"  {mod.check}>{mod.custom_title}</option>
						<!-- END: mod -->
					</select>
				</div>
			</div>
		</div>
	</div>
	<input name="submit" class="btn btn-primary" type="submit" value="{LANG.save}" />

</form>

<!-- END: main -->