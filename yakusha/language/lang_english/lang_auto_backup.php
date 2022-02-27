<?php
/***************************************************************************
 *                            lang_auto_backup.php [English]
 *                              -------------------
 *   begin                : Saturday, Mar 22 2003
 *   copyright            : (C) 2002-2004 by Omar Ramadan
 *   email                : princeomz2004@gmail.com
 *
 *   $Id: lang_auto_backup.php,v 1.13 2005/11/08 19:35:12 kkroo Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Automatic Database Backup Mod by kkroo < princeomz2004@hotmail.com > (Omar Ramadan) phpbb-login.sourceforge.net
//

$lang['Automatic_Backup'] = 'Automatic Database Backup';
$lang['Automatic_Backup_Explain'] = 'In this section, you can edit setings for your automatic database backup, to use the basic time setup, select <b>Basic Syntax</b>, if you want to use the advanced field, select <b>Advanced Syntax</b>. Here you can specify when you want the database to backup, and the email to send it to.';
$lang['Automatic_Backup_Form_Explain'] = 'For the email adress field, I recomend you use an email account that is not on the server, and has a lot of quota because the database file may be large. I personally recomend Gmail. The more complicated you set the time below, the longer it is going to take to load!';
$lang['Click_return_auto_backup'] = 'Click %sHere%s to return to Automatic Backup Configuration';
$lang['Error_updating_auto_backup'] = 'Error Updating SQL Backup data';
$lang['auto_backup_advanced_user'] = 'Advanced Syntax';
$lang['auto_backup_advanced_user_explain'] = 'This is a web interface to the crontab program. For example, * * * * * would mean every min and 0 0 * * * would mean at midnight of every day.';
$lang['auto_backup_basic_user'] = 'Basic Syntax';
$lang['auto_backup_level'] = 'Backup skill level';
$lang['Backup_type'] = 'Backup Settings';
$lang['phpBB_only'] = 'Only phpBB-related tables';
$lang['No_Search'] = 'Exclude Search tables';
$lang['Ignore_tables'] = 'Exclude Additional Tables';
$lang['Submit'] = 'Submit';
$lang['Reset'] = 'Reset';
$lang['Email_Address'] = 'Email Address';
$lang['Email_true'] = 'Email backups';
$lang['Delay_time'] = 'Delay Time';

// Minutes
$lang['Minutes'] = 'Minutes';
$lang['Every_Minute'] = 'Every Minute';
$lang['Every_Other_Minutes']= 'Every Other Minute';
$lang['Every_Five_Minutes']= 'Every Five Minutes';
$lang['Every_Ten_Minutes']= 'Every Ten Minutes';
$lang['Every_Fifteen_Minutes']= 'Every Fifteen Minutes';

// Hours
$lang['Hours'] = 'Hours';
$lang['Every_Hour'] = 'Every Hour';
$lang['Every_Other_Hour']= 'Every Other Hour';
$lang['Every_Four_Hours']= 'Every Four Hours';
$lang['Every_Six_Hours']= 'Every Six Hours';
$lang['Midnight']= 'Midnight';
$lang['Noon']= 'Noon';

// Days
$lang['Days'] = 'Day';
$lang['Every_Day'] = 'Every Day';

// Months
$lang['Months'] = 'Months';
$lang['Every_Month'] = 'Every Month';
$lang['January'] = 'January';
$lang['February'] = 'February';
$lang['March'] = 'March';
$lang['April'] = 'April';
$lang['May'] = 'May';
$lang['June'] = 'June';
$lang['July'] = 'July';
$lang['August'] = 'August';
$lang['September'] = 'September';
$lang['October'] = 'October';
$lang['November'] = 'November';
$lang['December'] = 'December';

// Weekdays
$lang['Weekdays'] = 'Weekdays';
$lang['Every_Weekday'] = 'Every Weekday';
$lang['Sunday'] = 'Sunday';
$lang['Monday'] = 'Monday';
$lang['Tuesday'] = 'Tuesday';
$lang['Wednesday'] = 'Wednesday';
$lang['Thursday'] = 'Thursday';
$lang['Friday'] = 'Friday';
$lang['Saturday'] = 'Saturday';

//FTP

$lang['FTP_true'] = 'Save backups to FTP server';
$lang['FTP_server'] = 'FTP Server';
$lang['FTP_user_name'] = 'FTP User Name';
$lang['FTP_user_pass'] = 'FTP User Password';
$lang['FTP_directory'] = 'FTP Directory';

// Write backups to backups directory
$lang['write_backups_true'] = 'Save backups to backups directory';
$lang['files_to_keep'] = 'Files to keep';
$lang['files_to_keep_explain'] = 'Enter the number of backups you would like to keep<br> in the text field. <b>-1</b> means keep all backups.';

$lang['Error_updating_auto_backup'] = 'Error Updating SQL Backup data';
$lang['Error_retrieving_auto_backup'] = 'Error retrieving SQL Backup data';
$lang['Error_enabling_disabling_board'] = 'Error enabling or disabling forum';
$lang['error_email_subject'] = 'An error occured while backing up your database';
$lang['auto_backup_email_message'] = 'Your database has been backed up successfully on ';
$lang['auto_backup_email_subject'] = 'Database Backup ';
$lang['file_saved_to_backups'] = 'The file has been saved to %s';

// FTP email messages
$lang['Current_directory'] = 'Current directory';
$lang['Change_directory_to'] = 'Changing directory to';
$lang['Couldnt_change_directory'] = 'Couldn\'t change directory';
$lang['Creating_directory'] = 'Creating Directory';
$lang['Created_directory'] = 'Created Directory';
$lang['Cant_Create_directory'] = 'Couldn\'t create directory';
$lang['FTP_upload_failed'] = 'FTP upload has failed';
$lang['FTP_connection_failed'] = 'FTP conntection has failed';
$lang['FTP_file_information'] = 'FTP file information';
$lang['Uploaded_file_to'] = 'Uploaded %s to ';

?>