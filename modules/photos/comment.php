<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 21 Jan 2014 01:32:02 GMT
 */

if( !defined( 'NV_MAINFILE' ) )
	die( 'Stop!!!' );

// Cap nhat lai so luong comment duoc kich hoat
$numf = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_comment where module= ' . $db->quote( $row['module'] ) . ' AND id= ' . $row['id'] . ' AND status=1' )->fetchColumn( );
$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $mod_info['module_data'] . '_album SET hitscm=' . $numf . ' WHERE album_id=' . $row['id'];
$db->query( $query );
