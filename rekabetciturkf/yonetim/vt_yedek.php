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


$sayfa_adi = 'Yönetim Veritabanı Yedekleme';
include_once('bilesenler/sayfa_baslik.php');
include_once('temalar/'.$temadizini.'/menu.php');
?>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Veritabanı Yedekleme</div>
<div class="kutu-icerik">


<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center">
	<tr>
	<td align="left" class="liste-veri">

<?php

//      GELİŞMİŞ KİPİ   -   BAŞI    //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'gelismis') ):


//  PARÇA HESAPLAMA KISMI   -   BAŞI    //

if ( (isset($_GET['parca'])) AND ($_GET['parca'] == 'hesapla') ):

	$ytablo = zkTemizle($_GET['tablo']);


	//	TABLODAKİ SATIR SAYISI ALINIYOR 	//
	$sorgu = $vt->query("SHOW TABLE STATUS LIKE '$ytablo'") or die ($vt->hata_ver());
	$satir_sayisi = $vt->fetch_assoc($sorgu);


	$asama = $satir_sayisi['Rows'] / $_GET['adim'];
	settype($asama,'integer');
	if (($satir_sayisi['Rows'] % $_GET['adim']) != 0) $asama++;


echo '
<br>
<b>&nbsp; Seçilen tablodaki girdi sayısı:</b> '.$satir_sayisi['Rows'].
'<br><b>&nbsp; Parça sayısı:</b> '.$asama;


//  PARÇA HESAPLAMA KISMI   -   SONU    //

//  BİRİNCİDEN SONRAKİ AŞAMALAR -   BAŞI    //


elseif ( (isset($_GET['toplamp'])) AND ($_GET['toplamp'] != '') ):

$_GET['devam']+=$_GET['adim'];

$parca = ($_GET['devam'] / $_GET['adim'])+1;

$asama = $_GET['toplamp'];

echo '
<br>
<b>&nbsp; Yedekleme Aşaması: <font color="red">'.$parca.' / '.$asama.'</font></b>';




else:

endif;



if ( (isset($_GET['yedekle'])) AND ($_GET['yedekle'] == 'yedek_al') ):

$parca = ($_GET['devam'] / $_GET['adim'])+1;

echo'
<center>
<br><br><br>
<form name="yedekle" action="bilesenler/vt_yedek_yap.php" method="post">
<input name="toplamp" type="hidden" value="'.$asama.'">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="tablo[]" type="hidden" value="'.$_GET['tablo'].'">
<input name="devam" type="hidden" value="'.$_GET['devam'].'">
<input name="adim" type="hidden" value="'.$_GET['adim'].'">
<input name="gzip" type="hidden" value="'.$_GET['gzip'].'">';


// son aşamaya kadar bu kısım

if ($asama >= ($parca+1))

echo '
<input class="dugme" type="submit" value="'.$parca.'. Parçayı indir">
</form>

<br><br><hr><br>
<b>'.$parca.'. parçayı indirdikten sonra Devamı tıklayın.</b>
<br><br><br>

<form name="yedekle2" action="vt_yedek.php" method="get">
<input name="toplamp" type="hidden" value="'.$asama.'">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="tablo" type="hidden" value="'.$_GET['tablo'].'">
<input name="devam" type="hidden" value="'.$_GET['devam'].'">
<input name="adim" type="hidden" value="'.$_GET['adim'].'">
<input name="gzip" type="hidden" value="'.$_GET['gzip'].'">
<input class="dugme" type="submit" value="Devam &gt;&gt;">
</form>
</center>
';


// tek parça ise bu kısım

elseif ($asama == 1)

echo '
<b>Tablo tek parçada yedeklenebiliyor, alttan indirebilirsiniz.</b>

<br><br><br>

<input class="dugme" type="submit" value="Tümünü indir">
</form>
<br>
<br>
</center>';


// son aşamada bu kısım

else

echo '
<input class="dugme" type="submit" value="Son Parçayı indir">
</form>
<br>
<b>Son parçayı da indirdikten sonra seçtiğiniz tablonun<br>yedeği tamamlanmış olacak.</b>
<br><br><br><br>
Başa dönmek için <a href="vt_yedek.php?kip=gelismis"><b>tıklayın</b></a>
<br><br>
</center>';


//  BİRİNCİDEN SONRAKİ AŞAMALAR -   SONU    //


else:

//  GELİŞMİŞ KİP GİRİŞ SAYFASI -   BAŞI    //

?>

<p align="center">
<b>2mb.`dan büyük veritabanı yedekleri için bu sayfayı kullanın.</b>
</p><br>

&nbsp; &nbsp; Bu sayfa; toplam boyutu 2-3 mb. geçen veritabanı yedekleme ve yükleme işlemleri için hazırlanmıştır. Yine tabloları buradan tek tek yedekleyeceksiniz, ama çok büyük tablolar parçalara ayrılarak uygun boyutlara getirilecek.

<p>&nbsp; &nbsp; Varsayılan parçalama boyutu 1000 girdi şeklindedir. Örneğin, forumunuzda 3 bin konu bulunduğunu varsayalım. Bu durumda mesajlar tablonuzda 3 bin girdi var demektir ve varsayılan 1000 adımı kullandığınızda bu mesajlar tablosu 3 yedek dosyası halinde size sunulacaktır.

<p>&nbsp; &nbsp; Forumdaki yazıların büyüklüğüne, sunucunuzun hızına ve yükleme yaptığınız andaki yoğunluğa bağlı olarak 3-5 bin girdi adımı bile kullanılabilir (toplam girdiye <a href="vt_yonetim.php"><u>buradan bakın</u></a>). Önemli olan gzip sıkıştırlımış yedek dosyasının boyutudur. &nbsp; 700kb. dan büyük dosyaların yüklenmesi işlemleri yarım kalabilir.

<p>&nbsp; &nbsp; En uygun ayarı dosya boyutuna bakarak kendiniz bulabilirsiniz, ama 1000 girdilik adımlar kullanmanızı öneririz. Ayrıca gzip sıkıştırmayı açmayı da unutmayın.

<br><br>



<form name="yedekle" action="vt_yedek.php" method="get">
<input name="kip" type="hidden" value="gelismis">
<input name="yedekle" type="hidden" value="yedek_al">
<input name="parca" type="hidden" value="hesapla">



<table cellspacing="0" width="450" cellpadding="2" border="0" align="center">
	<tr>
	<td class="liste-etiket" align="center">Tablolar</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center">
<select class="formlar" name="tablo" size="16" style="width:250px">
<?php
$vtsorgu = $vt->query("SHOW TABLE STATUS") or die ($vt->hata_ver());

while ($tablolar = $vt->fetch_assoc($vtsorgu))
{
	echo '<option value="'.$tablolar['Name'].'">'.$tablolar['Name'].'</option>'."\n";
}
?>
</select>
	</td>
	</tr>


	<tr>
	<td class="liste-veri" align="center" valign="top" colspan="2">
<br>
<b>Gzip Sıkıştır: </b> &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="0">&nbsp;Hayır</label>
&nbsp; &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="1" checked="checked">&nbsp;Evet</label>
<br><br><br>

<?php
echo '<input class="formlar" type="hidden" name="devam" value="0">
<b>Girdi Adımı:&nbsp;</b>
<input class="formlar" type="text" name="adim" size="8" value="1000" maxlength="4">&nbsp; 
<br><br><br>
<input class="dugme" type="submit" value="Parça Sayısını Hesapla">
<br><br>
	</td>
	</tr>
</table>
</form>';

//  GELİŞMİŞ KİP GİRİŞ SAYFASI -   SONU    //

endif; // devam etmeyi kapat

//  BİRİNCİ AŞAMA -   SONU    //

//      GELİŞMİŞ KİPİ   -   SONU    //



else:
//      NORMAL KİP   -   BAŞI    //
?>

<br>
&nbsp;Buradan veritabanınındaki, forum ile ilgili tüm tabloları yedekleyebilirsiniz. Ayrıca sunucunuz destekliyorsa (çoğunlukla destekler) dosyayı Gzip biçiminde sıkıştırabilirsiniz.
<br>
&nbsp; İsterseniz tabloları tek tek de yedekleyebilirsiniz. Bu veritabanınız 2mb. büyük ise çok işinize yarar. Çünkü sunucuların kabul ettiği en büyük dosya boyutu genellikle 2mb.`dır.
<br>
&nbsp; 2mb.`dan büyük veritabanı ve/veya tablo yedekleri için <a href="vt_yedek.php?kip=gelismis"><u>gelişmiş yedeklemeyi</u></a> kullanın.
<br><br><br>


<form name="yedekle" action="bilesenler/vt_yedek_yap.php" method="post">
<input name="yedekle" type="hidden" value="yedek_al">


<table cellspacing="0" width="450" cellpadding="2" border="0" align="center">
	<tr>
	<td class="liste-etiket" align="center">Tablolar</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center">
<select multiple="multiple" class="formlar" name="tablo[]" id="tablo" size="16" style="width:250px">
<?php
$vtsorgu = $vt->query("SHOW TABLE STATUS") or die ($vt->hata_ver());

while ($tablolar = $vt->fetch_assoc($vtsorgu))
{
	echo '<option value="'.$tablolar['Name'].'"';
	if (preg_match("/^$tablo_oneki/i", $tablolar['Name'])) echo ' selected="selected"';
	echo '>'.$tablolar['Name'].'</option>'."\n";
}
?>
</select>
	</td>
	</tr>

	<tr>
	<td class="liste-liste" align="center">
<a href="javascript:void(0)" onclick="hepsiniSec('forum')">Forum</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec('portal')">Portal</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec('cms')">CMS</a>
&nbsp;-&nbsp;
<a href="javascript:void(0)" onclick="hepsiniSec('hepsi')">Hepsini Seç</a>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="center" valign="top" colspan="3">
<br>
<b>Gzip Sıkıştır: </b> &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="0">&nbsp;Hayır</label>
&nbsp; &nbsp;
<label style="cursor: pointer;"><input type="radio" name="gzip" value="1" checked="checked">&nbsp;Evet</label>

<br><br><br>

<input class="dugme" type="submit" name="gonder" value="Yedekle">

	</td>
	</tr>
</table>
<br>
</form>

<?php
        //      NORMAL KİP   -   SONU    //
endif;
?>

	</td>
	</tr>
</table>

</div>
</div>
</div>

<script type="text/javascript">
<!-- //
function hepsiniSec(sistem)
{
var tablo = document.getElementById("tablo");
for (i=0; i < tablo.options.length; i++)
{
	if (sistem=='forum')
	{
		if ((tablo.options[i].value.match('^phpkf_'))&&(!tablo.options[i].value.match('^phpkf_portal_')))
			tablo.options[i].selected = 'selected';
		else tablo.options[i].selected = '';
	}

	else if (sistem=='portal')
	{
		if (tablo.options[i].value.match('^phpkf_portal_'))
			tablo.options[i].selected = 'selected';
		else tablo.options[i].selected = '';
	}

	else if (sistem=='cms')
	{
		if (tablo.options[i].value.match('^phpkfcms_'))
			tablo.options[i].selected = 'selected';
		else tablo.options[i].selected = '';
	}

	else tablo.options[i].selected = 'selected';
}
}
//  -->
</script>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>