<?php

if ( !defined('IN_PHPBB') )
{
die('Hacking attempt');
}

// --------------------------------------------------------------
// DOSYA ADI : lang_******.php
// TELÝF HAKKI : © 2000, 2005 Canver Networks [ phpBB Türkiye ]
// WWW : http://www.phpbbturkiye.com
// --------------------------------------------------------------

/* General */
$lang['Del_Before_Date'] = '%s tarihinden önceki tüm gölge baþlýklar silindi<br />';
$lang['Deleted_Topic'] = 'Gölge baþlýk %s silindi<br />';
$lang['Affected_Rows'] = '%d known entries were affected<br />';
$lang['Delete_From_Date'] = 'Tarihe göre silme';
$lang['Delete_Before_Date_Button'] = 'Tarihten öncesini sil';
$lang['No_Shadow_Topics'] = 'Hiçbir gölge baþlýk bulunamadý.';
$lang['Topic_Shadow'] = 'Gölge Baþlýklar';
$lang['TS_Desc'] = 'Orjinal mesaja dokunmadan gölge baþlýklarýn silinmesi iþlemini yerine getirir. Bir baþlýðý bir forumdan diðer foruma taþýdýðýnýzda, eski forumunda seçenek olarak, mesaja giden bir link býrakýlýr. Buna gölge baþlýk denilir.';
$lang['Month'] = 'Ay';
$lang['Day'] = 'Gün';
$lang['Year'] = 'Yýl';
$lang['Clear'] = 'Temizle';
$lang['Resync_Ran_On'] = 'Resync Ran On %s<br />';
$lang['All_Forums'] = 'Tüm forumlar';
$lang['Version'] = 'Versiyon';

$lang['Title'] = 'Baþlýk';
$lang['Moved_To'] = 'Kime';
$lang['Moved_From'] = 'Kimden';
$lang['Delete'] = 'Sil';

/* Modes */
$lang['topic_time'] = 'Zaman';
$lang['topic_title'] = 'Baþlýk';

/* Errors */
$lang['Error_Month'] = 'Seçtiðiniz Ay deðeri 1 ile 12 arasýnda olmalýdýr';
$lang['Error_Day'] = 'Seçtiðiniz Gün deðeri 1 ile 31 arasýnda olmalýdýr';
$lang['Error_Year'] = 'Seçtiðiniz Yýl deðeri 1970 ile 2038 arasýnda olmalýdýr';
$lang['Error_Topics_Table'] = 'Error accessing topics table';

//Special Cases, Do not change for another language
//türkçeleþtirilmiyor. böyle kalmalý
$lang['ASC'] = @$lang['Sort_Ascending'];
$lang['DESC'] = @$lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>