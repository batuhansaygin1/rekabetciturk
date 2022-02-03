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


//  VERİTABANI EK YÜK GİDERME İŞLEMİ   //

if ( (isset($_GET['vt'])) AND ($_GET['vt'] == 'ekyuk') )
{
	$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$ekyuk_sonucu = '';

	while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
	{
		$vtsorgu = "OPTIMIZE TABLE $tablo_bilgileri[Name]";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$ekyuk_bilgisi = $vt->fetch_assoc($vtsonuc2);
		$ekyuk_sonucu .= $ekyuk_bilgisi['Table'].' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Op'].
		' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Msg_type'].' &nbsp;-&nbsp; '.$ekyuk_bilgisi['Msg_text'].'<br>';
	}
}



//  VERİTABANI ONARMA İŞLEMİ    //

if ( (isset($_GET['vt'])) AND ($_GET['vt'] == 'onar') )
{
	$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$onarma_sonucu = '';

	while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
	{
		$vtsorgu = "REPAIR TABLE $tablo_bilgileri[Name]";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$onarma_bilgisi = $vt->fetch_assoc($vtsonuc2);
		$onarma_sonucu .= $onarma_bilgisi['Table'].' &nbsp;-&nbsp; '.$onarma_bilgisi['Op'].
		' &nbsp;-&nbsp; '.$onarma_bilgisi['Msg_type'].' &nbsp;-&nbsp; '.$onarma_bilgisi['Msg_text'].'<br>';
	}
}

$sayfa_adi = 'Yönetim - Veritabanı Yönetimi';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Veritabanı Yönetimi</div>
<div class="kutu-icerik">


<?php
//  VERİTABANINDAKİ EK YÜKÜ GİDER TILANMIŞSA //

if ( (isset($ekyuk_sonucu)) AND ($ekyuk_sonucu != '') )
{
	echo '<center><b>Veritabanındaki Ek Yük Giderilmiştir !</b></center><p>
	&nbsp;&nbsp; Veritabanı ek yük giderme ayrıntıları:</p>'.
	$ekyuk_sonucu.'
	<br><br><center>***************************************</center>';
}


//  VERİTABANINI ONAR TILANMIŞSA //

if ( (isset($onarma_sonucu)) AND ($onarma_sonucu != '') )
{
	echo '<center><b>Veritabanı Onarılmıştır !</b></center><p>
	&nbsp;&nbsp; Veritabanı onarım ayrıntıları:</p>'.
	$onarma_sonucu.'
	<br><br><center>***************************************</center>';
}
?>

<br>
 &nbsp;&nbsp; Buradan, veritabanınız boyutu ve satır sayısı hakkındaki bilgileri tablo tablo görebilir; Gerek duyarsanız onarma ve ek yük giderme işlemlerini gerçekleştirebilirsiniz.
<br><br>
 &nbsp;&nbsp; Çizelgedeki; ek yük boyutu verileri bayt cinsindendir.
<br>Toplam, veri boyutu ve index boyutu verileri ise kilobayt cinsindendir.
<br><br>


<table cellspacing="1" width="600" cellpadding="6" border="0" align="center" bgcolor="#dddddd">
	<tr class="tablo_ici">
	<td align="center" class="liste-etiket">tablo adı</td>
	<td align="center" class="liste-etiket" width="70">girdi</td>
	<td align="center" class="liste-etiket" width="100">veri boyutu</td>
	<td align="center" class="liste-etiket" width="100">index boyutu</td>
	<td align="center" class="liste-etiket" width="70">ek yük</td>
	</tr>

<?php


//	VERİTABANI BOYUTU HESAPLANIYOR - BAŞI	//

$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$toplam_boyut = 0;
$toplam_satir = 0;
$toplam_ekyuk = 0;

while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
{
	$toplam_boyut += ($tablo_bilgileri['Data_length'] + $tablo_bilgileri['Index_length']);
	$toplam_satir += $tablo_bilgileri['Rows'];
	$toplam_ekyuk += $tablo_bilgileri['Data_free'];

	if ($tablo_bilgileri['Data_free'] != 0) $ekyuk = NumaraBicim($tablo_bilgileri['Data_free']/1024, 2).' <b>kb</b>';
	else $ekyuk = '';

	echo '<tr class="liste-veri" bgcolor="'.$yazi_tabani1.'" onMouseOver="this.bgColor= \''.$yazi_tabani2.'\'" onMouseOut="this.bgColor= \''.$yazi_tabani1.'\'">
	<td align="left" class="liste-veri">'.$tablo_bilgileri['Name'].'</td>
	<td align="right" class="liste-veri">'.NumaraBicim($tablo_bilgileri['Rows']).'</td>
	<td align="right" class="liste-veri">'.NumaraBicim($tablo_bilgileri['Data_length']/1024, 1).' <b>kb</b></td>
	<td align="right" class="liste-veri">'.NumaraBicim($tablo_bilgileri['Index_length']/1024, 1).' <b>kb</b></td>
	<td align="right" class="liste-veri">'.$ekyuk.'</td>
	</tr>';
}

echo '<tr class="tablo_ici">
<td align="left" class="liste-veri" colspan="5">&nbsp;</td>
</tr>
<tr class="tablo_ici">
<td align="right" class="liste-etiket">Toplam&nbsp;</td>
<td align="right" class="liste-veri">'.NumaraBicim($toplam_satir).'</td>
<td align="right" class="liste-veri" colspan="2">'.NumaraBicim($toplam_boyut/1024/1024, 2).' <b>mb</b></td>
<td align="right" class="liste-veri">'.NumaraBicim($toplam_ekyuk/1024, 2).' <b>kb</b></td>
</tr>';


//	VERİTABANI BOYUTU HESAPLANIYOR - SONU	//

?>


	<tr class="tablo_ici">
	<td align="left" valign="bottom" class="liste-veri" colspan="5" height="75">
&nbsp;&nbsp; <a href="vt_yonetim.php?vt=ekyuk">Tüm tablolardaki ek yükü gider.</a>
<p>
&nbsp;&nbsp; <a href="vt_yonetim.php?vt=onar">Tüm tabloları onar.</a>
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
?>