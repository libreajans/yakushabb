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
$lang['Hacks_List'] = 'Mod Listesi';
$lang['Page_Desc'] = 'Forumunuza yüklü modlarla ilgili mod bilgilerini görüntülemenizi, düzenlemenizi ve kaldýrmanýzý saðlar. Bu bilgiler <a href=\'../modlist.php\' target=\'new\'>modlar</a> sayfasýnda listelenecek ve görüntülenecektir.';
$lang['Deleted_Hack'] = '%s modunu listeden kaldýr<br />';
$lang['Updated_Hack'] = '%s modu için bilgiler güncellendi<br />';
$lang['Added_Hack'] = '%s modu için bilgiler yüklendi<br />';
$lang['Status'] = 'Durum';
$lang['No_Website'] = 'Web sitesi bulunmuyor';
$lang['No_Hacks'] = 'Yüklü mod bilgisi bulunamadý';
$lang['Add_New_Hack'] = 'Yeni mod ekle';
$lang['User_Viewable'] = 'Gizle';
$lang['Hack_Name'] = 'Mod adý';
$lang['Description'] = 'Açýklama';
$lang['Required'] = 'Zorunlu';
$lang['Author_Email'] = 'Yazar e-posta';
$lang['Version'] = 'Versiyon';
$lang['Download_URL'] = 'Yükleme kaynaðý';

/* Errors */
$lang['Error_Hacks_List_Table'] = 'Modlar için sorgulama iþleminde hata.';
$lang['Required_Field_Missing'] = 'Zorunlu alanlarý girme iþleminde hata.';
$lang['Error_File_Opening'] = 'Dosya açýlamadý: %s';

$lang['Look_up_hack'] = 'Mod ara';
$lang['Mod_no_found'] = 'Mod bulunamadý';

/*Special Cases, Do not bother to change for another language */
$lang['YES'] = @$lang['Yes'];
$lang['NO'] = @$lang['No'];
$lang['HL_File_Error'] = @$lang['Error_File_Opening'];

?>