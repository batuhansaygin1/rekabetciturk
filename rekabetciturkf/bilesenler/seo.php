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


if ( ($ayarlar['seo'] != 0) AND (!defined('PHPKF_SEO')) ) define('PHPKF_SEO',true);


function seoyap($metin)
{
	$metin = mb_strtolower($metin, 'utf8');

	$ara = array (' ', ',', '.', 'ğ', 'ü', 'ş', 'ı', 'ö', 'ç');
	$degistir = array ('-', '-', '-', 'g', 'u', 's', 'i', 'o', 'c');
	$metin = str_replace($ara,$degistir,$metin);

	$ara = array(' ', '(', ')', '\'', '?' , '&nbsp', '&#34;', '&amp', 'http://', '&', '\r\n', '\n', '/', '\\', '+');
	$metin = str_replace($ara, '-', $metin);

	$ara = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$degistir = array('', '-', '');
	$metin = @preg_replace($ara, $degistir, $metin);

	return $metin;
}

function linkver($link, $url='', $ek='')
{
	$giren = array('/forum.php\?f=([0-9]+)&fs=([0-9]+)/',
	'/forum.php\?f=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&fs=([0-9]+)&ks=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&fs=([0-9]+)/',
	'/konu.php\?k=([0-9]+)&ks=([0-9]+)/',
	'/konu.php\?k=([0-9]+)/',
	'/profil.php\?kim=(.*)/',
	'/profil.php\?u=([0-9]+)&kim=(.*)/');

	$cikan = array('f\\1fs\\2-'.seoyap($url).'.html',
	'f\\1-'.seoyap($url).'.html',
	'k\\1fs\\2ks\\3-'.seoyap($url).'.html',
	'k\\1fs\\2-'.seoyap($url).'.html',
	'k\\1ks\\2-'.seoyap($url).'.html',
	'k\\1-'.seoyap($url).'.html',
	'uye-'.$url.'.html',
	'\\1-uye-'.seoyap($url).'.html');

	if (defined('PHPKF_SEO')) $link = @preg_replace($giren, $cikan, $link);
	else $link = @str_replace('&', '&amp;', $link);

	$link .= $ek;
	return $link; 
}
?>