<form method="post" action="{S_MODE_ACTION}">

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_SIGLIST}</span></td>
<td align="right" nowrap="nowrap"><span class="genmed">{L_SELECT_SORT_METHOD}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" /></span></td>
</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<th class="thTop" nowrap="nowrap">#</th>
<th width="100" class="thTop" nowrap="nowrap">&nbsp;{L_USERNAME}&nbsp;</th>
<th width="100%" class="thTop" nowrap="nowrap">{L_SIGNATURE}</th>
</tr>
<!-- BEGIN sigrow -->
<tr> 
<td class="{sigrow.ROW_CLASS}" align="center" valign="top"><span class="gen">&nbsp;{sigrow.ROW_NUMBER}&nbsp;</span></td>
<td class="{sigrow.ROW_CLASS}" align="left" valign="top" nowrap="nowrap" style="padding-left:5;"><span class="gen">
<a href="{sigrow.U_VIEWPROFILE}" class="gen">{sigrow.USERNAME}</a></span><br />
<span class="gensmall">{sigrow.POSTER_RANK}<!-- <br /><br />{sigrow.RANK_IMAGE} --><br /><br />
<!-- {sigrow.AVATAR_IMG}<br /><br /> -->
{L_POSTS}: <a href="{sigrow.U_SEARCH_USER_POSTS}" class="gensmall">{sigrow.POSTS}</a>
</span></td>
<td class="{sigrow.ROW_CLASS}" align="left" valign="top" style="padding-left:8;"><span class="gensmall">{sigrow.SIGNATURE}</span></td>
</tr>
<!-- END sigrow -->
<tr> 
<td class="catBottom" colspan="8" height="28">&nbsp;</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr> 
<td><span class="nav">{PAGE_NUMBER}</span></td>
<td align="right"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span></td>
</tr>
</table>
</form>

<table width="100%" cellspacing="2" border="0" align="center">
<tr> 
<td valign="top" align="left" style="font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #444444;">{SIG_MOD_WRITE}</td>
<td valign="top" align="right">{JUMPBOX}</td>
</tr>
</table>