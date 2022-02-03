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


if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);
if (!defined('DOSYA_DIL')) include_once('diller/index.php');
header("Content-type: text/html; charset=utf-8");
@ini_set('magic_quotes_runtime', 0);
$guncel_surum = '2.20';



//  AYAR DOSYASINI İNDİR TIKLANDIĞINDA ÇALIŞACAK KISIM  //

if ( (isset($_POST['kurulum_yapildi'])) AND (isset($_POST['ayar_bilgi'])) AND ($_POST['kurulum_yapildi'] == 'tamam') )
{
	header('Content-Type: text/x-delimtext; name="ayar.php"');
	header('Content-disposition: attachment; filename=ayar.php');

	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc())
	echo stripslashes($_POST['ayar_bilgi']);

	//	magic_quotes_gpc kapalıysa	//
	else echo $_POST['ayar_bilgi'];
	exit();
}




//  FORM BİLGİLERİ KONTROL EDİLİYOR - BAŞI  //

if ( (empty($_POST['kurulum'])) OR ($_POST['kurulum'] == '') ) exit();

if ( (empty($_POST['kurulum'])) OR ($_POST['kurulum'] != 'form_dolu') OR (empty($_POST['alanadi'])) OR (empty($_POST['dizin'])) OR (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) OR (empty($_POST['tablo_onek'])) OR (empty($_POST['yonetici_adi'])) OR (empty($_POST['yonetici_sifre'])) )
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Veritabanı kullanıcı adı ve şifresi hariç tüm alanların doldurulması zorunludur !'.$vt_hata_tablo[2];
	exit();
}

if (!isset($_POST['telif_kabul']))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Telif maddelerinin hepsini okuyup kabul etmeden "php Kolay Forum"u kuramaz<br>ve kullanamazsınız !'.$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[a-zA-Z]\w{0,10}+$/', $_POST['tablo_onek']))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Veritabanı tablo öneki sadece harf ile başlamalı ve 10 karakterden uzun olmamalıdır.'.$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['yonetici_adi']))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Yönetici kullanıcı adında geçersiz karakterler var ! <br><br>Latin ve Türkçe harf, rakam, alt çizgi( _ ), tire ( - ), nokta ( . ) kullanılabilir. <br>Bunların dışındaki özel karakterleri ve boşluk karakterini içeremez.'.$vt_hata_tablo[2];
	exit();
}

if (( strlen($_POST['yonetici_adi']) > 20) or ( strlen($_POST['yonetici_adi']) < 4))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Yönetici kullanıcı adı en az 4, en çok 20 karakter olmalıdır !'.$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['yonetici_sifre']))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Yönetici şifresinde geçersiz karakterler var ! <br><br>Latin harf, rakam, alt çizgi( _ ), tire ( - ), and ( & ), nokta ( . ) kullanılabilir. <br>Bunların dışındaki özel karakterleri, Türkçe karakterleri ve boşluk karakterini içeremez.'.$vt_hata_tablo[2];
	exit();
}

if (( strlen($_POST['yonetici_sifre']) > 20) or ( strlen($_POST['yonetici_sifre']) < 5))
{
	echo $vt_hata_tablo[0].'Hatalı Bilgi'.$vt_hata_tablo[1].'Yönetici şifresi en az 5, en çok 20 karakter olmalıdır !'.$vt_hata_tablo[2];
	exit();
}


//  FORM BİLGİLERİ KONTROL EDİLİYOR - SONU  //




//  veritabanına girilen veriler temizleniyor

function zkTemizle($metin)
{
	$donen = urldecode($metin);
	$donen = str_replace('>','',$donen);
	$donen = str_replace('<','',$donen);
	$donen = str_replace("'",'',$donen);
	$donen = str_replace('\\','',$donen);
	$donen = str_replace('"','',$donen);
	return $donen;
}

$vt_sunucu = zkTemizle($_POST['vt_sunucu']);
$vt_adi = zkTemizle($_POST['vt_adi']);
$vt_kullanici = zkTemizle($_POST['vt_kullanici']);
$vt_sifre = zkTemizle($_POST['vt_sifre']);
$vtsecim = zkTemizle($_POST['vt_tip']);
$tablo_onek = zkTemizle($_POST['tablo_onek']);
$yonetici_sifre = zkTemizle($_POST['yonetici_sifre']);
$alanadi = zkTemizle($_POST['alanadi']);
$site_dizin = zkTemizle($_POST['dizin']);
$yonetici_adi = zkTemizle($_POST['yonetici_adi']);



// Alanadından site ve yönetici e-posta adresi üretiliyor
$alanadi = str_replace(array('http://', 'https://', 'ftp://'), array(''), $alanadi);
$adres_dizi = explode('.', $alanadi);

$site_posta = 'admin@';
$ilk = true;

foreach ($adres_dizi as $adres)
{
	if ($ilk)
	{
		if ($adres != 'www') $site_posta .= $adres.'.';
		$ilk = false;
	}
	else $site_posta .= $adres.'.';
}

$site_posta = substr($site_posta, 0, -1);




//	tablo adlarına önek ekleniyor
$tablo_ayarlar = $tablo_onek.'ayarlar';
$tablo_baglantilar = $tablo_onek.'baglantilar';
$tablo_bildirimler = $tablo_onek.'bildirimler';
$tablo_cevaplar = $tablo_onek.'cevaplar';
$tablo_dallar = $tablo_onek.'dallar';
$tablo_duyurular = $tablo_onek.'duyurular';
$tablo_eklentiler = $tablo_onek.'eklentiler';
$tablo_forumlar = $tablo_onek.'forumlar';
$tablo_gruplar = $tablo_onek.'gruplar';
$tablo_kullanicilar = $tablo_onek.'kullanicilar';
$tablo_mesajlar = $tablo_onek.'mesajlar';
$tablo_oturumlar = $tablo_onek.'oturumlar';
$tablo_ozel_ileti = $tablo_onek.'ozel_ileti';
$tablo_ozel_izinler = $tablo_onek.'ozel_izinler';
$tablo_yasaklar = $tablo_onek.'yasaklar';
$tablo_yorumlar = $tablo_onek.'yorumlar';
$tablo_yuklemeler = $tablo_onek.'yuklemeler';



$tarih = time();
@ini_set('magic_quotes_runtime', 0);

//	şifrelerinin karıştırılacağı anahtar üretiliyor
$anahtar = md5(microtime());

//  şifre anahtar ile karıştırılarak sha1 ile şifreleniyor
$sifre =  sha1($anahtar.$yonetici_sifre);




            //      VERİTABANI BİLGİLERİ        //



$vtkaydi = "



--		`ayarlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_ayarlar` (
`etiket` varchar(50) NOT NULL,
`deger` text,
`kip` tinyint(3) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`etiket`),
KEY `kip` (`kip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_ayarlar` VALUES ('title', 'Site Adı Title', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('anasyfbaslik', 'Site Adı Ana Sayfa', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('syfbaslik', 'Site Adı Taban Yazı', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('fsyfkota', '20', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('ksyfkota', '8', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('k_cerez_zaman', '604800', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('ileti_sure', '20', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('gelen_kutu_kota', '20', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('ulasan_kutu_kota', '20', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kaydedilen_kutu_kota', '20', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('bbcode', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('o_ileti', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('tarih_bicimi', 'd.m.Y- H:i', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('y_posta', '$site_posta', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('alanadi', '$alanadi', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('f_dizin', '$site_dizin', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('eposta_yontem', 'mail', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('smtp_kd', 'true', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('smtp_sunucu', '', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('smtp_kullanici', '', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('smtp_sifre', '', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('smtp_port', '587', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('saat_dilimi', '3', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kilit_sure', '1800', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('imza_uzunluk', '500', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('uzak_resim', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('resim_yukle', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('resim_boyut', '512000', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('resim_genislik', '250', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('resim_yukseklik', '250', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('resim_galerisi', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kayit_cevabi', 'Ankara', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kayit_soru', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kayit_sorusu', 'Türkiye`nin başkenti neresidir?', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('hesap_etkin', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('forum_rengi', 'mavi', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('seo', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('meta_diger', '<meta name=\"rating\" content=\"All\" />
<meta name=\"robots\" content=\"index, follow\" />', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('site_taban_kod', '', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kurucu', 'Kurucu', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yonetici', 'Yönetici', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yardimci', 'Yardımcı', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('blm_yrd', 'Blm Yrd', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kullanici', 'Üye', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('surum', '$guncel_surum', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('sonkonular','1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kacsonkonu','10', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('temadizini','varsayilan', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('tema_secenek','varsayilan,', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('cevrimici', '1800', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('forum_durumu', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('portal_kullan', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('onay_kodu', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('kul_resim', 'dosyalar/resimler/varsayilan_resim.jpg', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('boyutlandirma', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('duyuru_tarihi', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('bolum_kisi', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('konu_kisi', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('uye_kayit', '1', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('oi_uyari', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('vt_hata', '2', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici', 'varsayilan', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('dduzenleyici', 'varsayilan', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yduzenleyici', 'duz', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici_secenek', 'duz,varsayilan,tinymce,ckeditor,sceditor', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('tema_genislik', '95%', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('tema_logo_ust', 'Üst Logo', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('tema_logo_alt', 'Alt Logo', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('cms_kullan', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('cms_icinden', '0', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yukleme_dosya', 'zip,rar,tar.gz,tar,gz,jpg,jpeg,gif,png,bmp,ico,wav,mp3,mp4,ogg,ogv,oga,webm,flv,swf,mpeg,mpg,mp2,wmv,mkv,avi,mov,3gp,', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yukleme_dizin', 'dosyalar/yuklemeler', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yukleme_boyut', '10485760', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yukleme_genislik', '2000', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('yukleme_yukseklik', '2000', 1);

INSERT INTO `$tablo_ayarlar` VALUES ('site_acilis','$tarih','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dil_varsayilan','tr','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dil_eklenen',',en,','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dil_eklenen_alanlar',',en,','1');

INSERT INTO `$tablo_ayarlar` VALUES ('durum_sayfalar','1','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_kat','kategoriler','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_sayfa','sayfalar','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_galeri','galeriler','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_video','videolar','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_etiket','etiket','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dizin_arama','arama','1');

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici_font','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css','1');

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici_html_tema','varsayilan','1');

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici_bbcode_tema','varsayilan','1');

INSERT INTO `$tablo_ayarlar` VALUES ('duzenleyici_hizli_tema','modern_acik_kucuk','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dugme_kodlar','','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dugme_stil','','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dugme_html','kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih | youtube video audio | postimage yukleme | geri ileri','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dugme_bbcode','kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih | youtube video audio | postimage yukleme | geri ileri','1');

INSERT INTO `$tablo_ayarlar` VALUES ('dugme_hizli','kalin alticizgili yatik ustucizgili | renk artalan kaldir | sol orta sag | adres adresk resim eposta | alinti kod | youtube postimage yukleme','1');




--		`baglantilar` TABLOSU VERiLERi

CREATE TABLE `$tablo_baglantilar` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`yer` tinyint(1) NOT NULL DEFAULT '1',
`sayfa` int(11) unsigned NOT NULL,
`alt_menu` int(11) unsigned NOT NULL DEFAULT '0',
`sistem` tinyint(1) NOT NULL DEFAULT '0',
`sira` tinyint(3) unsigned NOT NULL DEFAULT '1',
`ad` varchar(255) NOT NULL,
`adres` varchar(255) NOT NULL,
`bilgi` varchar(255) NOT NULL,
`ad_en` varchar(255) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `alt_menu` (`alt_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_baglantilar` VALUES (1, 1, 0, 0, 1, 10, 'giris-cikis', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (2, 1, 0, 0, 1, 9, 'kayit', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (3, 1, 0, 0, 1, 1, 'anasayfa', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (4, 0, 0, 0, 1, 1, 'kategoriler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (5, 0, 0, 0, 1, 2, 'sayfalar', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (6, 0, 0, 0, 1, 3, 'galeriler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (7, 0, 0, 0, 1, 4, 'videolar', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (8, 1, 0, 0, 1, 5, 'uyeler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (9, 1, 0, 0, 1, 6, 'cevrimici', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (10, 0, 0, 0, 1, 5, 'iletisim', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (11, 0, 0, 0, 1, 6, 'etiket', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (12, 1, 0, 0, 1, 7, 'arama', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (13, 1, 0, 0, 1, 2, 'forum', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (14, 1, 0, 0, 1, 3, 'portal', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (15, 1, 0, 0, 1, 8, 'profil', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (16, 1, 0, 15, 1, 1, 'duzenle', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (17, 1, 0, 15, 1, 2, 'sifre', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (18, 1, 0, 15, 1, 3, 'ozel', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (19, 1, 0, 15, 1, 4, 'yonetim', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (20, 1, 0, 0, 1, 4, 'yardim', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (21, 2, 0, 0, 1, 8, 'giris-cikis', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (22, 2, 0, 0, 1, 7, 'kayit', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (23, 2, 0, 0, 1, 1, 'anasayfa', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (24, 2, 0, 0, 1, 2, 'kategoriler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (25, 2, 0, 0, 1, 3, 'sayfalar', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (26, 2, 0, 0, 1, 4, 'uyeler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (27, 2, 0, 0, 1, 5, 'cevrimici', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (28, 2, 0, 0, 1, 7, 'iletisim', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (29, 2, 0, 0, 1, 1, 'forum', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (30, 2, 0, 0, 1, 1, 'portal', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (31, 3, 0, 0, 1, 8, 'giris-cikis', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (32, 3, 0, 0, 1, 9, 'kayit', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (33, 3, 0, 0, 1, 1, 'anasayfa', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (34, 3, 0, 0, 1, 5, 'uyeler', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (35, 3, 0, 0, 1, 6, 'cevrimici', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (36, 0, 0, 0, 1, 7, 'iletisim', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (37, 3, 0, 0, 1, 7, 'arama', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (38, 3, 0, 0, 1, 2, 'mobil', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (39, 3, 0, 0, 1, 3, 'rss', '', '', NULL);

INSERT INTO `$tablo_baglantilar` VALUES (40, 3, 0, 0, 1, 4, 'yardim', '', '', NULL);




--		`bildirimler` TABLOSU VERiLERi

CREATE TABLE `$tablo_bildirimler` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL,
`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`seviye` tinyint(1) unsigned NOT NULL DEFAULT '0',
`tip` tinyint(2) unsigned NOT NULL DEFAULT '0',
`okundu` tinyint(1) unsigned NOT NULL DEFAULT '0',
`bildirim` varchar(255) NOT NULL,
PRIMARY KEY (`id`),
KEY `uye_id` (`uye_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`cevaplar` TABLOSU VERiLERi

CREATE TABLE `$tablo_cevaplar` (
`id` int(10) unsigned NOT NULL auto_increment,
`tarih` int(11) unsigned NOT NULL,
`cevap_baslik` varchar(255) NOT NULL DEFAULT '',
`cevap_icerik` text NOT NULL,
`cevap_yazan` varchar(20) NOT NULL,
`hangi_basliktan` mediumint(8) unsigned NOT NULL,
`degistirme_tarihi` int(11) unsigned default NULL,
`degistirme_sayisi` smallint(5) unsigned NOT NULL default '0',
`degistiren` varchar(20) default NULL,
`hangi_forumdan` smallint(5) unsigned NOT NULL,
`yazan_ip` varchar(39) default NULL,
`degistiren_ip` varchar(39) default NULL,
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`silinmis` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
PRIMARY KEY (`id`),
KEY `cevap_yazan` (`cevap_yazan`),
KEY `hangi_basliktan` (`hangi_basliktan`),
KEY `hangi_forumdan` (`hangi_forumdan`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`dallar` TABLOSU VERiLERi

CREATE TABLE `$tablo_dallar` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`ana_forum_baslik` text NOT NULL,
`sira` tinyint(3) unsigned NOT NULL default '1',
PRIMARY KEY (`id`),
KEY `sira` (`sira`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_dallar` VALUES (1, 'Deneme Forum Dalı 1', 1);




--		`duyurular` TABLOSU VERiLERi

CREATE TABLE `$tablo_duyurular` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`fno` varchar(5) default NULL,
`duyuru_baslik` varchar(255) NOT NULL DEFAULT '',
`duyuru_icerik` text,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_duyurular` VALUES (1, 'tum', 'php Kolay Foruma Hoş Geldiniz !', '<center><b>Kurulumunuz başarıyla tamamlanmıştır.</b><p>Yönetici olarak giriş yaptığınızda üst menüde görünen <a href=\"yonetim/index.php\">Yönetim</a> bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.</center>');




--		`eklentiler` TABLOSU VERiLERi

CREATE TABLE `$tablo_eklentiler` (
`ad` varchar(40) NOT NULL,
`kur` tinyint(1) unsigned NOT NULL,
`etkin` tinyint(1) unsigned NOT NULL,
`vt` tinyint(1) unsigned NOT NULL,
`dosya` tinyint(1) unsigned NOT NULL,
`dizin` tinyint(1) unsigned NOT NULL,
`sistem` tinyint(1) unsigned NOT NULL,
`usurum` varchar(5) NOT NULL,
`esurum` varchar(5) NOT NULL,
PRIMARY KEY (`ad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`forumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_forumlar` (
`id` smallint(5) unsigned NOT NULL auto_increment,
`dal_no` smallint(5) unsigned NOT NULL,
`forum_baslik` text NOT NULL,
`forum_bilgi` text NOT NULL,
`sira` tinyint(3) unsigned NOT NULL default '1',
`okuma_izni` tinyint(1) NOT NULL default '0',
`yazma_izni` tinyint(1) NOT NULL default '0',
`resim` varchar(100) default NULL,
`konu_acma_izni` tinyint(1) NOT NULL default '0',
`konu_sayisi` mediumint(8) unsigned default '0',
`cevap_sayisi` int(10) unsigned default '0',
`alt_forum` smallint(5) unsigned default '0',
`gizle` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`id`),
KEY `dal_no` (`dal_no`),
KEY `sira` (`sira`),
KEY `alt_forum` (`alt_forum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_forumlar` VALUES (1, 1, 'Deneme Forumu 1', 'Bu forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 1, 0, 0, 0);

INSERT INTO `$tablo_forumlar` VALUES (2, 1, 'Deneme Alt Forumu', 'Bu alt forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 0, 0, 1, 0);




--		`gruplar` TABLOSU VERiLERi

CREATE TABLE `$tablo_gruplar` (
`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
`grup_adi` varchar(30) NOT NULL,
`sira` tinyint(2) unsigned NOT NULL DEFAULT '0',
`gizle` tinyint(1) unsigned NOT NULL DEFAULT '0',
`yetki` tinyint(1) NOT NULL DEFAULT '-1',
`ozel_ad` varchar(30) DEFAULT NULL,
`uyeler` text,
`grup_bilgi` varchar(250) DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `grup_adi` (`grup_adi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`kullanicilar` TABLOSU VERiLERi

CREATE TABLE `$tablo_kullanicilar` (
`id` mediumint(8) unsigned NOT NULL auto_increment,
`kullanici_kimlik` varchar(40) default NULL,
`kullanici_adi` varchar(20) NOT NULL,
`sifre` varchar(40) NOT NULL,
`posta` varchar(100) NOT NULL,
`web` varchar(100) default NULL,
`gercek_ad` varchar(100) NOT NULL,
`dogum_tarihi` varchar(10) NOT NULL,
`katilim_tarihi` int(11) unsigned NOT NULL,
`sehir` varchar(30) NOT NULL,
`mesaj_sayisi` mediumint(8) unsigned NOT NULL default '0',
`yonetim_kimlik` varchar(40) default NULL,
`resim` varchar(100) default NULL,
`imza` text,
`posta_goster` tinyint(1) NOT NULL default '1',
`dogum_tarihi_goster` tinyint(1) NOT NULL default '1',
`sehir_goster` tinyint(1) NOT NULL default '1',
`okunmamis_oi` smallint(3) unsigned NOT NULL default '0',
`son_ileti` int(11) unsigned NOT NULL default '0',
`kul_etkin` tinyint(1) NOT NULL default '0',
`kul_etkin_kod` varchar(10) NOT NULL default '0',
`engelle` tinyint(1) NOT NULL default '0',
`yeni_sifre` mediumint(7) unsigned NOT NULL default '0',
`yetki` tinyint(1) NOT NULL default '0',
`kilit_tarihi` int(11) unsigned NOT NULL default '0',
`giris_denemesi` tinyint(1) unsigned NOT NULL default '0',
`son_giris` int(11) unsigned NOT NULL default '0',
`son_hareket` int(11) unsigned NOT NULL default '0',
`hangi_sayfada` varchar(120) default NULL,
`kul_ip` varchar(39) default NULL,
`gizli` tinyint(1) NOT NULL default '0',
`icq` varchar(30) default NULL,
`msn` varchar(100) default NULL,
`yahoo` varchar(100) default NULL,
`aim` varchar(100) default NULL,
`skype` varchar(100) default NULL,
`temadizini` varchar(25) default NULL,
`temadizinip` varchar(25) default NULL,
`ozel_ad` varchar(30) default NULL,
`posta2` varchar(100) default NULL,
`sayfano` varchar(25) DEFAULT '0',
`grupid` smallint(5) unsigned DEFAULT '0',
`cinsiyet` tinyint(1) NOT NULL DEFAULT '0',
`hakkinda` text,
`takip` text,
`yrm_sayi` mediumint(6) unsigned NOT NULL DEFAULT '0',
`yrm_yapilan` mediumint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `kullanici_adi` (`kullanici_adi`),
KEY `posta` (`posta`),
KEY `katilim_tarihi` (`katilim_tarihi`),
KEY `kul_etkin` (`kul_etkin`),
KEY `engelle` (`engelle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_kullanicilar` VALUES (1, NULL, '$yonetici_adi', '$sifre', '$site_posta', 'http://$alanadi', '$yonetici_adi', '00-00-0000', $tarih, '', 1, NULL, '', '', 1, 0, 0, 0, 0, 1, '0', 0, 0, 1, 0, 0, $tarih-1, $tarih-1, 'Kullanıcı çıkış yaptı', '', 0, '', '', '', '', '','', '', '', '',0,0,0,'','',0,0);




--		`mesajlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_mesajlar` (
`id` mediumint(8) unsigned NOT NULL auto_increment,
`tarih` int(11) unsigned NOT NULL,
`mesaj_baslik` varchar(255) NOT NULL DEFAULT '',
`mesaj_icerik` text NOT NULL,
`yazan` varchar(20) NOT NULL,
`degistirme_tarihi` int(11) unsigned default NULL,
`hangi_forumdan` smallint(5) unsigned NOT NULL,
`goruntuleme` mediumint(8) unsigned NOT NULL default '0',
`cevap_sayi` smallint(5) unsigned NOT NULL default '0',
`son_mesaj_tarihi` int(11) unsigned default NULL,
`degistirme_sayisi` smallint(5) unsigned NOT NULL default '0',
`degistiren` varchar(20) default NULL,
`yazan_ip` varchar(39) default NULL,
`degistiren_ip` varchar(39) default NULL,
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`ust_konu` tinyint(1) NOT NULL default '0',
`kilitli` tinyint(1) NOT NULL default '0',
`silinmis` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
`son_cevap` int(10) unsigned NOT NULL DEFAULT '0',
`son_cevap_yazan` varchar(20) NULL,
PRIMARY KEY (`id`),
KEY `tarih` (`tarih`),
KEY `yazan` (`yazan`),
KEY `hangi_forumdan` (`hangi_forumdan`),
KEY `cevap_sayi` (`cevap_sayi`),
KEY `son_mesaj_tarihi` (`son_mesaj_tarihi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_mesajlar` VALUES (1, $tarih, 'php Kolay Foruma Hoş Geldiniz', '[quote=\"phpKF\"]php Kolay Forum kurulumunuz başarıyla tamamlanmıştır...[/quote]\nYönetici olarak giriş yaptığınızda en üstte görünen  [url=yonetim/index.php]Yönetim[/url]   bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.', '$yonetici_adi', NULL, 1, 0, 0, $tarih, 0, NULL, NULL, '', 1, 0, 0, 0, 0, 0, NULL);




--		`oturumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_oturumlar` (
`sid` varchar(32) NOT NULL,
`giris` int(11) unsigned NOT NULL,
`son_hareket` int(11) unsigned NOT NULL,
`hangi_sayfada` varchar(120) NOT NULL,
`kul_ip` varchar(39) NOT NULL,
`sayfano` varchar(25) DEFAULT '0',
KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`ozel_ileti` TABLOSU VERiLERi

CREATE TABLE `$tablo_ozel_ileti` (
`id` int(10) unsigned NOT NULL auto_increment,
`kimden` varchar(20) NOT NULL,
`kime` varchar(20) NOT NULL,
`ozel_baslik` varchar(255) NOT NULL DEFAULT '',
`ozel_icerik` text NOT NULL,
`gonderme_tarihi` int(11) unsigned NOT NULL,
`okunma_tarihi` int(11) unsigned default NULL,
`gonderen_kutu` tinyint(1) NOT NULL default '0',
`alan_kutu` tinyint(1) NOT NULL default '0',
`bbcode_kullan` tinyint(1) NOT NULL default '0',
`ifade` tinyint(1) NOT NULL default '1',
`cevap_sayi` tinyint(3) unsigned NOT NULL default '0',
`cevap` int(10) unsigned NOT NULL default '0',
PRIMARY KEY (`id`),
KEY `kimden` (`kimden`),
KEY `kime` (`kime`),
KEY `gonderme_tarihi` (`gonderme_tarihi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`ozel_izinler` TABLOSU VERiLERi

CREATE TABLE `$tablo_ozel_izinler` (
`kulad` varchar(30) NOT NULL,
`kulid` mediumint(8) unsigned NOT NULL DEFAULT '0',
`grup` smallint(5) unsigned NOT NULL DEFAULT '0',
`fno` smallint(5) unsigned NOT NULL,
`okuma` tinyint(1) NOT NULL default '0',
`yazma` tinyint(1) NOT NULL default '0',
`yonetme` tinyint(1) NOT NULL default '0',
`konu_acma` tinyint(1) NOT NULL default '0',
`cevap_sayi` tinyint(3) unsigned DEFAULT '0',
`cevap` int(10) unsigned DEFAULT '0',
KEY `kulid` (`kulid`),
KEY `kulad` (`kulad`),
KEY `fno` (`fno`),
KEY `grup` (`grup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`yasaklar` TABLOSU VERiLERi

CREATE TABLE `$tablo_yasaklar` (
`etiket` varchar(30) NOT NULL,
`deger` text,
`tip` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`etiket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `$tablo_yasaklar` VALUES ('kulad', '', '0');

INSERT INTO `$tablo_yasaklar` VALUES ('adsoyad', '', '0');

INSERT INTO `$tablo_yasaklar` VALUES ('posta', '', '0');

INSERT INTO `$tablo_yasaklar` VALUES ('sozcukler', '', '0');

INSERT INTO `$tablo_yasaklar` VALUES ('cumle', '', '0');

INSERT INTO `$tablo_yasaklar` VALUES ('yasak_ip', '', '0');




--		`yorumlar` TABLOSU VERiLERi

CREATE TABLE `$tablo_yorumlar` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL,
`uye_adi` varchar(20) NOT NULL,
`uye_id` mediumint(8) unsigned NOT NULL,
`yazan` varchar(20) NOT NULL,
`yazan_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`yazan_ip` varchar(39) DEFAULT NULL,
`silinmis` tinyint(1) unsigned NOT NULL DEFAULT '0',
`onay` tinyint(1) unsigned NOT NULL DEFAULT '0',
`sikayet` text,
`yorum_icerik` text NOT NULL,
PRIMARY KEY (`id`),
KEY `uye_id` (`uye_id`),
KEY `tarih` (`tarih`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




--		`yuklemeler` TABLOSU VERiLERi

CREATE TABLE `$tablo_yuklemeler` (
`id` int(8) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) NOT NULL DEFAULT '0',
`boyut` int(7) unsigned DEFAULT '0',
`ip` varchar(15) DEFAULT NULL,
`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`uye_adi` varchar(20) NOT NULL DEFAULT '',
`dosya` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";




		//	VERİTABANI YÜKLEME KISMI - BAŞI 	//


if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);

// Veritabanı sınıf dosyası yükleniyor
if(!@include_once('../bilesenler/veritabani/'.$vtsecim.'.php'))
{
	echo $vt_hata_tablo[0].'Veritabanı Dosyası Bulunamıyor!'.$vt_hata_tablo[1].'/bilesenler/veritabani/'.$vtsecim.'.php dosyası bulunamıyor!<br /><br />Veritabanı Tipi seçimi hatalı veya veritabanı dosyası silinmiş veya eksik.'.$vt_hata_tablo[2];
	exit();
}


//  Veritabanı ile bağlantı kuruluyor
$vt = new sinif_vt();
$vt->baglan($vt_sunucu, $vt_kullanici, $vt_sifre);

//  veritabanı seçiliyor
if ($vt->hata_cikti == '') $veri_tabani = $vt->sec($vt_adi);
else $veri_tabani = false;


// Hata iletileri
if ( (!$vt) OR (!$veri_tabani) )
{
	if ( (preg_match("|Can\'t connect to MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|Unknown MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|php_network_getaddresses|si", $vt->hata_cikti)) )
		echo $vt_hata_tablo[0].'Veritabanı sunucusu ile bağlantı kurulamıyor !'.$vt_hata_tablo[1].'Girdiğiniz veritabanı adresini kontrol edip tekrar deneyin.<br><br>
		<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Access denied for user|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].'Hatalı kullanıcı adı veya şifre !'.$vt_hata_tablo[1].'Girdiğiniz veritabanı kullanıcı adı ve şifresini kontrol edip tekrar deneyin.<br><br>
	<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Unknown database|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].'Veritabanı açılamıyor !'.$vt_hata_tablo[1].'Veritabanı adını doğru yazdığınızdan emin olun.<br><br>
	<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	else echo $vt_hata_tablo[0].'Veritabanı ile bağlantı kurulamıyor !'.$vt_hata_tablo[1].'Veritabanı sunucu adresi, kullanıcı adı ve şifre bilgilerinizi tekrar girin.<br><br>
	<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	die();
}






// dosyadaki veriler satır satır dizi değişkene aktarılıyor //
$toplam = explode(";\n\n", $vtkaydi);

// satır sayısı alınıyor //
$toplam_sayi = count($toplam);

// dizideki satırlar döngüye sokuluyor //
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor //
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor //
				$vtsorgu = $vt->query($yorum[$satir2]) or die($vt->hata_ver());
			}
		}

		else // sorgu veritabanına giriliyor //
		$vtsorgu = $vt->query($toplam[$satir]) or die($vt->hata_ver());
	}
}



		//	VERİTABANI YÜKLEME KISMI - SONU 	//







		//	AYAR.PHP DOSYA İÇERİĞİ - BAŞI 	//



$ayar_cikti = '&lt;?php

if (!defined(\'PHPKF_ICINDEN\')) define(\'PHPKF_ICINDEN\', true);
if (!defined(\'DOSYA_AYAR\')) define(\'DOSYA_AYAR\',true);

//  PHP hata gösterme ve kayıt ayarları
@error_reporting(E_ALL);
@ini_set(\'display_errors\',\'off\');
@ini_set(\'log_errors\', 1);

//  veritabanı seçimi
$vtsecim = \''.$vtsecim.'\';

//  veritabanı sunucu adresi
$vtadres = \''.$vt_sunucu.'\';

//  veritabanı ismi
$vtisim = \''.$vt_adi.'\';

//  veritabanı kullanıcı adı
$vtkul = \''.$vt_kullanici.'\';

//  veritabanı şifresi
$vtsifre = \''.$vt_sifre.'\';

//  tablo öneki
$tablo_oneki = \''.$tablo_onek.'\';

//  kullanıcı şifrelerinin karıştırılacağı anahtar sözcük
$anahtar = \''.$anahtar.'\';

//  forum ana sayfasının dosya adi (varsayılan index.php; CMS kullanıyorsanız forum_index.php yapın)
$forum_index = \'index.php\';

//  portal ana sayfasının dosya adi (varsayılan portal_index.php)
$portal_index = \'portal_index.php\';

//  CMS ana sayfasının dosya adi (varsayılan index.php)
$cms_index = \'index.php\';

//  CMS tablo öneki
$cms_tablo_oneki = \'phpkfcms_\';

//  CMS dizini
$cms_dizin = \'\';

//  CMS üyelik sistemi kullanma ayarı
$cms_uyelik = 0;


//  DOSYA İSİMLERİ - BAŞI  //
$dosya_forum = $forum_index;
$dosya_portal = $portal_index;
$dosya_index = \'index.php\';
$dosya_giris = \'giris.php\';
$dosya_cikis = \'cikis.php\';
$dosya_kayit = \'kayit.php\';
$dosya_uyeler = \'uyeler.php\';
$dosya_rss = \'rss.php\';
$dosya_cevrimici = \'cevrimici.php\';
$dosya_yardim = \'yardim.php\';
$dosya_ozel_ileti = \'ozel_ileti.php\';
$dosya_oi_oku = \'oi_oku.php\';
$dosya_oi_yaz = \'oi_yaz.php\';
$dosya_mobil = \'mobil/index.php\';
$dosya_arama = \'arama.php\';
$dosya_profil = \'profil.php\';
$dosya_profil_degistir = \'profil_degistir.php\';
$dosya_sifre_degistir = \'profil_degistir.php?kosul=sifre\';
//  DOSYA İSİMLERİ - SONU  //


// veritabanı bağlantısı yapılıyor
include_once(\'bilesenler/vt_baglanti.php\');

//  çerez dizini
$cerez_dizin = $ayarlar[\'f_dizin\'];

?&gt;';



		//	AYAR.PHP DOSYA İÇERİĞİ - SONU 	//





//	KURULUM TAMAMLANDI İLETİSİ - yazma hakkı yok 	//

$kurulum_tamam1 = '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.ico" rel="icon" type="image/x-icon" />
<title>Kurulum Başarıyla Tamamlanmıştır</title>
</head>
<body>
<br /><br /><br /><table border="0" cellspacing="1" cellpadding="10" width="580" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#333333" size="5"><b>
Kurulum Başarıyla Tamamlanmıştır
</b></font></td></tr>
<tr><td bgcolor="#fafafa">

<font face="arial" size="3">
Kurulum tamamlanmıştır, phpKF`yi tercih ettiğiniz için teşekkür ederiz.

<p><font color="ff0000">Sunucunuzda yazma hakkı bulunmadığı için <b>ayar.php</b> dosyasını<br /> sizin yüklemeniz gerekiyor.</font>

<br /><br />Alttaki düğmeyi tıkladıktan sonra gelen "ayar.php" dosyasını, forumun bulunduğu klasöre atın.

<p>Ayrıca sitenizin güvenliği için "/kurulum" klasörünü, içindeki tüm dosyalarla beraber silin.
<br /><br />
</font>

<form action="kurulum.php" method="post" name="kurulum_formu2">
<input type="hidden" name="kurulum_yapildi" value="tamam">
<input type="hidden" name="ayar_bilgi" value="'.$ayar_cikti.'">
<center><input class="dugme" type="submit" value="Ayar Dosyasını indir">
<br><br><a href="../index.php">Forum Ana Sayfasına Gitmek için Tıklayın</a>
</center>
</form>

<br /></td></tr></table>
</body>
</html>';




//	KURULUM TAMAMLANDI İLETİSİ - sorun yok  	//

$kurulum_tamam2 = '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.ico" rel="icon" type="image/x-icon" />
<title>Kurulum Başarıyla Tamamlanmıştır</title>
</head>
<body>
<br /><br /><br /><table border="0" cellspacing="1" cellpadding="10" width="580" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#333333" size="5"><b>
Kurulum Başarıyla Tamamlanmıştır
</b></font></td></tr>
<tr><td bgcolor="#fafafa">

<font face="arial" size="3">
<br />Kurulum tamamlanmıştır, phpKF`yi tercih ettiğiniz için teşekkür ederiz.

<p><b>ayar.php dosyası otomatik olarak oluşturulmuştur.</b>

<br /><br />Sitenizin güvenli için "/kurulum" klasörünü, içindeki tüm dosyalarla beraber silmeyi unutmayın.
<br /><br />

<center><br><a href="../index.php">Forum Ana Sayfasına Gitmek için Tıklayın</a></center>

<br />
</font>
</td></tr></table>
</body>
</html>';




$adi_ayarphp = '../ayar.php';

if (@touch($adi_ayarphp))
{
	if (@is_writable($adi_ayarphp))
	{
		$dosya_ayarphp = @fopen($adi_ayarphp, 'w');

		@flock($dosya_ayarphp, 2);


		$bul = array('&gt;', '&lt;', '&quot;');
		$cevir = array('>', '<', '"');
		$ayar_cikti = @str_replace($bul, $cevir, $ayar_cikti);


		@fwrite($dosya_ayarphp, $ayar_cikti);

		@flock($dosya_ayarphp, 3);
		@fclose($dosya_ayarphp);

		echo $kurulum_tamam2;
	}

	else echo $kurulum_tamam1;
}

else echo $kurulum_tamam1;

?>