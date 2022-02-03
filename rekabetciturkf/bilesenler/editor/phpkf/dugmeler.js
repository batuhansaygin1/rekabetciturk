<!-- //
/*
 +===========================================================+
 |                  php Kolay Forum (phpKF)                  |
 +===========================================================+
 |                                                           |
 |            Telif - Copyright (c) 2007 - 2018              |
 |       http://www.phpkf.com   -   phpkf @ phpkf.com        |
 |        Tüm hakları saklıdır - All Rights Reserved         |
 |              http://www.phpkf.com/telif.php               |
 |                                                           |
 +===========================================================+*/

var liste_tablosu = '<table cellspacing="0" cellpadding="3" border="0" class="yazibicimi_tablosu" id="'+duzenleyici_id+'_liste_tablosu">\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'liste\',\'disc\')">&#9899;&nbsp; '+phpkfl["daire"]+'</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'liste\',\'1\')">&nbsp;1&nbsp; '+phpkfl["rakam"]+'</a></td></tr></table>';


var baslik_tablosu = '<table cellspacing="0" cellpadding="3" border="0" class="yazibicimi_tablosu" id="'+duzenleyici_id+'_baslik_tablosu">\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'baslik\',\'1\')">H1 '+phpkfl["hbaslik"]+'</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'baslik\',\'2\')">H2 '+phpkfl["hbaslik"]+'</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'baslik\',\'3\')">H3 '+phpkfl["hbaslik"]+'</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'baslik\',\'4\')">H4 '+phpkfl["hbaslik"]+'</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'baslik\',\'5\')">H5 '+phpkfl["hbaslik"]+'</a></td></tr></table>';


var yaziboyutu_tablosu = '<table cellspacing="0" cellpadding="3" border="0" class="yazibicimi_tablosu" id="'+duzenleyici_id+'_yaziboyutu_tablosu">\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'1\')">'+phpkfl["boyut"]+' 1</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'2\')">'+phpkfl["boyut"]+' 2</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'3\')">'+phpkfl["boyut"]+' 3</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'4\')">'+phpkfl["boyut"]+' 4</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'5\')">'+phpkfl["boyut"]+' 5</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'6\')">'+phpkfl["boyut"]+' 6</a></td></tr>\
<tr><td><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_boyutu\',\'7\')">'+phpkfl["boyut"]+' 7</a></td></tr></table>';


var yazitipi_tablosu = '<table cellspacing="0" cellpadding="3" border="0" class="yazibicimi_tablosu" id="'+duzenleyici_id+'_yazitipi_tablosu">\
<tr><td style="font-family: arial"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'arial\')">Arial</a></td></tr>\
<tr><td style="font-family: arial black"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'arial black\')">Arial Black</a></td></tr>\
<tr><td style="font-family: comic sans ms"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'comic sans ms\')">Comic Sans MS</a></td></tr>\
<tr><td style="font-family: courier new"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'courier new\')">Courier New</a></td></tr>\
<tr><td style="font-family: georgia"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'georgia\')">Georgia</a></td></tr>\
<tr><td style="font-family: helvetica"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'helvetica\')">Helvetica</a></td></tr>\
<tr><td style="font-family: impact"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'impact\')">Impact</a></td></tr>\
<tr><td style="font-family: sans-serif"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'sans-serif\')">Sans-Serif</a></td></tr>\
<tr><td style="font-family: tahoma"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'tahoma\')">Tahoma</a></td></tr>\
<tr><td style="font-family: times new roman"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'times new roman\')">Times New Roman</a></td></tr>\
<tr><td style="font-family: verdana"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_tipi\',\'verdana\')">Verdana</a></td></tr>\
</table>';


var renk_tablosu = '<table cellspacing="4" cellpadding="1" border="0" class="renk_tablosu" id="'+duzenleyici_id+'_renk_tablosu"><tr>\
<td style="background: #000000"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#000000\')">&nbsp;</a></td>\
<td style="background: #000080"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#000080\')">&nbsp;</a></td>\
<td style="background: #333399"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#333399\')">&nbsp;</a></td>\
<td style="background: #0000ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#0000ff\')">&nbsp;</a></td>\
<td style="background: #3366ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#3366ff\')">&nbsp;</a></td>\
<td style="background: #00ccff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#00ccff\')">&nbsp;</a></td></tr><tr>\
<td style="background: #800000"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#800000\')">&nbsp;</a></td>\
<td style="background: #993366"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#993366\')">&nbsp;</a></td>\
<td style="background: #ff0000"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff0000\')">&nbsp;</a></td>\
<td style="background: #ff6600"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff6600\')">&nbsp;</a></td>\
<td style="background: #ff9900"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff9900\')">&nbsp;</a></td>\
<td style="background: #ffff00"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ffff00\')">&nbsp;</a></td></tr><tr>\
<td style="background: #004400"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#004400\')">&nbsp;</a></td>\
<td style="background: #808000"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#808000\')">&nbsp;</a></td>\
<td style="background: #008000"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#008000\')">&nbsp;</a></td>\
<td style="background: #339966"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#339966\')">&nbsp;</a></td>\
<td style="background: #99cc00"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#99cc00\')">&nbsp;</a></td>\
<td style="background: #00ff00"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#00ff00\')">&nbsp;</a></td></tr><tr>\
<td style="background: #800080"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#800080\')">&nbsp;</a></td>\
<td style="background: #cc00ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#cc00ff\')">&nbsp;</a></td>\
<td style="background: #ff00ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff00ff\')">&nbsp;</a></td>\
<td style="background: #ff66ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff66ff\')">&nbsp;</a></td>\
<td style="background: #ff99cc"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ff99cc\')">&nbsp;</a></td>\
<td style="background: #cc99ff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#cc99ff\')">&nbsp;</a></td></tr><tr>\
<td style="background: #555555"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#555555\')">&nbsp;</a></td>\
<td style="background: #777777"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#777777\')">&nbsp;</a></td>\
<td style="background: #999999"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#999999\')">&nbsp;</a></td>\
<td style="background: #bbbbbb"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#bbbbbb\')">&nbsp;</a></td>\
<td style="background: #dddddd"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#dddddd\')">&nbsp;</a></td>\
<td style="background: #ffffff"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'yazi_rengi\',\'#ffffff\')">&nbsp;</a></td></tr></table>';



var artalan_tablosu = '<table cellspacing="4" cellpadding="1" border="0" class="renk_tablosu" id="'+duzenleyici_id+'_artalan_tablosu"><tr>\
<td style="background: black"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'black\')">&nbsp;</a></td>\
<td style="background: DarkBlue"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkBlue\')">&nbsp;</a></td>\
<td style="background: DarkSlateBlue"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkSlateBlue\')">&nbsp;</a></td>\
<td style="background: blue"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'blue\')">&nbsp;</a></td>\
<td style="background: DodgerBlue"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DodgerBlue\')">&nbsp;</a></td>\
<td style="background: DeepSkyBlue"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DeepSkyBlue\')">&nbsp;</a></td></tr><tr>\
<td style="background: maroon"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'maroon\')">&nbsp;</a></td>\
<td style="background: DarkMagenta"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkMagenta\')">&nbsp;</a></td>\
<td style="background: red"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'red\')">&nbsp;</a></td>\
<td style="background: OrangeRed"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'OrangeRed\')">&nbsp;</a></td>\
<td style="background: orange"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'orange\')">&nbsp;</a></td>\
<td style="background: yellow"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'yellow\')">&nbsp;</a></td></tr><tr>\
<td style="background: DarkGreen"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkGreen\')">&nbsp;</a></td>\
<td style="background: olive"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'olive\')">&nbsp;</a></td>\
<td style="background: ForestGreen"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'ForestGreen\')">&nbsp;</a></td>\
<td style="background: SeaGreen"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'SeaGreen\')">&nbsp;</a></td>\
<td style="background: YellowGreen"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'YellowGreen\')">&nbsp;</a></td>\
<td style="background: green"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'green\')">&nbsp;</a></td></tr><tr>\
<td style="background: DarkMagenta"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkMagenta\')">&nbsp;</a></td>\
<td style="background: DarkOrchid"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DarkOrchid\')">&nbsp;</a></td>\
<td style="background: magenta"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'magenta\')">&nbsp;</a></td>\
<td style="background: violet"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'violet\')">&nbsp;</a></td>\
<td style="background: pink"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'pink\')">&nbsp;</a></td>\
<td style="background: orchid"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'orchid\')">&nbsp;</a></td></tr><tr>\
<td style="background: DimGray"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'DimGray\')">&nbsp;</a></td>\
<td style="background: gray"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'gray\')">&nbsp;</a></td>\
<td style="background: darkgray"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'darkgray\')">&nbsp;</a></td>\
<td style="background: silver"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'silver\')">&nbsp;</a></td>\
<td style="background: LightGray"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'LightGray\')">&nbsp;</a></td>\
<td style="background: white"><a href="javascript:void(0)" onclick="islem(\''+duzenleyici_id+'\',\'artalan_rengi\',\'white\')">&nbsp;</a></td></tr></table>';




var simge_dizin = duzenleyici_dizin+'phpkf-bilesenler/editor/phpkf/dugmeler/';

var phpkf_dugmeler = [];

phpkf_dugmeler['kalin'] = {
id : 'kalin',
simge : 'class="fa fa-bold"',
aciklama : phpkfl["kalin"],
islem : "islem('"+duzenleyici_id+"', 'kalin', '')",
ek : '',
};

phpkf_dugmeler['alticizgili'] = {
id : 'alticizgili',
simge : 'class="fa fa-underline"',
aciklama : phpkfl["alticizgili"],
islem : "islem('"+duzenleyici_id+"', 'altcizgili', '')",
ek : '',
};

phpkf_dugmeler['yatik'] = {
id : 'yatik',
simge : 'class="fa fa-italic"',
aciklama : phpkfl["yatik"],
islem : "islem('"+duzenleyici_id+"', 'yatik', '')",
ek : '',
};

phpkf_dugmeler['ustucizgili'] = {
id : 'ustucizgili',
simge : 'class="fa fa-strikethrough"',
aciklama : phpkfl["ustucizgili"],
islem : "islem('"+duzenleyici_id+"', 'ustucizgili', '')",
ek : '',
};

phpkf_dugmeler['altsimge'] = {
id : 'altsimge',
simge : 'class="fa fa-subscript"',
aciklama : phpkfl["altsimge"],
islem : "islem('"+duzenleyici_id+"', 'altsimge', '')",
ek : '',
};

phpkf_dugmeler['ustsimge'] = {
id : 'ustsimge',
simge : 'class="fa fa-superscript"',
aciklama : phpkfl["ustsimge"],
islem : "islem('"+duzenleyici_id+"', 'ustsimge', '')",
ek : '',
};

phpkf_dugmeler['baslik'] = {
id : 'baslik',
simge : 'class="fa fa-header"',
aciklama : phpkfl["baslik"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_baslik_tablosu')",
ek : baslik_tablosu,
};

phpkf_dugmeler['boyut'] = {
id : 'boyut',
simge : 'class="fa fa-text-height"',
aciklama : phpkfl["boyut"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_yaziboyutu_tablosu')",
ek : yaziboyutu_tablosu,
};

phpkf_dugmeler['tip'] = {
id : 'tip',
simge : 'class="fa fa-font"',
aciklama : phpkfl["tip"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_yazitipi_tablosu')",
ek : yazitipi_tablosu,
};

phpkf_dugmeler['renk'] = {
id : 'renk',
simge : 'class="fa fa-font renk"',
aciklama : phpkfl["renk"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_renk_tablosu')",
ek : renk_tablosu,
};

phpkf_dugmeler['artalan'] = {
id : 'artalan',
simge : 'class="fa fa-font artalan"',
aciklama : phpkfl["artalan"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_artalan_tablosu')",
ek : artalan_tablosu,
};

phpkf_dugmeler['kaldir'] = {
id : 'kaldir',
simge : 'class="fa fa-eraser"',
aciklama : phpkfl["kaldir"],
islem : "islem('"+duzenleyici_id+"', 'kaldir', '')",
ek : '',
};

phpkf_dugmeler['sol'] = {
id : 'sol',
simge : 'class="fa fa-align-left"',
aciklama : phpkfl["sol"],
islem : "islem('"+duzenleyici_id+"', 'sola', '')",
ek : '',
};

phpkf_dugmeler['orta'] = {
id : 'orta',
simge : 'class="fa fa-align-center"',
aciklama : phpkfl["orta"],
islem : "islem('"+duzenleyici_id+"', 'ortala', '')",
ek : '',
};

phpkf_dugmeler['sag'] = {
id : 'sag',
simge : 'class="fa fa-align-right"',
aciklama : phpkfl["sag"],
islem : "islem('"+duzenleyici_id+"', 'saga', '')",
ek : '',
};

phpkf_dugmeler['ikiyana'] = {
id : 'ikiyana',
simge : 'class="fa fa-align-justify"',
aciklama : phpkfl["ikiyana"],
islem : "islem('"+duzenleyici_id+"', 'ikiyana', '')",
ek : '',
};

phpkf_dugmeler['girintieksi'] = {
id : 'girintieksi',
simge : 'class="fa fa-outdent"',
aciklama : phpkfl["girintieksi"],
islem : "islem('"+duzenleyici_id+"', 'girintieksi', '')",
ek : '',
};

phpkf_dugmeler['girintiarti'] = {
id : 'girintiarti',
simge : 'class="fa fa-indent"',
aciklama : phpkfl["girintiarti"],
islem : "islem('"+duzenleyici_id+"', 'girintiarti', '')",
ek : '',
};

phpkf_dugmeler['yataycizgi'] = {
id : 'yataycizgi',
simge : 'class="fa fa-arrows-h"',
aciklama : phpkfl["yataycizgi"],
islem : "islem('"+duzenleyici_id+"', 'yataycizgi', '');",
ek : '',
};

phpkf_dugmeler['liste'] = {
id : 'liste',
simge : 'class="fa fa-list-ol"',
aciklama : phpkfl["liste"],
islem : "olay_yuzen_tablo('"+duzenleyici_id+"_liste_tablosu')",
ek : liste_tablosu,
};

phpkf_dugmeler['tablo'] = {
id : 'tablo',
simge : 'class="fa fa-table"',
aciklama : phpkfl["tablo"],
islem : "islem('"+duzenleyici_id+"', 'tablo', '')",
ek : '',
};

phpkf_dugmeler['adres'] = {
id : 'adres',
simge : 'class="fa fa-link"',
aciklama : phpkfl["adres"],
islem : "islem('"+duzenleyici_id+"', 'baglanti', prompt('"+phpkfl["adres_yaziniz"]+"', 'http://'))",
ek : '',
};

phpkf_dugmeler['adresk'] = {
id : 'adresk',
simge : 'class="fa fa-unlink"',
aciklama : phpkfl["adresk"],
islem : "islem('"+duzenleyici_id+"', 'baglantik', '')",
ek : '',
};

phpkf_dugmeler['resim'] = {
id : 'resim',
simge : 'class="fa fa-picture-o"',
aciklama : phpkfl["resim"],
islem : "islem('"+duzenleyici_id+"', 'resim', prompt('"+phpkfl["adres_yaziniz"]+"', 'http://'))",
ek : '',
};

phpkf_dugmeler['eposta'] = {
id : 'eposta',
simge : 'class="fa fa-envelope-o"',
aciklama : phpkfl["eposta"],
islem : "islem('"+duzenleyici_id+"', 'eposta', prompt('"+phpkfl["adres_yaziniz"]+"', 'aaa@bbb.com'))",
ek : '',
};

phpkf_dugmeler['alinti'] = {
id : 'alinti',
simge : 'class="fa fa-quote-left"',
aciklama : phpkfl["alinti"],
islem : "islem('"+duzenleyici_id+"', 'alinti', '')",
ek : '',
};

phpkf_dugmeler['kod'] = {
id : 'kod',
simge : 'class="fa fa-code"',
aciklama : phpkfl["kod"],
islem : "islem('"+duzenleyici_id+"', 'kod_alani', '')",
ek : '',
};

phpkf_dugmeler['tarih'] = {
id : 'tarih',
simge : 'class="fa fa-calendar"',
aciklama : phpkfl["tarih"],
islem : "islem('"+duzenleyici_id+"', 'tarih', '')",
ek : '',
};

phpkf_dugmeler['devam'] = {
id : 'devam',
simge : 'class="fa fa-forward"',
aciklama : phpkfl["devam"],
islem : "islem('"+duzenleyici_id+"', 'devam', '')",
ek : '',
};

phpkf_dugmeler['youtube'] = {
id : 'youtube',
simge : 'class="fa fa-youtube-play"',
aciklama : phpkfl["youtube"],
islem : "islem('"+duzenleyici_id+"', 'youtube', prompt('"+phpkfl["adres_yaziniz"]+"', 'http://'))",
ek : '',
};

phpkf_dugmeler['video'] = {
id : 'video',
simge : 'class="fa fa-film"',
aciklama : phpkfl["video"],
islem : "islem('"+duzenleyici_id+"', 'video', prompt('"+phpkfl["adres_yaziniz"]+"', 'http://'))",
ek : '',
};

phpkf_dugmeler['audio'] = {
id : 'audio',
simge : 'class="fa fa-volume-up"',
aciklama : phpkfl["audio"],
islem : "islem('"+duzenleyici_id+"', 'audio', prompt('"+phpkfl["adres_yaziniz"]+"', 'http://'))",
ek : '',
};

phpkf_dugmeler['postimage'] = {
id : 'ryukle',
simge : 'class="fa fa-file-image-o"',
aciklama : phpkfl["ryukle"],
islem : "islem('"+duzenleyici_id+"', 'postimage', '')",
ek : '',
};

phpkf_dugmeler['yukleme'] = {
id : 'dyukle',
simge : 'class="fa fa-cloud-upload"',
aciklama : phpkfl["dyukle"],
islem : "islem('"+duzenleyici_id+"', 'dyukle', '')",
ek : '',
};

phpkf_dugmeler['geri'] = {
id : 'geri',
simge : 'class="fa fa-reply"',
aciklama : phpkfl["geri"],
islem : "islem('"+duzenleyici_id+"', 'geri', '')",
ek : '',
};

phpkf_dugmeler['ileri'] = {
id : 'ileri',
simge : 'class="fa fa-share"',
aciklama : phpkfl["ileri"],
islem : "islem('"+duzenleyici_id+"', 'ileri', '')",
ek : '',
};

//  -->