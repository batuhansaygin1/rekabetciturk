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


if (!defined('DOSYA_AYAR')) include '../../ayar.php';

if ( (isset($_POST['yedekle'])) AND ($_POST['yedekle'] == 'yedek_al') ):

if (!defined('DOSYA_GERECLER')) include '../../bilesenler/gerecler.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../bilesenler/kullanici_kimlik.php';



if ($kullanici_kim['id'] != 1)
{
	header('Location: ../hata.php?hata=151');
	exit();
}



// gelişmiş yedekleme adımları  //

$insert_sayisi = 1;

if (!isset($_POST['adim'])) $insert_adim = 0;
else $insert_adim = $_POST['adim'];

if (!isset($_POST['devam'])) $insert_devam = 0;
else $insert_devam = $_POST['devam'];


if ( ($insert_adim == 0) AND ($insert_devam == 0) )
$sorgu_limit = '';

else $sorgu_limit = "LIMIT $insert_devam,$insert_adim";



//	çift tıklanma olasılığına karşı 1 saniye bekleniyor
sleep(1);


$sira = 0;

$genel_cikti = "\n";
$genel_cikti .= '--		'.$ayarlar['anasyfbaslik'].' FORUMLARI VERiTABANI YEDEĞi';
$genel_cikti .= "\n";
$genel_cikti .= '--		TARiH: '.zonedate2($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, time());
$genel_cikti .= "\n";
$genel_cikti .= '--		SUNUCU ADRESi: http://'.$ayarlar['alanadi'].$ayarlar['f_dizin'];
$genel_cikti .= "\n\n";



//  SEÇİLİ TABLOLARIN VERİLERİ TEKER TEKER ALINIYOR    //

foreach ($_POST['tablo'] as $ytablo)
{
	$ytablo = zkTemizle($ytablo);

	if ($insert_devam == 0)
	{
		$vtsonuc = $vt->query("SHOW CREATE TABLE `$ytablo`") or die ($vt->hata_ver());
		$tablo_olustur = $vt->fetch_row($vtsonuc);

		$genel_cikti .= "\n\n\n--		`$ytablo` TABLOSU VERiLERi\n\n";
		$genel_cikti .= "DROP TABLE IF EXISTS `$ytablo`;\n\n";
		$genel_cikti .= $tablo_olustur[1];
		$genel_cikti .= ";\n\n";
	}


	// Tablodaki int (sayı) alanları lınıyor
	$vtsonuc3 = $vt->query("SHOW FIELDS FROM `$ytablo`") or die ($vt->hata_ver());

	$i=0;
	while ($alan_tipi = $vt->fetch_assoc($vtsonuc3))
	{
		$tip_dizi[$i] = $alan_tipi['Type'];
		$i++;
	}


	// Tablonun verileri çekiliyor
	$vtsonuc2 = $vt->query("SELECT * FROM `$ytablo` $sorgu_limit") or die ($vt->hata_ver());
	$alan_sayisi = $vt->num_fields($vtsonuc2);

	// tablo satır satır taranıyor
	while ($tablo_verileri = $vt->fetch_row($vtsonuc2))
	{
		$genel_cikti .= "INSERT INTO `$ytablo` VALUES (";

		// alanlardaki veriler VALUES içine yazdırılıyor
		for ($i=0; $i < $alan_sayisi; $i++)
		{
			// alan int (sayı) alanı ise tırnak işareti arasına koyma
			if (!preg_match('/int/i', $tip_dizi[$i]))
			$veri = '\''.addslashes($tablo_verileri[$i]).'\'';

			else
			{
				// int verisi NULL ise NULL yaz
				if (is_null($tablo_verileri[$i])) $veri = 'NULL';
				else $veri = addslashes($tablo_verileri[$i]);
			}

			// satır atlama kodunu \r\n yap
			$genel_cikti .= str_replace("\r\n",'\r\n',$veri);

			// her alan arasına virgül koy
			if ($i < ($alan_sayisi-1)) $genel_cikti .= ', ';
		}

		// VALUES parantezini kapat
		$genel_cikti .= ");\n\n";
	}
}




//*****************		GZİP BAŞI	********************//

if ( (isset($_POST['gzip'])) AND ($_POST['gzip'] == 1) )
{
	if(!@extension_loaded('zlib'))
	{
		header('Location: ../hata.php?hata=155');
		exit();
	}

	//	dönemsel kalan kontrolü fonsiyonu	//

	function gzip_PrintFourChars($Val)
	{
		$return = '';
		for ($i = 0; $i < 4; $i ++)
		{
			$return .= chr($Val % 256);
			$Val = floor($Val / 256);
		}
		return $return;
	} 

	//	$genel_cikti değişkeni $contents değişkenine aktarılıyor	//
	$contents = $genel_cikti;

	ob_start();
	ob_implicit_flush(0);

	//	çıktı yazdırılıyor	//
	echo $genel_cikti;

	//	boyut bilgisi	//
	$Size = strlen($contents);

	//	dönemsel kalan kontrolü bilgisi	//
	$Crc = crc32($contents);
	$contents = ob_get_contents();
	$contents = gzcompress($contents, 9);

	//	ekran temizleniyor	//
	ob_end_clean();

	//	DOSYANIN İSMİ BELİRLENİYOR	//
	header('Content-Type: application/x-gzip; name="phpkf_vt_yedek_'.zonedate2('d-m-Y', $ayarlar['saat_dilimi'], false, time()).'.sql.gz"');
	header('Content-disposition: attachment; filename=phpkf_vt_yedek_'.zonedate2('d-m-Y', $ayarlar['saat_dilimi'], false, time()).'.sql.gz');

	//	gzip başlık çıktısı	//
	echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";

	$contents = substr($contents, 0, strlen($contents) - 4);

	//	yazdırılıyor //
	echo $contents;

	//	crc ve boyut bilgileri	//
	echo gzip_PrintFourChars($Crc);
	echo gzip_PrintFourChars($Size);
}


//***************	NORMAL DOSYA ***************//

else
{
	//	DOSYANIN İSMİ BELİRLENİYOR	//
	header('Content-Type:text/html; charset=UTF-8');
	header('Content-Type: text/x-delimtext; name="phpkf_vt_yedek_'.zonedate2('d-m-Y', $ayarlar['saat_dilimi'], false, time()).'.sql"');
	header('Content-disposition: attachment; filename=phpkf_vt_yedek_'.zonedate2('d-m-Y', $ayarlar['saat_dilimi'], false, time()).'.sql');

	//	çıktı yazdırılıyor	//
	echo $genel_cikti;
}
endif;

?>