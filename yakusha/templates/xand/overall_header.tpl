<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">

<!-- INCLUDE ./../site_meta.tpl -->

{META}

{NAV_LINKS}
<title>{PAGE_TITLE}</title>
<link rel="stylesheet" href="{TEMPLATE_PATH}/{T_HEAD_STYLESHEET}" type="text/css">

<!-- [+] resim küçültme -->
<script type="text/javascript">
//<![CDATA[
<!--
// bu ayarý siz belirliyorsunuz
var rmw_max_width = 400;
var rmw_border_1 = '1px solid {T_BODY_LINK}';
var rmw_border_2 = '2px dotted {T_BODY_LINK}';
var rmw_image_title = '{L_RMW_IMAGE_TITLE}';
//-->
//]]>
</script>
<script type="text/javascript" src="templates/rmw_jslib.js"></script>
<!-- [-] resim küçültme -->

<!-- [+] çýkýþ iþlemi -->
<script type="text/javascript" language="JavaScript">
<!--
// Rückfrage beim abmelden
function logout_question()
{
body_self = document.getElementsByTagName('body');
body_self[0].style.filter = 'Alpha(opacity="60")';
body_self[0].style.MozOpacity = '0.6';
body_self[0].style.opacity = '0.6';
if (confirm('{L_LOGOUT_QUESTION}'))
{
body_self[0].style.filter = 'Alpha(opacity="100")';
body_self[0].style.MozOpacity = '1';
body_self[0].style.opacity = '1';
return true;
}
else
{
body_self[0].style.filter = 'Alpha(opacity="100")';
body_self[0].style.MozOpacity = '1';
body_self[0].style.opacity = '1';
return false;
}
}
//-->
</script>
<!-- [-] çýkýþ iþlemi -->

<!-- [+] arama fonksiyonu -->
<script language=JavaScript type=text/javascript>
<!--
function qsearch_onSubmit()
{
qs_enginename = document.qsearch_form.search_fields.value;
qs_keywords = document.qsearch_form.search_keywords.value;
switch( qs_enginename )
{
case 'all':
break;

case 'msgonly':
break;

case 'titleonly':
break;

case 'yazar':
window.open('{U_SEARCH}?search_author=' + qs_keywords, '_self', '');
return false;

case 'site':
window.open('http://www.google.com.tr/search?q=' + qs_keywords + ' site:{SITE_WAY}', '_blank', '');
return false;

case 'google':
window.open('http://www.google.com.tr/search?q=' + qs_keywords, '_google', '');
return false;

default:
if( (i = qsearch_findEngine(qs_enginename)) >= 0 )
{
window.open(qsearch_engines[i].url + qs_keywords, '_blank', '');
return false;
}
break;
}
return true;
}
// -->
</script>
<!-- [-] arama fonksiyonu -->

<!-- [+] Error_Blocker -->
<script language="Javascript" type="text/javascript">
<!-- Begin
function blockError(){
return true;}

window.onerror = blockError;
// End -->
</script>
<!-- [-] Error_Blocker -->

<!-- [+] özel mesaj popup / layer -->
<!-- BEGIN switch_enable_pm_popup -->
<table aling="center" id="new_pm_popup" class="row1" border="0" cellspacing="1" cellpadding="4" style="position: absolute; top: 40%; left: 30%; height: 125px; width: 424px; display: none;">
<tr>
<td valign="top" class="row1" align="center">
<br />
<span class="gen">{L_PRIVATEMSG_NEW}<br /><br />{L_MESSAGE}</span><br /><br />
<span class="genmed"><a href="" onClick="getElementById('new_pm_popup').style.display = 'none'; return false;" class="genmed">{L_CLOSE_WINDOW}</a></span><br /><br />
</td>
</tr>
</table>

<script language="javascript" type="text/javascript">
<!--
if ( {PRIVATE_MESSAGE_NEW_FLAG} ) 
{ 
pmWindow = window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');
if (!window.pmWindow)
{ 
document.getElementById('new_pm_popup').style.display = 'inline'; 
} 
} 
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- [-] özel mesaj popup / layer -->

<!-- [+] rss linki -->
<link rel="alternate" title="{L_RSS}" href="{U_RSS}" type="application/rss+xml">
<!-- [-] rss linki -->

<style type="text/css">
<!--

body { margin:0px; 0px; 0px; 0px; background-color: #656565; background-image: url({TEMPLATE_PATH}/images/backs.gif); background-repeat: repeat-xy; scrollbar-face-color: {T_TR_COLOR2}; scrollbar-highlight-color: {T_TD_COLOR2}; scrollbar-shadow-color: {T_TR_COLOR2}; scrollbar-3dlight-color: {T_TR_COLOR3}; scrollbar-arrow-color: #444444; scrollbar-track-color: {T_TR_COLOR1}; scrollbar-darkshadow-color: {T_TH_COLOR1}; }

font,th,td,p { font-family: {T_FONTFACE1} }
a:link,a:active,a:visited { color : #444444; }
a:hover { text-decoration: bold; color : #FF6C00; }
hr { height: 0px; border: solid {T_TR_COLOR3} 0px; border-top-width: 1px;}

.bodyline { background-color: #F7F7F7; border: 10px #FFFFFF solid; }
.forumline { background-color: #F5F5F5; border: 0px {T_TH_COLOR2} solid; }

td.row1 { background-color: #FFFFFF; }
td.row2 { background-color: #FFFFFF; }
td.row3 { background-color: #FFFFFF; }

td.rowpic { background-color: {T_TD_COLOR2}; background-image: url({TEMPLATE_PATH}/images/{T_TH_CLASS3}); background-repeat: repeat-y; }
th {  background-color: #FF8313; color: #FFFFFF; font-size: 12px; font-weight : bold; height: 34px; background-image: url({TEMPLATE_PATH}/images/{T_TH_CLASS2}); }

td.cat,td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom { background-image: url({TEMPLATE_PATH}/images/{T_TH_CLASS1}); background-color:fcf9f1; border: {T_TH_COLOR3}; border-style: solid; height: 28px; }

td.cat,td.catHead,td.catBottom { height: 24px; border-width: 0px 0px 0px 0px; }
th.thHead,th.thSides,th.thTop,th.thLeft,th.thRight,th.thBottom,th.thCornerL,th.thCornerR { font-weight: bold; border: {T_TD_COLOR2}; border-style: solid; height: 24px; }
td.row3Right,td.spaceRow { background-color: #FE9B00; border: {T_TH_COLOR3}; border-style: solid; }

th.thHead,td.catHead { font-size: {T_FONTSIZE3}px; border-width: 1px 1px 0px 1px; }
th.thSides,td.catSides,td.spaceRow { border-width: 0px 0px 0px 0px; }
th.thRight,td.catRight,td.row3Right { border-width: 0px 0px 0px 0px; }
th.thLeft,td.catLeft { border-width: 0px 0px 0px 0px; }
th.thBottom,td.catBottom { border-width: 0px 0px 0px 0px; }
th.thTop { border-width: 0px 0px 0px 0px; }
th.thCornerL { border-width: 0px 0px 0px 0px; }
th.thCornerR { border-width: 0px 0px 0px 0px; }

.maintitle { font-weight: bold; font-size: 22px; font-family: "{T_FONTFACE2}",{T_FONTFACE1}; text-decoration: none; line-height : 120%; color : {T_BODY_TEXT}; }

.gen { font-size : {T_FONTSIZE3}px; }
.genmed { font-size : {T_FONTSIZE2}px; }
.gensmall { font-size : {T_FONTSIZE1}px; }
.gen,.genmed,.gensmall { color : {T_BODY_TEXT}; }
a.gen,a.genmed,a.gensmall { color: #444444; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover { color: #FF6C00; text-decoration: bold; }

.mainmenu { font-size : 11px; color : #444444 }
a.mainmenu { font-size: 11px; color:#525252; text-decoration:none; font-weight:bold; padding: 3px; }
a.mainmenu:hover{ color:#FFFFFF; text-decoration:none; background-color:#FF9000; padding: 3px; }

.cattitle { font-weight: bold; font-size: {T_FONTSIZE3}px ; letter-spacing: 1px; color : #444444}
a.cattitle { text-decoration: none; color : #444444; }
a.cattitle:hover{ text-decoration: bold; }

.forumlink { font-weight: bold; font-size: {T_FONTSIZE3}px; color : #444444; }
a.forumlink { text-decoration: none; color : #444444; }
a.forumlink:hover{ text-decoration: bold; color : #FF6C00; }

.nav { font-weight: bold; font-size: {T_FONTSIZE2}px; color : {T_BODY_TEXT};}
a.nav { text-decoration: none; color : #444444; }
a.nav:hover { text-decoration: bold; }

a.topictitle:link { text-decoration: none; color : #444444; }
a.topictitle:visited { text-decoration: none; color : #5F5F5F; }
a.topictitle:hover { text-decoration: bold; color : #FF6C00; }

.name { font-size : {T_FONTSIZE2}px; color : {T_BODY_TEXT};}
.postdetails { font-size : {T_FONTSIZE1}px; color : {T_BODY_TEXT}; }
.postbody { font-size : {T_FONTSIZE3}px; line-height: 18px}

a.postlink:link { text-decoration: none; color : #444444 }
a.postlink:visited { text-decoration: none; color : #5F5F5F; }
a.postlink:hover { text-decoration: bold; color : #FF6C00}

.copyright { font-size: {T_FONTSIZE1}px; font-family: {T_FONTFACE1}; color: {T_FONTCOLOR1}; letter-spacing: -1px;}

a.copyright { color: {T_FONTCOLOR1}; text-decoration: none;}
a.copyright:hover { color: {T_BODY_TEXT}; text-decoration: bold;}

input,textarea, select { color : {T_BODY_TEXT}; font: normal {T_FONTSIZE2}px {T_FONTFACE1}; border-color : {T_BODY_TEXT}; }
input.post, textarea.post, select { background-color : {T_TD_COLOR2}; }
input { text-indent : 2px; }

input.button { background-color : {T_TR_COLOR1}; color : {T_BODY_TEXT}; font-size: {T_FONTSIZE2}px; font-family: {T_FONTFACE1}; }
input.mainoption { background-color : {T_TD_COLOR1}; font-weight : bold; }
input.liteoption { background-color : {T_TD_COLOR1}; font-weight : normal; }

a.topic-new, a.topic-new:visited { color : { T_BODY_HLINK } ; }
a.topic-new:hover, a.topic-new:active { color : { T_BODY_LINK } ; }
td.inlineadtitle { background-color: {T_TR_COLOR3}; border: {T_TH_COLOR3}; border-style: solid; border-width: 0px; }
td.inlinead { background-color: {T_TR_COLOR3}; border: {T_TH_COLOR3}; border-style: solid; border-width: 1px; text-align: center; }

@import url("{TEMPLATE_PATH}/formIE.css");
-->
</style>

</head>
<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}">

<a name="top"></a>

<table width="{FORUM_WIDTH}" cellspacing="0" cellpadding="10" border="0" align="center">
<tr>
<td class="bodyline">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="center" width="100%" valign="middle">

<table width="100%" border="0" cellpadding="2" cellspacing="0" background="{TEMPLATE_PATH}/images/menu.gif">
<tr colspan="2">
<td height="25">
<span class="mainmenu">
<img src="images/arrow.gif"> <a class="mainmenu" href="{U_SEARCH}">{L_SEARCH}</a>

<!-- BEGIN switch_user_logged_in -->
<img src="images/arrow.gif"> <a class="mainmenu" href="{U_PROFILE}">{L_PROFILE}</a>
<!-- END switch_user_logged_in -->

<!-- BEGIN switch_user_logged_out -->
<img src="images/arrow.gif"> <a class="mainmenu" href="{U_REGISTER}">{L_REGISTER}</a>
<!-- END switch_user_logged_out -->

<img src="images/arrow.gif"> <a class="mainmenu" href="{U_LOGIN_LOGOUT}"><font color="red">{L_LOGIN_LOGOUT}</font></a>
</span>
</td>

<td align="right" height="25">
<span class="mainmenu">
<!-- BEGIN switch_user_logged_out -->
{CURRENT_TIME}
<!-- END switch_user_logged_out -->
<!-- BEGIN switch_user_logged_in -->
<img src="images/pm.gif"> <a class="mainmenu" href="{U_PRIVATEMSGS}">{PRIVATE_MESSAGE_INFO}</a>
<img src="images/self_message.gif"> <a class="mainmenu" href="{U_SEARCH_SELF}">{L_SEARCH_SELF}</a>
<img src="images/new_message.gif"> <a class="mainmenu" href="{U_SEARCH_NEW}"><font color="red">{L_SEARCH_NEW}</font></a>
<!-- END switch_user_logged_in -->
</span>
</td>
</tr>
</table>

<!--<img width="100%" height="105" alt="topbanner" src="images/random/random.php">-->
<img width="100%" height="105" alt="topbanner" src="{TEMPLATE_PATH}/images/top.gif">

<table width="100%" border="0" cellpadding="2" cellspacing="0" background="{TEMPLATE_PATH}/images/menu.gif">
<tr>
<td height="34" valign="middle" nowrap="nowrap">
<span class="gen">&nbsp;&nbsp;
<a class="mainmenu" href="{U_PORTAL}">{L_SITEMIZ}</a> &nbsp;&nbsp;|&nbsp;&nbsp;
<a class="mainmenu" href="{U_INDEX}">{L_FORUM}</a> &nbsp;&nbsp;|&nbsp;&nbsp;
<a class="mainmenu" href="{U_MEMBERLIST}">{L_MEMBERLIST}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a class="mainmenu" href="{U_GROUP_CP}">{L_USERGROUPS}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a class="mainmenu" href="{U_RECENT}">{L_RECENT}</a>
</span>
</td>
</tr>
</table>
</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
<td valign="middle" class="gensmall">
<!-- BEGIN switch_user_logged_out -->
<table>
<tr>
<td>
<br />
<form id="loginform" method="post" autocomplete="off" action="{S_LOGIN_ACTION}">
{S_REDIRECT_PAGE}
<img style="z-index: 3; position: relative; top: 3px" alt="{L_LOGIN}" src="images/login.gif">
<input style="padding-left: 8px; z-index: 2; left: -15px; position: relative" size="10" class="post" type="text" name="username" value="{L_USERNAME}?" id="loginfield"
onfocus="if (document.getElementById('loginform').username.value == '{L_USERNAME}?') { document.getElementById('loginform').username.value = ''; }"
onblur="if (document.getElementById('loginform').username.value == '') { document.getElementById('loginform').username.value = '{L_USERNAME}?'; }" />

<input style="padding-left: 8px; z-index: 2; left: -15px; position: relative" size="10" class="post" type="password" name="password" />
<input style="padding-left: 8px; z-index: 2; left: -15px; position: relative" size="10" type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
</form>
</td>
</tr>
</table>
<!-- END switch_user_logged_out -->
<!-- BEGIN switch_user_logged_in -->
<br />
<span class="gensmall">{CURRENT_TIME} <br /> {LAST_VISIT_DATE}</span>
<!--<b><span class="gen">{SITENAME} - {SITE_DESCRIPTION}</span> </b>-->
<!-- END switch_user_logged_in -->
</td>


<td align="right">
<br />
<form name="qsearch_form" id="qsearch_form" onsubmit="return qsearch_onSubmit();" action="{U_SEARCH}" method="post">
<input type="hidden" name="search_forum" value="-1">
<input type="hidden" name="show_results" value="topics">
<input type="hidden" name="search_terms" value="any">
<a title="{L_SEARCH}" href="{U_SEARCH}">
<img style="z-index: 3; position: relative; top: 3px" alt="{L_SEARCH}" src="images/uyari.gif"></a>
<input style="padding-left: 8px; z-index: 2; left: -13px; position: relative" class="post" type="text" name="search_keywords" size="15" value="...?" id="searchfield"
onfocus="if (document.getElementById('qsearch_form').search_keywords.value == '...?') { document.getElementById('qsearch_form').search_keywords.value = ''; }"
onblur="if (document.getElementById('qsearch_form').search_keywords.value == '') { document.getElementById('qsearch_form').search_keywords.value = '...?'; }" />
<select style="padding-left: 8px; z-index: 2; left: -10px; position: relative" class=post onchange=qsearch_onChange(); name=search_fields>
<option value="all" selected>{L_ALL_MESS}</option>
<option value="msgonly">{L_MES_TEXT}</option>
<option value="titleonly">{L_MES_TOPICS}</option>
<option value=yazar>{L_YAZAR}</option>
<option value=site>{L_ALL_SITE}</option>
<option value=google>{L_SEARCH_MT}</option>
</select>
<input style="padding-left: 8px; z-index: 2; left: -5px; position: relative" type="submit" class="mainoption" name="submit" value="{L_ARA}" />
</form>
</td>
</tr>
</table>

<!-- BEGIN switch_admin_disable_board -->
<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%">
<tr>
<td width="10%" class="row2" align="center"><img src="images/hata.png"></td>
<td class="row2" align="center"><span class="gen">{L_BOARD_DISABLE}</span></td>
</tr>
</table>
<!-- END switch_admin_disable_board -->

<!-- BEGIN ctracker_message -->
<div align="center">
<table width="80%" cellspacing="1" cellpadding="3" border="0" class="forumline">
<tr>
<td align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><img src="{ctracker_message.ICON_GLOB}" alt="" title="" border="0"></td>
<td align="center" style="background-color:#{ctracker_message.ROW_COLOR};"><span class="gensmall">{ctracker_message.L_MESSAGE_TEXT}</span></td>
</tr>
<tr>
<td align="center" class="row2" colspan="2"><span class="gensmall"><b><a href="{ctracker_message.U_MARK_MESSAGE}">{ctracker_message.L_MARK_MESSAGE}</a></b></span></td>
</tr>
</table>
</div>
<!-- END ctracker_message -->