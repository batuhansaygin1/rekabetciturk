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
if (!defined('DOSYA_GERECLER')) include $duzenleyici_dizin.'bilesenler/gerecler.php';


$duzenleyici_ifadeler_dizin = $TEMA_SITE_ANADIZIN.'dosyalar/ifadeler/';
$duzenleyici_ifadeler_dizin  = str_replace('/','\\/',$duzenleyici_ifadeler_dizin);


$bul = array('\\','(',')','/','*','|');
$cevir = array('\\\\','\\(','\\)','\\/','\\*','\\|');
$ifaadeler_dizi3 = str_replace($bul,$cevir,$ifaadeler_dizi1);


$dongu=0; $a1=''; $b1=''; $a2=''; $b2='';

foreach($ifaadeler_dizi2 as $tek)
{
	$a1 .= '"'.$ifaadeler_dizi3[$dongu].'", ';
	$b1 .= '"'.$tek.'", ';
	$a2 .= '"<img src=\""+ifadeler_dizin+"'.$tek.'\"\>", ';
	$b2 .= '"'.$ifaadeler_dizi1[$dongu].'", ';
	$dongu++;
}

$a1 = substr($a1, 0, -2);
$b1 = substr($b1, 0, -2);
$a2 = substr($a2, 0, -2);
$b2 = substr($b2, 0, -2);

echo '<script type="text/javascript"><!-- //
var ifadeler_dizin="'.$duzenleyici_ifadeler_dizin.'";
var ifadeler_bul1 = new Array('.$a1.');
var ifadeler_degis1 = new Array('.$b1.');
var ifadeler_bul2 = new Array('.$a2.');
var ifadeler_degis2 = new Array('.$b2.');
var duzenleyici = "'.$duzenleyici.'";

window.onbeforeunload = function(){
	sayfadan_ayril();
	if(!ayril) return "Sayfadan ayrıldığınızda yaptığınız değişiklikler kaybolacak !";
};
// -->
</script>';

?>