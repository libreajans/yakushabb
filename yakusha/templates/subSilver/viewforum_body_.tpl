<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="center" valign="bottom" colspan="2">
<a class="maintitle" href="{U_VIEW_FORUM}">{FORUM_NAME}</a>
<br /><span class="baslik">{FORUM_DESC}</span></td>
</tr>
<tr>
<td align="left" valign="middle" width="50"><a href="{U_POST_NEW_TOPIC}">
<img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}" /></a></td>

<td align="right" valign="bottom" nowrap="nowrap">
<span class="gensmall"><b>{PAGINATION}</b></span>
</td>
</tr>
</table>

<table height="25" border="0" cellpadding="2" cellspacing="2" width="100%">
<tr>
<td nowrap="nowrap"><img src="images/nav.gif" border="0"></td>
<td valign="middle" width="100%" class="mainmenu">
<span class="gensmall">
<b>
<a href="{U_INDEX}" class="nav">{L_INDEX}</a> <b>&raquo;</b>
<!-- IF PARENT_FORUM -->
<a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> <b>&raquo;</b>
<!-- ENDIF -->
<a class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span>
</b>
</td>
<td valing="center" align="right" nowrap="nowrap">
<!-- BEGIN switch_user_logged_in -->
<span class="gensmall"><a href="{U_MARK_READ}">{L_MARK_TOPICS_READ}</a></span>
<!-- END switch_user_logged_in -->
</td>
</tr>
</table>

<!-- BEGIN catrow -->
<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline">
<tr>
<th colspan="2" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{catrow.CAT_DESC}&nbsp;</th>
<th class="thTop" nowrap="nowrap">&nbsp;{L_TOPICS}&nbsp;</th>
<th class="thTop" nowrap="nowrap">&nbsp;{L_POSTS}&nbsp;</th>
<th width="150" class="thCornerR" nowrap="nowrap">&nbsp;{L_LASTPOST}&nbsp;</th>
</tr>
<!-- BEGIN forumrow -->
<tr>
<td class="row1" align="center" valign="middle" height="50"><img src="{catrow.forumrow.FORUM_FOLDER_IMG}" alt="{catrow.forumrow.L_FORUM_FOLDER_ALT}" title="{catrow.forumrow.L_FORUM_FOLDER_ALT}" /></td>
<td class="row1" width="100%" height="40">
<span class="forumlink">
<a href="{catrow.forumrow.U_VIEWFORUM}" class="forumlink<!-- IF catrow.forumrow.UNREAD -->topic-new<!-- ENDIF -->">{catrow.forumrow.FORUM_NAME}</a></span>
<br /><span class="genmed">{catrow.forumrow.FORUM_DESC}</span>
<br /><span class="genmed">{catrow.forumrow.L_MODERATOR}: {catrow.forumrow.MODERATORS}</span>
<!-- ENDIF -->
</td>
<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.TOPICS}</span></td>
<td class="row2" align="center" valign="middle" height="50"><span class="gensmall">{catrow.forumrow.POSTS}</span></td>
<td class="row2" align="right" valign="middle" height="50" nowrap="nowrap"><span class="gensmall">{catrow.forumrow.LAST_POST}</span></td>
</tr>
<!-- END forumrow -->
</table>
<br />
<!-- END catrow -->

<!-- IF NUM_TOPICS || ! HAS_SUBFORUMS -->

{TOPICS_LIST_BOX}

<table width="100%" cellspacing="1" cellpadding="1" border="0">
<tr>
<td align="right" colspan="3" valign="bottom" class="nav" nowrap="nowrap"></td>
</tr>

<tr valign="top">
<td nowrap="nowrap" valing="top"> <a href="{U_POST_NEW_TOPIC}">
<img src="{POST_IMG}" border="0" title="{L_POST_NEW_TOPIC}" alt="{L_POST_NEW_TOPIC}" /></a>
</td>

<td align="right" width="70%" valign="middle">
<form id="order" method="post" action="{U_VIEW_FORUM}">
<span class="genmed">
{L_SELECT_SORT_METHOD}:&nbsp;{S_DAYS_SELECT}&nbsp;{S_MODE_SELECT}&nbsp;{S_ORDER_SELECT}&nbsp;<input type="submit" name="submit" value="{L_SUBMIT}" class="liteoption" />
</span>
</form>
</td>
</tr>
</table>

<table height="25" border="0" cellpadding="2" cellspacing="2" width="100%">
<tr>
<td nowrap="nowrap"><img src="images/nav.gif" border="0"></td>
<td valign="middle" width="100%" class="mainmenu">
<span class="gensmall">
<b>
<a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo;
<!-- IF PARENT_FORUM -->
<a class="nav" href="{U_VIEW_PARENT_FORUM}">{PARENT_FORUM_NAME}</a> &raquo;
<!-- ENDIF -->
<a  class="nav" href="{U_VIEW_FORUM}">{FORUM_NAME}</a></span>
</b>
</td>
<td valing="center" align="right" nowrap="nowrap">
<span class="gensmall"><b>{PAGINATION}</b></span></td>
</tr>
</table>

<table cellspacing="0" cellpadding="3" width="100%" class="forumline">
<tr>
<td class="row2">
<table width="100%" cellspacing="0" cellpadding="3" border="0">
<tr>
<td><span class="genmed">{L_MODERATOR}: {MODERATORS}</span></td>
<form id="qsearch_form_forum" method="POST" action="{U_SEARCH}?mode=results">
<td width="30%" align="right">
<input type="hidden" name="search_forum" value="{FORUM_ID}">
<input type="hidden" name="show_results" value="topics">
<input type="hidden" name="search_terms" value="any">
<input type="hidden" name="search_fields" value="all">
<input class="post" type="text" name="search_keywords" size="18" value="{L_SEARCH_IN_FORUM}" id="searchfield"
onfocus="if (document.getElementById('qsearch_form_forum').search_keywords.value == '{L_SEARCH_IN_FORUM}') { document.getElementById('qsearch_form_forum').search_keywords.value = ''; }"
onblur="if (document.getElementById('qsearch_form_forum').search_keywords.value == '') { document.getElementById('qsearch_form_forum').search_keywords.value = '{L_SEARCH_IN_FORUM}'; }" />
<input type="submit" name="submit" value="{L_ARA}" class="liteoption" />
</td>
</form>
</tr>
<tr>
<td><span class="genmed">{LOGGED_IN_USER_LIST}</span></td>
<td width="20%" align="right">
{JUMPBOX}
</td>

</tr>
</table>
</td>
</tr>
</table>
<br />
<!-- BEGIN switch_user_logged_in -->
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="forumline">
<tr>
<td class="row3">
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
<td>
<table cellspacing="0" cellpadding="1" border="0">
<tr>
<td width="20" align="center"><img src="{FOLDER_STICKY_IMG}" alt="{L_STICKY}" border="0" /></td>
<td class="gensmall">{L_STICKY}</td>
<td> </td>
<td width="20" align="center"><img src="{FOLDER_ANNOUNCE_IMG}" alt="{L_ANNOUNCEMENT}" border="0" /></td>
<td class="gensmall">{L_ANNOUNCEMENT}</td>
</tr>
<tr>
<td width="20"><img src="{FOLDER_NEW_IMG}" alt="{L_NEW_POSTS}" border="0" /></td>
<td class="gensmall">{L_NEW_POSTS}</td>
<td> </td>
<td width="20" align="center"><img src="{FOLDER_IMG}" alt="{L_NO_NEW_POSTS}" border="0" /></td>
<td class="gensmall">{L_NO_NEW_POSTS}</td>
</tr>
<tr>
<td width="20" align="center"><img src="{FOLDER_HOT_NEW_IMG}" alt="{L_NEW_POSTS_HOT}" border="0" /></td>
<td class="gensmall">{L_NEW_POSTS_HOT}</td>
<td> </td>
<td width="20" align="center"><img src="{FOLDER_HOT_IMG}" alt="{L_NO_NEW_POSTS_HOT}" border="0" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_HOT}</td>
</tr>
<tr>
<td class="gensmall"><img src="{FOLDER_LOCKED_NEW_IMG}" alt="{L_NEW_POSTS_LOCKED}" border="0" /></td>
<td class="gensmall">{L_NEW_POSTS_LOCKED}</td>
<td> </td>
<td class="gensmall"><img src="{FOLDER_LOCKED_IMG}" alt="{L_NO_NEW_POSTS_LOCKED}" border="0" /></td>
<td class="gensmall">{L_NO_NEW_POSTS_LOCKED}</td>
</tr>
</table>
</td>
<td align="right"><span class="gensmall">{S_AUTH_LIST}</span></td>
</tr>
</table>
</td>
</tr>
</table>
<!-- END switch_user_logged_in -->

<!-- ELSE -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="right">{JUMPBOX}</td>
</tr>
</table>
<!-- ENDIF -->