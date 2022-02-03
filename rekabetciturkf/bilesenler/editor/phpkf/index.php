<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('PHPKF_ICINDEN')) exit();


// Varsayılan değişkenler
if (!isset($duzenleyici_id)) $duzenleyici_id = 'mesaj_icerik';

if (!isset($duzenleyici_textarea)) $duzenleyici_textarea = '<textarea cols="69" rows="27" name="mesaj_icerik" id="mesaj_icerik" class="formlar_mesajyaz">{FORM_ICERIK}</textarea>';

$postimage = "window.open('https://postimage.org/mini.php?mode=phpbb&areaid=0&hash=1&lang=turkish&code=hotlink&content=family&forumurl='+escape('$TEMA_SITE_ANADIZIN'),'_imagehost','resizable=yes,width=500,height=400')";


// ifade javascript kodları yükleniyor
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';


// Düzenleyici tek defa yükleniyor
if (!isset($duzenleyici_yukle))
{
	echo '<script src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/phpkf.js" type="text/javascript"></script>';
}


// simge font yükleniyor
if ($ayarlar['duzenleyici_font'] != '')
{
	echo '<link href="'.$ayarlar['duzenleyici_font'].'" rel="stylesheet" type="text/css">';
}


// düğme ve varsayılan şablon yükleniyor
echo '<script src="'.$duzenleyici_dizin.'bilesenler/diller/'.$site_dili.'/javascript.js" type="text/javascript"></script>
<script src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/dugmeler.js" type="text/javascript"></script>
<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'bilesenler/editor/phpkf/css/varsayilan.css");</style>';


// harici düğme stil kodları
if ($ayarlar['dugme_stil'] != '')
{
	echo '<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'bilesenler/editor/phpkf/harici_stil.php");</style>';
}


// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	$duzenleyici_js = 'html';
	$duzenleyici_cevir = 'cevirme';
	$duzenleyici_yolla = "yolla('".$duzenleyici_id."_div','".$duzenleyici_id."','yolla')";
	$duzenleyici_tema = $ayarlar['duzenleyici_html_tema'];
}

// BBCode için
else
{
	$duzenleyici_js = 'bbcode';
	$duzenleyici_cevir = 'cevir';
	$duzenleyici_yolla = "yolla('".$duzenleyici_id."_div','".$duzenleyici_id."','yolla','cevir')";

	if ((isset($duzenleyici_tip))AND($duzenleyici_tip == 'hizli'))
	{
		$duzenleyici_tema = $ayarlar['duzenleyici_hizli_tema'];
		$ayarlar['dugme_bbcode'] = $ayarlar['dugme_hizli'];
	}
	else $duzenleyici_tema = $ayarlar['duzenleyici_bbcode_tema'];
}



// Kod çevirici ve şablon yükleniyor
if (!isset($duzenleyici_yukle)) echo '<script src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/'.$duzenleyici_js.'.js" type="text/javascript"></script>';

if ($duzenleyici_tema != 'varsayilan') echo '<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'bilesenler/editor/phpkf/css/'.$duzenleyici_tema.'.css");</style>';



echo $duzenleyici_textarea.'<script type="text/javascript"><!-- //
var duzenleyici_cevir = "'.$duzenleyici_cevir.'";
var duzenleyici_yolla = "'.$duzenleyici_yolla.'";
var dugme_html = "'.$ayarlar['dugme_html'].'";
var dugme_bbcode = "'.$ayarlar['dugme_bbcode'].'";
'.$ayarlar['dugme_kodlar'].'
var ifade_yukle=false;
function Postimage(id){'.$postimage.';}
//  -->
</script>
<script src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/uygula.js" type="text/javascript"></script>';


$duzenleyici_yukle = true;
?>