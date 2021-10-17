/**
 * @Project PHOTOS 4.x
 * @Author KENNYNGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com
 * @License GNU/GPL version 2 or any later version
 * @Createdate 21 Sep 2015 14 : 12 GMT +7
 */

function sendrating_album(album_id, point, checkss) {
	if (point == 1 || point == 2 || point == 3 || point == 4 || point == 5) {
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=rating&nocache=' + new Date().getTime(), 'album_id=' + album_id + '&checkss=' + checkss + '&point=' + point, function(res) {
			$('#stringrating').html(res);
		});
	}
}

function detai_view_next(next_id, view_next){
	$('#detail_viewer').load( nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail_viewer&nocache=' + new Date().getTime(),'&ajax=1&row_id=' + next_id, function() {
		FB.XFBML.parse();
	});
}
function detai_view_pre(pre_id, view_previous){
	$('#detail_viewer').load( nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=detail_viewer&nocache=' + new Date().getTime(),'&ajax=1&row_id=' + pre_id, function() {
		FB.XFBML.parse();
	});
}