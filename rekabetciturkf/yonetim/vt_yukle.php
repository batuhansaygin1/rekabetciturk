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


if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}



		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - BAŞI	//


//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA ÇOK BÜYÜKSE	//

if ( (isset($_FILES['vtyukle']['error'])) AND ($_FILES['vtyukle']['error'] != 0) )
{
	header('Location: hata.php?hata=156');
	exit();
}


if ( (isset($_FILES['vtyukle']['tmp_name'])) AND
		($_FILES['vtyukle']['tmp_name'] != '') ):


//	DOSYA 5`MB. DAN BÜYÜKSE	//

if ($_FILES['vtyukle']['size'] > 5242880):
	header('Location: hata.php?hata=157');
	exit();
endif;


$uzanti = end(explode(".", strtolower($_FILES['vtyukle']['name'])));


//	DOSYA SIKIŞTIRILMIŞ MI BAKILIYOR	//

if ($uzanti == 'gz'):

	if(extension_loaded('zlib'))
	{
		$gzipdosya01 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac01 = gzread( $gzipdosya01, 9921920 );
		gzclose($gzipdosya01);

		//	çift sıkıştırılımış olma olasılığına karşı tekrar açılıyor
		$yeni_gzipdosya = fopen($_FILES['vtyukle']['tmp_name'], 'w') or die ("Dosya açılamıyor!");
		fwrite($yeni_gzipdosya, $gzipac01);
		fclose($yeni_gzipdosya);

		$gzipdosya02 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac02 = gzread( $gzipdosya02, 9921920 );
		gzclose($gzipdosya02);

		$ac = $gzipac02;
	}

	else
	{
		header('Location: hata.php?hata=158');
		exit();
	}



//	DOSYA .SQL UZANTILI DEĞİLSE	//

elseif ($uzanti != 'sql'):

	header('Location: hata.php?hata=159');
	exit();


//	TEMP'TEKİ DOSYANIN İÇİNDEKİLER DEĞİŞKENE AKTARILIYOR	//

else:
$dosya = @fopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
$boyut = @filesize($_FILES['vtyukle']['tmp_name']);
$ac = @fread( $dosya, $boyut );
endif;





// dosyadaki veriler satır satır dizi değişkene aktarılıyor //
$toplam = explode(";\n\n", $ac);

// satır sayısı alınıyor //
$toplam_sayi = count($toplam);

// dizideki satırlar döngüye sokuluyor //
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor //
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor //
				$vtsorgu = $vt->query($yorum[$satir2]) or die ($vt->hata_ver());
			}
		}

		else // sorgu veritabanına giziliyor //
		$vtsorgu = $vt->query($toplam[$satir]) or die ($vt->hata_ver());
	}
}


//	VERİTABANI YEDEĞİ YÜKLENDİ MESAJI	//


setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);

header('Location: ../hata.php?bilgi=38');
exit();



		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - SONU	//


		//	GİRİŞ SAYFASI KISMI - BAŞI	//

else:
$sayfa_adi = 'Yönetim Veritabanı Geri Yükleme';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Veritabanı Geri Yükleme</div>
<div class="kutu-icerik">


<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri" >
<br>

Buradan sadece forum üzerinden aldığınız yedekleri yükleyebilirsiniz!
<p>
&nbsp; Bir çok sunucuda kabul edilen en büyük dosya boyutu 2mb. olduğu için, yüklenebilecek en büyük yedek dosya boyutu 2mb.`dır.
<br>Büyük veritabanları için yedekleri tablo tablo almayı deneyin. Tek bir tablo da 2mb.`dan büyükse <a href="vt_yedek.php?kip=gelismis">gelişmiş yedeklemeyi</a> kullanın.

<p>&nbsp; Gzip biçiminde sıkıştırılmış dosyalar otomatik açılıp yüklenir.

<p>&nbsp; Veritabanı geri yükleme işlemi, dosya büyüklüğüne ve sunucu yoğunluğuna göre biraz uzun sürebilir. Dosya sunucuya ulaştıktan sonra 30 saniye kadar daha sürebilir. Lütfen yükleme bitene kadar bekleyin.

<p>&nbsp;Bir çok sunucuda, kilitlenmeye sebep olmaması için bir betiğin çalıştırılabileceği süre 30 saniye ile sınırlanmıştır. Eğer <b>Fatal error: Maximum execution time of 30 seconds exceeded in...</b> şeklinde bir mesaj alırsanız, bu engele takıldınız anlamına gelmektedir.

<p>&nbsp;2mb.`dan büyük veritabanı ve/veya tablo yedekleri için, barındırma hizmeti aldığınız firmanın size sağladığı araçları kullanmanızı öneririz. Ayrıca <a href="http://mysql.navicat.com/download.html">Navicat</a> veya <a href="http://www.mysqlfront.de/download.html">MySQL-Front</a> da kullanabilirsiniz.
</p>
<br>
<br>
<center>
<form name="vtyukleme" action="vt_yukle.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="2621440">
<input class="formlar" name="vtyukle" type="file" size="30">
<br>
<br>
<br>
<input class="dugme" type="submit" value="Geri Yükle">
</form>
</center>
<br>
	</td>
	</tr>
</table>


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