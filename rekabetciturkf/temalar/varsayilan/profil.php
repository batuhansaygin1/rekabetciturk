<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>


<!--__KOSUL_BASLAT-2__-->

	<td align="left" valign="top">

<table cellspacing="1" width="155" cellpadding="7" border="0" align="left" class="tablo_border4 mobil-gizle" style="margin:0 15px 0 auto">
	<tr>
	<td class="forum-kategori-alt-baslik" bgcolor="#ececec" align="center">Kullanıcı Masası</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
<div style="height:5px"></div>
&nbsp;<font style="font-size: 10px"><b>Üyelik Bilgilerim</b></font>
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

<!--__KOSUL_BITIR-2__-->


	<td align="left" valign="top">

<table cellspacing="0" cellpadding="0" border="0" align="left" class="genel-tablo" style="width:675px">
	<tr>
	<td colspan="6" class="forum-kategori-alt-baslik" align="center" valign="middle">
Profil
	</td>
	</tr>

	<tr>
	<td align="center">



<div class="mobil-tam" style="box-sizing:border-box; float:left; width:50%; padding:20px 8px 0 20px">

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#777777; border:1px solid #ffffff" colspan="2">Üye Bilgileri</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center" valign="middle" colspan="2">
<div style="max-width:230px">{UYE_RESIM}</div>
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Üye Adı:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_ADI}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Ad Soyad:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_GERCEK_AD}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Yetki:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_YETKI}</td>
	</tr>

<!--__KOSUL_BASLAT-4__-->
	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right" valign="top">Üye Grubu:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_GRUBU}</td>
	</tr>
<!--__KOSUL_BITIR-4__-->


<!--__KOSUL_BASLAT-1__-->
	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Özel Ad:</td>
	<td class="ozel_ad" bgcolor="#ffffff" align="left">{OZEL_AD}</td>
	</tr>
<!--__KOSUL_BITIR-1__-->


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Konum:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_SEHIR}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Cinsiyet:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_CINSIYET}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">{DOGUM_YAS}:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_DOGUM}</td>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Kayıt Tarihi:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_KATILIM}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Son Giriş:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_GIRIS}</td>
	</tr>

	<tr>
	<td valign="top" class="liste-etiket" bgcolor="#ffffff" align="right">İleti Sayısı:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_MESAJ_SAYISI}</td>
	</tr>

	<tr>
	<td valign="top" class="liste-etiket" bgcolor="#ffffff" align="right">Profil Yorumu:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{YRM_SAYI}</td>
	</tr>

	<tr>
	<td valign="top" class="liste-etiket" bgcolor="#ffffff" align="right">Yaptığı Yorum:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{YRM_YAPILAN}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Durum:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_DURUM}</td>
	</tr>
</table>



<div align="center" style="position:relative; float:left; width:100%; height:20px;"></div>
</div>
<div class="mobil-tam" style="box-sizing:border-box; float:left; width:50%; padding:20px 20px 0 8px">



<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#777777; border:1px solid #ffffff" colspan="2">Bağlantılar</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right" width="115">E-Posta:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_EPOSTA}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Özel ileti:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_OI}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Web Sitesi:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_WEB}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Facebook:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_AIM}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Twitter:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_SKYPE}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Skype:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_MSN}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">Yahoo!:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_YAHOO}</td>
	</tr>

	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="right">ICQ:</td>
	<td class="liste-veri" bgcolor="#ffffff" align="left">{UYE_ICQ}</td>
	</tr>
</table>



<div align="center" style="position:relative; float:left; width:100%; height:20px;"></div>

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="left" style="color:#777777; border:1px solid #ffffff">Son Bulunduğu Sayfa</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" valign="middle" height="25">{SON_SAYFA}</td>
	</tr>
</table>



<!--__KOSUL_BASLAT-3__-->

<div align="center" style="position:relative; float:left; width:100%; height:20px;"></div>

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#777777; border:1px solid #ffffff">Yetkili Olduğu Bölümler</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center">{BLMYRD_YETKI}</td>
	</tr>
</table>

<!--__KOSUL_BITIR-3__-->



<div align="center" style="position:relative; float:left; width:100%; height:20px;"></div>

<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#e0e0e0">
	<tr>
	<td class="liste-etiket" bgcolor="#ececec" align="center" style="color:#777777; border:1px solid #ffffff">Yazılarını Bul</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="center">
<div style="height:5px"></div>
{KONU_GOSTER}<br>
{CEVAP_GOSTER}<br>
{MESAJ_ARA}
<div style="height:5px"></div>
	</td>
	</tr>
</table>



<div align="center" style="position:relative; float:left; width:100%; height:20px;"></div>
</div>
<div class="clear mobil-tam" style="padding:0 20px 10px 20px">



<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="border:1px solid #e0e0e0">
	<tr>
	<td id="uye_imzab" class="liste-etiket" bgcolor="#dcdcdc" align="center" width="70" style="padding:5px; color:#777777; border-left:1px solid #ffffff; border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-right:1px solid #dcdcdc; cursor:default" onMouseOver="uzerine('uye_imzab','uye_imza','1')" onMouseOut="uzerine('uye_imzab','uye_imza','2')" onClick="gizlegoster('uye_imza','uye_hakkinda','uye_yazilar','uye_yorum')">
İmzası
	</td>
	<td id="uye_hakkindab" class="liste-etiket" bgcolor="#ececec" align="center" width="85" style="padding:5px; color:#777777; border-left:1px solid #ffffff; border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-right:1px solid #dcdcdc; cursor:pointer" onMouseOver="uzerine('uye_hakkindab','uye_hakkinda','1')" onMouseOut="uzerine('uye_hakkindab','uye_hakkinda','2')" onClick="gizlegoster('uye_hakkinda','uye_imza','uye_yazilar','uye_yorum')">
Hakkında
	</td>
	<td id="uye_yazilarb" class="liste-etiket" bgcolor="#ececec" align="center" width="100" style="padding:5px; color:#777777; border-left:1px solid #ffffff; border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-right:1px solid #dcdcdc; cursor:pointer" onMouseOver="uzerine('uye_yazilarb','uye_yazilar','1')" onMouseOut="uzerine('uye_yazilarb','uye_yazilar','2')" onClick="gizlegoster('uye_yazilar','uye_hakkinda','uye_imza','uye_yorum')">
Son Yazıları
	</td>
	<td id="uye_yorumb" class="liste-etiket" bgcolor="#ececec" align="center" width="90" style="padding:5px; color:#777777; border-left:1px solid #ffffff; border-top:1px solid #ffffff; border-bottom:1px solid #ffffff; border-right:1px solid #dcdcdc; cursor:pointer" onMouseOver="uzerine('uye_yorumb','uye_yorum','1')" onMouseOut="uzerine('uye_yorumb','uye_yorum','2')" onClick="gizlegoster('uye_yorum','uye_imza','uye_hakkinda','uye_yazilar');{BILDIRIM_KAPAT}">
Yorumlar
	</td>
	<td class="liste-etiket" bgcolor="#ececec" style="border-left:1px solid #ffffff">&nbsp;</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" colspan="5" style="border-top:1px solid #e0e0e0">
<a name="yorum"></a>

<div id="uye_imza" align="left" style="position:relative; float:left; width:100%; min-height:40px; max-height:205px; display:inline; padding:7px; overflow:auto">{UYE_IMZA}</div>

<div id="uye_hakkinda" align="left" style="position:relative; float:left; width:100%; min-height:40px; max-height:205px; display:none; padding:7px; overflow:auto">{UYE_HAKKINDA}</div>

<div id="uye_yazilar" align="left" style="position:relative; float:left; width:100%; display:none"></div>

<div id="uye_yorum" align="left" style="position:relative; display:none; padding:7px"></div>

	</td>
	</tr>
</table>


<script type="text/javascript"><!-- //
var Renk1 = "#dcdcdc";
var Renk2 = "#ececec";
var Renk3 = "#000000";
var Renk4 = "#777777";
function yorum_daha_uzerine(katman,olay){
var alan1 = document.getElementById(katman);
if (olay=="1") alan1.style.backgroundColor = Renk1;
else alan1.style.backgroundColor = Renk2;}
//  -->
</script>
{JAVASCRIPT_KODU}


<img width="0" height="0" border="0" src="dosyalar/yukleniyor2.gif" alt="">

</div>

</td></tr></table>
</td></tr></table>