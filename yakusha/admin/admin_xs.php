<?php
/***************************************************************************
 * admin_xs.php
 ***************************************************************************/
// CTracker_Ignore: File Checked By Human

if(empty($setmodules))
{
	return;
}

define('IN_XS', true);
define('XS_ADMIN_OVERRIDE', true);
include_once('xs_include.' . $phpEx);
return;

?>