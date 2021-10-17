<!-- BEGIN: main -->
<div class="block_album_tab_new">
	<ul class="nav nav-tabs" role="tablist" id="block_album_tab_new_{BLOCK_ID}">
		<!-- BEGIN: tabs -->
		<li role="presentation">
			<a href="#{TABS.alias}_{BLOCK_ID}" aria-controls="home" role="tab" data-toggle="tab">{TABS.name}</a>
		</li>
		<!-- END: tabs -->
	</ul>

	<div class="tab-content">
		<!-- BEGIN: tabs_data -->
		<div role="tabpanel" class="tab-pane" id="{TABS.alias}_{BLOCK_ID}" style="padding: 10px">
			<div class="row">
				<!-- BEGIN: loop -->
				<div class="col-xs-24 col-sm-6 col-md-6" style="margin-bottom: 7px">
					<div class="m-bottom">
						<a href="{DATA.link}" title="{DATA.name}"><img src="{DATA.thumb}" alt="{DATA.name}" class="img-thumbnail" /></a>
						<a href="{DATA.link}" title="{DATA.name}"><span><strong>{DATA.name_cut}</strong></span></a>
					</div>
				</div>
				<!-- END: loop -->
			</div>
		</div>
		<!-- END: tabs_data -->
	</div>
</div>
<script>
$(window).on('load',function(){
	$('#block_album_tab_new_{BLOCK_ID} a:first').tab('show');
});
</script>
<!-- END: main -->