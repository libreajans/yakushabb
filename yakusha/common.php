<?php
/***************************************************************************
* common.php
***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

error_reporting	(E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables
set_magic_quotes_runtime(0); // Disable magic_quotes_runtime

@ini_set('register_globals',0);
@ini_set('variables_order','GPC');
@ini_set('display_errors','on');
@ini_set('default_socket_timeout',10);

// The following code (unsetting globals)
// Thanks to Matt Kavanagh and Stefan Esser for providing feedback as well as patch files

// PHP5 with register_long_arrays off?
if (@phpversion() >= '5.0.0' && (!@ini_get('register_long_arrays') || @ini_get('register_long_arrays') == '0' || strtolower(@ini_get('register_long_arrays')) == 'off'))
{
	$HTTP_POST_VARS = $_POST;
	$HTTP_GET_VARS = $_GET;
	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_COOKIE_VARS = $_COOKIE;
	$HTTP_ENV_VARS = $_ENV;
	$HTTP_POST_FILES = $_FILES;
	
	// _SESSION is the only superglobal which is conditionally set
	if (isset($_SESSION))
	{
		$HTTP_SESSION_VARS = $_SESSION;
	}
}

// CrackerTracker v5.x
include($phpbb_root_path . 'ctracker/engines/ct_security.' . $phpEx);
// CrackerTracker v5.x

if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS']))
{
	die('Hacking attempt');
}

if (isset($_SESSION) && !is_array($_SESSION))
{
	die('Hacking attempt');
}

if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
{
	// PHP4+ path
	$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');
	
	// Not only will array_merge give a warning if a parameter
	// is not an array, it will actually fail. So we check if
	// HTTP_SESSION_VARS has been initialised.
	if (!isset($HTTP_SESSION_VARS) || !is_array($HTTP_SESSION_VARS))
	{
		$HTTP_SESSION_VARS = array();
	}
	
	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES);
	
	unset($input['input']);
	unset($input['not_unset']);
	
	while (list($var,) = @each($input))
	{
		if (in_array($var, $not_unset))
		{
			die('Hacking attempt!');
		}
		unset($$var);
	}
	
	unset($input);
}//end if

//
// addslashes to vars if magic_quotes_gpc is off
// this is a security precaution to prevent someone
// trying to break out of a SQL statement.
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($HTTP_GET_VARS) )
	{
		while( list($k, $v) = each($HTTP_GET_VARS) )
		{
			if( is_array($HTTP_GET_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_GET_VARS[$k]) )
				{
					$HTTP_GET_VARS[$k][$k2] = addslashes($v2);
				}
				@reset($HTTP_GET_VARS[$k]);
			}
			else
			{
				$HTTP_GET_VARS[$k] = addslashes($v);
			}
		}//end while
		@reset($HTTP_GET_VARS);
	} //end is_array($HTTP_GET_VARS)

if( is_array($HTTP_POST_VARS) )
{
	while( list($k, $v) = each($HTTP_POST_VARS) )
	{
		if( is_array($HTTP_POST_VARS[$k]) )
		{
			while( list($k2, $v2) = each($HTTP_POST_VARS[$k]) )
			{
				$HTTP_POST_VARS[$k][$k2] = addslashes($v2);
			}
			@reset($HTTP_POST_VARS[$k]);
		}
		else
		{
			$HTTP_POST_VARS[$k] = addslashes($v);
		}
	}
	@reset($HTTP_POST_VARS);
}

if( is_array($HTTP_COOKIE_VARS) )
{
	while( list($k, $v) = each($HTTP_COOKIE_VARS) )
	{
		if( is_array($HTTP_COOKIE_VARS[$k]) )
		{
			while( list($k2, $v2) = each($HTTP_COOKIE_VARS[$k]) )
			{
				$HTTP_COOKIE_VARS[$k][$k2] = addslashes($v2);
			}
			@reset($HTTP_COOKIE_VARS[$k]);
		}
		else
		{
			$HTTP_COOKIE_VARS[$k] = addslashes($v);
		}
	}//end while
	@reset($HTTP_COOKIE_VARS);
	}// end is_array($HTTP_COOKIE_VARS)
}// end !get_magic_quotes_gpc

// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
$board_config = array();
$userdata = array();
$theme = array();
$images = array();
$lang = array();
$nav_links = array();
$gen_simple_header = FALSE;
$dss_seeded = false;

include($phpbb_root_path . 'config.'.$phpEx);

if( !defined("PHPBB_INSTALLED") )
{
	header('Location: ' . $phpbb_root_path . 'setup/index.php');
	exit;
}

@include($phpbb_root_path . 'includes/constants.'.$phpEx);
@include($phpbb_root_path . 'includes/template.'.$phpEx);
@include($phpbb_root_path . 'includes/sessions.'.$phpEx);
@include($phpbb_root_path . 'includes/auth.'.$phpEx);
@include($phpbb_root_path . 'includes/functions.'.$phpEx);
@include($phpbb_root_path . 'includes/db.'.$phpEx);

// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

//
// Obtain and encode users IP
//
// I'm removing HTTP_X_FORWARDED_FOR ... this may well cause other problems such as
// private range IP's appearing instead of the guilty routable IP, tough, don't
// even bother complaining ... go scream and shout at the idiots out there who feel
// "clever" is doing harm rather than good ... karma is a great thing ... :)
//
$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
$user_ip = encode_ip($client_ip);

// CrackerTracker v5.x
include($phpbb_root_path . 'ctracker/engines/ct_varsetter.' . $phpEx);
include($phpbb_root_path . 'ctracker/engines/ct_ipblocker.' . $phpEx);
// CrackerTracker v5.x

//
// Setup forum wide options, if this fails
// then we output a CRITICAL_ERROR since
// basic forum information is not available
//
$sql = "SELECT * FROM " . CONFIG_TABLE;
if ( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['config_name']] = $row['config_value'];
}
$db->sql_freeresult($result);

if (!empty($HTTP_SERVER_VARS['SERVER_NAME']) || !empty($HTTP_ENV_VARS['SERVER_NAME']))
{
	$server_name = (!empty($HTTP_SERVER_VARS['SERVER_NAME'])) ? $HTTP_SERVER_VARS['SERVER_NAME'] : $HTTP_ENV_VARS['SERVER_NAME'];
}
else if (!empty($HTTP_SERVER_VARS['HTTP_HOST']) || !empty($HTTP_ENV_VARS['HTTP_HOST']))
{
	$server_name = (!empty($HTTP_SERVER_VARS['HTTP_HOST'])) ? $HTTP_SERVER_VARS['HTTP_HOST'] : $HTTP_ENV_VARS['HTTP_HOST'];
}
else
{
	$server_name = '';
}
if (empty($board_config['server_name']) && !empty($server_name))
{
	$board_config['server_name'] = $server_name;
	if (empty($board_config['cookie_domain'])) 
        {
		$board_config['cookie_domain'] = $board_config['server_name'];
	}
}
if (empty($board_config['script_path'])) {
	$board_config['script_path'] = str_replace('admin/', '', dirname($HTTP_SERVER_VARS['PHP_SELF']) . '/');
	if (empty($board_config['cookie_path']))
        {
		$board_config['cookie_path'] = $board_config['script_path'];
	}
}

include($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx);

// Start add - Select default language MOD
if( !isset($board_config['real_default_lang']) )
{
	$board_config['real_default_lang'] = $board_config['default_lang'];
}
$language = ( isset($HTTP_POST_VARS['language']) ) ? $HTTP_POST_VARS['language'] : $HTTP_GET_VARS['language'];

if ($language)
{
	$language=trim(strip_tags($language));
	$board_config['default_lang'] = $language;
	setcookie($board_config['cookie_name'].'_default_lang',$language , (time()+21600), $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}
else
{
	if (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'].'_default_lang']) )
	{
		$board_config['default_lang']=$HTTP_COOKIE_VARS[$board_config['cookie_name'].'_default_lang'];
	}
}
// End add - Select default language MOD


// BEGIN theme selection box hack
if( isset($HTTP_GET_VARS['theme']) || isset($HTTP_POST_VARS['theme']) )
{
	$url_theme = intval($HTTP_GET_VARS['theme'] ? $HTTP_GET_VARS['theme'] : $HTTP_POST_VARS['theme']);
}
else
{
	$url_theme = 0;
}

if (file_exists('install') || file_exists('contrib') || file_exists('setup') || file_exists('docs'))
{
	message_die(GENERAL_MESSAGE, 'Kurulum_dosyalarini_sil');
}

?>