<!-- BEGIN: main -->
<div class="block_album_tab_new">
	<ul class="nav nav-tabs" role="tablist" id="block_album_tab_new_{BLOCK_ID}">
		<!-- BEGIN: tabs -->
		<li role="presentation">
			<a href="#{TABS.alias}" aria-controls="home" role="tab" data-toggle="tab">{TABS.name_cut}</a>
		</li>
		<!-- END: tabs -->
	</ul>

	<div class="tab-content">
		<!-- BEGIN: tabs_data -->
		<div role="tabpanel" class="tab-pane" id="{TABS.alias}" style="padding: 10px">
			<div class="row">
				<!-- BEGIN: loop -->
				<div class="col-xs-24 col-sm-6 col-md-6" style="margin-bottom: 7px">
					<a href="{DATA.link}" title="{DATA.name}"><img src="{DATA.thumb}" alt="{DATA.name}" class="img-thumbnail" /></a>
				</div>
				<!-- END: loop -->
				<!-- BEGIN: gallery -->
				<div class="col-xs-24 col-sm-6 col-md-6" style="margin-bottom: 7px">
					<a href="{DATA.file}" title="{DATA.name}" data-gallery="gallery-{DATA.album_id}"><img src="{DATA.thumb}" alt="{DATA.name}" class="img-thumbnail" /></a>
				</div>
				<!-- END: gallery -->
			</div>
		</div>
		<!-- END: tabs_data -->
	</div>
</div>
<!-- BEGIN: gallery_template -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/modules/{MODULE_FILE}/plugins/blueimp/blueimp-gallery.min.css">
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
<!-- END: gallery_template -->
<script>
$(window).on('load',function(){
	$('#block_album_tab_new_{BLOCK_ID} a:first').tab('show');
});
</script>
<!-- END: main -->