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



//  MSSQL (Microsoft SQL)  //

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

		$baglanti = @mssql_connect($adres, $kullanici, $sifre);
		if ($baglanti)
		{
			$this->baglanti = $baglanti;
			return $baglanti;
		}
		else
		{
			if ($ayarlar['vt_hata'] == 1) $this->hata_cikti = mssql_get_last_message();
			else $this->hata_cikti = '';
			return false;
		}
	}

	// VERİTABANI SEÇİMİ //
	function sec($vtadi)
	{
		$this->veritabani = mssql_select_db($vtadi) or $this->hata_cikti = mssql_get_last_message();
		return $this->veritabani;
	}

	// VERİTABANI SORGUSU //
	function query($cumle)
	{
		$sonuc = mssql_query($cumle);
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
		$this->dizi = mssql_fetch_assoc($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA - ALAN SIRA NO VE DEĞERİ //
	function fetch_row($sonuc)
	{
		$this->dizi = mssql_fetch_row($sonuc);
		return $this->dizi;
	}

	// SONUÇ DİZİ ALMA- ALAN ISMI, SIRA NO VE DEĞERİ //
	function fetch_array($sonuc)
	{
		$this->dizi = mssql_fetch_array($sonuc);
		return $this->dizi;
	}

	// SONUÇ SAYI ALMA //
	function num_rows($sonuc)
	{
		$this->dizi = mssql_num_rows($sonuc);
		return $this->dizi;
	}

	// SONUÇ ALAN ALMA //
	function num_fields($sonuc)
	{
		$this->dizi = mssql_num_fields($sonuc);
		return $this->dizi;
	}

	// ETKİLENEN SATIR SAYISI ALMA
	function affected_rows()
	{
		return $this->dizi = mssql_affected_rows($this->baglanti);
	}

	// GİRİŞ YAPILAN ID NUMARASI
	function insert_id()
	{
		return $this->dizi = mssql_query("SELECT @@identity", $this->baglanti);
	}

	// GİRDİ TEMİZLEME
	function real_escape_string($sonuc)
	{
		if(get_magic_quotes_gpc()) $yazi = stripslashes($yazi);
		$yazi = str_replace("'","''",$yazi);
		return $this->dizi = $yazi;
	}

	// MSSQL SÜRÜM ALMA
	function get_server_info()
	{
		return mssql_get_server_info();
	}

	// HAFIZAYI TEMİZLE
	function free_result($sonuc)
	{
		mssql_free_result($sonuc);
	}

	// MSSQL KAPATMA
	function close()
	{
		mssql_close($this->baglanti);
	}

	// HATA ALMA //
	function hata_ver()
	{
		global $ayarlar, $vt_hata_tablo;
		if (!isset($ayarlar['vt_hata'])) $ayarlar['vt_hata'] = 2;

		$hata = mssql_get_last_message();

		if (date('I') == 1) $yaz_saati = 3600;
		else $yaz_saati = 0;
		$tarih = time()+$yaz_saati;
		$bicim_tarih = date('d.m.Y- H:i:s', $tarih);

		$yolla =  'Tip:   Veritabanı Sorgu Hatası'."\r\n".
		'Tarih:   '.$bicim_tarih."\r\n".
		'Adres:  '.@$_SERVER['REQUEST_URI']."\r\n".
		'IP:   '.@$_SERVER['REMOTE_ADDR']."\r\n".
		'Hata:   '.$hata."\r\n".
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