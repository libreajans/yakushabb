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

// General
$lang['Auto_Delete'] = 'Otamatik Sil';
$lang['User_Auto_Delete'] = 'Otomatik Üye Sil';
$lang['Page_Desc'] = 'Bu eklenti, forumunuzu uzun süre ziyaret etmeyen üyeleri çeþitli þekillerde silmenizi saðlar.';
$lang['Updated_Value'] = '<b>%s</b> güncellendi.<br />';
$lang['Status'] = 'Ýþlem';
$lang['Version'] = 'Versiyon';
$lang['Enabled'] = 'Açýk :';
$lang['Auto_Days'] = 'Seçilen günden sonrasýný sil :';

$lang['Fake_Delete'] = 'Silinmiþ iþaretleme özelliði aktif edildi. Üyeler tamamen silinmemekte, sadece silinmiþ diye iþaretlenmektedir :).<br />';
$lang['Debug_Enabled'] = 'Debug is enabled. You may see lots of extra information printed out.<br />';

// Optional Emailer
$lang['Deletion_of_Inactive'] = 'Üyeliðinizi %d gün içinde aktif etmediðinizden dolayý üyeliðiniz otomatik olarak sistemden silinmiþtir.';
$lang['Deletion_of_Non_Visiting'] = 'Sitemizi %d gündür ziyaret etmediðinizden dolayý üyeliðiniz otomatik olarak sistemden silinmiþtir.';
$lang['Deletion_of_Non_Posting'] = 'Sitemize %d gündür mesaj yazmadýðýnýzdan dolayý üyeliðiniz otomatik olarak silinmiþtir.';

// Table Column -> Text
$lang['admin_auto_delete_inactive'] = 'Aktif olmayan üyeleri otomatik sil';
$lang['admin_auto_delete_non_visit'] = 'Forumu ziyaret etmeyen üyeleri otomatik sil';
$lang['admin_auto_delete_no_post'] = 'Mesaj göndermeyen üyeleri otomatik sil';

$lang['DESC_admin_auto_delete_inactive'] = 'Üye kayýt olmuþ fakat üyeliðini belirtilen sürede eposta ile aktif etmemiþse üyeliðini otomatik sil.';
$lang['DESC_admin_auto_delete_non_visit'] = 'Üye kayýt olmuþ, üyeliðini aktif etmiþ fakat uzun süre forumu ziyaret etmemiþse üyeliðini otomatik sil.';
$lang['DESC_admin_auto_delete_no_post'] = 'Üye kayýt olmuþ, üyeliðini aktif etmiþ fakat uzun süre foruma mesaj yazmamýþsa üyeliðini otomatik sil.';

$lang['admin_auto_delete_total'] = 'Toplam Otomatik Silinmiþ Üye';
$lang['DESC_admin_auto_delete_total'] = 'Bu, otomatik silinmiþ üye sayýsýnýn toplamýdýr. Otomatik güncellenir.';
$lang['admin_auto_delete_minutes'] = 'Otomatik Sil, Kaç Dakikada Bir Çalýþsýn';
$lang['DESC_admin_auto_delete_minutes'] = 'Otomatik silin ne zaman, kaç dakikada bir çalýþtýrýlacaðýný belirler.';

$lang['admin_auto_delete_days'] = 'Forumu ziyaret etmeyen üyeleri otomatik sil';
$lang['admin_auto_delete_days_no_post'] = 'Mesaj göndermeyen üyeleri otomatik sil';
$lang['admin_auto_delete_days_inactive'] = 'Aktif olmayan üyeleri otomatik sil';

// Errors
$lang['Config_Table_Error'] = 'Error querying Configuration Table.';
$lang['Error_Auto_Delete'] = 'Error doing user auto-delete';

?>