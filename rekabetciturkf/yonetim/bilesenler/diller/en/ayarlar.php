<?php
// phpKF-CMS v1.10
// Yönetim/Ayarlar Sayfası
// İngilizce Dil Dosyası



// Sayfa Başlıkları
$lya['genel_ayarlar'] = 'General Settings';
$lya['site_basliklari'] = 'Site Titles';
$lya['sayfalama_ayarlari'] = 'Page Settings';
$lya['seo_ayarlari'] = 'SEO Settings';
$lya['tarih_ayarlari'] = 'Date Settings';
$lya['uyelik_ayarlari'] = 'Member Settings';
$lya['kayit_ayarlari'] = 'Registration Settings';
$lya['resim_ayarlari'] = 'Image Settings';
$lya['eposta_ayarlari'] = 'Email Settings';
$lya['smtp_ayarlari'] = 'SMTP Settings';
$lya['duzenleyici_ayarlari'] = 'Editor Settings';
$lya['phpkf_duzenleyici_ayarlari'] = 'phpKF Editor Settings';
$lya['tinymce_duzenleyici_ayarlari'] = 'TinyMCE Editor Settings';
$lya['yukleme_ayarlari'] = 'Upload Settings';
$lya['tema_ayarlari'] = 'Theme Settings';
$lya['kurulu_eklentilerin_ayarlari'] = 'Settings for Installed Plugins';



// Sayfa Açıklamaları
$lya['tema_ayar_bilgi'] = 'Here you can change the custom settings added by the theme you are using.';
$lya['tema_ayar_yok'] = 'The theme you are using has no special settings.';
$lya['eklenti_ayar_bilgi'] = 'Here you can change the custom settings added by the plugins you install.';
$lya['eklenti_ayar_yok'] = 'There are no settings for installed extensions.';
$lya['isaretli_zorunlu'] = '* marked all fields are required!';
$lya['ayar_kaydet'] = 'Save Settings';





// Ayar başlık ve açıklamaları
$lya['site_adi']['baslik'] = 'Site Name';
$lya['site_adi']['secenek'] = '';
$lya['site_adi']['bilgi'] = 'Site Name';
$lya['site_adi']['aciklama'] = 'The site name that will appear in places like email, etc.';


$lya['alanadi']['baslik'] = 'Domainname';
$lya['alanadi']['secenek'] = '';
$lya['alanadi']['bilgi'] = 'Domainname';
$lya['alanadi']['aciklama'] = 'Site domainname information. Incorrect entry affects site operation. Do not enter http:// or https://';


$lya['dizin']['baslik'] = 'phpKF-CMS Directory';
$lya['dizin']['secenek'] = '';
$lya['dizin']['bilgi'] = 'phpKF-CMS Directory';
$lya['dizin']['aciklama'] = 'Directory where phpKF-CMS is installed. Incorrect entry affects site operation.
<br>Just add / append the directory to the end. Only enter / for the root directory.';


$lya['durum_anasayfa']['baslik'] = 'Home page';
$lya['durum_anasayfa']['secenek'] = '0:Latest Posts|2:Home Page Post|1:Custom Home Page';
$lya['durum_anasayfa']['bilgi'] = '';
$lya['durum_anasayfa']['aciklama'] = '';


$lya['anasyfdosya']['baslik'] = 'Custom Home Page File';
$lya['anasyfdosya']['secenek'] = '';
$lya['anasyfdosya']['bilgi'] = 'Enter file path and name';
$lya['anasyfdosya']['aciklama'] = '';


$lya['guncel_kat']['baslik'] = 'Latest Posts Category';
$lya['guncel_kat']['secenek'] = '0:All Categories|{KAT_ID}:{KATEGORILER}';
$lya['guncel_kat']['bilgi'] = '';
$lya['guncel_kat']['aciklama'] = 'The category in which the latest posts is displayed.';


$lya['guncel_yazi']['baslik'] = 'Latest Content Type';
$lya['guncel_yazi']['secenek'] = '2:Posts|0:Pages|4:Galleries|5:Videos|1:All content';
$lya['guncel_yazi']['bilgi'] = '';
$lya['guncel_yazi']['aciklama'] = 'The type of content to display as the latest posts.';


$lya['durum_sayfalar']['baslik'] = 'Categories and Pages';
$lya['durum_sayfalar']['secenek'] = '1:On|0:Off';
$lya['durum_sayfalar']['bilgi'] = '';
$lya['durum_sayfalar']['aciklama'] = 'You can close the "Categories - Pages" pages and links here.';


$lya['yazan_adi']['baslik'] = 'Author Name';
$lya['yazan_adi']['secenek'] = '0:User Name|1:Real Name';
$lya['yazan_adi']['bilgi'] = '';
$lya['yazan_adi']['aciklama'] = 'For the "Author" field seen in the text, choose the member name or real name.';


$lya['vt_hata']['baslik'] = 'Database Error messages';
$lya['vt_hata']['secenek'] = '0:Off|2:Only Error|1:Detailed Error';
$lya['vt_hata']['bilgi'] = '';
$lya['vt_hata']['aciklama'] = 'Off: Blank page appears, Only Error: "Query Failed" writer, Detailed Error: The error is written in detail. Turn on the "Detailed" setting only to see the error.';


$lya['durum_site']['baslik'] = 'Site Status';
$lya['durum_site']['secenek'] = '1:On|0:Off';
$lya['durum_site']['bilgi'] = '';
$lya['durum_site']['aciklama'] = 'In situations such as updating, it allows you to close the site outside the administrators.';


$lya['site_kapali']['baslik'] = 'Site Closed Posts';
$lya['site_kapali']['secenek'] = '';
$lya['site_kapali']['bilgi'] = 'Site Closed Posts';
$lya['site_kapali']['aciklama'] = 'It will be written when the site is closed or received. HTML usage.';


$lya['dil_varsayilan']['baslik'] = 'Default Language';
$lya['dil_varsayilan']['secenek'] = '{DIL_ID}:{DILLER}';
$lya['dil_varsayilan']['bilgi'] = '';
$lya['dil_varsayilan']['aciklama'] = 'The default language for your site.';


$lya['dil_eklenen']['baslik'] = 'Added languages';
$lya['dil_eklenen']['secenek'] = '';
$lya['dil_eklenen']['bilgi'] = '';
$lya['dil_eklenen']['aciklama'] = 'You can change the language order from this area. At first, it should be comma at the end and intervals. To cancel the language selection, enter only one comma. Adding/removing languages is done from the <a href="ayar_dil.php">following page.</a>';


$lya['forum_kullan']['baslik'] = 'phpKF Forum Usage';
$lya['forum_kullan']['secenek'] = '1:On|0:Off';
$lya['forum_kullan']['bilgi'] = '';
$lya['forum_kullan']['aciklama'] = 'The forum should be installed. <a href="http://www.phpkf.com/indirme.php" target="_blank">Click</a> to download. <a href="http://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">Click</a> for detailed information.';


$lya['portal_kullan']['baslik'] = 'phpKF-Portal Usage';
$lya['portal_kullan']['secenek'] = '1:On|0:Off';
$lya['portal_kullan']['bilgi'] = '';
$lya['portal_kullan']['aciklama'] = 'The portal should be installed. <a href="http://www.phpkf.com/indirme.php" target="_blank">Click</a> to download. <a href="http://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">Click</a> for detailed information.';


$lya['title_anasyf']['baslik'] = 'Website Title (Home Page)';
$lya['title_anasyf']['secenek'] = '';
$lya['title_anasyf']['bilgi'] = 'For Home Page';
$lya['title_anasyf']['aciklama'] = 'The title that will appear in the title of your web browser. For the home page. It is recommended that you keep 70 characters short for SEO.';


$lya['title']['baslik'] = 'Website Title (All Pages)';
$lya['title']['secenek'] = '';
$lya['title']['bilgi'] = 'For all pages';
$lya['title']['aciklama'] = 'The title that will appear in the title of your web browser. For all pages except the home page, you can leave it blank. It is recommended that you keep 70 characters short for SEO.';


$lya['site_taban']['baslik'] = 'Page Footer Text';
$lya['site_taban']['secenek'] = '';
$lya['site_taban']['bilgi'] = 'Page Footer Text';
$lya['site_taban']['aciklama'] = 'Entries will appear at the bottom of all pages. You can leave it blank.';


$lya['syfkota_guncel']['baslik'] = 'Number of Latest Posts';
$lya['syfkota_guncel']['secenek'] = '';
$lya['syfkota_guncel']['bilgi'] = '';
$lya['syfkota_guncel']['aciklama'] = 'Bir sayfada görünecek güncel yazı sayısı. Yer: Ana sayfa.';


$lya['syfkota_kat']['baslik'] = 'Category Number of Posts';
$lya['syfkota_kat']['secenek'] = '';
$lya['syfkota_kat']['bilgi'] = '';
$lya['syfkota_kat']['aciklama'] = 'Bir sayfada görünecek yazı sayısı. Yer: Kategoriler sayfası.';


$lya['syfkota_yorum']['baslik'] = 'Number of Comments';
$lya['syfkota_yorum']['secenek'] = '';
$lya['syfkota_yorum']['bilgi'] = '';
$lya['syfkota_yorum']['aciklama'] = 'Bir sayfada görünecek yorum sayısı. Yer: Yazı içerik sayfası.';


$lya['benzer_durum']['baslik'] = 'Similar Posts';
$lya['benzer_durum']['secenek'] = '1:On|0:Off';
$lya['benzer_durum']['bilgi'] = '';
$lya['benzer_durum']['aciklama'] = 'The status of similar text in the text content pages.';


$lya['benzer_kota']['baslik'] = 'Similar Number of Posts';
$lya['benzer_kota']['secenek'] = '';
$lya['benzer_kota']['bilgi'] = '';
$lya['benzer_kota']['aciklama'] = 'A similar number of posts to appear on a page. Location: Text content page.';


$lya['seo']['baslik'] = 'SEF Address Structure';
$lya['seo']['secenek'] = '0:Off|1:CategoryName-k1/PageName-y1.html|2:CategoryName/PageName.html|3:PageName-y1.html|4:PageName.html';
$lya['seo']['bilgi'] = '';
$lya['seo']['aciklama'] = 'If the links do not work, close this setting.
<br>Just change the site when it is first installed or the links that your search sites have saved will be invalid.';


$lya['dizin_kat']['baslik'] = 'Categories Directory';
$lya['dizin_kat']['secenek'] = '';
$lya['dizin_kat']['bilgi'] = 'Categories Directory';
$lya['dizin_kat']['aciklama'] = 'The virtual directory to display for the "Categories" page. It is linked to the SEF setting above.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['dizin_sayfa']['baslik'] = 'Pages Directory';
$lya['dizin_sayfa']['secenek'] = '';
$lya['dizin_sayfa']['bilgi'] = 'Pages Directory';
$lya['dizin_sayfa']['aciklama'] = 'The virtual directory to display for the "Pages" page. It is linked to the SEF setting above.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['dizin_galeri']['baslik'] = 'Galleries Directory';
$lya['dizin_galeri']['secenek'] = '';
$lya['dizin_galeri']['bilgi'] = 'Galleries Directory';
$lya['dizin_galeri']['aciklama'] = 'The virtual directory to display for the "Gallery" page. It is linked to the SEF setting above.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['dizin_video']['baslik'] = 'Videos Directory';
$lya['dizin_video']['secenek'] = '';
$lya['dizin_video']['bilgi'] = 'Videos Directory';
$lya['dizin_video']['aciklama'] = 'The virtual directory to display for the "Videos" page. It is linked to the SEF setting above.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['dizin_etiket']['baslik'] = 'Tags Directory';
$lya['dizin_etiket']['secenek'] = '';
$lya['dizin_etiket']['bilgi'] = 'Tags Directory';
$lya['dizin_etiket']['aciklama'] = 'The virtual directory to display for the "Tags" page.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['dizin_arama']['baslik'] = 'Search Directory';
$lya['dizin_arama']['secenek'] = '';
$lya['dizin_arama']['bilgi'] = 'Search Directory';
$lya['dizin_arama']['aciklama'] = 'The virtual directory to display for the "Search" page.
<br>Do not use spaces, capital letters, Turkish, or special characters.';


$lya['meta_description']['baslik'] = 'Meta Description';
$lya['meta_description']['secenek'] = '';
$lya['meta_description']['bilgi'] = 'Meta Description';
$lya['meta_description']['aciklama'] = 'Describe your site in a sentence. Up to 160 characters.<br>On the article pages this data is replaced with the article title.';


$lya['meta_keywords']['baslik'] = 'Meta Keywords';
$lya['meta_keywords']['secenek'] = '';
$lya['meta_keywords']['bilgi'] = 'Meta Keywords';
$lya['meta_keywords']['aciklama'] = 'Tags that identify your site. Separate tags from each other with , (comma). Up to 260 characters or 20 labels.<br>On the article pages, these are replaced by the text tags.';


$lya['meta_diger']['baslik'] = 'Other Meta and Header Codes';
$lya['meta_diger']['secenek'] = '';
$lya['meta_diger']['bilgi'] = 'Other Meta and Header Codes';
$lya['meta_diger']['aciklama'] = 'If you want to add other meta tags and &lt;head&gt; tags to your JavaScript, etc. you can enter codes here.<br>The following meta tags are automatically added: canonical, description, abstract, keywords, content-language, generator, publisher';


$lya['meta_sosyal']['baslik'] = 'Social Sharing Meta Tags';
$lya['meta_sosyal']['secenek'] = '';
$lya['meta_sosyal']['bilgi'] = 'Social Sharing Meta Tags';
$lya['meta_sosyal']['aciklama'] = 'You can enter meta tags for Facebook, Twitter, Linkedin, Google+, and other social networking sites here.<br>You can also use the following variables, which vary depending on the page where some are found:<br>{TITLE} {TITLE_ANASAYFA} {META_DESCRIPTION} {META_KEYWORDS}';


$lya['sosyal_imleme']['baslik'] = 'Social Sharing Codes';
$lya['sosyal_imleme']['secenek'] = '';
$lya['sosyal_imleme']['bilgi'] = 'Social Sharing Codes';
$lya['sosyal_imleme']['aciklama'] = 'Social sharing codes can be entered here. The added codes will appear next to the font heading on the font page.';


$lya['site_taban_kod']['baslik'] = 'Page Footer Codes to add';
$lya['site_taban_kod']['secenek'] = '';
$lya['site_taban_kod']['bilgi'] = 'Page Footer Codes to add';
$lya['site_taban_kod']['aciklama'] = 'The codes entered here are added to the footer of all pages.<br>Google Analytics, counter, add site, javascript, etc. you can enter any visible invisible code here.';


$lya['sef_adresler']['baslik'] = 'SEF Addresses';
$lya['sef_adresler']['secenek'] = '';
$lya['sef_adresler']['bilgi'] = 'SEF Addresses';
$lya['sef_adresler']['aciklama'] = 'This setting is for expert users! Add-ons can add settings here, do not delete added addresses.<br><br>You can use this field to forward addresses that are .php to .html etc.<br><u>Use</u>:&nbsp; dosya.html=directory/file.php &nbsp; Type every single lead in the lead and go to the bottom one.';


$lya['tarih']['baslik'] = 'Date Format';
$lya['tarih']['secenek'] = '0:date()|1:strftime()';
$lya['tarih']['bilgi'] = '';
$lya['tarih']['aciklama'] = '<br>The date format that will appear on the entire site. See the addresses below for further information.<br><br>
<b>date sample:&nbsp;</b> 31.12.2017-23:59:59
<br><b>strftime sample:&nbsp;</b> 31 December 2017 Wednesday-23:59:59';


$lya['tarih_bolge']['baslik'] = 'Date Region (for strftime)';
$lya['tarih_bolge']['secenek'] = '';
$lya['tarih_bolge']['bilgi'] = 'for strftime';
$lya['tarih_bolge']['aciklama'] = 'Use: <a href="http://www.php.net/date_default_timezone_set" target="_blank">date_default_timezone_set()</a>';


$lya['tarih_dil']['baslik'] = 'Date Language (for strftime)';
$lya['tarih_dil']['secenek'] = '';
$lya['tarih_dil']['bilgi'] = 'for strftime';
$lya['tarih_dil']['aciklama'] = 'Use: <a href="http://www.php.net/setlocale" target="_blank">setlocale()</a>';


$lya['tarih_bicimi']['baslik'] = 'Date Format';
$lya['tarih_bicimi']['secenek'] = '';
$lya['tarih_bicimi']['bilgi'] = '';
$lya['tarih_bicimi']['aciklama'] = 'Use: <a href="http://www.php.net/date" target="_blank">date()</a>, <a href="http://www.php.net/strftime" target="_blank">strftime()</a><br>
<p style="text-align:right">Adjusted View: &nbsp;{phpkf_tarih}</p>
<b>for date:&nbsp;</b> d.m.Y-H:i:s<br>
<b>for strftime:&nbsp;</b> %d %B %Y %A-%H:%M:%S<br>';


$lya['saat_dilimi']['baslik'] = 'Time Zone';
$lya['saat_dilimi']['secenek'] = '-12:UTC - 12|-11:UTC - 11|-10:UTC - 10|-9.5:UTC - 9.5|-9:UTC - 9|-8:UTC - 8|-7:UTC - 7|-6:UTC - 6|-5:UTC - 5|-4.5:UTC - 4.5|-4:UTC - 4|-3.5:UTC - 3.5|-3:UTC - 3|-2:UTC - 2|-1:UTC - 1|0:UTC + 0|1:UTC + 1|2:UTC + 2|3:UTC + 3|3.5:UTC + 3.5|4:UTC + 4|4.5:UTC + 4.5|5:UTC + 5|5.5:UTC + 5.5|6:UTC + 6|6.5:UTC + 6.5|7:UTC + 7|8:UTC + 8|8.75:UTC + 8.75|9:UTC + 9|9.5:UTC + 9.5|10:UTC + 10|10.5:UTC + 10.5|11:UTC + 11|11.5:UTC + 11.5|12:UTC + 12|12.75:UTC + 12.75|13:UTC + 13|14:UTC + 14';
$lya['saat_dilimi']['bilgi'] = '';
$lya['saat_dilimi']['aciklama'] = 'For Turkey (UTC +3) Select.';


$lya['bbcode']['baslik'] = 'BBCode';
$lya['bbcode']['secenek'] = '1:On|0:Off';
$lya['bbcode']['bilgi'] = '';
$lya['bbcode']['aciklama'] = 'Use of BBCode in the field of comment and signature.';


$lya['yorum_onay']['baslik'] = 'Confirmation of Comment';
$lya['yorum_onay']['secenek'] = '2:Everyone Excepting Administrators|1:Visitors Only|0:No one';
$lya['yorum_onay']['bilgi'] = '';
$lya['yorum_onay']['aciklama'] = 'Who needs comments from you?';


$lya['yorum_onay_kodu']['baslik'] = 'Comment Confirmation Code';
$lya['yorum_onay_kodu']['secenek'] = '1:On|0:Off';
$lya['yorum_onay_kodu']['bilgi'] = '';
$lya['yorum_onay_kodu']['aciklama'] = 'A confirmation code for visitors.';


$lya['yorum_siralama']['baslik'] = 'Comment Sorting';
$lya['yorum_siralama']['secenek'] = '1:Oldest to newest|0:Newest to oldest';
$lya['yorum_siralama']['bilgi'] = '';
$lya['yorum_siralama']['aciklama'] = 'The sort of comment sorting.';


$lya['yorum_sure']['baslik'] = 'Flood Times for Comments';
$lya['yorum_sure']['secenek'] = '';
$lya['yorum_sure']['bilgi'] = '';
$lya['yorum_sure']['aciklama'] = 'Wait time between two comments written: (seconds)';


$lya['uye_cevrimici_sure']['baslik'] = 'Online Time';
$lya['uye_cevrimici_sure']['secenek'] = '';
$lya['uye_cevrimici_sure']['bilgi'] = '';
$lya['uye_cevrimici_sure']['aciklama'] = 'Online time: (minutes)';


$lya['uye_kilit_sure']['baslik'] = 'Account Lockdown Time';
$lya['uye_kilit_sure']['secenek'] = '';
$lya['uye_kilit_sure']['bilgi'] = '';
$lya['uye_kilit_sure']['aciklama'] = 'The time that your account will remain locked after five unsuccessful attempts: (minutes)';


$lya['uye_imza_uzunluk']['baslik'] = 'The length of the user`s signature';
$lya['uye_imza_uzunluk']['secenek'] = '';
$lya['uye_imza_uzunluk']['bilgi'] = '';
$lya['uye_imza_uzunluk']['aciklama'] = 'Enter the maximum number of characters that can be written.';


$lya['k_cerez_zaman']['baslik'] = 'Cookie Validity Period';
$lya['k_cerez_zaman']['secenek'] = '';
$lya['k_cerez_zaman']['bilgi'] = '';
$lya['k_cerez_zaman']['aciklama'] = 'Session length in minutes. 10080 minutes = 7 days';


$lya['kayit_uyelik']['baslik'] = 'Member Recruitment';
$lya['kayit_uyelik']['secenek'] = '1:On|0:Off';
$lya['kayit_uyelik']['bilgi'] = '';
$lya['kayit_uyelik']['aciklama'] = 'Enables you to turn off member enrollment.';


$lya['kayit_hesap_etkin']['baslik'] = 'Account Activation Method';
$lya['kayit_hesap_etkin']['secenek'] = '0:Off|1:Member|2:Admin';
$lya['kayit_hesap_etkin']['bilgi'] = '';
$lya['kayit_hesap_etkin']['aciklama'] = 'Off: Activation is not required.
<br>Member: Verification is requested by sending an email to the registered member.
<br>Admin: In addition to email verification, administrator approval is required.';


$lya['kayit_onay_kodu']['baslik'] = 'Registration Confirmation Code';
$lya['kayit_onay_kodu']['secenek'] = '1:On|0:Off';
$lya['kayit_onay_kodu']['bilgi'] = '';
$lya['kayit_onay_kodu']['aciklama'] = 'The confirmation code that appears on the member registration page.';


$lya['kayit_soru']['baslik'] = 'Registration Question Status';
$lya['kayit_soru']['secenek'] = '1:On|0:Off';
$lya['kayit_soru']['bilgi'] = '';
$lya['kayit_soru']['aciklama'] = 'Use custom questions on the registration page to get rid of auto-registering bot scripts.';


$lya['kayit_sorusu']['baslik'] = 'Registration Question';
$lya['kayit_sorusu']['secenek'] = '';
$lya['kayit_sorusu']['bilgi'] = 'Registration Question';
$lya['kayit_sorusu']['aciklama'] = '';


$lya['kayit_cevabi']['baslik'] = 'Question Answer';
$lya['kayit_cevabi']['secenek'] = '';
$lya['kayit_cevabi']['bilgi'] = 'Question Answer';
$lya['kayit_cevabi']['aciklama'] = '';


$lya['uye_resim_yukle']['baslik'] = 'Image Upload Feature';
$lya['uye_resim_yukle']['secenek'] = '1:On|0:Off';
$lya['uye_resim_yukle']['bilgi'] = '';
$lya['uye_resim_yukle']['aciklama'] = 'Allows images to be uploaded to your server. This requires that you have write permission in the /phpkf-dosyalar/resimler/yuklenen/ directory.';


$lya['uye_resim_galerisi']['baslik'] = 'Picture Gallery';
$lya['uye_resim_galerisi']['secenek'] = '1:On|0:Off';
$lya['uye_resim_galerisi']['bilgi'] = '';
$lya['uye_resim_galerisi']['aciklama'] = 'Current directory: /phpkf-dosyalar/resimler/galeri/';


$lya['uye_resim_boyut']['baslik'] = 'Maximum File Size';
$lya['uye_resim_boyut']['secenek'] = '';
$lya['uye_resim_boyut']['bilgi'] = '';
$lya['uye_resim_boyut']['aciklama'] = 'Maximum file size in kilobytes (kb).';


$lya['uye_resim_yukseklik']['baslik'] = 'Maximum Image Height';
$lya['uye_resim_yukseklik']['secenek'] = '';
$lya['uye_resim_yukseklik']['bilgi'] = '';
$lya['uye_resim_yukseklik']['aciklama'] = 'Maximum height value in pixels (px).';


$lya['uye_resim_genislik']['baslik'] = 'Maximum Image Width';
$lya['uye_resim_genislik']['secenek'] = '';
$lya['uye_resim_genislik']['bilgi'] = '';
$lya['uye_resim_genislik']['aciklama'] = 'Maximum width value in pixels (px).';


$lya['v-uye_resmi']['baslik'] = 'Default Member Avatar';
$lya['v-uye_resmi']['secenek'] = '';
$lya['v-uye_resmi']['bilgi'] = 'Default Member Avatar';
$lya['v-uye_resmi']['aciklama'] = 'Default:&nbsp; /phpkf-dosyalar/resimler/varsayilan_resim.jpg';


$lya['v-ziyaretci_resmi']['baslik'] = 'Default Visitor Avatar';
$lya['v-ziyaretci_resmi']['secenek'] = '';
$lya['v-ziyaretci_resmi']['bilgi'] = 'Default Visitor Avatar';
$lya['v-ziyaretci_resmi']['aciklama'] = 'Default:&nbsp; /phpkf-dosyalar/resimler/gravatar.png';


$lya['site_posta']['baslik'] = 'Site Email Address';
$lya['site_posta']['secenek'] = '';
$lya['site_posta']['bilgi'] = 'Site Email Address';
$lya['site_posta']['aciklama'] = 'The email address you want to use for emails sent through the site.
<br>Email may not be sent if it does not match your web server or SMTP account.';


$lya['eposta_yontem']['baslik'] = 'EMail Method';
$lya['eposta_yontem']['secenek'] = 'mail:Server mail() function|smtp:SMTP server';
$lya['eposta_yontem']['bilgi'] = '';
$lya['eposta_yontem']['aciklama'] = '<br>The method to use for sending email.';


$lya['smtp_kd']['baslik'] = 'SMTP Authentication';
$lya['smtp_kd']['secenek'] = '1:On|0:Off';
$lya['smtp_kd']['bilgi'] = '';
$lya['smtp_kd']['aciklama'] = '<br>Do you want to authenticate your SMTP server?';


$lya['smtp_sunucu']['baslik'] = 'SMTP Server Address';
$lya['smtp_sunucu']['secenek'] = '';
$lya['smtp_sunucu']['bilgi'] = 'SMTP Server Address';
$lya['smtp_sunucu']['aciklama'] = 'Enter the SMTP server address. Usually it will be mail.DomainName.com.
<br>If the SMTP server requires SSL secure connection, add <b>ssl://</b> per address.';


$lya['smtp_kullanici']['baslik'] = 'SMTP Username';
$lya['smtp_kullanici']['secenek'] = '';
$lya['smtp_kullanici']['bilgi'] = 'SMTP Username';
$lya['smtp_kullanici']['aciklama'] = 'Fill in if the SMTP server requires it.
<br>Some servers may only need to be typed in username, in some cases Username@DomainName.com.';


$lya['smtp_sifre']['baslik'] = 'SMTP Password';
$lya['smtp_sifre']['secenek'] = '';
$lya['smtp_sifre']['bilgi'] = '';
$lya['smtp_sifre']['aciklama'] = 'Fill in if the SMTP server requires it.';


$lya['smtp_port']['baslik'] = 'SMTP Port';
$lya['smtp_port']['secenek'] = '';
$lya['smtp_port']['bilgi'] = '';
$lya['smtp_port']['aciklama'] = 'The default smtp port is 25. Port 587 is used in Turkey.
<br>You can learn which port your server is using from the hosting company.';


$lya['duzenleyici']['baslik'] = 'Text Editor';
$lya['duzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['duzenleyici']['bilgi'] = '';
$lya['duzenleyici']['aciklama'] = 'The editor to be used on the insert page.';


$lya['gduzenleyici']['baslik'] = 'Gallery Editor';
$lya['gduzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['gduzenleyici']['bilgi'] = '';
$lya['gduzenleyici']['aciklama'] = 'The editor to be used on the Add Gallery page.';


$lya['vduzenleyici']['baslik'] = 'Video Editor';
$lya['vduzenleyici']['secenek'] = 'varsayilan:phpKF';
$lya['vduzenleyici']['bilgi'] = '';
$lya['vduzenleyici']['aciklama'] = 'Editor to be used on video insert page.';


$lya['yduzenleyici']['baslik'] = 'Comment Editor';
$lya['yduzenleyici']['secenek'] = 'duz:Düz';
$lya['yduzenleyici']['bilgi'] = '';
$lya['yduzenleyici']['aciklama'] = 'The editor to be used in the comment field on the text content pages.';


$lya['duzenleyici_html_tema']['baslik'] = 'HTML Design<br><span style="font-size:11px;color:gray"><br>For content editors in the administration</span>';
$lya['duzenleyici_html_tema']['secenek'] = 'varsayilan:Modern (koyu, büyük)';
$lya['duzenleyici_html_tema']['bilgi'] = '';
$lya['duzenleyici_html_tema']['aciklama'] = 'Management content editor design. It is recommended that you delete the separators between the buttons when the classic is selected.';


$lya['duzenleyici_bbcode_tema']['baslik'] = 'BBCode Design<br><span style="font-size:11px;color:gray"><br>For comment editor</span>';
$lya['duzenleyici_bbcode_tema']['secenek'] = 'varsayilan:Modern (koyu, büyük)';
$lya['duzenleyici_bbcode_tema']['bilgi'] = '';
$lya['duzenleyici_bbcode_tema']['aciklama'] = 'Comment editor design. It is recommended that you delete the separators between the buttons when the classic is selected.';


$lya['duzenleyici_font']['baslik'] = 'Icon Font Address';
$lya['duzenleyici_font']['secenek'] = '';
$lya['duzenleyici_font']['bilgi'] = 'Icon Font Address';
$lya['duzenleyici_font']['aciklama'] = 'The font address used in the button icons.
<br>Default:&nbsp; https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';


$lya['dugme_html']['baslik'] = 'HTML Buttons<br><span style="font-size:11px;color:gray"><br>For content editors in the administration</span>';
$lya['dugme_html']['secenek'] = '';
$lya['dugme_html']['bilgi'] = 'HTML Buttons for content fields';
$lya['dugme_html']['aciklama'] = 'Leave a space between the button names. For the separator | (vertical line) For the new line; (semicolon). Leave blank for default. See the following information area for sample use.';


$lya['dugme_bbcode']['baslik'] = 'BBCode Buttons<br><span style="font-size:11px;color:gray"><br>For comment editor</span>';
$lya['dugme_bbcode']['secenek'] = '';
$lya['dugme_bbcode']['bilgi'] = 'BBCode Buttons for comment fields';
$lya['dugme_bbcode']['aciklama'] = 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih devam | youtube video audio | postimage yukleme | geri ileri';


$lya['dugme_kodlar']['baslik'] = 'External Buttons and Functions<br><span style="font-size:11px;color:gray"><br>Javascript code area</span>';
$lya['dugme_kodlar']['secenek'] = '';
$lya['dugme_kodlar']['bilgi'] = 'External button and function codes';
$lya['dugme_kodlar']['aciklama'] = 'Button creation codes, clickable function and / or floating layer codes, button image and style codes. <a href="#XXXXXX">Read more</a>';


$lya['dugme_stil']['baslik'] = 'External Button Style<br><span style="font-size:11px;color:gray"><br>CSS code field</span>';
$lya['dugme_stil']['secenek'] = '';
$lya['dugme_stil']['bilgi'] = 'External button style codes';
$lya['dugme_stil']['aciklama'] = 'Css style codes for external buttons. With the button id defined above, the css class name must be the same. <a href="#XXXXXX">Read more</a>';


$lya['yukleme_video']['baslik'] = 'Video Code';
$lya['yukleme_video']['secenek'] = '';
$lya['yukleme_video']['bilgi'] = 'Video Code';
$lya['yukleme_video']['aciklama'] = 'Video code for video formats such as MP4, WebM, Ogg with HTML 5 support.';


$lya['yukleme_embed']['baslik'] = 'Embed Code';
$lya['yukleme_embed']['secenek'] = '';
$lya['yukleme_embed']['bilgi'] = 'Embed Code';
$lya['yukleme_embed']['aciklama'] = 'Embed code for video formats that are not supported by HTML 5, that can be played with Media Player or Flash Player.';


$lya['yukleme_audio']['baslik'] = 'Audio Code';
$lya['yukleme_audio']['secenek'] = '';
$lya['yukleme_audio']['bilgi'] = 'Audio Code';
$lya['yukleme_audio']['aciklama'] = 'Audio code for all audio files.';


$lya['yukleme_dosya']['baslik'] = 'Downloadable File Types<br><span style="font-size:11px;color:gray"><br>For admins</span>';
$lya['yukleme_dosya']['secenek'] = '';
$lya['yukleme_dosya']['bilgi'] = '';
$lya['yukleme_dosya']['aciklama'] = 'Downloadable file extensions. Separate file extensions with (comma).';


$lya['yukleme_dosya_uye']['baslik'] = 'Downloadable File Types<br><span style="font-size:11px;color:gray"><br>For unauthorized users</span>';
$lya['yukleme_dosya_uye']['secenek'] = '';
$lya['yukleme_dosya_uye']['bilgi'] = '';
$lya['yukleme_dosya_uye']['aciklama'] = 'Leave the uploading feature blank to close the members.';


$lya['yukleme_dizin']['baslik'] = 'File Upload Directory<br><span style="font-size:11px;color:gray"><br>For admins</span>';
$lya['yukleme_dizin']['secenek'] = '';
$lya['yukleme_dizin']['bilgi'] = '';
$lya['yukleme_dizin']['aciklama'] = 'The directory where the files will be installed. Do not put a / (divided) at the beginning and end. You need to be able to write a directory for the installation process. (chmod 777) <br>Default: phpkf-dosyalar/yuklemeler';


$lya['yukleme_dizin_uye']['baslik'] = 'Dosya Yükleme Dizini<br><span style="font-size:11px;color:gray"><br>For unauthorized users</span>';
$lya['yukleme_dizin_uye']['secenek'] = '';
$lya['yukleme_dizin_uye']['bilgi'] = '';
$lya['yukleme_dizin_uye']['aciklama'] = 'You can use {uye_id} in the directory name for each folder for each folder.
<br>Sample: phpkf-dosyalar/yuklemeler/uyeler/{uye_id}
<br>Default: phpkf-dosyalar/yuklemeler/uyeler';


$lya['yukleme_genislik']['baslik'] = 'Smallest Image Width';
$lya['yukleme_genislik']['secenek'] = '';
$lya['yukleme_genislik']['bilgi'] = '';
$lya['yukleme_genislik']['aciklama'] = 'Auto-resized image width in pixels';


$lya['yukleme_yukseklik']['baslik'] = 'Smallest Image Height';
$lya['yukleme_yukseklik']['secenek'] = '';
$lya['yukleme_yukseklik']['bilgi'] = '';
$lya['yukleme_yukseklik']['aciklama'] = 'Automatically reduced image height in pixels';


$lya['yukleme_kalite']['baslik'] = 'Image Quality';
$lya['yukleme_kalite']['secenek'] = '';
$lya['yukleme_kalite']['bilgi'] = '';
$lya['yukleme_kalite']['aciklama'] = 'Automatically reduced image quality (1 - 100)';


$lya['tinymce_dosya']['baslik'] = 'Main Script File';
$lya['tinymce_dosya']['secenek'] = '';
$lya['tinymce_dosya']['bilgi'] = 'Main Script File';
$lya['tinymce_dosya']['aciklama'] = 'The main script file that enables TinyMCE to work. By default, it is loaded from the remote server.
<br>Default:&nbsp; //cdn.tinymce.com/4/tinymce.min.js';


$lya['tinymce_dizin']['baslik'] = 'TinyMCE Directory';
$lya['tinymce_dizin']['secenek'] = '';
$lya['tinymce_dizin']['bilgi'] = 'TinyMCE Directory';
$lya['tinymce_dizin']['aciklama'] = 'The directory where the TinyMCE files are located.
<br>Default:&nbsp; /phpkf-bilesenler/editor/tinymce/';


$lya['tinymce_language']['baslik'] = 'TinyMCE Language Selection';
$lya['tinymce_language']['secenek'] = '';
$lya['tinymce_language']['bilgi'] = 'TinyMCE Language Selection';
$lya['tinymce_language']['aciklama'] = 'For Turkish (cdn) &nbsp; <b>language_url:tinymce_dizin+"/langs/tr_TR.js",</b>
<br>For Turkish (local) &nbsp; <b>language : "tr_TR",</b>
<br>Leave blank for English.';


$lya['tinymce_toolbar']['baslik'] = 'Toolbar';
$lya['tinymce_toolbar']['secenek'] = '';
$lya['tinymce_toolbar']['bilgi'] = 'Toolbar';
$lya['tinymce_toolbar']['aciklama'] = 'The buttons on the toolbar. &nbsp; toolbar: içine eklenen buton adları. <a href="https://www.tinymce.com/docs/configure/editor-appearance/#toolbar" target="_blank">Read more</a>';


$lya['tinymce_plugins']['baslik'] = 'Plugins';
$lya['tinymce_plugins']['secenek'] = '';
$lya['tinymce_plugins']['bilgi'] = 'Plugins';
$lya['tinymce_plugins']['aciklama'] = 'plugins:[] plugin names that are included in. <a href="https://www.tinymce.com/docs/configure/integration-and-setup/#plugins" target="_blank">Read more</a>';


$lya['tinymce_harici_plugins']['baslik'] = 'External Plugins';
$lya['tinymce_harici_plugins']['secenek'] = '';
$lya['tinymce_harici_plugins']['bilgi'] = 'External Plugins';
$lya['tinymce_harici_plugins']['aciklama'] = 'Use: You can install the plugin remotely with tinymce.PluginManager.load() function.';


$lya['tinymce_style']['baslik'] = 'Format Menu';
$lya['tinymce_style']['secenek'] = '';
$lya['tinymce_style']['bilgi'] = 'Biçimler Menüsü';
$lya['tinymce_style']['aciklama'] = 'The upper "Format" menu has submenu options under the "Formats" menu. &nbsp; style_formats: button names added to. <a href="https://www.tinymce.com/docs/configure/content-formatting/#style_formats" target="_blank">Read more</a>';


$lya['tinymce_init']['baslik'] = 'Settings';
$lya['tinymce_init']['secenek'] = '';
$lya['tinymce_init']['bilgi'] = 'Settings';
$lya['tinymce_init']['aciklama'] = 'Settings added to tinyMCE.init(). <a href="https://www.tinymce.com/docs/advanced/creating-a-plugin/#exampleinit" target="_blank">Read more</a>';


$lya['tinymce_dahili']['baslik'] = 'Internal Functions';
$lya['tinymce_dahili']['secenek'] = '';
$lya['tinymce_dahili']['bilgi'] = 'Internal Functions';
$lya['tinymce_dahili']['aciklama'] = 'For situations such as adding custom buttons &nbsp; setup: functions added to setup. <a href="https://www.tinymce.com/docs/configure/integration-and-setup/#setup" target="_blank">Read more</a>';


$lya['tinymce_harici']['baslik'] = 'External Functions';
$lya['tinymce_harici']['secenek'] = '';
$lya['tinymce_harici']['bilgi'] = 'External Functions';
$lya['tinymce_harici']['aciklama'] = 'External functions added outside of tinyMCE.init() for special operations of special buttons.';


$lya['tema_genislik']['baslik'] = 'Page Width';
$lya['tema_genislik']['secenek'] = '';
$lya['tema_genislik']['bilgi'] = '95%';
$lya['tema_genislik']['aciklama'] = 'Enter the width value in percent and in pixels. It is advisable to enter a percentage value because of the responsive nature of the default theme.<br>When fixed value is entered, sensitive structure does not work according to window size. <br>Sample: 95% veya 1200px';


$lya['tema_logo_ust']['baslik'] = 'Top Logo';
$lya['tema_logo_ust']['secenek'] = '';
$lya['tema_logo_ust']['bilgi'] = 'Top Logo';
$lya['tema_logo_ust']['aciklama'] = 'Add text or an image for the top logo. Use the img tag to insert the image and type the full address of the image.<br>Sample: &lt;img src="http://www.siteadi.com/resim.jpg" style="position:absolute; left:0px; top:-15px"&gt;<br>You can adjust the logon location by changing the values of top and left in the example.';


$lya['tema_logo_alt']['baslik'] = 'Bottom Logo';
$lya['tema_logo_alt']['secenek'] = '';
$lya['tema_logo_alt']['bilgi'] = 'Bottom Logo';
$lya['tema_logo_alt']['aciklama'] = 'Add text or images for the bottom logo. Use the img tag to insert the image and type the full address of the image.<br>Sample: &lt;img src="http://www.siteadi.com/resim.jpg" style="position:absolute; left:0px; top:-15px"&gt;<br>By changing the top value in the example you can move the logos up and down.';


$lya['tema_uye_menusu']['baslik'] = 'Member Menu Visibility';
$lya['tema_uye_menusu']['secenek'] = '1:Always|0:Just login';
$lya['tema_uye_menusu']['bilgi'] = '';
$lya['tema_uye_menusu']['aciklama'] = 'Choose when the top membership menu will be visible.';


$lya['tema_ust_alan']['baslik'] = 'Announcement Area Design';
$lya['tema_ust_alan']['secenek'] = '1:BBlock Design|0:No Design';
$lya['tema_ust_alan']['bilgi'] = '';
$lya['tema_ust_alan']['aciklama'] = 'The design of the field used to add announcements, advertisements, etc. under the title menu.';


$lya['tema_ust_alan_baslik']['baslik'] = 'Announcement Area Title';
$lya['tema_ust_alan_baslik']['secenek'] = '';
$lya['tema_ust_alan_baslik']['bilgi'] = '';
$lya['tema_ust_alan_baslik']['aciklama'] = 'The title of the announcement or ad table.';


$lya['tema_ust_alan_kod']['baslik'] = 'Announcements, Ads, etc. Codes';
$lya['tema_ust_alan_kod']['secenek'] = '';
$lya['tema_ust_alan_kod']['bilgi'] = 'You can use HTML.';
$lya['tema_ust_alan_kod']['aciklama'] = 'Announcement, advertisement, etc. codes. HTML code can be added. Place codes for centering in &lt;center&gt;<i>codes</i>&lt;/center&gt;.';

?>