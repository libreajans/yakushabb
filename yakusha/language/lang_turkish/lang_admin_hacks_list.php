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
$lang['Hacks_List'] = 'Mod Listesi';
$lang['Page_Desc'] = 'Forumunuza y�kl� modlarla ilgili mod bilgilerini g�r�nt�lemenizi, d�zenlemenizi ve kald�rman�z� sa�lar. Bu bilgiler <a href=\'../modlist.php\' target=\'new\'>modlar</a> sayfas�nda listelenecek ve g�r�nt�lenecektir.';
$lang['Deleted_Hack'] = '%s modunu listeden kald�r<br />';
$lang['Updated_Hack'] = '%s modu i�in bilgiler g�ncellendi<br />';
$lang['Added_Hack'] = '%s modu i�in bilgiler y�klendi<br />';
$lang['Status'] = 'Durum';
$lang['No_Website'] = 'Web sitesi bulunmuyor';
$lang['No_Hacks'] = 'Y�kl� mod bilgisi bulunamad�';
$lang['Add_New_Hack'] = 'Yeni mod ekle';
$lang['User_Viewable'] = 'Gizle';
$lang['Hack_Name'] = 'Mod ad�';
$lang['Description'] = 'A��klama';
$lang['Required'] = 'Zorunlu';
$lang['Author_Email'] = 'Yazar e-posta';
$lang['Version'] = 'Versiyon';
$lang['Download_URL'] = 'Y�kleme kayna��';

/* Errors */
$lang['Error_Hacks_List_Table'] = 'Modlar i�in sorgulama i�leminde hata.';
$lang['Required_Field_Missing'] = 'Zorunlu alanlar� girme i�leminde hata.';
$lang['Error_File_Opening'] = 'Dosya a��lamad�: %s';

$lang['Look_up_hack'] = 'Mod ara';
$lang['Mod_no_found'] = 'Mod bulunamad�';

/*Special Cases, Do not bother to change for another language */
$lang['YES'] = @$lang['Yes'];
$lang['NO'] = @$lang['No'];
$lang['HL_File_Error'] = @$lang['Error_File_Opening'];

?>