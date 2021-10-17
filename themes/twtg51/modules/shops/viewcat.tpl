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
																	
							
							<div class="viewcat shops-cat-page shops-cat-page-{MODULE_NAME}" id="category">
								<div class="page-header">
									<h1>{CAT_NAME} ({COUNT} {LANG.title_products})</h1>
									<!-- BEGIN: viewdescriptionhtml -->
									<!-- BEGIN: image -->
									<div class="text-center margin-bottom margin-top">
										<img src="{IMAGE}" class="img-thumbnail" alt="{CAT_NAME}">
									</div>
									<!-- END: image -->
									<div class="margin-bottom">
										{DESCRIPTIONHTML}
									</div>
									<!-- END: viewdescriptionhtml -->
								</div>
								<!-- BEGIN: displays -->
								<div class="form-group text-right s-cat-fillter">
									<select name="sort" id="sort" class="form-control input-sm d-inline-block" onchange="nv_chang_price();">
										<!-- BEGIN: sorts -->
										<option value="{key}"{se}>{value}</option>
										<!-- END: sorts -->
									</select>
									<!-- BEGIN: viewtype -->
									<div class="viewtype d-inline-block">
										<span class="pointer {VIEWTYPE.active}" onclick="nv_chang_viewtype('{VIEWTYPE.index}');" title="{VIEWTYPE.title}"><i class="fa fa-{VIEWTYPE.icon} fa-lg"></i></span>
									</div>
									<!-- END: viewtype -->
								</div>
								<!-- END: displays -->
								<div id="shops-content">
									{CONTENT}
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: main -->


