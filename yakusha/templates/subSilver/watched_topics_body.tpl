<script language="Javascript" type="text/javascript">
<!--
function setCheckboxes(theForm, elementName, isChecked)
{
var chkboxes = document.forms[theForm].elements[elementName];
var count = chkboxes.length;

if (count)
{
for (var i = 0; i < count; i++)
{
chkboxes[i].checked = isChecked;
}
}
else
{
chkboxes.checked = isChecked;
}

return true;
}
//-->
</script>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left" class="nav">
<span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; <a href="{S_FORM_ACTION}" class="nav">{L_WATCHED_TOPICS}</a></span>
</td>
</tr>

<!-- BEGIN switch_watched_topics_block -->
<form name="unwatch_form" id="unwatch_form" method="post" action="{S_FORM_ACTION}">
<input type="Hidden" name="mode" value="editprofile" />
<!-- END switch_watched_topics_block -->

<!-- BEGIN switch_no_watched_topics -->
<!--
<!-- END switch_no_watched_topics -->
<table cellspacing="1" cellpadding="2" border="0" width="100%" class="forumline">
<tr>
<th class="catLeft">{L_WATCHED_TOPICS}</th>
<th class="cat">{L_FORUM}</td>
<th class="cat">{L_REPLIES}</td>
<th class="cat">{L_STARTED}</td>
<th class="cat">{L_LAST_POST}</td>
<th class="catRight"></td>
</tr>

<!-- BEGIN switch_no_watched_topics -->
-->
<!-- END switch_no_watched_topics -->

<!-- BEGIN topic_watch_row -->
<tr>
<td class="{topic_watch_row.ROW_CLASS}" height="24"><span class="genmed"><a href="{topic_watch_row.U_WATCHED_TOPIC}" class="genmed">{topic_watch_row.S_WATCHED_TOPIC}</a><br/>{topic_watch_row.GOTO_PAGE}</span></td>
<td class="{topic_watch_row.ROW_CLASS}" align="center"><span class="genmed"><a href="{topic_watch_row.U_FORUM_LINK}" class="genmed">{topic_watch_row.S_FORUM_TITLE}</span></td>
<td class="{topic_watch_row.ROW_CLASS}" align="center"><span class="genmed">{topic_watch_row.S_WATCHED_TOPIC_REPLIES}</span></td>
<td class="{topic_watch_row.ROW_CLASS}" align="center"><span class="genmed">{topic_watch_row.S_WATCHED_TOPIC_START}<br/>{topic_watch_row.TOPIC_POSTER}</span></td>
<td class="{topic_watch_row.ROW_CLASS}" align="center"><span class="genmed">{topic_watch_row.S_WATCHED_TOPIC_LAST}<br/>{topic_watch_row.LAST_POSTER}</span></td>
<td class="{topic_watch_row.ROW_CLASS}" align="center" nowrap>
<input type="checkbox" name="unwatch_list[]" value="{topic_watch_row.S_WATCHED_TOPIC_ID}" />
</td>
</tr>
<!-- END topic_watch_row -->

<!-- BEGIN switch_watched_topics_block -->
<tr>
<td class="spaceRow" colspan="6" height="1"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
<tr>
<td colspan="6" class="catBottom" align="right">
<input type="submit" name="unwatch_topics" class="liteoption" value="{L_STOP_WATCH}" />&nbsp;&nbsp;
</td>
</tr>
<!-- END switch_watched_topics_block -->

</table>
<!-- BEGIN switch_watched_topics_block -->
<div align="right">
<a href="#" onclick="setCheckboxes('unwatch_form', 'unwatch_list[]', true); return false;" class="gensmall">{L_CHECK_ALL}</a>&nbsp;<span class="nav">::</span>&nbsp;<a href="#" onclick="setCheckboxes('unwatch_form', 'unwatch_list[]', false); return false;" class="gensmall">{L_UNCHECK_ALL}</a>
<br/>
<!-- END switch_watched_topics_block -->
<span class="gensmall"><b>{PAGINATION}</b></span>
<!-- BEGIN switch_watched_topics_block -->
</div>
</form>
<!-- END switch_watched_topics_block -->
<!-- BEGIN switch_no_watched_topics -->
<table class="forumline" width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
<th class="thHead" height="25">{L_INFO}</th>
</tr>
<tr>
<td class="row1"><table width="100%" cellspacing="0" cellpadding="1" border="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><span class="gen">{L_NO_WATCHED_TOPICS}</span></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table></td>
</tr>
</table>
<!-- END switch_no_watched_topics -->