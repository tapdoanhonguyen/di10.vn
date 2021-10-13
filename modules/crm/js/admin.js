/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 18 Nov 2014 01:50:26 GMT
 */
 
 function nv_add_otherimage() {
	var newitem = "<tr><td><input class=\"form-control\" value=\"\" name=\"image_file[]\" id=\"image_file_" + file_items + "\" style=\"width : 80%\" maxlength=\"255\" />";
	newitem += "&nbsp;<input type=\"button\" class=\"btn btn-info\" value=\"Browse\" name=\"selectfile\" onclick=\"nv_open_browse( '" + nv_base_adminurl + "index.php?" + nv_name_variable + "=upload&popup=1&area=image_file_" + file_items + "&path=" + file_dir + "&type=file&currentpath=" + file_dir + "', 'NVImg', 850, 400, 'resizable=no,scrollbars=no,toolbar=no,location=no,status=no' ); return false; \" /></td><td><input class=\"form-control\" value=\"\" name=\"image_title[]\" id=\"image_title_" + file_items + "\" style=\"width : 100%\" maxlength=\"255\" /></td><td><input class=\"form-control\" value=\"\" name=\"image_description[]\" id=\"image_description_" + file_items + "\" style=\"width : 100%\" maxlength=\"255\" /></td></tr>";
	$("#add_other_img").append(newitem);
	file_items++;
}
function nv_chang_cat(order_id) {
    if( confirm( nv_is_change_act_confirm[0] ) ){
        var nv_timer = nv_settimeout_disable('id_' + order_id, 5000);
    	var new_vid = $('#id_' + order_id).val();
    	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_order&nocache=' + new Date().getTime(), 'order_id=' + order_id + '&new_vid=' + new_vid, function(res) {
    		alert( res );
            window.location.href=window.location.href;
    		return;
    	});
    	return;   
    }
}
function nv_chang_status(item_id, table, column) {
    if( confirm( nv_is_change_act_confirm[0] ) ){
        var nv_timer = nv_settimeout_disable('id_' + item_id, 5000);
    	var new_vid = $('#id_' + item_id).val();
    	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_status&nocache=' + new Date().getTime(), 'item_id=' + item_id + '&new_vid=' + new_vid + '&column=' + column + '&table=' + table, function(res) {
            window.location.href=window.location.href;
    		return;
    	});
    	return;   
    }
}


function nv_del_block_cat(bid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_block_cat&nocache=' + new Date().getTime(), 'bid=' + bid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				nv_show_list_block_cat();
			} else if (r_split[0] == 'ERR') {
				alert(r_split[1]);
			} else {
				alert(nv_is_del_confirm[2]);
			}
		});
	}
	return false;
}

function nv_chang_block_cat(bid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + bid, 5000);
	var new_vid = $('#id_' + mod + '_' + bid).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=chang_block_cat&nocache=' + new Date().getTime(), 'bid=' + bid + '&mod=' + mod + '&new_vid=' + new_vid, function(res) {
		var r_split = res.split('_');
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		nv_show_list_block_cat();
	});
	return;
}

function nv_show_list_block_cat() {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_block_cat&nocache=' + new Date().getTime());
	}
	return;
}

function nv_chang_block(bid, id, mod) {
	var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
	var new_vid = $('#id_weight_' + id).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_block&nocache=' + new Date().getTime(), 'id=' + id + '&bid=' + bid + '&&mod=' + mod + '&new_vid=' + new_vid, function(res) {
		nv_chang_block_result(res);
	});
	return;
}

function nv_chang_block_result(res) {
	var r_split = res.split('_');
	if (r_split[0] != 'OK') {
		alert(nv_is_change_act_confirm[2]);
	}
	var bid = parseInt(r_split[1]);
	nv_show_list_block(bid);
	return;
}

function nv_show_list_block(bid) {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_block&bid=' + bid + '&nocache=' + new Date().getTime());
	}
	return;
}

function nv_del_block_list(oForm, bid) {
	var del_list = '';
	var fa = oForm['idcheck[]'];
	if (fa.length) {
		for (var i = 0; i < fa.length; i++) {
			if (fa[i].checked) {
				del_list = del_list + ',' + fa[i].value;
			}
		}
	} else {
		if (fa.checked) {
			del_list = del_list + ',' + fa.value;
		}
	}

	if (del_list != '') {
		if (confirm(nv_is_del_confirm[0])) {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_block&nocache=' + new Date().getTime(), 'del_list=' + del_list + '&bid=' + bid, function(res) {
				nv_chang_block_result(res);
			});
		}
	}
}