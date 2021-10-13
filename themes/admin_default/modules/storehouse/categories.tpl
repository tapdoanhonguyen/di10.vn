<!-- BEGIN: main2 -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">

<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.categories}       </h2>

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
		                    <th>{LANG.code}</th>
		                    <th>{LANG.name}</th>
		                    <th class="w150">&nbsp;</th>
		                </tr>
		            </thead>
		            <!-- BEGIN: generate_page -->
		            <tfoot>
		                <tr>
		                    <td class="text-center" colspan="4">{NV_GENERATE_PAGE}</td>
		                </tr>
		            </tfoot>
		            <!-- END: generate_page -->
		            <tbody>
		                <!-- BEGIN: loop -->
		                <tr>
		                    <td> {VIEW.number} </td>
		                    <td> {VIEW.code} </td>
		                    <td> {VIEW.name} </td>
		                    <td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}#edit">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
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
		<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
		    <input type="hidden" name="id" value="{ROW.id}" />
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.code}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="code" value="{ROW.code}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.name}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="name" value="{ROW.name}" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.image}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="image" value="{ROW.image}" />
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.parent_id}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <select class="form-control" name="parent_id">
		                <option value=""> --- </option>
		                <!-- BEGIN: select_parent_id -->
		                <option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
		                <!-- END: select_parent_id -->
		            </select>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.alias}</strong> <span class="red">(*)</span></label>
		        <div class="col-sm-19 col-md-18">
		            <input class="form-control" type="text" name="alias" value="{ROW.alias}" id="id_alias" required="required" oninvalid="setCustomValidity(nv_required)" oninput="setCustomValidity('')" />
		        </div>
		        <div class="col-sm-4 col-md-2">
		            <i class="fa fa-refresh fa-lg icon-pointer" onclick="nv_get_alias('id_alias');">&nbsp;</i>
		        </div>
		    </div>
		    <div class="form-group">
		        <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.description}</strong></label>
		        <div class="col-sm-19 col-md-20">
		            <input class="form-control" type="text" name="description" value="{ROW.description}" />
		        </div>
		    </div>
		    <div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
		</form>
		</div></div>
		
		<script type="text/javascript">
		//<![CDATA[
		    function nv_get_alias(id) {
		        var title = strip_tags($("[name='name']").val());
		        if (title != '') {
		            $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=categories&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
		                $("#"+id).val(strip_tags(res));
		            });
		        }
		        return false;
		    }
		//]]>
		</script>
		
	<!-- BEGIN: auto_get_alias -->
	
	<!-- END: auto_get_alias -->
	</div>
</div>
<!-- END: main2 -->

<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<div class="box">
	<div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart"></i>{LANG.categories}       </h2>

        <div class="box-icon">
        </div>
    </div>
	    <div class="box-content">
		<div id="module_show_list">
			{CAT_LIST}
		</div>
		<div id="cat-delete-area">&nbsp;</div>
		<div id="edit" class="table-responsive">
			<!-- BEGIN: error -->
			<div class="alert alert-warning">{error}</div>
			<!-- END: error -->
			<form class="form-inline" action="{FORM_ACTION}" method="post">
				<input type="hidden" name="id" value="{DATA.id}" />
				<input type="hidden" name="parentid_old" value="{DATA.parentid}" />
				<input name="savecat" type="hidden" value="1" />
				<table class="table table-striped table-bordered table-hover">
					<caption>{CAPTION}</caption>
					<tbody>
						<tr>
							<th class="text-right">{LANG.catalog_code}</th>
							<td>
								<input class="form-control" style="width: 500px" name="code" type="text" value="{DATA.code}" maxlength="255" id="idtitle" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
								
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.catalog_name}</th>
							<td>
								<input class="form-control" style="width: 500px" name="title" type="text" value="{DATA.title}" maxlength="255" id="idtitle" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" /><span class="text-middle"> {GLANG.length_characters}: <span id="titlelength" class="red">0</span>. {GLANG.title_suggest_max} </span>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.alias} : </th>
							<td>
								<input class="form-control" style="width: 500px" name="alias" type="text" value="{DATA.alias}" maxlength="255" id="idalias"/>&nbsp; <em class="fa fa-refresh fa-lg fa-pointer" onclick="nv_get_alias('idalias');">&nbsp;</em>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.cat_sub}</th>
							<td>
								<select class="form-control" name="parentid">
									<!-- BEGIN: parent_loop -->
									<option value="{pcatid_i}" {pselect}>{ptitle_i}</option>
									<!-- END: parent_loop -->
								</select>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.subsecondcategory_id}</th>
							<td>
								<div class="col-xs-24 col-sm-24 col-md-24" id="secondcatid">
									<select multiple class="form-control  secondcatid" name="secondcatid[]">
										<!-- BEGIN: secondcat -->
										<option value="{pcatid_i}" data-badge="" {pselect}>{ptitle_i}</option>
										<!-- END: secondcat -->
									</select>
								</div>
								<div id="secondcat_catid"  class="col-xs-24 col-sm-24 col-md-6">
									<select multiple class="form-control  secondcat_id" name="secondcat_id[]">
										
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.description}</th>
							<td>
								<textarea style="width: 500px" name="description" id="description" cols="100" rows="5" class="form-control">{DATA.description}</textarea> <span class="text-middle"> {GLANG.length_characters}: <span id="descriptionlength" class="red">0</span>. {GLANG.description_suggest_max} </span>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.content_homeimg}</th>
							<td>
								<input class="form-control" style="width: 500px" type="text" name="image" id="image" value="{DATA.image}"/>
								<a class="btn btn-info" name="selectimg"><em class="fa fa-folder-open-o">&nbsp;</em>{LANG.file_selectfile}</a>
							</td>
						</tr>
						<tr>
							<th class="text-right">{LANG.content_bodytext}</th>
							<td>
								{DESCRIPTIONHTML}
							</td>
						</tr>
		
					</tbody>
				</table>
		
				
				
		
				<div class="text-center">
					<input class="btn btn-primary" name="submit1" type="submit" value="{LANG.save}"/>
				</div>
			</form>
		</div>
		<style>
			.select2-results__option {
		  padding-right: 20px;
		  vertical-align: middle;
		}
		 .select2-results__option:before {
		  content: "";
		  display: inline-block;
		  position: relative;
		  height: 20px;
		  width: 20px;
		  border: 2px solid #e9e9e9;
		  border-radius: 4px;
		  background-color: #fff;
		  margin-right: 20px;
		  vertical-align: middle;
		}
		 .select2-results__option[aria-selected=true]:before {
		  font-family:fontAwesome;
		  content: "\f00c";
		  color: #fff;
		  background-color: #f77750;
		  border: 0;
		  display: inline-block;
		  padding-left: 3px;
		}
		 .select2-container--default .select2-results__option[aria-selected=true] {
			background-color: #fff !important
		}
		 .select2-container--default .select2-results__option--highlighted[aria-selected] {
			background-color: #eaeaeb !important;
			color: #272727 !important;
		}
		 .select2-container--default .select2-selection--multiple {
			margin-bottom: 10px;
		}
		.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
			border-radius: 4px;
		}
		 .select2-container--default.select2-container--focus .select2-selection--multiple {
			border-color: #f77750;
			border-width: 2px;
		}
		.select2-container--default .select2-selection--multiple {
			border-width: 2px;
		}
		.select2-container--open .select2-dropdown--below {
			
			border-radius: 6px;
			box-shadow: 0 0 10px rgba(0,0,0,0.5);
		
		}
		 .select2-selection .select2-selection--multiple:after {
			content: 'hhghgh';
		}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				$('input[name="cat_allow_point"]').change(function() {
					if($(this).is(":checked"))
					{
						$('input[name="cat_number_point"]').removeAttr('readonly');
						$('input[name="cat_number_product"]').removeAttr('readonly');
					}
					else
					{
						$('input[name="cat_number_point"]').attr('readonly','readonly');
						$('input[name="cat_number_product"]').attr('readonly','readonly');
					}
				});
			});
			
			$("#titlelength").html($("#idtitle").val().length);
			$("#idtitle").bind("keyup paste", function() {
				$("#titlelength").html($(this).val().length);
			});
			
		
			$("#descriptionlength").html($("#description").val().length);
			$("#description").bind("keyup paste", function() {
				$("#descriptionlength").html($(this).val().length);
			});
		
			$("a[name=selectimg]").click(function() {
				var area = "image";
				var path = "{UPLOAD_CURRENT}";
				var currentpath = "{UPLOAD_CURRENT}";
				var type = "image";
				nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
				return false;
			});
			$(".secondcatid").select2({
				closeOnSelect : false,
				placeholder : "{LANG.search_secondcat_main}",
				allowHtml: true,
				allowClear: true,
				tags: true // создает новые опции на лету
			});
			
			nv_load_subcat_catid();
			$('select[name="secondcatid[]"]').change(function(){
				var r_split = $('select[name="secondcatid[]"]').val();
				console.log(r_split);
				nv_load_subcat_catid();
			});
			$('#secondcat_catid').hide();
			function nv_load_subcat_catid()
			{
				var secondcatid = $('select[name="secondcatid[]"]').val();
				var secondcat_id = $('select[name="secondcat_id[]"]').val();
				var r_split = $('select[name="secondcatid[]"]').val();
				if(r_split != ''){
					//$('#secondcat_catid .select2-selection__rendered').html('');
					//$('.secondcat_id').html('<p class="text-center" style="margin-top: 20px"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em></p>').load( script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + "=ajax&mod=load_secondcatid&secondcatid=" + secondcatid + "&secondcat_id=" +  secondcat_id);
					//$('#secondcat_catid').show();
					
				}else{
					//$('.secondcat_id').html('');
					//$('#secondcat_catid').hide();
				}
					
				
				
			}
			$(".secondcat_id").select2({
					closeOnSelect : false,
					placeholder : "{LANG.search_secondcat_sub}",
					allowHtml: true,
					allowClear: true,
					width :"100%",
					tags: true // создает новые опции на лету
				});
		</script>
		<script type="text/javascript">
		//<![CDATA[
		    function nv_get_alias(id) {
		        var title = strip_tags($("[name='title']").val());
		        if (title != '') {
		            $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=categories&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
		                $("#"+id).val(strip_tags(res));
		            });
		        }
		        return false;
		    }
		//]]>
		</script>
		<!-- BEGIN: getalias -->
		
		<script type="text/javascript">
			$("#idtitle").change(function() {
				nv_get_alias('idalias');
			});
		</script>
		<!-- END: getalias -->
	</div>
</div>

<!-- END: main -->
<!-- BEGIN: list_subcat -->
	<!-- BEGIN: subcat -->
	<option value="{pcatid_i}" data-badge="" {pselect}>{ptitle_i}</option>
	<!-- END: subcat -->
<!-- END: list_subcat -->