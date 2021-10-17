<!-- BEGIN: main -->
<!-- BEGIN: view_grid -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/blueimp/blueimp-gallery.min.css">
<div class="page-header pd10_0 mg0_0_10">
	<h1 class="txt20 txt_bold">{ALBUM.name}</h1>
	<span class="text-muted">{LANG.category}:&nbsp;</span><a href="{CATALOG.link}" title="{CATALOG.name}">{CATALOG.name}</a>
	<span><i class="fa spacer"></i></span>
	<span class="text-muted">{LANG.album_author_upload}: {ALBUM.author_upload}</span>
	<span><i class="fa spacer"></i></span>
	<span class="text-muted">{LANG.viewed}: {ALBUM.viewed}</span>
</div>
<!-- BEGIN: description -->
<hr />
<p class="album_description">{ALBUM.description}</p>
<!-- END: description -->

<div id="album-gallery">
	<div class="row">
	<!-- BEGIN: loop_img -->
	<div class="col-xs-24 col-sm-12 col-md-{PER_LINE} col-lg-{PER_LINE}">
		<div class="panel panel-default">
			<div class="panel-body pd5">
				<a href="{PHOTO.file}" title="{PHOTO.description}" data-gallery="gallery">
					<img class="lazy img-responsive center-block" data-original="{PHOTO.thumb}" src="{PHOTO.thumb}" alt="{PHOTO.name}" width="640" height="480"/>
				</a>
			</div>
			<div class="panel-footer view_detail pd5">
			<span class="text-muted"><em class="fa fa-eye"></em>&nbsp;{PHOTO.viewed}</span>
				<a href="{PHOTO.link_img}" class="btn btn-primary pull-right"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_image}</a>
			</div>
		</div>
	</div>
	<!-- END: loop_img -->
	</div>
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

<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">
$(function() {
    $("img.lazy").lazyload({
	effect : "fadeIn"
	});
});
</script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/lazy/jquery.lazyload.min.js" type="text/javascript" ></script>
<!-- END: view_grid -->

<!-- BEGIN: slider -->
<link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/magicslideshow/magicslideshow.css" type="text/css" rel="stylesheet" media="all" />
<div class="pd5">
	<h1 class="txt20 txt_bold">{ALBUM.name}</h1>
	<ul class="list-inline text-muted">
		<li><em class="fa fa-user">&nbsp;</em>{LANG.album_author_upload}: {ALBUM.author_upload}</li>
		<li><em class="fa fa-eye">&nbsp;</em>{LANG.viewed}: {ALBUM.viewed}</li>
	</ul>
	<!-- BEGIN: description -->
	<hr />
	<p class="album_description">{ALBUM.description}</p>
	<hr />
	<!-- END: description -->
	
	<div class="MagicSlideshow album-{ALBUM.id}" data-options="selectors: bottom; selectors-style: thumbnails; selectors-size: 40px;">
		<!-- BEGIN: loop_slide -->
		<img src="{PHOTO.file}" alt="{ALBUM.name}">
		<!-- END: loop_slide -->
	</div>
 </div>

<!-- END: slider -->

<!-- BEGIN: generate_page -->
<div id="generate_page" class="text-center">
	{GENERATE_PAGE}
</div>
<!-- END: generate_page -->

<!-- BEGIN: social_tool -->
<div class="social_tool pd5">
	<div class="fb-like" data-href="{SELFURL}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">&nbsp;</div>
	<div class="fb-comments" data-href="{SELFURL}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
</div>
<!-- END: social_tool -->

<hr/>
<div class="album_comment pd5">
<!-- BEGIN: comment -->
{CONTENT_COMMENT}
<!-- END: comment -->
</div>

<!-- BEGIN: other_album -->
<div class="page-header pd10_0 mg0_10_10">
	<h4 class="txt20 txt_bold">{LANG.other_album}</h4>
</div>
<div id="other-album" class="row">
	<!-- BEGIN: loop_album -->
	<div class="col-xs-24 col-sm-12 col-md-{PER_LINE} col-lg-{PER_LINE}">
		<div class="panel panel-default">
			<div class="panel-body pd5">
				<a href="{OTHER.link}" title="{OTHER.name}">
					<img class="lazy img-responsive center-block" data-original="{OTHER.thumb}" src="{OTHER.thumb}" alt="{OTHER.name}" width="640" height="480"/>
				</a>
			</div>
			<div class="panel-footer view_detail pd5">
				<div class="album-name">
					<h3><a title="{OTHER.name}" href="{OTHER.link}">{OTHER.name}</a></h3>
				</div>
				<div class="clear"></div>
				<span class="text-muted"><em class="fa fa-eye"></em>&nbsp;{OTHER.viewed}</span>
				<a href="{OTHER.link}" class="btn btn-primary pull-right"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
			</div>
		</div>
	</div>
	<!-- END: loop_album -->
	<div class="clear"></div>
</div>
<!-- END: other_album -->
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/magicslideshow/magicslideshow.js"></script>
<!-- END: main -->