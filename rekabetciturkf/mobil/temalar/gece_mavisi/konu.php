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
<div class="forumKutuBaslik">&nbsp;{SAYFA_BASLIK} &nbsp;&raquo;<br>
{FORUM_BASLIK} {ALT_FORUM_BASLIK}
</div>
<div class="clear"></div>
</div>

{SAYFALAMA}

<!--__TEKLI_BASLAT-1__-->

<div class="forumKutu clearfix">
	<div class="forumKutuBaslik">
		<div class="yazar-sol">{YAZAN} &nbsp;|&nbsp; <i>{BASLIK}</i></div>
		<div class="yazar-sag">{CEVAPNO}</div>
		<div class="tarih">{TARIH}</div>
		<div class="clear"></div>
	</div>
	<div class="konu-icerik">
		<p>{ICERIK}</p>
	</div>
	<div class="clear"></div>
</div>

<!--__TEKLI_BITIR-1__-->

{SAYFALAMA}

<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-3__-->

<a name="hcevap"></a>
<div class="forumKutu clearfix">
<div class="forumKutuBaslik"><span>Hızlı Cevap</span></div>
<div class="hizli-cevap" style="font-weight:bold">

{FORM_BILGI}

<?php
// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="30" rows="7" name="mesaj_icerik" id="mesaj_icerik" style="width: 100%" class="hizliTextarea" placeholder="Cevap Yaz..." onkeyup="if(EnterGonder(event)&&denetle_mesaj()){if(document.form1.onsubmit())document.form1.submit()}">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
$ayarlar['duzenleyici'] = 'duz';
$duzenleyici_dizin = '../';
include_once('../bilesenler/editor/index.php');
?>

<p style="margin-top:12px;"><label style="cursor:pointer"><input type="checkbox" checked="checked" name="enter_gonder">Enter tuşu ile gönder</label></p>

<input class="hizliDugme" style="width:50%" name="mesaj_gonder" type="submit" value="G ö n d e r">
<input class="hizliDugme" style="width:49%" name="onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj(mobil_dizin)" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir.">

</form>
</div>
<div class="clear"></div>
</div>

<!--__KOSUL_BITIR-3__-->
