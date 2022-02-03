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


if (!isset($sayfano)) $sayfano = 50;
define('DOSYA_YONETIM_OTURUM',true);

if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


//   IP YASAKLAMA - BAŞI   //

// yasaklı ip adresleri alınıyor
$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='yasak_ip' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_ip = $vt->fetch_row($yasak_sonuc);

$yasak_ipd = explode("\r\n", $yasak_ip[0]);

if ($yasak_ip[0] != '')
{
	foreach ($yasak_ipd as $yasak_ipt)
	{
		if ($_SERVER['REMOTE_ADDR'] == $yasak_ipt)
		{
			$a = '403 Access Forbidden - Erişim Engellendi';
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
			header('Content-type: text/html; charset=utf-8');
			echo '<!DOCTYPE html><html><head><title>'.$a.'</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /></head><body><h3>'.$a.'</h3></body></html>';
			exit();
		}
	}
}

//   IP YASAKLAMA - SONU   //




//  OTURUM BİLGİLERİ - BAŞI  //
//  OTURUM BİLGİLERİ - BAŞI  //

$tarih = time();
$_SERVER['REMOTE_ADDR'] = zkTemizle4($_SERVER['REMOTE_ADDR']);
$_SERVER['REMOTE_ADDR'] = zkTemizle($_SERVER['REMOTE_ADDR']);
$sayfa_adi = zkTemizle($sayfa_adi);
$sayfa_adi = mb_substr($sayfa_adi, 0, 100, 'utf-8');


//	KAYITLI KULLANICI İSE	//

if (isset($kullanici_kim['id']))
{
	// Android uygulaması için
	if (!preg_match('/phpKF\ Android\ Uygulamasi/', $_SERVER['HTTP_USER_AGENT']))
		$kul_ip = ", kul_ip='$_SERVER[REMOTE_ADDR]'";
	else $kul_ip = '';


	$vtsorgu = "UPDATE $tablo_kullanicilar SET son_hareket='$tarih',
			sayfano='0', hangi_sayfada='$sayfa_adi'
			$kul_ip
			WHERE id='$kullanici_kim[id]' LIMIT 1";
	$oturum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


//	MİSAFİRİN İLK GELİŞİ İSE	//

elseif ( (empty($kullanici_kim['id'])) AND (empty($_COOKIE['misafir_kimlik'])) )
{
	// MD5 ile oluşturulan kimlik yarım saatlik ömür ile çereze kaydediliyor.
	$misafir_kimlik = md5(microtime());
	setcookie('misafir_kimlik', $misafir_kimlik, $tarih+1800, $cerez_dizin, $cerez_alanadi);


	$vtsorgu = "INSERT INTO $tablo_oturumlar (sid,giris,son_hareket,sayfano,hangi_sayfada,kul_ip)
			VALUES('$misafir_kimlik','$tarih','$tarih','0','$sayfa_adi','$_SERVER[REMOTE_ADDR]')";
	$oturum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


//	MİSAFİRİN GEZİNTİLERİ	//

elseif ( (empty($kullanici_kim['id'])) AND (isset($_COOKIE['misafir_kimlik']))
		AND ($_COOKIE['misafir_kimlik'] != '') )
{
	$misafir_kimlik = zkTemizle4($_COOKIE['misafir_kimlik']);
	$misafir_kimlik = zkTemizle($misafir_kimlik);
	setcookie('misafir_kimlik', $misafir_kimlik, $tarih+1800, $cerez_dizin, $cerez_alanadi);


	$vtsorgu = "UPDATE $tablo_oturumlar SET son_hareket='$tarih',
			sayfano='0', hangi_sayfada='$sayfa_adi',
			kul_ip='$_SERVER[REMOTE_ADDR]'
			WHERE sid='$misafir_kimlik' LIMIT 1";
	$oturum_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

//  OTURUM BİLGİLERİ - SONU  //
//  OTURUM BİLGİLERİ - SONU  //

?>