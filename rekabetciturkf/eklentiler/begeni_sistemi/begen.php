<?php

if (!defined('DOSYA_AYAR')) include '../../ayar.php';

if ((isset($ayarlar['surum'])) AND ($ayarlar['surum'] == '3.00'))
{
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_GERECLER')) include '../../phpkf-bilesenler/gerecler.php';
}
else
{
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_GERECLER')) include '../../bilesenler/gerecler.php';
}

$tablo_begeni = $tablo_oneki.'begeniler';

// giriş kontrolü
if (!isset($kullanici_kim['id']))
{
	echo "Sadece Üyeler Oylama Yapabilir";
	exit();
}

$k_id = $kullanici_kim['id'];
$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE id='$k_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$kullanici_kim = $vt->fetch_assoc($vtsonuc);


if (isset($_POST["begen_id"])) $begen_id = zkTemizle($_POST["begen_id"]);
else $begen_id = false;

if (isset($_POST["begenme_id"])) $begenme_id = zkTemizle($_POST["begenme_id"]);
else $begenme_id = false;

if (!$begen_id)
{
	echo "Yazı belirtilmedi!";
	exit();
}


else
{
	// Sorgulama
	$bsorgu = "SELECT * FROM $tablo_begeni WHERE uye_id='$k_id' AND yazi_id='$begen_id' LIMIT 1";
	$bsonuc = $vt->query($bsorgu) or die ($vt->hata_ver());
	$bsatir = $vt->fetch_array($bsonuc);

	if ($bsatir > 0)
	{
		echo 'Daha önce oylama yaptınız!';
		exit();
	}


	// Yazı var mı
	$bksorgu = "SELECT id FROM $tablo_mesajlar WHERE id='$begen_id' OR id='$begenme_id' LIMIT 1";
	$bksonuc = $vt->query($bksorgu) or die ($vt->hata_ver());
	$bksatir = $vt->fetch_array($bksonuc);

	if (!isset($bksatir['id']))
	{
		echo 'Böyle bir yazı bulunmamaktadır!';
		exit();
	}


	// Ekleme
	if ($begenme_id != '')
	{
		$begen_sorgu = "UPDATE $tablo_mesajlar SET begenmeyenler=begenmeyenler+1 WHERE id='$begenme_id' LIMIT 1";
		$begen_sonuc = $vt->query($begen_sorgu) or die ($vt->hata_ver());

		$begen_sorgu = "INSERT INTO $tablo_begeni (uye_id, puan, yazi_id) VALUES ('$k_id','-1','$begenme_id')";
		$begen_sonuc2 = $vt->query($begen_sorgu) or die ($vt->hata_ver());
	}

	else
	{
		$begen_sorgu = "UPDATE $tablo_mesajlar SET begenenler=begenenler+1 WHERE id='$begen_id' LIMIT 1";
		$begen_sonuc = $vt->query($begen_sorgu) or die ($vt->hata_ver());

		$begen_sorgu = "INSERT INTO $tablo_begeni (uye_id, puan, yazi_id) VALUES ('$k_id','1','$begen_id')";
		$begen_sonuc2 = $vt->query($begen_sorgu) or die ($vt->hata_ver());
	}

	if (!$begen_sonuc)
	{
		echo "Bir sorun oluştu";
		exit();
	}

	elseif (!$begen_sonuc2)
	{
		echo "Bir sorun oluştu";
		exit();
	}

	else
	{
		echo 'Oylama için teşekkürler!';
		exit();
	}
}
?>