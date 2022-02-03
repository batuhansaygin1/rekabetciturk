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


if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'guncelle') )
{
	// Üyeler alınıyor
	$vtsorgu2 = "SELECT id, kullanici_adi FROM $tablo_kullanicilar ORDER BY id";
	$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

	while ($uyeler = $vt->fetch_assoc($vtsonuc2))
	{
		// Konu sayısı alınıyor
		$vtsorgu = "SELECT id FROM $tablo_mesajlar WHERE yazan='$uyeler[kullanici_adi]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$konu_sayisi = $vt->num_rows($vtsonuc);

		// Cevap sayısı alınıyor
		$vtsorgu = "SELECT id FROM $tablo_cevaplar WHERE cevap_yazan='$uyeler[kullanici_adi]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$cevap_sayisi = $vt->num_rows($vtsonuc);

		$toplam = ($konu_sayisi + $cevap_sayisi);

		// Üye mesaj sayısı güncelleniyor
		$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi='$toplam' WHERE id='$uyeler[id]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		/*echo 'Üye: '.$uyeler['kullanici_adi'];
		echo '<br>Konu: '.$konu_sayisi;
		echo '<br>Cevap: '.$cevap_sayisi;
		echo '<br>Toplam: '.$toplam;
		echo '<br><br>';*/
	}

	header('Location: hata.php?bilgi=56');
	exit();
}



$sayfa_adi = 'Yönetim Üye İleti Sayısı Güncelleme';
include_once('bilesenler/sayfa_baslik.php');
include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Yönetim Üye İleti Sayısı Güncelleme</div>
<div class="kutu-icerik">
phpKF sürüm 2.00 ve önceki sürümlerde yazılar silindiğinde üyelerin ileti sayıları düşürülmüyordu.
<br>2.10 ve sonraki sürümlerde bu uygulamadan vazgeçildi ve ileti sayısı düşürülecek şekilde yeniden ayarlandı.
<br><br>
Eksi sürümlerden güncelleme yapanlar aşağıdaki düğmeyi tıklayarak, üye ileti sayılarını güncelleyebilirler.
<br>
Tüm forum bölümünün silinmesi sonrasında da bu işlemi tekrarlayınız.
<br><br><br>

<center>
<form name="guncelle_form" action="ileti_guncelle.php" method="get">
<input type="hidden" name="kip" value="guncelle" />
<input class="dugme" type="submit" value="Güncelle">
</form>
</center>
<br>

</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>