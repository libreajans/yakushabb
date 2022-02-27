<?php
/***************************************************************************
* pagestart.php
***************************************************************************/

if (!defined('IN_PHPBB'))
{
	die("Hacking attempt");
}

define('IN_ADMIN', true);
include($phpbb_root_path . 'common.'.$phpEx);

// admin paneli þifreleme modu, congif.php sayfasýndaki deðerlerden þifreyi alýyor
if ($_SERVER['PHP_AUTH_USER'] != $config['adminuser'] || $_SERVER['PHP_AUTH_PW'] != $config['adminpassword'])
{
	header('WWW-Authenticate: Basic realm="Yönetim paneli þifresini giriniz."');
	header('HTTP/1.0 401 Unauthorized');
	die("Yetkisiz giriþ denemesi");
}

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

if (!$userdata['session_logged_in'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx", true));
}
else if ($userdata['user_level'] != ADMIN)
{
	message_die(GENERAL_MESSAGE, $lang['Not_admin']);
}

if ($HTTP_GET_VARS['sid'] != $userdata['session_id'])
{
	redirect("index.$phpEx?sid=" . $userdata['session_id']);
}

if (!$userdata['session_admin'])
{
	redirect(append_sid("login.$phpEx?redirect=admin/index.$phpEx&admin=1", true));
}

if (empty($no_page_header))
{
	// Not including the pageheader can be neccesarry if META tags are
	// needed in the calling script.
	include('./page_header_admin.'.$phpEx);
}

?>