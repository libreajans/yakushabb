<script type="text/javascript">
<!--
function selectValueFromSelect(/*HTMLSelectElement*/ sel, /*String*/ val) {
  for(var i=0;sel.options[i].value != val;i++) void(0);
  sel.selectedIndex = i;
}

// -->
</script>
<body onload='selectValueFromSelect(document.getElementsByName("minute")[0], "{MINUTES}"); selectValueFromSelect(document.getElementsByName("hour")[0], "{HOURS}"); selectValueFromSelect(document.getElementsByName("day")[0], "{DAYS}"); selectValueFromSelect(document.getElementsByName("month")[0], "{MONTHS}"); selectValueFromSelect(document.getElementsByName("weekday")[0], "{WEEKDAYS}");'>
<form method="POST" action="{FORM_ACTION}">
	<input type="hidden" name="perform" value="backup" /><input type="hidden" name="drop" value="1" /><input type="hidden" name="perform" value="backup" />
	<p align="left">
	&nbsp;<h1>{L_AUTOMATIC_BACKUP}</h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
	<p align="left">{L_BACKUP_EXPLAIN}</p>
	<p align="left">{L_FORM_EXPLAIN}</p>
	<p>&nbsp;</p>
<table width="90%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
<th>
{L_AUTOMATIC_BACKUP}</th>
</tr>
</td>
</tr>	
</table>
<table width="90%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline" id="table1">
<tr>
<td class="catHead">{L_BACKUP_TYPE}</td>
</tr>
<tr> 
<td class="row2">

<p align="center"></p>
</p><b>
<p>&nbsp;<table cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
	<tr>
		<th colspan="2" class="thHead">{L_BACKUP_TYPE}</th>
	</tr>
	<tr>
		<td class="row1">{L_FULL_BACKUP}</td>
		<td class="row2"><b>
		<input type="radio" name="backup_type" value="full" {FULL_BACKUP} /></td>
	</tr>
	<tr>
		<td class="row1">{L_STRUCTURE_BACKUP}</td>
		<td class="row2"><b>
<input type="radio" name="backup_type" value="structure" {STRUCTURE_BACKUP} /></td>
	</tr>

	<tr>
		<td class="row1">{L_DATA_BACKUP}</td>
		<td class="row2"><b>
		<input type="radio" name="backup_type" value="data" {DATA_BACKUP}/></td>
	</tr>
	<tr> 
	  <td class="row1">{L_PHPBB_ONLY}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0" align="left">
		  <tr> 
			<td align="left" valign="middle">{L_ENABLED}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left" valign="middle"><input type="checkbox" name="phpbb_only" value="1" {PHPBB_ONLY_YES} /></td>
		  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1">{L_NO_SEARCH}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0" align="left">
		  <tr>
			<td align="left" valign="middle">{L_ENABLED}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left" valign="middle"><input type="checkbox" name="no_search" value="1" {NO_SEARCH} /></td>
		  </tr>
	  </table></td>
	</tr>
	<tr>
		<td class="row1">{L_IGNORE_TABLES}</td>
		<td class="row2">
			<input type="text" name="ignore_tables" size="20" value="{IGNORE_TABLES}">
		</td>
	</tr>
	<tr>
		<td class="row1">{L_DELAY_TIME}</td>
		<td class="row2">
			<input type="text" name="delay_time" size="5" value="{DELAY_TIME}">
		</td>
	</tr>
		<tr> 
	  <td class="row1">{L_EMAIL_TRUE}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0" align="left">
		  <tr> 
			<td align="left" valign="middle">{L_ENABLED}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left" valign="middle"><input type="checkbox" name="email_true" value="1" {EMAIL_TRUE} /></td>
		  </tr>
		  <tr> 
			<td align="left" valign="middle">{L_EMAIL}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left" valign="middle"><input type="text" name="email" size="20" value="{EMAIL}"></td>
		  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="row1">{L_FTP_TRUE}</td>
	  <td class="row2">
		  <table cellspacing="0" cellpadding="1" border="0" align="left">
			  <tr> 
				<td align="left" valign="middle">{L_ENABLED}</td>
				<td align="left" valign="middle"><input type="checkbox" name="ftp_true" value="1" {FTP_TRUE} /></td>
			  </tr>
			  <tr> 
				<td align="left" valign="middle">{L_FTP_SERVER}</td>
				<td align="left" valign="middle"><input type="text" name="ftp_server" size="20" value="{FTP_SERVER}"></td>
			  </tr>
			   <tr> 
				<td align="left" valign="middle">{L_FTP_USER}</td>
				<td align="left" valign="middle"><input type="text" name="ftp_user_name" size="20" value="{FTP_USER}"></td>
			  </tr>
			  <tr> 
				<td align="left" valign="middle">{L_FTP_PASS}</td>
				<td align="left" valign="middle"><input type="password" name="ftp_user_pass" size="20" value="{FTP_PASS}"></td>
			  </tr>
			  <tr> 
				<td align="left" valign="middle">{L_FTP_DIRECTORY}</td>
				<td align="left" valign="middle"><input type="text" name="ftp_directory" size="20" value="{FTP_DIRECTORY}"></td>
			  </tr>
		  </table>
	  </td>
	</tr>
	<tr> 
	  <td class="row1">{L_WRITE_BACKUPS_TRUE}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0" align="left">
		  <tr> 
			<td align="left" valign="middle">{L_ENABLED}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left" valign="middle"><input type="checkbox" name="write_backups_true" value="1" {WRITE_BACKUPS_TRUE} /></td>
		  </tr>
	  </table></td>
	</tr>
	<tr>
		<td class="row1">{L_FILES_TO_KEEP}<br><span class="gensmall">{L_FILES_TO_KEEP_EXPLAIN}</span></td>
		<td class="row2">
			<input type="text" name="files_to_keep" size="5" value="{FILES_TO_KEEP}">
		</td>
	</tr>
	<tr>
		<td class="row1">{L_LEVEL}</td>
		<td class="row2">{L_ADVANCED_BACKUP} 
	<b>
	<input type="radio" name="level" value="advanced" {SKILL_ADVANCED} /></b>  &nbsp;{L_BASIC_BACKUP} 
	<b>
	<input type="radio" name="level" value="basic" {SKILL_BASIC} /></td>
	</tr>
</table>
</td>
</tr>
<tr>
<td class="catHead">{L_BASIC_BACKUP}</td>
</tr>
<tr> 
<td class="row2">

<p align="center"></p>
</p><p align="center">&nbsp;</p>
<p align="center"><b>
<table cellpadding=4 cellspacing=4 align=center valign=top id="table7">
<tr><td><b>{L_MINUTES}:</b><br>
<select name=minute size=10>
<option value=*> {L_EVERY_MINUTE}
<option value=*/2> {L_EVERY_OTHER_MINUTES}
<option value=*/5> {L_EVERY_FIVE_MINUTES}
<option value=*/10> {L_EVERY_TEN_MINUTES}
<option value=*/15> {L_EVERY_FIFTEEN_MINUTES}
<option value=0> 0
<option value=1> 1

<option value=2> 2
<option value=3> 3
<option value=4> 4
<option value=5> 5
<option value=6> 6
<option value=7> 7
<option value=8> 8
<option value=9> 9
<option value=10> 10

<option value=11> 11
<option value=12> 12
<option value=13> 13
<option value=14> 14
<option value=15> 15
<option value=16> 16
<option value=17> 17
<option value=18> 18
<option value=19> 19

<option value=20> 20
<option value=21> 21
<option value=22> 22
<option value=23> 23
<option value=24> 24
<option value=25> 25
<option value=26> 26
<option value=27> 27
<option value=28> 28

<option value=29> 29
<option value=30> 30
<option value=31> 31
<option value=32> 32
<option value=33> 33
<option value=34> 34
<option value=35> 35
<option value=36> 36
<option value=37> 37

<option value=38> 38
<option value=39> 39
<option value=40> 40
<option value=41> 41
<option value=42> 42
<option value=43> 43
<option value=44> 44
<option value=45> 45
<option value=46> 46

<option value=47> 47
<option value=48> 48
<option value=49> 49
<option value=50> 50
<option value=51> 51
<option value=52> 52
<option value=53> 53
<option value=54> 54
<option value=55> 55

<option value=56> 56
<option value=57> 57
<option value=58> 58
<option value=59> 59
</select><br><br><center>
&nbsp;</center>
</td>
<td><b>{L_HOURS}:</b><br>
<select name=hour size=5>
<option value=*> {L_EVERY_HOUR}
<option value=*/2> {L_EVERY_OTHER_HOUR}

<option value=*/4> {L_EVERY_FOUR_HOURS}
<option value=*/6> {L_EVERY_SIX_HOURS}
<option value=0> 0 = 12 AM/{L_MIDNIGHT}
<option value=1> 1 = 1 AM
<option value=2> 2 = 2 AM
<option value=3> 3 = 3 AM
<option value=4> 4 = 4 AM
<option value=5> 5 = 5 AM
<option value=6> 6 = 6 AM

<option value=7> 7 = 7 AM
<option value=8> 8 = 8 AM
<option value=9> 9 = 9 AM
<option value=10> 10 = 10 AM
<option value=11> 11 = 11 AM
<option value=12> 12 = 12 PM/{L_NOON}
<option value=13> 13 = 1 PM
<option value=14> 14 = 2 PM
<option value=15> 15 = 3 PM

<option value=16> 16 = 4 PM
<option value=17> 17 = 5 PM
<option value=18> 18 = 6 PM
<option value=19> 19 = 7 PM
<option value=20> 20 = 8 PM
<option value=21> 21 = 9 PM
<option value=22> 22 = 10 PM
<option value=23> 23 = 11 PM
</select>

<br><br><b>{L_DAYS}:</b><br>
<select name=day size=5>
<option value=*> {L_EVERY_DAY}
<option value=1> 1
<option value=2> 2
<option value=3> 3
<option value=4> 4
<option value=5> 5
<option value=6> 6

<option value=7> 7
<option value=8> 8
<option value=9> 9
<option value=10> 10
<option value=11> 11
<option value=12> 12
<option value=13> 13
<option value=14> 14
<option value=15> 15

<option value=16> 16
<option value=17> 17
<option value=18> 18
<option value=19> 19
<option value=20> 20
<option value=21> 21
<option value=22> 22
<option value=23> 23
<option value=24> 24

<option value=25> 25
<option value=26> 26
<option value=27> 27
<option value=28> 28
<option value=29> 29
<option value=30> 30
<option value=31> 31
</select><br><br>
</td><td><b>{L_MONTHS}:</b><br>

<select name=month size=5>
<option value=*> {L_EVERY_MONTH}
<option value=1> {L_JANUARY}
<option value=2> {L_FEBRUARY}
<option value=3> {L_MARCH}
<option value=4> {L_APRIL}
<option value=5> {L_MAY}
<option value=6> {L_JUNE}
<option value=7> {L_JULY}

<option value=8> {L_AUGUST}
<option value=9> {L_SEPTEMBER}
<option value=10> {L_OCTOBER}
<option value=11> {L_NOVEMBER}
<option value=12> {L_DECEMBER}
</select>
<br><br><b>{L_WEEKDAYS}:</b><br>
<select name=weekday size=5>
<option value=*> {L_EVERY_WEEKDAY}
<option value=Sun> {L_SUNDAY}

<option value=Mon> {L_MONDAY}
<option value=Tue> {L_TUESDAY}
<option value=Wed> {L_WEDNESDAY}
<option value=Thu> {L_THURSDAY}
<option value=Fri> {L_FRIDAY}
<option value=Sat> {L_SATURDAY}
</select>
</td></tr>

</table></p>
<p>&nbsp;</td>
</tr>
<tr>
<td class="catHead">{L_ADVANCED_BACKUP}</td>
</tr>
<tr> 
<td class="row2">

<p align="center"></p>
</p>
<p align="left">
{L_ADVANCED_BACKUP_EXPLAIN}</p>
<p align="left">
&nbsp;</p>
<b>
<table cellpadding=4 cellspacing=4 align=center valign=top id="table9">
         <tr><td><b>
			{L_MINUTES}</td><td><b>
			{L_HOURS}</td><td><b>
			{L_DAYS}</td><td><b>
			{L_MONTHS}</td><td><b>
			{L_WEEKDAYS}</td></tr>

<tr>
         <td><input type=text name="advanced_minute" size=2 value="{MINUTES}"></td>
         <td><input type=text name="advanced_hour" size=2 value="{HOURS}"></td>
         <td><input type=text name="advanced_day" size=2 value="{DAYS}"></td>
         <td><input type=text name="advanced_month" size=2 value="{MONTHS}"></td>
         <td><input type=text name="advanced_weekday" size=2 value="{WEEKDAYS}"></td>
         </tr>

         </tr></td></tr>

</table>
<p>&nbsp;</p>
</p>
<p>&nbsp;</td>
</tr>
</table>
	<p align="center">
<input type=submit value="{L_SUBMIT}"  class="liteoption"> <input type="reset" value="{L_RESET}" class="liteoption">
	</p>
<p>&nbsp;</p>
</form>