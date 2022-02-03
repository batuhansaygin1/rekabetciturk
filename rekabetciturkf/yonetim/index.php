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


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';





// RESMİ DUYURU - BAŞI //

if ( (isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'forum' ) OR (isset($_GET['fsurum'])) AND ($_GET['fsurum'] != '' ) )
{
	if (isset($_GET['duyuru'])) $ek = 'l='.$site_dili.'&duyuru=forum';
	elseif (isset($_GET['fsurum'])) $ek = 'l='.$site_dili.'&fsurum='.$_GET['fsurum'];

	if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = $protocol.'://'.$ayarlar['alanadi'].$ayarlar['f_dizin'].'/yonetim/index.php';

	if ((isset($_GET['adres'])) AND ($_GET['adres'] == '1'))
	{
		$adres = '79.171.17.200';
		$_GET['adres'] = '0';
	}
	else
	{
		$adres = 'www.phpkf.com';
		$_GET['adres'] = '0';
	}


	header('Content-type: text/html');
	header("Content-type: text/html; charset=iso-8859-9");
	header('Content-Language: tr');


$out = "GET /resmi_duyuru.php?$ek HTTP/1.1
Accept: text/html
Accept-Encoding: iso-8859-9
Host: $adres
Referer: $_SERVER[HTTP_REFERER]
User-Agent: phpKF Resmi Duyuru ve Surum Denetleme
Connection: close

";


	// fsockopen fonksiyonu engellenmişse
	if (!function_exists('fsockopen'))
	{
		if ( (isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'forum' ) )
		echo mb_convert_encoding('<iframe src="//www.phpkf.com/resmi_duyuru.php?l='.$site_dili.'&duyuru=cms" name="duyuru" style="border:2px solid #ddd; width:800px; height:500px">'.$ly['noiframe'].'</iframe>',"ISO-8859-9","UTF-8");
		exit();
	}



	$cikis = '';
	$baglanti = @fsockopen($adres, 80, $hatano, $hata, 10);

	if(!$baglanti)
	{
		if ($_GET['adres'] == '0')
		{
			header('Location: index.php?adres=1&'.$ek);
			exit();
		}
		else
		{
			echo '<font color="#ff0000"><b>'.$ly['baglanti_yok_ansi'].'</b></font><br>';
			echo "$hata ($hatano)<br><br>";
			exit();
		}
	}

	@fputs($baglanti, $out);
	$satir = @fgets($baglanti);

	if (@substr_count($satir, "200 OK") > 0)
	{
		$baslik = false;
		while(!@feof($baglanti))
		{
			$satir = @fgets($baglanti);
			if ($satir == "\r\n") $baslik = true;
			if ($baslik) $cikis .= $satir;
		}
	}

	else $cikis .= '<font color="#ff0000"><b>'.$ly['baglanti_yok_ansi'].'</b></font><br>';
	@fclose($baglanti);

	$cikis = str_replace(array("\r", "\n"), array('', ''), $cikis);
	$cikis = preg_replace("/^([a-z0-9-]*?)\</i", '<', $cikis);
	$cikis = preg_replace("/\>([a-z0-9-]*?)$/i", '>', $cikis);

	echo $cikis;
	exit();
}

// RESMİ DUYURU - SONU //



// RESMİ DUYURU EKRANI - BAŞI //

$duyuru_tikla = '<a href="javascript:void(0)" onclick="duyuru(\\\'katman_duyuru1\\\')">'.$ly['tiklayin'].'</a>';
$ly['duyuru_tikla'] = str_replace('{TIKLAYIN}', $duyuru_tikla, $ly['duyuru_tikla']);


$phpkf_duyuru = '<br>
<noscript><br><font color="#ff0000">
<b>'.$ly['noscript'].'</b><br>
</font></noscript>

<div id="katman_duyuru1" style="float:left; border:0px solid #000000">

<script type="text/javascript"><!-- //
document.write(\'<b>'.$ly['duyuru_tikla'].'</a></b>\');
//  -->
</script>

</div>
';



$javascript_kodu = '
<script type="text/javascript"><!-- //
//    phpKF
//  =========
//  Telif - Copyright (c) 2007 - 2019 phpKF
//  https://www.phpkf.com   -   phpkf@phpkf.com
//  Tüm hakları saklıdır - All Rights Reserved

function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = \'name=value\';
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);

istek.onreadystatechange = function(){
if (istek.readyState == 4){
if (istek.status == 200) katman1.innerHTML = istek.responseText;
else katman1.innerHTML = \'<font color="#ff0000"><b>\'+jsl["baglanti_yok"]+\'</b></font>\';}};
istek.send(veri_yolla);}

function yenile(katman,veri){
adres = \'index.php?fsurum=\'+veri;
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../dosyalar/yukleniyor.gif" width="18" height="18" alt="." title="\'+jsl["yukleniyor"]+\'">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}

function duyuru(katman){
adres = \'index.php?duyuru=forum\';
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../dosyalar/yukleniyor2.gif" width="220" height="19" alt="." title="\'+jsl["yukleniyor"]+\'">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}';

$tarih = time();
if (($ayarlar['duyuru_tarihi']+86400) < $tarih)
{
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tarih' WHERE etiket='duyuru_tarihi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$javascript_kodu .= 'duyuru(\'katman_duyuru1\');
	yenile(\'katman_surum2\', \''.$ayarlar['surum'].'\');';
}

$javascript_kodu .= '
// -->
</script>';

// RESMİ DUYURU EKRANI - SONU //





// GD kütüphanesi bilgisi
$gd_bilgisi = '';
if (@extension_loaded('gd'))
{
	$gd_bilgi = @gd_info();

	$gd_bilgisi .= $ly['gd_bilgisi'].': '.$gd_bilgi['GD Version'];

	if ($gd_bilgi['PNG Support'] == true)
		$gd_bilgisi .= '<br>'.$ly['png_destekleniyor'];

	else $gd_bilgisi .= '<br><font color="#ff0000">'.$ly['png_hata'].'</font></font>';
}
else $gd_bilgisi .= '<font color="#ff0000">'.$ly['gd_hata'].'</font><br>';



// Gzip sıkıştırma desteği
if (@extension_loaded('zlib')) $gzip = '<font color="#007900">'.$ly['var'].'</font>';
else $gzip = '<font color="#ff0000"><b>'.$ly['yok'].'</b></font>';



// Sunucunun register_globals ayarına bakılıyor
if(ini_get('register_globals'))
{
	$register_globals = '<font color="#ff0000">'.$ly['register_globals_hata'][0].'<br><a href="https://www.phpkf.com/k820-registerglobals-evrensel-kayit-ozelligini-kapatma.html" target="_blank">'.$ly['register_globals_hata'][1].'</a></font>';
}
else $register_globals = '<font color="#007900">'.$ly['kapali'].'</font>';



// Sunucunun safe_mode ayarına bakılıyor
if(@ini_get('safe_mode')) $safe_mode = '<font color="#007900">'.$ly['acik'].'</font>';
else $safe_mode = $ly['kapali'];



// Sunucu yazılım ve sürüm bilgileri
if (@PHP_OS) $sunucu_is = @PHP_OS;
elseif (isset($_ENV['TERM'])) $sunucu_is = $_ENV['TERM'];
elseif (isset($_ENV['OS'])) $sunucu_is = $_ENV['OS'];



// .htaccess ve mod_rewrite kontrolü
$apache = get_extension_funcs('apache2handler');
if ($apache) $apache_modul = in_array('mod_rewrite', $apache);
if (isset($apache_modul)) $moduller = @apache_get_modules();
else $moduller[0] = 'mod_rewrite';
if(!isset($moduller)) $moduller[0] = 'mod_rewrite';
$mod_rewrite = in_array('mod_rewrite', $moduller);


if (!@is_file('../.htaccess'))
	$htaccess = '<font color="#ff0000">'.$ly['htaccess_hata'][0].'</font><br>'.$ly['htaccess_hata'][1].'';

elseif ((!isset($mod_rewrite)) OR ($mod_rewrite != '1'))
	$htaccess = '<font color="#ff0000">'.$ly['mod_rewrite_hata'][0].'</font><br>'.$ly['mod_rewrite_hata'][1];

else $htaccess = '<font color="#007900">'.$ly['sorun_yok'].'</font>';




// Veritabanı boyutu hazırlanıyor
$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$toplam_boyut = 0;
while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
$toplam_boyut += ($tablo_bilgileri['Data_length'] + $tablo_bilgileri['Index_length']);

$vt_boyutu = NumaraBicim($toplam_boyut/1024/1024, 2).' mb';



// Bağlantılar, dil değişkenlerinden hazırlanıyor
$vt_yonetim_tikla = '<a href="vt_yonetim.php">'.$ly['tiklayin'].'</a>';
$mysql_tikla = '<a href="show_status.php">'.$ly['tiklayin'].'</a>';
$sunucu_bilgi_tikla = '<a href="phpinfo.php">'.$ly['tiklayin'].'</a>';

$ly['vt_yonetim_tikla'] = str_replace('{TIKLAYIN}', $vt_yonetim_tikla, $ly['vt_yonetim_tikla']);
$ly['mysql_tikla'] = str_replace('{TIKLAYIN}', $mysql_tikla, $ly['mysql_tikla']);
$ly['sunucu_bilgi_tikla'] = str_replace('{TIKLAYIN}', $sunucu_bilgi_tikla, $ly['sunucu_bilgi_tikla']);



// Açılış tarihi, sürüm, denetle
$acilis_tarihi = zonedate2('d.m.Y', $ayarlar['saat_dilimi'], false, $ayarlar['site_acilis']);
$surum_denetle = '<a href="javascript:void(0);" onclick="yenile(\'katman_surum2\', \''.$ayarlar['surum'].'\')">'.$ly['surumu_denetle'].'</a>';
$phpkf_surum = $ayarlar['surum']. ' &nbsp; ';



// Tema uygulanıyor
$sayfa_adi = $ly['yonetim_anasayfa'];
$sayfa_baslik = $ly['yonetim_anasayfa'];
include_once('bilesenler/sayfa_baslik.php');

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/index.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>