<!-- BEGIN switch_list_staff -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left">
<span class="nav"> <a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_STAFF} </span>
</td>
</tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
<th width="20%" class="thTop">{L_USERNAME}</th>
<th width="20%" class="thTop">{L_LOCATION}</th>
<th width="60%" class="thTop">{L_CONTACT}</th>
</tr>
<!-- BEGIN user_level -->
<tr>
<td class="row3" colspan="4" align="left"><span class="nav"><b>{switch_list_staff.user_level.USER_LEVEL}</b></span></td>
</tr>
<!-- BEGIN staff -->
<tr>
<td width="100" align="center" class="{switch_list_staff.user_level.staff.ROW_CLASS}" valign="top">
<span class="gen">{switch_list_staff.user_level.staff.U_PROFILE}
<span class="gensmall"> {switch_list_staff.user_level.staff.USER_STATUS}<br />{switch_list_staff.user_level.staff.RANK}<br />{switch_list_staff.user_level.staff.RANK_IMAGE}<br />
{switch_list_staff.user_level.staff.AVATAR}</span></td>
<td class="{switch_list_staff.user_level.staff.ROW_CLASS}" valign="top" align="center"><span class="genmed">{switch_list_staff.user_level.staff.LOCATION}</span></td>
<td class="{switch_list_staff.user_level.staff.ROW_CLASS}" width="11%" valign="top" align="center">
{switch_list_staff.user_level.staff.EMAIL} 
{switch_list_staff.user_level.staff.PM}
{switch_list_staff.user_level.staff.MSN}
{switch_list_staff.user_level.staff.YIM}
{switch_list_staff.user_level.staff.AIM}
{switch_list_staff.user_level.staff.ICQ}
{switch_list_staff.user_level.staff.WWW}
</td>
</tr>
<!-- END staff -->
<!-- END user_level -->
<tr>
<td class="catBottom" colspan="6">&nbsp;</td>
</tr>
</table>
<!-- END switch_list_staff -->