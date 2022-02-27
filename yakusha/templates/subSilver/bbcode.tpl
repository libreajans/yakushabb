<!-- BEGIN ulist_open --><ul><!-- END ulist_open -->
<!-- BEGIN ulist_close --></ul><!-- END ulist_close -->
<!-- BEGIN olist_open --><ol type="{LIST_TYPE}"><!-- END olist_open -->
<!-- BEGIN olist_close --></ol><!-- END olist_close -->
<!-- BEGIN listitem --><li><!-- END listitem -->
<!-- BEGIN quote_username_open --><blockquote><h6>{USERNAME} {L_WROTE}:</h6><!-- END quote_username_open -->
<!-- BEGIN quote_open --><blockquote><h6>{L_QUOTE}:</h6><!-- END quote_open -->
<!-- BEGIN quote_close --></blockquote><!-- END quote_close -->
<!-- BEGIN code_open --><div class="code"><h6>{L_CODE}:</h6><!-- END code_open -->
<!-- BEGIN code_close --></div><!-- END code_close -->
<!-- BEGIN b_open --><span style="font-weight: bold"><!-- END b_open -->
<!-- BEGIN b_close --></span><!-- END b_close -->
<!-- BEGIN u_open --><span style="text-decoration: underline"><!-- END u_open -->
<!-- BEGIN u_close --></span><!-- END u_close -->
<!-- BEGIN i_open --><span style="font-style: italic"><!-- END i_open -->
<!-- BEGIN i_close --></span><!-- END i_close -->
<!-- BEGIN color_open --><span style="color: {COLOR}"><!-- END color_open -->
<!-- BEGIN color_close --></span><!-- END color_close -->
<!-- BEGIN size_open --><span style="font-size: {SIZE}px; line-height: normal"><!-- END size_open -->
<!-- BEGIN size_close --></span><!-- END size_close -->
<!-- BEGIN img --><img resizemod="on" onload="rmw_img_loaded(this)" src="{URL}" border="0" /><!-- END img -->
<!-- BEGIN url --><a rel="nofollow" href="{URL}" target="_blank" class="postlink">{DESCRIPTION}</a><!-- END url -->
<!-- BEGIN email --><a rel="nofollow" href="mailto:{EMAIL}">{EMAIL}</a><!-- END email -->
<!-- BEGIN s_open --><strike><!-- END s_open -->
<!-- BEGIN s_close --></strike><!-- END s_close -->
<!-- BEGIN table_open --><table style="{TABLE}"><tr><!-- END table_open -->
<!-- BEGIN table_close --></tr></table><!-- END table_close -->
<!-- BEGIN cell_open --><td style="{CELL}"><!-- END cell_open -->
<!-- BEGIN cell_close --></td><!-- END cell_close -->
<!-- BEGIN align_open --><div style="text-align:{ALIGN}"><!-- END align_open -->
<!-- BEGIN align_close --></div><!-- END align_close -->
<!-- BEGIN table_open --><table style="{TABLE}"><tr><!-- END table_open -->
<!-- BEGIN table_close --></tr></table><!-- END table_close -->
<!-- BEGIN font_open --><span style="font-family:{FONT}"><!-- END font_open -->
<!-- BEGIN font_close --></span><!-- END font_close -->
<!-- BEGIN left --><img src="{URL}" border="0" align="left" /><!-- END left --> 
<!-- BEGIN hr --><hr noshade color='#000000' size='1'><!-- END hr -->
<!-- BEGIN right --><img src="{URL}" border="0" align="right" /><!-- END left -->
<!-- BEGIN GVideo -->
<object width="425" height="350"> 
<param name="movie" value="http://video.google.com/googleplayer.swf?docId={GVIDEOID}"></param> 
<embed style="width:400px; height:326px;" id="VideoPlayback" 
align="middle" type="application/x-shockwave-flash" 
src="http://video.google.com/googleplayer.swf?docId={GVIDEOID}" 
allowScriptAccess="sameDomain" quality="best" bgcolor="#ffffff" 
scale="noScale" salign="TL"  FlashVars="playerMode=embedded"> 
</embed> 
</object><br /> 
<a rel="nofollow" href="http://video.google.com/googleplayer.swf?docId={GVIDEOID}" target="_blank">{GVIDEOLINK}</a><br /> 
<!-- END GVideo --> 

<!-- BEGIN youtube --> 
<object width="425" height="350"> 
<param name="movie" value="http://www.youtube.com/v/{YOUTUBEID}"></param> 
<embed src="http://www.youtube.com/v/{YOUTUBEID}" type="application/x-shockwave-flash" width="425" height="350"></embed> 
</object><br /> 
<a rel="nofollow" href="http://youtube.com/watch?v={YOUTUBEID}" target="_blank">{YOUTUBELINK}</a><br /> 
<!-- END youtube -->

<!-- BEGIN sup_open --><sup><!-- END sup_open -->
<!-- BEGIN sup_close --></sup><!-- END sup_close -->

<!-- BEGIN sub_open --><sub><!-- END sub_open -->
<!-- BEGIN sub_close --></sub><!-- END sub_close -->

<!-- BEGIN flash --><!-- URL's used in the movie--> 
<!-- text used in the movie--> 
<!-- --> 
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH={WIDTH} HEIGHT={HEIGHT}> 
<PARAM NAME=movie VALUE="{URL}"><PARAM NAME=quality VALUE=high> <PARAM NAME=scale VALUE=noborder> <PARAM NAME=wmode VALUE=transparent> <PARAM NAME=bgcolor VALUE=#000000> 
  <EMBED src="{URL}" quality=high scale=noborder wmode=transparent bgcolor=#000000 WIDTH={WIDTH} HEIGHT={HEIGHT} TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
</EMBED></OBJECT><!-- END flash --> 

<!-- BEGIN video -->
<div align="center"><embed src="{URL}" width={WIDTH} height={HEIGHT}></embed></div>
<!-- END video -->

<!-- BEGIN ram --><div align="center"><embed src="{URL}" align="center" width="275" height="40" type="audio/x-pn-realaudio-plugin" console="cons" controls="ControlPanel" autostart="false"></embed></div><!-- END ram -->

<!-- BEGIN stream --><object id="wmp" width={WIDTH} height={HEIGHT} classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" 
codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0" 
standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject"> 
<param name="FileName" value="{URL}"> 
<param name="ShowControls" value="1"> 
<param name="ShowDisplay" value="0"> 
<param name="ShowStatusBar" value="1"> 
<param name="AutoSize" value="1"> 
<embed type="application/x-mplayer2" 
pluginspage="http://www.microsoft.com/windows95/downloads/contents/wurecommended/s_wufeatured/mediaplayer/default.asp" 
src="{URL}" name=MediaPlayer2 showcontrols=1 showdisplay=0 showstatusbar=1 autosize=1 visible=1 animationatstart=0 transparentatstart=1 loop=0 height=70 width=300> 
</embed></object><!-- END stream -->

<!-- BEGIN marq_open --><marquee direction="{MARQ}" scrolldelay="120"><!-- END marq_open -->
<!-- BEGIN marq_close --></marquee><!-- END marq_close -->

<!-- BEGIN imgwh --><img src="{URL}" width={WIDTH} height={HEIGHT}></img><!-- END imgwh -->

<!-- BEGIN search --><a rel="nofollow" href="search.php?search_keywords={KEYWORD}"/>{KEYWORD}</a><!-- END search -->

<!-- BEGIN table_open --><table align="top" cellpadding="2" cellspacing="0" class="postbody" border="1" bgcolor="#FFFFFF"><!-- END table_open -->
<!-- BEGIN table_close --></td></tr></table><!-- END table_close -->
<!-- BEGIN table_color --><table align="top" cellpadding="2" cellspacing="0" class="postbody" bgcolor="{TABCOLOR}" border="1"><!-- END table_color -->
<!-- BEGIN table_size --><table align="top" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF" style="font-size: {TABSIZE}px" border="1"><!-- END table_size -->
<!-- BEGIN table_cs --><table align="top" cellpadding="2" cellspacing="0" bgcolor="{TABCSCOLOR}" style="font-size: {TABCSSIZE}px" border="1"><!-- END table_cs -->
<!-- BEGIN table_mainrow --></td></tr><tr><td style="font-weight: bold; text-align: center;"><!-- END table_mainrow -->
<!-- BEGIN table_mainrow_color --></td></tr><tr bgcolor="{TABMRCOLOR}"><td style="font-weight: bold; text-align: center;"><!-- END table_mainrow_color -->
<!-- BEGIN table_mainrow_size --></td></tr><tr style="font-size: {TABMRSIZE}px;"><td style="font-weight: bold; text-align: center;"><!-- END table_mainrow_size -->
<!-- BEGIN table_mainrow_cs --></td></tr><tr bgcolor="{TABMRCSCOLOR}" style="font-size: {TABMRCSSIZE}px"><td style="font-weight: bold; text-align: center;"><!-- END table_mainrow_cs -->
<!-- BEGIN table_maincol --></td><td style="font-weight: bold; text-align: center;"><!-- END table_maincol -->
<!-- BEGIN table_maincol_color --></td><td bgcolor="{TABMCCOLOR}" style="font-weight: bold; text-align: center;"><!-- END table_maincol_color -->
<!-- BEGIN table_maincol_size --></td><td style="font-size: {TABMCSIZE}px; font-weight: bold; text-align: center;"><!-- END table_maincol_size -->
<!-- BEGIN table_maincol_cs --></td><td bgcolor="{TABMCCSCOLOR}" style="font-size: {TABMCCSSIZE}px; font-weight: bold; text-align: center;"><!-- END table_maincol_cs -->
<!-- BEGIN table_row --></td></tr><tr><td><!-- END table_row -->
<!-- BEGIN table_row_color --></td></tr><tr bgcolor="{TABRCOLOR}"><td><!-- END table_row_color -->
<!-- BEGIN table_row_size --></td></tr><tr style="font-size: {TABRSIZE}px"><td><!-- END table_row_size -->
<!-- BEGIN table_row_cs --></td></tr><tr bgcolor="{TABRCSCOLOR}" style="font-size: {TABRCSSIZE}px"><td><!-- END table_row_cs -->
<!-- BEGIN table_col --></td><td><!-- END table_col -->
<!-- BEGIN table_col_color --></td><td bgcolor="{TABCCOLOR}"><!-- END table_col_color -->
<!-- BEGIN table_col_size --></td><td style="font-size: {TABCSIZE}px"><!-- END table_col_size -->
<!-- BEGIN table_col_cs --></td><td bgcolor="{TABCCSCOLOR}" style="font-size: {TABCCSSIZE}px"><!-- END table_col_cs -->
<!-- BEGIN google --><a href="http://www.google.com/search?q={QUERY}" target="_blank">{STRING}</a><!-- END google -->