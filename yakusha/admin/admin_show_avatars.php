<?php
/***************************************************************************
 * admin_show_avatars.php
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['User_avatars'] = $filename;

	return;
}

$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$sql = "SELECT user_id, username, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height
	FROM " . USERS_TABLE . "
	WHERE user_avatar_type != " . USER_AVATAR_NONE . "
	ORDER BY username";

$result = $db->sql_query($sql);
if( !$result )
{
	message_die(GENERAL_ERROR, "Could not obtain avatars from database", '', __LINE__, __FILE__, $sql);
}

$avatars = $db->sql_fetchrowset($result);

$template->set_filenames(array(
	"body" => "admin/admin_show_avatars_body.tpl")
);

$columns=5;
$onrow=0;

for($i = 0; $i < count($avatars); $i = $i + $columns)
{
	$onrow++;
	$row_class = ( !($onrow % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$template->assign_block_vars("avatar_row", array(
		"ROW_CLASS" => $row_class)
	);

	for ( $j = 0; $j < $columns; $j++ )
	{

		$avatar_id = $i + $j;
		if ( $avatars[$avatar_id]['user_avatar'] )
		{
			switch ($avatars[$avatar_id]['user_avatar_type']) {
					case USER_AVATAR_UPLOAD:
						$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $phpbb_root_path . $board_config['avatar_path'] . '/' . $avatars[$avatar_id]['user_avatar'] . '" alt="" border="0" />' : '';
						break;
                		case USER_AVATAR_REMOTE:
                			if ( $board_config['allow_avatar_remote'] )
                			{
                			$avatar_url = $avatars[$avatar_id]['user_avatar'];

                			$avatar_status = check_avatar($avatar_url);
                			if ($avatar_status === FALSE)
                			{
                				$avatar_img  = ( $board_config['allow_avatar_remote'] ) ? '<img src="../images/avatar_yok.gif" alt="" border="0" />' : '';
                			}
                			else if ($avatar_status === TRUE)
                			{
                				if ( ($avatars[$avatar_id]['user_avatar_height'] && $avatars[$avatar_id]['user_avatar_height'] > 0) &&
                				      ($avatars[$avatar_id]['user_avatar_width'] && $avatars[$avatar_id]['user_avatar_width'] > 0) )
                				{
                					 $avatar_img  = '<img src="' . $avatar_url  . '" height="' . $avatars[$avatar_id]['user_avatar_height'] . '" width="' . $avatars[$avatar_id]['user_avatar_width'] . '" alt="" border="0" />';
                				}
                				else  // No width/height in the user's profile
                				{
                					$avatar_img   = '<img src="' . $avatar_url  . '" alt="" border="0" />';
                				}
                			}
                			}
                			else  // remote avatars not allowed
                			$avatar_img  = '';
                                        break;
                                   case USER_AVATAR_GALLERY:
						$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $phpbb_root_path . $board_config['avatar_gallery_path'] . '/' . $avatars[$avatar_id]['user_avatar'] . '" alt="" border="0" />' : '';
						break;
                        }

			if ( $userdata['user_level'] == ADMIN )
			{
				$avatar_img = '<a href="' . append_sid("admin_users.php?mode=edit&amp;" . POST_USERS_URL . "=". $avatars[$avatar_id]['user_id']) . '">'.$avatar_img.'</a>';
			}

			$template->assign_block_vars("avatar_row.avatars", array(
                                "AVATAR_IMG" => $avatar_img,
				"USERNAME" => $avatars[$avatar_id]['username'])
			);
		}
	}
}

$template->pparse("body");
include('./page_footer_admin.'.$phpEx);

?>