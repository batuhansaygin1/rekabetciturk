<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<style type="text/css" scoped="scoped">
@import url("../temalar/varsayilan/sablon.css");
div.sayfalama_mobil .tablo_border{
	border:1px solid #246A8A;
}
div.sayfalama_mobil td{
	padding:5px;
	border:1px solid #246A8A;
}
.arama_dis_tablo {
margin:20px;
}
.arama_dis_tablo td{
border:1px solid #ddd;
padding:5px;
}
</style>

<table cellspacing="0" cellpadding="1" width="98%" border="0" align="center" style="margin:20px auto;border:1px solid #ddd;Background:#fff;">
	<tr>
	<td colspan="6" class="forum-kategori-baslik" align="center" valign="middle">
Konu ve İçerik Arama
	</td>
	</tr>

	<tr>
	<td align="center" valign="top">

<table cellspacing="5" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">


<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td align="center">
<form action="arama.php" name="arama" method="get">
<input name="a" value="1" type="hidden">
<input name="b" value="1" type="hidden">

{BULUNAMADI}

<table cellspacing="1" cellpadding="8" border="0" align="center" bgcolor="#d0d0d0" class="arama_dis_tablo">

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="220">
<b>Yazılar içinde sözcük(ler) ara:</b>
	</td>
	<td>
&nbsp;
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff" align="left">
	<td>
Bu sözcüklerin hepsi için ara:
	</td>
	<td align="left">
&nbsp; <input class="formlar" type="text" name="sozcuk_hepsi" size="25" maxlength="100" value="{SOZCUK_HEPSI}">
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left">
Bu sözcüklerden herhangi biri için ara:
	</td>
	<td align="left">
&nbsp; <input class="formlar" type="text" name="sozcuk_herhangi" size="25" maxlength="100" value="{SOZCUK_HERHANGI}">
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left">
Bu sözcükleri aynen yazıldığı gibi ara: 
	</td>
	<td align="left">
&nbsp; <input class="formlar" type="text" name="sozcuk_aynen" size="25" maxlength="100" value="{SOZCUK_AYNEN}">
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left">
Bu sözcükler hariç ara:
	</td>
	<td align="left">
&nbsp; <input class="formlar" type="text" name="sozcuk_haric" size="25" maxlength="100" value="{SOZCUK_HARIC}">
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left">
Seçili tarihden yenilerde ara:
	</td>
	<td align="left">
&nbsp; <select name="tarih" class="formlar">
<option value="tum_zamanlar" selected="selected">Tüm zamanlar
<option value="1gun">1 Günlük
<option value="3gun">3 Günlük
<option value="1hafta">1 Haftalık
<option value="2hafta">2 Haftalık
<option value="1ay">1 Aylık
<option value="3ay">3 Aylık
<option value="6ay">6 Aylık
<option value="1sene">1 Senelik
</select>
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center">
<b>Sadece bu üyenin yazılarında ara:</b>
	</td>
	<td align="left">
&nbsp; <input class="formlar" type="text" name="yazar_ara" size="25" maxlength="20" value="{YAZAR_ARA}">
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td valign="top" align="center">
<b>Bu forum(lar)da ara:</b>
	</td>

	<td align="left">
&nbsp; <select name="forum" class="formlar" style="width:220px">
<option value="tum" selected="selected">&nbsp; - TÜM FORUMLARDA ARA -
{ARAMA_SECENEK}
</select>
	</td>

	</tr>
</table>

<p align="center"><br>
<input type="submit" value="Aramayı başlat" class="dugme">
</form>
	</td>
	</tr>



<!--__KOSUL_BITIR-1__-->

	<tr>
	<td>

<!--__KOSUL_BASLAT-2__-->

	<tr>
	<td align="left">


<font face="verdana" size="1">
&nbsp; &nbsp; Aradığınız koşula uyan &nbsp;<b>{TOPLAM_SONUC}</b>&nbsp; sonuç bulundu.
</font>
<br><br>

<table cellspacing="1" width="98%" cellpadding="4" border="0" align="center" bgcolor="#d0d0d0" class="arama_dis_tablo" style="margin: auto">
	<tr>
	<td class="forum-kategori-alt-baslik" colspan="6" height="20" align="center" valign="middle">
- ARAMA SONUÇLARI -
	</td>
	</tr>


<!--__TEKLI_BASLAT-1__-->


	<tr>
	<td colspan="6" align="center" class="arama_baslik">Arama Sonucu {SONUC_SAYISI}</td>
	</tr>

	<tr class="forum-kategori-baslik">
	<td align="center">Başlık</td>
	<td align="center">Forum</td>
	<td align="center" width="100">Yazan</td>
	<td align="center" width="55">Cevap</td>
	<td align="center" width="70">Gösterim</td>
	<td align="center" width="120">Tarih</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td>
{KONU_BASLIK}
	</td>

    <td>
{FORUM_BASLIK}
    </td>

	<td align="center" title="Kullanıcı profilini görüntüle" width="100">
{YAZAN}
	</td>

	<td align="center" width="55">
{CEVAP_SAYI}
	</td>

	<td align="center" width="70">
{GOSTERIM}
	</td>

	<td align="center" width="120">
{TARIH}
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left" valign="top" colspan="6">
<br>
<b>Mesaj içeriği:</b>
<br><br>

{MESAJ_ICERIK}

<br><br><br><br>
	</td>
	</tr>



<!--__TEKLI_BITIR-1__-->

</table>
<br>
<div class="sayfalama_mobil">{SAYFALAMA}</div>

<!--__KOSUL_BITIR-2__-->


</table>
<br>
</td></tr></table>
<br>
<br>