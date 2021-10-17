<!-- BEGIN: detail_viewer -->
	<div class="col-md-24 col-sm-24 col-xs-24">
		<div class="page-header pd10_0 mg0_10_10">
			<h3 class="txt20 txt_bold"><span>{PHOTO.title}</span></h3>
			<p>{PHOTO.description}</p>
			<span class="text-muted">{LANG.album}:&nbsp;</span><a href="{ALBUM.link}" title="{ALBUM.name}">{ALBUM.name}</a>
			<i class="fa spacer"></i>
			<span class="text-muted">{LANG.viewed}:&nbsp;{PHOTO.viewed}</span>
		</div>
	</div>
	<div id="view_image_{PHOTO.row_id}" class="col-md-24 col-sm-24 col-xs-24">
		<!-- BEGIN: pre -->
		<a href="#" class="arrow_left" title="{PREV.name}" onclick="detai_view_pre('{PREV.row_id}','view_previous');"><i class="fa fa-chevron-circle-left fa-3x"></i></a>
		<!-- END: pre -->
		<div class="col-md-24 col-sm-24 col-xs-24">
			<div id="photo-{PHOTO.row_id}">
				<a href="{PHOTO.file}" title="{PHOTO.title}" data-gallery="gallery">
					<img class="img-responsive center-block" src="{PHOTO.file}" alt="{PHOTO.title}"/>
				</a>
			</div>	
		</div>
		<!-- BEGIN: next -->
		<a href="#" class="arrow_right" title="{NEXT.name}" onclick="detai_view_next('{NEXT.row_id}','view_next');"><i class="fa fa-chevron-circle-right fa-3x"></i></a>
		<!-- END: next -->
	</div>

	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev">‹</a>
		<a class="next">›</a>
		<a class="close">×</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body next"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left prev">
							<i class="fa fa-chevron-left"></i>
							{LANG.view_previous}
						</button>
						<button type="button" class="btn btn-primary next">
							{LANG.view_next}
							<i class="fa fa-chevron-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	$('a[href="#"], a[href=""]').attr("href", "javascript:void(0);");
	var state = '{PHOTO.row_id}';
	var title = 'View Photos';
	var view_url = '{VIEW_URL}';
	window.history.pushState(state, title, view_url);
</script>
<!-- BEGIN: social_tool -->
<div id="social_button" class="col-md-24 col-sm-24 col-xs-24 pd10">
	<div class="fb-like"></div>
	<div class="fb-comments" data-href="{VIEW_URL}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
</div>
<!-- END: social_tool -->
<!-- END: detail_viewer -->

<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/blueimp/blueimp-gallery.min.css">
<div id="fb-root"></div>
<div class="row" id="detail_viewer"></div>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
$('#detail_viewer').load( nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail_viewer&ajax=1&row_id={PHOTO.row_id}' );
</script>

<noscript>
<div class="row">
	<div class="col-md-24 col-sm-24 col-xs-24">
		<div class="page-header pd10_0 mg0_10_10">
			<h3 class="txt20 txt_bold"><span class="pd5">{PHOTO.name}</span></h3>
			<span class="pd5 text-muted"><em class="fa fa-eye"></em> {PHOTO.viewed}</span>
		</div>
	</div>
	<div id="view_image_{PHOTO.row_id}" class="col-md-24 col-sm-24 col-xs-24">
		<!-- BEGIN: pre -->
		<a href="{PREV.link}" class="arrow_left" title="{PREV.name}"><i class="fa fa-chevron-circle-left fa-3x"></i></a>
		<!-- END: pre -->
		<div class="col-md-24 col-sm-24 col-xs-24">
			<div id="photo-{PHOTO.row_id}">
				<a href="{PHOTO.file}" title="{PHOTO.name}" data-gallery="gallery">
					<img alt="{PHOTO.name}" title="{PHOTO.name}" src="{PHOTO.file}" class="img-thumbnail"/>
				</a>
			</div>	
		</div>
		<!-- BEGIN: next -->
		<a href="{NEXT.link}" class="arrow_right" title="{NEXT.name}"><i class="fa fa-chevron-circle-right fa-3x"></i></a>
		<!-- END: next -->
	</div>
</div>
</noscript>
<!-- END: main -->