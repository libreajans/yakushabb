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


/* Eklendi 1.6.0 */
$lang['PM_View_Type'] = 'Ki�isel Mesaj G�r�n�m Tipi';
$lang['Show_IP'] = 'IP Adresini g�ster';
$lang['Rows_Per_Page'] = 'Sayfa ba��na sat�r';
$lang['Archive_Feature'] = 'Ar�iv �zelli�i';
$lang['Inline'] = '�� sat�r';
$lang['Pop_up'] = 'A��lan Pencere';
$lang['Current'] = '�uanki';
$lang['Rows_Plus_5'] = '5 Sat�r Ekle';
$lang['Rows_Minus_5'] = '5 Sat�r Sil';
$lang['Enable'] = 'A��k';
$lang['Disable'] = 'Kapal�';
$lang['Inserted_Default_Value'] = '%s Ayar de�eri bulunamad�, varsay�lan de�er girildi.<br />'; // %s = ayar ismi
$lang['Updated_Config'] = 'Ayar de�eri g�ncellendi %s<br />'; // %s = ayar de�eri
$lang['Archive_Table_Inserted'] = 'Ar�iv tablosu bulunamad�, olu�turun<br />';
$lang['Switch_Normal'] = 'Normal Ar�iv Bi�imi';
$lang['Switch_Archive'] = 'Ar�iv Bi�imini De�i�tir';

/* Genel */
$lang['Deleted_Message'] = '�zel Mesaj Silindi - %s <br />'; // %s = K.M. ba�l���
$lang['Archived_Message'] = 'Ar�ivlenmi� Ki�isel Mesaj - %s <br />'; // %s = K.M. ba�l���
$lang['Archived_Message_No_Delete'] = 'Ar�iv i�in se�ilen %s mesaj� silemezsiniz<br />'; // %s = K.M. ba�l���
$lang['Private_Messages'] = 'Ki�isel Mesajlar';
$lang['Private_Messages_Archive'] = 'Ki�isel Mesaj Ar�ivi';
$lang['Archive'] = 'Ar�iv';
$lang['To'] = 'Kime';
$lang['Subject'] = 'Konu';
$lang['Sent_Date'] = 'G�nderilme Tarihi';
$lang['Delete'] = 'Sil';
$lang['From'] = 'G�nderen';
$lang['Sort'] = 'D�zenle';
$lang['Filter_By'] = 'Filtre';
$lang['PM_Type'] = 'Mesaj Tipi';
$lang['Status'] = 'Durum';
$lang['No_PMS'] = 'Arama kriterlerinize uygun g�sterilecek ki�isel mesaj bulunamad�.';
$lang['Archive_Desc'] = 'Ar�iv i�in se�ti�iniz ki�isel mesajlar burada listelenir. Normal kullan�c�lar bu b�l�me ula�amazlar, ama siz g�rebilir ve herhangi bir zamanda silebilirsiniz.';
$lang['Normal_Desc'] = 'Mesaj Panosundaki t�m ki�isel mesajlar� buradan y�netebilirsiniz. Bunlar� silebilir veya ar�iv olu�turabilirsiniz.';
$lang['Version'] = 'S�r�m';
$lang['Remove_Old'] = 'Gereksiz �zel Mesaj:</a> <span class=\'gensmall\'>Daha �ok �yelikleri silinmi� olan �yelerin kalan ki�isel mesajlar�n� silmek i�in.</span>';
$lang['Remove_Sent'] = 'Giden �zel Mesaj Kutusu:</a> <span class=\'gensmall\'>G�nderilen kutusundaki ki�isel mesajlar sadece kendilerine yollanan mesajlar�n ayn�lar�n�n kopyalar�d�r. Ger�ekten ihtiya� duyulmaz.</span>';
$lang['Affected_Rows'] = '%d bilinen giri�ler silindi.<br />';
$lang['Removed_Old'] = 'T�m gereksiz �zel mesajlar silindi<br />';
$lang['Removed_Sent'] = 'T�m giden �zel mesajlar silindi.<br />';
$lang['Utilities'] = 'Toplu silme arac�';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* Ki�isel MEsaj Tipileri */
$lang['PM_-1'] = 'T�m Mesajlar'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Okunmu� �zel mesaj'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'Yeni �zel mesaj'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Giden �zel mesaj'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Kay�tl� �zel mesaj (Gelen)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Kay�tl� �zel mesaj (Giden)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Okunmam�� �zel mesaj'; //PRIVMSGS_UNREAD_MAIL = 5

/* Hatalar */
$lang['Error_Other_Table'] = 'Gerekli tablo sorgulamas�nda hata.';
$lang['Error_Posts_Text_Table'] = '�zel mesaj metin tablosunu sorgulamada hata.';
$lang['Error_Posts_Table'] = '�zel mesaj tablosunu sorgulamada hata.';
$lang['Error_Posts_Archive_Table'] = '�zel mesaj ar�iv tablosunu sorgulamada hata.';
$lang['No_Message_ID'] = 'Belirtilen �yeye ait �zel mesaj yok.';


/* �zel Durumlar, Ba�ka bir lisanda kar���kl�k olmamas� i�in de�i�tirmeyin */
$lang['ASC'] = @$lang['Sort_Ascending'];
$lang['DESC'] = @$lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>