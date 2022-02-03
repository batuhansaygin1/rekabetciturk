<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v1.10                              |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2018 phpKF Ekibi               |
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
define('DOSYA_DIL',true);


// Tanımlı Diller - kendi dilinde yazılış
$dillerg = array(
'de' => 'Deutsch',
'ar' => 'العربية',
'az' => 'Azərbaycan dili',
'eu' => 'Euskara',
'bn' => 'বাংলা',
'bg' => 'Български език',
'cs' => 'Čeština',
'zh-cn' => '简体中文',
'zh-tw' => '繁體中文',
'da' => 'Dansk',
'id' => 'Bahasa Indonesia',
'hy' => 'Հայերեն',
'et' => 'Eesti',
'fa' => 'فارسی',
'fil' => 'Filipino',
'fi' => 'Suomi',
'fr' => 'Français',
'gl' => 'Galego',
'gu' => 'ગુજરાતી',
'ka' => 'ქართული ენა',
'hr' => 'Hrvatski',
'hi' => 'हिन्दी',
'nl' => 'Nederlands',
'he' => 'עִבְרִית',
'en' => 'English',
'ga' => 'Gaeilge',
'es' => 'Español',
'sv' => 'Svenska',
'it' => 'Italiano',
'ja' => '日本語',
'kn' => 'ಕನ್ನಡ',
'ca' => 'Català',
'ko' => '한국어',
'kk' => 'Қазақша',
'ky' => 'кыргызча',
'ku' => 'Kurdî (Kurmancî)',
'hac' => 'گۆرانی (Gorani)',
'cb' => 'کوردیی ناوەندی‏ (Sorani)',
'zz' => 'Kurdî (Zaza)',
'lzz' => 'Lazuri nena - ლაზური ნენა',
'pl' => 'Polski',
'hu' => 'Magyar',
'mk' => 'Македонски',
'msa' => 'Bahasa Melayu',
'mn' => 'Монгол',
'mr' => 'मराठी',
'no' => 'Norsk',
'ota' => 'Osmanlıca',
'uz' => 'O`zbek',
'pt' => 'Português',
'ro' => 'Română',
'ru' => 'Русский',
'sr' => 'Српски',
'sk' => 'Slovenčina',
'tg' => 'Тоҷикӣ',
'ta' => 'தமிழ்',
'th' => 'ภาษาไทย',
'tr' => 'Türkçe',
'tm' => 'Türkmen dili - تورکمن ﺗﻴﻠی',
'uk' => 'Українська мова',
'ur' => 'اردو',
'vi' => 'Tiếng Việt',
'el' => 'Ελληνικά',
);




// GET ile dil seçimi
if (isset($_GET['dil']))
{
	$bul = array('x','-','.',',');
	$dil = htmlspecialchars(urldecode(trim($_GET['dil'])), ENT_QUOTES);
	$dil = str_replace($bul, '', $dil);
	$zaman = time()+$ayarlar['k_cerez_zaman'];

	if (isset($_SERVER['HTTP_REFERER'])) $ref = str_replace('dil='.$dil, '', $_SERVER['HTTP_REFERER']);
	else $ref = $dosya_index;

	if (($dil == '') OR ($dil == '0') OR (!preg_match("/,$dil,/is", $ayarlar['dil_eklenen'])) ) {$dil = ''; $zaman = 0;}

	@setcookie('dil', $dil, $zaman, $ayarlar['dizin'], $cerez_alanadi);

	header('Location: '.$ref);
	exit();
}




// COOKIE ile dil seçimi
if (isset($_COOKIE['dil']))
{
	$bul = array('x','-','.',',');
	$dil = htmlspecialchars(urldecode(trim($_COOKIE['dil'])), ENT_QUOTES);
	$dil = str_replace($bul, '', $dil);

	if (($dil != '') AND (preg_match("/,$dil,/is", $ayarlar['dil_eklenen']))) $site_dili = $_COOKIE['dil'];
	else $site_dili = $ayarlar['dil_varsayilan'];
}
else
{
	if (isset($ayarlar['dil_varsayilan'])) $site_dili = $ayarlar['dil_varsayilan'];
	else $site_dili = 'tr';
}




// Dil dosyası yükleniyor
if (@include_once($site_dili.'/index.php'));
else include_once('tr/index.php');





// Dil seçim formu hazırlanıyor

if (@$ayarlar['dil_eklenen'] != ',')
{
	$TEMA_DIL_SECIM = '<option value="0"> - '.$l['dil_sec'].' - </option>';

	if (@$ayarlar['dil_varsayilan'] == $site_dili) $TEMA_DIL_SECIM .= '<option value="">'.$dillerg[$ayarlar['dil_varsayilan']].'</option>'."\r\n";
	else $TEMA_DIL_SECIM .= '<option value="">'.@$dillerg[$ayarlar['dil_varsayilan']].' - '.@$diller[$ayarlar['dil_varsayilan']].'</option>'."\r\n";

	$dil_eklenen = explode(',', $ayarlar['dil_eklenen']);
	foreach ($dil_eklenen as $dil)
	{
		if ($dil == '') continue;
		if ($dil == $site_dili)
		{
			$s = ' selected="selected"';
			$z = '';
		}
		else
		{
			$s = '';
			$z = ' - '.$diller[$dil];
		}
		$TEMA_DIL_SECIM .= '<option value="'.$dil.'"'.$s.'>'.$dillerg[$dil].$z.'</option>'."\r\n";
	}
}
else $TEMA_DIL_SECIM = false;

?>