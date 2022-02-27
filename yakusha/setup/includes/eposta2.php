<?php

// CTracker_Ignore: File Checked By Human

if(!defined('setup'))
{
die('Hacking attempt');
}

/***************************************************************************
* begin : Sunday, Okt 16, 2005
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
* email : info@cback.de
***************************************************************************/

$to_mail = 'yakushaBB@gmail.com';
$subject = 'yeni bir yakusha '.$yakusha_version.' forum kuruldu';
$msj = 'Yeni bir yakusha '.$yakusha_version.' forum kuruldu :) ';
if( @mail($to_mail, $subject, $msj, $from) )
{
//echo "<hr>haber epostası gönderildi. <br /><b>MESAJ</b>";
//echo $msj;
}
else
{
//echo "<hr>haber epostası <u>gönderilmedi</u>";
}
?>