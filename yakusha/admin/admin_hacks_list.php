<?php
/***************************************************************************
*  admin_hacks_list.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
   $filename = basename(__FILE__);
   $module['General']['Hacks_List'] = $filename;

   return;
}

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('hack_name','hack_desc','hack_author','hack_author_website');
require('./pagestart.' . $phpEx);

include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_hacks_list.' . $phpEx);
include($phpbb_root_path.'includes/functions_hacks_list.'.$phpEx);

define('MOD_VERSION', '1.20');

/****************************************************************************
/** Constants and Main Vars.
/***************************************************************************/
$page_title = $lang['Hacks_List'];
$required_fields = array('hack_name', 'hack_desc', 'hack_author');
$dbase_fields = array('hack_download_url', 'hack_hide', 'hack_name', 'hack_desc', 'hack_author', 'hack_author_email', 'hack_author_website', 'hack_version');
$status_message = '';
$update_sql = '';
$insert_sql = '';
$insert_val_sql = '';

/*******************************************************************************************
/** Get parameters.  'var_name' => 'default'
/******************************************************************************************/
$params = array('mode' => '', 'hack_id' => '');

foreach($params as $var => $default)
{
 $$var = $default;
 if( isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]) )
 {
  $$var = ( isset($HTTP_POST_VARS[$var]) ) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var];
 }
}

if (count($HTTP_POST_VARS))
{
 foreach($HTTP_POST_VARS as $key => $valx)
 {
  /*******************************************************************************************
  /** Check for deletion items
  /******************************************************************************************/
  if (substr_count($key, 'delete_id_'))
  {
   $hack_id = substr($key, 10);
   
   $sql = 'SELECT hack_name FROM ' . HACKS_LIST_TABLE . "
      WHERE hack_id = $hack_id";
   if(!$result = $db->sql_query($sql))
   {
    message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
   }
   $row = $db->sql_fetchrow($result);
   
   $neat_bc_name = addslashes(str_replace(" ", "_", $row['hack_name'])) . '_list_info';
   $sql = 'DELETE FROM ' . CONFIG_TABLE . "
      WHERE config_name = '$neat_bc_name'";
   if (!$db->sql_query($sql))
   {
    message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
   }
   
   $sql = "DELETE FROM " . HACKS_LIST_TABLE . "
      WHERE hack_id = $hack_id";
   if(!$db->sql_query($sql))
   {
    message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
   }
   else
   {
    $status_message .= sprintf($lang['Deleted_Hack'], stripslashes($row['hack_name']));
   }
  }
  
  /*******************************************************************************************
  /** Check for update items
  /******************************************************************************************/
  elseif (substr_count($key, 'update_id_'))
  {
   $hack_id = substr($key, 10);
   
   foreach ($dbase_fields as $val)
   {
    /* Check for required items */
    if (in_array($val, $required_fields) && $HTTP_POST_VARS[$val] == '')
    {
     message_die(GENERAL_ERROR, $lang['Required_Field_Missing'], '', __LINE__, __FILE__);
    }
    
    /* Compile the SQL Lists */
    $update_sql .= ($update_sql != '') ? ", $val = '" . addslashes($HTTP_POST_VARS[$val]) . "'" : "$val = '" . addslashes($HTTP_POST_VARS[$val]) . "'";
   }
   
   $sql = 'UPDATE ' . HACKS_LIST_TABLE . "
      SET $update_sql
      WHERE hack_id = '$hack_id'";
   if(!$db->sql_query($sql))
   {
    message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
   }
   else
   {
    $status_message .= sprintf($lang['Updated_Hack'], stripslashes($HTTP_POST_VARS['hack_name']));
   }
  }
  
  /*******************************************************************************************
  /** Check for add items
  /******************************************************************************************/
  elseif (substr_count($key, 'add_id_'))
  {
   $hack_id = substr($key, 7);
   
   foreach ($dbase_fields as $val)
   {
    /* Check for required items */
    if (in_array($val, $required_fields) && $HTTP_POST_VARS[$val] == '')
    {
     message_die(GENERAL_ERROR, $lang['Required_Field_Missing'], '', __LINE__, __FILE__);
    }
    
    /* Compile the SQL Lists */
    $insert_sql .= ($insert_sql != '') ? ", $val" : $val;
    $insert_val_sql .= ($insert_val_sql != '') ? ", '" . addslashes($HTTP_POST_VARS[$val]) . "'" : "'" . addslashes($HTTP_POST_VARS[$val]) . "'";
   }

   $sql = 'INSERT INTO ' . HACKS_LIST_TABLE . "
      ($insert_sql)
      VALUES
      ($insert_val_sql)";
   if(!$db->sql_query($sql))
   {
    message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
   }
   else
   {
    $status_message .= sprintf($lang['Added_Hack'], stripslashes($HTTP_POST_VARS['hack_name']));
   }
  }
 }
}
/*******************************************************************************************
/** Parse for modes...Two seperate pages (add + edit, display list)
/******************************************************************************************/
setup_hacks_list_array();
scan_hl_files();
switch($mode)
{
 case 'edit':
 {
  /* Fetch the data for the specified ID in edit mode, then do the same thing as add */
  $sql = 'SELECT * FROM ' . HACKS_LIST_TABLE . "
         WHERE hack_id = $hack_id";
  if(!$result = $db->sql_query($sql))
  {
   message_die(GENERAL_ERROR, $lang['Error_Hacks_List_Table'], '', __LINE__, __FILE__, $sql);
  }
  $row = $db->sql_fetchrow($result);
  
  $template->assign_vars(array(
  'S_HACK_ID' => $row['hack_id'],
  'S_HIDDEN' => 'update_id_' . $row['hack_id'],
  'S_HACK_NAME' => trim(stripslashes($row['hack_name'])),
  'S_HACK_DESC' => trim(stripslashes($row['hack_desc'])),
  'S_HACK_DOWNLOAD' => $row['hack_download_url'],
  'S_HACK_AUTHOR' => trim(stripslashes($row['hack_author'])),
  'S_HACK_AUTHOR_EMAIL' => trim(stripslashes($row['hack_author_email'])),
  'S_HACK_WEBSITE' => trim(stripslashes($row['hack_author_website'])),
  'S_HACK_HIDE_NO' => ($row['hack_hide'] == 'No') ? 'checked="checked"' : '',
  'S_HACK_HIDE_YES' => ($row['hack_hide'] == 'Yes') ? 'checked="checked"' : '',
  'S_HACK_VERSION' => trim(stripslashes($row['hack_version']))));
  
 }
 case 'add':
 {
  if ($mode != 'edit')
  {
   $template->assign_vars(array(
   'S_HIDDEN' => 'add_id_' . $row['hack_id'],
   'S_HACK_HIDE_NO' => 'checked="checked"'));
  }
  
  $template->set_filenames(array('body' => 'admin/admin_hacks_list_add.tpl'));
  break;
 }
 case 'display':
 default:
 {

        if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
        {
         $mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
        }
        else
        {
         $mode = 'hack_name';
        }
        
        if(isset($HTTP_POST_VARS['order']))
        {
         $sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
        }
        else if(isset($HTTP_GET_VARS['order']))
        {
         $sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
        }
        else
        {
         $sort_order = 'ASC';
        }
        
        //
        // Modlist sorting
        //
        $mode_types_text = array($lang['Hack_Name'], $lang['Version'] ,$lang['Description'], $lang['Author'],$lang['Author_Email'],  $lang['Website']);
        $mode_types = array('hack_name', 'hack_version', 'hack_desc', 'hack_author', 'hack_author_email', 'hack_author_website');
        
        $select_sort_mode = '<select name="mode">';
        for($i = 0; $i < count($mode_types_text); $i++)
        {
         $selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
         $select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
        }
        $select_sort_mode .= '</select>';
        
        $select_sort_order = '<select name="order">';
        if($sort_order == 'ASC')
        {
         $select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
        }
        else
        {
         $select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
        }
        $select_sort_order .= '</select>';
        
        //
        // Generate page
        //
        
        $template->set_filenames(array(
         'body' => 'admin/admin_hacks_list_display.tpl')
        );
        
        $template->assign_vars(array(
         'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
         'L_PAGE_TITLE' => $page_title,
                'L_HACK_NAME' => $lang['Hack_Name'],
         'L_HACK_AUTHOR' => $lang['Author'],
         'L_HACK_DESC' => $lang['Description'],
         'L_HACK_WEB' => $lang['Website'],
         'L_SORT' => $lang['Sort'],
         'L_SUBMIT' => $lang['Sort'],
         'L_LOOK_UP' => $lang['Look_up_hack'],
         'S_MODE_SELECT' => $select_sort_mode,
         'S_ORDER_SELECT' => $select_sort_order,
         'S_MODE_ACTION' => append_sid("modlist.$phpEx"))
        );
        
        switch( $mode )
        {
         case 'hack_ame':
          $order_by = "hack_name $sort_order ";
          break;
         case 'hack_version':
          $order_by = "hack_version $sort_order ";
          break;
         case 'hack_desc':
          $order_by = "hack_desc $sort_order ";
          break;
         case 'hack_author':
          $order_by = "hack_author $sort_order ";
          break;
         case 'hack_author_email':
          $order_by = "hack_author_email $sort_order ";
          break;
         case 'hack_author_website':
          $order_by = "hack_author_website $sort_order ";
          break;
         default:
          $order_by = "hack_name $sort_order";
          break;
        }
        
          //arama fonksiyonun için hack_name deðiþkeni taranýyor
          $hack_name = ( !empty($HTTP_POST_VARS['hack_name']) ) ? $HTTP_POST_VARS['hack_name'] : '';
        
          if ( $hack_name && isset($HTTP_POST_VARS['submituser']) )
          {
        
                $sql = "SELECT * FROM " . HACKS_LIST_TABLE . " WHERE ($mode like '%$hack_name%') order by ". $mode;
        
                if( !($result = $db->sql_query($sql)) )
                  {
                     message_die(GENERAL_ERROR, 'Sorgu Çalýþtýrýlamadý', '', __LINE__, __FILE__, $sql);
                  }
          }
          else
          {
                $sql = "SELECT * FROM " . HACKS_LIST_TABLE . " WHERE hack_id > 0 $hide ORDER BY $order_by ";
        
                if( !($result = $db->sql_query($sql)) )
                {
                     message_die(GENERAL_ERROR, 'Sorgu Çalýþtýrýlamadý', '', __LINE__, __FILE__, $sql);
                }
          }
        // test amaçlý
        // echo $sql;

  $i = 1;
  while ($row = $db->sql_fetchrow($result))
  {
   $template->assign_block_vars('listrow', array(
   'ROW_CLASS' => (!($i% 2)) ? $theme['td_class1'] : $theme['td_class2'],
                        'ROW_NUMBER' => $i++,
   'HACK_ID' => $row['hack_id'],
   'HACK_AUTHOR' => ($row['hack_author_email'] != '') ? '<a href="mailto:' . stripslashes($row['hack_author_email']) . '">' . stripslashes($row['hack_author']) . '</a>' : stripslashes($row['hack_author']),
   'HACK_WEBSITE' => ($row['hack_author_website'] != '') ? '<a href="' . stripslashes($row['hack_author_website']) . '" target="author_web">' . stripslashes($row['hack_author_website']) . '</a>' : $lang['No_Website'],
   'HACK_NAME' => ($row['hack_download_url'] != '') ? '<a href="' . stripslashes($row['hack_download_url']) . '" target="hack_url">' . stripslashes($row['hack_name']) . '</a>' : stripslashes($row['hack_name']),
   'HACK_DESC' => stripslashes($row['hack_desc']),
   'HACK_VERSION' => ($row['hack_version'] != '') ? ' v' . stripslashes($row['hack_version']) : '',
   'S_ACTION_EDIT' => '<a href="' . append_sid(basename(__FILE__) . '?mode=edit&hack_id=' . $row['hack_id']) . '">' . $lang['Edit'] . '</a>',
   'HACK_DISPLAY' => $lang[$row['hack_hide']],
   'ADD_DATE' => create_date($lang['DATE_FORMAT'], $row['log_time'], $board_config['board_timezone'])));
  }
  
  if ($i == 1 || !isset($i))
  {
   $template->assign_block_vars('empty_switch', array());
   $template->assign_var('L_NO_HACKS', $lang['No_Hacks']);
  }
 }
}


$template->assign_vars(array(
'L_VERSION' => $lang['Version'],
'VERSION' => MOD_VERSION,
'L_PAGE_NAME' => $page_title,
'S_ACTION_ADD' => '<a href="' . append_sid(basename(__FILE__) . '?mode=add') . '">' . $lang['Add_New_Hack'] . '</a>',

'S_MODE_ACTION' => append_sid(basename(__FILE__)),
'L_EDIT' => $lang['Edit'],
'L_DELETE' => $lang['Delete'],
'L_ADD_NEW_HACK' => $lang['Add_New_Hack'],
'L_AUTHOR' => $lang['Author'],
'L_DESCRIPTION' => $lang['Description'],
'L_SUBMIT' => $lang['Submit'],
'L_RESET' => $lang['Reset'],
'L_HACK_NAME' => $lang['Hack_Name'],
'L_AUTHOR_EMAIL' => $lang['Author_Email'],
'L_REQUIRED' => $lang['Required'],
'L_WEBSITE' => $lang['Website'],
'L_DOWNLOAD_URL' => $lang['Download_URL'],
'L_YES' => $lang['Yes'],
'L_NO' => $lang['No'],
'L_VERSION' => $lang['Version'],
'L_USER_VIEWABLE' => $lang['User_Viewable'],
'L_PAGE_DESC' => $lang['Page_Desc']));

if ($status_message != '')
{
 $template->assign_block_vars('statusrow', array());
 $template->assign_vars(array(
 'L_STATUS' => $lang['Status'],
 'I_STATUS_MESSAGE' => $status_message)
 );
}

$template->pparse('body');
include('page_footer_admin.'.$phpEx);

?>