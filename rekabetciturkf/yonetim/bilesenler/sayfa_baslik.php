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
if (!defined('DOSYA_YONETIM_OTURUM')) include 'bilesenler/oturum.php';
if (!defined('PHPKF_SEO')) include_once('../bilesenler/seo.php');


// Varsayılan yönetim teması ayarlanıyor
$secili_tema = $ayarlar['temadizini'];
$ayarlar['temadizini'] = 'varsayilan';
$temadizini = $ayarlar['temadizini'];


// tema  yonetim_tema.php  dosyası yükleniyor
include 'temalar/'.$temadizini.'/yonetim_tema.php';
$TEMA_CSS = $css_satiri;


// tema logo veya yazı
if (@!preg_match('/\<img/', $ayarlar['tema_logo_ust']))
{
	$TEMA_LOGO_UST = '<span id="baslikyazi">'.$ayarlar['tema_logo_ust'].'</span>';
}
else $TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];


// Dil etiketleri
header("Content-type: text/html; charset=utf-8");
$TEMA_HTML_DIL = 'lang="'.$site_dili.'" dir="ltr"';
$TEMA_META_KARAKTER = 'utf-8';


$sayfa_baslik = $ayarlar['title'];
$site_baslik = str_replace('"', '', $ayarlar['title']);

if (isset($sayfa_adi)) $sayfa_baslik = $sayfa_adi;
else $sayfa_adi = '';



// Tema sınıfı yükleniyor
if (!defined('DOSYA_TEMA_SINIF')) include '../bilesenler/tema_sinif.php';



//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //

// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
$drm_syf_ek = '';
if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel'";
if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";
else{if ($ayarlar['durum_sayfalar'] != 1) $drm_syf_ek .= "AND ad!='kategoriler' AND ad!='sayfalar'";}


// üye giriş durumu için ek sorgu
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
	else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
}
else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";


$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='1' AND alt_menu='0' $drm_syf_ek ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$TEMA_MENU = '';


while ($menubag = $vt->fetch_array($vtsonuc))
{
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu, '../');
}

//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //



// Tema uygulanıyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
$ornek1->tema_uygula();
unset($dongusuz);
unset($ornek1);
?>