<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVASCRIPT_KODU}

<table cellspacing="1" cellpadding="0" border="0" align="center">
	<tr>
	<td align="left" valign="top">


<table cellspacing="1" width="155" cellpadding="7" border="0" align="left" class="tablo_border4 mobil-gizle" style="margin:0 15px 0 auto">
	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center">Kullanıcı Masası</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
<div style="height:5px"></div>
&nbsp;<a href="profil.php">Üyelik Bilgilerim</a>
<div style="height:15px"></div>
&nbsp;{B_DEGISTIR}
<div style="height:15px"></div>
&nbsp;{ES_DEGISTIR}
<div style="height:15px"></div>
&nbsp;{TAKIP}
<div style="height:15px"></div>
&nbsp;{YUKLEMELER}
<div style="height:15px"></div>
&nbsp;{BILDIRIMLER}
<div style="height:5px"></div>
	</td>
	</tr>

	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center">Özel İletiler</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
<div style="height:5px"></div>
&nbsp;<a href="ozel_ileti.php?kip=ayarlar">Özel İleti Ayarları</a>
<div style="height:15px"></div>
&nbsp;<a href="oi_yaz.php">Özel İleti Gönder</a>
<div style="height:15px"></div>
&nbsp;<a href="ozel_ileti.php">Gelen Kutusu{OKUNMAMIS_OI}</a>
<div style="height:15px"></div>
&nbsp;<a href="ozel_ileti.php?kip=ulasan">Ulaşan Kutusu</a>
<div style="height:15px"></div>
&nbsp;<a href="ozel_ileti.php?kip=gonderilen">Gönderilen Kutusu</a>
<div style="height:15px"></div>
&nbsp;<a href="ozel_ileti.php?kip=kaydedilen">Kaydedilen Kutusu</a>
<div style="height:5px"></div>
	</td>
	</tr>
</table>

	</td>

	<td align="left" valign="top">


{FORM_BILGI}

<table cellspacing="0" cellpadding="0" border="0" align="left" class="genel-tablo" style="width:640px;margin:0">
	<tr>
	<td align="left" valign="top" bgcolor="#ffffff">




<!--__KOSUL_BASLAT-6__-->

<table cellspacing="1" width="100%" cellpadding="10" border="0" align="left" bgcolor="#ececec">
	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">{SAYFA_BASLIK}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" width="40%" align="left">
Üye Adı
	</td>
	<td class="liste-etiket" bgcolor="#ffffff" width="60%" align="left">
<b>{UYE_ADI}</b> &nbsp; 
<font size="-2" style="font-weight: normal">
<i>(Değiştirilemez)</i>
</font>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Ad Soyad veya Lâkap <font size="1">*</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="gercek_ad" size="45" maxlength="30" value="{UYE_GERCEK_AD}" required />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Doğum Tarihi <font size="1">*</font>
	</td>
	<td bgcolor="#ffffff" align="left">
{UYE_DOGUM}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Konum <font size="1">*</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="sehir" size="45" maxlength="99" value="{UYE_SEHIR}" required />
	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Cinsiyet
	</td>
	<td bgcolor="#ffffff" align="left">
{UYE_CINSIYET}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Web Adresi
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="web" size="45" maxlength="99" value="{UYE_WEB}" />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left" valign="top">
Forum Teması
	</td>
	<td bgcolor="#ffffff" align="left">
{UYE_TEMA}
	</td>
	</tr>


<!--__KOSUL_BASLAT-5__-->


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left" valign="top">
Portal Teması
	</td>
	<td bgcolor="#ffffff" align="left">
{UYE_PORTAL_TEMA}
	</td>
	</tr>


<!--__KOSUL_BITIR-5__-->




	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">SOSYAL AĞLAR</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Facebook
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="aim" size="45" maxlength="99" value="{UYE_AIM}" />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Twitter
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="skype" size="45" maxlength="99" value="{UYE_SKYPE}" />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Skype - MSN
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="msn" size="45" maxlength="99" value="{UYE_MSN}" />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Yahoo!
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="yahoo" size="45" maxlength="99" value="{UYE_YAHOO}" />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
ICQ
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="icq" size="45" maxlength="30" value="{UYE_ICQ}" />
	</td>
	</tr>



<!--__KOSUL_BASLAT-1__-->


	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">RESİM AYARLARI</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" colspan="2" align="left">
{RESIM_YUKLEME_BILGI}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" valign="top" bgcolor="#ffffff" align="left">Geçerli Resim</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<div style="max-width:200px">{GECERLI_RESIM}</div>
	</td>
	</tr>


<!--__KOSUL_BASLAT-2__-->


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Resim Yükle
<br><font size="1" style="font-weight: normal">
<i>Bilgisayarınızdan resim yükleyin.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" name="resim_yukle" type="file" size="30" />
	</td>
	</tr>


<!--__KOSUL_BITIR-2__-->
<!--__KOSUL_BASLAT-3__-->


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Uzak Resim Ekle
<br><font size="1" style="font-weight: normal">
<i>Başka sitede bulunan resmin adresini girin.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="uzak_resim" size="45" maxlength="150" value="" />
	</td>
	</tr>


<!--__KOSUL_BITIR-3__-->
<!--__KOSUL_BASLAT-4__-->


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Galeriden Resim Seç
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<a href="galeri.php"><u>Galeriyi Göster</u></a>
<input class="formlar" type="hidden" name="uzak_resim2" maxlength="150" value="{UZAK_RESIM2}" />
	</td>
	</tr>


<!--__KOSUL_BITIR-4__-->

<!--__KOSUL_BITIR-1__-->


	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">SEÇENEKLER</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Doğum Tarihi veya Yaş Göster
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="1" {DOGUM_GOSTER_EVET} />
Tarih</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="2" {YAS_GOSTER_EVET} />
Yaş</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="dogum_tarihi_goster" value="0" {DOGUM_GOSTER_HAYIR} />
Gizle</label>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
E-Posta Adresini Göster
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type=radio name="posta_goster" value="1" {POSTA_GOSTER_EVET} />
Evet</label>&nbsp;&nbsp;
<label style="cursor: pointer;">
<input type="radio" name="posta_goster" value="0" {POSTA_GOSTER_HAYIR} />
Hayır</label>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Konum Göster
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="1" {SEHIR_GOSTER_EVET} />
Evet</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="sehir_goster" value="0" {SEHIR_GOSTER_HAYIR} />
Hayır</label>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Çevrimiçi Durumunu Göster
	</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="gizli" value="0" {CEVRIMICI_GOSTER_EVET} />
Evet</label>&nbsp;&nbsp;

<label style="cursor: pointer;">
<input type="radio" name="gizli" value="1" {CEVRIMICI_GOSTER_HAYIR} />
Hayır</label>
	</td>
	</tr>




	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">İMZA</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="formlar" cols="66" rows="5" name="imza" onkeyup="imzaUzunluk()" style="width:90%; height:100px">{UYE_IMZA}</textarea>

<div align="left" style="width:90%">
<div style="height:10px"></div>
{IMZA_BILGI}
<div id="imza_uzunluk">Eklenebilir karakter sayısı:</div>
<div style="height:5px"></div>
</div>
	</td>
	</tr>


	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">HAKKINDA</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" colspan="2">
<div style="height:5px"></div>
<textarea class="formlar" cols="66" rows="5" name="hakkinda" onkeyup="hakkindaUzunluk()" style="width:90%; height:100px">{UYE_HAKKINDA}</textarea>

<div align="left" style="width:90%">
<div style="height:10px"></div>
{HAKKINDA_BILGI}
<div id="hakkinda_uzunluk">Eklenebilir karakter sayısı:</div>
<div style="height:5px"></div>
</div>
{JAVASCRIPT_KODU2}
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-6__-->





<!--__KOSUL_BASLAT-7__-->

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">{SAYFA_BASLIK}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Şu Anki Şifreniz <font size="1">*</font>
<br><br>
<font size="1" style="font-weight: normal">
<i>Şifre veya E-Posta değişikliği için gereklidir.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="password" name="sifre" size="45" maxlength="20" value="" required />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Yeni Şifre <font size="1">*</font>
<br><br>
<font size="1" style="font-weight: normal">
<i>Değiştirmeyecekseniz dokunmayın.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="password" name="ysifre" size="45" maxlength="20" value="sifre_degismedi" required />
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
Yeni Şifre Onay <font size="1">*</font>
<br><br>
<font size="1" style="font-weight: normal">
<i>Değiştirmeyecekseniz dokunmayın.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="password" name="ysifre2" size="45" maxlength="20" value="sifre_degismedi" required />

<script type="text/javascript">
<!-- //
document.form1.sifre.setAttribute("autocomplete","off");
document.form1.ysifre.setAttribute("autocomplete","off");
document.form1.ysifre2.setAttribute("autocomplete","off");
//  -->
</script>

	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="left">
E-Posta Adresiniz <font size="1">*</font>
<br>
<font size="1" style="font-weight: normal">
<i>E-Posta değişikliği onay gerektirir.
<br><br>
Değiştirmeyecekseniz dokunmayın.</i>
</font>
	</td>
	<td bgcolor="#ffffff" align="left">
<input class="formlar" type="text" name="posta" size="45" maxlength="70" value="{UYE_EPOSTA}" required />
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-7__-->



<!--__KOSUL_BASLAT-8__-->

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr class="liste-etiket">
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Sıra</td>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik">Dosya</td>
	<td align="center" width="110" bgcolor="#ececec" class="forum-kategori-alt-baslik">Tarih</td>
	<td align="center" width="60" bgcolor="#ececec" class="forum-kategori-alt-baslik">Boyut</td>
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Sil</td>
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Ara</td>
	<td align="center" width="25" bgcolor="#ececec" class="forum-kategori-alt-baslik">Aç</td>
	</tr>

<!--__TEKLI_BASLAT-1__-->
	<tr class="liste-veri" bgcolor="#ffffff" onMouseOver="this.bgColor= '#e0e0e0'" onMouseOut="this.bgColor= '#ffffff'">
	<td align="left"><b>{SIRA}</b></td>
	<td align="left">{DOSYA}</td>
	<td align="center">{TARIH}</td>
	<td align="right">{BOYUT}</td>
	<td align="center">{SIL}</td>
	<td align="center">{ARA}</td>
	<td align="center">{AC}</td>
	</tr>
<!--__TEKLI_BITIR-1__-->

</table>

<!--__KOSUL_BITIR-8__-->





<!--__KOSUL_BASLAT-9__-->

<table cellspacing="1" width="667" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik" style="width:28px">Sıra</td>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik" style="width:94px">Tarih</td>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik">Bilgi</td>
	<td align="center" bgcolor="#ececec" class="forum-kategori-alt-baslik" style="width:20px">Sil</td>
	</tr>
</table>

<!--__TEKLI_BASLAT-2__-->
<div align="center" class="liste-veri" style="position:relative; width:100%">
<div align="left" style="position:relative; width:100%" id="bildirimkt{SIRA}">
<div style="position:relative; width:41px; float:left; border-bottom:1px solid #e0e0e0; padding:7px 5px 7px 9px; background:#fff"><b>{SIRA})</b></div>
<div style="position:relative; width:106px; float:left; border-left:1px solid #e0e0e0; border-bottom:1px solid #e0e0e0; padding:7px; background:#fff; text-align:center">{TARIH}</div>
<div style="position:relative; width:429px; float:left; border-left:1px solid #e0e0e0; border-bottom:1px solid #e0e0e0; padding:7px; background:#fff">{BILGI}</div>
<div style="position:relative; width:24px; float:left; border-left:1px solid #e0e0e0; border-bottom:1px solid #e0e0e0; padding:8px 7px 3px 15px; min-height:21px; background:#fff">
<a href="javascript:void(0);" onclick="{SIL}" id="bildirimks{SIRA}">Sil</a>
</div></div></div>
<div class="clear"></div>
<!--__TEKLI_BITIR-2__-->

<!--__KOSUL_BITIR-9__-->



	<tr>
	<td colspan="2" align="left" bgcolor="#ffffff" class="liste-veri">
<div style="height:10px"></div>
{ALAN_BILGI}
	</td>
	</tr>

	<tr>
	<td bgcolor="#ffffff" align="center">
<div style="height:20px"></div>
<input class="dugme" type="submit" value="Değiştir"> &nbsp; &nbsp; 
<input class="dugme" type="reset">
<div style="height:20px"></div>
	</td>
	</tr>


</table>
</form>
</td></tr></table>
<br>
