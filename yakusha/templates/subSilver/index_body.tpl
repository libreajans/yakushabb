<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="3" class="thCornerL" height="20" nowrap="nowrap">&nbsp;{L_FORUM}&nbsp;</th>
<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
<th width="50" class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
<th class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- BEGIN catrow -->
<tr>
<td class="catLeft" colspan="6" height="28">
<span class="cattitle"><a href="{catrow.U_VIEWCAT}" class="cattitle">{catrow.CAT_DESC}</a></span>
</td>
</tr>
<!-- BEGIN forumrow -->
<!-- IF ! forumrow.PARENT -->
<tr>
<td class="row1" align="center" valign="middle" height="50">{catrow.forumrow.FORUM_ICON_IMG}</td>
<td class="row1" width="100%" height="50">
<a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink">{catrow.forumrow.FORUM_NAME}</a>
<span class="genmed"><br />{catrow.forumrow.FORUM_DESC}</span>
<span class="gensmall"><br />{catrow.forumrow.L_MODERATOR} {catrow.forumrow.MODERATORS}</span>
<table border="0">
<tr>
<!-- BEGIN sub -->
<!-- DEFINE $HAS_SUB = 1 -->
<!-- IF catrow.forumrow.sub.NUM > 0 -->
<!-- ELSE -->
<!-- ENDIF -->
<td width="170">{catrow.forumrow.sub.LAST_POST_SUB}
<span class="gensmall">
<a href="{catrow.forumrow.sub.U_VIEWFORUM}" <!-- IF catrow.forumrow.sub.UNREAD -->class="topic-new"<!-- ENDIF --> title="{catrow.forumrow.sub.FORUM_DESC_HTML}">{catrow.forumrow.sub.FORUM_NAME} </a>
</span>
</td>
<!-- IF $sub_i %2 -->
</tr>
<tr>
<!-- ENDIF -->
<!-- END sub -->
<!-- IF $HAS_SUB -->
<!-- UNDEFINE $HAS_SUB -->
<!-- ENDIF -->
</tr>
</table>

</td>
<td class="row1" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOTAL_TOPICS}</span></td>
<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOTAL_POSTS}</span></td>
<td width="175" class="row2" align="right" nowrap="nowrap"><span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
</tr>
<!-- ENDIF -->
<!-- END forumrow -->
<!-- END catrow -->
</table>

<table width="100%" cellspacing="0" border="0" align="center" cellpadding="2">
<tr>
<td align="left">
<!-- BEGIN switch_user_logged_in -->
<span class="gensmall"><a href="{U_MARK_READ}" class="gensmall">{L_MARK_FORUMS_READ}</a></span>
<!-- END switch_user_logged_in -->
</td>
<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
</tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<tr>
<td class="catHead" colspan="2">
<span class="cattitle">{L_INFOS}</span>
</td>
</tr>

<tr>
<td class="row1" rowspan="3" width="5%" align="center">
<a href="{U_VIEWONLINE}" class="gensmall"><img alt="{L_WHO_IS_ONLINE}" src="{TEMPLATE_PATH}/images/whosonline.gif"></a>
</td>
<td class="row1" align="left">
<span class="gensmall">
<!-- BEGIN switch_user_logged_in -->
&nbsp;{CURRENT_TIME} | {LAST_VISIT_DATE}<br />
<!-- END switch_user_logged_in -->
&nbsp;{TOTAL_POSTS} | {L_TOTAL_TOPICCOUNT} <b>{TOTAL_TOPICCOUNT}</b> | {L_WACHED_TOTAL}: <b>{WACHED_TOTAL}</b> | {TOTAL_USERS} | {NEW_USER}
</span>
</td>
</tr>

<tr>
<td class="row1" align="left">
<span class="gensmall">&nbsp;{L_MODER}{COLOR_GROUPS_LIST}</span>
</td>
</tr>

<tr>
<td class="row1" align="left">
<span class="gensmall">&nbsp;{RECORD_USERS}<br />&nbsp;{TOTAL_USERS_ONLINE}<br />&nbsp;<a href="{U_VIEWONLINE}" class="gensmall"><b>{L_WHO_IS_ONLINE}</b></a> {LOGGED_IN_USER_LIST}</span>
<!-- BEGIN online -->
<span class="gensmall"><br />&nbsp;{online.UOT_TITLE}: <b>{online.UOT_COUNT}</b> : {online.UOT_LIST}&nbsp;</span>
<!-- END online -->
</td>
</tr>

</table>

<table width="100%" cellpadding="1" cellspacing="1" border="0">
<tr>
<td align="left" valign="top"><span class="gensmall">{L_ONLINE_EXPLAIN}</span></td>
</tr>
</table>

<!-- BEGIN switch_user_logged_out -->
<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
<form method="post" action="{S_LOGIN_ACTION}">
{S_REDIRECT_PAGE}
<tr>
<td class="catHead" height="28"><a name="login"></a><span class="cattitle">{L_LOGIN_LOGOUT}</span></td>
</tr>
<tr>
<td class="row1" align="center" valign="middle" height="28"><span class="gensmall">{L_USERNAME}:
<input class="post" type="text" name="username" size="10" />&nbsp;&nbsp;&nbsp;{L_PASSWORD}:
<input class="post" type="password" name="password" size="10" maxlength="32" />
<!-- BEGIN switch_allow_autologin -->
&nbsp;&nbsp; &nbsp;&nbsp;{L_AUTO_LOGIN}
<input class="text" type="checkbox" name="autologin" />
<!-- END switch_allow_autologin -->
&nbsp;&nbsp;&nbsp;
<input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
</span> </td>
</tr>
</form>
</table>
<!-- END switch_user_logged_out -->