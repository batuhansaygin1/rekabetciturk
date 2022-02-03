<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo">
	<tr>
	<td class="forum-kategori-baslik" align="center" valign="bottom">
{SAYFA_BASLIK}
	</td>
	</tr>

	<tr>
	<td align="center" valign="top" style="padding-left:20px; padding-top:10px; padding-bottom:20px">


<!--__KOSUL_BASLAT-4__-->

<table cellspacing="1" cellpadding="4" width="330" border="0" align="center" bgcolor="#d0d0d0">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" colspan="2">{KURUCU_BASLIK}</td>
	</tr>
	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="middle" width="80" height="90">{KURUCU_RESIM}</td>
	<td align="left" valign="middle">{KURUCU_BILGI}</td>
	</tr>
</table>



<table cellspacing="1" cellpadding="3" width="225" border="0" align="left" bgcolor="#d0d0d0" style="margin-left:11px; margin-top:20px; margin-bottom:30px">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" colspan="2">{YONETICI_BASLIK}</td>
	</tr>
<!--__TEKLI_BASLAT-2__-->
	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="middle" width="50" height="70">{YONETICI_RESIM}</td>
	<td align="left" valign="middle">{YONETICI_BILGI}</td>
	</tr>
<!--__TEKLI_BITIR-2__-->
</table>



<table cellspacing="1" cellpadding="3" width="225" border="0" align="left" bgcolor="#d0d0d0" style="margin-left:10px; margin-top:20px; margin-bottom:30px">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" colspan="2">{YARDIMCI_BASLIK}</td>
	</tr>
<!--__TEKLI_BASLAT-3__-->
	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="middle" width="50" height="70">{YARDIMCI_RESIM}</td>
	<td align="left" valign="middle">{YARDIMCI_BILGI}</td>
	</tr>
<!--__TEKLI_BITIR-3__-->
</table>



<table cellspacing="1" cellpadding="3" width="225" border="0" align="left" bgcolor="#d0d0d0" style="margin-left:10px; margin-top:20px; margin-bottom:30px">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" colspan="2">{BLM_YRD_BASLIK}</td>
	</tr>
<!--__TEKLI_BASLAT-4__-->
	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="middle" width="50" height="70">{BLM_YRD_RESIM}</td>
	<td align="left" valign="middle">{BLM_YRD_BILGI}</td>
	</tr>
<!--__TEKLI_BITIR-4__-->
</table>

	</td>
	</tr>

	<tr>
	<td class="forum-kategori-baslik" align="center" valign="bottom">
{GRUP_BASLIK}
	</td>
	</tr>

	<tr>
	<td align="center" valign="top" style="padding-left:20px;">



<!--__KOSUL_BASLAT-5__-->

<!--__DIS_BASLAT-1__-->

{ASAGI_AT}
<table cellspacing="1" cellpadding="3" width="225" border="0" align="left" bgcolor="#d0d0d0" style="margin-left:10px; margin-top: 20px">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" colspan="2">{GRUP_ADI}</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left" valign="top" colspan="2">
{GRUP_BILGI}
	</td>
	</tr>

<!--__IC_BASLAT-1__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="middle" width="50" height="70">
{GRUP_RESIM}
	</td>
	<td align="left" valign="middle">
{GRUP_UYE}
	</td>
	</tr>

<!--__IC_BITIR-1__-->

</table>

<!--__DIS_BITIR-1__-->

<!--__KOSUL_BITIR-5__-->

{GRUP_YOK}
<div style="float: left; width: 100%; height: 30px;"></div>

<!--__KOSUL_BITIR-4__-->








<!--__KOSUL_BASLAT-3__-->

<form action="uyeler.php" name="kul_ara" method="get">

<table cellspacing="10" width="96%" cellpadding="0" border="0" align="center" bgcolor="#ffffff" style="margin:0; padding:0; margin-left:-20px">
	<tr>
	<td class="liste-veri" valign="bottom" align="left">
<input class="formlar" type="text" name="kul_ara" size="20" maxlength="20" value="{KULLANICI_ARA}">
&nbsp;<input type="submit" value="Üye Ara" class="dugme">
	</td>
	<td class="liste-veri" valign="bottom" align="right">

<div class="liste-veri" style="width: 100%; text-align: right"><a href="uyeler.php?kip=grup" style="text-decoration: none"><b>Yetkililer ve Gruplar &raquo;</b></a></div>
<div class="liste-veri" style="width: 100%; height:7px"></div>

<select name="sirala" class="formlar">
{SIRALAMA_SECENEK}
</select>

&nbsp;<input type="submit" value="üyeleri sırala" class="dugme">

	</td>
	</tr>

	<tr>
	<td colspan="2">

<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#cccccc">
	<tr class="forum-kategori-alt-baslik">
	<td align="center" title="Kullanıcı profilini görüntüle">Kullanıcı Adı</td>
	<td align="center" width="120">Yetkisi</td>
	<td align="center" width="50">İleti</td>
	<td align="center" width="110" class="mobil-gizle">Kayıt</td>
	<td align="center" width="70" class="mobil-gizle">Konum</td>
	<td align="center" width="60" class="mobil-gizle" title="Forum üzerinden E-Posta gönder">E-Posta</td>
	<td align="center" width="30" class="mobil-gizle" title="Özel ileti gönder">Özel</td>
	</tr>


<!--__KOSUL_BASLAT-2__-->

	<tr class="liste-etiket" bgcolor="#ffffff">
	<td colspan="8" align="center" height="70" valign="middle">
{SONUC_YOK}
	</td>
	</tr>

<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-1__-->

<!--__TEKLI_BASLAT-1__-->



	<tr class="liste-veri" bgcolor="#ffffff" onMouseOver="this.bgColor= '#e0e0e0'" onMouseOut="this.bgColor= '#ffffff'">
	<td title="Kullanıcı profilini görüntüle" align="left">
{UYE_ADI}
	</td>

	<td align="center">
{UYE_YETKISI}
	</td>

	<td align="center">
{UYE_MESAJ}
	</td>

	<td align="center" class="mobil-gizle">
{UYE_KATILIM}
	</td>

	<td align="center" class="mobil-gizle">
{UYE_SEHIR}
	</td>

	<td align="center" class="mobil-gizle" title="Forum üzerinden E-Posta gönder">
{UYE_EPOSTA}
	</td>

	<td align="center" class="mobil-gizle" title="Özel ileti gönder">
{UYE_OZEL}
	</td>
	</tr>



<!--__TEKLI_BITIR-1__-->

<!--__KOSUL_BITIR-1__-->



</table>


<div class="sayfalama" style="margin-top:10px">{SAYFALAMA}</div>

<p align="left" class="mobil-gizle">
<font face="verdana" size="1">
Aradığınız koşula uyan üye sayısı: <b>{UYE_SAYISI}</b> &nbsp; 
</font>
</p>

</td></tr></table>
</form>

<!--__KOSUL_BITIR-3__-->

</td></tr></table>

