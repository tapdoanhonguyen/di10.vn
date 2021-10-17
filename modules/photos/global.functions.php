<?php

/**
 * @Project PHOTOS 4.x
 * @Author KENNY NGUYEN (nguyentiendat713@gmail.com)
 * @Copyright (C) 2015 tradacongnghe.com. All rights reserved
 * @Based on NukeViet CMS
 * @License GNU/GPL version 2 or any later version
 * @Createdate  Fri, 18 Sep 2015 11:52:59 GMT
 */

if( !defined( 'NV_MAINFILE' ) )
	die( 'Stop!!!' );

global $global_photo_cat, $global_photo_album;
//$global_photo_cat
$global_photo_cat = array( );
$sql = 'SELECT * FROM ' . TABLE_PHOTO_NAME . '_category ORDER BY sort_order ASC';
$list = $nv_Cache->db( $sql, 'category_id', $module_name );
foreach( $list as $l )
{
	$global_photo_cat[$l['category_id']] = $l;
	$global_photo_cat[$l['category_id']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $l['alias'];

}
unset( $sql, $list );
//$global_photo_album
$global_photo_album = array( );
$sql = 'SELECT * FROM ' . TABLE_PHOTO_NAME . '_album ORDER BY weight ASC';
$list = $nv_Cache->db( $sql, 'album_id', $module_name );
foreach( $list as $l )
{
	$global_photo_album[$l['album_id']] = $l;
	$global_photo_album[$l['album_id']]['link'] = $global_photo_cat[$l['category_id']]['link'] . '/' . $l['alias'] . '-' . $l['album_id'];

}
unset( $sql, $list );

/**
 * GetCatidInParent()
 *
 * @param mixed $category_id
 * @param integer $check_inhome
 * @return
 */
function GetCatidInParent( $category_id, $check_inhome = 0 )
{
	global $global_photo_cat, $array_cat;
	$array_cat[] = $category_id;
	$subcatid = explode( ',', $global_photo_cat[$category_id]['subcatid'] );
	if( !empty( $subcatid ) )
	{
		foreach( $subcatid as $id )
		{
			if( $id > 0 )
			{
				if( $global_photo_cat[$id]['numsubcat'] == 0 )
				{
					if( !$check_inhome or ($check_inhome and $global_photo_cat[$id]['inhome'] == 1) )
					{
						$array_cat[] = $id;
					}
				}
				else
				{
					$array_cat_temp = GetCatidInParent( $id, $check_inhome );
					foreach( $array_cat_temp as $catid_i )
					{
						if( !$check_inhome or ($check_inhome and $global_photo_cat[$catid_i]['inhome'] == 1) )
						{
							$array_cat[] = $catid_i;
						}
					}
				}
			}
		}
	}
	return array_unique( $array_cat );
}

/**
 * Back-end create thumbs
 * Upload function
 **/
function creatThumb( $file, $dir, $width, $height = 0 )
{

	$image = new NukeViet\Files\Image( $file, NV_MAX_WIDTH, NV_MAX_HEIGHT );

	if( empty( $height ) )
	{
		$image->resizeXY( $width, NV_MAX_HEIGHT );
	}
	else
	{
		if( ($width * $image->fileinfo['height'] / $image->fileinfo['width']) > $height )
		{
			$image->resizeXY( $width, NV_MAX_HEIGHT );
		}
		else
		{
			$image->resizeXY( NV_MAX_WIDTH, $height );
		}

		$image->cropFromCenter( $width, $height );
	}

	// Kiem tra anh ton tai
	$fileName = $width . 'x' . $height . '-' . basename( $file );
	$fileName2 = $fileName;
	$i = 1;
	while( file_exists( $dir . '/' . $fileName2 ) )
	{
		$fileName2 = preg_replace( '/(.*)(\.[a-zA-Z0-9]+)$/', '\1-' . $i . '\2', $fileName );
		++$i;
	}
	$fileName = $fileName2;

	// Luu anh
	$image->save( $dir, $fileName );
	$image->close( );

	return substr( $image->create_Image_info['src'], strlen( $dir . '/' ) );
}

/**
 * photos_thumbs()
 * front-end thumbs create
 *
 */
if( !nv_function_exists( 'photos_thumbs' ) )
{
	function photos_thumbs( $id, $file, $module_upload, $width = 200, $height = 150, $quality = 90 )
	{
		if( $width >= $height )
			$rate = $width / $height;
		else
			$rate = $height / $width;

		$image = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/images/' . $file;

		if( $file != '' and file_exists( $image ) )
		{
			$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/images/' . $file;
			$imginfo = nv_is_image( $image );

			$basename = $module_upload . '_' . $width . 'x' . $height . '-' . $id . '-' . md5_file( $image ) . '.' . $imginfo['ext'];

			if( file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename ) )
			{
				$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename;
			}
			else
			{

				$_image = new NukeViet\Files\Image( $image, NV_MAX_WIDTH, NV_MAX_HEIGHT );

				if( $imginfo['width'] <= $imginfo['height'] )
				{
					$_image->resizeXY( $width, 0 );

				}
				elseif( ($imginfo['width'] / $imginfo['height']) < $rate )
				{
					$_image->resizeXY( $width, 0 );
				}
				elseif( ($imginfo['width'] / $imginfo['height']) >= $rate )
				{
					$_image->resizeXY( 0, $height );
				}

				$_image->cropFromCenter( $width, $height );

				$_image->save( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/', $basename, $quality );

				if( file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename ) )
				{
					$imgsource = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/thumbs/' . $basename;
				}
			}
		}
		elseif( nv_is_url( $file ) )
		{
			$imgsource = $file;
		}
		else
		{
			$imgsource = '';
		}
		return $imgsource;
	}

}
