!function(t){var n={};function e(o){if(n[o])return n[o].exports;var s=n[o]={i:o,l:!1,exports:{}};return t[o].call(s.exports,s,s.exports,e),s.l=!0,s.exports}e.m=t,e.c=n,e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:o})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(e.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var s in t)e.d(o,s,function(n){return t[n]}.bind(null,s));return o},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=689)}({689:function(t,n,e){"use strict";var o={init:function(){$("#kt_touchspin_1, #kt_touchspin_2_1").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",min:0,max:100,step:.1,decimals:2,boostat:5,maxboostedstep:10}),$("#kt_touchspin_2, #kt_touchspin_2_2").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",min:-1e9,max:1e9,stepinterval:50,maxboostedstep:1e7,prefix:"$"}),$("#kt_touchspin_3, #kt_touchspin_2_3").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",min:-1e9,max:1e9,stepinterval:50,maxboostedstep:1e7,postfix:"$"}),$("#kt_touchspin_4, #kt_touchspin_2_4").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",verticalbuttons:!0,verticalup:'<i class="la la-plus"></i>',verticaldown:'<i class="la la-minus"></i>'}),$("#kt_touchspin_5, #kt_touchspin_2_5").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",verticalbuttons:!0,verticalup:'<i class="la la-angle-up"></i>',verticaldown:'<i class="la la-angle-down"></i>'}),$("#kt_touchspin_1_validate").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",min:-1e9,max:1e9,stepinterval:50,maxboostedstep:1e7,prefix:"$"}),$("#kt_touchspin_2_validate").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",min:0,max:100,step:.1,decimals:2,boostat:5,maxboostedstep:10}),$("#kt_touchspin_3_validate").TouchSpin({buttondown_class:"btn btn-secondary",buttonup_class:"btn btn-secondary",verticalbuttons:!0,verticalupclass:"la la-plus",verticaldownclass:"la la-minus"})}};jQuery(document).ready((function(){o.init()}))}});