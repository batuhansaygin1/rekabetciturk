<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="width:100%">
	<tr>
	<td colspan="6" class="forum-kategori-baslik" align="center" valign="middle">
Özel İletiler
	</td>
	</tr>

	<tr>
	<td align="center" valign="top">

<table cellspacing="0" cellpadding="0" border="0" align="center" class="ozel_ileti_linkler" style="margin-top:10px">
	<tr>
	<td align="center" class="liste-veri" height="25">
<a href="profil.php">Üyelik Bilgilerim</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php">Bilgilerimi Değiştir</a>
&nbsp; | &nbsp;
<a href="ozel_ileti.php?kip=ayarlar">Özel İleti Ayarları</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=takip">Takip Edilenler</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=yuklemeler">Yüklemeler</a>
&nbsp; | &nbsp;
<a href="profil_degistir.php?kosul=bildirim">Bildirimler</a>
	</td>
	</tr>
</table>



<table cellspacing="4" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td align="center">
<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td align="left" valign="top" width="100%" height="35">
<a href="oi_yaz.php" title="Özel ileti gönder">{OZEL_ILETI_GONDER}</a>
	</td>
	</tr>

	<tr>
	<td align="center" valign="top" width="100%">

<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" bgcolor="#d0d0d0">
	<tr>
	<td colspan="4" height="35" class="liste-etiket" align="center" bgcolor="#f8f8f8">
<a href="ozel_ileti.php">Gelen Kutusu</a> &nbsp; | &nbsp; 
<a href="ozel_ileti.php?kip=ulasan">Ulaşan Kutusu</a> &nbsp; | &nbsp; 
<a href="ozel_ileti.php?kip=gonderilen">Gönderilen Kutusu</a> &nbsp; | &nbsp; 
<a href="ozel_ileti.php?kip=kaydedilen">Kaydedilen Kutusu</a>
	</td>
	</tr>

	<tr bgcolor="#ffffff">
	<td class="forum-kategori-alt-baslik" align="center" width="100%" >
{OZEL_ILET_BASLIK}
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left" bgcolor="#ececec" style="color:#000000; border:1px solid #ffffff">
<div style="position:relative; float:left; text-align:left; width:50px">
<img src="{GONDEREN_RESIM}" width="36" style="border:1px solid #999999" alt="Kullanıcı Resmi" title="Kullanıcı Resmi"></div>
<div style="position:relative; float:left; text-align:left;">
<div style="margin-top:4px;"><b>Yazan: </b>{OI_KIMDEN}
<br><b>Tarih: </b>{OI_TARIH}</div>
</div>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left">
<div style="position:relative; overflow:auto; padding:5px 10px 20px 10px;">
{OI_ICERIK}
</div>
	</td>
	</tr>


<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-1__-->

	<tr>
	<td class="liste-veri" align="left" bgcolor="#ececec" style="color:#000000; border:1px solid #ffffff">
<div style="position:relative; float:left; text-align:left; width:50%">

<div style="position:relative; float:left; width:50px">
<img src="{CGONDEREN_RESIM}" width="36" style="border:1px solid #999999" alt="Kullanıcı Resmi" title="Kullanıcı Resmi"></div>
<div style="margin-top:4px;"><b>Yazan: </b>{OICEVAP_YAZAN}
<br><b>Tarih: </b>{OICEVAP_TARIH}</div>

</div>

<div style="position:relative; float:left; text-align:right; width:50%">
<br><b>Cevap: {OICEVAP_SIRA}</b>
</div>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="#ffffff" align="left" valign="top">
<div style="position:relative; overflow:auto; padding:5px 10px 20px 10px;">
{OICEVAP_ICERIK}
</div>
	</td>
	</tr>

<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-1__-->


</table>

	</td>
	</tr>

	<tr>
	<td align="left" valign="top" class="liste-veri">
<a name="hzlcvp"></a>
<div style="height:15px"></div>
<div class="oihizlicevap_baslik">Hızlı Cevap:</div>

{FORM_BILGI1}
<input type="hidden" name="mesaj_baslik" value="Cvp:" />

<div align="left">
<?php
// Hızlı Cevap için ayarlanan düzenleyici seçiliyor
$duzenleyici = $ayarlar['yduzenleyici'];
$duzenleyici_tip = 'hizli';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="77" rows="10" name="mesaj_icerik" id="mesaj_icerik" class="post" placeholder="Cevap Yaz..." style="width:100%; height:180px; margin:0px; box-sizing:border-box">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
include_once('bilesenler/editor/index.php');
?>
</div>

<div align="left">
<label style="cursor:pointer">
<input type="checkbox" name="bbcode_kullan" checked="checked" />Bu iletide BBCode kullan</label>
<br>
<label style="cursor:pointer">
<input type="checkbox" name="ifade" checked="checked" />Bu iletide ifade kullan</label>
</div>

<div align="center" class="liste-veri">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="G ö n d e r" />&nbsp; &nbsp;
<input class="dugme dugme-mavi" name="mesaj_onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj()" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir" />
</div>

</form>

	</td>
	</tr>
</table>
</td></tr></table>
</td></tr></table>

