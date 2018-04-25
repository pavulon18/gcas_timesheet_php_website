﻿/*
 Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
(function(){function y(a){function b(){this.deflated||(a.widgets.focused==this.widget&&(this.focused=!0),a.widgets.destroy(this.widget),this.deflated=!0)}function e(){var b=a.editable(),c=a.document;if(this.deflated)this.widget=a.widgets.initOn(this.element,"image",this.widget.data),this.widget.inline&&!(new CKEDITOR.dom.elementPath(this.widget.wrapper,b)).block&&(b=c.createElement(a.activeEnterMode==CKEDITOR.ENTER_P?"p":"div"),b.replace(this.widget.wrapper),this.widget.wrapper.move(b)),this.focused&&
(this.widget.focus(),delete this.focused),delete this.deflated;else{var d=this.widget,b=f,c=d.wrapper,e=d.data.align,d=d.data.hasCaption;if(b){for(var j=3;j--;)c.removeClass(b[j]);"center"==e?d&&c.addClass(b[1]):"none"!=e&&c.addClass(b[m[e]])}else"center"==e?(d?c.setStyle("text-align","center"):c.removeStyle("text-align"),c.removeStyle("float")):("none"==e?c.removeStyle("float"):c.setStyle("float",e),c.removeStyle("text-align"))}}var f=a.config.image2_alignClasses,g=a.config.image2_captionedClass;
return{allowedContent:z(a),requiredContent:"img[src,alt]",features:A(a),styleableElements:"img figure",contentTransformations:[["img[width]: sizeToAttribute"]],editables:{caption:{selector:"figcaption",allowedContent:"br em strong sub sup u s; a[!href]"}},parts:{image:"img",caption:"figcaption"},dialog:"image2",template:t,data:function(){var f=this.features;this.data.hasCaption&&!a.filter.checkFeature(f.caption)&&(this.data.hasCaption=!1);"none"!=this.data.align&&!a.filter.checkFeature(f.align)&&
(this.data.align="none");this.shiftState({widget:this,element:this.element,oldData:this.oldData,newData:this.data,deflate:b,inflate:e});this.data.link?this.parts.link||(this.parts.link=this.parts.image.getParent()):this.parts.link&&delete this.parts.link;this.parts.image.setAttributes({src:this.data.src,"data-cke-saved-src":this.data.src,alt:this.data.alt});if(this.oldData&&!this.oldData.hasCaption&&this.data.hasCaption)for(var c in this.data.classes)this.parts.image.removeClass(c);if(a.filter.checkFeature(f.dimension)){f=
this.data;f={width:f.width,height:f.height};c=this.parts.image;for(var d in f)f[d]?c.setAttribute(d,f[d]):c.removeAttribute(d)}this.oldData=CKEDITOR.tools.extend({},this.data)},init:function(){var b=CKEDITOR.plugins.image2,c=this.parts.image,d={hasCaption:!!this.parts.caption,src:c.getAttribute("src"),alt:c.getAttribute("alt")||"",width:c.getAttribute("width")||"",height:c.getAttribute("height")||"",lock:this.ready?b.checkHasNaturalRatio(c):!0},e=c.getAscendant("a");e&&this.wrapper.contains(e)&&(this.parts.link=
e);d.align||(f?(this.element.hasClass(f[0])?d.align="left":this.element.hasClass(f[2])&&(d.align="right"),d.align?this.element.removeClass(f[m[d.align]]):d.align="none"):(d.align=this.element.getStyle("float")||c.getStyle("float")||"none",this.element.removeStyle("float"),c.removeStyle("float")));if(a.plugins.link&&this.parts.link&&(d.link=CKEDITOR.plugins.link.parseLinkAttributes(a,this.parts.link),(c=d.link.advanced)&&c.advCSSClasses))c.advCSSClasses=CKEDITOR.tools.trim(c.advCSSClasses.replace(/cke_\S+/,
""));this.wrapper[(d.hasCaption?"remove":"add")+"Class"]("cke_image_nocaption");this.setData(d);a.filter.checkFeature(this.features.dimension)&&B(this);this.shiftState=b.stateShifter(this.editor);this.on("contextMenu",function(a){a.data.image=CKEDITOR.TRISTATE_OFF;if(this.parts.link||this.wrapper.getAscendant("a"))a.data.link=a.data.unlink=CKEDITOR.TRISTATE_OFF});this.on("dialog",function(a){a.data.widget=this},this)},addClass:function(a){n(this).addClass(a)},hasClass:function(a){return n(this).hasClass(a)},
removeClass:function(a){n(this).removeClass(a)},getClasses:function(){var a=RegExp("^("+[].concat(g,f).join("|")+")$");return function(){var b=this.repository.parseElementClasses(n(this).getAttribute("class")),f;for(f in b)a.test(f)&&delete b[f];return b}}(),upcast:C(a),downcast:D(a)}}function C(a){var b=o(a),e=a.config.image2_captionedClass;return function(a,g){var h={width:1,height:1},c=a.name,d;if(!a.attributes["data-cke-realelement"]){if(b(a)){if("div"==c&&(d=a.getFirst("figure")))a.replaceWith(d),
a=d;g.align="center";d=a.getFirst("img")||a.getFirst("a").getFirst("img")}else"figure"==c&&a.hasClass(e)?d=a.getFirst("img")||a.getFirst("a").getFirst("img"):k(a)&&(d="a"==a.name?a.children[0]:a);if(d){for(var i in h)(c=d.attributes[i])&&c.match(E)&&delete d.attributes[i];return a}}}}function D(a){var b=a.config.image2_alignClasses;return function(a){var f="a"==a.name?a.getFirst():a,g=f.attributes,h=this.data.align;if(!this.inline){var c=a.getFirst("span");c&&c.replaceWith(c.getFirst({img:1,a:1}))}h&&
"none"!=h&&(c=CKEDITOR.tools.parseCssText(g.style||""),"center"==h&&"figure"==a.name?a=a.wrapWith(new CKEDITOR.htmlParser.element("div",b?{"class":b[1]}:{style:"text-align:center"})):h in{left:1,right:1}&&(b?f.addClass(b[m[h]]):c["float"]=h),!b&&!CKEDITOR.tools.isEmpty(c)&&(g.style=CKEDITOR.tools.writeCssText(c)));return a}}function o(a){var b=a.config.image2_captionedClass,e=a.config.image2_alignClasses,f={figure:1,a:1,img:1};return function(g){if(!(g.name in{div:1,p:1}))return!1;var h=g.children;
if(1!==h.length)return!1;h=h[0];if(!(h.name in f))return!1;if("p"==g.name){if(!k(h))return!1}else if("figure"==h.name){if(!h.hasClass(b))return!1}else if(a.enterMode==CKEDITOR.ENTER_P||!k(h))return!1;return(e?g.hasClass(e[1]):"center"==CKEDITOR.tools.parseCssText(g.attributes.style||"",!0)["text-align"])?!0:!1}}function k(a){return"img"==a.name?!0:"a"==a.name?1==a.children.length&&a.getFirst("img"):!1}function B(a){var b=a.editor,e=b.editable(),f=b.document,g=a.resizer=f.createElement("span");g.addClass("cke_image_resizer");
g.setAttribute("title",b.lang.image2.resizer);g.append(new CKEDITOR.dom.text("​",f));if(a.inline)a.wrapper.append(g);else{var h=a.parts.link||a.parts.image,c=h.getParent(),d=f.createElement("span");d.addClass("cke_image_resizer_wrapper");d.append(h);d.append(g);a.element.append(d,!0);c.is("span")&&c.remove()}g.on("mousedown",function(c){function j(a,b,c){var j=CKEDITOR.document,d=[];f.equals(j)||d.push(j.on(a,b));d.push(f.on(a,b));if(c)for(a=d.length;a--;)c.push(d.pop())}function d(){p=m+i*u;q=Math.round(p/
r)}function s(){q=o-l;p=Math.round(q*r)}var h=a.parts.image,i="right"==a.data.align?-1:1,n=c.data.$.screenX,F=c.data.$.screenY,m=h.$.clientWidth,o=h.$.clientHeight,r=m/o,k=[],t="cke_image_s"+(!~i?"w":"e"),x,p,q,w,u,l,v;b.fire("saveSnapshot");j("mousemove",function(a){x=a.data.$;u=x.screenX-n;l=F-x.screenY;v=Math.abs(u/l);1==i?0>=u?0>=l?d():v>=r?d():s():0>=l?v>=r?s():d():s():0>=u?0>=l?v>=r?s():d():s():0>=l?d():v>=r?d():s();15<=p&&15<=q?(h.setAttributes({width:p,height:q}),w=!0):w=!1},k);j("mouseup",
function(){for(var c;c=k.pop();)c.removeListener();e.removeClass(t);g.removeClass("cke_image_resizing");w&&(a.setData({width:p,height:q}),b.fire("saveSnapshot"));w=!1},k);e.addClass(t);g.addClass("cke_image_resizing")});a.on("data",function(){g["right"==a.data.align?"addClass":"removeClass"]("cke_image_resizer_left")})}function G(a){var b=[],e;return function(f){var g=a.getCommand("justify"+f);if(g){b.push(function(){g.refresh(a,a.elementPath())});if(f in{right:1,left:1,center:1})g.on("exec",function(e){var c=
i(a);if(c){c.setData("align",f);for(c=b.length;c--;)b[c]();e.cancel()}});g.on("refresh",function(b){var c=i(a),d={right:1,left:1,center:1};c&&(void 0==e&&(e=a.filter.checkFeature(a.widgets.registered.image.features.align)),e?this.setState(c.data.align==f?CKEDITOR.TRISTATE_ON:f in d?CKEDITOR.TRISTATE_OFF:CKEDITOR.TRISTATE_DISABLED):this.setState(CKEDITOR.TRISTATE_DISABLED),b.cancel())})}}}function H(a){a.plugins.link&&(a.on("doubleclick",function(b){b.data.dialog&&("link"==b.data.dialog&&i(a))&&b.cancel()}),
CKEDITOR.on("dialogDefinition",function(b){b=b.data;if("link"==b.name){var b=b.definition,e=b.onShow,f=b.onOk;b.onShow=function(){var b=i(a);b&&(b.inline?!b.wrapper.getAscendant("a"):1)?this.setupContent(b.data.link||{}):e.apply(this,arguments)};b.onOk=function(){var b=i(a);if(b&&(b.inline?!b.wrapper.getAscendant("a"):1)){var e={};this.commitContent(e);b.setData("link",e)}else f.apply(this,arguments)}}}),a.getCommand("unlink").on("exec",function(b){var e=i(a);e&&e.parts.link&&(e.setData("link",null),
this.refresh(a,a.elementPath()),b.cancel())}),a.getCommand("unlink").on("refresh",function(b){var e=i(a);e&&(this.setState(e.data.link||e.wrapper.getAscendant("a")?CKEDITOR.TRISTATE_OFF:CKEDITOR.TRISTATE_DISABLED),b.cancel())}))}function i(a){return(a=a.widgets.focused)&&"image"==a.name?a:null}function z(a){var b=a.config.image2_alignClasses,a={div:{match:o(a)},p:{match:o(a)},img:{attributes:"!src,alt,width,height"},figure:{classes:"!"+a.config.image2_captionedClass},figcaption:!0};b?(a.div.classes=
b[1],a.p.classes=a.div.classes,a.img.classes=b[0]+","+b[2],a.figure.classes+=","+a.img.classes):(a.div.styles="text-align",a.p.styles="text-align",a.img.styles="float",a.figure.styles="float,display");return a}function A(a){a=a.config.image2_alignClasses;return{dimension:{requiredContent:"img[width,height]"},align:{requiredContent:"img"+(a?"("+a[0]+")":"{float}")},caption:{requiredContent:"figcaption"}}}function n(a){return a.data.hasCaption?a.element:a.parts.image}var t='<img alt="" src="" />',I=
new CKEDITOR.template('<figure class="{captionedClass}">'+t+"<figcaption>{captionPlaceholder}</figcaption></figure>"),m={left:0,center:1,right:2},E=/^\s*(\d+\%)\s*$/i;CKEDITOR.plugins.add("image2",{lang:"af,ar,bg,bn,bs,ca,cs,cy,da,de,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn",requires:"widget,dialog",icons:"image",hidpi:!0,onLoad:function(){CKEDITOR.addCss(".cke_image_nocaption{line-height:0}.cke_editable.cke_image_sw, .cke_editable.cke_image_sw *{cursor:sw-resize !important}.cke_editable.cke_image_se, .cke_editable.cke_image_se *{cursor:se-resize !important}.cke_image_resizer{display:none;position:absolute;width:10px;height:10px;bottom:-5px;right:-5px;background:#000;outline:1px solid #fff;line-height:0;cursor:se-resize;}.cke_image_resizer_wrapper{position:relative;display:inline-block;line-height:0;}.cke_image_resizer.cke_image_resizer_left{right:auto;left:-5px;cursor:sw-resize;}.cke_widget_wrapper:hover .cke_image_resizer,.cke_image_resizer.cke_image_resizing{display:block}.cke_widget_wrapper>a{display:inline-block}")},
init:function(a){var b=a.config,e=a.lang.image2,f=y(a);b.filebrowserImage2BrowseUrl=b.filebrowserImageBrowseUrl;b.filebrowserImage2UploadUrl=b.filebrowserImageUploadUrl;f.pathName=e.pathName;f.editables.caption.pathName=e.pathNameCaption;a.widgets.add("image",f);a.ui.addButton&&a.ui.addButton("Image",{label:a.lang.common.image,command:"image",toolbar:"insert,10"});a.contextMenu&&(a.addMenuGroup("image",10),a.addMenuItem("image",{label:e.menu,command:"image",group:"image"}));CKEDITOR.dialog.add("image2",
this.path+"dialogs/image2.js")},afterInit:function(a){var b={left:1,right:1,center:1,block:1},e=G(a),f;for(f in b)e(f);H(a)}});CKEDITOR.plugins.image2={stateShifter:function(a){function b(a,b){var c={};g?c.attributes={"class":g[1]}:c.styles={"text-align":"center"};c=f.createElement(a.activeEnterMode==CKEDITOR.ENTER_P?"p":"div",c);e(c,b);b.move(c);return c}function e(b,d){if(d.getParent()){var f=a.createRange();f.moveToPosition(d,CKEDITOR.POSITION_BEFORE_START);d.remove();c.insertElementIntoRange(b,
f)}else b.replace(d)}var f=a.document,g=a.config.image2_alignClasses,h=a.config.image2_captionedClass,c=a.editable(),d=["hasCaption","align","link"],i={align:function(c,d,f){var e=c.element;if(c.changed.align){if(!c.newData.hasCaption&&("center"==f&&(c.deflate(),c.element=b(a,e)),!c.changed.hasCaption&&"center"==d&&"center"!=f))c.deflate(),d=e.findOne("a,img"),d.replace(e),c.element=d}else"center"==f&&(c.changed.hasCaption&&!c.newData.hasCaption)&&(c.deflate(),c.element=b(a,e));!g&&e.is("figure")&&
("center"==f?e.setStyle("display","inline-block"):e.removeStyle("display"))},hasCaption:function(b,c,d){b.changed.hasCaption&&(c=b.element.is({img:1,a:1})?b.element:b.element.findOne("a,img"),b.deflate(),d?(d=CKEDITOR.dom.element.createFromHtml(I.output({captionedClass:h,captionPlaceholder:a.lang.image2.captionPlaceholder}),f),e(d,b.element),c.replace(d.findOne("img")),b.element=d):(c.replace(b.element),b.element=c))},link:function(b,c,d){if(b.changed.link){var e=b.element.is("img")?b.element:b.element.findOne("img"),
g=b.element.is("a")?b.element:b.element.findOne("a"),h=b.element.is("a")&&!d||b.element.is("img")&&d,i;h&&b.deflate();d?(c||(i=f.createElement("a",{attributes:{href:b.newData.link.url}}),i.replace(e),e.move(i)),d=CKEDITOR.plugins.link.getLinkAttributes(a,d),CKEDITOR.tools.isEmpty(d.set)||(i||g).setAttributes(d.set),d.removed.length&&(i||g).removeAttributes(d.removed)):(d=g.findOne("img"),d.replace(g),i=d);h&&(b.element=i)}}};return function(a){var b,c;a.changed={};for(c=0;c<d.length;c++)b=d[c],a.changed[b]=
a.oldData?a.oldData[b]!==a.newData[b]:!1;for(c=0;c<d.length;c++)b=d[c],i[b](a,a.oldData?a.oldData[b]:null,a.newData[b]);a.inflate()}},checkHasNaturalRatio:function(a){var b=a.$,a=this.getNatural(a);return Math.round(b.clientWidth/a.width*a.height)==b.clientHeight||Math.round(b.clientHeight/a.height*a.width)==b.clientWidth},getNatural:function(a){if(a.$.naturalWidth)a={width:a.$.naturalWidth,height:a.$.naturalHeight};else{var b=new Image;b.src=a.getAttribute("src");a={width:b.width,height:b.height}}return a}}})();
CKEDITOR.config.image2_captionedClass="image";