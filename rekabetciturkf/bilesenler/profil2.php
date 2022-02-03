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


@ini_set('magic_quotes_runtime', 0);

if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include 'kullanici_kimlik.php';
include_once('seo.php');
if (!isset($_GET['kosul'])) exit();
$tarih = time();



//   ÜYENİN SON YAZILARI AJAX - BAŞI   //

if ($_GET['kosul'] == 'sonyazi')
{
	header("Content-type: text/html; charset=utf-8");

	$sayfa_adi = 'Üyenin Son Yazıları';
	$hatali_veri = '<font color="#ff0000"><b>Hatalı veri !</b></font>';
	$uye_yazilar = '<div style="padding:7px"><br>Üyenin hiçbir yazısı bulunmamaktadır.<br><br></div>';


	// veri hatalıysa
	if ( (!isset($_GET['u'])) OR ($_GET['u'] == '') OR (is_numeric($_GET['u']) == false) )
	{
		echo $hatali_veri;
		exit();
	}


	$_GET['u'] = @zkTemizle2($_GET['u']);
	$vtsorgu = "SELECT id,mesaj_sayisi,kullanici_adi FROM $tablo_kullanicilar WHERE id='$_GET[u]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_array($vtsonuc);


	// üye yoksa
	if (empty($satir['id']))
	{
		echo $hatali_veri;
		exit();
	}


	// konu ve cevaplar veritabanından çekiliyor
	$vtsorgu = "SELECT id,hangi_forumdan as hangi,mesaj_baslik,tarih as tarih2,yazan AS rakam
FROM $tablo_mesajlar WHERE silinmis=0 AND yazan='$satir[kullanici_adi]'
UNION ALL SELECT id,hangi_basliktan as hangi,cevap_baslik as mesaj_baslik,tarih as tarih2,id AS rakam
FROM $tablo_cevaplar WHERE silinmis=0 AND cevap_yazan='$satir[kullanici_adi]'
ORDER BY tarih2 DESC LIMIT 0,5";

	$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// üyenin yazısı yoksa
	if ( ($satir['mesaj_sayisi'] == '0') OR (!$vt->num_rows($vtsonuc5)) )
	{
		echo $uye_yazilar;
		exit();
	}


	$uye_yazilar = '<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
	<tr class="tablo_ici">
	<td class="liste-etiket" align="center" colspan="2" style="border-right:1px solid #e0e0e0">Başlık</td>
	<td class="liste-etiket" align="center" width="115">Tarih</td>
	</tr>';


	// üyenin yazıları sıralanıyor
	while ($yazilar_satir = $vt->fetch_array($vtsonuc5))
	{
		$yazi_tarih = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yazilar_satir['tarih2']);

		// bulunan cevap ise
		if (is_numeric($yazilar_satir['rakam']))
		{
			// cevabın konusunun bilgileri çekiliyor
			$vtsorgu = "SELECT id,mesaj_baslik FROM $tablo_mesajlar WHERE id='$yazilar_satir[hangi]'";
			$vtsonuc6 = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$konusu = $vt->fetch_assoc($vtsonuc6);


			$uye_yazilar .= '<tr class="tablo_ici">
			<td class="liste-etiket" align="right" height="20" width="50" style="border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0">Cevap:</td>
			<td class="liste-veri" align="left" style="border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0">
			<a href="'.linkver('konu.php?k='.$konusu['id'], $konusu['mesaj_baslik'], '#c'.$yazilar_satir['id']).'">'.$konusu['mesaj_baslik'].'</a></td>
			<td class="liste-veri" align="center" style="border-top:1px solid #e0e0e0">'.$yazi_tarih.'</td>
			</tr>';
		}

		// bulunan konu ise
		else
		{
			$uye_yazilar .= '<tr class="tablo_ici">
			<td class="liste-etiket" align="right" height="20" width="50" style="border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0">Konu:</td>
			<td class="liste-veri" align="left" style="border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0">
			<a href="'.linkver('konu.php?k='.$yazilar_satir['id'], $yazilar_satir['mesaj_baslik']).'">'.$yazilar_satir['mesaj_baslik'].'</a></td>
			<td class="liste-veri" align="center" style="border-top:1px solid #e0e0e0">'.$yazi_tarih.'</td>
			</tr>';
		}
	}


	$sayfano = '4,';
	$sayfano .= $satir['id'];
	$sayfa_adi .= ': '.$satir['kullanici_adi'];

	if (!defined('DOSYA_OTURUM')) include 'oturum.php';

	echo $uye_yazilar.'</table>';
	exit();
}

//   ÜYENİN SON YAZILARI AJAX - SONU   //






//   YORUM GÖSTER AJAX - BAŞI   //

elseif ($_GET['kosul'] == 'yorum')
{
	header("Content-type: text/html; charset=utf-8");

	$yrmadim = 5;
	$sayfa_adi = 'Üyenin Yorumları';
	$hatali_veri = '<font color="#ff0000"><b>Hatalı veri !</b></font>';
	$uye_yorum = '<div style="padding:7px"><br>Üyenin hiçbir yorumu bulunmamaktadır.<br><br></div>';


	// veri hatalıysa
	if ( (!isset($_GET['u'])) OR ($_GET['u'] == '') OR (is_numeric($_GET['u']) == false) )
	{
		echo $hatali_veri;
		exit();
	}


	$_GET['u'] = @zkTemizle2($_GET['u']);
	$vtsorgu = "SELECT id,kullanici_adi,yrm_sayi FROM $tablo_kullanicilar WHERE id='$_GET[u]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_array($vtsonuc);


	// üye yoksa
	if (empty($satir['id']))
	{
		echo $hatali_veri;
		exit();
	}


	// üye kendi yorumlarına bakıyorsa, yorum bildirimi varsa okundu olarak işaretleniyor
	if ($satir['id'] == $kullanici_kim['id'])
	{
		$vtsorgu = "UPDATE $tablo_bildirimler SET okundu='1' WHERE uye_id='$kullanici_kim[id]' AND tip='2' AND okundu='0'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}




	// yönetici, yardımcı ve üyenin kendisine onaysızları göster
	if (!isset($kullanici_kim['yetki'])) $onay_eksorgu = 'AND onay=1';
	elseif ($kullanici_kim['yetki'] == '0') $onay_eksorgu = "AND onay=1 OR silinmis=0 AND uye_id='$satir[id]' AND onay=0 AND yazan_id=$kullanici_kim[id]";
	else $onay_eksorgu = '';


	// yorum sayısı alınıyor
	$yrmsayi = $vt->query("SELECT id FROM $tablo_yorumlar WHERE silinmis=0 AND uye_id='$satir[id]' $onay_eksorgu") or die ($vt->hata_ver());
	$yorum_sayi = $vt->num_rows($yrmsayi);


	// sayfalama hesaplanıyor
	if ( (!isset($_GET['s'])) OR ($_GET['s'] == '') ) $_GET['s'] = 0;
	if (is_numeric($_GET['s']) == false) $_GET['s'] = 0;
	$yrmsayfa = zkTemizle2($_GET['s']);
	if ($yrmsayfa > $yorum_sayi) $yrmsayfa = $yorum_sayi;


	// yorumlar çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_yorumlar WHERE silinmis=0 AND uye_id='$satir[id]' $onay_eksorgu ORDER BY id DESC LIMIT $yrmsayfa,$yrmadim";
	$vtsonuc6 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$uye_yorum = '<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">';


	// giriş yapmışsa ve sayfa değeri yoksa yorum yazma alanını göster
	if ( (isset($kullanici_kim['id'])) AND ($yrmsayfa == 0) )
	{
		$uye_yorum .= '<tr><td class="yorum_yaz" align="center" valign="middle" width="70">';

		if ($kullanici_kim['resim'] != '') $uye_yorum .= '<img src="'.$kullanici_kim['resim'].'" width="60" alt="Kullanıcı Resmi" title="Kullanıcı Resmi">';
		elseif ($ayarlar['kul_resim'] != '') $uye_yorum .= '<img src="'.$ayarlar['kul_resim'].'" width="60" alt="Varsayılan Kullanıcı Resmi" title="Varsayılan Kullanıcı Resmi">';
		else $uye_yorum .= '';

		$uye_yorum .= '</td><td class="yorum_yaz" align="left" valign="top">
		<form action="javascript:Yolla(\'bilesenler/profil2.php?kosul=yorumg&u='.$satir['id'].'\',3,\'uye_yorum\');" method="post" onsubmit="return denetle()" name="formyorum">
		<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
		<textarea class="formlar" cols="70" rows="6" name="yorum" style="width:350px; height:80px; margin:0px; color:#777777" onfocus="YorumSil(this)" onblur="YorumSil(this)">Yorum yaz...</textarea>
		<div id="uye_yorum_bekle" style="position:relative; float:right; width:105px"><input class="formlar" name="yorum_gonder" type="submit" value="Gönder"></div>
		</form><div style="height:3px"></div></td></tr>';
	}


	// üye için hiç yorum yoksa
	if ($yorum_sayi == 0)
	{
		$ilk_yorum = 'Üye için bırakılmış hiçbir yorum bulunmamaktadır.';
		if ($satir['yrm_sayi'] != 0) $ilk_yorum = 'Üyenin henüz onaylanmamış <b>'.($satir['yrm_sayi']-$yorum_sayi).'</b> yorumu bulunmaktadır.';
		elseif (isset($kullanici_kim['id'])) $ilk_yorum .= '<br>İlk yorumu siz yazın.';

		$uye_yorum .= '<tr><td class="yorum_ilk" align="center" colspan="2"><br><br>'.$ilk_yorum.'<br><br></td></tr></table>';
		echo $uye_yorum;

		$sayfano = '4,';
		$sayfano .= $satir['id'];
		$sayfa_adi .= ': '.$satir['kullanici_adi'];
		if (!defined('DOSYA_OTURUM')) include 'oturum.php';
		exit();
	}


	else
	{
	// yorumlar sıralanıyor
	while ($yorumlar = $vt->fetch_array($vtsonuc6))
	{
		$vtsorgu2 = "SELECT resim,yetki FROM $tablo_kullanicilar WHERE id='$yorumlar[yazan_id]' LIMIT 1";
		$vtsonuc7 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
		$resim = $vt->fetch_assoc($vtsonuc7);

		$uye_yorum .= '<tr>
		<td class="yorumlar" align="center" valign="middle" rowspan="2" width="70">
		<div style="height:5px"></div>';

		if ($resim['resim'] != '') $uye_yorum .= '<img src="'.$resim['resim'].'" width="60" alt="Kullanıcı Resmi" title="Kullanıcı Resmi">';
		elseif ($ayarlar['kul_resim'] != '') $uye_yorum .= '<img src="'.$ayarlar['kul_resim'].'" width="60" alt="Varsayılan Kullanıcı Resmi" title="Varsayılan Kullanıcı Resmi">';
		else $uye_yorum .= '';

		$uye_yorum .= '<div style="height:5px"></div></td><td class="liste-veri" align="left" height="20">
		<div style="position:relative;float:left;height:20px">';

		$uye_yorum .= '<a href="'.linkver('profil.php?u='.$yorumlar['yazan_id'].'&kim='.$yorumlar['yazan'], $yorumlar['yazan']).'">';

		$uye_yorum .= '<b>'.$yorumlar['yazan'].'</b></a>';

		$uye_yorum .= '&nbsp;('.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $yorumlar['tarih']).') &nbsp;&nbsp; </div>';

		$yorum_sil = '<div id="yorumsil'.$yorumlar['id'].'" style="position:relative;float:left;height:18px"><a href="javascript:void(0)"
		onclick="YorumIslem(\'bilesenler/profil2.php?kosul=sil&amp;y='.$yorumlar['id'].'\',\'uye_yorum\',\'yorumsil'.$yorumlar['id'].'\')">Sil</a></div>';


		// yetkiye göre linkler oluşturuluyor - başı //
		if (!isset($kullanici_kim['id']));

		elseif ($kullanici_kim['yetki'] == '0')
		{
			if ($yorumlar['yazan_id'] == $kullanici_kim['id']) $uye_yorum .= $yorum_sil;
			elseif ($resim['yetki'] == '0')
			{
				$yorum_sikayet = '<div id="yorumskyt'.$yorumlar['id'].'" style="position:relative;float:left;height:18px"><a
				href="javascript:void(0)" onclick="YorumIslem(\'bilesenler/profil2.php?kosul=sikayet&amp;y='.$yorumlar['id'].'\',\'yorumskyt'.$yorumlar['id'].'\')">';

				if ($yorumlar['sikayet'] != ''){
					if (preg_match("/$kullanici_kim[id],/i", $yorumlar['sikayet'])) $uye_yorum .= $yorum_sikayet.'Şikayeti Geri Al</a></div>';
					else $uye_yorum .= $yorum_sikayet.'Şikayet Et</a></div>';}
				else $uye_yorum .= $yorum_sikayet.'Şikayet Et</a></div>';
			}
		}

		else
		{
			$uye_yorum .= '<div id="yorumony'.$yorumlar['id'].'" style="position:relative;float:left;width:70px;height:18px"><a href="javascript:void(0)"
			 onclick="YorumIslem(\'bilesenler/profil2.php?kosul=onay&amp;y='.$yorumlar['id'].'\',\'yorumony'.$yorumlar['id'].'\')">';
			if ($yorumlar['onay'] == '1') $uye_yorum .= '<font color="green">Onayını Al</font></a></div>';
			else $uye_yorum .= '<font color="red">Onayla</font></a></div>';

			$uye_yorum .= '<div style="position:relative;float:left;height:18px;width:5px"></div>'.$yorum_sil;
		}
		// yetkiye göre linkler oluşturuluyor - sonu //


		$uye_yorum .= '</td></tr><tr><td class="yorumlar" align="left" valign="bottom">';
		$uye_yorum .= bbcode_acik(ifadeler($yorumlar['yorum_icerik']),0);
		$uye_yorum .= '</td></tr>';

	}


	$sayfano = '4,';
	$sayfano .= $satir['id'];
	$sayfa_adi .= ': '.$satir['kullanici_adi'];
	if (!defined('DOSYA_OTURUM')) include 'oturum.php';


	// Sayfalama Kodları
	$yrmsayfa += $yrmadim;
	$yrmkalan = $yorum_sayi - $yrmsayfa;
	$uye_yorum .= '</td></tr></table>';

	if ($yrmsayfa < $yorum_sayi)
	$uye_yorum .= '<div id="yorum_daha'.$yrmsayfa.'"><div style="height:10px"></div>
	<table cellspacing="0" cellpadding="0" border="0" align="center" class="yorum_daha1">
	<tr><td id="yorum_daha2" align="center" onMouseOver="yorum_daha_uzerine(\'yorum_daha2\',1)"
	onMouseOut="yorum_daha_uzerine(\'yorum_daha2\',2)" onclick="Yolla(\'bilesenler/profil2.php?kosul=yorum&u='.$satir['id'].'&s='.$yrmsayfa.'\',2,\'yorum_daha'.$yrmsayfa.'\')">
	&#9660;&nbsp; Diğer '.$yrmkalan.' yorumu göster &nbsp;&#9660; </td></tr></table><div style="height:10px"></div></div>';

	else
	{
		if ($satir['yrm_sayi']> $yorum_sayi) $uye_yorum .= '<center><br><br>Üyenin henüz onaylanmamış <b>'.($satir['yrm_sayi']-$yorum_sayi).'</b> yorumu daha bulunmaktadır.<br><br></center>';
		else $uye_yorum .= '<div style="height:10px"></div>';
	}

	echo $uye_yorum;
	exit();
	}
}

//   YORUM GÖSTER AJAX - SONU   //





//   YORUM YAZ AJAX - BAŞI   //

elseif ($_GET['kosul'] == 'yorumg')
{
	header("Content-type: text/html; charset=utf-8");

	if (!isset($_POST['kayit_yapildi_mi'])) exit();
	if ($_POST['kayit_yapildi_mi'] != 'form_dolu') exit();
	if ($_POST['yorum'] == '') exit();
	if (strlen($_POST['yorum']) < 3) exit();
	if ($_POST['yorum'] == 'Yorum yaz...') exit();
	if ($_GET['u'] == '') exit();
	if (is_numeric($_GET['u']) == false) exit();
	$_GET['u'] = zkTemizle2($_GET['u']);
	if (!isset($kullanici_kim['id'])) exit();


	// üye yoksa
	if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['ileti_sure']) )
	{
		$cikis = '<font color="#ff0000"><b>Yolladığınız son iletinin üzerinden '.$ayarlar['ileti_sure'].' saniye geçmeden başka bir ileti gönderemezsiniz !</b></font>';
		echo $cikis;
		exit();
	}

	// yorum yazılan üyenin verileri çekiliyor
	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar WHERE id='$_GET[u]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$satir = $vt->fetch_array($vtsonuc);


	// üye yoksa
	if (empty($satir['id']))
	{
		exit();
	}


	if ($kullanici_kim['yetki'] == 0) $onayli = 1;
	else $onayli = 1;


	//	magic_quotes_gpc açıksa	//
	if (get_magic_quotes_gpc()) $_POST['yorum'] = @ileti_yolla(stripslashes($_POST['yorum']),2);

	//	magic_quotes_gpc kapalıysa	//
	else $_POST['yorum'] = @ileti_yolla($_POST['yorum'],2);


	// yorum veritabanına giriliyor
	$vtsorgu = "INSERT INTO $tablo_yorumlar (tarih,uye_adi,uye_id,yazan,yazan_id,yazan_ip,silinmis,onay,yorum_icerik)";
	$vtsorgu .= "VALUES ('$tarih','$satir[kullanici_adi]','$satir[id]','$kullanici_kim[kullanici_adi]','$kullanici_kim[id]','$_SERVER[REMOTE_ADDR]','0','$onayli','$_POST[yorum]')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// Kendine yazmıyorsa bildirim yolla
	if($kullanici_kim['id'] != $satir['id'])
	{
		$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
		$vtsorgu .= "VALUES ('$tarih','$satir[id]','0','2','0','$kullanici_kim[kullanici_adi]')";
		$vtsonuc5 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}


	// üyelerin yorum sayıları arttırılıyor, gönderilen üyeye özel ileti
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_sayi=yrm_sayi+1 where id='$satir[id]' LIMIT 1"; 
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_kullanicilar SET son_ileti='$tarih',yrm_yapilan=yrm_yapilan+1 where id='$kullanici_kim[id]' LIMIT 1"; 
	$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: profil2.php?kosul=yorum&u='.$satir['id']);
	exit();
}

//   YORUM YAZ AJAX - SONU   //






//   YORUM ONAY AJAX - BAŞI   //

elseif ($_GET['kosul'] == 'onay')
{
	if (!isset($_GET['y'])) exit();
	if ($_GET['y'] == '') exit();
	if (is_numeric($_GET['y']) == false) exit();
	$_GET['y'] = zkTemizle2($_GET['y']);
	if (!isset($kullanici_kim['id'])) exit();
	if ($kullanici_kim['yetki'] == '0') exit();


	// yorum veritabanından çekiliyor
	$vtsorgu = "SELECT id,onay FROM $tablo_yorumlar WHERE id='$_GET[y]' AND silinmis=0 LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yorum = $vt->fetch_array($vtsonuc1);


	// yorum yoksa
	if (!isset($yorum['id'])) exit();


	if ($yorum['onay'] == 1)
	{
		$onay = 0;
		echo '<font color="#ff0000">Onayı Alındı</font>';
		$onay2 = 'Onayını aldı';
	}
	else
	{
		$onay = 1;
		echo '<font color="green">Onaylandı</font>';
		$onay2 = 'Onay verdi';
	}


	// yorumun onayı değiştiriliyor
	$vtsorgu = "UPDATE $tablo_yorumlar SET onay='$onay' where id='$_GET[y]'"; 
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	exit();
}

//   YORUM ONAY AJAX - SONU   //






//   YORUM SİLME AJAX - BAŞI   //

elseif ($_GET['kosul'] == 'sil')
{
	if (!isset($_GET['y'])) exit();
	if ($_GET['y'] == '') exit();
	if (is_numeric($_GET['y']) == false) exit();
	$_GET['y'] = zkTemizle2($_GET['y']);
	if (!isset($kullanici_kim['id'])) exit();


	// yorum veritabanından çekiliyor
	$vtsorgu = "SELECT uye_id,yazan_id,silinmis FROM $tablo_yorumlar WHERE id='$_GET[y]' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yorum = $vt->fetch_array($vtsonuc1);


	// yorum yoksa
	if (!isset($yorum['yazan_id'])) exit();


	if (($kullanici_kim['yetki'] == '0') AND ($yorum['yazan_id'] != $kullanici_kim['id']))
	{
		echo '<font color="#ff0000">Yetkisiz</font>';
		exit();
	}


	// yorum siliniyor, geri dönüşüme gidiyor
	$vtsorgu = "UPDATE $tablo_yorumlar SET silinmis='1' where id='$_GET[y]' LIMIT 1"; 
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	// üyelerin yorum sayıları eksiltiliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_sayi=yrm_sayi-1 where id='$yorum[uye_id]' LIMIT 1"; 
	$vtsonuc3 = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$vtsorgu = "UPDATE $tablo_kullanicilar SET yrm_yapilan=yrm_yapilan-1 where id='$yorum[yazan_id]' LIMIT 1"; 
	$vtsonuc4 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	header('Location: profil2.php?kosul=yorum&u='.$yorum['uye_id']);
	exit();
}

//   YORUM SİLME AJAX - SONU   //







//   YORUM ŞİKAYET AJAX - BAŞI   //

elseif ($_GET['kosul'] == 'sikayet')
{
	if (!isset($_GET['y'])) exit();
	if ($_GET['y'] == '') exit();
	if (is_numeric($_GET['y']) == false) exit();
	$_GET['y'] = zkTemizle2($_GET['y']);
	if (!isset($kullanici_kim['id'])) exit();


	// yorum veritabanından çekiliyor
	$vtsorgu = "SELECT id,yazan_id,sikayet FROM $tablo_yorumlar WHERE id='$_GET[y]' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yorum = $vt->fetch_array($vtsonuc1);


	// yorum yoksa
	if (!isset($yorum['id'])) exit();


	// yazan üyenin yetkisi veritabanından çekiliyor
	$vtsorgu = "SELECT id,yetki FROM $tablo_kullanicilar WHERE id='$yorum[yazan_id]' LIMIT 1";
	$vtsonuc1 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yetki = $vt->fetch_array($vtsonuc1);


	// yazan üye yönetici ise yorumu şikayet edilemez
	if ($yetki['yetki'] != '0')
	{
		exit();
	}


	// şikayet etmişse edilmişse geri alınıyor
	if (preg_match("/$kullanici_kim[id],/i", $yorum['sikayet']))
	{
		$islem = '<font color="green">Şikayet Geri Alındı</font>';
		$eksorgu = str_replace("$kullanici_kim[id],", '', $yorum['sikayet']);
	}
	else
	{
		$islem = '<font color="green">Şikayet Edildi</font>';
		$eksorgu = "$yorum[sikayet]$kullanici_kim[id],";
	}


	// şikayet yorum alanına giriliyor
	$vtsorgu = "UPDATE $tablo_yorumlar SET sikayet='$eksorgu' where id='$_GET[y]'"; 
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


	echo $islem;
	exit();
}

//   YORUM ŞİKAYET AJAX - SONU   //

?>