<script language="javascript" type="text/javascript" src="{U_CFAQ_JSLIB}"></script>
<noscript>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
<tr>
<td class="row1" align="center"><span class="gen"><br />{L_CFAQ_NOSCRIPT}<br />&nbsp;</span></td>
</tr>
</table>
</noscript>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td align="left" class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> &raquo; {L_FAQ_TITLE}</td>
<td align="right" class="nav"> <a href="{U_FAQ}?&amp;dhtml=no">HTML</a></td>
</tr>
</table>

<table class="forumline" width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
<td class="row3">
<!-- BEGIN faq_block -->
<table width="100%" cellspacing="2" cellpadding="3" border="0" align="center">
<tr>
<th class="thHead" height="28" align="center">{faq_block.BLOCK_TITLE}</th>
</tr>
<!-- BEGIN faq_row -->
<tr>
<td class="{faq_block.faq_row.ROW_CLASS}" align="left" valign="top">
<div onclick="return CFAQ.display('faq_a_{faq_block.faq_row.U_FAQ_ID}', false);"
style="width:100%;cursor:pointer;cursor:hand;">
<span class="gen">
<a name="{faq_block.faq_row.U_FAQ_ID}" href="#{faq_block.faq_row.U_FAQ_ID}" onclick="return CFAQ.display('faq_a_{faq_block.faq_row.U_FAQ_ID}', true);" onfocus="this.blur();">{faq_block.faq_row.FAQ_QUESTION}
</span></a>
</div>
<div id="faq_a_{faq_block.faq_row.U_FAQ_ID}" style="display:none;">
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
<tr>
<td class="spaceRow"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="0" height="0" /></td>
</tr>
<tr><td align="left" valign="top"><span class="postbody">{faq_block.faq_row.FAQ_ANSWER}<br /></span></td></tr>
<tr>
<td class="spaceRow"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="0" height="0" /></td>
</tr>
</table>
</div>
</td>
</tr>
<!-- END faq_row -->
</table>
<!-- END faq_block -->
</td>
</tr>
</table>
<table width="100%" cellspacing="2" border="0" align="center">
<tr>
<td colspan="2" class="spaceRow" height="1"><img src="{TEMPLATE_PATH}/images/spacer.gif" alt="" width="1" height="5" /></td>
</tr>
<tr>
<td align="left" valign="top" nowrap="nowrap"><span class="copyright">DHTML Collapsible FAQ &copy; By <a href="http://www.phpmix.com/" target="_blank" class="copyright">phpMiX</a></span></td>
<td align="right" class="nav"> <a href="{U_FAQ}?&amp;dhtml=no">HTML</a></td>
</tr>
</table>