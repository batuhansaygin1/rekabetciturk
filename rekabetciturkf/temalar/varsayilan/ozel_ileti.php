<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<!--__KOSUL_BASLAT-8__-->
<!--__TEKLI_BASLAT-2__-->

<table cellspacing="1" cellpadding="4" border="0" align="center" class="genel-tablo" style="width:100%">
	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="center" valign="middle" style="padding:25px 25px;">
<font color="#ff0000"><b>{OZEL_DUYURU_BASLIK}</b></font>
<br><br>
{OZEL_DUYURU_ICERIK}
	</td>
	</tr>
</table>
<br>

<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-8__-->


<!--__KOSUL_BASLAT-5__-->

{JAVASCRIPT_KODU}

{FORM_BILGI}

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="width:100%">
	<tr>
	<td colspan="6" class="forum-kategori-baslik" align="center" valign="middle">
Özel İletiler
	</td>
	</tr>

	<tr>
	<td align="center" valign="top">

<table cellspacing="0" cellpadding="0" border="0" align="center" class="ozel_ileti_linkler" style="margin-top:10px">
	<tr>
	<td align="center" class="liste-veri" height="25">
<a href="profil.php">Üyelik Bilgilerim</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php">Bilgilerimi Değiştir</a>
&nbsp; | &nbsp;
<a href="ozel_ileti.php?kip=ayarlar">Özel İleti Ayarları</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=takip">Takip Edilenler</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=yuklemeler">Yüklemeler</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=bildirim">Bildirimler</a>
	</td>
	</tr>
</table>



<table cellspacing="4" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td align="center">

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td align="left" valign="top" width="100%">

<div class="liste-veri" align="left" style="width:300px; height: 35px; float: left">
<a href="oi_yaz.php" title="Özel ileti gönder">{OZEL_ILETI_GONDER}</a>
</div>

<div class="liste-veri" align="left" style="height: 35px; float: right">
<b>Doluluk {KUTU_KOTA}/{DOLULUK}</b>
<div class="oran_dis" align="left"><div class="oran_ic" style="width: {DOLULUK_ORANI}px"></div></div>
</div>

	</td>
	</tr>

	<tr>
	<td align="left" valign="top" width="100%">


<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center" bgcolor="#cccccc">
	<tr>
	<td colspan="8" height="35" class="liste-etiket" align="center" bgcolor="#f8f8f8">
{GELEN_KUTUSU_BAG}{GELEN_KUTUSU}{GELEN_KUTUSU_BAG2} &nbsp; | &nbsp; 
{ULASAN_KUTUSU_BAG}{ULASAN_KUTUSU}{ULASAN_KUTUSU_BAG2} &nbsp; | &nbsp; 
{GONDERILEN_KUTUSU_BAG}{GONDERILEN_KUTUSU}{GONDERILEN_KUTUSU_BAG2} &nbsp; | &nbsp; 
{KAYDEDILEN_KUTUSU_BAG}{KAYDEDILEN_KUTUSU}{KAYDEDILEN_KUTUSU_BAG2}
	</td>
	</tr>

	<tr>
	<td align="center" width="30" class="forum-kategori-alt-baslik">Seç</td>
	<td align="center" width="30" class="forum-kategori-alt-baslik mobil-gizle"></td>
	<td align="center" class="forum-kategori-alt-baslik">Konu</td>
	<td align="center" width="100" class="forum-kategori-alt-baslik">{KIMDEN_KIME}</td>
	<td align="center" width="120" class="forum-kategori-alt-baslik mobil-gizle">{TARIH_ALAN1}</td>
	<td align="center" width="115" class="forum-kategori-alt-baslik mobil-gizle">{SON_CEVAP}</td>
	<td align="center" width="115" class="forum-kategori-alt-baslik mobil-gizle">{TARIH_ALAN2}</td>
	<td align="center" width="50" class="forum-kategori-alt-baslik mobil-gizle">Yanıt</td>
	</tr>


<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" colspan="8" align="center">
<br>
{KUTU_BOS}
<br>
<br>
	</td>
	</tr>

<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-2__-->

<!--__TEKLI_BASLAT-1__-->

	<tr class="liste-veri" bgcolor="#ffffff" id="secili{TABLO_NO}">
	<td align="center" style="height:25px;">
<input type="checkbox" name="sec_ileti[]" value="{OI_NO}" onclick="secili_yap({TABLO_NO})">
	</td>

	<td align="center" class="mobil-gizle">{OI_SIMGE}</td>
	<td align="left">{OZEL_ILET_BASLIK}</td>
	<td align="center">{OI_KIMDEN}</td>
	<td align="center" class="mobil-gizle">{OI_TARIH1}</td>
	<td align="center" class="mobil-gizle">{OI_SONCEVAP}</td>
	<td align="center" class="mobil-gizle">{OI_TARIH2}</td>
	<td align="center" class="mobil-gizle">{OI_CEVAP}</td>
	</tr>

<!--__TEKLI_BITIR-1__-->

<!--__KOSUL_BITIR-2__-->



</table>
<table border="0" cellspacing="0" width="100%" cellpadding="0">
	<tr>
	<td align="left" class="liste-veri">
<br>
<input class="dugme" type="submit" name="secili_sil" value="Seçilileri Sil" onclick="return window.confirm('Silmek istediğinize eminmisiniz?')"> &nbsp; 
<!--__KOSUL_BASLAT-7__-->
<input class="dugme" type="submit" name="secili_kaydet" value="Seçilileri Kaydet">
<!--__KOSUL_BITIR-7__-->
<p>
<a href="javascript:secim(true)">Hepsini seç</a> &nbsp;-&nbsp;
<a href="javascript:secim(false)">Hiçbirini seçme</a>
	</td>
	<td class="liste-veri" align="center">
<font size="1"><i>{KUTU_ACIKLAMA}</i></font>

</td></tr></table>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</form>

<!--__KOSUL_BITIR-5__-->



<!--__KOSUL_BASLAT-6__-->

{FORM_BILGI2}

<table cellspacing="1" cellpadding="0" border="0" align="center" style="margin:20px auto;">
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
&nbsp;<a href="profil_degistir.php">Bilgilerimi Değiştir</a>
<div style="height:15px"></div>
&nbsp;<a href="profil_degistir.php?kosul=sifre">E-Posta - Şifre Değiştir</a>
<div style="height:15px"></div>
&nbsp;<a href="profil_degistir.php?kosul=takip">Takip Edilenler</a>
<div style="height:15px"></div>
&nbsp;<a href="profil_degistir.php?kosul=yuklemeler">Yüklemeler</a>
<div style="height:15px"></div>
&nbsp;<a href="profil_degistir.php?kosul=bildirim">Bildirimler</a>
<div style="height:5px"></div>
	</td>
	</tr>

	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" >Özel İletiler</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
<div style="height:5px"></div>
&nbsp;<font style="font-size: 10px"><b>Özel İleti Ayarları</b></font>
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


<table cellspacing="1" cellpadding="0" border="0" align="left" class="genel-tablo" style="width:600px;margin:0">
	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center" colspan="2">Özel İleti Ayarları</td>
	</tr>

	<tr>
	<td align="center">

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td colspan="2" height="10"></td>
	</tr>

	<tr>
	<td colspan="2" align="left" class="liste-veri">
 &nbsp; Bu sayfadan size özel ileti atılmasını tamamen engelleyebilir veya sadece istediğiniz
kişileri engelleyebilirsiniz. Kullanımı ile ilgili ayrıntılı bilgi aşağıda yazmaktadır.
{EUYARI}

<br><br><br>

<table cellspacing="1" width="96%" cellpadding="8" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" valign="middle" align="center" width="170">
Seçenekler: 
	</td>

	<td class="liste-veri" bgcolor="#ffffff" align="left">
<label style="cursor: pointer;">
<input type="radio" name="engel_tipi" value="0" {TIP_HICKIMSE}>
Hiç kimseyi engelleme</label>&nbsp;&nbsp;
<br>
<label style="cursor: pointer;">
<input type="radio" name="engel_tipi" value="1" {TIP_HERKES}>
* Yetkililer ve alttakiler hariç herkesi engelle</label>
<br>
<label style="cursor: pointer;">
<input type="radio" name="engel_tipi" value="2" {TIP_SADECE}>
* Sadece alttakileri engelle</label>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" valign="top" align="left">
<br>
Yasaklılar / izinliler:

<font size="1" style="font-weight: normal">
<br><br>
Üye adlarını altalta yazın.
<br>Yanlış yazılanlar silinecektir.
<br>
<br>
<i>* işaretli alanlar seçiliyse
<br>bu kişiler hariç veya
<br>sadece bu kişiler engellensin.
<br>
<br>"Hiç kimseyi engelleme"
<br>seçildiğinde buradakiler silinir.</i>
</font>
<br><br>
	</td>

	<td bgcolor="#ffffff" align="left">
<textarea class="formlar" cols="36" rows="9" name="engellenenler" onkeyup="imzaUzunluk()" style="width: 240px; height: 130px">{ENGELLENENLER}</textarea>
	</td>
	</tr>

	<tr>
	<td colspan="2" height="45" bgcolor="#ffffff" align="center">
<input class="dugme" type="submit" value="Değiştir"> &nbsp; &nbsp; 
<input class="dugme" type="reset">
	</td>
	</tr>

</table>

	</td>
	</tr>

	<tr>
	<td colspan="2" height="5"></td>
	</tr>

	<tr>
	<td colspan="2" align="left" class="liste-veri">

<p align="center" class="liste-etiket">- Ayrıntılar -</p>

&nbsp; "<i>Yetkililer ve alttakiler hariç herkesi engelle</i>" seçtiğinizde, forum yönetici ve yardımcıları hariç herkesi engellemiş olursunuz. Ayrıca isterseniz "<i>Yasaklılar / izinliler:</i>" kısmına yazdığınız kişilerin engelini kaldırabilirsiniz.

<br><br>
&nbsp; "<i>Sadece alttakileri engelle</i>" seçtiğinizde, sadece "<i>Yasaklılar / izinliler:</i>" kısmına yazdığınız kişileri engellemiş olursunuz.

<br><br>
&nbsp; "<i>Hiç kimseyi engelleme</i>" seçtiğinizde hiç kimse engellenmez ve daha önce "<i>Yasaklılar / izinliler:</i>" kısmına yazdığınız kişiler silinir.

<br><br><br>
&nbsp; "<i>Yasaklılar / izinliler:</i>" kısmına; Forum yönetici ve yardımcıları, kendi adınız, geçersiz bir üye adı veya aynı üyeyi birden fazla yazdığınızda bunlar silinecektir.

<br><br>
</td></tr></table>
</td></tr></table>
</td></tr></table>
</form>

<!--__KOSUL_BITIR-6__-->

