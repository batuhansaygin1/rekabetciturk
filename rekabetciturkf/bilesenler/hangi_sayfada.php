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


function HangiSayfada($sayfano, $baslik)
{
	global $kullanici_kim, $l, $dosya_forum, $dosya_portal, $dosya_index, $dosya_giris, $dosya_cikis, $dosya_kayit, $dosya_uyeler, $dosya_rss, $dosya_cevrimici, $dosya_yardim, $dosya_mobil, $dosya_arama, $dosya_profil;

	switch ($sayfano)
	{
		case -1;
		$sayfa = 'Kullanıcı çıkış yaptı';
		break;

		case 0;
		$sayfa = $baslik;
		break;

		case 1;
		$sayfa = '<a href="'.$forum_index.'">Forum Ana Sayfası</a>';
		break;

		case 2;
		$konuno = explode(',', $sayfano);
		$konu = explode(' : ', $baslik);
		$sayfa = 'Konu: <a href="'.linkver('konu.php?k='.$konuno[1], $konu[0]).'">'.$baslik.'</a>';
		break;

		case 3;
		$forumno = explode(',', $sayfano);
		$forum = explode(' : ', $baslik);
		$sayfa = 'Forum: <a href="'.linkver('forum.php?f='.$forumno[1], $forum[0]).'">'.$baslik.'</a>';
		break;

		case 4;
		$uyeno = explode(',', $sayfano);
		$uyeadi = explode(': ', $baslik);
		if (isset($uyeadi[1])) $sayfa = 'Profil Görüntüleme: <a href="'.linkver('profil.php?u='.$uyeno[1].'&kim='.$uyeadi[1], $uyeadi[1]).'">'.$uyeadi[1].'</a>';
		else $sayfa = '<a href="profil.php?u='.$uyeno[1].'">Profiline Bakıyor</a>';
		break;

		case 5;
		$sayfa = '<a href="'.$dosya_cevrimici.'">Çevrimiçi Sayfası</a>';
		break;

		case 6;
		$sayfa = '<a href="'.$dosya_yardim.'">Yardım Sayfası</a>';
		break;

		case 7;
		$sayfa = '<a href="'.$dosya_uyeler.'">Üyeler Sayfası</a>';
		break;

		case 8;
		$sayfa = '<a href="'.$dosya_giris.'">Giriş Sayfası</a>';
		break;

		case 9;
		$sayfa = '<a href="'.$dosya_kayit.'">Kayıt Sayfası</a>';
		break;

		case 10;
		$sayfa = '<a href="'.$dosya_arama.'">Arama Sayfası</a>';
		break;

		case 11;
		$konuno = explode(',', $sayfano);
		$sayfa = 'Başlık Taşıma: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik).'">'.$baslik.'</a>';
		break;

		case 12;
		$uyeno = explode(': ', $baslik);
		$sayfa = 'E-Posta Gönderme: <a href="'.linkver('profil.php?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 13;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Konu Değiştirme Önizlemesi: ', $baslik);
		$sayfa = 'Konu Değiştirme Önizlemesi: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 14;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Cevap Değiştirme Önizlemesi: ', $baslik);
		$sayfa = 'Cevap Değiştirme Önizlemesi: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'#c'.$konuno[2].'">'.$baslik[1].'</a>';
		break;

		case 15;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Konu Değiştirme: ', $baslik);
		$sayfa = 'Konu Değiştirme: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 16;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Cevap Değiştirme: ', $baslik);
		$sayfa = 'Cevap Değiştirme: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'#c'.$konuno[2].'">'.$baslik[1].'</a>';
		break;

		case 17;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Cevap Yazma Önizlemesi: ', $baslik);
		$sayfa = 'Cevap Yazma Önizlemesi: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 18;
		$forumno = explode(',', $sayfano);
		$baslik = explode('Yeni Konu Oluşturma Önizlemesi: ', $baslik);
		$sayfa = 'Yeni Konu Oluşturma Önizlemesi: <a href="'.linkver('forum.php?f='.$forumno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 19;
		$konuno = explode(',', $sayfano);
		$baslik = explode('Cevap Yazma: ', $baslik);
		$sayfa = 'Cevap Yazma: <a href="'.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 20;
		$forumno = explode(',', $sayfano);
		$baslik = explode('Yeni Konu Oluşturma: ', $baslik);
		$sayfa = 'Yeni Konu Oluşturma: <a href="'.linkver('forum.php?f='.$forumno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 21;
		$sayfa = 'Özel ileti Okuma';
		break;

		case 22;
		$sayfa = 'Özel ileti Önizlemesi';
		break;

		case 23;
		$sayfa = 'Özel ileti Yazma';
		break;

		case 24;
		$sayfa = 'Özel ileti Ayarları';
		break;

		case 25;
		$sayfa = 'Özel iletiler Ulaşan Kutusu';
		break;

		case 26;
		$sayfa = 'Özel iletiler Gönderilen Kutusu';
		break;

		case 27;
		$sayfa = 'Özel iletiler Kaydedilen Kutusu';
		break;

		case 28;
		$sayfa = 'Özel iletiler Gelen Kutusu';
		break;

		case 29;
		$sayfa = 'E-Posta ve Şifre Değiştirme';
		break;

		case 30;
		$sayfa = 'Profil Değiştirme';
		break;

		case 31;
		$sayfa = '<a href="'.$dosya_rss.'">RSS Beslemesi</a>';
		break;

		case 32;
		$forumno = explode(',', $sayfano);
		$baslik = explode('RSS Beklemesi: ', $baslik);
		$sayfa = 'RSS Beslemesi: <a href="'.$dosya_rss.'?f='.$forumno[1].'">'.$baslik[1].'</a>';
		break;

		case 33;
		$sayfa = '<a href="yeni_sifre.php">Yeni Şifre Başvurusu</a>';
		break;

		case 34;
		$sayfa = '<a href="ymesaj.php">Okunmamış iletiler</a>';
		break;

		case 35;
		$sayfa = '<a href="etkinlestir.php">Etkinleştirme Kodu Başvurusu</a>';
		break;

		case 36;
		$sayfa = '<a href="galeri.php">Kullanıcı Resim Galerisi</a>';
		break;

		case 37;
		$uyeno = explode(': ', $baslik);
		$sayfa = 'Üye Konu Arama: <a href="'.linkver('profil.php?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 38;
		$uyeno = explode(': ', $baslik);
		$sayfa = 'Üye Cevap Arama: <a href="'.linkver('profil.php?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 39;
		$sayfa = 'Hata Sayfası';
		break;

		case 40;
		$sayfa = 'Yüklemeler';
		break;

		case 41;
		$sayfa = '<a href="'.$dosya_mobil.'">Mobil Ana Sayfa</a>';
		break;

		case 42;
		$sayfa = '<a href="'.$dosya_uyeler.'?kip=grup">Yetkililer ve Gruplar Sayfası</a>';
		break;

		case 43;
		$sayfa = 'Bildirimler';
		break;

		case 44;
		$tarayici = explode(',', $sayfano);
		if (!isset($tarayici[1])) $tarayici[1] = 0;
		if ($tarayici[1] == 1) $sayfa = '<a target="_blank" href="https://addons.mozilla.org/tr/firefox/addon/phpkf/"><font color="#ff0000">'.$l['phpkf_firefox'].'</font></a>';
		elseif ($tarayici[1] == 2) $sayfa = '<a target="_blank" href="https://chrome.google.com/webstore/detail/phpkf/iafmbjiobknabkmoodgmodpkoefgcgbk?hl=tr"><font color="#ff0000">'.$l['phpkf_chrome'].'</font></a>';
		else $sayfa = '<a target="_blank" href="https://play.google.com/store/apps/details?id=com.phpkf.mobil"><font color="#ff0000">'.$l['phpkf_android'].'</font></a>';
		break;

		case 45;
		$sayfa = 'Takip Edilenler';
		break;

		case 46;
		$sayfa = 'Dosya Yükleme';
		break;

		case 47;
		$forumno = explode(',', $sayfano);
		$sayfa = 'Mobil Konu: <a href="'.$dosya_mobil.'?ak='.$forumno[1].'">'.$baslik.'</a>';
		break;

		case 48;
		$forumno = explode(',', $sayfano);
		$sayfa = 'Mobil Forum: <a href="'.$dosya_mobil.'?af='.$forumno[1].'">'.$baslik.'</a>';
		break;

		case 50;
		if ($kullanici_kim['yetki'] != 1) $sayfa = 'Yönetim Sayfaları';
		else $sayfa = 'Yönetim: '.$baslik;
		break;




		case 201;
		$sayfa = '<a href="'.$portal_index.'">Portal Ana Sayfası</a>';
		break;

		if ($kullanici_kim['yetki'] != 1) $sayfa = 'Yönetim Sayfaları';
		else $sayfa = 'Portal Yönetim: '.$baslik;
		break;


		default:
		$sayfa = $baslik;
	}
	return $sayfa;
}

?>