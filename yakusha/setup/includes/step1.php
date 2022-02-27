<?php
// CTracker_Ignore: File Checked By Human

if(!defined('setup'))
{
die('Hacking attempt');
}

if(empty($mode))
{
	$step = 1;
	$linkextension = '?step='.$step.'&lang='.$language;

	echo "<img src='images/yukle01.png'>&nbsp; <b>".$langu['welcome']."</b><p>";
	echo $langu['welcome_text']."<br /><br /><p><b>".$langu['imethod']."</b><p>";
	echo $langu['imethod_text']."<p>".$langu['destek']." <p>";
	echo '<br /><p align="center" style="font-weight:bold;">&laquo; &nbsp;<a href="index.php'.$linkextension.'&mode=install">'.$langu['install'].'</a>&nbsp; - &nbsp;<a href="index.php'.$linkextension.'&mode=convert">'.$langu['convert'].'</a>&nbsp; &raquo;</p>';

}
else
{
	$step = 2;

	$chmodpath = '../';
	$chmodcheck = array(
		$chmodpath."cache", 
		$chmodpath."files", 
		$chmodpath."images/avatars",
		$chmodpath."ctracker/logfiles/logfile_worms.txt",
		$chmodpath."ctracker/logfiles/logfile_spammer.txt",
		$chmodpath."ctracker/logfiles/logfile_worms.txt",
		$chmodpath."ctracker/logfiles/logfile_spammer.txt",
		$chmodpath."ctracker/logfiles/logfile_malformed_logins.txt",
		$chmodpath."ctracker/logfiles/logfile_blocklist.txt",
		$chmodpath."ctracker/logfiles/logfile_attempt_counter.txt",
	);
	for ($i = 0; $a > 7; $i++)
	{
		chmod ($chmodpath.$chmodcheck[$i], 777);
	}

	$linkext = '?step='.$step.'&lang='.$language.'&mode='.$mode;
	$link3 = '<a href="index.php'.$linkext.'">'.$langu['ok_btn'].'</a>';

	echo "<img src='images/yukle05.png'>&nbsp; <b>".$langu['ch_mods']."</b><p>";
	echo $langu['ch_modt']."<p><center><table border='1' width='80%' cellpadding='6'>";

	foreach ($chmodcheck as $dir)
	{
		echo "<tr><td width='70%' align='left' bgcolor='#f4f4f4'><font face='Verdana' size='2'>$dir</font></td>";

		@chmod($dir,0777);
		if(is_writeable($dir))
		{
			echo "<td width='30%' align='right' bgcolor='#f0f0f0'><font face='Verdana' size='2'>".$langu['ch_ok']."</font></td>";
		}
		else if(!is_writeable($dir))
		{
			echo "<td width='30%' align='right' bgcolor='#f0f0f0'><font face='Verdana' size='2'>".$langu['ch_nok']."</font></td>";
		}
		else
		{
			echo "<td width='30%' align='right' bgcolor='#f0f0f0'><font face='Verdana' size='2'>".$langu['ch_uok']."</font></td>";
		}
		echo "</tr>";
	}
	echo "</table><p><b>$link3</b> <p>";
}

?>