<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="uyeAlani" style="display:block;text-align:center;">
	<ul class="kutuListe">
		<div><li><a href="ozel_ileti.php" title="Gelen Kutusu">Gelen</a></li></div>
		<div><li><a href="ozel_ileti.php?kip=ulasan" title="Ulaşan Kutusu">Ulaşan</a></li></div>
		<div><li><a href="ozel_ileti.php?kip=gonderilen" title="Gönderilen Kutusu">Gönderilen</a></li></div>
		<div><li><a href="ozel_ileti.php?kip=kaydedilen" title="Kaydedilen Kutusu">Kaydedilen</a></li></div>
	</ul>
<div class="clear"></div>
</div>


<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">
	<tr>
	<td align="center" width="30" class="ozeLkutuBaslik"></td>
	<td align="left" class="ozeLkutuBaslik">Konu</td>
	<td align="center" width="120" class="ozeLkutuBaslik">{KIMDEN_KIME}</td>
	<td align="center" width="50" class="ozeLkutuBaslik">Yanıt</td>
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

	<tr class="ozelKutuMesaj">
	<td align="center">{OI_SIMGE}</td>
	<td align="left">{OZEL_ILET_BASLIK}</td>
	<td align="center">{OI_KIMDEN}<span class="tarih">{OI_TARIH1}</span></td>
	<td align="center">{OI_CEVAP}</td>
	</tr>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-2__-->

</table>


<div class="forumKutu clearfix">
<div class="forumKutuBaslik"><span>Özel ileti Gönder</span></div>
<div class="hizli-cevap" style="font-weight:bold">
<form action="../bilesenler/oi_yaz_yap.php" method="post" name="form1" onsubmit="return denetle_duzenleyici()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="sayfa_onizleme" value="oi_yaz">
<input type="hidden" name="mesaj_onizleme" value="Önizleme">
<input type="hidden" name="bbcode_kullan" value="1">
<input type="hidden" name="ifade" value="1">
<input type="hidden" name="mobil" value="1">
<input type="text" name="ozel_kime" placeholder="Üye Adı" style="width: 100%;" class="hizliKime">
<input type="text" name="mesaj_baslik" placeholder="Başlık" style="width: 100%;" class="hizliKime" value="">
<br>

<?php
// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="30" rows="7" name="mesaj_icerik" id="mesaj_icerik" style="width: 100%" class="hizliTextarea" placeholder="Özel ileti içerik..." onkeyup="if(EnterGonder(event)&&denetle_mesaj()){if(document.form1.onsubmit())document.form1.submit()}">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
$ayarlar['duzenleyici'] = 'duz';
$duzenleyici_dizin = '../';
include_once('../bilesenler/editor/index.php');
?>

<p style="margin-top:10px;"><label style="cursor:pointer"><input type="checkbox" checked="checked" name="enter_gonder">Enter tuşu ile gönder</label></p>

<input class="hizliDugme" style="width:50%" name="mesaj_gonder" type="submit" value="G ö n d e r">
<input class="hizliDugme" style="width:49%" name="onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj(mobil_dizin)" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir.">

</form>
</div>
</div>
<div class="clear"></div>
