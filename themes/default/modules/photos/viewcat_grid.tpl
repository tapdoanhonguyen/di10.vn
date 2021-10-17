<!-- BEGIN: main -->
<div id="photo-{OP}">
	<div class="page-header pd10_0 mg0_10_10">
		<h1 class="txt20 txt_bold">{CATALOG.name}</h1>
	</div>
	<div class="panel-body">
		<div class="row">
			<!-- BEGIN: loop_album -->
			<div class="col-xs-24 col-sm-12 col-md-{PER_LINE} col-lg-{PER_LINE} album-album">
				<div class="panel panel-default">
					<div class="album-image panel-body pd5">
						<a title="{ALBUM.name}" href="{ALBUM.link}"> <img class="lazy img-responsive" data-original="{ALBUM.thumb}" data-src="{ALBUM.thumb}" src="{ALBUM.thumb}" alt="{ALBUM.name}" /> </a>
					</div>
					<div class="catalog_content panel-footer view_detail pd5">
						<div class="album-name">
							<h3><a title="{ALBUM.name}" href="{ALBUM.link}">{ALBUM.name}</a></h3>
						</div>
					</div>
				</div>
			</div>
			<!-- END: loop_album -->
		</div>
	</div>
	<hr />
	<!-- BEGIN: social_tool -->
	<div class="social_tool">
		<div class="fb-like"></div>
		<div class="fb-comments" data-href="{SELFURL}" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
	</div>
	<!-- END: social_tool -->

	<!-- BEGIN: generate_page -->
	<div id="generate_page" class="text-center">
		{GENERATE_PAGE}
	</div>
	<!-- END: generate_page -->
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