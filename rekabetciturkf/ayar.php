<?php

if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);
if (!defined('DOSYA_AYAR')) define('DOSYA_AYAR',true);

//  PHP hata gösterme ve kayıt ayarları
@error_reporting(E_ALL);
@ini_set('display_errors','off');
@ini_set('log_errors', 1);

//  veritabanı seçimi
$vtsecim = 'mysqli';

//  veritabanı sunucu adresi
$vtadres = 'localhost';

//  veritabanı ismi
$vtisim = 'rekabetciturkf';

//  veritabanı kullanıcı adı
$vtkul = 'root';

//  veritabanı şifresi
$vtsifre = '';

//  tablo öneki
$tablo_oneki = 'phpkf_';

//  kullanıcı şifrelerinin karıştırılacağı anahtar sözcük
$anahtar = '9351890b7bfc4174797bcc41d77c49ce';

//  forum ana sayfasının dosya adi (varsayılan index.php; CMS kullanıyorsanız forum_index.php yapın)
$forum_index = 'index.php';

//  portal ana sayfasının dosya adi (varsayılan portal_index.php)
$portal_index = 'portal_index.php';

//  CMS ana sayfasının dosya adi (varsayılan index.php)
$cms_index = 'index.php';

//  CMS tablo öneki
$cms_tablo_oneki = 'phpkfcms_';

//  CMS dizini
$cms_dizin = '';

//  CMS üyelik sistemi kullanma ayarı
$cms_uyelik = 0;


//  DOSYA İSİMLERİ - BAŞI  //
$dosya_forum = $forum_index;
$dosya_portal = $portal_index;
$dosya_index = 'index.php';
$dosya_giris = 'giris.php';
$dosya_cikis = 'cikis.php';
$dosya_kayit = 'kayit.php';
$dosya_uyeler = 'uyeler.php';
$dosya_rss = 'rss.php';
$dosya_cevrimici = 'cevrimici.php';
$dosya_yardim = 'yardim.php';
$dosya_ozel_ileti = 'ozel_ileti.php';
$dosya_oi_oku = 'oi_oku.php';
$dosya_oi_yaz = 'oi_yaz.php';
$dosya_mobil = 'mobil/index.php';
$dosya_arama = 'arama.php';
$dosya_profil = 'profil.php';
$dosya_profil_degistir = 'profil_degistir.php';
$dosya_sifre_degistir = 'profil_degistir.php?kosul=sifre';
//  DOSYA İSİMLERİ - SONU  //


// veritabanı bağlantısı yapılıyor
include_once('bilesenler/vt_baglanti.php');

//  çerez dizini
$cerez_dizin = $ayarlar['f_dizin'];

?>