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
if (!defined('DOSYA_AYAR')) include 'ayar.php';
if (!defined('PHPKF_SEO')) include_once('bilesenler/seo.php');


//  CMS İÇİNDEN - BAŞI  //

if ($cms_icinden == 1):
include_once('phpkf-ayar.php');
include_once('phpkf-bilesenler/tema_sinif.php');
include_once('tema_sinif.php');
include_once('phpkf-bilesenler/kullanici_kimlik.php');
include_once('phpkf-bilesenler/sayfa_baslik.php');
include_once('oturum.php');
include_once('temalar/'.$ayarlar['temadizini'].'/tema.php');
echo '<style type="text/css" scoped="scoped">@import url("'.$css_satiri.'");</style>';

//  CMS İÇİNDEN - SONU  //



else:

header("Content-type: text/html; charset=utf-8");
if (!defined('DOSYA_OTURUM')) include 'oturum.php';


//  KULLANICI TEMA SEÇİMİ UYGULANIYOR  //

if( (isset($kullanici_kim['temadizini'])) AND ($kullanici_kim['temadizini'] != '') )
	$ayarlar['temadizini'] = $kullanici_kim['temadizini'];

elseif ( (!isset($ayarlar['temadizini'])) OR ($ayarlar['temadizini'] == '') )
	$ayarlar['temadizini'] = 'varsayilan';

$temadizini = $ayarlar['temadizini'];



//  META ETİKETLERİ  //

if (isset($_SERVER['REQUEST_URI']))
{
	if (!@preg_match('/"/', urldecode($_SERVER['REQUEST_URI']))) $meta_canonical = $_SERVER['REQUEST_URI'];
	else $meta_canonical = '';
	$meta_canonical = zkTemizle($meta_canonical);
	$meta_canonical = zkTemizle4($meta_canonical);
	$meta_canonical = $protocol.'://'.$ayarlar['alanadi'].$meta_canonical;
}
else $meta_canonical = $protocol.'://'.$ayarlar['alanadi'];



// Dil etiketleri
$TEMA_HTML_DIL = 'lang="'.$site_dili.'" dir="ltr"';
$TEMA_META_KARAKTER = 'utf-8';

$meta_etiketler = '<link rel="canonical" href="'.$meta_canonical.'" />
<meta name="content-language" content="'.$site_dili.'" />
<meta name="generator" content="phpKF" />'."\r\n".$ayarlar['meta_diger']."\r\n";



if (isset($sayfa_adi)) $sayfa_adi = stripslashes($sayfa_adi);
else $sayfa_adi = '';

if ($sayfano == 1) $sayfa_baslik = $ayarlar['title'];
else $sayfa_baslik = $sayfa_adi;

$site_baslik = str_replace('"', '', $ayarlar['title']);



//  RSS BAĞLANTILARI  //

if ( (isset($_GET['f'])) AND ($_GET['f'] != '') AND (is_numeric($_GET['f']) == true) )
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa - Forum '.$_GET['f'].'" href="rss.php?f='.$_GET['f'].'" />';
	$rssadres = 'rss.php?f='.$_GET['f'];
}

elseif (isset($mesaj_satir['hangi_forumdan']))
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa - Forum '.$mesaj_satir['hangi_forumdan'].'" href="rss.php?f='.$mesaj_satir['hangi_forumdan'].'" />';
	$rssadres = 'rss.php?f='.$mesaj_satir['hangi_forumdan'];
}

else
{
	$rss_satiri = '<link rel="alternate" type="application/rss+xml" title="Anasayfa" href="rss.php" />';
	$rssadres = 'rss.php';
}
$rss_satiri .= "\r\n".'<script src="bilesenler/diller/'.$site_dili.'/javascript.js"></script>
<script src="bilesenler/js/phpkf-jsk.js" type="text/javascript"></script>
<script src="bilesenler/js/islemler.js" type="text/javascript"></script>'."\r\n";



// DUYURU BİLGİLERİ ÇEKİLİYOR //

$vtsorgu = "SELECT * FROM $tablo_duyurular WHERE fno!='por' AND fno!='ozel' ORDER BY fno='tum' desc";
$duyuru_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// DUYURU VARSA DÖNGÜYE GİRİLİYOR //

if ($vt->num_rows($duyuru_sonuc)) 
{
	while ($duyurular = $vt->fetch_assoc($duyuru_sonuc))
	{
		if ($duyurular['fno'] == 'tum') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

		if (isset($kullanici_kim['id']))
		{
			if ($duyurular['fno'] == 'uye') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'byar') AND ($kullanici_kim['yetki'] == '3')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'fyar') AND ($kullanici_kim['yetki'] == '2')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);

			if (($duyurular['fno'] == 'yon') AND ($kullanici_kim['yetki'] == '1')) $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);
		}

		else {if ($duyurular['fno'] == 'mis') $tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);}

		if ( (isset($_GET['f']) AND ($duyurular['fno'] == $_GET['f'])) OR (isset($mesaj_satir['hangi_forumdan']) AND ($duyurular['fno'] == $mesaj_satir['hangi_forumdan'])) )
			$tekli1[] = array('{DUYURU_BASLIK}' => $duyurular['duyuru_baslik'], '{DUYURU_ICERIK}' => $duyurular['duyuru_icerik']);
	}
}



// Tema sınıfı yükleniyor
if (!defined('DOSYA_TEMA_SINIF')) include 'tema_sinif.php';


// tema  tema.php  dosyası yükleniyor
include 'temalar/'.$temadizini.'/tema.php';
$TEMA_CSS = '<link href="'.$css_satiri.'" rel="stylesheet" type="text/css" />
<style type="text/css">
.genislik{width:'.$ayarlar['tema_genislik'].'; margin:0 auto}
</style>';


// tema logo veya yazı
if (@!preg_match('/\<img/', $ayarlar['tema_logo_ust']))
{
	$TEMA_LOGO_UST = '<span id="baslikyazi">'.$ayarlar['tema_logo_ust'].'</span>';
}
else $TEMA_LOGO_UST = $ayarlar['tema_logo_ust'];


$javascript_kodu = '<script type="text/javascript"><!-- //
setInterval(\'ziplama()\',500);
//  -->
</script>';



//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - BAŞI  //
if (isset($tema_ozellik_genel_menu)):

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
	$TEMA_MENU .= phpkf_ust_menu($menubag, $tema_ozellik_genel_menu);
}

endif;
//  MENÜ BAĞLANTILARI OLUŞTURULUYOR - SONU  //



// Temada başlık bölümünün en altına kod eklemek için
$baslik_en_alt = '';


// Tema dosyası yükleniyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/baslik.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



//  KULLANICI GİRİŞ YAPMIŞSA  //
if (isset($kullanici_kim['id']))
{
	$kullanici_adi = $kullanici_kim['kullanici_adi'];
	$ornek1->kosul('9', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{O}' => $o), true);
	$ornek1->kosul('10', array('{O}' => $o), true);

	if ($ayarlar['o_ileti'] == 1)
	{
		if ($kullanici_kim['okunmamis_oi'])
		{
			$ornek1->kosul('3', array('' => ''), false);
			$ornek1->kosul('4', array('{OKUNMAMIS_OI}' => $kullanici_kim['okunmamis_oi'],
			'{JAVASCRIPT_KODU}' => $javascript_kodu), true);
		}
		else $ornek1->kosul('4', array('' => ''), false);
	}

	else
	{
		$ornek1->kosul('3', array('' => ''), false);
		$ornek1->kosul('4', array('' => ''), false);
	}

	if ($kullanici_kim['yetki'] != '1') $ornek1->kosul('YONETIM', array('' => ''), false);
}


//  KULLANICI GİRİŞ YAPMAMIŞSA  //
else
{
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('9', array('' => ''), true);
	$ornek1->kosul('10', array('' => ''), false);
	$ornek1->kosul('YONETIM', array('' => ''), false);
	$kullanici_adi = '';
}


//  DUYURU TABLOSU AYARLARI  //

// duyuru varsa koşul 5 alanı tekli döngüye sokuluyor ve koşul 6 alanı gizleniyor
if (isset($tekli1))
{
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->tekli_dongu('1',$tekli1);
	unset($tekli1);
}

// duyuru yoksa koşul 5 alanı gizleniyor
else $ornek1->kosul('5', array('' => ''), false);



// portal kullanılıyorsa portal bağlantısı ekleniyor
if ($portal_kullan == 1)
{
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('8', array('{FORUM_INDEX}' => $forum_index, '{PORTAL_INDEX}' => $portal_index), true);
}
else
{
	$ornek1->kosul('8', array('' => ''), false);
	$ornek1->kosul('7', array('{FORUM_INDEX}' => $forum_index), true);
}



// Tema değişkenleri
$dongusuz = array('{CSS_SATIRI}' => $TEMA_CSS,
'{SAYFA_BASLIK}' => $sayfa_baslik,
'{SITE_BASLIK}' => $site_baslik,
'{KULLANICI_ADI}' => $kullanici_adi,
'{RSS_SATIRI}' => $rss_satiri,
'{BASLIK_TABANI}' => $basliktabani,
'{BASLIK_EN_ALT}' => $baslik_en_alt);


// Tema uygulanıyor
$ornek1->dongusuz($dongusuz);
$ornek1->tema_uygula();

unset($dongusuz);
unset($tekli1);
unset($ornek1);

endif; // CMS içinden koşulu sonu

?>