<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Yüklü Temalar</div>
<div class="kutu-icerik">




<!--__KOSUL_BASLAT-1__-->
<div style="width:100%; height:17px;">
<div class="liste-veri" style="width:200px; height:17px; text-align: left; float: left">
{KIP_FORUM}
</div>

<div class="liste-veri" style="width:200px; height:17px; text-align: right; float: right">
{KIP_PORTAL}
</div>
</div>
<!--__KOSUL_BITIR-1__-->



<div class="liste-veri">
<br>
{SAYFA_ACIKLAMA}
<br><br><br>
<center>
<b>Kullanmak istediğiniz temayı alttan seçiniz.</b>
<br>
Kullanılan Tema: <b>{SUANKI_TEMA}</b>
<br><br>
</center>
</div>


<table cellspacing="1" cellpadding="4" width="100%" border="0" align="left" bgcolor="#d0d0d0">
	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center" width="65">
Kullanım
	</td>
	<td class="forum_baslik" bgcolor="#0099ff" align="center" width="85">
Ekle/Kaldır
	</td>
	<td class="forum_baslik" bgcolor="#0099ff" align="center" width="280">
Tema Görünümü
	</td>
	<td class="forum_baslik" bgcolor="#0099ff" align="center" width="320">
Tema Bilgisi
	</td>
	</tr>



<!--__TEKLI_BASLAT-1__-->

	<tr>
	<td align="center" bgcolor="#ffffff" width="68" valign="middle" class="liste-veri">
<b>
{TEMA_KULLANIM}
</b>
	</td>


	<td align="center" bgcolor="#ffffff" width="85" valign="middle" class="liste-veri">
{EKLE_KALDIR}
	</td>

	<td align="center" bgcolor="#ffffff" width="280" valign="top" class="liste-veri">
<img src="{TEMA_RESIM}" width="250" height="238" border="1" alt="Tema Görüntüsü" style="margin:10px">
	</td>

	<td align="left" class="liste-veri" bgcolor="#ffffff" valign="top" width="320">
<br>Tema adı: &nbsp;{TEMA_ADI}
<br>Yapımcı: &nbsp;{TEMA_YAPIMCI}
<br>Uyumlu Sürümler: &nbsp;{TEMA_SURUM}
<br>Tarih: &nbsp;{TEMA_TARIH}
<br>Demo: &nbsp;{TEMA_DEMO}
<br>Açıklama: &nbsp;{TEMA_ACIKLAMA}

<br>
<br>
<center>
<br><b>{TEMA_UYGULAMA}</b>
<p><b>{TEMA_KULLANICI}</b>
</center>
	</td>
	</tr>

<!--__TEKLI_BITIR-1__-->



</table>

<br>
{YANLIS_KULLANAN}

</div>
</div>
</div>
