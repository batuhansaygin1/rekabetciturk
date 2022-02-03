<?php

if (!defined('PHPKF_ICINDEN')) exit();


//  Eklenti Bilgileri  //

$eklenti_bilgi = array(
'ad' => 'Forumdan Konular Blok',
'yapimci' => 'phpKF',
'telif' => 'phpKF',
'adres' => 'https://www.phpkf.com',
'tarih' => '26.09.2016 (01.09.2019)',
'esurum' => '1.1',
'usurum' => '0.650;0.750;1.00;1.10;1.20;3.00',
'tip' => 'Blok',
'aciklama' => 'Forumdan güncel konuları CMS sağ blok içinde sıralar. Ayarlarını <a href="ayarlar.php?kip=eklenti#forum_konular_blok">Kurulu Eklentilerin Ayarları</a> sayfasından değiştirebilirsiniz.
<br>Bu eklenti phpKF Forum 2.0 ve üstü kullananlar içindir.',
'resim_kucuk' => 'onizlemek.png',
'resim_buyuk' => 'onizlemeb.png',
);




//  EKLENTİ KURULUM İŞLEMLERİ - BAŞI  //

if ($eklenti_kurulum):

//  Eklenecek Bloklar  //
$blok_ekle[] = array(
'baslik' => 'Forumdan Konular',
'yer' => '2',
'genislik' => '250px',
'adres' => 'forum_konular_blok.php',
'kod' => '',
);

// Konu sayısı ayarı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '1',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'forum_konular_blok_sayi',
'deger' => '10',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '10',
'bos' => '0',
'diger' => 'maxlength="2" style="width:30px"',
'bilgi' => '10',
'baslik' => 'Gösterilecek konu sayısı',
'aciklama' => 'Son konular bloğunda gösterilecek konu sayısı.',
);

// Yazı başlık karakter sınırlaması
$ayar_ekle[] = array(
'kat' => '',
'sira' => '2',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'forum_konular_blok_baslik',
'deger' => '30',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '30',
'bos' => '0',
'diger' => 'maxlength="3" style="width:30px"',
'bilgi' => '30',
'baslik' => 'Azami başlık karakter sayısı',
'aciklama' => 'Yazı başlığının alabileceği en fazla karakter sayısı. Girilen değerden uzunsa ... şeklinde kısaltılır.',
);

// Konu sıralama ayarı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '3',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'forum_konular_blok_sira',
'deger' => '0',
'form_tip' => 'select',
'secenek' => '0:Yeniden Eksiye|1:Eskiden Yeniye',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Konu Sıralama',
'aciklama' => 'Gösterilecek konuların sıralanma şekli.',
);

endif;

//  EKLENTİ KURULUM İŞLEMLERİ - SONU  //




//  EKLENTİ KALDIRMA İŞLEMLERİ - BAŞI  //

if ($eklenti_kaldirma):

// kaldırılacak ayarlar
$ayar_kaldir = array(
'forum_konular_blok_sayi',
'forum_konular_blok_baslik',
'forum_konular_blok_sira',
);

endif;

//  EKLENTİ KALDIRMA İŞLEMLERİ - SONU  //

?>