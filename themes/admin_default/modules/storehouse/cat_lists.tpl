<!-- BEGIN: main -->
<!-- BEGIN: catnav -->
<div class="divbor1">
	<!-- BEGIN: loop -->
	{CAT_NAV}
	<!-- END: loop -->
</div>
<!-- END: catnav -->
<!-- BEGIN: data -->
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr class="text-center">
				<th class="w100">{LANG.weight}</th>
				<th>{LANG.catalog_name}</th>
				<th class="text-center" class="w250">{LANG.function}</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN: loop -->
			<tr>
				<td class="text-center">
					<select class="form-control" id="id_weight_{ROW.catid}" onchange="nv_chang_cat('{ROW.catid}','weight');">
						<!-- BEGIN: weight -->
						<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.title}</option>
						<!-- END: weight -->
					</select>
				</td>
				<td><a href="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}=categories&amp;parentid={ROW.catid}"> <strong>{ROW.title}</strong> </a> {ROW.numsubcat} </td>



				<td class="text-center">
					
					<i class="fa fa-edit fa-lg">&nbsp;</i><a href="{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}=categories&amp;id={ROW.catid}&amp;parentid={ROW.parentid}#edit">{GLANG.edit}</a>
					&nbsp;
					<i class="fa fa-trash-o fa-lg">&nbsp;</i><a href="{ROW.cat_link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{GLANG.delete}</a>
				</td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
</div>
<!-- END: data -->
<!-- END: main -->