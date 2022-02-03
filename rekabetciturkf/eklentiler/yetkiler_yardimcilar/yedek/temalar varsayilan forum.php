<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="link-agaci">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}</div>

<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">


<!--__KOSUL_BASLAT-5__-->

	<tr>
	<td valign="top" align="left" width="100%">

<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center" bgcolor="#d0d0d0" style="margin-bottom:20px;">
	<tr align="center">
	<td colspan="3" class="forum-kategori-alt-baslik">Alt Forum</td>
	<td width="225" class="forum-kategori-alt-baslik tablet-gizle mobil-gizle">Son Konu</td>
	<td width="45" class="forum-kategori-alt-baslik mobil-gizle">Başlık</td>
	<td width="45" class="forum-kategori-alt-baslik mobil-gizle">ileti</td>
	</tr>

<!--__TEKLI_BASLAT-3__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" width="45" class="forum-klasor mobil-gizle">
<img {ALT_FORUM_KLASOR}>
	</td>

	<td align="center" width="45" class="forum-ozel-klasor">
<img {ALT_FORUM_OZEL_KLASOR}>
	</td>

	<td align="left" valign="top">
<a href="{ALT_FORUM_BAGLANTI}"><b>{ALT_FORUM_BASLIK}</b></a> &nbsp; <font color="#ff0000"><i>{ALT_FORUM_GOR}</i></font>
<br>{ALT_FORUM_BILGI}
{ALT_FORUM_YARDIMCILARI}
	</td>

	<td align="left" valign="top" class="tablet-gizle mobil-gizle">
{ALT_SONMESAJ_BASLIK}
{ALT_SONMESAJ_YAZAN}
<p align="right">{ALT_SONMESAJ_TARIH}&nbsp;{ALT_SONMESAJ_GIT}</p>
	</td>

	<td align="center" class="mobil-gizle">
{ALT_FORUM_BASLIK_SAYISI}
	</td>

	<td align="center" class="mobil-gizle">
{ALT_FORUM_MESAJ_SAYISI}
	</td>
	</tr>

<!--__TEKLI_BITIR-3__-->


</table>

	</td>
	</tr>

<!--__KOSUL_BITIR-5__-->





	<tr>
	<td valign="top" align="left" width="100%">

<div style="float: left; position: relative; width: 100%;margin-bottom:10px">
<div style="float: left; position: relative; width: 30%; text-align: left;">{YENI_BASLIK}</div>
<div style="float: right; position: relative; width: 69%" class="sayfalama">{SAYFALAMA}</div>
</div>

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="left" bgcolor="#d0d0d0">
	<tr>
	<td class="forum-kategori-baslik" align="center" colspan="2">Başlık</td>
	<td class="forum-kategori-baslik mobil-gizle" align="center" width="40">Cevap</td>
	<td class="forum-kategori-baslik mobil-gizle" align="center" width="110">Yazan</td>
	<td class="forum-kategori-baslik mobil-gizle" align="center" width="40">Gösterim</td>
	<td class="forum-kategori-baslik" align="center" width="120">Son ileti</td>
	</tr>


<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td align="center" height="50" class="liste-etiket" bgcolor="#ffffff" colspan="6">
{KONU_YOK_UYARI}
	</td>
	</tr>

<!--__KOSUL_BITIR-1__-->




<!--__KOSUL_BASLAT-2__-->


<!--__TEKLI_BASLAT-1__-->



	<tr class="{SATIR_RENK}">
	<td align="center" width="30">
{KONU_KLASOR}
	</td>

	<td align="left">
<b>üst konu:</b><br>
{KONU_BAGLANTI}
{KONU_SAYFALARI}
	</td>

	<td align="center" class="mobil-gizle">
{CEVAP_SAYISI}
	</td>

	<td align="center" class="mobil-gizle">
{YAZAN_BAGLANTI}{KONUYU_ACAN}</a>
	</td>

	<td align="center" class="mobil-gizle">
{GOSTERIM}
	</td>

	<td align="right" class="son-ileti-tarih">
{SONMESAJ_TARIH}
<br>
{CEVAP_YAZAN_BAGLANTI}{CEVAP_YAZAN}</a>&nbsp;{SONMESAJ_BAGLANTI}
	</td>
	</tr>



<!--__TEKLI_BITIR-1__-->


<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-4__-->
	<tr>
	<td height="40" colspan="6" bgcolor="#ffffff" align="center" valign="bottom">
<div style="width: 60%; position: relative; float: center; font-family: arial; font-size: 1px; border: 0px solid #000000; height: 10px; top: 9px">

<div style="background: #cccccc; height: 2px; width: 45%; position: relative; float: left; font-family: arial; font-size: 1px;"></div>

<div style="width: 9%; position: relative; float: left; font-family: arial; font-size: 20px; color: #cccccc; text-weight: bolder; text-align: center; top: -9px;">O</div>

<div style="background: #cccccc; height: 2px; width: 45%; position: relative; float: left; font-family: arial; font-size: 1px;"></div>

</div>
	</td>
	</tr>
<!--__KOSUL_BITIR-4__-->



<!--__KOSUL_BASLAT-3__-->


<!--__TEKLI_BASLAT-2__-->



	<tr class="{SATIR_RENK}">
	<td align="center" width="30">
{KONU_KLASOR}
	</td>

	<td align="left">
{KONU_BAGLANTI}
{KONU_SAYFALARI}
	</td>

	<td align="center" class="mobil-gizle">
{CEVAP_SAYISI}
	</td>

	<td align="center" class="mobil-gizle">
{YAZAN_BAGLANTI}{KONUYU_ACAN}</a>
	</td>

	<td align="center" class="mobil-gizle">
{GOSTERIM}
	</td>

	<td align="right" class="son-ileti-tarih">
{SONMESAJ_TARIH}
<br>
{CEVAP_YAZAN_BAGLANTI}{CEVAP_YAZAN}</a>&nbsp; {SONMESAJ_BAGLANTI}
	</td>
	</tr>



<!--__TEKLI_BITIR-2__-->


<!--__KOSUL_BITIR-3__-->



</table>
	</td>
	</tr>

	<tr>
	<td align="left">

<div style="width: 250px; float: left;margin-top:10px;">

{YENI_BASLIK}
</div>
<div style="margin-top:10px" class="sayfalama">{SAYFALAMA}</div>


<div class="clear"></div>
<div class="link-agaci" style="margin-top:20px">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}</div>


<!--__KOSUL_BASLAT-6__-->

<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#cccccc" style="margin-bottom:20px">
	<tr>
	<td colspan="2" class="forum-kategori-baslik" align="left">
{GOR_KISI}
	</td>
	</tr>

	<tr>
	<td colspan="2" class="liste-veri" bgcolor="#ffffff" align="left" style="padding:10px">
{GOR_UYELER}
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-6__-->


<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
<tr bgcolor="#ffffff">
	<td align="center" width="80"><img {ACIK_FORUM} alt="Açık Başlık"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Açık Başlık</font></td>

	<td align="center" width="80"><img {OZEL_FORUM} alt="Üst Konu"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Üst Konu</font></td>

	<td align="center" width="80"><img {YONETICI_FORUM} alt="Kilitli Başlık"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Kilitli Başlık</font></td>
</tr>
</table>
{FORUMLAR_ARASI_GECIS}

</td></tr></table>
