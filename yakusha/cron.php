<?php
/***************************************************************************
 * cron.php
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// include cron.php
include( $phpbb_root_path . 'includes/cron.php' );


header("Cache-control: no-cache");
header("Content-Type: image/gif");



echo base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");

exit;

?>