<?php

/***************************************************************************
* function_selects.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

//
// Pick a language, any language ...
//
function language_select($default, $select_name = "language", $dirname="language")
{
	global $phpEx, $phpbb_root_path;

	$dir = opendir($phpbb_root_path . $dirname);

	$lang = array();
	while ( $file = readdir($dir) )
	{
		if (preg_match('#^lang_#i', $file) && !is_file(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)))
		{
			$filename = trim(str_replace("lang_", "", $file));
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$lang[$displayname] = $filename;
		}
	}

	closedir($dir);

	@asort($lang);
	@reset($lang);

	$lang_select = '<select name="' . $select_name . '">';
	while ( list($displayname, $filename) = @each($lang) )
	{
		$selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
		$lang_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
	}
	$lang_select .= '</select>';

	return $lang_select;
}

function language_select2($default, $select_name = "language", $dirname="language")
{
	global $phpEx, $phpbb_root_path;

	$dir = opendir($phpbb_root_path . $dirname);

	$lang = array();
	while ( $file = readdir($dir) )
	{
		if (preg_match('#^lang_#i', $file) && !is_file(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)) && !is_link(@phpbb_realpath($phpbb_root_path . $dirname . '/' . $file)))
		{
			$filename = trim(str_replace("lang_", "", $file));
			$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
			$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
			$lang[$displayname] = $filename;
		}
	}

	closedir($dir);

	@asort($lang);
	@reset($lang);

	$lang_select = '<select onChange="this.form.submit();" name="' . $select_name . '">';
        $lang_select .= '<optgroup label="Language Select">';
	while ( list($displayname, $filename) = @each($lang) )
	{
		$selected = ( strtolower($default) == strtolower($filename) ) ? ' selected="selected"' : '';
		$lang_select .= '<option value="' . $filename . '"' . $selected . '>-- ' . ucwords($displayname) . '</option>';
	}
	$lang_select .= '</select>';
	$lang_select .= '</optgroup>';

	return $lang_select;
}

//
// Pick a template/theme combo, 
//
function style_select($default_style, $select_name = "style", $dirname = "templates")
{
	global $db;

	$sql = "SELECT themes_id, style_name
		FROM " . THEMES_TABLE . "
		ORDER BY template_name, themes_id";
        if ( !($result = $db->sql_query($sql)) )
	//if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not query themes table", "", __LINE__, __FILE__, $sql);
	}

	$style_select = '<select name="' . $select_name . '">';
	$style_select .= '<option value="NULL"' . $selected . '>--------------------</option>';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';
		$style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
	}
	$style_select .= "</select>";

	return $style_select;
}

function style_select2($default_style, $select_name = "style", $dirname = "templates")
{
	global $db;

	$sql = "SELECT themes_id, style_name
		FROM " . THEMES_TABLE . "
		ORDER BY template_name, themes_id";
        if ( !($result = $db->sql_query($sql)) )
	//if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not query themes table", "", __LINE__, __FILE__, $sql);
	}

	$style_select = '<select name="' . $select_name . '">';
	while ( $row = $db->sql_fetchrow($result) )
	{
		$selected = ( $row['themes_id'] == $default_style ) ? ' selected="selected"' : '';
		$style_select .= '<option value="' . $row['themes_id'] . '"' . $selected . '>' . $row['style_name'] . '</option>';
	}
	$style_select .= "</select>";

	return $style_select;
}

//
// Pick a timezone
//
function tz_select($default, $select_name = 'timezone')
{
	global $sys_timezone, $lang;

	if ( !isset($default) )
	{
		$default == $sys_timezone;
	}
	$tz_select = '<select name="' . $select_name . '">';

	while( list($offset, $zone) = @each($lang['tz']) )
	{
		$selected = ( $offset == $default ) ? ' selected="selected"' : '';
		$tz_select .= '<option value="' . $offset . '"' . $selected . '>' . $zone . '</option>';
	}
	$tz_select .= '</select>';

	return $tz_select;
}

//insancýl tarih :) formatlarý

//
// Pick a (canned) date format
//
function date_format_select($default, $timezone, $select_name = 'dateformat')
{
	global $board_config;

	// Include any valid PHP date format strings here, in your preferred order
	$date_formats = array(
                'H:i d-F-Y',
                'H:i d-F-Y l',
		'H:i j-m-Y',
		'H:i j-m-Y l',
		'l j-m-Y',
		'l j-m-Y H:i',
                'l Y-m-d',
		'l Y-m-d H:i',
                'l H:i Y-m-d',
                'l H:i j-m-Y',
		'j-m-Y',
		'j-m-Y H:i',
		'j-m-Y H:i l',
		'j-m-Y l',
		'j-m-Y l H:i',
                'd-F-Y',
                'd-F-Y H:i',
                'd-F-Y H:i l',
                'd-F-Y l',
                'd-F-Y l H:i',
                'Y-m-d',
		'Y-m-d H:i',
		'Y-m-d H:i l',
		'Y-m-d l',
		'Y-m-d l H:i',
                'l H:i d-F-Y',
                'H:i l d-F-Y',
                'l d-F-Y H:i'
	);

	if ( !isset($timezone) )
	{
		$timezone == $board_config['board_timezone'];
	}
	$now = time() + (3600 * $timezone);

	$df_select = '<select name="' . $select_name . '">';
	for ($i = 0; $i < sizeof($date_formats); $i++)
	{
		$format = $date_formats[$i];
		$display = date($format, $now);
		$df_select .= '<option value="' . $format . '"';
		if (isset($default) && ($default == $format))
		{
			$df_select .= ' selected';
		}
		$df_select .= '>' . $display . '</option>';
	}
	$df_select .= '</select>';

	return $df_select;
}

function admin_date_format_select($default, $timezone, $select_name = 'default_dateformat') 
{ 
global $board_config;

// Include any valid PHP date format strings here, in your preferred order 
	$date_formats = array(
                'H:i d-F-Y',
                'H:i d-F-Y l',
		'H:i j-m-Y',
		'H:i j-m-Y l',
		'l j-m-Y',
		'l j-m-Y H:i',
                'l Y-m-d',
		'l Y-m-d H:i',
                'l H:i Y-m-d',
                'l H:i j-m-Y',
		'j-m-Y',
		'j-m-Y H:i',
		'j-m-Y H:i l',
		'j-m-Y l',
		'j-m-Y l H:i',
                'd-F-Y',
                'd-F-Y H:i',
                'd-F-Y H:i l',
                'd-F-Y l',
                'd-F-Y l H:i',
                'Y-m-d',
		'Y-m-d H:i',
		'Y-m-d H:i l',
		'Y-m-d l',
		'Y-m-d l H:i',
                'l H:i d-F-Y',
                'H:i l d-F-Y',
                'l d-F-Y H:i'
	);

if ( !isset($timezone) )
{ 
$timezone == $board_config['board_timezone']; 
} 
$now = time() + (3600 * $timezone);

$df_select = '<select name="' . $select_name . '">'; 
for ($i = 0; $i < sizeof($date_formats); $i++)
{ 
$format = $date_formats[$i];
$display = date($format, $lang[$now]);
$df_select .= '<option value="' . $format . '"'; 
if (isset($default) && ($default == $format)) 
{ 
$df_select .= ' selected'; 
} 
$df_select .= '>' . $display . '</option>';
} 
$df_select .= '</select>'; 

return $df_select; 
}

//sonu
//-- [+] MOD: Þehir Açýlýr Kutuda ---------------------------------------
//-- eklendi
//
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_city.' . $phpEx); 

function location_select($default_location, $select_name = "location")
{
	global $lang;
	$location_list = $lang['Location_choice'];

	$location_select = '<select name="' . $select_name . '">';
	while( list($id, $location_name) = @each($location_list) ) 
	{
		$selected = ( $location_name == $default_location ) ? ' selected="selected"' : '';

		$location_select .= '<option value="' . $location_name . '"' . $selected . '>' . $location_name . '</option>';
	}
	$location_select .= "</select>";
 
	return $location_select;
}
//
//-- [-] MOD: Þehir Açýlýr Kutuda ---------------------------------------

//-- [+] MOD: meslek açýlýr kutuda --------------------------------------
//-- eklendi
//
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_occ.' . $phpEx); 

function occupation_select($default_occupation, $select_name = "occupation")
{
	global $lang;
	$occupation_list = $lang['Occupation_choice'];

	$occupation_select = '<select name="' . $select_name . '">';
	while( list($id, $occupation_name) = @each($occupation_list) ) 
	{
		$selected = ( $occupation_name == $default_occupation ) ? ' selected="selected"' : '';

		$occupation_select .= '<option value="' . $occupation_name . '"' . $selected . '>' . $occupation_name . '</option>';
	}
	$occupation_select .= "</select>";
 
	return $occupation_select;
}
//
//-- [-] MOD: meslek açýlýr kutuda --------------------------------------

?>