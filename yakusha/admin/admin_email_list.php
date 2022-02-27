<?php
/***************************************************************************
 * admin_email_list.php
 ***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['Email_list'] = append_sid($filename);
	return;
}

//
// Load default header
//
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// Generate page
//
$template->set_filenames(array(
	'body' => 'admin/admin_users_email_list_body.tpl')
);

$template->assign_vars(array(
	'L_ADMIN_USERS_LIST_MAIL_TITLE' => $lang['Admin_Users_List_Mail_Title'],
	'L_ADMIN_USERS_LIST_MAIL_EXPLAIN' => $lang['Admin_Users_List_Mail_Explain'],
	'L_USERNAME' => $lang['Usersname'],
	'L_GONDER' => $lang['Gonder'],
	'L_EMAIL' => $lang['Email'])
);

// Count users
$sql = "SELECT user_id FROM ".USERS_TABLE." WHERE user_id > 0";
if(!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Could not count Users", "", __LINE__, __FILE__, $sql);
}
$total_users = $db->sql_numrows($result);
//

$query_result = mysql_query("SELECT username, user_email, user_id FROM ".USERS_TABLE." WHERE user_id > 0 order by username");

while( $row = $db->sql_fetchrow($query_result) )
{
	$userrow[] = $row;
}

for ($i = 0; $i < $total_users; $i++)
{
	if (empty($userrow[$i]))
	{
		break;
	}

	$row_color = (($i % 2) == 0) ? "row1" : "row2";
	
	$template->assign_block_vars('userrow', array(
		'COLOR' => $row_color,
		'NUMBER' => ($start + $i + 1),
		'USERNAME' => $userrow[$i]['username'],
		'POSTA' => "../profile.$phpEx?mode=email&amp;u=".$userrow[$i]['user_id'],
		'EMAIL' => $userrow[$i]['user_email']
		) //end array
	);
} // end for
//  ?mode=email&u=10
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);
?>
