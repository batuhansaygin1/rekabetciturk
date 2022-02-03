<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v1.10                              |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2018 phpKF Ekibi               |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../bilesenler/tema_sinif.php');


// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ( ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle') ) OR (isset($_POST['kip'])) )
{
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}
}


// kipe göre yer seçimi POST
if ( (isset($_POST['yer'])) AND ($_POST['yer'] != '') )
{
	if ($_POST['yer'] == '2'){
		$yer = 2;
		$git = 'blok';}
	elseif ($_POST['yer'] == '3'){
		$yer = 3;
		$git = 'taban';}
	else{
		$yer = 1;
		$git = '';}
}
else{
		$yer = 1;
		$git = '';
}


// Eklenen diller kontrol ediliyor
$dil_eklenen = ',';
if ($ayarlar['dil_eklenen_alanlar'] != ',')
{
	$dileklenen = explode(',', $ayarlar['dil_eklenen_alanlar']);
	foreach ($dileklenen as $dil)
	{
		if ($dil == '') continue;
		$bag_ad = "ad_$dil";

		// bağlantılar tablosunda dil var mı?
		$vtsorgu = "SHOW FIELDS FROM $tablo_baglantilar WHERE Field='$bag_ad'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		if ($vt->num_rows($vtsonuc)) $dil_eklenen .= $dil.',';
	}
}





//   İŞLEMLER - BAŞI   //


// bağlantı sıralama uygulama

if ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'uygula') )
{
	$sira_ham = @zkTemizle($_POST['siralama']);
	$gizle_ham = @zkTemizle($_POST['gizleme']);
	$cop_ham = @zkTemizle($_POST['copkutusu']);


	if ($cop_ham != '')
	{
		$cop_dizi = explode('|', $cop_ham);

		foreach ($cop_dizi as $sira)
		{
			if ($sira == '') continue;
			$a = explode(':', $sira);
			if (!isset($a[0])) continue;

			$vtsorgu = "DELETE FROM $tablo_baglantilar WHERE id='$a[0]' LIMIT 1";
			$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}


	if ($gizle_ham != '')
	{
		$gizle_dizi = explode('|', $gizle_ham);

		foreach ($gizle_dizi as $sira)
		{
			if ($sira == '') continue;
			$a = explode(':', $sira);
			if (!isset($a[0])) continue;

			$vtsorgu = "UPDATE $tablo_baglantilar SET yer='0' WHERE id='$a[0]' LIMIT 1";
			$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}


	if ($sira_ham != '')
	{
		$sira_dizi = explode('|', $sira_ham);

		foreach ($sira_dizi as $sira)
		{
			if ($sira == '') continue;
			$a = explode(':', $sira);
			if ( (!isset($a[0])) OR (!isset($a[1])) OR (!isset($a[2])) ) continue;
			$a[2] = ($a[2]+1);

			$vtsorgu = "UPDATE $tablo_baglantilar SET alt_menu='$a[1]', sira='$a[2]', yer='$yer' WHERE id='$a[0]' LIMIT 1";
			$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}


	header('Location: hata.php?bilgi=100&git='.$git);
	exit();
}



// yeni bağlantı oluşturma

elseif ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'yeni') )
{
	if ( (!isset($_POST['ad'])) OR (!isset($_POST['adres'])) OR (!isset($_POST['bilgi'])) OR ($_POST['ad'] == '') OR ($_POST['adres'] == '') OR ($_POST['bilgi'] == '') )
	{
		header('Location: hata.php?hata=300');
		exit();
	}

	// veri temizleniyor
	$ad = BoslukSil(@zkTemizle($_POST['ad']));
	$adres = BoslukSil(@zkTemizle($_POST['adres']));
	$bilgi = BoslukSil(@zkTemizle0($_POST['bilgi']));


	// Diğer diller
	$sorgu_ek = '';
	$sorgu_ek2 = '';
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			$a = BoslukSil(@zkTemizle($_POST['ad_'.$dil]));
			$sorgu_ek .= ",ad_$dil";
			$sorgu_ek2 .= ",'$a'";
		}
	}


	// bağlantı veritabanına giriliyor
	$vtsorgu = "INSERT INTO $tablo_baglantilar (yer,sayfa,alt_menu,sistem,sira,ad,adres,bilgi $sorgu_ek)
	VALUES('$yer','0','0','0','0','$ad','$adres','$bilgi' $sorgu_ek2)";
	$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


	header('Location: baglantilar.php?kip='.$git);
	exit();
}



// bağlantı düzenleme

elseif ( (isset($_POST['kip'])) AND ($_POST['kip'] == 'duzenle') )
{
	$id = BoslukSil(@zkTemizle($_POST['id']));
	$ad = BoslukSil(@zkTemizle($_POST['ad']));
	$adres = BoslukSil(@zkTemizle($_POST['adres']));
	$bilgi = BoslukSil(@zkTemizle0($_POST['bilgi']));


	// bağlantının sistem bilgisi alınıyor
	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE id='$id' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$baglar = $vt->fetch_assoc($vtsonuc);


	// Diğer diller
	$sorgu_ek = '';
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			if (array_key_exists('ad_'.$dil, $baglar))
			{
				$a = BoslukSil(@zkTemizle($_POST['ad_'.$dil]));
				$sorgu_ek .= ",ad_$dil='$a'";
			}
		}
	}


	if ($baglar['sistem'] != 1)
	{
		$vtsorgu = "UPDATE $tablo_baglantilar SET ad='$ad',adres='$adres',bilgi='$bilgi' $sorgu_ek WHERE id='$id' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}


	header('Location: baglantilar.php?kip='.$git);
	exit();
}

//   İŞLEMLER - SONU   //






//  NORMAL GÖRÜNÜM İŞLEMLERİ - BAŞI  //


// kipe göre yer seçimi GET
if ( (isset($_GET['kip'])) AND ($_GET['kip'] != '') )
{
	if ($_GET['kip'] == 'blok')
	{
		$yer = 2;
		$sayfa_baslik = $ly['blok_baglantilari'];

		$diger_baglantilar = '
		<a href="baglantilar.php">'.$ly['menu_baglantilari'].'</a>
		<br><b>'.$ly['blok_baglantilari'].'</b>
		<br><a href="baglantilar.php?kip=taban">'.$ly['taban_baglantilari'].'</a>';
	}

	elseif ($_GET['kip'] == 'taban')
	{
		$yer = 3;
		$sayfa_baslik = $ly['taban_baglantilari'];

		$diger_baglantilar = '
		<a href="baglantilar.php">'.$ly['menu_baglantilari'].'</a>
		<br><a href="baglantilar.php?kip=blok">'.$ly['blok_baglantilari'].'</a>
		<br><b>'.$ly['taban_baglantilari'].'</b>';
	}

	else
	{
		$yer = 1;
		$sayfa_baslik = $ly['menu_baglantilari'];

		$diger_baglantilar = '<b>'.$ly['menu_baglantilari'].'</b>
		<br><a href="baglantilar.php?kip=blok">'.$ly['blok_baglantilari'].'</a>
		<br><a href="baglantilar.php?kip=taban">'.$ly['taban_baglantilari'].'</a>';
	}
}

else
{
	$yer = 1;
	$sayfa_baslik = $ly['menu_baglantilari'];
	$_GET['kip'] = '';


	$diger_baglantilar = '<b>'.$ly['menu_baglantilari'].'</b>
	<br><a href="baglantilar.php?kip=blok">'.$ly['blok_baglantilari'].'</a>
	<br><a href="baglantilar.php?kip=taban">'.$ly['taban_baglantilari'].'</a>';
}



// bağlantı düzenleme için alma

if ( (isset($_GET['duzenle'])) AND ($_GET['duzenle'] == '1') )
{
	$id = @zkTemizle($_GET['id']);
	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE id='$id' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$baglar = $vt->fetch_assoc($vtsonuc);

	$yeni_duzenle = $ly['baglanti_duzenleme'];
	$bagadres = $baglar['adres'];
	$bagbilgi = $baglar['bilgi'];
	$bagad = $baglar['ad'];
	$bag_altmenu = $baglar['alt_menu'];
	$form_ek = '<input type="hidden" name="kip" value="duzenle" />
	<input type="hidden" name="id" value="'.$baglar['id'].'" />
	<input type="hidden" name="yer" value="'.$yer.'" />';
	$form_yolla = '<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['degistir'].'" />';


	// Diğer diller
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			if (isset($baglar['ad_'.$dil])) $bagad_diger[$dil] = $baglar['ad_'.$dil];
		}
	}
}

else
{
	$yeni_duzenle = $ly['baglanti_ekleme'];
	$bagad = '';
	$bagadres = '';
	$bagbilgi = '';
	$bag_altmenu = '';
	$form_ek = '<input type="hidden" name="kip" value="yeni" />
	<input type="hidden" name="yer" value="'.$yer.'" />';
	$form_yolla = '<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['yeni_olustur'].'" />';


	// Diğer diller
	if ($dil_eklenen != ',')
	{
		$dileklenen = explode(',', $dil_eklenen);
		foreach ($dileklenen as $dil)
		{
			if ($dil == '') continue;
			$bagad_diger[$dil] = '';
		}
	}
}





// Sınırsız bağlantı fonksiyonu

function phpkf_yonetim_baglantilar($baglanti)
{
	global $ayarlar, $vt, $site_dili, $tablo_baglantilar, $yo, $lmenu, $forum_kullan, $portal_kullan, $cms_kullan, $_GET;

	$duzenle = '<a href="baglantilar.php?kip='.$_GET['kip'].'&amp;duzenle=1&amp;id='.$baglanti['id'].'&amp;yo='.$yo.'#duzenle" style="text-align:right; float:right;"><img src="temalar/varsayilan/resimler/duzenle.png" width="14" height="14" class="duzeltLink" /></a>';


	if ($baglanti['ad'] == 'giris-cikis') $ad = $lmenu['giris'].' - '.$lmenu['cikis'];
	elseif ($baglanti['ad'] == 'kayit') $ad = $lmenu['kayit'];
	elseif ($baglanti['ad'] == 'anasayfa') $ad = $lmenu['anasayfa'];
	elseif ($baglanti['ad'] == 'kategoriler') $ad = $lmenu['kategori'];
	elseif ($baglanti['ad'] == 'sayfalar') $ad = $lmenu['sayfa'];
	elseif ($baglanti['ad'] == 'galeriler') $ad = $lmenu['galeri'];
	elseif ($baglanti['ad'] == 'videolar') $ad = $lmenu['video'];
	elseif ($baglanti['ad'] == 'etiket') $ad = $lmenu['etiket'];
	elseif ($baglanti['ad'] == 'arama') $ad = $lmenu['arama'];
	elseif ($baglanti['ad'] == 'uyeler') $ad = $lmenu['uye'];
	elseif ($baglanti['ad'] == 'yardim') $ad = $lmenu['yardim'];
	elseif ($baglanti['ad'] == 'mobil') $ad = $lmenu['mobil'];
	elseif ($baglanti['ad'] == 'rss') $ad = $lmenu['rss'];
	elseif ($baglanti['ad'] == 'iletisim') $ad = $lmenu['iletisim'];
	elseif ($baglanti['ad'] == 'forum') $ad = $lmenu['forum'];
	elseif ($baglanti['ad'] == 'portal') $ad = $lmenu['portal'];
	elseif ($baglanti['ad'] == 'cevrimici') $ad = $lmenu['cevrimici'];
	elseif ($baglanti['ad'] == 'profil') $ad = $lmenu['profil'];
	elseif ($baglanti['ad'] == 'duzenle') $ad = $lmenu['duzenle'];
	elseif ($baglanti['ad'] == 'sifre') $ad = $lmenu['sifre'];
	elseif ($baglanti['ad'] == 'ozel') $ad = $lmenu['ozel'];
	elseif ($baglanti['ad'] == 'yonetim') $ad = $lmenu['yonetim'];
	else $ad = $baglanti['ad'];

	if (($site_dili != $ayarlar['dil_varsayilan']) AND (isset($baglanti['ad_'.$site_dili])) AND ($baglanti['ad_'.$site_dili] != '')) $ad = $baglanti['ad_'.$site_dili];
	if ($baglanti['sistem'] == 1) $linkler = "\r\n".'<li id="'.$baglanti['id'].'" rel="sistem"><div style="margin-bottom:5px">'.$ad.'</div><ul>';
	else $linkler = "\r\n".'<li id="'.$baglanti['id'].'" rel="normal"><div style="margin-bottom:5px">'.$ad.$duzenle.'</div><ul>';


	// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
	$drm_syf_ek = '';
	if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel'";
	if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
	if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";
	else{if ($ayarlar['durum_sayfalar'] != 1) $drm_syf_ek .= "AND ad!='kategoriler' AND ad!='sayfalar'";}


	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE alt_menu='$baglanti[id]' $drm_syf_ek ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		while ($altlink = $vt->fetch_assoc($vtsonuc)) $linkler .= phpkf_yonetim_baglantilar($altlink);
	}


	$linkler .= '</ul></li>';

	return($linkler);
}


//  NORMAL GÖRÜNÜM İŞLEMLERİ - SONU  //








// forum ve portal için ek sorgu
$ek_sorgu = '';
if ($forum_kullan != 1) $ek_sorgu .= " AND ad!='forum' AND ad!='ozel'";
if ($portal_kullan != 1) $ek_sorgu .= " AND ad!='portal'";
if ($cms_kullan != 1) $ek_sorgu .= " AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";
else{if ($ayarlar['durum_sayfalar'] != 1) $ek_sorgu .= "AND ad!='kategoriler' AND ad!='sayfalar'";}


// Bağlantılar veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='$yer' AND alt_menu=0 $ek_sorgu OR yer=0 AND alt_menu=0 $ek_sorgu ORDER BY sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


$baslik_bag = '';
$gizle = '';

while ($baglar = $vt->fetch_assoc($vtsonuc))
{
	$depo1 = phpkf_yonetim_baglantilar($baglar);

	// gizle - göster
	if($baglar['yer'] == 0) $gizle .= $depo1;
	else $baslik_bag .= $depo1;
}



// Dil seçim formu hazırlanıyor
$diger_diller = '';
if ($dil_eklenen != ',')
{
	$dileklenen = explode(',', $dil_eklenen);
	foreach ($dileklenen as $dil)
	{
		if ($dil == '') continue;
		if (isset($bagad_diger[$dil])) $a = $bagad_diger[$dil];
		else $a = '';
		$diger_diller .= '<div class="phpkf-form-label"><label class="label">'.$diller[$dil].'<br /></label>
<input class="formlar" type="text" name="ad_'.$dil.'" value="'.$a.'" style="width:90%" /></div>';
	}
}





$tema_sayfa_icerik = '
<link rel="stylesheet" type="text/css" media="screen" href="bilesenler/css/baglantilar.css">
<form name="form1" action="baglantilar.php" method="post" onsubmit="return CopKontrol()">
<input type="hidden" name="kip" value="uygula" />
<input type="hidden" name="yo" value="'.$yo.'" />
<input type="hidden" name="yer" value="'.$yer.'" />

<div style="display:none">
<textarea name="siralama" id="siralama" rows="1" cols="1" style="width:100px;height:100px"></textarea>
<textarea name="gizleme" id="gizleme" rows="1" cols="1" style="width:100px;height:100px"></textarea>
<textarea name="copkutusu" id="copkutusu" rows="1" cols="1" style="width:100px;height:100px"></textarea>
</div>


<fieldset style="float:left; margin-right:30px;">
<legend>'.$sayfa_baslik.'</legend>
<div class="bloklar_yapi2" id="gorunen_baglantilar">
<ul id="baglantilar" style="padding:10px;">
'.$baslik_bag.'
</ul>
</div>
</fieldset>


<fieldset style="float:left;margin-right:30px">
<legend>'.$ly['islemler'].'</legend>

<div style="clear:both;width:100%">
<center>
<input class="dugme dugme-mavi" type="submit" name="yeni" value="'.$ly['degisiklikleri_uygula'].'" />
</center>
<br />
</div>

<b>'.$ly['cop_kutusu'].'</b>
<br />
<div class="bloklar_yapi2" id="cop_alani">
<ul id="cop" style="padding:10px;border:1px solid #bbb;min-height:25px;min-width:200px"></ul>
</div>

<div style="clear:both;width:100%">
<br /><br />
</div>

<b>'.$ly['gizle'].'</b>
<div class="bloklar_yapi2" id="gizle_alani">
<ul id="gizle" style="padding:10px;border:1px solid #bbb;min-height:25px;min-width:200px">
'.$gizle.'
</ul>
</div>
</fieldset>

</form>


<div style="position:absolute;top:47px;right:20px">
<fieldset>
<legend>'.$ly['diger_baglantilar'].'</legend>
'.$diger_baglantilar.'
</fieldset>
</div>



<div style="clear:both;"></div>

<fieldset style="max-width:550px">
<legend>'.$yeni_duzenle.'</legend>
<a name="duzenle"></a>


<form name="form2" action="baglantilar.php" method="post" onsubmit="return yarim_denetle()">
<input type="hidden" name="yo" value="'.$yo.'" />
'.$form_ek.'

<div class="phpkf-form-label">
<label class="label">'.$ly['baslik'].'<br /></label>
<input class="formlar" type="text" name="ad" value="'.$bagad.'" onkeyup="SefYapKat(this.value)" style="width:90%" />
</div>
'.$diger_diller.'

<div class="phpkf-form-label">
<label class="label">'.$ly['bilgi'].'<br /></label>
<input class="formlar" type="text" name="bilgi" value="'.$bagbilgi.'" style="width:90%" />
</div>

<div class="phpkf-form-label">
<label class="label">'.$ly['sef_adres'].'<br /></label>
<input class="formlar" type="text" name="adres" value="'.$bagadres.'" style="width:90%" />
</div>

'.$form_yolla.'

</form>
</fieldset>


<script type="text/javascript"><!-- //
function yarim_denetle(){
	var dogruMu = true;

	if (document.form2.ad.value=="") dogruMu = false;
	if (document.form2.bilgi.value=="") dogruMu = false;
	if (document.form2.adres.value=="") dogruMu = false;

	if (!dogruMu) alert(jsl["kategori_alanlar_zorunludur"]);
	return dogruMu;
}
//  -->
</script>

<script type="text/javascript" src="bilesenler/js/islemler.js"></script>
<script type="text/javascript" src="bilesenler/js/surukle_birak.js"></script>
';


$sayfa_adi = $sayfa_baslik;
$tema_sayfa_baslik = $sayfa_baslik;



//	TEMA UYGULANIYOR	//
include_once('bilesenler/sayfa_baslik.php');

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/varsayilan.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

eval(TEMA_UYGULA);

?>