﻿/*
 Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
(function(){CKEDITOR.plugins.add("ajax",{requires:"xml"});CKEDITOR.ajax=function(){function g(){if(!CKEDITOR.env.ie||"file:"!=location.protocol)try{return new XMLHttpRequest}catch(a){}try{return new ActiveXObject("Msxml2.XMLHTTP")}catch(b){}try{return new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}return null}function h(a){return 4==a.readyState&&(200<=a.status&&300>a.status||304==a.status||0===a.status||1223==a.status)}function i(a){return h(a)?a.responseText:null}function j(a,b,e){var f=!!b,c=
g();if(!c)return null;c.open("GET",a,f);f&&(c.onreadystatechange=function(){4==c.readyState&&(b(e(c)),c=null)});c.send(null);return f?"":e(c)}function k(a,b,e,f,c){var d=g();if(!d)return null;d.open("POST",a,!0);d.onreadystatechange=function(){4==d.readyState&&(f(c(d)),d=null)};d.setRequestHeader("Content-type",e||"application/x-www-form-urlencoded; charset=UTF-8");d.send(b)}var l=function(a){if(h(a)){var b=a.responseXML;return new CKEDITOR.xml(b&&b.firstChild?b:a.responseText)}return null};return{load:function(a,
b){return j(a,b,i)},post:function(a,b,e,f){return k(a,b,e,f,i)},loadXml:function(a,b){return j(a,b,l)}}}()})();