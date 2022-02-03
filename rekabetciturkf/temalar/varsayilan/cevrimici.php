<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="0" cellpadding="0" border="0" align="center" class="genel-tablo" style="width:100%">
    <tr>
    <td class="forum-kategori-alt-baslik" align="center" valign="middle">ÇEVRİMİÇİ KULLANICILAR</td>
    </tr>

    <tr>
    <td height="10"></td>
    </tr>

    <tr>
    <td align="center">

<table width="97%" cellspacing="1" cellpadding="5" border="0" align="center" bgcolor="#d0d0d0">
    <tr class="liste-veri" bgcolor="#f8f8f8">
    <td align="center" colspan="{HUCRE_SAYISI}" height="30">
<font class="kurucu">{KURUCU}</font> - 
<font class="yonetici">{YONETICI}</font> -
<font class="yardimci">{YARDIMCI}</font> -
<font class="blm_yrd">{BLM_YRD}</font>
{GIZLI}
    </td>
    </tr>

    <tr align="center">
    <td width="160" class="forum-kategori-baslik">Kullanıcı Adı</td>
    <td align="center" width="100" class="forum-kategori-baslik mobil-gizle">Son Giriş</td>
    <td align="center" width="100" class="forum-kategori-baslik mobil-gizle">Son Hareketi</td>
    <td align="center" class="forum-kategori-baslik">Bulunduğu Sayfa</td>
<!--__KOSUL_BASLAT-3__-->
    <td align="center" width="110" class="forum-kategori-baslik">IP Adresi</td>
<!--__KOSUL_BITIR-3__-->
    </tr>

    <tr class="liste-veri" bgcolor="#ffffff">
    <td align="center" colspan="{HUCRE_SAYISI}" height="30">
<b> &nbsp; {KULLANICI_SAYI} kayıtlı kullanıcı çevrimiçi {GIZLI_SAYI}</b>
    </td>
    </tr>




<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-1__-->
    <tr class="liste-veri" bgcolor="#ffffff" onmouseover="this.bgColor= '#e0e0e0'" onmouseout="this.bgColor= '#ffffff'">
    <td align="left">&nbsp;{UYE_BAGLANTI}</td>

    <td align="center" class="mobil-gizle">{UYE_SON_GIRIS}</td>

    <td align="center" class="mobil-gizle">{UYE_SON_HAREKET}</td>

    <td align="left">{UYE_SAYFA}</td>
    </tr>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-4__-->
<!--__TEKLI_BASLAT-1__-->
    <tr class="liste-veri" bgcolor="#ffffff" onmouseover="this.bgColor= '#e0e0e0'" onmouseout="this.bgColor= '#ffffff'">
    <td align="left">&nbsp;{UYE_BAGLANTI}</td>

    <td align="center" class="mobil-gizle">{UYE_SON_GIRIS}</td>

    <td align="center" class="mobil-gizle">{UYE_SON_HAREKET}</td>

    <td align="left">{UYE_SAYFA}</td>

    <td align="center">{UYE_IP}</td>
    </tr>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-4__-->




    <tr class="liste-veri" bgcolor="#ffffff">
    <td align="center" colspan="{HUCRE_SAYISI}" height="30">
<b> &nbsp; {MISAFIR SAYI} misafir çevrimiçi</b>
    </td>
    </tr>



<!--__KOSUL_BASLAT-2__-->
<!--__TEKLI_BASLAT-2__-->
    <tr class="liste-veri" bgcolor="#ffffff" onmouseover="this.bgColor= '#e0e0e0'" onmouseout="this.bgColor= '#ffffff'">
    <td align="left">&nbsp;{MISAFIR}</td>

    <td align="center" class="mobil-gizle">{MISAFIR_SON_GIRIS}</td>

    <td align="center" class="mobil-gizle">{MISAFIR_SON_HAREKET}</td>

    <td align="left">{MISAFIR_SAYFA}</td>
    </tr>
<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-5__-->
<!--__TEKLI_BASLAT-2__-->
    <tr class="liste-veri" bgcolor="#ffffff" onmouseover="this.bgColor= '#e0e0e0'" onmouseout="this.bgColor= '#ffffff'">
    <td align="left">&nbsp;{MISAFIR}</td>

    <td align="center" class="mobil-gizle">{MISAFIR_SON_GIRIS}</td>

    <td align="center" class="mobil-gizle">{MISAFIR_SON_HAREKET}</td>

    <td align="left">{MISAFIR_SAYFA}</td>

    <td align="center">{MISAFIR_IP}</td>
    </tr>
<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-5__-->


</table>

{SAYFALAMA}


<p align="left"><span class="liste-veri"><font size="1"> &nbsp;&nbsp;
Buradaki veriler son {ZAMAN_ASIMI} dakika içerisinde etkin olan ziyaretçilere aittir.
<br><br>
</font></span></p>

    </td>
    </tr>
</table>

