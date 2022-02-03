<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="link-agaci">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}</div>

<div style="float: left; position: relative; width: 100%; height: 40px;">
<div style="float: left; position: relative; width: 50%; text-align: left;">{BASLIK_CEVAP}</div>
<div style="float: right; position: relative; width: 50%" class="sayfalama">{SAYFALAMA}</div>
</div>

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="left" bgcolor="#d0d0d0">

<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
{KONU_ANAME}
{KONU_BASLIK2}
	</td>
	</tr>

	<tr class="liste-etiket" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle">Yazan</td>
	<td width="100%" align="center">Konu içeriği</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle">
<img src="temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">

<div class="yazar-bilgi"><b>{KONU_ACAN}</b></div>
<div class="yazar-bilgi">[{KONU_ACAN_ADI}]</div>
<div class="yazar-bilgi">{KONU_ACAN_YETKISI}</div>
<div class="yazar-bilgi"><div style="max-width:160px; max-height:160px">{KONU_ACAN_RESMI}</div></div>
<div class="yazar-bilgi">
	<font size="1" face="verdana">
Kayıt: {KONU_ACAN_KAYIT}
<br>
İleti: {KONU_ACAN_MESAJSAYI}
<br>
Konum: {KONU_ACAN_SEHIR}
<br>
Durum: {KONU_ACAN_DURUM}
<br>
<br>
{KONU_ACAN_EPOSTA}
{KONU_ACAN_WEB}
<br>
{KONU_ACAN_OZEL}
<br><br>
{TSK_ETTI}
<br>
{TSK_EDILDI}
<br>
</font>
</div>


	</td>

	<td valign="top" height="150" align="left">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b>Konu Yazan:</b> {KONU_ACAN}<br>
</div>
<b>Konu Tarihi: </b> {KONU_TARIHI}
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
{KONU_ALINTI_DUZENLE}
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="clear:both; position:relative; margin:0px 4px 0px 4px; overflow:auto; word-wrap:break-word">

{KONU_ICERIK}
<br><p align="right">{TESEKKUR}</p>

<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri" bgcolor="#ffffff" align="left">
{KONU_ACAN_IMZA}
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
<style type="text/css">@import url("eklentiler/begeni_sistemi/begeni_sablon.css");</style>
<div style="display:none">
<form id="begeni-formu" method="post" action="eklentiler/begeni_sistemi/begen.php">
<input type="hidden" id="begen-input" name="begen_id" value="{KONU_ID}" />
<input type="hidden" id="begenme-input" name="begenme_id" />
</div>
{BEGENI_SISTEMI}
</form>
<script src="eklentiler/begeni_sistemi/phpkf-ajax.js" type="text/javascript"></script>
</div>
{KONU_DEGISTIRME}{TSK_EDENLER}
	</td>
	</tr>


<!--__KOSUL_BITIR-1__-->







<!--__KOSUL_BASLAT-2__-->

<!--__TEKLI_BASLAT-1__-->



	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
{CEVAP_ANAME}
<div style="float: left; text-align: left; width: 70%">{CEVAP_BASLIK}</div>
<div style="float: right; text-align: right; font-size: 11px; position: relative; top: 3px; width: 30%">
{ILETI_NO} &nbsp; 
</div>
	</td>
	</tr>

	<tr class="liste-etiket" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle">Yazan</td>
	<td width="100%" align="center">Cevap içeriği</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle" style="background:#f8f8f8;border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;">
<img src="temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">

<span style="position: relative;top: -21px;">
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;position: relative;top: 22px;"><b style="font-size: 16px;">{CEVAP_YAZAN}</b></div>
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;background: #9acd3200;position: relative;top: 13.4px;">{CEVAP_YAZAN_YETKISI}</div>
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;"><div>{CEVAP_YAZAN_DURUM}{CEVAP_YAZAN_RESMI}</div>

<span style="position: relative;top: 9.7px;">
<div class="yazarbilgisi" style="background: #fff;color: #3e3e3e;border: 1px solid #cccccc;padding: 3px 3px 3px 10px;margin-top: 2px;text-align: left;-moz-border-radius: 10px;-webkit-border-radius: 5px;border-radius: 5px;font-family: Verdana, Arial, Sans-Serif;font-size: 13px;white-space: nowrap;position: relative;top: -7px;"><img src="temalar/varsayilan/resimler/kayittarihi.png">&nbsp;&nbsp;&nbsp;&nbsp;<span style="position: relative;top: -1.6px">{CEVAP_YAZAN_KAYIT}</span></div>
<div class="yazarbilgisi" style="background: #fff;color: #3e3e3e;border: 1px solid #cccccc;padding: 3px 3px 3px 10px;margin-top: 2px;text-align: left;-moz-border-radius: 10px;-webkit-border-radius: 5px;border-radius: 5px;font-family: Verdana, Arial, Sans-Serif;font-size: 13px;white-space: nowrap;position: relative;top: -4px;"><img src="temalar/varsayilan/resimler/paylasim.png">&nbsp;&nbsp;&nbsp;&nbsp;<span style="position: relative;top: -1.6px">{CEVAP_YAZAN_MESAJSAYI} Paylaşım yaptı</span></div>
<div class="yazarbilgisi" style="background: #fff;color: #3e3e3e;border: 1px solid #cccccc;padding: 3px 3px 3px 10px;margin-top: 2px;text-align: left;-moz-border-radius: 10px;-webkit-border-radius: 5px;border-radius: 5px;font-family: Verdana, Arial, Sans-Serif;font-size: 13px;white-space: nowrap;"><img src="temalar/varsayilan/resimler/begendim.png">&nbsp;&nbsp;&nbsp;&nbsp;<span style="position: relative;top: -1.6px">7 Beğeni aldı</span></div>
</span>
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;"><font size="1" face="verdana">
</span>

<br><br>
{CVP_TSK_EDILDI}
<br>
{CVP_TSK_ETTI}
<br>
</font></div>


	</td>

	<td valign="top" height="150" align="left">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b>Cevap Yazan:</b> {CEVAP_YAZAN}<br>
</div>
<b>Cevap Tarihi: </b> {CEVAP_TARIHI}
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
{CEVAP_ALINTI_DUZENLE}
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="clear:both; position:relative; margin:0px 4px 0px 4px; overflow:auto; word-wrap:break-word">

{CEVAP_ICERIK}
<br><p align="right">{CVP_TESEKKUR}</p>

<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri" bgcolor="#ffffff" align="left">
{CEVAP_YAZAN_IMZA}

{CEVAP_DEGISTIRME}{CEVAP_TSK_EDENLER}
	</td>
	</tr>



<!--__TEKLI_BITIR-1__-->


<!--__KOSUL_BITIR-2__-->


</table>



<div style="float: left; position: relative; width: 100%;margin-top:10px">
<div style="float: left; position: relative; width: 50%; text-align: left;">{BASLIK_CEVAP}</div>
<div style="float: right; position: relative; width: 50%" class="sayfalama">{SAYFALAMA}</div>
</div>
<div class="clear"></div>

<div class="link-agaci" style="margin-top:20px">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}{KONU_BASLIK}</div>


<!--__KOSUL_BASLAT-4__-->

<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#cccccc">
	<tr>
	<td colspan="2" class="forum-kategori-baslik" align="left">
&nbsp;{GOR_KISI}
	</td>
	</tr>

	<tr>
	<td colspan="2" class="liste-veri" bgcolor="#ffffff" align="left" style="padding:10px 20px">
&nbsp;{GOR_UYELER}
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-4__-->


{FORUMLAR_ARASI_GECIS}
<div class="clear"></div>
{BENZER_KONULAR}
{ETIKETLER}


<!--__KOSUL_BASLAT-3__-->

{FORM_BILGI1}
<input type="hidden" name="mesaj_baslik" value="Cvp:">

<table cellspacing="0" cellpadding="0" border="0" align="center" class="hizli_cevap">
	<tr>
	<td class="hizli_cevap_baslik">&nbsp; Hızlı Cevap</td>
	</tr>

	<tr>
	<td class="hizli_cevap_form_icerik">
<?php
// Hızlı Cevap için ayarlanan düzenleyici seçiliyor
$duzenleyici = $ayarlar['yduzenleyici'];
$duzenleyici_tip = 'hizli';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="77" rows="10" name="mesaj_icerik" id="mesaj_icerik" class="post" placeholder="Cevap Yaz..." style="width:98%">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
include_once('bilesenler/editor/index.php');
?>

<label style="cursor:pointer">
<input type="checkbox" name="bbcode_kullan" checked="checked">Bu iletide BBCode kullan</label>
<br>
<label style="cursor:pointer">
<input type="checkbox" name="ifade" checked="checked">Bu iletide ifade kullan</label>

<div align="center">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="G ö n d e r"> &nbsp; &nbsp;
<input class="dugme dugme-mavi" name="mesaj_onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj()" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir">
</div>
	</td>
	</tr>
</table>

</form>

<!--__KOSUL_BITIR-3__-->
