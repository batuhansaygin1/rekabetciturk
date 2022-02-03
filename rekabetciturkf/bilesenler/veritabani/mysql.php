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

$phpkf_dosya_surum = '2.10';



//  MYSQL  //

class sinif_vt
{
	var $baglanti;
	var $veritabani;
	var $sorgu;
	var $dizi;
	var $hata_cikti;
	var $karakter = 'utf8';
	var $karakter2 = 'utf8_general_ci';


	// VERİTABANI BAĞLANTISI //
	function baglan($adres, $kullanici, $sifre)
	{
		global $ayarlar;
		if (!isset($ayarlar['vt_hata'])) $ayarlar['vt_hata'] = 1;

		$baglanti = @mysql_connect($adres, $kullanici, $sifre);
		if ($baglanti)
		{
			$this->baglanti = $baglanti;
			return $baglanti;
		}
		else
		{
			if ($ayarlar['vt_hata'] == 1) $this->hata_cikti = mysql_error();
			else $this->hata_cikti = '';
			return false;
		}
	}

	// VERİTABANI SEÇİMİ //
	function sec($vtadi)
	{
		$this->veritabani = mysql_select_db($vtadi) or $this->hata_cikti = mysql_error();

		if (!mysql_query("SET NAMES '".$this->karakter."'"))
		{
			$this->hata_cikti = 'Karakter seçimi başarısız "SET NAMES"';
			return false;
		}

		else if (!mysql_query("SET CHARACTER SET '".$this->karakter."'"))
		{
			$this->hata_cikti = 'Karakter değişimi başarısız "SET CHARACTER SET"';
			return false;
		}

		else if (!mysql_query("SET COLLATION_CONNECTION='".$this->karakter2."'"))
		{
			$this->hata_cikti = 'Karakter değişimi başarısız "SET COLLATION_CONNECTION"';
			return false;
		}
		else return $this->veritabani;
	}

	// VERİTABANI SORGUSU //
	function query($cumle)
	{
		$sonuc = mysql_query($cumle);
		if (!$sonuc)
		{
			$this->hata_cikti = 'Sorgu başarısız !';
			$this->sorgu = $cumle;
			return false;
		}
		else return $sonuc;
	}

	// SONUÇ DİZİ ALMA - ALAN ISMI VE DEĞERİ //
	function fetch_assoc($sonuc)
	{
		$this->dizi = mysql_fetch_assoc($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA - ALAN SIRA NO VE DEĞERİ //
	function fetch_row($sonuc)
	{
		$this->dizi = mysql_fetch_row($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA- ALAN ISMI, SIRA NO VE DEĞERİ //
	function fetch_array($sonuc)
	{
		$this->dizi = mysql_fetch_array($sonuc);
		return $this->dizi;
	}

	// SONUÇ SAYI ALMA //
	function num_rows($sonuc)
	{
		$this->dizi = mysql_num_rows($sonuc);
		return $this->dizi;
	}

	// SONUÇ ALAN ALMA //
	function num_fields($sonuc)
	{
		$this->dizi = mysql_num_fields($sonuc);
		return $this->dizi;
	}

	// ETKİLENEN SATIR SAYISI ALMA
	function affected_rows()
	{
		return $this->dizi = mysql_affected_rows($this->baglanti);
	}

	// GİRİŞ YAPILAN ID NUMARASI
	function insert_id()
	{
		return $this->dizi = mysql_insert_id($this->baglanti);
	}

	// GİRDİ TEMİZLEME
	function real_escape_string($cumle)
	{
		return $this->dizi = mysql_real_escape_string($cumle);
	}

	// MySQL SÜRÜM ALMA
	function get_server_info()
	{
		return mysql_get_server_info();
	}

	// HAFIZAYI TEMİZLE
	function free_result($sonuc)
	{
		mysql_free_result($sonuc);
	}

	// MYSQL KAPATMA
	function close()
	{
		mysql_close($this->baglanti);
	}

	// HATA ALMA //
	function hata_ver()
	{
		global $ayarlar, $vt_hata_tablo;
		if (!isset($ayarlar['vt_hata'])) $ayarlar['vt_hata'] = 2;

		$hata_no = mysql_errno($this->baglanti);
		$hata = mysql_error($this->baglanti);

		if (date('I') == 1) $yaz_saati = 3600;
		else $yaz_saati = 0;
		$tarih = time()+$yaz_saati;
		$bicim_tarih = date('d.m.Y- H:i:s', $tarih);

		$yolla =  'Tip:   Veritabanı Sorgu Hatası'."\r\n".
		'Tarih:   '.$bicim_tarih."\r\n".
		'Adres:  '.@$_SERVER['REQUEST_URI']."\r\n".
		'IP:   '.@$_SERVER['REMOTE_ADDR']."\r\n".
		'Hata:   '.$hata."\r\n".
		'HataNo:   '.$hata_no."\r\n".
		'Sorgu:   '.$this->sorgu."\r\n\r\n";

		$dosya_adi = 'bilesenler/log/veritabani.log.php';
		$dosya = @fopen($dosya_adi, 'a');
		@flock($dosya, 2);
		@fwrite($dosya, $yolla);
		@flock($dosya, 3);
		@fclose($dosya);

		if ($ayarlar['vt_hata'] == 1)
		{
			$yolla = $vt_hata_tablo[0].$this->hata_cikti.$vt_hata_tablo[1];
			$yolla .= '<b>Sorgu:</b> '.$this->sorgu;
			$yolla .= '<br /><b>Hata no:</b> '.$hata_no;
			$yolla .= '<br /><b>Hata:</b> '.$hata.'<br />';
			$yolla .= $vt_hata_tablo[2];
			return $yolla;
		}
		elseif ($ayarlar['vt_hata'] == 2)
		{
			$yolla = $vt_hata_tablo[0].$this->hata_cikti.$vt_hata_tablo[1];
			$yolla .= '<center>Hata ayrıntısı kapalı.</center>';
			$yolla .= $vt_hata_tablo[2];
			return $yolla;
		}
		else return $vt_hata_tablo[3];
	}
}

?>