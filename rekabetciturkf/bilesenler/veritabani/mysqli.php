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



//  MYSQLi (improved)  //

class sinif_vt
{
	var $baglanti;
	var $veritabani;
	var $sorgu;
	var $dizi;
	var $hata_cikti;
	var $karakter = 'utf8';


	// VERİTABANI BAĞLANTISI //
	function baglan($adres, $kullanici, $sifre)
	{
		global $ayarlar;
		if (!isset($ayarlar['vt_hata'])) $ayarlar['vt_hata'] = 1;

		$baglanti = @mysqli_connect($adres, $kullanici, $sifre);
		if ($baglanti)
		{
			$this->baglanti = $baglanti;
			return $baglanti;
		}

		else
		{
			if ($ayarlar['vt_hata'] == 1) $this->hata_cikti = $this->hata_cikti = mysqli_connect_error();
			else $this->hata_cikti = '';
			return false;
		}
	}

	// VERİTABANI SEÇİMİ //
	function sec($vtadi)
	{
		$this->veritabani = mysqli_select_db($this->baglanti, $vtadi) or $this->hata_cikti = mysqli_error($this->baglanti);

		if (!@mysqli_set_charset($this->baglanti, $this->karakter))
		{
			$this->hata_cikti = 'Karakter set seçimi başarısız !';
			return false;
		}
		else return $this->veritabani;
	}

	// VERİTABANI SORGUSU //
	function query($cumle)
	{
		$sonuc = mysqli_query($this->baglanti, $cumle);
		if (!$sonuc)
		{
			$this->hata_cikti = 'Sorgu başarısız !';
			$this->sorgu = $cumle;
			return false;
		}
		/*else
		{
			if ( !preg_match("/\/yonetim\//", $_SERVER['REQUEST_URI'])
			AND !preg_match("/^SELECT etiket,deger FROM phpkf_ayarlar/", $cumle)
			AND !preg_match("/^SELECT deger FROM phpkf_yasaklar/", $cumle)
			AND !preg_match("/^UPDATE phpkf_oturumlar SET son_hareket/", $cumle)
			AND !preg_match("/FROM phpkf_duyurular WHERE/", $cumle)
			 )
			{
				$yolla = '-----------------'."\r\n".
				'Sorgu:   '.$cumle."\r\n";

				$dosya_adi = 'bilesenler/log/veritabani.log.php';
				$dosya = @fopen($dosya_adi, 'a');
				@flock($dosya, 2);
				@fwrite($dosya, $yolla);
				@flock($dosya, 3);
				@fclose($dosya);
			}

			return $sonuc;
		}*/

		else return $sonuc;
	}

	// SONUÇ DİZİ ALMA - ALAN ISMI VE DEĞERİ //
	function fetch_assoc($sonuc)
	{
		$this->dizi = mysqli_fetch_assoc($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA - ALAN SIRA NO VE DEĞERİ //
	function fetch_row($sonuc)
	{
		$this->dizi = mysqli_fetch_row($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA- ALAN ISMI, SIRA NO VE DEĞERİ //
	function fetch_array($sonuc)
	{
		$this->dizi = mysqli_fetch_array($sonuc, MYSQLI_BOTH);
		return $this->dizi;
	}

	// SONUÇ SAYI ALMA //
	function num_rows($sonuc)
	{
		$this->dizi = mysqli_num_rows($sonuc);
		return $this->dizi;
	}

	// SONUÇ ALAN ALMA //
	function num_fields($sonuc)
	{
		$this->dizi = mysqli_num_fields($sonuc);
		return $this->dizi;
	}

	// ETKİLENEN SATIR SAYISI ALMA
	function affected_rows()
	{
		return $this->dizi = mysqli_affected_rows($this->baglanti);
	}

	// GİRİŞ YAPILAN ID NUMARASI
	function insert_id()
	{
		return $this->dizi = mysqli_insert_id($this->baglanti);
	}

	// GİRDİ TEMİZLEME
	function real_escape_string($cumle)
	{
		return $this->dizi = mysqli_real_escape_string($this->baglanti, $cumle);
	}

	// MySQL SÜRÜM ALMA
	function get_server_info()
	{
		return mysqli_get_server_info($this->baglanti);
	}

	// HAFIZAYI TEMİZLE
	function free_result($sonuc)
	{
		mysqli_free_result($sonuc);
	}

	// MYSQL KAPATMA
	function close()
	{
		mysqli_close($this->baglanti);
	}

	// HATA ALMA //
	function hata_ver()
	{
		global $ayarlar, $vt_hata_tablo;
		if (!isset($ayarlar['vt_hata'])) $ayarlar['vt_hata'] = 2;

		$hata_no = mysqli_errno($this->baglanti);
		$hata = mysqli_error($this->baglanti);

		if (date('I') == 1) $yaz_saati = 3600;
		else $yaz_saati = 0;
		$tarih = time()+$yaz_saati;
		$bicim_tarih = date('d.m.Y- H:i:s', $tarih);

		$yolla = 'Tip:   Veritabanı Sorgu Hatası'."\r\n".
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