<?php

if (!defined('DOSYA_AYAR')) include_once('../ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('tema_sinif.php');
if (!defined('DOSYA_GUVENLIK')) include_once('guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'kullanici_kimlik.php';
$tarih = time();
// Giriş Yapan Kullanıcı Bilgileri

@$kullanici = $kullanici_kim['kullanici_adi'];
///////////////////////////////////////

// Karşı taraf bilgileri
@$arkadas = @zkTemizle($_GET["ekle_kimi"]);
if( (empty($_GET)) )
{
echo 'İşlem Belirtilmedi!';
}else if(isset($_GET["ekle_kimi"])) //Arkadaş Ekleme Başı
{
if($_GET["ekle_kimi"] !== $kullanici)
{
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$profil = $vt->fetch_array($vtsonuc);

	if (empty($profil['kullanici_adi']))
	{
		echo 'Böyle Bir Kullanıcı Bulunmamaktadır!';
		exit();
	}
$denetle1 = "SELECT * FROM $tablo_istekler WHERE kullanici_adi='$kullanici' and arkadas='$arkadas'";
$dsonuc = $vt->query($denetle1) or die ($vt->hata_ver());
$denetle = $vt->fetch_row($dsonuc);
if($denetle > 0)
{
			echo 'Aynı İşlemi Tekrarlayamazsınız!';
			exit();
exit();
}
$vt->query("Insert into $tablo_istekler (kullanici_adi,arkadas) VALUES ('$kullanici', '$arkadas')") or die ($vt->hata_ver());
// bildirim veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
$vtsorgu .= "VALUES ('$tarih','$profil[id]','0','20','0','$kullanici')";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			echo 'Arkadaşlık İsteğiniz Gönderildi';
			exit();
			
}else{
echo 'Kendinizi Arkadaş Olarak Ekleyemezsiniz!';
exit();
}
} // Arkadaş Ekleme Sonu
if(isset($_GET["gericek_kimden"])) // Arkadaşlık Isteği Geri  Çek Başı
{
@$arkadas2 = @zkTemizle($_GET["gericek_kimden"]);
if($_GET["gericek_kimden"] !== $kullanici)
{
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas2' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$profil = $vt->fetch_array($vtsonuc);

	if (empty($profil['kullanici_adi']))
	{
		echo 'Böyle Bir Kullanıcı Bulunmamaktadır!';
		exit();
	}
$vt->query("delete from $tablo_istekler where kullanici_adi='$kullanici' and arkadas='$arkadas2'") or die ($vt->hata_ver());
			echo 'Arkadaşlık İsteğiniz Geri Çekildi';
			exit();
		
}else{
echo 'Kendiniz için bu işlemi yapamazsınız!';
exit();
}
} // Arkadaslik Isteği Geri Çek Sonu
if(isset($_GET["sil_kimi"])) // Arkadasliktan Sil Basi
{
@$arkadas3 = @zkTemizle($_GET["sil_kimi"]);
if($_GET["sil_kimi"] !== $kullanici)
{
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas3' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$profil = $vt->fetch_array($vtsonuc);

	if (empty($profil['kullanici_adi']))
	{
		echo 'Böyle Bir Kullanıcı Bulunmamaktadır!';
		exit();
	}
$vt->query("delete from $tablo_arkadaslar where kullanici_adi='$kullanici' and arkadas='$arkadas3'") or die ($vt->hata_ver());
$vt->query("delete from $tablo_arkadaslar where arkadas='$kullanici' and kullanici_adi='$arkadas3'") or die ($vt->hata_ver());
			echo 'Arkadaşlıktan Silindi';
			exit();
}else{
echo 'Kendiniz için bu işlemi yapamazsınız!';
exit();
}
} // Arkadaşlıktan Sil Sonu
if(isset($_GET["reddet_kimi"])) //İsteği Redd Et Başı
{
@$arkadas4 = @zkTemizle($_GET["reddet_kimi"]);
if($_GET["reddet_kimi"] !== $kullanici)
{
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas4' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$profil = $vt->fetch_array($vtsonuc);

	if (empty($profil['kullanici_adi']))
	{
		echo 'Böyle Bir Kullanıcı Bulunmamaktadır!';
		exit();
	}
$vt->query("delete from $tablo_istekler where kullanici_adi='$kullanici' and arkadas='$arkadas4'") or die ($vt->hata_ver());
$vt->query("delete from $tablo_istekler where kullanici_adi='$arkadas4' and arkadas='$kullanici'") or die ($vt->hata_ver());
			echo 'Arkadaşlık İsteğini Redd Ettiniz';
			exit();
}else{
echo 'Kendiniz için bu işlemi yapamazsınız!';
exit();
}
} // İsteği Redd Et Sonu
if(isset($_GET["kabulet_kimi"])) //Istegi Kabulet Basi
{
@$arkadas5 = @zkTemizle($_GET["kabulet_kimi"]);
if($_GET["kabulet_kimi"] !== $kullanici)
{
$vtsorgu = "SELECT * FROM $tablo_kullanicilar WHERE kullanici_adi='$arkadas5' LIMIT 1";

	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$profil = $vt->fetch_array($vtsonuc);

	if (empty($profil['kullanici_adi']))
	{
		echo 'Böyle Bir Kullanıcı Bulunmamaktadır!';
		exit();
	}
$denetle22 = "SELECT * FROM $tablo_arkadaslar WHERE kullanici_adi='$kullanici' and arkadas='$arkadas5'";
$ddsonuc = $vt->query($denetle22) or die ($vt->hata_ver());
$denetle2 = $vt->fetch_assoc($ddsonuc);
if($denetle2)
{
			echo 'Aynı İşlemi Tekrarlayamazsınız!';
			exit();
}
$vt->query("delete from $tablo_istekler where kullanici_adi='$arkadas5' and arkadas='$kullanici'") or die ($vt->hata_ver());
$vt->query("Insert into $tablo_arkadaslar (kullanici_adi,arkadas) VALUES ('$kullanici', '$arkadas5')") or die ($vt->hata_ver());
$vt->query("Insert into $tablo_arkadaslar (kullanici_adi,arkadas) VALUES ('$arkadas5', '$kullanici')") or die ($vt->hata_ver());
// bildirim veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
$vtsorgu .= "VALUES ('$tarih','$profil[id]','0','21','0','$kullanici')";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			echo 'Arkadaşlık İsteğini Kabul Ettiniz';
			exit();
}else{
echo 'Kendiniz için bu işlemi yapamazsınız!';
exit();
}
} // Istegi Kabul Et Sonu
?>