<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVASCRIPT_KODU}

<div style="border-left:1px solid #ddd;border-right:1px solid #ddd;margin:10px auto;max-width:520px;background:#fff">
<div class="giris-form-baslik">Yönetim Girişi</div>

<form name="giris" action="giris.php" method="post" onsubmit="return denetle_giris()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="git" value="{PORTALA_GIT}" />


<div class="fieldset" style="margin:15px;padding:15px;">

<div class="phpkf-form-label">
<label class="label">Kullanıcı Adı<br/></label>
<input class="formlar giris-text" type="text" name="kullanici_adi" id="kullanici_adi" value="{KULLANICI_ADI}" size="30" maxlength="20" placeholder="Kullanıcı Adı" required onkeyup="javascript:dogrula_giris(this.name,this.value)" />
</div>

<div class="phpkf-form-label">
<label class="label">Şifre<br/></label>
<input class="formlar giris-text" type="password" name="sifre" id="sifre" size="30" maxlength="20" placeholder="Şifre" required onkeyup="javascript:dogrula_giris(this.name,this.value)" />
</div>

<div class="phpkf-form-label">
<label style="cursor:pointer">
<input type="checkbox" name="hatirla" checked="checked" />&nbsp;Beni hatırla</label>
</div>

</div>


<div class="fieldset" style="margin:15px;padding:15px;">
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi">Giriş Yap</button></div>
</div>


<div class="giris-form-alt">
<a href="../etkinlestir.php">Etkinleştirme Kodu</a> &nbsp;|&nbsp;
<a href="../yeni_sifre.php">Yeni Şifre</a> &nbsp;| &nbsp;
<a href="../kayit.php">Yeni Kayıt</a>
</div>
</form>
</div>



<div style="display: none">
<img width="0" height="0" border="0" src="temalar/varsayilan/resimler/bos.png" alt="boş">
<img width="0" height="0" border="0" src="temalar/varsayilan/resimler/dogru.png" alt="doğru">
<img width="0" height="0" border="0" src="temalar/varsayilan/resimler/yanlis.png" alt="yanlış">
</div>

<script type="text/javascript">
<!-- //
document.giris.kullanici_adi.focus();
setTimeout("dogrula_giris('sifre')",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
//  -->
</script>
