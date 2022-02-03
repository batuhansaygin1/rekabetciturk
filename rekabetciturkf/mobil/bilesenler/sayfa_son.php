<?php
if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_GERECLER')) include 'bilesenler/gerecler.php';


// Forum dizini ve Taban yazı
if ($ayarlar['f_dizin'] == '/') $fdizin = '';
else $fdizin = $ayarlar['f_dizin'].'/mobil';
$yonetim = '';
$TEMA_SITE_TABAN_YAZI = $ayarlar['syfbaslik'];


$tam_surum = $dizin_bilgi.$forum_index;

if ( (isset($_GET['af'])) AND ($_GET['af'] !='' ) AND (is_numeric($_GET['af'])) )
	$tam_surum = $dizin_bilgi.'forum.php?f='.$_GET['af'];

elseif ( (isset($_GET['ak'])) AND ($_GET['ak'] !='' ) AND (is_numeric($_GET['ak'])) )
	$tam_surum = $dizin_bilgi.'konu.php?k='.$_GET['ak'];

elseif ( (isset($_GET['oino'])) AND ($_GET['oino'] !='' ) AND (is_numeric($_GET['oino'])) )
	$tam_surum = $dizin_bilgi.'oi_oku.php?oino='.$_GET['oino'];

elseif ((isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != ''))
{
	$adres = $_SERVER['REQUEST_URI'];
	if (preg_match("/mobil\/ozel_ileti.php/i", $adres))
	{
		if (isset($_GET['kip'])) $tam_surum = $dizin_bilgi.'ozel_ileti.php?kip='.zkTemizle($_GET['kip']);
		else $tam_surum = $dizin_bilgi.'ozel_ileti.php';
	}
	elseif (preg_match("/mobil\/arama.php/i", $adres)) $tam_surum = $dizin_bilgi.'arama.php';
}

// Tema uygulanıyor
$dongusuz = array('{FORUM_INDEX}' => $tam_surum);
eval(TEMA_UYGULA_SON);
$vt->close();
unset($vt);
?>