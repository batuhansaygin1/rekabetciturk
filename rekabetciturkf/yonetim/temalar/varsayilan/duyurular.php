<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{SAYFA_BASLIK}</div>
<div class="kutu-icerik">



<!--__KOSUL_BASLAT-1__-->


<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:728px">
	<tr class="tablo_ici">
	<td align="left" class="liste-veri" colspan="2">


<form action="duyurular.php" method="post" onsubmit="return denetle_duzenleyici()" name="form1" id="duzenleyici_form">
<input type="hidden" name="duyuru" value="{KIP}">
<input type="hidden" name="dno" value="{DNO}">
<input type="hidden" name="bbcode_kullan" value="">


<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-etiket" align="left" height="40" valign="middle" width="100">
&nbsp; BÖLÜM: 
<br><img src="../temalar/varsayilan/resimler/bosluk170.gif" width="100" height="1" border="0" alt="boşluk">
	</td>
	<td class="liste-etiket" valign="top">
{FORUM_SECENEK}
	</td>
	</tr>

	<tr>
	<td class="liste-etiket" align="left" height="30" valign="middle">
&nbsp; KONU:
	</td>
	<td class="liste-etiket" valign="top" style="padding-right:14px">
<input class="formlar" type="text" name="mesaj_baslik" size="25" maxlength="60" value="{DUYURU_BASLIK}" style="width:100%">
	</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
	</tr>


	<tr>
	<td class="liste-etiket" valign="top" rowspan="4" align="left">
&nbsp; İÇERİK:
<p>
<div style="font-weight: normal">
<font size="1">
<br><br><br>
&nbsp; HTML <b>açık</b><br>
&nbsp; BBCode <b>kapalı</b>
</font>
</div>
	</td>


	<td class="liste-etiket" valign="top" id="tablo_buyut2">
<?php
// Düzenleyici (Editör) yükleniyor
$duzenleyici_dizin = '../';
$duzenleyici_bicim = 'html';

$duzenleyici = $ayarlar['dduzenleyici'];
$duzenleyici_id = 'mesaj_icerik';

$duzenleyici_textarea = '<textarea cols="69" rows="27" name="mesaj_icerik" id="mesaj_icerik" class="formlar_mesajyaz">{FORM_ICERIK}</textarea>
<div class="clear"></div>';

include_once('../bilesenler/editor/index.php');
?>

	</td>
	</tr>

	<tr>
	<td style="height:10px">&nbsp;</td>
	</tr>

	<tr>
	<td align="center" class="liste-etiket" valign="top" colspan="2">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="{FORM_GONDER}">
	</td>
	</tr>

	<tr>
	<td style="height:10px">&nbsp;</td>
	</tr>
</table>
</form>

	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-1__-->





<!--__KOSUL_BASLAT-2__-->

<div style="width: 100%; float: left; padding-bottom:10px">
<div style="width: 35%; float: left; margin-top:12px"><a href="{YENI_DUYURU_EKLE}"><b>[ Yeni Duyuru Ekle ]</a></b></div>
<div style="width: 64%; float: right; text-align: right;">
<form action="duyurular.php" method="get" name="duyuru_sirala">
<select name="sirala" class="formlar">
{SIRALAMA_SECENEK}
</select>
&nbsp; <input class="dugme" type="submit" value="Sırala">
</form>
</div>
</div>

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="left" class="tablo_border4">

<!--__TEKLI_BASLAT-1__-->

	<tr class="tablo_ici">
	<td align="left" class="liste-veri" colspan="2">

	<br>
<b>Bölüm:</b> &nbsp; &nbsp; {FORUM_BASLIK}
<br><br>
<b>İşlemler:</b> &nbsp; &nbsp; <a href="duyurular.php?kip=duzenle&amp;dno={DNO}"><img {SIMGE_DEGISTIR} alt="duyuruyu düzenle" title="duyuruyu düzenle"></a>
&nbsp; <a href="duyurular.php?kip=sil&amp;dno={DNO}&amp;yo={YO}"><img {SIMGE_SIL} alt="bu duyuruyu sil" title="bu duyuruyu sil" onclick="return window.confirm('Bu duyuruyu silmek istediğinize eminmisiniz?')"></a>
<br><br>
<b>Başlık:</b> {DUYURU_BASLIK}<br><br><br>
<b>İçerik:</b><br> {DUYURU_ICERIK}

	</td>
	</tr>

<!--__TEKLI_BITIR-1__-->

</table>

<div style="width: 100%; float: left; padding-top:10px">
<div style="width: 35%; float: left; padding-top:10px"><a href="{YENI_DUYURU_EKLE}"><b>[ Yeni Duyuru Ekle ]</b></a></div>
<div style="width: 64%; float: right; text-align: right;">
<form action="duyurular.php" method="get" name="duyuru_sirala">
<select name="sirala" class="formlar">
{SIRALAMA_SECENEK}
</select>
&nbsp; <input class="dugme" type="submit" value="Sırala">
</form>
</div>
</div>

<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-3__-->

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="left" class="tablo_border4">
	<tr class="tablo_ici">
	<td align="left" class="liste-etiket" colspan="2">
<br>
{DUYURU_YOK}
<br><br><br>
 &nbsp; <a href="{YENI_DUYURU_EKLE}">[ Yeni Duyuru Ekle ]</a>
<br><br>
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-3__-->



</div>
</div>
</div>
