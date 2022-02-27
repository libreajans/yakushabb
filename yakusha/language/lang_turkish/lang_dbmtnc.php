<?php
// --------------------------------------------------------------
// DOSYA ADI : lang_dbmtnc.php
// Terc�me: sabri �nal / http://www.yakusha.net
// versiyon: 1.0.2 - 04-01-2007
// TEL�F HAKKI : � 2000, 2005 Canver Networks [ phpBB T�rkiye ]
// WWW : http://www.phpbbturkiye.com / http:www.canver.net
// --------------------------------------------------------------
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

//yakushaya �zg� de�erler ++++
$lang['Yakusha_versiyon'] = 'Yakusha Premod Version';
//yakushaya �zg� de�erler ----

//kurulum bilgileri
$lang['DB_Maintenance'] = 'Veritaban� bak�m';
$lang['DB_Maintenance_Description'] = 'Buradan veritaban�n�z� hatalara ve tutars�zl�klara kar�� denetleyebilirsiniz.<br /> <b>Uyar�:</b> Baz� i�lemler uzun s�re alabilir. Bu i�lemler s�ras�nda forum <b>kilitli</b> durumda olacakt�r.</br /><br /><b>Listedeki fonksiyonlar� kullanmadan �nce Veritaban�n�z�n yede�ini alman�z <b>tavsiye</b> edilir!</b>';
$lang['Function'] = 'Fonksiyon.';
$lang['Function_Description'] = 'A��klama.';
$lang['Incomplete_configuration'] = 'Forum ayarlar�n�zdan <b>%s</b> bulunamam��t�r. Veritaban� bak�m arac� bu ayarlar olmadan �al��amaz.<br /> Kurulum s�ras�nda yapman�z gereken SQL girdilerini eklemeyi unutmu� olabilirsiniz.';
$lang['dbtype_not_supported'] = '�zg�n�z, bu fonksiyon Veritaban�n�zca desteklenmiyor.';
$lang['no_function_specified'] = 'Hi�bir fonksiyon se�ilmedi.';
$lang['function_unknown'] = 'Se�ilen fonksiyon ge�ersiz.';
$lang['Old_MySQL_Version'] = '�zg�n�z. MySQL versiyonunuz bu fonksiyon ile uyumlu de�il. L�tfen MySQL 3.23.17 ve daha yeni versiyonlar� kullan�n.';
$lang['Back_to_DB_Maintenance'] = 'Veritaban� bak�m�na geri d�n.';
$lang['Processing_time'] = 'Veritaban� bak�m, bu i�lemi %f saniye i�inde tamamlam��t�r.';
$lang['Lock_db'] = 'Forum kilitleniyor.';
$lang['Unlock_db'] = 'Forum kilidi a��l�yor.';
$lang['Already_locked'] = 'Forum kilitlendi.';
$lang['Ignore_unlock_command'] = '<font color=\'red\'>Forum, bu komutla kilitlenmi�tir, fakat forum kilidi a��lamam��t�r. Forum kilidini a��n�z.</font>';
$lang['Delay_info'] = 'Bu i�lem �� saniye kadar s�rebilir.';
$lang['Affected_row'] = '1 Veritaban� de�eri etkilendi.';
$lang['Affected_rows'] = '%d veritaban� de�eri etkilendi.';
$lang['Done'] = '��lem Tamamland�.';

//i�lemler s�ras�nda i�lemler ger�ekle�tiriliyor yaz�s�n�n ��kmas�n� istemiyorsan�z bo� b�rak�n�z veya // ile kapat�n�z.
$lang['Nothing_to_do'] = '<p class=\'gen\'><i>��lem ger�ekle�tiriliyor :-)</i></p>';

//
// kurtar�lm�� de�erler i�in standart ba�l�klar
$lang['New_cat_name'] = 'Kurtar�lm�� forumlar';
$lang['New_forum_name'] = 'Kurtar�lm�� ba�l�klar';
$lang['New_topic_name'] = 'Kurtar�lm�� yaz�lar';
$lang['Restored_topic_name'] = 'Kurtar�lm�� ba�l�k';
$lang['New_poster_name'] = 'Kurtar�lm�� yaz�';


// Fonksiyonun mevcut i�leyi�i
//
// Dahili �smi: De�erleri terc�me edilmiyor, ��nk� fonksiyonlar bu de�erleri kulan�yor, dokunmay�n yani :)
// Kullan�m�: $mtnc[] = array(dahili ad�, fonksiyon ad�, fonksiyon a��klamas�, fonksiyon uyar� mesaj� (uyar� mesaj� ��kmas�n istiyorsan�z bo� b�rak�n).
// Kontrol fonsiyonun de�eri (say� olarak giriniz))

// liste i�inde sat�r aral�klar� olu�turmak i�in a�a��daki bo� fonksiyon de�erini kullan�n�z.
// $mtnc[] = array('--', '', '', '', 0)


/*$mtnc[] = array('statistic',
'�statistikler.',
'Forumunuza ve Veritaban�n�za dair bilgiler g�sterir.',
'',
0);
$mtnc[] = array('config',
'Ayarlar.',
'Veritaban� bak�m arac�n� yap�land�rman�za imkan tan�r.',
'',
5);
*/

$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_user',
'�ye ve Grup tablolar�n� tara.',
'�ye ve Grup tablolar�n� hatalara kar�� kapsaml� olarak tarar ve �yeleri kendi ki�isel gruplar�na yeniden ekler.',
'Bu i�lem sonunda, �yesi olmayan kullan�c� gruplar�n� kaybedeceksiniz. �lerleyelim mi?',
0);
$mtnc[] = array('check_post',
'Mesaj ve ba�l�k tablolar�n� tara.',
'Mesaj ve ba�l�k tablolar�n� hatalara kar�� tarar.',
'Bu i�lem sonunda, metin de�erleri bulunamayan t�m mesajlar� kaybedeceksiniz. �lerleyelim mi?',
0);
$mtnc[] = array('check_vote',
'Anket tablosunu tara.',
'Anket tablosunu hatalara kar�� tarar.',
'Bu i�lem sonunda, ge�erli bir ankete sahip olmayan oylar� kaybedeceksiniz. �lerleyelim mi?',
0);
$mtnc[] = array('check_pm',
'�zel Mesaj tablosunu tara.',
'�zel Mesaj tablosunu hatalara kar�� tarar.',
'Okunmam�� mesajlar, g�nderen �ye veya al�c� �ye varolmad���nda silinecektir. �lerleyelim mi?',
0);
$mtnc[] = array('check_config',
'Ayarlar tablosunu tara.',
'Bu i�lem, eksik giri�lere kar�� ayarlar tablosunu tarar.',
'',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_search_wordmatch',
'S�zc�k kay�t defterini tara.',
'Hatalara kar�� s�zc�k kay�t defterini tarar. Bu defter, forum arama fonksiyonu taraf�ndan kullan�lmaktad�r.',
'',
0);
$mtnc[] = array('check_search_wordlist',
'S�zc�k kay�t listesini tara.',
'S�zc�k kay�t listesini tarar ve t�m gereksiz kelime listelerini siler.',
'Bu i�lem biraz vakit alabilir. Bu i�lemi yapmak gerekli de�ildir, fakat yaparsan�z veritaban� b�y�kl���n� bir par�a azaltacakt�r. �lerleyelim mi?',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('synchronize_post',
'Forum ve ba�l�klar� uyumlu hale getir.',
'Forumlara ve Ba�l�klara ait mesaj say�lar�n� ve mesaj bilgilerini uyumlu hale getirir.',
'Bu i�lemin tamamlanmas� uzun s�re almaktad�r. E�er sunucunuz set_time_limit() PHP fonksiyonunu kullanman�za izin vermiyorsa bu i�lem yar�dakalabilir veya hi� ger�ekle�tirilemeyebilir. Bu durumda bir bilgi kayb�n�z olmayacakt�r fakat kimi bilgiler g�ncellenemeyecektir. �lerleyelim mi?',
0);
$mtnc[] = array('synchronize_user',
'�ye mesaj say�lar�n� uyumlu hale getir.',
'Bu i�lem, �ye mesaj say�lar�n� uyumlu hale getirir.',
'<b>Uyar�:</b> Normalde �ye mesajlar� silinirken mesaj say�lar� de�i�tirilmez. Bu i�lem s�ras�nda, �ye mesaj say�lar� varolan mesaj say�lar�yla de�i�tirilecektir ve bu i�lemden geri d�n�� m�mk�n de�ildir. �lerleyelim mi?',
6);
$mtnc[] = array('synchronize_mod_state',
'B�l�m yetkilisi bilgilerini uyumlu hale getir.',
'�ye tablosundaki verileri kullanarak, b�l�m yetkilisi bilgilerini uyumlu hale getirir.',
'',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_date',
'Son mesaj saatini yenile.',
'Bu i�lem, son mesaj saatini yeniden ayarlamaya yarar. Son mesaj saati, ba�l��a mesaj yaz�lmak istendi�inde kontrol edilmek �zere forum tablolarda saklanmaktad�r.',
'E�er mesajlar�n�zdan herhangi birisi hen�z gelmemi� bir zaman� g�steriyorsa, ge�erli saat ile de�i�tirilecektir. �lerleyelim mi?',
0);
$mtnc[] = array('reset_sessions',
'Oturum tablosunu bo�alt.',
'Bu i�lem, oturum tablosunu bo�altarak, oturum tablosunu yeniden d�zenler.',
'B�t�n aktif �yeler oturum bilgilerini ve arama sonu�lar�n� kaybedeceklerdir. �lerleyelim mi?',
0);

 /*
$mtnc[] = array('--', '', '', '', 8);
$mtnc[] = array('rebuild_search_index',
'Arama tablolar�n� yeniden olu�tur.',
'Arama tablolar� i�in bir kelime fihristi olu�turur. Normal �artlar alt�nda bu fonksiyona ihtiya� duymazs�n�z.',
'Arama tablolar�n� tamamen silip yeniden olu�turacakt�r. Bu i�lemi, forumunuzun b�y�kl��� oran�yla orant�l� olarak saatler bile s�rebilir. Bu i�lem s�resince forumunuz eri�ilebilir olmayacakt�r. �lerleyelim mi?',
7);
$mtnc[] = array('proceed_rebuilding',
'Arama tablosu olu�turmay� yeniden ba�lat.',
'Arama tablosu olu�turma i�leminiz yar�da kesildiyse bu fonksiyonu kullan�n.',
'',
4);
*/

$mtnc[] = array('--', '', '', '', 1);
$mtnc[] = array('check_db',
'Veritaban� hatalar�n� tara.',
'Hatalara kar�� veritaban� tablolar�n� tarar',
'',
1);
$mtnc[] = array('optimize_db',
'Veritaban� bilgilerini ��pten ay�kla',
'Veritaban� bilgilerini ��pten ay�kla. Bu i�lem, gereksiz tablo bilgilerini silerek forum tablolar�n�z� hafifletecektir. ',
'',
1);
$mtnc[] = array('repair_db',
'Veritaban� hatalar�n� tamir et.',
'Veritaban� tablolar�nda hata bulundu�unda hatalar� tamir edecektir.',
'Bu i�lemi, sadece veritaban� tablolar� taran�rken bir hata rapor edilirse kullanmal�s�n�z. �lerleyelim mi?',
1);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_auto_increment',
'Otomatik artan de�erleri s�f�rla',
'Bu i�lem, otomatik artan de�erleri s�f�rlar. Bu islem sadece, tablolara yeni veri kaydederken bir hata olursa kullan�lmal�d�r',
'Otomatik artan de�erleri s�f�rlamak istedi�inizden emin misiniz? Hi� bir veri kayb� olmayacakt�r fakat bu fonksiyonu sadece ihtiya� halinde kullanman�z gerekmektedir',
0);
$mtnc[] = array('heap_convert',
'Oturum tablosunu d�n��t�r',
'Bu i�lem, oturum tablonuzu HEAP tablo yap�s�na �evirir. HEAP tablo yap�s� MySQl normal tablo yap�s� olan MyISAM tablo yap�s�ndan daha h�zl� bir tablo yap�s�d�r. E�er bu se�ene�i kullan�rsan�z, phpBB forumunuzu bir par�a h�zland�rman�z m�mk�nd�r.',
'Oturum tablosunu MyISAM tablo yap�s�ndan HEAP tablo yap�s�na �evirmek istedi�inize emin misiniz?',
2);
$mtnc[] = array('--', '', '', '', 3);
$mtnc[] = array('unlock_db',
'Forum kilinidi a�',
'Bu fonksiyonu kullanmadan �nce bir i�lem s�ras�nda bir hata yapt�rd�ysan�z forum hala kilitlidir',
'',
3);

//
// fonksiyonlar i�in �zel de�erler.
//

//************************** istatistikler ****************************
$lang['Statistic_title'] = 'Forum ve veritaban� istatistikleri';
$lang['Database_table_info'] = 'Veritaban� istatistikleri iki t�r de�er ta��maktad�r.<br /> Birinci de�er standart phpBB ayarlar�yla gelen tablo de�erleridir ki \'phpBB ana tablolar�\' ba�l��� alt�nda listelenmektedir. �kinci de�er ise \'phpBB geli�mi� tablolar�\' ba�l��� alt�nda listelenmekte olan geli�mi� tablo de�erleridir. Bu de�erlere, eklenmi� modlar ile gelen phpBB tablolar� da dahildir.';
$lang['Board_statistic'] = 'Forum istatistikleri';
$lang['Database_statistic'] = 'Veritaban� istatistikleri';
$lang['Version_info'] = 'Versiyon bilgisi';
$lang['Thereof_deactivated_users'] = 'Aktif olmayan �ye say�s�';
$lang['Thereof_Moderators'] = 'B�l�m yetkilisi say�s�';
$lang['Thereof_Administrators'] = 'Forum y�neticisi say�s�';
$lang['Users_with_Admin_Privileges'] = 'Forum y�neticisi yetkisine sahip �yeler';
$lang['Number_tables'] = 'Tablo say�s�';
$lang['Number_records'] = 'Kay�t say�s�';
$lang['DB_size'] = 'Veritaban� b�y�kl���';
$lang['Thereof_phpbb_core'] = 'phpBB ana tablolar�nda';
$lang['Thereof_phpbb_advanced'] = 'phpBB geli�mi� tablolar�nda';
$lang['Version_of_board'] = 'phpBB versiyonu';
$lang['Version_of_mod'] = 'Veritaban� bak�m arac� versiyonu';
$lang['Version_of_PHP'] = 'PHP versiyonu';
$lang['Version_of_MySQL'] = 'MySQL versiyonu';

//************************** ayarlar ****************************
$lang['Config_title'] = 'Veritaban� bak�m arac� ayarlar�';
$lang['Config_info'] = 'Bu se�enekler, veritaban� bak�m arac�n� kontrol edebilmenize imkan verir. Unutmay�n�z, yanl�� yap�lm�� ayarlar, beklenmedik sonu�lara neden olabilir.';
$lang['General_Config'] = 'Genel ayarlar';
$lang['Rebuild_Config'] = 'Arama tablosu, yeniden yap�land�rma ayarlar�';
$lang['Current_Rebuild_Config'] = 'Arama tablosu, ge�erli yeniden yap�land�rma ayarlar�';
$lang['Rebuild_Settings_Explain'] = 'Bu ayarlar, arama tablolar�n� yeniden yap�land�r�l�rken, veritaban� bak�m arac�n�n nas�l davranmas� gerekti�ini belirler.';
$lang['Current_Rebuild_Settings_Explain'] = 'Bu ayarlar, veritaban� bak�m arac� taraf�ndan i�lemler s�ras�nda kullan�lmaktad�r ve yeniden yap�land�rma i�leminde nerede kal�nd���n� g�stermektedir. Normal �artlarda bu de�erler asla de�i�tirilmemelidir.';
$lang['Disallow_postcounter'] = '�ye mesaj say�s�n� uyumlu hale getirmeyi kapat.';
$lang['Disallow_postcounter_Explain'] = 'Fonksiyonlar�n �ye mesaj say�lar�n� yeniden d�zenlemelirini durdurabilirsiniz. E�er fonksiyonlar�n �ye mesaj say�lar�n� uyumlu hale getirmesini durdurursan�z, �yeleler yine eski mesaj de�erleri �zerinden i�lem g�r�rler.';
$lang['Disallow_rebuild'] = 'Arama tablosunu yeniden yap�land�rmay� kapat.';
$lang['Disallow_rebuild_Explain'] = 'Bu se�enek, arama tablolar�n�n yeninen yap�land�rma i�lemini kapatacakt�r. Fakat yar�da kesilmi� i�lemler i�in yeniden yap�land�rma fonksiyonu yine de kullan�l�r olacakt�r.';
$lang['Rebuildcfg_Timelimit'] = 'Yeniden in�a i�lemi i�in maksimum i�lem s�resi (saniye cinsinden)';
$lang['Rebuildcfg_Timelimit_Explain'] = 'Yeniden in�a i�lemi i�in maksimum i�lem s�resini belirler. (Normalde 240 saniye). Bu de�eri kendi tercihinize g�re daha uzun bir s�re olarak da belirleyebilirsiniz.';
$lang['Rebuildcfg_Timeoverwrite'] = 'Yeniden in�a i�lemine, i�lemi bitirmesi i�in verilecek fazladan s�re. (saniye cinsinden).';
$lang['Rebuildcfg_Timeoverwrite_Explain'] = 'Yeniden in�a i�lemine, i�lemi tamamlayabilmesi i�in fazladan s�re tan�r. (Normalde 0 saniye). E�er, s�f�r (0) girilirse, i�lem normal in�a s�resi �zerinden hesaplanacakt�r ve hesap edilen di�er s�reler de hesaplanan i�lem s�resi �zerine eklenecektir.';
$lang['Rebuildcfg_Maxmemory'] = 'Yeniden in�a i�lemi i�in maksimum mesaj b�y�kl���. (kByte cinsinden).';
$lang['Rebuildcfg_Maxmemory_Explain'] = 'Yeniden in�a i�leminin, tek seferde yeniden in�a edece�i en y�ksek mesaj b�y�kl���. (Normalde 500). ��lem s�ras�nda bu de�ere ula��l�rsa, i�lem kald��� yerden bir sonraki a�amada devam eder.';
$lang['Rebuildcfg_Minposts'] = 'Her a�amada, yeniden in�a edilecek en az mesaj say�s�.';
$lang['Rebuildcfg_Minposts_Explain'] = 'Her a�amada, yeniden in�a edilecek en az mesaj say�s�. (Normalde 3). Her a�amada, en az ka� mesaj�n yeniden in�a adilmesi gerekti�ini belirleyiniz.';
$lang['Rebuildcfg_PHP3Only'] = 'Sadece standard PHP 3 ile uyumlu yeniden in�a �zelli�ini kullan.';
$lang['Rebuildcfg_PHP3Only_Explain'] = 'Veritaban� bak�m arac� yeniden in�a �zelli�inin geli�mi� versiyonu olan PHP 4.0.5 ve �st� i�in ge�erli olan yeniden in�a �zelli�ini kullanmaktad�r. E�er bu se�ene�i ge�erli k�larsan�z, veritaban� bak�m arac� standart yeniden in�a metodunu kullanarak forumunuzun arama tablolar�n� yeniden in�a edecektir.';
$lang['Rebuildcfg_PHP4PPS'] = 'Geli�mi� in�a �zelli�i kullan�l�rken, her saniyede yeniden in�a edilecek mesaj say�s�.';
$lang['Rebuildcfg_PHP4PPS_Explain'] = 'Geli�mi� in�a �zelli�i kullan�l�rken, her saniyede yeniden in�a edilecek mesaj say�s�n�n yakla��k de�erini buraya girebilirsiniz. (Normalde 8).';
$lang['Rebuildcfg_PHP3PPS'] = 'Standart yeniden in�a �zelli�i kullan�l�rken, her saniyede yeniden in�a edilecek mesaj say�s�.';
$lang['Rebuildcfg_PHP3PPS_Explain'] = 'Standart yeniden in�a �zelli�i kullan�l�rken, her saniyede yeniden in�a edilecek mesaj say�s�n�n yakla��k de�erini buraya girebilirsiniz. (Normalde 1).';
$lang['Rebuild_Pos'] = 'Yeniden in�a edilmi� son mesaj';
$lang['Rebuild_Pos_Explain'] = 'Yeniden in�a edilmi� son mesaj�n ID de�eri. E�er bu de�er -1 ise, yeniden in�a i�lemi tamamlanm�� demektir.';
$lang['Rebuild_End'] = 'Yeniden in�a edilecek son mesaj';
$lang['Rebuild_End_Explain'] = 'Yeniden in�a s�ras�nda indexlenecek son mesaj�n ID de�eri. E�er bu de�er 0 ise, yeniden yap�land�rma i�lemi tamamlanm�� demektir.';

/*
//ingilizcesi
$lang['Rebuild_Pos'] = 'Last post indexed';
$lang['Rebuild_Pos_Explain'] = 'ID of the last successful indexed post. Is -1 when rebuilding has finished.';
$lang['Rebuild_End'] = 'Last post to index';
$lang['Rebuild_End_Explain'] = 'ID of the last post to index. Is 0 when rebuilding has finished.';

//eski t�rk�ele�tirmesi
$lang['Rebuild_Pos'] = 'Yeniden yap�land�rma s�ras�nda kal�nan mesaj de�eri.';
$lang['Rebuild_Pos_Explain'] = 'Yeniden yap�land�rma s�ras�nda kal�nan, mesaj�n ID de�eri. E�er de�er -1 ise, yeniden yap�land�rma i�lemi tamamlanm�� demektir.';
$lang['Rebuild_End'] = 'Yeniden yap�land�rma s�ras�nda yar�da kal�nan mesaj de�eri.';
$lang['Rebuild_End_Explain'] = 'Yeniden yap�land�rma s�ras�nda yar�da kal�nan mesaj�n ID de�eri. E�er bu de�er 0 
*/
$lang['Dbmtnc_config_updated'] = 'Ayarlar ba�ar�yla g�ncelle�tirilmi�tir.';
$lang['Click_return_dbmtnc_config'] = 'Ayarlar men�s�ne d�nmek i�in %sburaya%s t�klay�n�z.';

//************************** �yeleri tara ****************************
$lang['Checking_user_tables'] = '�ye ve grup tablolar� taran�yor.';
$lang['Checking_missing_anonymous'] = 'Anonim kullan�c� taran�yor.';
$lang['Anonymous_recreated'] = 'Anonim kullan�c� yeniden �retiliyor.';
//---[+]------------------------------------ garip terc�me------------
$lang['Checking_incorrect_pending_information'] = 'Ge�ersiz ask� bilgileri taran�yor';
$lang['Updating_invalid_pendig_user'] = 'Bir �yeye ait ge�ersiz ask� bilgileri g�ncelle�tirildi.';
$lang['Updating_invalid_pendig_users'] = '%d �yeye ait ge�ersiz ask� bilgileri g�ncelle�tirildi';
$lang['Updating_pending_information'] = 'Ki�isel gruplara ait ge�ersiz ask� bilgileri g�ncelle�tiriliyor.';
//---[-]------------------------------------ garip terc�me------------
$lang['Checking_missing_user_groups'] = '�oklu grup kay�tlar�na kar�� �ye tablolar� taran�yor.';
$lang['Found_multiple_SUG'] = '�oklu grup kay�tlar�na sahip �yeler bulundu.';
$lang['Resolving_user_id'] = '�yeler gruplar�na yeniden yerle�tiriliyor.';
$lang['Removing_groups'] = 'Gruplar siliniyor.';
$lang['Removing_user_groups'] = '�yelerin grup bilgileri siliniyor.';
$lang['Recreating_SUG'] = '�yeler i�in ki�isel �ye gruplar� yeniden d�zenleniyor.';
$lang['Checking_for_invalid_moderators'] = 'Hatal� grup y�neticileri taran�yor.';
$lang['Updating_Moderator'] = 'Grup yetkilileri yeniden ayarlan�yor.';
$lang['Checking_moderator_membership'] = 'B�l�m yetkilileri i�in, grup �yelik bilgileri taran�yor.';
$lang['Updating_mod_membership'] = 'B�l�m yetkilileri i�in, grup �yelik bilgileri g�ncelleniyor.';
$lang['Moderator_added'] = 'B�l�m yetkilileri bir gruba ekleniyor.';
//---[+]------------------------------------ garip terc�me------------
$lang['Moderator_changed_pending'] = 'Grup y�neticisi ask� bilgisi de�i�tirildi.';
//--[-]------------------------------------- garip terc�me------------
$lang['Remove_invalid_user_data'] = 'Ge�ersiz �ye kay�tlar� grup tablosundan siliniyor.';
$lang['Remove_empty_groups'] = 'Bo� gruplar siliniyor.';
$lang['Remove_invalid_group_data'] = 'Ge�ersiz grup bilgileri grup tablosundan siliniyor.';
$lang['Checking_ranks'] = 'Ge�ersiz r�tbeler taran�yor.';
$lang['Invalid_ranks_found'] = 'Ge�ersiz r�tbelere sahip �yeler taran�yor.';
$lang['Removing_invalid_ranks'] = 'Ge�ersiz r�tbeler siliniyor.';
$lang['Checking_themes'] = 'Ge�ersiz tema ayarlar� taran�yor.';
$lang['Updating_users_without_style'] = '�yeler, tema yok �eklinde g�ncelle�tiriliyor.';
$lang['Default_theme_invalid'] = '<b>Uyar�:</b> Standart tema ge�ersiz. Ayarlar�n�z� kontrol ediniz.';
$lang['Updating_themes'] = 'Ge�ersiz tema bilgisi %d temas�yla de�i�tiriliyor.';
$lang['Checking_theme_names'] = 'Ge�ersiz tema ad� bilgileri taran�yor.';
$lang['Removing_invalid_theme_names'] = 'Ge�ersiz tema ad� bilgileri siliniyor.';
$lang['Checking_languages'] = 'Ge�ersiz dil dosyalar� taran�yor.';
$lang['Invalid_languages_found'] = 'Ge�ersiz dil de�erine sahip bir �ye bulundu.';
$lang['Default_language_invalid'] = '<b>Uyar�:</b> Standart dil yanl��. L�tfen ayarlar�n�z kontrol ediniz.';
$lang['English_language_invalid'] = '<b>Uyar�:</b> Standart dil yanl�� ve ingilizce (t�rk�e) dil dosyas� bulunam�yor. <b>lang_english (lang_turkish)</b> -klas�r�n� kontrol ediniz.';
$lang['Changing_language'] = 'Dil dosyas� \'%s\' den \'%s\' diline de�i�tiriliyor.';
$lang['Remove_invalid_ban_data'] = 'Ge�ersiz yasakl� �ye bilgileri siliniyor.';
$lang['Remove_invalid_session_keys'] = 'Ge�ersiz oturum anahtar� de�erleri siliniyor.';

//************************** mesajlar� tara ****************************
$lang['Checking_post_tables'] = 'Mesaj ve ba�l�k tablolar� kontrol ediliyor.';
$lang['Checking_invalid_forums'] = 'Forumlar, ge�ersiz katergorilere kar�� taran�yor.';
$lang['Invalid_forums_found'] = 'Ge�ersiz kategoriye sahip forumlar bulundu.';
$lang['Setting_category'] = 'Forumlar \'%s\' kategorisine ta��n�yor.';
$lang['Checking_posts_wo_text'] = 'Metin bilgisine sahip olmayan mesajlar taran�yor.';
$lang['Posts_wo_text_found'] = 'Metin bilgisine sahip olmayan mesajlar bulundu.';
$lang['Deleting_post_wo_text'] = '%d (Ba�l�k: %s (%d); �ye: %s (%d)).';
$lang['Deleting_Posts'] = 'Mesaj bilgileri siliniyor.';
$lang['Checking_topics_wo_post'] = 'Mesaj sahibi olmayan ba�l�klar taran�yor.';
$lang['Topics_wo_post_found'] = 'Mesaj sahibi olmayan ba�l�klar bulundu.';
$lang['Deleting_topics'] = 'Ba�l�k bilgileri siliniyor.';
$lang['Checking_invalid_topics'] = 'Ba�l�k bilgileri, ge�ersiz forum bigilerine kar�� taran�yor.';
$lang['Invalid_topics_found'] = 'Ge�ersiz forum bilgilerine sahip ba�l�klar bulundu.';
$lang['Setting_forum'] = 'Ba�l�klar \'%s\' forumuna t���n�yor.';
$lang['Checking_invalid_posts'] = 'Mesajlar, ge�ersiz ba�l�k bilgilerine kar�� taran�yor.';
$lang['Invalid_posts_found'] = 'Ge�ersiz ba�l�k bilgilerine sahip mesajlar bulundu.';
$lang['Setting_topic'] = '%s mesajlar� \'%s\' ba�l�klar�na (%d) \'%s\' forumuna ta��n�yor.';
$lang['Checking_invalid_forums_posts'] = 'Mesajlar, ge�ersiz forum bilgilerine kar�� taran�yor.';
$lang['Invalid_forum_posts_found'] = 'Ge�ersiz forum bilgilerine sahip mesajlar bulundu.';
$lang['Setting_post_forum'] = '%d: \'%s\' forumundan (%d) \'%s\' forumuna (%d) ta��n�yor';
$lang['Checking_texts_wo_post'] = 'Mesaj bilgisine sahip olmayan mesaj metinleri taran�yor.';
$lang['Invalid_texts_found'] = 'Mesaj bilgisine sahip olmayan mesaj metinleri bulundu.';
$lang['Recreating_post'] = '%d mesaj� yeniden olu�turuluyor ve \'%s\' ba�l���yla \'%s\' forumuna t���n�yor.<br />��karan: %s';
$lang['Checking_invalid_topic_posters'] = 'Ge�ersiz g�nderici bilgisine sahip ba�l�klar taran�yor.';
$lang['Invalid_topic_poster_found'] = 'Ge�ersiz g�nderici bilgisine sahip ba�l�klar bulundu.';
$lang['Updating_topic'] = 'Ba�l�k g�ncelleniyor %d (G�nderen: %d -&gt; %d).';
$lang['Checking_invalid_posters'] = 'Ge�ersiz g�nderici bilgisine sahip mesajlar taran�yor.';
$lang['Invalid_poster_found'] = 'Ge�ersiz g�nderici bilgisine sahip mesajlar bulundu.';
$lang['Updating_posts'] = 'Mesajlar g�ncelleniyor.';
$lang['Checking_moved_topics'] = 'Ta��nm�� ba�l�klar taran�yor.';
$lang['Deleting_invalid_moved_topics'] = 'Ge�ersiz ta��nm�� ba�l�klar siliniyor.';
$lang['Updating_invalid_moved_topic'] = 'Silinmemi� bir ba�l��a ait, ge�ersiz ta��nm�� ba�l�k bilgileri g�ncelleniyor.';
$lang['Updating_invalid_moved_topics'] = 'Silinmemi� ba�l�klara ait, ge�ersiz ta��nm�� ba�l�k bilgileri %d ba�l�klar� i�in g�ncelleniyor.';
$lang['Checking_prune_settings'] = 'Ge�ersiz temizlik bilgileri taran�yor.';
$lang['Removing_invalid_prune_settings'] = 'Ge�ersiz temizlik bilgileri siliniyor.';
$lang['Updating_invalid_prune_setting'] = 'Bir foruma ait ge�ersiz temizlik bilgileri g�ncelleniyor.';
$lang['Updating_invalid_prune_settings'] = '%d forumlar�na ait ge�ersiz temizlik bilgileri g�ncelleniyor.';
$lang['Checking_topic_watch_data'] = 'Ge�ersiz ba�l�k izleme bilgileri taran�yor.';
$lang['Checking_auth_access_data'] = 'Ge�ersiz grup y�neticisi bilgileri taran�yor.';
$lang['Must_synchronize'] = 'Foruma d�nmeden �nce mesaj tablolar�n� uyumlu hale etmeniz gerekmektedir. ��lemi ger�ekle�tirmek i�in t�klay�n�z.';

//************************** anket bilgilerini tara ****************************
$lang['Checking_vote_tables'] = 'Anket tablosunu tara.';
$lang['Checking_votes_wo_topic'] = 'Uyu�mayan ba�l�klar i�in anketler taran�yor.';
$lang['Votes_wo_topic_found'] = 'Ba�l�ks�z anketler bulundu.';
$lang['Invalid_vote'] = '%s (%d) - Ba�lang�� tarihi: %s - Biti�i tarihi: %s';
$lang['Deleting_votes'] = 'Anketler siliniyor.';
$lang['Checking_votes_wo_result'] = 'Sonu�suz oylar taran�yor.';
$lang['Updating_topics_wo_vote'] = 'Anket olarak i�aretlenmi�, fakat hakk�nda yanl�� oy bilgileri bulunan ba�l�klar g�ncelleniyor.';
$lang['Updating_topics_w_vote'] = 'Anket olarak i�aretlenmemi�, fakat hakk�nda oy bulunan ba�l�klar g�ncelleniyor.';
$lang['Invalid_result'] = 'Ge�ersiz sonu�lar siliniyor: %s (Oylar: %d).';
$lang['Checking_voters_data'] = 'Ge�ersiz oy kullanan bilgileri taran�yor.';

$lang['Checking_results_wo_vote'] = 'Checking for results without corresponding vote';
$lang['Results_wo_vote_found'] = 'Found results without vote';
$lang['Invalid_result'] = 'Deleting result: %s (Votes: %d)';
$lang['Checking_voters_data'] = 'Checking for invalid voting data';

//--[ + ] --- buras� �ok kar���k
$lang['Votes_wo_result_found'] = 'Sahipsiz oylar bulundu.';
$lang['Checking_topics_vote_data'] = 'Uyu�mayan sonu�lara kar�� oy tablolar� taran�yor.';
$lang['Checking_results_wo_vote'] = 'Uyu�mayan sonu�lara kar�� anket tablolar� taran�yor';
$lang['Results_wo_vote_found'] = 'Sahipsiz anketler bulundu.';
//--[ - ] --- buras� �ok kar���k


//************************** �zel mesajlar� tara ****************************
$lang['Checking_pm_tables'] = '�zel mesaj tablosu taran�yor.';
$lang['Checking_pms_wo_text'] = 'Metinleri kay�p �zel mesajlar taran�yor.';
$lang['Pms_wo_text_found'] = 'Metni kay�p �zel mesajlar bulundu.';
$lang['Deleting_pn_wo_text'] = '%d (Konu: %s; G�nderen: %s (%d); Al�c�: %s (%d))';
$lang['Deleting_Pms'] = '�zel mesaj bilgisi siliniyor.';
$lang['Checking_texts_wo_pm'] = '�zel mesaj bilgilerine sahip olmayan ge�ersiz �zel mesaj metinleri taran�yor.';
$lang['Deleting_pm_texts'] = 'Ge�ersiz �zel mesaj metinleri siliniyor.';
$lang['Checking_invalid_pm_senders'] = 'Ge�ersiz g�nderici bilgisine sahip �zel mesajlar taran�yor.';
$lang['Invalid_pm_senders_found'] = 'Ge�ersiz g�nderici bilgisine sahip �zel mesajlar bulundu.';
$lang['Updating_pms'] = '�zel mesajlar g�ncelleniyor.';
$lang['Checking_invalid_pm_recipients'] = '�zel mesajlar, ge�ersiz al�c� bilgilerine kar�� taran�yor.';
$lang['Invalid_pm_recipients_found'] = 'Ge�ersiz al�c� bilgisine sahip �zel mesajlar bulundu.';
$lang['Checking_pm_deleted_users'] = '�zel mesajlar, silinmi� g�ndericilere ve al�c�lara kar�� taran�yor.';
$lang['Invalid_pm_users_found'] = 'Silinmi� g�nderici veya al�c� bilgisine sahip �zel mesajlar bulundu.';
$lang['Deleting_pms'] = '�zel mesajlar siliniyor.';
$lang['Synchronize_new_pm_data'] = 'Yeni �zel mesaj say�lar� uyumlu hale getiriliyor.';
$lang['Synchronizing_users'] = 'Kullan�c�lar g�ncelleniyor.';
$lang['Synchronizing_user'] = 'Kullan�c� g�nceleniyor %s (%d).';
$lang['Synchronize_unread_pm_data'] = 'Okunmam�� �zel mesaj say�s� uyumlu hale getiriliyor.';

//************************** mesajlar� uyumlu hale getir ****************************
$lang['Synchronize_posts'] = 'Mesaj bilgileri uyumlu hale getiriliyor.';
$lang['Synchronize_topic_data'] = 'Mesaj ba�l�klar� uyumlu hale getiriliyor.';
$lang['Synchronizing_topics'] = 'Ba�l�klar g�ncelleniyor.';
$lang['Synchronizing_topic'] = '%d nolu ba�l�k (%s) g�ncelleniyor.';
$lang['Synchronize_moved_topic_data'] = 'Ta��nm�� ba�l�klar uyumlu hale getiriliyor.';
$lang['Inconsistencies_found'] = 'Veritaban�n�zda tutars�zl�k bulundu. L�tfen %smesaj ve ba�l�k tablolar�n�%s kontrol ediniz.';
$lang['Synchronizing_moved_topics'] = 'Ta��nm�� ba�l�klar g�ncelleniyor.';
$lang['Synchronizing_moved_topic'] = 'Ta��nm�� ba�l�k g�ncelleniyor %d -&gt; %d (%s).';
$lang['Synchronize_forum_topic_data'] = 'Forumlar i�in ba�l�k bilgileri uyumlu hale getiriliyor.';
$lang['Synchronizing_forums'] = 'Forumlar g�ncelleniyor.';
$lang['Synchronizing_forum'] = 'Forum %d (%s) g�ncelleniyor.';
$lang['Synchronize_forum_data_wo_topic'] = 'Ba�l�ks�z forumlar uyumlu hale getiriliyor.';
$lang['Synchronize_forum_post_data'] = 'Forumlar�n mesaj bilgileri uyumlu hale getiriliyor.';
$lang['Synchronize_forum_data_wo_post'] = 'Mesajs�z forumlar uyumlu hale getiriliyor.';

// k���k lokmalar
//--- ayar tablosunu tara
$lang['Checking_config_table'] = 'Ayar tablosu kontrol ediliyor.';
$lang['Checking_config_entries'] = 'Ayar tablosu de�erleri kontrol ediliyor.';
$lang['Restoring_config'] = 'Kay�tlar tamir ediliyor.';
//--- check_search_wordmatch
$lang['Checking_search_wordmatch_tables'] = 'S�zc�k kay�t defteri taran�yor.';
$lang['Checking_search_data'] = 'Ge�ersiz arama bilgileri taran�yor.';
//--- check_search_wordlist
$lang['Checking_search_wordlist_tables'] = 'S�zc�k kay�t listeleri taran�yor.';
$lang['Checking_search_words'] = 'Ge�ersiz arama kelimeleri taran�yor.';
$lang['Removing_part_invalid_words'] = 'Ge�ersiz arama kelimeleri par�alar� siliniyor.';
$lang['Removing_invalid_words'] = 'Ge�ersiz arama kelimeleri siliniyor.';
//--- rebuild_search_index
$lang['Rebuilding_search_index'] = 'Arama tablolar�n� yeniden olu�tur.';
$lang['Deleting_search_tables'] = 'Arama tablolar� bo�alt�l�yor.';
$lang['Reset_search_autoincrement'] = 'Arama tablolar� sayac� yenileniyor.';
$lang['Preparing_config_data'] = 'Ayar bilgileri d�zenleniyor.';
$lang['Can_start_rebuilding'] = 'Art�k arama tablolar�n� yeniden olu�turmaya ba�layabilirsiniz.';
$lang['Click_once_warning'] = '<b>Linke yaln�z bir kere bas�n�z!</b> - Yeni sayfan�n g�sterilmesi biraz vakit alabilir.';
//--- proceed_rebuilding
$lang['Preparing_to_proceed'] = 'Tablolar i�lemler i�in haz�rlan�yor.';
$lang['Preparing_search_tables'] = 'Arama tablolar� i�lemler i�in haz�rlan�yor.';
//--- perform_rebuild
$lang['Click_or_wait_to_proceed'] = 'Ge�erli i�leme bir miktar vakit daha vermek i�in t�klay�n�z.';
//---[+]------------------------------------ eksik terc�me------------
$lang['Indexing_progress'] = '%d mesaj�n (%d mesajlardan (%01.1f%%)) mesaj) arama kelime listesi yeniden olu�turulmu�tur. ��lemin kald��� son mesaj: %d.';
//---[-]------------------------------------ eksik terc�me------------
$lang['Indexing_finished'] = 'Arama tablolar�n� yeniden olu�turma i�lemi tamamlanm��t�r.';
//--- synchronize_user
$lang['Synchronize_post_counters'] = 'Mesaj say�lar� uyumlu hale getiriliyor.';
$lang['Synchronize_user_post_counter'] = '�ye mesaj say�lar� uyumlu hale getiriliyor.';
$lang['Synchronizing_user_counter'] = '�yeler g�ncelle�tiriliyor %s (%d): %d -&gt; %d';
//--- synchronize_mod_state
$lang['Synchronize_moderators'] = 'B�l�m yetkilileri �ye tablosundan uyumlu hale getiriliyor.';
$lang['Getting_moderators'] = 'B�l�m yetkilileri bilgileri getiriliyor.';
$lang['Checking_non_moderators'] = 'B�l�m yetkilisi olan, forum bilgilerinde b�l�m yetkilisi olarak g�r�nmeyen �yeler taran�yor.';
$lang['Updating_mod_state'] = '�yelerin, b�l�m yetkilisi durumlar� g�ncelleniyor.';
$lang['Changing_moderator_status'] = '�yelerin, b�l�m yetkilisi durumlar� �ye olarak de�i�tiriliyor. %s (%d)';
$lang['Checking_moderators'] = 'B�l�m Yetkilisi olmayan, forum bilgilerinde b�l�m yetkilisi olarak g�r�nen �yeler taran�yor.';
//--- tarihler yenileniyor
$lang['Resetting_future_post_dates'] = 'Son mesaj tarihleri g�ncelleniyor.';
$lang['Checking_post_dates'] = 'Mesaj tarihleri taran�yor.';
$lang['Checking_pm_dates'] = '�zel mesaj tarihleri taran�yor.';
$lang['Checking_email_dates'] = 'Son e-posta tarihleri taran�yor.';
//--- oturumlar yenileniyor
$lang['Resetting_sessions'] = 'Oturumlar yenileniyor.';
$lang['Deleting_session_tables'] = 'Oturum ve arama sonu� tablolar� bo�alt�l�yor.';
$lang['Restoring_session'] = 'Aktif kullan�c�lar�n oturumlar� yenileniyor.';
//--- Veritaban� bilgileri taran�yor
$lang['Checking_db'] = 'Veritaban� kontrol ediliyor.';
$lang['Checking_tables'] = 'Tablolar kontrol ediliyor.';
$lang['Table_OK'] = 'tamam';
$lang['Table_HEAP_info'] = 'HEAP tablo yap�s� i�in bu komut kullan�lam�yor.';
//--- Veritaban� tamir ediliyor
$lang['Repairing_db'] = 'Veritaban� tamir ediliyor.';
$lang['Repairing_tables'] = 'Tablolar tamir ediliyor.';
//--- Veritaban� ��pten ay�rlan�yor
$lang['Optimizing_db'] = 'Veritaban� ��pten ay�klan�yor.';
$lang['Optimizing_tables'] = 'Tablolar ��pten ay�klan�yor.';
$lang['Optimization_statistic'] = 'Forum tablolar�n b�y�kl��� %s seviyesinden %s seviyesine d���r�ld�. Bu ise %s d�zeyinde %01.2f%% oran�nda bir iyile�tirme demektir.';
//--- otomatik artan de�erler yenileniyor
$lang['Reset_ai'] = 'Otomatik artan de�erler s�f�rlan�yor.';
$lang['Ai_message_update_table'] = 'Tablo g�ncellendi.';
$lang['Ai_message_no_update'] = 'Ge�erli de�erler g�ncellenemiyor.';
$lang['Ai_message_update_table_old_mysql'] = 'Tablo g�ncellendi.';
//--- heap yap�s�na d�n��t�r
$lang['Converting_heap'] = 'Oturum tablosu MyIsam tablo yap�s�ndan HEAP tablo yap�s�na d�n��t�r�l�yor.';
//--- Veritaban� kilidini a�
$lang['Unlocking_db'] = 'Veritaban� kilidi a��l�yor.';

//************************** AC�L BAKIM ARACI ****************************
$lang['Forum_Home'] = 'Forum Ana Sayfa';
$lang['ERC'] = 'Acil Bak�m Arac�';
$lang['Submit_text'] = 'G�nder';
$lang['Select_Language'] = 'Bir dil se�iniz';
$lang['No_selectable_language'] = 'Se�ilebilir bir dil bulunamad�';
$lang['Select_Option'] = 'Se�enekler';
$lang['Option_Help'] = 'A��klamalar';
$lang['Authenticate_methods'] = 'Bu i�lem i�in iki se�ene�iniz var';
$lang['Authenticate_methods_help_text'] = 'E�er forunuzla ilgili bir de�i�iklik yapacaksan�z, bunu iki �ekilde yapabilirsiniz. Birinci se�enek, �u an aktif bir forum y�neticisi ve parolas�yla giri� yaparak yapman�z. (Genelde tercih edilen y�ntem.) �kinci se�enek ise forum ayarlar�n�n �zerine bina edilmi� oldu�u veritaban� �yeli�i ve veritaban� �ifresi ile yapman�z. Tercih sizin.';
$lang['Authenticate_user_only'] = 'Bu i�lem i�in tek i�lem yolu g�r�nmektedir';
$lang['Authenticate_user_only_help_text'] = 'Bu i�lem i�in, forum y�netisi olman�z gerekmektedir. Bu i�lemi ancak, forum y�neticisi yetkilerine sahip bir �ye ad� ve parolas�yla yapabilirsiniz.';
$lang['Admin_Account'] = 'Forum �yeli�i';
$lang['Database_Login'] = 'Veritaban� kullan�c�s�';
$lang['Username'] = 'Kullan�c�';
$lang['Password'] = '�ifre';
$lang['Auth_failed'] = '<b>Yetkisiz i�lem denemesi!</b>';
$lang['Return_ERC'] = 'Acil bak�m arac�na geri d�n';
$lang['cur_setting'] = 'Ge�erli ayarlar';
$lang['rec_setting'] = 'Uygulanacak ayarlar';
$lang['secure'] = 'G�venlik';
$lang['secure_yes'] = 'Evet (https)';
$lang['secure_no'] = 'Hay�r (http)';
$lang['domain'] = 'Alan ad�';
$lang['port'] = 'Port';
$lang['path'] = 'Forum yolu';
$lang['Cookie_domain'] = '�erez alan ad�';
$lang['Cookie_name'] = '�erez ad�';
$lang['Cookie_path'] = '�erez yolu';
$lang['select_language'] = 'Bir dil se�iniz';
$lang['select_theme'] = 'Bir tema se�iniz';
$lang['reset_thmeme'] = 'Standart temay� yeniden olu�tur';
$lang['new_admin_user'] = '�yeyi, forum y�neticisi tayin et';
$lang['dbms'] = 'Veritaban� tipi';
$lang['DB_Host'] = 'Sunucu ad� / DSN';
$lang['DB_Name'] = 'Veritaban� ad�';
$lang['DB_Username'] = 'Veritaban� kullan�c�s�';
$lang['DB_Password'] = 'Veritaban� �ifresi';
$lang['Table_Prefix'] = 'Veritaban� i�in tablo �n eki';
$lang['New_config_php'] = 'Yeni Config.'.@$phpEx .' dosyan�z haz�r';

// se�enekler
$lang['cls'] = 'Oturumlar� temizle';
$lang['rdb'] = 'Forum tablolar�n� tamir et';
$lang['cct'] = 'Ayarlar tablosunu kontrol et';
$lang['rpd'] = 'Yol bilgilerini yenile';
$lang['rcd'] = '�erez bilgilerini yenile';
$lang['rld'] = 'Dil bilgilerini yenile';
$lang['rtd'] = 'Tema bilgilerini yenile';
$lang['dgc'] = 'GZip fonksiyonunu kapat';
$lang['cbl'] = 'Yasakl�lar tablosunu temizle';
$lang['raa'] = 'B�t�n forum y�neticilerini sil';
$lang['mua'] = 'Forum y�neticisi belirle';
$lang['rcp'] = 'Config.'.@$phpEx.' dosyas�n� yenile';

// se�eneklere dair bilgi mesajlar�
$lang['cls_info'] = '��lem s�ras�nda, b�t�n oturum bilgileri temizlenecektir.';
$lang['rdb_info'] = 'i�lem s�ras�nda, b�t�n forum tablolar� tamir edilecektir.(Not: Bu i�lemi bir ka� kere tekrar etmeniz tavsiye edilir.)';
$lang['cct_info'] = '��lem s�ras�nda ayarlar tablosu hatalara kar�� taranacak ve uygun �ekilde tamir edilecektir.';
$lang['rpd_info'] = 'i�lem s�ras�nda, uygulanacak ayarlar listesinden <b>se�tikleriniz</b> g�ncelle�tirilecektir.';
$lang['rcd_info'] = '��lem s�ras�nda �erez bilgileri g�ncelle�tirilecektir. E�er girece�iniz verinin g�venli�inden emin de�ilseniz, forum kurulumu s�ras�nda gelen genel �erez ayarlar�n� kurunuz.';
$lang['rld_info'] = '��lem s�ras�nda, se�ilen dil hem mesaj panosu ayarlar� hem de �ye ayarlar� i�in sabit olarak ayarlanacakt�r';
$lang['rtd_info'] = '��lem s�ras�nda se�ilen tema b�t�n kullan�c�lar ve mesaj panosu i�in varsay�lan tema olarak ayarlanacakt�r veya standart tema yeniden �retilecek ve t�m forum kullan�c�lar� i�in ge�erli tema olarak ayarlanacakt�r.';
$lang['rtd_info_no_theme'] = '��lem s�ras�nda standart tema yeniden �retilecek ve t�m forum kullan�c�lar� i�in ge�erli tema olarak ayarlanacakt�r.';
$lang['dgc_info'] = '��lem s�ras�nda, GZip s�k��t�rma kapat�lacakt�r.';
$lang['cbl_info'] = '��lem s�ras�nda, yasakl� �yeler listesi temizlenecek ve pasif �yelikler aktif edilecektir.';
$lang['raa_info'] = '��lem s�ras�nda, b�t�n forum y�neticileri normal kullan�c� olarak ayarlanacakt�r. ��lem i�in forum �yeli�i y�ntemini se�mi�seniz se�ilen �ye forum y�neticili�ini devam ettirecektir.';
$lang['mua_info'] = '��lem s�ras�nda, se�ilen �ye forum y�neticisi olarak se�ilecek ve yetkileriyle beraber aktif edilecektir.';
$lang['rcp_info'] = '��lem s�ras�nda, yeni Config.'.@$phpEX.' dosyan�z girdi�iniz bilgilere uygun olarak yeniden �retilecektir.';

// se�enekler i�in i�lem ger�ekle�tiriliyor mesajlar�
$lang['cls_success'] = 'B�t�n oturumlar ba�ar�yla temizlendi.';
$lang['rdb_success'] = 'Forum tablolar� tamir edilmi�tir.';
$lang['rpd_success'] = 'Forum ayarlar�n�z g�ncelle�tirilmi�tir.';
$lang['cct_success'] = 'Ayar tablosu kontrol� tamamlanm��t�r.';
$lang['rcd_success'] = '�erez bilgileri g�ncelle�tirme i�lemi tamamlanm��t�r.';
$lang['rld_success'] = 'Dil bilgileri g�ncelle�tirme i�lemi tamamlanm��t�r.';
$lang['rld_failed'] = 'Se�ilen dil i�in gerekli olan dil dosyalar� (<b>lang_main.'.@$phpEx.'</b> ve <b>lang_admin.'.@$phpEx.'</b>) bulunam�yor. L�tfen kontrol ediniz.';
$lang['rtd_restore_success'] = 'Standart tema tamir i�lemi tamamlanm��t�r.';
$lang['rtd_success'] = 'Tema g�ncelle�tirme i�lemi tamamlanm��t�r.';
$lang['dgc_success'] = 'GZip fonksiyonu kapatma i�lemi tamamlanm��t�r.';
$lang['cbl_success'] = 'Yasakl� isimleri temizleme ve kapal� �yelikleri aktif etme i�lemi tamamlanm��t�r.';
$lang['cbl_success_anonymous'] = 'Yasakl� isimleri temizleme ve kapal� �yelikleri aktif etme i�lemi tamamlanm��t�r. Anonim �yelik yeniden olu�turulmu�tur. Anonim kullan�c� hesab� bir gruba dahil edildi�i i�in b�yle bir hatay� al�yor olabilirsiniz. &quot;�ye ve Grup tablolar�n� veritaban� bak�m arac�ndaki ilgili fonksiyonlarla kontrol ediniz.';
$lang['raa_success'] = 'B�t�n forum y�neticileri silinmi�tir.';
$lang['mua_success'] = 'Se�ilen �ye forum y�neticisi olarak ayarlanm��t�r.';
$lang['mua_failed'] = '<font color=\'red\'><b>Hata:</b> Se�ilen �ye zaten Forum y�neticisi olarak g�r�nmektedir.</font> ';
$lang['rcp_success'] = 'Config.'.@$phpEx.' dosyan�z� bilgisayar�n�za kaydetmek i�in %sburaya%s t�klay�n�z. Daha sonra bu dosyay� forumunuzun ana dizinine /root dizinine y�kleyiniz. Dosyay� y�klemeden �nce mutlaka b�t�n kodlar�n <b>&lt;?php</b> ve <b>?&gt;</b> aral��� i�inde oldu�unu ve yabanc� kod i�ermedi�ini do�rulay�n�z. ';

// i�lem ger�ekle�tiriliyor mesaj�
$lang['Removing_admins'] = 'Forum y�neticileri siliniyor';

// yard�m metni
$lang['Option_Help_Text'] = '
<p>E�er oturumlar ile ilgili bir hata ald�ysan�z, oturum tablosunu temizlemek i�in <b>Oturumlar� Temizle</b> se�ene�ini t�klay�n�z.
<p>Forum tablolar�yla ilgili bir hata ald�ysan�z, tablolar� tamir etmek i�in <b>Forum tablolar�n� tamir et</b> se�ene�ini t�klay�n�z.
<p><b>Ayar tablosunu kontrol et</b> eksik giri�ler i�in ayarlar tablosunu kontrol eder. Bir �ok hata t�r�ne kar�� yard�mc� olacak bir i�lemdir.
<p>Y�netim paneline ba�lanam�yorsan�z forumun yol bilgilerinde ya da �erez ayarlar�nda bir hata olabilir
<b>Yol bilgilerini yenile</b> se�ene�i veya <b>�erez bilgilerini yenile</b> se�ene�i size yard�mc� olabilir.
<p>Dil bilgilerini yenilemek i�in <b>Dil bilgilerini yenile</b> se�ene�ini, tema bilgilerini yenilemek i�in <b>Tema bilgilerini yenile</b> se�ene�ini t�klay�n�z.

<p>E�er probleminiz Gzip fonksiyonunu aktif ettikten sonra olu�tuysa, Gzip fonksiyonunu kapatmak i�in <b>Gzip fonksiyonunu kapat</b> se�ene�ini deneyiniz.</p>
<p>E�er, �ye hesab�n�z�n parolas�n� kaybettiyseniz, se�ti�iniz bir kullan�c�y� forum y�neticisi olarak ayarlamak i�in <b>Forum y�neticisi belirle</b> se�ene�ini kullan�n�z.
Bir kullan�c� kaydettikten sonra bu se�ene�i kullanabilirsiniz. E�er yeni bir kullan�c� kaydedemezseniz problemin kayna�� bir yasak olabilir, yasak tablosunu temizlemek i�in <b>Yasakl�lar listesini temizle</b> se�ene�ini deneyiniz.
<p>E�er forumuzun bir hack i�lemine u�rad�ysa b�t�n forum y�neticilerini silmek i�in <b>Forum y�neticilerini sil</b> se�ene�ini se�iniz. <b>Forum �yelikleri silinmeyecektir, sadece y�netici haklar� ellerinden al�nacakt�r.</b></p>
<p>E�er Config.'.@$phpEx.' dosyas�n� yeniden olu�turmak istiyorsan�z <b>Config.'.@$phpEx.' dosyas�n� yenile</b> se�ene�ini t�klay�n�z.';
//acil bak�m arac� sonu

?>