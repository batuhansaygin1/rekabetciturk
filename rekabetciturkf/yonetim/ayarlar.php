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


$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../bilesenler/kullanici_kimlik.php';


// site kurucusu değilse hata ver
if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


$ayarlar_forum_rengi = $ayarlar['forum_rengi'];
$form_ek = '<input type="hidden" name="yo" value="'.$yo.'">';
$sayfa_adi = 'Yönetim Genel Ayarlar';

include_once('bilesenler/sayfa_baslik.php');

include '../temalar/'.$secili_tema.'/tema.php';
$ayarlar_t_tema_adi = $t_tema_adi;
$ayarlar_t_renkler = $t_renkler;




//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  BAŞI   //



if ( (isset($_GET['kip'])) AND ($_GET['kip'] !='') ):

$form_ek .= '<input type="hidden" name="kip" value="'.$_GET['kip'].'">';


if ($_GET['kip'] =='eposta')
{
	$TEMA_SAYFA_BASLIK = 'E-Posta Ayarları';

	if ($ayarlar['eposta_yontem'] == 'mail') $eposta_mail = 'checked="checked"';
	else $eposta_mail = '';

	if ($ayarlar['eposta_yontem'] == 'smtp') $eposta_smtp = 'checked="checked"';
	else $eposta_smtp = '';


	if ($ayarlar['smtp_kd'] == 'true') $smtp_kd_acik = 'checked="checked"';
	else $smtp_kd_acik = '';

	if ($ayarlar['smtp_kd'] == 'false') $smtp_kd_kapali = 'checked="checked"';
	else $smtp_kd_kapali = '';


	$y_posta = $ayarlar['y_posta'];
	$smtp_sunucu = $ayarlar['smtp_sunucu'];
	$smtp_kullanici = $ayarlar['smtp_kullanici'];
	$smtp_port = $ayarlar['smtp_port'];
}




elseif ($_GET['kip'] =='ozel_ileti')
{
	$TEMA_SAYFA_BASLIK = 'Özel ileti Ayarları';

	if ($ayarlar['o_ileti'] == 1) $o_ileti_acik = 'checked="checked"';
	else $o_ileti_acik = '';

	if ($ayarlar['o_ileti'] == 0) $o_ileti_kapali = 'checked="checked"';
	else $o_ileti_kapali = '';


	if ($ayarlar['oi_uyari'] == 1) $oi_uyari_acik = 'checked="checked"';
	else $oi_uyari_acik = '';

	if ($ayarlar['oi_uyari'] == 0) $oi_uyari_kapali = 'checked="checked"';
	else $oi_uyari_kapali = '';

	$gelen_kutu_kota = $ayarlar['gelen_kutu_kota'];
	$ulasan_kutu_kota = $ayarlar['ulasan_kutu_kota'];
	$kaydedilen_kutu_kota = $ayarlar['kaydedilen_kutu_kota'];
}




elseif ($_GET['kip'] =='cms')
{
	$TEMA_SAYFA_BASLIK = 'CMS ve Portal Ayarları';

	if ($ayarlar['portal_kullan'] == 1) $portal_acik = 'checked="checked"';
	else $portal_acik = '';

	if ($ayarlar['portal_kullan'] == 0) $portal_kapali = 'checked="checked"';
	else $portal_kapali = '';


	if ($ayarlar['cms_kullan'] == 1) $cms_kullan_acik = 'checked="checked"';
	else $cms_kullan_acik = '';

	if ($ayarlar['cms_kullan'] == 0) $cms_kullan_kapali = 'checked="checked"';
	else $cms_kullan_kapali = '';


	if ($ayarlar['cms_icinden'] == 1) $cms_icinden_acik = 'checked="checked"';
	else $cms_icinden_acik = '';

	if ($ayarlar['cms_icinden'] == 0) $cms_icinden_kapali = 'checked="checked"';
	else $cms_icinden_kapali = '';
}




elseif ($_GET['kip'] =='uyelik')
{
	$TEMA_SAYFA_BASLIK = 'Üyelik Ayarları';

	if ($ayarlar['bbcode'] == 1) $bbcode_acik = 'checked="checked"';
	else $bbcode_acik = '';

	if ($ayarlar['bbcode'] == 0) $bbcode_kapali = 'checked="checked"';
	else $bbcode_kapali = '';


	if ($ayarlar['hesap_etkin'] == 0) $hesap_etkin_kapali = ' checked="checked"';
	else $hesap_etkin_kapali = '';

	if ($ayarlar['hesap_etkin'] == 1) $hesap_etkin_kullanici = ' checked="checked"';
	else $hesap_etkin_kullanici = '';

	if ($ayarlar['hesap_etkin'] == 2) $hesap_etkin_yonetici = ' checked="checked"';
	else $hesap_etkin_yonetici = '';


	if ($ayarlar['uye_kayit'] == 1) $uye_kayit_acik = 'checked="checked"';
	else $uye_kayit_acik = '';

	if ($ayarlar['uye_kayit'] == 0) $uye_kayit_kapali = 'checked="checked"';
	else $uye_kayit_kapali = '';


	if ($ayarlar['resim_yukle'] == 1) $resim_yukle_acik = 'checked="checked"';
	else $resim_yukle_acik = '';

	if ($ayarlar['resim_yukle'] == 0) $resim_yukle_kapali = 'checked="checked"';
	else $resim_yukle_kapali = '';


	if ($ayarlar['uzak_resim'] == 1) $uzak_resim_acik = 'checked="checked"';
	else $uzak_resim_acik = '';

	if ($ayarlar['uzak_resim'] == 0) $uzak_resim_kapali = 'checked="checked"';
	else $uzak_resim_kapali = '';


	if ($ayarlar['resim_galerisi'] == 1) $resim_galerisi_acik = 'checked="checked"';
	else $resim_galerisi_acik = '';

	if ($ayarlar['resim_galerisi'] == 0) $resim_galerisi_kapali = 'checked="checked"';
	else $resim_galerisi_kapali = '';


	if ($ayarlar['onay_kodu'] == 1) $kayit_onay_acik = 'checked="checked"';
	else $kayit_onay_acik = '';

	if ($ayarlar['onay_kodu'] == 0) $kayit_onay_kapali = 'checked="checked"';
	else $kayit_onay_kapali = '';


	if ($ayarlar['kayit_soru'] == 1) $kayit_soru_acik = 'checked="checked"';
	else $kayit_soru_acik = '';

	if ($ayarlar['kayit_soru'] == 0) $kayit_soru_kapali = 'checked="checked"';
	else $kayit_soru_kapali = '';


	$cevrimici = ($ayarlar['cevrimici'] / 60);
	$ileti_sure = $ayarlar['ileti_sure'];
	$kilit_sure = ($ayarlar['kilit_sure'] / 60);
	$kayit_sorusu = $ayarlar['kayit_sorusu'];
	$kayit_cevabi = $ayarlar['kayit_cevabi'];
	$imza_uzunluk = $ayarlar['imza_uzunluk'];

	$kurucu = $ayarlar['kurucu'];
	$yonetici = $ayarlar['yonetici'];
	$yardimci = $ayarlar['yardimci'];
	$blm_yrd = $ayarlar['blm_yrd'];
	$kullanici = $ayarlar['kullanici'];

	$resim_boyut = ($ayarlar['resim_boyut']/1024);
	$resim_yukseklik = $ayarlar['resim_yukseklik'];
	$resim_genislik = $ayarlar['resim_genislik'];
	$kul_resim = $ayarlar['kul_resim'];
}




elseif ($_GET['kip'] =='yukleme')
{
	$TEMA_SAYFA_BASLIK = 'Yükleme Ayarları';

	$yukleme_dosya = $ayarlar['yukleme_dosya'];
	$yukleme_dizin = $ayarlar['yukleme_dizin'];
	$yukleme_boyut = ($ayarlar['yukleme_boyut']/1024);
	$yukleme_genislik = $ayarlar['yukleme_genislik'];
	$yukleme_yukseklik = $ayarlar['yukleme_yukseklik'];
}




elseif ($_GET['kip'] =='duzenleyici')
{
	$TEMA_SAYFA_BASLIK = 'Düzenleyici ve Yükleme Ayarları';

	$duzenleyici_font = $ayarlar['duzenleyici_font'];
	$dugme_html = $ayarlar['dugme_html'];
	$dugme_bbcode = $ayarlar['dugme_bbcode'];
	$dugme_hizli = $ayarlar['dugme_hizli'];
	$duzenleyici_html_tema = $ayarlar['duzenleyici_html_tema'];
	$duzenleyici_bbcode_tema = $ayarlar['duzenleyici_bbcode_tema'];
	$duzenleyici_hizli_tema = $ayarlar['duzenleyici_hizli_tema'];
	$dugme_kodlar = $ayarlar['dugme_kodlar'];
	$dugme_stil = $ayarlar['dugme_stil'];


	$duzenleyici_secenek = explode(',', $ayarlar['duzenleyici_secenek']);


	// BBCode düzenleyici seçimi
	$duzenleyici = '<select class="formlar" name="duzenleyici">';
	if (is_array($duzenleyici_secenek))
	{
		foreach ($duzenleyici_secenek as $secenek)
		{
			if ($secenek == 'duz') $isim = 'Düz';
			elseif ($secenek == 'varsayilan') $isim = 'phpKF';
			elseif ($secenek == 'tinymce') $isim = 'TinyMCE';
			elseif ($secenek == 'ckeditor') $isim = 'CKEditor';
			elseif ($secenek == 'sceditor') $isim = 'SCEditor';
			else $isim = $secenek;

			if ($ayarlar['duzenleyici'] == $secenek) $duzenleyici .= "\r\n".'<option value="'.$secenek.'" selected="selected">'.$isim.'</option>';
			else $duzenleyici .= "\r\n".'<option value="'.$secenek.'">'.$isim.'</option>';
		}
	}
	else $duzenleyici .= "\r\n".'<option value="varsayilan" selected="selected">phpKF</option>';
	$duzenleyici .= '</select>';



	// HTML düzenleyici seçimi
	$dduzenleyici = '<select class="formlar" name="dduzenleyici">';
	if (is_array($duzenleyici_secenek))
	{
		foreach ($duzenleyici_secenek as $secenek)
		{
			if ($secenek == 'duz') $isim = 'Düz';
			elseif ($secenek == 'varsayilan') $isim = 'phpKF';
			elseif ($secenek == 'tinymce') $isim = 'TinyMCE';
			elseif ($secenek == 'ckeditor') $isim = 'CKEditor';
			elseif ($secenek == 'sceditor') $isim = 'SCEditor';
			else $isim = $secenek;

			if ($ayarlar['dduzenleyici'] == $secenek) $dduzenleyici .= "\r\n".'<option value="'.$secenek.'" selected="selected">'.$isim.'</option>';
			else $dduzenleyici .= "\r\n".'<option value="'.$secenek.'">'.$isim.'</option>';
		}
	}
	else $dduzenleyici .= "\r\n".'<option value="varsayilan" selected="selected">phpKF</option>';
	$dduzenleyici .= '</select>';



	// Hızlı cevap düzenleyici seçimi
	$yduzenleyici = '<select class="formlar" name="yduzenleyici">';
	if (is_array($duzenleyici_secenek))
	{
		foreach ($duzenleyici_secenek as $secenek)
		{
			if ($secenek == 'duz') $isim = 'Düz';
			elseif ($secenek == 'varsayilan') $isim = 'phpKF';
			elseif ($secenek == 'tinymce') $isim = 'TinyMCE';
			elseif ($secenek == 'ckeditor') $isim = 'CKEditor';
			elseif ($secenek == 'sceditor') $isim = 'SCEditor';
			else $isim = $secenek;

			if ($ayarlar['yduzenleyici'] == $secenek) $yduzenleyici .= "\r\n".'<option value="'.$secenek.'" selected="selected">'.$isim.'</option>';
			else $yduzenleyici .= "\r\n".'<option value="'.$secenek.'">'.$isim.'</option>';
		}
	}
	else $yduzenleyici .= "\r\n".'<option value="varsayilan" selected="selected">phpKF</option>';
	$yduzenleyici .= '</select>';
}

else
{
	// Tema uygulanıyor
	include_once('temalar/varsayilan/menu.php');
	$ornek1 = new phpkf_tema();
	eval(TEMA_UYGULA);
	exit();
}

$gec='';

//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //
//    KİPE GÖRE SAYFA GÖSTERİMİ  -  SONU   //






//  GENEL AYARLAR - BAŞI  //

else:

$TEMA_SAYFA_BASLIK = 'Genel Ayarlar';


if ($ayarlar['forum_durumu'] == 1) $forum_durumu_acik = 'checked="checked"';
else $forum_durumu_acik = '';

if ($ayarlar['forum_durumu'] == 0) $forum_durumu_kapali = 'checked="checked"';
else $forum_durumu_kapali = '';


if ($ayarlar['seo'] == 1) $seo_acik = 'checked="checked"';
else $seo_acik = '';

if ($ayarlar['seo'] == 0) $seo_kapali = 'checked="checked"';
else $seo_kapali = '';


if ($ayarlar['bolum_kisi'] == 1) $bolumkisi_acik = 'checked="checked"';
else $bolumkisi_acik = '';

if ($ayarlar['bolum_kisi'] == 0) $bolumkisi_kapali = 'checked="checked"';
else $bolumkisi_kapali = '';


if ($ayarlar['konu_kisi'] == 1) $konukisi_acik = 'checked="checked"';
else $konukisi_acik = '';

if ($ayarlar['konu_kisi'] == 0) $konukisi_kapali = 'checked="checked"';
else $konukisi_kapali = '';


if ($ayarlar['sonkonular'] == 1) $sonkonular_acik = 'checked="checked"';
else $sonkonular_acik = '';

if ($ayarlar['sonkonular'] == 0) $sonkonular_kapali = 'checked="checked"';
else $sonkonular_kapali = '';

if ($ayarlar['boyutlandirma'] == 1) $boyutlandirma_acik = 'checked="checked"';
else $boyutlandirma_acik = '';

if ($ayarlar['boyutlandirma'] == 0) $boyutlandirma_kapali = 'checked="checked"';
else $boyutlandirma_kapali = '';


if ($ayarlar['vt_hata'] == 0) $vt_hata_kapali = ' checked="checked"';
else $vt_hata_kapali = '';

if ($ayarlar['vt_hata'] == 1) $vt_hata_ayrinti = ' checked="checked"';
else $vt_hata_ayrinti = '';

if ($ayarlar['vt_hata'] == 2) $vt_hata_sadece = ' checked="checked"';
else $vt_hata_sadece = '';



$site_title = $ayarlar['title'];
$anasyfbaslik = $ayarlar['anasyfbaslik'];
$syfbaslik = $ayarlar['syfbaslik'];
$alanadi = $ayarlar['alanadi'];
$f_dizin = $ayarlar['f_dizin'];
$tarih_bicimi = $ayarlar['tarih_bicimi'];
$fsyfkota = $ayarlar['fsyfkota'];
$ksyfkota = $ayarlar['ksyfkota'];
$kacsonkonu = $ayarlar['kacsonkonu'];
$k_cerez_zaman = ($ayarlar['k_cerez_zaman'] / 60);
$meta_diger = $ayarlar['meta_diger'];
$site_taban_kod = $ayarlar['site_taban_kod'];


$saat_dilimi = '<select class="formlar" name="saat_dilimi">
<option value="-12"';

if ($ayarlar['saat_dilimi'] == -12) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 12 Saat</option>
<option value="-11"';

if ($ayarlar['saat_dilimi'] == -11) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 11 Saat</option>
<option value="-10"'; 

if ($ayarlar['saat_dilimi'] == -10) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 10 Saat</option>
<option value="-9.5"';

if ($ayarlar['saat_dilimi'] == -9.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 9.5 Saat</option>
<option value="-9"';

if ($ayarlar['saat_dilimi'] == -9) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 9 Saat</option>
<option value="-8"';

if ($ayarlar['saat_dilimi'] == -8) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 8 Saat</option>
<option value="-7"';

if ($ayarlar['saat_dilimi'] == -7) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 7 Saat</option>
<option value="-6"';

if ($ayarlar['saat_dilimi'] == -6) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 6 Saat</option>
<option value="-5"';

if ($ayarlar['saat_dilimi'] == -5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 5 Saat</option>
<option value="-4.5"';

if ($ayarlar['saat_dilimi'] == -4.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 4.5 Saat</option>
<option value="-4"';

if ($ayarlar['saat_dilimi'] == -4) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 4 Saat</option>
<option value="-3.5"';

if ($ayarlar['saat_dilimi'] == -3.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 3.5 Saat</option>
<option value="-3"';

if ($ayarlar['saat_dilimi'] == -3) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 3 Saat</option>
<option value="-2"';

if ($ayarlar['saat_dilimi'] == -2) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 2 Saat</option>
<option value="-1"';

if ($ayarlar['saat_dilimi'] == -1) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC - 1 Saat</option>
<option value="0"';

if ($ayarlar['saat_dilimi'] == 0) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC</option>
<option value="1"';

if ($ayarlar['saat_dilimi'] == 1) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 1 Saat</option>
<option value="2"';

if ($ayarlar['saat_dilimi'] == 2) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 2 Saat</option>
<option value="3"';

if ($ayarlar['saat_dilimi'] == 3) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 3 Saat</option>
<option value="3.5"';

if ($ayarlar['saat_dilimi'] == 3.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 3.5 Saat</option>
<option value="4"';

if ($ayarlar['saat_dilimi'] == 4) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 4 Saat</option>
<option value="4.5"';

if ($ayarlar['saat_dilimi'] == 4.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 4.5 Saat</option>
<option value="5"';

if ($ayarlar['saat_dilimi'] == 5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 5 Saat</option>
<option value="5.5"';

if ($ayarlar['saat_dilimi'] == 5.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 5.5 Saat</option>
<option value="6"';

if ($ayarlar['saat_dilimi'] == 6) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 6 Saat</option>
<option value="6.5"';

if ($ayarlar['saat_dilimi'] == 6.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 6.5 Saat</option>
<option value="7"';

if ($ayarlar['saat_dilimi'] == 7) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 7 Saat</option>
<option value="8"';

if ($ayarlar['saat_dilimi'] == 8) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 8 Saat</option>
<option value="8.75"';

if ($ayarlar['saat_dilimi'] == 8.75) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 8.75 Saat</option>
<option value="9"';

if ($ayarlar['saat_dilimi'] == 9) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 9 Saat</option>
<option value="9.5"';

if ($ayarlar['saat_dilimi'] == 9.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 9.5 Saat</option>
<option value="10"';

if ($ayarlar['saat_dilimi'] == 10) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 10 Saat</option>
<option value="10.5"';

if ($ayarlar['saat_dilimi'] == 10.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 10.5 Saat</option>
<option value="11"';

if ($ayarlar['saat_dilimi'] == 11) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 11 Saat</option>
<option value="11.5"';

if ($ayarlar['saat_dilimi'] == 11.5) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 11.5 Saat</option>
<option value="12"';

if ($ayarlar['saat_dilimi'] == 12) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 12 Saat</option>
<option value="12.75"';

if ($ayarlar['saat_dilimi'] == 12.75) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 12.75 Saat</option>
<option value="13"';

if ($ayarlar['saat_dilimi'] == 13) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 13 Saat</option>
<option value="14"';

if ($ayarlar['saat_dilimi'] == 14) $saat_dilimi .= ' selected="selected"';
$saat_dilimi .= '>UTC + 14 Saat</option>
</select>';



if (is_array($ayarlar_t_renkler))
{
	$forum_rengi = '<select class="formlar" name="forum_rengi">';

	foreach ($ayarlar_t_renkler as $renkler1=>$renkler2)
	{
		if ($ayarlar_forum_rengi == $renkler2)
			$forum_rengi .= "\r\n".'<option value="'.$renkler2.'" selected="selected">'.$renkler1;
		else $forum_rengi .= "\r\n".'<option value="'.$renkler2.'">'.$renkler1;
	}

	$forum_rengi .= '</select>';
}
else $forum_rengi = '<input type="hidden" name="forum_rengi" value="siyah">"'.$ayarlar_t_tema_adi.'" için renk seçimi yok.';


$tema_genislik = $ayarlar['tema_genislik'];
$tema_logo_ust = $ayarlar['tema_logo_ust'];
$tema_logo_alt = $ayarlar['tema_logo_alt'];
$dil_eklenen = $ayarlar['dil_eklenen'];



$dil_varsayilan = '<select name="dil_varsayilan" class="formlar" style="width:auto">';
foreach ($diller as $anahtar => $dil)
{
	if ($ayarlar['dil_varsayilan'] == $anahtar) $isaretle = ' selected="selected"';
	else $isaretle = '';
	$dil_varsayilan .= "\r\n".'<option value="'.$anahtar.'" '.$isaretle.'>'.$diller[$anahtar].'</option>';
}
$dil_varsayilan .= '</select>';








endif;
//  GENEL AYARLAR - SONU  //





// Tema uygulanıyor
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/ayarlar.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));
eval(TEMA_UYGULA);

?>