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



//  FORM DOLU İSE  //

if ((isset($_POST['form'])) AND ($_POST['form'] == 'dolu')):



if ((!isset($_POST['grup_adi'])) OR ($_POST['grup_adi'] == ''))
{
	header('Location: hata.php?hata=26');
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_ ğĞüÜŞşİıÖöÇç.]+$/', $_POST['grup_adi']))
{
	header('Location: hata.php?hata=201');
	exit();
}

if ( ( strlen($_POST['grup_adi']) > 30) OR ( strlen($_POST['grup_adi']) < 4) )
{
	header('Location: hata.php?hata=202');
	exit();
}


//  veriler temizleniyor

if (isset($_POST['grup_adi'])) $_POST['grup_adi'] = zkTemizle($_POST['grup_adi']);
if (isset($_POST['ozel_ad'])) $_POST['ozel_ad'] = zkTemizle($_POST['ozel_ad']);
if (isset($_POST['grup_bilgi'])) $_POST['grup_bilgi'] = zkTemizle($_POST['grup_bilgi']);
if (isset($_POST['duzenle'])) $_POST['duzenle'] = zkTemizle($_POST['duzenle']);
if (isset($_POST['yetki'])) $_POST['yetki'] = zkTemizle($_POST['yetki']);


// grup gizleme
if (isset($_POST['grup_gizle'])) $grup_gizle = 1;
else $grup_gizle = 0;



//   YENİ GRUP OLUŞTURMA   //

if ((isset($_POST['yeni_grup'])) AND ($_POST['yeni_grup'] == 'yeni_grup'))
{
	// grup adının daha önce kullanılıp kullanılmadığına bakılıyor
	$vtsorgu = "SELECT grup_adi FROM $tablo_gruplar WHERE grup_adi='$_POST[grup_adi]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		header('Location: hata.php?hata=203');
		exit();
	}


	// yeni grup kaydı yapılıyor
	$vtsorgu = "INSERT INTO $tablo_gruplar (grup_adi, sira, gizle, yetki, ozel_ad, uyeler, grup_bilgi)";
	$vtsorgu .= "VALUES ('$_POST[grup_adi]','$_POST[sira]', '$grup_gizle', '$_POST[yetki]', '$_POST[ozel_ad]', '', '$_POST[grup_bilgi]')";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}



//   GRUP DÜZENLEME   //

elseif ((isset($_POST['duzenle'])) AND ($_POST['duzenle'] != ''))
{
	// grubun eski yetkisi "bölüm yardımcılığı" ise ve değiştirilmişse uyarı ver
	if ( ($_POST['eski_yetki'] == '3') AND ($_POST['yetki'] != '3') )
	{
		header('Location: hata.php?hata=205');
		exit();
	}

	// grubun eski ve yeni yetkileri "yetkisiz" değilse, yeni yetkiyi grup üyelerine uygula
	elseif ($_POST['yetki'] != '-1')
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET yetki='$_POST[yetki]' WHERE grupid='$_POST[duzenle]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// gruba özel ad eklenmişse veya silinmişse grup üyelerine uygulanıyor
	if ( ($_POST['ozel_ad'] != '') OR (($_POST['eski_ozel_ad'] != '') AND ($_POST['ozel_ad'] == '')) )
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET ozel_ad='$_POST[ozel_ad]' WHERE grupid='$_POST[duzenle]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// sıra değiştirilmişse diğer gruba uygulanıyor
	if ($_POST['eski_sira'] != $_POST['sira'])
	{
		$vtsorgu = "UPDATE $tablo_gruplar SET sira='$_POST[eski_sira]' WHERE sira='$_POST[sira]' LIMIT 1";
		$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}

	// grup bilgileri düzenleniyor
	$vtsorgu = "UPDATE $tablo_gruplar SET grup_adi='$_POST[grup_adi]', sira='$_POST[sira]', gizle='$grup_gizle', yetki='$_POST[yetki]', ozel_ad='$_POST[ozel_ad]', grup_bilgi='$_POST[grup_bilgi]' WHERE id='$_POST[duzenle]' LIMIT 1";
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


header('Location: gruplar.php');
exit();





//   GRUP SİLME İŞLEMLERİ   //

elseif ((isset($_GET['sil'])) AND ($_GET['sil'] != '')):


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hata.php?hata=45');
	exit();
}


$_GET['sil'] = zkTemizle($_GET['sil']);


// grup siliniyor
$vtsorgu = "DELETE FROM $tablo_gruplar WHERE id='$_GET[sil]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// grubun özel izinleri siliniyor
$vtsorgu = "DELETE FROM $tablo_ozel_izinler WHERE grup='$_GET[sil]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// grup üyelikleri iptal ediliyor
$vtsorgu = "UPDATE $tablo_kullanicilar SET grupid='0' WHERE grupid='$_GET[sil]'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

header('Location: gruplar.php');
exit();




endif;



// Düzenleme tıklanmışsa

if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != ''))
{
	if (isset($_GET['duzenle'])) $_GET['duzenle'] = zkTemizle($_GET['duzenle']);

	$vtsorgu = "SELECT * FROM $tablo_gruplar WHERE id='$_GET[duzenle]' LIMIT 1";
	$vtsonuc_duzenle = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir_duzenle = $vt->fetch_assoc($vtsonuc_duzenle);

	// seçili grup yoksa
	if (!isset($satir_duzenle['id']))
	{
		header('Location: gruplar.php');
		exit();
	}
}




//  SAYFA NORMAL GÖSTERİM  //

$sayfa_adi = 'Yönetim Üye Gruplar';
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');


// Grupların bilgileri çekiliyor
$vtsorgu = "SELECT * FROM $tablo_gruplar ORDER BY sira";
$vtsonuc_grup = $vt->query($vtsorgu) or die ($vt->hata_ver());

?>

<script type="text/javascript">
<!-- //
function silme_onay(){
	var onay1 = confirm("Bu grubu silmek istediğinize emin misiniz?");
	if (onay1){
		var onay2 = confirm("Gerçekten silmek istediğinize emin misiniz?");
		if (onay2) return true;
		else return false;
	}
	else return false;
}
// -->
</script>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Üye Grupları</div>
<div class="kutu-icerik" style="padding-left:30px;padding-right:30px;">



&nbsp; &nbsp; Grup oluşturma, düzenleme ve görüntüleme işlemlerini bu sayfadan yapabilirsiniz.
<br><br>
Bir gruba yetki verdiğinizde gruptaki tüm üyelerin yetkileri değişir. Grup yetkisi "Yok" olarak ayarlandığında grup üyelerinin yetkilerinde herhangi bir değişiklik olmaz.

<br><br>
Bir gruba özel ad verdiğinizde gruptaki tüm üyelerin özel adları değişir, boş bıraktığınızda  herhangi bir değişiklik olmaz.
<br>
<br>
<br>

<table cellspacing="1" width="580" cellpadding="5" border="0" align="center" bgcolor="#dddddd">

<?php

$tgrup = 0;

if (!$vt->num_rows($vtsonuc_grup))
{
	echo '
	<tr class="liste-veri">
	<td align="center" valign="middle" height="50" colspan="3" class="tablo_ici">
	<b>Henüz Hiçbir Grup Oluşturulmamış</b><br>
	</td>
	</tr>';
}


else
{
	echo '<tr class="liste-etiket">
	<td align="center" class="tablo_ici" width="43%">Grup Adı</td>
	<td align="center" class="tablo_ici" width="43%">Grup Üyeleri</td>
	<td align="center" class="tablo_ici" width="14%">İşlem</td></tr>';


	while ($satir_grup = $vt->fetch_assoc($vtsonuc_grup))
	{
		echo '
		<tr class="tablo_ici" >
		<td align="left" valign="top" height="30" class="liste-etiket">
		<b>'.$satir_grup['grup_adi'].'</b><font style="font-size: 11px; font-weight: normal">';
		if ($satir_grup['gizle'] == '1') echo '&nbsp; <i>(gizli)</i>';
		echo '<br><br>
		<a href="kul_izinler.php?grup='.$satir_grup['id'].'">Özel yetki ver</a>
		</font></td>
		<td align="left">
		<div class="liste-veri" style="overflow-y:auto; max-height:195px">';

		$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar WHERE grupid='$satir_grup[id]'";
		$vtsonuc_grup2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$sayi = 1;

		if ($vt->num_rows($vtsonuc_grup2))
		{
			while ($satir_grup2 = $vt->fetch_assoc($vtsonuc_grup2))
			{
				echo '<b>'.$sayi.')</b>&nbsp; <a href="kullanici_degistir.php?u='.$satir_grup2['id'].'" title="Üye profilini değiştir">'.$satir_grup2['kullanici_adi'].'</a><br>';
				$sayi++;
			}
		}

		else echo '<b>Yok</b><br><br><a href="kullanicilar.php">Üye Ekle</a>';


		echo '</div></td>
		<td align="center" class="tablo_ici">
		<a href="gruplar.php?duzenle='.$satir_grup['id'].'#duzenle" title="Grubu Düzenle"><img '.$simge_degistir.' alt="düzenle"></a> &nbsp;
		<a href="gruplar.php?sil='.$satir_grup['id'].'&amp;yo='.$yo.'" title="Grubu Sil" onclick="return silme_onay()"><img '.$simge_sil.' alt="sil"></a>
		</td></tr>';

		$tgrup++;
	}
}

?>

</table>



<a name="duzenle"></a>
<form action="gruplar.php" method="post" name="form1">
<input type="hidden" name="form" value="dolu">
<?php
echo '<input type="hidden" name="sira" value="'.($tgrup+1).'">';

if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != ''))
echo '<input type="hidden" name="duzenle" value="'.$satir_duzenle['id'].'">';

else echo '<input type="hidden" name="yeni_grup" value="yeni_grup">';
?>


<br><br>
<hr>
<br>



Yeni grup oluşturma ve düzenleme işlemlerini bu bölümden yapabilirsiniz.<br><br>
<font size="1">
<i>Tüm alanların doldurulması zorunludur!</i>
</font>
<br><br>


<center><b>
<?php
if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '')) echo 'Grup Düzenleme';
else echo 'Yeni Grup Oluştur';
?>
</b></center>


<table cellspacing="1" width="580" cellpadding="5" border="0" align="center" bgcolor="#dddddd" style="margin-top:5px">
	<tr class="liste-etiket">
	<td align="left" width="45%" height="40" class="tablo_ici">
Grup Adı:
	</td>

	<td align="left" width="55%" height="40"  class="tablo_ici">
<input type="text" class="formlar" name="grup_adi" size="37" maxlength="30" value="<?php
if (isset($satir_duzenle['grup_adi'])) echo $satir_duzenle['grup_adi'];
?>">
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" valign="top" height="40" class="tablo_ici">
Grup Açıklaması:<br>
<font size="1" style="font-weight: normal">
Açıklama en fazla 250 karakter olabilir.<br>
(Sadece düz metin)
</font>
<br><br><br><br><br><br>
<div id="bilgi_uzunluk" style="font-weight: normal">Eklenebilir Karakter: </div>
	</td>

	<td align="left" class="tablo_ici">
<textarea name="grup_bilgi" rows="10" cols="30" class="formlar" style="width: 85%; height:130px" onkeyup="BilgiUzunluk()"><?php
if (isset($satir_duzenle['grup_bilgi'])) echo $satir_duzenle['grup_bilgi'];
?></textarea>


<script type="text/javascript">
<!-- //
function BilgiUzunluk()
{
	var div_katman = document.getElementById('bilgi_uzunluk');
	div_katman.innerHTML = 'Eklenebilir Karakter: ' + (250-document.form1.grup_bilgi.value.length);

	if (document.form1.grup_bilgi.value.length > 250)
	{
		alert('En fazla 250 karakter girebilirsiniz.');
		document.form1.grup_bilgi.value = document.form1.grup_bilgi.value.substr(0,250);
		div_katman.innerHTML = 'Eklenebilir Karakter: 0';
	}
	return true;
}
BilgiUzunluk();
//  -->
</script>

	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" width="45%" height="40" class="tablo_ici">
Grup Özel Adı:
	</td>

	<td align="left" width="55%" height="40"  class="tablo_ici">
<input type="text" class="formlar" name="ozel_ad" size="37" maxlength="30" value="<?php
if (isset($satir_duzenle['ozel_ad'])) echo $satir_duzenle['ozel_ad'];
?>">
	</td>
	</tr>


	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Grup Yetkisi:
	</td>

	<td align="left" class="tablo_ici">
<?php

if (isset($satir_duzenle['yetki']))
{
	echo '<input type="hidden" name="eski_yetki" value="'.$satir_duzenle['yetki'].'">
<input type="hidden" name="eski_ozel_ad" value="'.$satir_duzenle['ozel_ad'].'">
<select class="formlar" name="yetki">
	<option value="-1"';
	if ($satir_duzenle['yetki'] == '-1') echo ' selected="selected"';
	echo '>Yok</option>';

	echo '<option value="0"';
	if ($satir_duzenle['yetki'] == 0) echo ' selected="selected"';
	echo '>Kayıtlı Kullanıcı</option>';

	if ($satir_duzenle['yetki'] == 3) echo '<option value="3" selected="selected">Bölüm Yardımcısı</option>';

	echo '<option value="2"';
	if ($satir_duzenle['yetki'] == 2) echo ' selected="selected"';
	echo '>Forum Yardımcısı</option>';

	echo '<option value="1"';
	if ($satir_duzenle['yetki'] == 1) echo ' selected="selected"';
	echo '>Forum Yöneticisi</option></select> &nbsp;&nbsp;
	<font style="font-size: 11px; font-weight: normal"><a href="kul_izinler.php?grup='.$satir_duzenle['id'].'">Özel yetki ver</a></font>';
}

else
{
	echo '<select class="formlar" name="yetki">
	<option value="-1" selected="selected">Yok</option>
	<option value="0">Kayıtlı Kullanıcı</option>
	<option value="2">Forum Yardımcısı</option>
	<option value="1">Forum Yöneticisi</option>
	</select>';
}

?>
	</td>
	</tr>



<?php

if (isset($satir_duzenle['sira']))
{
	echo '<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Grup Sırası:
	</td>

	<td align="left" class="tablo_ici">
<input type="hidden" name="eski_sira" value="'.$satir_duzenle['sira'].'">
<select class="formlar" name="sira">';

	for($i=1; $i<=$tgrup; $i++)
	{
		echo '<option value="'.$i.'"';
		if ($satir_duzenle['sira'] == $i) echo ' selected="selected"';
		echo '>&nbsp;'.$i.'&nbsp;</option>';
	}


	echo '>Yok</option>
	</select>
	</td>
	</tr>';
}

?>



	<tr class="liste-etiket">
	<td align="left" height="40" class="tablo_ici">
Grup Durumu:
	</td>

	<td align="left" class="tablo_ici">
<label style="cursor: pointer;">
<?php

if ((isset($satir_duzenle['gizle'])) AND ($satir_duzenle['gizle'] == 1)) echo '<input type="checkbox" name="grup_gizle" checked="checked">';
else echo '<input type="checkbox" name="grup_gizle">';

?>
<font style="font-size: 11px; font-weight: normal; position: relative; top:-2px;">Grubu gizle</font></label>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td colspan="2" class="liste-veri" align="center" valign="middle" height="50">
<?php
if ((isset($_GET['duzenle'])) AND ($_GET['duzenle'] != '')) echo '<input class="dugme" type="submit" value="Grubu Düzenle">';
else echo '<input class="dugme" type="submit" value="Grup Oluştur">';
?>
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
?>