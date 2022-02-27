<?php

// CTracker_Ignore: File Checked By Human

if(!defined('setup'))
{
die('Hacking attempt');
}
/***************************************************************************
* begin : Sunday, Okt 16, 2005
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
* email : info@cback.de
***************************************************************************/

// Reset Vars
$dbtyp = '';
$dbhost = '';
$dbname = '';
$dbuser = '';
$dbpass = '';
$dbprefix = '';
$domainname = '';
$skriptpfad = '';
$serverport = '';
$adminnick = '';
$adminmail = '';
$adminpass = '';
$adminpasswh = '';

// Installautomatisierung
$dbhost = 'localhost';

if (!empty($HTTP_SERVER_VARS['SERVER_NAME']) || !empty($HTTP_ENV_VARS['SERVER_NAME']))
{
$domainname = (!empty($HTTP_SERVER_VARS['SERVER_NAME'])) ? $HTTP_SERVER_VARS['SERVER_NAME'] : $HTTP_ENV_VARS['SERVER_NAME'];
}
else if (!empty($HTTP_SERVER_VARS['HTTP_HOST']) || !empty($HTTP_ENV_VARS['HTTP_HOST']))
{
$domainname = (!empty($HTTP_SERVER_VARS['HTTP_HOST'])) ? $HTTP_SERVER_VARS['HTTP_HOST'] : $HTTP_ENV_VARS['HTTP_HOST'];
}
else
{
$domainname = '';
}

if(!empty($domainname))
{
$domainname .= str_replace('/setup', '', dirname($HTTP_SERVER_VARS['PHP_SELF']));
$skriptpfad = '/';
}
else
{
$skriptpfad = str_replace('setup', '', dirname($HTTP_SERVER_VARS['PHP_SELF']));
}

if (!empty($HTTP_POST_VARS['server_port']))
{
$serverport = $HTTP_POST_VARS['server_port'];
}
else
{
if (!empty($HTTP_SERVER_VARS['SERVER_PORT']) || !empty($HTTP_ENV_VARS['SERVER_PORT']))
{
$serverport = (!empty($HTTP_SERVER_VARS['SERVER_PORT'])) ? $HTTP_SERVER_VARS['SERVER_PORT'] : $HTTP_ENV_VARS['SERVER_PORT'];
}
else
{
$serverport = '80';
}
}

// Seite ausgeben
if($mode == 'install')
{
$dbhost = 'localhost';
$dbprefix = 'phpbb_';

echo "<img src='images/yukle03.png'> <b>".$langu['installd']."</b><p>".$langu['installd1']."<p>";
echo "<form method='post' action='index.php?step=3&lang=$language&mode=install'><center><table border='0' width='80%' cellspacing='2' cellpadding='2'>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right' valign='top'><font size='2' face='Verdana'>".$langu['field0a']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><font size='2' face='Verdana'>
<input type='radio' name='dbtyp' value='mysql'> MySQL 3<br />
<input type='radio' name='dbtyp' value='mysql4' checked='true'> MySQL 4<br />
<input type='radio' name='dbtyp' value='mysql4'> MySQL 5<br />
<input type='radio' name='dbtyp' value='mysql'> MySQL (".$langu['field0b'].")</font></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field0']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$dbhost' name='dbhost' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field1']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$dbname' name='dbname' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field2']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$dbuser' name='dbuser' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field3']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='password' value='$dbpass' name='dbpass' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field4']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$dbprefix' name='dbprefix' size='44'></td>
</tr>";

echo "<tr height='30px'><td colspan='2'></td></tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field5']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$domainname' name='domainname' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field6']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$skriptpfad' name='skriptpfad' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field7']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$serverport' name='serverport' size='44'></td>
</tr>";

echo "<tr height='30px'><td colspan='2'></td></tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field8']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$adminnick' name='adminnick' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['field9']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='text' value='$adminmail' name='adminmail' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['fieldA']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='password' value='$adminpass' name='adminpass' size='44'></td>
</tr>";

echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['fieldB']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='password' value='$adminpasswh' name='adminpasswh' size='44'></td>
</tr>
<input type='hidden' name='report' value='true'>
";

echo "<tr height='30px'><td colspan='2' valign='center' align='right' bgcolor='#e0e0e0'><input type='submit' name='submit' value='".$langu['fieldE']."'</td></tr>";
echo "</table> <p></form>";
}
if($mode == 'convert')
{
$dbhost = 'localhost';
$dbprefix = 'phpbb_';
echo "<img src='images/yukle07.png'>&nbsp; <b>".$langu['convert1']."</b><p>".$langu['convert2']."<p>";

if(file_exists("../config.php"))
{
echo "<form method='post' action='index.php?step=3&lang=$language&mode=convert'><p><center><table border='0' width='80%' cellspacing='2' cellpadding='2'>";
echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['fieldC']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='password' value='$dbpass' name='dbpass' size='44'></td>
</tr>";
echo "<tr height='30px'><td colspan='2' valign='center' align='right' bgcolor='#e0e0e0'><input type='submit' name='submit' value='".$langu['fieldF']."'</td></tr>";
echo "</table> <p></form>";
}
else
{
echo "<p><table border='0' width='80%' cellpadding='6'><tr><td align='left' bgcolor='#FFAA2F'><font size=2>".$langu['fieldD']."</font></td></tr></table><p> ";
}

}
if($mode == 'update')
{
echo "<img src='images/yukle06.png'>&nbsp; <b>".$langu['installu']."</b><p>".$langu['installu1']."<p>";

if(file_exists("../config.php"))
{
echo "<form method='post' action='index.php?step=3&lang=$language&mode=update'><p><center><table border='0' width='80%' cellspacing='2' cellpadding='2'>";
echo "<tr>
<td width='50%' bgcolor='#f4f4f4' align='right'><font size='2' face='Verdana'>".$langu['fieldC']."</font></td>
<td width='50%' bgcolor='#f0f0f0' align='left'><input type='password' value='$dbpass' name='dbpass' size='44'></td>
</tr>";
echo "<tr height='30px'><td colspan='2' valign='center' align='right' bgcolor='#e0e0e0'><input type='submit' name='submit' value='".$langu['fieldF']."'</td></tr>";
echo "</table> <p></form>";
}
else
{
echo "<p><table border='0' width='80%' cellpadding='6'><tr><td align='left' bgcolor='#FFAA2F'><font size=2>".$langu['fieldD']."</font></td></tr></table><p> ";
}

}
?>