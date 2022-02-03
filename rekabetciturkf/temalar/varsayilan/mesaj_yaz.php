<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<!--__KOSUL_BASLAT-4__-->

<div class="link-agaci" style="margin:0 auto; margin-bottom:20px">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}{SAYFA_BASLIK}{CEVAP_BASLIK}</div>

<!--__KOSUL_BITIR-4__-->

{JAVASCRIPT_KAPALI}




<!--__KOSUL_BASLAT-3__-->

<a name="onizleme"></a>
<div class="mobil-tam" style="margin:20px auto;width:90%">
<div class="giris-form-baslik" style="border-bottom:0;border-left:1px solid #dddddd;border-right:1px solid #dddddd">Önizleme</div>

<table cellspacing="1" width="100%" cellpadding="7" border="0" align="center" class="tablo_border4">
	<tr bgcolor="#ffffff">
	<td class="liste-etiket" align="left" width="140">Kimden:</td>
	<td class="liste-veri" align="left">
{ONIZLEME_KIMDEN}
	</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td class="liste-etiket" align="left">Kime:</td>
	<td class="liste-veri" align="left">
{ONIZLEME_KIME}
	</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td class="liste-etiket" align="left">Konu:</td>
	<td class="liste-veri" align="left">
{ONIZLEME_BASLIK}
	</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td class="liste-etiket" valign="top" align="left"><br>İleti:</td>
	<td class="liste-veri" align="left">
<br>
{ONIZLEME_ICERIK}
	</td>
	</tr>
</table>
<br>
</div>

<!--__KOSUL_BITIR-3__-->




<!--__KOSUL_BASLAT-1__-->

<a name="onizleme"></a>

<div style="margin:20px auto">
<div class="giris-form-baslik" style="border-bottom:0;border-left:1px solid #dddddd;border-right:1px solid #dddddd"><image src="temalar/varsayilan/resimler/bitidiklerim.png" style="padding-bottom: 5px;position: relative;top: 7px;" />   <span style="position: relative;top: 1.3px; left: 1.6px; font-size:13.7px;">{ONIZLEME_BASLIK}</span>&nbsp;<span style="color: red;position: relative;top: 1.37px;left: 7.6px;font-size: 12px;">(Önizleme gösterimi)</span></div>

<table cellspacing="1" cellpadding="4" border="0" align="center" class="tablo_border4" style="width:100%">
	<tr class="liste-etiket" bgcolor="#f5f5f5" style="display:none;">
	<td width="170" align="center">Yazan</td>
	<td width="100%" align="center">Mesaj içeriği</td>
	</tr>

	<tr class="liste-veri" bgcolor="#ffffff">
	<td width="170" valign="top" rowspan="2" align="left" style="background: #f8f8f8;">

<img src="temalar/varsayilan/resimler/bosluk170.gif" width="170" height="0" border="0" style="display: block;height:0px" alt="boşluk">

<span style="position: relative;top: -21px;">
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;position: relative;top: 22px;"><b style="font-size: 16px;">{ONIZLEME_UYE_ADI}</b></div>
<div class="yazar-bilgi" style="border:0px solid #ccc;border-bottom:0px solid #bbb;border-right:0px solid #bbb;"><div style="width:147px; height:143px;padding-left:7px;padding-top: 17px;">{ONIZLEME_RESIM}</div></div>

<span style="position: relative;top: 4.6px;">
<div class="yazarbilgisi" style="background: #fff;color: #3e3e3e;border: 1px solid #cccccc;padding: 3px 3px 3px 10px;margin-top: 2px;text-align: left;-moz-border-radius: 10px;-webkit-border-radius: 5px;border-radius: 5px;font-family: Verdana, Arial, Sans-Serif;font-size: 13px;white-space: nowrap;position: relative;top: -7px;"><img src="temalar/varsayilan/resimler/kayittarihi.png">&nbsp;&nbsp;&nbsp;&nbsp;<span style="position: relative;top: -1.6px">{ONIZLEME_KATILIM}</span></div>
<div class="yazarbilgisi" style="background: #fff;color: #3e3e3e;border: 1px solid #cccccc;padding: 3px 3px 3px 10px;margin-top: 2px;text-align: left;-moz-border-radius: 10px;-webkit-border-radius: 5px;border-radius: 5px;font-family: Verdana, Arial, Sans-Serif;font-size: 13px;white-space: nowrap;position: relative;top: -4px;"><img src="temalar/varsayilan/resimler/paylasim.png">&nbsp;&nbsp;&nbsp;&nbsp;<span style="position: relative;top: -1.6px">{ONIZLEME_MESAJ_SAYI} Paylaşım yaptı</span></div>
</span>
</span>
	</td>

	<td valign="top" height="190" align="left">
<span style="float:right;padding-right: 7.9px;"><b style="position: relative;top: 3px;left: 3.4px;">Yayınlanacak Tarih:</b> <span style="position: relative;top: 3px;left: 3.4px;">{ONIZLEME_TARIH}</span></span>
<hr size="1" style="border:0;border-bottom: 2px solid #ccc;display: none;">
<br>

<span style="margin:0px 4px 0px 4px;">{ONIZLEME_MESAJ}</span>

<br><br>
	</td>
	</tr>

	<tr style="display:none;">
	<td height="23" class="liste-veri" bgcolor="#ffffff" align="left">
{ONIZLEME_IMZA}
	</td>
	</tr>
</table>
<br>
</div>

<!--__KOSUL_BITIR-1__-->




<div class="genel-tablo" style="box-sizing:border-box; display:table; width:100%" id="tablo_buyut3">
<div class="giris-form-baslik">{SAYFA_KIP}<span class="mobil-gizle" style="float:right; cursor:pointer; font-weight:normal; font-size:30px; line-height:12px" onclick="alan_buyut('811px')">&#8652;</span></div>

<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%;padding-right:20px">
	<tr>
	<td align="center" valign="top">

{FORM_BILGI1}
<table cellspacing="10" cellpadding="0" width="100%" border="0" align="left" class="tablo_ici">
<!--__KOSUL_BASLAT-5__-->

	<tr>
	<td class="liste-etiket mobil-gizle" align="left" valign="middle">
KİME:
	</td>
	<td class="liste-etiket" align="left" valign="middle">
<input class="formlar" type="text" name="ozel_kime" size="25" maxlength="20" placeholder="Gönderilecek Üye Adı" value="{OI_KIME}" style="width:175px" />
&nbsp;&nbsp;<a style="font-weight:normal; text-decoration:none" href="javascript:uye_ara();">Üye Ara</a>
	</td>
	</tr>

<!--__KOSUL_BITIR-5__-->

	<tr>
	<td class="liste-etiket mobil-gizle" style="width:160px" align="left" valign="middle">
KONU:
	</td>

	<td class="liste-etiket" align="left" valign="middle" style="padding-right: 14px">
<input class="formlar" type="text" name="mesaj_baslik" size="25" maxlength="200" value="{FORM_BASLIK}" placeholder="Konu Başlığı" style="width:100%" />
	</td>
	</tr>
	<tr>
	<td class="liste-etiket mobil-gizle" align="left" valign="top" rowspan="5">
İÇERİK:
<div style="height:24px"></div>
<img src="temalar/varsayilan/resimler/bosluk170.gif" width="140" height="1" border="0" alt="boşluk">
<div align="center" style="font-weight:normal; font-size:10px; position:relative; float:center; overflow:auto; width:100%; height:140px">

<b>ifadeler:</b>
<div style="height:12px"></div>
<?php echo ifade_olustur('5'); ?>
</div>


<div style="height:20px"></div>
<font class="ufak" style="line-height:17px">
<b style="display:block;text-align:center;margin-bottom:6px">BBCode:</b>
[b] kalın [/b]<br>
[i] yatık [/i]<br>
[u] altı çizgili [/u]<br>
[size=5] büyük [/size]<br>
[color=red] renkli [/color]<br>
[code=php] echo [/code]<br>
[quote="ad"] alıntı [/quote]<br>
[img] resim.gif [/img]
<div style="height:18px"></div>

<a href="yardim.php#bbcode" target="_blank">[BBCode Yardım]</a>
</font>
	</td>


	<td class="liste-etiket" valign="top" id="tablo_buyut2">
<?php
// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="69" rows="27" name="mesaj_icerik" id="mesaj_icerik" class="formlar_mesajyaz">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
include_once('bilesenler/editor/index.php');
?>
	</td>
	</tr>

	<tr>
	<td align="center" class="liste-etiket" valign="top">
<div align="left">
{FORM_OZELLIK}
</div>
<br>
	</td>
	</tr>

	<tr class="liste-etiket">
	<td align="center" class="liste-etiket" valign="top">
<div style="width:50%; float:left; text-align:right">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="G ö n d e r" />&nbsp;&nbsp;
</div>

<div style="width:50%; float:left; text-align:left">
<input class="dugme dugme-mavi" name="mesaj_onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj()" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir" />
</div>
	</td>
	</tr>
</table>
</form>

	</td>
	</tr>

	<tr>
	<td width="140" height="20"></td>
	</tr>

</table>

</div>




<!--__KOSUL_BASLAT-2__-->

<br><br><br>
<div style="margin:10px auto;width:100%;background:#ffffff">
<div class="giris-form-baslik" style="border-bottom:0; border-left:1px solid #dddddd; border-right:1px solid #dddddd">"{MESAJ_BASLIK}" &nbsp; &nbsp; <i>cevaplarının yeniden eskiye sıralanışı</i></div>

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#dddddd">

<!--__TEKLI_BASLAT-1__-->

	<tr>
	<td bgcolor="#ffffff" class="liste-veri" align="left">

<b>{YAZI_BASLIK}:</b> {CEVAP_BASLIK} &nbsp; &nbsp; 
<b>{YAZI_YAZAN}:</b> {CEVAP_YAZAN} &nbsp; &nbsp; 
<b>{YAZI_TARIH}: </b> {CEVAP TARIH}
<hr style="border: 1px solid #909090; width:100%"><br>

{CEVAP_ICERIK}

<br>
<br>
	</td>
	</tr>

<!--__TEKLI_BITIR-1__-->

</table>
</div>
<br>

<!--__KOSUL_BITIR-2__-->
