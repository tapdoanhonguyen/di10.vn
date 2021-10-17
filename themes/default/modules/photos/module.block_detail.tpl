<!-- BEGIN: album -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.pack.js"></script>
<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.MetaData.js" type="text/javascript"></script>
<link href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.css" type="text/css" rel="stylesheet"/>

<div class="photo-detail" id="{BLOCK_ID}">
	<span class="pull-left"><strong>{LANG.album_model}</strong>:&nbsp;</span><h3>{DATA.name}</h3>
	<div class="clear"></div>
	<!-- BEGIN: model -->
	<span class="pull-left"><strong>{LANG.album_model}</strong>:&nbsp;</span><span>{DATA.model}</span>
	<div class="clear"></div>
	<!-- END: model -->
	
	<!-- BEGIN: capturelocal -->
	<span class="pull-left"><strong>{LANG.album_capturelocal}</strong>:&nbsp;</span><span>{DATA.capturelocal}</span>
	<div class="clear"></div>
	<!-- END: capturelocal -->
	
	<!-- BEGIN: capturedate -->
	<span class="pull-left"><strong>{LANG.album_capturedate}</strong>:&nbsp;</span><span>{DATA.capturedate}</span>
	<div class="clear"></div>
	<!-- END: capturedate -->
	<!-- BEGIN: allowed_rating -->
	<div class="panel-body">
		<form id="form3B" action="">
			<div class="h5 clearfix">
				<p>{STRINGRATING}</p>
				<!-- BEGIN: data_rating -->
				<span itemscope itemtype="http://data-vocabulary.org/Review-aggregate">{LANG.rating_average}:
					<span itemprop="rating">{REVIEWCOUNT}</span> -
					<span itemprop="votes">{RATINGCOUNT}</span> {LANG.rating_count}
				</span>
				<!-- END: data_rating -->
				<div style="padding: 5px;">
					<input class="hover-star" type="radio" value="1" title="{LANGSTAR.verypoor}" /><input class="hover-star" type="radio" value="2" title="{LANGSTAR.poor}" /><input class="hover-star" type="radio" value="3" title="{LANGSTAR.ok}" /><input class="hover-star" type="radio" value="4" title="{LANGSTAR.good}" /><input class="hover-star" type="radio" value="5" title="{LANGSTAR.verygood}" /><span id="hover-test" style="margin: 0 0 0 20px;">{LANGSTAR.note}</span>
				</div>
			</div>
		</form>
	</div>
	<script>
	$(function() {
		var sr = 0;
		$(".hover-star").rating({
			focus: function(b, c) {
				var a = $("#hover-test");
				2 != sr && (a[0].data = a[0].data || a.html(), a.html(c.title || "value: " + b), sr = 1)
			},
			blur: function(b, c) {
				var a = $("#hover-test");
				2 != sr && ($("#hover-test").html(a[0].data || ""), sr = 1)
			},
			callback: function(b, c) {
				1 == sr && (sr = 2, $(".hover-star").rating("disable"), sendrating_album("{ALBUM_ID}", b, "{CHECKSS}"))
			}
		});
		$(".hover-star").rating("select", "{NUMBERRATING}");
		<!-- BEGIN: disablerating -->
		$(".hover-star").rating('disable');
		sr = 2;
		<!-- END: disablerating -->
	})
	</script>
	<!-- END: allowed_rating -->
</div>
<!-- END: album -->

<!-- BEGIN: detail -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.pack.js"></script>
<script src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.MetaData.js" type="text/javascript"></script>
<link href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/star-rating/jquery.rating.css" type="text/css" rel="stylesheet"/>

<div class="photo-detail" id="{BLOCK_ID}">
	<span class="pull-left"><strong>{LANG.album_model}</strong>:&nbsp;</span><h3>{DATA.name}</h3>
	<div class="clear"></div>
	<!-- BEGIN: model -->
	<span class="pull-left"><strong>{LANG.album_model}</strong>:&nbsp;</span><span>{DATA.model}</span>
	<div class="clear"></div>
	<!-- END: model -->
	
	<!-- BEGIN: capturelocal -->
	<span class="pull-left"><strong>{LANG.album_capturelocal}</strong>:&nbsp;</span><span>{DATA.capturelocal}</span>
	<div class="clear"></div>
	<!-- END: capturelocal -->
	
	<!-- BEGIN: capturedate -->
	<span class="pull-left"><strong>{LANG.album_capturedate}</strong>:&nbsp;</span><span>{DATA.capturedate}</span>
	<div class="clear"></div>
	<!-- END: capturedate -->
	<!-- BEGIN: allowed_rating -->
	<div class="panel-body">
		<form id="form3B" action="">
			<div class="h5 clearfix">
				<p>{STRINGRATING}</p>
				<!-- BEGIN: data_rating -->
				<span itemscope itemtype="http://data-vocabulary.org/Review-aggregate">{LANG.rating_average}:
					<span itemprop="rating">{REVIEWCOUNT}</span> -
					<span itemprop="votes">{RATINGCOUNT}</span> {LANG.rating_count}
				</span>
				<!-- END: data_rating -->
				<div style="padding: 5px;">
					<input class="hover-star" type="radio" value="1" title="{LANGSTAR.verypoor}" /><input class="hover-star" type="radio" value="2" title="{LANGSTAR.poor}" /><input class="hover-star" type="radio" value="3" title="{LANGSTAR.ok}" /><input class="hover-star" type="radio" value="4" title="{LANGSTAR.good}" /><input class="hover-star" type="radio" value="5" title="{LANGSTAR.verygood}" /><span id="hover-test" style="margin: 0 0 0 20px;">{LANGSTAR.note}</span>
				</div>
			</div>
		</form>
	</div>
	<script>
	$(function() {
		var sr = 0;
		$(".hover-star").rating({
			focus: function(b, c) {
				var a = $("#hover-test");
				2 != sr && (a[0].data = a[0].data || a.html(), a.html(c.title || "value: " + b), sr = 1)
			},
			blur: function(b, c) {
				var a = $("#hover-test");
				2 != sr && ($("#hover-test").html(a[0].data || ""), sr = 1)
			},
			callback: function(b, c) {
				1 == sr && (sr = 2, $(".hover-star").rating("disable"), sendrating_album("{ALBUM_ID}", b, "{CHECKSS}"))
			}
		});
		$(".hover-star").rating("select", "{NUMBERRATING}");
		<!-- BEGIN: disablerating -->
		$(".hover-star").rating('disable');
		sr = 2;
		<!-- END: disablerating -->
	})
	</script>
	<!-- END: allowed_rating -->
</div>
<!-- END: detail -->

<!-- BEGIN: viewcat -->
<ul>
	<li>
		<h4>
		<strong>{LANG.module_info}</strong>
		</h4>
	</li>
	<li>{LANG.album_incat_nums}:&nbsp;{NUM_ALBUMS}</li>
	<li>{LANG.album_incat_topview}:&nbsp;<a href="{DATA.link}" title="{DATA.name}">{DATA.name}</a></li>
</ul>
<!-- END: viewcat -->

<!-- BEGIN: main -->
<ul>
	<li>
		<h4>
		<strong>{LANG.module_info}</strong>
		</h4>
	</li>
	<li>{LANG.category_nums}:&nbsp;{NUM_CATS}</li>
	<li>{LANG.album_nums}:&nbsp;{NUM_ALBUMS}</li>
	<li>{LANG.photo_nums}:&nbsp;{NUM_PHOTOS}</li>

</ul>
<!-- END: main -->