<?php
/***************************************************************************
 * admin_portal.php
 ***************************************************************************/
// CTracker_Ignore: File Checked By Human

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Portal'] = "$file?mode=config";
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('welcome_text');
require('./pagestart.' . $phpEx);

define('PORTAL_TABLE', $table_prefix.'portal');

//
// Pull all config data
//
$sql = "SELECT * FROM " . PORTAL_TABLE;
if(!$result = $db->sql_query($sql))
{
	message_die(CRITICAL_ERROR, "Could not query config information in admin_portal", "", __LINE__, __FILE__, $sql);
}
else
{
	while( $row = $db->sql_fetchrow($result) )
	{
		$portal_name = trim($row['portal_name']);
		$portal_value = trim($row['portal_value']);
		$default_portal[$portal_name] = $portal_value;
		
		$new[$portal_name] = ( isset($HTTP_POST_VARS[$portal_name]) ) ? $HTTP_POST_VARS[$portal_name] : $default_portal[$portal_name];
		if( isset($HTTP_POST_VARS['submit']) )
		{
			$sql = "UPDATE " . PORTAL_TABLE . " SET
				portal_value = '" . str_replace("\'", "''", $new[$portal_name]) . "'
				WHERE portal_name = '$portal_name'";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, "Failed to update general configuration for $portal_name", "", __LINE__, __FILE__, $sql);
			}
		}
	}

	if( isset($HTTP_POST_VARS['submit']) )
	{
		$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_portal.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}
}

$template->set_filenames(array(
	"body" => "admin/portal_config_body.tpl")
);

$template->assign_vars(array(
	"S_CONFIG_ACTION" => append_sid("admin_portal.$phpEx"),
	"L_CONFIGURATION_TITLE" => $lang['General_Portal_Config'],
	"L_WELCOME_TEXT" => $lang['Welcome_Text'],
	"L_NUMBER_OF_NEWS" => $lang['Number_of_News'],
	"L_NEWS_LENGTH" => $lang['News_length'],
	"L_NEWS_FORUM" => $lang['News_Forum'],
	"L_POLL_FORUM" => $lang['Poll_Forum'],
	"L_NUMBER_RECENT_TOPICS" => $lang['Number_Recent_Topics'],
	"L_LAST_SEEN" => $lang['Last_Seen'],
	"L_SUBMIT" => $lang['Submit'], 
	"L_RESET" => $lang['Reset'], 
	"L_SHOW" => $lang['Portal_Show'],
	"L_HIDE" => $lang['Portal_Hide'],
	"L_COMMA" => $lang['Comma'],

	"WELCOME_TEXT" => $new['welcome_text'], 
	"NUMBER_OF_NEWS" => $new['number_of_news'],
	"NEWS_LENGTH" => $new['news_length'],
	"NEWS_FORUM" => $new['news_forum'],
	"POLL_FORUM" => $new['poll_forum'],
	"NUMBER_RECENT_TOPICS" => $new['number_recent_topics'],
	"LAST_SEEN" => $new['last_seen'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>

