<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{SAYFA_BASLIK2}</div>
<div class="kutu-icerik">


<table cellspacing="1" cellpadding="4" width="100%" border="0" align="left" bgcolor="#d0d0d0">
	<tr>
	<td colspan="4" height="30" class="liste-etiket" align="center" bgcolor="#ffffff">
{SAYFA_KIP}
	</td>
	</tr>

	<tr>
	<td class="liste-veri" colspan="4" align="left" bgcolor="#ffffff">
<br>

{SAYFA_ACIKLAMA}

<br><br>
	</td>
	</tr>


<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td align="center" height="50" colspan="3" class="liste-etiket" bgcolor="#ffffff">
{EKLENTI_YOK}
	</td>
	</tr>

<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-2__-->

	<tr class="forum_baslik">
	<td align="center" width="95">Durum</td>
	<td align="center" width="115">Görünüm</td>
	<td align="center" colspan="2">Eklenti Bilgisi</td>
	</tr>

<!--__TEKLI_BASLAT-1__-->

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="center" valign="top" rowspan="2" style="font-weight: bolder;">{EKLE_KALDIR}</td>

	<td align="center" valign="middle" rowspan="2">{EKLENTI_RESIM}</td>

	<td align="center" valign="middle" height="28" colspan="2">
<b>{EKLENTI_ADI}</b>
	</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td align="left" valign="top" style="min-width:225px">
{EKLENTI_ACIKLAMA1}
	</td>

	<td align="left" valign="top" style="min-width:230px">
<div style="position: relative; float: center; overflow: auto; width: 100%; height: 140px;" onclick="this.style.height=''">
{EKLENTI_ACIKLAMA2}
</div>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" valign="top" colspan="4">
<div style="position: relative; float: center; overflow: auto; width: 100%; height: 39px;" onclick="this.style.height=''">
{EKLENTI_ACIKLAMA3}
</div>
	</td>
	</tr>

	<tr><td bgcolor="#246A8A" colspan="4" style="padding:0;margin:0;height:4px"></td></tr>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-2__-->

</table>

</div>
</div>
</div>