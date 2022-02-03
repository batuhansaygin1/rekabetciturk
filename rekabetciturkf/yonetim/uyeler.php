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

if (empty($_GET['sayfa'])) $_GET['sayfa'] = 0;
else $_GET['sayfa'] = @zkTemizle($_GET['sayfa']);

if (empty($_GET['sirala'])) $_GET['sirala'] = 1;
else $_GET['sirala'] = @zkTemizle($_GET['sirala']);

if (empty($_GET['kul_id'])) $_GET['kul_id'] = 0;
else $_GET['kul_id'] = @zkTemizle($_GET['kul_id']);

if (empty($_GET['kul_ara'])) $_GET['kul_ara'] = '%';
else
{
	$_GET['kul_ara'] = @zkTemizle(trim($_GET['kul_ara']));
	$_GET['kul_ara'] = @str_replace('*','%',$_GET['kul_ara']);
}



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
else $gyo = '';




//  İŞLEMLER BAŞI  //
//  İŞLEMLER BAŞI  //
//  İŞLEMLER BAŞI  //

if ((isset($_GET['kullanici'])) AND ($_GET['kullanici'] != '')):

$_GET['kullanici'] = @zkTemizle($_GET['kullanici']);


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hata.php?hata=45');
	exit();
}


//		KULLANICI ETKİSİZLEŞTİRME		 //

if ($_GET['kullanici'] == 'etkisiz')
{
	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=61');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin='0', kullanici_kimlik='', yonetim_kimlik='' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: hata.php?bilgi=33');
	exit();
}



//		KULLANICI ETKİNLEŞTİRME		 //

elseif ($_GET['kullanici'] == 'etkin')
{
	$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin='1',kul_etkin_kod='0' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: hata.php?bilgi=25');
	exit();
}



//		KULLANICI SİLME		//

elseif ($_GET['kullanici'] == 'sil')
{
	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=137');
		exit();
	}


	$vtsorgu = "DELETE FROM $tablo_kullanicilar WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
		header('Location: hata.php?bilgi=23');

	elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
		header('Location: hata.php?bilgi=26');

	else header('Location: hata.php?bilgi=34');
	exit();
}



//		KULLANICI ENGELLE		//

elseif ($_GET['kullanici'] == 'engelle')
{
	if ($_GET['kul_id'] == 1)
	{
		header('Location: hata.php?hata=149');
		exit();
	}


	$vtsorgu = "UPDATE $tablo_kullanicilar SET engelle='1', kullanici_kimlik='', yonetim_kimlik='' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: hata.php?bilgi=35');
	exit();
}



//		KULLANICI ENGELİNİ KALDIRMA		//

elseif ($_GET['kullanici'] == 'engel_kaldir')
{
	$vtsorgu = "UPDATE $tablo_kullanicilar SET engelle='0' WHERE id='$_GET[kul_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: hata.php?bilgi=24');
	exit();
}

endif;

//  İŞLEMLER SONU  //
//  İŞLEMLER SONU  //
//  İŞLEMLER SONU  //







//	KİP SEÇİMİ	//

if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
{
	$eksorgu = "engelle='1' AND kul_etkin='1'";
	$sayfaek = 'kip=engelli&amp;';

	$sayfa_adi = $ly['engellenmis_uyeler'];
	$sayfa_baslik = $ly['engellenmis_uyeler'];

	$sonuc_yok = $l['uye_arama_sonuc_yok'];
	$form_bilgisi = '<form action="uyeler.php" name="kul_ara" method="get">
<input type="hidden" name="kip" value="engelli">';
}

elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
{
	$eksorgu = "kul_etkin='0'";
	$sayfaek = 'kip=etkisiz&amp;';

	$sayfa_adi = $ly['etkin_olmayan_uyeler'];
	$sayfa_baslik = $ly['etkin_olmayan_uyeler'];

	$sonuc_yok = $l['uye_arama_sonuc_yok'];
	$form_bilgisi = '<form action="uyeler.php" name="kul_ara" method="get">
<input type="hidden" name="kip" value="etkisiz">';
}

else
{
	$eksorgu = "engelle='0' AND kul_etkin='1'";
	$sayfaek = '';

	$sayfa_adi = $ly['etkin_uyeler'];
	$sayfa_baslik = $ly['etkin_uyeler'];

	$sonuc_yok = $l['uye_arama_sonuc_yok'];
	$form_bilgisi = '<form action="uyeler.php" name="kul_ara" method="get">';
}







//	SORGU SONUCUNDAKİ TOPLAM SONUÇ SAYISI ALINIYOR	//

$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE $eksorgu AND kullanici_adi LIKE '$_GET[kul_ara]%'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc);

$uyeler_kota = 30;

$toplam_sayfa = ($satir_sayi / $uyeler_kota);
settype($toplam_sayfa,'integer');

if (($satir_sayi % $uyeler_kota) != 0) $toplam_sayfa++;


//	KULLANICILARIN BİLGİLERİ ÇEKİLİYOR	//

$vtsorgu = "SELECT id,kullanici_adi,yetki,mesaj_sayisi,katilim_tarihi,kul_ip,son_hareket FROM $tablo_kullanicilar WHERE $eksorgu AND kullanici_adi LIKE '$_GET[kul_ara]%' ORDER BY ";

if ($_GET['sirala'] == 'katilim_9dan0a') $vtsorgu .= "id DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'mesaj_0dan9a') $vtsorgu .= "mesaj_sayisi LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'mesaj_9dan0a') $vtsorgu .= "mesaj_sayisi DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'ad_AdanZye') $vtsorgu .= "kullanici_adi LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'ad_ZdenAya') $vtsorgu .= "kullanici_adi DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'giris_0dan9a') $vtsorgu .= "son_hareket LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'giris_9dan0a') $vtsorgu .= "son_hareket DESC LIMIT $_GET[sayfa],$uyeler_kota";
elseif ($_GET['sirala'] == 'yetki') $vtsorgu .= "yetki=0, yetki=3, yetki=2, yetki=1, id LIMIT $_GET[sayfa],$uyeler_kota";
else $vtsorgu .= "id LIMIT $_GET[sayfa],$uyeler_kota";

$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());






$siralama_secenek = '<option value="1">'.$l['sirala_kayit'].'</option>
<option value="katilim_9dan0a" ';

if ($_GET['sirala'] == 'katilim_9dan0a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_kayit_ters'].'</option>

<option value="ad_AdanZye" ';
if ($_GET['sirala'] == 'ad_AdanZye') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_ad'].'</option>

<option value="ad_ZdenAya" ';
if ($_GET['sirala'] == 'ad_ZdenAya') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_ad_ters'].'</option>

<option value="mesaj_9dan0a" ';
if ($_GET['sirala'] == 'mesaj_9dan0a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_ileti'].'</option>

<option value="mesaj_0dan9a" ';
if ($_GET['sirala'] == 'mesaj_0dan9a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_ileti_ters'].'</option>

<option value="giris_9dan0a" ';
if ($_GET['sirala'] == 'giris_9dan0a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_giris'].'</option>

<option value="giris_0dan9a" ';
if ($_GET['sirala'] == 'giris_0dan9a') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_giris_ters'].'</option>

<option value="yetki" ';
if ($_GET['sirala'] == 'yetki') $siralama_secenek .= 'selected="selected"';
$siralama_secenek .= '>'.$l['sirala_yetki'].'</option>';




//  ÜYELERİN BİLGİLERİ SIRALANIYOR  //

// Simgeler
$duzenle_simge = '<img src="temalar/varsayilan/resimler/duzenle.png" width="16" height="16" alt="d" style="margin-left:6px; margin-right:12px" title="'.$ly['yetki_profil_degistir'].'" />';

$sil_simge = '<img src="temalar/varsayilan/resimler/sil.png" width="15" height="15" alt="s" style="margin-left:12px; margin-right:6px" title="'.$l['sil'].'" />';


$etkin_simge = '<img src="temalar/varsayilan/resimler/bos2.png" width="15" height="15" alt="a" style="margin-left:6px; margin-right:12px" title="'.$ly['etkisiz_yap'].'" />';

$etkisiz_simge = '<img src="temalar/varsayilan/resimler/dogru.png" width="15" height="15" alt="a" style="margin-left:6px; margin-right:12px" title="'.$ly['etkin_yap'].'" />';


$engelli_simge = '<img src="temalar/varsayilan/resimler/bos.png" width="15" height="15" alt="b" style="margin-left:12px; margin-right:6px" title="'.$ly['engel_kaldir'].'" />';

$engelsiz_simge = '<img src="temalar/varsayilan/resimler/yanlis.png" width="15" height="15" alt="b" style="margin-left:12px; margin-right:6px" title="'.$ly['engelle'].'" />';



$uyeler_dongu = '';

while ($uyeler_satir = $vt->fetch_array($vtsonuc)):

if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'engelli'))
{
	$uye_etkin = '<a href="javascript:void(0)" style="cursor:no-drop">'.$etkin_simge.'</a>';

	$uye_engel = '<a href="uyeler.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engel_kaldir" onclick="return window.confirm(\''.$ly['engel_kaldir'].'?\')">'.$engelli_simge.'</a>';

	$kip = 'kip='.$_GET['kip'].'&amp;';
}

elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'etkisiz'))
{
	$uye_etkin = '<a href="uyeler.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=etkin" onclick="return window.confirm(\''.$ly['etkin_yap'].'?\')">'.$etkisiz_simge.'</a>';

	$uye_engel = '<a href="uyeler.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engelle" onclick="return window.confirm(\''.$ly['engelle'].'?\')">'.$engelsiz_simge.'</a>';

	$kip = 'kip='.$_GET['kip'].'&amp;';
}

else
{
	$uye_etkin = '<a href="uyeler.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=etkisiz" onclick="return window.confirm(\''.$ly['etkisiz_yap'].'?\')">'.$etkin_simge.'</a>';

	$uye_engel = '<a href="uyeler.php?kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=engelle" onclick="return window.confirm(\''.$ly['engelle'].'?\')">'.$engelsiz_simge.'</a>';

	$kip = '';
}



$uye_adi = '&nbsp;<a href="../'.$dosya_profil.'?u='.$uyeler_satir['id'].'">'.$uyeler_satir['kullanici_adi'].'</a>';

$uye_katilim = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uyeler_satir['katilim_tarihi']);

$uye_son_hareket = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $uyeler_satir['son_hareket']);

$uye_ip = '<a href="ip_yonetimi.php?kip=1&ip='.$uyeler_satir['kul_ip'].'">'.$uyeler_satir['kul_ip'].'</a>';

$uye_mesaj = NumaraBicim($uyeler_satir['mesaj_sayisi']);


$uye_duzenle = '<a href="kullanici_degistir.php?u='.$uyeler_satir['id'].'">'.$duzenle_simge.'</a>';

$uye_sil = '<a href="uyeler.php?'.$kip.'kul_id='.$uyeler_satir['id'].'&amp;yo='.$yo.'&amp;kullanici=sil" onclick="return window.confirm(jsl[\'sil_uyari\'])">'.$sil_simge.'</a>';


if ($uyeler_satir['id'] == 1) $uye_yetki = '<font class="kurucu">'.$ayarlar['kurucu'].'</font>';
elseif ($uyeler_satir['yetki'] == 1) $uye_yetki = '<font class="yonetici">'.$ayarlar['yonetici'].'</font>';
elseif ($uyeler_satir['yetki'] == 2) $uye_yetki = '<font class="yardimci">'.$ayarlar['yardimci'].'</font>';
elseif ($uyeler_satir['yetki'] == 3) $uye_yetki = '<font class="blm_yrd">'.$ayarlar['blm_yrd'].'</font>';
else $uye_yetki = '';


$uyeler_dongu .= '<tr bgcolor="#ffffff" onMouseOver="this.bgColor= \'#efefef\'" onMouseOut="this.bgColor= \'#ffffff\'">
<td align="left" title="'.$l['profil_goruntule'].'">'.$uye_adi.'</td>
<td align="center">'.$uye_yetki.'</td>
<td align="center">'.$uye_mesaj.'</td>
<td align="center">'.$uye_katilim.'</td>
<td align="center">'.$uye_son_hareket.'</td>
<td align="center">'.$uye_ip.'</td>
<td align="center" style="line-height:20px">

<span style="display:inline; width:78px; margin:0 auto; border:0px solid #ff0000">'.$uye_duzenle.$uye_sil.'</span>
<span style="display:inline-table; width:78px; margin:12px auto 0 auto; border:0px solid #ff0000">'.$uye_etkin.$uye_engel.'</span>
</td>
</tr>';


endwhile;



//  SAYFALAMA   //

$sayfalama = '';

if ($satir_sayi > $uyeler_kota):

$sayfalama .= '<p>
<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
	<tr>
	<td class="forum_baslik">
Toplam '.$toplam_sayfa.' Sayfa:&nbsp;
	</td>
';


if ($_GET['sayfa'] != 0)
{
	$sayfalama .= '<td bgcolor="#ffffff" title="ilk sayfaya git">';
	$sayfalama .= '&nbsp;<a href="uyeler.php?'.$sayfaek.'sayfa=0&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&laquo;ilk</a>&nbsp;</td>';
	
	$sayfalama .= '<td bgcolor="#ffffff" title="önceki sayfaya git">';
	$sayfalama .= '&nbsp;<a href="uyeler.php?'.$sayfaek.'sayfa='.($_GET['sayfa'] - $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&lt;</a>&nbsp;</td>';
}

for ($sayi=0,$sayfa_sinir=$_GET['sayfa']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['sayfa'] / $uyeler_kota) - 3));

	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['sayfa'] + 8)) {break;}
		if (($sayi == 0) and ($_GET['sayfa'] == 0))
		{
			$sayfalama .= '<td bgcolor="#ffffff" title="Şu an bulunduğunuz sayfa">';
			$sayfalama .= '&nbsp;<b>[1]</b>&nbsp;</td>';
		}
	
		elseif (($sayi + 1) == (($_GET['sayfa'] / $uyeler_kota) + 1))
		{
			$sayfalama .= '<td bgcolor="#ffffff" title="Şu an bulunduğunuz sayfa">';
			$sayfalama .= '&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
		}
	
		else
		{
			$sayfalama .= '<td bgcolor="#ffffff" title="'.($sayi + 1).' numaralı sayfaya git">';

			$sayfalama .= '&nbsp;<a href="uyeler.php?'.$sayfaek.'sayfa='.($sayi * $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">'.($sayi + 1).'</a>&nbsp;</td>';
		}
	}
}
if ($_GET['sayfa'] < ($satir_sayi - $uyeler_kota))
{
	$sayfalama .= '<td bgcolor="#ffffff" title="sonraki sayfaya git">';
	$sayfalama .= '&nbsp;<a href="uyeler.php?'.$sayfaek.'sayfa='.($_GET['sayfa'] + $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">&gt;</a>&nbsp;</td>';

	$sayfalama .= '<td bgcolor="#ffffff" title="son sayfaya git">';
	$sayfalama .= '&nbsp;<a href="uyeler.php?'.$sayfaek.'sayfa='.(($toplam_sayfa - 1) * $uyeler_kota).'&amp;kul_ara='.$_GET['kul_ara'].'&amp;sirala='.$_GET['sirala'].'">son&raquo;</a>&nbsp;</td>';
}

$sayfalama .= '</tr>
</table>';

endif;




$uye_sayisi = NumaraBicim($satir_sayi);
$uye_ara = @str_replace('%','*',$_GET['kul_ara']);


// Arama sonuç vermezse
if ($uyeler_dongu == '')
{
	$uyeler_dongu = '<tr class="liste-etiket" bgcolor="#ffffff">
	<td colspan="9" align="center" height="70" valign="center">'.$sonuc_yok.'</td>
	</tr>';
}



// Tema uygulanıyor
include_once('bilesenler/sayfa_baslik.php');

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/uyeler.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);
?>