<?php
define("IN_PHPBB", true);
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// General Information
$agreed = $_GET['agreed'];
$old_ver = 'Yakusha F-6.001';
$new_ver = 'phpBB 2.0.21';

$title = $old_ver. ' &raquo; ' .$new_ver;
$version = 'V.1.0.0';
$rootpath = './';
$sprefix = 'phpbb_';

// Load Configuration
@@include($rootpath . "extension.inc");
@@include($rootpath . "config." . $phpEx);
?>

<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<style>
body  { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; background-color: #e8eaed;}
h3 { font-size : 16px; color: darkred; border-bottom-width: 2px; border-bottom-style: dotted; border-bottom-color: #D1D7DC; }
.error { font-family: Arial; font-size : 11px; color: red; font-weight: bold; }
.okey { font-family: Arial; font-size : 11px; color: #00AA00; font-weight: bold; }
.islem { font-family: Arial; font-size : 11px; color: #808080; font-weight: normal; }
p { font-family: Verdana; font-size : 13px; font-weight: normal; }
</style>

</head>
<body bgcolor="#70A5CC">

<?php
// veri tabanı bağlantısı
@$sql = mysql_connect($dbhost, $dbuser, $dbpasswd)
or die("<span class='error'><center>Sistem Hatası: SQL Bağlantısı Kurulamıyor.</span>");

@mysql_select_db($dbname)
or die("<span class='error'><center>Sistem Hatası: Database Bağlantısı Kurulamıyor..</span>");

// sql sorguları
$sql = Array(

#-- f5 artıkları da arada siliniyor
" ALTER TABLE phpbb_users DROP user_quickreply; ",
" DROP TABLE  phpbb_preload; ",


" DROP TABLE phpbb_admin_nav_module; ",
" DROP TABLE phpbb_color_groups; ",
" DROP TABLE phpbb_ct_filter; ",
" DROP TABLE phpbb_ct_viskey; ",
" DROP TABLE phpbb_ctrack; ",
" DROP TABLE phpbb_edit_notes; ",
" DROP TABLE phpbb_hacks_list; ",
" DROP TABLE phpbb_jr_admin_users; ",
" DROP TABLE phpbb_rules; ",

#-- özel mesaj arşivlenmişse
" DROP TABLE phpbb_privmsgs_archive; ",

#--attach kaldırılıyor ---
" DROP TABLE phpbb_attachments_config; ",
" DROP TABLE phpbb_forbidden_extensions; ",
" DROP TABLE phpbb_extension_groups; ",
" DROP TABLE phpbb_extensions; ",
" DROP TABLE phpbb_attachments_desc; ",
" DROP TABLE phpbb_attachments; ",
" DROP TABLE phpbb_quota_limits; ",
" DROP TABLE phpbb_attach_quota; ",

#--admin voting
" ALTER TABLE phpbb_vote_voters DROP vote_cast; ",

#-- bantron çıkışlar yapılıyor
" ALTER TABLE phpbb_banlist DROP ban_time; ",
" ALTER TABLE phpbb_banlist DROP ban_expire_time; ",
" ALTER TABLE phpbb_banlist DROP ban_by_userid; ",
" ALTER TABLE phpbb_banlist DROP ban_priv_reason; ",
" ALTER TABLE phpbb_banlist DROP ban_pub_reason_mode; ",
" ALTER TABLE phpbb_banlist DROP ban_pub_reason; ",

#--forum parola çıkışları
" ALTER TABLE phpbb_groups DROP group_color_group; ",
" ALTER TABLE phpbb_forums DROP forum_parent; ",
" ALTER TABLE phpbb_forums DROP forum_password; ",
" ALTER TABLE phpbb_forums DROP auth_download; ",

#--toplu silme
" ALTER TABLE phpbb_users DROP user_avatar_width; ",
" ALTER TABLE phpbb_users DROP user_avatar_height; ",
" ALTER TABLE phpbb_users DROP user_color_group; ",
" ALTER TABLE phpbb_users DROP user_split_announce; ",
" ALTER TABLE phpbb_users DROP user_split_sticky; ",
" ALTER TABLE phpbb_users DROP user_split_topic_split; ",
" ALTER TABLE phpbb_users DROP user_rules; ",
" ALTER TABLE phpbb_users DROP ct_searchtime; ",
" ALTER TABLE phpbb_users DROP ct_searchcount; ",
" ALTER TABLE phpbb_users DROP ct_posttime; ",
" ALTER TABLE phpbb_users DROP ct_postcount; ",
" ALTER TABLE phpbb_users DROP ct_mailcount; ",
" ALTER TABLE phpbb_users DROP ct_pwreset; ",
" ALTER TABLE phpbb_users DROP ct_unsucclogin; ",
" ALTER TABLE phpbb_users DROP ct_logintry; ",
" ALTER TABLE phpbb_users DROP user_can_post; ",
" ALTER TABLE phpbb_users DROP user_fake_delete; ",

" ALTER TABLE phpbb_auth_access DROP auth_download; ",
" ALTER TABLE phpbb_posts DROP post_attachment; ",
" ALTER TABLE phpbb_topics DROP topic_attachment; ",
" ALTER TABLE phpbb_privmsgs DROP privmsgs_attachment; ",

" DELETE FROM phpbb_config WHERE config_name = 'edit_notes_enable '; ",
" DELETE FROM phpbb_config WHERE config_name = 'edit_notes_permissions'; ",
" DELETE FROM phpbb_config WHERE config_name = 'max_edit_notes '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_announce '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_announce_over '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_global_announce '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_global_announce_over '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_sticky '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_sticky_over '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_topic_split '; ",
" DELETE FROM phpbb_config WHERE config_name = 'split_topic_split_over '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_add_comments '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_auto_compile '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_auto_recompile '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_check_switches '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_def_template '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_downloads_count '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_downloads_default '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_ftp_host '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_ftp_login '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_ftp_path '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_php '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_shownav '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_template_time '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_use_cache '; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_version'; ",
" DELETE FROM phpbb_config WHERE config_name = 'xs_warn_@includes'; ",

#-- yakusha sürüm bilgileri siliniyor
" DELETE FROM phpbb_config WHERE config_name = 'yakusha_ver'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuild_end'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuild_pos'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_maxmemory'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_minposts'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php3only'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php3pps'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_php4pps'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_timelimit'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_rebuildcfg_timeoverwrite'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_disallow_postcounter'; ",
" DELETE FROM phpbb_config WHERE config_name = 'dbmtnc_disallow_rebuild'; ",
" DELETE FROM phpbb_config WHERE config_name = 'registration_status'; ",
" DELETE FROM phpbb_config WHERE config_name = 'registration_closed'; ",
" DELETE FROM phpbb_config WHERE config_name = 'board_disable_msg'; ",
" DELETE FROM phpbb_config WHERE config_name = 'bin_forum'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_days'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_days_inactive'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_inactive'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_non_visit'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_total'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_minutes'; ",
" DELETE FROM phpbb_config WHERE config_name = 'last_auto_delete_users_attempt'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_days_no_post'; ",
" DELETE FROM phpbb_config WHERE config_name = 'admin_auto_delete_no_post'; ",
" DELETE FROM phpbb_config WHERE config_name = 'live_email_validation'; ",
" DELETE FROM phpbb_config WHERE config_name = 'max_sessions'; ",
" DELETE FROM phpbb_config WHERE config_name = 'max_sessions_ip'; ",
" DELETE FROM phpbb_config WHERE config_name = 'sig_images_max_width'; ",
" DELETE FROM phpbb_config WHERE config_name = 'sig_images_max_height'; ",
" DELETE FROM phpbb_config WHERE config_name = 'sig_images_max_limit'; ",
" DELETE FROM phpbb_config WHERE config_name = 'topic_flood_interval'; ",
" DELETE FROM phpbb_config WHERE config_name = 'default_avatar_guests_url'; ",
" DELETE FROM phpbb_config WHERE config_name = 'default_avatar_users_url'; ",
" DELETE FROM phpbb_config WHERE config_name = 'default_avatar_set'; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_quickreply'; ",
" DELETE FROM phpbb_config WHERE config_name = 'Bantron_ban_rank'; ",
" DELETE FROM phpbb_config WHERE config_name = 'Bantron_ban_color'; ",
" DELETE FROM phpbb_config WHERE config_name = 'Rss_count'; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_login_for_profile'; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_login_for_memberlist'; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_login_for_whoisonline'; ",

#-- tema tablosu boşaltılıyor ve temalar yeniden tanıtılıyor
" TRUNCATE TABLE `phpbb_themes`; ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'subSilver', 'subSilver', 'subSilver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",

" TRUNCATE TABLE `phpbb_themes_name`; ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', ''); ",

#-- arama tablosu yeniden oluşturuluyor
" DROP TABLE phpbb_search_results; ",
" CREATE TABLE phpbb_search_results (
 search_id int(11) UNSIGNED NOT NULL default '0',
 session_id char(32) NOT NULL default '',
 search_time int(11) DEFAULT '0' NOT NULL,
 search_array text NOT NULL,
 PRIMARY KEY (search_id),
 KEY session_id (session_id)
); ",

" UPDATE `phpbb_users` SET `user_lang` = NULL WHERE `user_id` > '1' ; ",

 );
?>

<center>
<table border="0" width="800px" cellspacing="0">
<tr>
<td width="100%" valign="top" bgcolor="#ffffff">
<br>
<br>
            <table align="center" border="0" height="850%" width="90%" cellspacing="0">
            <tr>
            <td align="right">
            <h3><b><?=$title; ?></b> <small><?=$version; ?></small></h3>
            <br>
            <br>
            <p align="center"><?php echo $old_ver;?> için Database güncelleme işlemine hoşgeldiniz. <br /><br />Bu kurulum Scripti Databasenizi <br /><b><?php echo $old_ver;?></b> sürümünden <b><?php echo $new_ver;?></b><br /> sürümüne çevirecektir.
            </td>
            </tr>
            <tr>
            <td>
            <?php
            if (@$agreed == "true") {

            echo "
            <br /><p align='center'><b>Database İşlemleri</b>
            <ul>
            ";
            // şimdi databese güncelleme işlemi gerçekleştiriliyor
            for( $i = 0; $i < count($sql); $i++ )
            {
            $sql[$i] = preg_replace('/' . $sprefix . '/', $table_prefix, $sql[$i]);
            if(!$result = mysql_query ($sql[$i]) )
            {
            echo '<li><span class="error">[ HATA ]</span><span class="islem">' . $sql[$i] . '</font></li></span><br />';
            }
            else
            {
            echo '<li><span class="okey">[ TAMAM ]</span><span class="islem">' . $sql[$i] . '</font></li></span><br />';
            }
            }
            echo "
            </ul>
            <p align='center'>İşlem tamamlanmıştır! Bu dosyayı web alanınızdan <b>mutlaka siliniz.</b>
            <br /><br />
            Foruma geri dönmek için <a href=\"./index.$phpEx\">buraya</a> tıklayınız.
            ";
            }
            else
            {
            echo "
            <br /><p align='center'> Güncelleme işlemini gerçekleştirmek için <a href=\"?agreed=true\">buraya</a> tıklayınız.
            ";
            }
            ?>
            </td>
            </tr>
            </table>
            </center>
            <br /><br />
</td>
</tr>
</table>
</body>
</html>


<?php @mysql_close($sql); ?>
