<?php
/***************************************************************************
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
***************************************************************************/
if(!defined('setup'))
{
	die('Hacking attempt');
}

$langu['welcome'] = $yakusha_version .' install';
$langu['welcome_text'] = 'Thank you for choosing '.$yakusha_version.'
<p>We are honoured to serve you with '.$yakusha_version.'. Automatic setting tool will help you 
with the installation of the forum.

<p>Before this installation process, please ensure you have created a new blank <b>MySQL database</b>
or you can achieve the installation on your previous forum tables.';

$langu['imethod'] = 'Choose a setup method';
$langu['convert'] = 'Convert from phpBB';
$langu['install'] = 'New installation';
$langu['imethod_text'] = ' If this phpBB '.$yakusha_version.' will be your first installation on a blank database, please click <b>'.$langu['install'].' </b>
<p>If you want to convert from phpBB 2.0.19 and a newer version to '.$yakusha_version.', please click <b>'.$langu['convert'].'</b>.
<p><b>Warning:</b> This process will save your standart phpBB information but you will lose  the data coming with other modifications. If you prefer to convert, please have a copy of your database and files.';
 
$langu['destek'] = '<b><font color="green">All the technical information regarding the installation and the things to be done, have been explained in <u><a target="destek" href="http://www.yakusha.net/destek/index.html">support files</a></u> prepared by Yakusha Team</font></b>';
$langu['ch_mods'] = 'CHMOD - permissions of files';
$langu['ch_modt'] = 'Installation system is checking the permissions of related files.
If the permissions of directories and files are valid as  CHMOD 777, please go on.
If CHMOD settings are wrong, after right clicking over directories or files related FTP program, you have to set the permissýons of directories and files as CHMOD 777 or rwx-rwx-rwx';
$langu['ch_ok'] = '<font color="green"><b>Ok.</b></font>';
$langu['ch_nok'] = '<font color="red"><b>Error</b></font>';
$langu['ch_uok'] = '<font color="yellow"><b>Empty</b></font>';
$langu['ok_btn'] = 'continue';

$langu['installd'] = 'Installation and management';
$langu['installd1'] = 'To install, you have to fill the information in the forum, please ensure you have entered the informations correctly.
<p><font color="red"><b>Warnýng:</b></font> First of all, you have to create a blank database. Your domain name must not include prefix http:// and suffix \'/\'.
<p>Please ensure you have entered the informations correctly, otherwise setup can not be completed.
<p>Using the information you have entered, installation script will create the installation configurations as unchangeble and form the<b>config.php</b> file. You are allowed to use a different table prefix.';

$langu['field0a'] = 'Database Type';
$langu['field0b'] = 'Undefined version';

$langu['convert1'] = 'Convert';
$langu['convert2'] = 'The automatic convert function will change your phpBB forum with yakusha '.$yakusha_version.' version. All necessary information will be supported by config.php file for this process.
For your safety and continuation of the process please confirm your database password.
<p>Please, upload your old config.php file into the new '.$yakusha_version.' forum.
<p><font color="red"><b>Warning:</b></font> Before converting, please ensure, you have already had a copy of your old files and database.';
$langu['fieldC'] = 'Confirm your MySQL password.';
$langu['fieldD'] = 'Installation script couldnt find your config.php files.
Please, load your old config.php into your new '.$yakusha_version.' forum. 
if you cant find the related file, create a config.php file made according to your previuos forum settings and load it.';
$langu['fieldF'] = 'Update';

$langu['field0'] = 'Database-Host';
$langu['field1'] = 'Database-Name';
$langu['field2'] = 'MySQL-DB-User';
$langu['field3'] = 'MySQL-DB-Pass';
$langu['field4'] = 'Table prefix';
$langu['field5'] = 'Domain-Name';
$langu['field6'] = 'Script path';
$langu['field7'] = 'Server Port';
$langu['field8'] = 'Administrator username';
$langu['field9'] = 'Admin email address';
$langu['fieldA'] = 'Administrator password';
$langu['fieldB'] = 'Password - [confirm]' ;

$langu['fieldE'] = 'start the installation';
$langu['err1'] = '<b>ERROR:</b><p>Could not connect to the database. Please ensure you entered words are true. Click <b>BACK</b>';
$langu['err2'] = '<b>ERROR:</b><p>Could not find to the database name.please ensure you entered words are true. Click <b>BACK</b>';
$langu['err3'] = '<b>PASWORD ERROR:</b><p>The password you entered did not match. Please ensure you entered words are match. Click <b>BACK</b>';
$langu['err4'] = '<b>please complete all sections</b><p>Please  try again . Click <b>BACK</b>';
$langu['running'] = '<center>The installation is running. Please wait until you see the CONTINUE link';
$langu['dbresponse1'] = '<b><font color="green">Database process is over!</font></b>';
$langu['dbresponse2'] = '<b><font color="red">ERROR</font></b>';

$langu['fertig'] = '<b>CONGRATULATIONS!</b>
<p><img src="images/yukle04.png">THE SETUP has been INSTALLED!
Thank you for choosing '.$yakusha_version.'.
Please ensure  the install directory is deleted<p><b>WARNING!</b>
At this point your basic installation is complete. You will now be taken to a screen which will allow you to administer your new installation. Please be sure to check the General Configuration Details and make any required changes.<p><a href="../index.php"><p><a href="../index.php">
<center>please click here to go back to Forum index</a> ';

$langu['cwrit'] = '<center>Your admin username has been created. At this point your basic installation is complete. Please click finish to log out.<br /><p><p>';

$langu['cdol'] = '<b>config.php install</b><p>
<img src="images/config.png">
your config.php files has been created.  Please save config.php and move it to the root directory of your forum. You can use one of the ftp programs.<p>his is the directory which includes the files like index.php, viewtopic.php etc. after this process, click finish and end the installation.<p>';

$langu['dload'] = ' save config.php';
$langu['fstell'] = 'Fýnýsh';

// EoF
?>
