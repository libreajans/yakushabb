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


/* Eklendi 1.6.0 */
$lang['PM_View_Type'] = 'Kiþisel Mesaj Görünüm Tipi';
$lang['Show_IP'] = 'IP Adresini göster';
$lang['Rows_Per_Page'] = 'Sayfa baþýna satýr';
$lang['Archive_Feature'] = 'Arþiv Özelliði';
$lang['Inline'] = 'Ýç satýr';
$lang['Pop_up'] = 'Açýlan Pencere';
$lang['Current'] = 'Þuanki';
$lang['Rows_Plus_5'] = '5 Satýr Ekle';
$lang['Rows_Minus_5'] = '5 Satýr Sil';
$lang['Enable'] = 'Açýk';
$lang['Disable'] = 'Kapalý';
$lang['Inserted_Default_Value'] = '%s Ayar deðeri bulunamadý, varsayýlan deðer girildi.<br />'; // %s = ayar ismi
$lang['Updated_Config'] = 'Ayar deðeri güncellendi %s<br />'; // %s = ayar deðeri
$lang['Archive_Table_Inserted'] = 'Arþiv tablosu bulunamadý, oluþturun<br />';
$lang['Switch_Normal'] = 'Normal Arþiv Biçimi';
$lang['Switch_Archive'] = 'Arþiv Biçimini Deðiþtir';

/* Genel */
$lang['Deleted_Message'] = 'Özel Mesaj Silindi - %s <br />'; // %s = K.M. baþlýðý
$lang['Archived_Message'] = 'Arþivlenmiþ Kiþisel Mesaj - %s <br />'; // %s = K.M. baþlýðý
$lang['Archived_Message_No_Delete'] = 'Arþiv için seçilen %s mesajý silemezsiniz<br />'; // %s = K.M. baþlýðý
$lang['Private_Messages'] = 'Kiþisel Mesajlar';
$lang['Private_Messages_Archive'] = 'Kiþisel Mesaj Arþivi';
$lang['Archive'] = 'Arþiv';
$lang['To'] = 'Kime';
$lang['Subject'] = 'Konu';
$lang['Sent_Date'] = 'Gönderilme Tarihi';
$lang['Delete'] = 'Sil';
$lang['From'] = 'Gönderen';
$lang['Sort'] = 'Düzenle';
$lang['Filter_By'] = 'Filtre';
$lang['PM_Type'] = 'Mesaj Tipi';
$lang['Status'] = 'Durum';
$lang['No_PMS'] = 'Arama kriterlerinize uygun gösterilecek kiþisel mesaj bulunamadý.';
$lang['Archive_Desc'] = 'Arþiv için seçtiðiniz kiþisel mesajlar burada listelenir. Normal kullanýcýlar bu bölüme ulaþamazlar, ama siz görebilir ve herhangi bir zamanda silebilirsiniz.';
$lang['Normal_Desc'] = 'Mesaj Panosundaki tüm kiþisel mesajlarý buradan yönetebilirsiniz. Bunlarý silebilir veya arþiv oluþturabilirsiniz.';
$lang['Version'] = 'Sürüm';
$lang['Remove_Old'] = 'Gereksiz Özel Mesaj:</a> <span class=\'gensmall\'>Daha çok üyelikleri silinmiþ olan üyelerin kalan kiþisel mesajlarýný silmek için.</span>';
$lang['Remove_Sent'] = 'Giden Özel Mesaj Kutusu:</a> <span class=\'gensmall\'>Gönderilen kutusundaki kiþisel mesajlar sadece kendilerine yollanan mesajlarýn aynýlarýnýn kopyalarýdýr. Gerçekten ihtiyaç duyulmaz.</span>';
$lang['Affected_Rows'] = '%d bilinen giriþler silindi.<br />';
$lang['Removed_Old'] = 'Tüm gereksiz özel mesajlar silindi<br />';
$lang['Removed_Sent'] = 'Tüm giden özel mesajlar silindi.<br />';
$lang['Utilities'] = 'Toplu silme aracý';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* Kiþisel MEsaj Tipileri */
$lang['PM_-1'] = 'Tüm Mesajlar'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Okunmuþ özel mesaj'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Yeni özel mesaj'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Giden özel mesaj'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Kayýtlý özel mesaj (Gelen)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Kayýtlý özel mesaj (Giden)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Okunmamýþ özel mesaj'; //PRIVMSGS_UNREAD_MAIL = 5

/* Hatalar */
$lang['Error_Other_Table'] = 'Gerekli tablo sorgulamasýnda hata.';
$lang['Error_Posts_Text_Table'] = 'Özel mesaj metin tablosunu sorgulamada hata.';
$lang['Error_Posts_Table'] = 'Özel mesaj tablosunu sorgulamada hata.';
$lang['Error_Posts_Archive_Table'] = 'Özel mesaj arþiv tablosunu sorgulamada hata.';
$lang['No_Message_ID'] = 'Belirtilen üyeye ait özel mesaj yok.';


/* Özel Durumlar, Baþka bir lisanda karýþýklýk olmamasý için deðiþtirmeyin */
$lang['ASC'] = @$lang['Sort_Ascending'];
$lang['DESC'] = @$lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>