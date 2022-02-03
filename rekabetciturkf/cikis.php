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


if (!defined('DOSYA_AYAR')) include 'ayar.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include 'bilesenler/gerecler.php';


// oturum bilgisine bakılıyor
if (isset($_GET['o'])) $go = @zkTemizle($_GET['o']);
else $go = '';

// oturum kodu kontrol ediliyor
if ($go != $o)
{
	header('Location: hata.php?hata=45');
	exit();
}



$sayfano = '-1';
$sayfa_adi = 'Kullanıcı çıkış yaptı';
$tarih = time();



// Android uygulaması için
$_SERVER['REMOTE_ADDR'] = zkTemizle($_SERVER['REMOTE_ADDR']);
if (!@preg_match('/phpKF\ Android\ Uygulamasi/', $_SERVER['HTTP_USER_AGENT']))
	$kul_ip = ",kul_ip='$_SERVER[REMOTE_ADDR]',kullanici_kimlik='',yonetim_kimlik=''";
else $kul_ip = '';


$vtsorgu = "UPDATE $tablo_kullanicilar
		SET son_hareket='$tarih', hangi_sayfada='$sayfa_adi', sayfano='$sayfano' $kul_ip
		WHERE id='$kullanici_kim[id]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
setcookie('kfk_okundu', '', 0, $cerez_dizin, $cerez_alanadi);




// Gelinen sayfaya yönlendirme
if (isset($_SERVER['HTTP_REFERER'])) $gelinen = str_replace($TEMA_SITE_ANADIZIN, '', $_SERVER['HTTP_REFERER']);
else $gelinen = '';


if (preg_match('/hata.php/i', $gelinen)) $adres = $forum_index;
else
{
	if ($gelinen == '') $adres = $forum_index.'?cikiss=1';
	elseif (preg_match('/\//i', $gelinen)) $adres = $gelinen;
	elseif (preg_match('/.html/i', $gelinen)) $adres = $gelinen;
	elseif (preg_match('/.php\?/i', $gelinen)) $adres = $gelinen.'&cikiss=1';
	else $adres = $gelinen.'?cikiss=1';
}


header('Location: '.$adres);
exit();
?>