<?php

if (!defined('PHPKF_ICINDEN')) exit();


//  EKLENTİ BİLGİLERİ  //

$eklenti_bilgi = array(
'ad' => 'RSS Bot Eklentisi',
'yapimci' => 'phpKF',
'telif' => 'phpKF',
'adres' => 'http://www.phpkf.com',
'tarih' => '14.01.2017 (01.09.2019)',
'esurum' => '1.1',
'usurum' => '0.600;0.650;0.750;1.00;1.10;1.20;3.00',
'tip' => 'Bot',
'aciklama' => 'RSS kaynaklarından aldığı yazıları siteye ekler. İlk olarak <a href="ayarlar.php?kip=eklenti#rss_bot_kaynak"><u>Eklenti ayarları</u></a> sayfasından rss adres ve kategori bilgilerini giriniz. Botu her çalıştırdığınızda yeni yazılar siteye eklenir. Botu çalıştırmak için <a href="../phpkf-bilesenler/eklentiler/rss_bot/rss_bot.php"  target="_blank"><u>tıklayın.</u></a><br>Sunucunuz destekliyorsa cron ile belli aralıklarla botun çalışmasını sağlayabilirsiniz.<br>Cron görevine adres olarak şunu yazın: '.$anadizin.'phpkf-bilesenler/eklentiler/rss_bot/rss_bot.php',
'resim_kucuk' => 'onizleme.png',
'resim_buyuk' => 'onizlemeb.png',
);







//  EKLENTİ KURULUM İŞLEMLERİ - BAŞI  //

if ($eklenti_kurulum):

// RSS Kaynak
$ayar_ekle[] = array(
'kat' => '',
'sira' => '1',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_kaynak',
'deger' => '',
'form_tip' => 'textarea',
'secenek' => '',
'secenek_tip' => 'html',
'varsayilan' => '',
'bos' => '0',
'diger' => '',
'bilgi' => 'http://',
'baslik' => 'RSS Kaynak Adresler',
'aciklama' => 'XML formatta RSS beslemesinin, http:// dahil tam ve yönlendirmesiz adresini giriniz. Her satıra bir adres gelecek şekilde altalta birden fazla adres yazabilirsiniz.',
);

// Resim ekle
$ayar_ekle[] = array(
'kat' => '',
'sira' => '2',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_resim',
'deger' => '0',
'form_tip' => 'radio',
'secenek' => '0:Hayır|1:Evet',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Resim Ekle',
'aciklama' => 'İçerikte resim yoksa, kaynakta ek olarak gelen resmi içeriğe ekle.',
);

// Link ekle
$ayar_ekle[] = array(
'kat' => '',
'sira' => '3',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_link',
'deger' => '0',
'form_tip' => 'radio',
'secenek' => '0:Hayır|1:Evet',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Link Ekle',
'aciklama' => 'İçerikte link yoksa, kaynakta ek olarak gelen linki içeriğe ekle.',
);

// Kategori seçimi
$ayar_ekle[] = array(
'kat' => '',
'sira' => '4',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_kat',
'deger' => '',
'form_tip' => 'select',
'secenek' => '0:- Seçiniz -|{KAT_ID}:{KATEGORILER}',
'secenek_tip' => 'numeric',
'varsayilan' => '',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Yazı kategorisi',
'aciklama' => 'Yazıların girileceği kategori.',
);

// RSS kota
$ayar_ekle[] = array(
'kat' => '',
'sira' => '5',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_kota',
'deger' => '0',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => 'maxlength="2" style="width:30px"',
'bilgi' => '0',
'baslik' => 'RSS Kota:',
'aciklama' => 'RSS kaynağından alınacak yazı sayısı, sınırsız için 0 girin.',
);

// Üye ID
$ayar_ekle[] = array(
'kat' => '',
'sira' => '6',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_uye_id',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '',
'bos' => '0',
'diger' => 'maxlength="11" style="width:140px"',
'bilgi' => 'Yazar üye id numarası',
'baslik' => 'Yazar Üye ID:',
'aciklama' => 'Yazar olarak görünecek üyenin id numarası.',
);

// Üye Adı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '7',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_uye_adi',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'text',
'varsayilan' => '',
'bos' => '0',
'diger' => 'maxlength="100"',
'bilgi' => 'Yazar Üye Adı',
'baslik' => 'Yazar Üye Adı',
'aciklama' => 'Yazar olarak görünecek üyenin üye adı.',
);

// Üye Ad Soyad
$ayar_ekle[] = array(
'kat' => '',
'sira' => '8',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_uye_gercek',
'deger' => '',
'form_tip' => 'text',
'secenek_tip' => 'text',
'varsayilan' => '',
'bos' => '0',
'diger' => 'maxlength="100"',
'bilgi' => 'Yazar Ad Soyad',
'baslik' => 'Yazar Ad Soyad',
'aciklama' => 'Genel Ayarlar sayfasından Yazar Adı: "Gerçek Ad" seçili ise görünür.',
);

// Ek yazı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '9',
'tip' => 'eklenti',
'kip' => '0',
'etiket' => 'rss_bot_ekyazi',
'deger' => '',
'form_tip' => 'textarea',
'secenek' => '',
'secenek_tip' => 'html',
'varsayilan' => '',
'bos' => '1',
'diger' => '',
'bilgi' => 'Ek Yazılar',
'baslik' => 'Ek Yazılar',
'aciklama' => 'Her içeriğin altına eklenecek yazı veya kodları buraya yazabilirsiniz. Boş bırakılabilir.',
);

endif;


//  EKLENTİ KURULUM İŞLEMLERİ - SONU  //



//  EKLENTİ KALDIRMA İŞLEMLERİ - BAŞI  //

if ($eklenti_kaldirma):

// kaldırılacak ayarlar
$ayar_kaldir = array(
'rss_bot_kaynak',
'rss_bot_resim',
'rss_bot_link',
'rss_bot_kat',
'rss_bot_kota',
'rss_bot_uye_id',
'rss_bot_uye_adi',
'rss_bot_uye_gercek',
'rss_bot_ekyazi',
);

endif;

//  EKLENTİ KALDIRMA İŞLEMLERİ - SONU  //

?>