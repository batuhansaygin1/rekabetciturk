<?php
// phpKF-CMS v1.10
// Yönetim/Ayarlar Sayfası
// Türkçe Dil Dosyası



// Sayfa Başlıkları
$lya['genel_ayarlar'] = 'Genel Ayarlar';
$lya['site_basliklari'] = 'Site Başlıkları';
$lya['sayfalama_ayarlari'] = 'Sayfalama Ayarları';
$lya['seo_ayarlari'] = 'SEO Ayarları';
$lya['tarih_ayarlari'] = 'Tarih Ayarları';
$lya['uyelik_ayarlari'] = 'Üyelik Ayarları';
$lya['kayit_ayarlari'] = 'Kayıt Ayarları';
$lya['resim_ayarlari'] = 'Resim Ayarları';
$lya['eposta_ayarlari'] = 'E-Posta Ayarları';
$lya['smtp_ayarlari'] = 'SMTP Ayarları';
$lya['duzenleyici_ayarlari'] = 'Düzenleyici Ayarları';
$lya['phpkf_duzenleyici_ayarlari'] = 'phpKF Düzenleyici Ayarları';
$lya['tinymce_duzenleyici_ayarlari'] = 'TinyMCE Düzenleyici Ayarları';
$lya['yukleme_ayarlari'] = 'Yükleme Ayarları';
$lya['tema_ayarlari'] = 'Tema Ayarları';
$lya['kurulu_eklentilerin_ayarlari'] = 'Kurulu Eklentilerin Ayarları';



// Sayfa Açıklamaları
$lya['tema_ayar_bilgi'] = 'Kullandığınız temanın eklediği özel ayarları buradan değiştirebilirsiniz.';
$lya['tema_ayar_yok'] = 'Kullandığınız temanın hiçbir özel ayarı yok.';
$lya['eklenti_ayar_bilgi'] = 'Kurduğunuz eklentilerin eklediği özel ayarları buradan değiştirebilirsiniz.';
$lya['eklenti_ayar_yok'] = 'Kurulu eklentilere ait hiçbir ayar yok.';
$lya['isaretli_zorunlu'] = '* işaretli tüm alanların doldurulması zorunludur !';
$lya['ayar_kaydet'] = 'Ayarları Kaydet';





// Ayar başlık ve açıklamaları
$lya['site_adi']['baslik'] = 'Site Adı';
$lya['site_adi']['secenek'] = '';
$lya['site_adi']['bilgi'] = 'Site Adı';
$lya['site_adi']['aciklama'] = 'E-Posta vb. yerlerde görünecek site adı.';


$lya['alanadi']['baslik'] = 'Alanadı';
$lya['alanadi']['secenek'] = '';
$lya['alanadi']['bilgi'] = 'Alanadı';
$lya['alanadi']['aciklama'] = 'Site alanadı bilgisi. Yanlış girilmesi sitenin çalışmasını etkiler. http:// veya https:// girmeyin!';


$lya['dizin']['baslik'] = 'phpKF-CMS Dizini';
$lya['dizin']['secenek'] = '';
$lya['dizin']['bilgi'] = 'phpKF-CMS Dizini';
$lya['dizin']['aciklama'] = 'phpKF-CMS`nin kurulu olduğu dizin. Yanlış girilmesi sitenin çalışmasını etkiler.
<br>Dizinin sadece başına / ekleyin, sonuna <u>eklemeyin</u>. Kök dizini için sadece / girin.';


$lya['durum_anasayfa']['baslik'] = 'Ana Sayfa';
$lya['durum_anasayfa']['secenek'] = '0:Güncel Yazılar|2:Ana Sayfa Yazısı|1:Özel Ana Sayfa';
$lya['durum_anasayfa']['bilgi'] = '';
$lya['durum_anasayfa']['aciklama'] = '';


$lya['anasyfdosya']['baslik'] = 'Özel Ana Sayfa Dosyası';
$lya['anasyfdosya']['secenek'] = '';
$lya['anasyfdosya']['bilgi'] = 'Dosya yolu ve adını giriniz';
$lya['anasyfdosya']['aciklama'] = '';


$lya['guncel_kat']['baslik'] = 'Güncel Yazılar Kategorisi';
$lya['guncel_kat']['secenek'] = '0:Tüm Kategoriler|{KAT_ID}:{KATEGORILER}';
$lya['guncel_kat']['bilgi'] = '';
$lya['guncel_kat']['aciklama'] = 'Güncel yazıların gösterileceği kategori.';


$lya['guncel_yazi']['baslik'] = 'Güncel İçerik Tipi';
$lya['guncel_yazi']['secenek'] = '2:Yazılar|0:Sayfalar|4:Galeriler|5:Videolar|1:Tüm içerik';
$lya['guncel_yazi']['bilgi'] = '';
$lya['guncel_yazi']['aciklama'] = 'Güncel yazı olarak gösterilecek içerik tipi.';


$lya['durum_sayfalar']['baslik'] = 'Kategoriler ve Sayfalar';
$lya['durum_sayfalar']['secenek'] = '1:Açık|0:Kapalı';
$lya['durum_sayfalar']['bilgi'] = '';
$lya['durum_sayfalar']['aciklama'] = '"Kategoriler - Sayfalar" sayfalarını ve bağlantılarını buradan kapatabilirsiniz.';


$lya['yazan_adi']['baslik'] = 'Yazar Adı';
$lya['yazan_adi']['secenek'] = '0:Üye Adı|1:Gerçek Ad';
$lya['yazan_adi']['bilgi'] = '';
$lya['yazan_adi']['aciklama'] = 'Yazılarda görünen "Yazan" alanı için, üye adı veya gerçek ad seçimi.';


$lya['vt_hata']['baslik'] = 'Veritabanı Hata iletileri';
$lya['vt_hata']['secenek'] = '0:Kapalı|2:Sadece Hata|1:Ayrıntılı Hata';
$lya['vt_hata']['bilgi'] = '';
$lya['vt_hata']['aciklama'] = 'Kapalı: Boş sayfa çıkar, Sadece Hata: "Sorgu Başarısız" yazar, Ayrıntılı Hata: Hata ayrıntılı olarak yazılır. "Ayrıntılı" ayarını sadece hatayı görmek için açın.';


$lya['durum_site']['baslik'] = 'Site Durumu';
$lya['durum_site']['secenek'] = '1:Açık|0:Kapalı';
$lya['durum_site']['bilgi'] = '';
$lya['durum_site']['aciklama'] = 'Güncelleme gibi durumlarda siteyi yöneticiler dışındakilere kapatmanızı sağlar.';


$lya['site_kapali']['baslik'] = 'Site Kapalı Yazısı';
$lya['site_kapali']['secenek'] = '';
$lya['site_kapali']['bilgi'] = 'Site Kapalı Yazısı';
$lya['site_kapali']['aciklama'] = 'Siteyi kapattığınızda veya bakıma aldığınızda gösterilecek yazı. HTML kullanabilirsiniz.';


$lya['dil_varsayilan']['baslik'] = 'Varsayılan Dil';
$lya['dil_varsayilan']['secenek'] = '{DIL_ID}:{DILLER}';
$lya['dil_varsayilan']['bilgi'] = '';
$lya['dil_varsayilan']['aciklama'] = 'Sitenin varsayılan dili.';


$lya['dil_eklenen']['baslik'] = 'Eklenen Diller';
$lya['dil_eklenen']['secenek'] = '';
$lya['dil_eklenen']['bilgi'] = '';
$lya['dil_eklenen']['aciklama'] = 'Dil sıralamasını bu alandan değiştirebilirsiniz. Başta, sonda ve aralarda virgül olmalıdır. Dil seçimini iptal etmek için sadece tek virgül girin. Dil ekleme/çıkarma işlemleri <a href="ayar_dil.php">şu sayfadan</a> yapılmaktadır.';


$lya['forum_kullan']['baslik'] = 'phpKF Forum Kullanımı';
$lya['forum_kullan']['secenek'] = '1:Açık|0:Kapalı';
$lya['forum_kullan']['bilgi'] = '';
$lya['forum_kullan']['aciklama'] = 'Forum kurulu olmalıdır. İndirmek için <a href="http://www.phpkf.com/indirme.php" target="_blank">tıklayın.</a> Ayrıntılı bilgi için <a href="http://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">bakınız.</a>';


$lya['portal_kullan']['baslik'] = 'phpKF-Portal Kullanımı';
$lya['portal_kullan']['secenek'] = '1:Açık|0:Kapalı';
$lya['portal_kullan']['bilgi'] = '';
$lya['portal_kullan']['aciklama'] = 'Portal kurulu olmalıdır. İndirmek için <a href="http://www.phpkf.com/indirme.php" target="_blank">tıklayın.</a> Ayrıntılı bilgi için <a href="http://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">bakınız.</a>';


$lya['title_anasyf']['baslik'] = 'Tarayıcı Site Başlığı (Ana Sayfa)';
$lya['title_anasyf']['secenek'] = '';
$lya['title_anasyf']['bilgi'] = 'Ana Sayfa için';
$lya['title_anasyf']['aciklama'] = 'Web tarayıcısının başlığında görünecek başlık (title). Ana sayfa içindir. SEO açısından 70 karakterden kısa tutmanız önerilir.';


$lya['title']['baslik'] = 'Tarayıcı Site Başlığı (Tüm sayfalar)';
$lya['title']['secenek'] = '';
$lya['title']['bilgi'] = 'Tüm sayfalar için';
$lya['title']['aciklama'] = 'Web tarayıcısının başlığında görünecek başlık (title). Ana sayfa haricindeki tüm sayfalar içindir, boş bırakabilirsiniz. SEO açısından 70 karakterden kısa tutmanız önerilir.';


$lya['site_taban']['baslik'] = 'Sayfa Taban Yazısı';
$lya['site_taban']['secenek'] = '';
$lya['site_taban']['bilgi'] = 'Sayfa Taban Yazısı';
$lya['site_taban']['aciklama'] = 'Tüm sayfaların en altında görünecek yazı. Boş bırakabilirsiniz.';


$lya['syfkota_guncel']['baslik'] = 'Güncel Yazılar Sayısı';
$lya['syfkota_guncel']['secenek'] = '';
$lya['syfkota_guncel']['bilgi'] = '';
$lya['syfkota_guncel']['aciklama'] = 'Bir sayfada görünecek güncel yazı sayısı. Yer: Ana sayfa.';


$lya['syfkota_kat']['baslik'] = 'Kategori Yazı Sayısı';
$lya['syfkota_kat']['secenek'] = '';
$lya['syfkota_kat']['bilgi'] = '';
$lya['syfkota_kat']['aciklama'] = 'Bir sayfada görünecek yazı sayısı. Yer: Kategoriler sayfası.';


$lya['syfkota_yorum']['baslik'] = 'Yorum Sayısı';
$lya['syfkota_yorum']['secenek'] = '';
$lya['syfkota_yorum']['bilgi'] = '';
$lya['syfkota_yorum']['aciklama'] = 'Bir sayfada görünecek yorum sayısı. Yer: Yazı içerik sayfası.';


$lya['benzer_durum']['baslik'] = 'Benzer Yazılar';
$lya['benzer_durum']['secenek'] = '1:Açık|0:Kapalı';
$lya['benzer_durum']['bilgi'] = '';
$lya['benzer_durum']['aciklama'] = 'Yazı içerik sayfalarındaki benzer yazıların durumu.';


$lya['benzer_kota']['baslik'] = 'Benzer Yazı Sayısı';
$lya['benzer_kota']['secenek'] = '';
$lya['benzer_kota']['bilgi'] = '';
$lya['benzer_kota']['aciklama'] = 'Bir sayfada görünecek benzer yazı sayısı. Yer: Yazı içerik sayfası.';


$lya['seo']['baslik'] = 'SEF Adres Yapısı';
$lya['seo']['secenek'] = '0:Kapalı|1:KategoriAdı-k1/SayfaAdı-y1.html|2:KategoriAdı/SayfaAdı.html|3:SayfaAdı-y1.html|4:SayfaAdı.html';
$lya['seo']['bilgi'] = '';
$lya['seo']['aciklama'] = 'Linkler çalışmazsa bu ayarı kapatın.
<br>Sadece siteyi ilk kurduğunuzda değiştirin yoksa arama sitelerinin kaydettiği linkler geçersiz olur.';


$lya['dizin_kat']['baslik'] = 'Kategoriler Dizini';
$lya['dizin_kat']['secenek'] = '';
$lya['dizin_kat']['bilgi'] = 'Kategoriler Dizini';
$lya['dizin_kat']['aciklama'] = '"Kategoriler" sayfası için gösterilecek sanal dizin. Yukarıdaki SEF ayarı ile bağlantılıdır.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['dizin_sayfa']['baslik'] = 'Sayfalar Dizini';
$lya['dizin_sayfa']['secenek'] = '';
$lya['dizin_sayfa']['bilgi'] = 'Sayfalar Dizini';
$lya['dizin_sayfa']['aciklama'] = '"Sayfalar" sayfası için gösterilecek sanal dizin. Yukarıdaki SEF ayarı ile bağlantılıdır.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['dizin_galeri']['baslik'] = 'Galeriler Dizini';
$lya['dizin_galeri']['secenek'] = '';
$lya['dizin_galeri']['bilgi'] = 'Galeriler Dizini';
$lya['dizin_galeri']['aciklama'] = '"Galeriler" sayfası için gösterilecek sanal dizin. Yukarıdaki SEF ayarı ile bağlantılıdır.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['dizin_video']['baslik'] = 'Videolar Dizini';
$lya['dizin_video']['secenek'] = '';
$lya['dizin_video']['bilgi'] = 'Videolar Dizini';
$lya['dizin_video']['aciklama'] = '"Videolar" sayfası için gösterilecek sanal dizin. Yukarıdaki SEF ayarı ile bağlantılıdır.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['dizin_etiket']['baslik'] = 'Etiketler Dizini';
$lya['dizin_etiket']['secenek'] = '';
$lya['dizin_etiket']['bilgi'] = 'Etiketler Dizini';
$lya['dizin_etiket']['aciklama'] = '"Etiketler" sayfası için gösterilecek sanal dizin.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['dizin_arama']['baslik'] = 'Arama Dizini';
$lya['dizin_arama']['secenek'] = '';
$lya['dizin_arama']['bilgi'] = 'Arama Dizini';
$lya['dizin_arama']['aciklama'] = '"Arama" sayfası için gösterilecek sanal dizin.
<br>Boşluk, büyük harf, Türkçe ve özel karakter kullanmayın.';


$lya['meta_description']['baslik'] = 'Açıklama Metni (Meta Description)';
$lya['meta_description']['secenek'] = '';
$lya['meta_description']['bilgi'] = 'Açıklama Metni';
$lya['meta_description']['aciklama'] = 'Sitenizi bir cümle ile tanımlayın. Azami 160 karakter.<br>Yazı sayfalarında bu veri yazı başlığı ile değiştirilir.';


$lya['meta_keywords']['baslik'] = 'Anahtar Kelimeler (Meta Keywords)';
$lya['meta_keywords']['secenek'] = '';
$lya['meta_keywords']['bilgi'] = 'Anahtar Kelimeler';
$lya['meta_keywords']['aciklama'] = 'Sitenizi tanımlayan etiketler. Etiketleri birbirinden , (virgül) ile ayırın. Azami 260 karakter veya 20 etiket.<br>Yazı sayfalarında bu veri yazı etiketleri ile değiştirilir.';


$lya['meta_diger']['baslik'] = 'Diğer Meta ve Header Kodları';
$lya['meta_diger']['secenek'] = '';
$lya['meta_diger']['bilgi'] = 'Diğer Meta ve Header Kodları';
$lya['meta_diger']['aciklama'] = 'Diğer meta etiketlerini ve &lt;head&gt; etiketi içine eklemek istediğiniz javascript vs. kodları buraya girebilirsiniz.<br>Şu meta etiketleri otomatik eklenmektedir: canonical, description, abstract, keywords, content-language, generator, publisher';


$lya['meta_sosyal']['baslik'] = 'Sosyal Paylaşım Meta Etiketleri';
$lya['meta_sosyal']['secenek'] = '';
$lya['meta_sosyal']['bilgi'] = 'Sosyal Paylaşım Meta Etiketleri';
$lya['meta_sosyal']['aciklama'] = 'Facebook, Twitter, Linkedln, Google+ ve diğer sosyal paylaşım sitelerinin meta etiketlerini buraya girebilirsiniz.<br>Ayrıca, bazıları bulunulan sayfaya göre değişen şu değişkenleri kullanabilirsiniz:<br>{TITLE} {TITLE_ANASAYFA} {META_DESCRIPTION} {META_KEYWORDS}';


$lya['sosyal_imleme']['baslik'] = 'Sosyal İmleme Kodları';
$lya['sosyal_imleme']['secenek'] = '';
$lya['sosyal_imleme']['bilgi'] = 'Sosyal imleme, paylaş kodları';
$lya['sosyal_imleme']['aciklama'] = 'Sosyal imleme ve paylaş kodlarını buraya girebilirsiniz. Eklenen kodlar yazı sayfasında yazı başlığının yanında görünecektir.';


$lya['site_taban_kod']['baslik'] = 'Sayfa Altına Eklenecek Kodlar';
$lya['site_taban_kod']['secenek'] = '';
$lya['site_taban_kod']['bilgi'] = 'Sayfa Altına Eklenecek Kodlar';
$lya['site_taban_kod']['aciklama'] = 'Buraya girilen kodlar tüm sayfaların altına eklenir.<br>Google Analytics, sayaç, site ekle, javascript, vs. her türlü görünür görünmez kodu buraya girebilirsiniz.';


$lya['sef_adresler']['baslik'] = 'SEF Adresler';
$lya['sef_adresler']['secenek'] = '';
$lya['sef_adresler']['bilgi'] = 'SEF Adresler';
$lya['sef_adresler']['aciklama'] = 'Bu ayar uzman kullanıcılar içindir! Eklentiler buraya ayar ekleyebilir, eklenen adresleri silmeyin.<br><br>Sonu .php olan adresleri .html yapma vb. yönlendirmeler için bu alanı kullanabilirsiniz.<br><u>Kullanım</u>:&nbsp; dosya.html=dizin/dosya.php &nbsp; Her yönlendirmeyi tek satıra yazın ve alt satıra geçin.';


$lya['tarih']['baslik'] = 'Tarih Biçimi';
$lya['tarih']['secenek'] = '0:date()|1:strftime()';
$lya['tarih']['bilgi'] = '';
$lya['tarih']['aciklama'] = '<br>Tüm sitede görünecek tarih biçimi. Ayrıntılı bilgi için aşağıdaki adreslere bakınız.<br><br>
<b>date örnek:&nbsp;</b> 31.12.2017-23:59:59
<br><b>strftime örnek:&nbsp;</b> 31 Aralık 2017 Çarşamba-23:59:59';


$lya['tarih_bolge']['baslik'] = 'Tarih Bölge (strftime için)';
$lya['tarih_bolge']['secenek'] = '';
$lya['tarih_bolge']['bilgi'] = 'strftime için';
$lya['tarih_bolge']['aciklama'] = 'Kullanım: <a href="http://www.php.net/date_default_timezone_set" target="_blank">date_default_timezone_set()</a>';


$lya['tarih_dil']['baslik'] = 'Tarih dil (strftime için)';
$lya['tarih_dil']['secenek'] = '';
$lya['tarih_dil']['bilgi'] = 'strftime için';
$lya['tarih_dil']['aciklama'] = 'Kullanım: <a href="http://www.php.net/setlocale" target="_blank">setlocale()</a>';


$lya['tarih_bicimi']['baslik'] = 'Tarih Biçimi';
$lya['tarih_bicimi']['secenek'] = '';
$lya['tarih_bicimi']['bilgi'] = '';
$lya['tarih_bicimi']['aciklama'] = 'Kullanım: <a href="http://www.php.net/date" target="_blank">date()</a>, <a href="http://www.php.net/strftime" target="_blank">strftime()</a><br>
<p style="text-align:right">Ayarlı Görünüm: &nbsp;{phpkf_tarih}</p>
<b>date için:&nbsp;</b> d.m.Y-H:i:s<br>
<b>strftime için:&nbsp;</b> %d %B %Y %A-%H:%M:%S<br>';


$lya['saat_dilimi']['baslik'] = 'Zaman dilimi';
$lya['saat_dilimi']['secenek'] = '-12:UTC - 12|-11:UTC - 11|-10:UTC - 10|-9.5:UTC - 9.5|-9:UTC - 9|-8:UTC - 8|-7:UTC - 7|-6:UTC - 6|-5:UTC - 5|-4.5:UTC - 4.5|-4:UTC - 4|-3.5:UTC - 3.5|-3:UTC - 3|-2:UTC - 2|-1:UTC - 1|0:UTC + 0|1:UTC + 1|2:UTC + 2|3:UTC + 3|3.5:UTC + 3.5|4:UTC + 4|4.5:UTC + 4.5|5:UTC + 5|5.5:UTC + 5.5|6:UTC + 6|6.5:UTC + 6.5|7:UTC + 7|8:UTC + 8|8.75:UTC + 8.75|9:UTC + 9|9.5:UTC + 9.5|10:UTC + 10|10.5:UTC + 10.5|11:UTC + 11|11.5:UTC + 11.5|12:UTC + 12|12.75:UTC + 12.75|13:UTC + 13|14:UTC + 14';
$lya['saat_dilimi']['bilgi'] = '';
$lya['saat_dilimi']['aciklama'] = 'Türkiye için (UTC +3) seçin.';


$lya['bbcode']['baslik'] = 'BBCode';
$lya['bbcode']['secenek'] = '1:Açık|0:Kapalı';
$lya['bbcode']['bilgi'] = '';
$lya['bbcode']['aciklama'] = 'Yorum ve imza alanında BBCode kullanımı.';


$lya['yorum_onay']['baslik'] = 'Yorum Onay';
$lya['yorum_onay']['secenek'] = '2:Yöneticiler Hariç Herkes|1:Sadece Ziyaretçiler|0:Hiç Kimse';
$lya['yorum_onay']['bilgi'] = '';
$lya['yorum_onay']['aciklama'] = 'Kimlerin yazdığı yorumlar onay gerektirsin?';


$lya['yorum_onay_kodu']['baslik'] = 'Yorum Onay Kodu';
$lya['yorum_onay_kodu']['secenek'] = '1:Açık|0:Kapalı';
$lya['yorum_onay_kodu']['bilgi'] = '';
$lya['yorum_onay_kodu']['aciklama'] = 'Ziyaretçiler için onay kodu görseli.';


$lya['yorum_siralama']['baslik'] = 'Yorum Sıralama';
$lya['yorum_siralama']['secenek'] = '1:Eskiden yeniye|0:Yeniden eskiye';
$lya['yorum_siralama']['bilgi'] = '';
$lya['yorum_siralama']['aciklama'] = 'Yorumların sıralanma şekli.';


$lya['yorum_sure']['baslik'] = 'Yorumlar Arası Bekleme Süresi';
$lya['yorum_sure']['secenek'] = '';
$lya['yorum_sure']['bilgi'] = '';
$lya['yorum_sure']['aciklama'] = 'Yazılan iki yorum arasındaki bekleme süresi: (saniye)';


$lya['uye_cevrimici_sure']['baslik'] = 'Çevrimiçi Süresi';
$lya['uye_cevrimici_sure']['secenek'] = '';
$lya['uye_cevrimici_sure']['bilgi'] = '';
$lya['uye_cevrimici_sure']['aciklama'] = 'Çevrimiçi süresi: (dakika)';


$lya['uye_kilit_sure']['baslik'] = 'Hesap Kilit Süresi';
$lya['uye_kilit_sure']['secenek'] = '';
$lya['uye_kilit_sure']['bilgi'] = '';
$lya['uye_kilit_sure']['aciklama'] = 'Beş başarısız girişten sonra hesabın kilitli kalacağı süre: (dakika)';


$lya['uye_imza_uzunluk']['baslik'] = 'Kullanıcı imzasının uzunluğu';
$lya['uye_imza_uzunluk']['secenek'] = '';
$lya['uye_imza_uzunluk']['bilgi'] = '';
$lya['uye_imza_uzunluk']['aciklama'] = 'Yazılabilecek en fazla karakter sayısını giriniz.';


$lya['k_cerez_zaman']['baslik'] = 'Çerez geçerlilik süresi';
$lya['k_cerez_zaman']['secenek'] = '';
$lya['k_cerez_zaman']['bilgi'] = '';
$lya['k_cerez_zaman']['aciklama'] = 'Dakika cinsinden oturum uzunluğu. 10080 dakika = 7 gün';


$lya['kayit_uyelik']['baslik'] = 'Üye Alımı';
$lya['kayit_uyelik']['secenek'] = '1:Açık|0:Kapalı';
$lya['kayit_uyelik']['bilgi'] = '';
$lya['kayit_uyelik']['aciklama'] = 'Üye kayıt özelliğini kapatmanızı sağlar.';


$lya['kayit_hesap_etkin']['baslik'] = 'Hesap Etkinleştirme Şekli';
$lya['kayit_hesap_etkin']['secenek'] = '0:Kapalı|1:Üye|2:Yönetici';
$lya['kayit_hesap_etkin']['bilgi'] = '';
$lya['kayit_hesap_etkin']['aciklama'] = 'Kapalı: Etkinleştirme gerekmez.
<br>Üye: Kayıt olan üyeye e-posta yollanarak doğrulama istenir.
<br>Yönetici: E-posta doğrulamasına ek olarak yönetici onayı gerektirir.';


$lya['kayit_onay_kodu']['baslik'] = 'Kayıt Onay Kodu';
$lya['kayit_onay_kodu']['secenek'] = '1:Açık|0:Kapalı';
$lya['kayit_onay_kodu']['bilgi'] = '';
$lya['kayit_onay_kodu']['aciklama'] = 'Üye kayıt sayfasında görünen onay kodu görseli.';


$lya['kayit_soru']['baslik'] = 'Kayıt Sorusu Durumu';
$lya['kayit_soru']['secenek'] = '1:Açık|0:Kapalı';
$lya['kayit_soru']['bilgi'] = '';
$lya['kayit_soru']['aciklama'] = 'Otomatik kayıt yapan robot programlardan kurtulmak için, kayıt sayfasında özel soru kullan.';


$lya['kayit_sorusu']['baslik'] = 'Kayıt Sorusu';
$lya['kayit_sorusu']['secenek'] = '';
$lya['kayit_sorusu']['bilgi'] = 'Kayıt Sorusu';
$lya['kayit_sorusu']['aciklama'] = '';


$lya['kayit_cevabi']['baslik'] = 'Sorunun Cevabı';
$lya['kayit_cevabi']['secenek'] = '';
$lya['kayit_cevabi']['bilgi'] = 'Sorunun Cevabı';
$lya['kayit_cevabi']['aciklama'] = '';


$lya['uye_resim_yukle']['baslik'] = 'Resim yükleme özelliği';
$lya['uye_resim_yukle']['secenek'] = '1:Açık|0:Kapalı';
$lya['uye_resim_yukle']['bilgi'] = '';
$lya['uye_resim_yukle']['aciklama'] = 'Resimlerin sunucunuza yüklenmesini sağlar. Bunun için /phpkf-dosyalar/resimler/yuklenen/ dizininde yazma izninin olması gerekir.';


$lya['uye_resim_galerisi']['baslik'] = 'Resim Galerisi';
$lya['uye_resim_galerisi']['secenek'] = '1:Açık|0:Kapalı';
$lya['uye_resim_galerisi']['bilgi'] = '';
$lya['uye_resim_galerisi']['aciklama'] = 'Geçerli dizin: /phpkf-dosyalar/resimler/galeri/';


$lya['uye_resim_boyut']['baslik'] = 'Azami Dosya Boyutu';
$lya['uye_resim_boyut']['secenek'] = '';
$lya['uye_resim_boyut']['bilgi'] = '';
$lya['uye_resim_boyut']['aciklama'] = 'kilobayt (kb.) cinsinden en yüksek dosya boyutu.';


$lya['uye_resim_yukseklik']['baslik'] = 'Azami Resim Yüksekliği';
$lya['uye_resim_yukseklik']['secenek'] = '';
$lya['uye_resim_yukseklik']['bilgi'] = '';
$lya['uye_resim_yukseklik']['aciklama'] = 'Piksel (px) cinsinden en fazla yükseklik değeri.';


$lya['uye_resim_genislik']['baslik'] = 'Azami Resim Genişliği';
$lya['uye_resim_genislik']['secenek'] = '';
$lya['uye_resim_genislik']['bilgi'] = '';
$lya['uye_resim_genislik']['aciklama'] = 'Piksel (px) cinsinden en fazla genişlik değeri.';


$lya['v-uye_resmi']['baslik'] = 'Varsayılan Üye Resmi';
$lya['v-uye_resmi']['secenek'] = '';
$lya['v-uye_resmi']['bilgi'] = 'Varsayılan Üye Resmi';
$lya['v-uye_resmi']['aciklama'] = 'Varsayılan:&nbsp; /phpkf-dosyalar/resimler/varsayilan_resim.jpg';


$lya['v-ziyaretci_resmi']['baslik'] = 'Varsayılan Ziyaretçi Resmi';
$lya['v-ziyaretci_resmi']['secenek'] = '';
$lya['v-ziyaretci_resmi']['bilgi'] = 'Varsayılan Ziyaretçi Resmi';
$lya['v-ziyaretci_resmi']['aciklama'] = 'Varsayılan:&nbsp; /phpkf-dosyalar/resimler/gravatar.png';


$lya['site_posta']['baslik'] = 'Site E-Posta Adresi';
$lya['site_posta']['secenek'] = '';
$lya['site_posta']['bilgi'] = 'Site E-Posta Adresi';
$lya['site_posta']['aciklama'] = 'Site üzerinden gönderilecek e-postalarda kullanmak istediğiniz e-posta adresi.
<br>Web sunucu veya smtp hesabınızla uyuşmazsa E-Posta gönderilemeyebilir.';


$lya['eposta_yontem']['baslik'] = 'E-Posta Yöntemi';
$lya['eposta_yontem']['secenek'] = 'mail:Sunucu mail() fonksiyonu|smtp:SMTP sunucu';
$lya['eposta_yontem']['bilgi'] = '';
$lya['eposta_yontem']['aciklama'] = '<br>E-Posta gönderiminde kullanılacak yöntem.';


$lya['smtp_kd']['baslik'] = 'SMTP Kimlik Doğrulaması';
$lya['smtp_kd']['secenek'] = '1:Açık|0:Kapalı';
$lya['smtp_kd']['bilgi'] = '';
$lya['smtp_kd']['aciklama'] = '<br>SMTP sunucunuz kimlik doğrulaması istiyor mu?';


$lya['smtp_sunucu']['baslik'] = 'SMTP Sunucu Adresi';
$lya['smtp_sunucu']['secenek'] = '';
$lya['smtp_sunucu']['bilgi'] = 'SMTP Sunucu Adresi';
$lya['smtp_sunucu']['aciklama'] = 'SMTP sunucu adresini girin. Genelde mail.SiteAdresi.com şeklinde olur.
<br>SMTP sunucu SSL güvenli bağlantı gerektiriyorsa adresin başına <b>ssl://</b> ekleyin.';


$lya['smtp_kullanici']['baslik'] = 'SMTP Kullanıcı Adı';
$lya['smtp_kullanici']['secenek'] = '';
$lya['smtp_kullanici']['bilgi'] = 'SMTP Kullanıcı Adı';
$lya['smtp_kullanici']['aciklama'] = 'SMTP sunucu gerektiriyorsa doldurun.
<br>Bazı sunucularda sadece kullanıcı adı, bazılarındaysa KullanıcıAdı@SiteAdresi.com şeklinde yazılması gerekebilir.';


$lya['smtp_sifre']['baslik'] = 'SMTP Şifresi';
$lya['smtp_sifre']['secenek'] = '';
$lya['smtp_sifre']['bilgi'] = '';
$lya['smtp_sifre']['aciklama'] = 'SMTP sunucu gerektiriyorsa doldurun.';


$lya['smtp_port']['baslik'] = 'SMTP Portu';
$lya['smtp_port']['secenek'] = '';
$lya['smtp_port']['bilgi'] = '';
$lya['smtp_port']['aciklama'] = 'Varsayılan smtp portu 25`dir. Türk Telekom 25. portu engellediği için Türkiye`de 587 kullanılmaktadır.
<br>Sunucunuzun hangi portu kullandığını hosting firmanızdan öğrenebilirsiniz.';


$lya['duzenleyici']['baslik'] = 'Metin Düzenleyici';
$lya['duzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['duzenleyici']['bilgi'] = '';
$lya['duzenleyici']['aciklama'] = 'Yazı ekleme sayfasında kullanılacak editör.';


$lya['gduzenleyici']['baslik'] = 'Galeri Düzenleyici';
$lya['gduzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['gduzenleyici']['bilgi'] = '';
$lya['gduzenleyici']['aciklama'] = 'Galeri ekleme sayfasında kullanılacak editör.';


$lya['vduzenleyici']['baslik'] = 'Video Düzenleyici';
$lya['vduzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['vduzenleyici']['bilgi'] = '';
$lya['vduzenleyici']['aciklama'] = 'Video ekleme sayfasında kullanılacak editör.';


$lya['yduzenleyici']['baslik'] = 'Yorum Düzenleyici';
$lya['yduzenleyici']['secenek'] = 'duz:Düz';
$lya['yduzenleyici']['bilgi'] = '';
$lya['yduzenleyici']['aciklama'] = 'Yazı içerik sayfalarındaki yorum alanında kullanılacak editör.';


$lya['duzenleyici_html_tema']['baslik'] = 'HTML Tasarım<br><span style="font-size:11px;color:gray"><br>Yönetimdeki içerik düzenleyiciler için</span>';
$lya['duzenleyici_html_tema']['secenek'] = 'varsayilan:Modern (koyu, büyük)';
$lya['duzenleyici_html_tema']['bilgi'] = '';
$lya['duzenleyici_html_tema']['aciklama'] = 'Yönetim içerik düzenleyici tasarımı. Klasik seçildiğinde düğmeler arasındaki ayraçlarları silmeniz önerilir.';


$lya['duzenleyici_bbcode_tema']['baslik'] = 'BBCode Tasarım<br><span style="font-size:11px;color:gray"><br>Yorum düzenleyici için</span>';
$lya['duzenleyici_bbcode_tema']['secenek'] = 'varsayilan:Modern (koyu, büyük)';
$lya['duzenleyici_bbcode_tema']['bilgi'] = '';
$lya['duzenleyici_bbcode_tema']['aciklama'] = 'Yorum düzenleyici tasarımı. Klasik seçildiğinde düğmeler arasındaki ayraçlarları silmeniz önerilir.';


$lya['duzenleyici_font']['baslik'] = 'Simge Font Adresi';
$lya['duzenleyici_font']['secenek'] = '';
$lya['duzenleyici_font']['bilgi'] = 'Simge Font Adresi';
$lya['duzenleyici_font']['aciklama'] = 'Düğme simgelerinde kullanılan font adresi.
<br>Varsayılan:&nbsp; https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';


$lya['dugme_html']['baslik'] = 'HTML Düğmeler<br><span style="font-size:11px;color:gray"><br>Yönetimdeki içerik düzenleyiciler için</span>';
$lya['dugme_html']['secenek'] = '';
$lya['dugme_html']['bilgi'] = 'İçerik alanları için HTML Düğmeler';
$lya['dugme_html']['aciklama'] = 'Düğme isimleri arasında boşluk bırakın. Ayraç için | (dikey çizgi) Yeni satır için ; (noktalı virgül) kullanabilirsiniz. Varsayılan için boş bırakın. Örnek kullanım için aşağıdaki bilgi alanına bakın.';


$lya['dugme_bbcode']['baslik'] = 'BBCode Düğmeler<br><span style="font-size:11px;color:gray"><br>Yorum düzenleyici için</span>';
$lya['dugme_bbcode']['secenek'] = '';
$lya['dugme_bbcode']['bilgi'] = 'Yorum alanları için BBCode Düğmeler';
$lya['dugme_bbcode']['aciklama'] = 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih devam | youtube video audio | postimage yukleme | geri ileri';


$lya['dugme_kodlar']['baslik'] = 'Harici Düğme ve Fonksiyonlar<br><span style="font-size:11px;color:gray"><br>Javascript kod alanı</span>';
$lya['dugme_kodlar']['secenek'] = '';
$lya['dugme_kodlar']['bilgi'] = 'Harici düğme ve fonksiyon kodları';
$lya['dugme_kodlar']['aciklama'] = 'Düğme oluşturma kodları, tıklayınca çalışacak fonksiyon ve/veya yüzer katman kodları, düğme resim ve stil kodları. <a href="#XXXXXX">Bakınız</a>';


$lya['dugme_stil']['baslik'] = 'Harici Düğme Stil<br><span style="font-size:11px;color:gray"><br>CSS kod alanı</span>';
$lya['dugme_stil']['secenek'] = '';
$lya['dugme_stil']['bilgi'] = 'Harici düğme stil kodları';
$lya['dugme_stil']['aciklama'] = 'Harici düğmeler için css stil kodları. Yukarıda tanımlanan düğme id ile, css class adı aynı olmalıdır. <a href="#XXXXXX">Bakınız</a>';


$lya['yukleme_video']['baslik'] = 'Video Kodu';
$lya['yukleme_video']['secenek'] = '';
$lya['yukleme_video']['bilgi'] = 'Video Kodu';
$lya['yukleme_video']['aciklama'] = 'HTML 5 destekli MP4, WebM, Ogg gibi video formatları için Video kodu.';


$lya['yukleme_embed']['baslik'] = 'Embed Kodu';
$lya['yukleme_embed']['secenek'] = '';
$lya['yukleme_embed']['bilgi'] = 'Embed Kodu';
$lya['yukleme_embed']['aciklama'] = 'HTML 5 desteği olmayan, Media Player veya Flash Player ile oynatılabilen video formatları için Embed kodu.';


$lya['yukleme_audio']['baslik'] = 'Audio Kodu';
$lya['yukleme_audio']['secenek'] = '';
$lya['yukleme_audio']['bilgi'] = 'Audio Kodu';
$lya['yukleme_audio']['aciklama'] = 'Tüm ses dosyaları için Audio kodu.';


$lya['yukleme_dosya']['baslik'] = 'Yüklenebilir Dosya Tipleri<br><span style="font-size:11px;color:gray"><br>Yöneticiler için</span>';
$lya['yukleme_dosya']['secenek'] = '';
$lya['yukleme_dosya']['bilgi'] = '';
$lya['yukleme_dosya']['aciklama'] = 'Yüklenebilir dosya uzantıları. Dosya uzantılarını birbirinden , (virgül) ile ayırın.';


$lya['yukleme_dosya_uye']['baslik'] = 'Yüklenebilir Dosya Tipleri<br><span style="font-size:11px;color:gray"><br>Yetkisiz üyeler için</span>';
$lya['yukleme_dosya_uye']['secenek'] = '';
$lya['yukleme_dosya_uye']['bilgi'] = '';
$lya['yukleme_dosya_uye']['aciklama'] = 'Yükleme özelliğini üyelere kapatmak için boş bırakın.';


$lya['yukleme_dizin']['baslik'] = 'Dosya Yükleme Dizini<br><span style="font-size:11px;color:gray"><br>Yöneticiler için</span>';
$lya['yukleme_dizin']['secenek'] = '';
$lya['yukleme_dizin']['bilgi'] = '';
$lya['yukleme_dizin']['aciklama'] = 'Dosyaların yükleneceği dizini. Başına ve sonuna / (bölü) <u>koymayın.</u> Yükleme işlemi için dizine yazma hakkı vermelisiniz. (chmod 777) <br>Varsayılan: phpkf-dosyalar/yuklemeler';


$lya['yukleme_dizin_uye']['baslik'] = 'Dosya Yükleme Dizini<br><span style="font-size:11px;color:gray"><br>Yetkisiz üyeler için</span>';
$lya['yukleme_dizin_uye']['secenek'] = '';
$lya['yukleme_dizin_uye']['bilgi'] = '';
$lya['yukleme_dizin_uye']['aciklama'] = 'Her üyeye farklı klasör için dizin adında {uye_id} kullanabilirsiniz.
<br>Örnek: phpkf-dosyalar/yuklemeler/uyeler/{uye_id}
<br>Varsayılan: phpkf-dosyalar/yuklemeler/uyeler';


$lya['yukleme_genislik']['baslik'] = 'En küçük resim genişliği';
$lya['yukleme_genislik']['secenek'] = '';
$lya['yukleme_genislik']['bilgi'] = '';
$lya['yukleme_genislik']['aciklama'] = 'Otomatik küçültülen resmin piksel cinsinden genişliği';


$lya['yukleme_yukseklik']['baslik'] = 'En küçük resim yüksekliği';
$lya['yukleme_yukseklik']['secenek'] = '';
$lya['yukleme_yukseklik']['bilgi'] = '';
$lya['yukleme_yukseklik']['aciklama'] = 'Otomatik küçültülen resmin piksel cinsinden yüksekliği';


$lya['yukleme_kalite']['baslik'] = 'Resim Kalitesi';
$lya['yukleme_kalite']['secenek'] = '';
$lya['yukleme_kalite']['bilgi'] = '';
$lya['yukleme_kalite']['aciklama'] = 'Otomatik küçültülen resmin kalitesi (1 - 100 arası)';


$lya['tinymce_dosya']['baslik'] = 'Ana Script Dosyası';
$lya['tinymce_dosya']['secenek'] = '';
$lya['tinymce_dosya']['bilgi'] = 'Ana Script Dosyası';
$lya['tinymce_dosya']['aciklama'] = 'TinyMCE`nin çalışmasını sağlayan ana script dosyası. Varsayılan olarak uzak sunucudan yüklenir.
<br>Varsayılan:&nbsp; //cdn.tinymce.com/4/tinymce.min.js';


$lya['tinymce_dizin']['baslik'] = 'TinyMCE Dizini';
$lya['tinymce_dizin']['secenek'] = '';
$lya['tinymce_dizin']['bilgi'] = 'TinyMCE Dizini';
$lya['tinymce_dizin']['aciklama'] = 'TinyMCE dosyalarının bulunduğu dizin.
<br>Varsayılan:&nbsp; /phpkf-bilesenler/editor/tinymce/';


$lya['tinymce_language']['baslik'] = 'TinyMCE Dil Seçimi';
$lya['tinymce_language']['secenek'] = '';
$lya['tinymce_language']['bilgi'] = 'TinyMCE Dil Seçimi';
$lya['tinymce_language']['aciklama'] = 'Türkçe için (cdn) &nbsp; <b>language_url:tinymce_dizin+"/langs/tr_TR.js",</b>
<br>Türkçe için (yerel) &nbsp; <b>language:"tr_TR",</b>
<br>İngilizce için boş bırakın.';


$lya['tinymce_toolbar']['baslik'] = 'Araç Çubuğu';
$lya['tinymce_toolbar']['secenek'] = '';
$lya['tinymce_toolbar']['bilgi'] = 'Araç Çubuğu';
$lya['tinymce_toolbar']['aciklama'] = 'Araç çubuğundaki butonlar. &nbsp; toolbar: içine eklenen buton adları. <a href="https://www.tinymce.com/docs/configure/editor-appearance/#toolbar" target="_blank">Bakınız</a>';


$lya['tinymce_plugins']['baslik'] = 'Eklentiler';
$lya['tinymce_plugins']['secenek'] = '';
$lya['tinymce_plugins']['bilgi'] = 'Eklentiler';
$lya['tinymce_plugins']['aciklama'] = 'plugins:[] içine eklenen eklenti adları. <a href="https://www.tinymce.com/docs/configure/integration-and-setup/#plugins" target="_blank">Bakınız</a>';


$lya['tinymce_harici_plugins']['baslik'] = 'Harici Eklentiler';
$lya['tinymce_harici_plugins']['secenek'] = '';
$lya['tinymce_harici_plugins']['bilgi'] = 'Harici Eklentiler';
$lya['tinymce_harici_plugins']['aciklama'] = 'Kullanım: tinymce.PluginManager.load() fonksiyonuyla uzaktan eklenti yükleyebilirsiniz.';


$lya['tinymce_style']['baslik'] = 'Biçimler Menüsü';
$lya['tinymce_style']['secenek'] = '';
$lya['tinymce_style']['bilgi'] = 'Biçimler Menüsü';
$lya['tinymce_style']['aciklama'] = 'Üst "Biçim" menüsündeki alt "Biçimler" menüsü seçenekleri. &nbsp; style_formats: içine eklenen buton adları. <a href="https://www.tinymce.com/docs/configure/content-formatting/#style_formats" target="_blank">Bakınız</a>';


$lya['tinymce_init']['baslik'] = 'Ayarlar';
$lya['tinymce_init']['secenek'] = '';
$lya['tinymce_init']['bilgi'] = 'Ayarlar';
$lya['tinymce_init']['aciklama'] = 'tinyMCE.init() içine eklenen ayarlar. <a href="https://www.tinymce.com/docs/advanced/creating-a-plugin/#exampleinit" target="_blank">Bakınız</a>';


$lya['tinymce_dahili']['baslik'] = 'Dahili Fonksiyonlar';
$lya['tinymce_dahili']['secenek'] = '';
$lya['tinymce_dahili']['bilgi'] = 'Dahili Fonksiyonlar';
$lya['tinymce_dahili']['aciklama'] = 'Özel buton ekleme gibi durumlar için &nbsp; setup: içine eklenen fonksiyonlar. <a href="https://www.tinymce.com/docs/configure/integration-and-setup/#setup" target="_blank">Bakınız</a>';


$lya['tinymce_harici']['baslik'] = 'Harici Fonksiyonlar';
$lya['tinymce_harici']['secenek'] = '';
$lya['tinymce_harici']['bilgi'] = 'Harici Fonksiyonlar';
$lya['tinymce_harici']['aciklama'] = 'Özel butonların özel işlemleri için, tinyMCE.init() dışına eklenen harici fonksiyonlar.';


$lya['tema_genislik']['baslik'] = 'Sayfa Genişliği';
$lya['tema_genislik']['secenek'] = '';
$lya['tema_genislik']['bilgi'] = '95%';
$lya['tema_genislik']['aciklama'] = 'Genişlik değerini yüzde ve piksel cinsinden giriniz. Varsayılan temanın responsive (duyarlı) yapısından dolayı yüzde değeri girmeniz tavsiye olunur.<br>Sabit değer girildiğinde pencere boyutuna göre duyarlı yapı çalışmaz. <br>Örnek: 95% veya 1200px';


$lya['tema_logo_ust']['baslik'] = 'Üst Logo';
$lya['tema_logo_ust']['secenek'] = '';
$lya['tema_logo_ust']['bilgi'] = 'Üst Logo';
$lya['tema_logo_ust']['aciklama'] = 'Üst logo için yazı veya resim ekleyin.  Resim eklemek için img etiketi kullanın ve resmin tam adresini yazın.<br>Örnek: &lt;img src="http://www.siteadi.com/resim.jpg" style="position:absolute; left:0px; top:-15px"&gt;<br>Örnekteki top ve left değerlerini değiştirerek logonun yerini ayarlayabilirsiniz.';


$lya['tema_logo_alt']['baslik'] = 'Alt Logo';
$lya['tema_logo_alt']['secenek'] = '';
$lya['tema_logo_alt']['bilgi'] = 'Alt Logo';
$lya['tema_logo_alt']['aciklama'] = 'Alt logo için yazı veya resim ekleyin. Resim eklemek için img etiketi kullanın ve resmin tam adresini yazın.<br>Örnek: &lt;img src="http://www.siteadi.com/resim.jpg" style="position:absolute; left:0px; top:-15px"&gt;<br>Örnekteki top değerini değiştirerek logoyu yukarı aşağı oynatabilirsiniz.';


$lya['tema_uye_menusu']['baslik'] = 'Üyelik Menüsü Görünürlüğü';
$lya['tema_uye_menusu']['secenek'] = '1:Her zaman|0:Sadece giriş yapınca';
$lya['tema_uye_menusu']['bilgi'] = '';
$lya['tema_uye_menusu']['aciklama'] = 'En üstteki üyelik menüsünün ne zaman görünür olacağını seçin.';


$lya['tema_ust_alan']['baslik'] = 'Duyuru Alanı Tasarımı';
$lya['tema_ust_alan']['secenek'] = '1:Blok Tasarım|0:Tasarım Yok';
$lya['tema_ust_alan']['bilgi'] = '';
$lya['tema_ust_alan']['aciklama'] = 'Başlık menüsünün altına duyuru, reklam, vs. eklemek için kullanılan alanın tasarımı.';


$lya['tema_ust_alan_baslik']['baslik'] = 'Duyuru Alanı Başlık';
$lya['tema_ust_alan_baslik']['secenek'] = '';
$lya['tema_ust_alan_baslik']['bilgi'] = '';
$lya['tema_ust_alan_baslik']['aciklama'] = 'Duyuru veya reklam tablosunun başlığı.';


$lya['tema_ust_alan_kod']['baslik'] = 'Duyuru, Reklam, vs. Kodları';
$lya['tema_ust_alan_kod']['secenek'] = '';
$lya['tema_ust_alan_kod']['bilgi'] = 'HTML kullanabilirsiniz.';
$lya['tema_ust_alan_kod']['aciklama'] = 'Duyuru, reklam, vs. kodları. HTML kod eklenebilir. Ortalamak için kodları &lt;center&gt;<i>kodlar</i>&lt;/center&gt; arasına alın.';

?>