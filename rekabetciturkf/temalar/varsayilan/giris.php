<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="genel-tablo" style="max-width:520px">
<div class="giris-form-baslik"><?php echo $l['kullanici_giris']; ?></div>

<form name="giris" action="giris.php" method="post" onsubmit="return denetle()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="git" value="<?php echo $gelinen_adres; ?>" />


<div class="fieldset" style="margin:15px;padding:15px;">

<div class="phpkf-form-label">
<label class="label"><?php echo $l['kullanici_adi']; ?><br/></label>
<input class="formlar giris-text" type="text" name="kullanici_adi" id="kullanici_adi" size="30" maxlength="20" placeholder="<?php echo $l['kullanici_adi']; ?>" onkeyup="javascript:dogrula_giris(this.name,this.value)" required />
</div>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['sifre']; ?><br/></label>
<input class="formlar giris-text" type="password" name="sifre" id="sifre" size="30" maxlength="20" placeholder="<?php echo $l['sifre']; ?>" onkeyup="javascript:dogrula_giris(this.name,this.value)" required />
</div>

<div class="phpkf-form-label">
<label style="cursor:pointer">
<input type="checkbox" name="hatirla" checked="checked" />&nbsp;<?php echo $l['beni_hatirla']; ?></label>
</div>

</div>


<div class="fieldset" style="margin:15px;padding:15px;">
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi">&nbsp;<?php echo $l['giris_yap']; ?>&nbsp;</button></div>
</div>

<?php echo $ek_girisler; ?>

<div class="giris-form-alt">
<a href="etkinlestir.php"><?php echo $l['etkinlestirme_kodu']; ?></a> &nbsp;|&nbsp;
<a href="yeni_sifre.php"><?php echo $l['yeni_sifre']; ?></a> &nbsp;| &nbsp;
<a href="<?php echo $dosya_kayit; ?>"><?php echo $l['yeni_kayit']; ?></a>
</div>
</form>
</div>


<div style="display:none">
<img width="0" height="0" alt="." src="temalar/varsayilan/resimler/bos.png" />
<img width="0" height="0" alt="." src="temalar/varsayilan/resimler/dogru.png" />
<img width="0" height="0" alt="." src="temalar/varsayilan/resimler/yanlis.png" />
</div>

<script type="text/javascript"><!-- //
document.giris.kullanici_adi.focus();
setTimeout("dogrula_giris('sifre')",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
//  -->
</script>
