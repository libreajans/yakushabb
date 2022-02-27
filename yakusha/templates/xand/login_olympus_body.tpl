<form action="{S_LOGIN_ACTION}" method="post" target="_top">

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td>
<span class="nav">&nbsp;<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_LOGIN}</span>
</td>
</tr>
</table>
<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
<tr>
<th colspan="2">{L_LOGIN}</th>
</tr>
<tr>
<td class="row3" colspan="2" align="center"><span class="gensmall">{L_ENTER_PASSWORD}</span></td>
</tr>
<tr>
<td style="background:url(images/bg_login.png)" class="row1" width="50%">
<center><span class="gensmall">
<!-- BEGIN switch_user_logged_out -->
{L_LOGIN_INFO}
<!-- END switch_user_logged_out -->
<!-- BEGIN switch_admin_reauth -->
{L_LOGIN_ADMIN}
<!-- END switch_admin_reauth -->
</span><br /><br />
<span class="genmed" align="center"><a href="{U_INDEX}">{L_LOGIN_INDEX}</a> |
<!-- BEGIN switch_admin_activation -->
<a href="{U_LOGIN_ACTIVATE}">{L_LOGIN_ACTIVATE}</a> |
<!-- END switch_admin_activation -->
<a href="{U_FAQ}">{L_LOGIN_FAQ}</a></span>
</center></td>
<td class="row2">
<table cellspacing="1" cellpadding="4">
<tr>
<td class="row1"><b class="gensmall">{L_USERNAME}</b></td>
<td class="row1"><span class="gensmall"><b>:</b></span></td>
<td width="100%" class="row1">
<input class="post" type="text" name="username" size="25" maxlength="40" value="{USERNAME}" tabindex="1" />
<!-- BEGIN switch_user_logged_out -->
<span class="gensmall"><b> <br />&raquo; </b><a class="gensmall" href="{U_REGISTER}">{L_LOGIN_REGISTER}</a></span>
<!-- END switch_user_logged_out -->
</td>
</tr>
<tr>
<td class="row1"><b class="gensmall">{L_PASSWORD}</b></td>
<td class="row1"><span class="gensmall"><b>:</b></span></td>
<td width="100%" class="row1">
<input class="post" type="password" name="password" size="25" maxlength="25" tabindex="2" />
<!-- BEGIN switch_user_logged_out -->
<span class="gensmall"><b> <br />&raquo; </b><a href="{U_SEND_PASSWORD}">{L_SEND_PASSWORD}</a></span>
<!-- END switch_user_logged_out -->
</td>
</tr>

<!-- BEGIN switch_user_logged_out -->
<tr>
<td class="row1">
<span class="gensmall"><b>{L_LOGIN_OPTIONS}</b></span>
</td>
<td class="row1"><span class="gensmall"><b>:</b></span></td>
<td width="100%" class="row1">
<span class="gensmall">
<input type="checkbox" name="autologin" tabindex="5" />&nbsp;{L_AUTO_LOGIN}
<input type="checkbox" name="hideonline" tabindex="5" />&nbsp;{L_LOGIN_HIDEME}
</span>
</td>
</tr>
<!-- END switch_user_logged_out -->

</table>

</td>
</tr>
<tr>
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="login" class="mainoption" value="{L_LOGIN}" tabindex="3" /></td>
</tr>
</table>
</form>
<br />
<br />