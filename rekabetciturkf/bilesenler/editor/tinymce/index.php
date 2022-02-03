<?php
if (!defined('PHPKF_ICINDEN')) exit();

// ifade javascript kodları yükleniyor
if (!isset($duzenleyici_dizin)) $duzenleyici_dizin = '';
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';

// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	$duzenleyici_bicim = 'html';
	$duzenleyici_plugin = '';
}

// BBCode için
else
{
	$duzenleyici_bicim = 'bbcode';
	$duzenleyici_plugin = 'bbcode';
}
?>

<!--  TinyMCE - BAŞI  -->

<script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
<!-- //
var tinymce_dizin = "<?php echo $duzenleyici_dizin; ?>bilesenler/editor/tinymce";

tinyMCE.init({
// Genel Ayarlar
language_url: tinymce_dizin + "/langs/tr_TR.js",
toolbar2: "fontselect | fontsizeselect",
selector: "textarea",
theme: "modern",
entity_encoding: "raw",
element_format: "<?php echo $duzenleyici_bicim; ?>",
remove_linebreaks: false,
force_br_newlines: true,
force_p_newlines: false,
forced_root_block: false,
image_advtab: true,
preformatted: true,
resize: "both",
height: "350",
relative_urls: false,
remove_script_host: false,
convert_urls: true,

// Düğmeler
toolbar1: "undo redo | bold italic underline | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | removeformat link image dosyayukle | bullist numlist outdent indent alintiekle | preview code fullscreen help",


// Eklentiler
plugins: [
"<?php echo $duzenleyici_plugin; ?> advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker help",
"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
"save table contextmenu directionality emoticons template paste textcolor"],

// Dahili Fonksiyonlar
setup: function(ed) {
ed.addButton("alintiekle", {
title: "Alıntı Ekle",
icon: "blockquote",
onclick: function() {
ed.focus();
ed.selection.setContent("[quote]" + ed.selection.getContent() + "[/quote]");}
});
ed.addButton("dosyayukle",{
title: "Dosya Yükle",
image:  tinymce_dizin + "/dyukle.png",
onclick: function() {
ed.focus();
YuklemeAc("<?php echo $duzenleyici_dizin; ?>");}
});
},


// Biçimler Menüsü
style_formats: [
{title: "Headers", items: [
{title: "Header 1", format: "h1"},
{title: "Header 2", format: "h2"},
{title: "Header 3", format: "h3"},
{title: "Header 4", format: "h4"},
{title: "Header 5", format: "h5"}]},

{title: "Inline", items: [
{title: "Bold", icon: "bold", format: "bold"},
{title: "Italic", icon: "italic", format: "italic"},
{title: "Underline", icon: "underline", format: "underline"},
{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
{title: "Superscript", icon: "superscript", format: "superscript"},
{title: "Subscript", icon: "subscript", format: "subscript"},
{title: "Code", icon: "code", format: "code"}]},

{title: "Blocks", items: [
{title: "Paragraph", format: "p"},
{title: "Blockquote", format: "blockquote"},
{title: "Div", format: "div"},
{title: "Pre", format: "pre"}]},

{title: "Alignment", items: [
{title: "Left", icon: "alignleft", format: "alignleft"},
{title: "Center", icon: "aligncenter", format: "aligncenter"},
{title: "Right", icon: "alignright", format: "alignright"},
{title: "Justify", icon: "alignjustify", format: "alignjustify"},
{title: "Image Left", selector: 'img',styles: {'float': 'left', 'margin': '0 10px 0 0'}},
{title: 'Image Right', selector: 'img', styles: {'float': 'right', 'margin': '0 0 0 10px'}}]},],


// Başlık ve Paragraf
block_formats: "Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3;Header 4=h4;Header 5=h5",

});

function islem_ifade(deger1,deger2){
	deger2 = "&nbsp;"+deger2+"&nbsp;";
	tinyMCE.activeEditor.selection.setContent(deger2);
	if(document.form1.ifade.checked==false)document.form1.ifade.checked=true;
	return false;
}

// -->
</script>

<!--  TinyMCE - SONU  -->

<textarea cols="71" rows="25" id="mesaj_icerik" name="mesaj_icerik">{FORM_ICERIK}</textarea>
