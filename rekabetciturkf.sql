-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Şub 2022, 20:55:16
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `rekabetciturkf`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_ayarlar`
--

CREATE TABLE `phpkf_ayarlar` (
  `etiket` varchar(50) NOT NULL,
  `deger` text DEFAULT NULL,
  `kip` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_ayarlar`
--

INSERT INTO `phpkf_ayarlar` (`etiket`, `deger`, `kip`) VALUES
('title', 'Site Adı Title', 1),
('anasyfbaslik', 'Site Adı Ana Sayfa', 1),
('syfbaslik', 'Site Adı Taban Yazı', 1),
('fsyfkota', '20', 1),
('ksyfkota', '8', 1),
('k_cerez_zaman', '604800', 1),
('ileti_sure', '20', 1),
('gelen_kutu_kota', '20', 1),
('ulasan_kutu_kota', '20', 1),
('kaydedilen_kutu_kota', '20', 1),
('bbcode', '1', 1),
('o_ileti', '1', 1),
('tarih_bicimi', 'd.m.Y- H:i', 1),
('y_posta', 'admin@localhost', 1),
('alanadi', 'localhost', 1),
('f_dizin', '/rekabetciturkf', 1),
('eposta_yontem', 'mail', 1),
('smtp_kd', 'true', 1),
('smtp_sunucu', '', 1),
('smtp_kullanici', '', 1),
('smtp_sifre', '', 1),
('smtp_port', '587', 1),
('saat_dilimi', '3', 1),
('kilit_sure', '1800', 1),
('imza_uzunluk', '500', 1),
('uzak_resim', '0', 1),
('resim_yukle', '1', 1),
('resim_boyut', '512000', 1),
('resim_genislik', '147', 1),
('resim_yukseklik', '143', 1),
('resim_galerisi', '1', 1),
('kayit_cevabi', 'Ankara', 1),
('kayit_soru', '0', 1),
('kayit_sorusu', 'Türkiye`nin başkenti neresidir?', 1),
('hesap_etkin', '1', 1),
('forum_rengi', 'mavi', 1),
('seo', '0', 1),
('meta_diger', '<meta name=\"rating\" content=\"All\" />\n<meta name=\"robots\" content=\"index, follow\" />', 1),
('site_taban_kod', '', 1),
('kurucu', 'Kurucu', 1),
('yonetici', 'Yönetici', 1),
('yardimci', 'Yardımcı', 1),
('blm_yrd', 'Blm Yrd', 1),
('kullanici', 'Üye', 1),
('surum', '2.20', 1),
('sonkonular', '1', 1),
('kacsonkonu', '10', 1),
('temadizini', 'varsayilan', 1),
('tema_secenek', 'varsayilan,', 1),
('cevrimici', '1800', 1),
('forum_durumu', '1', 1),
('portal_kullan', '0', 1),
('onay_kodu', '1', 1),
('kul_resim', 'dosyalar/resimler/varsayilan_resim.jpg', 1),
('boyutlandirma', '0', 1),
('duyuru_tarihi', '1643849421', 1),
('bolum_kisi', '1', 1),
('konu_kisi', '1', 1),
('uye_kayit', '1', 1),
('oi_uyari', '0', 1),
('vt_hata', '2', 1),
('duzenleyici', 'varsayilan', 1),
('dduzenleyici', 'varsayilan', 1),
('yduzenleyici', 'duz', 1),
('duzenleyici_secenek', 'duz,varsayilan,tinymce,ckeditor,sceditor', 1),
('tema_genislik', '95%', 1),
('tema_logo_ust', 'Üst Logo', 1),
('tema_logo_alt', 'Alt Logo', 1),
('cms_kullan', '0', 1),
('cms_icinden', '0', 1),
('yukleme_dosya', 'zip,rar,tar.gz,tar,gz,jpg,jpeg,gif,png,bmp,ico,wav,mp3,mp4,ogg,ogv,oga,webm,flv,swf,mpeg,mpg,mp2,wmv,mkv,avi,mov,3gp,', 1),
('yukleme_dizin', 'dosyalar/yuklemeler', 1),
('yukleme_boyut', '10485760', 1),
('yukleme_genislik', '2000', 1),
('yukleme_yukseklik', '2000', 1),
('site_acilis', '1643632152', 1),
('dil_varsayilan', 'tr', 1),
('dil_eklenen', ',en,', 1),
('dil_eklenen_alanlar', ',en,', 1),
('durum_sayfalar', '1', 1),
('dizin_kat', 'kategoriler', 1),
('dizin_sayfa', 'sayfalar', 1),
('dizin_galeri', 'galeriler', 1),
('dizin_video', 'videolar', 1),
('dizin_etiket', 'etiket', 1),
('dizin_arama', 'arama', 1),
('duzenleyici_font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', 1),
('duzenleyici_html_tema', 'varsayilan', 1),
('duzenleyici_bbcode_tema', 'varsayilan', 1),
('duzenleyici_hizli_tema', 'modern_acik_kucuk', 1),
('dugme_kodlar', '', 1),
('dugme_stil', '', 1),
('dugme_html', 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih | youtube video audio | postimage yukleme | geri ileri', 1),
('dugme_bbcode', 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih | youtube video audio | postimage yukleme | geri ileri', 1),
('dugme_hizli', 'kalin alticizgili yatik ustucizgili | renk artalan kaldir | sol orta sag | adres adresk resim eposta | alinti kod | youtube postimage yukleme', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_baglantilar`
--

CREATE TABLE `phpkf_baglantilar` (
  `id` int(11) UNSIGNED NOT NULL,
  `yer` tinyint(1) NOT NULL DEFAULT 1,
  `sayfa` int(11) UNSIGNED NOT NULL,
  `alt_menu` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sistem` tinyint(1) NOT NULL DEFAULT 0,
  `sira` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `ad` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `bilgi` varchar(255) NOT NULL,
  `ad_en` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_baglantilar`
--

INSERT INTO `phpkf_baglantilar` (`id`, `yer`, `sayfa`, `alt_menu`, `sistem`, `sira`, `ad`, `adres`, `bilgi`, `ad_en`) VALUES
(1, 1, 0, 0, 1, 10, 'giris-cikis', '', '', NULL),
(2, 1, 0, 0, 1, 9, 'kayit', '', '', NULL),
(3, 1, 0, 0, 1, 1, 'anasayfa', '', '', NULL),
(4, 0, 0, 0, 1, 1, 'kategoriler', '', '', NULL),
(5, 0, 0, 0, 1, 2, 'sayfalar', '', '', NULL),
(6, 0, 0, 0, 1, 3, 'galeriler', '', '', NULL),
(7, 0, 0, 0, 1, 4, 'videolar', '', '', NULL),
(8, 1, 0, 0, 1, 5, 'uyeler', '', '', NULL),
(9, 1, 0, 0, 1, 6, 'cevrimici', '', '', NULL),
(10, 0, 0, 0, 1, 5, 'iletisim', '', '', NULL),
(11, 0, 0, 0, 1, 6, 'etiket', '', '', NULL),
(12, 1, 0, 0, 1, 7, 'arama', '', '', NULL),
(13, 1, 0, 0, 1, 2, 'forum', '', '', NULL),
(14, 1, 0, 0, 1, 3, 'portal', '', '', NULL),
(15, 1, 0, 0, 1, 8, 'profil', '', '', NULL),
(16, 1, 0, 15, 1, 1, 'duzenle', '', '', NULL),
(17, 1, 0, 15, 1, 2, 'sifre', '', '', NULL),
(18, 1, 0, 15, 1, 3, 'ozel', '', '', NULL),
(19, 1, 0, 15, 1, 4, 'yonetim', '', '', NULL),
(20, 1, 0, 0, 1, 4, 'yardim', '', '', NULL),
(21, 2, 0, 0, 1, 8, 'giris-cikis', '', '', NULL),
(22, 2, 0, 0, 1, 7, 'kayit', '', '', NULL),
(23, 2, 0, 0, 1, 1, 'anasayfa', '', '', NULL),
(24, 2, 0, 0, 1, 2, 'kategoriler', '', '', NULL),
(25, 2, 0, 0, 1, 3, 'sayfalar', '', '', NULL),
(26, 2, 0, 0, 1, 4, 'uyeler', '', '', NULL),
(27, 2, 0, 0, 1, 5, 'cevrimici', '', '', NULL),
(28, 2, 0, 0, 1, 7, 'iletisim', '', '', NULL),
(29, 2, 0, 0, 1, 1, 'forum', '', '', NULL),
(30, 2, 0, 0, 1, 1, 'portal', '', '', NULL),
(31, 3, 0, 0, 1, 8, 'giris-cikis', '', '', NULL),
(32, 3, 0, 0, 1, 9, 'kayit', '', '', NULL),
(33, 3, 0, 0, 1, 1, 'anasayfa', '', '', NULL),
(34, 3, 0, 0, 1, 5, 'uyeler', '', '', NULL),
(35, 3, 0, 0, 1, 6, 'cevrimici', '', '', NULL),
(36, 0, 0, 0, 1, 7, 'iletisim', '', '', NULL),
(37, 3, 0, 0, 1, 7, 'arama', '', '', NULL),
(38, 3, 0, 0, 1, 2, 'mobil', '', '', NULL),
(39, 3, 0, 0, 1, 3, 'rss', '', '', NULL),
(40, 3, 0, 0, 1, 4, 'yardim', '', '', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_begeniler`
--

CREATE TABLE `phpkf_begeniler` (
  `uye_id` mediumint(8) UNSIGNED NOT NULL,
  `puan` tinyint(1) NOT NULL,
  `yazi_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_bildirimler`
--

CREATE TABLE `phpkf_bildirimler` (
  `id` int(11) UNSIGNED NOT NULL,
  `tarih` int(11) UNSIGNED NOT NULL,
  `uye_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `seviye` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `tip` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `okundu` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `bildirim` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_cevaplar`
--

CREATE TABLE `phpkf_cevaplar` (
  `id` int(10) UNSIGNED NOT NULL,
  `tarih` int(11) UNSIGNED NOT NULL,
  `cevap_baslik` varchar(255) NOT NULL DEFAULT '',
  `cevap_icerik` text NOT NULL,
  `cevap_yazan` varchar(20) NOT NULL,
  `hangi_basliktan` mediumint(8) UNSIGNED NOT NULL,
  `degistirme_tarihi` int(11) UNSIGNED DEFAULT NULL,
  `degistirme_sayisi` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `degistiren` varchar(20) DEFAULT NULL,
  `hangi_forumdan` smallint(5) UNSIGNED NOT NULL,
  `yazan_ip` varchar(39) DEFAULT NULL,
  `degistiren_ip` varchar(39) DEFAULT NULL,
  `bbcode_kullan` tinyint(1) NOT NULL DEFAULT 0,
  `silinmis` tinyint(1) NOT NULL DEFAULT 0,
  `ifade` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_cevaplar`
--

INSERT INTO `phpkf_cevaplar` (`id`, `tarih`, `cevap_baslik`, `cevap_icerik`, `cevap_yazan`, `hangi_basliktan`, `degistirme_tarihi`, `degistirme_sayisi`, `degistiren`, `hangi_forumdan`, `yazan_ip`, `degistiren_ip`, `bbcode_kullan`, `silinmis`, `ifade`) VALUES
(1, 1643728790, 'Cvp:', 'deneme ileti', 'Kurucu', 1, NULL, 0, NULL, 1, '::1', NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_dallar`
--

CREATE TABLE `phpkf_dallar` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `ana_forum_baslik` text NOT NULL,
  `sira` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_dallar`
--

INSERT INTO `phpkf_dallar` (`id`, `ana_forum_baslik`, `sira`) VALUES
(1, 'Deneme Forum Dalı 1', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_duyurular`
--

CREATE TABLE `phpkf_duyurular` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `fno` varchar(5) DEFAULT NULL,
  `duyuru_baslik` varchar(255) NOT NULL DEFAULT '',
  `duyuru_icerik` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_duyurular`
--

INSERT INTO `phpkf_duyurular` (`id`, `fno`, `duyuru_baslik`, `duyuru_icerik`) VALUES
(1, 'tum', 'php Kolay Foruma Hoş Geldiniz !', '<center><b>Kurulumunuz başarıyla tamamlanmıştır.</b><p>Yönetici olarak giriş yaptığınızda üst menüde görünen <a href=\"yonetim/index.php\">Yönetim</a> bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.</center>');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_eklentiler`
--

CREATE TABLE `phpkf_eklentiler` (
  `ad` varchar(40) NOT NULL,
  `kur` tinyint(1) UNSIGNED NOT NULL,
  `etkin` tinyint(1) UNSIGNED NOT NULL,
  `vt` tinyint(1) UNSIGNED NOT NULL,
  `dosya` tinyint(1) UNSIGNED NOT NULL,
  `dizin` tinyint(1) UNSIGNED NOT NULL,
  `sistem` tinyint(1) UNSIGNED NOT NULL,
  `usurum` varchar(5) NOT NULL,
  `esurum` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_eklentiler`
--

INSERT INTO `phpkf_eklentiler` (`ad`, `kur`, `etkin`, `vt`, `dosya`, `dizin`, `sistem`, `usurum`, `esurum`) VALUES
('24saat_cevrimici_uyeler', 1, 2, 0, 0, 0, 1, '2.10', '1.1'),
('begeni_sistemi', 1, 2, 1, 0, 0, 1, '2.10', '1.1'),
('benzer_konular', 1, 1, 1, 0, 0, 1, '2.10', '1.2'),
('resim_kucultme', 1, 2, 0, 0, 0, 1, '2.10', '1.0'),
('rutberesimleri', 1, 2, 0, 0, 0, 1, '2.10', '1.3'),
('yetkiler_yardimcilar', 1, 1, 0, 0, 0, 1, '2.10', '1.1'),
('tesekkur', 1, 2, 1, 0, 0, 1, '2.10', '1.4');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_forumlar`
--

CREATE TABLE `phpkf_forumlar` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `dal_no` smallint(5) UNSIGNED NOT NULL,
  `forum_baslik` text NOT NULL,
  `forum_bilgi` text NOT NULL,
  `sira` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `okuma_izni` tinyint(1) NOT NULL DEFAULT 0,
  `yazma_izni` tinyint(1) NOT NULL DEFAULT 0,
  `resim` varchar(100) DEFAULT NULL,
  `konu_acma_izni` tinyint(1) NOT NULL DEFAULT 0,
  `konu_sayisi` mediumint(8) UNSIGNED DEFAULT 0,
  `cevap_sayisi` int(10) UNSIGNED DEFAULT 0,
  `alt_forum` smallint(5) UNSIGNED DEFAULT 0,
  `gizle` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_forumlar`
--

INSERT INTO `phpkf_forumlar` (`id`, `dal_no`, `forum_baslik`, `forum_bilgi`, `sira`, `okuma_izni`, `yazma_izni`, `resim`, `konu_acma_izni`, `konu_sayisi`, `cevap_sayisi`, `alt_forum`, `gizle`) VALUES
(1, 1, 'Deneme Forumu 1', 'Bu forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 1, 1, 0, 0),
(2, 1, 'Deneme Alt Forumu', 'Bu alt forum deneme amaçlı açılmıştır.', 1, 0, 0, '', 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_gruplar`
--

CREATE TABLE `phpkf_gruplar` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `grup_adi` varchar(30) NOT NULL,
  `sira` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `gizle` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `yetki` tinyint(1) NOT NULL DEFAULT -1,
  `ozel_ad` varchar(30) DEFAULT NULL,
  `uyeler` text DEFAULT NULL,
  `grup_bilgi` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_gruplar`
--

INSERT INTO `phpkf_gruplar` (`id`, `grup_adi`, `sira`, `gizle`, `yetki`, `ozel_ad`, `uyeler`, `grup_bilgi`) VALUES
(1, 'Yönetici', 1, 0, 1, '', '', ''),
(2, 'Yetkili', 2, 0, 2, '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_kullanicilar`
--

CREATE TABLE `phpkf_kullanicilar` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `kullanici_kimlik` varchar(40) DEFAULT NULL,
  `kullanici_adi` varchar(20) NOT NULL,
  `sifre` varchar(40) NOT NULL,
  `posta` varchar(100) NOT NULL,
  `web` varchar(100) DEFAULT NULL,
  `gercek_ad` varchar(100) NOT NULL,
  `dogum_tarihi` varchar(10) NOT NULL,
  `katilim_tarihi` int(11) UNSIGNED NOT NULL,
  `sehir` varchar(30) NOT NULL,
  `mesaj_sayisi` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `yonetim_kimlik` varchar(40) DEFAULT NULL,
  `resim` varchar(100) DEFAULT NULL,
  `imza` text DEFAULT NULL,
  `posta_goster` tinyint(1) NOT NULL DEFAULT 1,
  `dogum_tarihi_goster` tinyint(1) NOT NULL DEFAULT 1,
  `sehir_goster` tinyint(1) NOT NULL DEFAULT 1,
  `okunmamis_oi` smallint(3) UNSIGNED NOT NULL DEFAULT 0,
  `son_ileti` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `kul_etkin` tinyint(1) NOT NULL DEFAULT 0,
  `kul_etkin_kod` varchar(10) NOT NULL DEFAULT '0',
  `engelle` tinyint(1) NOT NULL DEFAULT 0,
  `yeni_sifre` mediumint(7) UNSIGNED NOT NULL DEFAULT 0,
  `yetki` tinyint(1) NOT NULL DEFAULT 0,
  `kilit_tarihi` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `giris_denemesi` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `son_giris` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `son_hareket` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `hangi_sayfada` varchar(120) DEFAULT NULL,
  `kul_ip` varchar(39) DEFAULT NULL,
  `gizli` tinyint(1) NOT NULL DEFAULT 0,
  `icq` varchar(30) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `yahoo` varchar(100) DEFAULT NULL,
  `aim` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `temadizini` varchar(25) DEFAULT NULL,
  `temadizinip` varchar(25) DEFAULT NULL,
  `ozel_ad` varchar(30) DEFAULT NULL,
  `posta2` varchar(100) DEFAULT NULL,
  `sayfano` varchar(25) DEFAULT '0',
  `grupid` smallint(5) UNSIGNED DEFAULT 0,
  `cinsiyet` tinyint(1) NOT NULL DEFAULT 0,
  `hakkinda` text DEFAULT NULL,
  `takip` text DEFAULT NULL,
  `yrm_sayi` mediumint(6) UNSIGNED NOT NULL DEFAULT 0,
  `yrm_yapilan` mediumint(6) UNSIGNED NOT NULL DEFAULT 0,
  `tsk_etti` int(8) NOT NULL DEFAULT 0,
  `tsk_edildi` int(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_kullanicilar`
--

INSERT INTO `phpkf_kullanicilar` (`id`, `kullanici_kimlik`, `kullanici_adi`, `sifre`, `posta`, `web`, `gercek_ad`, `dogum_tarihi`, `katilim_tarihi`, `sehir`, `mesaj_sayisi`, `yonetim_kimlik`, `resim`, `imza`, `posta_goster`, `dogum_tarihi_goster`, `sehir_goster`, `okunmamis_oi`, `son_ileti`, `kul_etkin`, `kul_etkin_kod`, `engelle`, `yeni_sifre`, `yetki`, `kilit_tarihi`, `giris_denemesi`, `son_giris`, `son_hareket`, `hangi_sayfada`, `kul_ip`, `gizli`, `icq`, `msn`, `yahoo`, `aim`, `skype`, `temadizini`, `temadizinip`, `ozel_ad`, `posta2`, `sayfano`, `grupid`, `cinsiyet`, `hakkinda`, `takip`, `yrm_sayi`, `yrm_yapilan`, `tsk_etti`, `tsk_edildi`) VALUES
(1, '9be1cc92f7915b7f16eb4cb92a86cfc1b0ce5dba', 'Kurucu', '80cbbfc5c49c0a0369287ef92973c7f7248587d6', 'admin@localhost', 'http://localhost', 'Kurucu', '00-00-0000', 1643632152, '', 2, 'aa6e1c726265314cb3dfccf4e65074cde030c088', '', '', 1, 0, 0, 0, 1643728790, 1, '0', 0, 0, 1, 0, 0, 1643871395, 1643877858, 'php Kolay Foruma Hoş Geldiniz', '::1', 0, '', '', '', '', '', '', '', '', '', '2,1,3,1', 0, 0, '', '', 0, 0, 0, 0),
(2, '', 'deneme123', '80cbbfc5c49c0a0369287ef92973c7f7248587d6', 'ads@asd.asd', NULL, 'deneme123', '00-00-0000', 1643778904, '', 1, '', NULL, NULL, 1, 0, 0, 0, 1643779329, 1, '0', 0, 0, 0, 0, 0, 1643778904, 1643779390, 'Kullanıcı çıkış yaptı', '::1', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '-1', 0, 0, NULL, NULL, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_mesajlar`
--

CREATE TABLE `phpkf_mesajlar` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `tarih` int(11) UNSIGNED NOT NULL,
  `mesaj_baslik` varchar(255) NOT NULL DEFAULT '',
  `mesaj_icerik` text NOT NULL,
  `yazan` varchar(20) NOT NULL,
  `degistirme_tarihi` int(11) UNSIGNED DEFAULT NULL,
  `hangi_forumdan` smallint(5) UNSIGNED NOT NULL,
  `goruntuleme` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `cevap_sayi` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `son_mesaj_tarihi` int(11) UNSIGNED DEFAULT NULL,
  `degistirme_sayisi` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `degistiren` varchar(20) DEFAULT NULL,
  `yazan_ip` varchar(39) DEFAULT NULL,
  `degistiren_ip` varchar(39) DEFAULT NULL,
  `bbcode_kullan` tinyint(1) NOT NULL DEFAULT 0,
  `ust_konu` tinyint(1) NOT NULL DEFAULT 0,
  `kilitli` tinyint(1) NOT NULL DEFAULT 0,
  `silinmis` tinyint(1) NOT NULL DEFAULT 0,
  `ifade` tinyint(1) NOT NULL DEFAULT 1,
  `son_cevap` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `son_cevap_yazan` varchar(20) DEFAULT NULL,
  `begenenler` int(9) NOT NULL,
  `begenmeyenler` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_mesajlar`
--

INSERT INTO `phpkf_mesajlar` (`id`, `tarih`, `mesaj_baslik`, `mesaj_icerik`, `yazan`, `degistirme_tarihi`, `hangi_forumdan`, `goruntuleme`, `cevap_sayi`, `son_mesaj_tarihi`, `degistirme_sayisi`, `degistiren`, `yazan_ip`, `degistiren_ip`, `bbcode_kullan`, `ust_konu`, `kilitli`, `silinmis`, `ifade`, `son_cevap`, `son_cevap_yazan`, `begenenler`, `begenmeyenler`) VALUES
(1, 1643632152, 'php Kolay Foruma Hoş Geldiniz', '[quote=\"phpKF\"]php Kolay Forum kurulumunuz başarıyla tamamlanmıştır...[/quote]\nYönetici olarak giriş yaptığınızda en üstte görünen  [url=yonetim/index.php]Yönetim[/url]   bağlantısını tıklayarak, yönetimle ilgili işlemlere ulaşabilirsiniz.', 'Kurucu', NULL, 1, 313, 1, 1643728790, 0, NULL, NULL, '', 1, 0, 0, 0, 0, 1, 'Kurucu', 0, 0),
(2, 1643779329, 'deneme213123', '(h)Denemedir.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse hendrerit mattis volutpat. Etiam eget vulputate ante. Nullam sollicitudin pretium aliquam. Phasellus tristique purus et sapien blandit, nec varius nisl faucibus. [sub]Ut quis eros semper, accumsan purus vel, pellentesque nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean tristique metus sed semper pharetra.[/sub]Nulla tempus tempor ipsum, [sup]ullamcorper [/sup]dignissim mi varius a. Mauris faucibus posuere velit sed dictum. Integer a est rhoncus, tincidunt purus non, consequat velit. Donec laoreet sapien enim, eu sagittis nibh cursus fermentum. Integer venenatis, leo eget ullamcorper consectetur, nulla tortor congue mi, pharetra luctus magna nunc vel nibh. [u]Mauris vel convallis nisl, at bibendum orci. Nulla lectus arcu, sodales quis arcu pharetra, porttitor aliquam risus. Aliquam porta lacinia dolor ac mollis. Praesent molestie sem sit amet leo malesuada porttitor.[/u][b]Sed iaculis ultrices tempus. Sed aliquam ut eros sit amet tincidunt. Etiam ultricies eros id lobortis pretium. Sed vehicula molestie viverra. Aliquam vestibulum elementum magna sed cursus. Sed erat lectus, gravida vitae varius sit amet, convallis facilisis odio. Ut scelerisque a lectus non volutpat.[/b]Aenean sagittis et leo mattis rutrum. Donec fermentum fringilla nibh, at dignissim nisl posuere vitae. Sed erat eros, congue ut nisl vitae, aliquam lobortis nulla. Etiam at dictum massa. Nullam rutrum a nulla eget convallis. Curabitur varius dui quis diam faucibus aliquet. Nulla rhoncus maximus lobortis. Sed eget orci interdum, ullamcorper risus non, pharetra ipsum. Sed efficitur velit eget ligula ullamcorper egestas. Aliquam eget metus mauris. Pellentesque efficitur convallis eros in rutrum. Praesent sed luctus tellus. Vivamus volutpat vestibulum viverra. Quisque et metus aliquam, vestibulum arcu vitae, ullamcorper ipsum. Nullam vitae nisl at enim ornare commodo a dignissim sapien.[ center; margin: 0px 0px 15px; padding: 0px]Donec lectus odio, fermentum egestas rutrum vel, elementum eget ipsum. Curabitur iaculis quam ante, non tristique libero viverra quis. Fusce faucibus libero neque. Vestibulum varius arcu et neque faucibus lobortis. Proin pellentesque sodales leo, eget tristique purus condimentum at. Aenean condimentum mi ligula, eleifend gravida mi pharetra euismod. Mauris est ante, laoreet id mi vitae, pellentesque ullamcorper elit. In viverra risus nunc, quis cursus sem posuere sit amet.[/ center; margin: 0px 0px 15px; padding: 0px][ center; margin: 0px 0px 15px; padding: 0px]\r\n[/ center; margin: 0px 0px 15px; padding: 0px]Aenean sagittis et leo mattis rutrum. Donec fermentum fringilla nibh, at dignissim nisl posuere vitae. Sed erat eros, congue ut nisl vitae, aliquam lobortis nulla. Etiam at dictum massa. Nullam rutrum a nulla eget convallis. Curabitur varius dui quis diam faucibus aliquet. Nulla rhoncus maximus lobortis. Sed eget orci interdum, ullamcorper risus non, pharetra ipsum. Sed efficitur velit eget ligula ullamcorper egestas. Aliquam eget metus mauris. Pellentesque efficitur convallis eros in rutrum. Praesent sed luctus tellus. Vivamus volutpat vestibulum viverra. Quisque et metus aliquam, vestibulum arcu vitae, ullamcorper ipsum. Nullam vitae nisl at enim ornare commodo a dignissim sapien.\r\n[/quote]\r\n:i:-a:g\r\n', 'deneme123', NULL, 2, 13, 0, 1643779329, 0, NULL, '::1', NULL, 1, 0, 0, 0, 1, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_oturumlar`
--

CREATE TABLE `phpkf_oturumlar` (
  `sid` varchar(32) NOT NULL,
  `giris` int(11) UNSIGNED NOT NULL,
  `son_hareket` int(11) UNSIGNED NOT NULL,
  `hangi_sayfada` varchar(120) NOT NULL,
  `kul_ip` varchar(39) NOT NULL,
  `sayfano` varchar(25) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_oturumlar`
--

INSERT INTO `phpkf_oturumlar` (`sid`, `giris`, `son_hareket`, `hangi_sayfada`, `kul_ip`, `sayfano`) VALUES
('700fcc64e424d66fd681ad15a280b496', 1643879001, 1643879003, 'php Kolay Foruma Hoş Geldiniz', '::1', '2,1,3,1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_ozel_ileti`
--

CREATE TABLE `phpkf_ozel_ileti` (
  `id` int(10) UNSIGNED NOT NULL,
  `kimden` varchar(20) NOT NULL,
  `kime` varchar(20) NOT NULL,
  `ozel_baslik` varchar(255) NOT NULL DEFAULT '',
  `ozel_icerik` text NOT NULL,
  `gonderme_tarihi` int(11) UNSIGNED NOT NULL,
  `okunma_tarihi` int(11) UNSIGNED DEFAULT NULL,
  `gonderen_kutu` tinyint(1) NOT NULL DEFAULT 0,
  `alan_kutu` tinyint(1) NOT NULL DEFAULT 0,
  `bbcode_kullan` tinyint(1) NOT NULL DEFAULT 0,
  `ifade` tinyint(1) NOT NULL DEFAULT 1,
  `cevap_sayi` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `cevap` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_ozel_izinler`
--

CREATE TABLE `phpkf_ozel_izinler` (
  `kulad` varchar(30) NOT NULL,
  `kulid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `grup` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `fno` smallint(5) UNSIGNED NOT NULL,
  `okuma` tinyint(1) NOT NULL DEFAULT 0,
  `yazma` tinyint(1) NOT NULL DEFAULT 0,
  `yonetme` tinyint(1) NOT NULL DEFAULT 0,
  `konu_acma` tinyint(1) NOT NULL DEFAULT 0,
  `cevap_sayi` tinyint(3) UNSIGNED DEFAULT 0,
  `cevap` int(10) UNSIGNED DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_tesekkur`
--

CREATE TABLE `phpkf_tesekkur` (
  `id` mediumint(8) NOT NULL,
  `eden` varchar(20) NOT NULL DEFAULT '',
  `edilen` varchar(20) NOT NULL DEFAULT '',
  `tarih` int(11) NOT NULL DEFAULT 0,
  `konu_no` mediumint(8) NOT NULL DEFAULT 0,
  `cevap_no` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_yasaklar`
--

CREATE TABLE `phpkf_yasaklar` (
  `etiket` varchar(30) NOT NULL,
  `deger` text DEFAULT NULL,
  `tip` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `phpkf_yasaklar`
--

INSERT INTO `phpkf_yasaklar` (`etiket`, `deger`, `tip`) VALUES
('kulad', '', 0),
('adsoyad', '', 0),
('posta', '', 0),
('sozcukler', '', 0),
('cumle', '', 0),
('yasak_ip', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_yorumlar`
--

CREATE TABLE `phpkf_yorumlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `tarih` int(11) UNSIGNED NOT NULL,
  `uye_adi` varchar(20) NOT NULL,
  `uye_id` mediumint(8) UNSIGNED NOT NULL,
  `yazan` varchar(20) NOT NULL,
  `yazan_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `yazan_ip` varchar(39) DEFAULT NULL,
  `silinmis` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `onay` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sikayet` text DEFAULT NULL,
  `yorum_icerik` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `phpkf_yuklemeler`
--

CREATE TABLE `phpkf_yuklemeler` (
  `id` int(8) UNSIGNED NOT NULL,
  `tarih` int(11) NOT NULL DEFAULT 0,
  `boyut` int(7) UNSIGNED DEFAULT 0,
  `ip` varchar(15) DEFAULT NULL,
  `uye_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `uye_adi` varchar(20) NOT NULL DEFAULT '',
  `dosya` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `phpkf_ayarlar`
--
ALTER TABLE `phpkf_ayarlar`
  ADD PRIMARY KEY (`etiket`),
  ADD KEY `kip` (`kip`);

--
-- Tablo için indeksler `phpkf_baglantilar`
--
ALTER TABLE `phpkf_baglantilar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alt_menu` (`alt_menu`);

--
-- Tablo için indeksler `phpkf_bildirimler`
--
ALTER TABLE `phpkf_bildirimler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uye_id` (`uye_id`);

--
-- Tablo için indeksler `phpkf_cevaplar`
--
ALTER TABLE `phpkf_cevaplar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cevap_yazan` (`cevap_yazan`),
  ADD KEY `hangi_basliktan` (`hangi_basliktan`),
  ADD KEY `hangi_forumdan` (`hangi_forumdan`),
  ADD KEY `tarih` (`tarih`);

--
-- Tablo için indeksler `phpkf_dallar`
--
ALTER TABLE `phpkf_dallar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sira` (`sira`);

--
-- Tablo için indeksler `phpkf_duyurular`
--
ALTER TABLE `phpkf_duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `phpkf_eklentiler`
--
ALTER TABLE `phpkf_eklentiler`
  ADD PRIMARY KEY (`ad`);

--
-- Tablo için indeksler `phpkf_forumlar`
--
ALTER TABLE `phpkf_forumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dal_no` (`dal_no`),
  ADD KEY `sira` (`sira`),
  ADD KEY `alt_forum` (`alt_forum`);

--
-- Tablo için indeksler `phpkf_gruplar`
--
ALTER TABLE `phpkf_gruplar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_adi` (`grup_adi`);

--
-- Tablo için indeksler `phpkf_kullanicilar`
--
ALTER TABLE `phpkf_kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kullanici_adi` (`kullanici_adi`),
  ADD KEY `posta` (`posta`),
  ADD KEY `katilim_tarihi` (`katilim_tarihi`),
  ADD KEY `kul_etkin` (`kul_etkin`),
  ADD KEY `engelle` (`engelle`);

--
-- Tablo için indeksler `phpkf_mesajlar`
--
ALTER TABLE `phpkf_mesajlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarih` (`tarih`),
  ADD KEY `yazan` (`yazan`),
  ADD KEY `hangi_forumdan` (`hangi_forumdan`),
  ADD KEY `cevap_sayi` (`cevap_sayi`),
  ADD KEY `son_mesaj_tarihi` (`son_mesaj_tarihi`);
ALTER TABLE `phpkf_mesajlar` ADD FULLTEXT KEY `mesaj_baslik` (`mesaj_baslik`);

--
-- Tablo için indeksler `phpkf_oturumlar`
--
ALTER TABLE `phpkf_oturumlar`
  ADD KEY `sid` (`sid`);

--
-- Tablo için indeksler `phpkf_ozel_ileti`
--
ALTER TABLE `phpkf_ozel_ileti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kimden` (`kimden`),
  ADD KEY `kime` (`kime`),
  ADD KEY `gonderme_tarihi` (`gonderme_tarihi`);

--
-- Tablo için indeksler `phpkf_ozel_izinler`
--
ALTER TABLE `phpkf_ozel_izinler`
  ADD KEY `kulid` (`kulid`),
  ADD KEY `kulad` (`kulad`),
  ADD KEY `fno` (`fno`),
  ADD KEY `grup` (`grup`);

--
-- Tablo için indeksler `phpkf_tesekkur`
--
ALTER TABLE `phpkf_tesekkur`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `phpkf_yasaklar`
--
ALTER TABLE `phpkf_yasaklar`
  ADD PRIMARY KEY (`etiket`);

--
-- Tablo için indeksler `phpkf_yorumlar`
--
ALTER TABLE `phpkf_yorumlar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uye_id` (`uye_id`),
  ADD KEY `tarih` (`tarih`);

--
-- Tablo için indeksler `phpkf_yuklemeler`
--
ALTER TABLE `phpkf_yuklemeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_baglantilar`
--
ALTER TABLE `phpkf_baglantilar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_bildirimler`
--
ALTER TABLE `phpkf_bildirimler`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_cevaplar`
--
ALTER TABLE `phpkf_cevaplar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_dallar`
--
ALTER TABLE `phpkf_dallar`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_duyurular`
--
ALTER TABLE `phpkf_duyurular`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_forumlar`
--
ALTER TABLE `phpkf_forumlar`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_gruplar`
--
ALTER TABLE `phpkf_gruplar`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_kullanicilar`
--
ALTER TABLE `phpkf_kullanicilar`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_mesajlar`
--
ALTER TABLE `phpkf_mesajlar`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_ozel_ileti`
--
ALTER TABLE `phpkf_ozel_ileti`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_tesekkur`
--
ALTER TABLE `phpkf_tesekkur`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_yorumlar`
--
ALTER TABLE `phpkf_yorumlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `phpkf_yuklemeler`
--
ALTER TABLE `phpkf_yuklemeler`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
