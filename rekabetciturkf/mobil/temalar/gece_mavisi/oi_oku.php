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

<div class="forumKutu clearfix">
	<div class="OzelMesajKonu">
		<span>{OZEL_ILET_BASLIK}</span>
	</div>
	<div class="clear"></div>
</div>


<div class="forumKutu clearfix">
	<div class="forumKutuBaslik">
		<div class="yazar-sol">{OI_KIMDEN}</div>
		<div class="tarih">{OI_TARIH}</div>
		<div class="clear"></div>
	</div>
<div class="konu-icerik">
<p>{OI_ICERIK}</p>
</div>
<div class="clear"></div>
</div>


<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-1__-->

<div class="forumKutu clearfix">
	<div class="forumKutuBaslik">
		<div class="yazar-sol">{OICEVAP_YAZAN}</div>
		<div class="yazar-sag">Cevap: {OICEVAP_SIRA}</div>
		<div class="tarih">{OICEVAP_TARIH}</div>
		<div class="clear"></div>
	</div>
<div class="konu-icerik">
<p>{OICEVAP_ICERIK}</p>
</div>
<div class="clear"></div>
</div>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-1__-->



<a name="hzlcvp"></a>
<div class="forumKutu clearfix">
<div class="forumKutuBaslik"><span>Hızlı Cevap</span></div>
<div class="hizli-cevap" style="font-weight:bold">
{FORM_BILGI1}

<?php
// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="30" rows="7" name="mesaj_icerik" id="mesaj_icerik" style="width: 100%" class="hizliTextarea" placeholder="Cevap Yaz..." onkeyup="if(EnterGonder(event)&&denetle_mesaj()){if(document.form1.onsubmit())document.form1.submit()}">{FORM_ICERIK}</textarea>';

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
