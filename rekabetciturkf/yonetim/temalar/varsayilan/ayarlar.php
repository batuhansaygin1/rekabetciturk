<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik">

<form action="bilesenler/ayarlar_yap.php" method="post" onsubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<?php echo $form_ek; ?>


<script type="text/javascript"><!-- //
function denetle(){
	var dogruMu = true;
	for (var i=0; i<document.form1.length; i++)
	{
		if (document.form1.elements[i].name=="kul_resim") continue;
		else if (document.form1.elements[i].name=="smtp_sunucu") continue;
		else if (document.form1.elements[i].name=="smtp_kullanici") continue;
		else if (document.form1.elements[i].name=="smtp_sifre") continue;
		else if (document.form1.elements[i].name=="meta_diger") continue;
		else if (document.form1.elements[i].name=="site_taban_kod") continue;
		else if (document.form1.elements[i].name=="dugme_html") continue;
		else if (document.form1.elements[i].name=="dugme_bbcode") continue;
		else if (document.form1.elements[i].name=="dugme_kodlar") continue;
		else if (document.form1.elements[i].name=="dugme_stil") continue;

		if (document.form1.elements[i].value=="")
		{
			dogruMu = false;
			alert("SMTP ayarları ve varsayılan üye resmi hariç, \nTüm alanların doldurulması zorunludur !");
			break;
		}
	}
	return dogruMu;
}
// -->
</script>

<table cellspacing="1" width="100%" cellpadding="9" border="0" align="left" bgcolor="#d0d0d0">




<?php if ( (isset($_GET['kip'])) AND ($_GET['kip'] =='eposta') ): ?>

<!--  E-POSTA AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Yönetici E-Posta adresi:
<br>
<font size="1">
Web sunucu veya smtp hesabınızla uyuşmazsa E-Posta yollayamayabilirsiniz.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<input class="formlar" type="text" name="y_posta" size="30" maxlength="100" value="<?php echo $y_posta; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
E-Posta göndermede kullanılacak yöntem:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="eposta_yontem" value="mail" <?php echo $eposta_mail; ?>>mail() &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="eposta_yontem" value="smtp" <?php echo $eposta_smtp; ?>>SMTP</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" colspan="2" align="left">
<br>
<i>SMTP seçili ise aşağıdaki alanların doldurulması zorunludur !</i>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SMTP sunucusu,<br>kimlik doğrulaması gerektiriyor mu?
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="smtp_kd" value="true" <?php echo $smtp_kd_acik; ?>>Evet &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="smtp_kd" value="false" <?php echo $smtp_kd_kapali; ?>>Hayır</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SMTP sunucu adresi:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="smtp_sunucu" size="30" maxlength="100" value="<?php echo $smtp_sunucu; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SMTP kullanıcı adı:
<font size="1">
<br>smtp sunucu gerektiriyorsa doldurun.
<br>Bazı sunucularda sadece kullanıcı adı, bazılarındaysa KullanıcıAdı@AlanAdı.com şeklinde yazılması gerekebilir.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="smtp_kullanici" size="30" maxlength="100" value="<?php echo $smtp_kullanici; ?>" autocomplete="off">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SMTP şifresi:
<font size="1">
<br>smtp sunucu gerektiriyorsa doldurun.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="password" name="smtp_sifre" size="30" maxlength="100" value="sifre_degismedi" autocomplete="new-password">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SMTP portu:
<font size="1">
<br>Varsayılan smtp portu 25`dir. Türk Telekom 25. portu engellediği için Türkiye`de 587 kullanılmaktadır.
<br>Sunucunuzun hangi portu kullandığını hosting firmanızdan öğrenebilirsiniz.

</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="smtp_port" size="6" maxlength="6" value="<?php echo $smtp_port; ?>">
	</td>
	</tr>

<!--  E-POSTA AYARLARI - SONU  -->







<?php elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] =='ozel_ileti') ): ?>

<!--  ÖZEL İLETİ AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Özel ileti Özelliği:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<label style="cursor: pointer;">
<input type="radio" name="o_ileti" value="1" <?php echo $o_ileti_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="o_ileti" value="0" <?php echo $o_ileti_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Özel ileti E-Posta Uyarısı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="oi_uyari" value="1" <?php echo $oi_uyari_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="oi_uyari" value="0" <?php echo $oi_uyari_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Gelen Kutusu Kotası:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="gelen_kutu_kota" size="5" maxlength="3" value="<?php echo $gelen_kutu_kota; ?>">
	</td>
	</tr>
	
	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Ulaşan Kutusu Kotası:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="ulasan_kutu_kota" size="5" maxlength="3" value="<?php echo $ulasan_kutu_kota; ?>">
	</td>
	</tr>
	
	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kaydedilen Kutusu Kotası:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kaydedilen_kutu_kota" size="5" maxlength="3" value="<?php echo $kaydedilen_kutu_kota; ?>">
	</td>
	</tr>

<!--  ÖZEL İLETİ AYARLARI - SONU  -->








<?php elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] =='cms') ): ?>

<!--  CMS VE PORTAL AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
phpKF-CMS Kullanımı:<br>
<font size="1">
CMS kurulu olmalıdır. İndirmek için <a href="http://www.phpkf.com/indirme.php" target="_blank">tıklayın.</a>
<br>CMS entegrasyonu ile ilgili ayrıntılı bilgi için <a href="http://www.phpkf.com/k4368-cms-forum-portal-ortak-kullanimi-entegrasyon-.html" target="_blank">tıklayın.</a>
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<label style="cursor: pointer;">
<input type="radio" name="cms_kullan" value="1" <?php echo $cms_kullan_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="cms_kullan" value="0" <?php echo $cms_kullan_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
CMS içinden:<br>
<font size="1">
Forumun CMS içinden çalışmasını sağlar. Tüm forum sayfalarında CMS başlık bölümü kullanılır.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="cms_icinden" value="1" <?php echo $cms_icinden_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="cms_icinden" value="0" <?php echo $cms_icinden_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
phpKF-Portal Kullanımı:<br>
<font size="1">
Portal kurulu olmalıdır. İndirmek için <a href="http://www.phpkf.com/indirme.php" target="_blank">tıklayın.</a>
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="portal" value="1" <?php echo $portal_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="portal" value="0" <?php echo $portal_kapali; ?>>Kapalı</label>
	</td>
	</tr>

<!--  CMS VE PORTAL AYARLARI - SONU  -->









<?php elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] =='uyelik') ): ?>

<!-- ÜYELİK AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
BBCode:<br>
<font size="1">
Yazılarda zengin içerik kullanmak için BBCode ayarı
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="bbcode" value="1" <?php echo $bbcode_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="bbcode" value="0" <?php echo $bbcode_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Çevrimiçi Süresi: (dakika)
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<input class="formlar" type="text" name="cevrimici" size="3" maxlength="3" value="<?php echo $cevrimici; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kullanıcıların, gönderdiği iki ileti arasındaki bekleme süresi: (saniye)
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="ileti_sure" size="6" maxlength="5" value="<?php echo $ileti_sure; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Beş başarısız girişten sonra hesabın kilitli kalacağı süre: (dakika)
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kilit_sure" size="5" maxlength="4" value="<?php echo $kilit_sure; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kullanıcı imzasının uzunluğu:<br>
<font size="1">
Verebileceğiniz en büyük değer 500'dür.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="imza_uzunluk" size="4" maxlength="3" value="<?php echo $imza_uzunluk; ?>">
	</td>
	</tr>


	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
Kayıt Ayarları
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Üye Alımı:<br>
<font size="1">
Üye kayıt sayfasını kapatmanızı sağlar.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<label style="cursor: pointer;">
<input type="radio" name="uye_kayit" value="1" <?php echo $uye_kayit_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="uye_kayit" value="0" <?php echo $uye_kayit_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Hesap Etkinleştirme Şekli:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="hesap_etkin" value="0" <?php echo $hesap_etkin_kapali; ?>>Kapalı</label> &nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="hesap_etkin" value="1" <?php echo $hesap_etkin_kullanici; ?>>Kullanıcı</label> &nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="hesap_etkin" value="2" <?php echo $hesap_etkin_yonetici; ?>>Yönetici</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kayıt Sayfasındaki Onay Kodu:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="kayit_onay" value="1" <?php echo $kayit_onay_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="kayit_onay" value="0" <?php echo $kayit_onay_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Otomatik kayıt yapan robot programlardan kurtulmak için, kayıt sayfasında özel soru kullan.
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="kayit_soru" value="1" <?php echo $kayit_soru_acik; ?>>Evet &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="kayit_soru" value="0" <?php echo $kayit_soru_kapali; ?>>Hayır</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kayıt Sorusu:
<br><br>
Sorunun Cevabı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kayit_sorusu" size="35" maxlength="100" value="<?php echo $kayit_sorusu; ?>">
<br><br>
<input class="formlar" type="text" name="kayit_cevabi" size="35" maxlength="100" value="<?php echo $kayit_cevabi; ?>">
	</td>
	</tr>




	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
Yetki Adı Ayarları
	</td>
	</tr>


	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Site kurucusunun görünen adı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<input class="formlar" type="text" name="kurucu" size="30" maxlength="100" value="<?php echo $kurucu; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forum yöneticilerinin görünen adı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yonetici" size="30" maxlength="100" value="<?php echo $yonetici; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forum yardımcılarının görünen adı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yardimci" size="30" maxlength="100" value="<?php echo $yardimci; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Bölüm yardımcılarının görünen adı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="blm_yrd" size="30" maxlength="100" value="<?php echo $blm_yrd; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Kayıtlı kullanıcıların görünen adı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kullanici" size="30" maxlength="100" value="<?php echo $kullanici; ?>">
	</td>
	</tr>






	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
Üye Resim Ayarları
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Resim yükleme özelliği:<br>
<font size="1">
Resimlerin sunucunuza yüklemesini sağlar. Bunun için /dosyalar/resimler/yuklenen/ dizininde yazma izninizin olması gerekir.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<label style="cursor: pointer;">
<input type="radio" name="resim_yukle" value="1" <?php echo $resim_yukle_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="resim_yukle" value="0" <?php echo $resim_yukle_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Uzak resim özelliği:<br>
<font size="1">
Kullanıcıların url adresi göstererek başka sunuculardan resim eklemelerini sağlar.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="uzak_resim" value="1" <?php echo $uzak_resim_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="uzak_resim" value="0" <?php echo $uzak_resim_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Resim galerisi:<br>
<font size="1">
Geçerli dizin: /dosyalar/resimler/galeri/
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="resim_galerisi" value="1" <?php echo $resim_galerisi_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="resim_galerisi" value="0" <?php echo $resim_galerisi_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
En yüksek dosya büyüklüğü:<br>
<font size="1">
(kilobayt cinsinden)
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="resim_boyut" size="5" maxlength="4" value="<?php echo $resim_boyut; ?>"> kb
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
En yüksek resim boyutu:<br>
<font size="1">
(Yükseklik x Genişlik)
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="resim_yukseklik" size="4" maxlength="3" value="<?php echo $resim_yukseklik; ?>">
&nbsp;X&nbsp;
<input class="formlar" type="text" name="resim_genislik" size="4" maxlength="3" value="<?php echo $resim_genislik; ?>"> px
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Varsayılan kullanıcı resmi:<br>
<font size="1">
Örnek: dosyalar/resimler/galeri/resim_yok.png
<br>Kapatmak için boş bırakın.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kul_resim" size="35" maxlength="100" value="<?php echo $kul_resim; ?>">
	</td>
	</tr>

<!-- ÜYELİK AYARLARI - SONU  -->








<?php elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] =='yukleme') ): ?>

<!-- YÜKLEME AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Yüklenebilir Dosya Tipleri:<br>
<font size="1">
Yüklenebilir dosya uzantıları. Dosya uzantılarını birbirinden , (virgül) ile ayırın.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<input class="formlar" type="text" name="yukleme_dosya" size="35" maxlength="500" style="width:96%" value="<?php echo $yukleme_dosya; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Dosya Yükleme Dizini:<br>
<font size="1">
Dosyaların yükleneceği dizini. Yükleme işlemi için dizine yazma hakkı vermelisiniz. (chmod 777)
<br>Varsayılan: dosyalar/yuklemeler
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yukleme_dizin" size="35" maxlength="100" value="<?php echo $yukleme_dizin; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Azami Dosya Büyüklüğü:<br>
<font size="1">
Yüklenilen dosyanın kb cinsinden boyutu
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yukleme_boyut" size="12" maxlength="10" value="<?php echo $yukleme_boyut; ?>"> kb
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Azami Resim Genişliği:<br>
<font size="1">
Yüklenilen resmin piksel cinsinden genişliği
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yukleme_genislik" size="7" maxlength="5" value="<?php echo $yukleme_genislik; ?>"> px
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Azami Resim Yüksekliği:<br>
<font size="1">
Yüklenilen resmin piksel cinsinden yüksekliği
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yukleme_yukseklik" size="7" maxlength="5" value="<?php echo $yukleme_yukseklik; ?>"> px
	</td>
	</tr>

<!-- YÜKLEME AYARLARI - SONU  -->







<?php elseif ( (isset($_GET['kip'])) AND ($_GET['kip'] =='duzenleyici') ): ?>

<!-- DÜZENLEYİCİ AYARLARI - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
HTML Metin Düzenleyici:<br>
<font size="1">
Yönetim duyuru vs. yazı ekleme sayfalarında kullanılacak editör
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<?php echo $dduzenleyici; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
BBCode Metin Düzenleyici:<br>
<font size="1">
Normal yazı ekleme sayfalarında kullanılacak editör
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<?php echo $duzenleyici; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Hızlı Cevap BBCode Metin Düzenleyici:<br>
<font size="1">
Hızlı cevap yazı ekleme sayfalarında kullanılacak editör
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<?php echo $yduzenleyici; ?>
	</td>
	</tr>




	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
phpKF Düzenleyici Ayarları
	</td>
	</tr>


	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
HTML Tasarım:<br>
<font size="1">
Yönetim içerik düzenleyici tasarımı. Klasik seçildiğinde düğmeler arasındaki ayraçlarları silmeniz önerilir.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<select name="duzenleyici_html_tema" class="formlar" style="width:auto">
<option value="varsayilan"<?php echo (($duzenleyici_html_tema == 'varsayilan') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, büyük)</option>
<option value="varsayilan_kucuk"<?php echo (($duzenleyici_html_tema == 'varsayilan_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, küçük)</option>
<option value="modern_acik"<?php echo (($duzenleyici_html_tema == 'modern_acik') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, büyük)</option>
<option value="modern_acik_kucuk"<?php echo (($duzenleyici_html_tema == 'modern_acik_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, küçük)</option>
<option value="klasik_koyu"<?php echo (($duzenleyici_html_tema == 'klasik_koyu') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, büyük)</option>
<option value="klasik_koyu_kucuk"<?php echo (($duzenleyici_html_tema == 'klasik_koyu_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, küçük)</option>
<option value="klasik_acik"<?php echo (($duzenleyici_html_tema == 'klasik_acik') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, büyük)</option>
<option value="klasik_acik_kucuk"<?php echo (($duzenleyici_html_tema == 'klasik_acik_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, küçük)</option>
</select>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
BBCode Tasarım:<br>
<font size="1">
Mesaj düzenleyici tasarımı. Klasik seçildiğinde düğmeler arasındaki ayraçlarları silmeniz önerilir.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<select name="duzenleyici_bbcode_tema" class="formlar" style="width:auto">
<option value="varsayilan"<?php echo (($duzenleyici_bbcode_tema == 'varsayilan') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, büyük)</option>
<option value="varsayilan_kucuk"<?php echo (($duzenleyici_bbcode_tema == 'varsayilan_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, küçük)</option>
<option value="modern_acik"<?php echo (($duzenleyici_bbcode_tema == 'modern_acik') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, büyük)</option>
<option value="modern_acik_kucuk"<?php echo (($duzenleyici_bbcode_tema == 'modern_acik_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, küçük)</option>
<option value="klasik_koyu"<?php echo (($duzenleyici_bbcode_tema == 'klasik_koyu') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, büyük)</option>
<option value="klasik_koyu_kucuk"<?php echo (($duzenleyici_bbcode_tema == 'klasik_koyu_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, küçük)</option>
<option value="klasik_acik"<?php echo (($duzenleyici_bbcode_tema == 'klasik_acik') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, büyük)</option>
<option value="klasik_acik_kucuk"<?php echo (($duzenleyici_bbcode_tema == 'klasik_acik_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, küçük)</option>
</select>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Hizli Cevap Tasarım:<br>
<font size="1">
Hızlı cevap düzenleyici tasarımı. Klasik seçildiğinde düğmeler arasındaki ayraçlarları silmeniz önerilir.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<select name="duzenleyici_hizli_tema" class="formlar" style="width:auto">
<option value="varsayilan"<?php echo (($duzenleyici_hizli_tema == 'varsayilan') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, büyük)</option>
<option value="varsayilan_kucuk"<?php echo (($duzenleyici_hizli_tema == 'varsayilan_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (koyu, küçük)</option>
<option value="modern_acik"<?php echo (($duzenleyici_hizli_tema == 'modern_acik') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, büyük)</option>
<option value="modern_acik_kucuk"<?php echo (($duzenleyici_hizli_tema == 'modern_acik_kucuk') ? 'selected="selected"' : ''); ?>>Modern Düz (açık, küçük)</option>
<option value="klasik_koyu"<?php echo (($duzenleyici_hizli_tema == 'klasik_koyu') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, büyük)</option>
<option value="klasik_koyu_kucuk"<?php echo (($duzenleyici_hizli_tema == 'klasik_koyu_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (koyu, küçük)</option>
<option value="klasik_acik"<?php echo (($duzenleyici_hizli_tema == 'klasik_acik') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, büyük)</option>
<option value="klasik_acik_kucuk"<?php echo (($duzenleyici_hizli_tema == 'klasik_acik_kucuk') ? 'selected="selected"' : ''); ?>>Klasik Buton (açık, küçük)</option>
</select>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Simge Font Adresi:<br>
<font size="1">
Düğme simgelerinde kullanılan font adresi. Varsayılan:<br>
https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="duzenleyici_font" size="35" maxlength="100" style="width:96%" value="<?php echo $duzenleyici_font; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
HTML Düğmeler:<br>
<font size="1">
Yönetimdeki içerik düzenleyiciler için.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="dugme_html" style="height:90px; width:95%" cols="30" rows="3"><?php echo $dugme_html; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
BBCode Düğmeler:<br>
<font size="1">
Konu, cevap ve özel ileti düzenleyici için.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="dugme_bbcode" style="height:90px; width:95%" cols="30" rows="3"><?php echo $dugme_bbcode; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Hızlı Cevap Düğmeler:<br>
<font size="1">
Hızlı cevap düzenleyici için.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="dugme_hizli" style="height:90px; width:95%" cols="30" rows="3"><?php echo $dugme_hizli; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" colspan="2">
HTML ve BBCode Düğmeleri Yardım:<br>
<font size="1">
Düğme isimleri arasında boşluk bırakın. Ayraç için | (dikey çizgi) Yeni satır için ; (noktalı virgül) kullanabilirsiniz. Varsayılan için boş bırakın. Örnek kullanım için aşağıdaki yazıya bakın.<br><br>
</font>
Tüm Düğmeler:<br>
<font size="1">
kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih | youtube video audio | postimage yukleme | geri ileri
</font>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Harici Düğme ve Fonksiyonlar:<br>
<font size="1">
Javascript kod alanı.<br>
Düğme oluşturma kodları, tıklayınca çalışacak fonksiyon ve/veya yüzer katman kodları, düğme resim ve stil kodları. <b>Bakınız</b>
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="dugme_kodlar" style="height:140px; width:95%" cols="30" rows="6"><?php echo $dugme_kodlar; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Harici Düğme Stil:<br>
<font size="1">
CSS kod alanı.<br>
Harici düğmeler için css stil kodları. Yanda tanımlanan düğme id ile, css class adı aynı olmalıdır. <b>Bakınız</b>
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="dugme_stil" style="height:140px; width:95%" cols="30" rows="6"><?php echo $dugme_stil; ?></textarea>
	</td>
	</tr>

<!-- DÜZENLEYİCİ AYARLARI - SONU  -->










<?php else: ?>

<!--  GENEL AYARLAR - BAŞI  -->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="40%">
Tarayıcı Site Başlığı (Title):
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left" width="60%">
<input class="formlar" type="text" name="title" size="35" maxlength="100" style="width:96%" value="<?php echo $site_title; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Ana Sayfa ve E-Postalarda Görünecek Site Adı:<br>
<font size="1">
Sadece desteklenen temalarda görünür. Varsayılan temada görünmez.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="anasyfbaslik" size="35" maxlength="100" style="width:96%" value="<?php echo $anasyfbaslik; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Sayfa Taban Yazısı
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="syfbaslik" size="35" maxlength="100" style="width:96%" value="<?php echo $syfbaslik; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forumun alanadı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
http(s):// <input class="formlar" type="text" name="alanadi" size="35" maxlength="100" value="<?php echo $alanadi; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forumun bulunduğu dizin:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="f_dizin" size="21" maxlength="100" value="<?php echo $f_dizin; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Zaman dilimi:<br>
<font size="1">
Türkiye için (UTC +3) seçin.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<?php echo $saat_dilimi; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forumda kullanılan tarih biçimi:<br>
<font size="1">
Geçerli biçim, PHP'nin <a href="http://www.php.net/date">date()</a> fonksiyonudur.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="tarih_bicimi" size="21" maxlength="20" value="<?php echo $tarih_bicimi; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Çerez geçerlilik süresi:<br>
<font size="1">
Dakika cinsinden oturum uzunluğu. (10080 = 7 gün)
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
	<input class="formlar" type="text" name="k_cerez_zaman" size="6" maxlength="5" value="<?php echo $k_cerez_zaman; ?>">
	</td>
	</tr>


	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Forum durumu:<br>
<font size="1">
Güncelleme gibi durumlarda forumu yöneticiler dışındakilere kapatmanızı sağlar.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="forum_durumu" value="1" <?php echo $forum_durumu_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="forum_durumu" value="0" <?php echo $forum_durumu_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Veritabanı Hata iletileri:
<br>
<font size="1">
Kapalı: Boş sayfa çıkar, Sadece Hata: "Sorgu Başarısız" yazar, Ayrıntılı Hata: Hatayı ayrıntılı olarak yazar. "Ayrıntılı" ayarını sadece hatayı görmek için açın.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="vt_hata" value="0" <?php echo $vt_hata_kapali; ?>>Kapalı</label> &nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="vt_hata" value="2" <?php echo $vt_hata_sadece; ?>>Sadece Hata</label> &nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="vt_hata" value="1" <?php echo $vt_hata_ayrinti; ?>>Ayrıntılı Hata</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Varsayılan Dil:<br>
<font size="1">
Sitenin varsayılan dili.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<?php echo $dil_varsayilan; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Eklenen Diller:<br>
<font size="1">
Dil sıralamasını bu alandan değiştirebilirsiniz. Başta, sonda ve aralarda virgül olmalıdır. Dil seçimini iptal etmek için sadece tek virgül girin.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
	<input class="formlar" type="text" name="dil_eklenen" size="35" maxlength="255" style="width:96%" value="<?php echo $ayarlar['dil_eklenen']; ?>">
	</td>
	</tr>







	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
SEO ve Meta Ayarları
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
SEF Adres Yapısı:<br>
<font size="1">
Arama motoru dostu adres yapısı
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="seo" value="1" <?php echo $seo_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="seo" value="0" <?php echo $seo_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" valign="top">
Meta Etiketleri:<br>
<font size="1">
&lt;head&gt; etiketi içine eklemek istediğiniz SEO, sosyal medya, paylaş, css, javascript vs. kodları buraya girebilirsiniz.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="meta_diger" style="height:140px; width:95%" cols="30" rows="6"><?php echo $meta_diger; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" valign="top">
Sayfa Altına Eklenecek Kodlar:<br>
<font size="1">
Buraya girilen kodlar tüm sayfaların altına eklenir.
Google Analytics, sayaç, site ekle, javascript, vs. her türlü görünür görünmez kodu buraya girebilirsiniz.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="site_taban_kod" style="height:140px; width:95%" cols="30" rows="6"><?php echo $site_taban_kod; ?></textarea>
	</td>
	</tr>






	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
Forum Bölümü Ayarları
	</td>
	</tr>


	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Bir sayfada görüntülenecek konu sayısı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="fsyfkota" size="3" maxlength="2" value="<?php echo $fsyfkota; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Bir sayfada görüntülenecek cevap sayısı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="ksyfkota" size="3" maxlength="2" value="<?php echo $ksyfkota; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Ana Sayfadaki Güncel Konular Kısmı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="sonkonular" value="1" <?php echo $sonkonular_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="sonkonular" value="0" <?php echo $sonkonular_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Gösterilecek Güncel Konu Sayısı:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="kacsonkonu" size="3" maxlength="2" value="<?php echo $kacsonkonu; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Otomatik Resim Boyutlandırma:
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="boyutlandirma" value="1" <?php echo $boyutlandirma_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="boyutlandirma" value="0" <?php echo $boyutlandirma_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Görüntüleyen Sayısı:<br>
<font size="1">
Ana sayfa ve forum sayfalarında, ilgili forum bölümünü görüntüleyen kişi sayısını gösterme özelliği.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="bolum_kisi" value="1" <?php echo $bolumkisi_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="bolum_kisi" value="0" <?php echo $bolumkisi_kapali; ?>>Kapalı</label>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Görüntüleyenler:<br>
<font size="1">
Forum ve konu sayfalarında, görüntüleyen kişi sayısını ve üye adlarını gösterme özelliği.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="konu_kisi" value="1" <?php echo $konukisi_acik; ?>>Açık &nbsp;</label> &nbsp;
<label style="cursor: pointer;">
<input type="radio" name="konu_kisi" value="0" <?php echo $konukisi_kapali; ?>>Kapalı</label>
	</td>
	</tr>






	<tr>
	<td class="ayarlar-ara-baslik" colspan="2" align="left" valign="middle" style="height:15px">
Görsel Ayarlar
	</td>
	</tr>


	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Tema Rengi:
<br>
<font size="1">
Sadece varsayılan olarak ayarlanmış tema için.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<?php echo $forum_rengi; ?>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Sayfa Genişliği:<br>
<font size="1">
Genişlik değerini yüzde ve piksel cinsinden giriniz.
<br>Örnek: 95% veya 1200px
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
	<input class="formlar" type="text" name="tema_genislik" size="8" maxlength="10" value="<?php echo $tema_genislik; ?>">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Üst Logo:<br>
<font size="1">
Üst logo için yazı veya resim ekleyin.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="tema_logo_ust" rows="1" style="height:44px; width:95%" cols="30"><?php echo $tema_logo_ust; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
Alt Logo:<br>
<font size="1">
Alt logo için yazı veya resim ekleyin.
</font>
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<textarea class="formlar" name="tema_logo_alt" rows="1" style="height:44px; width:95%" cols="30"><?php echo $tema_logo_alt; ?></textarea>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" colspan="2">
<font size="1">
Resim eklemek için img etiketi kullanın ve resmin tam adresini yazın.
<br>Örnek: &lt;img src="http://www.siteadi.com/resim.jpg" style="position:absolute; left:0px; top:-10px"&gt;
<br>Örnekteki top ve left değerlerini değiştirerek logonun yerini ayarlayabilirsiniz.
</font>
	</td>
	</tr>

<!--  GENEL AYARLAR - SONU  -->



<?php endif; // Tüm koşulların sonu ?>




	<tr>
	<td class="liste-veri" bgcolor="#ffffff" colspan="2" height="50" align="center" valign="middle">
<input class="dugme" type="submit" name="ayar_degistir" value="Değiştir">
 &nbsp; &nbsp; &nbsp;
<input class="dugme" type="reset" name="temizle" value="Sıfırla">
	</td>
	</tr>
</table>


</form>

</div>
</div>
</div>
