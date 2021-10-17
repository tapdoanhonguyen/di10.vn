<!-- BEGIN: main -->
<div id="content"> 
	<!-- BEGIN: catnav -->
	<div class="divbor1" style="margin-bottom: 10px">
		<!-- BEGIN: loop -->
		{CAT_NAV}
		<!-- END: loop -->
	</div>
	<!-- END: catnav -->
	<!-- BEGIN: success -->
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> {SUCCESS}
		</div>
	<!-- END: success -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-list"></i> {LANG.category_list}</h3> 
			 <div class="pull-right">
				<a href="{ADD_NEW}" data-toggle="tooltip" data-placement="top" title="{LANG.add_new}" class="btn btn-success"><i class="fa fa-plus"></i></a>
				<button type="button" data-toggle="tooltip" data-placement="top" title="{LANG.delete}" class="btn btn-danger" id="button-delete">
					<i class="fa fa-trash-o"></i>
				</button>
			</div>
			<div style="clear:both"></div>
		</div>
		<!-- BEGIN: require_cate -->
		<p class="text-info text-center"><strong>{REQUIRE_CATE}</strong></p>
		<!-- END: require_cate -->
		<!-- BEGIN: show_cate -->
		<div class="panel-body">
			<form action="#" method="post" enctype="multipart/form-data" id="form-category">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="col-md-2 text-center" style="width:80px" ><strong><a href="{URL_WEIGHT}">{LANG.weight}</a></strong></td>
								<td class="col-md-8 text-left"><strong><a href="{URL_NAME}">{LANG.category_name}</a></strong></td>
								<td class="col-md-2 text-center"> <strong>{LANG.category_inhome} </strong></td>
								<td class="col-md-2 text-center"> <strong>{LANG.category_status} </strong></td>
								<td class="col-md-5 text-center"> <strong>{LANG.category_viewcat} </strong></td>
								<td class="col-md-2 text-center"> <strong>{LANG.category_numlinks} </strong></td>
								<td class="col-md-3 text-center"> <strong>{LANG.action} </strong></td>
							</tr>
						</thead>
						<tbody>
							 <!-- BEGIN: loop --> 
							<tr id="group_{LOOP.category_id}">
								<td class="text-center">
									<select id="id_weight_{LOOP.category_id}" onchange="nv_change_category('{LOOP.category_id}','weight');" class="form-control">
									<!-- BEGIN: weight -->
									<option value="{WEIGHT.w}"{WEIGHT.selected}>{WEIGHT.w}</option>
									<!-- END: weight -->
									</select>
								</td>
								<td class="text-left"><a href="{LOOP.link}"> <strong>{LOOP.name}</strong> </a> {LOOP.numsubcat}</td>
								<td class="text-center">
									<select class="form-control" id="id_inhome_{LOOP.category_id}" onchange="nv_change_category('{LOOP.category_id}','inhome');">
										<!-- BEGIN: inhome -->
										<option value="{INHOME.value}"{INHOME.selected}>{INHOME.title}</option>
										<!-- END: inhome -->
									</select>
								</td>
								
								<td class="text-center">
									<select class="form-control" id="id_status_{LOOP.category_id}" onchange="nv_change_category('{LOOP.category_id}','status');">
										<!-- BEGIN: status -->
										<option value="{STATUS.value}"{STATUS.selected}>{STATUS.title}</option>
										<!-- END: status -->
									</select>
								</td>
								
								<td>
									<select class="form-control" id="id_viewcat_{LOOP.category_id}" onchange="nv_change_category('{LOOP.category_id}','viewcat');">
										<!-- BEGIN: viewcat -->
										<option value="{VIEWCAT.key}"{VIEWCAT.selected}>{VIEWCAT.title}</option>
										<!-- END: viewcat -->
									</select>
								</td>
								<td class="text-center">
										<select class="form-control" id="id_numlinks_{LOOP.category_id}" onchange="nv_change_category('{LOOP.category_id}','numlinks');">
											<!-- BEGIN: numlinks -->
											<option value="{NUMLINKS.key}"{NUMLINKS.selected}>{NUMLINKS.title}</option>
											<!-- END: numlinks -->
										</select>
								</td>
								<td class="text-center">
									<a href="{LOOP.edit}" data-toggle="tooltip" title="{LANG.edit}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
									&nbsp;&nbsp;
									<a href="javascript:void(0);" onclick="delete_category('{LOOP.category_id}', '{LOOP.token}')" data-toggle="tooltip" title="{LANG.delete}" class="btn btn-danger"><i class="fa fa-trash-o"></i>
								
								
								</td>
							</tr>
							 <!-- END: loop -->
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<!-- END: show_cate -->
		<!-- BEGIN: generate_page -->
		<div class="row">
			<div class="col-sm-12 text-left">
			
			<div style="clear:both"></div>
			{GENERATE_PAGE}
			
			</div>
			 
		</div>
		<!-- END: generate_page -->
		<div id="cat-delete-area">&nbsp;</div>
	</div>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/admin_default/js/photos_footer.js"></script>
<script type="text/javascript">
var lang_del_confirm = '{LANG.confirm}';

$('button[type=\'submit\']').on('click', function() {
	$("form[id*='form-']").submit();
});

</script>

<!-- END: main -->