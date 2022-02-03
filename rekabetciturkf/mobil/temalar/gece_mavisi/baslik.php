<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<title>{SAYFA_BASLIK}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo $meta_etiketler; ?>
<link rel="canonical" href="<?php echo $meta_canonical; ?>" />
<link href="{DIZIN}mobil/temalar/gece_mavisi/resimler/favicon.png" rel="icon" type="image/png" />
<link type="text/css" rel="stylesheet" href="{DIZIN}mobil/temalar/gece_mavisi/sablon.css" />
<script type="text/javascript" src="{DIZIN}bilesenler/js/phpkf-jsk.js"></script>
<script type="text/javascript" src="{DIZIN}bilesenler/js/islemler.js"></script>
<script type="text/javascript" src="{DIZIN}mobil/mbetik.js"></script>
</head>
<body>
<div class="mobilHeader">
<div class="headerIcerik">


<!--__KOSUL_BASLAT-1__-->

<a class="menuLink" href="javascript:void(0);" onclick="gosterGizle('solMenu','uyeAlani');"><span class="label">Menü</span></a>
<a class="kullaniciLink" href="javascript:void(0);" onclick="gosterGizle('uyeAlani','solMenu');"><span class="label">Üye Giriş</span></a>
<a class="logo" title="Mobil Ana Sayfa" href="{DIZIN}mobil/index.php"><h1 class="label"></h1></a>
</div>
</div>
<div class="solMenu" id="solMenu">
<ul>
<li><a href="{DIZIN}{FORUM_INDEX}">Forum</a></li>
<?php if ($portal_kullan == 1): ?>
<li><a href="{DIZIN}{PORTAL_INDEX}">Portal</a></li>
<?php endif; ?>
<li><a href="{DIZIN}uyeler.php">Üyeler</a></li>
</ul></div>
<div class="uyeAlani clearfix" id="uyeAlani">
<form class="girisFormu" action="{DIZIN}giris.php" name="giris" method="post" onsubmit="return denetle_giris()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="text" name="kullanici_adi" class="giris-input" placeholder="Kullanıcı Adı" required />
<input type="password" name="sifre" class="giris-input" placeholder="Şifre" required />
<input type="submit" value="Giriş" class="giris-dugme" />
<p class="giris-diger" align="left"><label style="cursor: pointer;"><input type="checkbox" checked="checked" name="hatirla" class="hatirlaDugme" />&nbsp;Beni Hatırla</label></p>
<p class="giris-diger" style="margin-top:5px;">
<a href="{DIZIN}yeni_sifre.php">Şifre Sıfırla</a> &middot; <a href="{DIZIN}kayit.php">Kayıt Ol</a></p>
</form>
</div>
<div class="forumKutu clearfix">

<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-2__-->

<a class="menuLink" href="javascript:void(0)" onclick="gosterGizle('solMenu','OzelMenu','Bildirimler');"><span class="label">Menü</span></a>
<a class="bildirimLink" href="javascript:void(0)" onClick="gosterGizle('Bildirimler','OzelMenu','solMenu')">{OKUNMAMIS_OI1}</a>
<a class="uyeAyarLink" href="javascript:void(0)" onclick="gosterGizle('OzelMenu','solMenu','Bildirimler');"><span class="label">{KULLANICI_ADI}</span></a>
<a class="logo" title="Mobil Ana Sayfa" href="{DIZIN}mobil/index.php"><h1 class="label"></h1></a>
</div>
</div>
<div class="solMenu" id="solMenu">
<ul>
<li><a href="{DIZIN}{FORUM_INDEX}">Forum</a></li>
<?php if ($portal_kullan == 1): ?>
<li><a href="{DIZIN}{PORTAL_INDEX}">Portal</a></li>
<?php endif; ?>
<li><a href="{DIZIN}uyeler.php">Üyeler</a></li>
<li><a href="{DIZIN}mobil/arama.php">Arama</a></li>
<li><a href="{DIZIN}ymesaj.php">Yeni iletiler</a></li>

<!--__KOSUL_BASLAT-3__-->
<li><a href="{DIZIN}yonetim/index.php">Yönetim Masası</a></li>
<!--__KOSUL_BITIR-3__-->

</ul>
</div>
<div class="Bildirimler" id="Bildirimler">
<ul>{OKUNMAMIS_OI3}</ul>
</div>
<div class="solMenu" id="OzelMenu">
<ul>
<li><a href="{DIZIN}mobil/ozel_ileti.php">Özel ileti{OKUNMAMIS_OI2}</a></li>
<li><a href="{DIZIN}profil.php">Profil Bilgilerim</a></li>
<li><a href="{DIZIN}cikis.php?o={O}" onclick="return window.confirm('Çıkış yapmak istediğinize emin misiniz?')" title="Çıkış Yap">Çıkış Yap</a></li>
</ul>
</div>
<div class="forumKutu clearfix">

<!--__KOSUL_BITIR-2__-->

<script type="text/javascript"><!--//
var mobil_dizin = "{DIZIN}";
// --></script>