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
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'kullanici_kimlik.php';



// Yüklenmesine izin verilen dosya tipleri
$TanimliDosyaTipleri = str_replace(' ', '', $ayarlar['yukleme_dosya']);

// En fazla dosya boyutu
$resim_boyut = $ayarlar['yukleme_boyut'];

// En fazla resim genişliği
$resim_genislik = $ayarlar['yukleme_genislik'];

// En fazla resim yüksekliği
$resim_yukseklik = $ayarlar['yukleme_yukseklik'];

// Dosya yükleme dizini
$dosya_yolu = '../'.$ayarlar['yukleme_dizin'].'/';



$sayfano = 46;
$sayfa_adi = 'Dosya Yükleme';

$tarih = time();
$bicim_tarih = date('d.m.Y- H:i:s', $tarih);
$sure = $ayarlar['ileti_sure'];

$cikis1 = '<br><center><font color="#ff0000"><b>';
$cikis2 = '<p>&nbsp; <a href="dyukle.php">&laquo; &nbsp;geri</a></b></font></center>';
$cikis3 = '</b></font></center>';


$kul_ip = @zkTemizle($_SERVER['REMOTE_ADDR']);
$adres = '//'.$ayarlar['alanadi'].$anadizin;



// üye kontrolü yapılıyor
if (!isset($kullanici_kim['id']))
{
	echo $cikis1.'Sadece üyeler yükleme yapılabilir !<br><br></font><font color="#000000"><a href="giris.php" target="_blank">Giriş</a> &nbsp; - &nbsp; <a href="kayit.php" target="_blank">Kayıt</a>'.$cikis3;
	exit();
}





// Kod ekleme javascript kodu
$kod_ekle = '
function YuklemeAcKapat(durum){
var alan1 = top.document.getElementById("yukleme_pencere");
var alan2 = top.document.getElementById("dyukle");
if (durum==1){
alan1.style.display="block";
alan2.src="bilesenler/dyukle.php";}
else alan1.style.display="none";
}

function denetle(){
var dogruMu = true;
if (document.yukleme.yukle.value.length < 4){
dogruMu = false; 
alert("Dosya seçmeyi unuttunuz !");}
else;
return dogruMu;}

function kilitle(){
var dogruMu = false;
if (document.yukleme.yukle.value.length > 4){
document.yukleme.yolla.value="Yükleniyor...";
document.yukleme.yolla.disabled="disabled";
document.yukleme.submit();
dogruMu = true;}
var dogruMu;}

function kod_ekle(adres, dosya_adi)
{
	var yukleme_duzenleyici_id = "mesaj_icerik";
	var yukleme_duzenleyici_katman = "mesaj_icerik_div";
	var div_katman = top.document.getElementById(yukleme_duzenleyici_katman);

	var kod = "html";
	if (div_katman){if (div_katman.style.display != "inline") kod = "bbcode";}

	var desen = new RegExp("/yonetim/", "gi");
	if (unescape(top.document.location).match(desen)) kod = "html";


	if (kod == "bbcode")
	{
		if ((dosya_adi.match(/.jpg$/gim)) || (dosya_adi.match(/.jpeg$/gim)) || (dosya_adi.match(/.gif$/gim)) || (dosya_adi.match(/.png$/gim)) || (dosya_adi.match(/.bmp$/gim)) || (dosya_adi.match(/.ico$/gim)))
			dosya="[img]" + adres + "[/img]";
		else if ((dosya_adi.match(/.mp4$/gim)) || (dosya_adi.match(/.flv$/gim)) || (dosya_adi.match(/.webm$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.ogv$/gim)) || (dosya_adi.match(/.ogx$/gim)) || (dosya_adi.match(/.ogm$/gim)))
			dosya="[video]" + adres + "[/video]";
		else if ((dosya_adi.match(/.mp3$/gim)) || (dosya_adi.match(/.wav$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.oga$/gim)) || (dosya_adi.match(/.opus$/gim)) || (dosya_adi.match(/.spx$/gim)) || (dosya_adi.match(/.flac$/gim)) || (dosya_adi.match(/.aif$/gim)))
			dosya="[audio]" + adres + "[/audio]";
		else dosya = "[url=" + adres + "][b]" + dosya_adi.replace(/^'.$kullanici_kim['id'].'-/g, "") + "[/b][/url]";
	}

	else
	{
		if (div_katman){if (div_katman.style.display == "inline") div_katman.focus();}
		if ((dosya_adi.match(/.jpg$/gim)) || (dosya_adi.match(/.jpeg$/gim)) || (dosya_adi.match(/.gif$/gim)) || (dosya_adi.match(/.png$/gim)) || (dosya_adi.match(/.bmp$/gim)) || (dosya_adi.match(/.ico$/gim)))
			dosya = "<img src=\"" + adres + "\">";
		else if ((dosya_adi.match(/.mp4$/gim)) || (dosya_adi.match(/.flv$/gim)) || (dosya_adi.match(/.webm$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.ogv$/gim)) || (dosya_adi.match(/.ogx$/gim)) || (dosya_adi.match(/.ogm$/gim)))
			dosya="[video]" + adres + "[/video]";
		else if ((dosya_adi.match(/.mp3$/gim)) || (dosya_adi.match(/.wav$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.oga$/gim)) || (dosya_adi.match(/.opus$/gim)) || (dosya_adi.match(/.spx$/gim)) || (dosya_adi.match(/.flac$/gim)) || (dosya_adi.match(/.aif$/gim)))
			dosya="[audio]" + adres + "[/audio]";
		/*else if ((dosya_adi.match(/.mp4$/gim)) || (dosya_adi.match(/.flv$/gim)) || (dosya_adi.match(/.webm$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.ogv$/gim)) || (dosya_adi.match(/.ogx$/gim)) || (dosya_adi.match(/.ogm$/gim)))
			dosya="<video src=\"" + adres + "\" width=\"100%\" controls=\"true\">Browser does not support the video tag (Tarayıcı video etiketi desteklemiyor)</video>";
		else if ((dosya_adi.match(/.mp3$/gim)) || (dosya_adi.match(/.wav$/gim)) || (dosya_adi.match(/.ogg$/gim)) || (dosya_adi.match(/.oga$/gim)) || (dosya_adi.match(/.opus$/gim)) || (dosya_adi.match(/.spx$/gim)) || (dosya_adi.match(/.flac$/gim)) || (dosya_adi.match(/.aif$/gim)))
			dosya="<audio src=\"" + adres + "\" controls=\"true\">Browser does not support the audio tag (Tarayıcı audio etiketi desteklemiyor)</audio>";*/
		else dosya = "<a href=\"" + adres + "\"><b>" + dosya_adi.replace(/^'.$kullanici_kim['id'].'-/g, "") + "</b></a>";
	}


	// editör seçimi için varsayılan değişkenler
	if (typeof(top.tinyMCE) !== "undefined") var Btinymce = top.tinyMCE.activeEditor;
	else var Btinymce = "";

	if (typeof(top.$.sceditor) !== "undefined"){
		if (top.$("#"+yukleme_duzenleyici_id).sceditor("instance")) var Bsceditor = yukleme_duzenleyici_id;
		else var Bsceditor = "";
	}
	else var Bsceditor = "";


	// tinyMCE için
	if (Btinymce.id==yukleme_duzenleyici_id)
	{
		Btinymce.focus();
		Btinymce.selection.setContent(dosya);
	}

	// CKEditor için
	else if ( (typeof(top.CKEDITOR) !== "undefined") && (typeof(top.CKEDITOR.instances[yukleme_duzenleyici_id]) !== "undefined") )
	{
		top.CKEDITOR.instances[yukleme_duzenleyici_id].insertHtml(dosya);
	}

	// SCEditor için
	else if (Bsceditor==yukleme_duzenleyici_id)
	{
		top.$("#"+yukleme_duzenleyici_id).sceditor("instance").focus();
		var veri = top.$("#"+yukleme_duzenleyici_id).sceditor("instance").val();
		top.$("#"+yukleme_duzenleyici_id).sceditor("instance").val(veri+dosya);
	}

	// phpKF ve diğer editörler için
	else
	{
		if (top.document.getElementById(yukleme_duzenleyici_id) != null) top.document.getElementById(yukleme_duzenleyici_id).value += dosya;
		if (top.document.getElementById(yukleme_duzenleyici_katman) != null){
			top.document.getElementById(yukleme_duzenleyici_katman).innerHTML += dosya;
		}
	}

	YuklemeAcKapat(0);
}';




// CSS Kodları
$css_kod = '
<style type="text/css">
BODY {
 position:relative;
 background-color:#f0f0f0;
 margin:0;
 padding:0;
}
html{
 height:100%;
}
a,a:active,a:focus,a:active {
 color:#0000ff;
 outline: 0;
 text-decoration:none;
}
a:hover{
 color:#000000;
 text-decoration:none;
}
.katman1 {
 margin:10px 10px 0 10px;
 background-color:#ffffff;
 border:1px solid #d0d0d0;
 text-align:center;
 height:280px;
}
.katman2 {
 text-align:left;
 width:400px;
 font-family:verdana;
 font-size:11px;
 margin:0 auto;
 line-height:17px;
}
.kapat-kutu{
 position:relative;
 top:0px;
 left:0px;
 right:0px;
 display:block;
 width:100%;
 color:#555;
 padding:5px 0;
 text-align:right;
}
.kapat-kutu .kapat-dugme{
 margin:10px;
}
.kapat-grafik{
 display:block;
 float:right;
 width:24px;
 height:24px;
 padding-right:10px;
 font-weight:bold;
 color:#333;
 font-family:verdana;
 font-size:18px;
}
</style>';





// YÜKLENEN DOSYA KONTROL EDİLİYOR  //

if ( (isset($_FILES['yukle']['tmp_name'])) AND ($_FILES['yukle']['tmp_name'] != '') ):

//  çift tıklanma olasılığına karşı 1 saniye bekleniyor
sleep(1);

if (!defined('DOSYA_GERECLER')) include 'gerecler.php';

@session_start();

if (!isset($_SESSION['yukleme_zamani'])) $_SESSION['yukleme_zamani'] = 0;


// ardarda yükleme yapılması engelleniyor
if (($_SESSION['yukleme_zamani']+$sure) > $tarih)
{
	echo $cikis1.'Son yüklemenizin üzerinden '.$sure.' saniye geçmeden başka yükleme yapamazsınız !<br>Kalan süre '.(($_SESSION['yukleme_zamani'] + $sure) - $tarih).' saniye.'.$cikis2;
	exit();
}


// dosya boyutuna bakılıyor
if ($_FILES['yukle']['size'] > $resim_boyut)
{
	echo $cikis1.'Yüklemeye çalıştığınız dosya '.($resim_boyut/1024).' kilobayt`dan büyük olamaz !'.$cikis2;
	exit();
}



$uzanti = explode(".", strtolower($_FILES['yukle']['name']));
$uzanti = end($uzanti);



// kabul edilen uzantılar kontrol ediliyor
if (!preg_match("/$uzanti/", $TanimliDosyaTipleri))
{
	echo $cikis1.'Yüklemeye çalıştığınız dosya tipine izin verilmemektedir.'.$cikis2;
	exit();
}


// zip uzantılı dosyalar
if ($uzanti == 'zip')
{
	if (@extension_loaded('zip'))
	{
		$arsiv = new ZipArchive;
		$zip_dosya = $arsiv->open($_FILES['yukle']['tmp_name']);

		if ($zip_dosya !== true)
		{
			echo $cikis1.'Yüklemeye çalıştığınız zip dosyası bozuk !'.$cikis2;
			exit();
		}
	}

	else
	{
		echo $cikis1.'Sunucuda zip desteği yok !'.$cikis2;
		exit();
	}
}


// Resim dosyaları
elseif (($uzanti == 'gif') OR ($uzanti == 'jpg') OR ($uzanti == 'jpeg') OR ($uzanti == 'png'))
{
	list($genislik, $yukseklik, $tip) = getimagesize($_FILES['yukle']['tmp_name']);

	// gif uzantılı dosyalar
	if ((isset($tip)) AND ($tip == 1))
	{
		if (!@imagecreatefromgif($_FILES['yukle']['tmp_name']))
		{
			echo $cikis1.'Yüklemeye çalıştığınız resim bozuk !'.$cikis2;
			exit();
		}
	}

	// jpg uzantılı dosyalar
	elseif ((isset($tip)) AND ($tip == 2))
	{
		if (!@imagecreatefromjpeg($_FILES['yukle']['tmp_name']))
		{
			echo $cikis1.'Yüklemeye çalıştığınız resim bozuk !'.$cikis2;
			exit();
		}
	}

	// png uzantılı dosyalar
	elseif ((isset($tip)) AND ($tip == 3))
	{
		if (!@imagecreatefrompng($_FILES['yukle']['tmp_name']))
		{
			echo $cikis1.'Yüklemeye çalıştığınız resim bozuk !'.$cikis2;
			exit();
		}
	}

	else
	{
		echo $cikis1.'Yüklemeye çalıştığınız resim bozuk !'.$cikis2;
		exit();
	}


	// resim en ve boyuna bakılıyor
	if (($genislik > $resim_genislik) OR ($yukseklik > $resim_yukseklik))
	{
		echo $cikis1.'Yüklemeye çalıştığınız resmin boyutları '.NumaraBicim($resim_genislik).'x'.NumaraBicim($resim_yukseklik).' piksel`den büyük olamaz !'.$cikis2;
		exit();
	}
}



// isim değiştirme fonksiyonu
function isimDonustur($isim)
{
	$isim = rawurldecode($isim);
	$b = array(' ',',','ş','Ş','ü','Ü','ö','Ö','ç','Ç','ğ','Ğ','ı','İ');
	$d = array('-','_','s','s','u','u','o','o','c','c','g','g','i','i');
	$isim = @str_replace ($b, $d, $isim);
	$isim = @strtolower($isim);
	$isim = @preg_replace('#[^-a-zA-Z0-9_.]#','',$isim);
	return $isim;
}


// dosya adı oluşturuluyor
$dosya_adi = $kullanici_kim['id'].'-'.isimDonustur($_FILES["yukle"]["name"]);
$dosya_yolu2 = $dosya_yolu.$dosya_adi;


// dosya taşınıyor
if (!@move_uploaded_file($_FILES["yukle"]["tmp_name"],$dosya_yolu2))
{
	echo $cikis1.'Dosya yüklenemedi, dizine yazma hakkı yok !<br><br>Yöneticiyseniz FTP programınızdan '.$dosya_yolu.'<br>dizinine yazma hakkı vermeyi (chmod 777) deneyin.'.$cikis2;
	exit();
}



$dosya_adresi = $adres.str_replace('../', '', $dosya_yolu2);
$_SESSION['yukleme_zamani'] = $tarih;
$_SERVER['REMOTE_ADDR'] = @zkTemizle($_SERVER['REMOTE_ADDR']);


$boyut = $_FILES['yukle']['size'];
settype($boyut,'integer');
$boyut = ($boyut / 1024);
settype($boyut,'integer');
$boyut++;



// dosya_yukleme tablosuna giriliyor
$satir = "INSERT INTO $tablo_yuklemeler (tarih,boyut,ip,uye_id,uye_adi,dosya) VALUES ('$tarih', '$boyut', '$_SERVER[REMOTE_ADDR]', '$kullanici_kim[id]', '$kullanici_kim[kullanici_adi]', '$dosya_adi')";
$vtsonuc = $vt->query($satir) or die ($vt->hata_ver());

?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<title><?php echo $sayfa_adi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<script type="text/javascript"><!-- //
<?php
echo $kod_ekle;
echo 'kod_ekle("'.$dosya_adresi.'", "'.$dosya_adi.'");';
?>
// -->
</script>
</body>
</html>
<?php

//  DOSYA YÜKLEME - SONU  //












//  YÜKLÜ DOSYALAR SIRALANIYOR - BAŞI  //

elseif ( (isset($_GET['yuklu'])) AND ($_GET['yuklu'] == 'goster') ):

$vtsorgu = "SELECT * FROM $tablo_yuklemeler WHERE uye_id='$kullanici_kim[id]' ORDER BY id ASC";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Yüklü Dosyalar</title>
<?php echo $css_kod; ?>
<link href="../temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<script type="text/javascript"><!-- //
<?php echo $kod_ekle; ?>
top.document.getElementById("dyukle").style.width="600px";
top.document.getElementById("dyukle").style.height="400px";
if(window.navigator.userAgent.match(/(android|mobile)/i)){
top.document.getElementById("dyukle").style.width="99%";
top.document.getElementById("dyukle").style.height="99%";
}
// -->
</script>
</head>
<body>
<div class="kapat-kutu"><a href="javascript:void(0)" onclick="YuklemeAcKapat()" class="kapat-dugme" title="Kapat"><span class="kapat-grafik">X</span></a></div>

<table cellspacing="1" width="98%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
<tr class="liste-etiket">
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Sıra</td>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik">Dosya</td>
	<td align="center" width="110" bgcolor="#ececec" class="forum-kategori-alt-baslik">Tarih</td>
	<td align="center" width="60" bgcolor="#ececec" class="forum-kategori-alt-baslik">Boyut</td>
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Aç</td>
	<td align="center" width="30" bgcolor="#ececec" class="forum-kategori-alt-baslik">Ekle</td>
</tr>
<?php
// yüklü dosya varsa
if ($vt->num_rows($vtsonuc))
{
	$sira = 0;
	$tboyut = 0;

	while ($yukleme = $vt->fetch_array($vtsonuc))
	{
		$sira++;
		$dosya = $yukleme['dosya'];
		$dosya_adresi = 'dosyalar/yuklemeler/'.$dosya;
		$tboyut += $yukleme['boyut'];
		$tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yukleme['tarih']);
		$boyut = NumaraBicim($yukleme['boyut']).' <b>kb</b>';
		$sil = '<a href="../profil_degistir.php?kosul=dsil&amp;o='.$o.'&amp;sil='.$yukleme['id'].'" onclick="return window.confirm(\'Dosyayı silmek istediğinize emin misiniz ?\nDosyayı herhangi bir iletide kullandıysanız sildikten sonra erişilemez olacaktır.\')">Sil</a>';
		$ara = '<a href="../arama.php?a=1&amp;b=1&amp;forum=tum&amp;tarih=tum_zamanlar&amp;sozcuk_hepsi='.$dosya.'">Ara</a>';
		$ac = '<a href="../'.$dosya_adresi.'" target="_blank">Aç</a>';
		$ekle = '<a href="javascript:void(0)" onclick="kod_ekle(\''.$adres.$dosya_adresi.'\', \''.$dosya.'\')">Ekle</a>';


		echo '<tr class="liste-veri" bgcolor="#ffffff" onMouseOver="this.bgColor= \'#e0e0e0\'" onMouseOut="this.bgColor= \'#ffffff\'">
		<td align="left"><b>'.$sira.'</b></td>
		<td align="left">'.preg_replace("/^$kullanici_kim[id]-/is", '', $dosya).'</td>
		<td align="center">'.$tarih.'</td>
		<td align="right">'.$boyut.'</td>
		<td align="center">'.$ac.'</td>
		<td align="center">'.$ekle.'</td>
		</tr>';
	}

	echo '<tr><td colspan="6" align="center" valign="middle" height="30" bgcolor="#ffffff" class="liste-veri"><b>Toplam:</b> '.NumaraBicim($tboyut/1024, 2).' mb</td></tr>';
}

else
{
	echo '<tr><td colspan="6" align="center" bgcolor="#ffffff" class="liste-veri"><br>Yüklü Dosya Yok<br><br></td></tr>';
}

?>
</table>
<div style="margin:10px; text-align:center"><a href="dyukle.php">&laquo; Geri dön</a></div>
</body>
</html>
<?php

//  YÜKLÜ DOSYALAR SIRALANIYOR - SONU  //













//  NORMAL GÖSTERİM - BAŞI  //

else:

// gezinti kaydı yapılıyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET son_hareket='$tarih',hangi_sayfada='$sayfa_adi',sayfano='$sayfano',kul_ip='$kul_ip' WHERE id='$kullanici_kim[id]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $sayfa_adi; ?></title>
<?php echo $css_kod; ?>
<script type="text/javascript"><!-- //
<?php echo $kod_ekle; ?>
top.document.getElementById("dyukle").style.width="470px";
top.document.getElementById("dyukle").style.height="304px";
if(window.navigator.userAgent.match(/(android|mobile)/i)){
top.document.getElementById("dyukle").style.width="99%";
top.document.getElementById("dyukle").style.height="99%";
}
// -->
</script>
</head>
<body>
<div class="katman1">
<div class="kapat-kutu"><a href="javascript:void(0)" onclick="YuklemeAcKapat()" class="kapat-dugme" title="Kapat"><span class="kapat-grafik">X</span></a></div>
<font style="font-family:verdana;font-weight:bold;font-size:18px;"><?php echo $sayfa_adi; ?></font>
<div style="height:20px"></div>
<div align="center" class="katman2">
<div style="overflow:auto; max-height:52px">
<b>Dosya tipleri:</b>&nbsp; <?php echo str_replace(',', ', ', $TanimliDosyaTipleri); ?>
</div>
<b>Azami dosya boyutu:</b>&nbsp; <?php echo NumaraBicim($resim_boyut/1024/1024, 2)?> mb
<br>
<b>Azami resim çözünürlüğü:</b>&nbsp; <?php echo NumaraBicim($resim_genislik).' x '.NumaraBicim($resim_yukseklik); ?> px
<br>
<div style="margin-top:10px; text-align:center"><a href="dyukle.php?yuklu=goster">Yüklü dosyaları göster</a></div>
</div>
<div style="height:25px"></div>
<form name="yukleme" action="dyukle.php" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="MAX_FILE_SIZE" value="983322563">
<input name="yukle" type="file" size="20" style="max-width:430px">
<br><br>
<input type="submit" name="yolla" value="Yükle" onclick="return kilitle()">
</form>
</div>
</body>
</html>
<?php endif; ?>