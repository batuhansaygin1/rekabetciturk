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


$sayfa_adi = 'phpKF Mobil Android Servis';
$dosya_mobil = 'mobil/index.php';
$user_agent = $_SERVER['HTTP_USER_AGENT'];


if (@preg_match('/phpKF\ Android\ Uygulamasi/', $user_agent)) $sayfano = '44,0';
elseif (@preg_match('/Firefox\//', $user_agent)) $sayfano = '44,1';
elseif (@preg_match('/Chrome\//', $user_agent)) $sayfano = '44,2';
else $sayfano = '44,0';



// kip verisi alınıyor
if (isset($_GET['kip'])) 
{
	$_GET['kip'] = @str_replace(array('-','x','.'), '', $_GET['kip']);
	if (is_numeric($_GET['kip'])) $kip = $_GET['kip'];
	else $kip = 0;
	if (($kip==0) OR ($kip==1) OR ($kip==2) OR ($kip==3));
	else $kip = 0;
}
else $kip = 0;



// Üye giriş denetimi
if (isset($_GET['denetim']))
{
	if ($_GET['denetim'] == '2') exit();
	else
	{
		if (!defined('DOSYA_AYAR')) include '../ayar.php';

		if ( (isset($_COOKIE['kullanici_kimlik'])) AND ($_COOKIE['kullanici_kimlik'] != '') )
		{
			if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';

			$_COOKIE['kullanici_kimlik'] = @zkTemizle($_COOKIE['kullanici_kimlik']);

			$vtsorgu = "SELECT id,kullanici_kimlik,son_hareket,kul_ip FROM $tablo_kullanicilar
					WHERE kullanici_kimlik='$_COOKIE[kullanici_kimlik]' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$satir = $vt->fetch_assoc($vtsonuc);

			if (!$vt->num_rows($vtsonuc))
			{
				setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
				setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
				setcookie('kfk_okundu', '', 0, $cerez_dizin, $cerez_alanadi);
			}

			else setcookie('kullanici_kimlik', $satir['kullanici_kimlik'], time() +$ayarlar['k_cerez_zaman'], $cerez_dizin, $cerez_alanadi);
		}

		else setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
		exit();
	}
}



include_once('../ayar.php');
include_once('../bilesenler/oturum.php');
include_once('../bilesenler/kullanici_kimlik.php');
header("Content-type: text/xml; charset=UTF-8");
$sayfa_cikis = '';
$bilsayi = 0;



// forum alanadı ve dizini
if ($ayarlar['f_dizin'] == '/') $af_dizin = '';
else $af_dizin = $ayarlar['f_dizin'];
$alanadi = 'http://'.$ayarlar['alanadi'].$af_dizin.'/';


$tarih = time();
$guncel_saat = zonedate2($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $tarih);


// üye ise zaman değeri: son hareket
if (isset($kullanici_kim['id'])) $zaman = $kullanici_kim['son_hareket'];

// misafir ise zaman değeri: bir önceki ziyaret, değilse sıfır
else
{
	if ( (isset($_GET['zaman'])) AND ($_GET['zaman'] != '') AND ($_GET['zaman'] != '0') AND (is_numeric($_GET['zaman'])) )
	$zaman = $_GET['zaman'];
	else $zaman = 0;
}

$bul = array('<b>', ',</b>');
$cevir = array('', '');



// Boş Bildirim XML
$bosbildirim = '<BILDIRIM>
<BASLIK> </BASLIK>
<KONU> </KONU>
<ADRES><![CDATA['.$alanadi.'mobil.php]]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN> </YAZAN>
<UYARI>0</UYARI>
</BILDIRIM>';

// Takip uyarı bildirim, bölüm seçilmemiş
$takipuyari1 = '<BILDIRIM>
<BASLIK>Takip Uyarı</BASLIK>
<KONU>Takip için seçim yapılmalıdır</KONU>
<ADRES><![CDATA['.$alanadi.'profil_degistir.php?kosul=takip]]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN>'.$ayarlar['alanadi'].'</YAZAN>
<UYARI>1</UYARI>
</BILDIRIM>';

// Takip Uyarı bildirim, giriş yapılmamış
$takipuyari2 = '<BILDIRIM>
<BASLIK>Takip Uyarı</BASLIK>
<KONU>Takip için üye girişi yapılmalıdır</KONU>
<ADRES><![CDATA['.$alanadi.$dosya_mobil.']]></ADRES>
<ZAMAN>'.$tarih.'</ZAMAN>
<TARIH>'.$guncel_saat.'</TARIH>
<YAZAN>'.$ayarlar['alanadi'].'</YAZAN>
<UYARI>1</UYARI>
</BILDIRIM>';




//  YENİ İLETİLERE BAKILIYOR    //
//  YENİ İLETİLERE BAKILIYOR    //
//  YENİ İLETİLERE BAKILIYOR    //


// Servisin her çalışması
if ($zaman != 0)
{
	// Her şey veya takip edilenler seçiliyse, yeni iletilere bakılıyor
	if ( ($kip == 0) OR ($kip == 2) )
	{
		// TAKİP EDİLENLER SEÇİLİYSE
		if ($kip == 2)
		{
			if (isset($kullanici_kim['id']))
			{
				$vtsorgu = "SELECT id,takip FROM $tablo_kullanicilar WHERE id='$kullanici_kim[id]' LIMIT 1";
				$takip_sonuc = $vt->query($vtsorgu) or die ();
				$takip_veri = $vt->fetch_assoc($takip_sonuc);

				if ($takip_veri['takip'] != '')
				{
					$takip_dizi = explode(";", $takip_veri['takip']);
					$takip_eksorgu = '';

					foreach ($takip_dizi as $takip_tek)
					{
						if (preg_match('/^f-/i', $takip_tek))
							$takip_eksorgu .= " silinmis='0' AND hangi_forumdan='".substr($takip_tek,2)."' AND son_mesaj_tarihi > '$zaman' OR";
					}
					$takip_eksorgu = substr($takip_eksorgu, 0, -2);


					$sorgu = $vt->query("SELECT id FROM $tablo_mesajlar WHERE $takip_eksorgu") or die ();
					$sorgu1 = "SELECT id,yazan,mesaj_baslik,son_mesaj_tarihi,cevap_sayi,son_cevap,son_cevap_yazan FROM $tablo_mesajlar WHERE $takip_eksorgu ORDER BY son_mesaj_tarihi DESC LIMIT 10";

					$konu_sayi = $vt->num_rows($sorgu);
					$m_arama_sonuc = $vt->query($sorgu1) or die ();
				}

				// takip için bölüm seçilmemiş, uyarı veriliyor
				else
				{
					$konu_sayi = 0;
					$sayfa_cikis .= $takipuyari1;
				}
			}


			// üye girişi yapılmamış, uyarı veriliyor
			else
			{
				$konu_sayi = 0;
				$sayfa_cikis .= $takipuyari2;
			}
		}



		// HER ŞEY SEÇİLİYSE
		else
		{
			$sorgu = $vt->query("SELECT id FROM $tablo_mesajlar WHERE silinmis='0' AND son_mesaj_tarihi > '$zaman'") or die ();
			$sorgu1 = "SELECT id,yazan,mesaj_baslik,son_mesaj_tarihi,cevap_sayi,son_cevap,son_cevap_yazan
			FROM $tablo_mesajlar WHERE silinmis='0' AND son_mesaj_tarihi > '$zaman'
			ORDER BY son_mesaj_tarihi DESC LIMIT 10";

			$konu_sayi = $vt->num_rows($sorgu);
			$m_arama_sonuc = $vt->query($sorgu1) or die ();
		}




		// YENİ İLETİ VARSA
		if ($konu_sayi > 0)
		{
			while ($mesaj_satir = $vt->fetch_assoc($m_arama_sonuc))
			{
				$bilsayi++;
				$mesaj_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $mesaj_satir['son_mesaj_tarihi']);
				$mesaj_tarih = @str_replace($bul, $cevir, $mesaj_tarih);


				// Yeni Cevap ise
				if ($mesaj_satir['cevap_sayi'] != 0)
				{
					// konu çok sayfalı ise son sayfaya git

					if ($mesaj_satir['cevap_sayi'] > $ayarlar['ksyfkota'])
					{
						$sayfaya_git = (($mesaj_satir['cevap_sayi']-1) / $ayarlar['ksyfkota']);
						settype($sayfaya_git,'integer');
						$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

						$sonagit = '&aks='.$sayfaya_git.'#c'.$mesaj_satir['son_cevap'];
					}
					else $sonagit = '#c'.$mesaj_satir['son_cevap'];


					// Bildirim XML
					$sayfa_cikis .= '<BILDIRIM>
					<BASLIK><![CDATA[Yeni bir cevap var]]></BASLIK>
					<KONU><![CDATA[Cevap: '.$mesaj_satir['mesaj_baslik'].']]></KONU>
					<ADRES><![CDATA['.$alanadi.$dosya_mobil.'?ak='.$mesaj_satir['id'].$sonagit.']]></ADRES>
					<ZAMAN>'.$tarih.'</ZAMAN>
					<TARIH><![CDATA['.$mesaj_tarih.']]></TARIH>
					<YAZAN><![CDATA['.$mesaj_satir['son_cevap_yazan'].']]></YAZAN>
					<UYARI>1</UYARI>
					</BILDIRIM>';
				}

				// Yeni Konu ise
				else
				{
					// Bildirim XML
					$sayfa_cikis .= '<BILDIRIM>
					<BASLIK><![CDATA[Yeni bir konu var]]></BASLIK>
					<KONU><![CDATA[Konu: '.$mesaj_satir['mesaj_baslik'].']]></KONU>
					<ADRES><![CDATA['.$alanadi.$dosya_mobil.'?ak='.$mesaj_satir['id'].']]></ADRES>
					<ZAMAN>'.$tarih.'</ZAMAN>
					<TARIH><![CDATA['.$mesaj_tarih.']]></TARIH>
					<YAZAN><![CDATA['.$mesaj_satir['yazan'].']]></YAZAN>
					<UYARI>1</UYARI>
					</BILDIRIM>';
				}
			}
		}
	}
}





//  KULLANICI GİRİŞ YAPMIŞSA    //
//  KULLANICI GİRİŞ YAPMIŞSA    //
//  KULLANICI GİRİŞ YAPMIŞSA    //

if (isset($kullanici_kim['id']))
{
	// Üyenin özel iletilerine bakılıyor //
	$sorgu = $vt->query("SELECT * FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null AND gonderme_tarihi > '$zaman' OR kime='$kullanici_kim[kullanici_adi]' AND kimden='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null") or die ();
	$oi_sayi = $vt->num_rows($sorgu);


	// Yeni özel ileti varsa
	if ($oi_sayi > 0)
	{
		$sorgu2 = "SELECT * FROM $tablo_ozel_ileti WHERE kime='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null AND gonderme_tarihi > '$zaman' OR kime='$kullanici_kim[kullanici_adi]' AND kimden='$kullanici_kim[kullanici_adi]' AND alan_kutu='1' AND okunma_tarihi is null ORDER BY gonderme_tarihi DESC LIMIT 10";
		$oi_sonuc = $vt->query($sorgu2) or die ();

		while ($oi_satir = $vt->fetch_assoc($oi_sonuc))
		{
			$bilsayi++;
			$oi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $oi_satir['gonderme_tarihi']);
			$oi_tarih = @str_replace($bul, $cevir, $oi_tarih);


			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir özel iletiniz var]]></BASLIK>
			<KONU><![CDATA[Özel ileti: '.$oi_satir['ozel_baslik'].']]></KONU>
			<ADRES><![CDATA['.$alanadi.'mobil/oi_oku.php?oino='.$oi_satir['id'].']]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$oi_tarih.']]></TARIH>
			<YAZAN><![CDATA['.$oi_satir['kimden'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}
	}





	//  ÜYE BİLDİRİMLERİ  //
	//  ÜYE BİLDİRİMLERİ  //

	// yöneticiler için ek sorgu
	if ($kullanici_kim['yetki'] != 0) $eksorgu = "uye_id='$kullanici_kim[id]' AND okundu='0' AND seviye='0' OR seviye='1' AND okundu='0'";
	else $eksorgu = "uye_id='$kullanici_kim[id]' AND okundu='0' AND seviye='0'";

	// Üyenin bildirimlerine bakılıyor
	$sorgu = "SELECT * FROM $tablo_bildirimler WHERE $eksorgu ORDER BY id";
	$bilsonuc = $vt->query($sorgu) or die ($vt->hata_ver());

	while ($bildirim = $vt->fetch_assoc($bilsonuc))
	{
		$okundu = false;
		$bildirim_tarihi = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $bildirim['tarih']);
		$bildirim_tarihi = @str_replace($bul, $cevir, $bildirim_tarihi);

		// profil yorum bildirimleri
		if ($bildirim['tip'] == '2')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir profil yorumunuz var]]></BASLIK>
			<KONU><![CDATA[Profil yorumu]]></KONU>
			<ADRES><![CDATA['.$alanadi.'profil.php]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// teşekkür bildirimleri
		elseif ($bildirim['tip'] == '4')
		{
			$bilsayi++;
			$okundu = true;
			$tsk_konu = explode(';', $bildirim['bildirim']);

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Bir yazınıza teşekkür edildi]]></BASLIK>
			<KONU><![CDATA[Teşekkür edildi]]></KONU>
			<ADRES><![CDATA['.$alanadi.'konu.php?'.$tsk_konu[1].']]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$tsk_konu[0].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// CMS yorum bildirimleri
		elseif ($bildirim['tip'] == '5')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Onaysız yorum var]]></BASLIK>
			<KONU><![CDATA[Onaysız yorum]]></KONU>
			<ADRES><![CDATA['.$alanadi.'phpkf-yonetim/yorumlar.php]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// sipariş bildirimleri
		elseif ($bildirim['tip'] == '6')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir sipariş var]]></BASLIK>
			<KONU><![CDATA[Ürün Sipariş]]></KONU>
			<ADRES><![CDATA['.$alanadi.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		// ödeme bildirimleri
		elseif ($bildirim['tip'] == '7')
		{
			$bilsayi++;
			$okundu = true;

			// Bildirim XML
			$sayfa_cikis .= '<BILDIRIM>
			<BASLIK><![CDATA[Yeni bir ödeme var]]></BASLIK>
			<KONU><![CDATA[Ürün Ödeme]]></KONU>
			<ADRES><![CDATA['.$alanadi.'phpkf-yonetim/ozel_sayfa.php?s=phpkf-bilesenler/eklentiler/urunler/urunler_yonetim.php&siparisler]]></ADRES>
			<ZAMAN>'.$tarih.'</ZAMAN>
			<TARIH><![CDATA['.$bildirim_tarihi.']]></TARIH>
			<YAZAN><![CDATA['.$bildirim['bildirim'].']]></YAZAN>
			<UYARI>1</UYARI>
			</BILDIRIM>';
		}


		if ($okundu == true)
		{
			// okundu olarak işaretle
			$sorgu2 = "UPDATE $tablo_bildirimler SET okundu='1' WHERE id='$bildirim[id]' LIMIT 1";
			$vtsonuc2 = $vt->query($sorgu2) or die ($vt->hata_ver());
		}
	}
}



$sayfa_bas = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n".'<PHPKF>'."\r\n";
if ($bilsayi == 0) $sayfa_bas .= $bosbildirim;
$sayfa_cikis = $sayfa_bas.$sayfa_cikis."\r\n".'</PHPKF>';
echo $sayfa_cikis;

?>