<div class="maintitle">
<center>
{L_CONFIGURATION_TITLE}
</center>
</div>
<br />
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
<tr>
<th colspan="2">{L_GENERAL_SETTINGS}</th>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_WELCOME_TEXT}</b><br />
<span class="gensmall">{L_WELCOME_TEXT_EXPLAIN}</span></td>
<td class="row2" width="62%"><textarea type="text" maxlength="9999" size="40" name="welcome_text" rows="10" cols="40">
{WELCOME_TEXT}
</textarea> </td>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_NUMBER_OF_NEWS}</b></td>
<td class="row2" width="62%"> <input type="text" maxlength="255" size="40" name="number_of_news" value="{NUMBER_OF_NEWS}" class="post" /> </td>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_NEWS_LENGTH}</b></td>
<td class="row2" width="62%"> <input type="text" maxlength="255" size="40" name="news_length" value="{NEWS_LENGTH}" class="post" /> </td>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_NEWS_FORUM}</b> <br />
<span class="gensmall"><u>{L_COMMA}</u></span></td>
<td class="row2" width="62%"> <input type="text" maxlength="255" size="40" name="news_forum" value="{NEWS_FORUM}" class="post" /> </td>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_POLL_FORUM}</b> <br />
<span class="gensmall"><u>{L_COMMA}</u></span></td>
<td class="row2" width="62%"> <input type="text" maxlength="255" size="40" name="poll_forum" value="{POLL_FORUM}" class="post" /> </td>
</tr>
<tr>
<td class="row1" width="38%"><b>{L_NUMBER_RECENT_TOPICS}</b></td>
<td class="row2" width="62%"> <input type="text" maxlength="255" size="40" name="number_recent_topics" value="{NUMBER_RECENT_TOPICS}" class="post" /> </td>
</tr>
<tr>
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp;
<input type="reset" value="{L_RESET}" class="button" /> </td>
</tr>
</form>
</table>
<br clear="all" />