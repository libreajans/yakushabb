<?php
/***************************************************************************
* admin_stylewatch.php
***************************************************************************/
define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['Users']['User_Styles'] = $filename;

	return;
}

// Load Page Header
$phpbb_root_path = './../';
$no_page_header = TRUE;
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// OK hier gucken wir zuerst mal welche Themes installiert sind
$tnames = "SELECT themes_id, style_name FROM " . THEMES_TABLE;

if ( !($tres = $db->sql_query($tnames)) )
{
	message_die(GENERAL_ERROR, "Could not query user table", "", __LINE__, __FILE__, $sql);
}

$arnum = 0;

while ( $tthemes = $db->sql_fetchrow($tres) )
{
	$themelist[$arnum][0] = $tthemes['themes_id'];
	$themelist[$arnum][1] = $tthemes['style_name'];
	$arnum++;
}


$superstring = '';
$tsql = "SELECT user_id, username,user_style FROM " . USERS_TABLE . " where user_style > 0 ORDER BY user_style";

if ( !($tresult = $db->sql_query($tsql)) )
{
	message_die(GENERAL_ERROR, "Could not query user table", "", __LINE__, __FILE__, $sql);
}

$rcnum = 1;
while ( $trow = $db->sql_fetchrow($tresult) )
{
	$stylecount = 0;
	while ($themelist[$stylecount][0] != '')
	{
		if ($trow['user_style'] == $themelist[$stylecount][0])
		{
			$ausgabename = $themelist[$stylecount][1];
		}

		$stylecount++;
	}
	// Und nun die Ausgabe
	if ($trow['username'] != 'Anonymous')
	{
		if ($rcnum == 1)
		{
			$superstring = $superstring . "<tr><td width=\"50%\" class=\"row1\">" . $trow['username'] . "</td><td width=\"50%\" class=\"row1\">" . $ausgabename . "</td></tr>";
			$rcnum++;
		}
		else
		{
			$superstring = $superstring . "<tr><td width=\"50%\" class=\"row2\">" . $trow['username'] . "</td><td width=\"50%\" class=\"row2\">" . $ausgabename . "</td></tr>";
			$rcnum = 1;
		}
	}
}//end while


$template->set_filenames(array(
	'body' => 'admin/admin_stylewatch.tpl')
);

$template->assign_vars(array(
	"STYLE_STATIC" => $lang['Style_static'],
	"USER" => $lang['User'],
	"STYLE" => $lang['Style'],
	"C_STATISTIC" => $superstring)
);

include('./page_header_admin.'.$phpEx);

$template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>
