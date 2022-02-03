<?php
/*
 +-===================================================-+
 |              php Kolay Forum (phpKF)                |
 +-----------------------------------------------------+
 |    EKLENTİ ADI        :  TEŞEKKÜR EKLENTİSİ         |
 |    EKLENTİ SÜRÜMÜ     :  1.4                        |
 |    KODLAYAN           :  FaTe                       |
 |    UYARLAMA-DÜZENLEME :  Adem YILMAZ                |
 +-----------------------------------------------------+
 |  Buradaki kodlar yazardan izin almadan kullanılamaz |
 |  Emeğe saygı göstererek bu kurallara uyunuz ve      |
 |  bu bölümü silmeyiniz.                              |
 +-===================================================-+*/


@ini_set('magic_quotes_runtime', 0);

if (!defined('DOSYA_AYAR')) include '../../ayar.php';

if ($ayarlar['surum'] == '3.00')
{
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_GERECLER')) include '../../phpkf-bilesenler/gerecler_forum.php';
	if (!defined('DOSYA_SEO')) include '../../phpkf-bilesenler/seo.php';
}
else
{
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_GERECLER')) include '../../bilesenler/gerecler.php';
	if (!defined('DOSYA_SEO')) include '../../bilesenler/seo.php';
}



// gelen veriler temizleniyor

if ( (isset($_GET['mesajno'])) AND (is_numeric($_GET['mesajno']) == true) )
	$tmesajno = zkTemizle($_GET['mesajno']);
else $tmesajno = 0;


if ( (isset($_GET['cevapno'])) AND (is_numeric($_GET['cevapno']) == true) )
	$tcevapno = zkTemizle($_GET['cevapno']);
else $tcevapno = 0;



// giriş denetimi
if (!isset($kullanici_kim['id']))
{
	$git = @str_replace('&', 'veisareti', $_SERVER['REQUEST_URI']);

	header('Location: ../../hata.php?uyari=6&git='.$git);
	exit();
}


// konu veya cevap numarası yoksa

if (($tmesajno == 0) AND ($tcevapno == 0))
{
	header('Location: ../../hata.php?hata=3172');
	exit();
}



// konuya teşekkür ediliyorsa
if ($tmesajno > 0)
{
	$vtsorgu = "SELECT id,yazan,mesaj_baslik FROM $tablo_mesajlar WHERE id='$tmesajno' LIMIT 1";
	$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$mesaj_varmi = $vt->fetch_assoc($sonuctsk);


	if (!isset($mesaj_varmi['id']))
	{
		header('Location: ../../hata.php?hata=47');
		exit();
	}


	// kendi mesajına teşekkür etmesi önleniyor
	if ($kullanici_kim['kullanici_adi'] == $mesaj_varmi['yazan'])
	{
		header('Location: ../../hata.php?hata=3171&mesaj_no='.$tmesajno);
		exit();
	}


	$tskedilen = $mesaj_varmi['yazan'];
	$tskkonuno = $tmesajno;
	$tskcevapno = 0;
	$hangisayfa = 0;
	$konubaslik = $mesaj_varmi['mesaj_baslik'];
	$cevapek = '';


	// kullanıcının aynı cevaba teşekkür etmesi önleniyor
	$vtsorgu = "SELECT * FROM $tablo_tesekkur WHERE eden='$kullanici_kim[kullanici_adi]' AND konu_no='$tmesajno' LIMIT 1";
	$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$tsk_varmi = $vt->fetch_assoc($sonuctsk);


	if (isset($tsk_varmi['id']))
	{
		header('Location: ../../hata.php?hata=3173&mesaj_no='.$tmesajno);
		exit();
	}
}



// cevaba teşekkür ediliyorsa
else
{
	$vtsorgu = "SELECT id,tarih,cevap_yazan,hangi_basliktan FROM $tablo_cevaplar WHERE id='$tcevapno' LIMIT 1";
	$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$cevap_varmi = $vt->fetch_assoc($sonuctsk);


	if (!isset($cevap_varmi['id']))
	{
		header('Location: ../../hata.php?hata=55');
		exit();
	}


	$tskedilen = $cevap_varmi['cevap_yazan'];
	$tskkonuno = $cevap_varmi['hangi_basliktan'];
	$tskcevapno = $tcevapno;
	$cevapek = '#c'.$tskcevapno;


	// Cevabın bulunduğu konunun bilgileri alınıyor
	$vtsorgu = "SELECT id,mesaj_baslik,cevap_sayi FROM $tablo_mesajlar WHERE id='$tskkonuno' LIMIT 1";
	$sonuckb = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$konubaslik2 = $vt->fetch_assoc($sonuckb);
	$konubaslik = $konubaslik2['mesaj_baslik'];


	// Cevabın bulunduğu sayfada hesaplanıyor
	$vtsorgu = "SELECT id FROM $tablo_cevaplar WHERE silinmis='0' AND hangi_basliktan='$tskkonuno' AND tarih < $cevap_varmi[tarih] ORDER BY id";
	$sonuccs = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$cevapsirasi = $vt->num_rows($sonuccs);
	$cevapsirasi++;

	if ($cevapsirasi < $ayarlar['ksyfkota']) $hangisayfa = 0;
	else
	{
		$hangisayfa = ($cevapsirasi / $ayarlar['ksyfkota']);
		settype($hangisayfa,'integer');
		$hangisayfa = ($hangisayfa * $ayarlar['ksyfkota']);
	}


	// kendi mesajına teşekkür etmesi önleniyor
	if ($kullanici_kim['kullanici_adi'] == $cevap_varmi['cevap_yazan'])
	{
		header('Location: ../../hata.php?hata=3171&mesaj_no='.$tskkonuno.'&sayfa='.$hangisayfa.'&cevapno='.$tcevapno);
		exit();
	}


	// kullanıcının aynı cevaba teşekkür etmesi önleniyor
	$vtsorgu = "SELECT * FROM $tablo_tesekkur WHERE eden='$kullanici_kim[kullanici_adi]' AND cevap_no='$tcevapno' LIMIT 1";
	$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$tsk_varmi = $vt->fetch_assoc($sonuctsk);


	if (isset($tsk_varmi['id']))
	{
		header('Location: ../../hata.php?hata=3173&mesaj_no='.$tskkonuno.'&sayfa='.$hangisayfa.'&cevapno='.$tcevapno);
		exit();
	}
}




// TEŞEKKÜR VERİTABANINA GİRİLİYOR  //

$tarih = time();

$vtsorgu = "INSERT INTO $tablo_tesekkur (eden, edilen,tarih, konu_no, cevap_no)";
$vtsorgu .= "VALUES ('$kullanici_kim[kullanici_adi]','$tskedilen','$tarih','$tmesajno','$tcevapno')";
$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());


// teşekkür eden sayacı arttırılıyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET tsk_etti=tsk_etti+1 WHERE kullanici_adi='$kullanici_kim[kullanici_adi]' LIMIT 1";
$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());


// teşekkür edilen sayacı arttırılıyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET tsk_edildi=tsk_edildi+1 WHERE kullanici_adi='$tskedilen' LIMIT 1";
$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());


// üye id numarası alınıyor
$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE kullanici_adi='$tskedilen' LIMIT 1";
$sonuctsk = $vt->query($vtsorgu) or die ($vt->hata_ver());
$kulid = $vt->fetch_assoc($sonuctsk);


// bildirim veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
$vtsorgu .= "VALUES ('$tarih','$kulid[id]','0','4','0','$kullanici_kim[kullanici_adi];k=$tskkonuno&ks=$hangisayfa#c$tskcevapno')";
$sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());



// işlemler tamam, bilgi iletisine yönlendir

header('Location: ../../konu.php?k='.$tskkonuno.'&ks='.$hangisayfa.'#c'.$tskcevapno);
//header('Location: ../../hata.php?bilgi=3170&mesaj_no='.$tskkonuno.'&sayfa='.$hangisayfa.'&cevapno='.$tskcevapno);
exit();

?>