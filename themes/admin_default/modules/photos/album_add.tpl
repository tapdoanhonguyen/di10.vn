<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/shadowbox/shadowbox.css" />
<div id="content">
    <!-- BEGIN: error_warning -->
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {error_warning}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <br>
    </div>
    <!-- END: error_warning -->
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {CAPTION}</h3>
			<div class="pull-right">
				<button type="submit" data-toggle="tooltip" id="album_save" name="album_save" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button> 
				<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" id="album-add" class="form-horizontal">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab">{LANG.general}</a> </li>
				    <li class="disabled"><a href="#tab-image" rel="tab-image" data-toggle="tab">{LANG.album_image}</a></li>
                    <li class="disabled"><a href="#tab-info-image" rel="tab-info-image" data-toggle="tab">{LANG.album_info_image}</a></li>
                </ul>
				<div class="tab-content">
                     <div class="tab-pane active" id="tab-general">
						<ul class="glt-upload-step clearfix">
								<li class="active">
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">Bước 1: Tạo Album</span>
								</li>
								<li>
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">Bước 2: Chọn và tải ảnh</span>
								</li>
								<li>
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">Bước 3: Cập nhật thông tin ảnh</span>
								</li>
						</ul>
						<div class="form-group required">
							<label class="col-sm-4 control-label" for="input-name">{LANG.album_name}</label>
							<div class="col-sm-20">
								<input type="text" name="name" value="{DATA.name}" placeholder="{LANG.album_name}" id="input-name" class="form-control" />
								<!-- BEGIN: error_name --><div class="text-danger">{error_name}</div><!-- END: error_name -->
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-4 control-label" for="input-alias">{LANG.album_alias}</label>
							<div class="col-sm-20">
								<div class="input-group">
									<input class="form-control" name="alias" placeholder="{LANG.album_alias}"  type="text" value="{DATA.alias}" maxlength="255" id="input-alias"/>
									<div class="input-group-addon fixaddon" data-toggle="tooltip" title="{LANG.create_alias}">
										&nbsp;<em class="fa fa-refresh fa-lg fa-pointer" onclick="get_alias('album',{DATA.album_id});">&nbsp;</em>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group required">
							<label class="col-sm-4 control-label" for="input-folder">{LANG.album_folder}</label>
							<div class="col-sm-20">
								<div class="input-group" rel="folder">
									<input class="form-control" name="folder" placeholder="{LANG.album_folder}" type="text" value="{DATA.folder}" maxlength="255" id="input-folder"/>
									<div class="input-group-addon fixaddon" data-toggle="tooltip" title="{LANG.delete_sign}">
										&nbsp;<em class="fa fa-refresh fa-lg fa-pointer" onclick="get_alias_folder('folder','{DATA.album_id}');">&nbsp;</em>
									</div>
								</div>
								<!-- BEGIN: error_folder--><div class="text-danger">{error_folder}</div><!-- END: error_folder -->
								
							</div>
						</div>
						
						<div class="form-group required">
							<label class="col-sm-4 control-label" for="input-parent">{LANG.album_category}</label>
							<div class="col-sm-20">
								<select class="form-control" name="category_id">
									<option value="0">{LANG.album_category_select}</option>
									<!-- BEGIN: category -->
									<option value="{CATALOG.key}" {CATALOG.selected}>{CATALOG.name}</option>
									<!-- END: category -->
								</select>
								<!-- BEGIN: error_category--><div class="text-danger">{error_category}</div><!-- END: error_category -->
							</div>
						</div>
						
						<div class="form-group">
							 <label class="col-sm-4 control-label" for="input-description">{LANG.album_description} </label>
							<div class="col-sm-20">{edit_description}</div>
						 </div>
						 <div class="form-group">
								<label class="col-sm-4 control-label" for="input-meta-title">{LANG.album_meta_title}</label>
								<div class="col-sm-20">
									<input type="text" name="meta_title" value="{DATA.meta_title}" placeholder="{LANG.album_meta_title}" id="input-meta-title" class="form-control" />
								</div>
						 </div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-meta-description">{LANG.album_meta_description}</label>
							<div class="col-sm-20">
								<textarea name="meta_description" rows="2" placeholder="{LANG.album_meta_description}" id="input-meta-description" class="form-control">{DATA.meta_description}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-meta-keyword">{LANG.album_meta_keyword}</label>
							<div class="col-sm-20">
								<textarea name="meta_keyword" rows="2" placeholder="{LANG.album_meta_keyword}" id="input-meta-keyword" class="form-control">{DATA.meta_keyword}</textarea>
							</div>
						</div>
						<div class="form-group">
								<label class="col-sm-4 control-label" for="input-model">{LANG.album_model}</label>
								<div class="col-sm-20">
									<input type="text" name="model" value="{DATA.model}" placeholder="{LANG.album_model}" id="input-model" class="form-control" />
 								</div>
						</div>
						<div class="form-group">
								<label class="col-sm-4 control-label" for="input-date-album">{LANG.album_capturedate}</label>
								<div class="col-sm-20">
									<input type="text" name="capturedate" value="{DATA.capturedate}" placeholder="{LANG.album_capturedate}" id="input-date-album" class="form-control" maxlength="10"/>
 								</div>
						</div>
						<div class="form-group">
								<label class="col-sm-4 control-label" for="input-capturelocal">{LANG.album_capturelocal}</label>
								<div class="col-sm-20">
									<input type="text" name="capturelocal" value="{DATA.capturelocal}" placeholder="{LANG.album_capturelocal}" id="input-capturelocal" class="form-control" />
 								</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-parent">{LANG.album_layout}</label>
							<div class="col-sm-20">
								<select class="form-control" name="layout">
									<option value="">{LANG.defaults}</option>
									<!-- BEGIN: layout -->
									<option value="{LAYOUT.key}" {LAYOUT.selected}>{LAYOUT.key}</option>
									<!-- END: layout -->
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-keyword"> {GLANG.groups_view}</label>
							<div class="col-sm-20">
								<!-- BEGIN: groups_view -->
								<label><input name="groups_view[]" type="checkbox" value="{GROUPS_VIEW.value}" {GROUPS_VIEW.checked} />{GROUPS_VIEW.title}</label>
								<!-- END: groups_view -->
							</div>
						</div>	 
									 
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-keyword"> {LANG.album_allow_comment}</label>
							<div class="col-sm-20">
								<!-- BEGIN: allow_comment -->
								<label><input name="allow_comment[]" type="checkbox" value="{ALLOW_COMMENT.value}" {ALLOW_COMMENT.checked} />{ALLOW_COMMENT.title}</label>
								<!-- END: allow_comment -->
							</div>
						</div>	 
									 
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-status">{LANG.album_allow_rating}</label>
							<div class="col-sm-20">
								<select name="allow_rating" id="input-allow_rating" class="form-control">
									<!-- BEGIN: allow_rating -->
									<option value="{RATING.key}" {RATING.selected}>{RATING.name}</option>
									<!-- END: allow_rating -->
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="input-status">{LANG.album_show_status}</label>
							<div class="col-sm-20">
								<select name="status" id="input-status" class="form-control">
									<!-- BEGIN: status -->
									<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
									<!-- END: status -->
								</select>
							</div>
						</div>
						
					</div>
				
					<div class="tab-pane" id="tab-image">
							<ul class="glt-upload-step clearfix">
								<li >
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">{LANG.album_step_1}</span>
								</li>
								<li class="active">
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">{LANG.album_step_2}</span>
								</li>
								<li>
									<span class="stepicon"><span>&nbsp;</span></span>
									<span class="steptext">{LANG.album_step_3}</span>
								</li>
							</ul>
							<div class="form-inline">
								<div id="uploader">
									<p>{LANG.album_upload_require}</p>
								</div>
							</div>
							<a href="javascript:void(0);" class="nextstep btn btn-primary">{LANG.album_next_step} </a>
							<link type="text/css" href="{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" />
							<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/plupload.full.min.js"></script>
							<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
							<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/i18n/vi.js"></script>
							<script type="text/javascript">
								$(function() {
 
									$("#uploader").pluploadQueue({
										runtimes: 'html5,flash,silverlight,html4',
										url: '{UPLOAD_URL}',
										<!-- BEGIN: resize_at_browser -->
										resize: {
										  width: {ORIGIN_WIDTH},
										  height: {ORIGIN_HEIGHT}
										},
										<!-- END: resize_at_browser -->
										chunk_size: '{MAXUPLOAD}',
										max_retries: 3,
										rename: false,
										dragdrop: true,
										filters: {
											max_file_size: '{MAXUPLOAD}',
											mime_types: [{
												title: "Image files",
												extensions: "jpg,gif,png,jpeg"
											},{ title : "Zip files", extensions : "zip" },
                                            { title : "MP3 files", extensions : "mp3" }]
										},
										flash_swf_url: '{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/Moxie.swf',
										silverlight_xap_url: '{NV_BASE_SITEURL}themes/admin_default/modules/{MODULE_FILE}/plupload/Moxie.xap',
										multi_selection: true,
										prevent_duplicates: true,
										multiple_queues: false,
										init: {

											FilesAdded: function (up, files) {},
											UploadComplete: function (up, files) {
												//$('.plupload_filelist_footer .plupload_file_name').append('<a href="javascript:void(0);" class="plupload_button plupload_submit nextstep">{LANG.album_next_step}</a>'); 
												$(".plupload_button").css("display", "inline");
												$(".plupload_upload_status").css("display", "inline");
												Shadowbox.init({ skipSetup: true }); Shadowbox.setup(); 
												 
 											}
										}
										   
									});
									var uploader = $("#uploader").pluploadQueue();  
									uploader.bind('BeforeUpload', function(up) {
										 up.settings.multipart_params = {
												'folder': $('input[name="folder"]').val()
										 };
									});
									var i = {num_row};
									uploader.bind('FileUploaded', function(up, file, response) {
										
 										var content = $.parseJSON(response.response).data;
										var item='';		  
										item+='<div id="images-'+ i +'" class="col-sm-12 col-md-6">';
										item+='<div class="table-responsive row">';
										item+='	<table class="table table-striped table-bordered table-hover">';
										item+='		<tbody>';
										item+='			<tr>';
										item+='				<td class="col-md-2">';
										item+='					<input type="hidden" name="albums['+ i +'][row_id]" value="0">';
										item+='					<input type="hidden" name="albums['+ i +'][basename]" value="'+ content['basename'] +'">';
										item+='					<input type="hidden" name="albums['+ i +'][filePath]" value="'+ content['filePath'] +'">';
										item+='					<input type="hidden" name="albums['+ i +'][image_url]" value="'+ content['image_url'] +'">';
										item+='					<input type="hidden" name="albums['+ i +'][thumb]" value="'+ content['thumb'] +'">';
										item+='					<a href="'+ content['image_url'] +'" rel="shadowbox[miss]" class="glt-upload2-thumb">';
										item+='						<span><img src="'+ content['thumb'] +'" width="90"></span>'; 
										item+='					</a>';
										item+='				</td>';
										item+='				<td class="col-md-10 control">';
										item+='					<label class="labelradio"><input type="radio" name="albums['+ i +'][defaults]" value="1" class="form-control fixradio" > {LANG.photo_defaults}</label>';
										item+='					<label class="labelradio fr deleterows" data-toggle="tooltip" title="{LANG.delete}" data-row="'+ content['row_id'] +'" data-token="'+ content['token'] +'" data-token-image="'+ content['token_image'] +'" data-token-thumb="'+ content['token_thumb'] +'" data-key="'+ i +'" >';
										item+='						<i class="fa fa-spinner fa-lg  fa-spin"></i>';
										item+='						<i class="fa fa-trash-o fa-lg fixtrash"></i>';
										item+='					</label>';
										item+='					<input type="text" name="albums['+ i +'][name]" value="' + content['basename'] + '" class="form-control" placeholder="{LANG.photo_name}">';
										item+='					<input type="text" name="albums['+ i +'][description]" value="" class="form-control" placeholder="{LANG.photo_description}">';
										item+='				</td>';
										item+='			</tr>';
										item+='		</tbody>';
										item+='	</table>';
										item+='</div>';
										item+='</div>';
										
										$('#insert-image').append(item);										
										++i;  
										  
									});
									
									uploader.bind("UploadComplete", function () {
										$('.nextstep').css("display", "inline-block");
									});
									
									uploader.bind('QueueChanged', function() {
										$('.nextstep').css("display", "none");
									});
 
								 	
									$('.nextstep').on('click', function(){
										$('a[rel="tab-info-image"]').tab('show'); 
										uploader.splice();
										uploader.refresh();
										uploader.init( );
										$('.plupload_buttons').css("display", "inline");
										$(".plupload_upload_status").css("display", "inline");
									});
								});
							</script>
					</div>
					<div class="tab-pane" id="tab-info-image">
						<ul class="glt-upload-step clearfix">
							<li>
								<span class="stepicon"><span>&nbsp;</span></span>
								<span class="steptext">{LANG.album_step_1}</span>
							</li>
							<li>
								<span class="stepicon"><span>&nbsp;</span></span>
								<span class="steptext">{LANG.album_step_2}</span>
							</li>
							<li class="active">
								<span class="stepicon"><span>&nbsp;</span></span>
								<span class="steptext">{LANG.album_step_3}</span>
							</li>
						</ul>
						<div class="clear"></div>
						<div class="containers">
 							<div class="message_info alert alert-danger" style="display:none">
								<i class="fa fa-exclamation-circle"></i> {LANG.album_error_defaults}
								<button type="button" class="close" data-dismiss="alert">×</button>
								<br>
							</div>
							<div class="row" id="insert-image">
								<!-- BEGIN: photo -->
								<div id="images-{PHOTO.key}" class="col-sm-12 col-md-6">
									<div class="table-responsive row">
										<table class="table table-striped table-bordered table-hover">
											<tbody>
												<tr>
													<td class="col-md-2">
														<input type="hidden" name="albums[{PHOTO.key}][row_id]" value="{PHOTO.row_id}">
														<input type="hidden" name="albums[{PHOTO.key}][basename]" value="{PHOTO.basename}">
														<input type="hidden" name="albums[{PHOTO.key}][filePath]" value="{PHOTO.filePath}">
														<input type="hidden" name="albums[{PHOTO.key}][image_url]" value="{PHOTO.image_url}">
														<input type="hidden" name="albums[{PHOTO.key}][thumb]" value="{PHOTO.thumb}">
														<a href="{PHOTO.image_url}" rel="shadowbox[miss]" class="glt-upload2-thumb"> <span><img src="{PHOTO.thumb}" width="90"></span> </a>
													</td>
													<td class="col-md-10 control">
														<label class="labelradio"><input type="radio" name="albums[{PHOTO.key}][defaults]" value="1" class="form-control fixradio" {PHOTO.defaults}> {LANG.defaults}</label>	
														<label class="labelradio fr deleterows" data-toggle="tooltip" title="{LANG.delete}" data-row="{PHOTO.row_id}" data-token="{PHOTO.token}" data-token-image="{PHOTO.token_image}" data-token-thumb="{PHOTO.token_thumb}" data-key="{PHOTO.key}" >
															<i class="fa fa-spinner fa-lg  fa-spin"></i>
															<i class="fa fa-trash-o fa-lg fixtrash"></i>
														</label>	
														<input type="text" name="albums[{PHOTO.key}][name]" value="{PHOTO.name}" class="form-control" placeholder="{LANG.photo_name}">
														<input type="text" name="albums[{PHOTO.key}][description]" value="{PHOTO.description}" class="form-control" placeholder="{LANG.photo_description}"> </td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>			
								<!-- END: photo -->
							</div>
						</div>
					</div>
				</div>				
				<div align="center">
					<input type="hidden" name ="album_id" value="{DATA.album_id}" />
					<input name="action" type="hidden" value="add" />
					<input name="save" type="hidden" value="1" />
					<!-- <input class="btn btn-primary" type="submit" value="{LANG.save}" /> -->
					<!-- <a class="btn btn-primary" href="{CANCEL}" title="{LANG.cancel}">{LANG.cancel}</a>  -->
				</div>
                     
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/shadowbox/shadowbox.js"></script>
<script type="text/javascript">Shadowbox.init();</script>

<script type="text/javascript">
var album_error_name = '{LANG.album_error_name}';
var album_error_folder = '{LANG.album_error_folder}';
var album_error_category = '{LANG.album_error_category}';
var album_id = '{DATA.album_id}';
var lang_confirm = '{LANG.confirm}';
var lang_check_form = '{LANG.check_form}';
// Calendar */
$('#input-date-album').datepicker({
	showOn : "both",
	dateFormat : "dd/mm/yy",
	changeMonth : true,
	changeYear : true,
	showOtherMonths : true,
	buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
	buttonImageOnly : true
});
</script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/js/photos_footer.js"></script>
<!-- BEGIN: getalias -->
<script type="text/javascript">
$("#input-name").change(function() {
	get_alias('album', {DATA.album_id});
	get_alias_folder('folder', {DATA.album_id});
});
</script>
<!-- END: getalias -->

<script type="text/javascript">
$('a[rel="tab-image"], a[rel="tab-info-image"]').hover( function(e) {	
	return checkform();
});
$('a[rel="tab-image"], a[rel="tab-info-image"], input[type="submit"], button[type="submit"], input[type="text"], select[name="category_id"]').on('click keyup blur change', function(e) {	
	return checkform();
});

$("button[id*='album']").on('click', function() 
{
	var checked = 0;
	$('body .fixradio').each(function() 
	{
		if( $(this).is(':checked') )
		{
			++checked;
		}
	});
	if( checked == 0 )
	{
		$('.message_info').show();
		alert(lang_check_form);
		return false;
	}else
	{
		$('.message_info').hide();
	}
	
	if( checkform() == true )
	{
		$("form[id*='album-']").submit();
	}
});
</script>
<!-- END: main -->