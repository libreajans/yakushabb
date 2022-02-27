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

$lang['Extreme_Styles'] = 'Tema Yönetimi'; // eXtreme Styles
$lang['xs_title'] = 'Geliþmiþ Stil';

// [+] ALEXIS
// yönetim bölümünde EN çýkan Styles Management için
$lang['Styles_Management'] = 'Stil Yönetimi';

$lang['xs_file'] = 'Dosya';
$lang['xs_template'] = 'Tema';
$lang['xs_id'] = 'ID';
$lang['xs_style'] = 'Stil';
$lang['xs_styles'] = 'Stiller';
$lang['xs_users'] = 'Kullanýcýlar';
$lang['xs_options'] = 'Seçenekler';
$lang['xs_comment'] = 'Yorumlar';
$lang['xs_upload_time'] = 'Yükleme Zamaný';
$lang['xs_select'] = 'Seç';

$lang['xs_continue'] = 'Devam'; // button

$lang['xs_click_here_lc'] = 'týklayýn';
$lang['xs_edit_lc'] = 'düzenle';

/*
* navigation
*/
$lang['xs_config_shownav'] = array(
'Ayarlar',
'Stil Yükle',
'Stil Sil',
'Varsayýlan Stil',
'Önbelleði Yönet',
'Stil Al',
'Stil Ver',
'Stil Kopyala',
'Stil Ýndir',
'Tema Düzenle',
'Stil Düzenle',
'Veritabaný Gönder',
'Güncellemeler',
);

/*
* frame_top.tpl
*/
$lang['xs_menu_lc'] = 'Geliþmiþ Stil menüsü';
$lang['xs_support_forum_lc'] = 'destek forumu';
$lang['xs_download_styles_lc'] = 'stil indir';
$lang['xs_install_styles_lc'] = 'stil yükle';

/*
* index.tpl
*/

$lang['xs_main_comment1'] = 'Geliþmiþ Stil ana menüsü. Bir çok özelliðin bulunduðu bu sayfada her fonksiyon adýnýn altýnda kýsa açýklamasý mevcuttur.<br /><br />Not: Bu eklenti phpBB stil ve tema yönetimini yenilemektedir. Standart phpBB fonksiyonlarýný bu listede bulabilirsiniz, fakat bu fonksiyonlar optimize edildi ve yeni özelliklere sahiptir.<br /><br />Bu konuda herhangi bir sorununuz varsa Geliþmiþ Stil (eXtreme Styles) <a href="http://www.phpbbstyles.com" target="_blank">Destek Forumu</a> \'nu ziyaret edin.';
$lang['xs_main_comment2'] = 'Geliþmiþ Stil yöneticinin stil dosyalarýný saklamasýný saðlamaktadýr. stiller küçük sýkýþtýrýlmýþ dosyalar halinde saklanmaktadýr, bu iþlem ile bir sürü dosyanýn yüklenip indirilirken meydana gelebilecek sorunlarýn önüne geçilmektedir. Stil dosyalarý sýkýþtýrýlmýþtýr bunlarý indirmek sýkýþtýrýlmamýþ dosyalarý indirmektan daha kolaydýr.';
$lang['xs_main_comment3'] = 'phpBB stil yönetiminin bütün özellikleri Geliþmiþ Stil eklentisi ile birlikte yenilendi.<br /><br />Menüyü görmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_main_title'] = 'Geliþmiþ Stil ayar menüsü';
$lang['xs_menu'] = 'Geliþmiþ Stil Menüsü';

$lang['xs_manage_styles'] = 'Stilleri Yönet';
$lang['xs_import_export_styles'] = 'Stil Al/Ver';
$lang['xs_install_uninstall_styles'] = 'Stil Yükle/Kaldýr';
$lang['xs_edit_templates'] = 'Temalarý Düzenle';
$lang['xs_other_functions'] = 'Diðer Fonksiyonlar';

$lang['xs_configuration'] = 'Ayarlar';
$lang['xs_configuration_explain'] = 'Bu özellik Geliþmiþ Stil ayarlarýný deðiþtirebilmenizi saðlar.';
$lang['xs_default_style'] = 'Varsayýlan Stil';
$lang['xs_default_style_explain'] = 'Bu özellik varsayýlan pano stilini deðiþtirip kullanýcýlarýn stilden stile geçebilmelerini saðlar.';
$lang['xs_manage_cache'] = 'Önbelliði Yönet';
$lang['xs_manage_cache_explain'] = 'Bu özellik önbelleði yönetmenizi saðlar.';
$lang['xs_import_styles'] = 'Stil Al';
$lang['xs_import_styles_explain'] = 'Bu özellik .style dosyalarýný indirip yüklemenizi saðlar.';
$lang['xs_export_styles'] = 'Stil Ver';
$lang['xs_export_styles_explain'] = 'Bu özellik panonuzdan bir stili .style olarak kaydedip kolayca baþka bir web sitesine ya da panoya transfer etmenizi saðlar.';
$lang['xs_clone_styles'] = 'Stil Çoðalt';
$lang['xs_clone_styles_explain'] = 'Bu özellik stil ya da temalarýn kolayca kopyalarýný çýkarmanýzý saðlar.';
$lang['xs_download_styles'] = 'Stil Ýndir';
$lang['xs_download_styles_explain'] = 'Bu özellik stilleri web sitesinden kolayca yükleyip kurmanýzý saðlar. Web sitelerinin listesini siz ayarlayabilirsiniz.';
$lang['xs_install_styles'] = 'Stil Yükle';
$lang['xs_install_styles_explain'] = 'Bu özellik panonuza yüklenen stilleri kurmanýzý saðlar.';
$lang['xs_uninstall_styles'] = 'Stil Kaldýr';
$lang['xs_uninstall_styles_explain'] = 'Bu özellik panonuzdaki stilleri kaldýrmanýzý/silmenizi saðlar.';
$lang['xs_edit_templates_explain'] = 'Bu özellik tpl dosyalarýný çevrimiçi halde düzenlemenizi saðlar.';
$lang['xs_edit_styles_data'] = 'Stil Verisini Düzenle';
$lang['xs_edit_styles_data_explain'] = 'Bu özellik stillerin deðiþkenlerini düzenlemenizi saðlar. Bu özellik bazý stillerde kullanýlýr, fakat çoðu stil bunlarýn yerine css dosyasý kullanýr';
$lang['xs_export_styles_data'] = 'Stil Verisini Ver';
$lang['xs_export_styles_data_explain'] = 'Bu özellik stil deðiþkenlerini theme_info.cfg dosyasýna kaydetmenizi saðlar.';
$lang['xs_check_for_updates'] = 'Yeni Sürümü Denetle';
$lang['xs_check_for_updates_explain'] = 'Bu özellik yüklü olan ve güncelleme özelliðini destekleyen modlarýn ve temalarýn güncel sürümlerini kontrol edebilmenizi saðlar.';

$lang['xs_set_configuration_lc'] = 'ayarlarý belirle';
$lang['xs_set_default_style_lc'] = 'varsayýlan stili belirle';
$lang['xs_manage_cache_lc'] = 'önbelleði yönet';
$lang['xs_import_styles_lc'] = 'stil al';
$lang['xs_export_styles_lc'] = 'stil ver';
$lang['xs_clone_styles_lc'] = 'stil çoðalt';
$lang['xs_uninstall_styles_lc'] = 'stil kaldýr';
$lang['xs_edit_templates_lc'] = 'tema düzenle';
$lang['xs_edit_styles_data_lc'] = 'stil verisini düzenle';
$lang['xs_export_styles_data_lc'] = 'stil verisini ver';
$lang['xs_check_for_updates_lc'] = 'yeni sürümü denetle';

/*
* ftp.tpl, ftp functions
*/

$lang['xs_ftp_comment1'] = 'Bu özelliði kullanabilmeniz için dosya yükleme metodunuzu seçmeniz gerekmektedir. FTP metodunu seçerseniz þifreler saklanmayacaktýr. Geliþmiþ Stil her baðlantý kurduðunda sizden þifre isteyecektir. Lokal dosya sistemini seçerseniz bütün gerekli dosyalarýn yazýlabilir olmasý lazým.';
$lang['xs_ftp_comment2'] = 'Bu özelliði kullanabilmek için FTP ayarlarýnýzý yapmalýsýnýz. FTP þifreniz saklanmayacaktýr. FTP ile iletiþime geçecek fonksiyonu her seferinizde çalýþtýrdýðýnýzda Geliþmiþ Stil size FTP þifrenizi soracaktýr';
$lang['xs_ftp_comment3'] = 'Uyarý: FTP fonksiyonu bu sunucu üzerinde kapatýlmýþ. Geliþmiþ Stil\'in FTP fonksiyonunu kullanamayacaksýnýz.';

$lang['xs_ftp_title'] = 'FTP ayarlarý';

$lang['xs_ftp_explain'] = 'FTP yeni stillerin yükleme iþleminde kullanýlmaktadýr. Stil alma özelliðini kullanmak istiyorsanýz FTP ayarlarýnýzý yapmalýsýnýz. Geliþmiþ Stil; eðer mümkünse, ayarlarý otomatik algýlayýp düzenlemeye çalýþýcaktýr.';

$lang['xs_ftp_error_fatal'] = 'Bu sunucuda FTP fonksiyonlarýna izin verilmiyor. Devam edilemiyor.';
$lang['xs_ftp_error_connect'] = 'FTP hatasý: {HOST} sunucusuna baðlanýlamadý';
$lang['xs_ftp_error_login'] = 'FTP hatasý: giriþ yapýlamadý';
$lang['xs_ftp_error_chdir'] = 'FTP hatasý: {DIR} dizini deðiþtirilemedi';
$lang['xs_ftp_error_nonphpbbdir'] = 'FTP hatasý: geçersiz bir dizin ayarladýnýz. Dizinde phpBB ile ilgili dosya yok.';
$lang['xs_ftp_error_noconnect'] = 'FTP sunucuya baðlanýlamadý';
$lang['xs_ftp_error_login2'] = 'FTP kullanýcý adý veya þifresi geçersiz';

$lang['xs_ftp_log_disabled'] = 'Bu sunucuda FTP fonksiyonlarýna izin verilmiyor. Devam edilemiyor.';
$lang['xs_ftp_log_connecting'] = 'baðlanýlan sunucu {HOST}';
$lang['xs_ftp_log_noconnect'] = '{HOST} sunucuya baðlanýlamadý ';
$lang['xs_ftp_log_connected'] = 'baðlandý. giriþ yapýldý...';
$lang['xs_ftp_log_nologin'] = '{USER} ile giriþ yapýlamadý';
$lang['xs_ftp_log_loggedin'] = 'giriþ yapýldý';
$lang['xs_ftp_log_end'] = 'programýn çalýþmasý sona erdi';
$lang['xs_ftp_log_nopwd'] = 'hata: Dizine ulaþýlamadý';
$lang['xs_ftp_log_nomkdir'] = 'hata: {DIR} dizini oluþturulamadý ';
$lang['xs_ftp_log_mkdir'] = '{DIR} dizini oluþturuldu';
$lang['xs_ftp_log_nochdir'] = 'hata: {DIR} dizinine geçilemedi';
$lang['xs_ftp_log_normdir'] = 'hata: {DIR} dizini silinemedi';
$lang['xs_ftp_log_rmdir'] = '{DIR} dizini silindi';
$lang['xs_ftp_log_chdir'] = '{DIR} dizinine geçilemedi';
$lang['xs_ftp_log_noupload'] = 'hata: {FILE} dosyasý yüklenemedi';
$lang['xs_ftp_log_upload'] = '{FILE} dosyasý yüklendi';
$lang['xs_ftp_log_nochmod'] = 'uyarý: {FILE} dosyasýnýn chmod ayarlarý yapýlamadý';
$lang['xs_ftp_log_chmod'] = '{FILE} dosyasý için chmod ayarlarý {MODE} þekline ayarlandý';
$lang['xs_ftp_log_invalidcommand'] = 'hata: geçersiz komut: {COMMAND}';
$lang['xs_ftp_log_chdir2'] = 'Þimdiki dizini þununla deðiþtiriyor {DIR}';
$lang['xs_ftp_log_nochdir2'] = '{DIR} dizini deðiþtirilemedi';

$lang['xs_ftp_config'] = 'FTP Ayarlarý';
$lang['xs_ftp_select_method'] = 'Yükleme metodunu seçin';
$lang['xs_ftp_select_local'] = 'Yerel Dosya Sistemini Kullan (ayar gerekmiyor)';
$lang['xs_ftp_select_ftp'] = 'FTP kullan (FTP ayarlarýnýzý yapýn)';

$lang['xs_ftp_settings'] = 'FTP Ayarlarý';
$lang['xs_ftp_host'] = 'FTP Sunucusu';
$lang['xs_ftp_login'] = 'FTP Kullanýcýsý';
$lang['xs_ftp_path'] = 'FTP phpBB yolu';
$lang['xs_ftp_pass'] = 'FTP Þifresi';
$lang['xs_ftp_remotedir'] = 'Uzak Dizin';

$lang['xs_ftp_host_guess'] = ' (muhtemelen "{HOST}" [<a href="javascript: void()" onclick="{CLICK}">host ayarla</a>])';
$lang['xs_ftp_login_guess'] = ' (muhtemelen "{LOGIN}" [<a href="javascript: void()" onclick="{CLICK}">host ayarla</a>])';
$lang['xs_ftp_path_guess'] = ' (muhtemelen "{PATH}" [<a href="javascript: void()" onclick="{CLICK}">yol ayarla</a>])';

/*
* config.tpl
*/

$lang['xs_config_updated'] = 'Ayarlar güncellendi.';
$lang['xs_config_updated_explain'] = 'Yeni ayarlarýn etkin olabilmesi için sayfayý yenilemelisiniz. Sayfayý yenilemek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_config_warning'] = 'Uyarý: Önbelleðe yazýlamýyor.';
$lang['xs_config_warning_explain'] = 'Önbellek dizinine yazýlamýyor. Geliþmiþ Stil bu sorunu çözmeye çalýþacak. Önbellek dizinine baðlantý þeklini deðiþtirmek için<br /><a href="{URL}">buraya</a> týklayýn.<br /><br /> Önbellekleme sizin sunucunuzda çalýþmazsa endiþelenmeyin, Geliþmiþ Stil önbellekleme olmadan da defalarca panonuzun hýzýný arttýrabilir.';

$lang['xs_config_maintitle'] = 'Geliþmiþ Stil Ayarlarý';
$lang['xs_config_subtitle'] = 'Bu Geliþmiþ Stil ayar menüsüdür. Seçeneklerin neleri deðiþtirdiðini bilmiyorsanýz ayarlarla oynamayýn.';
$lang['xs_config_title'] = 'Geliþmiþ Stil v{VERSION} Ayarlarý';
$lang['xs_config_cache'] = 'Önbellek Ayarlarý';

$lang['xs_config_navbar'] = 'Sol çerçevede göster:';
$lang['xs_config_navbar_explain'] = 'Yönetim panelinde sol çerçevede nelerin gösterileceðini seçebilirsiniz.';

$lang['xs_config_def_template'] = 'Varsayýlan tema dizin';
$lang['xs_config_def_template_explain'] = 'Gerekli bir tpl dosyasý varsayýlan tema dizininde bulanamadýysa (bu phpBB\'nin modlarýný eksik yüklediyseniz olur) tema sistemi o dosyayý bulmak için diðer temalarýn içine de bakacaktýr, bu özelliði kapamak için boþ býrakýn.';

$lang['xs_config_check_switches'] = 'Derlerken deðiþiklikleri kontrol et';
$lang['xs_config_check_switches_explain'] = 'Bu özellik temalarý hatalara karþý kontrol eder. Kapamak derlemeyi hýzlandýrýr, eðer hata varsa, derleyici derleme iþlemini yaparken hatalarý görmezden gelebilir.<br /><br />Geliþmiþ kontrol sistemi temalarý otomatik kontrol eder ve bilinen hatalarý düzeltmeye çalýþýr (farklý modlar için farklý hatalar vardýr). Basit kontrol sisteminden biraz daha yavaþ çalýþýr.<br /><br />Bazen hata kontrol sistemi kapatýldýðýnda temalar daha güzel durmaktadýr. Bu kötü þekilde html kodlamasýndan meydana gelmektedir (tema için). Hatalarý düzeltmek istiyorsanýz tpl dosyasýnýn kimin yazdýðýný bulup irtibata geçin.<br /><br />Önbellek özelliði kapatýldýysa hýzlý bir derleme için bu özelliði de kapatýn.';
$lang['xs_config_check_switches_0'] = 'Kapalý';
$lang['xs_config_check_switches_1'] = 'Geliþmiþ';
$lang['xs_config_check_switches_2'] = 'Basit';

$lang['xs_config_show_errors'] = 'Eðer dosyalar hatalý tpl dosyalarý içeriyorsa hatalarý göster';
$lang['xs_config_show_error_explain'] = 'Bu özellik tpl dosyalarýndaki yanlýþ kullanýmdan dolayý oluþan hatalarý göstermektedir. &lt;!-- INCLUDE filename --&gt;';

$lang['xs_config_tpl_comments'] = 'HTML içine tpl dosya adlarýný koy';
$lang['xs_config_tpl_comments_explain'] = 'Bu özellik HTML içine açýklama koyarak hangi tpl dosyalarýnýn gösterildiðini stil tasarýmcýlarýnýn görmesini saðlamaktadýr.';

$lang['xs_config_use_cache'] = 'Önbelleði kullan';
$lang['xs_config_use_cache_explain'] = 'Önbellek disk alanýna kaydedilir, bu temalarý hýzlandýracaktýr çünkü her defasýnda temalarýn derlenmesine gerek kalmaz.';

$lang['xs_config_auto_compile'] = 'Önbelleði otomatik kaydet';
$lang['xs_config_auto_compile_explain'] = 'Bu özellik önbelleðe alýnmamýþ temalarý otomatik derleyerek önbellek dizinine kayýt eder.';

$lang['xs_config_auto_recompile'] = 'Otomatik önbellek derlemesi';
$lang['xs_config_auto_recompile_explain'] = 'Eðer bir temada bir deðiþiklik yapýldýysa bu özellik bunlarý otomatik derler.';

$lang['xs_config_php'] = 'Önbelleðe alýnan dosyalarýn uzantýlarý';
$lang['xs_config_php_explain'] = 'Bu önbelleðe alýnan dosyalarýn uzantýlarýdýr. Dosyalar varsayýlan olarak php formatýnda saklanýr.';

$lang['xs_config_back'] = 'Ayarlara dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_config_sql_error'] = 'Genel ayarlarýn güncelleþtirilmesi {VAR} durumu için baþarýsýz oldu.';

// Debug info
$lang['xs_debug_header'] = 'Onarma bilgisi';
$lang['xs_debug_explain'] = 'Onarma bilgisi önbellek ayarlanýrken hatalarýn bulunup çözümlenmesinde kullanýlmaktadýr.';
$lang['xs_debug_vars'] = 'Tema deðiþkenleri';
$lang['xs_debug_tpl_name'] = 'Tema adý:';
$lang['xs_debug_cache_filename'] = 'Önbellek adý:';
$lang['xs_debug_data'] = 'Onarma verisi:';

$lang['xs_check_hdr'] = 'Önbelleði %s için kontrol ediyor';
$lang['xs_check_filename'] = 'Hata: geçersiz dosya adý';
$lang['xs_check_openfile1'] = 'Hata: Dosyayý açamýyor "%s". Dizini oluþturmaya çalýþacak ...';
$lang['xs_check_openfile2'] = 'Hata: Dosyayý açamýyor "%s" 2. deneme . Sonuç Baþarýsýz...';
$lang['xs_check_nodir'] = 'Kontrol ediyor "%s" - böyle bir dizin yok.';
$lang['xs_check_nodir2'] = 'Hata: Dizini oluþturamýyor "%s" - Dosya izinlerini kontrol etmeniz gerekiyor.';
$lang['xs_check_createddir'] = 'Oluþturulan dizin "%s"';
$lang['xs_check_dir'] = 'Kontrol ediliyor "%s" - dizin mevcut.';
$lang['xs_check_ok'] = 'Yazmak için dosya açýldý "%s" herþey tamam görünüyor.';
$lang['xs_error_demo_edit'] = 'Ön izleme modunda dosya deðiþikliði yapamazsýnýz';
$lang['xs_error_not_installed'] = 'Geliþmiþ Stil yüklenemedi. includes/template.php dosyasýný atmayý unutmayýn';

/*
* chmod
*/

$lang['xs_chmod'] = 'CHMOD';
$lang['xs_chmod_return'] = '<br /><br />Ayarlara dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_chmod_message1'] = 'Ayarlar deðiþtirildi.';
$lang['xs_chmod_error1'] = 'Önbellek dizinine baðlantý tarzýný deðiþtiremiyor';


/*
* default style
*/

$lang['xs_def_title'] = 'Varsayýlan Stil Yap';
$lang['xs_def_explain'] = 'Bu özellik kullanýcýlarýn stilleri kolayca deðiþtirebilmelerini saðlamaktadýr';

$lang['xs_styles_set_default'] = 'varsayýlan yap';
$lang['xs_styles_no_override'] = 'kullanýcý ayarlarýný gözardý etme';
$lang['xs_styles_do_override'] = 'kullanýcý ayarlarýný gözardý et';
$lang['xs_styles_switch_all'] = 'tüm kullanýcýlar için bu stili ayarla';
$lang['xs_styles_switch_all2'] = 'Tüm kullanýcýlar için:';
$lang['xs_styles_defstyle'] = 'varsayýlan stil';
$lang['xs_styles_available'] = 'Varolan Stiller';
$lang['xs_styles_make_public'] = 'stili herkes kullanabilsin';
$lang['xs_styles_make_admin'] = 'stili sadece yönetici kullanabilsin';
$lang['xs_styles_users'] = 'kullananlar';


/*
* cache management
*/

$lang['xs_manage_cache_explain2'] = 'Bu özellik stiller için önbelleðe alýnmýþ dosyalarý derlemeye ve silmeye yarar.';
$lang['xs_clear_all_lc'] = 'hepsini temizle';
$lang['xs_compile_all_lc'] = 'hepsini derle';
$lang['xs_clear_cache_lc'] = 'önbelleði temizle';
$lang['xs_compile_cache_lc'] = 'önbelleði derle';
$lang['xs_cache_confirm'] = 'Eðer çok fazla temanýz varsa sunucunuzun yüklenmesine sebep olabilir. Devam etmek istiyor musunuz?';

$lang['xs_cache_nowrite'] = 'Hata: Önbellek diziniyle baðlantý kurulamýyor';
$lang['xs_cache_log_deleted'] = 'Silindi: {FILE}';
$lang['xs_cache_log_nodelete'] = 'Hata: {FILE} dosyasý silinemiyor';
$lang['xs_cache_log_nothing'] = '<b>{TPL}</b> temasý için silinecek bir þey yok';
$lang['xs_cache_log_nothing2'] = 'Önbellek dizininde silinecek bir þey yok';
$lang['xs_cache_log_count'] = 'Silindi: <b>{NUM}</b> dosya';
$lang['xs_cache_log_count2'] = 'Silerken hata: <b>{NUM}</b> dosya';
$lang['xs_cache_log_compiled'] = 'Derlendi: <b>{NUM}</b> dosya';
$lang['xs_cache_log_errors'] = 'Hata: <b>{NUM}</b>';
$lang['xs_cache_log_noaccess'] = 'Hata: {DIR} dizini ile baðlantý kurulamýyor';
$lang['xs_cache_log_compiled2'] = 'Derlendi: {FILE}';
$lang['xs_cache_log_nocompile'] = 'Derlerken hata: {FILE}';

/*
* export/import/download/clone
*/

$lang['xs_import_explain'] = 'Bu özellik stilleri almanýzý saðlamaktadýr. Ayrýca stilleri otomatik indirip kurabilmektedir.<br /><br /><b>Not:</b> Eðer panonuza herhangi bir mod yüklediyseniz (Geliþmiþ Stil haricinde) stilleri yüklerken dikkatli olmalýsýnýz. Panonuzla uyumlu olmayabilirler. Yalnýzca panonuzda yaptýðýnýz deðiþikliklere sahip stilleri kullanýn.';

$lang['xs_import_lc'] = 'al';
$lang['xs_list_files_lc'] = 'dosya listesi';
$lang['xs_delete_file_lc'] = 'dosya sil';
$lang['xs_export_style_lc'] = 'stil ver';

$lang['xs_import_no_cached'] = 'Yüklenecek önbelleðe alýnmýþ stil yok';
$lang['xs_add_styles'] = 'Stil Ekle';
$lang['xs_add_styles_web'] = 'Web\'ten indir';
$lang['xs_add_styles_web_get'] = 'Ýndir';
$lang['xs_add_styles_copy'] = 'Yerel dosyadan kopyala';
$lang['xs_add_styles_copy_get'] = 'Kopyala';
$lang['xs_add_styles_upload'] = 'Bilgisayarýnýzdan yükleyin';
$lang['xs_add_styles_upload_get'] = 'Yükle';

$lang['xs_export_style'] = 'Stil Ver';
$lang['xs_export_style_explain'] = 'Bu özellik stilleri tek bir dosya halinde göndermenizi saðlar. Bu tek dosya gzip ile sýkýþtýrýlmýþ ve bir zip dosyasýndan boyut olarak daha küçüktür. Diðer bütün stiller tek dosya halindedir, böylece bir panodan diðer panoya stil transfer etmek çok kolaydýr.<br /><br />Bu özellik bir stili bir panodan baþka bir panoya hiç elle kopyalamadan transfer etmenizi saðlamaktadýr.';

$lang['xs_export_style_title'] = 'Tema Ver {TPL}';
$lang['xs_export_tpl_name'] = 'Verilecek tema';
$lang['xs_export_style_names'] = 'Verilecek stil(leri) seçin';
$lang['xs_export_style_name'] = 'Verilecek stil';
$lang['xs_export_style_comment'] = 'Yorum';
$lang['xs_export_where'] = 'Nereye verilecek';
$lang['xs_export_where_download'] = '<b>Dosya olarak indir</b>';
$lang['xs_export_where_store'] = '<b>Dosyalarý sunucuda depola</b>';
$lang['xs_export_where_store_dir'] = 'Dizin';
$lang['xs_export_where_ftp'] = '<b>FTP yolu ile yükle</b>';
$lang['xs_export_filename'] = 'Verilecek dosya adý';

$lang['xs_download_explain2'] = 'Bu özellik stilleri baþka bir web sitesinden kolayca indirip kurmanýzý saðlamaktadýr. Site isminin yanýndaki linke týklayýn böylece stil indirme sayfasýna yönlendiriliceksiniz.<br /><br />Ayrýca buradan web sitelerinin listesini yönetebilirsiniz.';

$lang['xs_download_locations'] = 'Ýndirme Yeri';
$lang['xs_edit_link'] = 'Link Düzenle';
$lang['xs_add_link'] = 'Link Ekle';
$lang['xs_link_title'] = 'Link Baþlýðý';
$lang['xs_link_url'] = 'Link URL';
$lang['xs_delete'] = 'Sil';

$lang['xs_style_header_error_file'] = 'lokal dosyayý açamýyor';
$lang['xs_style_header_error_server'] = 'sunucuda hata: ';
$lang['xs_style_header_error_invalid'] = 'Geçersiz dosya baþlýðý';
$lang['xs_style_header_error_reason'] = 'Dosya baþlýðýný okurken hata: ';
$lang['xs_style_header_error_incomplete'] = 'Dosya tamamlanmamýþ';
$lang['xs_style_header_error_incomplete2'] = 'Geçersiz dosya boyutu. Büyük olasýlýkla dosya tamamlanmamýþ.';
$lang['xs_style_header_error_invalid2'] = 'Geçersiz dosya. Büyük olasýlýkla dosya Geliþmiþ Stil sistemi ile uyumlu bir stil deðil ya da geçersiz bir sürüm.';
$lang['xs_error_cannot_open'] = 'Dosya açýlamadý.';
$lang['xs_error_decompress_style'] = 'Dosyayý açarken hata oluþtu büyük olasýlýkla dosya bozuk.';
$lang['xs_error_cannot_create_file'] = '{FILE} dosyasý oluþturulamadý.';
$lang['xs_error_cannot_create_tmp'] = '{FILE} geçici dosyasý oluþturulamýyor.';
$lang['xs_import_invalid_file'] = 'Geçersiz Dosya';
$lang['xs_import_incomplete_file'] = 'Tamamlanmamýþ dosya';
$lang['xs_import_uploaded'] = 'Stil yerleþtirildi.';
$lang['xs_import_installed'] = 'Stil yerleþtirildi ve yüklendi.';
$lang['xs_import_notinstall'] = 'Stil yerleþtirildi, yüklemede hata oluþtu: sql hatasý.';
$lang['xs_import_notinstall2'] = 'Stil yerleþtirildi, yüklemede hata oluþtu: theme_info.cfg dosyasýnda stil bulunamadý.';
$lang['xs_import_notinstall3'] = 'Stil yerleþtirildi, yüklemede hata oluþtu: theme_info.cfg dosyasýnda "{STYLE}" için hiç bir giriþ bulunamadý.';
$lang['xs_import_notinstall4'] = 'Stil yerleþtirildi, yüklemede hata oluþtu: sonraki themes_id bilgisi alýnamýyor.';
$lang['xs_import_notinstall5'] = 'Stil yerleþtirildi, yüklemede hata oluþtu: stil tablosu güncelleþtirilemiyor.';
$lang['xs_import_nodownload'] = 'Stil {URL} adresinden indirilemiyor ';
$lang['xs_import_nodownload2'] = 'Stil {URL} adresinden kopyalanamýyor';
$lang['xs_import_nodownload3'] = 'Dosya indirilemedi.';
$lang['xs_import_uploaded2'] = 'Stil indirildi, þimdi alabilirsiniz.<br /><br />almak için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_import_uploaded3'] = 'Stil kopyalandý, þimdi alabilirsiniz.<br /><br />almak için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_import_uploaded4'] = 'Stil yerleþtirildi, þimdi alabilirsiniz.<br /><br />almak için <a href="{URL}">buraya</a> týklayýn..';
$lang['xs_export_no_open_dir'] = '{DIR} dizini açýlamýyor';
$lang['xs_export_no_open_file'] = '{FILE} dosyasý açýlamýyor';
$lang['xs_export_no_read_file'] = '{FILE} dosyasý okunurken hata oluþtu';
$lang['xs_no_theme_data'] = 'Seçilen tema için stil verisi alýnamýyor';
$lang['xs_no_style_info'] = 'Stil bilgisi alýnamýyor';
$lang['xs_export_noselect_themes'] = 'En az bir stil seçmelisiniz';
$lang['xs_export_error'] = '"{TPL}" temasý verilemedi: ';
$lang['xs_export_error2'] = '"{TPL}" stili verilemedi: stil boþ';
$lang['xs_export_saved'] = 'Stil "{FILE}" olarak farklý kaydedildi';
$lang['xs_export_error_uploading'] = 'Dosya yüklemesinde hata';
$lang['xs_export_uploaded'] = 'Dosya yüklendi.';
$lang['xs_clone_taken'] = 'Bu stil adý zaten kullanýlýyor.';
$lang['xs_error_new_row'] = 'Tabloya bir dizi eklenemiyor.';
$lang['xs_theme_cloned'] = 'Stil çoðaltýldý.';
$lang['xs_invalid_style_name'] = 'Geçersiz stil adý.';
$lang['xs_clone_style_exists'] = 'Bu tema zaten var.';
$lang['xs_clone_no_select'] = 'Kopyalamak için en az bir stil seçmelisiniz.';
$lang['xs_no_themes'] = 'Stil veritabanýnda bulunamadý.';

$lang['xs_import_back'] = 'Stil Alma Sayfasýna geri dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_import_back_download'] = 'Ýndirme Sayfasýna geri dönmek için <a href="{URL}" target="main">buraya</a> týklayýn.';
$lang['xs_export_back'] = 'Stil Verme Sayfasýna geri dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_clone_back'] = 'Stil Çoðaltma Sayfasýna geri dönmek için <a href="{URL}">buraya</a> týklayýn..';
$lang['xs_download_back'] = 'Ýndirme Sayfasýna geri dönmek için <a href="{URL}">buraya</a> týklayýn.';

$lang['xs_import_tpl'] = 'Tema Al "{TPL}"';
$lang['xs_import_tpl_comment'] = 'Bu özellik temalarý panonuza yüklemenizi saðlamaktadýr. Eðer ayný isimli bir tema daha varsa panonuzda bu özellik eski dosyalarýn üstüne otomatik yazacaktýr. Böylece bu özellik stilleri otomatik güncelleþtirmek için de kullanýlabilir.<br /><br />Bu özellik ayrýca stilleri otomatik yükleyebilir. Stilleri aldýktan sonra yüklemek istiyorsanýz aþaðýdan bir ya da daha çok stil seçin.';
$lang['xs_import_tpl_filename'] = 'Dosya adý:';
$lang['xs_import_tpl_tplname'] = 'Tema adý:';
$lang['xs_import_tpl_comment2'] = 'Yorum:';
$lang['xs_import_select_styles'] = 'Yüklenecek stil(ler) seçin:';
$lang['xs_import_install_def_lc'] = 'varsayýlan stil yap';
$lang['xs_import_install_style'] = 'Stil Yükle:';
$lang['xs_import'] = 'Al';

$lang['xs_import_list_contents'] = 'Dosya içindekiler: ';
$lang['xs_import_list_filename'] = 'Dosya adý: ';
$lang['xs_import_list_template'] = 'Tema: ';
$lang['xs_import_list_comment'] = 'Yorum: ';
$lang['xs_import_list_styles'] = 'Stil(ler): ';
$lang['xs_import_list_files'] = 'Dosyalar ({NUM}):';
$lang['xs_import_download_lc'] = 'dosyayý indir';
$lang['xs_import_view_lc'] = 'dosyaya bak';
$lang['xs_import_file_size'] = '({NUM} byte)';

$lang['xs_import_nogzip'] = 'Bu özellik gzip sýkýþtýrmasý gerektirir ve gzip sunucunuzda desteklenmiyor görünüyor.';
$lang['xs_import_nowrite_cache'] = 'Önbelleðe yazýlamýyor. Bu özellik önbelleðe yazýlabilmeyi gerektirir. Geliþmiþ Stil ayarlarýný kontrol edin.<br /><br />Önbelleðe yazýlabilmesi için <a href="{URL1}">buraya</a> týklayýn.<br /><br />Yükleme sayfasýna dönmek için<a href="{URL2}">buraya</a> týklayýn.';

$lang['xs_import_download_warning'] = 'Bu özellik sizi baþka bir siteye yönlendiricek, bu site aracýlýðý ile bir kaç týklamayla kolayca stilleri Geliþmiþ Stil modu sayesinde indirebilirsiniz.';

$lang['xs_clone_style'] = 'Stil Çoðalt';
$lang['xs_clone_style_explain'] = 'Bu özellik stil ya da tüm temanýn kopyasýný almayý saðlamaktadýr.<br /><br /><b>Dikkat:</b> temayý kopyalarken tema yapýmcýsýnýn buna izin verdiðine emin olun (tema subsilver ise istediðiniz herþeyi yapabilirsiniz). Genellikle tema yapýmcýlarý temalarýný deðiþtirmenize izin verirler. Fakat deðiþtirilmiþ temalarýn daðýtýmý yasaktýr.';
$lang['xs_clone_style_explain2'] = 'Bu özellik temanýz için yeni bir stil oluþturmanýzý saðlamaktadýr. Bu özellik hiçbir dosyayý kopyalamamaktadýr. Veritabanýna yeni stiliniz için kayýt girmektedir. Yeni ve eski bütün stiller ayný temayý kullanýr.';
$lang['xs_clone_style_explain3'] = 'Oluþturacaðýnýz yeni stilinizin adýný girin ve "Kopyala" buttonuna basýn.';
$lang['xs_clone_style_explain4'] = 'Bu özellik temalarý çoðaltmaya yarar. Ayrýca bu temaya ait bütün stilleri de kopyalayabilirsiniz. Bundan sonra tpl dosyalarýný güvenle düzenleyebilirsiniz, eski ve yeni temalarýnýz etkilenmeyecektir.';

$lang['xs_clone_style_lc'] = 'stil çoðalt';
$lang['xs_clone_style2'] = 'Stil çoðalt "{STYLE}":';
$lang['xs_clone_style3'] = 'Tema çoðalt "{STYLE}"';
$lang['xs_clone_newdir_name'] = 'Yeni tema (dizin) adý:';
$lang['xs_clone_select'] = 'Çoðlatmak için stil(ler) seçiniz:';
$lang['xs_clone_select_explain'] = 'En az bir stil seçmelisiniz.';
$lang['xs_clone_newname'] = 'Yeni stil adý:';


/*
* install/uninstall
*/
$lang['xs_install_styles_explain2'] = 'Panonuza yüklenen ancak kurulmayan stillerin listesidir. Seçtiðiniz stilleri Yükle butonuna basarak kurabilirsiniz. Tek bir stil kurmak için stil adý yanýndaki yükle baðýna týklayýnýz.';
$lang['xs_uninstall_styles_explain2'] = 'Panonuza yüklenen stillerin bir listesidir. "kaldýr" baðýna týklayarak panonuzdan stilleri kaldýrabilirsiniz. Stilleri kaldýrmak güvenlidir. Kaldýrdýðýnýz stili kullanan kullanýcýlar, stil silindikten sonra varsayýlan stili kullanmaya baþlarlar ve silme iþlemi sýrasýnda bu stil için olan önbellek otomatik silinir.';

$lang['xs_install'] = 'Yükle';
$lang['xs_install_lc'] = 'yükle';
$lang['xs_uninstall'] = 'Kaldýr';
$lang['xs_remove_files'] = 'Dosyalarý Sil';
$lang['xs_style_removed'] = 'Stil silindi.';
$lang['xs_uninstall_lc'] = 'kaldýr';
$lang['xs_uninstall2_lc'] = 'kaldýr ve dosyalarý sil';

$lang['xs_install_back'] = 'Stil Yüklemesine dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_uninstall_back'] = 'Stil Kaldýrmasýna dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_goto_default'] = 'Varsayýlan stili deðiþtirmek için <a href="{URL}">buraya</a> týklayýn.';

$lang['xs_install_installed'] = 'Stil(ler) yüklendi.';
$lang['xs_install_error'] = 'Stil yüklemesinde hata.';
$lang['xs_install_none'] = 'Yüklenecek yeni stil yok. Bütün kullanýlabilir stiller yüklü.';

$lang['xs_uninstall_default'] = 'Varsayýlan stili silemezsin. Varsayýlan stili deðiþtirmek için <a href="{URL}">buraya</a> týklayýn.';

/*
* export theme_info.cfg
*/
$lang['xs_export_styles_data_explain2'] = 'Bu özellik stil verisini theme_info.cfg dosyasýna yazmaktadýr. Bu özellik; stil bir panodan diðerine transfer edilmeden önce veritabaný bilgisini saklamaya yarar.<br /><br /><b>Not:</b> Geliþmiþ Stil verme özelliðini kullanýyorsanýz stil bilgisini theme_info.cfg dosyasýna kaydetmenize gerek yok. Bu iþlem Geliþmiþ Stil tarafýndan otomatik yapýlmaktadýr.';
$lang['xs_export_styles_data_explain3'] = 'Göndermek istediðiniz stilleri seçin.';

$lang['xs_export_data_back'] = 'Stil Verisini Verme Yönetimine dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_export_style_data_lc'] = 'stil verisini ver';

$lang['xs_export_data_saved'] = 'Veri verildi.';

/*
* edit templates (file manager)
*/
$lang['xs_edit_template_comment1'] = 'Bu özellik temalarý düzenleyebilmenizi saðlamaktadýr. Dosyaya göz atma seçeneði yalnýzca düzenlenebilir dosyalarý gösterir';
$lang['xs_edit_template_comment2'] = 'Bu özellik temalarý düzenleyebilmenizi saðlamaktadýr.';
$lang['xs_edit_file_saved'] = 'Dosya kayýtlandý.';
$lang['xs_edit_not_found'] = 'Dosya bulunamadý.';
$lang['xs_edittpl_back_dir'] = 'Dosya Yöneticisine dönmek için <a href="{URL}">buraya</a> týklayýn.';

$lang['xs_fileman_browser'] = 'Dosyalara gözat';
$lang['xs_fileman_directory'] = 'Dizin:';
$lang['xs_fileman_dircount'] = 'Dizinler ({COUNT}):';
$lang['xs_fileman_filter'] = 'Filtre';
$lang['xs_fileman_filter_ext'] = 'Þu uzantýya sahip dosyalarý göster:';
$lang['xs_fileman_filter_content'] = 'Þunu içeren dosyalarý göster:';
$lang['xs_fileman_filter_clear'] = 'Filtreyi Temizle';
$lang['xs_fileman_filename'] = 'Dosya adý';
$lang['xs_fileman_filesize'] = 'Boyut';
$lang['xs_fileman_filetime'] = 'Deðiþtirilme';
$lang['xs_fileman_options'] = 'Seçenekler';
$lang['xs_fileman_time_today'] = '(bugün)';
$lang['xs_fileman_edit_lc'] = 'düzen';

$lang['xs_fileedit_search_nomatch'] = 'aradýðýnýz kriterde bir þey bulunamadý';
$lang['xs_fileedit_search_match1'] = '1 sonuç deðiþtirildi';
$lang['xs_fileedit_search_matches'] = "Deðiþtirildi ' + Hesaplandý + ' Eþleþen";
$lang['xs_fileedit_noundo'] = 'Geri döndürülecek hiç bir iþlem yok';
$lang['xs_fileedit_undo_complete'] = 'Eski içerik yüklendi';
$lang['xs_fileedit_edit_name'] = 'Dosya düzenle:';
$lang['xs_fileedit_location'] = 'Yer:';
$lang['xs_fileedit_reload_lc'] = 'dosyayý tekrar yükle';
$lang['xs_fileedit_download_lc'] = 'dosya indir';
$lang['xs_fileedit_trim'] = 'Dosyanýn baþýndaki ve sonundaki boþluklarý otomatik temizle.';
$lang['xs_fileedit_functions'] = 'Fonksiyon Düzenle';
$lang['xs_fileedit_replace1'] = 'Deðiþtir ';
$lang['xs_fileedit_replace2'] = ' ile ';
$lang['xs_fileedit_replace_first_lc'] = 'ilk bulunan sonuç ile deðiþtir';
$lang['xs_fileedit_replace_all_lc'] = 'bütün sonuçlarý deðiþtir';
$lang['xs_fileedit_replace_undo_lc'] = 'yapýlanlarý geri al';
$lang['xs_fileedit_backups'] = 'Yedekleme';
$lang['xs_fileedit_backups_save_lc'] = 'yedekle';
$lang['xs_fileedit_backups_show_lc'] = 'içindekileri göster';
$lang['xs_fileedit_backups_restore_lc'] = 'onar';
$lang['xs_fileedit_backups_download_lc'] = 'indir';
$lang['xs_fileedit_backups_delete_lc'] = 'sil';
$lang['xs_fileedit_upload'] = 'Yükle';
$lang['xs_fileedit_upload_file'] = 'Dosya yükle:';

/*
* edit styles data (theme_info)
*/
$lang['xs_data_head_stylesheet'] = 'CSS þablonu';
$lang['xs_data_body_background'] = 'Arkaplan resmi';
$lang['xs_data_body_bgcolor'] = 'Arkaplan rengi';
$lang['xs_data_style_name'] = 'Stil Adý';
$lang['xs_data_body_link'] = 'Bað rengi';
$lang['xs_data_body_text'] = 'Metin rengi';
$lang['xs_data_body_vlink'] = 'Ziyaret edilen bað rengi';
$lang['xs_data_body_alink'] = 'Aktif bað rengi';
$lang['xs_data_body_hlink'] = 'Üzerine gelme bað rengi';
$lang['xs_data_tr_color'] = 'Tablo dizi rengi %s';
$lang['xs_data_tr_class'] = 'Tablo dizi türü %s';
$lang['xs_data_th_color'] = 'Tablo baþý rengi %s';
$lang['xs_data_th_class'] = 'Tablo baþý türü %s';
$lang['xs_data_td_color'] = 'Tablo hücre dizi rengi %s';
$lang['xs_data_td_class'] = 'Tablo hücre rengi %s';
$lang['xs_data_fontface'] = 'Font türü %s';
$lang['xs_data_fontsize'] = 'Font boyutu %s';
$lang['xs_data_fontcolor'] = 'Font rengi %s';
$lang['xs_data_span_class'] = 'geniþlik türü %s';
$lang['xs_data_img_size_poll'] = 'Anket resminin boyutu [px]';
$lang['xs_data_img_size_privmsg'] = 'Kiþisel mesaj durum boyutu [px]';
$lang['xs_data_theme_public'] = 'Herkese açýk stil (1 veya 0)';
$lang['xs_data_unknown'] = 'Tanýmlama bilgisi yok (%s)';

$lang['xs_edittpl_error_updating'] = 'Stil güncellerken hata.';
$lang['xs_edittpl_style_updated'] = 'Stil güncellendi.';
$lang['xs_invalid_style_id'] = 'Geçersiz stil ID\'si.';

$lang['xs_edittpl_back_edit'] = 'Düzenlemeye geri dönmek için <a href="{URL}">buraya</a> týklayýn.';
$lang['xs_edittpl_back_list'] = 'Stil listesine geri dönmek için <a href="{URL}">buraya</a> týklayýn.';

$lang['xs_editdata_explain'] = 'Bu özellik veritabanýna yüklenmiþ stilleri düzenlemenizi saðlar. Bazý stiller veritabaný deðerlerini görmezden gelir ve css kullanýr bazýlarý da veritabaný deðerlerini kullanýr.';
$lang['xs_editdata_var'] = 'Deðiþken';
$lang['xs_editdata_value'] = 'Deðer';
$lang['xs_editdata_comment'] = 'Yorum';


/*
* updates
*/

$lang['xs_updates'] = 'Güncelleþtirmeler';
$lang['xs_updates_comment'] = 'Bu özellik bazý stil ve modlarýn güncellemeleri kontrol eder. Sadece konu ile ilgili güncelleme bilgileri mevcut ise çalýþýr.';
$lang['xs_updates_comment2'] = 'Sürüm denetimi için sonuçlar.';
$lang['xs_update_total1'] = 'Toplam: <b>{NUM}</b>';
$lang['xs_update_info1'] = 'Bu özellik panonuzda yüklü olan ve güncelleme özelliðini destekleyen modlar ve stillerin güncel sürümlerini kontrol etmeye yarar. Güncel sürüm bulunduðu zaman size güncelleþtirmeleri indirebileceðiniz sitenin adresini gösterecektir.<br /><br />Bu özellik "socket" özelliðinin açýk olmasýný gerektirir. Çoðu bedava alan saðlayýcýlarý bu özelliði size sunmaz, örneðin lycos gibi yerlerde güncelleþtirme özelliðini kullanamayabilirsiniz, fakat panonuz normal bir sunucu üzerindeyse herþey düzgün çalýþacaktýr.<br /><br />"Devam" butonuna týkladýðýnýzda "Geliþmiþ Stil" panonuza yüklü bazý özellikleri kontrol edecektir. Eðer siteniz yavaþsa bu iþlemlerin yapýlmasý uzun bir zaman alabilir. Sabýrlý olun ve tarayýcýnýzdaki dur butonuna basmayýn. Sunucunuz yavaþsa ya da yüklenen içeriðin bulunduðu site yavaþsa iþlem zaman aþýmýna uðrayabilir. Bu gibi durumlarda olursa zaman aþýmý deðerini yükseltin.';
$lang['xs_update_name'] = 'Ýsim';
$lang['xs_update_type'] = 'Tip';
$lang['xs_update_current_version'] = 'Sürümünüz';
$lang['xs_update_latest_version'] = 'Son sürüm';
$lang['xs_update_downloadinfo'] = 'Ýndirme adresi';
$lang['xs_update_timeout'] = 'Güncelleme özelliði zaman aþýmý deðeri (saniye):';
$lang['xs_update_continue'] = 'Devam';

$lang['xs_update_total2'] = 'Hatalar: <b>{NUM}</b>';
$lang['xs_update_total3'] = 'Güncellemeler: <b>{NUM}</b>';
$lang['xs_update_select1'] = 'Güncellemeleri seçin';
$lang['xs_update_types'] = array(
0 => 'Bilinmeyen',
1 => 'Stil',
2 => 'Mod',
3 => 'phpBB'
);
$lang['xs_update_fileinfo'] = 'Daha fazla bilgi';
$lang['xs_update_nothing'] = 'Güncelleþtirecek bir þey yok.';
$lang['xs_update_noupdate'] = 'Son sürümü kullanýyorsunuz.';

$lang['xs_update_error_url'] = 'Hata: %s sitesi bulunamadý';
$lang['xs_update_error_noitem'] = 'Hata: Güncelleme bilgileri bulunamadý';
$lang['xs_update_error_noconnect'] = 'Hata: Güncelleme sunucusuna baðlanýlamadý';

$lang['xs_update_download'] = 'indir';
$lang['xs_update_downloadinfo2'] = 'indir/bilgi';
$lang['xs_update_info'] = 'web sitesi';

$lang['xs_permission_denied'] = 'Ýzniniz Yok';

$lang['xs_download_lc'] = 'indir';
$lang['xs_info_lc'] = 'bilgi';

/*
* style configuration
*/
$lang['Template_Config'] = 'Tema Ayarlarý';
$lang['xs_style_configuration'] = 'Geliþmiþ Tema ayarlarý';

?>