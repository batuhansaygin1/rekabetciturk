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
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';
$uyumlu_surum = '2.10'; //$ayarlar['surum'];


// site kurucusu değilse hata ver
if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


// eklenti yardım konuları
$yardim_konulari = 'Ayrıntılı bilgi için aşağıdaki konulara bakın.<br><br><a href="http://www.phpkf.com/k1902-eklentiler-kurulum-kaldirma-ve-etkisizlestirme.html"><b>Eklenti Yükleme, Kurulum, Kaldırma ve Etkisizleştirme</b></a><br><br><a href="http://www.phpkf.com/k1904-eklenti-islemlerinde-olusabilecek-hatalar.html"><b>Oluşabilecek Hatalar</b></a>';




//  XML DOSYASI OKUMA FONKSİYONU    //

function xml_oku($dosya)
{
	global $ayarlar;
	global $tablo_oneki;
	global $forum_index;
	global $portal_index;

	$degistir = 0;
	$etkin_degistir = 0;
	$ekle = 0;
	$olustur = 0;
	$kur_veritabani = 0;
	$kaldir_veritabani = 0;
	$etkin_veritabani = 0;
	$etkisiz_veritabani = 0;

	$bul = array('{VT_ONEK}', '{FORUM_INDEX}', '{PORTAL_INDEX}');
	$cevir = array($tablo_oneki, $forum_index, $portal_index);

	$ebilgi = new XMLReader();
	$ebilgi->open($dosya, 'UTF-8');

	while (@$ebilgi->read())
	{
		if ($ebilgi->nodeType == XMLReader::ELEMENT)
			$etiket = $ebilgi->name;

		elseif ( ($ebilgi->nodeType == XMLReader::TEXT) OR ($ebilgi->nodeType == XMLReader::CDATA) )
		{
			if ($etiket == 'degistirilecek_dosya')
			{
				$dizi[$etiket][$degistir] = str_replace($bul, $cevir, $ebilgi->value);
				$degistir++;
			}

			elseif ($etiket == 'etkin_degistirilecek_dosya')
			{
				$dizi[$etiket][$etkin_degistir] = str_replace($bul, $cevir, $ebilgi->value);
				$etkin_degistir++;
			}

			elseif ($etiket == 'eklenecek_dosya')
			{
				$dizi[$etiket][$ekle] = str_replace($bul, $cevir, $ebilgi->value);
				$ekle++;
			}

			elseif ($etiket == 'dizin_olustur')
			{
				$dizi[$etiket][$olustur] = str_replace($bul, $cevir, $ebilgi->value);
				$olustur++;
			}

			elseif ($etiket == 'kur_veritabani')
			{
				$dizi[$etiket][$kur_veritabani] = str_replace($bul, $cevir, $ebilgi->value);
				$kur_veritabani++;
			}

			elseif ($etiket == 'kaldir_veritabani')
			{
				$dizi[$etiket][$kaldir_veritabani] = str_replace($bul, $cevir, $ebilgi->value);
				$kaldir_veritabani++;
			}

			elseif ($etiket == 'etkin_veritabani')
			{
				$dizi[$etiket][$etkin_veritabani] = str_replace($bul, $cevir, $ebilgi->value);
				$etkin_veritabani++;
			}

			elseif ($etiket == 'etkisiz_veritabani')
			{
				$dizi[$etiket][$etkisiz_veritabani] = str_replace($bul, $cevir, $ebilgi->value);
				$etkisiz_veritabani++;
			}


			elseif ($etiket == 'kod_bul')
				$dizi[$etiket][$degistir-1][] = $ebilgi->value;

			elseif ($etiket == 'kod_degistir')
				$dizi[$etiket][$degistir-1][] = $ebilgi->value;

			elseif ($etiket == 'etkin_kod_bul')
				$dizi[$etiket][$etkin_degistir-1][] = $ebilgi->value;

			elseif ($etiket == 'etkin_kod_degistir')
				$dizi[$etiket][$etkin_degistir-1][] = $ebilgi->value;

			else $dizi[$etiket] = $ebilgi->value;
		}
	}
	$ebilgi->close();
	return(@$dizi);
}



//  DİZİN-DOSYA SIRALAMA    //

function DizinDosya_Ac($ftp_baglanti, $dzn_chmod, $dsy_chmod, $ftp_kok, $yol)
{
	$cikis = '';
	$dizin = opendir('../../'.$yol);

	while ( gettype($bilgi = readdir($dizin)) != 'boolean' )
	{
		if ( (is_dir('../../'.$yol.'/'.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
		{
			$cikis .= "<br><br> &nbsp; <b>Dizin:</b>&nbsp; ";
			$cikis .= HakDegistir($ftp_baglanti, $dzn_chmod, $ftp_kok, $yol.'/'.$bilgi);
			$cikis .= DizinDosya_Ac($ftp_baglanti, $dzn_chmod, $dsy_chmod, $ftp_kok, $yol.'/'.$bilgi);
		}

		elseif ( ($bilgi != '.') AND ($bilgi != '..') )
		{
			$cikis .= '<br><br> &nbsp; <b>Dosya:</b> &nbsp; ';
			$cikis .= HakDegistir($ftp_baglanti, $dsy_chmod, $ftp_kok, $yol.'/'.$bilgi);
		}
	}
	closedir($dizin);
	return $cikis;
}



//  DİZİN-DOSYA HAKLARINI DEĞİŞTİRME    //

function HakDegistir($ftp_baglanti, $chmod, $ftp_kok, $yol)
{
	if (ftp_site($ftp_baglanti, "CHMOD $chmod $ftp_kok/$yol") !== false)
		return "$yol<font color=\"#669900\"><b> &nbsp; Değiştirildi</b></font>";

	else
	{
		if (chmod('../../'.$yol, '0777')) return "$yol<font color=\"#669900\"><b> &nbsp; Değiştirildi</b></font>";
		else return "$yol<font color=\"#ff0000\"><b> &nbsp; Değiştirilemedi</b></font>";
	}
	return true;
}




		//  phpkf_eklenti SINIF - BAŞI    //

class phpkf_eklenti
{
	var $eklenti_ham;
	var $eklenti_cikis;
	var $hata;


	// dosya değiştirme için denetleniyor
	function dd_denetle($dosya)
	{
		if (!@is_file($dosya))
		{
			$this->hata = 'dosya yok';
			return false;
		}

		elseif (@touch($dosya))
		{
			if (!@is_writable($dosya))
			{
				$this->hata = 'yazma hakkı yok';
				return false;
			}
			else return true;
		}

		else
		{
			$this->hata = 'yazma hakkı yok';
			return false;
		}
	}


	// dosya kopyalama için denetleniyor
	function do_denetle($dosya, $dizin)
	{
		$dosyak = preg_replace('|(.*?)/([a-z0-9_\-.&]+?)$|si', '\\2', $dosya);
		$dosyak = '../eklentiler/'.$dizin.'/'.$dosyak;

		if (!@is_file($dosyak))
		{
			$this->hata = 'kopyalanacak dosya yok';
			return false;
		}

		elseif (!@touch($dosyak))
		{
			$this->hata = 'kopyalanacak dosyaya okuma hakkı yok';
			return false;
		}

		elseif (@is_file($dosya))
		{
			if (!@is_writable($dosya)) $this->hata = 'dosya var, üzerine yazma hakkı yok';
			else $this->hata = 'dosya var';
			return false;
		}

		elseif (@touch($dosya))
		{
			if (!@is_writable($dosya))
			{
				$this->hata = 'dizine yazma hakkı yok';
				return false;
			}

			else
			{
				@unlink($dosya);
				return true;
			}
		}

		else
		{
			$this->hata = 'dizine yazma hakkı yok';
			return false;
		}
	}


	// dosya kopyalama
	function dosya_kopyala($dosya, $dizin)
	{
		global $_SERVER;
		$dosyat = preg_replace('|(.*?)/([a-z0-9_\-.&]+?)$|si', '\\2', $dosya);
		$dosyak = '../eklentiler/'.$dizin.'/'.$dosyat;

		if (!@is_file($dosyak))
		{
			$this->hata = 'kopyalanacak dosya yok';
			return false;
		}

		elseif (@is_file($dosya))
		{
			if ($this->dosya_yedekle($dosya, $dizin));
			if (!@copy($dosyak, $dosya)) return false;
			//if ($_SERVER['HTTP_HOST'] != 'localhost') @chmod($dosya, '0777');
			return true;
		}

		elseif (@copy($dosyak, $dosya))
		{
			//if ($_SERVER['HTTP_HOST'] != 'localhost') @chmod($dosya, '0777');
			return true;
		}

		else
		{
			$this->hata = 'dizine yazma hakkı yok';
			return false;
		}
	}


	// dosya silme için denetleniyor
	function ds_denetle($dosya)
	{
		if (!@is_file($dosya))
		{
			$this->hata = 'dosya yok';
			return false;
		}

		elseif (!@touch($dosya))
		{
			$this->hata = 'silme hakkı yok';
			return false;
		}

		else return true;
	}


	// dosya siliyor
	function dosya_silme($dosya)
	{
		if (!@is_file($dosya))
		{
			$this->hata = 'dosya yok';
			return false;
		}

		elseif (@unlink($dosya)) return true;

		else
		{
			$this->hata = 'silme hakkı yok';
			return false;
		}
	}


	// dizin oluşturma için denetleniyor
	function dio_denetle($dizin)
	{
		if (@opendir($dizin))
		{
			$this->hata = 'dizin zaten var';
			return false;
		}

		elseif (@mkdir($dizin))
		{
			@rmdir($dizin);
			return true;
		}

		else
		{
			$this->hata = 'dizine yazma hakkı yok';
			return false;
		}
	}


	// dizin oluşturuluyor
	function dizin_olustur($dizin)
	{
		$eski_umask = umask(0);
		if (@opendir($dizin))
		{
			$this->hata = 'dizin zaten var';
			return false;
		}

		elseif (@mkdir($dizin)) return true;

		else
		{
			$this->hata = 'dizine yazma hakkı yok';
			return false;
		}
		umask($eski_umask);
	}


	// dizin silme için denetleniyor
	function dis_denetle($dizin)
	{
		if (!@is_dir($dizin))
		{
			$this->hata = 'dizin yok';
			return false;
		}

		elseif (!@fopen($dizin.'/yokla.txt', 'w'))
		{
			$this->hata = 'silme hakkı yok';
			return false;
		}

		else
		{
			@unlink($dizin.'/yokla.txt');
			return true;
		}
	}


	// dizin siliniyor
	function dizin_sil($dizin)
	{
		if (!@is_dir($dizin))
		{
			$this->hata = 'dizin yok';
			return false;
		}

		else
		{
			$dosyalar = @opendir($dizin);
			$dizin .= '/';
			while (@gettype($dosya = @readdir($dosyalar)) != 'boolean')
			{
				if ( (!@is_dir($dizin.$dosya)) AND ($dosya != '.') AND ($dosya != '..')) @unlink($dizin.$dosya);

				elseif (($dosya != '.') AND ($dosya != '..'))
				{
					$this->dizin_sil($dizin.$dosya.'/');
					@rmdir($dizin.$dosya);
				}
			}
			@closedir($dosyalar);

			if (@rmdir($dizin)) return true;
			else {$this->hata .= '<br>dizin yok'; return false;}
		}
	}


	// değiştirilecek dosya açılıyor
	function dosya_ac($dosya)
	{
		if (!($dosya_ac = @fopen($dosya,'r')))
		{
			$this->hata = $dosya.' = <font color="#ff0000">dosya açılamıyor</font>';
			return false;
		}

		else
		{
			$boyut = filesize($dosya);
			$dosya_metni = fread($dosya_ac,$boyut);
			fclose($dosya_ac);
			$this->eklenti_ham = $dosya_metni;

			return true;
		}
	}


	// dosyadaki bul kodları denetleniyor
	function bul_denetle($bul)
	{
		$t_bul = array('\\', "'", '$', '(', ')', '<', '>', '{', '}', '&', '[', ']', '|', '^', '?', '+', '*');
		$t_cevir = array('\\\\', "\'", '\$', '\(', '\)', '\<', '\>', '\{', '\}', '\&', '\[', '\]', '\|', '\^', '\?', '\+', '\*');
		$bul = @str_replace($t_bul, $t_cevir, $bul);
		$sayi = 1;


		foreach ($bul as $deger)
		{
			if (!preg_match('|'.$deger.'|si', $this->eklenti_ham))
			{
				$this->hata .= '<br><hr><b>'.$sayi.')</b><br><pre>'.htmlspecialchars(stripslashes($deger)).'</pre><hr>';
				$bulunamadi = 1;
				$sayi++;
			}
		}

		if (isset($bulunamadi)) return false;
		else return true;
	}


	// değişiklik yapılıyor
	function degistir($bul,$cevir)
	{
		$t_bul = array('\\', "'", '$', '(', ')', '<', '>', '{', '}', '&', '[', ']', '|', '^', '?', '+', '*');
		$t_cevir = array('\\\\', "\'", '\$', '\(', '\)', '\<', '\>', '\{', '\}', '\&', '\[', '\]', '\|', '\^', '\?', '\+', '\*');
		$bul = @str_replace($t_bul, $t_cevir, $bul);
		$cevir = @str_replace('\\', '\\\\', $cevir);

		$sayi = 0;
		foreach ($bul as $deger)
		{
			$bul[$sayi] = '|'.$deger.'|si';
			$sayi++;
		}

		$this->eklenti_cikis = preg_replace($bul,$cevir,$this->eklenti_ham);
	}


	// değiştirilen dosya kaydediliyor
	function dosya_kaydet($dosya)
	{
		if (@touch($dosya))
		{
			if (@is_writable($dosya))
			{
				$dosya_kaydet = fopen($dosya, 'w');
				flock($dosya_kaydet, 2);
				fwrite($dosya_kaydet, $this->eklenti_cikis);
				flock($dosya_kaydet, 3);
				fclose($dosya_kaydet);

				return true;
			}

			else
			{
				$this->hata = 'yazılamıyor';
				return false;
			}
		}

		else
		{
			$this->hata = 'yazılamıyor';
			return false;
		}
	}


	// yedekleme (değiştirilen dosyayı)
	function dosya_yedekle($dosya, $dizin)
	{
		global $_SERVER;
		$dosyak = str_replace(array('../','/'), array('',' '), $dosya);
		$dosyak = '../eklentiler/'.$dizin.'/yedek/'.$dosyak;

		if (!@is_file($dosya))
		{
			$this->hata = 'yedeklenecek dosya yok';
			return false;
		}

		elseif (@copy($dosya, $dosyak))
		{
			//if ($_SERVER['HTTP_HOST'] != 'localhost') @chmod($dosyak, '0777');
			return true;
		}

		else
		{
			$this->hata = 'yedek dizine yazma hakkı yok';
			return false;
		}
	}
}

		//  phpkf_eklenti SINIF - SONU    //





		//  KURULUM ÖNCESİ DENETİM   //

if ( (isset($_GET['kur'])) AND ($_GET['kur'] != '') ):

$_GET['kur'] = zkTemizle(trim($_GET['kur']));


// dosya adında sorun varsa
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_GET['kur']))
{
	header('Location: hata.php?hata=171');
	exit();
}


// eklentiler dizini yazma hakkı yoksa
if (!@fopen('../eklentiler/yokla.txt', 'w'))
{
	header('Location: hata.php?hata=172');
	exit();
}
else @unlink('../eklentiler/yokla.txt');


// eklenti dosyası yoksa
if (!@is_file('../eklentiler/'.$_GET['kur'].'/eklenti_bilgi.xml'))
{
	header('Location: hata.php?hata=173');
	exit();
}


// eklenti dosyası yükleniyor
$edbilgi = xml_oku('../eklentiler/'.$_GET['kur'].'/eklenti_bilgi.xml');


// eklenti sürümü uyumsuzsa
if (!preg_match('/'.$uyumlu_surum.'/', $edbilgi['uyumlu_surum']))
{
	header('Location: hata.php?hata=185');
	exit();
}



// Eklenti bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$_GET[kur]'";
$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);


// eklenti zaten kuruluysa, güncelleme değilse
if ( ($ekl_satir['kur'] == 1) AND (!isset($_GET['guncel'])) )
{
	header('Location: hata.php?hata=174');
	exit();
}


// eklenti portal içinse ve portal kullanılmıyorsa
if ( ($portal_kullan == 0) AND ($edbilgi['sistem'] != '1') )
{
	header('Location: hata.php?hata=189');
	exit();
}



// eklenti_bilgi.xml dosyası
$dosya_xml = 'eklentiler/'.$_GET['kur'].'/eklenti_bilgi.xml';


if (!isset($edbilgi['tema_dizini'])) $edbilgi['tema_dizini'] = 'varsayilan';
$esayfa_aciklama = '';



// değiştirilecek dosyalar denetleniyor

$esayfa_aciklama .= '<b>Değiştirilecek Dosyalar:</b> ';

if ( (isset($edbilgi['degistirilecek_dosya'])) AND (is_array($edbilgi['degistirilecek_dosya'])) )
{
	$sayi = 0;
	foreach($edbilgi['degistirilecek_dosya'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->dd_denetle('../'.$a))
			{
				$eklenti1->dosya_ac('../'.$a);

				if ( (!isset($edbilgi['kod_bul'][$sayi])) OR (!isset($edbilgi['kod_degistir'][$sayi])) )
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">değişiklik bilgileri yok</font>';
					$ed_hata2 = false;
				}

				elseif (!$eklenti1->bul_denetle($edbilgi['kod_bul'][$sayi]))
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">şu kod(lar) bulunamıyor: </font><br>'.$eklenti1->hata.'<br><br>';
					$ed_hata2 = false;
				}

				else
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';

					if ( (isset($ed_hata2)) AND ($ed_hata2 == false) ) $ed_hata2 = false;
					else $ed_hata2 = true;
				}
			}

			elseif ( ($eklenti1->hata == 'dosya yok') AND (preg_match('/temalar\//i', $a)) )
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';
				if ( (isset($ed_hata2)) AND ($ed_hata2 == false) ) $ed_hata2 = false;
				else $ed_hata2 = true;
			}

			else
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
				$ed_hata2 = false;
			}

			if ( ((isset($ed_hata)) AND ($ed_hata == true)) OR ($a != $dosya_xml) ) $ed_hata = true;
			else $ed_hata = false;

			unset($eklenti1);
			$sayi++;
		}
	}
}

else
{
	$esayfa_aciklama .= ' Yok';
	$ed_hata = false;
	$ed_hata2 = true;
}



// oluşturulacak dizinler denetleniyor, güncelleme değilse

$esayfa_aciklama .= '<br><br><b>Oluşturulacak Dizinler:</b>';
$olusturulacak_dizinler = ',';

if ( (isset($edbilgi['dizin_olustur'])) AND (is_array($edbilgi['dizin_olustur'])) AND (!isset($_GET['guncel'])) )
{
	foreach($edbilgi['dizin_olustur'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->dio_denetle('../'.$a))
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';
				$olusturulacak_dizinler .= $a.',';

				if ( (isset($edi_hata2)) AND ($edi_hata2 == false) ) $edi_hata2 = false;
				else $edi_hata2 = true;
			}

			else
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
				$edi_hata2 = false;
				}

			$edi_hata = true;
			unset($eklenti1);
		}
	}
}


else
{
	$esayfa_aciklama .= ' Yok';
	$edi_hata = false;
	$edi_hata2 = true;
}



// kopyalanacak dosyalar denetleniyor, güncelleme değilse

$esayfa_aciklama .= '<br><br><b>Eklenecek Dosyalar:</b>';

if ( (isset($edbilgi['eklenecek_dosya'])) AND (is_array($edbilgi['eklenecek_dosya'])) )
{
	foreach($edbilgi['eklenecek_dosya'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->do_denetle('../'.$a, $_GET['kur']))
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';

				if ( (isset($eo_hata2)) AND ($eo_hata2 == false) ) $eo_hata2 = false;
				else $eo_hata2 = true;
			}

			// dizin yoksa
			elseif ($eklenti1->hata == 'dizine yazma hakkı yok')
			{
				$dosyak = preg_replace('|(.*?)/([a-z0-9_\-.&]+?)$|si', '\\1', $a);
				// oluşturulacaksa
				if (preg_match('/,'.$dosyak.',/i', $olusturulacak_dizinler))
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';
					$eo_hata2 = true;
				}
				// tema ise geçiliyor
				elseif (preg_match('/temalar\//i', $a))
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';
					if ( (isset($eo_hata2)) AND ($eo_hata2 == false) ) $eo_hata2 = false;
					else $eo_hata2 = true;
				}

				else
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
					$eo_hata2 = false;
				}
			}

			else
			{
				if ($eklenti1->hata == 'dosya var')
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">dosya var, üzerine yazılacak</font>';
					$eo_hata2 = true;
				}

				else
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
					$eo_hata2 = false;
				}
			}

			$eo_hata = true;
			unset($eklenti1);
		}
	}
}

else
{
	$esayfa_aciklama .= ' Yok';
	$eo_hata = false;
	$eo_hata2 = true;
}



// veritabanı işlemleri görüntüleniyor, güncelleme değilse

$esayfa_aciklama .= '<br><br><b>Veritabanı İşlemleri:</b>';

if ( (isset($edbilgi['kur_veritabani'])) AND (is_array($edbilgi['kur_veritabani'])) AND (!isset($_GET['guncel'])) )
{
	$dongu = 1;
	foreach($edbilgi['kur_veritabani'] as $a)
	{
		if ($a != '')
		{
			$esayfa_aciklama .= '<br><b>Sorgu '.$dongu.' : </b> '.$a;
			$ev_hata = true;
			$dongu++;
		}
	}
}

else
{
	$esayfa_aciklama .= ' Yok';
	$ev_hata = false;
}



$esayfa_aciklama .= '<br><br><br><hr><br>';




// HERHANGİ BİR HATA VARSA  //

if ( ( (!$ed_hata) AND (!$eo_hata) AND (!$edi_hata) AND (!$ev_hata) AND (!isset($_GET['guncel'])) ) OR (!$ed_hata2) OR (!$edi_hata2) OR (!$eo_hata2) )
{
	$esayfa_aciklama .= '<font color="#ff0000"><b>Eklenti Kurulamaz !</b><br>';

	// hiçbir dosya, dizin veya veritabanı işlemi yok
	if ( (!$ed_hata) AND (!$eo_hata) AND (!$edi_hata) AND (!$ev_hata) ) $esayfa_aciklama .= '<br>Hiçbir dosya, dizin veya veritabanı işlemi yok.</font>';

	// dosya değişim hataları
	if (!$ed_hata2) $esayfa_aciklama .= '<br>Dosya değişim işlemlerinde hata(lar) var.';

	// dizin oluşturma hataları 
	if (!$edi_hata2) $esayfa_aciklama .= '<br>Dizin oluşturma işlemlerinde hata(lar) var.';

	// dosya kopyalama hataları 
	if (!$eo_hata2) $esayfa_aciklama .= '<br>Dosya kopyalama işlemlerinde hata(lar) var.';

	$esayfa_aciklama .= '</font><br><br>'.$yardim_konulari;
}




//  HİÇBİR HATA YOKSA KURULUMA DEVAM    //

else
{
	if (isset($_GET['guncel']))
	{
		$guncelek = 'guncel=1&amp;';
		if (isset($_GET['vt'])) $guncelek .= 'vt=1&amp;';
		if (isset($_GET['dosya'])) $guncelek .= 'dosya=1&amp;';
		if (isset($_GET['dizin'])) $guncelek .= 'dizin=1&amp;';
		$kur_guncelle_dugme = 'Güncelle';
		$kur_guncelle_ek = 'güncelleme';
	}

	else
	{
		$guncelek = '';
		$kur_guncelle_dugme = 'Kurulumu Başlat';
		$kur_guncelle_ek = 'kurulum';
	}

	$esayfa_aciklama .= '<br><center><font color="#669900"><b>Eklentide herhangi bir sorunla karşılaşılmadı, '.$kur_guncelle_ek.' yapabilirsiniz.</b></font>

<br><br><br>

<form action="eklentiler.php?'.$guncelek.'kur='.$_GET['kur'].'" method="post" name="form1">
<input type="hidden" name="onay" value="onay">
<input type="submit" class="dugme" value="'.$kur_guncelle_dugme.'">
</form>
	</center>';
}




//  KURULUM YAPILIYOR   //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') ):

$esayfa_aciklama = '';

if ( ( (!$ed_hata) AND (!$eo_hata) AND (!$edi_hata) AND (!$ev_hata) AND (!isset($_GET['guncel'])) ) OR (!$ed_hata2) OR (!$edi_hata2) OR (!$eo_hata2) )
	$esayfa_aciklama .= '<p align="center"><font color="#ff0000"><b>Eklentide hatalar var, kurulamaz !</b></font></p><br><br>'.$yardim_konulari;



// sorun yoksa kurulumu gerçekleştir
else
{
	$esayfa_aciklama = '';
	$vt_islem = 0;
	$dosya_islem = 0;
	$dizin_islem = 0;

	// veritabanı işlemleri yapılıyor, güncelleme değilse
	if ( (isset($edbilgi['kur_veritabani'])) AND (is_array($edbilgi['kur_veritabani'])) AND (!isset($_GET['guncel'])) )
	{
		foreach($edbilgi['kur_veritabani'] as $a)
		{
			if ($a != '')
			{
				$ev_sonuc = $vt->query($a);

				// sorguda hata varsa
				if (!$ev_sonuc)
				{
					$esayfa_aciklama .= '<br><font color="#ff0000"><b>hatalı sorgu:</b></font> '.$a.$vt->hata_ver();
					$ev_hata = false; break;
				}

				// sorguda hata yoksa
				else
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>sorun yok</b></font><br>';
					if ($ev_hata != false) $ev_hata = true;
				}
			}
		}
		$vt_islem = 1;
	}

	else {$ev_hata = true; $vt_islem = 0;}



	// veritabanı işlemlerinde hata yoksa diğer işlemlere devam
	if ($ev_hata == true)
	{
		// dosya değişlikleri yapılıyor
		if ( (isset($edbilgi['degistirilecek_dosya'])) AND (is_array($edbilgi['degistirilecek_dosya'])) )
		{
			// yedek dizini oluşturuluyor, içine index.html kopyalanıyor
			$eski_umask = umask(0);
			@mkdir('../eklentiler/'.$_GET['kur'].'/yedek');
			@copy('../eklentiler/'.$_GET['kur'].'/index.html', '../eklentiler/'.$_GET['kur'].'/yedek/index.html');
			umask($eski_umask);
			$sayi = 0;

			foreach($edbilgi['degistirilecek_dosya'] as $a)
			{
				if ($a != '')
				{
					$eklenti1 = new phpkf_eklenti();
					$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

					if ($eklenti1->dosya_ac('../'.$a))
					{
						$eklenti1->degistir($edbilgi['kod_bul'][$sayi],$edbilgi['kod_degistir'][$sayi]);
						$esayfa_aciklama .= '<br>'.$a.' = ';

						if ($eklenti1->dosya_yedekle('../'.$a, $_GET['kur']))
							$esayfa_aciklama .= '<font color="#669900"><b>yedeklendi</b></font>';
						else $esayfa_aciklama .= '<font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';

						if ($eklenti1->dosya_kaydet('../'.$a))
							$esayfa_aciklama .= ', <font color="#669900"><b>değiştirildi</b></font>';
						else $esayfa_aciklama .= ', <font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
					}

					elseif ( (preg_match('/\>dosya açılamıyor\</', $eklenti1->hata)) AND (preg_match('/temalar\//i', $a)) )
						$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';

					else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
				}

				unset($eklenti1);
				$sayi++;
			}
		}


		// dizinler oluşturuluyor, güncelleme değilse
		if ( (isset($edbilgi['dizin_olustur'])) AND (is_array($edbilgi['dizin_olustur'])) AND (!isset($_GET['guncel'])) )
		{
			$sayi = 0;
			foreach($edbilgi['dizin_olustur'] as $a)
			{
				if ($a != '')
				{
					$eklenti1 = new phpkf_eklenti();
					$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

					if ($eklenti1->dizin_olustur('../'.$a))
						$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>dizin oluşturuldu</b></font>';

					else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
				}

				unset($eklenti1);
				$sayi++;
			}
			$dizin_islem = 1;
		}


		// dosyalar kopyalanıyor, güncelleme değilse
		if ( (isset($edbilgi['eklenecek_dosya'])) AND (is_array($edbilgi['eklenecek_dosya'])) )
		{
			$sayi = 0;
			foreach($edbilgi['eklenecek_dosya'] as $a)
			{
				if ($a != '')
				{
					$eklenti1 = new phpkf_eklenti();
					$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

					if ($eklenti1->dosya_kopyala('../'.$a, $_GET['kur']))
						$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>dosya kopyalandı</b></font>';

					// tema ise geçiliyor
					elseif (preg_match('/temalar\//i', $a))
						$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';

					else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
				}

				unset($eklenti1);
				$sayi++;
			}
			$dosya_islem = 1;
		}


		// Etkisizleştirme desteği
		if (isset($edbilgi['eklenti_etkin'])) $eetkin = 1;
		else $eetkin = 2;


		if (!isset($_GET['guncel']))
		{
			// Eklenti veritabanına ekleniyor - ilk kurulum
			$vtsorgu = "INSERT INTO $tablo_eklentiler (ad,kur,etkin,vt,dosya,dizin,sistem,usurum,esurum)
			VALUES ('$_GET[kur]', '1', '$eetkin', '$vt_islem', '$dosya_islem', '$dizin_islem', '$edbilgi[sistem]', '$uyumlu_surum', '$edbilgi[eklenti_surumu]')";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$esayfa_aciklama .= '<br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Kurulum başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php#'.$_GET['kur'].'">tıklayın.</a></b>';
		}

		else
		{
			if (isset($_GET['vt'])) $vt_islem = 1;
			if (isset($_GET['dosya'])) $dosya_islem = 1;
			if (isset($_GET['dizin'])) $dizin_islem = 1;

			// Eklenti veritabanına ekleniyor - güncelleme
			$vtsorgu = "UPDATE $tablo_eklentiler SET etkin='$eetkin', vt='$vt_islem', dosya='$dosya_islem', dizin='$dizin_islem', sistem='$edbilgi[sistem]', usurum='$uyumlu_surum', esurum='$edbilgi[eklenti_surumu]' WHERE ad='$_GET[kur]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$esayfa_aciklama .= '<br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Güncelleme başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php#'.$_GET['kur'].'">tıklayın.</a></b>';
		}
	}


	// veritabanı sorgu hatası
	else $esayfa_aciklama .= '<br><br><br><br><font color="#ff0000"><b>Yukarıdaki veritabanı işleminde hata oluştu. Eklenti kurulumu durduruldu.<br>Hatalı sorgudan önce sorunsuz yapılan sorgular <u>varsa</u> bunlar gerçekleşti, işlem yarım kalmış olabilir.</b></font><br>';
}


endif; // kur onay kapatılıyor





//  BAŞLIK DOSYASI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');


//  TEMA UYGULANIYOR    //

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);

if (isset($_GET['guncel'])) $kur_guncelle_baslik = 'Eklenti Güncelleme için Denetleniyor';
else $kur_guncelle_baslik = 'Eklenti Kurulum için Denetleniyor';

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => $kur_guncelle_baslik,
'{SAYFA_KIP}' => '',
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));




		//  KALDIRMA ÖNCESİ DENETİM   //

elseif ( (isset($_GET['kaldir'])) AND ($_GET['kaldir'] != '') ):

$_GET['kaldir'] = zkTemizle(trim($_GET['kaldir']));


// dosya adında sorun varsa
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_GET['kaldir']))
{
	header('Location: hata.php?hata=171');
	exit();
}


// eklenti dosyası yoksa
if (!@is_file('../eklentiler/'.$_GET['kaldir'].'/eklenti_bilgi.xml'))
{
	header('Location: hata.php?hata=173');
	exit();
}


// eklenti dosyası yükleniyor
$edbilgi = xml_oku('../eklentiler/'.$_GET['kaldir'].'/eklenti_bilgi.xml');



// Eklenti bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$_GET[kaldir]'";
$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);


// eklenti zaten kaldırılmışsa
if (!isset($ekl_satir['kur']))
{
	header('Location: hata.php?hata=182');
	exit();
}


// eklenti_bilgi.xml dosyası
$dosya_xml = 'eklentiler/'.$_GET['kaldir'].'/eklenti_bilgi.xml';


if (!isset($edbilgi['tema_dizini'])) $edbilgi['tema_dizini'] = 'varsayilan';
$esayfa_aciklama = '';



// değiştirilecek dosyalar denetleniyor

$esayfa_aciklama .= '<b>Değiştirilecek Dosyalar:</b> ';

if ( (isset($edbilgi['degistirilecek_dosya'])) AND (is_array($edbilgi['degistirilecek_dosya'])) )
{
	$sayi = 0;
	foreach($edbilgi['degistirilecek_dosya'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->dd_denetle('../'.$a))
			{
				$eklenti1->dosya_ac('../'.$a);

				if (!$eklenti1->bul_denetle($edbilgi['kod_degistir'][$sayi]))
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">şu kod(lar) bulunamıyor: </font><br>'.$eklenti1->hata.'<br><br>';
					$ed_hata2 = false;
				}

				else
				{
					$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';

					if ( (isset($ed_hata2)) AND ($ed_hata2 == false) ) $ed_hata2 = false;
					else $ed_hata2 = true;
				}
			}

			elseif ( ($eklenti1->hata == 'dosya yok') AND (preg_match('/temalar\//i', $a)) )
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';
				if ( (isset($ed_hata2)) AND ($ed_hata2 == false) ) $ed_hata2 = false;
				else $ed_hata2 = true;
			}

			else
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
				$ed_hata2 = false;
			}

			if ( ((isset($ed_hata)) AND ($ed_hata == true)) OR ($a != $dosya_xml) ) $ed_hata = true;
			else $ed_hata = false;

			unset($eklenti1);
			$sayi++;
		}
	}
}

else
{
	$esayfa_aciklama .= ' Yok';
	$ed_hata = false;
	$ed_hata2 = true;
}



// silinecek dosyalar denetleniyor

$esayfa_aciklama .= '<br><br><b>Silinecek Dosyalar:</b>';

if ( (isset($edbilgi['eklenecek_dosya'])) AND (is_array($edbilgi['eklenecek_dosya'])) )
{
	foreach($edbilgi['eklenecek_dosya'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->ds_denetle('../'.$a, $_GET['kaldir']))
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';

				if ( (isset($es_hata2)) AND ($es_hata2 == false) ) $es_hata2 = false;
				else $es_hata2 = true;
			}

			// tema ise geçiliyor
			elseif (preg_match('/temalar\//i', $a))
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';
				if ( (isset($es_hata2)) AND ($es_hata2 == false) ) $es_hata2 = false;
				else $es_hata2 = true;
			}

			else
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
				$es_hata2 = false;
			}

			$es_hata = true;
			unset($eklenti1);
		}
	}
}

else
{
    $esayfa_aciklama .= ' Yok';
    $es_hata = false;
    $es_hata2 = true;
}



// silinecek dizinler denetleniyor

$esayfa_aciklama .= '<br><br><b>Silinecek Dizinler:</b>';

if ( (isset($edbilgi['dizin_olustur'])) AND (is_array($edbilgi['dizin_olustur'])) )
{
	foreach($edbilgi['dizin_olustur'] as $a)
	{
		if ($a != '')
		{
			$eklenti1 = new phpkf_eklenti();

			$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

			if ($eklenti1->dis_denetle('../'.$a))
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900">sorun yok</font>';

				if ( (isset($dis_hata2)) AND ($dis_hata2 == false) ) $dis_hata2 = false;
				else $dis_hata2 = true;
			}

			else
			{
				$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
				$dis_hata2 = false;
			}

			$dis_hata = true;
			unset($eklenti1);
		}
	}
}


else
{
	$esayfa_aciklama .= ' Yok';
	$dis_hata = false;
	$dis_hata2 = true;
}




// veritabanı işlemleri görüntüleniyor

$esayfa_aciklama .= '<br><br><b>Veritabanı İşlemleri:</b>';

if ( (isset($edbilgi['kaldir_veritabani'])) AND (is_array($edbilgi['kaldir_veritabani'])) )
{
	$dongu = 1;
	foreach($edbilgi['kaldir_veritabani'] as $a)
	{
		if ($a != '')
		{
			$esayfa_aciklama .= '<br><b>Sorgu '.$dongu.' : </b> '.$a;
			$ev_hata = true;
			$dongu++;
		}
	}
}

else
{
	$esayfa_aciklama .= ' Yok';
	$ev_hata = false;
}



$esayfa_aciklama .= '<br><br><br><hr><br>';


// HERHANGİ BİR HATA VARSA  //

if ( ((!$ed_hata) AND (!$es_hata) AND (!$dis_hata) AND (!$ev_hata)) OR (!$ed_hata2) OR (!$dis_hata2) OR (!$es_hata2) )
{
	$esayfa_aciklama .= '<font color="#ff0000"><b>Eklenti Kaldırılamaz !</b><br>';

	// hiçbir dosya, dizin veya veritabanı işlemi yok
	if ( (!$ed_hata) AND (!$es_hata) AND (!$dis_hata) AND (!$ev_hata) ) $esayfa_aciklama .= '<br>Hiçbir dosya, dizin veya veritabanı işlemi yok.</font>';

	// dosya değişim hataları
	if (!$ed_hata2) $esayfa_aciklama .= '<br>Dosya değişim işlemlerinde hata(lar) var.';

	// dizin silme hataları 
	if (!$dis_hata2) $esayfa_aciklama .= '<br>Dizin silme işlemlerinde hata(lar) var.';

	// dosya silme hataları 
	if (!$es_hata2) $esayfa_aciklama .= '<br>Dosya silme işlemlerinde hata(lar) var.';

	$esayfa_aciklama .= '</font><br><br>'.$yardim_konulari;
}




//  HİÇBİR HATA YOKSA KALDIRMA İŞLEMİNE DEVAM    //

else
{
	$esayfa_aciklama .= '<br><center><font color="#669900"><b>Eklentide herhangi bir sorunla karşılaşılmadı, kaldırma işlemini başlatabilirsiniz.</b></font>

<br><br><br>

<form action="eklentiler.php?kaldir='.$_GET['kaldir'].'" method="post" name="form1">
<input type="hidden" name="onay" value="onay">
<input type="submit" class="dugme" value="Kaldır">
</form>
	</center>';
}




//  KALDIRMA İŞLEMİ YAPILIYOR   //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') )
{
	$esayfa_aciklama = '';

	if ( ((!$ed_hata) AND (!$es_hata) AND (!$ev_hata)) OR (!$ed_hata2) OR (!$es_hata2) )
		$esayfa_aciklama .= '<p align="center"><font color="#ff0000"><b>Eklentide hatalar var, kaldırılamaz !</b></font></p><br>'.$yardim_konulari;


	// sorun yoksa kaldırma işlemlerini gerçekleştir
	else
	{
		$esayfa_aciklama = '';

		// veritabanı işlemleri yapılıyor
		if ( (isset($edbilgi['kaldir_veritabani'])) AND (is_array($edbilgi['kaldir_veritabani'])) )
		{
			foreach($edbilgi['kaldir_veritabani'] as $a)
			{
				if ($a != '')
				{
					$ev_sonuc = $vt->query($a);

					// sorguda hata varsa
					if (!$ev_sonuc)
					{
						$esayfa_aciklama .= '<br><font color="#ff0000"><b>hatalı sorgu:</b></font> '.$a.$vt->hata_ver();
						$ev_hata = false; break;
					}

					// sorguda hata yoksa
					else
					{
						$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>sorun yok</b></font><br>';
						if ($ev_hata != false) $ev_hata = true;
					}
				}
			}
		}

		else $ev_hata = true;



		// veritabanı işlemlerinde hata yoksa diğer işlemlere devam
		if ($ev_hata != false)
		{
			// dosya değişlikleri geri alınıyor
			if ( (isset($edbilgi['degistirilecek_dosya'])) AND (is_array($edbilgi['degistirilecek_dosya'])) )
			{
				$sayi = 0;
				foreach($edbilgi['degistirilecek_dosya'] as $a)
				{
					if ($a != '')
					{
						$eklenti1 = new phpkf_eklenti();
						$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

						if ($eklenti1->dosya_ac('../'.$a))
						{
							$eklenti1->degistir($edbilgi['kod_degistir'][$sayi],$edbilgi['kod_bul'][$sayi]);

							if ($eklenti1->dosya_kaydet('../'.$a))
								$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>değiştirildi</b></font>';

							else $esayfa_aciklama .= '<br>'.$a.' = <font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
						}

						elseif ( (preg_match('/\>dosya açılamıyor\</', $eklenti1->hata)) AND (preg_match('/temalar\//i', $a)) )
							$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';

						else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
					}

					unset($eklenti1);
					$sayi++;
				}
			}


			// dosyalar siliniyor
			if ( (isset($edbilgi['eklenecek_dosya'])) AND (is_array($edbilgi['eklenecek_dosya'])) )
			{
				$sayi = 0;
				foreach($edbilgi['eklenecek_dosya'] as $a)
				{
					if ($a != '')
					{
						$eklenti1 = new phpkf_eklenti();
						$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

						if ($eklenti1->dosya_silme('../'.$a))
							$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>dosya silindi</b></font>';

						elseif ( ($eklenti1->hata == 'dosya yok') AND (preg_match('/temalar\//i', $a)) )
							$esayfa_aciklama .= '<br>'.$a.' = <font color="#ff8800">geçiliyor...</font>';

						else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
					}

					unset($eklenti1);
					$sayi++;
				}
			}


			// dizinler siliniyor
			if ( (isset($edbilgi['dizin_olustur'])) AND (is_array($edbilgi['dizin_olustur'])) )
			{
				$sayi = 0;
				foreach($edbilgi['dizin_olustur'] as $a)
				{
					if ($a != '')
					{
						$eklenti1 = new phpkf_eklenti();
						$a = str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));

						if ($eklenti1->dizin_sil('../'.$a))
							$esayfa_aciklama .= '<br>'.$a.' = <font color="#669900"><b>dizin silindi</b></font>';

						else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
					}

					unset($eklenti1);
					$sayi++;
				}
			}


			// Eklenti veritabanından siliniyor
			$vtsorgu = "DELETE FROM $tablo_eklentiler WHERE ad='$_GET[kaldir]'";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


			$esayfa_aciklama .= '<br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Kaldırma işlemi başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php#'.$_GET['kaldir'].'">tıklayın.</a></b>';
		}


		// veritabanı sorgu hatası
		else $esayfa_aciklama .= '<br><br><br><br><font color="#ff0000"><b>Yukarıdaki veritabanı işleminde hata oluştu. Eklenti kaldırma işlemi durduruldu.<br>Hatalı sorgudan önce sorunsuz yapılan sorgular <u>varsa</u> bunlar gerçekleşti, işlem yarım kalmış olabilir.</b></font><br>';
	}
}




//  BAŞLIK DOSYASI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');


//  TEMA UYGULANIYOR    //

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => 'Eklenti Kaldırma için Denetleniyor',
'{SAYFA_KIP}' => '',
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));






		//  SİLME ÖNCESİ DENETİM   //

elseif ( (isset($_GET['sil'])) AND ($_GET['sil'] != '') ):

$_GET['sil'] = zkTemizle(trim($_GET['sil']));


// dosya adında sorun varsa
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_GET['sil']))
{
	header('Location: hata.php?hata=171');
	exit();
}


// eklenti dosyası varsa
if (@is_file('../eklentiler/'.$_GET['sil'].'/eklenti_bilgi.xml'))
{
	// eklenti dosyası yükleniyor
	$edbilgi = xml_oku('../eklentiler/'.$_GET['sil'].'/eklenti_bilgi.xml');

	// Eklenti bilgileri çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$_GET[sil]'";
	$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$ekl_satir = $vt->fetch_assoc($ekl_sonuc);

	// eklenti kurulu ise "önce kaldırın" uyarısı ver
	/*if ($ekl_satir['kur'] == 1)
	{
		header('Location: hata.php?hata=187');
		exit();
	}*/

	// Eklenti veritabanından siliniyor
	$vtsorgu = "DELETE FROM $tablo_eklentiler WHERE ad='$_GET[sil]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}

$esayfa_aciklama = '';

$eklenti1 = new phpkf_eklenti();


// silinecek dizin denetleniyor

if ($eklenti1->dis_denetle('../eklentiler/'.$_GET['sil']))
{
	$esayfa_aciklama .= '<br>../eklentiler/'.$_GET['sil'].' = <font color="#669900">sorun yok</font>';
	$dis_hata2 = true;
}

else
{
	$esayfa_aciklama .= '<br>../eklentiler/'.$_GET['sil'].' = <font color="#ff0000">'.$eklenti1->hata.'</font>';
	$dis_hata2 = false;
}

$esayfa_aciklama .= '<br><br><br><hr><br>';


// HERHANGİ BİR HATA VARSA  //

if (!$dis_hata2) $esayfa_aciklama .= '<font color="#ff0000"><b>Eklenti Silinemez !</b><br><br>Dosya silme işleminde hata var.</font>';




//  HİÇBİR HATA YOKSA SİLME İŞLEMİNE DEVAM    //

else
{
	$esayfa_aciklama .= '<br><center><font color="#669900"><b>Eklentide herhangi bir sorunla karşılaşılmadı, silme işlemini başlatabilirsiniz.</b></font>

<br><br><br>

<form action="eklentiler.php?sil='.$_GET['sil'].'" method="post" name="form1">
<input type="hidden" name="onay" value="onay">
<input type="submit" class="dugme" value="Sil">
</form>
	</center>';
}




//  SİLME İŞLEMİ YAPILIYOR   //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') )
{
	$esayfa_aciklama = '';

	if (!$dis_hata2) $esayfa_aciklama .= '<font color="#ff0000"><b>Eklenti Silinemez !</b><br><br>Dosya silme işleminde hata var.</font>';


	// sorun yoksa silme işlemini gerçekleştir
	else
	{
		$esayfa_aciklama = '';

		// eklenti dizin ve dosyaları siliniyor
		if ($eklenti1->dizin_sil('../eklentiler/'.$_GET['sil']))
			$esayfa_aciklama .= '<br>'.$_GET['sil'].' = <font color="#669900"><b>dizin silindi</b></font><br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Silme işlemi başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php">tıklayın.</a></b>';

		else $esayfa_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font><br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Silme işlemi yukarıdaki hata(lar) nedeniyle tamamlanamadı.</b></font><br>';
	}
}




//  BAŞLIK DOSYASI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');


//  TEMA UYGULANIYOR    //

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => 'Eklenti Silme için Denetleniyor',
'{SAYFA_KIP}' => '',
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));





		//  ETKİNLEŞTİRME ÖNCESİ DENETİM   //

elseif ( (isset($_GET['etkin'])) AND ($_GET['etkin'] != '') ):

$_GET['etkin'] = zkTemizle(trim($_GET['etkin']));


// dosya adında sorun varsa
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_GET['etkin']))
{
	header('Location: hata.php?hata=171');
	exit();
}


// eklenti dosyası yoksa
if (!@is_file('../eklentiler/'.$_GET['etkin'].'/eklenti_bilgi.xml'))
{
	header('Location: hata.php?hata=173');
	exit();
}


// eklenti dosyası yükleniyor
$edbilgi = xml_oku('../eklentiler/'.$_GET['etkin'].'/eklenti_bilgi.xml');


// Eklenti bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$_GET[etkin]'";
$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);


// eklenti etkisizleştirmeyi desteklemiyorsa
if ((!isset($ekl_satir['etkin'])) OR ($ekl_satir['etkin'] == 2))
{
	header('Location: hata.php?hata=200');
	exit();
}


// eklenti zaten etkinse
if ($ekl_satir['etkin'] == 1)
{
	header('Location: hata.php?hata=183');
	exit();
}


$esayfa_aciklama = '<br><center><font color="#669900"><b>Etkinleştirme işlemini başlatmak için tıklayın.</b></font>
<br><br><br>
<form action="eklentiler.php?etkin='.$_GET['etkin'].'" method="post" name="form1">
<input type="hidden" name="onay" value="onay">
<input type="submit" class="dugme" value="Etkinleştir">
</form>
</center>';



//  ETKİNLEŞTİRME İŞLEMİ YAPILIYOR   //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') )
{
	// Eklenti Veritabanında etkinleştiriliyor

	$vtsorgu = "UPDATE $tablo_eklentiler SET etkin='1' WHERE ad='$_GET[etkin]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$esayfa_aciklama = '<br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Etkinleştirme işlemi başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php#'.$_GET['etkin'].'">tıklayın.</a></b>';
}




//  BAŞLIK DOSYASI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');


//  TEMA UYGULANIYOR    //

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => 'Etkinleştirme için Denetleniyor',
'{SAYFA_KIP}' => '',
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));






		//  ETKİSİZLEŞTİRME ÖNCESİ DENETİM   //

elseif ( (isset($_GET['etkisiz'])) AND ($_GET['etkisiz'] != '') ):
$_GET['etkisiz'] = zkTemizle(trim($_GET['etkisiz']));


// dosya adında sorun varsa
if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_GET['etkisiz']))
{
	header('Location: hata.php?hata=171');
	exit();
}


// eklenti dosyası yoksa
if (!@is_file('../eklentiler/'.$_GET['etkisiz'].'/eklenti_bilgi.xml'))
{
	header('Location: hata.php?hata=173');
	exit();
}


// eklenti dosyası yükleniyor
$edbilgi = xml_oku('../eklentiler/'.$_GET['etkisiz'].'/eklenti_bilgi.xml');


// Eklenti bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$_GET[etkisiz]'";
$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$ekl_satir = $vt->fetch_assoc($ekl_sonuc);


// eklenti zaten etkisizse
if ((!isset($ekl_satir['etkin'])) OR ($ekl_satir['etkin'] == 0))
{
	header('Location: hata.php?hata=184');
	exit();
}


// eklenti etkisizleştirmeyi desteklemiyorsa
if ($ekl_satir['etkin'] == 2)
{
	header('Location: hata.php?hata=200');
	exit();
}



$esayfa_aciklama = '<br><center><font color="#669900"><b>Etkisizleştirme işlemini başlatmak için tıklayın.</b></font>
<br><br><br>
<form action="eklentiler.php?etkisiz='.$_GET['etkisiz'].'" method="post" name="form1">
<input type="hidden" name="onay" value="onay">
<input type="submit" class="dugme" value="Etkisizleştir">
</form>
</center>';



//  ETKİSİZLEŞTİRME İŞLEMİ YAPILIYOR   //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') )
{
	$esayfa_aciklama = '';

	// Eklenti Veritabanında etkisizleştiriliyor
	$vtsorgu = "UPDATE $tablo_eklentiler SET etkin='0' WHERE ad='$_GET[etkisiz]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$esayfa_aciklama = '<br><br><br><br><p align="center"><font style="font-size: 17px;"><b>Etkisizleştirme işlemi başarıyla tamamlanmıştır.</b><br><br></font><b>Geri dönmek için <a href="eklentiler.php#'.$_GET['etkisiz'].'">tıklayın.</a></b>';
}



//  BAŞLIK DOSYASI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');


//  TEMA UYGULANIYOR    //

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));



$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => 'Etkisizleştirme için Denetleniyor',
'{SAYFA_KIP}' => '',
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));






		//  SAYFA NORMAL GÖSTERİM   //

else:
//  BAŞLIK VE TEMA DOSYALARI YÜKLENİYOR  //

$sayfa_adi = 'Yönetim Eklentiler';
include_once('bilesenler/sayfa_baslik.php');

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/eklentiler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


// eklentiler dizinine yazma hakkına bakılıyor

$eyhakki = '&nbsp; Dizine Yazma Hakkı:&nbsp;';

if (@fopen('../eklentiler/yokla.txt', 'w'))
{
	@unlink('../eklentiler/yokla.txt');
	$eyhakki .= '<font color="#008800"><b>Var</b></font>';
}

else $eyhakki .= '<font color="#ff0000"><b>Yok !</b></font>
<br> &nbsp; Eklenti yükleme ve kurulumu için /eklentiler/ dizinine yazma hakkı olmalıdır. 
<a href="eklentiler.php?kip=ayarlar">Ayarlar</a> sayfasına FTP bilgilerini girerek işlemin otomatik yapılmasını sağlayabilir veya FTP programınızla yazma hakkı verebilirsiniz. (chmod 777)<br>';


// sunucu XMLReader desteğine bakılıyor

$xmldestek = '&nbsp; Sunucu XMLReader Desteği:&nbsp;';

if (@extension_loaded('xmlreader')) $xmldestek .= '<font color="#008800"><b>Var</b></font>';
else $xmldestek .= '<font color="#ff0000"><b>Desteklenmiyor !</b></font>
<br> &nbsp; Eklentilerle ilgili hiçbir işlem yapamazsınız. XMLReader desteği için barındırma hizmeti aldığınız şirket ile görüşün.<br>';


// sunucu zip desteğine bakılıyor

$zipdestek = '&nbsp; Sunucu Zip Desteği:&nbsp;';

if (@extension_loaded('zip')) $zipdestek .= '<font color="#008800"><b>Var</b></font>';
else $zipdestek .= '<font color="#ff0000"><b>Desteklenmiyor !</b></font>
<br> &nbsp; Eklenti yüklemek için sunucuda zip desteği olmalıdır. Yüklemek istediğiniz eklentileri açıp (zipten çıkartıp), <br>FTP programıyla /eklentiler/ dizinine kendiniz kopayalabilirsiniz.';


// sunucu safe_mode ayarına bakılıyor

$safe_mode = '&nbsp; Safe Mode:&nbsp;';
if(@ini_get('safe_mode')) $safe_mode .= '<font color="#ff0000"><b>Açık !</b></font>
 &nbsp; &nbsp; Safe Mode`un açık olması forum üzerinden eklenti yüklemenize engel olabilir.';
else $safe_mode .= '<font color="#008800"><b>Kapalı</b></font>';






//  EKLENTİ YÜKLEME SAYFASI //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] != '') ):

if ($_GET['kip'] == 'yukle'):
$sayfa_baslik2 = 'Eklenti Yükleme';
$sayfa_kip = '<a href="eklentiler.php">Yüklü Eklentiler</a> &nbsp; | &nbsp; Eklenti Yükleme &nbsp; | &nbsp; <a href="eklentiler.php?kip=ayarlar">Ayarlar</a>';



//  YÜKLEME İŞLEMLERİ //
if ( (isset($_POST['yukleme'])) AND ($_POST['yukleme'] == 'yapildi') )
{
	if ( (isset($_FILES['eklenti_yukle']['error'])) AND ($_FILES['eklenti_yukle']['error'] != 0) )
		$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Dosya yüklenemedi, dosya adı alınamadı !</b></font><br><br><b>Nedeni dosyanın çok büyük olması ya da<br>dosya adının kabul edilemeyen karakterler içermesi olabilir.</b></p>';

	elseif ( (isset($_FILES['eklenti_yukle']['tmp_name'])) AND ($_FILES['eklenti_yukle']['tmp_name'] != '') )
	{
		$uzanti = @end(@explode('.',$_FILES['eklenti_yukle']['name']));

		if ($_FILES['eklenti_yukle']['size'] > 10485760)
			$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Çok büyük eklentiler buradan yüklenemez !</b></font><br><br><b>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla /eklentiler/ dizinine kendiniz yükleyin.</b></p>';

		elseif ($uzanti != 'zip')
			$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Sadece .zip uzantılı (zip olarak sıkıştırılmış) eklentiler yüklenebilir !</b></font></p>';

		elseif (!@extension_loaded('zip'))
			$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Sunucunuz zip dosyalarını açmayı desteklemiyor !</b></font><br><br><b>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla /eklentiler/ dizinine kendiniz yükleyin.</b></p>';

		else
		{
			$arsiv = new ZipArchive;
			$zip_dosya = $arsiv->open($_FILES['eklenti_yukle']['tmp_name']);

			if ($zip_dosya === true)
			{
				$eski_umask = umask(0);
				ob_start();
				ob_implicit_flush(0);
				$arsiv->extractTo('../eklentiler/');
				$zip_hata = ob_get_contents();
				ob_end_clean();
				$arsiv->close();
				umask($eski_umask);
				$dosyaya_git = substr($_FILES['eklenti_yukle']['name'], 0, -4);
				$xml_dosya = '../eklentiler/'.$dosyaya_git.'/eklenti_bilgi.xml';


				if ($zip_hata == '')
				{
					// eklenti_bilgi.xml dosyasının varlığı kontrol ediliyor
					if (!@is_file($xml_dosya))
						$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Yükleme tamamlandı fakat eklentinin eklenti_bilgi.xml dosyası bulunamıyor.<br>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla /eklentiler/ dizinine kendiniz yükleyin.<br><br><br>Yüklü eklentileri görmek için <a href="eklentiler.php">tıklayın.</a></b></font>';


					else
					{
						// eklenti_bilgi.xml dosyasının satır sonu kodu kontrol ediliyor
						$xml_ac = fopen($xml_dosya,'r');
						$xml_metni = fread($xml_ac,100);
						fclose($xml_ac);

						if (!preg_match('|\<\?xml version="1.0" encoding="utf-8"\?\>\r\n\<phpKF_Eklenti\>|si', $xml_metni))
							$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>Yükleme tamamlandı fakat eklentinin eklenti_bilgi.xml dosyasının satır sonu kodu sorunlu yüklendi.<br>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla /eklentiler/ dizinine kendiniz yükleyin.<br><br><br>Yüklü eklentileri görmek için <a href="eklentiler.php">tıklayın.</a></b></font>';

						else $esayfa_aciklama = '<center><br><br><b>Yükleme Tamamlandı !</b><br><br>Yüklü eklentileri görmek için <a href="eklentiler.php#'.$dosyaya_git.'">tıklayın.</a></center>';
					}
				}


				else
				{
					$esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI ÇIKARTILAMIYOR !</b></font><br><br>Sunucu bu dizine dosya kopyalanmasına izin vermiyor.';
					if(@ini_get('safe_mode')) $esayfa_aciklama .= ' Nedeni SAFE MODE`un açık olması olabilir.';
					$esayfa_aciklama .= '<br><br><br><br><b>Hata Çıktısı:</b><br>'.$zip_hata.'</p>';
				}
			}

			else $esayfa_aciklama = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI AÇILAMIYOR !</b></font><br><br><b>Hata Kodu: '.$zip_dosya.'</b></p>';
		}
	}
}


else $esayfa_aciklama = 'Bu sayfadan eklentileri sunucuya yükledikten sonra <a href="eklentiler.php">Yüklü Eklentiler</a> sayfasından kurulum yapın.
<br>Eklenti edinmek için <a href="http://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a> eklentiler sayfasını ziyaret edin.

<br><br><ul style="margin-left:18px"><li>2mb.`dan büyük dosyalar, sunucuda kısıtlama varsa yüklenmeyebilir.
<li>Eklenti yükleme için sunucunuzda zip açma özelliği olmalıdır.
<li>Eklentilerin yükleneceği /eklentiler/ dizinine yazma hakkı olmalıdır.
<li>Sorunlu eklentiler yüklerken değil kurulum yaparken hata verir.</ul>


<br>'.$eyhakki.'<br>'.$xmldestek.'<br>'.$zipdestek.'<br>'.$safe_mode.'<br><br><br><br><br>
<center>

<script type="text/javascript">
<!-- //
function denetle(){
	var dogruMu = true;
	if (document.eklenti_yukleme.eklenti_yukle.value.length < 4){
		dogruMu = false; 
		alert("Dosya seçmeyi unuttunuz !");}
	else;
	return dogruMu;}
//  -->
</script>

<form name="eklenti_yukleme" action="eklentiler.php?kip=yukle" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="yukleme" value="yapildi" />
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<b>Dosya Seç: &nbsp;</b><input class="formlar" name="eklenti_yukle" type="file" size="200" style="width: 250px" />
<br><br><br>
&nbsp; &nbsp; &nbsp; <input class="dugme" type="submit" value="Eklenti Yükle" />
</form></center>';


$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);






//  EKLENTİ AYARLARI - BAŞI //

elseif ($_GET['kip'] == 'ayarlar'):

$sayfa_baslik2 = 'Eklenti Ayarları';
$sayfa_kip = '<a href="eklentiler.php">Yüklü Eklentiler</a> &nbsp; | &nbsp; <a href="eklentiler.php?kip=yukle">Eklenti Yükleme</a> &nbsp; | &nbsp; Ayarlar';

$esayfa_aciklama = '<font class="liste-etiket">Dosya-Dizin İzinleri Değiştiriliyor</font><br><br><br>';



// ayarlar yaplıyor //

if ( (isset($_POST['onay'])) AND ($_POST['onay'] != '') ):

$ftp_sunucu = $_POST['ftp_sunucu'];
$ftp_kullanici = $_POST['ftp_kullanici'];
$ftp_sifre = $_POST['ftp_sifre'];
$ftp_kok = $_POST['ftp_kok'];
$f_dizin = substr($_POST['f_dizin'], 1);
$dzn_chmod = $_POST['dzn_chmod'];
$dsy_chmod = $_POST['dsy_chmod'];



// ftp bağlantısı kuruluyor

$ftp_baglanti = ftp_connect($ftp_sunucu);
$ftp_sonuc = ftp_login($ftp_baglanti, $ftp_kullanici, $ftp_sifre);

if ((!$ftp_baglanti) OR (!$ftp_sonuc))
	die('<br><h3>FTP bağlantısı kurulamadı !</h3>');

$esayfa_aciklama = DizinDosya_Ac($ftp_baglanti, $dzn_chmod, $dsy_chmod, $ftp_kok, $f_dizin);

ftp_close($ftp_baglanti);



// Ayarlar sayfası giriş

else:

$esayfa_aciklama = '<br> &nbsp; &nbsp; <font color="#ff0000"><b>Dikkat! Bu özellik sadece uzman kullanıcılar için önerilmektedir.</b></font>
<br> &nbsp; &nbsp; Aşağıdaki alanlara FTP bilgilerinizi girerek, dosya ve dizin haklarını değiştirebilirsiniz. Girdiğiniz FTP kullanıcısının, dizin haklarını değiştirme yetkisi olması gereklidir.

<br><br> &nbsp; &nbsp; Sahipliği, girdiğiniz FTP kullanıcısından farklı olan dosyaların hakları değiştirilemez. Bu sorun bazı ücretsiz sunucularda forum üzerinden yüklenen dosyalarda çıkmaktadır.
<br>&nbsp;Bu sorunu düzeltmek için tüm dosyaların sahipliğini almalısınız, bunun için cPanel ve benzeri panellerde "Fix File Ownership", "Reset Owner" ve "Fix File Permissions" gibi araçlar vardır.
<br><br>&nbsp;Dosya ve dizin haklarını değiştirme işlemi sadece Linux sunucularda çalışır.
<br><br><br><br>


<script type="text/javascript">
<!-- //
function denetle(){
	var dogruMu = true;
	for (var i=0; i<8; i++){
	if (document.eklenti_ayarlari.elements[i].value == \'\'){ 
		dogruMu = false; 
		alert(\'TÜM ALANLARIN DOLDURULMASI ZORUNLUDUR !\');
		break;}}
	return dogruMu;}
//  -->
</script>


<form name="eklenti_ayarlari" action="eklentiler.php?kip=ayarlar" method="post" onsubmit="return denetle()">
<input type="hidden" name="onay" value="onay">

<table cellspacing="1" cellpadding="10" width="430" border="0" align="center" class="tablo_border4">
	<tr class="tablo_ici">
	<td align="left" valign="top" colspan="2" height="55" class="liste-veri">
<center><b>FTP BİLGİLERİNİZ</b></center>
<br><font size="1"><i>Tüm alanların doldurulması zorunludur!</i></font>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle" class="liste-veri" width="170" height="50">
<b>FTP Sunucu Adresi:</b>
<br><font size="1" style="font-weight: normal">
<i>Yanlış ise değiştirin.</i></font>
	</td>
	<td align="left" valign="middle">
<input class="formlar" type="text" name="ftp_sunucu" value="';


if (preg_match('/^www./i', $_SERVER['HTTP_HOST'])) 
	$esayfa_aciklama .= 'ftp.'.str_replace('www.', '', $_SERVER['HTTP_HOST']);
else $esayfa_aciklama .= 'ftp.'.$_SERVER['HTTP_HOST'];


$esayfa_aciklama .= '" size="30" maxlength="100">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="top" class="liste-veri">
<b>FTP Kullanıcı Adı:</b>
<br><font size="1" style="font-weight: normal">
<i>Kullanıcı adı kaydedilmez.</i></font>
	</td>
	<td align="left" valign="top">
<input class="formlar" type="text" name="ftp_kullanici" size="30" maxlength="100">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="top" class="liste-veri">
<b>FTP Şifresi:</b>
<br><font size="1" style="font-weight: normal">
<i>Şifre kaydedilmez.</i></font>
	</td>
	<td align="left" valign="top">
<input class="formlar" type="password" name="ftp_sifre" size="30" maxlength="100">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle" class="liste-veri" height="50">
<b>FTP Kök Dizini:</b>
<br><font size="1" style="font-weight: normal">
<i>Yanlış ise değiştirin.</i></font>
	</td>
	<td align="left" valign="middle">
	<input class="formlar" type="text" name="ftp_kok" value="public_html" size="30" maxlength="100">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle" class="liste-veri" height="50">
<b>Forum Dizini:</b>
<br><font size="1" style="font-weight: normal">
<i>Yanlış ise değiştirin.</i></font>
	</td>
	<td align="left" valign="middle">
	<input class="formlar" type="text" name="f_dizin" value="'.$ayarlar['f_dizin'].'" size="30" maxlength="100">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle" class="liste-veri" height="50">
<b>Dizin için chmod:</b>
<br><font size="1" style="font-weight: normal">
<i>Bilmiyorsanız dokunmayın.</i></font>
	</td>
	<td align="left" valign="middle">
	<input class="formlar" type="text" name="dzn_chmod" value="0777" size="30" maxlength="4">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle" class="liste-veri" height="50">
<b>Dosya için chmod:</b>
<br><font size="1" style="font-weight: normal">
<i>Bilmiyorsanız dokunmayın.</i></font>
	</td>
	<td align="left" valign="middle">
	<input class="formlar" type="text" name="dsy_chmod" value="0777" size="30" maxlength="4">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" valign="middle" colspan="2" height="55">
<input class="dugme" type="submit" value="İzinleri Değiştir">
	</td>
	</tr>
</table>
</form>';

endif;


$ornek1->kosul('2', array('' => ''), false);
$ornek1->kosul('1', array('' => ''), false);


endif;







//  YÜKLÜ EKLENTİLER -   BAŞI    //

else:

$sayfa_baslik2 = 'Yüklü Eklentiler';
$sayfa_kip = 'Yüklü Eklentiler &nbsp; | &nbsp; <a href="eklentiler.php?kip=yukle">Eklenti Yükleme</a> &nbsp; | &nbsp; <a href="eklentiler.php?kip=ayarlar">Ayarlar</a>';


$esayfa_aciklama = '<script type="text/javascript">
<!-- //
function pencere(adres){
window.open(adres,"_blank","scrollbars=yes,left=1,top=1,width=750,height=550,resizable=yes");}
//  -->
</script>
 &nbsp; Bu sayfada <b>/eklentiler</b> dizinine yüklenilen eklentiler görüntülenmektedir.
<br> &nbsp; Sol taraftan durum bilgilerini görebilir; yine aynı yerdeki kur, güncelle, kaldır, etkinleştir ve etkisizleştir yazılarını tıklayarak eklentileri yönetebilirsiniz.
<br> &nbsp; Eklenti edinmek için <a href="http://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a> eklentiler sayfasını ziyaret edin.
<br> &nbsp; Eklenti Kurma, Kaldırma, Güncelleme, vs. ayrıntılı tüm bilgiler için <a href="http://www.phpkf.com/f63-phpkf-eklenti-bolumu.html" target="_blank"><b>bu bölümdeki</b></a> konulara bakabilirsiniz.

<br><br><br>'.$eyhakki.'<br>'.$xmldestek.'<br>'.$zipdestek.'<br>'.$safe_mode;


$yedizin_adi = '../eklentiler/';    // eklentiler dizini
$yedizin = @opendir($yedizin_adi);  // dizini açıyoruz


//  DİZİNDEKİ EKLENTİLER DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR   //

while ( @gettype($bilgi = @readdir($yedizin)) != 'boolean' )
{
	if ( (@is_dir($yedizin_adi.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
	{
		$guncelek = '';

		if (@is_file($yedizin_adi.$bilgi.'/eklenti_bilgi.xml'))
			$edbilgi = xml_oku($yedizin_adi.$bilgi.'/eklenti_bilgi.xml');

		else { $edbilgi = array(); $eklenti_resim = ''; $eklenti_adi = ''; $ebilgiler2 = ''; $ebilgiler3 = ''; }


		//  EKLENTİDE SORUN VARSA //

		if (!isset($edbilgi['eklenti_adi']))
		{
			$ekle_kaldir = '<br><br><br><a href="eklentiler.php?sil='.$bilgi.'" title="Bu Eklentiyi Sil">- Sil -</a>';
			$ebilgiler = '<font color="#ff0000"><b>Eklenti dizini:</b> '.$bilgi.'
			<br><br>Bu eklentide sorunlar var.<br>Yüklenirken sorun olmuş olablir, kontrol edip tekrar yükleyin.</font><br>';
			$edbilgi = array(); $eklenti_resim = ''; $eklenti_adi = ''; $ebilgiler2 = $yardim_konulari; $ebilgiler3 = '';
		}


		elseif ( (!isset($edbilgi['eklenecek_dosya'])) AND (!isset($edbilgi['degistirilecek_dosya'])) AND (!isset($edbilgi['kur_veritabani'])) )
		{
			$ekle_kaldir = '<br><br><a href="eklentiler.php?sil='.$bilgi.'" title="Bu Eklentiyi Sil">- Sil -</a>';
			$ebilgiler = '<font color="#ff0000"><b>Eklenti dizini:</b> '.$bilgi.'
			<br><br>Bu eklentide hiçbir dosya, dizin veya veritabanı işlemi yok.</font><br>';
			$edbilgi = array(); $eklenti_resim = ''; $eklenti_adi = ''; $ebilgiler2 = $yardim_konulari; $ebilgiler3 = '';
		}


		elseif ( (isset($edbilgi['degistirilecek_dosya'])) AND ((!isset($edbilgi['kod_bul'])) OR (!isset($edbilgi['kod_degistir']))) )
		{
			$ekle_kaldir = '<br><br><a href="eklentiler.php?sil='.$bilgi.'" title="Bu Eklentiyi Sil">- Sil -</a>';
			$ebilgiler = '<font color="#ff0000"><b>Eklenti dizini:</b> '.$bilgi.'
			<br><br>Bu eklentide bul ve değiştir bilgileri yok.</font><br>';
			$edbilgi = array(); $eklenti_resim = ''; $eklenti_adi = ''; $ebilgiler2 = $yardim_konulari; $ebilgiler3 = '';
		}


		//  EKLENTİDE SORUN YOKSA   //

		else
		{
			// Eklenti bilgileri çekiliyor
			$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$bilgi'";
			$ekl_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$ekl_satir = $vt->fetch_assoc($ekl_sonuc);

			$eklenti_resim = '<a href="javascript:void(0)" onclick="pencere(\'../eklentiler/'.$bilgi.'/onizlemeb.png\')"><img src="../eklentiler/'.$bilgi.'/onizlemek.jpg" alt="eklenti görünüm" border="0" width="100"></a>';


			if ($ekl_satir['etkin'] == 1)
				$eklenti_etkin = '<br><br><a href="eklentiler.php?etkisiz='.$bilgi.'" title="Bu Eklentiyi Etkisizleştir">Etkisizleştir</a>';

			elseif ($ekl_satir['etkin'] == 0)
				$eklenti_etkin = '<br><br><a href="eklentiler.php?etkin='.$bilgi.'" title="Bu Eklentiyi Etkinleştir">Etkinleştir</a>';

			else $eklenti_etkin = '';


			$eklenti_adi = '- '.$edbilgi['eklenti_adi'].' -';
			$ebilgiler = 'Yapımcı: <a href="'.@zkTemizle($edbilgi['eklenti_adres']).'" target="_blank">'.@zkTemizle($edbilgi['eklenti_yapimcisi']).'</a>';
			$ebilgiler .= '<br>Eklenti Sürümü: '.$edbilgi['eklenti_surumu'];
			$ebilgiler .= '<br>Tarih:</b> '.$edbilgi['eklenti_tarihi'];


			$ebilgiler .= '<br>Uyumluluk:'.str_replace(';',', ', $edbilgi['uyumlu_surum']);
			if (!preg_match('/'.$uyumlu_surum.'/', $edbilgi['uyumlu_surum'])) $ebilgiler .= ' <font color="#ff0000" size="1">(Uyumsuz)</font>';


			$ebilgiler .= '<br>Sistem: ';
			if ($edbilgi['sistem'] == '1') $ebilgiler .= 'Sadece forum için';
			elseif ($edbilgi['sistem'] == '2') $ebilgiler .= ' Sadece portal için';
			elseif ($edbilgi['sistem'] == '3') $ebilgiler .= 'Forum ve portal için';
			else $ebilgiler .= 'Hatalı veri';


			$ebilgiler .= '<br>Eklenti Tipi:';
			if ($edbilgi['tip'] == '1') $ebilgiler .= 'Değişiklik (Mod)';
			elseif ($edbilgi['tip'] == '2') $ebilgiler .= 'Gelişkin Eklenti';
			else $ebilgiler .= 'Hatalı veri';

			if ((isset($edbilgi['eklenti_etkin'])) AND ($edbilgi['eklenti_etkin'] == '1'))
				$ebilgiler .= '<br>Etkisizleştirme: Destekliyor';


			if ( (isset($edbilgi['kur_veritabani'])) AND (is_array($edbilgi['kur_veritabani'])) ){
				$ebilgiler .= '<br>Veritabanı İşlemi: Var';
				$guncelek .= '&amp;vt=1';}


			if (isset($edbilgi['tema_adi'])) $ebilgiler .= '<br><b>Tema Değişikliği:</b> '.@zkTemizle($edbilgi['tema_adi']);
			else $ebilgiler .= '<br>Tema Değişikliği: Yok';
			if (!isset($edbilgi['tema_dizini'])) $edbilgi['tema_dizini'] = 'varsayilan';


			$ebilgiler2 = '';

			if ( (isset($edbilgi['kur_veritabani'])) AND (is_array($edbilgi['kur_veritabani'])) AND (!isset($_GET['guncel'])) )
			{
				$ebilgiler2 .= 'Veritabanı Soruguları: ';
				$dongu = 0;
				foreach($edbilgi['kur_veritabani'] as $a)
				{
					if ($a != '')
					{
						/*if ($dongu != 0) $ebilgiler2 .= '<br>';
						$bul = array("\\r", "\\n", '\\', '{VT_ONEK}');
						$degis = array('', '<br>', '', $tablo_oneki);
						$ebilgiler2 .= str_replace($bul, $degis, @zkTemizle($a));*/
						$dongu++;
					}
				}
				$ebilgiler2 .= $dongu.' adet<br>';
			}


			if ( (isset($edbilgi['degistirilecek_dosya'])) AND (is_array($edbilgi['degistirilecek_dosya'])) )
			{
				$ebilgiler2 .= 'Değiştirilecek Dosyalar:<br>';
				$dongu = 0;
				foreach($edbilgi['degistirilecek_dosya'] as $a)
				{
					if ($a != '')
					{
						if (preg_match('/temalar\//', $a))
						{
							if (!@preg_match('/temalar\/\{TEMA_DIZINI\}/', $a)) continue;
							else
							{
								if (preg_match('/^portal/', $a)) $c = ' (portal teması)';
								else $c = ' (forum teması)';
								if (preg_match("/.*\/(.*?)$/", $a, $b)) $a = $b[1].$c;
							}
						}
						if ($dongu != 0) $ebilgiler2 .= '<br>';
						$ebilgiler2 .= @zkTemizle($a);
						$dongu++;
					}
				}
				$ebilgiler2 .= '<br><br>';
			}


			if ( (isset($edbilgi['eklenecek_dosya'])) AND (is_array($edbilgi['eklenecek_dosya'])) )
			{
				$ebilgiler2 .= 'Eklenecek Dosyalar:<br>';
				$dongu = 0;
				foreach($edbilgi['eklenecek_dosya'] as $a)
				{
					if ($a != '')
					{
						if ($dongu != 0) $ebilgiler2 .= ' - ';
						$ebilgiler2 .= str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));
						$dongu++;
					}
				}
				$ebilgiler2 .= '<br><br>';
				$guncelek .= '&amp;dosya=1';
			}


			if ( (isset($edbilgi['dizin_olustur'])) AND (is_array($edbilgi['dizin_olustur'])) )
			{
				$ebilgiler2 .= 'Oluşturulacak Dizinler:<br>';
				$dongu = 0;
				foreach($edbilgi['dizin_olustur'] as $a)
				{
					if ($a != '')
					{
						if ($dongu != 0) $ebilgiler2 .= ' - ';
						$ebilgiler2 .= str_replace('{TEMA_DIZINI}', $edbilgi['tema_dizini'], @zkTemizle($a));
						$dongu++;
					}
				}
				$guncelek .= '&amp;dizin=1';
			}


			$ebilgiler3 = '<b><a href="javascript:void(0);" title="Açıklama alanını genişletmek için tıklayın">Açıklama:</a></b>&nbsp; '.$edbilgi['aciklama'].'';


			$ekle_kaldir = '<a name="'.$bilgi.'"></a>';


			// eklenti veritabanına eklenmiş - kurulum yapılmış
			if ($ekl_satir['kur'] == 1)
			{
				if ( (!preg_match('/'.$uyumlu_surum.'/', $edbilgi['uyumlu_surum']))
					OR ($ekl_satir['esurum'] > $edbilgi['eklenti_surumu']) )
					$ekle_kaldir .= '<font color="#ff0000" style="font-weight: normal">Eklenti sürümü uyumsuz</font>';

				elseif ( ($ekl_satir['usurum'] == $uyumlu_surum) AND (preg_match('/'.$ekl_satir['usurum'].'/', $edbilgi['uyumlu_surum'])) AND ($ekl_satir['esurum'] == $edbilgi['eklenti_surumu']) )
					$ekle_kaldir .= '<font color="#007900">Kurulu<br>';

				elseif ( (!preg_match('/'.$ekl_satir['usurum'].'$/', $edbilgi['uyumlu_surum']))
					OR ($ekl_satir['esurum'] < $edbilgi['eklenti_surumu']) )
					$ekle_kaldir .= '<font color="#ff0000" style="font-weight: normal">Güncelleme gerekli !</font>
					<br><br><a href="eklentiler.php?guncel=1'.$guncelek.'&amp;kur='.$bilgi.'" title="Bu Eklentiyi Güncelle">- Güncelle -</a>';

				$ekle_kaldir .= '<br><br><a href="eklentiler.php?kaldir='.$bilgi.'">-Kaldır-</a></font><br><br><a href="eklentiler.php?sil='.$bilgi.'" title="Bu Eklentiyi Sil"><b>- Sil -</b></a>'.$eklenti_etkin;
			}

			// eklenti veritabanına eklen memiş - kurulum yapılmamış
			else
			{
				if (!preg_match('/'.$uyumlu_surum.'/', $edbilgi['uyumlu_surum']))
					$ekle_kaldir .= '<font color="#ff0000" style="font-weight: normal">Eklenti sürümü uyumsuz</font><br>';

				else $ekle_kaldir .= '<font color="#ff6666">Kurulu değil</font><br><br><a href="eklentiler.php?kur='.$bilgi.'" title="Bu Eklentiyi Kur">- Kur -</a>';

				$ekle_kaldir .= '<br><br><br><a href="eklentiler.php?sil='.$bilgi.'" title="Bu Eklentiyi Sil"><b>- Sil -</b></a>';
			}
		}


		//  tekli döngü tema motoruna yollanıyor    //
		$depo = array('{EKLENTI_RESIM}' => $eklenti_resim,
		'{EKLE_KALDIR}' => $ekle_kaldir,
		'{EKLENTI_ADI}' => $eklenti_adi,
		'{EKLENTI_ACIKLAMA1}' => $ebilgiler,
		'{EKLENTI_ACIKLAMA2}' => $ebilgiler2,
		'{EKLENTI_ACIKLAMA3}' => $ebilgiler3);


		if (@$ekl_satir['kur'] == 1) $depo1[] = $depo;
		else $depo2[] = $depo;
	}


	// değişkenler siliniyor
	unset($depo);
	unset($edbilgi);
	unset($eklenti_resim);
	unset($ebilgiler);
	unset($ebilgiler2);
}

@closedir($yedizin);    // dizini kapatıyoruz


if ( (isset($depo1)) AND (isset($depo2)) )
	$tekli1 = array_merge($depo1, $depo2);
elseif (isset($depo1))
	$tekli1 = $depo1;
elseif (isset($depo2))
	$tekli1 = $depo2;


if (isset($tekli1))
{
	$ornek1->tekli_dongu('1',$tekli1);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
}

else
{
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('{EKLENTI_YOK}' => '<br>Yüklü Eklenti Yok<br><br><span style="font-weight:normal">Eklenti edinmek için <a href="http://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a> eklentiler sayfasını ziyaret edin.</span><br><br>'), true);
}


endif; // kip kapatılıyor


//  YÜKLÜ EKLENTİLER -   SONU    //




//  TEMA UYGULANIYOR    //

$ornek1->dongusuz(array('{SAYFA_BASLIK}' => 'Eklenti Yönetimi',
'{SAYFA_BASLIK2}' => $sayfa_baslik2,
'{SAYFA_KIP}' => $sayfa_kip,
'{SAYFA_ACIKLAMA}' => $esayfa_aciklama));



endif; // işlemler kapatılıyor

eval(TEMA_UYGULA);

?>