<!-- BEGIN: main -->
<div class="bocuc  bocuc_41 ">
	<div class="loprong">
		<div class="padding ">
			<div class="bocuc  mauchitietbaiviet_1 bocuc_9  ">
				<div class="loprong">
					<h1 class="header">
						<span class="header_text">{MODULE_NAME}</span>
					</h1>
					<div class="padding ">
						<div class="chucnang_chitiet noidungchitiet">
														
														
							<!-- BEGIN: viewdescription -->
							<div class="news_column">
								<div class="alert alert-info clearfix">
									<h1>{CONTENT.title}</h1>
									<!-- BEGIN: image -->
									<img alt="{CONTENT.title}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail pull-left imghome" />
									<!-- END: image -->
									<p>{CONTENT.description}</p>
								</div>
							</div>
							<!-- END: viewdescription -->
							<!-- BEGIN: viewcatloop -->
							<div class="news_column">
								<!-- BEGIN: featured -->
								<div class="panel panel-default">
									<div class="panel-body featured">
										<!-- BEGIN: image -->
										<a href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}><img  alt="{HOMEIMGALT1}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail pull-left imghome" /></a>
										<!-- END: image -->
										<h2>
											<a href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}>{CONTENT.title}</a>
											<!-- BEGIN: newday --><span class="icon_new">&nbsp;</span><!-- END: newday -->
										</h2>
										<div class="text-muted">
											<ul class="list-unstyled list-inline">
												<li>
													<em class="fa fa-clock-o">&nbsp;</em> {CONTENT.publtime}
												</li>
												<li>
													<em class="fa fa-eye">&nbsp;</em> {LANG.view}: {CONTENT.hitstotal}
												</li>
												<!-- BEGIN: comment -->
												<li>
													<em class="fa fa-comment-o">&nbsp;</em> {LANG.total_comment}: {CONTENT.hitscm}
												</li>
												<!-- END: comment -->
											</ul>
										</div>
										{CONTENT.hometext}
										<!-- BEGIN: adminlink -->
										<p class="text-right">
											{ADMINLINK}
										</p>
										<!-- END: adminlink -->
									</div>
								</div>
								<!-- END: featured -->
								<!-- BEGIN: news -->
								<div class="panel panel-default">
									<div class="panel-body">
										<!-- BEGIN: image -->
										<a href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}><img  alt="{HOMEIMGALT1}" src="{HOMEIMG1}" width="{IMGWIDTH1}" class="img-thumbnail pull-left imghome" /></a>
										<!-- END: image -->
										<h3>
											<a href="{CONTENT.link}" title="{CONTENT.title}" {CONTENT.target_blank}>{CONTENT.title}</a>
											<!-- BEGIN: newday -->
											<span class="icon_new">&nbsp;</span>
											<!-- END: newday -->
										</h3>
										<div class="text-muted">
											<ul class="list-unstyled list-inline">
												<li><em class="fa fa-clock-o">&nbsp;</em> {CONTENT.publtime}</li>
												<li><em class="fa fa-eye">&nbsp;</em> {LANG.view}: {CONTENT.hitstotal}</li>
												<!-- BEGIN: comment -->
												<li><em class="fa fa-comment-o">&nbsp;</em> {LANG.total_comment}: {CONTENT.hitscm}</li>
												<!-- END: comment -->
											</ul>
										</div>
										{CONTENT.hometext}
										<!-- BEGIN: adminlink -->
										<p class="text-right">
											{ADMINLINK}
										</p>
										<!-- END: adminlink -->
									</div>
								</div>
								<!-- END: news -->
							</div>
							<!-- END: viewcatloop -->
							<!-- BEGIN: related -->
							<hr/>
							<h4>{ORTHERNEWS}</h4>
							<ul class="related list-items">
								<!-- BEGIN: loop -->
								<li>
									<em class="fa fa-angle-right">&nbsp;</em><a href="{RELATED.link}" title="{RELATED.title}" {EXTLINK}>{RELATED.title} <em>({RELATED.publtime}) </em></a>
									<!-- BEGIN: newday -->
									<span class="icon_new">&nbsp;</span>
									<!-- END: newday -->
								</li>
								<!-- END: loop -->
							</ul>
							<!-- END: related -->
							<!-- BEGIN: generate_page -->
							<div class="clearfix"></div>
							<div class="text-center">
								{GENERATE_PAGE}
							</div>
							<!-- END: generate_page -->
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: main -->