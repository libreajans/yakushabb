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

$lang['Extreme_Styles'] = 'Tema Y�netimi'; // eXtreme Styles
$lang['xs_title'] = 'Geli�mi� Stil';

// [+] ALEXIS
// y�netim b�l�m�nde EN ��kan Styles Management i�in
$lang['Styles_Management'] = 'Stil Y�netimi';

$lang['xs_file'] = 'Dosya';
$lang['xs_template'] = 'Tema';
$lang['xs_id'] = 'ID';
$lang['xs_style'] = 'Stil';
$lang['xs_styles'] = 'Stiller';
$lang['xs_users'] = 'Kullan�c�lar';
$lang['xs_options'] = 'Se�enekler';
$lang['xs_comment'] = 'Yorumlar';
$lang['xs_upload_time'] = 'Y�kleme Zaman�';
$lang['xs_select'] = 'Se�';

$lang['xs_continue'] = 'Devam'; // button

$lang['xs_click_here_lc'] = 't�klay�n';
$lang['xs_edit_lc'] = 'd�zenle';

/*
* navigation
*/
$lang['xs_config_shownav'] = array(
'Ayarlar',
'Stil Y�kle',
'Stil Sil',
'Varsay�lan Stil',
'�nbelle�i Y�net',
'Stil Al',
'Stil Ver',
'Stil Kopyala',
'Stil �ndir',
'Tema D�zenle',
'Stil D�zenle',
'Veritaban� G�nder',
'G�ncellemeler',
);

/*
* frame_top.tpl
*/
$lang['xs_menu_lc'] = 'Geli�mi� Stil men�s�';
$lang['xs_support_forum_lc'] = 'destek forumu';
$lang['xs_download_styles_lc'] = 'stil indir';
$lang['xs_install_styles_lc'] = 'stil y�kle';

/*
* index.tpl
*/

$lang['xs_main_comment1'] = 'Geli�mi� Stil ana men�s�. Bir �ok �zelli�in bulundu�u bu sayfada her fonksiyon ad�n�n alt�nda k�sa a��klamas� mevcuttur.<br /><br />Not: Bu eklenti phpBB stil ve tema y�netimini yenilemektedir. Standart phpBB fonksiyonlar�n� bu listede bulabilirsiniz, fakat bu fonksiyonlar optimize edildi ve yeni �zelliklere sahiptir.<br /><br />Bu konuda herhangi bir sorununuz varsa Geli�mi� Stil (eXtreme Styles) <a href="http://www.phpbbstyles.com" target="_blank">Destek Forumu</a> \'nu ziyaret edin.';
$lang['xs_main_comment2'] = 'Geli�mi� Stil y�neticinin stil dosyalar�n� saklamas�n� sa�lamaktad�r. stiller k���k s�k��t�r�lm�� dosyalar halinde saklanmaktad�r, bu i�lem ile bir s�r� dosyan�n y�klenip indirilirken meydana gelebilecek sorunlar�n �n�ne ge�ilmektedir. Stil dosyalar� s�k��t�r�lm��t�r bunlar� indirmek s�k��t�r�lmam�� dosyalar� indirmektan daha kolayd�r.';
$lang['xs_main_comment3'] = 'phpBB stil y�netiminin b�t�n �zellikleri Geli�mi� Stil eklentisi ile birlikte yenilendi.<br /><br />Men�y� g�rmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_main_title'] = 'Geli�mi� Stil ayar men�s�';
$lang['xs_menu'] = 'Geli�mi� Stil Men�s�';

$lang['xs_manage_styles'] = 'Stilleri Y�net';
$lang['xs_import_export_styles'] = 'Stil Al/Ver';
$lang['xs_install_uninstall_styles'] = 'Stil Y�kle/Kald�r';
$lang['xs_edit_templates'] = 'Temalar� D�zenle';
$lang['xs_other_functions'] = 'Di�er Fonksiyonlar';

$lang['xs_configuration'] = 'Ayarlar';
$lang['xs_configuration_explain'] = 'Bu �zellik Geli�mi� Stil ayarlar�n� de�i�tirebilmenizi sa�lar.';
$lang['xs_default_style'] = 'Varsay�lan Stil';
$lang['xs_default_style_explain'] = 'Bu �zellik varsay�lan pano stilini de�i�tirip kullan�c�lar�n stilden stile ge�ebilmelerini sa�lar.';
$lang['xs_manage_cache'] = '�nbelli�i Y�net';
$lang['xs_manage_cache_explain'] = 'Bu �zellik �nbelle�i y�netmenizi sa�lar.';
$lang['xs_import_styles'] = 'Stil Al';
$lang['xs_import_styles_explain'] = 'Bu �zellik .style dosyalar�n� indirip y�klemenizi sa�lar.';
$lang['xs_export_styles'] = 'Stil Ver';
$lang['xs_export_styles_explain'] = 'Bu �zellik panonuzdan bir stili .style olarak kaydedip kolayca ba�ka bir web sitesine ya da panoya transfer etmenizi sa�lar.';
$lang['xs_clone_styles'] = 'Stil �o�alt';
$lang['xs_clone_styles_explain'] = 'Bu �zellik stil ya da temalar�n kolayca kopyalar�n� ��karman�z� sa�lar.';
$lang['xs_download_styles'] = 'Stil �ndir';
$lang['xs_download_styles_explain'] = 'Bu �zellik stilleri web sitesinden kolayca y�kleyip kurman�z� sa�lar. Web sitelerinin listesini siz ayarlayabilirsiniz.';
$lang['xs_install_styles'] = 'Stil Y�kle';
$lang['xs_install_styles_explain'] = 'Bu �zellik panonuza y�klenen stilleri kurman�z� sa�lar.';
$lang['xs_uninstall_styles'] = 'Stil Kald�r';
$lang['xs_uninstall_styles_explain'] = 'Bu �zellik panonuzdaki stilleri kald�rman�z�/silmenizi sa�lar.';
$lang['xs_edit_templates_explain'] = 'Bu �zellik tpl dosyalar�n� �evrimi�i halde d�zenlemenizi sa�lar.';
$lang['xs_edit_styles_data'] = 'Stil Verisini D�zenle';
$lang['xs_edit_styles_data_explain'] = 'Bu �zellik stillerin de�i�kenlerini d�zenlemenizi sa�lar. Bu �zellik baz� stillerde kullan�l�r, fakat �o�u stil bunlar�n yerine css dosyas� kullan�r';
$lang['xs_export_styles_data'] = 'Stil Verisini Ver';
$lang['xs_export_styles_data_explain'] = 'Bu �zellik stil de�i�kenlerini theme_info.cfg dosyas�na kaydetmenizi sa�lar.';
$lang['xs_check_for_updates'] = 'Yeni S�r�m� Denetle';
$lang['xs_check_for_updates_explain'] = 'Bu �zellik y�kl� olan ve g�ncelleme �zelli�ini destekleyen modlar�n ve temalar�n g�ncel s�r�mlerini kontrol edebilmenizi sa�lar.';

$lang['xs_set_configuration_lc'] = 'ayarlar� belirle';
$lang['xs_set_default_style_lc'] = 'varsay�lan stili belirle';
$lang['xs_manage_cache_lc'] = '�nbelle�i y�net';
$lang['xs_import_styles_lc'] = 'stil al';
$lang['xs_export_styles_lc'] = 'stil ver';
$lang['xs_clone_styles_lc'] = 'stil �o�alt';
$lang['xs_uninstall_styles_lc'] = 'stil kald�r';
$lang['xs_edit_templates_lc'] = 'tema d�zenle';
$lang['xs_edit_styles_data_lc'] = 'stil verisini d�zenle';
$lang['xs_export_styles_data_lc'] = 'stil verisini ver';
$lang['xs_check_for_updates_lc'] = 'yeni s�r�m� denetle';

/*
* ftp.tpl, ftp functions
*/

$lang['xs_ftp_comment1'] = 'Bu �zelli�i kullanabilmeniz i�in dosya y�kleme metodunuzu se�meniz gerekmektedir. FTP metodunu se�erseniz �ifreler saklanmayacakt�r. Geli�mi� Stil her ba�lant� kurdu�unda sizden �ifre isteyecektir. Lokal dosya sistemini se�erseniz b�t�n gerekli dosyalar�n yaz�labilir olmas� laz�m.';
$lang['xs_ftp_comment2'] = 'Bu �zelli�i kullanabilmek i�in FTP ayarlar�n�z� yapmal�s�n�z. FTP �ifreniz saklanmayacakt�r. FTP ile ileti�ime ge�ecek fonksiyonu her seferinizde �al��t�rd���n�zda Geli�mi� Stil size FTP �ifrenizi soracakt�r';
$lang['xs_ftp_comment3'] = 'Uyar�: FTP fonksiyonu bu sunucu �zerinde kapat�lm��. Geli�mi� Stil\'in FTP fonksiyonunu kullanamayacaks�n�z.';

$lang['xs_ftp_title'] = 'FTP ayarlar�';

$lang['xs_ftp_explain'] = 'FTP yeni stillerin y�kleme i�leminde kullan�lmaktad�r. Stil alma �zelli�ini kullanmak istiyorsan�z FTP ayarlar�n�z� yapmal�s�n�z. Geli�mi� Stil; e�er m�mk�nse, ayarlar� otomatik alg�lay�p d�zenlemeye �al���cakt�r.';

$lang['xs_ftp_error_fatal'] = 'Bu sunucuda FTP fonksiyonlar�na izin verilmiyor. Devam edilemiyor.';
$lang['xs_ftp_error_connect'] = 'FTP hatas�: {HOST} sunucusuna ba�lan�lamad�';
$lang['xs_ftp_error_login'] = 'FTP hatas�: giri� yap�lamad�';
$lang['xs_ftp_error_chdir'] = 'FTP hatas�: {DIR} dizini de�i�tirilemedi';
$lang['xs_ftp_error_nonphpbbdir'] = 'FTP hatas�: ge�ersiz bir dizin ayarlad�n�z. Dizinde phpBB ile ilgili dosya yok.';
$lang['xs_ftp_error_noconnect'] = 'FTP sunucuya ba�lan�lamad�';
$lang['xs_ftp_error_login2'] = 'FTP kullan�c� ad� veya �ifresi ge�ersiz';

$lang['xs_ftp_log_disabled'] = 'Bu sunucuda FTP fonksiyonlar�na izin verilmiyor. Devam edilemiyor.';
$lang['xs_ftp_log_connecting'] = 'ba�lan�lan sunucu {HOST}';
$lang['xs_ftp_log_noconnect'] = '{HOST} sunucuya ba�lan�lamad� ';
$lang['xs_ftp_log_connected'] = 'ba�land�. giri� yap�ld�...';
$lang['xs_ftp_log_nologin'] = '{USER} ile giri� yap�lamad�';
$lang['xs_ftp_log_loggedin'] = 'giri� yap�ld�';
$lang['xs_ftp_log_end'] = 'program�n �al��mas� sona erdi';
$lang['xs_ftp_log_nopwd'] = 'hata: Dizine ula��lamad�';
$lang['xs_ftp_log_nomkdir'] = 'hata: {DIR} dizini olu�turulamad� ';
$lang['xs_ftp_log_mkdir'] = '{DIR} dizini olu�turuldu';
$lang['xs_ftp_log_nochdir'] = 'hata: {DIR} dizinine ge�ilemedi';
$lang['xs_ftp_log_normdir'] = 'hata: {DIR} dizini silinemedi';
$lang['xs_ftp_log_rmdir'] = '{DIR} dizini silindi';
$lang['xs_ftp_log_chdir'] = '{DIR} dizinine ge�ilemedi';
$lang['xs_ftp_log_noupload'] = 'hata: {FILE} dosyas� y�klenemedi';
$lang['xs_ftp_log_upload'] = '{FILE} dosyas� y�klendi';
$lang['xs_ftp_log_nochmod'] = 'uyar�: {FILE} dosyas�n�n chmod ayarlar� yap�lamad�';
$lang['xs_ftp_log_chmod'] = '{FILE} dosyas� i�in chmod ayarlar� {MODE} �ekline ayarland�';
$lang['xs_ftp_log_invalidcommand'] = 'hata: ge�ersiz komut: {COMMAND}';
$lang['xs_ftp_log_chdir2'] = '�imdiki dizini �ununla de�i�tiriyor {DIR}';
$lang['xs_ftp_log_nochdir2'] = '{DIR} dizini de�i�tirilemedi';

$lang['xs_ftp_config'] = 'FTP Ayarlar�';
$lang['xs_ftp_select_method'] = 'Y�kleme metodunu se�in';
$lang['xs_ftp_select_local'] = 'Yerel Dosya Sistemini Kullan (ayar gerekmiyor)';
$lang['xs_ftp_select_ftp'] = 'FTP kullan (FTP ayarlar�n�z� yap�n)';

$lang['xs_ftp_settings'] = 'FTP Ayarlar�';
$lang['xs_ftp_host'] = 'FTP Sunucusu';
$lang['xs_ftp_login'] = 'FTP Kullan�c�s�';
$lang['xs_ftp_path'] = 'FTP phpBB yolu';
$lang['xs_ftp_pass'] = 'FTP �ifresi';
$lang['xs_ftp_remotedir'] = 'Uzak Dizin';

$lang['xs_ftp_host_guess'] = ' (muhtemelen "{HOST}" [<a href="javascript: void()" onclick="{CLICK}">host ayarla</a>])';
$lang['xs_ftp_login_guess'] = ' (muhtemelen "{LOGIN}" [<a href="javascript: void()" onclick="{CLICK}">host ayarla</a>])';
$lang['xs_ftp_path_guess'] = ' (muhtemelen "{PATH}" [<a href="javascript: void()" onclick="{CLICK}">yol ayarla</a>])';

/*
* config.tpl
*/

$lang['xs_config_updated'] = 'Ayarlar g�ncellendi.';
$lang['xs_config_updated_explain'] = 'Yeni ayarlar�n etkin olabilmesi i�in sayfay� yenilemelisiniz. Sayfay� yenilemek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_config_warning'] = 'Uyar�: �nbelle�e yaz�lam�yor.';
$lang['xs_config_warning_explain'] = '�nbellek dizinine yaz�lam�yor. Geli�mi� Stil bu sorunu ��zmeye �al��acak. �nbellek dizinine ba�lant� �eklini de�i�tirmek i�in<br /><a href="{URL}">buraya</a> t�klay�n.<br /><br /> �nbellekleme sizin sunucunuzda �al��mazsa endi�elenmeyin, Geli�mi� Stil �nbellekleme olmadan da defalarca panonuzun h�z�n� artt�rabilir.';

$lang['xs_config_maintitle'] = 'Geli�mi� Stil Ayarlar�';
$lang['xs_config_subtitle'] = 'Bu Geli�mi� Stil ayar men�s�d�r. Se�eneklerin neleri de�i�tirdi�ini bilmiyorsan�z ayarlarla oynamay�n.';
$lang['xs_config_title'] = 'Geli�mi� Stil v{VERSION} Ayarlar�';
$lang['xs_config_cache'] = '�nbellek Ayarlar�';

$lang['xs_config_navbar'] = 'Sol �er�evede g�ster:';
$lang['xs_config_navbar_explain'] = 'Y�netim panelinde sol �er�evede nelerin g�sterilece�ini se�ebilirsiniz.';

$lang['xs_config_def_template'] = 'Varsay�lan tema dizin';
$lang['xs_config_def_template_explain'] = 'Gerekli bir tpl dosyas� varsay�lan tema dizininde bulanamad�ysa (bu phpBB\'nin modlar�n� eksik y�klediyseniz olur) tema sistemi o dosyay� bulmak i�in di�er temalar�n i�ine de bakacakt�r, bu �zelli�i kapamak i�in bo� b�rak�n.';

$lang['xs_config_check_switches'] = 'Derlerken de�i�iklikleri kontrol et';
$lang['xs_config_check_switches_explain'] = 'Bu �zellik temalar� hatalara kar�� kontrol eder. Kapamak derlemeyi h�zland�r�r, e�er hata varsa, derleyici derleme i�lemini yaparken hatalar� g�rmezden gelebilir.<br /><br />Geli�mi� kontrol sistemi temalar� otomatik kontrol eder ve bilinen hatalar� d�zeltmeye �al���r (farkl� modlar i�in farkl� hatalar vard�r). Basit kontrol sisteminden biraz daha yava� �al���r.<br /><br />Bazen hata kontrol sistemi kapat�ld���nda temalar daha g�zel durmaktad�r. Bu k�t� �ekilde html kodlamas�ndan meydana gelmektedir (tema i�in). Hatalar� d�zeltmek istiyorsan�z tpl dosyas�n�n kimin yazd���n� bulup irtibata ge�in.<br /><br />�nbellek �zelli�i kapat�ld�ysa h�zl� bir derleme i�in bu �zelli�i de kapat�n.';
$lang['xs_config_check_switches_0'] = 'Kapal�';
$lang['xs_config_check_switches_1'] = 'Geli�mi�';
$lang['xs_config_check_switches_2'] = 'Basit';

$lang['xs_config_show_errors'] = 'E�er dosyalar hatal� tpl dosyalar� i�eriyorsa hatalar� g�ster';
$lang['xs_config_show_error_explain'] = 'Bu �zellik tpl dosyalar�ndaki yanl�� kullan�mdan dolay� olu�an hatalar� g�stermektedir. &lt;!-- INCLUDE filename --&gt;';

$lang['xs_config_tpl_comments'] = 'HTML i�ine tpl dosya adlar�n� koy';
$lang['xs_config_tpl_comments_explain'] = 'Bu �zellik HTML i�ine a��klama koyarak hangi tpl dosyalar�n�n g�sterildi�ini stil tasar�mc�lar�n�n g�rmesini sa�lamaktad�r.';

$lang['xs_config_use_cache'] = '�nbelle�i kullan';
$lang['xs_config_use_cache_explain'] = '�nbellek disk alan�na kaydedilir, bu temalar� h�zland�racakt�r ��nk� her defas�nda temalar�n derlenmesine gerek kalmaz.';

$lang['xs_config_auto_compile'] = '�nbelle�i otomatik kaydet';
$lang['xs_config_auto_compile_explain'] = 'Bu �zellik �nbelle�e al�nmam�� temalar� otomatik derleyerek �nbellek dizinine kay�t eder.';

$lang['xs_config_auto_recompile'] = 'Otomatik �nbellek derlemesi';
$lang['xs_config_auto_recompile_explain'] = 'E�er bir temada bir de�i�iklik yap�ld�ysa bu �zellik bunlar� otomatik derler.';

$lang['xs_config_php'] = '�nbelle�e al�nan dosyalar�n uzant�lar�';
$lang['xs_config_php_explain'] = 'Bu �nbelle�e al�nan dosyalar�n uzant�lar�d�r. Dosyalar varsay�lan olarak php format�nda saklan�r.';

$lang['xs_config_back'] = 'Ayarlara d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_config_sql_error'] = 'Genel ayarlar�n g�ncelle�tirilmesi {VAR} durumu i�in ba�ar�s�z oldu.';

// Debug info
$lang['xs_debug_header'] = 'Onarma bilgisi';
$lang['xs_debug_explain'] = 'Onarma bilgisi �nbellek ayarlan�rken hatalar�n bulunup ��z�mlenmesinde kullan�lmaktad�r.';
$lang['xs_debug_vars'] = 'Tema de�i�kenleri';
$lang['xs_debug_tpl_name'] = 'Tema ad�:';
$lang['xs_debug_cache_filename'] = '�nbellek ad�:';
$lang['xs_debug_data'] = 'Onarma verisi:';

$lang['xs_check_hdr'] = '�nbelle�i %s i�in kontrol ediyor';
$lang['xs_check_filename'] = 'Hata: ge�ersiz dosya ad�';
$lang['xs_check_openfile1'] = 'Hata: Dosyay� a�am�yor "%s". Dizini olu�turmaya �al��acak ...';
$lang['xs_check_openfile2'] = 'Hata: Dosyay� a�am�yor "%s" 2. deneme . Sonu� Ba�ar�s�z...';
$lang['xs_check_nodir'] = 'Kontrol ediyor "%s" - b�yle bir dizin yok.';
$lang['xs_check_nodir2'] = 'Hata: Dizini olu�turam�yor "%s" - Dosya izinlerini kontrol etmeniz gerekiyor.';
$lang['xs_check_createddir'] = 'Olu�turulan dizin "%s"';
$lang['xs_check_dir'] = 'Kontrol ediliyor "%s" - dizin mevcut.';
$lang['xs_check_ok'] = 'Yazmak i�in dosya a��ld� "%s" her�ey tamam g�r�n�yor.';
$lang['xs_error_demo_edit'] = '�n izleme modunda dosya de�i�ikli�i yapamazs�n�z';
$lang['xs_error_not_installed'] = 'Geli�mi� Stil y�klenemedi. includes/template.php dosyas�n� atmay� unutmay�n';

/*
* chmod
*/

$lang['xs_chmod'] = 'CHMOD';
$lang['xs_chmod_return'] = '<br /><br />Ayarlara d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_chmod_message1'] = 'Ayarlar de�i�tirildi.';
$lang['xs_chmod_error1'] = '�nbellek dizinine ba�lant� tarz�n� de�i�tiremiyor';


/*
* default style
*/

$lang['xs_def_title'] = 'Varsay�lan Stil Yap';
$lang['xs_def_explain'] = 'Bu �zellik kullan�c�lar�n stilleri kolayca de�i�tirebilmelerini sa�lamaktad�r';

$lang['xs_styles_set_default'] = 'varsay�lan yap';
$lang['xs_styles_no_override'] = 'kullan�c� ayarlar�n� g�zard� etme';
$lang['xs_styles_do_override'] = 'kullan�c� ayarlar�n� g�zard� et';
$lang['xs_styles_switch_all'] = 't�m kullan�c�lar i�in bu stili ayarla';
$lang['xs_styles_switch_all2'] = 'T�m kullan�c�lar i�in:';
$lang['xs_styles_defstyle'] = 'varsay�lan stil';
$lang['xs_styles_available'] = 'Varolan Stiller';
$lang['xs_styles_make_public'] = 'stili herkes kullanabilsin';
$lang['xs_styles_make_admin'] = 'stili sadece y�netici kullanabilsin';
$lang['xs_styles_users'] = 'kullananlar';


/*
* cache management
*/

$lang['xs_manage_cache_explain2'] = 'Bu �zellik stiller i�in �nbelle�e al�nm�� dosyalar� derlemeye ve silmeye yarar.';
$lang['xs_clear_all_lc'] = 'hepsini temizle';
$lang['xs_compile_all_lc'] = 'hepsini derle';
$lang['xs_clear_cache_lc'] = '�nbelle�i temizle';
$lang['xs_compile_cache_lc'] = '�nbelle�i derle';
$lang['xs_cache_confirm'] = 'E�er �ok fazla teman�z varsa sunucunuzun y�klenmesine sebep olabilir. Devam etmek istiyor musunuz?';

$lang['xs_cache_nowrite'] = 'Hata: �nbellek diziniyle ba�lant� kurulam�yor';
$lang['xs_cache_log_deleted'] = 'Silindi: {FILE}';
$lang['xs_cache_log_nodelete'] = 'Hata: {FILE} dosyas� silinemiyor';
$lang['xs_cache_log_nothing'] = '<b>{TPL}</b> temas� i�in silinecek bir �ey yok';
$lang['xs_cache_log_nothing2'] = '�nbellek dizininde silinecek bir �ey yok';
$lang['xs_cache_log_count'] = 'Silindi: <b>{NUM}</b> dosya';
$lang['xs_cache_log_count2'] = 'Silerken hata: <b>{NUM}</b> dosya';
$lang['xs_cache_log_compiled'] = 'Derlendi: <b>{NUM}</b> dosya';
$lang['xs_cache_log_errors'] = 'Hata: <b>{NUM}</b>';
$lang['xs_cache_log_noaccess'] = 'Hata: {DIR} dizini ile ba�lant� kurulam�yor';
$lang['xs_cache_log_compiled2'] = 'Derlendi: {FILE}';
$lang['xs_cache_log_nocompile'] = 'Derlerken hata: {FILE}';

/*
* export/import/download/clone
*/

$lang['xs_import_explain'] = 'Bu �zellik stilleri alman�z� sa�lamaktad�r. Ayr�ca stilleri otomatik indirip kurabilmektedir.<br /><br /><b>Not:</b> E�er panonuza herhangi bir mod y�klediyseniz (Geli�mi� Stil haricinde) stilleri y�klerken dikkatli olmal�s�n�z. Panonuzla uyumlu olmayabilirler. Yaln�zca panonuzda yapt���n�z de�i�ikliklere sahip stilleri kullan�n.';

$lang['xs_import_lc'] = 'al';
$lang['xs_list_files_lc'] = 'dosya listesi';
$lang['xs_delete_file_lc'] = 'dosya sil';
$lang['xs_export_style_lc'] = 'stil ver';

$lang['xs_import_no_cached'] = 'Y�klenecek �nbelle�e al�nm�� stil yok';
$lang['xs_add_styles'] = 'Stil Ekle';
$lang['xs_add_styles_web'] = 'Web\'ten indir';
$lang['xs_add_styles_web_get'] = '�ndir';
$lang['xs_add_styles_copy'] = 'Yerel dosyadan kopyala';
$lang['xs_add_styles_copy_get'] = 'Kopyala';
$lang['xs_add_styles_upload'] = 'Bilgisayar�n�zdan y�kleyin';
$lang['xs_add_styles_upload_get'] = 'Y�kle';

$lang['xs_export_style'] = 'Stil Ver';
$lang['xs_export_style_explain'] = 'Bu �zellik stilleri tek bir dosya halinde g�ndermenizi sa�lar. Bu tek dosya gzip ile s�k��t�r�lm�� ve bir zip dosyas�ndan boyut olarak daha k���kt�r. Di�er b�t�n stiller tek dosya halindedir, b�ylece bir panodan di�er panoya stil transfer etmek �ok kolayd�r.<br /><br />Bu �zellik bir stili bir panodan ba�ka bir panoya hi� elle kopyalamadan transfer etmenizi sa�lamaktad�r.';

$lang['xs_export_style_title'] = 'Tema Ver {TPL}';
$lang['xs_export_tpl_name'] = 'Verilecek tema';
$lang['xs_export_style_names'] = 'Verilecek stil(leri) se�in';
$lang['xs_export_style_name'] = 'Verilecek stil';
$lang['xs_export_style_comment'] = 'Yorum';
$lang['xs_export_where'] = 'Nereye verilecek';
$lang['xs_export_where_download'] = '<b>Dosya olarak indir</b>';
$lang['xs_export_where_store'] = '<b>Dosyalar� sunucuda depola</b>';
$lang['xs_export_where_store_dir'] = 'Dizin';
$lang['xs_export_where_ftp'] = '<b>FTP yolu ile y�kle</b>';
$lang['xs_export_filename'] = 'Verilecek dosya ad�';

$lang['xs_download_explain2'] = 'Bu �zellik stilleri ba�ka bir web sitesinden kolayca indirip kurman�z� sa�lamaktad�r. Site isminin yan�ndaki linke t�klay�n b�ylece stil indirme sayfas�na y�nlendiriliceksiniz.<br /><br />Ayr�ca buradan web sitelerinin listesini y�netebilirsiniz.';

$lang['xs_download_locations'] = '�ndirme Yeri';
$lang['xs_edit_link'] = 'Link D�zenle';
$lang['xs_add_link'] = 'Link Ekle';
$lang['xs_link_title'] = 'Link Ba�l���';
$lang['xs_link_url'] = 'Link URL';
$lang['xs_delete'] = 'Sil';

$lang['xs_style_header_error_file'] = 'lokal dosyay� a�am�yor';
$lang['xs_style_header_error_server'] = 'sunucuda hata: ';
$lang['xs_style_header_error_invalid'] = 'Ge�ersiz dosya ba�l���';
$lang['xs_style_header_error_reason'] = 'Dosya ba�l���n� okurken hata: ';
$lang['xs_style_header_error_incomplete'] = 'Dosya tamamlanmam��';
$lang['xs_style_header_error_incomplete2'] = 'Ge�ersiz dosya boyutu. B�y�k olas�l�kla dosya tamamlanmam��.';
$lang['xs_style_header_error_invalid2'] = 'Ge�ersiz dosya. B�y�k olas�l�kla dosya Geli�mi� Stil sistemi ile uyumlu bir stil de�il ya da ge�ersiz bir s�r�m.';
$lang['xs_error_cannot_open'] = 'Dosya a��lamad�.';
$lang['xs_error_decompress_style'] = 'Dosyay� a�arken hata olu�tu b�y�k olas�l�kla dosya bozuk.';
$lang['xs_error_cannot_create_file'] = '{FILE} dosyas� olu�turulamad�.';
$lang['xs_error_cannot_create_tmp'] = '{FILE} ge�ici dosyas� olu�turulam�yor.';
$lang['xs_import_invalid_file'] = 'Ge�ersiz Dosya';
$lang['xs_import_incomplete_file'] = 'Tamamlanmam�� dosya';
$lang['xs_import_uploaded'] = 'Stil yerle�tirildi.';
$lang['xs_import_installed'] = 'Stil yerle�tirildi ve y�klendi.';
$lang['xs_import_notinstall'] = 'Stil yerle�tirildi, y�klemede hata olu�tu: sql hatas�.';
$lang['xs_import_notinstall2'] = 'Stil yerle�tirildi, y�klemede hata olu�tu: theme_info.cfg dosyas�nda stil bulunamad�.';
$lang['xs_import_notinstall3'] = 'Stil yerle�tirildi, y�klemede hata olu�tu: theme_info.cfg dosyas�nda "{STYLE}" i�in hi� bir giri� bulunamad�.';
$lang['xs_import_notinstall4'] = 'Stil yerle�tirildi, y�klemede hata olu�tu: sonraki themes_id bilgisi al�nam�yor.';
$lang['xs_import_notinstall5'] = 'Stil yerle�tirildi, y�klemede hata olu�tu: stil tablosu g�ncelle�tirilemiyor.';
$lang['xs_import_nodownload'] = 'Stil {URL} adresinden indirilemiyor ';
$lang['xs_import_nodownload2'] = 'Stil {URL} adresinden kopyalanam�yor';
$lang['xs_import_nodownload3'] = 'Dosya indirilemedi.';
$lang['xs_import_uploaded2'] = 'Stil indirildi, �imdi alabilirsiniz.<br /><br />almak i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_import_uploaded3'] = 'Stil kopyaland�, �imdi alabilirsiniz.<br /><br />almak i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_import_uploaded4'] = 'Stil yerle�tirildi, �imdi alabilirsiniz.<br /><br />almak i�in <a href="{URL}">buraya</a> t�klay�n..';
$lang['xs_export_no_open_dir'] = '{DIR} dizini a��lam�yor';
$lang['xs_export_no_open_file'] = '{FILE} dosyas� a��lam�yor';
$lang['xs_export_no_read_file'] = '{FILE} dosyas� okunurken hata olu�tu';
$lang['xs_no_theme_data'] = 'Se�ilen tema i�in stil verisi al�nam�yor';
$lang['xs_no_style_info'] = 'Stil bilgisi al�nam�yor';
$lang['xs_export_noselect_themes'] = 'En az bir stil se�melisiniz';
$lang['xs_export_error'] = '"{TPL}" temas� verilemedi: ';
$lang['xs_export_error2'] = '"{TPL}" stili verilemedi: stil bo�';
$lang['xs_export_saved'] = 'Stil "{FILE}" olarak farkl� kaydedildi';
$lang['xs_export_error_uploading'] = 'Dosya y�klemesinde hata';
$lang['xs_export_uploaded'] = 'Dosya y�klendi.';
$lang['xs_clone_taken'] = 'Bu stil ad� zaten kullan�l�yor.';
$lang['xs_error_new_row'] = 'Tabloya bir dizi eklenemiyor.';
$lang['xs_theme_cloned'] = 'Stil �o�alt�ld�.';
$lang['xs_invalid_style_name'] = 'Ge�ersiz stil ad�.';
$lang['xs_clone_style_exists'] = 'Bu tema zaten var.';
$lang['xs_clone_no_select'] = 'Kopyalamak i�in en az bir stil se�melisiniz.';
$lang['xs_no_themes'] = 'Stil veritaban�nda bulunamad�.';

$lang['xs_import_back'] = 'Stil Alma Sayfas�na geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_import_back_download'] = '�ndirme Sayfas�na geri d�nmek i�in <a href="{URL}" target="main">buraya</a> t�klay�n.';
$lang['xs_export_back'] = 'Stil Verme Sayfas�na geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_clone_back'] = 'Stil �o�altma Sayfas�na geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n..';
$lang['xs_download_back'] = '�ndirme Sayfas�na geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';

$lang['xs_import_tpl'] = 'Tema Al "{TPL}"';
$lang['xs_import_tpl_comment'] = 'Bu �zellik temalar� panonuza y�klemenizi sa�lamaktad�r. E�er ayn� isimli bir tema daha varsa panonuzda bu �zellik eski dosyalar�n �st�ne otomatik yazacakt�r. B�ylece bu �zellik stilleri otomatik g�ncelle�tirmek i�in de kullan�labilir.<br /><br />Bu �zellik ayr�ca stilleri otomatik y�kleyebilir. Stilleri ald�ktan sonra y�klemek istiyorsan�z a�a��dan bir ya da daha �ok stil se�in.';
$lang['xs_import_tpl_filename'] = 'Dosya ad�:';
$lang['xs_import_tpl_tplname'] = 'Tema ad�:';
$lang['xs_import_tpl_comment2'] = 'Yorum:';
$lang['xs_import_select_styles'] = 'Y�klenecek stil(ler) se�in:';
$lang['xs_import_install_def_lc'] = 'varsay�lan stil yap';
$lang['xs_import_install_style'] = 'Stil Y�kle:';
$lang['xs_import'] = 'Al';

$lang['xs_import_list_contents'] = 'Dosya i�indekiler: ';
$lang['xs_import_list_filename'] = 'Dosya ad�: ';
$lang['xs_import_list_template'] = 'Tema: ';
$lang['xs_import_list_comment'] = 'Yorum: ';
$lang['xs_import_list_styles'] = 'Stil(ler): ';
$lang['xs_import_list_files'] = 'Dosyalar ({NUM}):';
$lang['xs_import_download_lc'] = 'dosyay� indir';
$lang['xs_import_view_lc'] = 'dosyaya bak';
$lang['xs_import_file_size'] = '({NUM} byte)';

$lang['xs_import_nogzip'] = 'Bu �zellik gzip s�k��t�rmas� gerektirir ve gzip sunucunuzda desteklenmiyor g�r�n�yor.';
$lang['xs_import_nowrite_cache'] = '�nbelle�e yaz�lam�yor. Bu �zellik �nbelle�e yaz�labilmeyi gerektirir. Geli�mi� Stil ayarlar�n� kontrol edin.<br /><br />�nbelle�e yaz�labilmesi i�in <a href="{URL1}">buraya</a> t�klay�n.<br /><br />Y�kleme sayfas�na d�nmek i�in<a href="{URL2}">buraya</a> t�klay�n.';

$lang['xs_import_download_warning'] = 'Bu �zellik sizi ba�ka bir siteye y�nlendiricek, bu site arac�l��� ile bir ka� t�klamayla kolayca stilleri Geli�mi� Stil modu sayesinde indirebilirsiniz.';

$lang['xs_clone_style'] = 'Stil �o�alt';
$lang['xs_clone_style_explain'] = 'Bu �zellik stil ya da t�m teman�n kopyas�n� almay� sa�lamaktad�r.<br /><br /><b>Dikkat:</b> temay� kopyalarken tema yap�mc�s�n�n buna izin verdi�ine emin olun (tema subsilver ise istedi�iniz her�eyi yapabilirsiniz). Genellikle tema yap�mc�lar� temalar�n� de�i�tirmenize izin verirler. Fakat de�i�tirilmi� temalar�n da��t�m� yasakt�r.';
$lang['xs_clone_style_explain2'] = 'Bu �zellik teman�z i�in yeni bir stil olu�turman�z� sa�lamaktad�r. Bu �zellik hi�bir dosyay� kopyalamamaktad�r. Veritaban�na yeni stiliniz i�in kay�t girmektedir. Yeni ve eski b�t�n stiller ayn� temay� kullan�r.';
$lang['xs_clone_style_explain3'] = 'Olu�turaca��n�z yeni stilinizin ad�n� girin ve "Kopyala" buttonuna bas�n.';
$lang['xs_clone_style_explain4'] = 'Bu �zellik temalar� �o�altmaya yarar. Ayr�ca bu temaya ait b�t�n stilleri de kopyalayabilirsiniz. Bundan sonra tpl dosyalar�n� g�venle d�zenleyebilirsiniz, eski ve yeni temalar�n�z etkilenmeyecektir.';

$lang['xs_clone_style_lc'] = 'stil �o�alt';
$lang['xs_clone_style2'] = 'Stil �o�alt "{STYLE}":';
$lang['xs_clone_style3'] = 'Tema �o�alt "{STYLE}"';
$lang['xs_clone_newdir_name'] = 'Yeni tema (dizin) ad�:';
$lang['xs_clone_select'] = '�o�latmak i�in stil(ler) se�iniz:';
$lang['xs_clone_select_explain'] = 'En az bir stil se�melisiniz.';
$lang['xs_clone_newname'] = 'Yeni stil ad�:';


/*
* install/uninstall
*/
$lang['xs_install_styles_explain2'] = 'Panonuza y�klenen ancak kurulmayan stillerin listesidir. Se�ti�iniz stilleri Y�kle butonuna basarak kurabilirsiniz. Tek bir stil kurmak i�in stil ad� yan�ndaki y�kle ba��na t�klay�n�z.';
$lang['xs_uninstall_styles_explain2'] = 'Panonuza y�klenen stillerin bir listesidir. "kald�r" ba��na t�klayarak panonuzdan stilleri kald�rabilirsiniz. Stilleri kald�rmak g�venlidir. Kald�rd���n�z stili kullanan kullan�c�lar, stil silindikten sonra varsay�lan stili kullanmaya ba�larlar ve silme i�lemi s�ras�nda bu stil i�in olan �nbellek otomatik silinir.';

$lang['xs_install'] = 'Y�kle';
$lang['xs_install_lc'] = 'y�kle';
$lang['xs_uninstall'] = 'Kald�r';
$lang['xs_remove_files'] = 'Dosyalar� Sil';
$lang['xs_style_removed'] = 'Stil silindi.';
$lang['xs_uninstall_lc'] = 'kald�r';
$lang['xs_uninstall2_lc'] = 'kald�r ve dosyalar� sil';

$lang['xs_install_back'] = 'Stil Y�klemesine d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_uninstall_back'] = 'Stil Kald�rmas�na d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_goto_default'] = 'Varsay�lan stili de�i�tirmek i�in <a href="{URL}">buraya</a> t�klay�n.';

$lang['xs_install_installed'] = 'Stil(ler) y�klendi.';
$lang['xs_install_error'] = 'Stil y�klemesinde hata.';
$lang['xs_install_none'] = 'Y�klenecek yeni stil yok. B�t�n kullan�labilir stiller y�kl�.';

$lang['xs_uninstall_default'] = 'Varsay�lan stili silemezsin. Varsay�lan stili de�i�tirmek i�in <a href="{URL}">buraya</a> t�klay�n.';

/*
* export theme_info.cfg
*/
$lang['xs_export_styles_data_explain2'] = 'Bu �zellik stil verisini theme_info.cfg dosyas�na yazmaktad�r. Bu �zellik; stil bir panodan di�erine transfer edilmeden �nce veritaban� bilgisini saklamaya yarar.<br /><br /><b>Not:</b> Geli�mi� Stil verme �zelli�ini kullan�yorsan�z stil bilgisini theme_info.cfg dosyas�na kaydetmenize gerek yok. Bu i�lem Geli�mi� Stil taraf�ndan otomatik yap�lmaktad�r.';
$lang['xs_export_styles_data_explain3'] = 'G�ndermek istedi�iniz stilleri se�in.';

$lang['xs_export_data_back'] = 'Stil Verisini Verme Y�netimine d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_export_style_data_lc'] = 'stil verisini ver';

$lang['xs_export_data_saved'] = 'Veri verildi.';

/*
* edit templates (file manager)
*/
$lang['xs_edit_template_comment1'] = 'Bu �zellik temalar� d�zenleyebilmenizi sa�lamaktad�r. Dosyaya g�z atma se�ene�i yaln�zca d�zenlenebilir dosyalar� g�sterir';
$lang['xs_edit_template_comment2'] = 'Bu �zellik temalar� d�zenleyebilmenizi sa�lamaktad�r.';
$lang['xs_edit_file_saved'] = 'Dosya kay�tland�.';
$lang['xs_edit_not_found'] = 'Dosya bulunamad�.';
$lang['xs_edittpl_back_dir'] = 'Dosya Y�neticisine d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';

$lang['xs_fileman_browser'] = 'Dosyalara g�zat';
$lang['xs_fileman_directory'] = 'Dizin:';
$lang['xs_fileman_dircount'] = 'Dizinler ({COUNT}):';
$lang['xs_fileman_filter'] = 'Filtre';
$lang['xs_fileman_filter_ext'] = '�u uzant�ya sahip dosyalar� g�ster:';
$lang['xs_fileman_filter_content'] = '�unu i�eren dosyalar� g�ster:';
$lang['xs_fileman_filter_clear'] = 'Filtreyi Temizle';
$lang['xs_fileman_filename'] = 'Dosya ad�';
$lang['xs_fileman_filesize'] = 'Boyut';
$lang['xs_fileman_filetime'] = 'De�i�tirilme';
$lang['xs_fileman_options'] = 'Se�enekler';
$lang['xs_fileman_time_today'] = '(bug�n)';
$lang['xs_fileman_edit_lc'] = 'd�zen';

$lang['xs_fileedit_search_nomatch'] = 'arad���n�z kriterde bir �ey bulunamad�';
$lang['xs_fileedit_search_match1'] = '1 sonu� de�i�tirildi';
$lang['xs_fileedit_search_matches'] = "De�i�tirildi ' + Hesapland� + ' E�le�en";
$lang['xs_fileedit_noundo'] = 'Geri d�nd�r�lecek hi� bir i�lem yok';
$lang['xs_fileedit_undo_complete'] = 'Eski i�erik y�klendi';
$lang['xs_fileedit_edit_name'] = 'Dosya d�zenle:';
$lang['xs_fileedit_location'] = 'Yer:';
$lang['xs_fileedit_reload_lc'] = 'dosyay� tekrar y�kle';
$lang['xs_fileedit_download_lc'] = 'dosya indir';
$lang['xs_fileedit_trim'] = 'Dosyan�n ba��ndaki ve sonundaki bo�luklar� otomatik temizle.';
$lang['xs_fileedit_functions'] = 'Fonksiyon D�zenle';
$lang['xs_fileedit_replace1'] = 'De�i�tir ';
$lang['xs_fileedit_replace2'] = ' ile ';
$lang['xs_fileedit_replace_first_lc'] = 'ilk bulunan sonu� ile de�i�tir';
$lang['xs_fileedit_replace_all_lc'] = 'b�t�n sonu�lar� de�i�tir';
$lang['xs_fileedit_replace_undo_lc'] = 'yap�lanlar� geri al';
$lang['xs_fileedit_backups'] = 'Yedekleme';
$lang['xs_fileedit_backups_save_lc'] = 'yedekle';
$lang['xs_fileedit_backups_show_lc'] = 'i�indekileri g�ster';
$lang['xs_fileedit_backups_restore_lc'] = 'onar';
$lang['xs_fileedit_backups_download_lc'] = 'indir';
$lang['xs_fileedit_backups_delete_lc'] = 'sil';
$lang['xs_fileedit_upload'] = 'Y�kle';
$lang['xs_fileedit_upload_file'] = 'Dosya y�kle:';

/*
* edit styles data (theme_info)
*/
$lang['xs_data_head_stylesheet'] = 'CSS �ablonu';
$lang['xs_data_body_background'] = 'Arkaplan resmi';
$lang['xs_data_body_bgcolor'] = 'Arkaplan rengi';
$lang['xs_data_style_name'] = 'Stil Ad�';
$lang['xs_data_body_link'] = 'Ba� rengi';
$lang['xs_data_body_text'] = 'Metin rengi';
$lang['xs_data_body_vlink'] = 'Ziyaret edilen ba� rengi';
$lang['xs_data_body_alink'] = 'Aktif ba� rengi';
$lang['xs_data_body_hlink'] = '�zerine gelme ba� rengi';
$lang['xs_data_tr_color'] = 'Tablo dizi rengi %s';
$lang['xs_data_tr_class'] = 'Tablo dizi t�r� %s';
$lang['xs_data_th_color'] = 'Tablo ba�� rengi %s';
$lang['xs_data_th_class'] = 'Tablo ba�� t�r� %s';
$lang['xs_data_td_color'] = 'Tablo h�cre dizi rengi %s';
$lang['xs_data_td_class'] = 'Tablo h�cre rengi %s';
$lang['xs_data_fontface'] = 'Font t�r� %s';
$lang['xs_data_fontsize'] = 'Font boyutu %s';
$lang['xs_data_fontcolor'] = 'Font rengi %s';
$lang['xs_data_span_class'] = 'geni�lik t�r� %s';
$lang['xs_data_img_size_poll'] = 'Anket resminin boyutu [px]';
$lang['xs_data_img_size_privmsg'] = 'Ki�isel mesaj durum boyutu [px]';
$lang['xs_data_theme_public'] = 'Herkese a��k stil (1 veya 0)';
$lang['xs_data_unknown'] = 'Tan�mlama bilgisi yok (%s)';

$lang['xs_edittpl_error_updating'] = 'Stil g�ncellerken hata.';
$lang['xs_edittpl_style_updated'] = 'Stil g�ncellendi.';
$lang['xs_invalid_style_id'] = 'Ge�ersiz stil ID\'si.';

$lang['xs_edittpl_back_edit'] = 'D�zenlemeye geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';
$lang['xs_edittpl_back_list'] = 'Stil listesine geri d�nmek i�in <a href="{URL}">buraya</a> t�klay�n.';

$lang['xs_editdata_explain'] = 'Bu �zellik veritaban�na y�klenmi� stilleri d�zenlemenizi sa�lar. Baz� stiller veritaban� de�erlerini g�rmezden gelir ve css kullan�r baz�lar� da veritaban� de�erlerini kullan�r.';
$lang['xs_editdata_var'] = 'De�i�ken';
$lang['xs_editdata_value'] = 'De�er';
$lang['xs_editdata_comment'] = 'Yorum';


/*
* updates
*/

$lang['xs_updates'] = 'G�ncelle�tirmeler';
$lang['xs_updates_comment'] = 'Bu �zellik baz� stil ve modlar�n g�ncellemeleri kontrol eder. Sadece konu ile ilgili g�ncelleme bilgileri mevcut ise �al���r.';
$lang['xs_updates_comment2'] = 'S�r�m denetimi i�in sonu�lar.';
$lang['xs_update_total1'] = 'Toplam: <b>{NUM}</b>';
$lang['xs_update_info1'] = 'Bu �zellik panonuzda y�kl� olan ve g�ncelleme �zelli�ini destekleyen modlar ve stillerin g�ncel s�r�mlerini kontrol etmeye yarar. G�ncel s�r�m bulundu�u zaman size g�ncelle�tirmeleri indirebilece�iniz sitenin adresini g�sterecektir.<br /><br />Bu �zellik "socket" �zelli�inin a��k olmas�n� gerektirir. �o�u bedava alan sa�lay�c�lar� bu �zelli�i size sunmaz, �rne�in lycos gibi yerlerde g�ncelle�tirme �zelli�ini kullanamayabilirsiniz, fakat panonuz normal bir sunucu �zerindeyse her�ey d�zg�n �al��acakt�r.<br /><br />"Devam" butonuna t�klad���n�zda "Geli�mi� Stil" panonuza y�kl� baz� �zellikleri kontrol edecektir. E�er siteniz yava�sa bu i�lemlerin yap�lmas� uzun bir zaman alabilir. Sab�rl� olun ve taray�c�n�zdaki dur butonuna basmay�n. Sunucunuz yava�sa ya da y�klenen i�eri�in bulundu�u site yava�sa i�lem zaman a��m�na u�rayabilir. Bu gibi durumlarda olursa zaman a��m� de�erini y�kseltin.';
$lang['xs_update_name'] = '�sim';
$lang['xs_update_type'] = 'Tip';
$lang['xs_update_current_version'] = 'S�r�m�n�z';
$lang['xs_update_latest_version'] = 'Son s�r�m';
$lang['xs_update_downloadinfo'] = '�ndirme adresi';
$lang['xs_update_timeout'] = 'G�ncelleme �zelli�i zaman a��m� de�eri (saniye):';
$lang['xs_update_continue'] = 'Devam';

$lang['xs_update_total2'] = 'Hatalar: <b>{NUM}</b>';
$lang['xs_update_total3'] = 'G�ncellemeler: <b>{NUM}</b>';
$lang['xs_update_select1'] = 'G�ncellemeleri se�in';
$lang['xs_update_types'] = array(
0 => 'Bilinmeyen',
1 => 'Stil',
2 => 'Mod',
3 => 'phpBB'
);
$lang['xs_update_fileinfo'] = 'Daha fazla bilgi';
$lang['xs_update_nothing'] = 'G�ncelle�tirecek bir �ey yok.';
$lang['xs_update_noupdate'] = 'Son s�r�m� kullan�yorsunuz.';

$lang['xs_update_error_url'] = 'Hata: %s sitesi bulunamad�';
$lang['xs_update_error_noitem'] = 'Hata: G�ncelleme bilgileri bulunamad�';
$lang['xs_update_error_noconnect'] = 'Hata: G�ncelleme sunucusuna ba�lan�lamad�';

$lang['xs_update_download'] = 'indir';
$lang['xs_update_downloadinfo2'] = 'indir/bilgi';
$lang['xs_update_info'] = 'web sitesi';

$lang['xs_permission_denied'] = '�zniniz Yok';

$lang['xs_download_lc'] = 'indir';
$lang['xs_info_lc'] = 'bilgi';

/*
* style configuration
*/
$lang['Template_Config'] = 'Tema Ayarlar�';
$lang['xs_style_configuration'] = 'Geli�mi� Tema ayarlar�';

?>