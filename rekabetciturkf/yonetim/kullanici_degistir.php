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


if (empty($_GET['u']))
{
	header('Location: kullanicilar.php');
	exit();
}

if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


$_GET['u'] = zkTemizle($_GET['u']);


//	KULLANICININ BİLGİLERİ VERİTABANINDAN ÇEKİLİYOR	//

$vtsorgu = "SELECT
id,kullanici_adi,gercek_ad,posta,dogum_tarihi,sehir,web,resim,imza,posta_goster,dogum_tarihi_goster,sehir_goster,yetki,gizli,icq,msn,yahoo,aim,skype,temadizini,temadizinip,ozel_ad,grupid,cinsiyet,hakkinda
FROM $tablo_kullanicilar WHERE id='$_GET[u]' LIMIT 1";

$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$satir = $vt->fetch_array($vtsonuc);


if ($satir['id'] == 1)
{
	header('Location: hata.php?hata=147');
	exit();
}


if (empty($satir['kullanici_adi']))
{
	header('Location: hata.php?hata=46');
	exit();
}

$sayfa_adi = 'Yönetim Kullanıcı Profilini Değiştir - '.$satir['kullanici_adi'];
include_once('bilesenler/sayfa_baslik.php');

include_once('temalar/'.$temadizini.'/menu.php');
?>


<script type="text/javascript">
<!-- //
function denetle()
{ 
	var dogruMu = true;
	for (var i=0; i<8; i++)
	{
		if (document.form1.elements[i].value=="")
		{ 
			dogruMu = false; 
			alert("* İŞARETLİ BÖLÜMLERİN DOLDURULMASI ZORUNLUDUR !");
			break
		}
	}

	if (document.form1.ysifre.value != document.form1.ysifre2.value)
	{
		dogruMu = false; 
		alert("YAZDIĞINIZ ŞİFRELER UYUŞMUYOR !");
	}
	return dogruMu;
}
//  -->
</script>


<form name="form1" action="bilesenler/kullanici_degistir_yap.php?yo=<?php echo $yo ?>" method="post" enctype="multipart/form-data" onSubmit="return denetle()">
<input type="hidden" name="profil_degisti_mi" value="form_dolu" />
<input type="hidden" name="MAX_FILE_SIZE" value="1022999" />
<input type="hidden" name="id" value="<?php echo $satir['id'] ?>" />


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Profil Değiştir</div>
<div class="kutu-icerik">



<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">ÜYELİK BİLGİLERİ</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" width="35%">
Kullanıcı Adı
	</td>
	<td class="liste-etiket" align="left" width="65%">
<b><?php echo $satir['kullanici_adi'] ?></b> &nbsp; 
<font size="-2" style="font-weight: normal">
<i>(Değiştirilemez)</i>
</font>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Ad Soyad - Lâkap <font size="1">*</font>
	</td>
	<td align="left">
<input class="formlar" type="text" name="gercek_ad" size="35" maxlength="30" value="<?php echo $satir['gercek_ad'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Şifre <font size="1">*</font>
<br>
<font size="1" style="font-weight: normal">
<i>Değiştirmeyecekseniz dokunmayın.</i>
</font>
	</td>
	<td align="left">
<input class="formlar" type="password" name="ysifre" size="35" maxlength="20" value="sifre_degismedi" required />
	</td>
	</tr>
	
	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Şifre Onay <font size="1">*</font>
	</td>
	<td align="left">
<input class="formlar" type="password" name="ysifre2" size="35" maxlength="20" value="sifre_degismedi" required />

<script type="text/javascript">
<!-- //
document.form1.ysifre.setAttribute("autocomplete","off"); 
document.form1.ysifre2.setAttribute("autocomplete","off"); 
//  -->
</script>

	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
E-Posta Adresi <font size="1">*</font>
	</td>
	<td align="left">
<input class="formlar" type="text" name="posta" size="35" maxlength="70" value="<?php echo $satir['posta'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Doğum Tarihi &nbsp;<font size="1">*</font>
<font size="1" style="font-weight: normal">
<br><i>örn.01-01-1981</i>
</font>
	</td>
	<td align="left">
<input class="formlar" type="text" name="dogum_tarihi" size="10" maxlength="10" value="<?php echo $satir['dogum_tarihi'] ?>" required />
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Konum
	</td>
	<td align="left">
<input class="formlar" type="text" name="sehir" size="35" maxlength="99" value="<?php echo $satir['sehir'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Web Adresi
	</td>
	<td align="left">
<input class="formlar" type="text" name="web" size="35" maxlength="70" value="<?php echo $satir['web'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Cinsiyet
	</td>
	<td align="left">
<select class="formlar" name="cinsiyet">
<option value="0">Seçin</option>

<?php

// Cinsiyet seçimi
echo '<option value="1"';
if ($satir['cinsiyet'] == '1') echo ' selected="selected"';
echo '>Erkek</option>
<option value="2"';
if ($satir['cinsiyet'] == '2') echo ' selected="selected"';
echo '>Kadın</option></select>';


echo'
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Seçilebilir Forum Temaları
	</td>
	<td align="left">';


$temalar = explode(',',$ayarlar['tema_secenek']);

$adet = count($temalar);

$uye_tema = '<select class="formlar" name="tema_secim">';


for ($i=0; $adet-1 > $i; $i++)
{
	if ($satir['temadizini'] != $temalar[$i])
		$uye_tema .= '<option value="'.$temalar[$i].'">'.$temalar[$i].'</option>';
	
	else $uye_tema .= '<option value="'.$temalar[$i].'" selected="selected">'.$temalar[$i].'</option>';
}

$uye_tema .= '</select>';

echo $uye_tema.'


	</td>
	</tr>';


// portal tema seçimi alanı

if ($portal_kullan == '1')
{
	$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';

	$vtsorgu = "SELECT * FROM $tablo_portal_ayarlar where isim='tema_secenek' LIMIT 1";
	$pt_sonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
	$portal_temalari = $vt->fetch_assoc($pt_sonuc);


	$ptemalar = explode(',',$portal_temalari['sayi']);
	$adet = count($ptemalar);

	$uye_portal_tema = '
	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
	Seçilebilir Portal Temaları
	</td>
	<td align="left">
	<select class="formlar" name="tema_secimp">';

	for ($i=0; $adet-1 > $i; $i++)
	{
		if ($satir['temadizinip'] != $ptemalar[$i])
			$uye_portal_tema .= '<option value="'.$ptemalar[$i].'">'.$ptemalar[$i].'</option>';
	
		else $uye_portal_tema .= '<option value="'.$ptemalar[$i].'" selected="selected">'.$ptemalar[$i].'</option>';
	}

	$uye_portal_tema .= '
	</select>
	</td>
	</tr>';

	echo $uye_portal_tema;
}

?>

	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">YETKİLER</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Yetkisi <font size="1">*</font>
	</td>
	<td align="left">
<?php
	echo '<input type="hidden" name="eski_yetki" value="'.$satir['yetki'].'">
	<select class="formlar" name="yetki">
	<option value="0"';

	if ($satir['yetki'] == 0) echo ' selected="selected"';
	echo '>'.$ayarlar['kullanici'].'</option>';

	if ($satir['yetki'] == 3) echo '<option value="3" selected="selected">'.$ayarlar['blm_yrd'].'</option>';

	echo '<option value="2"';
	if ($satir['yetki'] == 2) echo ' selected="selected"';
	echo '>'.$ayarlar['yardimci'].'</option>';

	echo '<option value="1"';
	if ($satir['yetki'] == 1) echo ' selected="selected"';
	echo '>'.$ayarlar['yonetici'].'</option></select> &nbsp; ';
?>

<a href="kul_izinler.php?kim=<?php echo $satir['kullanici_adi']?>" class="liste-veri">Diğer Yetkiler</a>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Birincil Grup <font size="1">*</font><br>
<font size="1" style="font-weight: normal">
<i>Seçilen grup yetkilendirilmişse<br>bu seçim üyenin yetkisini etkiler.</i>
</font>
	</td>
	<td align="left">
<select class="formlar" name="grup">

<?php
	// Grupların bilgileri çekiliyor
	$vtsorgu = "SELECT id,grup_adi,uyeler FROM $tablo_gruplar ORDER BY id";
	$vtsonuc_grup = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$grup_secimi = '';
	$grup_secimi2 = '';
	$grup_uyesi = false;

	if ($vt->num_rows($vtsonuc_grup))
	{
		while ($satir_grup = $vt->fetch_assoc($vtsonuc_grup))
		{
			if ($satir_grup['id'] == $satir['grupid'])
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'" selected="selected">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = true;
			}

			elseif (preg_match("/$satir[id],/", $satir_grup['uyeler']))
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'" selected="selected">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = true;
			}

			else
			{
				$grup_secimi .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_secimi2 .= '<option value="'.$satir_grup['id'].'">'.$satir_grup['grup_adi'].'</option>';
				$grup_uyesi = false;
			}
		}
	}

	else
	{
		$grup_secimi .= '<option value="0">Henüz grup oluşturulmamış &nbsp;</option>';
		$grup_secimi2 .= '<option value="0">Henüz grup oluşturulmamış &nbsp;</option>';
		$grup_uyesi = false;
	}

	if ($grup_uyesi == true) echo '<option value="0">Hiçbir gruba dahil değil &nbsp;</option>'.$grup_secimi.'</select> &nbsp; ';
	else echo '<option value="0" selected="selected">Hiçbir gruba dahil değil &nbsp;</option>'.$grup_secimi.'</select> &nbsp; ';
?>

	</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-etiket" align="left" valign="top">
Ek Gruplar<br>
<font size="1" style="font-weight: normal">
<i>Bu seçim üyenin yetkisini <u>etkilemez</u>.<br>
CTRL tuşuna basılı tutarak çoklu seçim yapabilirsiniz.</i>
</font>
	</td>
	<td align="left">
<select class="formlar" name="grupc[]"  multiple="multiple" size="3">
<?php echo $grup_secimi2.'</select> &nbsp; '; ?>
	</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Özel Ad
<br>
<font size="1" style="font-weight: normal">
<i>Üyeye özel ad verdiğinizde sadece bilgileri altında görünecektir, herhangi bir yetki değişikliği olmayacaktır.</i>
</font>
	</td>
	<td align="left">
<input class="formlar" type="text" name="ozel_ad" size="35" maxlength="30" value="<?php echo $satir['ozel_ad'] ?>">
	</td>
	</tr>












	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">SOSYAL AĞLAR</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Facebook
	</td>
	<td align="left">
<input class="formlar" type="text" name="aim" size="35" maxlength="70" value="<?php echo $satir['aim'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Twitter
	</td>
	<td align="left">
<input class="formlar" type="text" name="skype" size="35" maxlength="70" value="<?php echo $satir['skype'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
 Skype - MSN 
	</td>
	<td align="left">
<input class="formlar" type="text" name="msn" size="35" maxlength="70" value="<?php echo $satir['msn'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Yahoo!
	</td>
	<td align="left">
<input class="formlar" type="text" name="yahoo" size="35" maxlength="70" value="<?php echo $satir['yahoo'] ?>">
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
ICQ
	</td>
	<td align="left">
<input class="formlar" type="text" name="icq" size="35" maxlength="30" value="<?php echo $satir['icq'] ?>">
	</td>
	</tr>




<?php
if ( ($ayarlar['uzak_resim'] == 1) OR ($ayarlar['resim_yukle'] == 1) OR
	($ayarlar['resim_galerisi'] == 1) ):
?>


	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">KULLANICI RESMİ AYARLARI</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-veri" colspan="2" align="left">
Resim sadece jpeg, gif veya png tipinde olabilir.<br>
<?php echo 'Dosya <b>boyutu '.($ayarlar['resim_boyut']/1024).'</b> kilobayt, <b>yüksekliği '.$ayarlar['resim_yukseklik'].'</b> ve <b>genişliği '.$ayarlar['resim_genislik'].'</b> noktadan büyük olamaz.'; ?>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" valign="top" align="left">Geçerli Resim</td>
	<td class="liste-veri" align="left">
<?php
if ( (isset($_POST['secim_yap'])) AND
	(isset($_POST['galeri_resimi'])) AND
	($_POST['galeri_resimi'] != '') )
echo '<img src="../'.$_POST['galeri_resimi'].'" alt="Kullanıcı Resmi" style="max-width:200px; max-height:200px" />&nbsp;
<label style="cursor: pointer;">
<input type="checkbox" name="resim_sil">Geçerli Resimi Sil</label>';

elseif ($satir['resim'])
{
	if ( (preg_match('/^http(s):\/\//i', $satir['resim'])) OR
	(preg_match('/^ftp:\/\//i', $satir['resim'])) )

		echo '<img src="'.$satir['resim'].'" alt="Kullanıcı Resmi" style="max-width:200px; max-height:200px" />&nbsp;
		<label style="cursor: pointer;">
		<input type="checkbox" name="resim_sil">Geçerli Resimi Sil</label>';


	else

		echo '<img src="../'.$satir['resim'].'" alt="Kullanıcı Resmi" style="max-width:200px; max-height:200px" />&nbsp;
		<label style="cursor: pointer;">
		<input type="checkbox" name="resim_sil">Geçerli Resimi Sil</label>';
}

else echo 'YOK';
?>
	</td>
	</tr>

<?php if ($ayarlar['resim_yukle'] == 1): ?>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Resim Yükle
<br><font size="1" style="font-weight: normal">
<i>Bilgisayarınızdan resim yükleyin.</i>
</font>
	</td>
	<td align="left">
<input class="formlar" name="resim_yukle" type="file" size="30">
	</td>
	</tr>


<?php endif; if ($ayarlar['uzak_resim'] == 1): ?>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Uzak Resim Ekle
<br><font size="1" style="font-weight: normal">
<i>Başka sitede bulunan resimin adresini girin.</i>
</font>
	</td>
	<td align="left">
<input class="formlar" type="text" name="uzak_resim" size="40" maxlength="150" value="">
	</td>
	</tr>


<?php endif; if ($ayarlar['resim_galerisi'] == 1): ?>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Galeriden Resim Seç
	</td>
	<td class="liste-veri" align="left">
<a href="../galeri.php?kim=<?php echo $satir['id'] ?>"><u>Galeriyi Göster</u></a>
<input class="formlar" type="hidden" name="uzak_resim2" size="40" maxlength="150" value="<?php

if ( (isset($_POST['secim_yap'])) AND
	(isset($_POST['galeri_resimi'])) AND
	($_POST['galeri_resimi'] != '') )

echo $_POST['galeri_resimi'];

?>">
	</td>
	</tr>

<?php endif; endif; ?>





	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">SEÇENEKLER</td>
	</tr>


	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Doğum Tarihi veya Yaş Göster
	</td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="1" <?php if ($satir['dogum_tarihi_goster'] == 1) echo 'checked=checked' ?>>
Tarih</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="2" <?php if ($satir['dogum_tarihi_goster'] == 2) echo 'checked=checked' ?>>
Yaş</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="0" <?php if ($satir['dogum_tarihi_goster'] == 0) echo 'checked=checked' ?>>
Gizle</label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
E-Posta Adresini Göster
	</td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type=radio name="posta_goster" value="1" <?php if ($satir['posta_goster'] == 1) echo 'checked=checked' ?>>
Evet</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="posta_goster" value="0" <?php if ($satir['posta_goster'] == 0) echo 'checked=checked' ?>>
Hayır</label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Konum Göster
	</td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="1" <?php if ($satir['sehir_goster'] == 1) echo 'checked=checked' ?>>
Evet</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="0" <?php if ($satir['sehir_goster'] == 0) echo 'checked=checked' ?>>
Hayır</label>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td class="liste-etiket" align="left">
Çevrimiçi Durumunu Göster
	</td>
	<td class="liste-veri" align="left">
<label style="cursor: pointer;">
<input type="radio" name="gizli" value="0" <?php if($satir['gizli'] == 0) echo 'checked=checked' ?>>
Evet</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="gizli" value="1" <?php if($satir['gizli'] == 1) echo 'checked=checked' ?>>
Hayır</label>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">İMZA</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="formlar" cols="66" rows="5" name="imza" onkeyup="imzaUzunluk()" style="width: 520px; height:100px"><?php echo $satir['imza'] ?></textarea>

<div align="left" style="width:527px;">
<div style="height:10px"></div>
İmza bilgisi profil sayfasında ve foruma bıraktığınız yazıların altında görünür.
En fazla <?php echo $ayarlar['imza_uzunluk'] ?> karakter olabilir, BBCode ve ifade kullanabilirsiniz.
<div id="imza_uzunluk">Eklenebilir karakter sayısı</div>
<div style="height:5px"></div>
</div>
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#555555; border:1px solid #ffffff" colspan="2">HAKKINDA</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="formlar" cols="66" rows="5" name="hakkinda" onkeyup="hakkindaUzunluk()" style="width: 520px; height:100px"><?php echo $satir['hakkinda'] ?></textarea>

<div align="left" style="width:527px;">
<div style="height:10px"></div>
Hakkkında bilgisi sadece profil sayfasında görünür.
En fazla 1000 karakter olabilir, BBCode ve ifade kullanabilirsiniz.
<div id="hakkinda_uzunluk">Eklenebilir karakter sayısı:</div>
<div style="height:5px"></div>
</div>
<?php

echo '<script type="text/javascript">
<!-- //
function imzaUzunluk(){
var div_katman = document.getElementById(\'imza_uzunluk\');
div_katman.innerHTML = \'Eklenebilir karakter sayısı: \' + ('.$ayarlar['imza_uzunluk'].'-document.form1.imza.value.length);
if (document.form1.imza.value.length > '.$ayarlar['imza_uzunluk'].'){
alert(\'İmza alanına en fazla '.$ayarlar['imza_uzunluk'].' karakter girebilirsiniz.\');
document.form1.imza.value = document.form1.imza.value.substr(0,'.$ayarlar['imza_uzunluk'].');
div_katman.innerHTML = \'Eklenebilir karakter sayısı: 0\';}
return true;}
function hakkindaUzunluk(){
var div_katman = document.getElementById(\'hakkinda_uzunluk\');
div_katman.innerHTML = \'Eklenebilir karakter sayısı: \' + (1000-document.form1.hakkinda.value.length);
if (document.form1.hakkinda.value.length > 1000){
alert(\'Hakkında alanına en fazla 1000 karakter girebilirsiniz.\');
document.form1.hakkinda.value = document.form1.hakkinda.value.substr(0,1000);
div_katman.innerHTML = \'Eklenebilir karakter sayısı: 0\';}
return true;}
imzaUzunluk();
hakkindaUzunluk();
//  -->
</script>';

?>
	</td>
	</tr>

</table>


<div style="width:560px; margin:0 auto">
<font size="1"><i>* işaretli alanların doldurulması zorunludur!</i></font>
</div>


<div style="width:180px; margin:20px auto">
<input class="dugme" type="submit" value="Değiştir"> &nbsp; &nbsp; 
<input class="dugme" type="reset">
</div>


</div>
</div>
</div>

</form>

<?php
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/bos.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>