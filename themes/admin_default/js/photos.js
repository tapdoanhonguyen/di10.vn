function get_alias(mod, id) {
	var name = strip_tags(document.getElementById('input-name').value);
	if (name != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'name=' + encodeURIComponent(name) + '&mod=' + mod + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('input-alias').value = res;
			} else {
				document.getElementById('input-alias').value = '';
			}
		});
	}
	return false;
}
function get_alias_folder(mod, id) {
	var name = strip_tags(document.getElementById('input-name').value);
	if (name != '') {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=alias&nocache=' + new Date().getTime(), 'name=' + encodeURIComponent(name) + '&mod=' + mod + '&id=' + id, function(res) {
			if (res != "") {
				document.getElementById('input-folder').value = res;
			} else {
				document.getElementById('input-folder').value = '';
			}
		});
	}
	return false;
}

function nv_change_category(category_id, mod) {
	var nv_timer = nv_settimeout_disable('id_'+mod+'_' + category_id, 5000);
	var new_vid = $('#id_'+mod+'_' + category_id).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=category&action='+mod+'&nocache=' + new Date().getTime(), 'category_id=' + category_id + '&new_vid=' + new_vid, function(res) {
		var r_split = res.split("_");
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
			clearTimeout(nv_timer);
		} else {
			window.location.href = window.location.href;
		}
	});
	return;
}

function nv_change_album(album_id, mod) {
	var nv_timer = nv_settimeout_disable('id_'+mod+'_' + album_id, 5000);
	var new_vid = $('#id_'+mod+'_' + album_id).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&action='+mod+'&nocache=' + new Date().getTime(), 'album_id=' + album_id + '&new_vid=' + new_vid, function(res) {
		var r_split = res.split("_");
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
			clearTimeout(nv_timer);
		} else {
			window.location.href = window.location.href;
		}
	});
	return;
}

function delete_album(album_id, token) {
	if(confirm(lang_del_confirm)) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'album_id=' + album_id + '&token=' + token,
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();

				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

function delete_category(category_id, token) {
	if(confirm(lang_del_confirm)) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=category&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'category_id=' + category_id + '&token=' + token,
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();

				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}



$('body').on('click', '.deleterows', function(e) {	
	
	var row_id = $(this).attr('data-row');
	var token = $(this).attr('data-token');
	var token_image = $(this).attr('data-token-image');
	var token_thumb = $(this).attr('data-token-thumb');
	var key = $(this).attr('data-key');
	var thumb = $('input[name="albums['+ key +'][thumb]"]').val();
	var image_url = $('input[name="albums['+ key +'][image_url]"]').val();
	if(confirm(lang_confirm) ) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&action=deleterows&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'album_id=' + album_id + '&row_id=' + row_id + '&token=' + token + '&token_image=' + token_image + '&token_thumb=' + token_thumb + '&thumb=' + thumb + '&image_url=' + image_url,
			beforeSend: function() {
				$('#images-' + key + ' .deleterows .fa-spinner').css('display', 'block');
			},	
			complete: function() {
				$('#images-' + key + ' .fa-spinner').css('display', 'none');
			},
			success: function(json) {
				$('.alert').remove();
				$("html, body").animate({ scrollTop: 0 }, "slow");
				
				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					
					$('#images-' + key).remove();
					
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					
					if( $('input[name="albums['+key+'][defaults]"]' ).is(":checked") )
					{
						$('body .fixradio').get(0).checked = true;
					}else
					{
						var check = 0;
						$('body .fixradio').each(function() 
						{
							 if( $(this).is(":checked") )
							 {
								++check;
							 }
						});
						if( check == 0 )
						{
							$('body .fixradio').get(0).checked = true;
						}
					}
					
				}		
				 
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	} 
});


$('#button-delete').on('click', function() {
	if(confirm(lang_del_confirm)) 
	{
		var listid = [];
		$("input[name=\"selected[]\"]:checked").each(function() {
			listid.push($(this).val());
		});
		if (listid.length < 1) {
			alert(lang_please_select_one);
			return false;
		}
	 
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'listid=' + listid + '&token='+del_token,
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();
 
				if (json['error']) {
					$('#content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}	
});

function checkform()
{
	$('.text-danger').remove();
	var is = true;	
	var name = $('input[name="name"]');	
	if( name.val().length < 3 )
	{		
		name.after('<div class="text-danger">'+album_error_name+'</div>');
		is = false;
	}else
	{
		var ename = $(name).parent().parent();	
		if (ename.hasClass('required')) {
			ename.removeClass('has-error');
		}
	}
	
	var rel_folder = $('div[rel="folder"]');
 	var folder = $('input[name="folder"]');
 	if( $(folder).val().length < 3 )
	{
		$(rel_folder).after('<div class="text-danger">'+album_error_folder+'</div>');
		is = false;
	}else
	{
		var efolder = $(rel_folder).parent().parent();	
		if (efolder.hasClass('required')) {
			efolder.removeClass('has-error');
		}
	}
	
	var category = $('select[name="category_id"]');
	if( category.val() == 0 )
	{
		category.after('<div class="text-danger">'+album_error_category+'</div>');
		is = false;
	}else
	{
		var ecategory = $(category).parent().parent();	
		if (ecategory.hasClass('required')) {
			ecategory.removeClass('has-error');
		}
	}	
	
	$('body .text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
	
	
	if( ! is ) 
	{
		$('a[rel="tab-image"]').parent().addClass('disabled');
		$('a[rel="tab-info-image"]').parent().addClass('disabled');
		return false;
	}else 
	{
		$('.text-danger').remove();
		$('a[rel="tab-image"]').parent().removeClass('disabled');
		$('a[rel="tab-info-image"]').parent().removeClass('disabled');
	}
	return is;
}
$('body').on('click', '.fixradio', function(e) {	
 
	$('body .fixradio').each(function() 
	{
		$(this).prop('checked', false);
	});
	$(this).prop('checked', true);
});

