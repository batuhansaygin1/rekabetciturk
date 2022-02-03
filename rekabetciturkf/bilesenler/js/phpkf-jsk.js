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

!function(){function e(e,t,i,n){return t?(t.removeEventListener?t.removeEventListener(i,n,!1):t.detachEvent&&t.detachEvent(e+i,n),this):this}function t(e,t,i,n,r){if(!t)return this;if("undefined"!=typeof r)var l=function(e){for(var t=e||window.event,i=t.target||t.srcElement,l=(i.phpKFdoc||i.ownerDocument).querySelectorAll(r),s=0;s<l.length;s++)l.item(s)===i&&n.call(e,l.item(s),i,r)};else var l=n;return t.addEventListener?t.addEventListener(i,l,!1):t.attachEvent&&t.attachEvent(e+i,l),this}function i(e){var t=e.length,i=d.veriTipi(e);return"function"===i||d.windowMu(e)?!1:1===e.nodeType&&t?!0:"array"===i||0===t||"number"==typeof t&&t>0&&t-1 in e}var n=window,r=this,l={},s=window,o=document,a=[],u=!1,c=!0,h="string",f="object",d=function(e){return new d.veriler.kfSecici(e)},v=function(e,t){return typeof e===t};d.sonArgumanCagir=function(e,t){var i=e[e.length-1];return d.FonksiyonMu(i)?(t&&i(),i):void 0},d.genislet=function(e,t){for(var i in t)void 0!==t[i]&&(e[i]=t[i]);return e},d.FonksiyonMu=function(e){return"function"===d.veriTipi(e)},d.diziMi=Array.isArray||function(e){return"array"===d.veriTipi(e)},d.windowMu=function(e){return null!=e&&e==e.window},d.numerikMi=function(e){return!d.diziMi(e)&&e-parseFloat(e)>=0},d.objeVarmi=function(e){var t;for(t in e)return!1;return!0},d.veriTipi=function(e){var t="";return null==e?e+"":"object"==typeof e||"function"==typeof e?t[Object.prototype.toString.call(e)]||"object":typeof e},d.negatifSayi=function(e){return e>=0?"arti":"eksi"},Object.keys||(Object.keys=function(){var e=Object.prototype.hasOwnProperty,t=!{toString:null}.propertyIsEnumerable("toString"),i=["toString","toLocaleString","valueOf","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","constructor"],n=i.length;return function(r){if("object"!=typeof r&&("function"!=typeof r||null===r))throw new TypeError("Object.keys nesnesi çağırıldı, ancak bir sorun oluştu...");var l,s,o=[];for(l in r)e.call(r,l)&&o.push(l);if(t)for(s=0;n>s;s++)e.call(r,i[s])&&o.push(i[s]);return o}}()),d.dur=function(e){e&&e.preventDefault?e.preventDefault():window.event&&window.event.returnValue&&(window.eventReturnValue=!1)};var g=function(e){function t(){i||(i=!0,e())}var i=!1;if(o.addEventListener)o.addEventListener("DOMContentLoaded",t,!1);else if(o.attachEvent){try{var n=null!=window.frameElement}catch(r){}if(o.documentElement.doScroll&&!n){var l=function(){if(!i)try{o.documentElement.doScroll("left"),t()}catch(e){setTimeout(l,10)}};l()}o.attachEvent("onreadystatechange",function(){"complete"===o.readyState&&t()})}if(window.addEventListener)window.addEventListener("load",t,!1);else if(window.attachEvent)window.attachEvent("onload",t);else{var s=window.onload;window.onload=function(){s&&s(),t()}}};d.sayfaYuklendi=function(e){function t(){for(var e=0;e<a.length;e++)a[e]()}a.length||g(t),a.push(e)};var p=function(e,t,i,r,l){if(r.childNodes)"setProperty"==l?r.style.setProperty(t,i):"removeProperty"==l?r.style.removeProperty(t):"setAttribute"==l?r.setAttribute(t,i):"removeAttribute"==l&&r.removeAttribute(t);else{var o,a=Array.prototype.map.call(r,function(e){return e.style}),u=[];u[0]=s.Element.prototype.setAttribute,u[1]=s.Element.prototype.removeAttribute,u[2]=s.CSSStyleDeclaration.prototype.setProperty,u[3]=s.CSSStyleDeclaration.prototype.removeProperty,"setAttribute"==l?o=0:"removeAttribute"==l?o=1:"setProperty"==l?o=2:"removeProperty"==l&&(o=3);var c=Boolean(i),h=u[o],f=Array.prototype.slice.call(arguments,1,c?3:2),d=e?a:r;c&&e&&f.push("");for(var v=0;v<r.length;v++)h.apply(d[v],f)}return n.follow=p,this};d.rgbCevir=function(e){if("#"===e.substr(0,1))return e;var t=/(.*?)rgb\((\d+),\s*(\d+),\s*(\d+)\)/i.exec(e),i=parseInt(t[2],10).toString(16),n=parseInt(t[3],10).toString(16),r=parseInt(t[4],10).toString(16);return"#"+((1==i.length?"0"+i:i)+(1==n.length?"0"+n:n)+(1==r.length?"0"+r:r))};var m=function(e){var t=e.primitiveType;if(t==CSSPrimitiveValue.CSS_NUMBER)return e.getFloatValue(CSSPrimitiveValue.CSS_NUMBER);if(t==CSSPrimitiveValue.CSS_PERCENTAGE)return e.getFloatValue(CSSPrimitiveValue.CSS_PERCENTAGE)+"%";if(CSSPrimitiveValue.CSS_EMS<=t&&t<=CSSPrimitiveValue.CSS_DIMENSION)return e.getFloatValue(CSSPrimitiveValue.CSS_PX)+"px";if(CSSPrimitiveValue.CSS_STRING<=t&&t<=CSSPrimitiveValue.CSS_ATTR)return e.getStringValue();if(t==CSSPrimitiveValue.CSS_COUNTER){var i=e.getCounterValue();return"(identifier: "+i.identifier+", listStyle: "+i.listStyle+", separator: "+i.separator+")"}if(t==CSSPrimitiveValue.CSS_RECT){var n=e.getRectValue(),r=n.top.getFloatValue(CSSPrimitiveValue.CSS_PX),l=n.right.getFloatValue(CSSPrimitiveValue.CSS_PX),s=n.bottom.getFloatValue(CSSPrimitiveValue.CSS_PX),o=n.left.getFloatValue(CSSPrimitiveValue.CSS_PX);return"rect("+r+"px, "+l+"px, "+s+"px, "+o+"px)"}if(t==CSSPrimitiveValue.CSS_RGBCOLOR){var a=e.getRGBColorValue(),u=a.red.getFloatValue(CSSPrimitiveValue.CSS_NUMBER),c=a.green.getFloatValue(CSSPrimitiveValue.CSS_NUMBER),h=a.blue.getFloatValue(CSSPrimitiveValue.CSS_NUMBER);return"rgb("+u+","+c+","+h+")"}return e.cssText};d.CSSGetir=function(e,t,i){var n=[],r="";if(void 0!=i){for(var l=document.styleSheets,s=[],o="",a="",u="",c=0;c<l.length;c++)for(var h=l[c].rules||l[c].cssRules,f=0;f<h.length;f++)if(h[f].selectorText==e)for(o=(h[f].cssText?h[f].cssText:h[f].style.cssText).match(/\{\s*([^{}]+)\s*\}/)[1],a=o.match(/([^;:]+:\s*[^;:]+\s*)/g),ntg=0;ntg<a.length;ntg++)u=a[ntg].match(/\s*([^:;]+):\s*([^;:]+)/),u.length>2&&(s[u[1]]=u[2]);return s}if(window.getComputedStyle){var d=window.getComputedStyle(e,null);try{for(var v=0;v<d.length;v++){var g=d.getPropertyCSSValue(t);if(g)switch(g.cssValueType){case CSSValue.CSS_INHERIT:r=g.toString();break;case CSSValue.CSS_PRIMITIVE_VALUE:r=m(g);break;case CSSValue.CSS_VALUE_LIST:for(var p=0;p<g.length;p++)n.push(m(g[p]));break;case CSSValue.CSS_CUSTOM:r=g.toString()}else r=null}}catch(y){r=null}}else r=null;return n.length>0&&(r=n),("auto"==r||""==r||null==r)&&(window.getComputedStyle&&(r=window.getComputedStyle(e,null).getPropertyValue(t)),e.currentStyle&&(t=t.replace(/\-(\w)/g,function(e,t){return t.toUpperCase()}),r=e.currentStyle[t],null==r&&(r="auto"))),r};var y=function(e){if(v(e,h)){var t="([^w+]*?):\\[([^w+]*?)\\]",i=new RegExp(t,"g"),n="",r=e.match(i),l="",s="";for(var o in r)n=new RegExp(t),l=r[o].match(n),s+="ilk"==l[2]?l[1]+":first-child":"son"==l[2]?l[1]+":last-child":l[1]+":nth-child("+l[2]+")",o<r.length-1&&(s+=" ");return""!=s?s:e}return e};d.tarayici=function(){var e=window.navigator.userAgent,t=/(Opera|OPR|firefox|chrome)[\/ ]([\w.\/]+)/i,i=/(?:(MSIE) |(Trident)\/.+rv:)([\w.]+)/i,n=e.match(t)||e.match(i);if(!n)return"bilinmiyor";if(Array.prototype.filter)n=n.filter(function(e){return null!=e});else for(var r=0;r<n.length;r++){var l=n[r];(null==l||""==l)&&(n.splice(r,1),r--)}return n[1].replace("Trident","MSIE").replace("OPR","Opera")},d.konum=function(e,t){var i=document.getElementsByTagName("script"),n=i[i.length-1].src,r=n.substring(0,n.lastIndexOf("/"))+"/",l=r.toString().match(/\/\/[^\/]+\/([^\.]+)/)[1];if("alanadi"==e&&(l=window.location.host),"konum"==e)var i=document.getElementsByTagName("script"),n=i[i.length-1].src,l=n.substring(0,n.lastIndexOf("/"))+"/";else if("dizin"==e)if("undefined"==typeof t&&(t=-2),"eksi"==d.negatifSayi(t)){var s=window.location.href.split("/");l=s[s.length+t]}else"undefined"==typeof t&&(t=1),l=window.location.href.split("//")[1].split("/")[t].split(".")[0];else"tamdizin"==e?l=window.location.pathname.substring(0,window.location.pathname.lastIndexOf("/")):"adres"==e&&(l=window.location.href);return l};var S=function(){for(var e=[JSON,o.querySelectorAll,n.XMLHttpRequest],t=0;t<e.length;t++)if(!e[t])return!1;return!0};d.hataAyiklama=function(){1==u&&t("on",window,"error",d.dur)},d.veriler=d.prototype={constructor:d,kfSecici:function(e){this.gelenVeri=e;var t=this,e=y(e);if(!S())throw"Hata: phpKF JSK yüklenemiyor. Gerekli tarayıcı özellikleri mevcut değil.";try{if(e?!e.nodeType||1!==e.nodeType&&9!==e.nodeType?v(e,h)?this.gelenid=o.querySelectorAll(e):this.gelenid=e:this.gelenid=[e]:d.hataAyiklama(),this.gelenid&&d.hataAyiklama(),r.gelenid=this.gelenid,t.gelenid=this.gelenid,this.length=this.gelenid.length,0===this.length)throw"Hata: Seçici'de bir sorun olmalı, üyeler bulunamadı.";return this}catch(i){if(!c)return void 0;d.hataAyiklama()}return this},dondur:function(e,t){var n,r=this.gelenid,l=0,s=r.length,o=i(r);if(t){if(o)for(;s>l&&(n=e.apply(r[l],t),n!==!1);l++);else for(l in r)if(n=e.apply(r[l],t),n===!1)break}else if(o)for(;s>l&&(n=e.call(r[l],l,r[l]),n!==!1);l++);else for(l in r)if(n=e.call(r[l],l,r[l]),n===!1)break;return r},verileriIsle:function(e,t){var i=this.gelenid,n=0;if(!v(e,"function"))throw"Hata: döngü verilen fonksiyon yok.";if(t)for(r in i)e.call(i[r],r)===!1?n--:n++;else for(var r=0;r<i.length;r++)e.call(i[r],r)===!1?n--:n++;return n},ara:function(e){var e=y(e),t=this.gelenid;return this.verileriIsle(function(){var i=[],n=[];if(1==v(e,h)){for(var r=0;r<t.length;r++)i[r]=t[r].querySelectorAll(e);if(1==v(i,f))for(var l=0;l<i.length;l++)n.push(i[l]),delete i[l]}return d.veriler.kfSecici(n)}),this},bul:function(e){var e=y(e);return this.verileriIsle(function(){return 1==v(e,h)?d.veriler.kfSecici(this.querySelectorAll(e)):void 0}),this},uyeler:function(e){var t=0>e?this.gelenid.length+e:e;return d.veriler.kfSecici(this.gelenid[t])},uye:function(e){return this.uyeler(e)},ilk:function(){return this.uyeler(0)},son:function(){return this.uyeler(-1)},ana:function(){return d(this.gelenid[0])},kucuk:function(){},adet:function(){return this.gelenid.length},length:function(){return this.gelenid.length},blur:function(e){return this.on("blur",e),this},focus:function(e){return this.on("focus",e),this},focusin:function(e){return this.on("focusin",e),this},focusout:function(e){return this.on("focusout",e),this},resize:function(e){return this.on("resize",e),this},scroll:function(e){return this.on("scroll",e),this},click:function(e){return this.on("click",e),this},dblclick:function(e){return this.on("dblclick",e),this},mousedown:function(e){return this.on("mousedown",e),this},mouseup:function(e){return this.on("mouseup",e),this},mousemove:function(e){return this.on("mousemove",e),this},mouseover:function(e){return this.on("mouseover",e),this},mouseout:function(e){return this.on("mouseout",e),this},mouseenter:function(e){return this.on("mouseenter",e),this},mouseleave:function(e){return this.on("mouseleave",e),this},change:function(e){return this.on("change",e),this},select:function(e){return this.on("select",e),this},submit:function(e){return this.on("submit",e),this},keydown:function(e){return this.on("keydown",e),this},keypress:function(e){return this.on("keypress",e),this},keyup:function(e){return this.on("keyup",e),this},contextmenu:function(e){return this.on("contextmenu",e),this},touchstart:function(e){return this.on("touchstart",e),this},touchend:function(e){return this.on("touchend",e),this},touchcancel:function(e){return this.on("touchcancel",e),this},touchmove:function(e){return this.on("touchmove",e),this},tik:function(e){return this.on("click",e),this},veri:function(e){return this.data(e)},eson:function(t,i){var n=t.replace(/\s/gm,"").split(",");return this.verileriIsle(function(){for($olaySonuc in n)e("on",this,n[$olaySonuc],i)}),this},esoff:function(t,i){var n=t.replace(/\s/gm,"").split(",");return this.verileriIsle(function(){for($olaySonuc in n)e("off",this,n[$olaySonuc],i)}),this},data:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return void 0!=d(t).attrGetir("data-"+e)?d(t).attrGetir("data-"+e):!1},on:function(e,i,n){var r=e.replace(/\s/gm,"").split(",");if(void 0!=i&&"object"==d.veriTipi(i)==1)var l=i;else{if(void 0==n||"object"==d.veriTipi(n)!=1)return!1;var l=n,s=i}return this.verileriIsle(function(){for($olaySonuc in r)void 0!==s?t("on",this,r[$olaySonuc],l,s):t("on",this,r[$olaySonuc],l)}),this},off:function(e,i,n){var r=e.replace(/\s/gm,"").split(",");if(void 0!=i&&"object"==d.veriTipi(i)==1)var l=i;else{if(void 0==n||"object"==d.veriTipi(n)!=1)return!1;var l=n,s=i}return this.verileriIsle(function(){for($olaySonuc in r)void 0!==s?t("on",this,r[$olaySonuc],l,s):t("off",this,r[$olaySonuc],l)}),this},blur:function(e){return this.on("blur",e),this},focus:function(e){return this.on("focus",e),this},id:function(e){return null==e?d(this.gelenid).attrGetir("id"):void this.verileriIsle(function(){return null!=d(this).attrGetir(e)?d(this).attrEkle("id",e):(d(this).attrSil(e),""!=e?d(this).attrEkle("id",e):void 0)})},formVerileri:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;if(e&&"FORM"===e.nodeName){var t,i,n=[];for(t=e.elements.length-1;t>=0;t-=1)if(""!==e.elements[t].name)switch(e.elements[t].nodeName){case"INPUT":switch(e.elements[t].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":n.push(e.elements[t].name+"="+encodeURIComponent(e.elements[t].value));break;case"checkbox":case"radio":e.elements[t].checked&&n.push(e.elements[t].name+"="+encodeURIComponent(e.elements[t].value))}break;case"file":break;case"TEXTAREA":n.push(e.elements[t].name+"="+encodeURIComponent(e.elements[t].value));break;case"SELECT":switch(e.elements[t].type){case"select-one":n.push(e.elements[t].name+"="+encodeURIComponent(e.elements[t].value));break;case"select-multiple":for(i=e.elements[t].options.length-1;i>=0;i-=1)e.elements[t].options[i].selected&&n.push(e.elements[t].name+"="+encodeURIComponent(e.elements[t].options[i].value))}break;case"BUTTON":switch(e.elements[t].type){case"reset":case"submit":case"button":n.push('"'+e.elements[t].name+"="+encodeURIComponent(e.elements[t].value)+'"')}}return n.join("&")}},yuklemeCubugu:function(){var e=this.gelenVeri,t=e.replace(/[^a-zA-Z0-9]+/g,""),i=arguments,n=1===i.length?i[0]:i[1],r={limit:"100",deger:"0",genislik:"300px",yukseklik:"30px",cerceve:"1px solid #555",disCerceveRenk:"silver",cerceveCubuk:"1px solid #555",icCerceveRenk:"red",oval:"0px",golge:"0px 0px 0px #fff",yaziKonumu:"center",yaziBoyutu:"15px",yaziRengi:"white"};n=d.genislet(r,n||{});var l=function(){var e,i,r,l=Math.round(100*n.deger/n.limit),s=this.getElementsByTagName("div").length;0==s?(e=document.createElement("div"),e.id="yuklemeCubugu"+t,e.style.width=n.genislik,e.style.height=n.yukseklik,e.style.lineHeight=n.yukseklik,e.style.border=n.cerceve,e.style.borderRadius=n.oval,e.style.boxShadow=n.golge,e.style.overflow="hidden",e.style.background=n.disCerceveRenk,this.appendChild(e),i=document.createElement("div"),i.id="ilerlemeCubugu"+t,i.style.width="0%",i.style.height=n.yukseklik,e.style.lineHeight=n.yukseklik,i.style.borderRight=n.cerceveCubuk,i.style.background=n.icCerceveRenk,e.appendChild(i),r=document.createElement("div"),r.id="cubukYazisi"+t,r.style.color=n.yaziRengi,r.style.fontSize=n.yaziBoyutu,r.style.textAlign=n.yaziKonumu,r.style.position="absolute",r.style.width=n.genislik,r.style.height=n.yukseklik,r.style.lineHeight=n.yukseklik,i.appendChild(r),i.style.width=l+"%",r.innerHTML=l+"%"):(document.getElementById("ilerlemeCubugu"+t).style.width=l+"%",document.getElementById("cubukYazisi"+t).innerHTML=l+"%")};return this.verileriIsle(l),this},formDenetle:function(){var e=function(){var e=arguments,t=1===e.length?e[0]:e[1],i={mesaj:"TÜM ALANLARIN DOLDURULMASI ZORUNLUDUR!",dahil:[],haric:[]};t=d.genislet(i,t||{});for(var n=!0,r=0;r<this.elements.length;r++)t.dahil.length>0?""==this.elements[r].value&&-1!=t.dahil.indexOf(this.elements[r].name)&&(n=!1):t.haric.length>0?""==this.elements[r].value&&-1==t.haric.indexOf(this.elements[r].name)&&(n=!1):""==this.elements[r].value&&(n=!1);return n||alert(t.mesaj),n};return this.verileriIsle(e)},cerezOku:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return e?decodeURIComponent(t.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*"+encodeURIComponent(e).replace(/[\-\.\+\*]/g,"\\$&")+"\\s*\\=\\s*([^;]*).*$)|^.*$"),"$1"))||null:null},cerezYaz:function(e,t,i,n,r,l){if(this.gelenid[0])var s=this.gelenid[0];else var s=this.gelenid;if("undefined"==typeof i)var i=86400;if(!e||/^(?:expires|max\-age|path|domain|secure)$/i.test(e))return!1;var o="";if(i)switch(i.constructor){case Number:o=i===1/0?"; expires=Fri, 31 Dec 9999 23:59:59 GMT":"; max-age="+i;break;case String:o="; expires="+i;break;case Date:o="; expires="+i.toUTCString()}return s.cookie=encodeURIComponent(e)+"="+encodeURIComponent(t)+o+(r?"; domain="+r:"")+(n?"; path="+n:"")+(l?"; secure":""),!0},cerezSil:function(e,t,i){if(this.gelenid[0])var n=this.gelenid[0];else var n=this.gelenid;return e&&new RegExp("(?:^|;\\s*)"+encodeURIComponent(e).replace(/[\-\.\+\*]/g,"\\$&")+"\\s*\\=").test(n.cookie)?(n.cookie=encodeURIComponent(e)+"=; expires=Thu, 01 Jan 1970 00:00:00 GMT"+(i?"; domain="+i:"")+(t?"; path="+t:""),!0):!1},cerezVarMi:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return e?new RegExp("(?:^|;\\s*)"+encodeURIComponent(e).replace(/[\-\.\+\*]/g,"\\$&")+"\\s*\\=").test(t.cookie):!1},cerezAnahtar:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;for(var t=e.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g,"").split(/\s*(?:\=[^;]*)?;\s*/),i=t.length,n=0;i>n;n++)t[n]=decodeURIComponent(t[n]);return t},html:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;if("string"!=typeof e)return t.innerHTML;var i=function(){return this.innerHTML=e,this};this.verileriIsle(i)},ohtml:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;if("string"!=typeof e)return t.outerHTML;var i=function(){return this.outerHTML=e,this};this.verileriIsle(i)},css:function(e){if(null==e){var t=d.CSSGetir(this.gelenVeri,null,"liste"),i="";for(ac in t)i+=ac+":"+t[ac]+"; ";return i}var n=function(){return this.style.cssText=e,this};return this.verileriIsle(n),this},yazi:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;if(!e)return t.innerTEXT;var i=function(){return""==e?(this.innerTEXT="",this):(this.appendChild(o.createTextNode(e)),this)};this.verileriIsle(i)},gizle:function(){var e=arguments,t=1===e.length?e[0]:e[1],i={height:!1,width:!1};t=d.genislet(i,t||{});var n=function(){""==t.height&&""==t.width?(p.call(r,!0,"display","none",this,"setProperty"),p.call(r,!0,"visibility","hidden",this,"setProperty")):(p.call(r,!0,"overflow","hidden",this,"setProperty"),1==t.height?p.call(r,!0,"max-height","0px",this,"setProperty"):p.call(r,!0,"max-width","0px",this,"setProperty"))};return this.verileriIsle(n),this},goster:function(){var e=arguments,t=1===e.length?e[0]:e[1],i={display:"inline-block",visibility:"visible",height:!1,width:!1};t=d.genislet(i,t||{});var n=function(){""==t.height&&""==t.width?(p.call(r,!0,"display",t.display,this,"setProperty"),p.call(r,!0,"visibility",t.visibility,this,"setProperty")):(p.call(r,!0,"overflow","",this,"removeProperty"),1==t.height?p.call(r,!0,"max-height","",this,"removeProperty"):p.call(r,!0,"max-width","",this,"removeProperty"))};return this.verileriIsle(n),this},efektGoster:function(e,t,i){if(t)var n=t;else var n="block";if(i)var l=i;else var l="visible";var s=0,o=function(){var t=this,i=setInterval(function(){(s.toFixed(2)>=1||s.toFixed(2)>=1)&&clearInterval(i),p.call(r,!0,"display",n,t,"setProperty"),p.call(r,!0,"visibility",l,t,"setProperty"),p.call(r,!0,"opacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"MozOpacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"KhtmlOpacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"filter","alpha(opacity="+100*s.toFixed(2)+");",t,"setProperty"),s+=.01},1e3*e/100)};return this.verileriIsle(o),this},efektGizle:function(e,t,i){if(t)var n=t;else var n="block";if(i)var l=i;else var l="visible";var s=1,o=function(){var t=this,i=setInterval(function(){s.toFixed(2)<=0||s.toFixed(2)<=0?(p.call(r,!0,"display","none",t,"setProperty"),clearInterval(i)):(p.call(r,!0,"display",n,t,"setProperty"),p.call(r,!0,"visibility",l,t,"setProperty")),p.call(r,!0,"opacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"MozOpacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"KhtmlOpacity",s.toFixed(2),t,"setProperty"),p.call(r,!0,"filter","alpha(opacity="+100*s.toFixed(2)+");",t,"setProperty"),s-=.01},1e3*e/100)};return this.verileriIsle(o),this},animasyon:function(){var e=arguments,t=1===e.length?e[0]:e[1],i={hiz:"1",katsayi:"1",limit:"100",yon:"yan",gitgel:!1};t=d.genislet(i,t||{}),t.limit=parseInt(t.limit),t.katsayi=parseInt(t.katsayi),t.hiz=parseInt(t.hiz),t.artiEksi=d.negatifSayi(t.limit);var n=function(){var e=this;if(0!=t.gitgel){var i=this.getAttribute("data-yon");i==t.yon+":"+t.artiEksi&&("eksi"==d.negatifSayi(t.limit)?t.limit=Math.abs(t.limit):t.limit=-Math.abs(t.limit),t.artiEksi=d.negatifSayi(t.limit))}if("yan"==t.yon){if(d.CSSGetir(e,"margin-left"))var n=d.CSSGetir(e,"margin-left");else var n="0px";n=n.split("px");var l=parseInt(n[0])}else if("ust"==t.yon){if(d.CSSGetir(e,"margin-top"))var s=d.CSSGetir(e,"margin-top");else var s="0px";s=s.split("px");var l=parseInt(s[0])}var o=parseInt(t.limit+l),a=function(e,i,n,l,s,o){if(p.call(r,!0,"data-yon","",e,"removeAttribute"),p.call(r,!0,"data-yon",n+":"+l,e,"setAttribute"),"yan"==n?p.call(this,!0,"margin-left",i+"px",e,"setProperty"):p.call(this,!0,"margin-top",i+"px",e,"setProperty"),"arti"==l){if(i>=s)return p.call(this,!0,"data-yon",n+":"+l,e,"setAttribute"),!1;i+=o}else{if(s>=i)return p.call(this,!0,"data-yon",n+":"+l,e,"setAttribute"),!1;i-=o}setTimeout(function(){a(e,i,n,l,s,o)},t.hiz)};a(e,l,t.yon,t.artiEksi,o,t.katsayi)};return this.verileriIsle(n),this},ekle:function(){var e=arguments,t=1===e.length?e[0]:e[1],i={olustur:"",alanlar:{},yazi:"",html:"",temizle:!1};t=d.genislet(i,t||{});var n=function(){if(1==t.temizle&&(this.innerHTML=""),""!=t.olustur){var e=o.createElement(t.olustur),i=o.createTextNode(t.yazi);e.appendChild(i),e.innerHTML+=t.html;for(var n in t.alanlar)v(t.alanlar,"object")&&d(e).attrEkle(n,t.alanlar[n]);this.appendChild(e)}else{for(var n in t.alanlar)v(t.alanlar,"object")&&d(this).attrEkle(n,t.alanlar[n]);""!=t.yazi&&(i=o.createTextNode(t.yazi),this.appendChild(i)),""!=t.html&&(this.innerHTML+=t.html)}};return this.verileriIsle(n),this},sil:function(){var e=function(){this.parentElement.removeChild(this)};return this.verileriIsle(e),this},classVarMi:function(e){var e=e.trim(),t=function(){return"-1"!=this.className.indexOf(e)?!0:!1};return v(e,h)&&(t=this.verileriIsle(t)),t="-1"==t?"yok":"var"},classGecis:function(e,t){var e=e.trim(),i=function(){""!=e&&"undefined"!=typeof t?"var"==d(this).classVarMi(e)?(d(this).classSil(e),d(this).classEkle(t)):"var"==d(this).classVarMi(t)&&d(this).classEkle(t):"var"==d(this).classVarMi(e)?d(this).classSil(e):d(this).classEkle(e)};return v(e,h)&&this.verileriIsle(i),this},classEkle:function(e){var t=function(){for(var t=(this.className+" "+e.trim()).split(" "),i={},n=[],r=0,l=t.length;l>r;r++)i[t[r]]=!0;for(var s in i)v(s,h)&&n.push(s);this.className=n.join(" ").trim()};return v(e,h)&&this.verileriIsle(t),this},classSil:function(e){var t=function(){for(var t=this.className+"",i=e.trim().split(" "),n=0;n<i.length;n++)t=t.replace(i[n],"");this.className=t};return this.verileriIsle(t),this},val:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return"string"!=typeof e?t.value:(this.verileriIsle(function(){this.value=e}),this)},scrollTop:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return"undefined"==typeof e?t.scrollTop:(t.scrollTop=e,this)},scrollLeft:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return"undefined"==typeof e?t.scrollLeft:(t.scrollLeft=e,this)},clientTop:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return"undefined"==typeof e?t.clientTop:(t.clientTop=e,this)},clientLeft:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return"undefined"==typeof e?t.clientLeft:(t.clientLeft=e,this)},scroll:function(e,t,i){if(this.gelenid[0])var n=this.gelenid[0];else var n=this.gelenid;return"undefined"==typeof i?n.scrollTo(e,t):n.scrollBy(e,t),this},scrollWidth:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.scrollWidth},scrollHeight:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.scrollHeight},clientWidth:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.clientWidth},clientHeight:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.clientHeight},innerWidth:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.innerWidth},konsol:function(e,t,i){if(this.gelenid[0])var n=this.gelenid[0];else var n=this.gelenid;return n.execCommand(e,t,i),this},sec:function(e,t){if(this.gelenid[0])var i=this.gelenid[0];else var i=this.gelenid;return"ilk"==e?(e=0,t=0):"son"==e&&(e=9999,t=9999),"undefined"==typeof e&&(e=0),"undefined"==typeof t&&(t=0),i.select(),i.focus(),i.setSelectionRange(e,t),this},secText:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.select(),this},secDiv:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.focus(),this},innerHeight:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.innerHeight},width:function(){return window.screen.width},height:function(){return window.screen.height},attrEkle:function(e,t){var i=function(){p.call(r,!0,e,t,this,"setAttribute")};return this.verileriIsle(i),this},attrGetir:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;var i=t.getAttribute(e);return i},attrSil:function(e){var t=function(){p.call(r,!0,e,"",this,"removeAttribute")};return this.verileriIsle(t),this},cssSil:function(e){var t=function(){p.call(r,!0,e,"",this,"removeProperty")};return this.verileriIsle(t),this},cssEkle:function(e,t){var i=function(){p.call(r,!0,e,t,this,"setProperty")};return this.verileriIsle(i),this},cssGetir:function(e){if(this.gelenid[0])var t=this.gelenid[0];else var t=this.gelenid;return d.CSSGetir(t,e)},follow:function(){return this.verileriIsle(function(){return this}),this},toString:function(){if(this.gelenid[0])var e=this.gelenid[0];else var e=this.gelenid;return e.toString()},liste:function(){return this.gelenid},append:function(e){this.verileriIsle(function(){return this.appendChild(e)})},insert:function(e,t){this.verileriIsle(function(){return this.parentNode.insertBefore(e,t)})},don:function(e){return 1==e?this.gelenid:this.gelenid[0]},"return":function(e){return 1==e?this.gelenid:this.gelenid[0]}},d.ajax=function(e,i){var n=arguments,i=1===n.length?n[0]:n[1],r={adres:2===n.length&&v(e,h)?e:".",cacheDurumu:!0,veri:{},basliklar:{},dosya:!1,baglam:null,content:"application/x-www-form-urlencoded",requested:"XMLHttpRequest",dil:"utf-8",tip:"GET",ekle:null,xhr:function(){return new window.XMLHttpRequest},yuklemeDurumu:function(){return new window.XMLHttpRequest},basarili:function(){},hata:function(){},tamamlandi:function(){}};i=d.genislet(r,i||{});var l={"application/json":"json","text/html":"html","text/plain":"text"};i.cacheDurumu||(i.adres=i.adres+(i.adres.indexOf("?")?"&":"?")+"noCache="+Math.floor(9e9*Math.random()));var s=function(e,t){var i="xhr";return t.xhr.call(t.baglam,e,i,t.ekle),c(i,e,t),this},o=function(e,i){var n="yuklemeDurumu",r=function(t){var r=parseInt(100-t.loaded/t.total*100),l=parseInt(0+t.loaded/t.total*100);i.yuklemeDurumu.call(i.baglam,e,t.loaded,t.total,r,l,n,i.ekle)};return t("on",e.upload,"progress",r),c(n,e,i),this},a=function(e,t,i){var n="basarili";return i.basarili.call(i.baglam,e,n,t,i.ekle),c(n,t,i),this},u=function(e,t,i,n){return n.hata.call(n.baglam,i,t,e,n.ekle),c(t,i,n),this},c=function(e,t,i){return i.tamamlandi.call(i.baglam,t,e,i.ekle),this};if(window.XMLHttpRequest)var f=new XMLHttpRequest;else var f=new ActiveXObject("Microsoft.XMLHTTP");o(f,i),s(f,i);var g=function(){if(4===f.readyState){var e,t;if(f.status>=200&&f.status<300||304===f.status){var n=f.getResponseHeader("content-type");t=l[n]||"text",e=f.responseText;try{return"json"===t&&(e=JSON.parse(e)),void a(e,f,i)}catch(r){}}return void u(null,"hata",f,i)}};t("on",f,"readystatechange",g);var p="",m=0;for(var y in i.veri)0==i.dosya&&"-1"==i.veri[y].indexOf("&")&&v(i.veri,"object")?(p+=y+"="+i.veri[y],m<Object.keys(i.veri).length-1&&(p+="&"),m++):p=i.veri;"GET"===i.tip?f.open(i.tip,i.adres+"?"+p):f.open(i.tip,i.adres),"POST"===i.tip&&(i.basliklar=d.genislet(i.basliklar,{"X-Requested-With":i.requested}),0==i.dosya&&(i.basliklar=d.genislet(i.basliklar,{"Content-type":i.content+"; charset="+i.dil})));for(var y in i.basliklar)f.setRequestHeader(y,i.basliklar[y]);return f.send(p||null),this},d.veriler.kfSecici.prototype=d.veriler,d.birlestir=function(e){function t(e){var i=d.veriler;for(var n in e)try{e[n].constructor==Object?i[n]=t(i[n],e[n]):i[n]=e[n]}catch(r){i[n]=e[n]}return i}return d.veriler.kfSecici.prototype=t(e)};var k=s._phpKF,b=s.$;return l.Secici=function(e){return s.$===d&&(s.$=b),e&&s._phpKF===d&&(s._phpKF=k),d},s.phpKF=l,s._phpKF=s.KF_Eklenti=s.$=d,d}();

//  -->