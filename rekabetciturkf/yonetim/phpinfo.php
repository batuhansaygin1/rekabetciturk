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


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';


if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


function phpinfo_array($return=false)
{
	@ob_start();
	@phpinfo(-1);
	$pi = @ob_get_clean();
	$pi = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $pi);
	$pi = strip_tags($pi,'<h1><h2><hr><style><table><tr><th><td><tbody><thead><tfoot><img><b><u><i><strong><em><br><p>');
	$pi = str_replace("phpinfo()", '', $pi);
	return $pi;
}


$sayfa_adi = 'Yönetim Sunucu Bilgileri';
include_once('bilesenler/sayfa_baslik.php');
include_once('temalar/'.$temadizini.'/menu.php');
?>

<style type="text/css">
.sunucu_bilgi {font-family: sans-serif !important; font-size:14px !important}
.sunucu_bilgi pre {margin: 0px; font-family: monospace;}
.sunucu_bilgi a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
.sunucu_bilgi a:hover {text-decoration: underline;}
.sunucu_bilgi table {border-collapse: collapse; width:100%}
.center {text-align: center;}
.center table { margin-left: auto; margin-right: auto; text-align: left;}
.center th { text-align: center !important; }
.sunucu_bilgi td, .sunucu_bilgi th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}
.sunucu_bilgi h1 {font-size: 150%;}
.sunucu_bilgi h2 {font-size: 125%;}
.p {text-align: left;}
.e {background-color: #ccccff; font-weight: bold; color: #000000;}
.h {background-color: #9999cc; font-weight: bold; color: #000000;}
.v {background-color: #cccccc; color: #000000;}
.vr {background-color: #cccccc; text-align: right; color: #000000;}
.sunucu_bilgi img {float: right; border: 0px;}
.sunucu_bilgi hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
</style>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">MySQL Bilgileri</div>
<div class="kutu-icerik">
<div class="sunucu_bilgi"><?php echo phpinfo_array(); ?></div>
</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>