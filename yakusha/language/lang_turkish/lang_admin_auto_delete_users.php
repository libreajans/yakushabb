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

// General
$lang['Auto_Delete'] = 'Otamatik Sil';
$lang['User_Auto_Delete'] = 'Otomatik �ye Sil';
$lang['Page_Desc'] = 'Bu eklenti, forumunuzu uzun s�re ziyaret etmeyen �yeleri �e�itli �ekillerde silmenizi sa�lar.';
$lang['Updated_Value'] = '<b>%s</b> g�ncellendi.<br />';
$lang['Status'] = '��lem';
$lang['Version'] = 'Versiyon';
$lang['Enabled'] = 'A��k :';
$lang['Auto_Days'] = 'Se�ilen g�nden sonras�n� sil :';

$lang['Fake_Delete'] = 'Silinmi� i�aretleme �zelli�i aktif edildi. �yeler tamamen silinmemekte, sadece silinmi� diye i�aretlenmektedir :).<br />';
$lang['Debug_Enabled'] = 'Debug is enabled. You may see lots of extra information printed out.<br />';

// Optional Emailer
$lang['Deletion_of_Inactive'] = '�yeli�inizi %d g�n i�inde aktif etmedi�inizden dolay� �yeli�iniz otomatik olarak sistemden silinmi�tir.';
$lang['Deletion_of_Non_Visiting'] = 'Sitemizi %d g�nd�r ziyaret etmedi�inizden dolay� �yeli�iniz otomatik olarak sistemden silinmi�tir.';
$lang['Deletion_of_Non_Posting'] = 'Sitemize %d g�nd�r mesaj yazmad���n�zdan dolay� �yeli�iniz otomatik olarak silinmi�tir.';

// Table Column -> Text
$lang['admin_auto_delete_inactive'] = 'Aktif olmayan �yeleri otomatik sil';
$lang['admin_auto_delete_non_visit'] = 'Forumu ziyaret etmeyen �yeleri otomatik sil';
$lang['admin_auto_delete_no_post'] = 'Mesaj g�ndermeyen �yeleri otomatik sil';

$lang['DESC_admin_auto_delete_inactive'] = '�ye kay�t olmu� fakat �yeli�ini belirtilen s�rede eposta ile aktif etmemi�se �yeli�ini otomatik sil.';
$lang['DESC_admin_auto_delete_non_visit'] = '�ye kay�t olmu�, �yeli�ini aktif etmi� fakat uzun s�re forumu ziyaret etmemi�se �yeli�ini otomatik sil.';
$lang['DESC_admin_auto_delete_no_post'] = '�ye kay�t olmu�, �yeli�ini aktif etmi� fakat uzun s�re foruma mesaj yazmam��sa �yeli�ini otomatik sil.';

$lang['admin_auto_delete_total'] = 'Toplam Otomatik Silinmi� �ye';
$lang['DESC_admin_auto_delete_total'] = 'Bu, otomatik silinmi� �ye say�s�n�n toplam�d�r. Otomatik g�ncellenir.';
$lang['admin_auto_delete_minutes'] = 'Otomatik Sil, Ka� Dakikada Bir �al��s�n';
$lang['DESC_admin_auto_delete_minutes'] = 'Otomatik silin ne zaman, ka� dakikada bir �al��t�r�laca��n� belirler.';

$lang['admin_auto_delete_days'] = 'Forumu ziyaret etmeyen �yeleri otomatik sil';
$lang['admin_auto_delete_days_no_post'] = 'Mesaj g�ndermeyen �yeleri otomatik sil';
$lang['admin_auto_delete_days_inactive'] = 'Aktif olmayan �yeleri otomatik sil';

// Errors
$lang['Config_Table_Error'] = 'Error querying Configuration Table.';
$lang['Error_Auto_Delete'] = 'Error doing user auto-delete';

?>