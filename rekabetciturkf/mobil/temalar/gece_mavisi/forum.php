<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<!--__KOSUL_BASLAT-1__-->

<ul class="mobilKonuListe">
	<li>
		<div class="konu" align="center" style="padding:30px"><b style="font-size:16px">{HATA_ILETISI}</b></div>
	</li>
</ul>

<!--__KOSUL_BITIR-1__-->


<!--__KOSUL_BASLAT-2__-->

<div class="forumKutu clearfix">
<div class="forumKutuBaslik">&nbsp;{SAYFA_BASLIK} &nbsp;&raquo;&nbsp; {FORUM_BASLIK} {ALT_FORUM_BASLIK}
</div>
<div class="clear"></div>
</div>

{SAYFALAMA}

<ul class="mobilKonuListe">
<!--__TEKLI_BASLAT-1__-->

<li>
	<div class="liste"><span>{SIRA}</span></div>
	<div class="konu"><a href="{KONU_BAGLANTI}">{KONU_BASLIK} <i>[{KONU_YAZAN}]</i>
	<p>{KONU_SONCEVAP_YAZAN} | {KONU_SONCEVAP_TARIH}</p></a></div>
</li>

<!--__TEKLI_BITIR-1__-->
</ul>

{SAYFALAMA}

<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-3__-->

<a name="hcevap"></a>
<div class="forumKutu clearfix">
<div class="forumKutuBaslik"><span>Hızlı Konu Açma</span></div>
<div class="hizli-cevap" style="font-weight:bold">

{FORM_BILGI}
<input type="text" name="mesaj_baslik" placeholder="Konu Başlık" style="width: 100%;" class="hizliKime" value="">

<?php
// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="30" rows="7" name="mesaj_icerik" id="mesaj_icerik_div" style="width: 100%" class="hizliTextarea" placeholder="Konu içerik..." onkeyup="if(EnterGonder(event)&&denetle_mesaj()){if(document.form1.onsubmit())document.form1.submit()}">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
$ayarlar['duzenleyici'] = 'duz';
$duzenleyici_dizin = '../';
include_once('../bilesenler/editor/index.php');
?>

<p style="margin-bottom:12px"><label style="cursor:pointer"><input type="checkbox" checked="checked" name="enter_gonder">Enter tuşu ile gönder</label></p>

<input class="hizliDugme" style="width:50%" name="mesaj_gonder" type="submit" value="G ö n d e r">
<input class="hizliDugme" style="width:49%" name="onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj(mobil_dizin)" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir.">

</form>
</div>
<div class="clear"></div>
</div>

<!--__KOSUL_BITIR-3__-->