<!-- BEGIN: submenu -->
<div class="menu-cat">
<!-- BEGIN: loop -->
<a href="{SUBMENU.link}" title="{SUBMENU.note}" {SUBMENU.target}>{SUBMENU.title_trim}</a>
<!-- END: loop -->
</div>
<!-- END: submenu -->

<!-- BEGIN: main -->

<div class="text-center">
			<h2 class="section_title_2">
				{BLOCK_TITLE}
			</h2>
		</div>
		<div class="section_content">
		    <div class="wraper">
			<div class="row">
			<!-- BEGIN: top_menu -->
				<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
					<div class="block-item">
						<div class="block-image">
						    <!-- BEGIN: image -->
							<a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>
								<img class="img-responsive lazyload" 
									 src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"  
									 data-src="{TOP_MENU.image}" alt="{TOP_MENU.note}"/>
							</a>
							<!-- END: image -->
						</div>
						<div class="block-content">
							<h3>
								<a href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>
									{TOP_MENU.title_trim}
								</a>
							</h3>
							<!-- BEGIN: sub -->
                           {SUB}
                           <!-- END: sub --> 
						   <a class="view-more" href="{TOP_MENU.link}" title="{TOP_MENU.note}" {TOP_MENU.target}>{LANG.allview}</a>
						</div>
					</div>
				</div>
				<!-- END: top_menu --> 
			</div></div>
		</div>
	

<!-- END: main -->
