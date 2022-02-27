<?php
/***************************************************************************
* lang_extend_mac.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
	exit;
}

if ( !defined('LANG_EXTEND_DONE') )
{
	// check for admin part
	$lang_extend_admin = defined('IN_ADMIN');

	// get the english settings
	if ( $board_config['default_lang'] != 'english' )
	{
		$dir = @opendir($phpbb_root_path . 'language/lang_english');
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . 'language/lang_english/' . $file);
			}
		}
		// include the personalisations
		@include_once($phpbb_root_path . 'language/lang_english/lang_extend.' . $phpEx);
		@closedir($dir);
	}

	// get the user settings
	if ( !empty($board_config['default_lang']) )
	{
		$dir = @opendir($phpbb_root_path . 'language/lang_' . $board_config['default_lang']);
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^lang_extend_.*?\." . $phpEx . "$/", $file) )
			{
				include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/' . $file);
			}
		}
		// include the personalisations
		@include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_extend.' . $phpEx);
		@closedir($dir);
	}
	define('LANG_EXTEND_DONE', true);
}

?>