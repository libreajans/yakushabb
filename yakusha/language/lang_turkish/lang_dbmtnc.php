<?php
// --------------------------------------------------------------
// DOSYA ADI : lang_dbmtnc.php
// Tercüme: sabri ünal / http://www.yakusha.net
// versiyon: 1.0.2 - 04-01-2007
// TELÝF HAKKI : © 2000, 2005 Canver Networks [ phpBB Türkiye ]
// WWW : http://www.phpbbturkiye.com / http:www.canver.net
// --------------------------------------------------------------
if ( !defined('IN_PHPBB') )
{
	die('Hacking attempt');
}

//yakushaya özgü deðerler ++++
$lang['Yakusha_versiyon'] = 'Yakusha Premod Version';
//yakushaya özgü deðerler ----

//kurulum bilgileri
$lang['DB_Maintenance'] = 'Veritabaný bakým';
$lang['DB_Maintenance_Description'] = 'Buradan veritabanýnýzý hatalara ve tutarsýzlýklara karþý denetleyebilirsiniz.<br /> <b>Uyarý:</b> Bazý iþlemler uzun süre alabilir. Bu iþlemler sýrasýnda forum <b>kilitli</b> durumda olacaktýr.</br /><br /><b>Listedeki fonksiyonlarý kullanmadan önce Veritabanýnýzýn yedeðini almanýz <b>tavsiye</b> edilir!</b>';
$lang['Function'] = 'Fonksiyon.';
$lang['Function_Description'] = 'Açýklama.';
$lang['Incomplete_configuration'] = 'Forum ayarlarýnýzdan <b>%s</b> bulunamamýþtýr. Veritabaný bakým aracý bu ayarlar olmadan çalýþamaz.<br /> Kurulum sýrasýnda yapmanýz gereken SQL girdilerini eklemeyi unutmuþ olabilirsiniz.';
$lang['dbtype_not_supported'] = 'Üzgünüz, bu fonksiyon Veritabanýnýzca desteklenmiyor.';
$lang['no_function_specified'] = 'Hiçbir fonksiyon seçilmedi.';
$lang['function_unknown'] = 'Seçilen fonksiyon geçersiz.';
$lang['Old_MySQL_Version'] = 'Üzgünüz. MySQL versiyonunuz bu fonksiyon ile uyumlu deðil. Lütfen MySQL 3.23.17 ve daha yeni versiyonlarý kullanýn.';
$lang['Back_to_DB_Maintenance'] = 'Veritabaný bakýmýna geri dön.';
$lang['Processing_time'] = 'Veritabaný bakým, bu iþlemi %f saniye içinde tamamlamýþtýr.';
$lang['Lock_db'] = 'Forum kilitleniyor.';
$lang['Unlock_db'] = 'Forum kilidi açýlýyor.';
$lang['Already_locked'] = 'Forum kilitlendi.';
$lang['Ignore_unlock_command'] = '<font color=\'red\'>Forum, bu komutla kilitlenmiþtir, fakat forum kilidi açýlamamýþtýr. Forum kilidini açýnýz.</font>';
$lang['Delay_info'] = 'Bu iþlem üç saniye kadar sürebilir.';
$lang['Affected_row'] = '1 Veritabaný deðeri etkilendi.';
$lang['Affected_rows'] = '%d veritabaný deðeri etkilendi.';
$lang['Done'] = 'Ýþlem Tamamlandý.';

//iþlemler sýrasýnda iþlemler gerçekleþtiriliyor yazýsýnýn çýkmasýný istemiyorsanýz boþ býrakýnýz veya // ile kapatýnýz.
$lang['Nothing_to_do'] = '<p class=\'gen\'><i>Ýþlem gerçekleþtiriliyor :-)</i></p>';

//
// kurtarýlmýþ deðerler için standart baþlýklar
$lang['New_cat_name'] = 'Kurtarýlmýþ forumlar';
$lang['New_forum_name'] = 'Kurtarýlmýþ baþlýklar';
$lang['New_topic_name'] = 'Kurtarýlmýþ yazýlar';
$lang['Restored_topic_name'] = 'Kurtarýlmýþ baþlýk';
$lang['New_poster_name'] = 'Kurtarýlmýþ yazý';


// Fonksiyonun mevcut iþleyiþi
//
// Dahili Ýsmi: Deðerleri tercüme edilmiyor, çünkü fonksiyonlar bu deðerleri kulanýyor, dokunmayýn yani :)
// Kullanýmý: $mtnc[] = array(dahili adý, fonksiyon adý, fonksiyon açýklamasý, fonksiyon uyarý mesajý (uyarý mesajý çýkmasýn istiyorsanýz boþ býrakýn).
// Kontrol fonsiyonun deðeri (sayý olarak giriniz))

// liste içinde satýr aralýklarý oluþturmak için aþaðýdaki boþ fonksiyon deðerini kullanýnýz.
// $mtnc[] = array('--', '', '', '', 0)


/*$mtnc[] = array('statistic',
'Ýstatistikler.',
'Forumunuza ve Veritabanýnýza dair bilgiler gösterir.',
'',
0);
$mtnc[] = array('config',
'Ayarlar.',
'Veritabaný bakým aracýný yapýlandýrmanýza imkan tanýr.',
'',
5);
*/

$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_user',
'Üye ve Grup tablolarýný tara.',
'Üye ve Grup tablolarýný hatalara karþý kapsamlý olarak tarar ve üyeleri kendi kiþisel gruplarýna yeniden ekler.',
'Bu iþlem sonunda, üyesi olmayan kullanýcý gruplarýný kaybedeceksiniz. Ýlerleyelim mi?',
0);
$mtnc[] = array('check_post',
'Mesaj ve baþlýk tablolarýný tara.',
'Mesaj ve baþlýk tablolarýný hatalara karþý tarar.',
'Bu iþlem sonunda, metin deðerleri bulunamayan tüm mesajlarý kaybedeceksiniz. Ýlerleyelim mi?',
0);
$mtnc[] = array('check_vote',
'Anket tablosunu tara.',
'Anket tablosunu hatalara karþý tarar.',
'Bu iþlem sonunda, geçerli bir ankete sahip olmayan oylarý kaybedeceksiniz. Ýlerleyelim mi?',
0);
$mtnc[] = array('check_pm',
'Özel Mesaj tablosunu tara.',
'Özel Mesaj tablosunu hatalara karþý tarar.',
'Okunmamýþ mesajlar, gönderen üye veya alýcý üye varolmadýðýnda silinecektir. Ýlerleyelim mi?',
0);
$mtnc[] = array('check_config',
'Ayarlar tablosunu tara.',
'Bu iþlem, eksik giriþlere karþý ayarlar tablosunu tarar.',
'',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('check_search_wordmatch',
'Sözcük kayýt defterini tara.',
'Hatalara karþý sözcük kayýt defterini tarar. Bu defter, forum arama fonksiyonu tarafýndan kullanýlmaktadýr.',
'',
0);
$mtnc[] = array('check_search_wordlist',
'Sözcük kayýt listesini tara.',
'Sözcük kayýt listesini tarar ve tüm gereksiz kelime listelerini siler.',
'Bu iþlem biraz vakit alabilir. Bu iþlemi yapmak gerekli deðildir, fakat yaparsanýz veritabaný büyüklüðünü bir parça azaltacaktýr. Ýlerleyelim mi?',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('synchronize_post',
'Forum ve baþlýklarý uyumlu hale getir.',
'Forumlara ve Baþlýklara ait mesaj sayýlarýný ve mesaj bilgilerini uyumlu hale getirir.',
'Bu iþlemin tamamlanmasý uzun süre almaktadýr. Eðer sunucunuz set_time_limit() PHP fonksiyonunu kullanmanýza izin vermiyorsa bu iþlem yarýdakalabilir veya hiç gerçekleþtirilemeyebilir. Bu durumda bir bilgi kaybýnýz olmayacaktýr fakat kimi bilgiler güncellenemeyecektir. Ýlerleyelim mi?',
0);
$mtnc[] = array('synchronize_user',
'Üye mesaj sayýlarýný uyumlu hale getir.',
'Bu iþlem, üye mesaj sayýlarýný uyumlu hale getirir.',
'<b>Uyarý:</b> Normalde üye mesajlarý silinirken mesaj sayýlarý deðiþtirilmez. Bu iþlem sýrasýnda, üye mesaj sayýlarý varolan mesaj sayýlarýyla deðiþtirilecektir ve bu iþlemden geri dönüþ mümkün deðildir. Ýlerleyelim mi?',
6);
$mtnc[] = array('synchronize_mod_state',
'Bölüm yetkilisi bilgilerini uyumlu hale getir.',
'Üye tablosundaki verileri kullanarak, bölüm yetkilisi bilgilerini uyumlu hale getirir.',
'',
0);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_date',
'Son mesaj saatini yenile.',
'Bu iþlem, son mesaj saatini yeniden ayarlamaya yarar. Son mesaj saati, baþlýða mesaj yazýlmak istendiðinde kontrol edilmek üzere forum tablolarda saklanmaktadýr.',
'Eðer mesajlarýnýzdan herhangi birisi henüz gelmemiþ bir zamaný gösteriyorsa, geçerli saat ile deðiþtirilecektir. Ýlerleyelim mi?',
0);
$mtnc[] = array('reset_sessions',
'Oturum tablosunu boþalt.',
'Bu iþlem, oturum tablosunu boþaltarak, oturum tablosunu yeniden düzenler.',
'Bütün aktif üyeler oturum bilgilerini ve arama sonuçlarýný kaybedeceklerdir. Ýlerleyelim mi?',
0);

 /*
$mtnc[] = array('--', '', '', '', 8);
$mtnc[] = array('rebuild_search_index',
'Arama tablolarýný yeniden oluþtur.',
'Arama tablolarý için bir kelime fihristi oluþturur. Normal þartlar altýnda bu fonksiyona ihtiyaç duymazsýnýz.',
'Arama tablolarýný tamamen silip yeniden oluþturacaktýr. Bu iþlemi, forumunuzun büyüklüðü oranýyla orantýlý olarak saatler bile sürebilir. Bu iþlem süresince forumunuz eriþilebilir olmayacaktýr. Ýlerleyelim mi?',
7);
$mtnc[] = array('proceed_rebuilding',
'Arama tablosu oluþturmayý yeniden baþlat.',
'Arama tablosu oluþturma iþleminiz yarýda kesildiyse bu fonksiyonu kullanýn.',
'',
4);
*/

$mtnc[] = array('--', '', '', '', 1);
$mtnc[] = array('check_db',
'Veritabaný hatalarýný tara.',
'Hatalara karþý veritabaný tablolarýný tarar',
'',
1);
$mtnc[] = array('optimize_db',
'Veritabaný bilgilerini çöpten ayýkla',
'Veritabaný bilgilerini çöpten ayýkla. Bu iþlem, gereksiz tablo bilgilerini silerek forum tablolarýnýzý hafifletecektir. ',
'',
1);
$mtnc[] = array('repair_db',
'Veritabaný hatalarýný tamir et.',
'Veritabaný tablolarýnda hata bulunduðunda hatalarý tamir edecektir.',
'Bu iþlemi, sadece veritabaný tablolarý taranýrken bir hata rapor edilirse kullanmalýsýnýz. Ýlerleyelim mi?',
1);


$mtnc[] = array('--', '', '', '', 0);
$mtnc[] = array('reset_auto_increment',
'Otomatik artan deðerleri sýfýrla',
'Bu iþlem, otomatik artan deðerleri sýfýrlar. Bu islem sadece, tablolara yeni veri kaydederken bir hata olursa kullanýlmalýdýr',
'Otomatik artan deðerleri sýfýrlamak istediðinizden emin misiniz? Hiç bir veri kaybý olmayacaktýr fakat bu fonksiyonu sadece ihtiyaç halinde kullanmanýz gerekmektedir',
0);
$mtnc[] = array('heap_convert',
'Oturum tablosunu dönüþtür',
'Bu iþlem, oturum tablonuzu HEAP tablo yapýsýna çevirir. HEAP tablo yapýsý MySQl normal tablo yapýsý olan MyISAM tablo yapýsýndan daha hýzlý bir tablo yapýsýdýr. Eðer bu seçeneði kullanýrsanýz, phpBB forumunuzu bir parça hýzlandýrmanýz mümkündür.',
'Oturum tablosunu MyISAM tablo yapýsýndan HEAP tablo yapýsýna çevirmek istediðinize emin misiniz?',
2);
$mtnc[] = array('--', '', '', '', 3);
$mtnc[] = array('unlock_db',
'Forum kilinidi aç',
'Bu fonksiyonu kullanmadan önce bir iþlem sýrasýnda bir hata yaptýrdýysanýz forum hala kilitlidir',
'',
3);

//
// fonksiyonlar için özel deðerler.
//

//************************** istatistikler ****************************
$lang['Statistic_title'] = 'Forum ve veritabaný istatistikleri';
$lang['Database_table_info'] = 'Veritabaný istatistikleri iki tür deðer taþýmaktadýr.<br /> Birinci deðer standart phpBB ayarlarýyla gelen tablo deðerleridir ki \'phpBB ana tablolarý\' baþlýðý altýnda listelenmektedir. Ýkinci deðer ise \'phpBB geliþmiþ tablolarý\' baþlýðý altýnda listelenmekte olan geliþmiþ tablo deðerleridir. Bu deðerlere, eklenmiþ modlar ile gelen phpBB tablolarý da dahildir.';
$lang['Board_statistic'] = 'Forum istatistikleri';
$lang['Database_statistic'] = 'Veritabaný istatistikleri';
$lang['Version_info'] = 'Versiyon bilgisi';
$lang['Thereof_deactivated_users'] = 'Aktif olmayan üye sayýsý';
$lang['Thereof_Moderators'] = 'Bölüm yetkilisi sayýsý';
$lang['Thereof_Administrators'] = 'Forum yöneticisi sayýsý';
$lang['Users_with_Admin_Privileges'] = 'Forum yöneticisi yetkisine sahip üyeler';
$lang['Number_tables'] = 'Tablo sayýsý';
$lang['Number_records'] = 'Kayýt sayýsý';
$lang['DB_size'] = 'Veritabaný büyüklüðü';
$lang['Thereof_phpbb_core'] = 'phpBB ana tablolarýnda';
$lang['Thereof_phpbb_advanced'] = 'phpBB geliþmiþ tablolarýnda';
$lang['Version_of_board'] = 'phpBB versiyonu';
$lang['Version_of_mod'] = 'Veritabaný bakým aracý versiyonu';
$lang['Version_of_PHP'] = 'PHP versiyonu';
$lang['Version_of_MySQL'] = 'MySQL versiyonu';

//************************** ayarlar ****************************
$lang['Config_title'] = 'Veritabaný bakým aracý ayarlarý';
$lang['Config_info'] = 'Bu seçenekler, veritabaný bakým aracýný kontrol edebilmenize imkan verir. Unutmayýnýz, yanlýþ yapýlmýþ ayarlar, beklenmedik sonuçlara neden olabilir.';
$lang['General_Config'] = 'Genel ayarlar';
$lang['Rebuild_Config'] = 'Arama tablosu, yeniden yapýlandýrma ayarlarý';
$lang['Current_Rebuild_Config'] = 'Arama tablosu, geçerli yeniden yapýlandýrma ayarlarý';
$lang['Rebuild_Settings_Explain'] = 'Bu ayarlar, arama tablolarýný yeniden yapýlandýrýlýrken, veritabaný bakým aracýnýn nasýl davranmasý gerektiðini belirler.';
$lang['Current_Rebuild_Settings_Explain'] = 'Bu ayarlar, veritabaný bakým aracý tarafýndan iþlemler sýrasýnda kullanýlmaktadýr ve yeniden yapýlandýrma iþleminde nerede kalýndýðýný göstermektedir. Normal þartlarda bu deðerler asla deðiþtirilmemelidir.';
$lang['Disallow_postcounter'] = 'Üye mesaj sayýsýný uyumlu hale getirmeyi kapat.';
$lang['Disallow_postcounter_Explain'] = 'Fonksiyonlarýn üye mesaj sayýlarýný yeniden düzenlemelirini durdurabilirsiniz. Eðer fonksiyonlarýn üye mesaj sayýlarýný uyumlu hale getirmesini durdurursanýz, üyeleler yine eski mesaj deðerleri üzerinden iþlem görürler.';
$lang['Disallow_rebuild'] = 'Arama tablosunu yeniden yapýlandýrmayý kapat.';
$lang['Disallow_rebuild_Explain'] = 'Bu seçenek, arama tablolarýnýn yeninen yapýlandýrma iþlemini kapatacaktýr. Fakat yarýda kesilmiþ iþlemler için yeniden yapýlandýrma fonksiyonu yine de kullanýlýr olacaktýr.';
$lang['Rebuildcfg_Timelimit'] = 'Yeniden inþa iþlemi için maksimum iþlem süresi (saniye cinsinden)';
$lang['Rebuildcfg_Timelimit_Explain'] = 'Yeniden inþa iþlemi için maksimum iþlem süresini belirler. (Normalde 240 saniye). Bu deðeri kendi tercihinize göre daha uzun bir süre olarak da belirleyebilirsiniz.';
$lang['Rebuildcfg_Timeoverwrite'] = 'Yeniden inþa iþlemine, iþlemi bitirmesi için verilecek fazladan süre. (saniye cinsinden).';
$lang['Rebuildcfg_Timeoverwrite_Explain'] = 'Yeniden inþa iþlemine, iþlemi tamamlayabilmesi için fazladan süre tanýr. (Normalde 0 saniye). Eðer, sýfýr (0) girilirse, iþlem normal inþa süresi üzerinden hesaplanacaktýr ve hesap edilen diðer süreler de hesaplanan iþlem süresi üzerine eklenecektir.';
$lang['Rebuildcfg_Maxmemory'] = 'Yeniden inþa iþlemi için maksimum mesaj büyüklüðü. (kByte cinsinden).';
$lang['Rebuildcfg_Maxmemory_Explain'] = 'Yeniden inþa iþleminin, tek seferde yeniden inþa edeceði en yüksek mesaj büyüklüðü. (Normalde 500). Ýþlem sýrasýnda bu deðere ulaþýlýrsa, iþlem kaldýðý yerden bir sonraki aþamada devam eder.';
$lang['Rebuildcfg_Minposts'] = 'Her aþamada, yeniden inþa edilecek en az mesaj sayýsý.';
$lang['Rebuildcfg_Minposts_Explain'] = 'Her aþamada, yeniden inþa edilecek en az mesaj sayýsý. (Normalde 3). Her aþamada, en az kaç mesajýn yeniden inþa adilmesi gerektiðini belirleyiniz.';
$lang['Rebuildcfg_PHP3Only'] = 'Sadece standard PHP 3 ile uyumlu yeniden inþa özelliðini kullan.';
$lang['Rebuildcfg_PHP3Only_Explain'] = 'Veritabaný bakým aracý yeniden inþa özelliðinin geliþmiþ versiyonu olan PHP 4.0.5 ve üstü için geçerli olan yeniden inþa özelliðini kullanmaktadýr. Eðer bu seçeneði geçerli kýlarsanýz, veritabaný bakým aracý standart yeniden inþa metodunu kullanarak forumunuzun arama tablolarýný yeniden inþa edecektir.';
$lang['Rebuildcfg_PHP4PPS'] = 'Geliþmiþ inþa özelliði kullanýlýrken, her saniyede yeniden inþa edilecek mesaj sayýsý.';
$lang['Rebuildcfg_PHP4PPS_Explain'] = 'Geliþmiþ inþa özelliði kullanýlýrken, her saniyede yeniden inþa edilecek mesaj sayýsýnýn yaklaþýk deðerini buraya girebilirsiniz. (Normalde 8).';
$lang['Rebuildcfg_PHP3PPS'] = 'Standart yeniden inþa özelliði kullanýlýrken, her saniyede yeniden inþa edilecek mesaj sayýsý.';
$lang['Rebuildcfg_PHP3PPS_Explain'] = 'Standart yeniden inþa özelliði kullanýlýrken, her saniyede yeniden inþa edilecek mesaj sayýsýnýn yaklaþýk deðerini buraya girebilirsiniz. (Normalde 1).';
$lang['Rebuild_Pos'] = 'Yeniden inþa edilmiþ son mesaj';
$lang['Rebuild_Pos_Explain'] = 'Yeniden inþa edilmiþ son mesajýn ID deðeri. Eðer bu deðer -1 ise, yeniden inþa iþlemi tamamlanmýþ demektir.';
$lang['Rebuild_End'] = 'Yeniden inþa edilecek son mesaj';
$lang['Rebuild_End_Explain'] = 'Yeniden inþa sýrasýnda indexlenecek son mesajýn ID deðeri. Eðer bu deðer 0 ise, yeniden yapýlandýrma iþlemi tamamlanmýþ demektir.';

/*
//ingilizcesi
$lang['Rebuild_Pos'] = 'Last post indexed';
$lang['Rebuild_Pos_Explain'] = 'ID of the last successful indexed post. Is -1 when rebuilding has finished.';
$lang['Rebuild_End'] = 'Last post to index';
$lang['Rebuild_End_Explain'] = 'ID of the last post to index. Is 0 when rebuilding has finished.';

//eski türkçeleþtirmesi
$lang['Rebuild_Pos'] = 'Yeniden yapýlandýrma sýrasýnda kalýnan mesaj deðeri.';
$lang['Rebuild_Pos_Explain'] = 'Yeniden yapýlandýrma sýrasýnda kalýnan, mesajýn ID deðeri. Eðer deðer -1 ise, yeniden yapýlandýrma iþlemi tamamlanmýþ demektir.';
$lang['Rebuild_End'] = 'Yeniden yapýlandýrma sýrasýnda yarýda kalýnan mesaj deðeri.';
$lang['Rebuild_End_Explain'] = 'Yeniden yapýlandýrma sýrasýnda yarýda kalýnan mesajýn ID deðeri. Eðer bu deðer 0 
*/
$lang['Dbmtnc_config_updated'] = 'Ayarlar baþarýyla güncelleþtirilmiþtir.';
$lang['Click_return_dbmtnc_config'] = 'Ayarlar menüsüne dönmek için %sburaya%s týklayýnýz.';

//************************** üyeleri tara ****************************
$lang['Checking_user_tables'] = 'Üye ve grup tablolarý taranýyor.';
$lang['Checking_missing_anonymous'] = 'Anonim kullanýcý taranýyor.';
$lang['Anonymous_recreated'] = 'Anonim kullanýcý yeniden üretiliyor.';
//---[+]------------------------------------ garip tercüme------------
$lang['Checking_incorrect_pending_information'] = 'Geçersiz aský bilgileri taranýyor';
$lang['Updating_invalid_pendig_user'] = 'Bir üyeye ait geçersiz aský bilgileri güncelleþtirildi.';
$lang['Updating_invalid_pendig_users'] = '%d üyeye ait geçersiz aský bilgileri güncelleþtirildi';
$lang['Updating_pending_information'] = 'Kiþisel gruplara ait geçersiz aský bilgileri güncelleþtiriliyor.';
//---[-]------------------------------------ garip tercüme------------
$lang['Checking_missing_user_groups'] = 'Çoklu grup kayýtlarýna karþý üye tablolarý taranýyor.';
$lang['Found_multiple_SUG'] = 'Çoklu grup kayýtlarýna sahip üyeler bulundu.';
$lang['Resolving_user_id'] = 'Üyeler gruplarýna yeniden yerleþtiriliyor.';
$lang['Removing_groups'] = 'Gruplar siliniyor.';
$lang['Removing_user_groups'] = 'Üyelerin grup bilgileri siliniyor.';
$lang['Recreating_SUG'] = 'Üyeler için kiþisel üye gruplarý yeniden düzenleniyor.';
$lang['Checking_for_invalid_moderators'] = 'Hatalý grup yöneticileri taranýyor.';
$lang['Updating_Moderator'] = 'Grup yetkilileri yeniden ayarlanýyor.';
$lang['Checking_moderator_membership'] = 'Bölüm yetkilileri için, grup üyelik bilgileri taranýyor.';
$lang['Updating_mod_membership'] = 'Bölüm yetkilileri için, grup üyelik bilgileri güncelleniyor.';
$lang['Moderator_added'] = 'Bölüm yetkilileri bir gruba ekleniyor.';
//---[+]------------------------------------ garip tercüme------------
$lang['Moderator_changed_pending'] = 'Grup yöneticisi aský bilgisi deðiþtirildi.';
//--[-]------------------------------------- garip tercüme------------
$lang['Remove_invalid_user_data'] = 'Geçersiz üye kayýtlarý grup tablosundan siliniyor.';
$lang['Remove_empty_groups'] = 'Boþ gruplar siliniyor.';
$lang['Remove_invalid_group_data'] = 'Geçersiz grup bilgileri grup tablosundan siliniyor.';
$lang['Checking_ranks'] = 'Geçersiz rütbeler taranýyor.';
$lang['Invalid_ranks_found'] = 'Geçersiz rütbelere sahip üyeler taranýyor.';
$lang['Removing_invalid_ranks'] = 'Geçersiz rütbeler siliniyor.';
$lang['Checking_themes'] = 'Geçersiz tema ayarlarý taranýyor.';
$lang['Updating_users_without_style'] = 'Üyeler, tema yok þeklinde güncelleþtiriliyor.';
$lang['Default_theme_invalid'] = '<b>Uyarý:</b> Standart tema geçersiz. Ayarlarýnýzý kontrol ediniz.';
$lang['Updating_themes'] = 'Geçersiz tema bilgisi %d temasýyla deðiþtiriliyor.';
$lang['Checking_theme_names'] = 'Geçersiz tema adý bilgileri taranýyor.';
$lang['Removing_invalid_theme_names'] = 'Geçersiz tema adý bilgileri siliniyor.';
$lang['Checking_languages'] = 'Geçersiz dil dosyalarý taranýyor.';
$lang['Invalid_languages_found'] = 'Geçersiz dil deðerine sahip bir üye bulundu.';
$lang['Default_language_invalid'] = '<b>Uyarý:</b> Standart dil yanlýþ. Lütfen ayarlarýnýz kontrol ediniz.';
$lang['English_language_invalid'] = '<b>Uyarý:</b> Standart dil yanlýþ ve ingilizce (türkçe) dil dosyasý bulunamýyor. <b>lang_english (lang_turkish)</b> -klasörünü kontrol ediniz.';
$lang['Changing_language'] = 'Dil dosyasý \'%s\' den \'%s\' diline deðiþtiriliyor.';
$lang['Remove_invalid_ban_data'] = 'Geçersiz yasaklý üye bilgileri siliniyor.';
$lang['Remove_invalid_session_keys'] = 'Geçersiz oturum anahtarý deðerleri siliniyor.';

//************************** mesajlarý tara ****************************
$lang['Checking_post_tables'] = 'Mesaj ve baþlýk tablolarý kontrol ediliyor.';
$lang['Checking_invalid_forums'] = 'Forumlar, geçersiz katergorilere karþý taranýyor.';
$lang['Invalid_forums_found'] = 'Geçersiz kategoriye sahip forumlar bulundu.';
$lang['Setting_category'] = 'Forumlar \'%s\' kategorisine taþýnýyor.';
$lang['Checking_posts_wo_text'] = 'Metin bilgisine sahip olmayan mesajlar taranýyor.';
$lang['Posts_wo_text_found'] = 'Metin bilgisine sahip olmayan mesajlar bulundu.';
$lang['Deleting_post_wo_text'] = '%d (Baþlýk: %s (%d); Üye: %s (%d)).';
$lang['Deleting_Posts'] = 'Mesaj bilgileri siliniyor.';
$lang['Checking_topics_wo_post'] = 'Mesaj sahibi olmayan baþlýklar taranýyor.';
$lang['Topics_wo_post_found'] = 'Mesaj sahibi olmayan baþlýklar bulundu.';
$lang['Deleting_topics'] = 'Baþlýk bilgileri siliniyor.';
$lang['Checking_invalid_topics'] = 'Baþlýk bilgileri, geçersiz forum bigilerine karþý taranýyor.';
$lang['Invalid_topics_found'] = 'Geçersiz forum bilgilerine sahip baþlýklar bulundu.';
$lang['Setting_forum'] = 'Baþlýklar \'%s\' forumuna týþýnýyor.';
$lang['Checking_invalid_posts'] = 'Mesajlar, geçersiz baþlýk bilgilerine karþý taranýyor.';
$lang['Invalid_posts_found'] = 'Geçersiz baþlýk bilgilerine sahip mesajlar bulundu.';
$lang['Setting_topic'] = '%s mesajlarý \'%s\' baþlýklarýna (%d) \'%s\' forumuna taþýnýyor.';
$lang['Checking_invalid_forums_posts'] = 'Mesajlar, geçersiz forum bilgilerine karþý taranýyor.';
$lang['Invalid_forum_posts_found'] = 'Geçersiz forum bilgilerine sahip mesajlar bulundu.';
$lang['Setting_post_forum'] = '%d: \'%s\' forumundan (%d) \'%s\' forumuna (%d) taþýnýyor';
$lang['Checking_texts_wo_post'] = 'Mesaj bilgisine sahip olmayan mesaj metinleri taranýyor.';
$lang['Invalid_texts_found'] = 'Mesaj bilgisine sahip olmayan mesaj metinleri bulundu.';
$lang['Recreating_post'] = '%d mesajý yeniden oluþturuluyor ve \'%s\' baþlýðýyla \'%s\' forumuna týþýnýyor.<br />Çýkaran: %s';
$lang['Checking_invalid_topic_posters'] = 'Geçersiz gönderici bilgisine sahip baþlýklar taranýyor.';
$lang['Invalid_topic_poster_found'] = 'Geçersiz gönderici bilgisine sahip baþlýklar bulundu.';
$lang['Updating_topic'] = 'Baþlýk güncelleniyor %d (Gönderen: %d -&gt; %d).';
$lang['Checking_invalid_posters'] = 'Geçersiz gönderici bilgisine sahip mesajlar taranýyor.';
$lang['Invalid_poster_found'] = 'Geçersiz gönderici bilgisine sahip mesajlar bulundu.';
$lang['Updating_posts'] = 'Mesajlar güncelleniyor.';
$lang['Checking_moved_topics'] = 'Taþýnmýþ baþlýklar taranýyor.';
$lang['Deleting_invalid_moved_topics'] = 'Geçersiz taþýnmýþ baþlýklar siliniyor.';
$lang['Updating_invalid_moved_topic'] = 'Silinmemiþ bir baþlýða ait, geçersiz taþýnmýþ baþlýk bilgileri güncelleniyor.';
$lang['Updating_invalid_moved_topics'] = 'Silinmemiþ baþlýklara ait, geçersiz taþýnmýþ baþlýk bilgileri %d baþlýklarý için güncelleniyor.';
$lang['Checking_prune_settings'] = 'Geçersiz temizlik bilgileri taranýyor.';
$lang['Removing_invalid_prune_settings'] = 'Geçersiz temizlik bilgileri siliniyor.';
$lang['Updating_invalid_prune_setting'] = 'Bir foruma ait geçersiz temizlik bilgileri güncelleniyor.';
$lang['Updating_invalid_prune_settings'] = '%d forumlarýna ait geçersiz temizlik bilgileri güncelleniyor.';
$lang['Checking_topic_watch_data'] = 'Geçersiz baþlýk izleme bilgileri taranýyor.';
$lang['Checking_auth_access_data'] = 'Geçersiz grup yöneticisi bilgileri taranýyor.';
$lang['Must_synchronize'] = 'Foruma dönmeden önce mesaj tablolarýný uyumlu hale etmeniz gerekmektedir. Ýþlemi gerçekleþtirmek için týklayýnýz.';

//************************** anket bilgilerini tara ****************************
$lang['Checking_vote_tables'] = 'Anket tablosunu tara.';
$lang['Checking_votes_wo_topic'] = 'Uyuþmayan baþlýklar için anketler taranýyor.';
$lang['Votes_wo_topic_found'] = 'Baþlýksýz anketler bulundu.';
$lang['Invalid_vote'] = '%s (%d) - Baþlangýç tarihi: %s - Bitiþi tarihi: %s';
$lang['Deleting_votes'] = 'Anketler siliniyor.';
$lang['Checking_votes_wo_result'] = 'Sonuçsuz oylar taranýyor.';
$lang['Updating_topics_wo_vote'] = 'Anket olarak iþaretlenmiþ, fakat hakkýnda yanlýþ oy bilgileri bulunan baþlýklar güncelleniyor.';
$lang['Updating_topics_w_vote'] = 'Anket olarak iþaretlenmemiþ, fakat hakkýnda oy bulunan baþlýklar güncelleniyor.';
$lang['Invalid_result'] = 'Geçersiz sonuçlar siliniyor: %s (Oylar: %d).';
$lang['Checking_voters_data'] = 'Geçersiz oy kullanan bilgileri taranýyor.';

$lang['Checking_results_wo_vote'] = 'Checking for results without corresponding vote';
$lang['Results_wo_vote_found'] = 'Found results without vote';
$lang['Invalid_result'] = 'Deleting result: %s (Votes: %d)';
$lang['Checking_voters_data'] = 'Checking for invalid voting data';

//--[ + ] --- burasý çok karýþýk
$lang['Votes_wo_result_found'] = 'Sahipsiz oylar bulundu.';
$lang['Checking_topics_vote_data'] = 'Uyuþmayan sonuçlara karþý oy tablolarý taranýyor.';
$lang['Checking_results_wo_vote'] = 'Uyuþmayan sonuçlara karþý anket tablolarý taranýyor';
$lang['Results_wo_vote_found'] = 'Sahipsiz anketler bulundu.';
//--[ - ] --- burasý çok karýþýk


//************************** özel mesajlarý tara ****************************
$lang['Checking_pm_tables'] = 'Özel mesaj tablosu taranýyor.';
$lang['Checking_pms_wo_text'] = 'Metinleri kayýp özel mesajlar taranýyor.';
$lang['Pms_wo_text_found'] = 'Metni kayýp özel mesajlar bulundu.';
$lang['Deleting_pn_wo_text'] = '%d (Konu: %s; Gönderen: %s (%d); Alýcý: %s (%d))';
$lang['Deleting_Pms'] = 'Özel mesaj bilgisi siliniyor.';
$lang['Checking_texts_wo_pm'] = 'Özel mesaj bilgilerine sahip olmayan geçersiz özel mesaj metinleri taranýyor.';
$lang['Deleting_pm_texts'] = 'Geçersiz özel mesaj metinleri siliniyor.';
$lang['Checking_invalid_pm_senders'] = 'Geçersiz gönderici bilgisine sahip özel mesajlar taranýyor.';
$lang['Invalid_pm_senders_found'] = 'Geçersiz gönderici bilgisine sahip özel mesajlar bulundu.';
$lang['Updating_pms'] = 'Özel mesajlar güncelleniyor.';
$lang['Checking_invalid_pm_recipients'] = 'Özel mesajlar, geçersiz alýcý bilgilerine karþý taranýyor.';
$lang['Invalid_pm_recipients_found'] = 'Geçersiz alýcý bilgisine sahip özel mesajlar bulundu.';
$lang['Checking_pm_deleted_users'] = 'Özel mesajlar, silinmiþ göndericilere ve alýcýlara karþý taranýyor.';
$lang['Invalid_pm_users_found'] = 'Silinmiþ gönderici veya alýcý bilgisine sahip özel mesajlar bulundu.';
$lang['Deleting_pms'] = 'Özel mesajlar siliniyor.';
$lang['Synchronize_new_pm_data'] = 'Yeni özel mesaj sayýlarý uyumlu hale getiriliyor.';
$lang['Synchronizing_users'] = 'Kullanýcýlar güncelleniyor.';
$lang['Synchronizing_user'] = 'Kullanýcý günceleniyor %s (%d).';
$lang['Synchronize_unread_pm_data'] = 'Okunmamýþ özel mesaj sayýsý uyumlu hale getiriliyor.';

//************************** mesajlarý uyumlu hale getir ****************************
$lang['Synchronize_posts'] = 'Mesaj bilgileri uyumlu hale getiriliyor.';
$lang['Synchronize_topic_data'] = 'Mesaj baþlýklarý uyumlu hale getiriliyor.';
$lang['Synchronizing_topics'] = 'Baþlýklar güncelleniyor.';
$lang['Synchronizing_topic'] = '%d nolu baþlýk (%s) güncelleniyor.';
$lang['Synchronize_moved_topic_data'] = 'Taþýnmýþ baþlýklar uyumlu hale getiriliyor.';
$lang['Inconsistencies_found'] = 'Veritabanýnýzda tutarsýzlýk bulundu. Lütfen %smesaj ve baþlýk tablolarýný%s kontrol ediniz.';
$lang['Synchronizing_moved_topics'] = 'Taþýnmýþ baþlýklar güncelleniyor.';
$lang['Synchronizing_moved_topic'] = 'Taþýnmýþ baþlýk güncelleniyor %d -&gt; %d (%s).';
$lang['Synchronize_forum_topic_data'] = 'Forumlar için baþlýk bilgileri uyumlu hale getiriliyor.';
$lang['Synchronizing_forums'] = 'Forumlar güncelleniyor.';
$lang['Synchronizing_forum'] = 'Forum %d (%s) güncelleniyor.';
$lang['Synchronize_forum_data_wo_topic'] = 'Baþlýksýz forumlar uyumlu hale getiriliyor.';
$lang['Synchronize_forum_post_data'] = 'Forumlarýn mesaj bilgileri uyumlu hale getiriliyor.';
$lang['Synchronize_forum_data_wo_post'] = 'Mesajsýz forumlar uyumlu hale getiriliyor.';

// küçük lokmalar
//--- ayar tablosunu tara
$lang['Checking_config_table'] = 'Ayar tablosu kontrol ediliyor.';
$lang['Checking_config_entries'] = 'Ayar tablosu deðerleri kontrol ediliyor.';
$lang['Restoring_config'] = 'Kayýtlar tamir ediliyor.';
//--- check_search_wordmatch
$lang['Checking_search_wordmatch_tables'] = 'Sözcük kayýt defteri taranýyor.';
$lang['Checking_search_data'] = 'Geçersiz arama bilgileri taranýyor.';
//--- check_search_wordlist
$lang['Checking_search_wordlist_tables'] = 'Sözcük kayýt listeleri taranýyor.';
$lang['Checking_search_words'] = 'Geçersiz arama kelimeleri taranýyor.';
$lang['Removing_part_invalid_words'] = 'Geçersiz arama kelimeleri parçalarý siliniyor.';
$lang['Removing_invalid_words'] = 'Geçersiz arama kelimeleri siliniyor.';
//--- rebuild_search_index
$lang['Rebuilding_search_index'] = 'Arama tablolarýný yeniden oluþtur.';
$lang['Deleting_search_tables'] = 'Arama tablolarý boþaltýlýyor.';
$lang['Reset_search_autoincrement'] = 'Arama tablolarý sayacý yenileniyor.';
$lang['Preparing_config_data'] = 'Ayar bilgileri düzenleniyor.';
$lang['Can_start_rebuilding'] = 'Artýk arama tablolarýný yeniden oluþturmaya baþlayabilirsiniz.';
$lang['Click_once_warning'] = '<b>Linke yalnýz bir kere basýnýz!</b> - Yeni sayfanýn gösterilmesi biraz vakit alabilir.';
//--- proceed_rebuilding
$lang['Preparing_to_proceed'] = 'Tablolar iþlemler için hazýrlanýyor.';
$lang['Preparing_search_tables'] = 'Arama tablolarý iþlemler için hazýrlanýyor.';
//--- perform_rebuild
$lang['Click_or_wait_to_proceed'] = 'Geçerli iþleme bir miktar vakit daha vermek için týklayýnýz.';
//---[+]------------------------------------ eksik tercüme------------
$lang['Indexing_progress'] = '%d mesajýn (%d mesajlardan (%01.1f%%)) mesaj) arama kelime listesi yeniden oluþturulmuþtur. Ýþlemin kaldýðý son mesaj: %d.';
//---[-]------------------------------------ eksik tercüme------------
$lang['Indexing_finished'] = 'Arama tablolarýný yeniden oluþturma iþlemi tamamlanmýþtýr.';
//--- synchronize_user
$lang['Synchronize_post_counters'] = 'Mesaj sayýlarý uyumlu hale getiriliyor.';
$lang['Synchronize_user_post_counter'] = 'Üye mesaj sayýlarý uyumlu hale getiriliyor.';
$lang['Synchronizing_user_counter'] = 'Üyeler güncelleþtiriliyor %s (%d): %d -&gt; %d';
//--- synchronize_mod_state
$lang['Synchronize_moderators'] = 'Bölüm yetkilileri üye tablosundan uyumlu hale getiriliyor.';
$lang['Getting_moderators'] = 'Bölüm yetkilileri bilgileri getiriliyor.';
$lang['Checking_non_moderators'] = 'Bölüm yetkilisi olan, forum bilgilerinde bölüm yetkilisi olarak görünmeyen üyeler taranýyor.';
$lang['Updating_mod_state'] = 'Üyelerin, bölüm yetkilisi durumlarý güncelleniyor.';
$lang['Changing_moderator_status'] = 'Üyelerin, bölüm yetkilisi durumlarý üye olarak deðiþtiriliyor. %s (%d)';
$lang['Checking_moderators'] = 'Bölüm Yetkilisi olmayan, forum bilgilerinde bölüm yetkilisi olarak görünen üyeler taranýyor.';
//--- tarihler yenileniyor
$lang['Resetting_future_post_dates'] = 'Son mesaj tarihleri güncelleniyor.';
$lang['Checking_post_dates'] = 'Mesaj tarihleri taranýyor.';
$lang['Checking_pm_dates'] = 'Özel mesaj tarihleri taranýyor.';
$lang['Checking_email_dates'] = 'Son e-posta tarihleri taranýyor.';
//--- oturumlar yenileniyor
$lang['Resetting_sessions'] = 'Oturumlar yenileniyor.';
$lang['Deleting_session_tables'] = 'Oturum ve arama sonuç tablolarý boþaltýlýyor.';
$lang['Restoring_session'] = 'Aktif kullanýcýlarýn oturumlarý yenileniyor.';
//--- Veritabaný bilgileri taranýyor
$lang['Checking_db'] = 'Veritabaný kontrol ediliyor.';
$lang['Checking_tables'] = 'Tablolar kontrol ediliyor.';
$lang['Table_OK'] = 'tamam';
$lang['Table_HEAP_info'] = 'HEAP tablo yapýsý için bu komut kullanýlamýyor.';
//--- Veritabaný tamir ediliyor
$lang['Repairing_db'] = 'Veritabaný tamir ediliyor.';
$lang['Repairing_tables'] = 'Tablolar tamir ediliyor.';
//--- Veritabaný çöpten ayýrlanýyor
$lang['Optimizing_db'] = 'Veritabaný çöpten ayýklanýyor.';
$lang['Optimizing_tables'] = 'Tablolar çöpten ayýklanýyor.';
$lang['Optimization_statistic'] = 'Forum tablolarýn büyüklüðü %s seviyesinden %s seviyesine düþürüldü. Bu ise %s düzeyinde %01.2f%% oranýnda bir iyileþtirme demektir.';
//--- otomatik artan deðerler yenileniyor
$lang['Reset_ai'] = 'Otomatik artan deðerler sýfýrlanýyor.';
$lang['Ai_message_update_table'] = 'Tablo güncellendi.';
$lang['Ai_message_no_update'] = 'Geçerli deðerler güncellenemiyor.';
$lang['Ai_message_update_table_old_mysql'] = 'Tablo güncellendi.';
//--- heap yapýsýna dönüþtür
$lang['Converting_heap'] = 'Oturum tablosu MyIsam tablo yapýsýndan HEAP tablo yapýsýna dönüþtürülüyor.';
//--- Veritabaný kilidini aç
$lang['Unlocking_db'] = 'Veritabaný kilidi açýlýyor.';

//************************** ACÝL BAKIM ARACI ****************************
$lang['Forum_Home'] = 'Forum Ana Sayfa';
$lang['ERC'] = 'Acil Bakým Aracý';
$lang['Submit_text'] = 'Gönder';
$lang['Select_Language'] = 'Bir dil seçiniz';
$lang['No_selectable_language'] = 'Seçilebilir bir dil bulunamadý';
$lang['Select_Option'] = 'Seçenekler';
$lang['Option_Help'] = 'Açýklamalar';
$lang['Authenticate_methods'] = 'Bu iþlem için iki seçeneðiniz var';
$lang['Authenticate_methods_help_text'] = 'Eðer forunuzla ilgili bir deðiþiklik yapacaksanýz, bunu iki þekilde yapabilirsiniz. Birinci seçenek, þu an aktif bir forum yöneticisi ve parolasýyla giriþ yaparak yapmanýz. (Genelde tercih edilen yöntem.) Ýkinci seçenek ise forum ayarlarýnýn üzerine bina edilmiþ olduðu veritabaný üyeliði ve veritabaný þifresi ile yapmanýz. Tercih sizin.';
$lang['Authenticate_user_only'] = 'Bu iþlem için tek iþlem yolu görünmektedir';
$lang['Authenticate_user_only_help_text'] = 'Bu iþlem için, forum yönetisi olmanýz gerekmektedir. Bu iþlemi ancak, forum yöneticisi yetkilerine sahip bir üye adý ve parolasýyla yapabilirsiniz.';
$lang['Admin_Account'] = 'Forum Üyeliði';
$lang['Database_Login'] = 'Veritabaný kullanýcýsý';
$lang['Username'] = 'Kullanýcý';
$lang['Password'] = 'Þifre';
$lang['Auth_failed'] = '<b>Yetkisiz iþlem denemesi!</b>';
$lang['Return_ERC'] = 'Acil bakým aracýna geri dön';
$lang['cur_setting'] = 'Geçerli ayarlar';
$lang['rec_setting'] = 'Uygulanacak ayarlar';
$lang['secure'] = 'Güvenlik';
$lang['secure_yes'] = 'Evet (https)';
$lang['secure_no'] = 'Hayýr (http)';
$lang['domain'] = 'Alan adý';
$lang['port'] = 'Port';
$lang['path'] = 'Forum yolu';
$lang['Cookie_domain'] = 'Çerez alan adý';
$lang['Cookie_name'] = 'Çerez adý';
$lang['Cookie_path'] = 'Çerez yolu';
$lang['select_language'] = 'Bir dil seçiniz';
$lang['select_theme'] = 'Bir tema seçiniz';
$lang['reset_thmeme'] = 'Standart temayý yeniden oluþtur';
$lang['new_admin_user'] = 'Üyeyi, forum yöneticisi tayin et';
$lang['dbms'] = 'Veritabaný tipi';
$lang['DB_Host'] = 'Sunucu adý / DSN';
$lang['DB_Name'] = 'Veritabaný adý';
$lang['DB_Username'] = 'Veritabaný kullanýcýsý';
$lang['DB_Password'] = 'Veritabaný þifresi';
$lang['Table_Prefix'] = 'Veritabaný için tablo ön eki';
$lang['New_config_php'] = 'Yeni Config.'.@$phpEx .' dosyanýz hazýr';

// seçenekler
$lang['cls'] = 'Oturumlarý temizle';
$lang['rdb'] = 'Forum tablolarýný tamir et';
$lang['cct'] = 'Ayarlar tablosunu kontrol et';
$lang['rpd'] = 'Yol bilgilerini yenile';
$lang['rcd'] = 'Çerez bilgilerini yenile';
$lang['rld'] = 'Dil bilgilerini yenile';
$lang['rtd'] = 'Tema bilgilerini yenile';
$lang['dgc'] = 'GZip fonksiyonunu kapat';
$lang['cbl'] = 'Yasaklýlar tablosunu temizle';
$lang['raa'] = 'Bütün forum yöneticilerini sil';
$lang['mua'] = 'Forum yöneticisi belirle';
$lang['rcp'] = 'Config.'.@$phpEx.' dosyasýný yenile';

// seçeneklere dair bilgi mesajlarý
$lang['cls_info'] = 'Ýþlem sýrasýnda, bütün oturum bilgileri temizlenecektir.';
$lang['rdb_info'] = 'iþlem sýrasýnda, bütün forum tablolarý tamir edilecektir.(Not: Bu iþlemi bir kaç kere tekrar etmeniz tavsiye edilir.)';
$lang['cct_info'] = 'Ýþlem sýrasýnda ayarlar tablosu hatalara karþý taranacak ve uygun þekilde tamir edilecektir.';
$lang['rpd_info'] = 'iþlem sýrasýnda, uygulanacak ayarlar listesinden <b>seçtikleriniz</b> güncelleþtirilecektir.';
$lang['rcd_info'] = 'Ýþlem sýrasýnda çerez bilgileri güncelleþtirilecektir. Eðer gireceðiniz verinin güvenliðinden emin deðilseniz, forum kurulumu sýrasýnda gelen genel çerez ayarlarýný kurunuz.';
$lang['rld_info'] = 'Ýþlem sýrasýnda, seçilen dil hem mesaj panosu ayarlarý hem de üye ayarlarý için sabit olarak ayarlanacaktýr';
$lang['rtd_info'] = 'Ýþlem sýrasýnda seçilen tema bütün kullanýcýlar ve mesaj panosu için varsayýlan tema olarak ayarlanacaktýr veya standart tema yeniden üretilecek ve tüm forum kullanýcýlarý için geçerli tema olarak ayarlanacaktýr.';
$lang['rtd_info_no_theme'] = 'Ýþlem sýrasýnda standart tema yeniden üretilecek ve tüm forum kullanýcýlarý için geçerli tema olarak ayarlanacaktýr.';
$lang['dgc_info'] = 'Ýþlem sýrasýnda, GZip sýkýþtýrma kapatýlacaktýr.';
$lang['cbl_info'] = 'Ýþlem sýrasýnda, yasaklý üyeler listesi temizlenecek ve pasif üyelikler aktif edilecektir.';
$lang['raa_info'] = 'Ýþlem sýrasýnda, bütün forum yöneticileri normal kullanýcý olarak ayarlanacaktýr. Ýþlem için forum üyeliði yöntemini seçmiþseniz seçilen üye forum yöneticiliðini devam ettirecektir.';
$lang['mua_info'] = 'Ýþlem sýrasýnda, seçilen üye forum yöneticisi olarak seçilecek ve yetkileriyle beraber aktif edilecektir.';
$lang['rcp_info'] = 'Ýþlem sýrasýnda, yeni Config.'.@$phpEX.' dosyanýz girdiðiniz bilgilere uygun olarak yeniden üretilecektir.';

// seçenekler için iþlem gerçekleþtiriliyor mesajlarý
$lang['cls_success'] = 'Bütün oturumlar baþarýyla temizlendi.';
$lang['rdb_success'] = 'Forum tablolarý tamir edilmiþtir.';
$lang['rpd_success'] = 'Forum ayarlarýnýz güncelleþtirilmiþtir.';
$lang['cct_success'] = 'Ayar tablosu kontrolü tamamlanmýþtýr.';
$lang['rcd_success'] = 'Çerez bilgileri güncelleþtirme iþlemi tamamlanmýþtýr.';
$lang['rld_success'] = 'Dil bilgileri güncelleþtirme iþlemi tamamlanmýþtýr.';
$lang['rld_failed'] = 'Seçilen dil için gerekli olan dil dosyalarý (<b>lang_main.'.@$phpEx.'</b> ve <b>lang_admin.'.@$phpEx.'</b>) bulunamýyor. Lütfen kontrol ediniz.';
$lang['rtd_restore_success'] = 'Standart tema tamir iþlemi tamamlanmýþtýr.';
$lang['rtd_success'] = 'Tema güncelleþtirme iþlemi tamamlanmýþtýr.';
$lang['dgc_success'] = 'GZip fonksiyonu kapatma iþlemi tamamlanmýþtýr.';
$lang['cbl_success'] = 'Yasaklý isimleri temizleme ve kapalý üyelikleri aktif etme iþlemi tamamlanmýþtýr.';
$lang['cbl_success_anonymous'] = 'Yasaklý isimleri temizleme ve kapalý üyelikleri aktif etme iþlemi tamamlanmýþtýr. Anonim üyelik yeniden oluþturulmuþtur. Anonim kullanýcý hesabý bir gruba dahil edildiði için böyle bir hatayý alýyor olabilirsiniz. &quot;Üye ve Grup tablolarýný veritabaný bakým aracýndaki ilgili fonksiyonlarla kontrol ediniz.';
$lang['raa_success'] = 'Bütün forum yöneticileri silinmiþtir.';
$lang['mua_success'] = 'Seçilen üye forum yöneticisi olarak ayarlanmýþtýr.';
$lang['mua_failed'] = '<font color=\'red\'><b>Hata:</b> Seçilen üye zaten Forum yöneticisi olarak görünmektedir.</font> ';
$lang['rcp_success'] = 'Config.'.@$phpEx.' dosyanýzý bilgisayarýnýza kaydetmek için %sburaya%s týklayýnýz. Daha sonra bu dosyayý forumunuzun ana dizinine /root dizinine yükleyiniz. Dosyayý yüklemeden önce mutlaka bütün kodlarýn <b>&lt;?php</b> ve <b>?&gt;</b> aralýðý içinde olduðunu ve yabancý kod içermediðini doðrulayýnýz. ';

// iþlem gerçekleþtiriliyor mesajý
$lang['Removing_admins'] = 'Forum yöneticileri siliniyor';

// yardým metni
$lang['Option_Help_Text'] = '
<p>Eðer oturumlar ile ilgili bir hata aldýysanýz, oturum tablosunu temizlemek için <b>Oturumlarý Temizle</b> seçeneðini týklayýnýz.
<p>Forum tablolarýyla ilgili bir hata aldýysanýz, tablolarý tamir etmek için <b>Forum tablolarýný tamir et</b> seçeneðini týklayýnýz.
<p><b>Ayar tablosunu kontrol et</b> eksik giriþler için ayarlar tablosunu kontrol eder. Bir çok hata türüne karþý yardýmcý olacak bir iþlemdir.
<p>Yönetim paneline baðlanamýyorsanýz forumun yol bilgilerinde ya da çerez ayarlarýnda bir hata olabilir
<b>Yol bilgilerini yenile</b> seçeneði veya <b>Çerez bilgilerini yenile</b> seçeneði size yardýmcý olabilir.
<p>Dil bilgilerini yenilemek için <b>Dil bilgilerini yenile</b> seçeneðini, tema bilgilerini yenilemek için <b>Tema bilgilerini yenile</b> seçeneðini týklayýnýz.

<p>Eðer probleminiz Gzip fonksiyonunu aktif ettikten sonra oluþtuysa, Gzip fonksiyonunu kapatmak için <b>Gzip fonksiyonunu kapat</b> seçeneðini deneyiniz.</p>
<p>Eðer, üye hesabýnýzýn parolasýný kaybettiyseniz, seçtiðiniz bir kullanýcýyý forum yöneticisi olarak ayarlamak için <b>Forum yöneticisi belirle</b> seçeneðini kullanýnýz.
Bir kullanýcý kaydettikten sonra bu seçeneði kullanabilirsiniz. Eðer yeni bir kullanýcý kaydedemezseniz problemin kaynaðý bir yasak olabilir, yasak tablosunu temizlemek için <b>Yasaklýlar listesini temizle</b> seçeneðini deneyiniz.
<p>Eðer forumuzun bir hack iþlemine uðradýysa bütün forum yöneticilerini silmek için <b>Forum yöneticilerini sil</b> seçeneðini seçiniz. <b>Forum üyelikleri silinmeyecektir, sadece yönetici haklarý ellerinden alýnacaktýr.</b></p>
<p>Eðer Config.'.@$phpEx.' dosyasýný yeniden oluþturmak istiyorsanýz <b>Config.'.@$phpEx.' dosyasýný yenile</b> seçeneðini týklayýnýz.';
//acil bakým aracý sonu

?>