<?php
if (!defined('PHPKF_ICINDEN')) exit();

// ifade javascript kodları yükleniyor
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';

// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
$duzenleyici_plugin = '';

// BBCode için
else $duzenleyici_plugin = "extraPlugins: 'bbcode',";
?>


<!--  CKEditor - BAŞI  -->

<script src="https://cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>

<textarea cols="71" rows="25" id="mesaj_icerik" name="mesaj_icerik">{FORM_ICERIK}</textarea>

<script type="text/javascript"><!-- //
CKEDITOR.replace(
	'mesaj_icerik',
	{
		<?php echo $duzenleyici_plugin; ?>
		width:'',
		height:'350px',
	}
);

function islem_ifade(deger1,deger2){
	deger2 = "&nbsp;"+deger2+"&nbsp;";
	var oEditor = CKEDITOR.instances.mesaj_icerik;
	oEditor.insertHtml(deger2);
	if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;
	return false;
}
// -->
</script>

<!--  CKEditor - SONU  -->