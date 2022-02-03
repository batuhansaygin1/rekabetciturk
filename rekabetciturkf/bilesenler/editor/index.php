<?php
if (!defined('PHPKF_ICINDEN')) exit();

// Varsayılan Değerler
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
if (!isset($duzenleyici_bicim)) $duzenleyici_bicim = 'bbcode';
if (!isset($duzenleyici_id)) $duzenleyici_id = 'mesaj_icerik';
$postimage = "window.open('https://postimage.org/mini.php?mode=phpbb&areaid=0&hash=1&lang=turkish&code=hotlink&content=family&forumurl='+escape('$TEMA_SITE_ANADIZIN'),'_imagehost','resizable=yes,width=500,height=400')";


echo '<script type="text/javascript"><!-- //
var duzenleyici_dizin = "'.$duzenleyici_dizin.'";
var duzenleyici_bicim = "'.$duzenleyici_bicim.'";
var duzenleyici_id = "'.$duzenleyici_id.'";
var duzenleyici_katman = "'.$duzenleyici_id.'_div";
//  -->
</script>';


if (!isset($duzenleyici)) $duzenleyici = $ayarlar['duzenleyici'];


// Düz textarea (yorum için)
if ($duzenleyici == 'duz')
{
	include_once($duzenleyici_dizin.'bilesenler/editor/duz/index.php');
}

// phpKF Düzenleyici
elseif ($duzenleyici == 'varsayilan')
{
	include_once($duzenleyici_dizin.'bilesenler/editor/phpkf/index.php');
}

// TinyMCE Düzenleyici
elseif ($duzenleyici == 'tinymce')
{
	include_once($duzenleyici_dizin.'bilesenler/editor/tinymce/index.php');
}

// CKEditor Düzenleyici
elseif ($duzenleyici == 'ckeditor')
{
	include_once($duzenleyici_dizin.'bilesenler/editor/ckeditor/index.php');
}

// SCEditor Düzenleyici
elseif ($duzenleyici == 'sceditor')
{
	include_once($duzenleyici_dizin.'bilesenler/editor/sceditor/index.php');
}

// 3. Parti düzenleyiciler için
else
{
	include_once($duzenleyici_dizin.'eklentiler/'.$duzenleyici.'/editor.php');
}
?>

<div id="dosya_resim_yukleme" style="text-align:center;line-height:20px">
<a href="javascript:void(0);" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir." onclick="document.form1.bbcode_kullan.checked=true; <?php echo $postimage; ?>; return false;">Resim Ekle</a>&nbsp; - &nbsp; 
<a href="javascript:void(0);" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir." onclick="YuklemeAc('<?php echo $duzenleyici_dizin; ?>')">Dosya Ekle</a>
</div>

<div id="yukleme_pencere" class="yukleme" style="position:fixed;top:0;left:0;bottom:0;right:0;display:none;z-index:1001;margin:auto;width:100%;height:100%;overflow:auto;background-color:rgba(0,0,0,0.7);">
<iframe src="about:blank" id="dyukle" width="470" height="304" style="position:absolute;top:0;left:0;bottom:0;right:0;margin:auto;width:470px;height:304px;overflow:auto;border-radius:7px;border:3px solid #333333;background:#fefefe;"></iframe>
</div>
