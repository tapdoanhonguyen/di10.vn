<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<input type="hidden" name="id" value="{ROW.id}" />
	<div class="row">
		<div class="col-xs-24 col-sm-24">
			<div class="row">
				<div class="col-xs-24 col-sm-16">
					<div class="panel panel-default">
					<div class="panel-heading">
						{LANG.content}
					</div>
					<div class="panel-body select">
						<textarea class="form-control" style="width:100%; height:100px" name="content">{ROW.content}</textarea>
						<span style="margin-top: 10px; display: block; font-weight: bold">{LANG.content_note}</span>
						<blockquote class="personal">
							<div class="row">
								<!-- BEGIN: personal -->
								<div class="col-xs-24 col-sm-12">
									<label>{PERSONAL.index}</label> {PERSONAL.value}
								</div>
								<!-- END: personal -->
							</div>
						</blockquote>
					</div>
					</div>
				</div>
				<div class="col-xs-24 col-sm-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							{LANG.phone} <em class="fa fa-question-circle fa-pointer text-info" data-toggle="tooltip" data-original-title="{LANG.phonelist_note}">&nbsp;</em>
						</div>
						<div class="panel-body select">
							<textarea class="form-control" name="phonelist" style="height: 130px">{ROW.phonelist}</textarea>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
                            {LANG.begintime}&nbsp;&nbsp;<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.typetime_note}"><em class="fa fa-info-circle fa-pointer text-info">&nbsp;</em></span>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div>
									<!-- BEGIN: typetime -->
									<label><input class="typetime" type="radio" name="typetime" value="{TYPETIME.index}" {TYPETIME.checked} />{TYPETIME.value}</label>&nbsp;
									<!-- END: typetime -->
								</div>
							</div>
							<div class="form-group" id="div-begintime"{ROW.style_begintime}>
								<div class="row m-bottom">
									<div class="col-xs-24 col-sm-12">
										<select name="begintime_hour" class="form-control">
											<option value="0">---{LANG.hour_select}---</option>
											<!-- BEGIN: hour -->
											<option value="{HOUR.index}"{HOUR.selected}>{HOUR.index}</option>
											<!-- END: hour -->
										</select>
									</div>
									<div class="col-xs-24 col-sm-12">
										<select name="begintime_min" class="form-control">
											<option value="0">---{LANG.min_select}---</option>
											<!-- BEGIN: min -->
											<option value="{MIN.index}"{MIN.selected}>{MIN.index}</option>
											<!-- END: min -->
										</select>
									</div>
								</div>
								<div class="input-group">
									<input class="form-control" type="text" name="begintime" value="{ROW.begintimef}" id="begintime" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" /> <span class="input-group-btn">
								<button class="btn btn-default" type="button" id="begintime-btn">
									<em class="fa fa-calendar fa-fix"> </em>
								</button>
							</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group text-center">
		<input class="btn btn-primary loading" name="submit" type="submit" value="{LANG.campaign_add}" />
	</div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
	//<![CDATA[
	$("#begintime").datepicker({
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		showOn : "focus",
		yearRange : "-90:+0",
	});

	$('input.typetime').change(function() {
		if ($(this).val() == 0) {
			$('#div-begintime').hide();
		} else if ($(this).val() == 1) {
			$('#div-begintime').show();
		}
	});

	//]]>
</script>
<!-- END: main -->