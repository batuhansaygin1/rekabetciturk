<?php
if (!defined('PHPKF_ICINDEN')) exit();

// javascript kodları yükleniyor
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';
$sceditor_dizin = $duzenleyici_dizin.'bilesenler/editor/sceditor';

// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	$duzenleyici_plugin = 'plugins: "xhtml", format: "xhtml",
	style: "https://www.sceditor.com/minified/jquery.sceditor.default.min.css"';

	$duzenleyici_js_ek = '<script type="text/javascript" src="https://www.sceditor.com/minified/jquery.sceditor.xhtml.min.js"></script>';
}

// BBCode için
else
{
	$duzenleyici_plugin = 'plugins: "bbcode", format: "bbcode",
	style: "https://www.sceditor.com/minified/jquery.sceditor.bbcode.min.css"';

	$duzenleyici_js_ek = '<script type="text/javascript" src="https://www.sceditor.com/minified/jquery.sceditor.bbcode.min.js"></script>';
}
?>

<!--  SCEditor - BAŞI  -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php echo $duzenleyici_js_ek; ?>
<script type="text/javascript" src="<?php echo $sceditor_dizin; ?>/languages/tr.js"></script>
<link rel="stylesheet" href="https://www.sceditor.com/minified/themes/default.min.css" type="text/css" media="all" />

<script type="text/javascript">
$(function() {
	// Replace all textarea's
	// with SCEditor
	$("textarea").sceditor({
		width: "626",
		height: "400",
		emoticonsRoot: "https://www.sceditor.com/",
		<?php echo $duzenleyici_plugin; ?>
	});
});


function islem_ifade(deger1,deger2){
	deger2 = " "+deger2+" ";
	$("textarea").sceditor("instance").insert(deger2);
	if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;
	return false;
}
</script>

<!--  SCEditor - SONU   -->

<textarea cols="71" rows="25" id="mesaj_icerik" name="mesaj_icerik">{FORM_ICERIK}</textarea>

<div id="mesaj_icerik_div" style="visibility:hidden;display:none"></div>
