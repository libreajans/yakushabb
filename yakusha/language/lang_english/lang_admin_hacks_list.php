<?php

if ( !defined('IN_PHPBB') )
{
die("Hacking attempt");
}

/***************************************************************************
* $RCSfile: lang_admin_hacks_list.php,v $
* -------------------
* copyright : (C) 2003 Nivisec.com
* email : support@nivisec.com
*
* $Id: lang_admin_hacks_list.php,v 1.3 2003/07/10 16:50:23 nivisec Exp $
***************************************************************************/
/***************************************************************************
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
***************************************************************************/

/* General */
$lang['Hacks_List'] = 'Mods List';
$lang['Page_Desc'] = 'This module allows you to add/edit/delete the list of current hacks/mods on your board. They are displayed for users when they visit the <a href="../modlist.php" target="new">mods list</a> page.';
$lang['Deleted_Hack'] = 'Deleted hack %s from the list.<br />';
$lang['Updated_Hack'] = 'Updated info for hack %s.<br />';
$lang['Added_Hack'] = 'Added info for hack %s.<br />';
$lang['Status'] = 'Status';
$lang['No_Website'] = 'No website is available.';
$lang['No_Hacks'] = 'No hacks to display.';
$lang['Add_New_Hack'] = 'Add A New Hack';
$lang['User_Viewable'] = 'Hide';
$lang['Hack_Name'] = 'Hack Name';
$lang['Description'] = 'Description';
$lang['Required'] = 'Required';
$lang['Author_Email'] = 'Author Email';
$lang['Version'] = 'Version';
$lang['Download_URL'] = 'Download Location';

$lang['Look_up_hack'] = 'Mod Search';
$lang['Mod_no_found'] = 'Mod no found';

/* Errors */
$lang['Error_Hacks_List_Table'] = 'Error querying the Hacks List Table.';
$lang['Required_Field_Missing'] = 'You failed to enter all required information.';
$lang['Error_File_Opening'] = 'Unable to open the file: %s';

/*Special Cases, Do not bother to change for another language */
$lang['YES'] = @$lang['Yes'];
$lang['NO'] = @$lang['No'];
$lang['HL_File_Error'] = @$lang['Error_File_Opening'];

?>