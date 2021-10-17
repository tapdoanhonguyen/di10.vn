<!-- BEGIN: main -->
<div id="photo-{OP}"> 
	<div class="row">
		<!-- BEGIN: loop_catalog -->
		<div class="row">
			<div class="page-header pd10_0 mg0_10_10">
				<h3 class="txt20 txt_bold"><a href="{CATALOG.link}" class="pull-left" title="{CATALOG.name}">{CATALOG.name}</a></h3>
				<span class="pull-right">
				<!-- BEGIN: subcatloop -->
				<a href="{SUBCAT.link}" title="{SUBCAT.name}">{SUBCAT.name}</a>&nbsp;&nbsp;&nbsp;
				<!-- END: subcatloop -->
				</span>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="panel-body">
			<!-- BEGIN: loop_album -->
				<div class="col-xs-24 col-sm-12 col-md-{PER_LINE} col-lg-{PER_LINE} album-album">
					<div class="panel panel-default">
						<div class="album-image panel-body pd5">
							<a title="{ALBUM.name}" href="{ALBUM.link}">
								<img class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
							</a>
						</div>
						<div class="catalog_content panel-footer view_detail pd5">
							<div class="album-name">
								<h3><a title="{ALBUM.name}" href="{ALBUM.link}">{ALBUM.name}</a></h3>
								<h4>{ALBUM.author_upload}</h4>
							</div>
							<div class="clear"></div>
							<a href="{ALBUM.link}" title="{ALBUM.name}" class="btn btn-primary"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
							<span class="text-muted"><em class="fa fa-eye"></em>&nbsp;{ALBUM.viewed}</span>
						</div>
					</div>
				</div>
			<!-- END: loop_album -->
			</div>
			<div class="clear"></div>
		</div>
		<!-- END: loop_catalog -->
	
		<!-- BEGIN: grid_album -->
		<div class="box-item">
			<!-- BEGIN: catalog_name -->
				<div class="category">
					<h3><a href="{CATALOG.link}" title="{CATALOG.name}">{CATALOG.name}&nbsp;</a></h3>
					<div class="clear"></div> 
				</div>
			<!-- END: catalog_name -->	
			<div class="row">
				<div class="panel-body">
				<!-- BEGIN: loop_album -->
					<div class="col-xs-24 col-sm-12 col-md-{PER_LINE} col-lg-{PER_LINE} album-album">
						<div class="panel panel-default">
							<div class="album-image panel-body pd5">
								<a title="{ALBUM.name}" href="{ALBUM.link}">
									<img class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}"/>
								</a>
							</div>
							<div class="catalog_content panel-footer view_detail pd5">
								<div class="album-name">
									<h3><a title="{ALBUM.name}" href="{ALBUM.link}">{ALBUM.name}</a></h3>
									<h4>{ALBUM.author_upload}</h4>
								</div>
								<div class="clear"></div>
								<a href="{ALBUM.link}" title="{ALBUM.name}" class="btn btn-primary"><i class="fa fa-picture-o"></i>&nbsp;{LANG.view_album}</a>
								<span class="text-muted"><em class="fa fa-eye"></em>&nbsp;{ALBUM.viewed}</span>
							</div>
						</div>
					</div>
				<!-- END: loop_album -->
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- END: grid_album -->
		<!-- BEGIN: generate_page -->
		<div id="generate_page" class="text-center">
			{GENERATE_PAGE}
		</div>
		<!-- END: generate_page -->
	</div> 
</div>
<script type="text/javascript">
$(function() {
    $("img.lazy").lazyload({
	effect : "fadeIn"
	});
});
</script>
<script src="{NV_BASE_SITEURL}themes/default/modules/{MODULE_FILE}/plugins/lazy/jquery.lazyload.min.js" type="text/javascript" ></script>
<!-- END: main -->