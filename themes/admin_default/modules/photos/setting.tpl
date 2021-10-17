<!-- BEGIN: main -->
<div id="content">
	<!-- BEGIN: success -->
		<div class="alert alert-success"><i class="fa fa-check-circle"></i>&nbsp;{SUCCESS}</div>
	<!-- END: success -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i>&nbsp;{LANG.setting}</h3>
            <div class="pull-right">
                <button type="submit" form="form-stock" data-toggle="tooltip" id="photos-setting-save" name="photos-setting-save" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button>
				&nbsp;<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
            </div>
            <div style="clear:both"></div>
        </div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" id="setting-form" class="form-horizontal">
				<input type="hidden" value="1" name="savesetting" />				
				<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
				<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
				<div class="form-group alert alert-info">
					<div class="col-sm-6">{LANG.setting_module_display}</div>
					<div class="col-sm-18">&nbsp;&nbsp;&nbsp;</div>
				</div>

				<div class="form-group">
					<label class="col-sm-6 col-md-6 control-label" style="padding-top: 0px;">{LANG.setting_origin_size}:</label>
					<div class="col-sm-18 col-md-18">
						<input class="form-control w100 pull-left" type="text" value="{DATA.origin_size_width}" name="origin_size_width" maxlength="4"/>
						<span class="pull-left text-middle">&nbsp;x&nbsp;</span>
						<input class="form-control pull-left w100" type="text" value="{DATA.origin_size_height}" name="origin_size_height" maxlength="4"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 col-md-6 control-label" style="padding-top: 0px;">{LANG.setting_cr_thumb_size}:</label>
					<div class="col-sm-18 col-md-18">
						<input class="form-control w50 pull-left" type="text" value="{DATA.cr_thumb_width}" name="cr_thumb_width" maxlength="3"/>
						<span class="pull-left text-middle">&nbsp;x&nbsp;</span><input class="form-control pull-left w50" type="text" value="{DATA.cr_thumb_height}" name="cr_thumb_height" maxlength="3"/>
						<span class="pull-left text-middle">&nbsp;&nbsp;&nbsp;{LANG.setting_cr_thumb_quality}&nbsp;</span> <input class="form-control w50" type="text" value="{DATA.cr_thumb_quality}" name="cr_thumb_quality" maxlength="2"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label" style="padding-top: 0px;">{LANG.setting_home_view}:</label>
					<div class="col-sm-18">
						<select class="form-control" name="home_view">
							<!-- BEGIN: home_view -->
							<option value="{HOME_VIEW.key}" {HOME_VIEW.selected}>{HOME_VIEW.title}</option>
							<!-- END: home_view -->
						</select>	
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 col-md-6 control-label" for="input-parent">{LANG.setting_home_layout}</label>
					<div class="col-md-18">
						<select class="form-control" name="home_layout">
							<option value="">{LANG.defaults}</option>
							<!-- BEGIN: home_layout -->
							<option value="{LAYOUT.key}" {LAYOUT.selected}>{LAYOUT.key}</option>
							<!-- END: home_layout -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label" style="padding-top: 0px;">{LANG.setting_album_view}:</label>
					<div class="col-sm-18">
						<select class="form-control" name="album_view">
							<!-- BEGIN: album_view -->
							<option value="{ALBUM_VIEW.key}" {ALBUM_VIEW.selected}>{ALBUM_VIEW.title}</option>
							<!-- END: album_view -->
						</select>	
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_per_line}:</label>
					<div class="col-sm-18">
						<select class="form-control" name="per_line">
							<!-- BEGIN: per_line -->
							<option value="{PER_LINE.key}" {PER_LINE.selected}>{PER_LINE.title}</option>
							<!-- END: per_line -->
						</select>	
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_per_page_album}:</label>
					<div class="col-sm-18">
						<select class="form-control" name="per_page_album">
							<!-- BEGIN: per_page_album -->
							<option value="{PER_PAGE_ALBUM.key}" {PER_PAGE_ALBUM.selected}>{PER_PAGE_ALBUM.title}</option>
							<!-- END: per_page_album -->
						</select>	
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_per_page_photo}:</label>
					<div class="col-sm-18">
						<select class="form-control" name="per_page_photo">
							<!-- BEGIN: per_page_photo -->
							<option value="{PER_PAGE_PHOTO.key}" {PER_PAGE_PHOTO.selected}>{PER_PAGE_PHOTO.title}</option>
							<!-- END: per_page_photo -->
						</select>		
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_home_title_cut}:</label>
					<div class="col-sm-18">
						<input class="form-control w50 pull-left" type="text" value="{DATA.home_title_cut}" name="home_title_cut" maxlength="3"/>
					</div>
				</div>
				
				<div class="form-group alert alert-info">
					<div class="col-sm-6">{LANG.setting_module_addition}</div>
					<div class="col-sm-18 info">&nbsp;&nbsp;&nbsp;</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_social_tool}:</label>
					<div class="col-sm-18">
						 <input type="checkbox" name="social_tool" value="1" {DATA.social_tool} />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_fbappid}:</label>
					<div class="col-sm-18">
						 <input class="form-control w250 pull-left" type="text" value="{DATA.fbappid}" name="fbappid"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_structure_upload}:</label>
					<div class="col-sm-18">
						<select class="form-control w500" name="structure_upload">
							<!-- BEGIN: structure_upload -->
							<option value="{STRUCTURE_UPLOAD.key}" {STRUCTURE_UPLOAD.selected}>{STRUCTURE_UPLOAD.title}</option>
							<!-- END: structure_upload -->
						</select>		
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_active_logo}:</label>
					<div class="col-sm-18">
						 <input type="checkbox" name="active_logo" value="1" {DATA.active_logo} />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_logo}:</label>
					<div class="col-sm-18">
						<div class="form-inline">
 						<div class="form-group fixgroup" style="margin-left: 0px;">
 							<input class="form-control fixlogo" name="module_logo" id="module_logo" value="{MODULE_LOGO}" maxlength="255" type="text" />
						</div>
						<input class="btn btn-primary fixprimary" value="{GLANG.browse_image}" name="selectimg" type="button" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_autologosize1}:</label>
					<div class="col-sm-18">
						<span class="text-middle pull-left"> {LANG.setting_autologowidth} &nbsp;</span>
						<input type="text" class="form-control w50 pull-left" value="{DATA.autologosize1}" maxlength="2" name="autologosize1"><span class="text-middle">&nbsp; %  </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_autologosize2}:</label>
					<div class="col-sm-18">
						<span class="text-middle pull-left"> {LANG.setting_autologowidth} &nbsp;</span>
						<input type="text" class="form-control pull-left w50" value="{DATA.autologosize2}" maxlength="2" name="autologosize2"/><span class="text-middle pull-left">&nbsp; %  </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_autologosize3}:</label>
					<div class="col-sm-18">
						<span class="text-middle pull-left"> {LANG.setting_autologosample}&nbsp;</span>
						<input type="text" class="form-control pull-left w50" value="{DATA.autologosize3}" maxlength="2" name="autologosize3"/>&nbsp;<span class="text-middle pull-left">&nbsp; %  </span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.upload_logo_pos}:</label>
					<div class="col-sm-5">
						<select class="form-control" name="logo_position">
							<!-- BEGIN: logopos -->
							<option value="{logopos.key}" {logopos.selected}>{logopos.title}</option>
							<!-- END: logopos -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_max_size_upload}:</label>
					<div class="col-sm-18">
						<select class="form-control w250" name="maxupload">
								<!-- BEGIN: size1 -->
								<option value="{SIZE1.key}" {SIZE1.selected}>{SIZE1.title}</option>
								<!-- END: size1 -->
						</select>
						({LANG.setting_sys_max_size}: {SYS_MAX_SIZE})
					</div>
				</div>
			</form>
            <div class="text-center">
                <button type="submit" form="form-stock" data-toggle="tooltip" id="photos-setting-save" name="photos-setting-save" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button>
				&nbsp;<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
            </div>
		</div>
    </div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/js/photos_footer.js"></script>
<script type="text/javascript">
$("button[id*='photos-setting-']").on('click', function() 
{
	$("form[id*='setting-']").submit();
});
$("input[name=selectimg]").click(function(){
	var area = "module_logo";
	var type= "image";
	var path= "{PATH}";
	var currentpath= "{CURRENTPATH}";
	nv_open_browse("{NV_BASE_ADMINURL}index.php?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", "850", "420","resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
	return false;
});
</script>

<!-- END: main -->