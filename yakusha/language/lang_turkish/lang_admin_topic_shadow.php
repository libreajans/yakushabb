<?php

if ( !defined('IN_PHPBB') )
{
die('Hacking attempt');
}

// --------------------------------------------------------------
// DOSYA ADI : lang_******.php
// TEL�F HAKKI : � 2000, 2005 Canver Networks [ phpBB T�rkiye ]
// WWW : http://www.phpbbturkiye.com
// --------------------------------------------------------------

/* General */
$lang['Del_Before_Date'] = '%s tarihinden �nceki t�m g�lge ba�l�klar silindi<br />';
$lang['Deleted_Topic'] = 'G�lge ba�l�k %s silindi<br />';
$lang['Affected_Rows'] = '%d known entries were affected<br />';
$lang['Delete_From_Date'] = 'Tarihe g�re silme';
$lang['Delete_Before_Date_Button'] = 'Tarihten �ncesini sil';
$lang['No_Shadow_Topics'] = 'Hi�bir g�lge ba�l�k bulunamad�.';
$lang['Topic_Shadow'] = 'G�lge Ba�l�klar';
$lang['TS_Desc'] = 'Orjinal mesaja dokunmadan g�lge ba�l�klar�n silinmesi i�lemini yerine getirir. Bir ba�l��� bir forumdan di�er foruma ta��d���n�zda, eski forumunda se�enek olarak, mesaja giden bir link b�rak�l�r. Buna g�lge ba�l�k denilir.';
$lang['Month'] = 'Ay';
$lang['Day'] = 'G�n';
$lang['Year'] = 'Y�l';
$lang['Clear'] = 'Temizle';
$lang['Resync_Ran_On'] = 'Resync Ran On %s<br />';
$lang['All_Forums'] = 'T�m forumlar';
$lang['Version'] = 'Versiyon';

$lang['Title'] = 'Ba�l�k';
$lang['Moved_To'] = 'Kime';
$lang['Moved_From'] = 'Kimden';
$lang['Delete'] = 'Sil';

/* Modes */
$lang['topic_time'] = 'Zaman';
$lang['topic_title'] = 'Ba�l�k';

/* Errors */
$lang['Error_Month'] = 'Se�ti�iniz Ay de�eri 1 ile 12 aras�nda olmal�d�r';
$lang['Error_Day'] = 'Se�ti�iniz G�n de�eri 1 ile 31 aras�nda olmal�d�r';
$lang['Error_Year'] = 'Se�ti�iniz Y�l de�eri 1970 ile 2038 aras�nda olmal�d�r';
$lang['Error_Topics_Table'] = 'Error accessing topics table';

//Special Cases, Do not change for another language
//t�rk�ele�tirilmiyor. b�yle kalmal�
$lang['ASC'] = @$lang['Sort_Ascending'];
$lang['DESC'] = @$lang['Sort_Descending'];
$lang['Nivisec_Com'] = 'Nivisec.com';

?>