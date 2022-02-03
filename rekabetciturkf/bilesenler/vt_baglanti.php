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


if (isset($_SERVER['REQUEST_URI'])) $gadres = $_SERVER['REQUEST_URI'];
else $gadres = '';
if (defined('DOSYA_PORTAL_INDEX')) @ini_set('error_log', 'portal/bilesenler/log/php.log.php');
elseif (!@preg_match('/bilesenler\//', $gadres)) @ini_set('error_log', 'bilesenler/log/php.log.php');
else @ini_set('error_log', 'log/php.log.php');


@ini_set('magic_quotes_runtime', 0);
@ini_set('default_charset', 'UTF-8');



// hata tablosu
$vt_hata_tablo[0] = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Veritabanı Hatası</title></head><body><br><br><br><table border="0" cellspacing="1" cellpadding="7" width="530" bgcolor="#999999" align="center" class="xe-fatal-error"><tr><td bgcolor="#eeeeee" align="center"><font color="#ff0000"><b>';
$vt_hata_tablo[1] = '</b></font></td></tr><tr><td bgcolor="#fafafa"><table border="0" cellspacing="1" cellpadding="7" width="100%" bgcolor="#999999" align="center"><tr><td bgcolor="#eeeeee" align="left"><br>';
$vt_hata_tablo[2] = '<br></td></tr></table></td></tr></table></body></html>';
$vt_hata_tablo[3] = '<table border="0" class="xe-fatal-error"><tr><td></td></tr></table>';



if (!@include_once('veritabani/'.$vtsecim.'.php'))
{
	echo $vt_hata_tablo[0].'Veritabanı Dosyası Bulunamıyor!'.$vt_hata_tablo[1].'/phpkf-bilesenler/veritabani/'.$vtsecim.'.php dosyası bulunamıyor!<br /><br />phpkf-ayar.php dosyasında <b>$vtsecim</b> değişkeni ile yaptığınız veritabanı seçimi hatalı veya veritabanı dosyası silinmiş veya eksik.'.$vt_hata_tablo[2];
	exit();
}



// tablo adlarına önek ekleniyor
$tablo_ayarlar = $tablo_oneki.'ayarlar';
$tablo_baglantilar = $tablo_oneki.'baglantilar';
$tablo_bildirimler = $tablo_oneki.'bildirimler';
$tablo_cevaplar = $tablo_oneki.'cevaplar';
$tablo_dallar = $tablo_oneki.'dallar';
$tablo_duyurular = $tablo_oneki.'duyurular';
$tablo_eklentiler = $tablo_oneki.'eklentiler';
$tablo_forumlar = $tablo_oneki.'forumlar';
$tablo_gruplar = $tablo_oneki.'gruplar';
$tablo_kullanicilar = $tablo_oneki.'kullanicilar';
$tablo_mesajlar = $tablo_oneki.'mesajlar';
$tablo_oturumlar = $tablo_oneki.'oturumlar';
$tablo_ozel_ileti = $tablo_oneki.'ozel_ileti';
$tablo_ozel_izinler = $tablo_oneki.'ozel_izinler';
$tablo_tesekkur = $tablo_oneki.'tesekkur';
$tablo_yasaklar = $tablo_oneki.'yasaklar';
$tablo_yorumlar = $tablo_oneki.'yorumlar';
$tablo_yuklemeler = $tablo_oneki.'yuklemeler';


// Veritabanı ile bağlantı kuruluyor
$vt = new sinif_vt();
$vt->baglan($vtadres, $vtkul, $vtsifre) or die($vt->hata_cikti);


// veritabanı seçiliyor
$veri_tabani = $vt->sec($vtisim) or die($vt->hata_ver());


// ayarlar tablosu kip seçimi
if (!isset($phpkf_ayarlar_kip)) $phpkf_ayarlar_kip = "WHERE kip='1'";


// veritabanından ayarlar tablosu çekiliyor
$vtsorgu = "SELECT etiket,deger FROM $tablo_ayarlar $phpkf_ayarlar_kip";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// ayarlar dizi değişkene aktarılıyor
while ($ayar = $vt->fetch_assoc($vtsonuc))
{
	$ayarlar[$ayar['etiket']] = $ayar['deger'];
}


// bölge ve tarih ayarları
date_default_timezone_set('Asia/Baghdad');
setlocale(LC_ALL,'turkish');


// site dizini bilgisi
if ($ayarlar['f_dizin'] == '/') $anadizin = '/';
else $anadizin = $ayarlar['f_dizin'].'/';


// site alanadı ve dizin bilgisi
$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$TEMA_SITE_ANADIZIN = $protocol.'://'.$ayarlar['alanadi'].$anadizin;


// çerez alanadı
if ($ayarlar['alanadi'] == 'localhost') $cerez_alanadi = null;
else $cerez_alanadi = $ayarlar['alanadi'];


// CMS ve portal ayarları
$forum_kullan = 1;
$portal_kullan = $ayarlar['portal_kullan'];
$cms_kullan = @$ayarlar['cms_kullan'];
$cms_icinden = @$ayarlar['cms_icinden'];


// CMS kullanımı için ayarlar yapılıyor
if ($cms_uyelik == 1)
{
	$vtsorgu = "SELECT id FROM ".$cms_tablo_oneki."kullanicilar WHERE id='1' LIMIT 1";

	if($vt->query($vtsorgu))
	{
		$tablo_baglantilar = $cms_tablo_oneki.'baglantilar';
		$tablo_kullanicilar = $cms_tablo_oneki.'kullanicilar';
		$tablo_oturumlar = $cms_tablo_oneki.'oturumlar';
		$tablo_yasaklar = $cms_tablo_oneki.'yasaklar';
	}

	else
	{
		echo '<div style="font-weight:bold; color:#ff0000; text-align:center; margin:40px">"'.$cms_tablo_oneki.'kullanicilar" CMS kullanıcılar veritabanı tablosu bulunamıyor!<br>Tüm işlemleri doğru yaptığınızdan emin olun.<br><br>Ayrıntılı bilgi için <a href="https://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">tıklayın.</a></div>';
	}
}


// Dil dosyası yükleniyor
if (!defined('DOSYA_DIL')) include_once('diller/index.php');

?>