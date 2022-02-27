<script language="JavaScript">

function mass_unban()
{
sql = "{MUNBAN_SQL_BEGIN}";
<!-- BEGIN jscript_mass_unban -->
if(document.action.bid_{jscript_mass_unban.BAN_ID}.checked == true)
{
sql = sql + " OR" + " ban_id = {jscript_mass_unban.BAN_ID}" ;
}
<!-- END jscript_mass_unban -->
document.action.runsql.value = sql;
document.action.submit();
}

</script>
<h1>{L_BULM_TITLE}</h1>
<p>{L_BULM_DESCRIPT}</p>
<p>
<form name="sort" method="post">
{L_BULM_SHOW}&nbsp;
<select name="view_sort">
<option value="username" {USERNAME_SEL}>{L_USERNAME}</option>
<option value="ip"{IP_SEL}>{L_IP}</option>
<option value="email" {EMAIL_SEL}>{L_EMAIL}</option>
<option value="all" {ALL_SEL}>{L_ALL}</option>
</select>
<select name="view_direction">
<option value="ASC" {ASC_SEL}>{L_ASSCEND}</option>
<option value="DESC" {DEC_SEL}>{L_DESCEND}</option>
</select>
<input type="submit"class="liteoption" name="sortie" value="{L_SORT}" />
</form>
</p>
<form name="action" method="post">
<table cellspacing="1" cellpadding="4" width="100%" border="0" align="center" class="forumline">
<tr>
<th class="thHead">{L_USERNAME}</th>
<th class="thHead">{L_EMAIL}</th>
<th class="thHead">{L_IP}</th>
<th class="thHead">{L_POSTS}</th>
<th class="thHead">{L_LAST_VISIT}</th>
<th class="thHead">{L_BANNED}</th>
<th class="thHead">{L_BY}</th>
<th class="thHead" colspan="2">{L_REASON}</th>
<th class="thHead"></th>
<tr>
<!-- BEGIN switch_paginate -->
<tr>
<td class="row2" colspan="10" align="left">{PAGINATE}</td>
</tr>
<!-- END switch_paginate -->
<!-- BEGIN switch_nobans -->
<tr>
<td class="row1" colspan="10" align="left">{NO_BANS}</td>
</tr>
<!-- END switch_nobans -->
<!-- BEGIN rowlist -->
<tr>
<td class="row1">{rowlist.USER_NAME}</td>
<td class="row1">{rowlist.EMAIL_ADDY}</td>
<td class="row1" align="center">{rowlist.IP_ADDY}</td>
<td class="row1" align="center">{rowlist.POSTS}</td>
<td class="row1" align="center">{rowlist.LAST_VISIT}</td>
<td class="row1" align="center">{rowlist.BAN_TIME}</td>
<td class="row1" align="center">{rowlist.BAN_BY}</td>
<td class="row1" align="center">{rowlist.BAN_REASON}</td>
<td class="row1" align="center">{rowlist.BAN_EDIT}</td>
<td class="row2" align="center"><input type="checkbox" name="bid_{rowlist.BAN_ID}" value="bid_{rowlist.BAN_ID}"></td>
</tr>
<!-- END rowlist -->
<!-- BEGIN switch_paginate -->
<tr>
<td class="row2" colspan="10" align="left">{PAGINATE}</td>
</tr>
<!-- END switch_paginate -->
<tr>
<th class="thHead" colspan="10">{L_FUNCTIONS}</th>
</tr>

<tr>
<td class="row2" colspan="2" align="center"><input class="mainoption" type="button" name="f_unban" value="{L_BULM_FUNBAN_TXT}" onclick="mass_unban()"></td>
<td class="row1" colspan="8">{L_BULM_FUNBAN_EXPLAIN}</td>
</tr>
<input type="hidden" name="runsql">
</table>
</form>

<br />

<form method="post" name="post" action="{S_BANLIST_ACTION}">
<table cellspacing="1" cellpadding="4" width="100%" border="0" align="center" class="forumline">
<tr>
<th class="thHead" colspan="2">{L_BAN_NEW_USERS}</th>
</tr>
<tr>
<td class="row1" colspan="2"><p>{L_BAN_EXPLAIN}</p></td>
</tr>
<tr>
<td class="row1" rowspan="2" width="100%">{L_USERNAME}:</td>
<td class="row2" align="center"><input type="text" class="post" name="username" maxlength="50" size="20" /></td>
</tr>
<tr>
<td class="row2" align="center"><input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onClick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
</tr>
<tr>
<td class="row1" width="100%">{L_IP_OR_HOSTNAME}: <br /><span class="gensmall">{L_BAN_IP_EXPLAIN}</span></td>
<td class="row2" align="center"><input type="text" name="ban_ip" size="20" /></td>
</tr>
<tr>
<td class="row1" width="100%">{L_EMAIL_ADDRESS}: <br /><span class="gensmall">{L_BAN_EMAIL_EXPLAIN}</span></td>
<td class="row2" align="center"><input type="text" name="ban_email" size="20" /></td>
</tr>
<tr>
<td class="row1" width="100%" colspan="2">{L_REASON}: <br /><span class="gensmall">{L_BAN_REASON_EXPLAIN}</span></td>
</tr>
<tr>
<td class="row2" align="center" colspan="2"><textarea name="ban_reason" rows="10" cols="100"></textarea></td>
</tr>
<tr>
<td class="row2" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" /></td>
</tr>
<tr>
<td class="row1" colspan="2"><p>{L_BAN_EXPLAIN_WARN}</p></td>
</tr>
</form>
</table>