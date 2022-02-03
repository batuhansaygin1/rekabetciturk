<?php
if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


// bildirim dosyası yükleniyor
$bldrm_dizin = '';
include_once('bilesenler/bildirim.php');


// Taban yazı ve logosu
if (@!preg_match('/\<img/', $ayarlar['tema_logo_alt']))
{
	$TEMA_LOGO_ALT  = '<span id="baslikyazialt">'.$ayarlar['tema_logo_alt'].'</span>';
}
else $TEMA_LOGO_ALT = $ayarlar['tema_logo_alt'];


$TEMA_SITE_TABAN_YAZI = $ayarlar['syfbaslik'];
$TEMA_SITE_TABAN_KOD = $ayarlar['site_taban_kod'];


// Forum dizini
if ($ayarlar['f_dizin'] == '/') $fdizin = '';
else $fdizin = $ayarlar['f_dizin'];
$tema_secimi = '';


// Yönetim bağlantıları
$yonetim = '';
if ( (isset($kullanici_kim['yetki'])) AND ($kullanici_kim['yetki'] == 1) )
{
	$yonetim .= '<a href="yonetim/index.php">Forum Yönetim</a>';
	if ($portal_kullan == 1) $yonetim .= ' &nbsp;|&nbsp; <a href="portal/index.php">Portal Yönetim</a>';
	if ($cms_kullan == 1) $yonetim .= ' &nbsp;|&nbsp; <a href="'.$cms_dizin.'phpkf-yonetim/index.php">CMS Yönetim</a>';
}


$mobil_adres = 'mobil/index.php';

if ( (isset($_GET['f'])) AND ($_GET['f'] !='' ) AND (is_numeric($_GET['f'])) )
	$mobil_adres = 'mobil/index.php?af='.$_GET['f'];

elseif ( (isset($_GET['k'])) AND ($_GET['k'] !='' ) AND (is_numeric($_GET['k'])) )
	$mobil_adres = 'mobil/index.php?ak='.$_GET['k'];

elseif ( (isset($_GET['oino'])) AND ($_GET['oino'] !='' ) AND (is_numeric($_GET['oino'])) )
	$mobil_adres = 'mobil/oi_oku.php?oino='.$_GET['oino'];

elseif ((isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != ''))
{
	$adres = $_SERVER['REQUEST_URI'];
	if (preg_match("/\/ozel_ileti.php/i", $adres))
	{
		if (isset($_GET['kip'])) $mobil_adres = 'mobil/ozel_ileti.php?kip='.zkTemizle($_GET['kip']);
		else $mobil_adres = 'mobil/ozel_ileti.php';
	}
	elseif (preg_match("/\/arama.php/i", $adres)) $mobil_adres = 'mobil/arama.php';
}


// Tema uygulanıyor
$dongusuz=array('{YONETIM_MASASI}' => $yonetim,
'{MOBIL_ADRES}' => $mobil_adres,
'{TEMA_SECIMI}' => $tema_secimi);
eval(TEMA_UYGULA_SON);
$vt->close();
unset($vt);
?>