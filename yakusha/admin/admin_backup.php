<?php
/***************************************************************************
 * admin_backup.php
 ***************************************************************************/
// CTracker_Ignore: File Checked By Human
define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ZDatabase']['Automatic_Database_Backup'] = $filename;
	return;
}

//
// Load default header
//
$no_page_header = TRUE;
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('ftp_server');
require('./pagestart.' . $phpEx);

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_auto_backup.' . $phpEx);

if ($HTTP_GET_VARS['post'] == true)
{ 
	if (  $_POST['level'] == 'basic' )
	{
		// Define minutes
		$minute = $_POST['minute'];
		
		// Define Hours
		$hour = $_POST['hour'];
		
		// Define Day
		$day = $_POST['day'];
		
		// Define Month
		$month = $_POST['month'];
		
		// Define Weekday
		$weekday = $_POST['weekday'];
	}
	elseif (  $_POST['level'] == 'advanced' )
	{
		// Define minutes
		$minute = $_POST['advanced_minute'];
		
		// Define Hours
		$hour = $_POST['advanced_hour'];
		
		// Define Day
		$day = $_POST['advanced_day'];
		
		// Define Month
		$month = $_POST['advanced_month'];
		
		// Define Weekday
		$weekday = $_POST['advanced_weekday'];
	}

	// Define Cronjob when line
	$when = "{$minute}    {$hour}    {$day }    {$month}    {$weekday}";

	// Define email
	$email_true = ( $_POST['email_true'] ) ? '1' : '0';
	$email = $_POST['email'];
	
	// Define delay time
	$delay_time = $_POST['delay_time'];

	// Define Backup types
	$backup_type = $_POST['backup_type'];
	$phpbb_only  = ( $_POST['phpbb_only'] ) ? '1' : '0';
	$no_search  = ( $_POST['no_search'] ) ? '1' : '0';
	$ignore_tables = $_POST['ignore_tables'];
	
	// Define Backup skill
	$skill_level = ( $_POST['level'] == 'basic') ? '0' : '1';
	
	// Define ftp
	$ftp_true = ( $_POST['ftp_true'] ) ? '1' : '0';
	$ftp_server  = $_POST['ftp_server'];
	$ftp_user_name  = $_POST['ftp_user_name'];
	$ftp_user_pass  = base64_encode($_POST['ftp_user_pass']);
	$ftp_directory  = $_POST['ftp_directory'];
	
	//Define save to backups directory
	$write_backups_true = ( $_POST['write_backups_true'] ) ? '1' : '0';
	$files_to_keep = $_POST['files_to_keep']; 
	
	// Submit to DB
	$sql = "UPDATE " . BACKUP_TABLE . " SET `backup_skill` = '" . $skill_level . "', `email_true` = '" . $email_true . "', `email` = '" . $email . "', `ftp_true` = '" . $ftp_true . "', `ftp_server` = '" . $ftp_server . "', `ftp_user_name` = '" . $ftp_user_name . "', `ftp_user_pass` = '" . $ftp_user_pass . "', `ftp_directory` = '" . $ftp_directory . "', `write_backups_true` = '" . $write_backups_true . "', `files_to_keep` = '" . $files_to_keep . "', `cron_time` = '".$when."', `backup_type` = '".$backup_type."', `phpbb_only` = '".$phpbb_only."', `no_search` = '".$no_search."', `ignore_tables` = '".$ignore_tables."', `delay_time` = '".$delay_time."';";
	
	if ( !$db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, $lang['Error_updating_auto_backup'], '', __LINE__, __FILE__, $sql);
	} 

	$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_auto_backup'], "<a href=\"" . append_sid("admin_backup.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

	message_die(GENERAL_MESSAGE, $message);
}



// Get info from backup table
$sql = "SELECT *
FROM " . BACKUP_TABLE . "";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, $lang['Error_retrieving_auto_backup'], '', __LINE__, __FILE__, $sql);
}

$backup_table = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

$cron_time = explode( "    ", $backup_table['cron_time'] );
$delay_time = $backup_table['delay_time'];

switch( $backup_table['backup_type'] ) {
     case "full": $backup_type_full = "checked"; break;
	 case "structure": $backup_type_structure = "checked"; break;
     case "data": $backup_type_data = "checked";
}
switch( $backup_table['backup_skill'] )
{
     case "0": $skill_basic = "checked=\"checked\""; break;
	 case "1": $skill_advanced = "checked=\"checked\"";
}

$no_search = ( $backup_table['no_search'] == '1' ) ? "checked=\"checked\"" : '';
$phpbb_only = ( $backup_table['phpbb_only'] == '1' ) ? "checked=\"checked\"" : '';
$ftp_true = ( $backup_table['ftp_true'] == '1' ) ? "checked=\"checked\"" : '';
$email_true = ( $backup_table['email_true'] == '1') ? "checked=\"checked\"" : '';
$write_backups_true = ( $backup_table['write_backups_true'] == '1') ? "checked=\"checked\"" : '';

$template->set_filenames(array(
   'body' => 'admin/admin_backup.tpl')
);

   
$template->assign_vars(array(
      'FORM_ACTION' => append_sid("admin_backup.$phpEx?post=true"),
      'L_AUTOMATIC_BACKUP' => $lang['Automatic_Backup'],
      'L_BACKUP_EXPLAIN' => $lang['Automatic_Backup_Explain'],
      'L_FORM_EXPLAIN' => $lang['Automatic_Backup_Form_Explain'],
      'L_FULL_BACKUP' => $lang['Full_backup'],
      'L_STRUCTURE_BACKUP' => $lang['Structure_backup'],
      'L_DATA_BACKUP' => $lang['Data_backup'],
	  'L_PHPBB_ONLY' => $lang['phpBB_only'],
	  'L_NO_SEARCH' => $lang['No_Search'],
	  'L_IGNORE_TABLES' => $lang['Ignore_tables'],
	  'L_ADVANCED_BACKUP' => $lang['auto_backup_advanced_user'],
	  'L_ADVANCED_BACKUP_EXPLAIN' => $lang['auto_backup_advanced_user_explain'],
	  'L_BASIC_BACKUP' => $lang['auto_backup_basic_user'],	  
	  'L_LEVEL' => $lang['auto_backup_level'],	
	  'L_BACKUP_TYPE' => $lang['Backup_type'],
	  'L_EMAIL' => $lang['Email_Address'],
	  'L_DELAY_TIME' => $lang['Delay_time'],
      'L_SUBMIT' => $lang['Submit'],
      'L_RESET' => $lang['Reset'],
	  'L_MINUTES' => $lang['Minutes'],
	  'L_EVERY_MINUTE' => $lang['Every_Minute'],
	  'L_EVERY_OTHER_MINUTES' => $lang['Every_Other_Minutes'],
	  'L_EVERY_FIVE_MINUTES' => $lang['Every_Five_Minutes'],
	  'L_EVERY_TEN_MINUTES' => $lang['Every_Ten_Minutes'],
	  'L_EVERY_FIFTEEN_MINUTES' => $lang['Every_Fifteen_Minutes'],
	  'L_HOURS' => $lang['Hours'],
	  'L_EVERY_HOUR' => $lang['Every_Hour'],
	  'L_EVERY_OTHER_HOUR' => $lang['Every_Other_Hour'],
	  'L_EVERY_FOUR_HOURS' => $lang['Every_Four_Hours'],
	  'L_EVERY_SIX_HOURS' => $lang['Every_Six_Hours'],
	  'L_MIDNIGHT' => $lang['Midnight'],
	  'L_NOON' => $lang['Noon'],
	  'L_DAYS' => $lang['Days'],
	  'L_EVERY_DAY' => $lang['Every_Day'],
	  'L_MONTHS' => $lang['Months'],
	  'L_EVERY_MONTH' => $lang['Every_Month'],
	  'L_JANUARY' => $lang['January'],
	  'L_FEBRUARY' => $lang['February'],
	  'L_MARCH' => $lang['March'],
	  'L_APRIL' => $lang['April'],
	  'L_MAY' => $lang['May'],
	  'L_JUNE' => $lang['June'],
	  'L_JULY' => $lang['July'],
	  'L_AUGUST' => $lang['August'],
	  'L_SEPTEMBER' => $lang['September'],
	  'L_OCTOBER' => $lang['October'],
	  'L_NOVEMBER' => $lang['November'],
	  'L_DECEMBER' => $lang['December'],
	  'L_WEEKDAYS' => $lang['Weekdays'],
	  'L_EVERY_WEEKDAY' => $lang['Every_Weekday'],
	  'L_SUNDAY' => $lang['Sunday'],
	  'L_MONDAY' => $lang['Monday'],
	  'L_TUESDAY' => $lang['Tuesday'],
	  'L_WEDNESDAY' => $lang['Wednesday'],
	  'L_THURSDAY' => $lang['Thursday'],
	  'L_FRIDAY' => $lang['Friday'],
	  'L_SATURDAY' => $lang['Saturday'],
	  'L_EMAIL_TRUE' => $lang['Email_true'],
	  'L_FTP_TRUE' => $lang['FTP_true'],
	  'L_FTP_SERVER' => $lang['FTP_server'],
	  'L_FTP_USER' => $lang['FTP_user_name'],
	  'L_FTP_PASS' => $lang['FTP_user_pass'],
	  'L_FTP_DIRECTORY' => $lang['FTP_directory'],
	  'L_WRITE_BACKUPS_TRUE' => $lang['write_backups_true'],
	  'L_FILES_TO_KEEP' => $lang['files_to_keep'],
	  'L_FILES_TO_KEEP_EXPLAIN' => $lang['files_to_keep_explain'],
	  'L_ENABLED' => $lang['Enabled'],
	  'L_NO' => $lang['No'],
	  'L_YES' => $lang['Yes'],
	  'MINUTES' => $cron_time[0],
	  'HOURS' => $cron_time[1],
	  'DAYS' => $cron_time[2],
	  'MONTHS' => $cron_time[3],
	  'WEEKDAYS' => $cron_time[4],
	  'DELAY_TIME' => $backup_table['delay_time'],
	  'EMAIL_TRUE' => $email_true,
	  'EMAIL' => $backup_table['email'],
	  'PHPBB_ONLY' => $phpbb_only,
	  'NO_SEARCH' => $no_search,
	  'IGNORE_TABLES' => $backup_table['ignore_tables'],
	  'FULL_BACKUP' => $backup_type_full,
	  'STRUCTURE_BACKUP' => $backup_type_structure,
	  'DATA_BACKUP' => $backup_type_data,
	  'FTP_TRUE' => $ftp_true,
	  'FTP_SERVER' => $backup_table['ftp_server'],
	  'FTP_USER' => $backup_table['ftp_user_name'],
	  'FTP_PASS' => base64_decode($backup_table['ftp_user_pass']),
	  'FTP_DIRECTORY' => $backup_table['ftp_directory'],
	  'WRITE_BACKUPS_TRUE' => $write_backups_true,
	  'FILES_TO_KEEP' => $backup_table['files_to_keep'],
	  'SKILL_BASIC' => $skill_basic,
	  'SKILL_ADVANCED' => $skill_advanced
	  )
);

include('./page_header_admin.'.$phpEx);
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>