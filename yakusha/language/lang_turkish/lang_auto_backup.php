<?php
/***************************************************************************
 * lang_auto_backup.php [English]
 ***************************************************************************/

$lang['Automatic_Backup'] = 'Otomatik Veritaban� Yedekle';
$lang['Automatic_Backup_Explain'] = 'Bu b�l�mde, otomatik veritaban� yedekleme ayarlar�n�z� d�zenleyebilirsiniz, basit zaman d�zeni i�in, <b>Basit Sentaks</b>\'� se�in, e�er geli�mi� ayarlar alan�n� kullanmak istiyorsan�z, <b>Geli�mi� Sentaks</b>\'� se�in. Buradan veritaban�n�z�n ne zaman yedeklenmesini istedi�inizi �zelle�tirebilir ve hangi e-posta adresinize bilgi verilmesini istedi�inizi belirtebilirsiniz.';
$lang['Automatic_Backup_Form_Explain'] = 'E-posta adresi se�ene�i i�in, Ba�ka bir server �zerinde olan e-posta adresinizi vermenizi tavsiye ederiz, ayr�ca bu e-posta adresinizin limiti y�ksek olmal�d�r; ��nk� veritaban� dosyas� b�y�k olabilir. (Gmail, Yahoo gibi...)';
$lang['Click_return_auto_backup'] = 'Otomatik Veritaban� Yedekleme ayarlar�na d�nmek i�in %sburaya%s t�klay�n�z';
$lang['Error_updating_auto_backup'] = 'SQL Yedek dosyalar� g�ncellenirken hata';
$lang['auto_backup_advanced_user'] = 'Geli�mi� Sentaks';
$lang['auto_backup_advanced_user_explain'] = 'Bu crontab program�n�n web aray�z�d�r. �rne�in: * * * * * ifadesi "Her g�n" anlam�na gelmektedir. 0 0 * * * ifadesi ise her g�n, gece yar�s� anlam�na gelmektedir.';
$lang['auto_backup_basic_user'] = 'Basit Sentaks';
$lang['auto_backup_level'] = 'Sentaks t�r�n� se�iniz';
$lang['Backup_type'] = 'Yedek Ayarlar�';
$lang['phpBB_only'] = 'Sadece phpBB tablolar�';
$lang['No_Search'] = 'Arama tablolar�n� ayr� tut';
$lang['Ignore_tables'] = 'Ekteki tablolar� ayr� tut';
$lang['Submit'] = 'G�nder';
$lang['Reset'] = 'Temizle';
$lang['Email_Address'] = 'E-posta adresi';
$lang['Email_true'] = 'Yedek dosyas�n� e-posta ile g�nder';
$lang['Delay_time'] = 'Gecikme zaman�';

// Dakika
$lang['Minutes'] = 'Dakika';
$lang['Every_Minute'] = 'Her Dakika';
$lang['Every_Other_Minutes']= 'Her Di�er Dakika';
$lang['Every_Five_Minutes']= 'Her Be� Dakika';
$lang['Every_Ten_Minutes']= 'Her On Dakika';
$lang['Every_Fifteen_Minutes']= 'Her Onbe� Dakika';

// Saat
$lang['Hours'] = 'Saat';
$lang['Every_Hour'] = 'Her Saat';
$lang['Every_Other_Hour']= 'Her Di�er Saat';
$lang['Every_Four_Hours']= 'Her D�rt Saat';
$lang['Every_Six_Hours']= 'Her Alt� Saat';
$lang['Midnight']= 'Geceyar�s�';
$lang['Noon']= '��len';

// G�nler
$lang['Days'] = 'G�n';
$lang['Every_Day'] = 'Her G�n';

// Aylar
$lang['Months'] = 'Aylar';
$lang['Every_Month'] = 'Her Ay';
$lang['January'] = 'Ocak';
$lang['February'] = '�ubat';
$lang['March'] = 'Mart';
$lang['April'] = 'Nisan';
$lang['May'] = 'May�s';
$lang['June'] = 'Haziran';
$lang['July'] = 'Temmuz';
$lang['August'] = 'A�ustos';
$lang['September'] = 'Eyl�l';
$lang['October'] = 'Ekim';
$lang['November'] = 'Kas�m';
$lang['December'] = 'Aral�k';

// haftan�n g�nleri
$lang['Weekdays'] = 'Haftan�n G�nleri';
$lang['Every_Weekday'] = 'Haftan�n Herg�n�';
$lang['Sunday'] = 'Pazar';
$lang['Monday'] = 'Pazartesi';
$lang['Tuesday'] = 'Sal�';
$lang['Wednesday'] = '�ar�amba';
$lang['Thursday'] = 'Per�embe';
$lang['Friday'] = 'Cuma';
$lang['Saturday'] = 'Cumartesi';

//FTP

$lang['FTP_true'] = 'Yede�i FTP Sunucu\'da sakla';
$lang['FTP_server'] = 'FTP Sunucu';
$lang['FTP_user_name'] = 'FTP Kullan�c� ad�';
$lang['FTP_user_pass'] = 'FTP �ifresi';
$lang['FTP_directory'] = 'FTP Dizini';

// Yedekleri backups dizinine sakla
$lang['write_backups_true'] = 'Yedekleri backups dizininde sakla';
$lang['files_to_keep'] = 'Tutulacak dosyalar';
$lang['files_to_keep_explain'] = 'Saklamak istedi�iniz yedekleme say�s�n� girin.<br><b>-1</b> ifadesi b�t�n yedeklemeleri sakla anlam�na gelir.';

$lang['Error_updating_auto_backup'] = 'SQL Yedek bilgisinde hata';
$lang['Error_retrieving_auto_backup'] = 'SQL yedek bilgisini d�zenelrken hata olu�tu.';
$lang['Error_enabling_disabling_board'] = 'Forumu kullanc�lara a�arken ya da kapat�rken sorun ya�and�.';
$lang['error_email_subject'] = 'Veritaban�n�z� yedeklerken bir hata olu�tu';
$lang['auto_backup_email_message'] = 'Veri taban�n�z ba�ar�l� bir �ekilde yedeklendi ';
$lang['auto_backup_email_subject'] = 'Veritaban� yede�i';
$lang['file_saved_to_backups'] = 'Dosya %s kay�t edildi';

// FTP email messages
$lang['Current_directory'] = 'Ge�erli Dizin';
$lang['Change_directory_to'] = 'Dizini �una de�i�tir';
$lang['Couldnt_change_directory'] = 'Dizin de�i�tirelemedi';
$lang['Creating_directory'] = 'Dizin ekle';
$lang['Created_directory'] = 'Dizin eklendi';
$lang['Cant_Create_directory'] = 'Dizin eklenemedi';
$lang['FTP_upload_failed'] = 'FTP y�klemesi ba�ar�s�z oldu';
$lang['FTP_connection_failed'] = 'FTP ba�lant�s� yap�lamad�';
$lang['FTP_file_information'] = 'FTP dosyas� bilgisi';
$lang['Uploaded_file_to'] = 'Dosyalar buraya: %s';

?>