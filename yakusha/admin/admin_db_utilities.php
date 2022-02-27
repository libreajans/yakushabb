<?php
/***************************************************************************
* admin_db_utilities.php
***************************************************************************/

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$filename = basename(__FILE__);
	$module['ZDatabase']['BBackup_DB'] = $filename . "?perform=backup";

	$file_uploads = (@phpversion() >= '4.0.0') ? @ini_get('file_uploads') : @get_cfg_var('file_uploads');

	if( (empty($file_uploads) || $file_uploads != 0) && (strtolower($file_uploads) != 'off') && (@phpversion() != '4.0.4pl1') )
	{
		$module['ZDatabase']['CRestore_DB'] = $filename . "?perform=restore";
	}

	return;
}

//
// Load default header
//

$phpbb_root_path = './../';
$no_page_header = TRUE;
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/sql_parse.'.$phpEx);

//
// Set VERBOSE to 1  for debugging info..
//
define('VERBOSE', 0);

//
// Increase maximum execution time, but don't complain about it if it isn't
// allowed.
//
@set_time_limit(1200);

$drop_search = (!empty($HTTP_POST_VARS['drop_search'])) ? $HTTP_POST_VARS['drop_search'] : ( (!empty($HTTP_GET_VARS['drop_search'])) ? $HTTP_GET_VARS['drop_search'] : 0 );

if ($drop_search == 1)
{
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "admin_nav_module;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "ctracker_filescanner;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "ctracker_filechk;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "ctracker_loginhistory;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "confirm;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "search_rebuild;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "search_results;");
    mysql_query(" TRUNCATE TABLE " . $table_prefix . "search_wordlist;");
}

// -----------------------
// The following functions are adapted from phpMyAdmin and upgrade_20.php
//
function gzip_PrintFourChars($Val)
{
	for ($i = 0; $i < 4; $i ++)
	{
		$return .= chr($Val % 256);
		$Val = floor($Val / 256);
	}
	return $return;
} 


//
// This function returns the "CREATE TABLE" syntax for mysql dbms...
//

function get_table_def_mysql($table, $crlf)
{
	global $drop, $db;

	$schema_create = "";
	$field_query = "SHOW FIELDS FROM $table";
	$key_query = "SHOW KEYS FROM $table";

	//
	// If the user has selected to drop existing tables when doing a restore.
	// Then we add the statement to drop the tables....
	//
	if ($drop == 1)
	{
		$schema_create .= "DROP TABLE IF EXISTS $table;$crlf";
	}

	$schema_create .= "CREATE TABLE $table($crlf";

	//
	// Ok lets grab the fields...
	//
	$result = $db->sql_query($field_query);
	if(!$result)
	{
		message_die(GENERAL_ERROR, "Failed in get_table_def (show fields)", "", __LINE__, __FILE__, $field_query);
	}

	while ($row = $db->sql_fetchrow($result))
	{
		$schema_create .= '	' . $row['Field'] . ' ' . $row['Type'];

		if(!empty($row['Default']))
		{
			$schema_create .= ' DEFAULT \'' . $row['Default'] . '\'';
		}

		if($row['Null'] != "YES")
		{
			$schema_create .= ' NOT NULL';
		}

		if($row['Extra'] != "")
		{
			$schema_create .= ' ' . $row['Extra'];
		}

		$schema_create .= ",$crlf";
	}
	//
	// Drop the last ',$crlf' off ;)
	//
	$schema_create = ereg_replace(',' . $crlf . '$', "", $schema_create);

	//
	// Get any Indexed fields from the database...
	//
	$result = $db->sql_query($key_query);
	if(!$result)
	{
		message_die(GENERAL_ERROR, "FAILED IN get_table_def (show keys)", "", __LINE__, __FILE__, $key_query);
	}

	while($row = $db->sql_fetchrow($result))
	{
		$kname = $row['Key_name'];

		if(($kname != 'PRIMARY') && ($row['Non_unique'] == 0))
		{
			$kname = "UNIQUE|$kname";
		}

		if(!is_array($index[$kname]))
		{
			$index[$kname] = array();
		}

		$index[$kname][] = $row['Column_name'];
	}

	while(list($x, $columns) = @each($index))
	{
		$schema_create .= ", $crlf";

		if($x == 'PRIMARY')
		{
			$schema_create .= '	PRIMARY KEY (' . implode($columns, ', ') . ')';
		}
		elseif (substr($x,0,6) == 'UNIQUE')
		{
			$schema_create .= '	UNIQUE ' . substr($x,7) . ' (' . implode($columns, ', ') . ')';
		}
		else
		{
			$schema_create .= "	KEY $x (" . implode($columns, ', ') . ')';
		}
	}

	$schema_create .= "$crlf);";

	if(get_magic_quotes_runtime())
	{
		return(stripslashes($schema_create));
	}
	else
	{
		return($schema_create);
	}

} // End get_table_def_mysql


//
// This function is for getting the data from a mysql table.
//

function get_table_content_mysql($table, $handler)
{
	global $db;

	// Grab the data from the table.
	if (!($result = $db->sql_query('SELECT * FROM '.$table)))
	{
		message_die(GENERAL_ERROR, "Failed in get_table_content (select *)", '', __LINE__, __FILE__, 'SELECT * FROM '.$table);
	}

	// Loop through the resulting rows and build the sql statement.
	if ($row = $db->sql_fetchrow($result))
	{
		$handler("\n#\n# Table Data for $table\n#\n");
		$field_names = array();

		// Grab the list of field names.
		$num_fields = $db->sql_numfields($result);
		$table_list = '(';
		for ($j = 0; $j < $num_fields; $j++)
		{
			$field_names[$j] = $db->sql_fieldname($j, $result);
			$table_list .= (($j > 0) ? ', ' : '') . $field_names[$j];
			
		}
		$table_list .= ')';

		do
		{
			// Start building the SQL statement.
			$schema_insert = "INSERT INTO $table $table_list VALUES(";

			// Loop through the rows and fill in data for each column
			for ($j = 0; $j < $num_fields; $j++)
			{
				$schema_insert .= ($j > 0) ? ', ' : '';

				if(!isset($row[$field_names[$j]]))
				{
					//
					// If there is no data for the column set it to null.
					// There was a problem here with an extra space causing the
					// sql file not to reimport if the last column was null in
					// any table.  Should be fixed now :) JLH
					//
					$schema_insert .= 'NULL';
				}
				elseif ($row[$field_names[$j]] != '')
				{
					$schema_insert .= '\'' . addslashes($row[$field_names[$j]]) . '\'';
				}
				else
				{
					$schema_insert .= '\'\'';
				}
			}

			$schema_insert .= ');';

			// Go ahead and send the insert statement to the handler function.
			$handler(trim($schema_insert));

		}
		while ($row = $db->sql_fetchrow($result));
	}

	return(true);
}



function output_table_content($content)
{
	global $tempfile;

	//fwrite($tempfile, $content . "\n");
	//$backup_sql .= $content . "\n";
	echo $content ."\n";
	return;
}
//
// End Functions
// -------------


//
// Begin program proper
//
if( isset($HTTP_GET_VARS['perform']) || isset($HTTP_POST_VARS['perform']) )
{
	$perform = (isset($HTTP_POST_VARS['perform'])) ? $HTTP_POST_VARS['perform'] : $HTTP_GET_VARS['perform'];

	switch($perform)
	{
		case 'backup':

			$error = false;
			switch(SQL_LAYER)
			{
				case 'oracle':
					$error = true;
					break;
				case 'db2':
					$error = true;
					break;
				case 'msaccess':
					$error = true;
					break;
				case 'mssql':
				case 'mssql-odbc':
					$error = true;
					break;
			}

			if ($error)
			{
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					'body' => 'admin/admin_message_body.tpl')
				);

				$template->assign_vars(array(
					'MESSAGE_TITLE' => $lang['Information'],
					'MESSAGE_TEXT' => $lang['Backups_not_supported'])
				);

				$template->pparse('body');

				include('./page_footer_admin.'.$phpEx);
			}
/*
                        $tables = array(
                        'admin_nav_module', 'attach_quota', 'attachments', 'attachments_config', 'attachments_desc',
                        'auth_access', 'banlist', 'captcha_config', 'categories', 'color_groups', 'config',
                        'confirm', 'ctracker_config', 'ctracker_filechk', 'ctracker_filescanner',
                        'ctracker_ipblocker', 'ctracker_loginhistory', 'disallow', 'edit_notes', 'extension_groups',
                        'extensions', 'favorites', 'forbidden_extensions', 'forums', 'forum_prune',
                        'groups', 'hacks_list', 'inline_ads', 'posts',
                        'posts_text', 'privmsgs', 'privmsgs_text', 'quota_limits', 'rules',
                        'ranks', 'report', 'report_cat', 'search_results', 'search_wordlist',
                        'search_wordmatch', 'sessions', 'sessions_keys', 'search_rebuild', 'smilies',
                        'themes', 'themes_name', 'topics', 'topics_watch', 'user_group',
                        'users', 'vote_desc', 'vote_results', 'vote_voters', 'words','portal'
                        );*/
			$sql = "SHOW TABLES LIKE '{$table_prefix}%'";
			$result = $db->sql_query($sql);
			if ( !$result )
			{
				message_die(GENERAL_ERROR, "Error listing table names", "", __LINE__, __FILE__, $sql);
			}
			else
			{
				$tables = array();
				$prefix_length = strlen($table_prefix);
				while ( ($row=$db->sql_fetchrow($result)) )
				{
					// Not all sql engines return key named '0'
					$keys = array_keys($row);
					$key0 = is_array($keys) ? $keys[0] : 0;
					$tbl = $row[$key0];
					if ( strlen($tbl) > $prefix_length )
					{	
						$tables[] = substr($tbl,$prefix_length);
					}
				}
			}

			$backup_type = (isset($HTTP_POST_VARS['backup_type'])) ? $HTTP_POST_VARS['backup_type'] : ( (isset($HTTP_GET_VARS['backup_type'])) ? $HTTP_GET_VARS['backup_type'] : '' );

			$gzipcompress = (!empty($HTTP_POST_VARS['gzipcompress'])) ? $HTTP_POST_VARS['gzipcompress'] : ( (!empty($HTTP_GET_VARS['gzipcompress'])) ? $HTTP_GET_VARS['gzipcompress'] : 0 );

			$drop = (!empty($HTTP_POST_VARS['drop'])) ? intval($HTTP_POST_VARS['drop']) : ( (!empty($HTTP_GET_VARS['drop'])) ? intval($HTTP_GET_VARS['drop']) : 0 );


			if( !isset($HTTP_POST_VARS['backupstart']) && !isset($HTTP_GET_VARS['backupstart']))
			{
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					'body' => 'admin/db_utils_backup_body.tpl')
				);	
				$s_hidden_fields = "<input type=\"hidden\" name=\"perform\" value=\"backup\" /><input type=\"hidden\" name=\"drop\" value=\"1\" /><input type=\"hidden\" name=\"perform\" value=\"$perform\" />";

				$template->assign_vars(array(
					'L_DATABASE_BACKUP' => $lang['Database_Utilities'] . ' : ' . $lang['Backup'],
					'L_BACKUP_EXPLAIN' => $lang['Backup_explain'],
					'L_FULL_BACKUP' => $lang['Full_backup'],
					'L_STRUCTURE_BACKUP' => $lang['Structure_backup'],
					'L_DATA_BACKUP' => $lang['Data_backup'],
					'L_ADDITIONAL_TABLES' => $lang['Additional_tables'],
					'L_START_BACKUP' => $lang['Start_backup'],
					'L_BACKUP_OPTIONS' => $lang['Backup_options'],
					'L_GZIP_COMPRESS' => $lang['Gzip_compress'],
					'L_NO' => $lang['No'],
					'L_YES' => $lang['Yes'],
					'L_DROP_FAZLA' => $lang['Fazlalik_degerleri_bosalt'],
					'L_DROP_FAZLA_SORT' => $lang['Fazlalik_degerleri_bosalt_sort'],

					'S_HIDDEN_FIELDS' => $s_hidden_fields,
					'S_DBUTILS_ACTION' => append_sid('admin_db_utilities.'.$phpEx))
				);
				$template->pparse('body');

				break;

			}
			else if( !isset($HTTP_POST_VARS['startdownload']) && !isset($HTTP_GET_VARS['startdownload']) )
			{
				if(is_array($additional_tables))
				{
					$additional_tables = implode(',', $additional_tables);
				}
				$template->set_filenames(array(
					'body' => 'admin/admin_message_body.tpl')
				);

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="2;url=' . append_sid("admin_db_utilities.$phpEx?perform=backup&additional_tables=" . quotemeta($additional_tables) . "&backup_type=$backup_type&drop=1&amp;backupstart=1&gzipcompress=$gzipcompress&startdownload=1") . '">',

					'MESSAGE_TITLE' => $lang['Database_Utilities'] . ' : ' . $lang['Backup'],
					'MESSAGE_TEXT' => $lang['Backup_download'])
				);

				include('./page_header_admin.'.$phpEx);

				$template->pparse('body');

				include('./page_footer_admin.'.$phpEx);

			}
			header('Pragma: no-cache');
			$do_gzip_compress = FALSE;
			if( $gzipcompress )
			{
				$phpver = phpversion();

				if($phpver >= '4.0')
				{
					if(extension_loaded('zlib'))
					{
						$do_gzip_compress = TRUE;
					}
				}
			}

                        $gendate = create_date('d-m-Y_H-i', time(), $board_config['board_timezone'])."_".$backup_type;
                        if($do_gzip_compress)
			{
				@ob_start();
				@ob_implicit_flush(0);
				header("Content-Type: application/x-gzip; name=\"backup_$gendate.sql.gz\"");
				header("Content-disposition: attachment; filename=backup_$gendate.sql.gz");
			}
			else
			{
				header("Content-Type: text/x-delimtext; name=\"backup_$gendate.sql\"");
				header("Content-disposition: attachment; filename=backup_$gendate.sql");
			}

			//
			// Build the sql script file...
			//
			echo "#\n";
			echo "# phpBB Backup Script\n";
			echo "# Dump of tables for $dbname\n";
			echo "#\n# DATE : " .  gmdate("d-m-Y H:i:s", time()) . " GMT\n";
			echo "#\n";

			for($i = 0; $i < count($tables); $i++)
			{
				$table_name = $tables[$i];

				switch (SQL_LAYER)
				{
					case 'mysql':
					case 'mysql4':
                                                $table_def_function = "get_table_def_mysql";
						$table_content_function = "get_table_content_mysql";
						break;
				}

				if($backup_type != 'data')
				{
					echo "#\n# TABLE: " . $table_prefix . $table_name . "\n#\n";
					echo $table_def_function($table_prefix . $table_name, "\n") . "\n";
				}

				if($backup_type != 'structure')
				{
					$table_content_function($table_prefix . $table_name, "output_table_content");
				}
			}
			
			if($do_gzip_compress)
			{
				$Size = ob_get_length();
				$Crc = crc32(ob_get_contents());
				$contents = gzcompress(ob_get_contents());
				ob_end_clean();
				echo "\x1f\x8b\x08\x00\x00\x00\x00\x00".substr($contents, 0, strlen($contents) - 4).gzip_PrintFourChars($Crc).gzip_PrintFourChars($Size);
			}
			exit;

			break;

		case 'restore':
			if(!isset($HTTP_POST_VARS['restore_start']))
			{
				//
				// Define Template files...
				//
				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					'body' => 'admin/db_utils_restore_body.tpl')
				);

				$s_hidden_fields = "<input type=\"hidden\" name=\"perform\" value=\"restore\" /><input type=\"hidden\" name=\"perform\" value=\"$perform\" />";

				$template->assign_vars(array(
					'L_DATABASE_RESTORE' => $lang['Database_Utilities'] . ' : ' . $lang['Restore'],
					'L_RESTORE_EXPLAIN' => $lang['Restore_explain'],
					'L_SELECT_FILE' => $lang['Select_file'],
					'L_START_RESTORE' => $lang['Start_Restore'],

					'S_DBUTILS_ACTION' => append_sid('admin_db_utilities.'.$phpEx),
					'S_HIDDEN_FIELDS' => $s_hidden_fields)
				);
				$template->pparse('body');

				break;

			}
			else
			{
				//
				// Handle the file upload ....
				// If no file was uploaded report an error...
				//
				$backup_file_name = (!empty($HTTP_POST_FILES['backup_file']['name'])) ? $HTTP_POST_FILES['backup_file']['name'] : '';
				$backup_file_tmpname = ($HTTP_POST_FILES['backup_file']['tmp_name'] != 'none') ? $HTTP_POST_FILES['backup_file']['tmp_name'] : '';
				$backup_file_type = (!empty($HTTP_POST_FILES['backup_file']['type'])) ? $HTTP_POST_FILES['backup_file']['type'] : '';

				if($backup_file_tmpname == '' || $backup_file_name == '')
				{
					message_die(GENERAL_MESSAGE, $lang['Restore_Error_no_file']);
				}
				//
				// If I file was actually uploaded, check to make sure that we
				// are actually passed the name of an uploaded file, and not
				// a hackers attempt at getting us to process a local system
				// file.
				//
				if( file_exists(phpbb_realpath($backup_file_tmpname)) )
				{
					if( preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?gzip(\-compressed)?)|(application\/octet-stream)$/is", $backup_file_type) )
					{
						if( preg_match("/\.gz$/is",$backup_file_name) )
						{
							$do_gzip_compress = FALSE;
							$phpver = phpversion();
							if($phpver >= '4.0')
							{
								if(extension_loaded('zlib'))
								{
									$do_gzip_compress = TRUE;
								}
							}

							if($do_gzip_compress)
							{
								$gz_ptr = gzopen($backup_file_tmpname, 'rb');
								$sql_query = '';
								while( !gzeof($gz_ptr) )
								{
									$sql_query .= gzgets($gz_ptr, 100000);
								}
							}
							else
							{
								message_die(GENERAL_ERROR, $lang['Restore_Error_decompress']);
							}
						}
						else
						{
							$sql_query = fread(fopen($backup_file_tmpname, 'r'), filesize($backup_file_tmpname));
						}
						//
						// Comment this line out to see if this fixes the stuff...
						//
						//$sql_query = stripslashes($sql_query);
					}
					else
					{
						message_die(GENERAL_ERROR, $lang['Restore_Error_filename'] ." $backup_file_type $backup_file_name");
					}
				}
				else
				{
					message_die(GENERAL_ERROR, $lang['Restore_Error_uploading']);
				}

				if($sql_query != "")
				{
					// Strip out sql comments...
					$sql_query = remove_remarks($sql_query);
					$pieces = split_sql_file($sql_query, ';');

					$sql_count = count($pieces);
					for($i = 0; $i < $sql_count; $i++)
					{
						$sql = trim($pieces[$i]);

						if(!empty($sql) and $sql[0] != '#')
						{
							if(VERBOSE == 1)
							{
								echo "Executing: $sql\n<br>";
								flush();
							}

							$result = $db->sql_query($sql);

							if(!$result && ( !(SQL_LAYER == 'postgresql' && eregi("drop table", $sql) ) ) )
							{
								message_die(GENERAL_ERROR, 'Error importing backup file', '', __LINE__, __FILE__, $sql);
							}
						}
					}
				}

				include('./page_header_admin.'.$phpEx);

				$template->set_filenames(array(
					'body' => 'admin/admin_message_body.tpl')
				);

				$message = $lang['Restore_success'];

				$template->assign_vars(array(
					'MESSAGE_TITLE' => $lang['Database_Utilities'] . ' : ' . $lang['Restore'],
					'MESSAGE_TEXT' => $message)
				);

				$template->pparse('body');
				break;
			}
			break;
	}
}

include('./page_footer_admin.'.$phpEx);

?>