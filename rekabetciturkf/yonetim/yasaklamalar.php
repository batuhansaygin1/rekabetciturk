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
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


//      FORM DOLDURULDUYSA      //

if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


// zararlı kodlar temizleniyor
if (isset($_POST['kulad'])) $kulad = trim($_POST['kulad']);
if (isset($_POST['adsoyad'])) $adsoyad = trim($_POST['adsoyad']);
if (isset($_POST['posta'])) $posta = trim($_POST['posta']);
if (isset($_POST['sozcukler'])) $sozcukler = trim($_POST['sozcukler']);
if (isset($_POST['cumle'])) $cumle = trim($_POST['cumle']);
if (isset($_POST['yasak_ip'])) $yasak_ip = trim($_POST['yasak_ip']);



// kullanıcı adları için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $kulad);
$kulad = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);

	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($kulad != '') $kulad .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $kulad .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// ad soyad için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $adsoyad);
$adsoyad = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($adsoyad != '') $adsoyad .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $adsoyad .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// e-posta için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $posta);
$posta = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);

	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($posta != '') $posta .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $posta .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// sözcükler için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $sozcukler);
$sozcukler = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($sozcukler != '') $sozcukler .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $sozcukler .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// cümle için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $cumle);
$cumle = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($cumle != '') $cumle .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $cumle .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// ip adresi için, 3 karakterden az adresler atılıyor
$yasak_bosluk = explode("\r\n", $yasak_ip);
$yasak_ip = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if (!preg_match('/^[0-9 .]+$/', $yasak_bosluk[$d])) continue;
		$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);
		if ($yasak_ip != '') $yasak_ip .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $yasak_ip .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}




//  BİLGİLER VERİTABANINA GİRİLİYOR  //

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$kulad' where etiket='kulad' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$adsoyad' where etiket='adsoyad' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$posta' where etiket='posta' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$sozcukler' where etiket='sozcukler' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$cumle' where etiket='cumle' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$yasak_ip' where etiket='yasak_ip' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// güncellendi iletisi

header('Location: hata.php?bilgi=39');
exit();







//      SAYFA NORMAL GÖSTERİM  //

else:

//	YASAK KULLANICI ADLARI ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='kulad' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_kulad = $vt->fetch_row($yasak_sonuc);


//	YASAK POSTA ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='posta' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_posta = $vt->fetch_row($yasak_sonuc);


//	YASAK AD SOYADLAR ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='adsoyad' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_adsoyad = $vt->fetch_row($yasak_sonuc);


//	SANSÜRLENECEK SÖZCÜKLER ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='sozcukler' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_sozcukler = $vt->fetch_row($yasak_sonuc);


//	SANSÜR CÜMLESİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='cumle' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_cumle = $vt->fetch_row($yasak_sonuc);


//	YASAKLI IP ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='yasak_ip' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_ip = $vt->fetch_row($yasak_sonuc);



$sayfa_adi = 'Yönetim Yasaklamalar Sayfası';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Yasaklamalar</div>
<div class="kutu-icerik">


<form name="yasak" action="yasaklamalar.php" method="post">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center">
	<tr>
	<td>

<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
Buraya girdiğiniz kullanıcı adlarıyla kayıt yapılmasını önleyebilirsiniz.
<br>Girdiğiniz her ismi satır atlayarak birbirinden ayırınız.
<br>Şununla başlayan veya biten anlamında joker olarak yıldız * kullanabilirsiniz.
<br>Girilen isimler jokerle beraber en az 3 karakter olmalıdır.
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b>Örnek:</b>
<br>
<br>Ahmet
<br>Mehmet
<br>*Veli
<br>Veli*
<br>*Veli*
	</td>
	<td align="right" valign="middle">
<textarea name="kulad" class="formlar" cols="35" rows="8" style="width:290px">
<?php echo $yasak_kulad[0] ?>
</textarea>
	</td>
	</tr>
</table>
<br>
	</td>
	</tr>


		<!--		YASAK E-POSTA ADRESLERİ			-->


	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center">
E-Posta Adresi Yasaklama
	</td>
	</tr>

	<tr>
	<td>

<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
Buraya girdiğiniz e-posta adresleriyle kayıt yapılmasını önleyebilirsiniz.
<br>Girdiğiniz her e-posta adresini satır atlayarak birbirinden ayırınız.
<br>Bir alanadından gelen tüm adresleri yasaklamak için joker olarak yıldız ( * ) kullanabilirsiniz.
<br>Girilen adresler jokerle beraber en az 3 karakter olmalıdır.
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b>Örnek:</b>
<br>
<br>ahmet@yahoo.com
<br>mehmet@hotmail.com
<br>*@spam.com
	</td>
	<td align="right" valign="middle">
<textarea name="posta" class="formlar" cols="35" rows="8" style="width:290px">
<?php echo $yasak_posta[0] ?>
</textarea>
	</td>
	</tr>
</table>
<br>
	</td>
	</tr>


		<!--		YASAK AD SOYADLAR       -->


	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center">
Ad Soyad - Lâkap Yasaklama
	</td>
	</tr>

	<tr>
	<td>

<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
Buraya girdiğiniz sözcüklerin ad soyad - lâkap alanında yazılmasını engelleyebilirsiniz.
<br>Girdiğiniz her ismi satır atlayarak birbirinden ayırınız.
<br>Yazdığınız isimlerim başına sonuna joker yıldız ( * ) konulmuş olarak varsayılır, ayrıca girmeyin.
<br>Girilen isimler jokerle beraber en az 3 karakter olmalıdır.
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br>
<b>Örnek:</b>
<br>
<br>Ahmet
<br>Mehmet
<br>Veli
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="adsoyad" class="formlar" cols="35" rows="8" style="width:290px">
<?php echo $yasak_adsoyad[0] ?>
</textarea>
	</td>
	</tr>
</table>
<br>
	</td>
	</tr>


		<!--		SANSÜRLENECEK SÖZCÜKLER			-->


	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center">
Sansürlenecek Sözcükler
	</td>
	</tr>

	<tr>
	<td>

<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
Buraya girdiğiniz sözcüklerin, belirlediğiniz yasak cümlesi ile değiştirilmesini sağlayabilirsiniz.
<br>Girdiğiniz her sözcüğü satır atlayarak birbirinden ayırınız.
<br>Yazdığınız sözcüklerin başına sonuna joker yıldız ( * ) konulmuş olarak varsayılır, ayrıca girmeyin.
<br>Girilen sözcükler en az 3 karakter olmalıdır.
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top">
<br>
<b>Örnek:</b>
<br>
<br>küfür
<br>hack
<br>crack
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="sozcukler" class="formlar" cols="35" rows="8" style="width:230px">
<?php echo $yasak_sozcukler[0] ?>
</textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" valign="top">
<br><br>
<b>Sansürlenen sözcüklerin<br>yerine yazılacak cümle:</b>
<br><i>BBCode kullanabilirsiniz.
<br>Boş bırakabilirsiniz.</i>
	</td>
	<td class="liste-veri" align="right" valign="middle">
<br><br>
<input name="cumle" class="formlar" value="<?php echo $yasak_cumle[0] ?>" size="33" style="width:230px">
	</td>
	</tr>

</table>
<br>
	</td>
	</tr>


		<!--		YASAKLI IPLER			-->


	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center">
Yasaklanan ip Adresleri
	</td>
	</tr>

	<tr>
	<td>

<table border="0" align="center" cellspacing="0" cellpadding="0" width="490">
	<tr>
	<td class="liste-veri" align="left" valign="top" colspan="2">
<br>
Buraya yazdığınız ip adresleri ile sitenize girilmesini yasaklayabilirsiniz.
<br>Girdiğiniz her ip adresini satır atlayarak birbirinden ayırınız.
<br>Girdiğiniz ip adresi bir üyeye aitse hesabını da engelleyin.
<br>Girilen geçersiz karakterli satırlar otomatik silinir.
<br><br><br>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top">
<br>
<b>Örnek:</b>
<br>
<br>192.168.1.1
<br>127.0.0.1
	</td>
	<td class="liste-veri" align="right" valign="middle">
<textarea name="yasak_ip" class="formlar" cols="35" rows="8" style="width:290px">
<?php echo $yasak_ip[0] ?>
</textarea>
	</td>
	</tr>

</table>
<br>
	</td>
	</tr>



	<tr>
	<td align="center" class="liste-veri">
<input class="dugme" type="submit" value="Gönder">
&nbsp; &nbsp;
<input class="dugme" type="reset" value="Temizle">
<br>
	</td>
	</tr>
</table>

</form>

</div>
</div>
</div>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
endif;
?>